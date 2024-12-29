<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\MenuProfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class MenuProfilController extends Controller
{
    public function index()
    {
         $data = [
             'title' => 'List Profil',
             'menu' => 'Menu',
             'sub_menu' => 'Profil',
             'list_profil' => MenuProfil::all()
         ];

         return view('back.pages.profil.index', $data);
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

         MenuProfil::create([
             'name' => $request->name,
             'slug' => Str::slug($request->name),
         ]);

         Alert::success('Success', 'Data berhasil ditambahkan');
         return redirect()->route('back.menu.profil.index');


     }

     public function edit($id)
     {
         $data = [
             'title' => 'Profil Edit',
             'menu' => 'Menu',
             'sub_menu' => 'Profil',
             'profil' => MenuProfil::find($id)
         ];

         return view('back.pages.profil.edit', $data);
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

         MenuProfil::find($id)->update([
             'name' => $request->name,
             'slug' => Str::slug($request->name),
             'content' => $request->content,
         ]);

         Alert::success('Success', 'Data berhasil diubah');
         return redirect()->route('back.menu.profil.index');
     }

     public function destroy($id)
     {
         MenuProfil::find($id)->delete();
         Alert::success('Success', 'Menu berhasil dihapus');
         return redirect()->back();
     }
     public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
        ],[
            'upload.required' => 'File harus diisi',
            'upload.image' => 'File harus berupa gambar',
            'upload.mimes' => 'File harus berupa gambar jpeg, png, jpg, gif, svg',
            'upload.max' => 'File maksimal 20MB',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'uploaded' => false,
                'error' => $validator->errors()->first()
            ]);
        }

        $file = $request->file('upload');
        $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $filePath = $file->StoreAs('personalia', $fileName, 'public');

        $url = Storage::url($filePath);

        return response()->json([
            'uploaded' => true,
            'url' => $url
        ]);
    }
}
