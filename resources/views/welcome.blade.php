@extends('layouts.app')

@section('content')
<!-- STATE MODAL PREVIEW ALPINE.JS -->
<div x-data="{ 
    openModal: false, 
    activeProduct: { title: '', price: '', image: '', category: '', desc: '', badge: '' },
    showPreview(product) {
        this.activeProduct = product;
        this.openModal = true;
    }
}">

    <!-- HERO BANNER -->
    <section class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-3 sm:pt-6 pb-6 sm:pb-10">
        <div class="relative rounded-2xl sm:rounded-3xl overflow-hidden border border-white/10 bg-gradient-to-b from-zinc-900 to-black h-[280px] sm:h-[460px] flex items-center justify-center shadow-2xl">
            
            <img src="{{ asset('images/hero-banner.png') }}" 
                 alt="Model DEABLA Brand" 
                 class="absolute inset-0 w-full h-full object-cover object-center opacity-40 mix-blend-luminosity">

            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>

            <div class="relative z-10 text-center px-4 max-w-2xl space-y-2 sm:space-y-3">
                <span class="text-pink-500 font-black text-[9px] sm:text-xs tracking-[0.25em] uppercase block">Est. 2025 Collection</span>
                <h1 class="text-3xl sm:text-7xl font-black text-white uppercase tracking-tight drop-shadow-2xl">
                    DEABLA<span class="text-pink-500">.</span>
                </h1>
                <p class="text-gray-300 text-[11px] sm:text-base font-medium max-w-sm mx-auto leading-relaxed">
                    Hoodie & Knitwear Crafting Modern Aesthetics.
                </p>
                <div class="pt-2 flex justify-center">
                    <a href="#katalog" class="bg-gradient-to-r from-pink-600 to-pink-500 hover:from-pink-500 hover:to-pink-400 text-white font-black text-[10px] sm:text-xs tracking-widest uppercase px-5 py-3 sm:px-7 sm:py-3.5 rounded-full shadow-lg shadow-pink-600/30 transition duration-300 active:scale-95">
                        Eksplorasi Produk
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- KATALOG PRODUK -->
    <div id="katalog" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 sm:py-8 space-y-10 sm:space-y-16">
        
        <!-- KATEGORI 1: HOODIES -->
        <section>
            <div class="flex items-end justify-between mb-4 sm:mb-6 border-b border-white/10 pb-3">
                <div>
                    <span class="text-pink-500 font-bold text-[9px] sm:text-xs uppercase tracking-widest block mb-0.5">Collection 01</span>
                    <h2 class="text-xl sm:text-3xl font-black text-white uppercase tracking-tight">Hoodies</h2>
                </div>
                <span class="text-[9px] sm:text-xs text-gray-400 font-semibold uppercase tracking-wider">Heavyweight Fleece</span>
            </div>

            <!-- GRID PRODUK -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                
                <!-- SINGLE PRODUCT: LOVE BOMBING -->
                <div @click="showPreview({
                        title: 'DEABLA Zip Hoodie - Love Bombing',
                        price: 'Rp 350.000',
                        image: '{{ asset('images/Love%20Bombing.png') }}',
                        category: 'Article 01 — Zip Hoodie',
                        desc: 'Artikel perdana Love Bombing menghadirkan potongan Boxy Zip-Up Hoodie berwarna hitam pekat dengan grafik font khas DEABLA bernuansa pink magenta & balok nada. Menggunakan material Cotton Fleece Heavyweight 375 GSM yang nyaman dan terstruktur.',
                        badge: 'Article 01'
                     })" 
                     class="group bg-zinc-900/60 rounded-2xl border border-white/10 overflow-hidden hover:border-pink-500/50 transition duration-300 flex flex-col cursor-pointer shadow-xl backdrop-blur-sm">
                    
                    <div class="aspect-[4/5] w-full overflow-hidden bg-black relative flex items-center justify-center p-2">
                        <img src="{{ asset('images/Love%20Bombing.png') }}" alt="DEABLA Love Bombing" class="h-full w-full object-contain object-center group-hover:scale-105 transition duration-500">
                        <span class="absolute top-3 left-3 text-[8px] sm:text-[10px] font-black uppercase tracking-wider bg-pink-500 text-white px-2.5 py-1 rounded-full shadow-md">Article 01</span>
                    </div>

                    <div class="p-4 sm:p-5 flex flex-col flex-grow justify-between space-y-3">
                        <div>
                            <span class="text-[9px] sm:text-xs font-bold text-gray-400 block uppercase tracking-wider">Zip Hoodie</span>
                            <h3 class="text-base sm:text-lg font-bold text-white group-hover:text-pink-400 transition line-clamp-1">Love Bombing</h3>
                            <p class="text-xs sm:text-sm font-extrabold text-pink-400 mt-1">Rp 350.000</p>
                        </div>
                        <span class="text-center bg-white/5 group-hover:bg-pink-600 text-white text-[10px] sm:text-xs font-bold py-2.5 rounded-xl border border-white/10 transition duration-300">
                            Quick View &rarr;
                        </span>
                    </div>
                </div>

            </div>
        </section>

        <!-- KATEGORI 2: KNITWEAR -->
        <section>
            <div class="flex items-end justify-between mb-4 sm:mb-6 border-b border-white/10 pb-3">
                <div>
                    <span class="text-purple-400 font-bold text-[9px] sm:text-xs uppercase tracking-widest block mb-0.5">Collection 02</span>
                    <h2 class="text-xl sm:text-3xl font-black text-white uppercase tracking-tight">Knitwear</h2>
                </div>
                <span class="text-[9px] sm:text-xs text-purple-400 font-bold uppercase tracking-wider animate-pulse">Next Drop</span>
            </div>

            <div class="relative rounded-2xl sm:rounded-3xl border border-purple-500/30 bg-gradient-to-r from-purple-950/40 via-zinc-900 to-black p-6 sm:p-12 text-center overflow-hidden shadow-2xl">
                
                <div class="absolute -top-12 -right-12 w-44 h-44 bg-purple-600/20 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-12 -left-12 w-44 h-44 bg-pink-600/20 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 max-w-md mx-auto space-y-3 sm:space-y-4">
                    <span class="inline-block px-3 py-1 rounded-full bg-purple-500/20 border border-purple-500/40 text-purple-300 font-extrabold text-[8px] sm:text-[10px] uppercase tracking-[0.2em]">
                        Collection 02 In Development
                    </span>
                    <h3 class="text-2xl sm:text-4xl font-black text-white uppercase tracking-tight">
                        STAY TUNED<span class="text-purple-500">.</span>
                    </h3>
                    <p class="text-xs sm:text-sm text-gray-400 font-medium leading-relaxed">
                        Koleksi <span class="text-white font-bold">Knitwear</span> DEABLA sedang dalam tahap pengerjaan & kurasi material.
                    </p>
                    
                    <div class="pt-1">
                        <a href="https://www.instagram.com/deablacenterr.id" 
                           target="_blank" 
                           class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-500 hover:to-pink-500 text-white font-extrabold text-[10px] sm:text-xs uppercase tracking-wider px-5 py-3 rounded-full shadow-lg shadow-purple-600/30 transition duration-300 active:scale-95">
                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            Follow IG DEABLA
                        </a>
                    </div>
                </div>

            </div>
        </section>

    </div>

    <!-- MODAL POPUP PREVIEW PRODUK -->
    <div x-show="openModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="fixed inset-0 z-[1000] flex items-center justify-center p-3 sm:p-4 bg-black/85 backdrop-blur-md" 
         style="display: none;">
        
        <div @click="openModal = false" class="absolute inset-0"></div>

        <div class="relative bg-zinc-950 border border-white/15 rounded-3xl max-w-sm sm:max-w-md w-full overflow-hidden shadow-2xl z-10 my-auto flex flex-col max-h-[88vh]">
            
            <button @click="openModal = false" class="absolute top-3 right-3 z-20 w-8 h-8 flex items-center justify-center bg-black/80 hover:bg-pink-500 text-white rounded-full text-xs transition">
                &#10005;
            </button>

            <div class="overflow-y-auto">
                <!-- BG HITAM PEKAT + GAMBAR UTUH HASIL CROP -->
                <div class="w-full h-64 sm:h-72 bg-black p-3 relative flex items-center justify-center">
                    <img :src="activeProduct.image" :alt="activeProduct.title" class="w-full h-full object-contain object-center">
                    <template x-if="activeProduct.badge">
                        <span class="absolute top-3 left-3 text-[8px] font-black uppercase tracking-wider bg-pink-500 text-white px-2.5 py-1 rounded-full shadow-md" x-text="activeProduct.badge"></span>
                    </template>
                </div>

                <div class="p-4 sm:p-5 flex flex-col justify-between space-y-3">
                    <div>
                        <div class="flex items-center justify-between gap-2 mb-1">
                            <span class="text-[9px] font-bold text-pink-400 uppercase tracking-widest" x-text="activeProduct.category"></span>
                            <p class="text-sm font-extrabold text-white" x-text="activeProduct.price"></p>
                        </div>
                        <h3 class="text-base sm:text-lg font-extrabold text-white leading-tight" x-text="activeProduct.title"></h3>
                        
                        <p class="text-[11px] sm:text-xs text-gray-300 mt-2 leading-relaxed" x-text="activeProduct.desc"></p>

                        <div class="mt-3">
                            <span class="text-[9px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Size Available</span>
                            <div class="flex gap-1.5">
                                <span class="px-2.5 py-1 bg-white/5 border border-white/10 rounded-lg text-[10px] font-bold text-white">S</span>
                                <span class="px-2.5 py-1 bg-white/5 border border-white/10 rounded-lg text-[10px] font-bold text-white">M</span>
                                <span class="px-2.5 py-1 bg-white/5 border border-white/10 rounded-lg text-[10px] font-bold text-white">L</span>
                                <span class="px-2.5 py-1 bg-white/5 border border-white/10 rounded-lg text-[10px] font-bold text-white">XL</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-2">
                        <a href="{{ url('/contact') }}" class="block text-center bg-pink-600 hover:bg-pink-500 text-white text-xs font-black py-3 rounded-xl uppercase tracking-wider transition shadow-lg shadow-pink-600/30">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection