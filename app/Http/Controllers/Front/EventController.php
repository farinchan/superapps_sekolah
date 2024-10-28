<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\SettingWebsite;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $setting_web = SettingWebsite::first();

        $data = [
            'title' => 'Agenda | ' . $setting_web->name,
            'meta_description' => strip_tags($setting_web->about),
            'meta_keywords' => 'Agenda, MAN 1 Padang Panjang, Padang Panjang',
            'favicon' => $setting_web->favicon,
            'setting_web' => $setting_web,

            'list_event' => Event::orderBy('start', 'desc')->paginate(12),
        ];

        return view('front.pages.event.index', $data);
    }

    public function show($slug)
    {
        $setting_web = SettingWebsite::first();
        $event = Event::where('slug', $slug)->first();
        $data = [
            'title' => $event->title . ' | ' . $setting_web->name,
            'meta_description' => strip_tags($event->content),
            'meta_keywords' => $event->title,
            'favicon' => $setting_web->favicon,
            'setting_web' => $setting_web,

            'event' => $event,
        ];

        return view('front.pages.event.show', $data);
    }
}
