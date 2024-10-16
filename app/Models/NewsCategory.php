<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    use HasFactory;

    protected $table = 'news_category';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function news()
    {
        return $this->hasMany(News::class, 'category_id');
    }
}
