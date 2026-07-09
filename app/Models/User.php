<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;


class User extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $table = 'users';
    protected $primaryKey = 'userID';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'loginEmail',
        'password',
        'status',
        'isLoggedIn',
        'lastSession',
        'roleID',
        'created_at',
        'updated_at',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'roleID', 'roleID');
    }

    public function staff()
    {
        return $this->hasOne(Staff::class, 'userID', 'userID');
    }
}
