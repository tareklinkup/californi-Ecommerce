<?php

namespace App\Http\Controllers\Admin;

use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    public function index() {
        $settings = Settings::first();
        return view('admin.setting.index', compact('settings'));
    }

    public function update(Request $request) {
        
        $request->validate([
            'logo' => 'nullable|image|mimes:png,jpg,jpeg', 
            'shop_name' => 'required', 
            'address' => 'required', 
            'vat' => 'required', 
            'phone_1' => 'required',
            'email_1' => 'required|email'
        ]);
        
        $settings = Settings::first();

        if ($request->hasFile('logo')) {
            if (isset($settings->logo) && file_exists($settings->logo)) {
                unlink($settings->logo);
            }

            $settings->logo = $this->imageUpload($request, 'logo', 'public/uploads/settings');
        }

        $settings->shop_name = $request->shop_name;
        $settings->address = $request->address;
        $settings->vat = $request->vat;
        $settings->shipping_charge = $request->shipping_charge;
        $settings->phone_1 = $request->phone_1;
        $settings->phone_2 = $request->phone_2;
        $settings->email_1 = $request->email_1;
        $settings->email_2 = $request->email_2;
        $settings->facebook = $request->facebook;
        $settings->twitter = $request->twitter;
        $settings->youtube = $request->youtube;
        $settings->vimeo = $request->vimeo;
        $settings->save();

        Session::flash('success', 'Settings successfully updated.');
        return redirect()->back();
    }

    public function banners()
    {
        $settings = Settings::first();
        return view('admin.banner.index', compact('settings'));
    }

    public function bannersUpdate(Request $request)
    {
        $request->validate([
            'banner_1' => 'nullable|image|mimes:png,jpg,jpeg',
            'banner_2' => 'nullable|image|mimes:png,jpg,jpeg',
            'banner_3' => 'nullable|image|mimes:png,jpg,jpeg',
            'banner_4' => 'nullable|image|mimes:png,jpg,jpeg'
        ]);

        $settings = Settings::first();

        if ($request->hasFile('banner_1')) {
            if (isset($settings->banner_1) && file_exists($settings->banner_1)) {
                unlink($settings->banner_1);
            }

            $settings->banner_1 = $this->imageUpload($request, 'banner_1', 'public/uploads/banners');
        }

        if ($request->hasFile('banner_2')) {
            if (isset($settings->banner_2) && file_exists($settings->banner_2)) {
                unlink($settings->banner_2);
            }

            $settings->banner_2 = $this->imageUpload($request, 'banner_2', 'public/uploads/banners');
        }

        if ($request->hasFile('banner_3')) {
            if (isset($settings->banner_3) && file_exists($settings->banner_3)) {
                unlink($settings->banner_3);
            }

            $settings->banner_3 = $this->imageUpload($request, 'banner_3', 'public/uploads/banners');
        }

        if ($request->hasFile('banner_4')) {
            if (isset($settings->banner_4) && file_exists($settings->banner_4)) {
                unlink($settings->banner_4);
            }

            $settings->banner_4 = $this->imageUpload($request, 'banner_4', 'public/uploads/banners');
        }

        $settings->save();

        return back()->with('success', 'Banners updated successfully');
    }
}
