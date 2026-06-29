@extends('layouts.admin')

@section('content')
<div style="padding: 0 60px; background-color: white;">
    
    {{-- Bagian Ikon Tambah (+) Utama --}}
    <div style="display: flex; justify-content: flex-end; margin-bottom: 10px;">
        <a href="{{ route('customers.create') }}" style="text-decoration: none; font-size: 50px; color: #a0a0a0; line-height: 0; font-weight: bold;">+</a>
    </div>

    {{-- Tabel Customer --}}
    <table style="width: 100%; border-collapse: collapse; border: 2px solid #000; font-family: 'Times New Roman', serif;">
        <thead>
            <tr style="text-align: center; font-weight: bold; background-color: white;">
                <th style="border: 2px solid #000; padding: 15px; width: 15%;">Nama Pembeli</th>
                <th style="border: 2px solid #000; padding: 15px; width: 15%;">Email</th>
                <th style="border: 2px solid #000; padding: 15px; width: 15%;">Nomor Telepon</th>
                <th style="border: 2px solid #000; padding: 15px; width: 15%;">Alamat</th>
                <th style="border: 2px solid #000; padding: 15px; width: 10%;">Pembelian ke -</th>
                <th style="border: 2px solid #000; padding: 15px; width: 15%;">Action</th>
                <th style="border: 2px solid #000; padding: 15px; width: 15%;">Diubah oleh</th>
            </tr>
        </thead>
        <tbody>
            @forelse($customers as $c)
                <tr>
                    <td style="border: 2px solid #000; padding: 15px; text-align: center;">{{ $c->customer_name }}</td>
                    <td style="border: 2px solid #000; padding: 15px; text-align: center;">{{ $c->email }}</td>
                    <td style="border: 2px solid #000; padding: 15px; text-align: center;">{{ $c->phone_number }}</td>
                    <td style="border: 2px solid #000; padding: 15px; text-align: center;">{{ $c->address }}</td>
                    <td style="border: 2px solid #000; padding: 15px; text-align: center;">{{ $c->purchase_count }}</td>
                    <td style="border: 2px solid #000; padding: 15px; text-align: center;">
                        <div style="display: flex; justify-content: center; gap: 15px; align-items: center;">
                            <a href="{{ route('customers.edit', $c->id) }}" style="text-decoration: none; font-size: 24px; color: white; font-weight: bold; background: #a0a0a0; border-radius: 50%; width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center; transform: rotate(-45deg);">✏</a>
                            <form action="{{ route('customers.destroy', $c->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none; border: none; font-size: 30px; color: #a0a0a0; cursor: pointer; padding: 0;">🗑</button>
                            </form>
                        </div>
                    </td>
                    <td style="border: 2px solid #000; padding: 15px; text-align: center;">{{ $c->user ? $c->user->name : '' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="border: 2px solid #000; padding: 40px; text-align: center; color: #a0a0a0; font-style: italic;">
                        Belum ada data customer tersedia. Klik tombol (+) untuk menambah.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection