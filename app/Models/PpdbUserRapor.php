<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbUserRapor extends Model
{
    protected $table = 'ppdb_user_rapor';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'semester1_nilai' => 'array',
        'semester2_nilai' => 'array',
        'semester3_nilai' => 'array',
        'semester4_nilai' => 'array',
        'semester5_nilai' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(PpdbUser::class, 'ppdb_user_id');
    }
}
