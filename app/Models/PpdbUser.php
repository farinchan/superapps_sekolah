<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PpdbUser extends Authenticatable
{
    use Notifiable;


    protected $table = 'ppdb_user';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $hidden = [
        'password'
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'additional_data' => 'array'
        ];
    }

    public function certificate()
    {
        return $this->hasMany(PpdbUserCertificate::class, 'ppdb_user_id');
    }

}
