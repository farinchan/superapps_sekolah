<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillingMonthly extends Model
{
    protected $table = 'billing_monthly';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class);
    }

    public function billing_classroom()
    {
        return $this->hasMany(BillingMonthlyClassroom::class);
    }

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class, 'billing_monthly_classroom', 'billing_monthly_id', 'classroom_id');
    }

    public function payments()
    {
        return $this->hasMany(BillingMonthlyPayment::class);
    }

    public function billing_monthly_student_payment()
    {
        return $this->hasMany(BillingMonthlyStudentPayment::class, 'billing_monthly_id', 'billing_monthly_id');
    }


}
