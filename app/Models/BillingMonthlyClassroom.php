<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillingMonthlyClassroom extends Model
{
    protected $table = 'billing_monthly_classroom';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function billingMonthly()
    {
        return $this->belongsTo(BillingMonthly::class);
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
