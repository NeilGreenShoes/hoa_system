<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillingItems extends Model
{
    protected $table = 'billing_line';
    protected $primaryKey = 'billing_lineID';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'billingID',
        'billing_type',
        'description',
        'amount',
        'created_at',
        'updated_at',
    ];

    public function billing(){
        return $this->belongsTo(Billing::class, 'billingID', 'billingID');
    }
}
