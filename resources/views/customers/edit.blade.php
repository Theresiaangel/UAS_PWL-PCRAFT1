{{-- Memanggil index agar tabel tetap muncul di belakang dengan header merah --}}
@include('customers.index')

{{-- Overlay Pop-up Edit --}}
<div style="position: fixed; inset: 0; background: rgba(0, 0, 0, 0.4); display: flex; align-items: center; justify-content: center; z-index: 9999; backdrop-filter: blur(2px);">
    
    {{-- Kotak Form Pop-up --}}
    <div style="background: white; width: 650px; border-radius: 60px; padding: 50px; box-shadow: 0 15px 40px rgba(0,0,0,0.3); position: relative;">
        
        <h2 style="font-family: 'Times New Roman', serif; text-align: center; font-weight: bold; margin-bottom: 30px; font-size: 28px;">Edit Customer</h2>

        <form action="{{ route('customers.update', $customer->id) }}" method="POST" style="font-family: 'Times New Roman', serif;">
            @csrf
            @method('PUT')
            
            {{-- Input Nama --}}
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: bold; font-size: 20px; margin-left: 20px; margin-bottom: 8px;">Nama</label>
                <input type="text" name="nama_customer" value="{{ $customer->nama_customer }}" required 
                    style="width: 100%; border: 3px solid #000; border-radius: 50px; padding: 12px 25px; font-size: 18px; outline: none; box-sizing: border-box;">
            </div>

            {{-- Input Email --}}
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: bold; font-size: 20px; margin-left: 20px; margin-bottom: 8px;">Email</label>
                <input type="email" name="email" value="{{ $customer->email }}" required 
                    style="width: 100%; border: 3px solid #000; border-radius: 50px; padding: 12px 25px; font-size: 18px; outline: none; box-sizing: border-box;">
            </div>

            {{-- Input Nomor Telepon --}}
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: bold; font-size: 20px; margin-left: 20px; margin-bottom: 8px;">Nomor Telepon</label>
                <input type="text" name="nomor_telepon" value="{{ $customer->nomor_telepon }}" required 
                    style="width: 100%; border: 3px solid #000; border-radius: 50px; padding: 12px 25px; font-size: 18px; outline: none; box-sizing: border-box;">
            </div>

            {{-- Input Alamat --}}
            <div style="margin-bottom: 40px;">
                <label style="display: block; font-weight: bold; font-size: 20px; margin-left: 20px; margin-bottom: 8px;">Alamat</label>
                <input type="text" name="alamat" value="{{ $customer->alamat }}" required 
                    style="width: 100%; border: 3px solid #000; border-radius: 50px; padding: 12px 25px; font-size: 18px; outline: none; box-sizing: border-box;">
            </div>

            {{-- Container Tombol --}}
            <div style="display: flex; gap: 20px;">
                {{-- Tombol Update --}}
                <button type="submit" 
                    style="background: transparent; border: 3px solid #ce1212; color: #ce1212; border-radius: 50px; padding: 10px 40px; font-weight: bold; font-size: 22px; font-style: italic; cursor: pointer; transition: 0.3s;">
                    Update
                </button>
                
                {{-- Tombol Kembali --}}
                <a href="{{ route('customers.index') }}" 
                    style="text-decoration: none; background: #ce1212; color: white; border-radius: 50px; padding: 13px 40px; font-weight: bold; font-size: 22px; font-style: italic; text-align: center; min-width: 100px;">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>