<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Perusahaan</title>
    <style>
        /* Gaya Dasar Halaman */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Gaya Header Merah Sesuai Gambar */
        .header {
            background-color: #cc0000; /* Merah pekat */
            padding: 20px;
            box-shadow: 0 5px 10px rgba(0,0,0,0.2); /* Bayangan di bawah header */
            position: relative;
            z-index: 10;
        }

        .header-left {
            display: flex;
            align-items: center;
        }

        /* Kotak Logo P Sesuai Gambar */
        .logo-box {
            width: 75px;
            height: 75px;
            background-color: white;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: bold;
            color: #cc0000;
            font-family: 'Times New Roman', Times, serif; /* P serif sesuai gambar */
        }

        .logo-box img {
            width: 100%;
            height: 100%;
            object-fit: contain; /* Menjaga proporsi gambar agar tidak gepeng */
        }

        /* Area Konten Utama */
        .content-area {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* Kotak Putih Form Sesuai Gambar */
        .login-box {
            background-color: white;
            border: 1px solid #999;
            width: 100%;
            max-width: 350px;
            padding: 30px;
            position: relative;
        }

        /* Gaya Label (Email, Password) */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        /* Gaya Input Bulat Sesuai Gambar */
        .form-group input {
            width: 100%;
            padding: 8px 0px; 
            border: 2px solid #333; 
            border-radius: 20px; 
            box-sizing: border-box; 
            margin-left: -5px; 
            padding-left: 10px; 
            outline: none; 
        }

        /* Menampilkan Error Merah di Bawah Input */
        .error-message {
            color: #cc0000;
            font-size: 12px;
            margin-top: 5px;
            padding-left: 10px;
        }

        /* Area Tombol Login Sesuai Gambar (Diposisikan kanan bawah) */
        .login-button-container {
            display: flex;
            justify-content: flex-end; 
            margin-top: 25px;
        }

        /* Gaya Tombol Bulat Putih-Merah Sesuai Gambar */
        .login-submit {
            background-color: white;
            color: #cc0000; 
            border: 2px solid #cc0000; 
            border-radius: 15px; 
            padding: 2px 20px; 
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        /* Sedikit Efek saat Diarahkan Mouse */
        .login-submit:hover {
            background-color: #cc0000;
            color: white;
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="header-left">
            <div class="logo-box">
                {{-- Ganti 'logo.png' sesuai nama file Anda di public/images/ --}}
                <img src="{{ asset('./images/logo bisnis pcraft.png') }}" alt="logo bisnis pcraft.png">
            </div>
        </div>
    </div>

    <div class="content-area">
        <div class="login-box">
            
            <form method="POST" action="{{ route('login') }}">
                @csrf <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                    
                    @if ($errors->has('email'))
                        <div class="error-message">{{ $errors->first('email') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    
                    @if ($errors->has('password'))
                        <div class="error-message">{{ $errors->first('password') }}</div>
                    @endif
                </div>

                <div class="login-button-container">
                    <button type="submit" class="login-submit">Login</button>
                </div>
            </form>

        </div>
    </div>

</body>
</html>