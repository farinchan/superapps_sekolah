<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    protected $table = 'school_year';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }
}
