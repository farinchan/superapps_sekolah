<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use App\Models\Classroom;
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

    public function getClassroom()
    {
        $school_year_id = request()->school_year_id;

        return response()->json(Classroom::when($school_year_id, function ($query) use ($school_year_id) {
            $query->where('school_year_id', $school_year_id);
        })->get());
    }
}
