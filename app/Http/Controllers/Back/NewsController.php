<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\NewsComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function category()
    {
        $data = [
            'title' => 'Kategori Berita',
            'menu' => 'Berita',
            'sub_menu' => 'Kategori',
            'categories' => NewsCategory::all()
        ];

        return view('back.pages.news.category', $data);
    }

    public function categoryStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:news_category,name',
            'description' => 'nullable',
        ], [
            'name.required' => 'Nama kategori harus diisi',
            'name.unique' => 'Nama kategori sudah ada'
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        NewsCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'meta_title' => $request->name,
            'meta_description' => $request->description,
            'meta_keywords' => implode(", ", explode(" ", $request->name)),
        ]);

        Alert::success('Sukses', 'Kategori Berita berhasil ditambahkan');
        return redirect()->route('back.news.category');
    }

    public function categoryUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:news_category,name,' . $id,
            'description' => 'nullable',
        ], [
            'name.required' => 'Nama kategori harus diisi',
            'name.unique' => 'Nama kategori sudah ada'
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category = NewsCategory::find($id);
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'meta_title' => $request->name,
            'meta_description' => $request->description,
            'meta_keywords' => implode(", ", explode(" ", $request->name)),
        ]);

        Alert::success('Sukses', 'Kategori Berita berhasil diubah');
        return redirect()->route('back.news.category');
    }

    public function categoryDestroy($id)
    {
        $category = NewsCategory::find($id);
        $category->delete();

        Alert::success('Sukses', 'Kategori Berita berhasil dihapus');
        return redirect()->route('back.news.category');
    }

    public function index()
    {
        $data = [
            'title' => 'Berita',
            'menu' => 'Berita',
            'sub_menu' => 'Berita',
            'list_news' => News::all()
        ];

        return view('back.pages.news.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Berita',
            'menu' => 'Berita',
            'sub_menu' => 'Berita',
            'categories' => NewsCategory::all(),
            'news' => News::all()
        ];

        return view('back.pages.news.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'status' => 'required',
            'meta_keywords' => 'nullable',
        ],[
            'image' => 'File harus berupa gambar',
            'mimes' => 'Format file harus :values',
            'max' => 'Ukuran file maksimal :max KB',
            'required' => 'Kolom :attribute harus diisi'
        ]
    );

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $slug = "";
        if (News::where('slug', Str::slug($request->title))->count() > 0) {
            $slug = Str::slug($request->title) . '-' . rand(1000, 9999);
        } else {
            $slug = Str::slug($request->title);
        }

        $news = new News();
        $news->title = $request->title;
        $news->slug = $slug;
        $news->content = $request->content;
        $news->category_id = $request->category_id;
        $news->user_id = Auth::user()->id;
        $news->status = $request->status;
        $news->meta_title = $request->title;
        $news->meta_description = Str::limit(strip_tags($request->content), 150);
        $news->meta_keywords = implode(", ", array_column(json_decode($request->meta_keywords), 'value'));

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $news->thumbnail = $thumbnail->storeAs('news', date('YmdHis') . '_' . Str::slug($request->title) . '.' . $thumbnail->getClientOriginalExtension(), 'public');
        }

        $news->save();

        Alert::success('Sukses', 'Berita berhasil ditambahkan');
        return redirect()->route('back.news.index');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Berita',
            'menu' => 'Berita',
            'sub_menu' => 'Berita',
            'categories' => NewsCategory::all(),
            'news' => News::find($id)
        ];

        return view('back.pages.news.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'status' => 'required',
            'meta_keywords' => 'nullable',
        ],[
            'image' => 'File harus berupa gambar',
            'mimes' => 'Format file harus :values',
            'max' => 'Ukuran file maksimal :max KB',
            'required' => 'Kolom :attribute harus diisi'
        ]
    );

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $slug = "";
        if (News::where('slug', Str::slug($request->title))->where('id', '!=', $id)->count() > 0) {
            $slug = Str::slug($request->title) . '-' . rand(1000, 9999);
        } else {
            $slug = Str::slug($request->title);
        }

        $news = News::find($id);
        $news->title = $request->title;
        $news->slug = $slug;
        $news->content = $request->content;
        $news->category_id = $request->category_id;
        $news->user_id = Auth::user()->id;
        $news->status = $request->status;
        $news->meta_title = $request->title;
        $news->meta_description = Str::limit(strip_tags($request->content), 150);
        $news->meta_keywords = implode(", ", array_column(json_decode($request->meta_keywords), 'value'));;

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $news->thumbnail = $thumbnail->storeAs('news', date('YmdHis') . '_' . Str::slug($request->title) . '.' . $thumbnail->getClientOriginalExtension(), 'public');
        }

        $news->save();

        Alert::success('Sukses', 'Berita berhasil diubah');
        return redirect()->route('back.news.index');
    }

    public function destroy($id)
    {
        $news = News::find($id);
        $news->delete();

        Alert::success('Sukses', 'Berita berhasil dihapus');
        return redirect()->route('back.news.index');
    }

    public function comment()
    {
        $data = [
            'title' => 'Komentar Berita',
            'menu' => 'Berita',
            'sub_menu' => 'Komentar',
            'comments' => NewsComment::with('news')->get()
        ];

        return view('back.pages.news.comment', $data);
    }

    public function commentSpam($id)
    {
        $comment = NewsComment::find($id);
        $comment->status = 'spam';
        $comment->save();

        Alert::success('Sukses', 'Komentar berhasil diubah menjadi spam');
        return redirect()->route('back.news.comment');
    }
}
