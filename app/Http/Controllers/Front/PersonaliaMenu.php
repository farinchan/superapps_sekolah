<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\MenuPersonalia;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\SettingWebsite;
use App\Models\Teacher;
use Illuminate\Http\Request;

class PersonaliaMenu extends Controller
{
    public function teacher(Request $request)
    {
        $search = $request->q;
        $setting_web = SettingWebsite::first();

        $data = [
            'title' => "Tenaga pendidik | " . $setting_web->name,
            'meta_description' => strip_tags($setting_web->about),
            'meta_keywords' => 'Teacher, Tenaga Pendidik, Tenaga Kependidikan, MAN 1 Padang Panjang, Padang Panjang',
            'favicon' => $setting_web->favicon,
            'setting_web' => $setting_web,
            'list_teacher' => Teacher::where('type', 'tenaga pendidik')
                ->orderBy('name', 'asc')
                ->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })->paginate(12),
        ];


        return view('front.pages.personalia.teacher', $data);
    }


    public function staff(Request $request)
    {
        $search = $request->q;
        $setting_web = SettingWebsite::first();

        $data = [
            'title' => "Tenaga Kependidikan | " . $setting_web->name,
            'meta_description' => strip_tags($setting_web->about),
            'meta_keywords' => 'Teacher, Tenaga Pendidik, Tenaga Kependidikan, MAN 1 Padang Panjang, Padang Panjang',
            'favicon' => $setting_web->favicon,
            'setting_web' => $setting_web,

            'list_teacher' => Teacher::where('type', 'tenaga kependidikan')
                ->orderBy('name', 'asc')
                ->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })->paginate(12),
        ];

        return view('front.pages.personalia.teacher', $data);
    }

    public function staffDetail($id)
    {
        $teacher = Teacher::findOrfail($id);
        $setting_web = SettingWebsite::first();

        $data = [
            'title' => "Detail Staff | " . $setting_web->name,
            'meta_description' => strip_tags($setting_web->about),
            'meta_keywords' => $teacher->meta_keywords,
            'favicon' => $setting_web->favicon,
            'setting_web' => $setting_web,

            'teacher' => $teacher,
        ];

        return view('front.pages.personalia.teacher-detail', $data);
    }

    public function personalia($slug)
    {
        $setting_web = SettingWebsite::first();
        $personalia = MenuPersonalia::where('slug', $slug)->first();

        $data = [
            'title' => $personalia->name . " | " . $setting_web->name,
            'meta_description' => strip_tags($personalia->content),
            'meta_keywords' => 'Personalia, ' . $personalia->name . 'man 1 padang panjang, padang panjang',
            'favicon' => $setting_web->favicon,
            'setting_web' => $setting_web,

            'personalia' => $personalia,
        ];

        return view('front.pages.personalia.personalia', $data);
    }

}
