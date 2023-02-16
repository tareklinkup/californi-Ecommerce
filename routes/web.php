<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');

Route::namespace('Website')->group(function() {

    Route::get('/categories', 'CategoryController@getCategories')->name('categories');
    Route::get('/brands', 'BrandController@getBrands')->name('brands');
    Route::get('/product/{slug}', 'ProductController@getProduct')->name('product');
    Route::get('/brand/{slug}', 'ProductController@getProductsByBrand')->name('brand.products');
    Route::get('/category/{slug}', 'ProductController@getProductsByCategory')->name('category.products');
    Route::get('/products', 'ProductController@getProducts')->name('products');
    Route::get('/products/{q}/suggestion', 'ProductController@suggestion')->name('products.suggestion');
    Route::get('/products/search', 'ProductController@search')->name('products.search');

    Route::get('/products/featured-items', 'ProductController@featuredItems')->name('featured.items');
    Route::get('/products/recent-items', 'ProductController@recentItems')->name('recent.items');
    Route::get('/products/new-offer-items', 'ProductController@newOfferItems')->name('new.offer.items');

    Route::get('/cart', 'CartController@index')->name('cart');
    Route::post('/cart/add', 'CartController@addNewItem')->name('cart.add');
    Route::get('/cart/{id}/{quantity}/update', 'CartController@updateQuantity')->name('quantity.update');
    Route::get('/cart/{id}/remove', 'CartController@itemRemoveFromCart')->name('cart.item.remove');

    // message route 18-2-2021 (author:azhar)
    Route::get('/message','ContactUsController@getMessage')->name('message');
    Route::post('/message','ContactUsController@messageStore')->name('message.store');

    Route::middleware(['verified', 'auth'])->group(function() {
        Route::get('/checkout', 'CheckoutController@index')->name('checkout');
        Route::post('/checkout/confirm', 'CheckoutController@orderConfirm')->name('order.confirm.process');
        Route::get('/checkout/success', 'CheckoutController@checkoutSuccess')->name('order.success');
        Route::get('/orders', 'CheckoutController@orders')->name('orders');
        Route::get('/order/{order_number}', 'CheckoutController@order')->name('order');
        Route::get('/order/{order_number}/cancel', 'CheckoutController@orderCancel')->name('order.cancel');

        Route::get('/profile', 'UserController@profile')->name('profile');
        Route::post('/profile/update', 'UserController@update')->name('profile.update');
    });

    Route::get('/about-us', 'AboutUsController@index')->name('about.us');
    Route::get('/contact-us', 'ContactUsController@index')->name('contact.us');
    Route::post('/contact-us/message', 'ContactUsController@sendMessage')->name('contact.us.message');
});

Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function() {

    Route::get('/', 'AdminController@showAdminLoginForm')->name('login');
    Route::post('/login', 'AdminController@adminLogin')->name('login.process');

    Route::middleware('admin')->group(function() {
        Route::post('/logout', 'AdminController@adminLogout')->name('logout');
        Route::get('/profile', 'AdminController@profile')->name('profile');
        Route::post('/profile/update', 'AdminController@update')->name('profile.update');

        Route::get('/dashboard', 'AdminController@showDashboard')->name('dashboard');
        Route::resource('/brand', 'BrandController')->except('show');
        Route::resource('/category', 'CategoryController')->except('show');
        Route::resource('/product', 'ProductController');
        Route::get('/image/{id}/delete', 'ProductController@imageDelete')->name('product.image.delete');

        Route::get('/orders', 'OrderController@index')->name('orders');
        Route::get('/order/{id}/show', 'OrderController@show')->name('order.show');
        Route::post('/order/cancel', 'OrderController@destroy')->name('order.destroy');
        Route::get('/order/{id}/processing', 'OrderController@processing')->name('order.processing');
        Route::get('/order/{id}/delivered', 'OrderController@delivered')->name('order.delivered');
        Route::get('/order/{id}/invoice', 'OrderController@invoice')->name('order.invoice');

        Route::get('/about-us', 'AboutUsController@index')->name('about.us');
        Route::get('/about-us/create', 'AboutUsController@create')->name('about.us.create');
        Route::post('/about-us/store', 'AboutUsController@store')->name('about.us.store');
        Route::get('/about-us/{id}/edit', 'AboutUsController@edit')->name('about.us.edit');
        Route::post('/about-us/update', 'AboutUsController@update')->name('about.us.update');
        Route::delete('/about-us/delete', 'AboutUsController@destroy')->name('about.us.delete');

        Route::get('/sliders', 'SliderController@index')->name('sliders');
        Route::get('/slider/image/add', 'SliderController@create')->name('slider.create');
        Route::post('/slider/image/store', 'SliderController@store')->name('slider.store');
        Route::get('/slider/image/{id}/edit', 'SliderController@edit')->name('slider.edit');
        Route::post('/slider/image/update', 'SliderController@update')->name('slider.update');
        Route::delete('slider/image/delete', 'SliderController@destroy')->name('slider.delete');

        Route::get('/settings', 'SettingController@index')->name('settings');
        Route::post('/settings/update', 'SettingController@update')->name('settings.update');

        Route::get('/banners', 'SettingController@banners')->name('banners');
        Route::post('/banners/update', 'SettingController@bannersUpdate')->name('banners.update');

        Route::get('/customers', 'AdminController@customers')->name('customer.list');

        // get all message
        Route::get('/message-list', 'AdminController@getAllMessage')->name('message.list');
        Route::delete('/message-destroy/{message}', 'AdminController@destroyMessage')->name('message.destroy');
    });
});