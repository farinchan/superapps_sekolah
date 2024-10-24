<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentAchievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class AchievementController extends Controller
{
    public function studentAchievement(){
        $data = [
            'title' => 'Prestasi Siswa',
            'menu' => 'Prestasi',
            'sub_menu' => 'Siswa',
            'list_student_achievements' => StudentAchievement::latest()->get(),

        ];

        return view('back.pages.achievement.student.index', $data);
    }

    public function createStudentAchievement(){
        $data = [
            'title' => 'Tambah Prestasi Siswa',
            'menu' => 'Prestasi',
            'sub_menu' => 'Siswa',
            'students' => Student::latest()->get(),
        ];

        return view('back.pages.achievement.student.create', $data);
    }

    public function storeStudentAchievement(Request $request){
        $validator = Validator::make($request->all(), [
            'student_id' => 'required',
            'name' => 'required',
            'level' => 'required',
            'event' => 'required',
            'rank' => 'required',
            'description' => 'required',
            'file' => 'required|file|mimes:pdf',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'student_id.required' => 'Siswa harus diisi',
            'name.required' => 'Nama prestasi harus diisi',
            'level.required' => 'Tingkat prestasi harus diisi',
            'event.required' => 'Nama kegiatan harus diisi',
            'rank.required' => 'Peringkat harus diisi',
            'description.required' => 'Deskripsi prestasi harus diisi',
            'file.required' => 'File sertifikat harus diisi',
            'file.mimes' => 'File sertifikat harus berformat pdf',
            'image.required' => 'Foto prestasi harus diisi',
            'image.mimes' => 'Foto prestasi harus berformat jpeg, png, jpg, gif, svg',
            'image.max' => 'Foto prestasi maksimal 2MB',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Data gagal disimpan');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $student_achievement = new StudentAchievement();
        $student_achievement->student_id = $request->student_id;
        $student_achievement->name = $request->name;
        $student_achievement->level = $request->level;
        $student_achievement->event = $request->event;
        $student_achievement->rank = $request->rank;
        $student_achievement->description = $request->description;

        $student_achievement->file = $request->file('file')->storeAs('student_achievements', Str::random(10) . '.' . $request->file('file')->extension(), 'public');
        $student_achievement->image = $request->file('image')->storeAs('student_achievements', Str::random(10) . '.' . $request->file('image')->extension(), 'public');

        $student_achievement->save();

        Alert::success('Berhasil', 'Data berhasil disimpan');
        return redirect()->route('back.achievement.student.index');
    }

    public function editStudentAchievement($id){
        $data = [
            'title' => 'Edit Prestasi Siswa',
            'menu' => 'Prestasi',
            'sub_menu' => 'Siswa',
            'student_achievement' => StudentAchievement::find($id),
            'students' => Student::latest()->get(),
        ];

        return view('back.pages.achievement.student.edit', $data);
    }

    public function updateStudentAchievement(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'student_id' => 'required',
            'name' => 'required',
            'level' => 'required',
            'event' => 'required',
            'rank' => 'required',
            'description' => 'required',
            'file' => 'nullable|file|mimes:pdf',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'student_id.required' => 'Siswa harus diisi',
            'name.required' => 'Nama prestasi harus diisi',
            'level.required' => 'Tingkat prestasi harus diisi',
            'event.required' => 'Nama kegiatan harus diisi',
            'rank.required' => 'Peringkat harus diisi',
            'description.required' => 'Deskripsi prestasi harus diisi',
            'file.mimes' => 'File sertifikat harus berformat pdf',
            'image.mimes' => 'Foto prestasi harus berformat jpeg, png, jpg, gif, svg',
            'image.max' => 'Foto prestasi maksimal 2MB',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Data gagal disimpan');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $student_achievement = StudentAchievement::find($id);
        $student_achievement->student_id = $request->student_id;
        $student_achievement->name = $request->name;
        $student_achievement->level = $request->level;
        $student_achievement->event = $request->event;
        $student_achievement->rank = $request->rank;
        $student_achievement->description = $request->description;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            Storage::disk('public')->delete($student_achievement->file);
            $student_achievement->file = $file->storeAs('student_achievements', Str::random(10) . '.' . $file->extension(), 'public');
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            Storage::disk('public')->delete($student_achievement->image);
            $student_achievement->image = $image->storeAs('student_achievements', Str::random(10) . '.' . $image->extension(), 'public');
        }

        $student_achievement->save();

        Alert::success('Berhasil', 'Data berhasil disimpan');
        return redirect()->route('back.achievement.student.index');
    }

    public function destroyStudentAchievement($id){
        $student_achievement = StudentAchievement::find($id);
        Storage::disk('public')->delete($student_achievement->file);
        Storage::disk('public')->delete($student_achievement->image);
        $student_achievement->delete();

        Alert::success('Berhasil', 'Data berhasil dihapus');
        return redirect()->route('back.achievement.student.index');
    }

}
