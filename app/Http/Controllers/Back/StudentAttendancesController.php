<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentAttendance;
use App\Models\StudentAttendanceRule;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class StudentAttendancesController extends Controller
{
    public function scan()
    {
        $data = [
            'title' => 'Scan QR Code',
            'menu' => 'Presensi',
            'sub_menu' => 'Presensi Siswa',

        ];

        // $timetable = StudentAttendanceRule::where('day', Carbon::now()->isoFormat('dddd'))->first();
        // return response()->json(['status' => 'success', 'message' => [
        //     'timetable' => $timetable,
        //     'one_hour_before' => Carbon::parse($timetable->start)->subHour()->format('H:i:s'),
        //     'one_hour_after' => Carbon::parse($timetable->start)->addHour()->format('H:i:s'),
        //     'now' => Carbon::now()->format('H:i:s'),
        //     'sejam_sebelum_status' => Carbon::now()->format('H:i:s') < Carbon::parse($timetable->start)->subHour()->format('H:i:s') ? 'true' : 'false',
        //     'sejam_seletal_status' => Carbon::now()->format('H:i:s') > Carbon::parse($timetable->start)->subHour()->format('H:i:s') ? 'true' : 'false',
        //     'sejam_setelah_status' => Carbon::now()->format('H:i:s') < Carbon::parse($timetable->start)->addHour()->format('H:i:s') ? 'true' : 'false',
        // ]]);


        return view('back.pages.student-attendance.scan', $data);
    }

    public function scanProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nisn' => 'required|exists:student,nisn',
        ], [
            'nisn.required' => 'NISN Harus Diisi',
            'nisn.exists' => 'NISN Tidak Ditemukan',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->all()]);
        }

        $student = Student::where('nisn', $request->nisn)->first();

        $timetable = StudentAttendanceRule::where('day', Carbon::now()->isoFormat('dddd'))->first();
        $attendance = StudentAttendance::where('student_id', $student->id)
            ->where('date', Carbon::now()->format('Y-m-d'))
            ->where('teacher_id', Auth::user()->teacher->id)
            ->first();

        if (!$timetable) {
            Alert::error('Gagal', 'Jadwal Presensi Belum Diatur');
            return response()->json(['status' => 'error', 'message' => 'Jadwal Presensi Belum Diatur']);
        }

        if (!$attendance) {
            if (Carbon::now()->format('H:i:s') < Carbon::parse($timetable->start)->subHour()->format('H:i:s')) {
                return response()->json(['status' => 'error', 'message' => 'Presensi Masuk hanya dapat dilakukan sejam sebelum jadwal masuk']);
            }

            $attendance = new StudentAttendance();
            $attendance->student_id = $student->id;
            $attendance->date = Carbon::now()->format('Y-m-d');
            $attendance->time_in = Carbon::now()->format('H:i:s');
            $attendance->time_in_info = $timetable->start < Carbon::now()->format('H:i:s') ? 'Terlambat' : 'Tepat Waktu';
            $attendance->teacher_id = Auth::user()->teacher->id;
            $attendance->save();
        } else {
            if (Carbon::now()->format('H:i:s') < Carbon::parse($timetable->start)->addHour()->format('H:i:s')) {
                return response()->json(['status' => 'error', 'message' => 'Presensi Pulang hanya dapat dilakukan satu jam setelah jadwal masuk']);
            }

            if ($attendance->time_out) {
                return response()->json(['status' => 'error', 'message' => 'Presensi Pulang Sudah Dilakukan']);
            }

            $attendance->time_out = Carbon::now()->format('H:i:s');
            $attendance->time_out_info = $timetable->end > Carbon::now()->format('H:i:s') ? 'Pulang Cepat' : 'Pulang Tepat Waktu';
            $attendance->teacher_id = Auth::user()->teacher->id;
            $attendance->save();
        }

        Alert::success('Berhasil', 'Presensi Berhasil Disimpan');
        return response()->json(['status' => 'success', 'message' => 'Presensi Berhasil Disimpan']);
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
                                    <img src="' . $row->student->getPhoto() . '"
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
            ->addColumn('time_in', function ($row) {
                return '
                    <span class="badge badge-light-primary">' . Carbon::parse($row->time_in)->format('H:i') . '</span>
                    <span class="badge badge-light-' . ($row->time_in_info == 'Terlambat' ? 'danger' : 'success') . '">' . $row->time_in_info . '</span>
                ';
            })
            ->addColumn('time_out', function ($row) {
                return $row->time_out ? '
                    <span class="badge badge-light-primary">' . Carbon::parse($row->time_out)->format('H:i') . '</span>
                    <span class="badge badge-light-' . ($row->time_out_info == 'Pulang Cepat' ? 'warning' : 'success') . '">' . $row->time_out_info . '</span>
                ' : '-';
            })
            ->rawColumns(['student', 'date', 'time_in', 'time_out'])
            ->make(true);
    }

    public function timetable()
    {
        $senin = StudentAttendanceRule::where('day', 'senin')->first();
        $selasa = StudentAttendanceRule::where('day', 'selasa')->first();
        $rabu = StudentAttendanceRule::where('day', 'rabu')->first();
        $kamis = StudentAttendanceRule::where('day', 'kamis')->first();
        $jumat = StudentAttendanceRule::where('day', 'jumat')->first();
        $sabtu = StudentAttendanceRule::where('day', 'sabtu')->first();
        $data = [
            'title' => 'Jadwal Presensi',
            'menu' => 'Presensi',
            'sub_menu' => 'Presensi Siswa',
            'senin_time_in' => $senin->start ?? '',
            'senin_time_out' => $senin->end ?? '',
            'selasa_time_in' => $selasa->start ?? '',
            'selasa_time_out' => $selasa->end ?? '',
            'rabu_time_in' => $rabu->start ?? '',
            'rabu_time_out' => $rabu->end ?? '',
            'kamis_time_in' => $kamis->start ?? '',
            'kamis_time_out' => $kamis->end ?? '',
            'jumat_time_in' => $jumat->start ?? '',
            'jumat_time_out' => $jumat->end ?? '',
            'sabtu_time_in' => $sabtu->start ?? '',
            'sabtu_time_out' => $sabtu->end ?? '',

        ];

        return view('back.pages.student-attendance.timetable', $data);
    }

    public function timetableUpdate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'senin_time_in' => 'required',
            'senin_time_out' => 'required',
            'selasa_time_in' => 'required',
            'selasa_time_out' => 'required',
            'rabu_time_in' => 'required',
            'rabu_time_out' => 'required',
            'kamis_time_in' => 'required',
            'kamis_time_out' => 'required',
            'jumat_time_in' => 'required',
            'jumat_time_out' => 'required',
            'sabtu_time_in' => 'required',
            'sabtu_time_out' => 'required',
        ], [
            'senin_time_in.required' => 'Waktu Masuk Senin Harus Diisi',
            'senin_time_out.required' => 'Waktu Pulang Senin Harus Diisi',
            'selasa_time_in.required' => 'Waktu Masuk Selasa Harus Diisi',
            'selasa_time_out.required' => 'Waktu Pulang Selasa Harus Diisi',
            'rabu_time_in.required' => 'Waktu Masuk Rabu Harus Diisi',
            'rabu_time_out.required' => 'Waktu Pulang Rabu Harus Diisi',
            'kamis_time_in.required' => 'Waktu Masuk Kamis Harus Diisi',
            'kamis_time_out.required' => 'Waktu Pulang Kamis Harus Diisi',
            'jumat_time_in.required' => 'Waktu Masuk Jumat Harus Diisi',
            'jumat_time_out.required' => 'Waktu Pulang Jumat Harus Diisi',
            'sabtu_time_in.required' => 'Waktu Masuk Sabtu Harus Diisi',
            'sabtu_time_out.required' => 'Waktu Pulang Sabtu Harus Diisi',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $senin = StudentAttendanceRule::updateOrCreate(
            ['day' => 'senin'],
            [
                'start' => $request->senin_time_in,
                'end' => $request->senin_time_out,
            ]
        );

        $selasa = StudentAttendanceRule::updateOrCreate(
            ['day' => 'selasa'],
            [
                'start' => $request->selasa_time_in,
                'end' => $request->selasa_time_out,
            ]
        );

        $rabu = StudentAttendanceRule::updateOrCreate(
            ['day' => 'rabu'],
            [
                'start' => $request->rabu_time_in,
                'end' => $request->rabu_time_out,
            ]
        );

        $kamis = StudentAttendanceRule::updateOrCreate(
            ['day' => 'kamis'],
            [
                'start' => $request->kamis_time_in,
                'end' => $request->kamis_time_out,
            ]
        );

        $jumat = StudentAttendanceRule::updateOrCreate(
            ['day' => 'jumat'],
            [
                'start' => $request->jumat_time_in,
                'end' => $request->jumat_time_out,
            ]
        );

        $sabtu = StudentAttendanceRule::updateOrCreate(
            ['day' => 'sabtu'],
            [
                'start' => $request->sabtu_time_in,
                'end' => $request->sabtu_time_out,
            ]
        );

        Alert::success('Berhasil', 'Jadwal Presensi Berhasil Diupdate');
        return redirect()->back();
    }
}
