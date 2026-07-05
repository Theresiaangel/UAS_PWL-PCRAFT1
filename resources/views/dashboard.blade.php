@extends('layouts.admin')

@section('content')
    <div style="margin-bottom: 20px;">

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

        <!-- Card 2: Total Nominal Pembelian -->
        <div style="background-color: #d9383e; color: white; border-radius: 8px; padding: 15px 20px; width: 260px; display: flex; align-items: center; box-shadow: 4px 4px 8px rgba(0,0,0,0.3); font-family: 'Times New Roman', serif;">
            <div style="margin-right: 15px;">
                <svg width="45" height="45" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2a3 3 0 0 0-3 3v1h-1a3 3 0 0 0-3 3v11a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V9a3 3 0 0 0-3-3h-1V5a3 3 0 0 0-3-3z"/>
                    <text x="12" y="16" text-anchor="middle" font-size="10" font-weight="bold" fill="black" stroke="none">$</text>
                </svg>
            </div>
            <div style="text-align: center; width: 100%;">
                <div style="font-weight: bold; font-size: 16px; line-height: 1.2; margin-bottom: 5px;">Total Nominal<br>Pembelian</div>
                <div style="font-weight: bold; font-size: 22px;">{{ number_format($totalNominal, 0, ',', '.') }}</div>
            </div>
        </div>

        <!-- Card 3: Total Produk -->
        <div style="background-color: #d9383e; color: white; border-radius: 8px; padding: 15px 20px; width: 260px; display: flex; align-items: center; box-shadow: 4px 4px 8px rgba(0,0,0,0.3); font-family: 'Times New Roman', serif;">
            <div style="margin-right: 15px;">
                <svg width="45" height="45" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="9" cy="21" r="2" fill="none"></circle>
                    <circle cx="20" cy="21" r="2" fill="none"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
            </div>
            <div style="text-align: center; width: 100%;">
                <div style="font-weight: bold; font-size: 18px; margin-bottom: 5px;">Total Produk</div>
                <div style="font-weight: bold; font-size: 22px;">{{ $totalProduk }}</div>
            </div>
        </div>
    </div>

    <table class="custom-table">
        <thead>
            <tr>
                <th width="35%">Nama Pembeli</th>
                <th width="35%">Total Nominal Pembelian</th>
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