<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registrations extends Model
{
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
        return $this->belongsTo(User::class, 'staffID', 'userID');
    }
}
