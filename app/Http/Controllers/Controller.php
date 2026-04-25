<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected $fillable = [
    'nama_customer', 
    'email', 
    'nomor_telepon', //
    'alamat'
];
}
