<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    protected $table = 'user_log';
    protected $primaryKey = 'logId';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    public $fillable = [
        'userID',
        'device',
        'agent',
        'ip_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }
}
