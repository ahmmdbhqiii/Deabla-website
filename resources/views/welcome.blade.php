@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black text-white selection:bg-pink-500 selection:text-white pb-20 overflow-x-hidden"
     x-data="{ 
        // State untuk Carousel Model di Atas
        currentIndex: 0,
        slides: [
            { image: '{{ asset('images/hero-banner.png') }}', title: 'New Drop 2026', subtitle: 'Love Bombing Zip Hoodie' },
            { image: '{{ asset('images/Love%20Bombing.png') }}', title: 'Studio Detail', subtitle: 'Heavyweight Cotton Fleece 310 GSM' },
            { image: '{{ asset('images/blog-banner.png') }}', title: 'Editorial Look', subtitle: 'Signature Streetwear Style' }
        ],
        nextSlide() {
            this.currentIndex = (this.currentIndex + 1) % this.slides.length;
        },
        prevSlide() {
            this.currentIndex = (this.currentIndex - 1 + this.slides.length) % this.slides.length;
        },

        // State untuk Preview Produk di Bawah (Hanya Foto Produk/Mockup, Bersih dari Logo)
        activeProductImage: '{{ asset('images/Love%20Bombing.png') }}',
        activeTab: 'specs',
        selectedSize: 'L'
     }">

    <!-- 1. HERO SECTION: FOTO MODEL / CAROUSEL UTAMA DI ATAS -->
    <section class="relative pt-6 pb-12 sm:py-16 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <!-- Glow Light Accent -->
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[350px] sm:w-[600px] h-[350px] sm:h-[600px] bg-pink-600/15 rounded-full blur-[140px] pointer-events-none"></div>

        <div class="space-y-8 relative z-10">
            
            <!-- FOTO MODEL / CAROUSEL DI ATAS -->
            <div class="relative w-full max-w-lg mx-auto">
                <div class="absolute -inset-2 rounded-3xl bg-gradient-to-r from-pink-600 to-purple-600 opacity-25 blur-2xl"></div>
                
                <div class="relative bg-zinc-950 border border-white/15 rounded-3xl p-4 sm:p-6 backdrop-blur-xl shadow-2xl space-y-4">
                    
                    <div class="aspect-[4/5] sm:aspect-square w-full rounded-2xl overflow-hidden bg-zinc-900 flex items-center justify-center border border-white/10 relative group">
                        <!-- Background Blur Ambient -->
                        <template x-for="(slide, index) in slides">
                            <img :src="slide.image" 
                                 x-show="currentIndex === index" 
                                 x-transition.opacity.duration.500ms
                                 alt="Glow Ambient" 
                                 class="absolute inset-0 w-full h-full object-cover blur-2xl opacity-40 scale-125 pointer-events-none">
                        </template>

                        <!-- Foto Utama Carousel -->
                        <template x-for="(slide, index) in slides">
                            <img :src="slide.image" 
                                 x-show="currentIndex === index"
                                 x-transition:enter="transition ease-out duration-500"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 alt="DEABLA Lookbook" 
                                 class="absolute inset-0 z-10 h-full w-full object-cover object-center">
                        </template>

                        <!-- Badge Status -->
                        <div class="absolute top-3 left-3 z-20 px-3 py-1 rounded-full bg-black/70 backdrop-blur-md border border-white/10 text-[9px] font-black uppercase text-pink-400 tracking-wider shadow-lg" x-text="slides[currentIndex].title"></div>

                        <!-- Tombol Navigasi Kiri Kanan -->
                        <button @click="prevSlide()" class="absolute left-3 top-1/2 -translate-y-1/2 z-20 w-9 h-9 rounded-full bg-black/70 hover:bg-pink-600 text-white flex items-center justify-center border border-white/20 transition shadow-lg text-sm active:scale-95">
                            &larr;
                        </button>
                        <button @click="nextSlide()" class="absolute right-3 top-1/2 -translate-y-1/2 z-20 w-9 h-9 rounded-full bg-black/70 hover:bg-pink-600 text-white flex items-center justify-center border border-white/20 transition shadow-lg text-sm active:scale-95">
                            &rarr;
                        </button>
                    </div>

                    <!-- Keterangan & Navigasi Dots di Tengah -->
                    <div class="flex flex-col items-center justify-center pt-1 text-center space-y-2.5">
                        <div>
                            <p class="text-[10px] sm:text-xs text-pink-400 font-bold uppercase tracking-wider block mb-0.5" x-text="slides[currentIndex].subtitle"></p>
                            <h3 class="text-xs sm:text-sm font-black text-white uppercase tracking-tight">DEABLA OFFICIAL LOOKBOOK</h3>
                        </div>
                        
                        <!-- Indikator Titik (Dots) -->
                        <div class="flex items-center justify-center gap-1.5">
                            <template x-for="(slide, index) in slides">
                                <button @click="currentIndex = index" 
                                        :class="currentIndex === index ? 'w-8 bg-pink-500 shadow-md shadow-pink-500/50' : 'w-2 bg-white/30 hover:bg-white/60'"
                                        class="h-2 rounded-full transition-all duration-300"></button>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TEKS HEADLINE DI BAWAH CAROUSEL ATAS -->
            <div class="text-center space-y-4 max-w-3xl mx-auto pt-2">
                <div class="inline-flex items-center gap-2 rounded-full bg-pink-500/10 px-3.5 py-1.5 text-[10px] sm:text-xs font-extrabold text-pink-400 ring-1 ring-inset ring-pink-500/30">
                    <span class="h-2 w-2 rounded-full bg-pink-500 animate-pulse"></span>
                    OFFICIAL RELEASE DROPS
                </div>

                <div>
                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight text-white uppercase leading-tight">
                        DEABLA<span class="text-pink-500">.</span> HOODIE & KNITWEAR
                    </h1>
                </div>

                <p class="text-xs sm:text-sm text-gray-400 max-w-xl mx-auto leading-relaxed">
                    Perpaduan siluet <em class="not-italic text-white font-semibold">Boxy oversized</em> modern dengan kekuatan material <em class="not-italic text-white font-semibold">heavyweight fleece</em> 310 GSM. Didesain untuk karakter tanpa kompromi.
                </p>
            </div>

        </div>
    </section>

    <!-- 2. SECTION: PRODUCT KNOWLEDGE & PREVIEW DETAIL PRODUK (MURNI PRODUK, TERHUBUNG DENGAN STOK REAL-TIME) -->
    <section class="py-12 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto border-t border-white/10">
        <div class="text-center space-y-2 mb-8">
            <span class="text-[10px] font-black text-pink-500 uppercase tracking-[0.25em]">Product Knowledge & Preview</span>
            <h2 class="text-2xl sm:text-4xl font-black text-white uppercase tracking-tight">Detail Produk & Spesifikasi</h2>
            <p class="text-xs text-gray-400">Pilih varian thumbnail produk di bawah untuk melihat detail barang.</p>
        </div>

        <div class="bg-zinc-950/90 border border-white/15 rounded-3xl p-6 sm:p-8 backdrop-blur-xl shadow-2xl space-y-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                
                <!-- KOLOM KIRI: TAMPILAN FOTO PRODUK & THUMBNAIL BERSIH -->
                <div class="lg:col-span-6 space-y-4">
                    <div class="aspect-square w-full rounded-2xl overflow-hidden bg-black border border-white/10 flex items-center justify-center relative">
                        <img :src="activeProductImage" alt="DEABLA Product Preview" class="h-full w-full object-contain p-4 transition duration-500">
                        
                        <!-- Badge Stok Real-Time dari Storage Laravel -->
                        @php
                            $displayStock = 25; // Default fallback
                            if (\Illuminate\Support\Facades\Storage::exists('admin_stock.json')) {
                                $stockData = json_decode(\Illuminate\Support\Facades\Storage::get('admin_stock.json'), true);
                                if (isset($stockData[0]['stock'])) {
                                    $displayStock = $stockData[0]['stock'];
                                }
                            }
                        @endphp
                        
                        <span class="absolute top-3 right-3 px-3 py-1 rounded-full {{ $displayStock > 0 ? 'bg-pink-500 text-white' : 'bg-red-600 text-white' }} text-[9px] font-black uppercase tracking-wider shadow-md">
                            {{ $displayStock > 0 ? 'Ready Stock (' . $displayStock . ' Pcs)' : 'Habis / Sold Out' }}
                        </span>
                    </div>

                    <!-- Thumbnail Interaktif -->
                    <div class="space-y-2">
                        <span class="text-[9px] font-bold text-gray-400 uppercase tracking-wider block">Pilih Sudut Pandang Produk:</span>
                        <div class="flex items-center gap-3">
                            <button @click="activeProductImage = '{{ asset('images/Love%20Bombing.png') }}'" 
                                    :class="activeProductImage === '{{ asset('images/Love%20Bombing.png') }}' ? 'border-pink-500 ring-2 ring-pink-500/40 scale-105' : 'border-white/10 opacity-60 hover:opacity-100'"
                                    class="w-16 h-16 rounded-xl overflow-hidden bg-black border transition-all duration-300 flex items-center justify-center">
                                <img src="{{ asset('images/Love%20Bombing.png') }}" class="w-full h-full object-contain p-1">
                            </button>
                        </div>
                    </div>
                </div>

                <!-- KOLOM KANAN: SPESIFIKASI & SIZE CHART INTERAKTIF -->
                <div class="lg:col-span-6 space-y-6">
                    <div>
                        <span class="text-[10px] font-black text-pink-400 uppercase tracking-widest bg-pink-500/10 px-3 py-1 rounded-full border border-pink-500/20">Drop 01 Flagship</span>
                        <h3 class="text-2xl font-black text-white uppercase tracking-tight mt-3">DEABLA Zip Hoodie - Love Bombing</h3>
                        <p class="text-xl font-black text-pink-400 font-mono mt-1">Rp 350.000</p>
                    </div>

                    <!-- Tab Switcher -->
                    <div class="flex items-center gap-2 border-b border-white/10 pb-3">
                        <button @click="activeTab = 'specs'" 
                                :class="activeTab === 'specs' ? 'bg-pink-600 text-white shadow-lg shadow-pink-600/30' : 'bg-white/5 text-gray-400 hover:text-white'"
                                class="px-4 py-2 rounded-xl font-black text-[11px] uppercase tracking-wider transition">
                            Spesifikasi
                        </button>
                        <button @click="activeTab = 'size'" 
                                :class="activeTab === 'size' ? 'bg-pink-600 text-white shadow-lg shadow-pink-600/30' : 'bg-white/5 text-gray-400 hover:text-white'"
                                class="px-4 py-2 rounded-xl font-black text-[11px] uppercase tracking-wider transition">
                            Size Chart
                        </button>
                    </div>

                    <!-- Konten Spesifikasi -->
                    <div x-show="activeTab === 'specs'" class="space-y-3">
                        <ul class="space-y-2 text-xs text-gray-300">
                            <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-pink-500"></span> <strong>Material:</strong> Heavyweight Cotton Fleece 310 GSM</li>
                            <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-pink-500"></span> <strong>Hood:</strong> Double-layer hood (Tegap berdiri)</li>
                            <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-pink-500"></span> <strong>Sablon:</strong> High-Density Screenprinting (Awet & anti retak)</li>
                            <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-pink-500"></span> <strong>Fit:</strong> Modern Boxy Oversized Cut</li>
                        </ul>
                    </div>

                    <!-- Konten Size Chart -->
                    <div x-show="activeTab === 'size'" class="space-y-4" x-cloak>
                        <div class="grid grid-cols-4 gap-2">
                            <button @click="selectedSize = 'M'" :class="selectedSize === 'M' ? 'border-pink-500 bg-pink-500/10 text-white' : 'border-white/10 bg-black/40 text-gray-400'" class="p-2.5 rounded-xl border text-center transition">
                                <span class="block text-sm font-black">M</span>
                            </button>
                            <button @click="selectedSize = 'L'" :class="selectedSize === 'L' ? 'border-pink-500 bg-pink-500/10 text-white' : 'border-white/10 bg-black/40 text-gray-400'" class="p-2.5 rounded-xl border text-center transition">
                                <span class="block text-sm font-black">L</span>
                            </button>
                            <button @click="selectedSize = 'XL'" :class="selectedSize === 'XL' ? 'border-pink-500 bg-pink-500/10 text-white' : 'border-white/10 bg-black/40 text-gray-400'" class="p-2.5 rounded-xl border text-center transition">
                                <span class="block text-sm font-black">XL</span>
                            </button>
                            <button @click="selectedSize = 'XXL'" :class="selectedSize === 'XXL' ? 'border-pink-500 bg-pink-500/10 text-white' : 'border-white/10 bg-black/40 text-gray-400'" class="p-2.5 rounded-xl border text-center transition">
                                <span class="block text-sm font-black">XXL</span>
                            </button>
                        </div>
                        <div class="bg-black border border-white/10 rounded-xl p-3 text-xs">
                            <span class="text-pink-400 font-bold uppercase">Size <span x-text="selectedSize"></span>:</span>
                            <p class="text-gray-300 mt-0.5" x-text="
                                selectedSize === 'M' ? 'Lebar Dada: 58 cm | Panjang Badan: 70 cm' :
                                (selectedSize === 'L' ? 'Lebar Dada: 61 cm | Panjang Badan: 72 cm' :
                                (selectedSize === 'XL' ? 'Lebar Dada: 64 cm | Panjang Badan: 75 cm' : 
                                'Lebar Dada: 67 cm | Panjang Badan: 78 cm'))
                            "></p>
                        </div>
                    </div>

                    <a href="{{ url('/contact') }}" class="block w-full text-center py-3.5 rounded-xl bg-gradient-to-r from-pink-600 to-pink-500 hover:from-pink-500 hover:to-pink-400 text-white font-black text-xs uppercase tracking-widest transition shadow-lg shadow-pink-600/30">
                        Pesan Varian Ini &rarr;
                    </a>
                </div>

            </div>

        </div>
    </section>

    <!-- KEUNGGULAN BRAND -->
    <section class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto border-t border-white/10 mt-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="flex items-start gap-4 p-6 rounded-2xl bg-zinc-900/60 border border-white/10 backdrop-blur-sm">
                <div class="p-3 rounded-xl bg-pink-500/10 text-pink-400 border border-pink-500/20 shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <div>
                    <h3 class="text-base font-extrabold text-white">Bahan Premium 310 GSM</h3>
                    <p class="text-xs text-gray-400 mt-1 leading-relaxed">Ketebalan optimal, terstruktur rapat, dan tidak gampang melar walau sering dicuci.</p>
                </div>
            </div>

            <div class="flex items-start gap-4 p-6 rounded-2xl bg-zinc-900/60 border border-white/10 backdrop-blur-sm">
                <div class="p-3 rounded-xl bg-pink-500/10 text-pink-400 border border-pink-500/20 shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                </div>
                <div>
                    <h3 class="text-base font-extrabold text-white">Garansi Tukar Ukuran</h3>
                    <p class="text-xs text-gray-400 mt-1 leading-relaxed">Ukuran tidak pas? Kami berikan jaminan tukar size gratis dalam 3 hari.</p>
                </div>
            </div>

            <div class="flex items-start gap-4 p-6 rounded-2xl bg-zinc-900/60 border border-white/10 backdrop-blur-sm">
                <div class="p-3 rounded-xl bg-pink-500/10 text-pink-400 border border-pink-500/20 shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <div>
                    <h3 class="text-base font-extrabold text-white">Pengiriman Cepat & Aman</h3>
                    <p class="text-xs text-gray-400 mt-1 leading-relaxed">Dikemas rapi dengan packaging eksklusif DEABLA dan perlindungan ganda.</p>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection