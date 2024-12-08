<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class StudentAttendancesController extends Controller
{
    public function scan()
    {
        $data = [
            'title' => 'Scan QR Code',
            'menu' => 'Presensi',
            'sub_menu' => 'Presensi Siswa',

        ];

        return view('back.pages.student-attendance.scan', $data);
    }

    public function HistoryScanDatatable(Request $request)
    {
        $history = StudentAttendance::where('teacher_id', Auth::user()->teacher->id)->latest()->get();

        return datatables()->of($history)
            ->addIndexColumn()
            ->addColumn('student', function ($row) {
                return '
                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                            <a href="#">
                                <div class="symbol-label">
                                    <img src="' . $row->student->getPhoto() .'"
                                        alt="' . $row->student->name . '" class="h-75"
                                        width="50px" />
                                </div>
                            </a>
                        </div>
                        <div class="d-flex flex-column">
                            <a href="#"
                                class="text-gray-800 text-hover-primary mb-1">' . $row->student->name . '</a>
                            <span> NISN.' . $row->student->nisn . '</span>
                            <span> NIK.' . $row->student->nik . '</span>
                        </div>
                ';
            })
            ->addColumn('date', function ($row) {
                return Carbon::parse($row->date)->isoFormat('dddd, D MMMM Y');
            })
            ->addColumn('time', function ($row) {
                return Carbon::parse($row->time)->format('H:i');
            })
            ->addColumn('type', function ($row) {
                if ($row->type == 'masuk') {
                    return '<span class="badge badge-light-primary">Masuk</span>';
                } else {
                    return '<span class="badge badge-light-danger">Pulang</span>';
                }
            })
            ->addColumn('status', function ($row) {
                return '';
            })
            ->rawColumns(['student', 'date', 'time', 'type', 'status'])
            ->make(true);
    }
}
