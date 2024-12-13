<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use App\Models\Classroom;
use App\Models\Student;
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

    public function getDetailClassroom()
    {
        $classroom_id = request()->classroom_id;

        $data = [
            "student" => Student::when($classroom_id, function ($query) use ($classroom_id) {
                $query->whereHas('classroomStudent', function ($query) use ($classroom_id) {
                    $query->where('classroom_id', $classroom_id);
                });
            })->get(),
            "wali_kelas" => Classroom::find($classroom_id)->teacher,
        ];

        return response()->json($data);
    }
}
