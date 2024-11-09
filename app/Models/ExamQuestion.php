<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
    

    public function getImage()
    {
        return $this->question_image ? Storage::url($this->question_image) : null;
    }
}
