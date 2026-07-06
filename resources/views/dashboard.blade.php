@extends('layouts.admin')

@section('content')
    <div style="margin-top: -20px; margin-bottom: 20px; font-size: 20px; font-weight: bold; color: black; text-align: left; font-family: 'Times New Roman', serif;">
        Selamat Datang di Pcraft,
    </div>

    <div style="display: flex; justify-content: center; gap: 30px; margin-bottom: 40px; flex-wrap: wrap;">
        <!-- Card 1: Total Customer -->
        <div style="background-color: #d9383e; color: white; border-radius: 8px; padding: 15px 20px; width: 260px; display: flex; align-items: center; box-shadow: 4px 4px 8px rgba(0,0,0,0.3); font-family: 'Times New Roman', serif;">
            <div style="margin-right: 15px;">
                <svg width="45" height="45" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
            </div>
            <div style="text-align: center; width: 100%;">
                <div style="font-weight: bold; font-size: 18px; margin-bottom: 5px;">Total Customer</div>
                <div style="font-weight: bold; font-size: 22px;">{{ $totalCustomer }}</div>
            </div>
        </div>

        <!-- Card 2: Total Nominal Penjualan -->
        <div style="background-color: #d9383e; color: white; border-radius: 8px; padding: 15px 20px; width: 260px; display: flex; align-items: center; box-shadow: 4px 4px 8px rgba(0,0,0,0.3); font-family: 'Times New Roman', serif;">
            <div style="margin-right: 15px;">
                <svg width="45" height="45" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 3 L18 3 L14.5 7 L9.5 7 Z" fill="white"/>
                    <path d="M12 7 C4 7, 1 13, 2 19 C3.5 24, 20.5 24, 22 19 C23 13, 20 7, 12 7 Z" fill="white"/>
                    <rect x="8.5" y="6" width="7" height="2.5" rx="1.25" fill="#cc0000"/>
                    <text x="12" y="17.5" text-anchor="middle" font-size="8.5" font-weight="900" font-family="sans-serif" font-style="italic" fill="#cc0000">Rp</text>
                </svg>
            </div>
            <div style="text-align: center; width: 100%;">
                <div style="font-weight: bold; font-size: 16px; line-height: 1.2; margin-bottom: 5px;">Total<br>Hasil Penjualan</div>
                <div style="font-weight: bold; font-size: 22px;">{{ number_format($totalNominal, 0, ',', '.') }}</div>
            </div>
        </div>

        <!-- Card 3: Total Produk -->
        <div style="background-color: #d9383e; color: white; border-radius: 8px; padding: 15px 20px; width: 260px; display: flex; align-items: center; box-shadow: 4px 4px 8px rgba(0,0,0,0.3); font-family: 'Times New Roman', serif;">
            <div style="margin-right: 15px;">
                <svg width="45" height="45" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="9" cy="21" r="2" fill="white"></circle>
                    <circle cx="20" cy="21" r="2" fill="white"></circle>
                    <path d="M1 1h4l1 5"></path>
                    <path d="M6 6l1.68 8.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6Z" fill="white"></path>
                </svg>
            </div>
            <div style="text-align: center; width: 100%;">
                <div style="font-weight: bold; font-size: 18px; margin-bottom: 5px;">Total Produk<br>yang Terjual</div>
                <div style="font-weight: bold; font-size: 22px;">{{ $totalProduk }}</div>
            </div>
        </div>
    </div>
    <div style="text-align: center; margin-top: 20px; margin-bottom: 30px; display: flex; justify-content: center; align-items: center; gap: 10px;">
        <h2 style="font-family: 'Times New Roman', serif; font-weight: bold; color: black; margin: 0; font-size: 36px;">Top Pelanggan Setia Pcraft</h2>
        <svg width="36" height="36" viewBox="0 0 24 24" fill="#d9383e" stroke="#d9383e" stroke-width="1" stroke-linejoin="round" stroke-linecap="round" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
        </svg>
    </div>

    <table class="custom-table">
        <thead>
            <tr>
                <th width="35%">Nama Pembeli</th>
                <th width="35%">Total Hasil Penjualan</th>
                <th width="30%">Jumlah Pembelian</th>
            </tr>
        </thead>
        <tbody>
            @foreach($topBuyers as $buyer)
                <tr>
                    <td>{{ $buyer->customer_name }}</td>
                    <td>Rp {{ number_format($buyer->total_nominal, 0, ',', '.') }}</td>
                    <td>{{ $buyer->total_transactions }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection