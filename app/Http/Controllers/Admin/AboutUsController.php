<?php

namespace App\Http\Controllers\Admin;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutUsController extends Controller
{
    public function index() {
        $about_us = AboutUs::all();
        return view('admin.about-us.index', compact('about_us'));
    }

    public function create() {
        return view('admin.about-us.create');
    }

    public function store(Request $request) {
        $request->validate([
            'heading' => 'required',
            'banner' => 'image|mimes:png,jpg,jpeg',
            'description' => 'required',
            'is_column' => 'required'
        ]);

        try {
            AboutUs::create([
                'heading' => $request->heading,
                'description' => $request->description,
                'banner' => $this->imageUpload($request, 'banner', 'public/uploads/about-us') ?? '',
                'is_column' => $request->is_column
            ]);
            $this->message('success', 'About us info successfully saved');
        } catch (\PDOException $e) {
            $this->message('error', $e->getMessage());
        }
        
        return redirect()->route('admin.about.us');
    }

    public function edit($id) {
        $about = AboutUs::findOrFail($id);
        return view('admin.about-us.edit', compact('about'));
    }

    public function update(Request $request) {
        $request->validate([
            'id' => 'required|integer',
            'heading' => 'required',
            'banner' => 'image|mimes:png,jpg,jpeg',
            'description' => 'required',
            'is_column' => 'required'
        ]);

        try {
            $about = AboutUs::findOrFail($request->id);
            $about->heading = $request->heading;
            $about->description = $request->description;
            if ($request->hasFile('banner')) {
                if (isset($about->banner) && file_exists($about->banner)) {
                    unlink($about->banner);
                }
                $about->banner = $this->imageUpload($request, 'banner', 'public/uploads/about-us') ?? '';
            }
            $about->is_column = $request->is_column;
            $about->save();

            $this->message('success', 'About us info successfully saved');
        } catch (\PDOException $e) {
            $this->message('error', $e->getMessage());
        }
        
        return redirect()->route('admin.about.us');
    }

    public function destroy(Request $request)
    {
        try {
            $about = AboutUs::findOrFail($request->id);
            if (isset($about->banner) && file_exists($about->banner)) {
                unlink($about->banner);
            }
            $about->delete();
            $this->message('success', 'About us info successfully deleted');
        } catch (\PDOException $e) {
            $this->message('error', $e->getMessage());
        }
        
        return redirect()->route('admin.about.us');
    }

}
