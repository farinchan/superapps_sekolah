<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Event extends Model
{

    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable()
        ->logOnlyDirty()
        ->setDescriptionForEvent(fn (string $eventName) => "This model has been {$eventName}");
    }

    protected $table = 'event';
    protected $fillable = [
        'title',
        'content',
        'image',
        'file',
        'slug',
        'is_active',
        'start',
        'end',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getImage()
    {
        return $this->image ? Storage::url($this->image) : asset('back/media/svg/files/blank-image.svg');
    }

    public function getFile()
    {
        return $this->file ? Storage::url($this->file) : null;
    }
}
