<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Customer extends Model
{
    protected $table = "customers";

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'date_of_birth',
        'contact_number',
        'email'
    ];

    public function purchaseInMonth() {
        return $this->hasMany('App\Models\PurchaseTransaction', 'customer_id')->where(
            'created_at', '>', Carbon::now()->subDays(30)->toDateTimeString()
        );
    }

    public function sumPurchaseInMonth() {
        return $this->purchaseInMonth->where(  
            'created_at', '>', Carbon::now()->subDays(30)->toDateTimeString()
        )->sum('total_spent');
    }

    public function voucher() {
        return $this->hasOne('App\Models\Voucher', 'customer_id');
    }
}
