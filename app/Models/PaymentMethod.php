<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentMethod extends Model
{
    use HasFactory;
    protected $table = 'payment_methods';
    protected $primaryKey = 'paymentMethodID';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'methodName',
        'created_at',
        'updated_at',
    ];

    public function payments()
    {
        return $this->hasMany(Payments::class, 'paymentMethodID', 'paymentMethodID');
    }
}
