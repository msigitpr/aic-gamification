<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseTransaction extends Model
{
    protected $table = "purchase_transaction";

    protected $fillable = [
        'customer_id',
        'total_spent',
        'total_saving'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }
}
