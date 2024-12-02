<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class AnnouncementController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'List Pegnumuman',
            'menu' => 'Post',
            'sub_menu' => 'Pengumuman',
            'list_announcement' => Announcement::latest()->get()
        ];

        return view('back.pages.announcement.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Pengumuman',
            'menu' => 'Post',
            'sub_menu' => 'Pengumuman'
        ];

        return view('back.pages.announcement.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'content' => 'required',
            'file' => 'nullable|mimes:pdf|max:16384',
            'meta_keywords' => 'nullable|max:255',
        ], [
            'title.required' => 'Judul harus diisi',
            'title.max' => 'Judul maksimal 255 karakter',
            'content.required' => 'Konten harus diisi',
            'file.mimes' => 'File harus berupa PDF',
            'file.max' => 'File maksimal 16MB',
            'meta_keywords.max' => 'Meta Keywords maksimal 255 karakter',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $announcement = new Announcement();
        $announcement->title = $request->title;
        $announcement->slug = Str::slug($request->title);
        $announcement->content = $request->content;
        $announcement->teacher_id = auth()->user()->teacher->id;
        $announcement->meta_title = $request->title;
        $announcement->meta_description = Str::limit(strip_tags($request->content), 250);
        $announcement->meta_keywords = $request->meta_keywords;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file_name = Str::random(10) . '.' . $file->getClientOriginalExtension();
            $announcement->file = $file->storeAs('announcement', $file_name, 'public');
        }

        $announcement->save();

        Alert::success('Berhasil', 'Pengumuman berhasil ditambahkan');
        return redirect()->route('back.announcement.index');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Pengumuman',
            'menu' => 'Post',
            'sub_menu' => 'Pengumuman',
            'announcement' => Announcement::findOrFail($id)
        ];

        return view('back.pages.announcement.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'content' => 'required',
            'file' => 'nullable|mimes:pdf|max:16384',
            'meta_keywords' => 'nullable|max:255',
        ], [
            'title.required' => 'Judul harus diisi',
            'title.max' => 'Judul maksimal 255 karakter',
            'content.required' => 'Konten harus diisi',
            'file.mimes' => 'File harus berupa PDF',
            'file.max' => 'File maksimal 16MB',
            'meta_keywords.max' => 'Meta Keywords maksimal 255 karakter',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $announcement = Announcement::findOrFail($id);
        $announcement->title = $request->title;
        $announcement->slug = Str::slug($request->title);
        $announcement->content = $request->content;
        $announcement->teacher_id = auth()->user()->teacher->id;
        $announcement->meta_title = $request->title;
        $announcement->meta_description = Str::limit(strip_tags($request->content), 250);
        $announcement->meta_keywords = $request->meta_keywords;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file_name = Str::random(10) . '.' . $file->getClientOriginalExtension();
            $announcement->file = $file->storeAs('announcement', $file_name, 'public');
        }

        $announcement->save();

        Alert::success('Berhasil', 'Pengumuman berhasil di update');
        return redirect()->route('back.announcement.index');
    }

    public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);
        if ($announcement->file) {
            Storage::delete($announcement->file);
        }
        $announcement->delete();

        Alert::success('Berhasil', 'Pengumuman berhasil dihapus');
        return redirect()->back();
    }
}
