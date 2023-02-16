<?php

namespace App\Http\Controllers\Website;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function getCategories() {
        $categories = Category::withoutDeleted()->active()->where('parent_id', 0)->get();
        return view('pages.categories', compact('categories'));
    }
}
