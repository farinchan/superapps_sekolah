<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    public function studentAchievement(){
        $data = [
            'title' => 'Prestasi Siswa',
            'menu' => 'Prestasi',
            'sub_menu' => 'Siswa',

        ];

        return view('back.pages.achievement.student', $data);
}
