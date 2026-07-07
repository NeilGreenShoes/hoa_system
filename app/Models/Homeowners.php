<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Homeowners extends Model
{
    protected $table = "homeowners";
    protected $primaryKey = "homeownerID";
    protected $keyType = "int";
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'firstName',
        'middleName',
        'lastName',
        'dateOfBirth',
        'gender',
        'religion',
        'maritalStatus',
        'contactNumber',
        'email',
        'profileImage',
        'userID',
        'addressID',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'addressID', 'addressID');
    }

    public function fullname()
    {
        return $this->lastName . ', ' . $this->firstName . ' ' . $this->middleName[0] . '.'; 
    }

}
