<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaints extends Model
{
    protected $table = 'complaints';
    protected $primaryKey = 'complaintID';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'title',
        'category',
        'description',
        'attachedFile',
        'severityLevel',
        'submitDate',
        'status',
        'membershipID',
        'staffID',
        'created_at',
        'updated_at',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staffID', 'staffID');
    }

    public function homeowner()
    {
        return $this->belongsTo(Homeowners::class, 'membershipID', 'homeownerID');
    }

    public function membership()
    {
        return $this->belongsTo(Membership::class, 'membershipID', 'homeownerID');
    }
}
