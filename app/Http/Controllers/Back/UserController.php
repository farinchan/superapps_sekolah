<?php

namespace App\Http\Controllers\Back;

use App\Exports\ParentExport;
use App\Http\Controllers\Controller;
use App\Imports\StudentImport;
use App\Exports\StudentExport;
use App\Exports\TeacherExport;
use App\Imports\ParentImport;
use App\Imports\TeacherImport;
use App\Models\ParentStudent;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use phpDocumentor\Reflection\Types\Parent_;

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
            'nik' => 'nullable',
            'gender' => 'nullable',
            'birth_date' => 'nullable',
            'birth_place' => 'nullable',
            'no_telp' => 'nullable',
            'email' => 'nullable|email|unique:users',
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

        if ($request->role_humas) {
            $user->assignRole('humas');
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

        if ($request->role_proktor) {
            $user->assignRole('proktor');
        }

        if ($request->role_ppdb) {
            $user->assignRole('ppdb');
        }

        if ($request->role_staff) {
            $user->assignRole('staff');
        }

        $teacher = new Teacher();
        $teacher->name = $request->name;
        $teacher->nip = $request->nip;
        $teacher->nik = $request->nik;
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
        $teacher->meta_keywords = "Guru, Staff, Tenaga Pendidik, Tenaga Kependidikan " . $request->name . " " . $request->position . " " . $request->type;
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
            'nik' => 'nullable',
            'gender' => 'nullable',
            'birth_date' => 'nullable',
            'birth_place' => 'nullable',
            'no_telp' => 'nullable',
            'email' => 'nullable|email',
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
        $teacher->nik = $request->nik;
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
        $teacher->meta_keywords = "Guru, Staff, Tenaga Pendidik, Tenaga Kependidikan " . $request->name . " " . $request->position . " " . $request->type;

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            if ($teacher->photo) {
                Storage::delete($teacher->photo);
            }
            $teacher->photo = $image->storeAs('teacher', date('YmdHis') . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension(), 'public');
        }

        $teacher->save();

        $user = User::findOrFail($teacher->user_id);
        // $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        if ($request->role_admin) {
            $user->assignRole('admin');
        } else {
            $user->removeRole('admin');
        }

        if ($request->role_kepsek) {
            $user->assignRole('kepsek');
        } else {
            $user->removeRole('kepsek');
        }

        if ($request->role_humas) {
            $user->assignRole('humas');
        } else {
            $user->removeRole('humas');
        }

        if ($request->role_guru) {
            $user->assignRole('guru');
        } else {
            $user->removeRole('guru');
        }

        if ($request->role_guru_bk) {
            $user->assignRole('guru_bk');
        } else {
            $user->removeRole('guru_bk');
        }

        if ($request->role_bendahara) {
            $user->assignRole('bendahara');
        } else {
            $user->removeRole('bendahara');
        }

        if ($request->role_proktor) {
            $user->assignRole('proktor');
        } else {
            $user->removeRole('proktor');
        }

        if ($request->role_ppdb) {
            $user->assignRole('ppdb');
        } else {
            $user->removeRole('ppdb');
        }

        if ($request->role_staff) {
            $user->assignRole('staff');
        } else {
            $user->removeRole('staff');
        }

        $user->save();

        Alert::success('Sukses', 'User berhasil diubah');
        return redirect()->route('back.user.staff.index');
    }

    public function staffDestroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $user = User::findOrFail($teacher->user_id);
        if ($teacher->photo) {
            Storage::delete($teacher->photo);
        }
        $teacher->delete();
        $user->delete();

        Alert::success('Sukses', 'User berhasil dihapus');
        return redirect()->route('back.user.staff.index');
    }

    public function staffImport(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xls,xlsx',
        ], [
            'required' => ':attribute harus diisi',
            'mimes' => 'File harus berupa excel',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            Excel::import(new TeacherImport, $request->file('file'));
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->back();
        }

        Alert::success('Sukses', 'Data guru berhasil diimport');
        return redirect()->route('back.user.staff.index');
    }

    public function staffExport()
    {
        return Excel::download(new TeacherExport, 'guru_' . date('YmdHis') . '.xlsx');
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
            if ($student->photo) {
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
        if ($student->photo) {
            Storage::delete($student->photo);
        }
        $student->delete();
        $user->delete();

        Alert::success('Sukses', 'Siswa berhasil dihapus');
        return redirect()->route('back.user.student.index');
    }

    public function studentImport(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xls,xlsx',
        ], [
            'required' => ':attribute harus diisi',
            'mimes' => 'File harus berupa excel',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            Excel::import(new StudentImport, $request->file('file'));
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->back();
        }

        Alert::success('Sukses', 'Data siswa berhasil diimport');
        return redirect()->route('back.user.student.index');
    }

    public function studentExport()
    {
        return Excel::download(new studentExport, 'siswa_' . date('YmdHis') . '.xlsx');
    }

    public function parent()
    {
        $data = [
            'title' => 'List Orang Tua',
            'menu' => 'User',
            'sub_menu' => 'Orang Tua',
            'users' => ParentStudent::latest()->get(),
        ];

        return view('back.pages.user.orang-tua.index', $data);
    }

    public function parentCreate()
    {
        $data = [
            'title' => 'Tambah Orang Tua',
            'menu' => 'user',
            'sub_menu' => 'Orang Tua',
            'list_student' => Student::all(),
        ];

        return view('back.pages.user.orang-tua.create', $data);
    }

    public function parentStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'nik' => 'nullable|unique:parent_student',
            'gender' => 'required',
            'no_telp' => 'nullable',
            'email' => 'nullable|email|unique:parent_student',
            'profession' => 'nullable',
            'student_id' => 'required',
            'password' => 'required|min:8',
        ], [
            'required' => ':attribute harus diisi',
            'unique' => ':attribute sudah terdaftar',
            'image' => 'File harus berupa gambar',
            'mimes' => 'File harus berupa gambar',
            'max' => 'Ukuran file maksimal 2MB',
            'email' => 'Email tidak valid',
            'min' => 'Password minimal 8 karakter',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->password = bcrypt($request->password);
        $user->save();
        $user->assignRole('orangtua');

        $parent = new ParentStudent();
        $parent->name = $request->name;
        $parent->nik = $request->nik;
        $parent->gender = $request->gender;
        $parent->no_telp = $request->no_telp;
        $parent->email = $request->email;
        $parent->profession = $request->profession;
        $parent->student_id = $request->student_id;

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $parent->photo = $image->storeAs('parent', date('YmdHis') . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension(), 'public');
        }

        $parent->user_id = $user->id;
        $parent->save();

        Alert::success('Sukses', 'Orang Tua berhasil ditambahkan');
        return redirect()->route('back.user.parent.index');
    }

    public function parentEdit($id)
    {
        $data = [
            'title' => 'Edit Orang Tua',
            'menu' => 'user',
            'sub_menu' => 'Orang Tua',
            'user' => ParentStudent::findOrFail($id),
            'list_student' => Student::all(),
        ];

        return view('back.pages.user.orang-tua.edit', $data);
    }

    public function parentUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'nik' => 'nullable|unique:parent_student,nik,' . $id,
            'gender' => 'required',
            'no_telp' => 'nullable',
            'email' => 'nullable|email',
            'profession' => 'nullable',
            'student_id' => 'required',
            'password' => 'nullable|min:8',
        ], [
            'required' => ':attribute harus diisi',
            'unique' => ':attribute sudah terdaftar',
            'image' => 'File harus berupa gambar',
            'mimes' => 'File harus berupa gambar',
            'max' => 'Ukuran file maksimal 2MB',
            'email' => 'Email tidak valid',
            'min' => 'Password minimal 8 karakter',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $parent = ParentStudent::findOrFail($id);
        $parent->name = $request->name;
        $parent->nik = $request->nik;
        $parent->gender = $request->gender;
        $parent->no_telp = $request->no_telp;
        $parent->email = $request->email;
        $parent->profession = $request->profession;
        $parent->student_id = $request->student_id;

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            if ($parent->photo) {
                Storage::delete($parent->photo);
            }
            $parent->photo = $image->storeAs('parent', date('YmdHis') . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension(), 'public');
        }

        $parent->save();

        $user = User::findOrFail($parent->user_id);
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();
        // $user->assignRole('orangtua');

        Alert::success('Sukses', 'Orang Tua berhasil diubah');
        return redirect()->route('back.user.parent.index');
    }

    public function parentDestroy($id)
    {
        $parent = ParentStudent::findOrFail($id);
        $user = User::findOrFail($parent->user_id);
        if ($parent->photo) {
            Storage::delete($parent->photo);
        }
        $parent->delete();
        $user->delete();

        Alert::success('Sukses', 'Orang Tua berhasil dihapus');
        return redirect()->route('back.user.parent.index');
    }

    public function parentImport(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xls,xlsx',
        ], [
            'required' => ':attribute harus diisi',
            'mimes' => 'File harus berupa excel',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            Excel::import(new ParentImport, $request->file('file'));
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->back();
        }

        Alert::success('Sukses', 'Data orang tua berhasil diimport');
        return redirect()->route('back.user.parent.index');
    }

    public function parentExport()
    {
        return Excel::download(new ParentExport, 'orang_tua_' . date('YmdHis') . '.xlsx');
    }

    public function profile()
    {
        $teacher = Teacher::findOrFail(Auth::user()->teacher->id);
        $data = [
            'title' =>  $teacher->name,
            'menu' => 'user',
            'sub_menu' => 'Profil',
            'user' => $teacher,
        ];

        return view('back.pages.user.guru.profile', $data);
    }

    public function profileUpdate(Request $request,)
    {
        $id = Auth::user()->teacher->id;
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'nip' => 'nullable',
            'nik' => 'nullable',
            'gender' => 'nullable',
            'birth_date' => 'nullable',
            'birth_place' => 'nullable',
            'no_telp' => 'nullable',
            'email' => 'nullable|email',
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
            'name.required' => 'Nama harus diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'photo.image' => 'File photo harus berupa gambar',
            'photo.mimes' => 'File photo harus berupa gambar',
            'photo.max' => 'Ukuran photo maksimal 2MB',
            'facebook.url' => 'URL Facebook tidak valid',
            'instagram.url' => 'URL Instagram tidak valid',
            'twitter.url' => 'URL Twitter tidak valid',
            'linkedin.url' => 'URL Linkedin tidak valid',
            'password.min' => 'Password minimal 8 karakter',

        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $teacher = Teacher::findOrFail($id);
        $teacher->name = $request->name;
        $teacher->nip = $request->nip;
        $teacher->nik = $request->nik;
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
        // $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }


        $user->save();

        Alert::success('Sukses', 'Profil berhasil diperbarui');
        return redirect()->route('back.user.staff.profile');
    }

    public function profileParent()
    {
        $teacher = ParentStudent::findOrFail(Auth::user()->parent->id);
        $data = [
            'title' =>  $teacher->name,
            'menu' => 'user',
            'sub_menu' => 'Profil',
            'user' => $teacher,
        ];

        return view('back.pages.user.orang-tua.profile', $data);
    }

    public function profileParentUpdate(Request $request)
    {
        $id = Auth::user()->parent->id;
        $validator = Validator::make($request->all(), [
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'nik' => 'nullable|unique:parent_student,nik,' . $id,
            'gender' => 'required',
            'no_telp' => 'nullable',
            'email' => 'nullable|email',
            'profession' => 'nullable',
            'password' => 'nullable|min:8',
        ], [
            'required' => ':attribute harus diisi',
            'unique' => ':attribute sudah terdaftar',
            'image' => 'File harus berupa gambar',
            'mimes' => 'File harus berupa gambar',
            'max' => 'Ukuran file maksimal 2MB',
            'email' => 'Email tidak valid',
            'min' => 'Password minimal 8 karakter',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $parent = ParentStudent::findOrFail($id);
        $parent->name = $request->name;
        $parent->nik = $request->nik;
        $parent->gender = $request->gender;
        $parent->no_telp = $request->no_telp;
        $parent->email = $request->email;
        $parent->profession = $request->profession;

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            if ($parent->photo) {
                Storage::delete($parent->photo);
            }
            $parent->photo = $image->storeAs('parent', date('YmdHis') . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension(), 'public');
        }

        $parent->save();

        $user = User::findOrFail($parent->user_id);
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();
        // $user->assignRole('orangtua');

        Alert::success('Sukses', 'Profile berhasil diubah');
        return redirect()->back();
    }


    public function profileStudent()
    {
        $student = Student::findOrFail(Auth::user()->student->id);
        $data = [
            'title' =>  $student->name,
            'menu' => 'user',
            'sub_menu' => 'Profil',
            'user' => $student,
        ];

        return view('back.pages.user.siswa.profile', $data);
    }

    public function profileStudentUpdate(Request $request)
    {
        $id = Auth::user()->student->id;
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
            'email' => 'nullable|email',
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
            if ($student->photo) {
                Storage::delete($student->photo);
            }
            $student->photo = $image->storeAs('student', date('YmdHis') . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension(), 'public');
        }

        $student->save();

        $user = User::findOrFail($student->user_id);
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        Alert::success('Sukses', 'Profile berhasil diubah');
        return redirect()->back();
    }



}
