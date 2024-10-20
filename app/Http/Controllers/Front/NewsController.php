<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\NewsViewer;
use Illuminate\Http\Request;
use Jenssegers\Agent\Facades\Agent;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\NewsComment;

class NewsController extends Controller
{
    public function index()
    {

        $search = request()->input('q');

        $data = [
            'category' => '',
            'latest_news' => News::latest()
                ->with(['category', 'user', 'viewers', 'comments'])
                ->where('status', 'published')
                ->limit(3)
                ->get(),
            'categories' => NewsCategory::with('news')->get(),
            'list_news' => News::latest()
                ->with(['category', 'user', 'viewers', 'comments'])
                ->where('status', 'published')->where(function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('content', 'like', '%' . $search . '%');
                })->paginate(6),
        ];
        $data = array_merge($data, $this->newsMeta());
        return view('front.pages.news.index', $data);
    }

    public function show($slug)
    {
        $news = News::where('slug', $slug)->first();
        $data = [
            'category' => '',
            'latest_news' => News::latest()
                ->with(['category', 'user', 'viewers', 'comments'])
                ->where('status', 'published')
                ->limit(4)
                ->get(),
            'categories' => NewsCategory::with('news')->get(),
            'news' => $news,
            'related_news' => News::latest()
                ->with(['category', 'user', 'viewers', 'comments'])
                ->where('status', 'published')
                ->where('category_id', $news->category_id)
                ->where('id', '!=', $news->id)
                ->limit(2)
                ->get(),
            'comments' => $news->comments()->where('status', 'approved')->get(),
            'next_news' => News::where('id', '>', $news->id)->first(),
            'prev_news' => News::where('id', '<', $news->id)->first(),
        ];

        $data = array_merge($data, $this->newsMeta());


        $currentUserInfo = Location::get(request()->ip());
        $news_viewers = new NewsViewer();
        $news_viewers->news_id = $news->id;
        $news_viewers->ip = request()->ip();
        if ($currentUserInfo) {
            $news_viewers->country = $currentUserInfo->countryName;
            $news_viewers->city = $currentUserInfo->cityName;
            $news_viewers->region = $currentUserInfo->regionName;
            $news_viewers->postal_code = $currentUserInfo->postalCode;
            $news_viewers->latitude = $currentUserInfo->latitude;
            $news_viewers->longitude = $currentUserInfo->longitude;
            $news_viewers->timezone = $currentUserInfo->timezone;
        }
        $news_viewers->user_agent = Agent::getUserAgent();
        $news_viewers->platform = Agent::platform();
        $news_viewers->browser = Agent::browser();
        $news_viewers->device = Agent::device();
        $news_viewers->save();


        return view('front.pages.news.detail', $data);
    }

    public function category($slug)
    {
        $category = NewsCategory::where('slug', $slug)->first();
        $data = [
            'category' => $category,
            'latest_news' => News::latest()
                ->with(['category', 'user', 'viewers', 'comments'])
                ->where('status', 'published')
                ->limit(4)
                ->get(),
            'categories' => NewsCategory::with('news')->get(),
            'list_news' => News::latest()
                ->with(['category', 'user', 'viewers', 'comments'])
                ->where('status', 'published')
                ->where('category_id', $category->id)
                ->paginate(6),
        ];
        $data = array_merge($data, $this->newsMeta());
        return view('front.pages.news.index', $data);
    }

    public function comment(Request $request, $slug)
    {
        // if (Auth::check()) {
        //     $validator = Validator::make($request->all(), [
        //         'comment' => 'required',
        //     ], [
        //         'comment.required' => 'Komentar harus diisi',
        //     ]);

        //     if ($validator->fails()) {
        //         Alert::error('Error', $validator->errors()->all());
        //         return redirect()->back()->withInput()->withErrors($validator);
        //     }
        // } else {

        //     $validator = Validator::make($request->all(), [
        //         'name' => 'required',
        //         'email' => 'required|email',
        //         'comment' => 'required',
        //     ], [
        //         'name.required' => 'Nama harus diisi',
        //         'email.required' => 'Email harus diisi',
        //         'email.email' => 'Email tidak valid',
        //         'comment.required' => 'Komentar harus diisi',
        //     ]);

        //     if ($validator->fails()) {
        //         Alert::error('Error', $validator->errors()->all());
        //         return redirect()->back()->withInput()->withErrors($validator);
        //     }
        // }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'comment' => 'required',
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'comment.required' => 'Komentar harus diisi',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $news = News::where('slug', $slug)->firstOrFail();

        $comment = new NewsComment();
        $comment->news_id = $news->id;
        // if (Auth::check()) {
        //     $comment->user_id = Auth::user()->id;
        //     $comment->name = Auth::user()->name;
        //     $comment->email = Auth::user()->email;
        // } else {
        //     $comment->name = $request->name;
        //     $comment->email = $request->email;
        // }

        $comment->name = $request->name;
        $comment->email = $request->email;

        $comment->comment = $request->comment;
        $comment->save();

        Alert::success('Success', 'Komentar berhasil di posting');
        return redirect()->back();
    }
}
