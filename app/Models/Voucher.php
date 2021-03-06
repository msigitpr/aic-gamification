<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = "vouchers";

    protected $fillable = [
        'code',
        'customer_id',
        'locked_at',
        'expired_at',
        'redeemed'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }
}
