<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class PartnerLinkController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Partner Link',
            'menu' => 'Partner Link',
            'sub_menu' => '',
            'list_partner' => Partner::all(),
        ];

        return view('back.pages.partner.index', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'link' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'name.required' => 'Nama wajib diisi',
            'link.required' => 'Link wajib diisi',
            'logo.image' => 'Logo harus berupa gambar',
            'logo.mimes' => 'Logo harus berformat jpeg, png, jpg, gif, svg',
            'logo.max' => 'Ukuran logo maksimal 2MB',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Partner::create([
            'name' => $request->name,
            'url' => $request->link,
            'logo' => $request->file('logo')->storeAs('partner', Str::slug($request->name) . '.' . $request->file('logo')->extension(), 'public'),
        ]);

        Alert::success('Berhasil', 'Data berhasil disimpan');
        return redirect()->route('back.partner-link.index');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'link' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Data gagal disimpan');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = Partner::find($id);
        $data->name = $request->name;
        $data->url = $request->link;

        if ($request->hasFile('logo')) {
            Storage::disk('public')->delete($data->logo);
            $data->logo = $request->file('logo')->storeAs('partner', Str::slug($request->name) . '.' . $request->file('logo')->extension(), 'public');
        }

        $data->save();

        Alert::success('Berhasil', 'Data berhasil disimpan');
        return redirect()->route('back.partner-link.index');
    }

    public function destroy($id)
    {
        $data = Partner::find($id);
        Storage::disk('public')->delete($data->logo);
        $data->delete();

        Alert::success('Berhasil', 'Data berhasil dihapus');
        return redirect()->route('back.partner-link.index');
    }
}
