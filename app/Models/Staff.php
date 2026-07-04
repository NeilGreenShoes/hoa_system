<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Address;

class Staff extends Model
{
    protected $table = 'staff';
    protected $primaryKey = 'staffID';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'lastname',
        'firstname', 
        'middlename',
        'dateOfBirth',
        'gender',
        'maritalStatus',
        'contactNumber',
        'email',
        'profileImage',
        'userID',
        'addressID',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'addressID', 'addressID');
    }
}
