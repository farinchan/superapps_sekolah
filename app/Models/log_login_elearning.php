<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class log_login_elearning extends Model
{
    protected $table = 'log_login_elearning';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
