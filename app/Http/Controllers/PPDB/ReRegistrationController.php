<?php

namespace App\Http\Controllers\PPDB;

use App\Http\Controllers\Controller;
use App\Models\PpdbInformation;
use App\Models\PpdbRegistrationUser;
use App\Models\PpdbReRegistrationUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class ReRegistrationController extends Controller
{
    public function index($registration_id, Request $request)
    {
        $data = [
            'menu' => 'PPDB',
            'submenu' => 'Dashboard',
            'page_title' => 'Pendaftaran Ulang',
            'page_description' => 'Silahkan lengkapi data daftar ulang',
            'user' => Auth::guard('ppdb')->user(),
            // 'registration' => PpdbRegistrationUser::with(['path.schoolYear'])->where('id', $registration_id)->first(),
            'registration_id' => $registration_id,
            're_registration' => PpdbReRegistrationUser::where('ppdb_registration_user_id', $registration_id)->first(),
            'information' => PpdbInformation::first(),
        ];
        // return response()->json($data);
        return view('ppdb.pages.back.re_registation.index', $data);
    }

    public function update($registration_id, Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'jenis_kelamin' => 'required',
            'parent_income' => 'required',
            'statement_letter' => 'nullable|file|mimes:pdf|max:4096',
            'file_kk' => 'nullable|file|mimes:pdf|max:4096',
            'file_kip' => 'nullable|file|mimes:pdf|max:4096',
            'file_pkh' => 'nullable|file|mimes:pdf|max:4096',
            'file_dtks' => 'nullable|file|mimes:pdf|max:4096',
            'file_kks' => 'nullable|file|mimes:pdf|max:4096',
        ], [
            'required' => ':attribute harus diisi',
            'file' => ':attribute harus berupa file',
            'mimes' => ':attribute harus berupa file pdf',
            'max' => ':attribute maksimal 2MB',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $re_registration = PpdbReRegistrationUser::where('ppdb_registration_user_id', $registration_id)->first() ?? new PpdbReRegistrationUser();
        $re_registration->ppdb_user_id = Auth::guard('ppdb')->user()->id;
        $re_registration->ppdb_registration_user_id = $registration_id;
        $re_registration->jenis_kelamin = $request->jenis_kelamin;
        $re_registration->parent_income = $request->parent_income;

        if ($request->hasFile('statement_letter')) {
            $statement_letter = $request->file('statement_letter');
            $statement_letter_name = 'statement_letter_' . Str::random(10) . '.' . $statement_letter->getClientOriginalExtension();
            $re_registration->statement_letter = $statement_letter->storeAs('ppdb/re_registration', $statement_letter_name, 'public');
        }

        if ($request->hasFile('file_kk')) {
            $file_kk = $request->file('file_kk');
            $file_kk_name = 'kk_' . Str::random(10) . '.' . $file_kk->getClientOriginalExtension();
            $re_registration->file_kk = $file_kk->storeAs('ppdb/re_registration', $file_kk_name, 'public');
        }

        if ($request->hasFile('file_kip')) {
            $file_kip = $request->file('file_kip');
            $file_kip_name = 'kip_' . Str::random(10) . '.' . $file_kip->getClientOriginalExtension();

            $re_registration->file_kip = $file_kip->storeAs('ppdb/re_registration', $file_kip_name, 'public');
        }

        if ($request->hasFile('file_pkh')) {
            $file_pkh = $request->file('file_pkh');
            $file_pkh_name = 'pkh_' . Str::random(10) . '.' . $file_pkh->getClientOriginalExtension();
            $re_registration->file_pkh = $file_pkh->storeAs('ppdb/re_registration', $file_pkh_name, 'public');
        }

        if ($request->hasFile('file_dtks')) {
            $file_dtks = $request->file('file_dtks');
            $file_dtks_name = 'dtks_' . Str::random(10) . '.' . $file_dtks->getClientOriginalExtension();
            $re_registration->file_dtks = $file_dtks->storeAs('ppdb/re_registration', $file_dtks_name, 'public');
        }

        if ($request->hasFile('file_kks')) {
            $file_kks = $request->file('file_kks');
            $file_kks_name = 'kks_' . Str::random(10) . '.' . $file_kks->getClientOriginalExtension();
            $re_registration->file_kks = $file_kks->storeAs('ppdb/re_registration', $file_kks_name, 'public');
        }

        $re_registration->save();

        Alert::success('Berhasil', 'Data berhasil disimpan');
        return redirect()->route('ppdb.re-registration.success', $registration_id);
    }

    public function success($registration_id)
    {
        $data = [
            'menu' => 'PPDB',
            'submenu' => 'Dashboard',
            'page_title' => 'Pendaftaran Ulang',
            'page_description' => 'Penyelesaian Pendaftaran Ulang Sukses',
            'user' => Auth::guard('ppdb')->user(),
            'information' => PpdbInformation::first(),
        ];
        return view('ppdb.pages.back.re_registation.success', $data);
    }
}
