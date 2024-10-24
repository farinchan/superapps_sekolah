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
use App\Models\Teacher;
use App\Models\TeacherAchievement;

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

    public function studentAchievementCreate(){
        $data = [
            'title' => 'Tambah Prestasi Siswa',
            'menu' => 'Prestasi',
            'sub_menu' => 'Siswa',
            'students' => Student::latest()->get(),
        ];

        return view('back.pages.achievement.student.create', $data);
    }

    public function studentAchievementStore(Request $request){
        $validator = Validator::make($request->all(), [
            'student_id' => 'required',
            'name' => 'required',
            'level' => 'required',
            'event' => 'required',
            'rank' => 'required',
            'description' => 'required|max:255',
            'file' => 'required|file|mimes:pdf',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'date' => 'required',
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
        $student_achievement->date = $request->date;

        $student_achievement->file = $request->file('file')->storeAs('student_achievements', Str::random(10) . '.' . $request->file('file')->extension(), 'public');
        $student_achievement->image = $request->file('image')->storeAs('student_achievements', Str::random(10) . '.' . $request->file('image')->extension(), 'public');

        $student_achievement->save();

        Alert::success('Berhasil', 'Data berhasil disimpan');
        return redirect()->route('back.achievement.student.index');
    }

    public function studentAchievementEdit($id){
        $data = [
            'title' => 'Edit Prestasi Siswa',
            'menu' => 'Prestasi',
            'sub_menu' => 'Siswa',
            'student_achievement' => StudentAchievement::find($id),
            'students' => Student::latest()->get(),
        ];

        return view('back.pages.achievement.student.edit', $data);
    }

    public function studentAchievementUpdate(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'student_id' => 'required',
            'name' => 'required',
            'level' => 'required',
            'event' => 'required',
            'rank' => 'required',
            'description' => 'required|max:255',
            'file' => 'nullable|file|mimes:pdf',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'date' => 'required',
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
        $student_achievement->date = $request->date;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            Storage::delete($student_achievement->file);
            $student_achievement->file = $file->storeAs('student_achievements', Str::random(10) . '.' . $file->extension(), 'public');
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            Storage::delete($student_achievement->image);
            $student_achievement->image = $image->storeAs('student_achievements', Str::random(10) . '.' . $image->extension(), 'public');
        }

        $student_achievement->save();

        Alert::success('Berhasil', 'Data berhasil disimpan');
        return redirect()->route('back.achievement.student.index');
    }

    public function studentAchievementDestroy($id){
        $student_achievement = StudentAchievement::find($id);
        Storage::delete($student_achievement->file);
        Storage::delete($student_achievement->image);
        $student_achievement->delete();

        Alert::success('Berhasil', 'Data berhasil dihapus');
        return redirect()->route('back.achievement.student.index');
    }

    public function teacherAchievement(){
        $data = [
            'title' => 'Prestasi Guru',
            'menu' => 'Prestasi',
            'sub_menu' => 'Guru',
            'list_teacher_achievements' => TeacherAchievement::latest()->get(),

        ];

        return view('back.pages.achievement.teacher.index', $data);
    }

    public function teacherAchievementCreate(){
        $data = [
            'title' => 'Tambah Prestasi Guru',
            'menu' => 'Prestasi',
            'sub_menu' => 'Guru',
            'teachers' => Teacher::where('type', 'tenaga pendidik')->latest()->get(),
        ];

        return view('back.pages.achievement.teacher.create', $data);
    }

    public function teacherAchievementStore(Request $request){
        $validator = Validator::make($request->all(), [
            'teacher_id' => 'required',
            'name' => 'required',
            'level' => 'required',
            'event' => 'required',
            'rank' => 'required',
            'description' => 'required|max:255',
            'file' => 'required|file|mimes:pdf',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'date' => 'required',
        ], [
            'teacher_id.required' => 'Guru harus diisi',
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
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $teacher_achievement = new TeacherAchievement();
        $teacher_achievement->teacher_id = $request->teacher_id;
        $teacher_achievement->name = $request->name;
        $teacher_achievement->level = $request->level;
        $teacher_achievement->event = $request->event;
        $teacher_achievement->rank = $request->rank;
        $teacher_achievement->description = $request->description;
        $teacher_achievement->date = $request->date;

        $teacher_achievement->file = $request->file('file')->storeAs('student_achievements', Str::random(10) . '.' . $request->file('file')->extension(), 'public');
        $teacher_achievement->image = $request->file('image')->storeAs('student_achievements', Str::random(10) . '.' . $request->file('image')->extension(), 'public');

        $teacher_achievement->save();

        Alert::success('Berhasil', 'Data berhasil disimpan');
        return redirect()->route('back.achievement.teacher.index');
    }

    public function teacherAchievementEdit($id){
        $data = [
            'title' => 'Edit Prestasi Guru',
            'menu' => 'Prestasi',
            'sub_menu' => 'Guru',
            'teacher_achievement' => TeacherAchievement::find($id),
            'teachers' => Teacher::where('type', 'tenaga pendidik')->latest()->get(),
        ];

        return view('back.pages.achievement.teacher.edit', $data);
    }

    public function teacherAchievementUpdate(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'teacher_id' => 'required',
            'name' => 'required',
            'level' => 'required',
            'event' => 'required',
            'rank' => 'required',
            'description' => 'required|max:255',
            'file' => 'nullable|file|mimes:pdf',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'date' => 'required',
        ], [
            'teacher_id.required' => 'Guru harus diisi',
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

        $teacher_achievement = TeacherAchievement::find($id);
        $teacher_achievement->teacher_id = $request->teacher_id;
        $teacher_achievement->name = $request->name;
        $teacher_achievement->level = $request->level;
        $teacher_achievement->event = $request->event;
        $teacher_achievement->rank = $request->rank;
        $teacher_achievement->description = $request->description;
        $teacher_achievement->date = $request->date;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            Storage::delete($teacher_achievement->file);
            $teacher_achievement->file = $file->storeAs('teacher_achievements', Str::random(10) . '.' . $file->extension(), 'public');
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            Storage::delete($teacher_achievement->image);
            $teacher_achievement->image = $image->storeAs('student_achievements', Str::random(10) . '.' . $request->file('image')->extension(), 'public');
        }

        $teacher_achievement->save();

        Alert::success('Berhasil', 'Data berhasil disimpan');
        return redirect()->route('back.achievement.teacher.index');
    }

    public function teacherAchievementDestroy($id){
        $teacher_achievement = TeacherAchievement::find($id);
        Storage::delete($teacher_achievement->file);
        Storage::delete($teacher_achievement->image);
        $teacher_achievement->delete();

        Alert::success('Berhasil', 'Data berhasil dihapus');
        return redirect()->route('back.achievement.teacher.index');
    }

}
