<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'List Anggota Aktif',
            'menu' => 'Anggota',
            'sub_menu' => '',
            'users' => User::where('status', 1)->get()
        ];
        return view('back.pages.user.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Anggota',
            'menu' => 'Anggota',
            'sub_menu' => '',
        ];
        return view('back.pages.user.create', $data);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'gender' => 'required',
            'place_of_birth' => 'required',
            'birth_date' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'job' => 'required',
            'kepakaran' => 'nullable',
            'keanggotaan' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ],[
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute sudah terdaftar',
            'email' => ':attribute tidak valid',
            'min' => ':attribute minimal :min karakter',
            'image' => ':attribute harus berupa gambar',
            'mimes' => 'Format file harus :values',
            'max' => 'Ukuran file maksimal :max KB',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $user = new User();
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoPath = $photo->storeAs('public/anggota', date('YmdHis') . '_' . Str::slug($request->name) . '.' . $photo->getClientOriginalExtension());
            $user->photo = str_replace('public/', '', $photoPath);
        }
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->place_of_birth = $request->place_of_birth;
        $user->birth_date = $request->birth_date;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->job = json_encode($request->job);
        $user->kepakaran = $request->kepakaran;
        $user->keanggotaan = $request->keanggotaan;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->status = 1;
        $user->save();

        if ($request->role_user) {
            $user->assignRole("user");
        }

        if ($request->role_admin) {
            $user->assignRole("admin");
        }

        try {
            Mail::send('email.create_user', ['user' => $user], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Anda telah terdaftar sebagai anggota');
            });

        } catch (\Exception $e) {
            // Alert::error('Error', 'Gagal mengirim email');
            // return redirect()->back();
        }

        Alert::success('Success', 'Anggota berhasil ditambahkan');
        return redirect()->route('back.user.index');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Anggota',
            'menu' => 'Anggota',
            'sub_menu' => '',
            'user' => User::find($id)
        ];

        return view('back.pages.user.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'gender' => 'required',
            'place_of_birth' => 'required',
            'birth_date' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'job' => 'required',
            'kepakaran' => 'nullable',
            'keanggotaan' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ],[
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute sudah terdaftar',
            'email' => ':attribute tidak valid',
            'image' => ':attribute harus berupa gambar',
            'mimes' => 'Format file harus :values',
            'max' => 'Ukuran file maksimal :max KB',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $user = User::find($id);
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoPath = $photo->storeAs('public/anggota', date('YmdHis') . '_' . Str::slug($request->name) . '.' . $photo->getClientOriginalExtension());
            $user->photo = str_replace('public/', '', $photoPath);
        }

        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->place_of_birth = $request->place_of_birth;
        $user->birth_date = $request->birth_date;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->job = json_encode($request->job);
        $user->kepakaran = $request->kepakaran;
        $user->keanggotaan = $request->keanggotaan;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        if ($request->role_user) {
            $user->assignRole("user");
        } else {
            $user->removeRole("user");
        }

        if ($request->role_admin) {
            $user->assignRole("admin");
        } else {
            $user->removeRole("admin");
        }


        Alert::success('Success', 'Anggota berhasil diubah');
        return redirect()->route('back.user.index');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        Storage::delete('public/' . $user->photo);
        $user->delete();

        Alert::success('Success', 'Anggota berhasil dihapus');
        return redirect()->route('back.user.index');
    }


    public function register()
    {
        $data = [
            'title' => 'List Pendaftar',
            'menu' => 'Anggota',
            'sub_menu' => '',
            'users' => User::where('status', 0)->get()
        ];
        return view('back.pages.user.regis', $data);
    }

    public function registerApprove($id)
    {
        $user = User::find($id);
        $user->status = 1;
        $user->save();

        try {
            Mail::send('email.register_approved_mail', ['user' => $user], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Permintaan Pendaftaran anda diterima');
            });

        } catch (\Exception $e) {
            // Alert::error('Error', 'Gagal mengirim email');
            // return redirect()->back();
        }

        Alert::success('Success', 'Pendaftar berhasil diaktifkan');
        return redirect()->route('back.user.register');
    }
}
