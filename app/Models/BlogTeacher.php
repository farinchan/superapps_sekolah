<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class BlogTeacher extends Model
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logUnguarded()
        ->logOnlyDirty()
        ->setDescriptionForEvent(fn (string $eventName) => "This model has been {$eventName}");
    }

    protected $table = 'blog_teacher';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function comments()
    {
        return $this->hasMany(BlogTeacherComment::class);
    }

    public function viewers()
    {
        return $this->hasMany(BlogTeacherViewer::class);
    }

    public function getThumbnail()
    {
        return $this->thumbnail ? Storage::url($this->thumbnail) : asset('img_ext/no-image.png');
    }
}
