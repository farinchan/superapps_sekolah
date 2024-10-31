<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Calendar',
            'menu' => 'calendar',
            'submenu' => '',
        ];

        return view('back.pages.calendar.index', $data);

    }
}
