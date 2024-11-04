<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamQuestionMatchingPair extends Model
{
    protected $table = 'exam_question_matching_pair';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function question()
    {
        return $this->belongsTo(ExamQuestion::class, 'exam_question_id');
    }
}
