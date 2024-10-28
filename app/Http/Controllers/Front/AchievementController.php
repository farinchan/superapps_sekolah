<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\SettingWebsite;
use App\Models\StudentAchievement;
use App\Models\TeacherAchievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    public function student()
    {
        $setting_web = SettingWebsite::first();
        $search = request()->input('q');
        $data = [
            'title' => 'Prestasi Siswa | ' . $setting_web->name,
            'meta_description' => strip_tags($setting_web->about),
            'meta_keywords' => 'Prestasi Siswa, Siswa, MAN 1 Padang Panjang, Padang Panjang',
            'favicon' => $setting_web->favicon,
            'setting_web' => $setting_web,

            'list_achievement' => StudentAchievement::latest()->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('event', 'like', '%' . $search . '%');
            })->paginate(12),
        ];

        return view('front.pages.achievement.index', $data);
    }

    public function teacher()
    {
        $setting_web = SettingWebsite::first();
        $search = request()->input('q');
        $data = [
            'title' => 'Prestasi Guru | ' . $setting_web->name,
            'meta_description' => strip_tags($setting_web->about),
            'meta_keywords' => 'Prestasi Guru, Guru, man 1 padang panjang, padang panjang',
            'favicon' => $setting_web->favicon,
            'setting_web' => $setting_web,

            'list_achievement' => TeacherAchievement::latest()->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('event', 'like', '%' . $search . '%');
            })->paginate(12),

        ];

        return view('front.pages.achievement.index', $data);

    }

    public function studentDetail($id)
    {
        $setting_web = SettingWebsite::first();
        $student_achievement = StudentAchievement::findOrFail($id);
        $data = [
            'title' => $student_achievement->name . ' - ' . $student_achievement->event .' | ' . $setting_web->name,
            'meta_description' => $student_achievement->description,
            'meta_keywords' => 'Prestasi Siswa, Siswa, MAN 1 Padang Panjang, Padang Panjang' . $student_achievement->name . ', ' . $student_achievement->event,
            'favicon' => $setting_web->favicon,
            'setting_web' => $setting_web,

            'achievement' => StudentAchievement::findOrFail($id),
        ];

        return view('front.pages.achievement.show', $data);
    }

    public function teacherDetail($id)
    {
        $setting_web = SettingWebsite::first();
        $teacher_achievement = TeacherAchievement::findOrFail($id);
        $data = [
            'title' => $teacher_achievement->name . ' - ' . $teacher_achievement->event . ' | ' . $setting_web->name,
            'meta_description' => $teacher_achievement->description,
            'meta_keywords' => 'Prestasi Guru, Guru, MAN 1 Padang Panjang, Padang Panjang' . $teacher_achievement->name . ', ' . $teacher_achievement->event,
            'favicon' => $setting_web->favicon,
            'setting_web' => $setting_web,

            'achievement' => TeacherAchievement::findOrFail($id),

        ];

        return view('front.pages.achievement.show', $data);

    }


}
