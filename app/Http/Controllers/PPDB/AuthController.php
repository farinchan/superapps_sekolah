<?php

namespace App\Http\Controllers\PPDB;

use App\Http\Controllers\Controller;
use App\Models\ppdb_user;
use App\Models\PpdbInformation;
use App\Models\PpdbUser;
use App\Models\PpdbUserRapor;
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
            'page_description' => 'Silakan isi form pendaftaran berikut untuk mendaftar PPDB',
            'information' => PpdbInformation::first(),
        ];
        // return response()->json($data);
        return view('ppdb.pages.auth.register', $data);
    }

    public function registerProcess(Request $request)
    {
        // dd($request->all());
        $validator_rule = [
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

            'screenshoot_nisn' => 'required|mimes:pdf,jpg,jpeg,png|max:10240',
            'certificates' => 'array',
            'certificates.*.certificate_name' => 'nullable',
            'certificates.*.certificate_rank' => 'nullable',
            'certificates.*.certificate_file' => 'nullable|mimes:pdf,jpg,jpeg,png|max:10240',
            'additional_data' => 'array'

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
                'unique' => ':attribute sudah terdaftar',
                'email' => ':attribute tidak valid',
                'min' => ':attribute minimal :min karakter',
                'date' => ':attribute harus berupa tanggal',
                'max' => ':attribute maksimal :max karakter',
                'string' => ':attribute harus berupa huruf',
                'mimes' => ':attribute harus berupa file :values',
            ]
        );

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
        if ($request->hasFile('screenshoot_nisn')) {
            $file = $request->file('screenshoot_nisn');
            $path = $file->storeAs('ppdb/screenshoot_nisn', Str::slug($request->nisn) . '-' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension(), 'public');
            $user->screenshoot_nisn = $path;
        }
        $user->additional_data = $request->additional_data;
        $user->save();

        if ($request->certificates) {
            foreach ($request->certificates as $certificate) {
                if (!isset($certificate['certificate_file'])) {
                    continue;
                }
                $certificateName = $certificate['certificate_name'];
                $certificateRank = $certificate['certificate_rank'];
                $certificateFile = $certificate['certificate_file'];
                $certificatePath = $certificateFile->storeAs('ppdb/certificates', Str::slug($request->nisn) . '-' . Str::random(10) . '.' . $certificateFile->getClientOriginalExtension(), 'public');
                $user->certificate()->create([
                    'ppdb_user_id' => $user->id,
                    'name' => Str::limit($certificateName, 250),
                    'rank' => $certificateRank,
                    'path' => $certificatePath
                ]);
            }
        }

        $rapor = new PpdbUserRapor();
        $rapor->ppdb_user_id = $user->id;
        $rapor->rapor_type = $request->rapor_type;

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
            $rapor->semester1_nilai = $semester1_nilai;
            $rapor->semester2_nilai = $semester2_nilai;
            $rapor->semester3_nilai = $semester3_nilai;
            $rapor->semester4_nilai = $semester4_nilai;
            $rapor->semester5_nilai = $semester5_nilai;

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
            $rapor->semester1_nilai = $semester1_nilai;
            $rapor->semester2_nilai = $semester2_nilai;
            $rapor->semester3_nilai = $semester3_nilai;
            $rapor->semester4_nilai = $semester4_nilai;
            $rapor->semester5_nilai = $semester5_nilai;
        }
        $rapor->semester1_file = $request->file('sem1_file')->storeAs('ppdb/rapor', Str::slug($request->nisn) . '-1.' . $request->file('sem1_file')->getClientOriginalExtension(), 'public');
        $rapor->semester2_file = $request->file('sem2_file')->storeAs('ppdb/rapor', Str::slug($request->nisn) . '-2.' . $request->file('sem2_file')->getClientOriginalExtension(), 'public');
        $rapor->semester3_file = $request->file('sem3_file')->storeAs('ppdb/rapor', Str::slug($request->nisn) . '-3.' . $request->file('sem3_file')->getClientOriginalExtension(), 'public');
        $rapor->semester4_file = $request->file('sem4_file')->storeAs('ppdb/rapor', Str::slug($request->nisn) . '-4.' . $request->file('sem4_file')->getClientOriginalExtension(), 'public');
        $rapor->semester5_file = $request->file('sem5_file')->storeAs('ppdb/rapor', Str::slug($request->nisn) . '-5.' . $request->file('sem5_file')->getClientOriginalExtension(), 'public');
        $rapor->save();

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
