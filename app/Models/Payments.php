<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payments extends Model
{
    use HasFactory;
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
        'created_at',
        'updated_at',
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
