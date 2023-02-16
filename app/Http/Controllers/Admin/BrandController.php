<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.brand.index', [
            'brands' => Brand::withoutDeleted()->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:brands',
            'thumbnail_image' => 'required|image|max:5000|mimes:png,jpg,jpeg|dimensions:max_width=220,max_height=162',
            'status' => 'required|boolean'
        ]);
            
        try {
            Brand::create([
                'name' => $request->name,
                'slug' => $this->getSlug($request->name),
                'thumbnail' => $this->imageUpload($request, 'thumbnail_image', 'public/uploads/brands') ?? '',
                'status' => $request->status
            ]);
            $this->message('success', 'Brand info successfully saved');
        } catch (\PDOException $e) {
            $this->message('error', $e->getMessage());
        }
        
        return redirect()->route('admin.brand.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AdminModels\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AdminModels\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required',
            'thumbnail_image' => 'image|max:5000|mimes:png,jpg,jpeg|dimensions:max_width=220,max_height=162',
            'status' => 'required|boolean'
        ]);

        try {
            if ($request->hasFile('thumbnail_image')) {
                if (!empty($brand->thumbnail) && file_exists($brand->thumbnail)) {
                    unlink($brand->thumbnail);
                }
                $brand->update([
                    'name' => $request->name,
                    'slug' => $this->getSlug($request->name),
                    'thumbnail' => $this->imageUpload($request, 'thumbnail_image', 'public/uploads/brands') ?? '',
                    'status' => $request->status
                ]);
            }
            else {
                $brand->update([
                    'name' => $request->name,
                    'slug' => $this->getSlug($request->name),
                    'status' => $request->status
                ]);
            }
            $this->message('success', 'Brand info successfully updated');
        } catch (\PDOException $e) {
            $this->message('error', $e->getMessage());
        }
        
        return redirect()->route('admin.brand.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AdminModels\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        try {
            $brand->update([
                'is_deleted' => 1
            ]);
            $this->message('success', 'Brand info successfully deleted');
        } catch (\PDOException $e) {
            $this->message('error', $e->getMessage());
        }
        
        return redirect()->route('admin.brand.index');
    }
}
