<?php

namespace App\Http\Controllers;

use App\Models\Accommodation\Accommodation;

class AccommodationController extends Controller
{
    public function index($lngCode, $id)
    {
        $accommodation = Accommodation::joinMl()->where('accommodations.id', $id)->firstOrFail();
        $facilities = $accommodation->facilities()->current()->get();
        $accommodations = Accommodation::joinMl()->where('accommodations.id', '!=', $id)->ordered()->with('images')->get();

        return view('accommodation.index', [
            'accommodation' => $accommodation,
            'facilities' => $facilities,
            'accommodations' => $accommodations
        ]);
    }
}