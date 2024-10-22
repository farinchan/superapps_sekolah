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
        ];

        return view('back.pages.partner-link.index', $data);
    }

    public function strore(Request $request)
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

        $data = $request->all();
        $data['logo'] = $request->file('logo')->storeAs('partner', Str::slug($request->name) . '.' . $request->file('logo')->extension(), 'public');

        Partner::create($data);

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
        $data->link = $request->link;

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
