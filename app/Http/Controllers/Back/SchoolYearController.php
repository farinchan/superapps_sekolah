<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;


class SchoolYearController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Tahun Ajaran',
            'menu' => 'Tahun Ajaran',
            'sub_menu' => '',
            'list_school_year' => SchoolYear::orderBy('start_year', 'asc')->get(),
        ];

        return view('back.pages.school_year.index', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_year' => 'required',
            'start_year' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Data gagal disimpan');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();

        SchoolYear::create($data);

        Alert::success('Berhasil', 'Data berhasil disimpan');
        return redirect()->route('back.school-year.index');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'start_year' => 'required',
            'start_year' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Data gagal disimpan');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();

        SchoolYear::find($id)->update($data);
    }

    public function destroy($id)
    {
        SchoolYear::destroy($id);
        Alert::success('Berhasil', 'Data berhasil dihapus');
        return redirect()->back();
    }
}
