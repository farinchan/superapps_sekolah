<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbRegistrationUser extends Model
{
    protected $table = 'ppdb_registration_user';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function path()
    {
        return $this->belongsTo(PpdbPath::class, 'ppdb_path_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(PpdbUser::class, 'ppdb_user_id', 'id');
    }
}
