{{-- Memanggil index agar tabel tetap muncul di belakang dengan header merah --}}
@include('transactions.index')

{{-- Overlay Pop-up Edit Transaksi --}}
<div style="position: fixed; inset: 0; background: rgba(0, 0, 0, 0.4); display: flex; align-items: flex-start; justify-content: center; z-index: 9999; backdrop-filter: blur(2px); overflow-y: auto; padding: 40px 20px;">
    
    <div style="background: white; width: 650px; border-radius: 40px; padding: 40px; box-shadow: 0 15px 40px rgba(0,0,0,0.3); position: relative; margin: auto;">
        <form action="{{ route('transactions.update', $transaction->id) }}" method="POST" style="font-family: 'Times New Roman', serif;">
            @csrf
            @method('PUT')
            
            {{-- Input Tanggal --}}
            <div style="margin-bottom: 10px;">
                <label style="display: block; font-weight: bold; font-size: 18px; margin-left: 15px; margin-bottom: 5px;">Tanggal</label>
                <input type="date" name="date" value="{{ $transaction->date }}" required 
                    style="width: 100%; border: 1.5px solid #000; border-radius: 50px; padding: 8px 20px; font-size: 16px; outline: none; box-sizing: border-box;">
            </div>

            {{-- Input Keterangan Produk (Custom Dropdown) --}}
            <div style="margin-bottom: 10px; position: relative;">
                <label style="display: block; font-weight: bold; font-size: 18px; margin-left: 15px; margin-bottom: 5px;">Keterangan Produk</label>
                <div id="productSelectContainer" style="width: 100%; border: 1.5px solid #000; border-radius: 50px; padding: 8px 20px; font-size: 16px; outline: none; box-sizing: border-box; cursor: pointer; display: flex; justify-content: space-between; align-items: center; background: white;">
                    <span id="selectedProductText">{{ $transaction->product_description }}</span>
                    <span style="font-weight: bold; font-family: sans-serif;">V</span>
                </div>
                <input type="hidden" name="product_description" id="product_description" value="{{ $transaction->product_description }}" required>
                
                {{-- Dropdown Options --}}
                <div id="productOptions" style="display: none; position: absolute; top: 100%; left: 0; right: 0; background: white; border: 1.5px solid #000; border-radius: 20px; margin-top: 5px; z-index: 10; overflow: hidden; padding: 10px 0;">
                    <div style="max-height: 150px; overflow-y: auto; padding-right: 5px;">
                        <div class="product-option" data-name="Cermin" data-price="4000" style="padding: 5px 20px; display: flex; justify-content: space-between; align-items: center; cursor: pointer; font-size: 16px; font-weight: bold;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <img src="{{ asset('images/Cermin.jpg') }}" alt="Cermin" style="width: 24px; height: 24px; border-radius: 50%; object-fit: cover; border: 1px solid #ccc;">
                                <span>Cermin</span>
                            </div>
                            <span>Rp4000</span>
                        </div>
                        <div class="product-option" data-name="Pot bunga" data-price="25000" style="padding: 5px 20px; display: flex; justify-content: space-between; align-items: center; cursor: pointer; font-size: 16px; font-weight: bold;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <img src="{{ asset('images/Pot Bunga.jpeg') }}" alt="Pot bunga" style="width: 24px; height: 24px; border-radius: 50%; object-fit: cover; border: 1px solid #ccc;">
                                <span>Pot bunga</span>
                            </div>
                            <span>Rp25000</span>
                        </div>
                        <div class="product-option" data-name="Gantungan karakter" data-price="10000" style="padding: 5px 20px; display: flex; justify-content: space-between; align-items: center; cursor: pointer; font-size: 16px; font-weight: bold;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <img src="{{ asset('images/Gantungan Karakter.jpg') }}" alt="Gantungan karakter" style="width: 24px; height: 24px; border-radius: 50%; object-fit: cover; border: 1px solid #ccc;">
                                <span>Gantungan karakter</span>
                            </div>
                            <span>Rp10000</span>
                        </div>
                        <div class="product-option" data-name="Gantungan Pita" data-price="3000" style="padding: 5px 20px; display: flex; justify-content: space-between; align-items: center; cursor: pointer; font-size: 16px; font-weight: bold;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <img src="{{ asset('images/Gantungan Pita.jpg') }}" alt="Gantungan Pita" style="width: 24px; height: 24px; border-radius: 50%; object-fit: cover; border: 1px solid #ccc;">
                                <span>Gantungan Pita</span>
                            </div>
                            <span>Rp3000</span>
                        </div>
                        <div class="product-option" data-name="Gantungan Pita Kupu-kupu" data-price="4000" style="padding: 5px 20px; display: flex; justify-content: space-between; align-items: center; cursor: pointer; font-size: 16px; font-weight: bold;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <img src="{{ asset('images/Gantungan Pita Kupu-kupu.jpg') }}" alt="Gantungan Pita Kupu-kupu" style="width: 24px; height: 24px; border-radius: 50%; object-fit: cover; border: 1px solid #ccc;">
                                <span>Gantungan Pita Kupu-kupu</span>
                            </div>
                            <span>Rp4000</span>
                        </div>
                        <div class="product-option" data-name="Bunga" data-price="10000" style="padding: 5px 20px; display: flex; justify-content: space-between; align-items: center; cursor: pointer; font-size: 16px; font-weight: bold;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <img src="{{ asset('images/Bunga.jpg') }}" alt="Bunga" style="width: 24px; height: 24px; border-radius: 50%; object-fit: cover; border: 1px solid #ccc;">
                                <span>Bunga</span>
                            </div>
                            <span>Rp10000</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Input Jumlah Barang --}}
            <div style="margin-bottom: 10px;">
                <label style="display: block; font-weight: bold; font-size: 18px; margin-left: 15px; margin-bottom: 5px;">Jumlah</label>
                <input type="number" name="quantity" value="{{ $transaction->quantity }}" min="1" required 
                    style="width: 100%; border: 1.5px solid #000; border-radius: 50px; padding: 8px 20px; font-size: 16px; outline: none; box-sizing: border-box;">
            </div>

            {{-- Input Harga Satuan --}}
            <div style="margin-bottom: 10px;">
                <label style="display: block; font-weight: bold; font-size: 18px; margin-left: 15px; margin-bottom: 5px;">Harga</label>
                <input type="number" name="unit_price" id="unit_price" value="{{ $transaction->unit_price }}" required 
                    style="width: 100%; border: 1.5px solid #000; border-radius: 50px; padding: 8px 20px; font-size: 16px; outline: none; box-sizing: border-box;">
            </div>

            {{-- Input Nama Pembeli --}}
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: bold; font-size: 18px; margin-left: 15px; margin-bottom: 5px;">Nama Pembeli</label>
                <input type="text" name="nama_pembeli" value="{{ $transaction->nama_pembeli }}" required 
                    style="width: 100%; border: 1.5px solid #000; border-radius: 50px; padding: 8px 20px; font-size: 16px; outline: none; box-sizing: border-box;">
            </div>

            {{-- Container Tombol --}}
            <div style="display: flex; gap: 15px; margin-left: 15px;">
                <button type="submit" 
                    style="background: transparent; border: 2.5px solid #ce1212; color: #ce1212; border-radius: 50px; padding: 6px 25px; font-weight: bold; font-size: 18px; cursor: pointer; transition: 0.3s;">
                    Update
                </button>
                
                <a href="{{ route('transactions.index') }}" 
                    style="text-decoration: none; background: #ce1212; border: 2.5px solid #ce1212; color: white; border-radius: 50px; padding: 6px 25px; font-weight: bold; font-size: 18px; text-align: center; min-width: 80px; transition: 0.3s;">
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