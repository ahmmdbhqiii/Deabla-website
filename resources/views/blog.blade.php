@extends('layouts.app')

@section('content')
<section class="py-6 sm:py-12 bg-black min-h-screen">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        
        <!-- HEADER BLOG -->
        <div class="border-b border-white/10 pb-6 sm:pb-8 mb-8 sm:mb-12 text-center max-w-2xl mx-auto space-y-2 sm:space-y-3">
            <span class="text-[9px] sm:text-xs font-black text-pink-500 uppercase tracking-[0.25em] block">Official DEABLA Journal</span>
            <h1 class="text-2xl sm:text-5xl font-black text-white uppercase tracking-tight drop-shadow-lg">Motto & Filosofi Brand</h1>
            <p class="text-xs sm:text-base text-gray-400 leading-relaxed font-medium">
                Cerita di balik lahirnya DEABLA, prinsip material pilihan, dan dedikasi kami dalam dunia streetwear.
            </p>
        </div>

        <!-- ARTIKEL UTAMA FULL STORY -->
        <article class="space-y-8 sm:space-y-12 text-gray-300">
            
            <!-- 1. BANNER FOTO MODEL UTAMA -->
            <div class="relative overflow-hidden rounded-2xl sm:rounded-3xl bg-zinc-950 border border-white/10 shadow-2xl">
                <div class="aspect-[3/4] sm:aspect-[4/3] w-full overflow-hidden bg-black relative flex items-center justify-center">
                    
                    <!-- AMBIENT GLOW BACKGROUND DARI FOTO -->
                    <img src="{{ asset('images/blog-banner.png') }}" 
                         alt="Background Glow" 
                         class="absolute inset-0 w-full h-full object-cover blur-2xl opacity-30 scale-125 pointer-events-none">

                    <!-- FOTO MODEL UTUH 100% TANPA KEPOTONG -->
                    <img src="{{ asset('images/blog-banner.png') }}" 
                         alt="Model DEABLA Wear" 
                         class="relative z-10 h-full w-full object-contain object-center">

                    <div class="absolute inset-0 z-20 bg-gradient-to-t from-zinc-950 via-transparent to-transparent opacity-80 pointer-events-none"></div>
                </div>

                <div class="p-5 sm:p-8 bg-zinc-900/90 border-t border-white/10 space-y-2 relative z-30">
                    <span class="text-[9px] sm:text-xs font-black text-pink-400 uppercase tracking-widest">Lookbook 2026</span>
                    <h2 class="text-lg sm:text-3xl font-black text-white uppercase tracking-tight">
                        "Raw Power in Minimalist Silhouette"
                    </h2>
                    <p class="text-xs sm:text-sm text-gray-400 leading-relaxed">
                        Motto utama DEABLA: Menghadirkan pakaian berkarakter kuat tanpa perlu menggunakan corak yang terlalu ramai. Kekuatan utama pakaian kami terletak pada potongan (<em class="not-italic text-white font-semibold">fit</em>) yang presisi serta ketebalan material yang terasa kokoh saat dikenakan.
                    </p>
                </div>
            </div>

            <!-- 2. PARAGRAF CERITA & FILOSOFI -->
            <div class="space-y-4 sm:space-y-6 text-xs sm:text-base leading-relaxed text-gray-300">
                <h3 class="text-base sm:text-2xl font-black text-white uppercase tracking-wider border-l-4 border-pink-500 pl-3 sm:pl-4">
                    Awal Mula DEABLA
                </h3>
                <p class="text-gray-400">
                    Kami memulai DEABLA dengan satu kegelisahan sederhana: banyaknya pakaian kasual yang terlihat bagus saat di foto, namun langsung kehilangan bentuk dan kelembutannya setelah beberapa kali dicuci.
                </p>
                <p class="text-gray-400">
                    Oleh karena itu, DEABLA hadir dengan standar produksi sendiri. Setiap koleksi yang kami rilis dirancang khusus menggunakan kain berkualitas tinggi, mulai dari katun bergramasi padat hingga serat rajut halus yang nyaman dipakai sepanjang hari.
                </p>
            </div>

            <!-- 3. SHOWCASE FOTO HOODIE & BANNER STAY TUNED KNITWEAR -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 py-2">
                
                <!-- Foto Hoodie (Diperbaiki menggunakan %20 untuk spasi file) -->
                <div class="space-y-3 bg-zinc-900/60 p-4 sm:p-5 rounded-2xl border border-white/10 backdrop-blur-sm flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="aspect-square rounded-xl overflow-hidden bg-black p-2 flex items-center justify-center">
                            <img src="{{ asset('images/Love%20Bombing.png') }}" 
                                 alt="DEABLA Heavyweight Hoodie" 
                                 class="h-full w-full object-contain object-center">
                        </div>
                        <div>
                            <span class="text-[9px] font-black text-pink-400 uppercase tracking-widest block mb-0.5">Material Standard</span>
                            <h4 class="text-sm sm:text-base font-extrabold text-white uppercase">Cotton Fleece 375 GSM</h4>
                            <p class="text-xs text-gray-400 mt-1 leading-relaxed">
                                Bahan hoodie kami menggunakan katun fleece 375 GSM bertekstur tebal, membuat bagian kupluk (<em class="not-italic text-white font-semibold">hood</em>) berdiri tegak dan tidak lembek saat dipakai.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Banner Knitwear Stay Tuned -->
                <div class="relative overflow-hidden rounded-2xl border border-purple-500/30 bg-gradient-to-br from-purple-950/60 via-zinc-900 to-black p-5 sm:p-6 flex flex-col justify-between space-y-4 shadow-xl">
                    
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-purple-600/30 rounded-full blur-2xl pointer-events-none"></div>
                    <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-pink-600/20 rounded-full blur-2xl pointer-events-none"></div>

                    <div class="relative z-10 space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-[9px] font-black text-purple-400 uppercase tracking-widest">Craftsmanship</span>
                            <span class="px-2.5 py-0.5 rounded-full bg-purple-500/20 border border-purple-500/40 text-purple-300 font-extrabold text-[8px] uppercase tracking-wider animate-pulse">
                                Next Drop
                            </span>
                        </div>
                        
                        <div class="pt-2">
                            <h4 class="text-xl sm:text-2xl font-black text-white uppercase tracking-tight">
                                STAY TUNED<span class="text-purple-500">.</span>
                            </h4>
                            <p class="text-xs font-bold text-gray-300 uppercase tracking-wider mt-0.5">
                                Soft Wool Knitwear Series
                            </p>
                        </div>

                        <p class="text-xs text-gray-400 leading-relaxed pt-1">
                            Koleksi rajut DEABLA memadukan benang <em class="not-italic text-white font-semibold">soft acrylic wool</em> agar menghasilkan rajutan yang rapat, hangat, namun tidak menyebabkan gatal pada kulit.
                        </p>
                    </div>

                    <div class="relative z-10 pt-2 border-t border-white/10">
                        <a href="https://www.instagram.com/deablacenterr.id" 
                           target="_blank" 
                           class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-500 hover:to-pink-500 text-white font-extrabold text-[10px] uppercase tracking-wider py-2.5 rounded-xl shadow-lg shadow-purple-600/20 transition duration-300 active:scale-95">
                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            Dapatkan Update di IG
                        </a>
                    </div>
                </div>

            </div>

            <!-- 4. KESIMPULAN / MOTTO PENUTUP -->
            <div class="p-5 sm:p-8 rounded-2xl bg-gradient-to-r from-pink-950/40 via-zinc-900 to-black border border-pink-500/30 text-center space-y-2 sm:space-y-3 shadow-xl">
                <h3 class="text-base sm:text-xl font-black text-white uppercase tracking-wider">
                    Dibuat Untuk Tahan Lama
                </h3>
                <p class="text-xs sm:text-sm text-gray-300 max-w-xl mx-auto leading-relaxed">
                    DEABLA bukan sekadar tentang tren sesaat. Pakaian kami diciptakan untuk menjadi koleksi andalan harian Anda yang <em class="not-italic text-white font-semibold">timeless</em>, nyaman, dan berkarakter.
                </p>
            </div>

        </article>

    </div>
</section>
@endsection