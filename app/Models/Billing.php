<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    protected $table = 'billing';
    protected $guarded = ["id", "created_at", "updated_at"];

    public function billing_payment()
    {
        return $this->hasMany(BillingPayment::class);
    }

    public function billing_classroom()
    {
        return $this->hasMany(BillingClassroom::class);
    }
}
