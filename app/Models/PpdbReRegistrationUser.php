<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbReRegistrationUser extends Model
{
    protected $table = 'ppdb_re_registration_user';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function registration()
    {
        return $this->belongsTo(PpdbRegistrationUser::class, 'ppdb_registration_user_id');
    }

    public function user()
    {
        return $this->belongsTo(PpdbUser::class, 'ppdb_user_id');
    }
}
