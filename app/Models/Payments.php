<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'paymentID';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    public $fillable = [
        'amount',
        'discount',
        'paymentDate',
        'paymentMethodID',
        'billingID',
        'staffID',
    ];

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'paymentMethodID', 'paymentMethodID');
    }

    public function billing()
    {
        return $this->belongsTo(Billing::class, 'billingID', 'billingID');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staffID', 'staffID');
    }
}
