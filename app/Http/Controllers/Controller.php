<?php

namespace App\Http\Controllers;

use App\Models\SettingWebsite;

abstract class Controller
{
    public function newsMeta()
    {
        $setting_web = SettingWebsite::first();
        $data = [
            'title' => "News | " . $setting_web->name,
            'meta_description' => strip_tags($setting_web->about),
            'meta_keywords' => 'News, MAN 1 Padang Panjang, Padang Panjang',
            'favicon' => $setting_web->favicon,
            'setting_web' => $setting_web,
        ];

        return $data;
    }

}
