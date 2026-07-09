<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Registrations extends Model
{
    use HasFactory;
    protected $table = "registrations";
    protected $primaryKey = "registrationID";
    protected $keyType = "int";
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'registrationID',
        'registrationType',
        'membershipFee',
        'validIDImage',
        'lotDocument',
        'registrationDate',
        'status',
        'remark',
        'homeownerID',
        'houseLotID',
        'userID',
        'staffID',
        'billingID',
        'created_at',
        'updated_at',
    ];

    public function homeowner()
    {
        return $this->belongsTo(Homeowners::class, 'homeownerID', 'homeownerID');
    }

    public function houseLot()
    {
        return $this->belongsTo(Houselots::class, 'houseLotID', 'houseLotID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staffID', 'staffID');
    }

    public function billing()
    {
        return $this->belongsTo(Billing::class, 'billingID', 'billingID');
    }
}
