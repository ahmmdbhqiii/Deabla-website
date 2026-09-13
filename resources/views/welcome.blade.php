@extends('layouts.app')

@section('content')
<div class="min-h-screen selection:bg-pink-500 selection:text-white pb-28 overflow-x-hidden transition-colors duration-700 relative"
     x-data="{ 
        // State untuk Mode Terang / Gelap
        isLightMode: false,

        // State untuk Carousel Model di Atas (Autoplay 3.6 Detik dengan Smooth 3D Coverflow)
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
        autoplayTimer: null,
        startAutoplay() {
            this.autoplayTimer = setInterval(() => {
                this.nextSlide();
            }, 3600);
        },

        // State untuk Fitur Like Interaktif
        liked: false,
        likeCount: 1420,
        toggleLike() {
            if (this.liked) {
                this.liked = false;
                this.likeCount--;
            } else {
                this.liked = true;
                this.likeCount++;
            }
        },

        // State untuk Preview Produk di Bawah
        activeProductImage: '{{ asset('images/Love%20Bombing.png') }}',
        activeTab: 'specs',
        selectedSize: 'L'
     }"
     x-init="startAutoplay()"
     :class="isLightMode ? 'bg-[#f8f9fa] text-gray-900' : 'bg-[#050505] text-white'">

    <!-- HEADER / NAVIGASI UTAMA (BERSIH DARI TOMBOL ADMIN) -->
    <header class="w-full py-6 px-6 sm:px-12 flex items-center justify-between max-w-7xl mx-auto border-b transition-colors duration-500 sticky top-0 z-50 backdrop-blur-xl"
            :class="isLightMode ? 'bg-white/80 border-gray-200' : 'bg-black/80 border-white/10'">
        <div class="flex items-center gap-3">
            <span class="font-black text-xl tracking-tighter uppercase">DEABLA<span class="text-pink-500">.</span></span>
        </div>

        <div class="flex items-center gap-4">
            <!-- TOMBOL TOGGLE DARK / LIGHT MODE -->
            <button @click="isLightMode = !isLightMode" 
                    class="px-4 py-2.5 rounded-2xl border text-xs font-black uppercase tracking-wider transition-all duration-300 shadow-sm flex items-center gap-2"
                    :class="isLightMode ? 'bg-gray-100 border-gray-300 text-gray-800 hover:bg-gray-200' : 'bg-zinc-900 border-white/15 text-white hover:bg-zinc-800'">
                <span x-show="!isLightMode">Light Mode</span>
                <span x-show="isLightMode" x-cloak>Dark Mode</span>
            </button>
        </div>
    </header>
    
    <!-- 1. HERO SECTION: CAROUSEL 3D DENGAN SISI KIRI KANAN BLUR PERMANEN & AUTOPLAY 3.6 DETIK -->
    <section class="relative pt-12 pb-16 px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto overflow-hidden">
        <!-- Glow Light Accent -->
        <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[450px] sm:w-[750px] h-[450px] sm:h-[750px] bg-pink-600/10 rounded-full blur-[180px] pointer-events-none"></div>

        <div class="space-y-10 relative z-10">
            
            <!-- CONTAINER UTAMA CAROUSEL -->
            <div class="relative w-full max-w-4xl mx-auto h-[420px] sm:h-[520px] flex items-center justify-center">
                
                <template x-for="(slide, index) in slides" :key="index">
                    <div class="absolute transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] flex items-center justify-center cursor-pointer will-change-transform"
                         :class="{
                            // FOKUS UTAMA DI TENGAH
                            'scale-100 opacity-100 z-30 translate-x-0 blur-0 shadow-2xl': index === currentIndex,
                            
                            // SISI KIRI PERMANEN KELIHATAN TAPI BLUR
                            'scale-75 opacity-40 z-10 -translate-x-[60%] sm:-translate-x-[70%] blur-sm grayscale-[25%]': index === (currentIndex - 1 + slides.length) % slides.length,
                            
                            // SISI KANAN PERMANEN KELIHATAN TAPI BLUR
                            'scale-75 opacity-40 z-10 translate-x-[60%] sm:translate-x-[70%] blur-sm grayscale-[25%]': index === (currentIndex + 1) % slides.length,
                            
                            // LAINNYA DISEMBUNYIKAN
                            'scale-50 opacity-0 z-0 pointer-events-none': index !== currentIndex && index !== (currentIndex - 1 + slides.length) % slides.length && index !== (currentIndex + 1) % slides.length
                         }"
                         @click="currentIndex = index">
                        
                        <!-- KARTU FOTO -->
                        <div class="w-[270px] sm:w-[350px] aspect-[4/5] rounded-[32px] overflow-hidden border border-white/20 bg-zinc-950 relative shadow-2xl group">
                            <img :src="slide.image" alt="DEABLA Lookbook" class="w-full h-full object-cover">
                            
                            <div class="absolute inset-0 bg-black/25 transition-opacity duration-500" :class="index === currentIndex ? 'opacity-0' : 'opacity-50'"></div>

                            <div class="absolute top-4 left-4 z-30 px-3.5 py-1.5 rounded-full bg-black/80 backdrop-blur-md border border-white/10 text-[10px] font-black uppercase text-pink-400 tracking-wider shadow-lg" 
                                 x-show="index === currentIndex" 
                                 x-text="slides[currentIndex].title"></div>
                        </div>
                    </div>
                </template>

                <!-- Tombol Navigasi Kiri Kanan -->
                <button @click="prevSlide()" class="absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 z-40 w-12 h-12 rounded-full bg-black/80 hover:bg-pink-600 text-white flex items-center justify-center border border-white/20 transition shadow-xl text-sm active:scale-95">
                    &larr;
                </button>
                <button @click="nextSlide()" class="absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 z-40 w-12 h-12 rounded-full bg-black/80 hover:bg-pink-600 text-white flex items-center justify-center border border-white/20 transition shadow-xl text-sm active:scale-95">
                    &rarr;
                </button>
            </div>

            <!-- Keterangan & Navigasi Dots -->
            <div class="flex flex-col items-center justify-center pt-2 text-center space-y-3">
                <div>
                    <p class="text-[11px] sm:text-xs text-pink-500 font-bold uppercase tracking-widest block mb-1" x-text="slides[currentIndex].subtitle"></p>
                    <h3 class="text-sm sm:text-base font-black uppercase tracking-tight" :class="isLightMode ? 'text-gray-900' : 'text-white'">DEABLA OFFICIAL LOOKBOOK</h3>
                </div>
                
                <div class="flex items-center justify-center gap-2">
                    <template x-for="(slide, index) in slides">
                        <button @click="currentIndex = index" 
                                :class="currentIndex === index ? 'w-10 bg-pink-600 shadow-md shadow-pink-600/50' : (isLightMode ? 'w-2.5 bg-gray-300 hover:bg-gray-500' : 'w-2.5 bg-white/30 hover:bg-white/60')"
                                class="h-2 rounded-full transition-all duration-300"></button>
                    </template>
                </div>
            </div>

            <!-- TEKS HEADLINE UTAMA & MOTTO BRAND -->
            <div class="text-center space-y-6 max-w-3xl mx-auto pt-6">
                <div class="inline-flex items-center gap-2 rounded-full bg-pink-500/10 px-4 py-1.5 text-xs font-extrabold text-pink-500 ring-1 ring-inset ring-pink-500/30">
                    <span class="h-2 w-2 rounded-full bg-pink-500 animate-pulse"></span>
                    Wear your style, own with your story! DBLA FOR DEABLA
                </div>

                <h1 class="text-4xl sm:text-6xl font-black tracking-tight uppercase leading-none" :class="isLightMode ? 'text-gray-900' : 'text-white'">
                    DEABLA<span class="text-pink-500">.</span> HOODIE & KNITWEAR
                </h1>

                <p class="text-xs sm:text-sm max-w-xl mx-auto leading-relaxed" :class="isLightMode ? 'text-gray-600' : 'text-gray-400'">
                    Perpaduan siluet <em class="not-italic font-semibold" :class="isLightMode ? 'text-gray-900' : 'text-white'">Boxy oversized</em> modern dengan kekuatan material <em class="not-italic font-semibold" :class="isLightMode ? 'text-gray-900' : 'text-white'">heavyweight fleece</em> 310 GSM. Didesain untuk karakter tanpa kompromi.
                </p>

                <!-- TOMBOL LIKE INTERAKTIF -->
                <div class="pt-2 flex justify-center">
                    <button @click="toggleLike()" 
                            class="px-6 py-3.5 rounded-full border text-xs font-black uppercase tracking-wider transition-all duration-300 flex items-center gap-2.5 shadow-sm"
                            :class="liked ? 'bg-pink-600 text-white border-pink-600 shadow-pink-600/30' : (isLightMode ? 'bg-white border-gray-300 text-gray-700 hover:bg-gray-100 shadow-gray-200' : 'bg-zinc-900 border-white/15 text-gray-300 hover:bg-zinc-800')">
                        <svg class="w-4 h-4 transition-transform duration-300" :class="liked ? 'scale-125 fill-current text-white' : 'fill-none stroke-current'" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        <span>Suka Produk Ini</span>
                        <span class="ml-1 px-2.5 py-0.5 rounded-full text-[10px] font-mono" :class="liked ? 'bg-black/20 text-white' : (isLightMode ? 'bg-gray-200 text-gray-700' : 'bg-white/10 text-gray-300')" x-text="likeCount"></span>
                    </button>
                </div>
            </div>

        </div>
    </section>

    <!-- 2. SECTION: PRODUCT KNOWLEDGE & PREVIEW DETAIL PRODUK -->
    <section class="py-20 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto border-t transition-colors duration-700" :class="isLightMode ? 'border-gray-200' : 'border-white/10'">
        <div class="text-center space-y-2 mb-12">
            <span class="text-[10px] font-black text-pink-500 uppercase tracking-[0.25em]">Product Knowledge & Preview</span>
            <h2 class="text-2xl sm:text-4xl font-black uppercase tracking-tight" :class="isLightMode ? 'text-gray-900' : 'text-white'">Detail Produk & Spesifikasi</h2>
            <p class="text-xs" :class="isLightMode ? 'text-gray-600' : 'text-gray-400'">Pilih varian thumbnail produk di bawah untuk melihat detail barang secara mendalam.</p>
        </div>

        <div class="border rounded-[36px] p-6 sm:p-12 backdrop-blur-2xl shadow-2xl space-y-8 transition-colors duration-700"
             :class="isLightMode ? 'bg-white border-gray-200 shadow-xl' : 'bg-zinc-950 border-white/15'">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                
                <!-- KOLOM KIRI: TAMPILAN FOTO PRODUK -->
                <div class="lg:col-span-6 space-y-5">
                    <div class="aspect-square w-full rounded-3xl overflow-hidden border flex items-center justify-center relative transition-colors duration-500"
                         :class="isLightMode ? 'bg-gray-100 border-gray-200' : 'bg-black border-white/10'">
                        <img :src="activeProductImage" alt="DEABLA Product Preview" class="h-full w-full object-contain p-6 transition duration-500">
                        
                        <!-- Badge Stok Real-Time dari Storage Laravel -->
                        @php
                            $displayStock = 25; 
                            if (\Illuminate\Support\Facades\Storage::exists('admin_stock.json')) {
                                $stockData = json_decode(\Illuminate\Support\Facades\Storage::get('admin_stock.json'), true);
                                if (isset($stockData[0]['stock'])) {
                                    $displayStock = $stockData[0]['stock'];
                                }
                            }
                        @endphp
                        
                        <span class="absolute top-4 right-4 px-3.5 py-1.5 rounded-full {{ $displayStock > 0 ? 'bg-pink-600 text-white' : 'bg-red-600 text-white' }} text-[10px] font-black uppercase tracking-wider shadow-lg">
                            {{ $displayStock > 0 ? 'Ready Stock (' . $displayStock . ' Pcs)' : 'Habis / Sold Out' }}
                        </span>
                    </div>

                    <!-- Thumbnail Interaktif -->
                    <div class="space-y-2">
                        <span class="text-[10px] font-bold uppercase tracking-wider block" :class="isLightMode ? 'text-gray-500' : 'text-gray-400'">Pilih Sudut Pandang Produk:</span>
                        <div class="flex items-center gap-3">
                            <button @click="activeProductImage = '{{ asset('images/Love%20Bombing.png') }}'" 
                                    :class="activeProductImage === '{{ asset('images/Love%20Bombing.png') }}' ? 'border-pink-500 ring-2 ring-pink-500/40 scale-105' : (isLightMode ? 'border-gray-300 opacity-60 hover:opacity-100 bg-gray-100' : 'border-white/10 opacity-60 hover:opacity-100 bg-black')"
                                    class="w-16 h-16 rounded-2xl overflow-hidden border transition-all duration-300 flex items-center justify-center">
                                <img src="{{ asset('images/Love%20Bombing.png') }}" class="w-full h-full object-contain p-1">
                            </button>
                        </div>
                    </div>
                </div>

                <!-- KOLOM KANAN: SPESIFIKASI & SIZE CHART -->
                <div class="lg:col-span-6 space-y-6">
                    <div>
                        <span class="text-[10px] font-black text-pink-500 uppercase tracking-widest bg-pink-500/10 px-3.5 py-1 rounded-full border border-pink-500/20">Drop 01 Flagship</span>
                        <h3 class="text-2xl sm:text-3xl font-black uppercase tracking-tight mt-3" :class="isLightMode ? 'text-gray-900' : 'text-white'">DEABLA Zip Hoodie - Love Bombing</h3>
                        <p class="text-2xl font-black text-pink-500 font-mono mt-1">Rp 350.000</p>
                    </div>

                    <!-- Tab Switcher -->
                    <div class="flex items-center gap-2 border-b pb-3 transition-colors duration-500" :class="isLightMode ? 'border-gray-200' : 'border-white/10'">
                        <button @click="activeTab = 'specs'" 
                                :class="activeTab === 'specs' ? 'bg-pink-600 text-white shadow-lg shadow-pink-600/30' : (isLightMode ? 'bg-gray-200 text-gray-700 hover:bg-gray-300' : 'bg-white/5 text-gray-400 hover:text-white')"
                                class="px-5 py-2.5 rounded-xl font-black text-xs uppercase tracking-wider transition">
                            Spesifikasi
                        </button>
                        <button @click="activeTab = 'size'" 
                                :class="activeTab === 'size' ? 'bg-pink-600 text-white shadow-lg shadow-pink-600/30' : (isLightMode ? 'bg-gray-200 text-gray-700 hover:bg-gray-300' : 'bg-white/5 text-gray-400 hover:text-white')"
                                class="px-5 py-2.5 rounded-xl font-black text-xs uppercase tracking-wider transition">
                            Size Chart
                        </button>
                    </div>

                    <!-- Konten Spesifikasi -->
                    <div x-show="activeTab === 'specs'" class="space-y-3">
                        <ul class="space-y-3 text-xs" :class="isLightMode ? 'text-gray-700' : 'text-gray-300'">
                            <li class="flex items-center gap-2.5"><span class="w-2 h-2 rounded-full bg-pink-500"></span> <strong :class="isLightMode ? 'text-gray-900' : 'text-white'">Material:</strong> Heavyweight Cotton Fleece 310 GSM</li>
                            <li class="flex items-center gap-2.5"><span class="w-2 h-2 rounded-full bg-pink-500"></span> <strong :class="isLightMode ? 'text-gray-900' : 'text-white'">Hood:</strong> Double-layer hood (Tegap berdiri)</li>
                            <li class="flex items-center gap-2.5"><span class="w-2 h-2 rounded-full bg-pink-500"></span> <strong :class="isLightMode ? 'text-gray-900' : 'text-white'">Sablon:</strong> High-Density Screenprinting (Awet & anti retak)</li>
                            <li class="flex items-center gap-2.5"><span class="w-2 h-2 rounded-full bg-pink-500"></span> <strong :class="isLightMode ? 'text-gray-900' : 'text-white'">Fit:</strong> Modern Boxy Oversized Cut</li>
                        </ul>
                    </div>

                    <!-- Konten Size Chart -->
                    <div x-show="activeTab === 'size'" class="space-y-4" x-cloak>
                        <div class="grid grid-cols-4 gap-2">
                            <button @click="selectedSize = 'M'" :class="selectedSize === 'M' ? 'border-pink-500 bg-pink-500/10 text-pink-600 font-bold' : (isLightMode ? 'border-gray-300 bg-gray-100 text-gray-700' : 'border-white/10 bg-black/40 text-gray-400')" class="p-3 rounded-xl border text-center transition">
                                <span class="block text-sm font-black">M</span>
                            </button>
                            <button @click="selectedSize = 'L'" :class="selectedSize === 'L' ? 'border-pink-500 bg-pink-500/10 text-pink-600 font-bold' : (isLightMode ? 'border-gray-300 bg-gray-100 text-gray-700' : 'border-white/10 bg-black/40 text-gray-400')" class="p-3 rounded-xl border text-center transition">
                                <span class="block text-sm font-black">L</span>
                            </button>
                            <button @click="selectedSize = 'XL'" :class="selectedSize === 'XL' ? 'border-pink-500 bg-pink-500/10 text-pink-600 font-bold' : (isLightMode ? 'border-gray-300 bg-gray-100 text-gray-700' : 'border-white/10 bg-black/40 text-gray-400')" class="p-3 rounded-xl border text-center transition">
                                <span class="block text-sm font-black">XL</span>
                            </button>
                            <button @click="selectedSize = 'XXL'" :class="selectedSize === 'XXL' ? 'border-pink-500 bg-pink-500/10 text-pink-600 font-bold' : (isLightMode ? 'border-gray-300 bg-gray-100 text-gray-700' : 'border-white/10 bg-black/40 text-gray-400')" class="p-3 rounded-xl border text-center transition">
                                <span class="block text-sm font-black">XXL</span>
                            </button>
                        </div>
                        <div class="border rounded-2xl p-4 text-xs transition-colors duration-500" :class="isLightMode ? 'bg-gray-100 border-gray-200' : 'bg-black border-white/10'">
                            <span class="text-pink-500 font-bold uppercase">Size <span x-text="selectedSize"></span>:</span>
                            <p class="mt-1" :class="isLightMode ? 'text-gray-700' : 'text-gray-300'" x-text="
                                selectedSize === 'M' ? 'Lebar Dada: 58 cm | Panjang Badan: 70 cm' :
                                (selectedSize === 'L' ? 'Lebar Dada: 61 cm | Panjang Badan: 72 cm' :
                                (selectedSize === 'XL' ? 'Lebar Dada: 64 cm | Panjang Badan: 75 cm' : 
                                'Lebar Dada: 67 cm | Panjang Badan: 78 cm'))
                            "></p>
                        </div>
                    </div>

                    <a href="{{ url('/contact') }}" class="block w-full text-center py-4 rounded-2xl bg-gradient-to-r from-pink-600 to-pink-500 hover:from-pink-500 hover:to-pink-400 text-white font-black text-xs uppercase tracking-widest transition shadow-xl shadow-pink-600/30">
                        Pesan Varian Ini &rarr;
                    </a>
                </div>

            </div>

        </div>
    </section>

    <!-- KEUNGGULAN BRAND -->
    <section class="py-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto border-t mt-12 transition-colors duration-700" :class="isLightMode ? 'border-gray-200' : 'border-white/10'">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="flex items-start gap-4 p-8 rounded-[28px] border backdrop-blur-sm transition-colors duration-500"
                 :class="isLightMode ? 'bg-white border-gray-200 shadow-sm' : 'bg-zinc-900/60 border-white/10'">
                <div class="p-3.5 rounded-2xl bg-pink-500/10 text-pink-500 border border-pink-500/20 shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <div>
                    <h3 class="text-base font-extrabold" :class="isLightMode ? 'text-gray-900' : 'text-white'">Bahan Premium 310 GSM</h3>
                    <p class="text-xs mt-1.5 leading-relaxed" :class="isLightMode ? 'text-gray-600' : 'text-gray-400'">Ketebalan optimal, terstruktur rapat, dan tidak gampang melar walau sering dicuci.</p>
                </div>
            </div>

            <div class="flex items-start gap-4 p-8 rounded-[28px] border backdrop-blur-sm transition-colors duration-500"
                 :class="isLightMode ? 'bg-white border-gray-200 shadow-sm' : 'bg-zinc-900/60 border-white/10'">
                <div class="p-3.5 rounded-2xl bg-pink-500/10 text-pink-500 border border-pink-500/20 shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                </div>
                <div>
                    <h3 class="text-base font-extrabold" :class="isLightMode ? 'text-gray-900' : 'text-white'">Garansi Tukar Ukuran</h3>
                    <p class="text-xs mt-1.5 leading-relaxed" :class="isLightMode ? 'text-gray-600' : 'text-gray-400'">Ukuran tidak pas? Kami berikan jaminan tukar size gratis dalam 3 hari.</p>
                </div>
            </div>

            <div class="flex items-start gap-4 p-8 rounded-[28px] border backdrop-blur-sm transition-colors duration-500"
                 :class="isLightMode ? 'bg-white border-gray-200 shadow-sm' : 'bg-zinc-900/60 border-white/10'">
                <div class="p-3.5 rounded-2xl bg-pink-500/10 text-pink-500 border border-pink-500/20 shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <div>
                    <h3 class="text-base font-extrabold" :class="isLightMode ? 'text-gray-900' : 'text-white'">Pengiriman Cepat & Aman</h3>
                    <p class="text-xs mt-1.5 leading-relaxed" :class="isLightMode ? 'text-gray-600' : 'text-gray-400'">Dikemas rapi dengan packaging eksklusif DEABLA dan perlindungan ganda.</p>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection