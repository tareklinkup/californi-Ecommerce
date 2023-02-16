<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Settings;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Website\CartController;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $brands = Brand::withoutDeleted()->active()->take(5)->get();
        $categories = Category::with('children')->withoutDeleted()->active()->take(5)->get();
        $total_cart_item = (new CartController)->cartTotalQuantity();
        $total_price = (new CartController)->getSubTotal();
        View::share('_brands', $brands);
        View::share('_categories', $categories);
        View::share('_total_cart_item', $total_cart_item);
        View::share('_total_price', $total_price);

        $newOrder = (new OrderController)->newOrderCount();
        View::share('_new_order_count', $newOrder);

        $settings = Settings::first();
        View::share('_settings', $settings);

        $shop_short_name = (new Controller)->wordsFirst($settings->shop_name ?? 'Fantasy Khelaghor');
        View::share('_shop_short_name', $shop_short_name);
    }
}
