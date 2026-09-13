@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black text-white flex items-center justify-center px-4 sm:px-6 relative overflow-hidden selection:bg-pink-500 selection:text-white"
     x-data="{
        cardStyle: '',
        handleMouseMove(e) {
            let card = this.$refs.loginCard;
            let rect = card.getBoundingClientRect();
            let x = e.clientX - rect.left - rect.width / 2;
            let y = e.clientY - rect.top - rect.height / 2;
            let rotateX = (-y / 15).toFixed(2);
            let rotateY = (x / 15).toFixed(2);
            this.cardStyle = `transform: perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02, 1.02, 1.02);`;
        },
        handleMouseLeave() {
            this.cardStyle = 'transform: perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1); transition: transform 0.5s ease;';
        }
     }">
    
    <!-- AMBIENT GLOW BACKGROUND KHAS DEABLA -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-pink-600/20 rounded-full blur-[150px] animate-pulse pointer-events-none"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-purple-600/20 rounded-full blur-[150px] animate-pulse pointer-events-none" style="animation-duration: 4s;"></div>

    <!-- LOGIN CARD DENGAN EFEK 3D TILT ANIMATION -->
    <div x-ref="loginCard0" 
         @mousemove="handleMouseMove($event)"
         @mouseleave="handleMouseLeave()"
         :style="cardStyle"
         class="w-full max-w-sm sm:max-w-md bg-zinc-950/75 border border-white/15 rounded-[32px] p-8 sm:p-10 backdrop-blur-[24px] shadow-[0_25px_60px_-15px_rgba(236,72,153,0.15)] relative z-10 space-y-6 transition-transform duration-100 ease-out">
        
        <!-- HEADER LOGIN KHAS DEABLA -->
        <div class="space-y-2">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-pink-500/10 border border-pink-500/30 text-pink-400 text-[10px] font-black uppercase tracking-[0.25em]">
                <span class="w-1.5 h-1.5 rounded-full bg-pink-500 animate-ping"></span>
                DEABLA ADMIN
            </div>
            <h1 class="text-2xl sm:text-3xl font-black uppercase tracking-tight text-white">Welcome <span class="text-pink-500">Back</span></h1>
            <p class="text-xs text-gray-400">Sign in to manage stock and orders.</p>
        </div>

        <!-- NOTIFIKASI ERROR -->
        @if(session('error'))
            <div class="p-3.5 rounded-2xl bg-red-500/10 border border-red-500/30 text-red-400 text-xs font-bold text-center">
                {{ session('error') }}
            </div>
        @endif

        <!-- FORM LOGIN -->
        <form action="{{ url('/admin/login') }}" method="POST" class="space-y-4">
            @csrf
            
            <div class="space-y-1.5">
                <label class="block text-[10px] font-black uppercase text-gray-400 tracking-wider">Username Admin</label>
                <input type="text" name="username" required placeholder="admin" 
                       class="w-full bg-black/60 border border-white/15 focus:border-pink-500 rounded-2xl px-4 py-3.5 text-xs text-white focus:outline-none transition shadow-inner placeholder-gray-600">
            </div>

            <div class="space-y-1.5">
                <label class="block text-[10px] font-black uppercase text-gray-400 tracking-wider">Password</label>
                <input type="password" name="password" required placeholder="••••••••" 
                       class="w-full bg-black/60 border border-white/15 focus:border-pink-500 rounded-2xl px-4 py-3.5 text-xs text-white focus:outline-none transition shadow-inner placeholder-gray-600">
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-pink-600 to-pink-500 hover:from-pink-500 hover:to-pink-400 text-white font-black text-xs uppercase tracking-widest py-4 rounded-2xl transition duration-300 shadow-xl shadow-pink-600/30 active:scale-[0.98] mt-2">
                Sign In &rarr;
            </button>
        </form>

        <div class="text-center pt-2 border-t border-white/10">
            <a href="{{ url('/') }}" class="text-[11px] font-bold text-gray-500 hover:text-gray-300 transition uppercase tracking-wider">
                &larr; Back to Store
            </a>
        </div>
    </div>
</div>
@endsection