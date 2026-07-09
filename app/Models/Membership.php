<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Membership extends Model
{
    use HasFactory;
    protected $table = 'memberships';
    protected $primaryKey = 'membershipID';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'membershipStartDate',
        'memberShipEndDate',
        'status',
        'homeownerID',
        'houseLotID',
        'registrationID',
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

    public function registration()
    {
        return $this->belongsTo(Registrations::class, 'registrationID', 'registrationID');
    }
}
