<?php

namespace App\Http\Controllers\PPDB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'menu' => 'PPDB',
            'submenu' => 'Dashboard',
            'page_title' => 'Dashboard',
            'page_description' => 'Selamat datang di dashboard PPDB',
            'user' => Auth::guard('ppdb')->user()
        ];
        // return response()->json($data);
        return view('ppdb.pages.back.dashboard', $data);
    }
}
