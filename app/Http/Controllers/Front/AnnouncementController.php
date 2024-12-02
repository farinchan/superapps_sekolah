<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\SettingWebsite;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $setting_web = SettingWebsite::first();

        $data = [
            'title' => 'Pengumuman | ' . $setting_web->name,
            'meta_description' => strip_tags($setting_web->about),
            'meta_keywords' => 'Pengumuman, MAN 1 Padang Panjang, Padang Panjang',
            'favicon' => $setting_web->favicon,
            'setting_web' => $setting_web,

            'list_announcement' => Announcement::orderBy('start', 'desc')->paginate(12),
        ];

        return redirect()->back();
        return view('front.pages.announcement.index', $data);
    }

    public function show($slug)
    {
        $setting_web = SettingWebsite::first();
        $announcement = Announcement::where('slug', $slug)->first();
        $data = [
            'title' => $announcement->title . ' | ' . $setting_web->name,
            'meta_description' => strip_tags($announcement->content),
            'meta_keywords' => $announcement->title . ', Pengumuman, MAN 1 Padang Panjang, Padang Panjang',
            'favicon' => $setting_web->favicon,
            'setting_web' => $setting_web,

            'announcement' => $announcement,
        ];

        return view('front.pages.announcement.show', $data);
    }
}
