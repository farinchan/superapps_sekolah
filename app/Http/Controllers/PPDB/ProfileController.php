<?php

namespace App\Http\Controllers\PPDB;

use App\Http\Controllers\Controller;
use App\Models\PpdbRegistrationUser;
use App\Models\PpdbUser;
use App\Models\PpdbUserCertificate;
use App\Models\PpdbUserRapor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
            'path_select_perbaiki' => PpdbRegistrationUser::where('ppdb_user_id', Auth::guard('ppdb')->user()->id)->where('status_berkas', 'perbaiki')->first() ? true : false,
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
            'path_select_perbaiki' => PpdbRegistrationUser::where('ppdb_user_id', Auth::guard('ppdb')->user()->id)->where('status_berkas', 'perbaiki')->first() ? true : false,
            'user' => Auth::guard('ppdb')->user(),
            'certificates' => PpdbUserCertificate::where('ppdb_user_id', Auth::guard('ppdb')->user()->id)->get(),
            'rapor' => $rapor,
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
        // dd($request->all());
        $validator_rule = [
            'rapor_type' => 'required|in:SMP,MTS',
            'sem1_ipa' => 'required|numeric',
            'sem1_ips' => 'required|numeric',
            'sem1_indonesia' => 'required|numeric',
            'sem1_inggris' => 'required|numeric',
            'sem1_matematika' => 'required|numeric',
            'sem1_file' => 'nullable|mimes:pdf,jpg,jpeg,png|max:10240',
            'sem2_ipa' => 'required|numeric',
            'sem2_ips' => 'required|numeric',
            'sem2_indonesia' => 'required|numeric',
            'sem2_inggris' => 'required|numeric',
            'sem2_matematika' => 'required|numeric',
            'sem2_file' => 'nullable|mimes:pdf,jpg,jpeg,png|max:10240',
            'sem3_ipa' => 'required|numeric',
            'sem3_ips' => 'required|numeric',
            'sem3_indonesia' => 'required|numeric',
            'sem3_inggris' => 'required|numeric',
            'sem3_matematika' => 'required|numeric',
            'sem3_file' => 'nullable|mimes:pdf,jpg,jpeg,png|max:10240',
            'sem4_ipa' => 'required|numeric',
            'sem4_ips' => 'required|numeric',
            'sem4_indonesia' => 'required|numeric',
            'sem4_inggris' => 'required|numeric',
            'sem4_matematika' => 'required|numeric',
            'sem4_file' => 'nullable|mimes:pdf,jpg,jpeg,png|max:10240',
            'sem5_ipa' => 'required|numeric',
            'sem5_ips' => 'required|numeric',
            'sem5_indonesia' => 'required|numeric',
            'sem5_inggris' => 'required|numeric',
            'sem5_matematika' => 'required|numeric',
            'sem5_file' => 'nullable|mimes:pdf,jpg,jpeg,png|max:10240',

            'screenshoot_nisn' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'certificates' => 'array',
            'certificates.*.certificate_name' => 'nullable',
            'certificates.*.certificate_rank' => 'nullable',
            'certificates.*.certificate_file' => 'nullable|mimes:pdf,jpg,jpeg,png|max:10240',
        ];
        if ($request->rapor_type == 'SMP') {
            $validator_rule = array_merge($validator_rule, [
                'sem1_agama' => 'required|numeric',
                'sem2_agama' => 'required|numeric',
                'sem3_agama' => 'required|numeric',
                'sem4_agama' => 'required|numeric',
                'sem5_agama' => 'required|numeric',
            ]);
        } else {
            $validator_rule = array_merge($validator_rule, [
                'sem1_qhadits' => 'required|numeric',
                'sem1_akidah' => 'required|numeric',
                'sem1_fiqih' => 'required|numeric',
                'sem1_ski' => 'required|numeric',
                'sem2_qhadits' => 'required|numeric',
                'sem2_akidah' => 'required|numeric',
                'sem2_fiqih' => 'required|numeric',
                'sem2_ski' => 'required|numeric',
                'sem3_qhadits' => 'required|numeric',
                'sem3_akidah' => 'required|numeric',
                'sem3_fiqih' => 'required|numeric',
                'sem3_ski' => 'required|numeric',
                'sem4_qhadits' => 'required|numeric',
                'sem4_akidah' => 'required|numeric',
                'sem4_fiqih' => 'required|numeric',
                'sem4_ski' => 'required|numeric',
                'sem5_qhadits' => 'required|numeric',
                'sem5_akidah' => 'required|numeric',
                'sem5_fiqih' => 'required|numeric',
                'sem5_ski' => 'required|numeric',

            ]);
        }
        $validator = Validator::make(
            $request->all(),
            $validator_rule,
            [
                'required' => ':attribute harus diisi',
                'numeric' => ':attribute harus berupa angka',
                'image' => ':attribute harus berupa gambar',
                'mimes' => ':attribute harus berupa gambar dengan format jpeg, png, jpg',
                'max' => ':attribute maksimal :max KB',
                'in' => ':attribute harus diisi dengan SMP atau MTS'
            ]
        );

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user_rapor = PpdbUserRapor::where('ppdb_user_id', Auth::guard('ppdb')->user()->id)->first();
        $user_rapor->rapor_type = $request->rapor_type;
        if ($request->rapor_type == 'SMP') {
            $semester1_nilai = [
                [
                    'mapel' => 'Ilmu Pengetahuan Alam (IPA)',
                    'nilai' => $request->sem1_ipa
                ],
                [
                    'mapel' => 'Ilmu Pengetahuan Sosial (IPS)',
                    'nilai' => $request->sem1_ips
                ],
                [
                    'mapel' => 'Bahasa Indonesia',
                    'nilai' => $request->sem1_indonesia
                ],
                [
                    'mapel' => 'Bahasa Inggris',
                    'nilai' => $request->sem1_inggris
                ],
                [
                    'mapel' => 'Matematika',
                    'nilai' => $request->sem1_matematika
                ],
                [
                    'mapel' => 'Pendidikan Agama Islam',
                    'nilai' => $request->sem1_agama
                ]
            ];
            $semester2_nilai = [
                [
                    'mapel' => 'Ilmu Pengetahuan Alam (IPA)',
                    'nilai' => $request->sem2_ipa
                ],
                [
                    'mapel' => 'Ilmu Pengetahuan Sosial (IPS)',
                    'nilai' => $request->sem2_ips
                ],
                [
                    'mapel' => 'Bahasa Indonesia',
                    'nilai' => $request->sem2_indonesia
                ],
                [
                    'mapel' => 'Bahasa Inggris',
                    'nilai' => $request->sem2_inggris
                ],
                [
                    'mapel' => 'Matematika',
                    'nilai' => $request->sem2_matematika
                ],
                [
                    'mapel' => 'Pendidikan Agama Islam',
                    'nilai' => $request->sem2_agama
                ]
            ];
            $semester3_nilai = [
                [
                    'mapel' => 'Ilmu Pengetahuan Alam (IPA)',
                    'nilai' => $request->sem3_ipa
                ],
                [
                    'mapel' => 'Ilmu Pengetahuan Sosial (IPS)',
                    'nilai' => $request->sem3_ips
                ],
                [
                    'mapel' => 'Bahasa Indonesia',
                    'nilai' => $request->sem3_indonesia
                ],
                [
                    'mapel' => 'Bahasa Inggris',
                    'nilai' => $request->sem3_inggris
                ],
                [
                    'mapel' => 'Matematika',
                    'nilai' => $request->sem3_matematika
                ],
                [
                    'mapel' => 'Pendidikan Agama Islam',
                    'nilai' => $request->sem3_agama
                ]
            ];
            $semester4_nilai = [
                [
                    'mapel' => 'Ilmu Pengetahuan Alam (IPA)',
                    'nilai' => $request->sem4_ipa
                ],
                [
                    'mapel' => 'Ilmu Pengetahuan Sosial (IPS)',
                    'nilai' => $request->sem4_ips
                ],
                [
                    'mapel' => 'Bahasa Indonesia',
                    'nilai' => $request->sem4_indonesia
                ],
                [
                    'mapel' => 'Bahasa Inggris',
                    'nilai' => $request->sem4_inggris
                ],
                [
                    'mapel' => 'Matematika',
                    'nilai' => $request->sem4_matematika
                ],
                [
                    'mapel' => 'Pendidikan Agama Islam',
                    'nilai' => $request->sem4_agama
                ]
            ];
            $semester5_nilai = [
                [
                    'mapel' => 'Ilmu Pengetahuan Alam (IPA)',
                    'nilai' => $request->sem5_ipa
                ],
                [
                    'mapel' => 'Ilmu Pengetahuan Sosial (IPS)',
                    'nilai' => $request->sem5_ips
                ],
                [
                    'mapel' => 'Bahasa Indonesia',
                    'nilai' => $request->sem5_indonesia
                ],
                [
                    'mapel' => 'Bahasa Inggris',
                    'nilai' => $request->sem5_inggris
                ],
                [
                    'mapel' => 'Matematika',
                    'nilai' => $request->sem5_matematika
                ],
                [
                    'mapel' => 'Pendidikan Agama Islam',
                    'nilai' => $request->sem5_agama
                ]
            ];
            $user_rapor->semester1_nilai = $semester1_nilai;
            $user_rapor->semester2_nilai = $semester2_nilai;
            $user_rapor->semester3_nilai = $semester3_nilai;
            $user_rapor->semester4_nilai = $semester4_nilai;
            $user_rapor->semester5_nilai = $semester5_nilai;
        } else {
            $semester1_nilai = [
                [
                    'mapel' => 'Ilmu Pengetahuan Alam (IPA)',
                    'nilai' => $request->sem1_ipa
                ],
                [
                    'mapel' => 'Ilmu Pengetahuan Sosial (IPS)',
                    'nilai' => $request->sem1_ips
                ],
                [
                    'mapel' => 'Bahasa Indonesia',
                    'nilai' => $request->sem1_indonesia
                ],
                [
                    'mapel' => 'Bahasa Inggris',
                    'nilai' => $request->sem1_inggris
                ],
                [
                    'mapel' => 'Matematika',
                    'nilai' => $request->sem1_matematika
                ],
                [
                    'mapel' => 'Al-qur\'an Hadits',
                    'nilai' => $request->sem1_qhadits
                ],
                [
                    'mapel' => 'Akidah Akhlak',
                    'nilai' => $request->sem1_akidah
                ],
                [
                    'mapel' => 'Fiqih',
                    'nilai' => $request->sem1_fiqih
                ],
                [
                    'mapel' => 'Sejarah Kebudayaan Islam (SKI)',
                    'nilai' => $request->sem1_ski
                ]
            ];
            $semester2_nilai = [
                [
                    'mapel' => 'Ilmu Pengetahuan Alam (IPA)',
                    'nilai' => $request->sem2_ipa
                ],
                [
                    'mapel' => 'Ilmu Pengetahuan Sosial (IPS)',
                    'nilai' => $request->sem2_ips
                ],
                [
                    'mapel' => 'Bahasa Indonesia',
                    'nilai' => $request->sem2_indonesia
                ],
                [
                    'mapel' => 'Bahasa Inggris',
                    'nilai' => $request->sem2_inggris
                ],
                [
                    'mapel' => 'Matematika',
                    'nilai' => $request->sem2_matematika
                ],
                [
                    'mapel' => 'Al-qur\'an Hadits',
                    'nilai' => $request->sem2_qhadits
                ],
                [
                    'mapel' => 'Akidah Akhlak',
                    'nilai' => $request->sem2_akidah
                ],
                [
                    'mapel' => 'Fiqih',
                    'nilai' => $request->sem2_fiqih
                ],
                [
                    'mapel' => 'Sejarah Kebudayaan Islam (SKI)',
                    'nilai' => $request->sem2_ski
                ]
            ];
            $semester3_nilai = [
                [
                    'mapel' => 'Ilmu Pengetahuan Alam (IPA)',
                    'nilai' => $request->sem3_ipa
                ],
                [
                    'mapel' => 'Ilmu Pengetahuan Sosial (IPS)',
                    'nilai' => $request->sem3_ips
                ],
                [
                    'mapel' => 'Bahasa Indonesia',
                    'nilai' => $request->sem3_indonesia
                ],
                [
                    'mapel' => 'Bahasa Inggris',
                    'nilai' => $request->sem3_inggris
                ],
                [
                    'mapel' => 'Matematika',
                    'nilai' => $request->sem3_matematika
                ],
                [
                    'mapel' => 'Al-qur\'an Hadits',
                    'nilai' => $request->sem3_qhadits
                ],
                [
                    'mapel' => 'Akidah Akhlak',
                    'nilai' => $request->sem3_akidah
                ],
                [
                    'mapel' => 'Fiqih',
                    'nilai' => $request->sem3_fiqih
                ],
                [
                    'mapel' => 'Sejarah Kebudayaan Islam (SKI)',
                    'nilai' => $request->sem3_ski
                ]
            ];
            $semester4_nilai = [
                [
                    'mapel' => 'Ilmu Pengetahuan Alam (IPA)',
                    'nilai' => $request->sem4_ipa
                ],
                [
                    'mapel' => 'Ilmu Pengetahuan Sosial (IPS)',
                    'nilai' => $request->sem4_ips
                ],
                [
                    'mapel' => 'Bahasa Indonesia',
                    'nilai' => $request->sem4_indonesia
                ],
                [
                    'mapel' => 'Bahasa Inggris',
                    'nilai' => $request->sem4_inggris
                ],
                [
                    'mapel' => 'Matematika',
                    'nilai' => $request->sem4_matematika
                ],
                [
                    'mapel' => 'Al-qur\'an Hadits',
                    'nilai' => $request->sem4_qhadits
                ],
                [
                    'mapel' => 'Akidah Akhlak',
                    'nilai' => $request->sem4_akidah
                ],
                [
                    'mapel' => 'Fiqih',
                    'nilai' => $request->sem4_fiqih
                ],
                [
                    'mapel' => 'Sejarah Kebudayaan Islam (SKI)',
                    'nilai' => $request->sem4_ski
                ]
            ];
            $semester5_nilai = [
                [
                    'mapel' => 'Ilmu Pengetahuan Alam (IPA)',
                    'nilai' => $request->sem5_ipa
                ],
                [
                    'mapel' => 'Ilmu Pengetahuan Sosial (IPS)',
                    'nilai' => $request->sem5_ips
                ],
                [
                    'mapel' => 'Bahasa Indonesia',
                    'nilai' => $request->sem5_indonesia
                ],
                [
                    'mapel' => 'Bahasa Inggris',
                    'nilai' => $request->sem5_inggris
                ],
                [
                    'mapel' => 'Matematika',
                    'nilai' => $request->sem5_matematika
                ],
                [
                    'mapel' => 'Al-qur\'an Hadits',
                    'nilai' => $request->sem5_qhadits
                ],
                [
                    'mapel' => 'Akidah Akhlak',
                    'nilai' => $request->sem5_akidah
                ],
                [
                    'mapel' => 'Fiqih',
                    'nilai' => $request->sem5_fiqih
                ],
                [
                    'mapel' => 'Sejarah Kebudayaan Islam (SKI)',
                    'nilai' => $request->sem5_ski
                ]
            ];
            $user_rapor->semester1_nilai = $semester1_nilai;
            $user_rapor->semester2_nilai = $semester2_nilai;
            $user_rapor->semester3_nilai = $semester3_nilai;
            $user_rapor->semester4_nilai = $semester4_nilai;
            $user_rapor->semester5_nilai = $semester5_nilai;
        }

        if ($request->hasFile('sem1_file')) {
            Storage::delete($user_rapor->semester1_file);
            $semester1_file = $request->file('sem1_file')->storeAs('ppdb/rapor', Str::slug(Auth::guard('ppdb')->user()->nisn) . '-1.' . $request->file('sem1_file')->getClientOriginalExtension(), 'public');
            $user_rapor->semester1_file = $semester1_file;
        }
        if ($request->hasFile('sem2_file')) {
            Storage::delete($user_rapor->semester2_file);
            $semester2_file = $request->file('sem2_file')->storeAs('ppdb/rapor', Str::slug(Auth::guard('ppdb')->user()->nisn) . '-2.' . $request->file('sem2_file')->getClientOriginalExtension(), 'public');
            $user_rapor->semester2_file = $semester2_file;
        }
        if ($request->hasFile('sem3_file')) {
            Storage::delete($user_rapor->semester3_file);
            $semester3_file = $request->file('sem3_file')->storeAs('ppdb/rapor', Str::slug(Auth::guard('ppdb')->user()->nisn) . '-3.' . $request->file('sem3_file')->getClientOriginalExtension(), 'public');
            $user_rapor->semester3_file = $semester3_file;
        }
        if ($request->hasFile('sem4_file')) {
            Storage::delete($user_rapor->semester4_file);
            $semester4_file = $request->file('sem4_file')->storeAs('ppdb/rapor', Str::slug(Auth::guard('ppdb')->user()->nisn) . '-4.' . $request->file('sem4_file')->getClientOriginalExtension(), 'public');
            $user_rapor->semester4_file = $semester4_file;
        }
        if ($request->hasFile('sem5_file')) {
            Storage::delete($user_rapor->semester5_file);
            $semester5_file = $request->file('sem5_file')->storeAs('ppdb/rapor', Str::slug(Auth::guard('ppdb')->user()->nisn) . '-5.' . $request->file('sem5_file')->getClientOriginalExtension(), 'public');
            $user_rapor->semester5_file = $semester5_file;
        }
        $user_rapor->save();

        $user = PpdbUser::find(Auth::guard('ppdb')->user()->id);

        if ($request->hasFile('screenshoot_nisn')) {
            Storage::delete($user->screenshoot_nisn);
            $screenshootNisn = $request->file('screenshoot_nisn')->storeAs('ppdb/screenshoot_nisn', Str::slug(Auth::guard('ppdb')->user()->nisn) . '.' . $request->file('screenshoot_nisn')->getClientOriginalExtension(), 'public');
            $user->screenshoot_nisn = $screenshootNisn;
        }

        $user->save();

        if($request->delete_certificate) {
            $certificate_delete = json_decode($request->delete_certificate, true);
            foreach ($certificate_delete as $certificateId) {
                $certificate = PpdbUserCertificate::find($certificateId);
                if ($certificate) {
                    Storage::delete('public/' . $certificate->path);
                    $certificate->delete();
                }
            }
        }


        // Looping data sertifikat dari request
        if ($request->certificates) {
            foreach ($request->certificates as $certificateData) {
                $certificateName = $certificateData['certificate_name'] ?? '-';
                $certificateRank = $certificateData['certificate_rank'] ?? 'Juara Lainnya';

                // Jika ada ID sertifikat, berarti update data lama
                if (isset($certificateData['certificate_id'])) {
                    $certificate = PpdbUserCertificate::find($certificateData['certificate_id']);

                    if (!$certificate) continue;

                    // Jika ada file baru yang diunggah, hapus file lama dan simpan yang baru
                    if (isset($certificateData['certificate_file']) && $certificateData['certificate_file']) {
                        // Hapus file lama jika ada
                        if ($certificate->path) {
                            Storage::delete('public/' . $certificate->path);
                        }

                        // Simpan file baru
                        $certificateFile = $certificateData['certificate_file'];
                        $certificatePath = $certificateFile->storeAs(
                            'ppdb/certificates',
                            Str::slug($user->nisn) . '-' . Str::random(10) . '.' . $certificateFile->getClientOriginalExtension(),
                            'public'
                        );

                        // Update path sertifikat
                        $certificate->path = $certificatePath;
                    }

                    // Update informasi lainnya
                    $certificate->name = Str::limit($certificateName, 250);
                    $certificate->rank = $certificateRank;
                    $certificate->save();
                } else {
                    // Jika tidak ada ID, buat data baru
                    if (isset($certificateData['certificate_file']) && $certificateData['certificate_file']) {
                        $certificateFile = $certificateData['certificate_file'];
                        $certificatePath = $certificateFile->storeAs(
                            'ppdb/certificates',
                            Str::slug($user->nisn) . '-' . Str::random(10) . '.' . $certificateFile->getClientOriginalExtension(),
                            'public'
                        );

                        // Simpan data baru
                        $user->certificate()->create([
                            'ppdb_user_id' => $user->id,
                            'name' => Str::limit($certificateName, 250),
                            'rank' => $certificateRank,
                            'path' => $certificatePath
                        ]);
                    }
                }
            }
        }

        Alert::success('Berhasil', 'Data berhasil diupdate');
        return redirect()->back();
    }
}
