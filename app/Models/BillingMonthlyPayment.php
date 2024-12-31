<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillingMonthlyPayment extends Model
{
    protected $table = 'billing_monthly_payment';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function billingMonthly()
    {
        return $this->belongsTo(BillingMonthly::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function parentStudent()
    {
        return $this->belongsTo(ParentStudent::class);
    }
}
