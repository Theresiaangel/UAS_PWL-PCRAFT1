@extends('layouts.admin')

@section('content')
<div style="padding: 0 40px; background-color: transparent;">
    
    {{-- Bagian Header & Ikon Tambah --}}
    <div style="text-align: center; margin-top: 20px; margin-bottom: 30px;">
        <h2 style="font-family: 'Times New Roman', serif; font-weight: bold; color: black; margin: 0; font-size: 36px;">Tabel Transaksi Penjualan</h2>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <div style="display: flex; align-items: center; gap: 10px;">
            <span style="font-family: 'Times New Roman', serif; font-weight: bold; font-size: 18px;">Diurutkan berdasarkan :</span>
            <form action="{{ route('transactions.index') }}" method="GET" style="margin: 0;">
                <select name="sort" onchange="this.form.submit()" style="padding: 10px 40px 10px 20px; border-radius: 30px; font-weight: bold; font-family: 'Times New Roman', serif; font-size: 18px; border: 1.5px solid #000; outline: none; cursor: pointer; background: white url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'black\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'%3e%3cpolyline points=\'6 9 12 15 18 9\'%3e%3c/polyline%3e%3c/svg%3e') no-repeat right 15px center; background-size: 15px; appearance: none; -webkit-appearance: none; color: black; box-shadow: 4px 4px 8px rgba(0,0,0,0.1);">
                    <option value="terbaru" {{ request('sort') != 'terlama' ? 'selected' : '' }}>Transaksi Terbaru</option>
                    <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Transaksi Terlama</option>
                </select>
            </form>
        </div>

        <a href="{{ route('transactions.create') }}" style="text-decoration: none; background-color: black; color: white; padding: 10px 25px; border-radius: 30px; font-weight: bold; font-family: 'Times New Roman', serif; font-size: 18px; box-shadow: 4px 4px 8px rgba(0,0,0,0.4); display: flex; align-items: center; gap: 8px;">
            Add New <span style="font-size: 26px; line-height: 0.8; margin-bottom: 2px;">+</span>
        </a>
    </div>

    {{-- Tabel Transaksi --}}
    <table class="custom-table">
        <thead>
            <tr>
                <th width="10%">Tanggal</th>
                <th width="15%">Keterangan<br>Produk</th>
                <th width="15%">Nama Pembeli</th>
                <th width="10%">Jumlah</th>
                <th width="15%">Harga</th>
                <th width="15%">Action</th>
                <th width="20%">Diubah oleh</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $t)
                <tr>
                    <td>{{ $t->date }}</td>
                    <td>{{ $t->product_description }}</td>
                    <td>{{ $t->customer_name }}</td>
                    <td>{{ $t->quantity }}</td>
                    <td>Rp {{ number_format($t->unit_price, 0, ',', '.') }}</td>
                    <td>
                        <div style="display: flex; justify-content: center; gap: 15px; align-items: center;">
                            <a href="{{ route('transactions.edit', $t->id) }}" style="text-decoration: none; font-size: 24px; color: #a0a0a0; font-weight: bold; background: #e0e0e0; border-radius: 50%; width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center; transform: rotate(-45deg);">✏</a>
                            <form id="delete-form-{{ $t->id }}" action="{{ route('transactions.destroy', $t->id) }}" method="POST" style="margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="showDeleteModal('delete-form-{{ $t->id }}')" style="background: none; border: none; font-size: 30px; color: #a0a0a0; cursor: pointer; padding: 0;">🗑</button>
                            </form>
                        </div>
                    </td>
                    <td>{{ $t->user ? $t->user->name : '' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="padding: 40px; text-align: center; color: black; font-style: italic;">
                        Belum ada data transaksi tersedia.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top: 20px;">
        {{ $transactions->links('vendor.pagination.custom') }}
    </div>
</div>

{{-- Custom Delete Confirmation Modal --}}
<div id="deleteModal" style="display: none; position: fixed; inset: 0; background: rgba(0, 0, 0, 0.4); align-items: center; justify-content: center; z-index: 9999; backdrop-filter: blur(2px);">
    <div style="background: linear-gradient(135deg, #e0e0e0 0%, #b3b3b3 100%); width: 450px; border-radius: 40px; padding: 30px; box-shadow: 10px 15px 30px rgba(0,0,0,0.6); text-align: center; font-family: 'Times New Roman', serif; border: 1px solid #ffffff;">
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