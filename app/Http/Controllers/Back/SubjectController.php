<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;


class SubjectController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'List Mata Pelajaran',
            'menu' => 'E-Learning',
            'sub_menu' => 'Mata Pelajaran',
            'list_subject' => Subject::all(),
        ];

        return view('back.pages.subject.index', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
        ], [
            'name.required' => 'Nama mata pelajaran wajib diisi',
            'description.required' => 'Deskripsi wajib diisi',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Subject::create($request->all());

        Alert::success('Success', 'Data berhasil disimpan');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
        ], [
            'name.required' => 'Nama mata pelajaran wajib diisi',
            'description.required' => 'Deskripsi wajib diisi',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Subject::find($id)->update($request->all());

        Alert::success('Success', 'Data berhasil diubah');
        return redirect()->back();
    }

    public function destroy($id)
    {
        Subject::find($id)->delete();

        Alert::success('Success', 'Data berhasil dihapus');
        return redirect()->back();
    }
}
