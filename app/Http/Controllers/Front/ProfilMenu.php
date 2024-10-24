<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\MenuProfil;
use App\Models\SettingWebsite;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsCategory;


class ProfilMenu extends Controller
{
    public function index($slug)
    {
        $setting_web = SettingWebsite::first();
        $profil = MenuProfil::where('slug', $slug)->first();

        $data = [
            'title' => $profil->name . " | " . $setting_web->name,
            'meta_description' => strip_tags($profil->content),
            'meta_keywords' => 'profil, ' . $profil->name . 'man 1 padang panjang, padang panjang',
            'favicon' => $setting_web->favicon,
            'setting_web' => $setting_web,

            'profil' => $profil,
        ];

        return view('front.pages.profil.index', $data);
    }
}
