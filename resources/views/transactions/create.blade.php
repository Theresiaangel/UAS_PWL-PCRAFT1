{{-- Memanggil index agar tabel tetap muncul di belakang --}}
@include('transactions.index')

{{-- Overlay Pop-up --}}
<div style="position: fixed; inset: 0; background: rgba(0, 0, 0, 0.4); display: flex; align-items: center; justify-content: center; z-index: 9999; backdrop-filter: blur(2px);">
    
    {{-- Kotak Form Pop-up --}}
    <div style="background: white; width: 650px; border-radius: 40px; padding: 40px; box-shadow: 0 15px 40px rgba(0,0,0,0.3); position: relative;">
        <form action="{{ route('transactions.store') }}" method="POST" style="font-family: 'Times New Roman', serif;">
            @csrf
            
            {{-- Input Tanggal --}}
            <div style="margin-bottom: 10px;">
                <label style="display: block; font-weight: bold; font-size: 18px; margin-left: 15px; margin-bottom: 5px;">Tanggal</label>
                <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required 
                    style="width: 100%; border: 1.5px solid #000; border-radius: 50px; padding: 8px 20px; font-size: 16px; outline: none; box-sizing: border-box;">
                @error('date') <small style="color: red; margin-left: 15px;">{{ $message }}</small> @enderror
            </div>

            {{-- Input Keterangan Produk (Custom Dropdown) --}}
            <div style="margin-bottom: 10px; position: relative;">
                <label style="display: block; font-weight: bold; font-size: 18px; margin-left: 15px; margin-bottom: 5px;">Keterangan Produk</label>
                <div id="productSelectContainer" style="width: 100%; border: 1.5px solid #000; border-radius: 50px; padding: 8px 20px; font-size: 16px; outline: none; box-sizing: border-box; cursor: pointer; display: flex; justify-content: space-between; align-items: center; background: white;">
                    <span id="selectedProductText">{{ old('product_description') ? old('product_description') : '' }}</span>
                    <span style="font-weight: bold; font-family: sans-serif;">v</span>
                </div>
                <input type="hidden" name="product_description" id="product_description" value="{{ old('product_description') }}" required>
                
                {{-- Dropdown Options --}}
                <div id="productOptions" style="display: none; position: absolute; top: 100%; left: 0; right: 0; background: white; border: 2px solid #8B5CF6; border-radius: 20px; margin-top: -15px; z-index: 10; overflow: hidden; padding: 10px 0;">
                    <div style="max-height: 150px; overflow-y: auto;">
                        <div class="product-option" data-name="Cermin" data-price="4000" style="padding: 5px 20px; display: flex; justify-content: space-between; cursor: pointer; font-size: 16px;">
                            <span>Cermin</span><span>Rp4000</span>
                        </div>
                        <div class="product-option" data-name="Pot bunga" data-price="25000" style="padding: 5px 20px; display: flex; justify-content: space-between; cursor: pointer; font-size: 16px;">
                            <span>Pot bunga</span><span>Rp25000</span>
                        </div>
                        <div class="product-option" data-name="Gantungan karakter" data-price="10000" style="padding: 5px 20px; display: flex; justify-content: space-between; cursor: pointer; font-size: 16px;">
                            <span>Gantungan karakter</span><span>Rp10000</span>
                        </div>
                        <div class="product-option" data-name="Gantungan Pita" data-price="3000" style="padding: 5px 20px; display: flex; justify-content: space-between; cursor: pointer; font-size: 16px;">
                            <span>Gantungan Pita</span><span>Rp3000</span>
                        </div>
                        <div class="product-option" data-name="Gantungan Pita Kupu-kupu" data-price="4000" style="padding: 5px 20px; display: flex; justify-content: space-between; cursor: pointer; font-size: 16px;">
                            <span>Gantungan Pita Kupu-kupu</span><span>Rp4000</span>
                        </div>
                        <div class="product-option" data-name="Bunga" data-price="6000" style="padding: 5px 20px; display: flex; justify-content: space-between; cursor: pointer; font-size: 16px;">
                            <span>Bunga</span><span>Rp6000</span>
                        </div>
                    </div>
                </div>
                @error('product_description') <small style="color: red; margin-left: 15px;">{{ $message }}</small> @enderror
            </div>

            {{-- Input Harga Satuan --}}
            <div style="margin-bottom: 10px;">
                <label style="display: block; font-weight: bold; font-size: 18px; margin-left: 15px; margin-bottom: 5px;">Harga</label>
                <input type="number" name="unit_price" id="unit_price" value="{{ old('unit_price') }}" required 
                    style="width: 100%; border: 1.5px solid #000; border-radius: 50px; padding: 8px 20px; font-size: 16px; outline: none; box-sizing: border-box; background-color: white;">
                @error('unit_price') <small style="color: red; margin-left: 15px;">{{ $message }}</small> @enderror
            </div>

            {{-- Input Jumlah Barang --}}
            <div style="margin-bottom: 10px;">
                <label style="display: block; font-weight: bold; font-size: 18px; margin-left: 15px; margin-bottom: 5px;">Jumlah</label>
                <input type="number" name="quantity" min="1" value="{{ old('quantity') }}" required 
                    style="width: 100%; border: 1.5px solid #000; border-radius: 50px; padding: 8px 20px; font-size: 16px; outline: none; box-sizing: border-box;">
                @error('quantity') <small style="color: red; margin-left: 15px;">{{ $message }}</small> @enderror
            </div>
            
            {{-- Input Nama Pembeli --}}
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: bold; font-size: 18px; margin-left: 15px; margin-bottom: 5px;">Nama Pembeli</label>
                <input type="text" name="nama_pembeli" value="{{ old('nama_pembeli') }}" required 
                    style="width: 100%; border: 1.5px solid #000; border-radius: 50px; padding: 8px 20px; font-size: 16px; outline: none; box-sizing: border-box;">
                @error('nama_pembeli') <small style="color: red; margin-left: 15px;">{{ $message }}</small> @enderror
            </div>

            {{-- Container Tombol --}}
            <div style="display: flex; gap: 15px; margin-left: 15px;">
                <button type="submit" class="btn-save"
                    style="background: transparent; border: 2.5px solid #ce1212; color: #ce1212; border-radius: 50px; padding: 6px 25px; font-weight: bold; font-size: 18px; cursor: pointer; transition: 0.3s;">
                    Save
                </button>
                
                <a href="{{ route('transactions.index') }}" 
                    style="text-decoration: none; background: #ce1212; border: 2.5px solid #ce1212; color: white; border-radius: 50px; padding: 6px 25px; font-weight: bold; font-size: 18px; text-align: center; transition: 0.3s;">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<style>
    .product-option:hover {
        background-color: #f3f4f6;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const productSelectContainer = document.getElementById('productSelectContainer');
        const productOptions = document.getElementById('productOptions');
        const selectedProductText = document.getElementById('selectedProductText');
        const productDescriptionInput = document.getElementById('product_description');
        const unitPriceInput = document.getElementById('unit_price');

        productSelectContainer.addEventListener('click', function(e) {
            e.stopPropagation();
            productOptions.style.display = productOptions.style.display === 'none' ? 'block' : 'none';
        });

        document.querySelectorAll('.product-option').forEach(function(option) {
            option.addEventListener('click', function() {
                const name = this.getAttribute('data-name');
                const price = this.getAttribute('data-price');
                
                selectedProductText.textContent = name;
                productDescriptionInput.value = name;
                unitPriceInput.value = price;
                
                productOptions.style.display = 'none';
            });
        });

        document.addEventListener('click', function(e) {
            if (!productSelectContainer.contains(e.target) && !productOptions.contains(e.target)) {
                productOptions.style.display = 'none';
            }
        });
    });
</script>