<?php

namespace App\Http\Controllers\Website;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function getProduct($slug) {
        $product = Product::where('slug', $slug)->with('images')->first();
        $same_category_products = $product->category->products->where('id', '!=', $product->id);
        return view('pages.product', compact('product', 'same_category_products'));
    }

    public function getProducts() {
        $mode = 'category';
        $products = Product::withoutDeleted()->active()->latest()->paginate(48);
        $categories = Category::withoutDeleted()->active()->where('parent_id', 0)->get();
        $slug = '';
        return view('pages.products', compact('products', 'categories', 'mode', 'slug'));
    }

    public function getProductsByCategory($slug) {
        $mode = 'category';
        $category = Category::where('slug', $slug)->first();
        $products = $category->products()->withoutDeleted()->active()->paginate(45);
        $categories = Category::withoutDeleted()->active()->where('parent_id', 0)->get();
        return view('pages.products', compact('products', 'categories', 'mode', 'slug'));
    }

    public function getProductsByBrand($slug) {
        $mode = 'brand';
        $brand = Brand::where('slug', $slug)->first();
        $products = $brand->products()->paginate(45);
        $brands = Brand::withoutDeleted()->active()->get();
        return view('pages.products', compact('products', 'brands', 'mode', 'slug'));
    }

    public function featuredItems()
    {
        $mode = 'category';
        $products = Product::withoutDeleted()->active()->featuredProducts()->latest()->paginate(45);
        $categories = Category::withoutDeleted()->active()->where('parent_id', 0)->get();
        $slug = '';
        return view('pages.products', compact('products', 'categories', 'mode', 'slug'));
    }

    public function recentItems()
    {
        $mode = 'category';
        $products = Product::withoutDeleted()->active()->recentProducts()->latest()->paginate(48);
        $categories = Category::withoutDeleted()->active()->where('parent_id', 0)->get();
        $slug = '';
        return view('pages.products', compact('products', 'categories', 'mode', 'slug'));
    }

    public function newOfferItems()
    {
        $mode = 'category';
        $products = Product::withoutDeleted()->active()->newOfferProducts()->latest()->paginate(48);
        $categories = Category::withoutDeleted()->active()->where('parent_id', 0)->get();
        $slug = '';
        return view('pages.products', compact('products', 'categories', 'mode', 'slug'));
    }

    public function suggestion($q) {
        if (request()->ajax()) {
            return Product::withoutDeleted()->active()
            ->where('product_code', 'LIKE', "%$q%")
            ->orWhere('name', 'LIKE', "%$q%")
            ->get();
        }
        abort(403);
    }

    public function search() {
        if (!empty(request()->input('q'))) {
            $q = request()->input('q');
            $mode = 'category';
            $products = Product::withoutDeleted()->active()
                            ->where('product_code', 'LIKE', "%$q%")
                            ->orWhere('name', 'LIKE', "%$q%")
                            ->orWhere('price', 'LIKE', "%$q%")
                            ->orWhere('description', 'LIKE', "%$q%")
                            ->latest()->paginate(6);
            $categories = Category::withoutDeleted()->active()->where('parent_id', 0)->get();
            $slug = '';
            return view('pages.products', compact('products', 'categories', 'mode', 'slug'));
        }
        return back();
    }

}
