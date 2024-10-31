<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Student extends Model
{
    protected $table = 'student';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function classroomStudent()
    {
        return $this->hasMany(ClassroomStudent::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPhoto(){
        return $this->photo ? Storage::url($this->photo) : asset('img_ext/anonim_person.png');
    }

}
