<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamAnswer;
use App\Models\ExamSession;
use App\Models\SchoolYear;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ExamController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'List Ujian',
            'menu' => 'E-Learning',
            'sub_menu' => 'Ujian',

            'list_exam' => Exam::with('teacher', 'schoolYear')->get(),

            'list_subject' => Subject::all(),
            'list_school_year' => SchoolYear::all(),
            'list_teacher' => Teacher::where('type', 'tenaga pendidik')->get(),


        ];

        return view('back.pages.exam.index', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject_id' => 'required',
            'description' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'duration' => 'required|numeric',
            'teacher_id' => 'required',
            'type' => 'required',
            'school_year_id' => 'required',
        ], [
            'subject_id.required' => 'Mata pelajaran wajib diisi',
            'description.required' => 'Deskripsi wajib diisi',
            'start_time.required' => 'Waktu mulai wajib diisi',
            'end_time.required' => 'Waktu selesai wajib diisi',
            'duration.required' => 'Durasi wajib diisi',
            'teacher_id.required' => 'Guru wajib diisi',
            'type.required' => 'Jenis Ujian wajib diisi',
            'school_year_id.required' => 'Tahun ajaran wajib diisi',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Exam::create($request->all());

        Alert::success('Success', 'Data berhasil ditambahkan');
        return redirect()->back();
    }

    public function setting($id)
    {
        $data = [
            'title' => 'Setting Ujian',
            'menu' => 'E-Learning',
            'sub_menu' => 'Ujian',

            'exam' => Exam::with('teacher', 'schoolYear')->find($id),
            'list_subject' => Subject::all(),
            'list_school_year' => SchoolYear::all(),
            'list_teacher' => Teacher::where('type', 'tenaga pendidik')->get(),
        ];

        return view('back.pages.exam.detail-setting', $data);
    }

    public function settingUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'subject_id' => 'required',
            'description' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'duration' => 'required|numeric',
            'teacher_id' => 'required',
            'type' => 'required',
            'school_year_id' => 'required',
        ], [
            'subject_id.required' => 'Mata pelajaran wajib diisi',
            'description.required' => 'Deskripsi wajib diisi',
            'start_time.required' => 'Waktu mulai wajib diisi',
            'end_time.required' => 'Waktu selesai wajib diisi',
            'duration.required' => 'Durasi wajib diisi',
            'teacher_id.required' => 'Guru wajib diisi',
            'type.required' => 'Jenis Ujian wajib diisi',
            'school_year_id.required' => 'Tahun ajaran wajib diisi',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Exam::find($id)->update($request->all());

        Alert::success('Success', 'Data berhasil diubah');
        return redirect()->back();
    }

    public function settingDestroy($id)
    {
        Exam::find($id)->delete();

        Alert::success('Success', 'Data berhasil dihapus');
        return redirect()->back();
    }




}
