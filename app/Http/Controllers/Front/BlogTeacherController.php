<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\BlogTeacher;
use App\Models\BlogTeacherComment;
use App\Models\BlogTeacherViewer;
use App\Models\SettingWebsite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Agent\Facades\Agent;
use RealRashid\SweetAlert\Facades\Alert;
use Stevebauman\Location\Facades\Location;

class BlogTeacherController extends Controller
{
    public function index()
    {
        $setting_web = SettingWebsite::first();
        $search = request()->input('q');

        $data = [
            'title' => 'Blog Guru | ' . $setting_web->name,
            'meta_description' => strip_tags($setting_web->about),
            'meta_keywords' => 'Blog Guru, Guru, MAN 1 Padang Panjang, Padang Panjang',
            'favicon' => $setting_web->favicon,
            'setting_web' => $setting_web,

            'list_blog_teacher' => BlogTeacher::latest()
                ->with(['teacher', 'comments'])
                ->where('status', 'published')->where(function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('content', 'like', '%' . $search . '%');
                })
                ->paginate(6),
        ];

        return view('front.pages.blog_teacher.index', $data);
    }

    public function show($slug)
    {
        $setting_web = SettingWebsite::first();
        $blog_teacher = BlogTeacher::where('slug', $slug)->first();
        $data = [
            'title' => $blog_teacher->title . ' | Blog Guru | ' . $setting_web->name,
            'meta_description' => strip_tags($blog_teacher->content),
            'meta_keywords' => $blog_teacher->meta_keywords . $blog_teacher->teacher->name,
            'favicon' => $setting_web->favicon,
            'setting_web' => $setting_web,

            'blog_teacher' => $blog_teacher,
            'related_blog_teacher' => BlogTeacher::latest()
                ->with(['teacher', 'comments'])
                ->where('teacher_id', $blog_teacher->teacher_id)
                ->where('id', '!=', $blog_teacher->id)
                ->limit(2)
                ->get(),
            'comments' => $blog_teacher->comments()->where('status', 'approved')->get(),
            'next_blog_teacher' => BlogTeacher::where('id', '>', $blog_teacher->id)->first(),
            'prev_blog_teacher' => BlogTeacher::where('id', '<', $blog_teacher->id)->first(),
        ];

        $currentUserInfo = Location::get(request()->ip());
        $blog_teacher_viewers = new BlogTeacherViewer();
        $blog_teacher_viewers->blog_teacher_id = $blog_teacher->id;
        $blog_teacher_viewers->ip = request()->ip();
        if ($currentUserInfo) {
            $blog_teacher_viewers->country = $currentUserInfo->countryName;
            $blog_teacher_viewers->city = $currentUserInfo->cityName;
            $blog_teacher_viewers->region = $currentUserInfo->regionName;
            $blog_teacher_viewers->postal_code = $currentUserInfo->postalCode;
            $blog_teacher_viewers->latitude = $currentUserInfo->latitude;
            $blog_teacher_viewers->longitude = $currentUserInfo->longitude;
            $blog_teacher_viewers->timezone = $currentUserInfo->timezone;
        }
        $blog_teacher_viewers->user_agent = Agent::getUserAgent();
        $blog_teacher_viewers->platform = Agent::platform();
        $blog_teacher_viewers->browser = Agent::browser();
        $blog_teacher_viewers->device = Agent::device();
        $blog_teacher_viewers->save();

        return view('front.pages.blog_teacher.detail', $data);
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

        $blog_teacher = BlogTeacher::where('slug', $slug)->firstOrFail();

        $comment = new BlogTeacherComment();
        $comment->blog_teacher_id = $blog_teacher->id;
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
