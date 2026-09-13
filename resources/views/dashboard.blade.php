@extends('layouts.app')

@section('content')
    <!-- HERO BANNER SECTION -->
    <section class="relative overflow-hidden bg-gradient-to-b from-zinc-950 via-zinc-900 to-black py-12 sm:py-16 lg:py-24 border-b border-white/10">
        <!-- Glow Light Accent -->
        <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-96 h-96 bg-pink-600/15 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                
                <!-- Kolom Kiri: Headline & CTA -->
                <div class="text-left space-y-5 sm:space-y-6">
                    <div class="inline-flex items-center gap-2 rounded-full bg-pink-500/10 px-3.5 py-1.5 text-[10px] sm:text-xs font-extrabold text-pink-400 ring-1 ring-inset ring-pink-500/30">
                        <span class="h-2 w-2 rounded-full bg-pink-500 animate-pulse"></span>
                        OFFICIAL RELEASE 2025 DROPS
                    </div>

                    <div>
                        <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black tracking-tight text-white uppercase leading-tight">
                            DEABLA<span class="text-pink-500">.</span>
                        </h1>
                        <p class="text-base sm:text-xl font-black text-gray-300 mt-2 tracking-wider uppercase">
                            Hoodie & Knitwear
                        </p>
                    </div>

                    <p class="text-xs sm:text-base text-gray-400 max-w-xl leading-relaxed">
                        Perpaduan siluet <em class="not-italic text-white font-semibold">Boxy oversized</em> modern dengan kekuatan material <em class="not-italic text-white font-semibold">heavyweight fleece</em> dan <em class="not-italic text-white font-semibold">premium cotton</em>. Didesain untuk Anda yang mengutamakan karakter dan kualitas tanpa kompromi.
                    </p>

                    <div class="flex flex-wrap items-center gap-3 sm:gap-4 pt-1">
                        <a href="{{ url('/blog') }}" class="w-full sm:w-auto text-center rounded-xl bg-gradient-to-r from-pink-600 to-pink-500 hover:from-pink-500 hover:to-pink-400 px-6 py-3.5 text-xs font-black uppercase tracking-wider text-white shadow-lg shadow-pink-600/25 transition-all duration-300 active:scale-95">
                            Baca Journal
                        </a>
                        <a href="#about" class="w-full sm:w-auto text-center rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 px-6 py-3.5 text-xs font-black uppercase tracking-wider text-gray-300 transition-all">
                            Filosofi Brand
                        </a>
                    </div>

                    <!-- Stats Counter -->
                    <div class="grid grid-cols-3 gap-3 sm:gap-6 pt-6 border-t border-white/10 text-center sm:text-left">
                        <div>
                            <p class="text-lg sm:text-2xl font-black text-white">310 GSM</p>
                            <p class="text-[10px] sm:text-xs text-gray-400 font-medium">Cotton Fleece</p>
                        </div>
                        <div>
                            <p class="text-lg sm:text-2xl font-black text-white">100%</p>
                            <p class="text-[10px] sm:text-xs text-gray-400 font-medium">Heavy Cotton</p>
                        </div>
                        <div>
                            <p class="text-lg sm:text-2xl font-black text-white">4.9/5.0</p>
                            <p class="text-[10px] sm:text-xs text-gray-400 font-medium">Customer Rating</p>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Foto Model -->
                <div class="relative mt-4 lg:mt-0">
                    <div class="relative mx-auto max-w-md lg:max-w-none">
                        <div class="absolute -inset-1 rounded-3xl bg-gradient-to-r from-pink-600 to-purple-600 opacity-20 blur-2xl"></div>
                        
                        <div class="relative aspect-[4/5] sm:aspect-square lg:aspect-[4/5] w-full overflow-hidden rounded-2xl sm:rounded-3xl bg-zinc-900 border border-white/10 shadow-2xl">
                            <img src="{{ asset('images/hero-banner.png') }}" 
                                 alt="DEABLA Lookbook" 
                                 class="h-full w-full object-cover object-center hover:scale-105 transition-transform duration-700">
                            
                            <div class="absolute bottom-4 left-4 right-4 sm:bottom-6 sm:left-6 sm:right-6 rounded-2xl bg-zinc-950/80 backdrop-blur-md p-4 sm:p-5 border border-white/10 flex items-center justify-between">
                                <div>
                                    <p class="text-[9px] sm:text-xs text-pink-400 font-bold uppercase tracking-wider">Featured Look</p>
                                    <p class="text-xs sm:text-base font-black text-white">Love Bombing Zip Hoodie</p>
                                </div>
                                <span class="rounded-xl bg-pink-600 px-3 py-1.5 text-[10px] sm:text-xs font-extrabold uppercase tracking-wider text-white shadow-md">New Drop</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- KEUNGGULAN BRAND -->
    <section class="py-10 sm:py-16 bg-zinc-950/50 border-b border-white/10" id="features">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-8">
                
                <div class="flex items-start gap-4 p-5 sm:p-6 rounded-2xl bg-zinc-900/60 border border-white/10 backdrop-blur-sm">
                    <div class="p-3 rounded-xl bg-pink-500/10 text-pink-400 border border-pink-500/20 shrink-0">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-sm sm:text-base font-extrabold text-white">Bahan Premium 310 GSM</h3>
                        <p class="text-xs text-gray-400 mt-1 leading-relaxed">Ketebalan optimal, terstruktur rapat, dan tidak gampang melar walau sering dicuci.</p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-5 sm:p-6 rounded-2xl bg-zinc-900/60 border border-white/10 backdrop-blur-sm">
                    <div class="p-3 rounded-xl bg-pink-500/10 text-pink-400 border border-pink-500/20 shrink-0">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-sm sm:text-base font-extrabold text-white">Garansi Tukar Ukuran</h3>
                        <p class="text-xs text-gray-400 mt-1 leading-relaxed">Ukuran tidak pas? Kami berikan jaminan tukar size gratis dalam 3 hari.</p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-5 sm:p-6 rounded-2xl bg-zinc-900/60 border border-white/10 backdrop-blur-sm">
                    <div class="p-3 rounded-xl bg-pink-500/10 text-pink-400 border border-pink-500/20 shrink-0">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-sm sm:text-base font-extrabold text-white">Pengiriman Cepat & Aman</h3>
                        <p class="text-xs text-gray-400 mt-1 leading-relaxed">Dikemas rapi dengan packaging eksklusif DEABLA dan perlindungan ganda.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- BRAND STORY SECTION -->
    <section class="py-12 sm:py-20 bg-black border-t border-white/10" id="about">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <div class="relative">
                    <div class="aspect-video lg:aspect-square w-full overflow-hidden rounded-2xl sm:rounded-3xl bg-zinc-900 border border-white/10">
                        <img src="{{ asset('images/hero-banner.png') }}" 
                             alt="DEABLA Workshop" 
                             class="h-full w-full object-cover object-center">
                    </div>
                </div>

                <div class="space-y-4 sm:space-y-6">
                    <span class="text-xs font-bold text-pink-400 uppercase tracking-widest block">Our Story & Craft</span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white uppercase tracking-tight">
                        Dibuat Dengan Detail & Presisi Tinggi
                    </h2>
                    <p class="text-xs sm:text-base text-gray-400 leading-relaxed">
                        <strong class="text-white">DEABLA</strong> lahir dari hasrat untuk menghadirkan pakaian kasual berkualitas tinggi tanpa kompromi. Kami percaya bahwa kenyamanan dan gaya bisa berjalan berdampingan tanpa mengorbankan daya tahan bahan.
                    </p>
                    <p class="text-xs sm:text-base text-gray-400 leading-relaxed">
                        Setiap helai kain dikurasi khusus dengan gramasi padat untuk memastikan bentuk pakaian tetap <em class="not-italic text-white font-semibold">fit</em> sempurna di tubuh Anda, bahkan setelah penggunaan berulang.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection