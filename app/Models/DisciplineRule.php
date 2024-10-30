<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DisciplineRule extends Model
{
    protected $table = 'discipline_rule';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'discipline_student', 'discipline_rule_id', 'student_id');
    }
}
