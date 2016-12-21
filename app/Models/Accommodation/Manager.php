<?php

namespace App\Models\Accommodation;

use App\Core\Image\SaveImage;
use DB;

class Manager
{
    public function store($data)
    {
        $data = $this->processSave($data);
        $accommodation = new Accommodation($data);
        DB::transaction(function() use($data, $accommodation) {
            $accommodation->save();
            $this->updatePrices($data['prices'], $accommodation);
            $this->storeMl($data['ml'], $accommodation);
            $this->updateDetails($data['details'], $accommodation);
            $this->storeImages($data['images'], $accommodation);
        });
    }

    public function update($id, $data)
    {
        $accommodation = Accommodation::findOrFail($id);
        $data = $this->processSave($data);
        DB::transaction(function() use($data, $accommodation) {
            $accommodation->update($data);
            $this->updatePrices($data['prices'], $accommodation, true);
            $this->updateMl($data['ml'], $accommodation);
            $this->updateDetails($data['details'], $accommodation, true);
            $this->updateImages($data['images'], $accommodation);
        });
    }

    protected function updatePrices($data, Accommodation $accommodation, $editMode = false)
    {
        if ($editMode) {
            AccommodationPrice::where('accommodation_id', $accommodation->id)->delete();
        }
        $prices = [];
        foreach ($data as $value) {
            $prices[] = new AccommodationPrice([
                'start_date' => $value['start_month'].'-'.$value['start_day'],
                'end_date' => $value['end_month'].'-'.$value['end_day'],
                'price' => $value['price']
            ]);
        }
        $accommodation->prices()->saveMany($prices);
    }

    protected function storeMl($data, Accommodation $accommodation)
    {
        $ml = $facilities = [];
        foreach ($data as $lngId => $mlData) {
            $ml[] = [
                'id' => $accommodation->id,
                'lng_id' => $lngId,
                'title' => $mlData['title'],
                'text' => $mlData['text'],
                'bed_type' => $mlData['bed_type'],
            ];
            if (isset($mlData['facilities'])) {
                $index = 0;
                foreach ($mlData['facilities'] as $facility) {
                    $facilities[] = [
                        'accommodation_id' => $accommodation->id,
                        'lng_id' => $lngId,
                        'title' => $facility['title'],
                        'index' => $index,
                    ];
                    $index++;
                }
            }
        }
        if (!empty($ml)) {
            AccommodationMl::insert($ml);
        }
        if (!empty($facilities)) {
            AccommodationFacility::insert($facilities);
        }
    }

    protected function updateMl($data, Accommodation $accommodation)
    {
        AccommodationMl::where('id', $accommodation->id)->delete();
        AccommodationFacility::where('accommodation_id', $accommodation->id)->delete();
        $this->storeMl($data, $accommodation);
    }

    protected function processSave($data)
    {
        if (!isset($data['prices'])) {
            $data['prices'] = [];
        }
        if (!isset($data['images'])) {
            $data['images'] = [];
        }
        if (!isset($data['details'])) {
            $data['details'] = [];
        }
        return $data;
    }

    protected function updateDetails($data, Accommodation $accommodation, $editMode = false)
    {
        if ($editMode) {
            AccommodationDetail::where('accommodation_id', $accommodation->id)->delete();
        }
        $details = [];
        $index = 0;
        foreach ($data as $key => $value) {
            foreach ($value['ml'] as $lngId => $ml) {
                $details[] = [
                    'accommodation_id' => $accommodation->id,
                    'lng_id' => $lngId,
                    'title' => $ml['title'],
                    'price' => $value['price'],
                    'index' => $index
                ];
            }
            $index++;
        }
        if (!empty($details)) {
            AccommodationDetail::insert($details);
        }
    }

    protected function storeImages($data, Accommodation $accommodation)
    {
        $images = [];
        $i = 0;
        foreach ($data as $value) {
            $images[$i] = new AccommodationImage(['show_status' => Accommodation::STATUS_ACTIVE]);
            SaveImage::save($value['image'], $images[$i]);
            $i++;
        }
        if (!empty($images)) {
            $accommodation->images()->saveMany($images);
        }
    }

    protected function updateImages($data, Accommodation $accommodation)
    {
        AccommodationImage::where('accommodation_id', $accommodation->id)->update(['show_status' => Accommodation::STATUS_DELETED]);
        $newImages = [];
        foreach ($data as $value) {
            if (empty($value['id'])) {
                $newImages[] = $value;
            } else {
                $accommodationImage = AccommodationImage::findOrFail($value['id']);
                $accommodationImage->show_status = Accommodation::STATUS_ACTIVE;
                $accommodationImage->save();
            }
        }
        if (!empty($newImages)) {
            $this->storeImages($newImages, $accommodation);
        }
        $deletedImages = AccommodationImage::where('accommodation_id', $accommodation->id)->where('show_status', Accommodation::STATUS_DELETED)->get();
        foreach ($deletedImages as $deletedImage) {
            $imgPath = public_path($deletedImage->getStorePath().'/'.$deletedImage->image);
            if (file_exists($imgPath)) {
                unlink($imgPath);
            }
        }
        AccommodationImage::where('accommodation_id', $accommodation->id)->where('show_status', Accommodation::STATUS_DELETED)->delete();
    }

    public function delete($id)
    {
        Accommodation::where('id', $id)->delete();
        AccommodationMl::where('id', $id)->delete();
        AccommodationImage::where('accommodation_id', $id)->delete();
        AccommodationFacility::where('accommodation_id', $id)->delete();
        AccommodationDetail::where('accommodation_id', $id)->delete();
    }
}