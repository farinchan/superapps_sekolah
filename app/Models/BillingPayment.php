<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class BillingPayment extends Model
{
    protected $table = 'billing_payment';
    protected $guarded = ["id", "created_at", "updated_at"];

    public function billing()
    {
        return $this->belongsTo(Billing::class);
    }

    public function parent_student()
    {
        return $this->belongsTo(ParentStudent::class, 'parent_student_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function getImage()
    {
        return Storage::url($this->image);
    }
}
