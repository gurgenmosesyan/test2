<?php

namespace App\Models\Offer;

use App\Core\Image\SaveImage;
use DB;

class Manager
{
    public function store($data)
    {
        $data = $this->processSave($data);
        $offer = new Offer($data);
        DB::transaction(function() use($data, $offer) {
            $offer->save();
            $this->storeMl($data['ml'], $offer);
            $this->storeImages($data['images'], $offer);
        });
    }

    public function update($id, $data)
    {
        $offer = Offer::findOrFail($id);
        $data = $this->processSave($data);
        DB::transaction(function() use($data, $offer) {
            $offer->update($data);
            $this->updateMl($data['ml'], $offer);
            $this->updateImages($data['images'], $offer);
        });
    }

    protected function storeMl($data, Offer $offer)
    {
        $ml = [];
        foreach ($data as $lngId => $mlData) {
            $mlData['lng_id'] = $lngId;
            $ml[] = new OfferMl($mlData);
        }
        $offer->ml()->saveMany($ml);
    }

    protected function updateMl($data, Offer $offer)
    {
        OfferMl::where('id', $offer->id)->delete();
        $this->storeMl($data, $offer);
    }

    protected function processSave($data)
    {
        if (!isset($data['images'])) {
            $data['images'] = [];
        }
        return $data;
    }

    protected function storeImages($data, Offer $offer)
    {
        $images = [];
        $i = 0;
        foreach ($data as $value) {
            $images[$i] = new OfferImage(['show_status' => Offer::STATUS_ACTIVE]);
            SaveImage::save($value['image'], $images[$i]);
            $i++;
        }
        if (!empty($images)) {
            $offer->images()->saveMany($images);
        }
    }

    protected function updateImages($data, Offer $offer)
    {
        OfferImage::where('offer_id', $offer->id)->update(['show_status' => Offer::STATUS_DELETED]);
        $newImages = [];
        foreach ($data as $value) {
            if (empty($value['id'])) {
                $newImages[] = $value;
            } else {
                $offerImage = OfferImage::findOrFail($value['id']);
                $offerImage->show_status = Offer::STATUS_ACTIVE;
                $offerImage->save();
            }
        }
        if (!empty($newImages)) {
            $this->storeImages($newImages, $offer);
        }
        $deletedImages = OfferImage::where('offer_id', $offer->id)->where('show_status', Offer::STATUS_DELETED)->get();
        foreach ($deletedImages as $deletedImage) {
            $imgPath = public_path($deletedImage->getStorePath().'/'.$deletedImage->image);
            if (file_exists($imgPath)) {
                unlink($imgPath);
            }
        }
        OfferImage::where('offer_id', $offer->id)->where('show_status', Offer::STATUS_DELETED)->delete();
    }

    public function delete($id)
    {
        Offer::where('id', $id)->delete();
        OfferMl::where('id', $id)->delete();
        OfferImage::where('offer_id', $id)->delete();
    }
}