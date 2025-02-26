<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbExamSession extends Model
{
    protected $table = 'ppdb_exam_session';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function Exam()
    {
        return $this->belongsTo(PpdbExam::class);
    }

    public function PpdbUser()
    {
        return $this->belongsTo(PpdbUser::class);
    }

    public function ExamAnswer()
    {
        return $this->hasMany(PpdbExamAnswer::class);
    }
}
