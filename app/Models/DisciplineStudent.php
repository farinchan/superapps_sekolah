<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DisciplineStudent extends Model
{

    protected $table = 'discipline_student';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function rules()
    {
        return $this->belongsTo(DisciplineRules::class, 'discipline_rule_id');
    }

    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function teachers()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
