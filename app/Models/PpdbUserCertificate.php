<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbUserCertificate extends Model
{

    protected $table = 'ppdb_user_certificate';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(PpdbUser::class, 'ppdb_user_id');
    }
}
