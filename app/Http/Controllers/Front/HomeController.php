<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\News;
use App\Models\SettingBanner;
use App\Models\SettingWebsite;
use App\Models\Student;
use App\Models\Teacher;
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

            'list_banner' => SettingBanner::where('status', 1)->get(),
            'list_news' => News::latest()->where('status', 'published')->limit(6)->get(),
            'list_agenda' => Event::orderBy('start', 'desc')->limit(6)->get(),
            'list_teacher' => Teacher::where('type', 'tenaga pendidik')->inRandomOrder()->limit(7)->get(),

            'tenaga_pendidik_count' => Teacher::where('type', 'tenaga pendidik')->count(),
            'tenaga_kependidikan_count' => Teacher::where('type', 'tenaga kependidikan')->count(),
            'siswa_count' => Student::count(),
            'alumni_count' => "10",

        ];

        return view('front.pages.home.index', $data);
    }
}
