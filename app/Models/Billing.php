<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
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


}
