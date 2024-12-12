<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillingClassroom extends Model
{
    protected $table = 'billing_classroom';
    protected $guarded = ["id", "created_at", "updated_at"];

    public function billing()
    {
        return $this->belongsTo(Billing::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function classroom_student()
    {
        return $this->hasMany(ClassroomStudent::class, 'classroom_id', 'classroom_id');
    }

    public function billing_payment()
    {
        return $this->hasMany(BillingPayment::class, 'billing_id', 'billing_id');
    }
}
