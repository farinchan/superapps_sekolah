<?php

namespace App\Http\Controllers\PPDB;

use App\Http\Controllers\Controller;
use App\Models\ppdb_user;
use App\Models\PpdbUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register()
    {
        $data = [
            'menu' => 'PPDB',
            'submenu' => 'Form Pendaftaran',
            'page_title' => 'Formulir Pendftaran Peserta didik Baru',
            'page_description' => 'Silakan isi form pendaftaran berikut untuk mendaftar PPDB'
        ];
        return view('ppdb.pages.auth.register', $data);
    }

    public function registerProcess(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'nisn' => 'required|unique:ppdb_user,nisn',
            'name' => 'required|string|max:255',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'school_origin' => 'required|max:255',
            'npsn' => 'required|max:255',
            'whatsapp_number' => 'required|max:255',
            'address' => 'required',
            'email' => 'nullable|email',
            'password' => 'required|min:8',
            'no_kk' => 'required|max:255',
            'nik' => 'required|max:255',
            'mother_nik' => 'required|max:255',
            'mother_name' => 'required|string|max:255',
            'mother_phone_number' => 'required|max:255',
            'father_nik' => 'required|max:255',
            'father_name' => 'required|string|max:255',
            'father_phone_number' => 'required|max:255',
            'rapor_semester_1' => 'required|max:255',
            'rapor_semester_2' => 'required|max:255',
            'rapor_semester_3' => 'required|max:255',
            'rapor_semester_4' => 'required|max:255',
            'rapor_semester_5' => 'required|max:255',
            'screenshoot_nisn' => 'required|mimes:pdf,jpg,jpeg,png|max:10240',
            'certificates' => 'array',
            'certificates.*.certificate_name' => 'nullable',
            'certificates.*.certificate_file' => 'nullable|mimes:pdf,jpg,jpeg,png|max:10240',
            'additional_data' => 'array'

        ], [
            'required' => ':attribute harus diisi',
            'unique' => ':attribute sudah terdaftar',
            'email' => ':attribute tidak valid',
            'min' => ':attribute minimal :min karakter',
            'date' => ':attribute harus berupa tanggal',
            'max' => ':attribute maksimal :max karakter',
            'string' => ':attribute harus berupa huruf',
            'mimes' => ':attribute harus berupa file :values',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new PpdbUser();
        $user->nisn = $request->nisn;
        $user->name = $request->name;
        $user->birth_place = $request->birth_place;
        $user->birth_date = $request->birth_date;
        $user->school_origin = $request->school_origin;
        $user->npsn = $request->npsn;
        $user->whatsapp_number = $request->whatsapp_number;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->no_kk = $request->no_kk;
        $user->nik = $request->nik;
        $user->mother_nik = $request->mother_nik;
        $user->mother_name = $request->mother_name;
        $user->mother_phone_number = $request->mother_phone_number;
        $user->father_nik = $request->father_nik;
        $user->father_name = $request->father_name;
        $user->father_phone_number = $request->father_phone_number;
        $user->rapor_semester_1 = $request->rapor_semester_1;
        $user->rapor_semester_2 = $request->rapor_semester_2;
        $user->rapor_semester_3 = $request->rapor_semester_3;
        $user->rapor_semester_4 = $request->rapor_semester_4;
        $user->rapor_semester_5 = $request->rapor_semester_5;
        if ($request->hasFile('screenshoot_nisn')) {
            $file = $request->file('screenshoot_nisn');
            $path = $file->storeAs('ppdb/screenshoot_nisn', Str::slug($request->nisn) . '-' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension(), 'public');
            $user->screenshoot_nisn = $path;
        }
        $user->additional_data = $request->additional_data;
        $user->save();

        if ($request->certificates) {
            foreach ($request->certificates as $certificate) {
                if (!isset($certificate['certificate_file']) ) {
                    continue;
                }
                $certificateName = $certificate['certificate_name'];
                $certificateFile = $certificate['certificate_file'];
                $certificatePath = $certificateFile->storeAs('ppdb/certificates', Str::slug($request->nisn) . '-' . Str::random(10) . '.' . $certificateFile->getClientOriginalExtension(), 'public');
                $user->sertifikat()->create([
                    'ppdb_user_id' => $user->id,
                    'name' => Str::limit($certificateName, 250),
                    'path' => $certificatePath
                ]);
            }
        }

        Alert::success('Berhasil', 'Pendaftaran berhasil');
        return redirect()->route('ppdb.login');
    }

    public function login()
    {
        $data = [
            'menu' => 'PPDB',
            'submenu' => 'Login',
            'page_title' => 'Login ',
            'page_description' => 'Silakan Masuk untuk melanjutkan'
        ];
        return view('ppdb.pages.auth.login', $data);
    }

    public function loginProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nisn' => 'required',
            'password' => 'required'
        ], [
            'required' => ':attribute harus diisi'
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('nisn', 'password');
        if (Auth::guard('ppdb')->attempt($credentials)) {
            return redirect()->route('ppdb.dashboard');
        }

        Alert::error('Gagal', 'NISN atau password salah');
        return redirect()->back();
    }

    public function logout()
    {
        Auth::guard('ppdb')->logout();
        return redirect()->route('ppdb.login');
    }
}
