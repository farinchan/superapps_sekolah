<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\MenuPersonalia;
use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class MenuPersonaliaController extends Controller
{
    public function index()
   {
        $data = [
            'title' => 'List Personalia',
            'menu' => 'Menu',
            'sub_menu' => 'Personalia',
            'list_personalia' => MenuPersonalia::all()
        ];

        return view('back.pages.personalia.index', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ],[
            'name.required' => 'Nama harus diisi',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        MenuPersonalia::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        Alert::success('Success', 'Data berhasil ditambahkan');
        return redirect()->route('back.menu.personalia.index');


    }

    public function edit($id)
    {
        $data = [
            'title' => 'Personalia Edit',
            'menu' => 'Menu',
            'sub_menu' => 'Personalia',
            'personalia' => MenuPersonalia::find($id)
        ];

        return view('back.pages.personalia.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'content' => 'required',
        ],[
            'name.required' => 'Nama harus diisi',
            'content.required' => 'Konten harus diisi',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        MenuPersonalia::find($id)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'content' => $request->content,
        ]);

        Alert::success('Success', 'Data berhasil diubah');
        return redirect()->route('back.menu.personalia.index');
    }

    public function destroy($id)
    {
        MenuPersonalia::find($id)->delete();
        Alert::success('Success', 'Data berhasil dihapus');
        return redirect()->route('back.menu.personalia.index');
    }
}
