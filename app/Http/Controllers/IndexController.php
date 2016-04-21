<?php

namespace App\Http\Controllers;

use App\Models\Slider\Slider;
use App\Models\Text\TextMl;
use App\Models\Category\CategoryMl;
use App\Models\Product\ProductMl;
use App\Models\Partner\PartnerMl;

class IndexController extends Controller
{
    public function about()
    {
        $slider = Slider::where('category', 'about')->get();
        $text = TextMl::where('id', 1)->current()->first();
        return view('index.about')->with([
            'slider' => $slider,
            'text' => $text
        ]);
    }

    public function products()
    {
        $slider = Slider::where('category', 'products')->get();
        $text = TextMl::where('id', 2)->current()->first();
        $categories = CategoryMl::current()->get();
        if ($categories->isEmpty()) {
            $products = collect();
            $categoryId = 0;
        } else {
            $firstCat = $categories[0];
            $products = ProductMl::current()->where('category_id', $firstCat->id)->get();
            $categoryId = $firstCat->id;
        }

        return view('index.products')->with([
            'slider' => $slider,
            'text' => $text,
            'categories' => $categories,
            'products' => $products,
            'categoryId' => $categoryId
        ]);
    }

    public function productsCategory($alias)
    {
        $category = CategoryMl::current()->where('alias', $alias)->firstOrFail();
        $slider = Slider::where('category', 'products')->get();
        $text = TextMl::where('id', 2)->current()->first();
        $categories = CategoryMl::current()->get();
        $products = ProductMl::current()->where('category_id', $category->id)->get();

        return view('index.products')->with([
            'slider' => $slider,
            'text' => $text,
            'categories' => $categories,
            'products' => $products,
            'categoryId' => $category->id
        ]);
    }

    public function partners()
    {
        $slider = Slider::where('category', 'partners')->get();
        $partners = PartnerMl::current()->get();
        $text = TextMl::where('id', 3)->current()->first();
        return view('index.partners')->with([
            'slider' => $slider,
            'text' => $text,
            'partners' => $partners
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