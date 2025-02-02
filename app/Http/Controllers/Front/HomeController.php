<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\BlogTeacher;
use App\Models\Event;
use App\Models\Extracurricular;
use App\Models\GalleryAlbum;
use App\Models\News;
use App\Models\Partner;
use App\Models\SekapurSirih;
use App\Models\SettingBanner;
use App\Models\SettingWebsite;
use App\Models\Student;
use App\Models\StudentAchievement;
use App\Models\Teacher;
use Dymantic\InstagramFeed\Profile;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $setting_web = SettingWebsite::first();

        $data = [
            'title' => "Home | " . $setting_web->name,
            'meta_description' => strip_tags($setting_web->about),
            'meta_keywords' => 'MAN 1 Padang Panjang, Padang Panjang, Sekolah, Madrasah Aliyah, Padang Panjang',
            'favicon' => $setting_web->favicon,
            'setting_web' => $setting_web,

            'list_banner' => SettingBanner::where('status', 1)->get(),
            'list_news' => News::latest()->where('status', 'published')->limit(6)->get(),
            'list_agenda' => Event::orderBy('start', 'desc')->where('is_active', 1)->limit(4)->get(),
            'list_pengumuman' => Announcement::latest()->where('is_active', 1)->limit(4)->get(),
            'sekapur_sirih' => SekapurSirih::first(),
            'list_extracurricular' => Extracurricular::all(),
            'list_student_achievement' => StudentAchievement::latest()->limit(6)->get(),
            'list_teacher' => Teacher::where('type', 'tenaga pendidik')->inRandomOrder()->limit(7)->get(),
            'list_blog_teacher' => BlogTeacher::where('status', 'published')->latest()->limit(8)->get(),
            'list_partner' => Partner::all(),
            'instagram_feed' => Profile::where('username', 'mansapapaofficial')->first()->freshFeed(12),
            'list_album' => GalleryAlbum::latest()->limit(12)->get(),

            'tenaga_pendidik_count' => Teacher::where('type', 'tenaga pendidik')->count(),
            'tenaga_kependidikan_count' => Teacher::where('type', 'tenaga kependidikan')->count(),
            'siswa_count' => Student::count(),
            'alumni_count' => "10",

        ];
        // return response()->json($data);
        // dd($data);
        return view('front.pages.home.index', $data);
    }

    public function sekapurSirih()
    {
        $setting_web = SettingWebsite::first();
        $sekapur_sirih = SekapurSirih::first();

        $data = [
            'title' => "Sekapur Sirih | " . $setting_web->name,
            'meta_description' => strip_tags($sekapur_sirih->content),
            'meta_keywords' => 'MAN 1 Padang Panjang, Padang Panjang, Sekolah, Madrasah Aliyah, Padang Panjang',
            'favicon' => $setting_web->favicon,
            'setting_web' => $setting_web,

            'sekapur_sirih' => $sekapur_sirih,
        ];

        return view('front.pages.home.sekapur_sirih', $data);
    }

    public function calendar()
    {
        $setting_web = SettingWebsite::first();

        $data = [
            'title' => 'Kalender Akademik | ' . $setting_web->name,
            'meta_description' => strip_tags($setting_web->about),
            'meta_keywords' => 'Kalender Akademik, MAN 1 Padang Panjang, Padang Panjang',
            'favicon' => $setting_web->favicon,
            'setting_web' => $setting_web,
        ];

        return view('front.pages.home.calendar', $data);

    }
}
