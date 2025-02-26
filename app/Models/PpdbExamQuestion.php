<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PpdbExamQuestion extends Model
{
    protected $table = 'ppdb_exam_question';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function multipleChoice()
    {
        return $this->hasMany(PpdbExamQuestionMultipleChoice::class, 'ppdb_exam_question_id');
    }

    public function examAnswer()
    {
        return $this->hasMany(PpdbExamAnswer::class, 'ppdb_exam_question_id');
    }

    public function getImage()
    {
        return $this->question_image ? Storage::url($this->question_image) : null;
    }
}
