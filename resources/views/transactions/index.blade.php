@extends('layouts.admin')

@section('content')
<div style="padding: 0 60px; background-color: white;">
    
    {{-- Bagian Ikon Tambah (+) Utama --}}
    <div style="display: flex; justify-content: flex-end; margin-bottom: 10px;">
        <a href="{{ route('transactions.create') }}" style="text-decoration: none; font-size: 50px; color: #a0a0a0; line-height: 0; font-weight: bold;">+</a>
    </div>

    {{-- Tabel Transaksi --}}
    <table style="width: 100%; border-collapse: collapse; border: 2px solid #000; font-family: 'Times New Roman', serif;">
        <thead>
            <tr style="text-align: center; font-weight: bold; background-color: white;">
                <th style="border: 2px solid #000; padding: 15px; width: 10%;">Tanggal</th>
                <th style="border: 2px solid #000; padding: 15px; width: 15%;">Keterangan<br>Produk</th>
                <th style="border: 2px solid #000; padding: 15px; width: 15%;">Harga</th>
                <th style="border: 2px solid #000; padding: 15px; width: 10%;">Jumlah</th>
                <th style="border: 2px solid #000; padding: 15px; width: 15%;">Nama Pembeli</th>
                <th style="border: 2px solid #000; padding: 15px; width: 15%;">Action</th>
                <th style="border: 2px solid #000; padding: 15px; width: 20%;">Diubah oleh</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $t)
                <tr>
                    <td style="border: 2px solid #000; padding: 15px; text-align: center;">{{ $t->date }}</td>
                    <td style="border: 2px solid #000; padding: 15px; text-align: center;">{{ $t->product_description }}</td>
                    <td style="border: 2px solid #000; padding: 15px; text-align: center;">Rp {{ number_format($t->unit_price, 0, ',', '.') }}</td>
                    <td style="border: 2px solid #000; padding: 15px; text-align: center;">{{ $t->quantity }}</td>
                    <td style="border: 2px solid #000; padding: 15px; text-align: center;">{{ $t->nama_pembeli }}</td>
                    <td style="border: 2px solid #000; padding: 15px; text-align: center;">
                        <div style="display: flex; justify-content: center; gap: 15px; align-items: center;">
                            <a href="{{ route('transactions.edit', $t->id) }}" style="text-decoration: none; font-size: 24px; color: #a0a0a0; font-weight: bold; background: #e0e0e0; border-radius: 50%; width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center; transform: rotate(-45deg);">✏</a>
                            <form action="{{ route('transactions.destroy', $t->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none; border: none; font-size: 30px; color: #a0a0a0; cursor: pointer; padding: 0;">🗑</button>
                            </form>
                        </div>
                    </td>
                    <td style="border: 2px solid #000; padding: 15px; text-align: center;">{{ $t->user ? $t->user->name : '' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="border: 2px solid #000; padding: 40px; text-align: center; color: #a0a0a0; font-style: italic;">
                        Belum ada data transaksi tersedia. Klik tombol (+) untuk menambah.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection