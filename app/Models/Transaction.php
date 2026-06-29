<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'date', 
        'product_description', 
        'quantity', 
        'unit_price', 
        'total',
        'nama_pembeli',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}