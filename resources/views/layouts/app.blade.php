<!DOCTYPE html>
<html lang="id" class="h-full bg-black scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DEABLACENTERR.ID — Hoodie & Knitwear</title>

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <!-- Tailwind CSS CDN & Alpine.js -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* KAPSUL LIQUID GLASS DESKTOP */
        .glass-navbar-desktop {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(24px) saturate(180%);
            -webkit-backdrop-filter: blur(24px) saturate(180%);
            border: 1px solid rgba(236, 72, 153, 0.2);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.5),
                        inset 0 1px 1px 0 rgba(255, 255, 255, 0.15);
        }

        /* CONTAINER DOCK MELAYANG HP */
        .glass-navbar-mobile {
            position: fixed;
            bottom: 24px;
            left: 50%;
            transform: translateX(-50%);
            width: 85%;
            max-width: 280px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(28px) saturate(200%);
            -webkit-backdrop-filter: blur(28px) saturate(200%);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 9999px;
            padding: 6px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6), 
                        0 0 20px rgba(236, 72, 153, 0.15),
                        inset 0 1px 1px rgba(255, 255, 255, 0.2);
            z-index: 999;
            overflow: hidden;
        }

        /* TRACK SWIPE / DRAG KHUSUS */
        .liquid-drag-track {
            display: flex;
            align-items: center;
            position: relative;
            gap: 6px;
            overflow-x: auto;
            scroll-behavior: auto !important;
            cursor: grab;
            user-select: none;
            -webkit-user-select: none;
            touch-action: pan-x;
        }

        .liquid-drag-track:active {
            cursor: grabbing;
        }

        .liquid-drag-track::-webkit-scrollbar {
            display: none;
        }
        .liquid-drag-track {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .nav-link-liquid, .nav-link-mobile {
            position: relative;
            padding: 8px 18px;
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            z-index: 2;
            transition: color 0.3s ease;
            white-space: nowrap;
            border-radius: 9999px;
            flex-shrink: 0;
            user-select: none;
            -webkit-user-drag: none;
        }

        .nav-link-liquid.active, .nav-link-mobile.active {
            color: #ffffff;
        }

        /* INDIKATOR LIQUID GLASS */
        .glass-indicator {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            background: linear-gradient(135deg, rgba(219, 39, 119, 0.5), rgba(147, 51, 234, 0.5));
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 9999px;
            box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.4),
                        0 4px 20px rgba(219, 39, 119, 0.3);
            z-index: 1;
            transition: all 0.45s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            pointer-events: none !important;
        }
    </style>
</head>
<body class="h-full text-gray-100 bg-black selection:bg-pink-500 selection:text-white">

<div class="min-h-full flex flex-col">

    <!-- HEADER DESKTOP -->
    <header class="relative z-40 px-4 sm:px-6 lg:px-8 pt-6 pb-2">
        <div class="mx-auto max-w-7xl glass-navbar-desktop rounded-2xl transition-all duration-300">
            <div class="flex h-16 items-center justify-between px-6">
                
                <!-- BRAND LOGO DEABLA & NAMA DEABLACENTERR.ID -->
                <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/logo.png') }}" 
                         alt="DEABLACENTERR.ID Logo" 
                         class="h-10 w-auto object-contain rounded-lg group-hover:scale-105 transition-transform">
                    <div>
                        <span class="text-base sm:text-lg font-black tracking-[0.12em] text-white uppercase block leading-none">
                            DEABLACENTERR<span class="text-pink-500">.ID</span>
                        </span>
                        <span class="text-[8px] tracking-[0.25em] text-purple-400 uppercase font-bold mt-1 block">Streetwear</span>
                    </div>
                </a>

                <!-- MENU DESKTOP -->
                <nav class="hidden md:block relative p-1 bg-white/5 rounded-full border border-white/10"
                     x-data="{
                         indicatorWidth: 0,
                         indicatorLeft: 0,
                         updatePos() {
                             let active = $el.querySelector('.nav-link-liquid.active') || $el.querySelector('.nav-link-liquid');
                             if(active) {
                                 this.indicatorWidth = active.offsetWidth;
                                 this.indicatorLeft = active.offsetLeft;
                             }
                         }
                     }"
                     x-init="$nextTick(() => updatePos())">
                    
                    <div class="flex items-center gap-1 relative">
                        <div class="glass-indicator" 
                             :style="`width: ${indicatorWidth}px; left: ${indicatorLeft}px;`"></div>

                        <a href="{{ url('/') }}" 
                           class="nav-link-liquid {{ Request::is('/') ? 'active' : '' }}">Home</a>

                        <a href="{{ url('/blog') }}" 
                           class="nav-link-liquid {{ Request::is('blog') ? 'active' : '' }}">Blog</a>

                        <a href="{{ url('/contact') }}" 
                           class="nav-link-liquid {{ Request::is('contact') ? 'active' : '' }}">Contact</a>
                    </div>
                </nav>

                <div class="hidden md:block">
                    <span class="text-[10px] font-black tracking-widest text-pink-400 border border-pink-500/30 px-3.5 py-2 rounded-full bg-pink-500/10 shadow-lg shadow-pink-500/10">
                        OFFICIAL STORE
                    </span>
                </div>

            </div>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-black border-t border-pink-500/20 py-8 mt-auto pb-28 md:pb-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-gray-500">
            <p>&copy; 2026 DEABLACENTERR.ID Apparel & Co. All rights reserved.</p>
            <div class="flex items-center gap-6">
                <!-- TAUTAN INSTAGRAM OFFICIAL -->
                <a href="https://www.instagram.com/deablacenterr.id?utm_source=ig_web_button_share_sheet&igsi=ZDNlZDc0MzIxNw==" 
                   target="_blank" 
                   class="text-pink-400 hover:text-pink-300 font-bold transition flex items-center gap-1.5">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    @deablacenterr.id
                </a>
                <a href="#" class="hover:text-pink-400 transition">Privacy Policy</a>
                <a href="#" class="hover:text-pink-400 transition">Terms of Service</a>
            </div>
        </div>
    </footer>

    <!-- DOCK MOBILE LIQUID GLASS -->
    <nav class="md:hidden glass-navbar-mobile"
         x-data="{
             indicatorWidth: 0,
             indicatorLeft: 0,
             updatePos() {
                 let active = $el.querySelector('.nav-link-mobile.active') || $el.querySelector('.nav-link-mobile');
                 if(active) {
                     this.indicatorWidth = active.offsetWidth;
                     this.indicatorLeft = active.offsetLeft;
                 }
             }
         }"
         x-init="setTimeout(() => updatePos(), 100)">
        
        <div id="liquidTrack" class="liquid-drag-track relative">
            <div class="glass-indicator" 
                 :style="`width: ${indicatorWidth}px; left: ${indicatorLeft}px;`"></div>
            
            <a href="{{ url('/') }}" 
               class="nav-link-mobile {{ Request::is('/') ? 'active' : '' }}">Home</a>
            
            <a href="{{ url('/blog') }}" 
               class="nav-link-mobile {{ Request::is('blog') ? 'active' : '' }}">Blog</a>
            
            <a href="{{ url('/contact') }}" 
               class="nav-link-mobile {{ Request::is('contact') ? 'active' : '' }}">Contact</a>
        </div>
    </nav>

</div>

<!-- SCRIPT DRAG & TOUCH HP -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const track = document.getElementById('liquidTrack');
        if (!track) return;

        let isDown = false;
        let startX = 0;
        let scrollLeft = 0;
        let hasMoved = false;

        track.addEventListener('dragstart', (e) => e.preventDefault());

        track.addEventListener('pointerdown', (e) => {
            isDown = true;
            hasMoved = false;
            startX = e.clientX - track.offsetLeft;
            scrollLeft = track.scrollLeft;
        });

        track.addEventListener('pointermove', (e) => {
            if (!isDown) return;
            const x = e.clientX - track.offsetLeft;
            const walk = (x - startX) * 1.5;
            
            if (Math.abs(x - startX) > 5) {
                hasMoved = true;
                track.scrollLeft = scrollLeft - walk;
            }
        });

        const endDrag = () => {
            isDown = false;
        };

        track.addEventListener('pointerup', endDrag);
        track.addEventListener('pointerleave', endDrag);

        const links = track.querySelectorAll('a');
        links.forEach(link => {
            link.addEventListener('click', (e) => {
                if (hasMoved) {
                    e.preventDefault();
                }
            });
        });
    });
</script>

</body>
</html>