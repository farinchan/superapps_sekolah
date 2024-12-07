<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class DisciplineStudent extends Model
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logUnguarded()
        ->logOnlyDirty()
        ->setDescriptionForEvent(fn (string $eventName) => "This model has been {$eventName}");
    }

    protected $table = 'discipline_student';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function rules()
    {
        return $this->belongsTo(DisciplineRule::class, 'discipline_rule_id');
    }

    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function teachers()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
