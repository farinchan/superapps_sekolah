<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
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

        return view('back.pages.user.guru', $data);
    }

    public function staffCreate()
    {
        $data = [
            'title' => 'Tambah user',
            'menu' => 'user',
            'sub_menu' => 'user',
        ];

        return view('back.pages.user.create', $data);
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

        return view('back.pages.user.edit', $data);
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
            Storage::disk('public')->delete($teacher->photo);
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


}
