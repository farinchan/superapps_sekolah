<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subject';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function exam()
    {
        return $this->hasMany(Exam::class);
    }
}
