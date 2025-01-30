<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbInformation extends Model
{
    protected $table = 'ppdb_information';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public static function getInformation()
    {
        return self::first();
    }
}
