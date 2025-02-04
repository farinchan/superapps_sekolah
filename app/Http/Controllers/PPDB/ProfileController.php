<?php

namespace App\Http\Controllers\PPDB;

use App\Http\Controllers\Controller;
use App\Models\PpdbUser;
use App\Models\PpdbUserRapor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;


class ProfileController extends Controller
{
    public function myData()
    {
        $data = [
            'menu' => 'PPDB',
            'submenu' => 'Profile',
            'page_title' => 'Profile',
            'page_description' => 'Data diri anda',
            'user' => Auth::guard('ppdb')->user()
        ];
        // return response()->json($data);
        return view('ppdb.pages.back.profile-update.my-data', $data);
    }

    public function myDataUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nisn' => 'required|unique:ppdb_user,nisn,' . Auth::guard('ppdb')->user()->id,
            'name' => 'required|string|max:255',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'school_origin' => 'required|max:255',
            'npsn' => 'required|max:255',
            'whatsapp_number' => 'required|max:255',
            'address' => 'required',
            'email' => 'nullable|email',
            'password' => 'nullable|min:8'
        ], [
            'required' => ':attribute harus diisi',
            'unique' => ':attribute sudah terdaftar',
            'email' => ':attribute harus berupa email',
            'min' => ':attribute minimal :min karakter'
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = PpdbUser::find(Auth::guard('ppdb')->user()->id);
        $user->nisn = $request->nisn;
        $user->name = $request->name;
        $user->birth_place = $request->birth_place;
        $user->birth_date = $request->birth_date;
        $user->school_origin = $request->school_origin;
        $user->npsn = $request->npsn;
        $user->whatsapp_number = $request->whatsapp_number;
        $user->address = $request->address;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        Alert::success('Berhasil', 'Data berhasil diupdate');
        return redirect()->back();

    }

    public function parentData()
    {
        $data = [
            'menu' => 'PPDB',
            'submenu' => 'Profile',
            'page_title' => 'Profile',
            'page_description' => 'Data orang tua anda',
            'user' => Auth::guard('ppdb')->user()
        ];
        // return response()->json($data);
        return view('ppdb.pages.back.profile-update.parent-data', $data);
    }

    public function parentDataUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_kk' => 'required|max:255',
            'nik' => 'required|max:255',
            'mother_nik' => 'required|max:255',
            'mother_name' => 'required|string|max:255',
            'mother_phone_number' => 'required|max:255',
            'father_nik' => 'required|max:255',
            'father_name' => 'required|string|max:255',
            'father_phone_number' => 'required|max:255',
        ], [
            'required' => ':attribute harus diisi',
            'max' => ':attribute maksimal :max karakter',
            'string' => ':attribute harus berupa huruf'
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = PpdbUser::find(Auth::guard('ppdb')->user()->id);
        $user->no_kk = $request->no_kk;
        $user->nik = $request->nik;
        $user->mother_nik = $request->mother_nik;
        $user->mother_name = $request->mother_name;
        $user->mother_phone_number = $request->mother_phone_number;
        $user->father_nik = $request->father_nik;
        $user->father_name = $request->father_name;
        $user->father_phone_number = $request->father_phone_number;
        $user->save();

        Alert::success('Berhasil', 'Data berhasil diupdate');
        return redirect()->back();
    }

    public function otherData()
    {
        $rapor = PpdbUserRapor::where('ppdb_user_id', Auth::guard('ppdb')->user()->id)->first();
        $data = [
            'menu' => 'PPDB',
            'submenu' => 'Profile',
            'page_title' => 'Profile',
            'page_description' => 'Data lainnya',
            'user' => Auth::guard('ppdb')->user(),
            'rapor' =>$rapor,
            'sem1_ipa' => collect($rapor->semester1_nilai)->firstWhere('mapel', 'Ilmu Pengetahuan Alam (IPA)')['nilai'] ?? 0,
            'sem1_ips' => collect($rapor->semester1_nilai)->firstWhere('mapel', 'Ilmu Pengetahuan Sosial (IPS)')['nilai'] ?? 0,
            'sem1_indonesia' => collect($rapor->semester1_nilai)->firstWhere('mapel', 'Bahasa Indonesia')['nilai'] ?? 0,
            'sem1_inggris' => collect($rapor->semester1_nilai)->firstWhere('mapel', 'Bahasa Inggris')['nilai'] ?? 0,
            'sem1_matematika' => collect($rapor->semester1_nilai)->firstWhere('mapel', 'Matematika')['nilai'] ?? 0,
            'sem1_agama' => collect($rapor->semester1_nilai)->firstWhere('mapel', 'Pendidikan Agama Islam')['nilai'] ?? 0,
            'sem1_qhadits' => collect($rapor->semester1_nilai)->firstWhere('mapel', 'Al-qur\'an Hadits')['nilai'] ?? 0,
            'sem1_akidah' => collect($rapor->semester1_nilai)->firstWhere('mapel', 'Akidah Akhlak')['nilai'] ?? 0,
            'sem1_fiqih' => collect($rapor->semester1_nilai)->firstWhere('mapel', 'Fiqih')['nilai'] ?? 0,
            'sem1_ski' => collect($rapor->semester1_nilai)->firstWhere('mapel', 'Sejarah Kebudayaan Islam (SKI)')['nilai'] ?? 0,

            'sem2_ipa' => collect($rapor->semester2_nilai)->firstWhere('mapel', 'Ilmu Pengetahuan Alam (IPA)')['nilai'] ?? 0,
            'sem2_ips' => collect($rapor->semester2_nilai)->firstWhere('mapel', 'Ilmu Pengetahuan Sosial (IPS)')['nilai'] ?? 0,
            'sem2_indonesia' => collect($rapor->semester2_nilai)->firstWhere('mapel', 'Bahasa Indonesia')['nilai'] ?? 0,
            'sem2_inggris' => collect($rapor->semester2_nilai)->firstWhere('mapel', 'Bahasa Inggris')['nilai'] ?? 0,
            'sem2_matematika' => collect($rapor->semester2_nilai)->firstWhere('mapel', 'Matematika')['nilai'] ?? 0,
            'sem2_agama' => collect($rapor->semester2_nilai)->firstWhere('mapel', 'Pendidikan Agama Islam')['nilai'] ?? 0,
            'sem2_qhadits' => collect($rapor->semester2_nilai)->firstWhere('mapel', 'Al-qur\'an Hadits')['nilai'] ?? 0,
            'sem2_akidah' => collect($rapor->semester2_nilai)->firstWhere('mapel', 'Akidah Akhlak')['nilai'] ?? 0,
            'sem2_fiqih' => collect($rapor->semester2_nilai)->firstWhere('mapel', 'Fiqih')['nilai'] ?? 0,
            'sem2_ski' => collect($rapor->semester2_nilai)->firstWhere('mapel', 'Sejarah Kebudayaan Islam (SKI)')['nilai'] ?? 0,

            'sem3_ipa' => collect($rapor->semester3_nilai)->firstWhere('mapel', 'Ilmu Pengetahuan Alam (IPA)')['nilai'] ?? 0,
            'sem3_ips' => collect($rapor->semester3_nilai)->firstWhere('mapel', 'Ilmu Pengetahuan Sosial (IPS)')['nilai'] ?? 0,
            'sem3_indonesia' => collect($rapor->semester3_nilai)->firstWhere('mapel', 'Bahasa Indonesia')['nilai'] ?? 0,
            'sem3_inggris' => collect($rapor->semester3_nilai)->firstWhere('mapel', 'Bahasa Inggris')['nilai'] ?? 0,
            'sem3_matematika' => collect($rapor->semester3_nilai)->firstWhere('mapel', 'Matematika')['nilai'] ?? 0,
            'sem3_agama' => collect($rapor->semester3_nilai)->firstWhere('mapel', 'Pendidikan Agama Islam')['nilai'] ?? 0,
            'sem3_qhadits' => collect($rapor->semester3_nilai)->firstWhere('mapel', 'Al-qur\'an Hadits')['nilai'] ?? 0,
            'sem3_akidah' => collect($rapor->semester3_nilai)->firstWhere('mapel', 'Akidah Akhlak')['nilai'] ?? 0,
            'sem3_fiqih' => collect($rapor->semester3_nilai)->firstWhere('mapel', 'Fiqih')['nilai'] ?? 0,
            'sem3_ski' => collect($rapor->semester3_nilai)->firstWhere('mapel', 'Sejarah Kebudayaan Islam (SKI)')['nilai'] ?? 0,

            'sem4_ipa' => collect($rapor->semester4_nilai)->firstWhere('mapel', 'Ilmu Pengetahuan Alam (IPA)')['nilai'] ?? 0,
            'sem4_ips' => collect($rapor->semester4_nilai)->firstWhere('mapel', 'Ilmu Pengetahuan Sosial (IPS)')['nilai'] ?? 0,
            'sem4_indonesia' => collect($rapor->semester4_nilai)->firstWhere('mapel', 'Bahasa Indonesia')['nilai'] ?? 0,
            'sem4_inggris' => collect($rapor->semester4_nilai)->firstWhere('mapel', 'Bahasa Inggris')['nilai'] ?? 0,
            'sem4_matematika' => collect($rapor->semester4_nilai)->firstWhere('mapel', 'Matematika')['nilai'] ?? 0,
            'sem4_agama' => collect($rapor->semester4_nilai)->firstWhere('mapel', 'Pendidikan Agama Islam')['nilai'] ?? 0,
            'sem4_qhadits' => collect($rapor->semester4_nilai)->firstWhere('mapel', 'Al-qur\'an Hadits')['nilai'] ?? 0,
            'sem4_akidah' => collect($rapor->semester4_nilai)->firstWhere('mapel', 'Akidah Akhlak')['nilai'] ?? 0,
            'sem4_fiqih' => collect($rapor->semester4_nilai)->firstWhere('mapel', 'Fiqih')['nilai'] ?? 0,
            'sem4_ski' => collect($rapor->semester4_nilai)->firstWhere('mapel', 'Sejarah Kebudayaan Islam (SKI)')['nilai'] ?? 0,

            'sem5_ipa' => collect($rapor->semester5_nilai)->firstWhere('mapel', 'Ilmu Pengetahuan Alam (IPA)')['nilai'] ?? 0,
            'sem5_ips' => collect($rapor->semester5_nilai)->firstWhere('mapel', 'Ilmu Pengetahuan Sosial (IPS)')['nilai'] ?? 0,
            'sem5_indonesia' => collect($rapor->semester5_nilai)->firstWhere('mapel', 'Bahasa Indonesia')['nilai'] ?? 0,
            'sem5_inggris' => collect($rapor->semester5_nilai)->firstWhere('mapel', 'Bahasa Inggris')['nilai'] ?? 0,
            'sem5_matematika' => collect($rapor->semester5_nilai)->firstWhere('mapel', 'Matematika')['nilai'] ?? 0,
            'sem5_agama' => collect($rapor->semester5_nilai)->firstWhere('mapel', 'Pendidikan Agama Islam')['nilai'] ?? 0,
            'sem5_qhadits' => collect($rapor->semester5_nilai)->firstWhere('mapel', 'Al-qur\'an Hadits')['nilai'] ?? 0,
            'sem5_akidah' => collect($rapor->semester5_nilai)->firstWhere('mapel', 'Akidah Akhlak')['nilai'] ?? 0,
            'sem5_fiqih' => collect($rapor->semester5_nilai)->firstWhere('mapel', 'Fiqih')['nilai'] ?? 0,
            'sem5_ski' => collect($rapor->semester5_nilai)->firstWhere('mapel', 'Sejarah Kebudayaan Islam (SKI)')['nilai'] ?? 0
        ];
        // return response()->json($data);
        return view('ppdb.pages.back.profile-update.other-data', $data);
    }

    public function otherDataUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rapor_type' => 'required|in:SMP,MTS',
            'sem1_ipa' => 'required|numeric',
            'sem1_ips' => 'required|numeric',
            'sem1_indonesia' => 'required|numeric',
            'sem1_inggris' => 'required|numeric',
            'sem1_matematika' => 'required|numeric',
            'sem1_file' => 'required|mimes:pdf,jpg,jpeg,png|max:10240',
            'sem2_ipa' => 'required|numeric',
            'sem2_ips' => 'required|numeric',
            'sem2_indonesia' => 'required|numeric',
            'sem2_inggris' => 'required|numeric',
            'sem2_matematika' => 'required|numeric',
            'sem2_file' => 'required|mimes:pdf,jpg,jpeg,png|max:10240',
            'sem3_ipa' => 'required|numeric',
            'sem3_ips' => 'required|numeric',
            'sem3_indonesia' => 'required|numeric',
            'sem3_inggris' => 'required|numeric',
            'sem3_matematika' => 'required|numeric',
            'sem3_file' => 'required|mimes:pdf,jpg,jpeg,png|max:10240',
            'sem4_ipa' => 'required|numeric',
            'sem4_ips' => 'required|numeric',
            'sem4_indonesia' => 'required|numeric',
            'sem4_inggris' => 'required|numeric',
            'sem4_matematika' => 'required|numeric',
            'sem4_file' => 'required|mimes:pdf,jpg,jpeg,png|max:10240',
            'sem5_ipa' => 'required|numeric',
            'sem5_ips' => 'required|numeric',
            'sem5_indonesia' => 'required|numeric',
            'sem5_inggris' => 'required|numeric',
            'sem5_matematika' => 'required|numeric',
            'sem5_file' => 'required|mimes:pdf,jpg,jpeg,png|max:10240',

            'screenshoot_nisn' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'certificates.*.certificate_name' => 'required',
            'certificates.*.certificate_file' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'required' => ':attribute harus diisi',
            'numeric' => ':attribute harus berupa angka',
            'image' => ':attribute harus berupa gambar',
            'mimes' => ':attribute harus berupa gambar dengan format jpeg, png, jpg',
            'max' => ':attribute maksimal :max KB'
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = PpdbUser::find(Auth::guard('ppdb')->user()->id);
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
        $user->save();

        if ($request->certificates) {
            foreach ($request->certificates as $certificate) {
                if (!isset($certificate['certificate_file']) || !$certificate['certificate_name']) {
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

        Alert::success('Berhasil', 'Data berhasil diupdate');
        return redirect()->back();

    }
}
