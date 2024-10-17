<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\SettingWebsite;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $setting_web = SettingWebsite::first();

        $data = [
            'title' => "Home | " . $setting_web->name,
            'meta_description' => strip_tags($setting_web->about),
            'meta_keywords' => 'Home, Muhammadiyah, Bukittinggi',
            'favicon' => $setting_web->favicon,
            'setting_web' => $setting_web,

        ];

        return view('front.pages.home.index', $data);
    }
}
