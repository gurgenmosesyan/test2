<?php

namespace App\Http\Controllers;

class IndexController extends Controller
{
    public function about()
    {
        return view('index.index')->with([

        ]);
    }

    public function contact()
    {
        $slider = Slider::where('category', 'contact')->get();
        $text = TextMl::where('id', 4)->current()->first();
        return view('index.contact')->with([
            'slider' => $slider,
            'text' => $text
        ]);
    }
}