<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use App\Models\Classroom;
use App\Models\SchoolYear;
use App\Models\Teacher;

class ClassroomController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kelas',
            'menu' => 'Kelas',
            'sub_menu' => '',
            'list_classroom' => Classroom::orderBy('name', 'asc')->get(),
            'list_teacher' => Teacher::orderBy('name', 'asc')->get(),
            'list_school_year' => SchoolYear::orderBy('start_year', 'asc')->get(),
        ];

        return view('back.pages.classroom.index', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'teacher_id' => 'required',
            'school_year_id' => 'required',
        ], [
            'name.required' => 'Nama kelas wajib diisi',
            'teacher_id.required' => 'Wali kelas wajib diisi',
            'school_year_id.required' => 'Tahun ajaran wajib diisi',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Data gagal disimpan');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();

        Classroom::create($data);

        Alert::success('Berhasil', 'Data berhasil disimpan');
        return redirect()->route('back.classroom.index');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'teacher_id' => 'required',
            'school_year_id' => 'required',
        ], [
            'name.required' => 'Nama kelas wajib diisi',
            'teacher_id.required' => 'Wali kelas wajib diisi',
            'school_year_id.required' => 'Tahun ajaran wajib diisi',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Data gagal disimpan');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();

        Classroom::find($id)->update($data);

        Alert::success('Berhasil', 'Data berhasil disimpan');
        return redirect()->route('back.classroom.index');
    }

    public function destroy($id)
    {
        Classroom::find($id)->delete();

        Alert::success('Berhasil', 'Data berhasil dihapus');
        return redirect()->route('back.classroom.index');
    }

}
