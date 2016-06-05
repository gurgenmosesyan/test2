<?php

namespace App\Http\Controllers;

use App\Models\Homepage\Homepage;
use App\Models\Homepage\HomepageMl;
use App\Models\Accommodation\Accommodation;

class IndexController extends Controller
{
    public function index()
    {
        $homepage = Homepage::first();
        $homepageMl = HomepageMl::where('lng_id', cLng('id'))->first();
        $accommodations = Accommodation::joinMl()->ordered()->with('images')->get();

        return view('index.index')->with([
            'homepage' => $homepage,
            'homepageMl' => $homepageMl,
            'accommodations' => $accommodations
        ]);
    }
}