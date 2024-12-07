<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class StudentAchievement extends Model
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logUnguarded()
        ->logOnlyDirty()
        ->setDescriptionForEvent(fn (string $eventName) => "This model has been {$eventName}");
    }
    protected $table = 'student_achievement';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function getImage(){
        return $this->image ? Storage::url($this->image) : asset('img_ext/no-image.png');
    }

    public function getFile(){
        return Storage::url($this->file);
    }
}
