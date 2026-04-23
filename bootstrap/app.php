<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    
    ->withMiddleware(function (Middleware $middleware): void {
        // Mendaftarkan alias middleware admin Anda
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
        ]);

        // MENGUBAH TUJUAN REDIRECT SETELAH LOGIN
        $middleware->redirectTo(
            guests: '/login',
            users: '/transactions', // Diarahkan ke sini setelah login berhasil
        );
    })
    
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();