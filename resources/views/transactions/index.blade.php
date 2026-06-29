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
                            <form id="delete-form-{{ $t->id }}" action="{{ route('transactions.destroy', $t->id) }}" method="POST" style="margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="showDeleteModal('delete-form-{{ $t->id }}')" style="background: none; border: none; font-size: 30px; color: #a0a0a0; cursor: pointer; padding: 0;">🗑</button>
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

{{-- Custom Delete Confirmation Modal --}}
<div id="deleteModal" style="display: none; position: fixed; inset: 0; background: rgba(0, 0, 0, 0.4); align-items: center; justify-content: center; z-index: 9999; backdrop-filter: blur(2px);">
    <div style="background: white; width: 450px; border-radius: 40px; padding: 30px; box-shadow: 0 15px 40px rgba(0,0,0,0.3); text-align: center; font-family: 'Times New Roman', serif;">
        <h3 style="font-weight: bold; font-size: 24px; margin-bottom: 30px; line-height: 1.5;">Apakah anda yakin ingin<br>menghapus ini ?</h3>
        <div style="display: flex; justify-content: center; gap: 20px;">
            <button onclick="confirmDelete()" style="background: transparent; border: 2.5px solid #ce1212; color: #ce1212; border-radius: 50px; padding: 8px 40px; font-weight: bold; font-size: 20px; cursor: pointer; transition: 0.3s;">
                Ya
            </button>
            <button onclick="closeDeleteModal()" style="background: #ce1212; border: 2.5px solid #ce1212; color: white; border-radius: 50px; padding: 8px 30px; font-weight: bold; font-size: 20px; cursor: pointer; transition: 0.3s;">
                Tidak
            </button>
        </div>
    </div>
</div>

<script>
    let formToSubmit = null;

    function showDeleteModal(formId) {
        formToSubmit = formId;
        const modal = document.getElementById('deleteModal');
        modal.style.display = 'flex';
    }

    function closeDeleteModal() {
        formToSubmit = null;
        const modal = document.getElementById('deleteModal');
        modal.style.display = 'none';
    }

    function confirmDelete() {
        if (formToSubmit) {
            document.getElementById(formToSubmit).submit();
        }
    }
</script>
@endsection