<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OwnershipTransfers extends Model
{
    protected $table = 'ownership_transfers';
    protected $primaryKey = 'ownershipTransferID';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'reason',
        'documentImage',
        'transferDate',
        'approveDate',
        'status',
        'membershipID',
        'homeownerID',
        'staffID',
        'created_at',
        'updated_at',
    ];

    public function member()
    {
        return $this->belongsTo(Membership::class, 'membershipID', 'membershipID');
    }

    public function homeowner()
    {
        return $this->belongsTo(Homeowners::class, 'homeownerID', 'homeownerID');
    }
    
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staffID', 'staffID');
    }
    
}
