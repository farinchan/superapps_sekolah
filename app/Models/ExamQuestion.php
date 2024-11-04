<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{
    protected $table = 'exam_question';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function multipleChoice()
    {
        return $this->hasMany(ExamQuestionMultipleChoice::class, 'exam_question_id');
    }

    public function matchingPairs()
    {
        return $this->hasMany(ExamQuestionMatchingPair::class, 'exam_question_id');
    }
}
