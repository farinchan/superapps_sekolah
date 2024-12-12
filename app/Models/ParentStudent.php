<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ParentStudent extends Model
{
    protected $table = 'parent_student';
    protected $guarded = ["id", "created_at", "updated_at"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function getPhoto(){
        return $this->photo ? Storage::url($this->photo) : asset('img_ext/anonim_person.png');
    }
}
