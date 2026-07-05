<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Houselots extends Model
{
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
}
