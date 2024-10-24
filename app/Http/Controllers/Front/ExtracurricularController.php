<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Extracurricular;
use App\Models\SettingWebsite;
use Illuminate\Http\Request;

class ExtracurricularController extends Controller
{
    public function show($slug){
        $setting_web = SettingWebsite::first();
        $extracurricular = Extracurricular::where('slug', $slug)->first();

        $data = [
            'title' => $extracurricular->name . ' | Ekstrakurikuler | ' . $setting_web->name,
            'meta_description' => strip_tags($extracurricular->description),
            'meta_keywords' => "Ekstrakurikuler, " . $extracurricular->name . "MAN 1 Padang Panjang, Padang Panjang",
            'favicon' => $setting_web->favicon,
            'setting_web' => $setting_web,

            'extracurricular' => $extracurricular,

        ];

        return view('front.pages.extracurricular.show', $data);
    }
}
