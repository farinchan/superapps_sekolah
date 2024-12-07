<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class DisciplineRule extends Model
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logUnguarded()
        ->logOnlyDirty()
        ->setDescriptionForEvent(fn (string $eventName) => "This model has been {$eventName}");
    }

    protected $table = 'discipline_rule';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'discipline_student', 'discipline_rule_id', 'student_id');
    }
}
