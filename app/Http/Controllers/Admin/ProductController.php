<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProduct;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProduct;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product.index', [
            'products' => Product::withoutDeleted()->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create', [
            'brands' => Brand::withoutDeleted()->get(),
            'categories' => Category::withoutDeleted()->get(),
            'new_product_code' => $this->generateNewProductCode()
        ]);
    }

    private function generateNewProductCode() {
        $oldCodes = Product::pluck('product_code');
        if (count(array_filter((array) $oldCodes)) > 0) {
            if ($oldCodes->max()) {
                $oldMaxCode = preg_replace('/[A-Z]+/', '', $oldCodes->max());
                $prefix = preg_replace('/[0-9]+/', '', $oldCodes->max());
                $newCode = $prefix . ($oldMaxCode + 1);
            } else {
                $newCode = 'P1001';
            }
        } else {
            $newCode = 'P1001';
        }
        return $newCode;
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
            'brand' => 'required|numeric',
            'category' => 'required|numeric',
            'name' => 'required|unique:products',
            'thumbnail_image' => 'required|image|mimes:png,jpg,jpeg|dimensions:max_width=220,max_height=162',
            'image.*' => 'image|mimes:png,jpg,jpeg|dimensions:width=220,height=162',
            'price' => 'required',
            // 'featured' => 'required|boolean',
            'status' => 'required|boolean',
            'description' => 'required'
        ]);

        if ($this->discountValueCheck($request)) {
            return redirect()->back()->withInput();
        }
        
        try {
            $product = Product::create([
                'product_code' => $this->generateNewProductCode(),
                'brand_id' => $request->brand,
                'category_id' => $request->category,
                'name' => $request->name,
                'slug' => $this->getSlug($request->name),
                'thumbnail' => $this->imageUpload($request, 'thumbnail_image', 'public/uploads/products') ?? '',
                'quantity' => $request->quantity,
                'price' => $request->price,
                'discount_percent' => $request->discount_percent,
                'discount_amount' => $request->discount_amount,
                'description' => $request->description
            ]);

            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $image) {
                    $imgName = time().uniqid().'.'.$image->getClientOriginalExtension();
                    $imageUrl = $image->move('public/uploads/products', $imgName);
                    if ($imageUrl) {
                        $proImage = new ProductImage;
                        $proImage->product_id = $product->id;
                        $proImage->image = $imageUrl;
                        $proImage->save();
                    }
                }
            }

            $this->message('success', 'Product info successfully saved');
        } catch (PDOException $e) {
            $this->message('error', $e->getMessage());
        }

        return redirect()->route('admin.product.index');
    }

    private function discountValueCheck($request) {
        if ($request->filled('discount_amount') && $request->filled('discount_percent')) {
            session()->flash('discount_error', 'Only discount amount or discount percent applicable.');
            return true;
        }
        return false;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $brands = Brand::withoutDeleted()->get();
        $categories = Category::withoutDeleted()->get();
        return view('admin.product.edit', compact('brands','categories','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'brand' => 'required|numeric',
            'category' => 'required|numeric',
            'name' => 'required',
            'thumbnail_image' => 'image|mimes:png,jpg,jpeg|dimensions:max_width=220,max_height=162',
            'image.*' => 'image|mimes:png,jpg,jpeg|dimensions:width=220,height=162',
            'price' => 'required',
            // 'featured' => 'required|boolean',
            'status' => 'required|boolean',
            'description' => 'required'
        ]);

        if ($this->discountValueCheck($request)) {
            return redirect()->back()->withInput();
        }

        try {
            if ($request->hasFile('thumbnail_image')) {
                if (file_exists($product->thumbnail)) {
                    unlink($product->thumbnail);
                }
                $product->update([
                    'brand_id' => $request->brand,
                    'category_id' => $request->category,
                    'name' => $request->name,
                    'slug' => $this->getSlug($request->name),
                    'thumbnail' => $this->imageUpload($request, 'thumbnail_image', 'public/uploads/products') ?? '',
                    'product_code' => $request->product_code,
                    'quantity' => $request->quantity,
                    'price' => $request->price,
                    'discount_percent' => $request->discount_percent,
                    'discount_amount' => $request->discount_amount,
                    'description' => $request->description,
                    // 'is_featured' => $request->featured,
                    'status' => $request->status
                ]);
            } else {
                $product->update([
                    'brand_id' => $request->brand,
                    'category_id' => $request->category,
                    'name' => $request->name,
                    'slug' => $this->getSlug($request->name),
                    'product_code' => $request->product_code,
                    'quantity' => $request->quantity,
                    'price' => $request->price,
                    'discount_percent' => $request->discount_percent,
                    'discount_amount' => $request->discount_amount,
                    'description' => $request->description,
                    // 'is_featured' => $request->featured,
                    'status' => $request->status
                ]);
            }

            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $image) {
                    $imgName = time().uniqid().'.'.$image->getClientOriginalExtension();
                    $imageUrl = $image->move('public/uploads/products', $imgName);
                    if ($imageUrl) {
                        $proImage = new ProductImage;
                        $proImage->product_id = $product->id;
                        $proImage->image = $imageUrl;
                        $proImage->save();
                    }
                }
            }

            $this->message('success', 'Product info successfully updated');
        } catch (PDOException $e) {
            $this->message('error', $e->getMessage());
        }

        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            $product->update([
                'is_deleted' => 1
            ]);
            $this->message('success', 'Product info successfully deleted');
        } catch (\PDOException $e) {
            $this->message('error', $e->getMessage());
        }
        
        return redirect()->route('admin.product.index');
    }

    public function imageDelete($id) {
        if (request()->ajax() && !empty($id)) {
            $proImage = ProductImage::findOrFail($id);
            if (file_exists($proImage->image)) {
                unlink($proImage->image);
            }
            $proImage->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}
