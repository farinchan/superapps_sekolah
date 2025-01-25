<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WhatsappController extends Controller
{
    public function setting()
    {
        $data = [
            'title' => 'Pengaturan Whatsapp',
            'menu' => 'administrator',
            'sub_menu' => 'whatsapp',
        ];

        return view('back.pages.whatsapp.setting', $data);

    }

    public function message()
    {
        $data = [
            'title' => 'Pesan Whatsapp',
            'menu' => 'administrator',
            'sub_menu' => 'whatsapp',
        ];

        return view('back.pages.whatsapp.message', $data);
    }
}
