<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class WaterReading extends Model
{
    use HasFactory;
    protected $table = 'water_readings';
    protected $primaryKey = 'waterReadingID';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'previousReading',
        'currentReading',
        'consumption',
        'readingImage',
        'readingDate',
        'amount',
        'membershipID',
        'staffID',
        'created_at',
        'updated_at',
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
