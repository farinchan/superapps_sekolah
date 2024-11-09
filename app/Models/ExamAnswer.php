<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamAnswer extends Model
{
    protected $table = 'exam_answer';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $casts = [
        'answer' => 'array',
    ];

    public function ExamSession()
    {
        return $this->belongsTo(ExamSession::class);
    }

    public function ExamQuestion()
    {
        return $this->belongsTo(ExamQuestion::class);
    }

}
