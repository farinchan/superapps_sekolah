<?php

namespace App\Http\Controllers\PPDB;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\PpdbContact;
use App\Models\PpdbInformation;
use App\Models\PpdbPath;
use App\Models\Student;
use App\Models\StudentAchievement;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'menu' => 'PPDB',
            'submenu' => 'Beranda',
            'page_title' => 'Beranda',
            'page_description' => '',
            'list_teacher' => Teacher::where('type', 'tenaga pendidik')->inRandomOrder()->limit(20)->get(),
            'tenaga_pendidik_kependidikan' => Teacher::count(),
            'siswa_count' => Student::count(),
            'alumni_count' => "10",
            'list_berita' => News::whereHas('category', function ($query) {
                $query->where('slug', 'berita-ppdb');
            })->where('status', 'published')->latest()->limit(5)->get(),

        ];
        // return response()->json($data);
        return view('ppdb.pages.front.home', $data);
    }

    public function information()
    {
        $data = [
            'menu' => 'Beranda',
            'submenu' => 'Informasi',
            'page_title' => 'Informasi PPDB',
            'page_description' => 'Informasi PPDB Madrasah Aliyah Negeri 1 Padang Panjang',
            'list_achievement' => StudentAchievement::latest()->limit(5)->get(),
            'list_path' => PpdbPath::with(['schoolYear','registrationUsers'])->where('start_date', '<=', date('Y-m-d'))->where('end_date', '>=', date('Y-m-d'))->get(),
            'information' => PpdbInformation::first(),

        ];
        // return response()->json($data);
        return view('ppdb.pages.front.information', $data);
    }

    public function contact()
    {
        $data = [
            'menu' => 'Beranda',
            'submenu' => 'Kontak',
            'page_title' => 'Kontak Kami',
            'page_description' => 'Hubungi Kami Mengenai PPDB Madrasah Aliyah Negeri 1 Padang Panjang'
        ];
        return view('ppdb.pages.front.contact', $data);
    }

    public function ContactSend(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'phone' => 'required|max:15',
            'email' => 'required|email',
            'subject' => 'required|max:255',
            'message' => 'required',
        ], [
            'name.required' => 'Nama harus diisi',
            'name.max' => 'Nama maksimal 255 karakter',
            'phone.required' => 'Nomor telepon harus diisi',
            'phone.max' => 'Nomor telepon maksimal 15 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'subject.required' => 'Subjek harus diisi',
            'subject.max' => 'Subjek maksimal 255 karakter',
            'message.required' => 'Pesan harus diisi',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);
        }

        $ppdbContact = new PpdbContact();
        $ppdbContact->name = $request->name;
        $ppdbContact->phone = $request->phone;
        $ppdbContact->email = $request->email;
        $ppdbContact->subject = $request->subject;
        $ppdbContact->message = $request->message;
        $ppdbContact->save();

        return response()->json(['status' => 'success', 'message' => 'Pesan berhasil dikirim']);
    }

    public function newsDetail($slug)
    {
        $news = News::where('slug', $slug)->first();
        if (!$news) {
            return abort(404);
        }
        $data = [
            'menu' => 'Beranda',
            'submenu' => 'Berita',
            'page_title' => "Berita Detail",
            'page_description' => $news->title,
            'news' => $news,
            'list_berita_terbaru' => News::whereHas('category', function ($query) {
                $query->where('slug', 'berita-ppdb');
            })->where('status', 'published')->latest()->limit(4)->get(),
            'list_achievement' => StudentAchievement::latest()->limit(5)->get(),

        ];
        return view('ppdb.pages.front.news-detail', $data);
    }
}
