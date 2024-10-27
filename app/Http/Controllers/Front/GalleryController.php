<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryAlbum;
use App\Models\SettingWebsite;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $setting_web = SettingWebsite::first();
        return abort(404);
        $data = [
            'title' => 'Gallery | ' . $setting_web->name,
            'meta_description' => strip_tags($setting_web->about),
            'meta_keywords' => 'MAN 1 Padang Panjang, Padang Panjang, Sekolah, Madrasah Aliyah, Padang Panjang, Gallery, Album, foto, video',
            'favicon' => $setting_web->favicon,
            'setting_web' => $setting_web,

            'list_gallery_album' => GalleryAlbum::latest()->get(),
        ];

        return view('front.pages.gallery.index', $data);
    }

    public function show($slug)
    {
        $setting_web = SettingWebsite::first();
        $gallery_album = GalleryAlbum::where('slug', $slug)->first();
        $data = [
            'title' => $gallery_album->title . ' | Gallery | ' . $setting_web->name,
            'meta_description' => $gallery_album->description,
            'meta_keywords' => 'MAN 1 Padang Panjang, Padang Panjang, Sekolah, Madrasah Aliyah, Padang Panjang, Gallery, Album, foto, video, ' . $gallery_album->title,
            'favicon' => $setting_web->favicon,
            'setting_web' => $setting_web,

            'gallery_album' => $gallery_album,
            'list_gallery' => $gallery_album->gallery()->latest()->get(),
        ];

        return view('front.pages.gallery.show', $data);
    }
}
