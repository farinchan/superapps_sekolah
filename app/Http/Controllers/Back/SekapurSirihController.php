<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\SekapurSirih;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class SekapurSirihController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Sekapur Sirih',
            'menu' => 'Sekapur Sirih',
            'sub_menu' => '',
        ];

        return view('back.pages.sekapur_sirih', $data);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'required',
        ], [
            'image.required' => 'Gambar wajib diisi',
            'image.image' => 'Gambar harus berupa gambar',
            'image.mimes' => 'Gambar harus berformat jpeg, png, jpg, gif, svg',
            'image.max' => 'Ukuran gambar maksimal 2MB',
            'content.required' => 'Konten wajib diisi',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $sekapur_sirih = SekapurSirih::first();

        if ($request->hasFile('image')) {
            $sekapur_sirih->update([
                'image' => $request->file('image')->storeAs('sekapur_sirih', 'sekapur_sirih.' . $request->file('image')->extension(), 'public'),
                'content' => $request->content,
            ]);
        } else {
            $sekapur_sirih->update([
                'content' => $request->content,
            ]);
        }

        Alert::success('Berhasil', 'Data berhasil disimpan');
        return redirect()->route('back.sekapur_sirih.index');

    }
}
