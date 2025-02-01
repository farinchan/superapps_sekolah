<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Student extends Model
{

    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logUnguarded()
        ->logOnlyDirty()
        ->setDescriptionForEvent(fn (string $eventName) => "This model has been {$eventName}");
    }

    protected $table = 'student';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function classroomStudent()
    {
        return $this->hasMany(ClassroomStudent::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function billing_payment()
    {
        return $this->hasMany(BillingPayment::class, 'student_id', 'id');
    }

    public function getPhoto(){
        return $this->photo ? Storage::url($this->photo) : asset('img_ext/anonim_person.png');
    }

    public function BillingMonthlyStudentPayment()
    {
        return $this->hasMany(BillingMonthlyStudentPayment::class);
    }

}
