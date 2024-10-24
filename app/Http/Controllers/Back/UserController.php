<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function staff()
    {
        $data = [
            'title' => 'Tenaga Pendidik dan Tenaga Kependidikan',
            'menu' => 'User',
            'sub_menu' => 'Staff',
            'users' => Teacher::latest()->get(),
        ];

        return view('back.pages.user.guru.index', $data);
    }

    public function staffCreate()
    {
        $data = [
            'title' => 'Tambah user',
            'menu' => 'user',
            'sub_menu' => 'user',
        ];

        return view('back.pages.user.guru.create', $data);
    }

    public function staffStore(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'nip' => 'nullable',
            'gender' => 'nullable',
            'birth_date' => 'nullable',
            'birth_place' => 'nullable',
            'no_telp' => 'nullable',
            'email' => 'required|email|unique:users',
            'address' => 'nullable|max:255',
            'position' => 'nullable',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'about' => 'nullable',
            'type' => 'required',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'meta_title' => 'nullable',
            'meta_description' => 'nullable',
            'meta_keywords' => 'nullable',
            'password' => 'required|min:8',
        ], [
            'required' => ':attribute harus diisi',
            'email.unique' => 'Email sudah terdaftar',
            'email' => 'Email tidak valid',
            'image' => 'File harus berupa gambar',
            'mimes' => 'File harus berupa gambar',
            'max' => 'Ukuran file maksimal 2MB',
            'in' => 'Pilih :attribute yang benar',
            'url' => 'URL tidak valid',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        if ($request->role_admin) {
            $user->assignRole('admin');
        }

        if ($request->role_kepsek) {
            $user->assignRole('kepsek');
        }

        if ($request->role_guru) {
            $user->assignRole('guru');
        }

        if ($request->role_guru_bk) {
            $user->assignRole('guru_bk');
        }

        if ($request->role_bendahara) {
            $user->assignRole('bendahara');
        }

        if ($request->role_staff) {
            $user->assignRole('staff');
        }

        $teacher = new Teacher();
        $teacher->name = $request->name;
        $teacher->nip = $request->nip;
        $teacher->gender = $request->gender;
        $teacher->birth_date = $request->birth_date;
        $teacher->birth_place = $request->birth_place;
        $teacher->no_telp = $request->no_telp;
        $teacher->email = $request->email;
        $teacher->address = $request->address;
        $teacher->position = $request->position;
        $teacher->about = $request->about;
        $teacher->type = $request->type;
        $teacher->facebook = $request->facebook;
        $teacher->instagram = $request->instagram;
        $teacher->twitter = $request->twitter;
        $teacher->linkedin = $request->linkedin;
        $teacher->meta_title = $request->name;
        $teacher->meta_description = $request->about;
        $teacher->meta_keywords = "Guru, Staff, Tenaga Pendidik, Tenaga Kependidikan" . $request->name . $request->position . $request->type;
        $teacher->user_id = $user->id;

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $teacher->photo = $image->storeAs('teacher', date('YmdHis') . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension(), 'public');
        }

        $teacher->save();

        Alert::success('Sukses', 'User berhasil ditambahkan');
        return redirect()->route('back.user.staff.index');

    }

    public function staffEdit($id)
    {
        $data = [
            'title' => 'Edit user',
            'menu' => 'user',
            'sub_menu' => 'user',
            'user' => Teacher::findOrFail($id),
        ];

        return view('back.pages.user.guru.edit', $data);
    }

    public function staffUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'nip' => 'nullable',
            'gender' => 'nullable',
            'birth_date' => 'nullable',
            'birth_place' => 'nullable',
            'no_telp' => 'nullable',
            'email' => 'required|email|unique:users,email,' . $id,
            'address' => 'nullable|max:255',
            'position' => 'nullable',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'about' => 'nullable',
            'type' => 'required',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'meta_title' => 'nullable',
            'meta_description' => 'nullable',
            'meta_keywords' => 'nullable',
            'password' => 'nullable|min:8',
        ], [
            'required' => ':attribute harus diisi',
            'email.unique' => 'Email sudah terdaftar',
            'email' => 'Email tidak valid',
            'image' => 'File harus berupa gambar',
            'mimes' => 'File harus berupa gambar',
            'max' => 'Ukuran file maksimal 2MB',
            'in' => 'Pilih :attribute yang benar',
            'url' => 'URL tidak valid',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $teacher = Teacher::findOrFail($id);
        $teacher->name = $request->name;
        $teacher->nip = $request->nip;
        $teacher->gender = $request->gender;
        $teacher->birth_date = $request->birth_date;
        $teacher->birth_place = $request->birth_place;
        $teacher->no_telp = $request->no_telp;
        $teacher->email = $request->email;
        $teacher->address = $request->address;
        $teacher->position = $request->position;
        $teacher->about = $request->about;
        $teacher->type = $request->type;
        $teacher->facebook = $request->facebook;
        $teacher->instagram = $request->instagram;
        $teacher->twitter = $request->twitter;
        $teacher->linkedin = $request->linkedin;
        $teacher->meta_title = $request->name;
        $teacher->meta_description = $request->about;
        $teacher->meta_keywords = "Guru, Staff, Tenaga Pendidik, Tenaga Kependidikan" . $request->name . $request->position . $request->type;

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            if ($teacher->photo) {
                Storage::delete($teacher->photo);
            }
            $teacher->photo = $image->storeAs('teacher', date('YmdHis') . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension(), 'public');
        }

        $teacher->save();

        $user = User::findOrFail($teacher->user_id);
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        Alert::success('Sukses', 'User berhasil diubah');
        return redirect()->route('back.user.staff.index');
    }

    public function staffDestroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $user = User::findOrFail($teacher->user_id);
        if ($teacher->photo){
            Storage::delete($teacher->photo);
        }
        $teacher->delete();
        $user->delete();

        Alert::success('Sukses', 'User berhasil dihapus');
        return redirect()->route('back.user.staff.index');
    }

    public function student()
    {
        $data = [
            'title' => 'Siswa',
            'menu' => 'User',
            'sub_menu' => 'Siswa',
            'users' => Student::latest()->get(),
        ];

        return view('back.pages.user.siswa.index', $data);
    }

    public function studentCreate()
    {
        $data = [
            'title' => 'Tambah Siswa',
            'menu' => 'user',
            'sub_menu' => 'Siswa',
        ];

        return view('back.pages.user.siswa.create', $data);
    }

    public function studentStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'nisn' => 'required|unique:student',
            'nik' => 'nullable|unique:student',
            'birth_place' => 'nullable',
            'birth_date' => 'nullable|date',
            'gender' => 'required',
            'address' => 'nullable|max:255',
            'no_telp' => 'nullable',
            'email' => 'nullable|email|unique:student',
            'kebutuhan_khusus' => 'nullable',
            'disabilitas' => 'nullable',
            'father_name' => 'nullable',
            'mother_name' => 'nullable',

        ], [
            'required' => ':attribute harus diisi',
            'unique' => ':attribute sudah terdaftar',
            'image' => 'File harus berupa gambar',
            'mimes' => 'File harus berupa gambar',
            'max' => 'Ukuran file maksimal 2MB',
            'email' => 'Email tidak valid',
            'date' => 'Tanggal tidak valid',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $user = new User();
        $user->email = $request->email;
        $user->password = bcrypt($request->nisn);
        $user->save();
        $user->assignRole('siswa');

        $student = new Student();
        $student->name = $request->name;
        $student->nisn = $request->nisn;
        $student->nik = $request->nik;
        $student->birth_place = $request->birth_place;
        $student->birth_date = $request->birth_date;
        $student->gender = $request->gender;
        $student->address = $request->address;
        $student->no_telp = $request->no_telp;
        $student->email = $request->email;
        $student->kebutuhan_khusus = $request->kebutuhan_khusus;
        $student->disabilitas = $request->disabilitas;
        $student->father_name = $request->father_name;
        $student->mother_name = $request->mother_name;
        $student->status = true;

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $student->photo = $image->storeAs('student', date('YmdHis') . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension(), 'public');
        }

        $student->user_id = $user->id;
        $student->save();

        Alert::success('Sukses', 'Siswa berhasil ditambahkan');
        return redirect()->route('back.user.student.index');

    }

    public function studentEdit($id)
    {
        $data = [
            'title' => 'Edit Siswa',
            'menu' => 'user',
            'sub_menu' => 'user',
            'user' => Student::findOrFail($id),
        ];

        return view('back.pages.user.siswa.edit', $data);
    }

    public function studentUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'nisn' => 'required|unique:student,nisn,' . $id,
            'nik' => 'nullable|unique:student,nik,' . $id,
            'birth_place' => 'nullable',
            'birth_date' => 'nullable|date',
            'gender' => 'required',
            'address' => 'nullable|max:255',
            'no_telp' => 'nullable',
            'email' => 'nullable|email|unique:student,email,' . $id,
            'kebutuhan_khusus' => 'nullable',
            'disabilitas' => 'nullable',
            'father_name' => 'nullable',
            'mother_name' => 'nullable',
        ], [
            'required' => ':attribute harus diisi',
            'unique' => ':attribute sudah terdaftar',
            'image' => 'File harus berupa gambar',
            'mimes' => 'File harus berupa gambar',
            'max' => 'Ukuran file maksimal 2MB',
            'email' => 'Email tidak valid',
            'date' => 'Tanggal tidak valid',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $student = Student::findOrFail($id);
        $student->name = $request->name;
        $student->nisn = $request->nisn;
        $student->nik = $request->nik;
        $student->birth_place = $request->birth_place;
        $student->birth_date = $request->birth_date;
        $student->gender = $request->gender;
        $student->address = $request->address;
        $student->no_telp = $request->no_telp;
        $student->email = $request->email;
        $student->kebutuhan_khusus = $request->kebutuhan_khusus;
        $student->disabilitas = $request->disabilitas;
        $student->father_name = $request->father_name;
        $student->mother_name = $request->mother_name;

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            if ($student->photo){
                Storage::delete($student->photo);
            }
            $student->photo = $image->storeAs('student', date('YmdHis') . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension(), 'public');
        }

        $student->save();

        $user = User::findOrFail($student->user_id);
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        Alert::success('Sukses', 'Siswa berhasil diubah');
        return redirect()->route('back.user.student.index');

    }

    public function studentDestroy($id)
    {
        $student = Student::findOrFail($id);
        $user = User::findOrFail($student->user_id);
        if ($student->photo){
            Storage::delete($student->photo);
        }
        $student->delete();
        $user->delete();

        Alert::success('Sukses', 'Siswa berhasil dihapus');
        return redirect()->route('back.user.student.index');
    }


}
