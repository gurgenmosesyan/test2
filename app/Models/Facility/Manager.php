<?php

namespace App\Models\Facility;

use App\Core\Image\SaveImage;
use DB;

class Manager
{
    public function store($data)
    {
        $facility = new Facility();
        DB::transaction(function() use($data, $facility) {
            $facility->save();
            $this->storeMl($data['ml'], $facility);
        });
    }

    public function update($id, $data)
    {
        $facility = Facility::findOrFail($id);
        DB::transaction(function() use($data, $facility) {
            $facility->update();
            $this->updateMl($data['ml'], $facility);
        });
    }

    protected function storeMl($data, Facility $facility)
    {
        $ml = [];
        foreach ($data as $lngId => $mlData) {
            $mlData['lng_id'] = $lngId;
            $ml[] = new FacilityMl($mlData);
        }
        $facility->ml()->saveMany($ml);
    }

    protected function updateMl($data, Facility $facility)
    {
        FacilityMl::where('id', $facility->id)->delete();
        $this->storeMl($data, $facility);
    }

    public function updateImages($data)
    {
        FacilityImage::where('show_status', FacilityImage::STATUS_ACTIVE)->update(['show_status' => FacilityImage::STATUS_DELETED]);
        $newImages = [];
        foreach ($data as $value) {
            if (empty($value['id'])) {
                $newImages[] = $value;
            } else {
                $offerImage = FacilityImage::findOrFail($value['id']);
                $offerImage->show_status = FacilityImage::STATUS_ACTIVE;
                $offerImage->save();
            }
        }
        if (!empty($newImages)) {
            $this->storeImages($newImages);
        }
        $deletedImages = FacilityImage::where('show_status', FacilityImage::STATUS_DELETED)->get();
        foreach ($deletedImages as $deletedImage) {
            $imgPath = public_path($deletedImage->getStorePath().'/'.$deletedImage->image);
            if (file_exists($imgPath)) {
                unlink($imgPath);
            }
        }
        FacilityImage::where('show_status', FacilityImage::STATUS_DELETED)->delete();
    }

    public function updateText($data)
    {
        DB::transaction(function() use($data) {
            FacilityText::getProcessor()->delete();
            foreach ($data as $lngId => $mlData) {
                $mlData['lng_id'] = $lngId;
                $text = new FacilityText($mlData);
                $text->save();
            }
        });
    }

    protected function storeImages($data)
    {
        foreach ($data as $value) {
            $image = new FacilityImage(['show_status' => FacilityImage::STATUS_ACTIVE]);
            SaveImage::save($value['image'], $image);
            $image->save();
        }
    }

    public function delete($id)
    {
        DB::transaction(function() use($id) {
            Facility::where('id', $id)->delete();
            FacilityMl::where('id', $id)->delete();
        });
    }
}