<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\SettingBanner;
use App\Models\SettingWebsite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class SettingController extends Controller
{
    public function website()
    {
        $data = [
            'title' => 'Setting Website',
            'menu' => 'Setting',
            'sub_menu' => 'Website',
            'setting' => SettingWebsite::first(),
        ];
        return view('back.pages.setting.website', $data);
    }

    public function websiteUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'favicon' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'facebook' => 'nullable',
            'instagram' => 'nullable',
            'twitter' => 'nullable',
            'youtube' => 'nullable',
            'whatsapp' => 'nullable',
            'telegram' => 'nullable',
            'linkedin' => 'nullable',
            'about' => 'nullable',
        ]);

        // dd($request->all());
        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $setting = SettingWebsite::first();
        $setting->name = $request->name;
        $setting->email = $request->email;
        $setting->phone = $request->phone;
        $setting->address = $request->address;
        $setting->latitude = $request->latitude;
        $setting->longitude = $request->longitude;
        $setting->facebook = $request->facebook;
        $setting->instagram = $request->instagram;
        $setting->twitter = $request->twitter;
        $setting->youtube = $request->youtube;
        $setting->whatsapp = $request->whatsapp;
        $setting->telegram = $request->telegram;
        $setting->linkedin = $request->linkedin;
        $setting->about = $request->about;

        if ($request->hasFile('logo')) {
            Storage::delete('public/' . $setting->logo);
            $logo = $request->file('logo');
            $setting->logo  = $logo->storeAs('setting', rand() . '.' . $logo->getClientOriginalExtension(), 'public');
        }

        if ($request->hasFile('favicon')) {
            Storage::delete('public/' . $setting->favicon);
            $favicon = $request->file('favicon');
            $setting->favicon = $favicon->storeAs('setting', 'favicon.' . $favicon->getClientOriginalExtension(), 'public');
        }

        $setting->save();

        Alert::success('Success', 'Setting website berhasil diperbarui');
        return redirect()->back();
    }

    public function informationUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'terms_conditions' => 'nullable',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $setting = SettingWebsite::first();
        $setting->terms_conditions = $request->terms_conditions;
        $setting->save();

        Alert::success('Success', 'Informasi berhasil diperbarui');
        return redirect()->back();
    }

    public function banner ()
    {
        $data = [
            'menu_title' => 'Pengaturan',
            'submenu_title' => 'Banner',
            'title' => 'Pengaturan Banner',
            'list_banner' => SettingBanner::latest()->get(),

        ];
        return view('back.pages.setting.banner', $data);
    }

    public function bannerCreate (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'required|image',
            'url' => 'required|string',
        ], [
            'required' => 'Kolom :attribute tidak boleh kosong',
            'string' => 'Kolom :attribute harus berupa string',
            'max' => 'Kolom :attribute tidak boleh lebih dari :max karakter',
            'image' => 'Kolom :attribute harus berupa gambar',
            'in' => 'Kolom :attribute harus diisi dengan :values',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $banner = new SettingBanner();
        $banner->title = $request->title;
        $banner->subtitle = $request->subtitle;
        $banner->url = $request->url;
        $banner->status = 1;

        $image = $request->file('image');
        $fileName = time() . '_' . $image->getClientOriginalName();
        $filePath = $image->storeAs('banner', $fileName, 'public');
        $banner->image = $filePath;

        $banner->save();
        return redirect()->route('back.setting.banner')->with('success', 'Pengaturan Banner berhasil ditambahkan');
    }

    public function bannerUpdate (Request $request, $id)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image',
            'url' => 'required|string',
        ], [
            'required' => 'Kolom :attribute tidak boleh kosong',
            'string' => 'Kolom :attribute harus berupa string',
            'max' => 'Kolom :attribute tidak boleh lebih dari :max karakter',
            'image' => 'Kolom :attribute harus berupa gambar',
            'in' => 'Kolom :attribute harus diisi dengan :values',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $banner = SettingBanner::find($id);
        $banner->title = $request->title;
        $banner->subtitle = $request->subtitle;
        $banner->url = $request->url;

        if ($request->hasFile('image')) {
            $oldImage = $banner->image;
            Storage::delete('public/' . $oldImage);

            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $filePath = $image->storeAs('banner/', $fileName, 'public');
            $banner->image = $filePath;
        }

        $banner->save();
        Alert::success('Success', 'Pengaturan Banner berhasil diubah');
        return redirect()->route('back.setting.banner')->with('success', 'Pengaturan Banner berhasil diubah');
    }

    public function bannerDestroy($id)
    {
        $banner = SettingBanner::find($id);
        Storage::delete('public/' . $banner->image);
        $banner->delete();
        Alert::success('Success', 'Pengaturan Banner berhasil dihapus');
        return redirect()->route('back.setting.banner')->with('success', 'Pengaturan Banner berhasil dihapus');
    }
}
