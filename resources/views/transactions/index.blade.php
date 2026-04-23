@extends('layouts.admin')

@section('content')
<div style="padding: 0 60px; background-color: white;">
    
    {{-- Bagian Ikon Aksi Utama --}}
    <div style="display: flex; justify-content: flex-end; gap: 20px; margin-bottom: 15px; align-items: center;">
        
        @if($transactions->count() > 0)
            <span onclick="toggleEditMode()" style="text-decoration: none; font-size: 30px; color: #a0a0a0; cursor: pointer; user-select: none;">✎</span>
        @else
            <span style="font-size: 30px; color: #e0e0e0; cursor: not-allowed;">✎</span>
        @endif

        <span onclick="toggleDeleteMode()" style="font-size: 30px; color: #a0a0a0; cursor: pointer; user-select: none;">🗑</span>
        
        <a href="{{ route('transactions.create') }}" style="text-decoration: none; font-size: 40px; color: #a0a0a0; line-height: 0;">+</a>
    </div>

    {{-- Tabel Transaksi --}}
    <table style="width: 100%; border-collapse: collapse; border: 2px solid #000;">
        <thead>
            <tr style="text-align: center; font-weight: bold;">
                <th style="border: 2px solid #000; padding: 20px; width: 15%;">Tanggal</th>
                <th style="border: 2px solid #000; padding: 20px; width: 30%;">Keterangan Produk</th>
                <th style="border: 2px solid #000; padding: 20px; width: 15%;">Harga Satuan</th>
                <th style="border: 2px solid #000; padding: 20px; width: 15%;">Jumlah</th>
                <th style="border: 2px solid #000; padding: 20px; width: 25%;">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $t)
                <tr>
                    <td style="border: 2px solid #000; padding: 15px; text-align: center; position: relative;">
                        
                        <div class="delete-btn-container" style="display: none; position: absolute; left: -40px; top: 50%; transform: translateY(-50%);">
                            <form action="{{ route('transactions.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none; border: none; color: #ce1212; font-size: 24px; font-weight: bold; cursor: pointer;">✕</button>
                            </form>
                        </div>

                        <div class="edit-btn-container" style="display: none; position: absolute; left: -40px; top: 50%; transform: translateY(-50%);">
                            <a href="{{ route('transactions.edit', $t->id) }}" style="text-decoration: none; font-size: 24px; color: #a0a0a0; font-weight: bold; cursor: pointer;">✎</a>
                        </div>
                        
                        {{ $t->tanggal }}
                    </td>
                    <td style="border: 2px solid #000; padding: 15px;">{{ $t->keterangan_produk }}</td>
                    
                    <td style="border: 2px solid #000; padding: 15px; text-align: right;">
                        Rp {{ number_format($t->harga_satuan, 0, ',', '.') }}
                    </td>

                    {{-- PERBAIKAN: Menggunakan nama kolom baru jumlah_barang --}}
                    <td style="border: 2px solid #000; padding: 15px; text-align: center;">{{ $t->jumlah_barang }}</td>
                    
                    {{-- PERBAIKAN: Menggunakan nama kolom baru total --}}
                    <td style="border: 2px solid #000; padding: 15px; text-align: right;">
                        Rp {{ number_format($t->total, 0, ',', '.') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="border: 2px solid #000; padding: 40px; text-align: center; color: #a0a0a0; font-style: italic;">
                        Belum ada data transaksi tersedia. Klik tombol (+) untuk menambah.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
    function toggleDeleteMode() {
        const deleteButtons = document.querySelectorAll('.delete-btn-container');
        deleteButtons.forEach(btn => {
            btn.style.display = (btn.style.display === 'none' || btn.style.display === '') ? 'block' : 'none';
        });
    }

    function toggleEditMode() {
        const editButtons = document.querySelectorAll('.edit-btn-container');
        editButtons.forEach(btn => {
            btn.style.display = (btn.style.display === 'none' || btn.style.display === '') ? 'block' : 'none';
        });
    }
</script>
@endsection