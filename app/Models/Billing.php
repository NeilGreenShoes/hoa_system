<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Billing extends Model
{
    use HasFactory;
    protected $table = 'billings';
    protected $primaryKey = 'billingID';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'billingDate',
        'dueDate',
        'monthlyDue',
        'securityFee',
        'penaltyFee',
        'reconnectionFee',
        'arrears',
        'totalAmount',
        'status',
        'seniorDiscountEligible',
        'waterReadingID',
        'membershipID',
        'staffID',
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'billingDate' => 'datetime',
        'dueDate' => 'datetime',
    ];

    public function waterReading()
    {
        return $this->belongsTo(WaterReading::class, 'waterReadingID', 'waterReadingID');
    }

    public function membership()
    {
        return $this->belongsTo(Membership::class, 'membershipID', 'membershipID');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staffID', 'staffID');
    }

    public function payment()
    {
        return $this->hasOne(Billing::class, 'billingID', 'billingID');
    }
}
