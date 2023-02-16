<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getSlug($string)
    {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
    }

    public function imageUpload($request, $name, $destination)
    {
        if ($request->hasFile($name)) {
            $thumbnail_image = $request->file($name);
            $original_name_split = explode('.', $thumbnail_image->getClientOriginalName());
            $generated_name  = $original_name_split[0].'_'.time().uniqid();
            $thumbnail_name = $generated_name.'.'.$thumbnail_image->getClientOriginalExtension();
            $_thubnail_path = $thumbnail_image->move($destination, $thumbnail_name);
            $thubnail_path = str_replace('\\', '/', $_thubnail_path);
            return $thubnail_path ?? false;
        }
    }

    public function message($type, $message)
    {
        if ('success' == $type) {
            $_message = '<div class="alert alert-success mb-3">' . $message . '</div>';
        } elseif ('error' == $type) {
            $_message = '<div class="alert alert-danger mb-3">' . $message . '</div>';
        }
        Session::flash('message', $_message);
    }

    public function wordsFirst($string) {
        $parts = explode(' ', strtoupper($string));
        $output = '';
        foreach ($parts as $key => $part) {
            $output .= $part[0];
        }
        return $output;
    }
}
