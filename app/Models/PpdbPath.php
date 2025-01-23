<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbPath extends Model
{
    protected $table = 'ppdb_path';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class, 'school_year_id');
    }

    public function registrationUsers()
    {
        return $this->hasMany(PpdbRegistrationUser::class);
    }
}
