<?php

namespace App\Http\Controllers;

use App\Models\Offer\Offer;
use App\Models\Offer\OfferText;
use App\Models\Slider\Slider;

class OfferController extends Controller
{
    public function all()
    {
        $offerText = OfferText::current()->first();
        $offers = Offer::joinMl()->ordered()->get();
        $facilities = Slider::join('facilities_ml as facility', function($query) {
            $query->on('facility.id', '=', 'slider.facility_id')->where('facility.lng_id', cLng('id'));
        })->where('slider.key', Slider::KEY_OFFERS)->orderBy('slider.sort_order', 'asc');

        return view('offer.all')->with([
            'offerText' => $offerText,
            'offers' => $offers,
            'facilities' => $facilities
        ]);
    }
}