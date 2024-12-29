<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\TeacherAttendance;
use App\Models\TeacherAttendanceTimetable;
use App\Models\TeacherAttendanceTimetableTeacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class TeacherAttendancesController extends Controller
{
    private function getIndonesianDay()
    {
        $day = Carbon::now()->format('l');
        $days = [
            'Sunday' => 'minggu',
            'Monday' => 'senin',
            'Tuesday' => 'selasa',
            'Wednesday' => 'rabu',
            'Thursday' => 'kamis',
            'Friday' => 'jumat',
            'Saturday' => 'sabtu',
        ];
        return $days[$day];
    }
    public function present()
    {
        $data = [
            'title' => 'Teacher Attendances',
            'page' => 'Teacher Attendances',
        ];
    }

    public function timetable()
    {
        $data = [
            'title' => 'Jadwal Presensi Guru',
            'menu' => 'Presensi',
            'sub_menu' => 'Presensi Guru',
            'list_teacher' => Teacher::where('type', 'tenaga pendidik')->get(),

            'list_senin' => TeacherAttendanceTimetable::with('teachersTimetable')->where('day', 'senin')->orderBy('start', 'asc')->get(),
            'list_selasa' => TeacherAttendanceTimetable::with('teachersTimetable')->where('day', 'selasa')->orderBy('start', 'asc')->get(),
            'list_rabu' => TeacherAttendanceTimetable::with('teachersTimetable')->where('day', 'rabu')->orderBy('start', 'asc')->get(),
            'list_kamis' => TeacherAttendanceTimetable::with('teachersTimetable')->where('day', 'kamis')->orderBy('start', 'asc')->get(),
            'list_jumat' => TeacherAttendanceTimetable::with('teachersTimetable')->where('day', 'jumat')->orderBy('start', 'asc')->get(),
            'list_sabtu' => TeacherAttendanceTimetable::with('teachersTimetable')->where('day', 'sabtu')->orderBy('start', 'asc')->get(),
        ];

        return view('back.pages.teacher-attendance.timetable', $data);
    }

    public function timetableStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'teacher_id' => 'required|array',
            'teacher_id.*' => 'required|integer',
            'day' => 'required',
            'start' => 'required',
            'end' => 'required',
        ], [
            'teacher_id.required' => 'Guru wajib diisi',
            'teacher_id.*.required' => 'Guru wajib diisi',
            'teacher_id.*.integer' => 'Guru harus berupa angka',
            'day.required' => 'Hari wajib diisi',
            'start.required' => 'Jam mulai wajib diisi',
            'end.required' => 'Jam selesai wajib diisi',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $timetable = new TeacherAttendanceTimetable();
        $timetable->day = $request->day;
        $timetable->start = $request->start;
        $timetable->end = $request->end;
        $timetable->save();

        foreach ($request->teacher_id as $teacher_id) {
            TeacherAttendanceTimetableTeacher::create([
                'teacher_attendance_timetable_id' => $timetable->id,
                'teacher_id' => $teacher_id,
            ]);
        }

        Alert::success('Success', 'Data berhasil ditambahkan');
        return redirect()->back();
    }

    public function timetableTeacherUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'teacher_id' => 'required|array',
            'teacher_id.*' => 'required|integer',
            'start' => 'required',
        ], [
            'teacher_id.required' => 'Guru wajib diisi',
            'teacher_id.*.required' => 'Guru wajib diisi',
            'teacher_id.*.integer' => 'Guru harus berupa angka',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        TeacherAttendanceTimetableTeacher::where('teacher_attendance_timetable_id', $id)->delete();

        foreach ($request->teacher_id as $teacher_id) {
            TeacherAttendanceTimetableTeacher::create([
                'teacher_attendance_timetable_id' => $id,
                'teacher_id' => $teacher_id,
            ]);
        }

        Alert::success('Success', 'Data berhasil diubah');
        return redirect()->back();
    }

    public function timetableDestroy($id)
    {
        TeacherAttendanceTimetable::destroy($id);
        TeacherAttendanceTimetableTeacher::where('teacher_attendance_timetable_id', $id)->delete();

        Alert::success('Success', 'Data berhasil dihapus');
        return redirect()->back();
    }

    public function attandance()
    {
        $teacher_me = Auth::user()->teacher;
        if ($teacher_me->type != 'tenaga pendidik') {
            Alert::error('Error', 'Anda tidak memiliki akses');
            return redirect()->back();
        }
        if (!$teacher_me) {
            Alert::error('Error', 'Data guru tidak ditemukan');
            return redirect()->back();
        }
        $attendance_active = TeacherAttendanceTimetable::whereHas('teachersTimetable', function ($query) use ($teacher_me) {
            $query->where('teacher_id', $teacher_me->id);
        })->where('day', $this->getIndonesianDay())->where('start', '<=', Carbon::now()->format('H:i:s'))->where('end', '>=', Carbon::now()->format('H:i:s'))->first();
        $data = [
            'title' => 'Presensi Guru',
            'menu' => 'Presensi',
            'sub_menu' => 'Presensi Guru',
            'attendance_senin' => TeacherAttendanceTimetable::with(
                ['teachersTimetable' => function ($query) use ($teacher_me) {
                    $query->where('teacher_id', $teacher_me->id);
                }]
            )->whereHas('teachersTimetable', function ($query) use ($teacher_me) {
                $query->where('teacher_id', $teacher_me->id);
            })->where('day', 'senin')->orderBy('start', 'asc')->get(),
            'attendance_selasa' => TeacherAttendanceTimetable::with(
                ['teachersTimetable' => function ($query) use ($teacher_me) {
                    $query->where('teacher_id', $teacher_me->id);
                }]
            )->whereHas('teachersTimetable', function ($query) use ($teacher_me) {
                $query->where('teacher_id', $teacher_me->id);
            })->where('day', 'selasa')->orderBy('start', 'asc')->get(),
            'attendance_rabu' => TeacherAttendanceTimetable::with(
                ['teachersTimetable' => function ($query) use ($teacher_me) {
                    $query->where('teacher_id', $teacher_me->id);
                }]
            )->whereHas('teachersTimetable', function ($query) use ($teacher_me) {
                $query->where('teacher_id', $teacher_me->id);
            })->where('day', 'rabu')->orderBy('start', 'asc')->get(),
            'attendance_kamis' => TeacherAttendanceTimetable::with(
                ['teachersTimetable' => function ($query) use ($teacher_me) {
                    $query->where('teacher_id', $teacher_me->id);
                }]
            )->whereHas('teachersTimetable', function ($query) use ($teacher_me) {
                $query->where('teacher_id', $teacher_me->id);
            })->where('day', 'kamis')->orderBy('start', 'asc')->get(),
            'attendance_jumat' => TeacherAttendanceTimetable::with(
                ['teachersTimetable' => function ($query) use ($teacher_me) {
                    $query->where('teacher_id', $teacher_me->id);
                }]
            )->whereHas('teachersTimetable', function ($query) use ($teacher_me) {
                $query->where('teacher_id', $teacher_me->id);
            })->where('day', 'jumat')->orderBy('start', 'asc')->get(),
            'attendance_sabtu' => TeacherAttendanceTimetable::with(
                ['teachersTimetable' => function ($query) use ($teacher_me) {
                    $query->where('teacher_id', $teacher_me->id);
                }]
            )->whereHas('teachersTimetable', function ($query) use ($teacher_me) {
                $query->where('teacher_id', $teacher_me->id);
            })->where('day', 'sabtu')->orderBy('start', 'asc')->get(),

            "attendance_active" => $attendance_active,
            "attendance_active_present" => $attendance_active ? TeacherAttendance::where('teacher_id', $teacher_me->id)->where('date', date('Y-m-d'))->where('time', '>=', $attendance_active->start)->where('time', '<=', $attendance_active->end)->first() : null,

        ];
        // return response()->json($data);
        return view('back.pages.teacher-attendance.attendance', $data);
    }

    public function attandanceProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'teacher_id' => 'required',
            'date' => 'required',
            'time' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ], [
            'teacher_id.required' => 'Guru wajib diisi',
            'date.required' => 'Tanggal wajib diisi',
            'status.required' => 'Status wajib diisi',
            'latitude.required' => 'Latitude wajib diisi',
            'longitude.required' => 'Longitude wajib diisi',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $attendance = new TeacherAttendance();
        $attendance->teacher_id = $request->teacher_id;
        $attendance->date = $request->date;
        $attendance->time = $request->time;
        $attendance->latitude = $request->latitude;
        $attendance->longitude = $request->longitude;
        $attendance->save();

        Alert::success('Success', 'Berhasil Melakukan Absensi');
        return redirect()->back();
    }
}
