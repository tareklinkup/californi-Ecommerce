<?php

namespace App\Http\Controllers;

use App\Admin\Slider;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $featured_products = Product::withoutDeleted()
        // ->active()->featuredProducts()->latest()->take(6)->get();

        $recent_products = Product::withoutDeleted()
        ->active()->latest()->take(36)->get();

        $new_offer_products = Product::withoutDeleted()
        ->active()->newOfferProducts()->latest()->take(12)->get();

        $brands = Brand::withoutDeleted()->active()->get();

        $slider = Slider::all();

        $categories = Category::withoutDeleted()->active()->where('parent_id', 0)->get();

        return view('pages.home', compact(
            // 'featured_products', 
            'recent_products', 
            'new_offer_products', 
            'brands', 'slider', 'categories'
        ));
    }
}
