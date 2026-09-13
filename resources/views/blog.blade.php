@extends('layouts.app')

@section('content')
<section class="py-8 sm:py-16 bg-black min-h-screen relative overflow-hidden">
    
    <!-- AMBIENT GLOW LATAR BELAKANG -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-pink-600/10 blur-[140px] pointer-events-none rounded-full"></div>
    <div class="absolute bottom-10 right-10 w-[400px] h-[400px] bg-purple-600/10 blur-[120px] pointer-events-none rounded-full"></div>

    <div class="relative z-10 mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        
        <!-- HEADER BLOG / JOURNAL -->
        <div class="border-b border-white/10 pb-8 sm:pb-10 mb-10 sm:mb-14 text-center max-w-2xl mx-auto space-y-3">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-pink-500/10 border border-pink-500/20 text-pink-400 text-[9px] sm:text-[10px] font-black uppercase tracking-[0.25em]">
                <span class="w-1.5 h-1.5 rounded-full bg-pink-500 animate-pulse"></span>
                Official DEABLA Journal
            </div>
            <h1 class="text-3xl sm:text-6xl font-black text-white uppercase tracking-tight drop-shadow-2xl">
                Motto & Filosofi <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-purple-500">Brand</span>
            </h1>
            <p class="text-xs sm:text-base text-gray-400 leading-relaxed font-medium">
                Eksplorasi mendalam di balik estetika visual, standar material heavyweight, dan dedikasi absolut DEABLA dalam industri streetwear modern.
            </p>
        </div>

        <!-- ARTIKEL UTAMA -->
        <article class="space-y-10 sm:space-y-16">
            
            <!-- 1. HERO LOOKBOOK BANNER -->
            <div class="relative overflow-hidden rounded-3xl bg-zinc-950 border border-white/15 shadow-2xl group">
                <div class="aspect-[4/5] sm:aspect-[16/9] w-full overflow-hidden bg-black relative flex items-center justify-center">
                    
                    <!-- Ambient Glow dari Foto -->
                    <img src="{{ asset('images/blog-banner.png') }}" 
                         alt="Ambient Blur" 
                         class="absolute inset-0 w-full h-full object-cover blur-3xl opacity-40 scale-125 pointer-events-none">

                    <!-- Foto Utama Model -->
                    <img src="{{ asset('images/blog-banner.png') }}" 
                         alt="DEABLA Editorial Look" 
                         class="relative z-10 h-full w-full object-contain object-center group-hover:scale-105 transition duration-700">

                    <!-- Gradien Overlay -->
                    <div class="absolute inset-0 z-20 bg-gradient-to-t from-zinc-950 via-zinc-950/40 to-transparent opacity-90 pointer-events-none"></div>
                </div>

                <div class="p-6 sm:p-10 bg-zinc-950 border-t border-white/10 space-y-3 relative z-30">
                    <div class="flex items-center justify-between">
                        <span class="text-[10px] sm:text-xs font-black text-pink-400 uppercase tracking-widest bg-pink-500/10 px-3 py-1 rounded-full border border-pink-500/20">Lookbook 2025/2026</span>
                        <span class="text-[10px] text-gray-500 font-mono">EST. 3 MIN READ</span>
                    </div>
                    <h2 class="text-xl sm:text-4xl font-black text-white uppercase tracking-tight">
                        "Raw Power in Minimalist Silhouette"
                    </h2>
                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-light">
                        Motto DEABLA: <strong class="text-white font-black tracking-wide">"Wear your style, own with your story! DBLA FOR DEABLA"</strong>. Kami percaya bahwa setiap detail jahitan merefleksikan identitas dan karakter urban yang otentik.
                    </p>
                </div>
            </div>

            <!-- 2. PARAGRAF FILOSOFI & MATERIAL 310GSM -->
            <div class="bg-zinc-900/40 border border-white/10 rounded-3xl p-6 sm:p-10 backdrop-blur-md space-y-6">
                <h3 class="text-lg sm:text-2xl font-black text-white uppercase tracking-wider border-l-4 border-pink-500 pl-4">
                    Awal Mula & Standar Material 310GSM
                </h3>
                
                <div class="space-y-4 text-xs sm:text-sm leading-relaxed text-gray-300">
                    <p class="text-gray-300">
                        DEABLA lahir dari sebuah dedikasi tanpa kompromi terhadap kualitas pakaian harian. Di saat banyak brand mengorbankan ketebalan demi efisiensi, kami memilih jalan berbeda dengan menetapkan standar wajib: <strong class="text-white font-bold">bahan 310GSM</strong> pada setiap artikel utama kami.
                    </p>
                    <p class="text-gray-400">
                        Penggunaan material bergramasi 310GSM ini memastikan pakaian memiliki struktur yang kokoh, tidak mudah susut, memberikan kehangatan yang pas, serta menjaga siluet tubuh tetap tegap dan berkarakter kuat dalam jangka panjang.
                    </p>
                </div>

                <!-- QUOTE BOX -->
                <div class="border-l-2 border-pink-500/60 pl-4 py-2 my-4 italic text-xs sm:text-sm text-pink-300 font-medium">
                    "Wear your style, own with your story! DBLA FOR DEABLA — kualitas 310GSM berbicara lewat ketahanan."
                </div>
            </div>

            <!-- 3. GRID SHOWCASE: MATERIAL & CRAFTSMANSHIP -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                
                <!-- Card 1: Cotton Fleece Standard -->
                <div class="group bg-zinc-950/80 rounded-3xl border border-white/10 p-6 sm:p-8 flex flex-col justify-between hover:border-pink-500/40 transition duration-500 shadow-xl">
                    <div class="space-y-4">
                        <div class="aspect-square rounded-2xl overflow-hidden bg-black p-3 flex items-center justify-center border border-white/5 group-hover:scale-[1.02] transition duration-500">
                            <img src="{{ asset('images/Love%20Bombing.png') }}" 
                                 alt="DEABLA Heavyweight Hoodie" 
                                 class="h-full w-full object-contain object-center">
                        </div>
                        <div>
                            <span class="text-[9px] font-black text-pink-400 uppercase tracking-widest block mb-1">Material Standard</span>
                            <h4 class="text-base sm:text-lg font-extrabold text-white uppercase">Cotton Fleece 310 GSM</h4>
                            <p class="text-xs text-gray-400 mt-2 leading-relaxed">
                                Karakter kain padat, lembut di kulit, dan tidak berbulu berlebih. Bagian kupluk (<em class="not-italic text-white font-semibold">hood</em>) dirancang double-layer agar berdiri tegar sempurna.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Knitwear Craftsmanship -->
                <div class="relative overflow-hidden rounded-3xl border border-purple-500/30 bg-gradient-to-br from-purple-950/50 via-zinc-950 to-black p-6 sm:p-8 flex flex-col justify-between space-y-6 shadow-xl">
                    
                    <div class="absolute -top-12 -right-12 w-40 h-40 bg-purple-600/25 rounded-full blur-3xl pointer-events-none"></div>
                    <div class="absolute -bottom-12 -left-12 w-40 h-40 bg-pink-600/20 rounded-full blur-3xl pointer-events-none"></div>

                    <div class="relative z-10 space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-[9px] font-black text-purple-400 uppercase tracking-widest">Craftsmanship</span>
                            <span class="px-3 py-1 rounded-full bg-purple-500/20 border border-purple-500/40 text-purple-300 font-extrabold text-[9px] uppercase tracking-wider animate-pulse">
                                Next Drop
                            </span>
                        </div>
                        
                        <div>
                            <h4 class="text-xl sm:text-2xl font-black text-white uppercase tracking-tight">
                                STAY TUNED<span class="text-purple-500">.</span>
                            </h4>
                            <p class="text-xs font-bold text-gray-300 uppercase tracking-wider mt-0.5">
                                Soft Wool Knitwear Series
                            </p>
                        </div>

                        <p class="text-xs text-gray-400 leading-relaxed">
                            Koleksi rajut eksklusif memadukan benang <em class="not-italic text-white font-semibold">soft acrylic wool</em> premium. Menghasilkan rajutan rapat, hangat di udara dingin, namun tetap breathable dan bebas gatal di kulit.
                        </p>
                    </div>

                    <div class="relative z-10 pt-4 border-t border-white/10">
                        <a href="https://www.instagram.com/deablacenterr.id" 
                           target="_blank" 
                           class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-500 hover:to-pink-500 text-white font-extrabold text-[10px] uppercase tracking-wider py-3 rounded-xl shadow-lg shadow-purple-600/25 transition duration-300 active:scale-95">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            Dapatkan Update di Instagram
                        </a>
                    </div>
                </div>

            </div>

            <!-- 4. KESIMPULAN / FOOTER JOURNAL -->
            <div class="p-6 sm:p-10 rounded-3xl bg-gradient-to-r from-pink-950/40 via-zinc-950 to-black border border-pink-500/30 text-center space-y-3 shadow-2xl relative overflow-hidden">
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-pink-600/10 via-transparent to-transparent pointer-events-none"></div>
                <h3 class="text-lg sm:text-2xl font-black text-white uppercase tracking-wider relative z-10">
                    Dibuat Untuk Tahan Lama
                </h3>
                <p class="text-xs sm:text-sm text-gray-300 max-w-xl mx-auto leading-relaxed relative z-10">
                    DEABLA melampaui batas tren musiman. Setiap artikel dirancang untuk menjadi investasi gaya harian yang <em class="not-italic text-white font-semibold">timeless</em>, tangguh, dan mencerminkan subkultur urban masa kini.
                </p>
            </div>

        </article>

    </div>
</section>
@endsection