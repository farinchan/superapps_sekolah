<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use Illuminate\Http\Request;

class UtilityController extends Controller
{
    public function getCalendar()
    {
        $data = [
            "calendar" => Calendar::all(),
        ];

        return response()->json($data);
    }
}
