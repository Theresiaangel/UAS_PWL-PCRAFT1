<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Penjualan</title>
    <style>
        body { margin: 0; font-family: Arial, sans-serif; background-color: #fff; }
        
        /* Header Merah */
        .header {
            background-color: #cc0000;
            padding: 20px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between; /* Menjaga logo di kiri dan logout di kanan */
            box-shadow: 0 8px 15px rgba(0,0,0,0.2);
        }

        .header-left {
            display: flex;
            align-items: center;
        }

        .logo-box {
            width: 75px; 
            height: 75px;
            background-color: white; 
            border-radius: 8px;
            display: flex; 
            align-items: center; 
            justify-content: center;
            margin-right: 50px;
            overflow: hidden; /* Memastikan gambar tetap di dalam kotak */
        }

        /* Styling Gambar Logo */
        .logo-box img {
            width: 100%;
            height: 100%;
            object-fit: contain; /* Menjaga proporsi gambar agar tidak gepeng */
        }

        .nav-link {
            color: white; text-decoration: none;
            font-size: 18px; font-weight: bold; margin-right: 40px;
        }

        /* Tombol Aktif dengan Shadow */
        .nav-link.active {
            background: rgba(255,255,255,0.2);
            padding: 10px 20px; border-radius: 20px;
            box-shadow: inset 0 0 10px rgba(0,0,0,0.3);
        }

        /* Styling Tombol Logout */
        .logout-btn {
            background-color: white;
            color: #cc0000;
            border: none;
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background-color: #f2f2f2;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .container { padding: 40px; }

        /* Styling Tabel Global */
        table {
            width: 100%; border-collapse: collapse;
            margin-top: 20px; border: 2px solid #000;
        }

        th, td {
            border: 1px solid #000; padding: 15px;
            text-align: center; height: 40px;
        }

        th { font-weight: bold; }

        /* Ikon Aksi (Edit, Hapus, Tambah) */
        .action-icons {
            display: flex; justify-content: flex-end;
            gap: 15px; margin-bottom: 10px;
        }

        .icon { font-size: 30px; color: #888; text-decoration: none; cursor: pointer; }
        .icon:hover { color: #333; }
    </style>
</head>

<body>
    <div class="header">
        <div class="header-left">
            <div class="logo-box">
                <img src="{{ asset('./images/logo bisnis pcraft.png') }}" alt="logo bisnis pcraft.png">
            </div>
            <a href="{{ route('transactions.index') }}" class="nav-link {{ Request::is('transactions*') ? 'active' : '' }}">Transaksi Penjualan</a>
            <a href="{{ route('customers.index') }}" class="nav-link {{ Request::is('customers*') ? 'active' : '' }}">Daftar Customer</a>
        </div>

        <div class="header-right">
            <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Yakin ingin keluar?')">
                @csrf
                <button type="submit" class="logout-btn">
                    <span style="font-size: 20px;">⏻</span> Logout
                </button>
            </form>
        </div>
    </div>

    <div class="container">
        @yield('content')
    </div>

</body>
</html>