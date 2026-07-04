{{-- Memanggil index agar tabel tetap muncul di belakang dengan header merah --}}
@include('customers.index')

{{-- Overlay Pop-up Edit --}}
<div style="position: fixed; inset: 0; background: rgba(0, 0, 0, 0.4); display: flex; align-items: flex-start; justify-content: center; z-index: 9999; backdrop-filter: blur(2px); overflow-y: auto; padding: 40px 20px;">
    
    {{-- Kotak Form Pop-up --}}
    <div style="background: linear-gradient(135deg, #e0e0e0 0%, #b3b3b3 100%); width: 650px; border-radius: 40px; padding: 40px; box-shadow: 10px 15px 30px rgba(0,0,0,0.6); border: 1px solid #ffffff; position: relative; margin: auto;">

        <form action="{{ route('customers.update', $customer->id) }}" method="POST" style="font-family: 'Times New Roman', serif;">
            @csrf
            @method('PUT')
            
            {{-- Input Nama --}}
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: bold; font-size: 20px; margin-left: 20px; margin-bottom: 8px;">Nama</label>
                <input type="text" name="customer_name" value="{{ $customer->customer_name }}" required 
                    style="width: 100%; border: 1.5px solid #000; border-radius: 50px; padding: 8px 20px; font-size: 16px; outline: none; box-sizing: border-box;">
            </div>

            {{-- Input Email --}}
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: bold; font-size: 20px; margin-left: 20px; margin-bottom: 8px;">Email</label>
                <input type="email" name="email" value="{{ $customer->email }}" required 
                    style="width: 100%; border: 1.5px solid #000; border-radius: 50px; padding: 8px 20px; font-size: 16px; outline: none; box-sizing: border-box;">
            </div>

            {{-- Input Nomor Telepon --}}
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: bold; font-size: 20px; margin-left: 20px; margin-bottom: 8px;">Nomor Telepon</label>
                <input type="text" name="phone_number" value="{{ $customer->phone_number }}" required 
                    style="width: 100%; border: 1.5px solid #000; border-radius: 50px; padding: 8px 20px; font-size: 16px; outline: none; box-sizing: border-box;">
            </div>

            {{-- Input Alamat --}}
            <div style="margin-bottom: 40px;">
                <label style="display: block; font-weight: bold; font-size: 20px; margin-left: 20px; margin-bottom: 8px;">Alamat</label>
                <input type="text" name="address" value="{{ $customer->address }}" required 
                    style="width: 100%; border: 1.5px solid #000; border-radius: 50px; padding: 8px 20px; font-size: 16px; outline: none; box-sizing: border-box;">
            </div>

            {{-- Container Tombol --}}
            <div style="display: flex; gap: 15px; margin-left: 15px;">
                <button type="submit" 
                    style="background: transparent; border: 2.5px solid #ce1212; color: #ce1212; border-radius: 50px; padding: 6px 25px; font-weight: bold; font-size: 18px; cursor: pointer; transition: 0.3s;">
                    Save
                </button>
                
                <a href="{{ route('customers.index') }}" 
                    style="text-decoration: none; background: #ce1212; border: 2.5px solid #ce1212; color: white; border-radius: 50px; padding: 6px 25px; font-weight: bold; font-size: 18px; text-align: center; min-width: 80px; transition: 0.3s;">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>