<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Penjualan</title>
    <style>
        body { margin: 0; font-family: Arial, sans-serif; background-color: #fff; }
        
        /* Custom Table Styles */
        .custom-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background-color: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .custom-table thead {
            background: #d9383e;
            color: white;
        }
        .custom-table th {
            padding: 20px 15px;
            font-size: 14px;
            text-transform: uppercase;
            font-weight: bold;
            border: none;
            text-align: center;
        }
        .custom-table td {
            padding: 18px 15px;
            border-bottom: 2px solid #eaeaea;
            color: #4b4b4b;
            font-weight: bold;
            border-top: none; 
            border-left: none; 
            border-right: none;
            text-align: center;
        }
        .custom-table tbody tr:last-child td {
            border-bottom: none;
        }

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
            padding: 10px 20px; border-radius: 10px;
        }

        /* Tombol Aktif dengan Shadow */
        .nav-link.active {
            background: #b30000; /* Darker red */
            box-shadow: 5px 5px 15px rgba(0,0,0,0.5);
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

        /* Dropdown Menu */
        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            top: 50px;
            background-color: white;
            min-width: 150px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 8px;
            overflow: hidden;
        }

        .dropdown-content a, .dropdown-content button {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            font-size: 16px;
            cursor: pointer;
        }

        .dropdown-content a:hover, .dropdown-content button:hover {
            background-color: #f1f1f1;
        }

        .dropdown-content.show {
            display: block;
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
            <a href="{{ route('dashboard') }}" class="nav-link {{ Request::is('dashboard*') || Request::is('/') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('transactions.index') }}" class="nav-link {{ Request::is('transactions*') ? 'active' : '' }}">Transaksi Penjualan</a>
            <a href="{{ route('customers.index') }}" class="nav-link {{ Request::is('customers*') ? 'active' : '' }}">Daftar Customer</a>
        </div>

        <div class="header-right" style="position: relative;">
            <div id="hamburger-menu" style="cursor: pointer; display: flex; flex-direction: column; gap: 6px; padding: 5px;" onclick="toggleDropdown(event)">
                <div style="width: 35px; height: 5px; background-color: white; border-radius: 3px;"></div>
                <div style="width: 35px; height: 5px; background-color: white; border-radius: 3px;"></div>
                <div style="width: 35px; height: 5px; background-color: white; border-radius: 3px;"></div>
            </div>

            <div id="dropdown-menu" class="dropdown-content">
                <a href="{{ route('profile.edit') }}">Profil</a>
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" onclick="return confirm('Yakin ingin keluar?')">Logout</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            timer: 3000,
            showConfirmButton: false
        });
    </script>
    @endif

</body>
<script>
    function toggleDropdown(event) {
        event.stopPropagation();
        document.getElementById('dropdown-menu').classList.toggle('show');
    }

    window.onclick = function(event) {
        if (!event.target.matches('#hamburger-menu') && !event.target.closest('#hamburger-menu')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>
</html>