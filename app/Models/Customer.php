<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'customer_name', 
        'email', 
        'phone_number', 
        'address',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getPurchaseCountAttribute() {
        return \App\Models\Transaction::where('customer_name', $this->customer_name)->count();
    }
}
