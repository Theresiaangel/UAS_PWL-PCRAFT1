@extends('layouts.admin')

@section('content')
    

    <div style="margin-bottom: 20px;">
        <h2 style="font-family: 'Times New Roman', serif;">Selamat Datang, {{ Auth::user()->name }}</h2>
        <p>Silakan pilih menu di atas untuk mengelola data.</p>
    </div>

    <div class="action-icons" style="margin-bottom: 15px; display: flex; justify-content: flex-end; gap: 10px;">
        {{-- Tombol Tambah Data di atas tabel --}}
        <a href="{{ route('transactions.create') }}" class="icon" title="Tambah Data" style="font-size: 24px; text-decoration: none;">✚</a> 
    </div>

    <table border="1" style="width: 100%; border-collapse: collapse; background-color: white;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th width="12%">Tanggal</th>
                <th width="28%">Keterangan Produk</th>
                <th width="15%">Harga Satuan</th>
                <th width="10%">Jumlah</th>
                <th width="20%">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions ?? [] as $transaction)
                <tr>
                    <td style="text-align: center; padding: 8px;">{{ $transaction->tanggal }}</td>
                    <td style="padding: 8px;">{{ $transaction->keterangan_produk }}</td>
                    <td style="text-align: right; padding: 8px;">Rp {{ number_format($transaction->harga_satuan, 0, ',', '.') }}</td>
                    <td style="text-align: center; padding: 8px;">{{ $transaction->jumlah_barang }}</td>
                    <td style="text-align: right; padding: 8px; font-weight: bold;">Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                    <td style="text-align: center; padding: 8px;">
                        {{-- Tombol Edit & Delete per baris --}}
                        <a href="{{ route('transactions.edit', $transaction->id) }}" style="text-decoration: none; margin-right: 10px;">✎</a>
                        
                        <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin hapus data?')" style="border: none; background: none; cursor: pointer; color: red;">🗑</button>
                        </form>
                    </td>
                </tr>
            @empty
                @for ($i = 0; $i < 5; $i++)
                    <tr>
                        <td colspan="6" style="text-align: center; color: #ccc; padding: 10px;">{{ $i == 0 ? 'Belum ada data transaksi.' : '' }} &nbsp;</td>
                    </tr>
                @endfor
            @endforelse
        </tbody>
    </table>
@endsection