<?php

namespace App\Http\Controllers\Website;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function getBrands() {
        $brands = Brand::withoutDeleted()->active()->get();
        return view('pages.brands', compact('brands'));
    }
}
