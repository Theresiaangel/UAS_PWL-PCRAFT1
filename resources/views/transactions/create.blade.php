{{-- Memanggil index agar tabel tetap muncul di belakang --}}
@include('transactions.index')

{{-- Overlay Pop-up --}}
<div style="position: fixed; inset: 0; background: rgba(0, 0, 0, 0.4); display: flex; align-items: center; justify-content: center; z-index: 9999; backdrop-filter: blur(2px);">
    
    {{-- Kotak Form Pop-up --}}
    <div style="background: white; width: 650px; border-radius: 40px; padding: 40px; box-shadow: 0 15px 40px rgba(0,0,0,0.3); position: relative;">
        <h2 style="font-family: 'Times New Roman', serif; text-align: center; font-weight: bold; margin-bottom: 25px; font-size: 28px;">Tambah Transaksi Baru</h2>
        <form action="{{ route('transactions.store') }}" method="POST" style="font-family: 'Times New Roman', serif;">
            @csrf
            
            {{-- Input Tanggal --}}
            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: bold; font-size: 18px; margin-left: 15px; margin-bottom: 5px;">Tanggal</label>
                <input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required 
                    style="width: 100%; border: 2.5px solid #000; border-radius: 50px; padding: 10px 20px; font-size: 16px; outline: none; box-sizing: border-box;">
                @error('tanggal') <small style="color: red; margin-left: 15px;">{{ $message }}</small> @enderror
            </div>

            {{-- Input Keterangan Produk --}}
            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: bold; font-size: 18px; margin-left: 15px; margin-bottom: 5px;">Keterangan Produk</label>
                <input type="text" name="keterangan_produk" placeholder="Masukkan nama produk..." value="{{ old('keterangan_produk') }}" required 
                    style="width: 100%; border: 2.5px solid #000; border-radius: 50px; padding: 10px 20px; font-size: 16px; outline: none; box-sizing: border-box;">
                @error('keterangan_produk') <small style="color: red; margin-left: 15px;">{{ $message }}</small> @enderror
            </div>

            {{-- Input Harga Satuan --}}
            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: bold; font-size: 18px; margin-left: 15px; margin-bottom: 5px;">Harga Satuan (Rp)</label>
                <div style="position: relative;">
                    <span style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); font-weight: bold;">Rp</span>
                    <input type="number" name="harga_satuan" placeholder="0" min="0" value="{{ old('harga_satuan') }}" required 
                        style="width: 100%; border: 2.5px solid #000; border-radius: 50px; padding: 10px 20px 10px 45px; font-size: 16px; outline: none; box-sizing: border-box;">
                </div>
                @error('harga_satuan') <small style="color: red; margin-left: 15px;">{{ $message }}</small> @enderror
            </div>

            {{-- Input Jumlah Barang --}}
            <div style="margin-bottom: 30px;">
                <label style="display: block; font-weight: bold; font-size: 18px; margin-left: 15px; margin-bottom: 5px;">Jumlah Barang</label>
                <input type="number" name="jumlah_barang" placeholder="0" min="1" value="{{ old('jumlah_barang') }}" required 
                    style="width: 100%; border: 2.5px solid #000; border-radius: 50px; padding: 10px 20px; font-size: 16px; outline: none; box-sizing: border-box;">
                @error('jumlah_barang') <small style="color: red; margin-left: 15px;">{{ $message }}</small> @enderror
            </div>

            {{-- Container Tombol --}}
            <div style="display: flex; gap: 15px; justify-content: center;">
                <button type="submit" class="btn-save"
                    style="background: transparent; border: 3px solid #ce1212; color: #ce1212; border-radius: 50px; padding: 10px 40px; font-weight: bold; font-size: 20px; font-style: italic; cursor: pointer; transition: 0.3s;">
                    Save
                </button>
                
                <a href="{{ route('transactions.index') }}" 
                    style="text-decoration: none; background: #ce1212; color: white; border-radius: 50px; padding: 13px 40px; font-weight: bold; font-size: 20px; font-style: italic; text-align: center; min-width: 80px; transition: 0.3s;">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>