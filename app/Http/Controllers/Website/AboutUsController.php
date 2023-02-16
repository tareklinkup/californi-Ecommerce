<?php

namespace App\Http\Controllers\Website;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutUsController extends Controller
{
    public function index() {
        $about_us = AboutUs::orderBy('is_column', 'asc')->get();
        return view('pages.about_us', compact('about_us'));
    }
}
