<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamSession extends Model
{
    protected $table = 'exam_session';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function Exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function ExamAnswer()
    {
        return $this->hasMany(ExamAnswer::class);
    }
}