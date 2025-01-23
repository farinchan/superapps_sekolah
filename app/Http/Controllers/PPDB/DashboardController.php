<?php

namespace App\Http\Controllers\PPDB;

use App\Http\Controllers\Controller;
use App\Models\PpdbPath;
use App\Models\PpdbRegistrationUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'menu' => 'PPDB',
            'submenu' => 'Dashboard',
            'page_title' => 'Dashboard',
            'page_description' => 'Selamat datang di dashboard PPDB',
            'user' => Auth::guard('ppdb')->user(),
            'path_select_check' => PpdbRegistrationUser::where('ppdb_user_id', Auth::guard('ppdb')->user()->id)->first() ? true : false,
            'path_rejected_check' => PpdbRegistrationUser::where('ppdb_user_id', Auth::guard('ppdb')->user()->id)->where(function ($query) {
                $query->where('status', 'registered')
                      ->orWhere('status', 'passed');
            })->first() ? false : true,
            'my_list_path' => PpdbRegistrationUser::with(['path.schoolYear'])->where('ppdb_user_id', Auth::guard('ppdb')->user()->id)->get(),
            'list_path' => PpdbPath::with(['schoolYear','registrationUsers'])->where('start_date', '<=', date('Y-m-d'))->where('end_date', '>=', date('Y-m-d'))->get(),

        ];
        // return response()->json($data);
        return view('ppdb.pages.back.dashboard', $data);
    }

    public function selectPath($path_id)
    {
        $path_select_check = PpdbRegistrationUser::where('ppdb_user_id', Auth::guard('ppdb')->user()->id)->where('status', 'registered')->orWhere('status', 'passed')->first() ? true : false;
        if ($path_select_check) {
            Alert::error('Gagal', 'Anda sudah memilih jalur PPDB');
            return redirect()->back();
        }


        $registrationUser = new PpdbRegistrationUser();
        $registrationUser->ppdb_user_id = Auth::guard('ppdb')->user()->id;
        $registrationUser->ppdb_path_id = $path_id;
        $registrationUser->status = 'registered';
        $registrationUser->save();

        Alert::success('Berhasil', 'Anda telah memilih jalur PPDB');
        return redirect()->back();
    }
}
