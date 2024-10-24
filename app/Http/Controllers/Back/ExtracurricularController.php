<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Extracurricular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class ExtracurricularController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Extracurricular',
            'menu' => 'Extracurricular',
            'sub_menu' => '',
            'list_extracurricular' => Extracurricular::all(),
        ];

        return view('back.pages.extracurricular.index', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'name.required' => 'Nama wajib diisi',
            'description.required' => 'Deskripsi wajib diisi',
            'image.image' => 'Logo harus berupa gambar',
            'image.mimes' => 'Logo harus berformat jpeg, png, jpg, gif, svg',
            'image.max' => 'Ukuran logo maksimal 2MB',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Extracurricular::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'image' => $request->file('image')->storeAs('extracurricular', Str::slug($request->name) . '.' . $request->file('image')->extension(), 'public'),
        ]);

        Alert::success('Berhasil', 'Data berhasil disimpan');
        return redirect()->route('back.extracurricular.index');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'name.required' => 'Nama wajib diisi',
            'description.required' => 'Deskripsi wajib diisi',
            'image.image' => 'Logo harus berupa gambar',
            'image.mimes' => 'Logo harus berformat jpeg, png, jpg, gif, svg',
            'image.max' => 'Ukuran logo maksimal 2MB',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $extracurricular = Extracurricular::find($id);
        $extracurricular->name = $request->name;
        $extracurricular->slug = Str::slug($request->name);
        $extracurricular->description = $request->description;

        if ($request->hasFile('image')) {
            Storage::delete($extracurricular->image);
            $extracurricular->image = $request->file('image')->storeAs('extracurricular', Str::slug($request->name) . '.' . $request->file('image')->extension(), 'public');
        }

        $extracurricular->save();

        Alert::success('Berhasil', 'Data berhasil diubah');
        return redirect()->route('back.extracurricular.index');
    }

    public function destroy($id)
    {
        $extracurricular = Extracurricular::find($id);
        Storage::delete($extracurricular->image);
        $extracurricular->delete();

        Alert::success('Berhasil', 'Data berhasil dihapus');
        return redirect()->route('back.extracurricular.index');
    }
}
