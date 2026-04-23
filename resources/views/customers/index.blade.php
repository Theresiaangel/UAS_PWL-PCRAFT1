@extends('layouts.admin')

@section('content')
<div style="padding: 0 60px; background-color: white;">
    
    {{-- Bagian Ikon Aksi Utama --}}
    <div style="display: flex; justify-content: flex-end; gap: 20px; margin-bottom: 15px; align-items: center;">
        
        @if($customers->count() > 0)
            {{-- Tombol Pensil Utama (Aktivasi Mode Edit) --}}
            <span onclick="toggleEditMode()" style="text-decoration: none; font-size: 30px; color: #a0a0a0; cursor: pointer; user-select: none;">✎</span>
        @else
            <span style="font-size: 30px; color: #e0e0e0; cursor: not-allowed;">✎</span>
        @endif

        {{-- Tombol Sampah (Aktivasi Mode Hapus) --}}
        <span onclick="toggleDeleteMode()" style="font-size: 30px; color: #a0a0a0; cursor: pointer; user-select: none;">🗑</span>
        
        {{-- Tombol Tambah --}}
        <a href="{{ route('customers.create') }}" style="text-decoration: none; font-size: 40px; color: #a0a0a0; line-height: 0;">+</a>
    </div>

    {{-- Tabel Customer --}}
    <table style="width: 100%; border-collapse: collapse; border: 2px solid #000;">
        <thead>
            <tr style="text-align: center; font-weight: bold;">
                <th style="border: 2px solid #000; padding: 20px; width: 25%;">Nama</th>
                <th style="border: 2px solid #000; padding: 20px; width: 25%;">Email</th>
                <th style="border: 2px solid #000; padding: 20px; width: 20%;">Nomor Telepon</th>
                <th style="border: 2px solid #000; padding: 20px; width: 30%;">Alamat</th>
            </tr>
        </thead>
        <tbody>
            @forelse($customers as $c)
                <tr>
                    {{-- Sel Nama dengan Ikon Melayang (Hapus & Edit) --}}
                    <td style="border: 2px solid #000; padding: 15px; position: relative;">
                        
                        {{-- [X] Merah (Mode Hapus) --}}
                        <div class="delete-btn-container" style="display: none; position: absolute; left: -40px; top: 50%; transform: translateY(-50%);">
                            <form action="{{ route('customers.destroy', $c->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus customer ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none; border: none; color: #ce1212; font-size: 24px; font-weight: bold; cursor: pointer;">✕</button>
                            </form>
                        </div>

                        {{-- [✎] Abu-abu (Mode Edit) --}}
                        <div class="edit-btn-container" style="display: none; position: absolute; left: -40px; top: 50%; transform: translateY(-50%);">
                            <a href="{{ route('customers.edit', $c->id) }}" style="text-decoration: none; font-size: 24px; color: #a0a0a0; font-weight: bold; cursor: pointer;">✎</a>
                        </div>
                        
                        {{-- Data Nama --}}
                        {{ $c->nama_customer }}
                    </td>
                    <td style="border: 2px solid #000; padding: 15px;">{{ $c->email }}</td>
                    <td style="border: 2px solid #000; padding: 15px; text-align: center;">{{ $c->nomor_telepon }}</td>
                    <td style="border: 2px solid #000; padding: 15px;">{{ $c->alamat }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="border: 2px solid #000; padding: 40px; text-align: center; color: #a0a0a0; font-style: italic;">
                        Belum ada data customer tersedia. Klik tombol (+) untuk menambah.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
    // Fungsi Mode Hapus
    function toggleDeleteMode() {
        const deleteButtons = document.querySelectorAll('.delete-btn-container');
        deleteButtons.forEach(btn => {
            btn.style.display = (btn.style.display === 'none' || btn.style.display === '') ? 'block' : 'none';
        });
    }

    // Fungsi Mode Edit
    function toggleEditMode() {
        const editButtons = document.querySelectorAll('.edit-btn-container');
        editButtons.forEach(btn => {
            btn.style.display = (btn.style.display === 'none' || btn.style.display === '') ? 'block' : 'none';
        });
    }
</script>
@endsection