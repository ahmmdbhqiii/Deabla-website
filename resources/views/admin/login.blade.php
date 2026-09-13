@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 sm:px-6 relative overflow-hidden selection:bg-pink-500 selection:text-white transition-colors duration-500"
     x-data="{
        isLightMode: false,
        cardStyle: '',
        handleMouseMove(e) {
            let card = this.$refs.loginCard;
            if (!card) return;
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
     }"
     :class="isLightMode ? 'bg-gray-100 text-gray-900' : 'bg-black text-white'">
    
    <!-- TOMBOL TOGGLE DARK / LIGHT MODE DI POJOK KANAN ATAS -->
    <div class="absolute top-6 right-6 z-20">
        <button @click="isLightMode = !isLightMode" 
                class="px-4 py-2.5 rounded-2xl border text-xs font-black uppercase tracking-wider transition-all duration-300 shadow-lg flex items-center gap-2"
                :class="isLightMode ? 'bg-white border-gray-300 text-gray-800 hover:bg-gray-200 shadow-gray-200' : 'bg-zinc-900/80 border-white/15 text-white hover:bg-zinc-800 shadow-pink-500/5'">
            <span x-show="!isLightMode">Light Mode</span>
            <span x-show="isLightMode" x-cloak>Dark Mode</span>
        </button>
    </div>

    <!-- AMBIENT GLOW BACKGROUND -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-pink-600/20 rounded-full blur-[150px] animate-pulse pointer-events-none"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-purple-600/20 rounded-full blur-[150px] animate-pulse pointer-events-none" style="animation-duration: 4s;"></div>

    <!-- LOGIN CARD DENGAN EFEK 3D TILT ANIMATION -->
    <div x-ref="loginCard" 
         @mousemove="handleMouseMove($event)"
         @mouseleave="handleMouseLeave()"
         :style="cardStyle"
         class="w-full max-w-sm sm:max-w-md border rounded-[32px] p-8 sm:p-10 backdrop-blur-[24px] relative z-10 space-y-6 transition-colors duration-500"
         :class="isLightMode ? 'bg-white/80 border-gray-300 shadow-[0_25px_60px_-15px_rgba(0,0,0,0.1)]' : 'bg-zinc-950/75 border-white/15 shadow-[0_25px_60px_-15px_rgba(236,72,153,0.15)]'">
        
        <!-- HEADER LOGIN -->
        <div class="space-y-2">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-pink-500/10 border border-pink-500/30 text-pink-500 text-[10px] font-black uppercase tracking-[0.25em]">
                <span class="w-1.5 h-1.5 rounded-full bg-pink-500 animate-ping"></span>
                DEABLA ADMIN
            </div>
            <h1 class="text-2xl sm:text-3xl font-black uppercase tracking-tight" :class="isLightMode ? 'text-gray-900' : 'text-white'">Welcome <span class="text-pink-500">Back</span></h1>
            <p class="text-xs" :class="isLightMode ? 'text-gray-600' : 'text-gray-400'">Sign in to manage stock and orders.</p>
        </div>

        <!-- NOTIFIKASI ERROR -->
        @if(session('error'))
            <div class="p-3.5 rounded-2xl bg-red-500/10 border border-red-500/30 text-red-500 text-xs font-bold text-center">
                {{ session('error') }}
            </div>
        @endif

        <!-- FORM LOGIN -->
        <form action="{{ url('/admin/login') }}" method="POST" class="space-y-4">
            @csrf
            
            <div class="space-y-1.5">
                <label class="block text-[10px] font-black uppercase tracking-wider" :class="isLightMode ? 'text-gray-600' : 'text-gray-400'">Username Admin</label>
                <input type="text" name="username" required placeholder="admin" 
                       class="w-full border rounded-2xl px-4 py-3.5 text-xs focus:outline-none transition shadow-inner placeholder-gray-500"
                       :class="isLightMode ? 'bg-gray-50 border-gray-300 text-gray-900 focus:border-pink-500' : 'bg-black/60 border-white/15 text-white focus:border-pink-500'">
            </div>

            <div class="space-y-1.5">
                <label class="block text-[10px] font-black uppercase tracking-wider" :class="isLightMode ? 'text-gray-600' : 'text-gray-400'">Password</label>
                <input type="password" name="password" required placeholder="••••••••" 
                       class="w-full border rounded-2xl px-4 py-3.5 text-xs focus:outline-none transition shadow-inner placeholder-gray-500"
                       :class="isLightMode ? 'bg-gray-50 border-gray-300 text-gray-900 focus:border-pink-500' : 'bg-black/60 border-white/15 text-white focus:border-pink-500'">
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-pink-600 to-pink-500 hover:from-pink-500 hover:to-pink-400 text-white font-black text-xs uppercase tracking-widest py-4 rounded-2xl transition duration-300 shadow-xl shadow-pink-600/30 active:scale-[0.98] mt-2">
                Sign In &rarr;
            </button>
        </form>

        <div class="text-center pt-2 border-t transition-colors duration-300" :class="isLightMode ? 'border-gray-200' : 'border-white/10'">
            <a href="{{ url('/') }}" class="text-[11px] font-bold transition uppercase tracking-wider" :class="isLightMode ? 'text-gray-500 hover:text-gray-800' : 'text-gray-500 hover:text-gray-300'">
                &larr; Back to Store
            </a>
        </div>
    </div>
</div>
@endsection