<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbContact extends Model
{
    protected $table = 'ppdb_contact';
    protected $guarded = ['id', 'created_at', 'updated_at'];

}
