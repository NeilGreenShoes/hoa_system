<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = 'payment_methods';
    protected $primaryKey = 'paymentMethodID';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'methodName',
    ];

    public function payments()
    {
        return $this->hasMany(Payments::class, 'paymentMethodID', 'paymentMethodID');
    }
}
