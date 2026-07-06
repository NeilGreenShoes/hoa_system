<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Address;

class Staff extends Model
{
    protected $table = 'staffs';
    protected $primaryKey = 'staffID';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'lastName',
        'firstName', 
        'middleName',
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

    public function fullName()
    {
        return $this->lastName . ', ' . $this->firstName . ' ' . $this->middleName;
    }

    public function name()
    {
        return $this->firstName . ' ' . $this->middleName[0] . '. ' . $this->lastName;
    }
}
