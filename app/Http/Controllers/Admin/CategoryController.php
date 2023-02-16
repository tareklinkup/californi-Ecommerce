<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.index', [
            'categories' => Category::withoutDeleted()->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorys = Category::withoutDeleted()->latest()->get();
        return view('admin.category.create',compact('categorys'));
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
            'name' => 'required|unique:categories',
            'thumbnail_image' => 'required|image|max:5000|mimes:png,jpg,jpeg|dimensions:max_width=220,max_height=162',
            'status' => 'required|boolean'
        ]);
            
        try {
            Category::create([
                'name' => $request->name,
                'slug' => $this->getSlug($request->name),
                'parent_id' => $request->parent_id,
                'thumbnail' => $this->imageUpload($request, 'thumbnail_image', 'public/uploads/categories') ?? '',
                'status' => $request->status
            ]);
            $this->message('success', 'Category info successfully saved');
        } catch (\PDOException $e) {
            $this->message('error', $e->getMessage());
        }
        
        return redirect()->route('admin.category.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AdminModels\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categorys = Category::withoutDeleted()->latest()->get();
        return view('admin.category.edit', compact('category','categorys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AdminModels\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'thumbnail_image' => 'image|max:5000|mimes:png,jpg,jpeg|dimensions:max_width=220,max_height=162',
            'status' => 'required|boolean'
        ]);

        try {
            if ($request->hasFile('thumbnail_image')) {
                if (!empty($category->thumbnail) && file_exists($category->thumbnail)) {
                    unlink($category->thumbnail);
                }
                $category->update([
                    'name' => $request->name,
                    'slug' => $this->getSlug($request->name),
                    'parent_id' => $request->parent_id,
                    'thumbnail' => $this->imageUpload($request, 'thumbnail_image', 'public/uploads/categories') ?? '',
                    'status' => $request->status
                ]);
            }
            else {
                $category->update([
                    'name' => $request->name,
                    'slug' => $this->getSlug($request->name),
                    'parent_id' => $request->parent_id,
                    'status' => $request->status
                ]);
            }
            $this->message('success', 'Category info successfully updated');
        } catch (\PDOException $e) {
            $this->message('error', $e->getMessage());
        }
        
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AdminModels\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            $category->update([
                'is_deleted' => 1
            ]);
            $this->message('success', 'Category info successfully deleted');
        } catch (\PDOException $e) {
            $this->message('error', $e->getMessage());
        }
        
        return redirect()->route('admin.category.index');
    }
}
