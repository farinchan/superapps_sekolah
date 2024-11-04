<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamClassroom extends Model
{
    protected $table = 'exam_classroom';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function Exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function Classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
}
