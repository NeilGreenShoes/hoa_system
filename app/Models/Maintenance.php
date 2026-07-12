<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Maintenance extends Model
{
    use HasFactory;
    protected $table = 'maintenance_requests';
    protected $primaryKey = 'maintenanceID';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'title',
        'category',
        'description',
        'attachedFile',
        'requestDate',
        'status',
        'membershipID', 
        'staffID',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'requestDate' => 'datetime',
    ];

    public function membership()
    {
        return $this->belongsTo(Membership::class, 'membershipID', 'membershipID');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staffID', 'staffID');
    }
}
