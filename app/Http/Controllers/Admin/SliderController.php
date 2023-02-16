<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    public function index() {
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function create() {
        return view('admin.slider.create');
    }

    public function store(Request $request) {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|dimensions:width=1280,height=500'
        ]);

        $slider = new Slider;

        $imageUpload = $this->imageUpload($request, 'image', 'public/uploads/slider');

        if (isset($imageUpload)) {
            $slider->image = $imageUpload;
        } else {
            return redirect()->back();
        }

        $slider->heading = $request->heading;
        $slider->save();

        $this->message('success', 'Slider image added');
        return redirect()->route('admin.sliders');
    }

    public function edit($id) {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(Request $request) {
        // return getimagesize($_FILES['image']['tmp_name']);
        $request->validate([
            'image' => 'nullable|image|mimes:png,jpg,jpeg|dimensions:width=1280,height=500'
        ]);

        $slider = Slider::findOrFail($request->id);
        
        if ($request->hasFile('image')) {
            if (isset($slider->image) && file_exists($slider->image)) {
                unlink($slider->image);
            }
            $slider->image = $this->imageUpload($request, 'image', 'public/uploads/slider');
        }

        $slider->heading = $request->heading;
        $slider->save();

        $this->message('success', 'Slider image updated');
        return redirect()->route('admin.sliders');
    }

    public function destroy(Request $request) {
        try {
            $slider = Slider::findOrFail($request->id);
            if (isset($slider->image) && file_exists($slider->image)) {
                unlink($slider->image);
            }
            $slider->delete();
            $this->message('success', 'Slider image successfully deleted');
        } catch (\PDOException $e) {
            $this->message('error', $e->getMessage());
        }
        
        return redirect()->route('admin.sliders');
    }
}
