@extends('layouts.admin')

@section('content')
<div style="display: flex; justify-content: center; padding-top: 50px;">
    {{-- Card Profil --}}
    <div style="border: 1.5px solid #000; border-radius: 10px; width: 600px; padding: 30px; background-color: white; font-family: 'Times New Roman', serif;">
        
        <h2 style="font-weight: bold; font-size: 24px; margin-bottom: 30px;">Profil</h2>
        
        <div style="display: flex; gap: 30px; align-items: flex-start;">
            {{-- Placeholder Image --}}
            <div style="width: 150px; height: 150px; border-radius: 10px; overflow: hidden; border: 1px solid #ddd; flex-shrink: 0;">
                @if(auth()->user()->email === 'ebet@gmail.com')
                    <img src="{{ asset('images/ebet.jpg') }}" alt="Profile Picture" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                @else
                    <svg viewBox="0 0 100 100" style="width: 100%; height: 100%; display: block;" xmlns="http://www.w3.org/2000/svg">
                        <!-- Sky -->
                        <rect width="100" height="100" fill="#d0f0ff" />
                        <!-- Cloud -->
                        <path d="M30 50 Q30 40 40 40 Q45 30 55 35 Q65 30 70 40 Q80 40 75 50 Z" fill="white" />
                        <!-- Back Hill -->
                        <path d="M-10 110 Q40 60 110 110 Z" fill="#b0d040" />
                        <!-- Front Hill -->
                        <path d="M-20 120 Q30 70 80 85 T 120 120 Z" fill="#80a000" />
                    </svg>
                @endif
            </div>
            
            {{-- User Details --}}
            <div style="font-size: 20px; font-weight: bold; line-height: 1.6; margin-top: 20px;">
                <div style="display: flex;">
                    <span style="width: 80px;">Nama</span>
                    <span>: {{ auth()->user()->name }}</span>
                </div>
                <div style="display: flex;">
                    <span style="width: 80px;">Email</span>
                    <span>: {{ auth()->user()->email }}</span>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
