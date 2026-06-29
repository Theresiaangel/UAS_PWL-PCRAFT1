<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistem Penjualan | Welcome</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <style>
            body {
                font-family: 'Instrument Sans', sans-serif;
                background-color: #fdfdfc;
                margin: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh;
                color: #1b1b18;
            }
            .welcome-container {
                text-align: center;
                padding: 40px;
                background: white;
                box-shadow: 0 10px 30px rgba(0,0,0,0.05);
                border-radius: 30px;
                border: 1px solid #e3e3e0;
                max-width: 500px;
            }
            h1 {
                font-family: 'Times New Roman', serif;
                font-size: 3rem;
                margin-bottom: 10px;
                font-weight: bold;
            }
            p {
                color: #706f6c;
                margin-bottom: 30px;
            }
            .btn-group {
                display: flex;
                gap: 15px;
                justify-content: center;
            }
            .btn {
                padding: 12px 30px;
                border-radius: 50px;
                text-decoration: none;
                font-weight: bold;
                transition: 0.3s;
            }
            .btn-login {
                background: #ce1212;
                color: white;
            }
            .btn-login:hover {
                background: #a00d0d;
            }
            .btn-dashboard {
                border: 2px solid #ce1212;
                color: #ce1212;
            }
            .btn-dashboard:hover {
                background: #fff2f2;
            }
        </style>
    </head>
    <body>
        <div class="welcome-container">
            <h1>PCRAFT</h1>
            <p>Selamat datang di aplikasi manajemen transaksi Pcraft. Kelola transaksi penjualan dan daftar customer dengan lebih mudah dan cepat.</p>

            <div class="btn-group">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-dashboard">Buka Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-login">Log in</a>
                    @endauth
                @endif
            </div>
        </div>
    </body>
</html>