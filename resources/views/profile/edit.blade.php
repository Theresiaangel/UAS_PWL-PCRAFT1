@extends('layouts.admin')

@section('content')
<div style="display: flex; justify-content: center; padding-top: 50px;">
    {{-- Card Profil ID --}}
    <div style="width: 450px; background-color: #ffffff; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 20px rgba(0,0,0,0.2); display: flex; flex-direction: column; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; position: relative;">
        
        {{-- Top Red Section --}}
        <div style="background-color: #d9383e; height: 100px; position: relative;">
            <div style="position: absolute; right: 20px; top: 20px; font-weight: 900; font-size: 24px; color: white; letter-spacing: 2px;">
                PCRAFT
            </div>
        </div>
        
        {{-- Content Section --}}
        <div style="padding: 20px; display: flex; gap: 25px; position: relative;">
            
            {{-- Profile Photo --}}
            <div style="width: 120px; height: 140px; border: 4px solid black; background: #fff; margin-top: -60px; position: relative; z-index: 2; overflow: hidden;">
                @if(auth()->user()->email === 'ebet@gmail.com')
                    <img src="{{ asset('images/Ebet.jpeg') }}" alt="Profile Picture" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                @elseif(auth()->user()->email === 'terew@gmail.com')
                    <img src="{{ asset('images/Tere.jpeg') }}" alt="Profile Picture" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                @elseif(auth()->user()->email === 'evelyn@gmail.com')
                    <img src="{{ asset('images/evelyn.jpeg') }}" alt="Profile Picture" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                @else
                    <svg viewBox="0 0 100 100" style="width: 100%; height: 100%; display: block;" xmlns="http://www.w3.org/2000/svg">
                        <rect width="100" height="100" fill="#d0f0ff" />
                        <path d="M30 50 Q30 40 40 40 Q45 30 55 35 Q65 30 70 40 Q80 40 75 50 Z" fill="white" />
                        <path d="M-10 110 Q40 60 110 110 Z" fill="#b0d040" />
                        <path d="M-20 120 Q30 70 80 85 T 120 120 Z" fill="#80a000" />
                    </svg>
                @endif
            </div>
            
            {{-- User Details --}}
            <div style="flex: 1; padding-top: 5px;">
                <div style="font-weight: 900; font-size: 20px; color: black; line-height: 1.2;">{{ auth()->user()->name }}</div>
                <div style="font-size: 14px; color: #555; margin-bottom: 20px;">
                    @if(auth()->user()->email === 'terew@gmail.com')
                        Marketing
                    @else
                        Administrator
                    @endif
                </div>
                
                <div style="font-size: 13px; font-weight: bold; color: black; line-height: 1.6;">
                    <div style="display: flex;">
                        <span style="width: 60px;">Email</span>
                        <span>: {{ auth()->user()->email }}</span>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
