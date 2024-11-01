<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\BlogTeacher;
use App\Models\BlogTeacherComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogTeacherController extends Controller
{
    public function index()
    {
        $blog = "";
        if (Auth::user()->hasRole('admin')) {
            $blog = BlogTeacher::all();
        } else {
            $blog = BlogTeacher::where('teacher_id', Auth::user()->teacher->id)->get();
        }

        $data = [
            'title' => 'List Blog Guru',
            'menu' => 'Blog',
            'sub_menu' => 'Guru',
            'list_blog' => $blog,
        ];

        return view('back.pages.blog_teacher.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Blog Guru',
            'menu' => 'Blog',
            'sub_menu' => 'Guru',
        ];

        return view('back.pages.blog_teacher.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
            'meta_keywords' => 'nullable',

        ], [
            'title.required' => 'Judul wajib diisi',
            'content.required' => 'Konten wajib diisi',
            'thumbnail.required' => 'Thumbnail wajib diisi',
            'thumbnail.image' => 'Thumbnail harus berupa gambar',
            'thumbnail.mimes' => 'Format thumbnail harus jpeg, png, jpg, gif, atau svg',
            'thumbnail.max' => 'Ukuran thumbnail maksimal 2MB',
            'status.required' => 'Status wajib diisi',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Mohon lengkapi form');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $blog_teacher = new BlogTeacher();
        $blog_teacher->title = $request->title;
        $blog_teacher->slug = Str::slug($request->title);
        $blog_teacher->content = $request->content;
        $blog_teacher->status = $request->status;
        $blog_teacher->teacher_id = Auth::user()->teacher->id;
        $blog_teacher->meta_title = $request->title;
        $blog_teacher->meta_description = Str::limit(strip_tags($request->content), 160);
        $blog_teacher->meta_keywords = $request->meta_keywords;

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $blog_teacher->thumbnail = $thumbnail->storeAs('blog_teacher', Str::random(16) . '.' . $thumbnail->getClientOriginalExtension(), 'public');
        }

        $blog_teacher->save();

        Alert::success('Sukses', 'Blog Guru berhasil ditambahkan');
        return redirect()->route('back.blog_teacher.index');
    }

    public function edit($id)
    {
        $blog_teacher = BlogTeacher::find($id);
        if ( $blog_teacher->teacher_id != Auth::user()->teacher->id) {
            Alert::error('Gagal', 'Anda tidak memiliki akses untuk mengedit blog ini');
            return redirect()->route('back.blog_teacher.index');
        }
        $data = [
            'title' => 'Edit Blog Guru',
            'menu' => 'Blog',
            'sub_menu' => 'Guru',
            'blog_teacher' => $blog_teacher,
        ];

        return view('back.pages.blog_teacher.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
            'meta_keywords' => 'nullable',

        ], [
            'title.required' => 'Judul wajib diisi',
            'content.required' => 'Konten wajib diisi',
            'thumbnail.required' => 'Thumbnail wajib diisi',
            'thumbnail.image' => 'Thumbnail harus berupa gambar',
            'thumbnail.mimes' => 'Format thumbnail harus jpeg, png, jpg, gif, atau svg',
            'thumbnail.max' => 'Ukuran thumbnail maksimal 2MB',
            'status.required' => 'Status wajib diisi',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Mohon lengkapi form');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $blog_teacher = BlogTeacher::find($id);
        if ( $blog_teacher->teacher_id != Auth::user()->teacher->id) {
            Alert::error('Gagal', 'Anda tidak memiliki akses untuk mengedit blog ini');
            return redirect()->route('back.blog_teacher.index');
        }
        $blog_teacher->title = $request->title;
        $blog_teacher->content = $request->content;
        $blog_teacher->status = $request->status;
        $blog_teacher->meta_keywords = $request->meta_keywords;

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            Storage::delete($blog_teacher->thumbnail);
            $blog_teacher->thumbnail = $thumbnail->storeAs('blog_teacher', Str::random(16) . '.' . $thumbnail->getClientOriginalExtension(), 'public');
        }

        $blog_teacher->save();

        Alert::success('Sukses', 'Blog Guru berhasil diperbarui');
        return redirect()->route('back.blog_teacher.index');
    }

    public function destroy($id)
    {
        $blog_teacher = BlogTeacher::find($id);
        if ( $blog_teacher->teacher_id != Auth::user()->teacher->id) {
            Alert::error('Gagal', 'Anda tidak memiliki akses untuk menghapus blog ini');
            return redirect()->route('back.blog_teacher.index');
        }
        if ($blog_teacher->thumbnail) {
            Storage::delete($blog_teacher->thumbnail);
        }
        $blog_teacher->delete();

        Alert::success('Sukses', 'Blog Guru berhasil dihapus');
        return redirect()->route('back.blog_teacher.index');
    }

    public function comment()
    {
        $comment = "";
        if (Auth::user()->hasRole('admin')) {
            $comment = BlogTeacherComment::all();
        } else {
            $comment = BlogTeacherComment::whereHas('blogTeacher', function ($query) {
                $query->where('teacher_id', Auth::user()->teacher->id);
            })->get();
        }
        $data = [
            'title' => 'Komentar Blog Guru',
            'menu' => 'Blog',
            'sub_menu' => 'Guru',
            'comments' => $comment,

        ];

        return view('back.pages.blog_teacher.comment', $data);
    }

    public function commentSpam($id)
    {
        $comment = BlogTeacherComment::find($id);
        if ( $comment->blogTeacher->teacher_id != Auth::user()->teacher->id) {
            Alert::error('Gagal', 'Anda tidak memiliki akses untuk mengubah status komentar ini');
            return redirect()->route('back.blog_teacher.comment');
        }
        $comment->status = 'spam';
        $comment->save();

        Alert::success('Sukses', 'Komentar berhasil diubah menjadi spam');
        return redirect()->route('back.blog_teacher.comment');
    }



}
