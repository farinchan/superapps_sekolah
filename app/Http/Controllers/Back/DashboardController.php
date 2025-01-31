<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\BlogTeacher;
use App\Models\BlogTeacherViewer;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsComment;
use App\Models\NewsViewer;
use App\Models\GalleryAlbum;
use App\Models\LogLogin;
use App\Models\LogLoginElearning;
use App\Models\PpdbRegistrationUser;
use App\Models\PpdbUser;
use App\Models\SchoolYear;
use App\Models\StudentAttendance;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Saya',
            'menu' => 'dashboard',

        ];
        if (Auth::user()->hasRole('guru')) {
            $data['blog_popular'] = BlogTeacher::with('comments')->where('teacher_id', Auth::user()->teacher->id)->withCount('viewers')->orderBy('viewers_count', 'desc')->limit(8)->get();
            $data['blog_new'] = BlogTeacher::with(['comments', 'viewers'])->where('teacher_id', Auth::user()->teacher->id)->latest()->limit(5)->get();
        }

        if (Auth::user()->hasRole('siswa')) {
            $data['my_attendance_now'] = StudentAttendance::where('student_id', Auth::user()->student->id)->whereDate('created_at', date('Y-m-d'))->first();
        }

        // return response()->json($data);
        return view('back.pages.dashboard.index', $data);
    }
    public function indexStat()
    {

        $data = [
            'blog_viewer_monthly' => BlogTeacherViewer::select(DB::raw('Date(created_at) as date'), DB::raw('count(*) as total'))
                ->whereHas('blogTeacher', function ($query) {
                    $query->where('teacher_id', Auth::user()->teacher->id);
                })
                ->orderBy('date', 'desc')
                ->limit(30)
                ->groupBy('date')
                ->get(),
            'blog_viewer_platfrom' => BlogTeacherViewer::select('platform', DB::raw('count(*) as total'))
                ->whereHas('blogTeacher', function ($query) {
                    $query->where('teacher_id', Auth::user()->teacher->id);
                })
                ->groupBy('platform')
                ->get(),
            'blog_viewer_browser' => BlogTeacherViewer::select('browser', DB::raw('count(*) as total'))
                ->whereHas('blogTeacher', function ($query) {
                    $query->where('teacher_id', Auth::user()->teacher->id);
                })
                ->groupBy('browser')
                ->get(),
        ];
        return response()->json($data);
    }

    public function news()
    {
        $data = [
            'title' => 'Dashboard Berita',
            'menu' => 'dashboard',
            'berita_count' => News::count(),
            'news_popular' => News::with('comments')->withCount('viewers')->orderBy('viewers_count', 'desc')->limit(8)->get(),
            'news_new' => News::with(['comments', 'viewers'])->latest()->limit(5)->get(),
            'news_writer' => news::select(
                DB::raw('count(*) as total'),
                'news.user_id',
                DB::raw('MAX(teacher.name) as name'),
                DB::raw('MAX(teacher.nip) as nip'),
            )
                ->leftJoin('teacher', 'news.user_id', '=', 'teacher.user_id')
                ->groupBy('news.user_id')
                ->orderBy('total', 'desc')
                ->limit(5)
                ->get(),
        ];
        return view('back.pages.dashboard.news', $data);
    }

    public function newsStat()
    {


        $data = [
            'news_viewer_monthly' => NewsViewer::select(DB::raw('Date(created_at) as date'), DB::raw('count(*) as total'))
            ->orderBy('date', 'desc')
                ->limit(30)
                ->groupBy('date')
                ->get(),
            'news_viewer_platfrom' => NewsViewer::select('platform', DB::raw('count(*) as total'))
                ->groupBy('platform')
                ->get(),
            'news_viewer_browser' => NewsViewer::select('browser', DB::raw('count(*) as total'))
                ->groupBy('browser')
                ->get(),
        ];
        return response()->json($data);
    }

    public function log()
    {
        $data = [
            'title' => 'Dashboard log',
            'menu' => 'dashboard',
            'log_login' => LogLogin::with('user')->latest()->get(),
            'log_login_elearning' => LogLoginElearning::with('user')->latest()->get(),
            'log_activity' => Activity::all(),
        ];
        return view('back.pages.dashboard.log', $data);
    }

    public function stat()
    {


        $data = [
            'news_viewer_monthly' => NewsViewer::select(DB::raw('Date(created_at) as date'), DB::raw('count(*) as total'))
                ->limit(30)
                ->groupBy('date')
                ->get(),
            'news_viewer_platfrom' => NewsViewer::select('platform', DB::raw('count(*) as total'))
                ->groupBy('platform')
                ->get(),
            'news_viewer_browser' => NewsViewer::select('browser', DB::raw('count(*) as total'))
                ->groupBy('browser')
                ->get(),
        ];
        return response()->json($data);
    }

    public function ppdbDashboard()
    {
        $data = [
            'title' => 'Dashboard PPDB',
            'menu' => 'dashboard',
            'list_school_year' => SchoolYear::latest()->get(),
            'register_stat' => PpdbUser::select(DB::raw('Date(created_at) as date'), DB::raw('count(*) as total'))
                ->orderBy('date', 'desc')
                ->limit(30)
                ->groupBy('date')
                ->get(),

        ];
        // return response()->json($data);
        return view('back.pages.dashboard.ppdb', $data);
    }

    public function ppdbStat(Request $request)
    {
        $school_year_id = $request->school_year_id;
        if (!$school_year_id) {
            return response()->json(['error' => 'Tahun ajaran tidak ditemukan'], 404);
        }
        $data = [
            'register_path_stat' => PpdbRegistrationUser::select('ppdb_path_id', DB::raw('count(*) as total'), DB::raw('MAX(ppdb_path.name) as name'), DB::raw('MAX(ppdb_path.description) as description'))
                ->whereHas('path', function ($query) use ($school_year_id) {
                    $query->where('school_year_id', $school_year_id);
                })
                ->leftJoin('ppdb_path', 'ppdb_registration_user.ppdb_path_id', '=', 'ppdb_path.id')
                ->groupBy('ppdb_path_id')
                ->get()
                ->map(function ($item) {
                    $total = PpdbRegistrationUser::count();
                    $item->percentage = $total ? ($item->total / $total) * 100 : 0;
                    return $item;
                }),

        ];
        return response()->json($data);
    }
}
