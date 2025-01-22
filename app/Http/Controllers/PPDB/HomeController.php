<?php

namespace App\Http\Controllers\PPDB;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

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
            'page_description' => 'Informasi PPDB Madrasah Aliyah Negeri 1 Padang Panjang'
        ];
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
}
