<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Faker\Generator as Faker;
use App\Http\Controllers\Controller;

$factory->define(Product::class, function (Faker $faker) {
    $brand = Brand::pluck('id')->toArray();
    $category = Category::pluck('id')->toArray();
    $name = $faker->name;
    return [
        'brand_id' => rand($brand[0], count($brand) - 1),
        'category_id' => rand($category[0], count($category) - 1),
        'name' => $name,
        'slug' => (new Controller)->getSlug($name),
        'thumbnail' => 'public/uploads/products\images2_15808125495e39490524830.jfif',
        'product_code' => 'P' . rand(1000, 2000),
        'quantity' => rand(5, 20),
        'price' => rand(200, 5000),
        'description' => $faker->paragraph(rand(4, 7)),
        'is_featured' => rand(0, 1)
    ];
});
