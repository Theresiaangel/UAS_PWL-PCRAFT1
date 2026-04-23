<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected $fillable = [
    'nama_customer', 
    'email', 
    'nomor_telepon', // Pastikan ini ada dan ejaannya sama dengan di database
    'alamat'
];
}
