<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Houselots extends Model
{
    use HasFactory;
    protected $table = "house_lots";
    protected $primaryKey = "houseLotID";
    protected $keyType = "int";
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'lotNumber',
        'blockNumber',
        'homeownerID',
        'occupancyStatus',
        'lastVerifiedDate',
        'created_at',
        'updated_at',
    ];

    public function registrations()
    {
        return $this->hasMany(Registrations::class, 'houseLotID', 'houseLotID');
    }

    public function homeowner()
    {
        return $this->belongsTo(Homeowners::class, 'homeownerID', 'homeownerID');
    }

    public function members()
    {
        return $this->hasMany(Membership::class, 'houseLotID', 'houseLotID');
    }
}
