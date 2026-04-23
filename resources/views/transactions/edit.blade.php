{{-- Memanggil index agar tabel tetap muncul di belakang dengan header merah --}}
@include('transactions.index')

{{-- Overlay Pop-up Edit Transaksi --}}
<div style="position: fixed; inset: 0; background: rgba(0, 0, 0, 0.4); display: flex; align-items: center; justify-content: center; z-index: 9999; backdrop-filter: blur(2px);">
    
    <div style="background: white; width: 650px; border-radius: 60px; padding: 50px; box-shadow: 0 15px 40px rgba(0,0,0,0.3); position: relative;">
        <h2 style="font-family: 'Times New Roman', serif; text-align: center; font-weight: bold; margin-bottom: 30px; font-size: 28px;">Edit Transaksi Penjualan</h2>
        <form action="{{ route('transactions.update', $transaction->id) }}" method="POST" style="font-family: 'Times New Roman', serif;">
            @csrf
            @method('PUT')
            
            {{-- Input Tanggal --}}
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: bold; font-size: 20px; margin-left: 20px; margin-bottom: 8px;">Tanggal</label>
                <input type="date" name="tanggal" value="{{ $transaction->tanggal }}" required 
                    style="width: 100%; border: 3px solid #000; border-radius: 50px; padding: 12px 25px; font-size: 18px; outline: none; box-sizing: border-box;">
            </div>

            {{-- Input Keterangan Produk --}}
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: bold; font-size: 20px; margin-left: 20px; margin-bottom: 8px;">Keterangan Produk</label>
                <input type="text" name="keterangan_produk" value="{{ $transaction->keterangan_produk }}" required 
                    style="width: 100%; border: 3px solid #000; border-radius: 50px; padding: 12px 25px; font-size: 18px; outline: none; box-sizing: border-box;">
            </div>

            {{-- Input Harga Satuan --}}
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: bold; font-size: 20px; margin-left: 20px; margin-bottom: 8px;">Harga Satuan</label>
                <input type="number" name="harga_satuan" value="{{ $transaction->harga_satuan }}" required 
                    style="width: 100%; border: 3px solid #000; border-radius: 50px; padding: 12px 25px; font-size: 18px; outline: none; box-sizing: border-box;">
            </div>

            {{-- PERBAIKAN: Input Jumlah Barang (Disesuaikan dengan Model Transaction) --}}
            <div style="margin-bottom: 40px;">
                <label style="display: block; font-weight: bold; font-size: 20px; margin-left: 20px; margin-bottom: 8px;">Jumlah Barang</label>
                <input type="number" name="jumlah_barang" value="{{ $transaction->jumlah_barang }}" required 
                    style="width: 100%; border: 3px solid #000; border-radius: 50px; padding: 12px 25px; font-size: 18px; outline: none; box-sizing: border-box;">
            </div>

            {{-- Container Tombol --}}
            <div style="display: flex; gap: 20px;">
                <button type="submit" 
                    style="background: transparent; border: 3px solid #ce1212; color: #ce1212; border-radius: 50px; padding: 10px 40px; font-weight: bold; font-size: 22px; font-style: italic; cursor: pointer; transition: 0.3s;">
                    Update
                </button>
                
                <a href="{{ route('transactions.index') }}" 
                    style="text-decoration: none; background: #ce1212; color: white; border-radius: 50px; padding: 13px 40px; font-weight: bold; font-size: 22px; font-style: italic; text-align: center; min-width: 100px;">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>