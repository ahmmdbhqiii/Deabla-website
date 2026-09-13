<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DEABLACENTERR.ID') }} - Official Store</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Scripts & Styles (Tailwind / Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js & GSAP Library -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #000000;
            color: #ffffff;
        }
        [x-cloak] { display: none !important; }

        /* PILL NAV STYLING */
        .pill-nav-items {
            position: relative;
            display: flex;
            align-items: center;
            height: 40px;
            background: #000000;
            border-radius: 9999px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .pill-list {
            list-style: none;
            display: flex;
            align-items: stretch;
            gap: 3px;
            margin: 0;
            padding: 3px;
            height: 100%;
        }

        .pill-list > li {
            display: flex;
            height: 100%;
        }

        .pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            padding: 0 16px;
            background: #120F17;
            color: #ffffff;
            text-decoration: none;
            border-radius: 9999px;
            box-sizing: border-box;
            font-weight: 800;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            white-space: nowrap;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        @media (min-width: 640px) {
            .pill { padding: 0 20px; font-size: 11px; }
            .pill-nav-items { height: 42px; }
        }

        .pill.active {
            background: #ec4899;
        }

        .pill .hover-circle {
            position: absolute;
            left: 50%;
            bottom: 0;
            border-radius: 50%;
            background: #ffffff;
            z-index: 1;
            display: block;
            pointer-events: none;
            will-change: transform;
        }

        .pill .label-stack {
            position: relative;
            display: inline-block;
            line-height: 1;
            z-index: 2;
            height: 12px;
            overflow: hidden;
        }

        .pill .pill-label {
            position: relative;
            z-index: 2;
            display: inline-block;
            line-height: 1;
            will-change: transform;
            color: #ffffff;
        }

        .pill .pill-label-hover {
            position: absolute;
            left: 0;
            top: 0;
            color: #120F17;
            z-index: 3;
            display: inline-block;
            will-change: transform, opacity;
        }

        /* MOBILE DOCK CONTAINER MELAYANG BAWAH */
        .glass-navbar-mobile {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            max-width: 320px;
            background: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(28px) saturate(200%);
            -webkit-backdrop-filter: blur(28px) saturate(200%);
            border: 1px solid rgba(236, 72, 153, 0.3);
            border-radius: 9999px;
            padding: 4px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.8), 0 0 20px rgba(236, 72, 153, 0.2);
            z-index: 999;
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body class="min-h-full bg-black text-white antialiased selection:bg-pink-500 selection:text-white flex flex-col justify-between">

<div class="min-h-full flex flex-col">

    <!-- HEADER / NAVBAR ATAS -->
    <header class="sticky top-0 z-50 w-full bg-black/80 backdrop-blur-xl border-b border-white/10 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- 1. BRAND LOGO -->
                <div class="flex items-center gap-3">
                    <a href="{{ url('/') }}" class="flex items-center gap-2.5 group">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo DEABLA" class="h-9 sm:h-10 w-auto object-contain rounded-xl group-hover:scale-105 transition flex-shrink-0">
                        <div class="flex flex-col">
                            <span class="text-xs sm:text-base font-black tracking-tight uppercase text-white whitespace-nowrap">
                                DEABLACENTERR<span class="text-pink-500">.ID</span>
                            </span>
                            <span class="text-[8px] font-bold text-gray-400 tracking-widest uppercase -mt-0.5">Official Store</span>
                        </div>
                    </a>
                </div>

                <!-- 2. RIGHT ACTION BUTTON (Desktop CTA) -->
                <div class="flex items-center gap-3">
                    <a href="{{ url('/contact') }}" class="relative group overflow-hidden rounded-xl p-px font-semibold text-xs uppercase tracking-wider">
                        <span class="absolute inset-0 bg-gradient-to-r from-pink-500 to-purple-600 transition-all duration-300 group-hover:opacity-90"></span>
                        <span class="relative block px-5 py-2.5 rounded-[11px] bg-black text-white transition duration-300 group-hover:bg-opacity-0">
                            Quick Order &rarr;
                        </span>
                    </a>
                </div>

            </div>
        </div>
    </header>

    <!-- MAIN CONTENT AREA -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- FOOTER UTAMA -->
    <footer class="bg-gradient-to-b from-black to-zinc-950 border-t border-white/10 pt-16 pb-32 md:pb-16 px-4 sm:px-6 lg:px-8 mt-20">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-12 gap-10 items-start">
            
            <!-- Kolom Brand & Bio -->
            <div class="md:col-span-5 space-y-4 text-center md:text-left">
                <div class="flex items-center justify-center md:justify-start gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto object-contain rounded-xl">
                    <span class="text-lg font-black tracking-tighter uppercase text-white">DEABLACENTERR<span class="text-pink-500">.ID</span></span>
                </div>
                <p class="text-xs text-gray-400 max-w-sm mx-auto md:mx-0 leading-relaxed">
                    High-end streetwear and heavyweight 310 GSM collection. Designed for those who value unique character and uncompromised quality.
                </p>
                <div class="pt-2">
                    <a href="https://www.instagram.com/deablacenterr.id" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white/5 border border-white/10 text-xs font-bold text-gray-300 hover:text-white hover:bg-white/10 transition">
                        <span>Instagram: @deablacenterr.id</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </div>

            <!-- Kolom Navigasi Cepat -->
            <div class="md:col-span-4 text-center md:text-left space-y-3">
                <h4 class="text-xs font-black uppercase tracking-[0.2em] text-pink-400">Quick Navigation</h4>
                <ul class="space-y-2 text-xs font-extrabold uppercase text-gray-300">
                    <li><a href="{{ url('/') }}" class="hover:text-pink-400 transition">Home / Catalog</a></li>
                    <li><a href="{{ url('/blog') }}" class="hover:text-pink-400 transition">Journal & Stories</a></li>
                    <li><a href="{{ url('/contact') }}" class="hover:text-pink-400 transition">Order & Contact Form</a></li>
                </ul>
            </div>

            <!-- Kolom Info Jam / Status -->
            <div class="md:col-span-3 text-center md:text-left space-y-3">
                <h4 class="text-xs font-black uppercase tracking-[0.2em] text-pink-400">Store Status</h4>
                <div class="p-4 rounded-2xl bg-zinc-900/60 border border-white/10 backdrop-blur-sm space-y-1">
                    <div class="flex items-center justify-center md:justify-start gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span class="text-xs font-bold text-white uppercase">Online 24/7</span>
                    </div>
                    <p class="text-[10px] text-gray-400">Fast response via WhatsApp & Instagram DM.</p>
                </div>
            </div>

        </div>

        <!-- Garis Bawah Copyright (Dengan Portal Rahasia Admin) -->
        <div class="max-w-7xl mx-auto border-t border-white/10 mt-12 pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-center">
            <p class="text-xs text-gray-500 font-medium">
                &copy; {{ date('Y') }} 
                <a href="{{ route('admin.login') }}" class="hover:text-pink-500 transition" title="Admin Portal">DEABLACENTERR.ID</a>. 
                All rights reserved. Crafted for High-End Streetwear.
            </p>
            <div class="flex items-center gap-4 text-[10px] font-bold uppercase text-gray-400">
                <span>Heavyweight 310 GSM</span>
                <span>&bull;</span>
                <span>Secure Checkout</span>
            </div>
        </div>
    </footer>

    <!-- MOBILE PILL NAV DOCK (MELAYANG DI BAWAH KHUSUS HP) -->
    <nav class="md:hidden glass-navbar-mobile" aria-label="Mobile Primary">
        <div class="pill-nav-items">
            <ul class="pill-list" role="menubar">
                <li role="none">
                    <a role="menuitem" href="{{ url('/') }}" class="pill {{ request()->is('/') ? 'active' : '' }}">
                        <span class="hover-circle" aria-hidden="true"></span>
                        <span class="label-stack">
                            <span class="pill-label">Home</span>
                            <span class="pill-label-hover" aria-hidden="true">Home</span>
                        </span>
                    </a>
                </li>
                <li role="none">
                    <a role="menuitem" href="{{ url('/blog') }}" class="pill {{ request()->is('blog*') ? 'active' : '' }}">
                        <span class="hover-circle" aria-hidden="true"></span>
                        <span class="label-stack">
                            <span class="pill-label">Journal</span>
                            <span class="pill-label-hover" aria-hidden="true">Journal</span>
                        </span>
                    </a>
                </li>
                <li role="none">
                    <a role="menuitem" href="{{ url('/contact') }}" class="pill {{ request()->is('contact*') ? 'active' : '' }}">
                        <span class="hover-circle" aria-hidden="true"></span>
                        <span class="label-stack">
                            <span class="pill-label">Contact</span>
                            <span class="pill-label-hover" aria-hidden="true">Contact</span>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

</div>

<!-- SCRIPT GSAP UNTUK EFEK PILL NAV -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const pills = document.querySelectorAll('.pill');
        const ease = 'power3.easeOut';

        pills.forEach((pill) => {
            const circle = pill.querySelector('.hover-circle');
            const label = pill.querySelector('.pill-label');
            const white = pill.querySelector('.pill-label-hover');

            if (!circle) return;

            const rect = pill.getBoundingClientRect();
            const w = rect.width || 90;
            const h = rect.height || 40;
            const R = ((w * w) / 4 + h * h) / (2 * h);
            const D = Math.ceil(2 * R) + 2;
            const delta = Math.ceil(R - Math.sqrt(Math.max(0, R * R - (w * w) / 4))) + 1;
            const originY = D - delta;

            circle.style.width = `${D}px`;
            circle.style.height = `${D}px`;
            circle.style.bottom = `-${delta}px`;

            gsap.set(circle, { xPercent: -50, scale: 0, transformOrigin: `50% ${originY}px` });
            if (label) gsap.set(label, { y: 0 });
            if (white) gsap.set(white, { y: h + 12, opacity: 0 });

            const tl = gsap.timeline({ paused: true });
            tl.to(circle, { scale: 1.2, xPercent: -50, duration: 2, ease, overwrite: 'auto' }, 0);
            if (label) tl.to(label, { y: -(h + 8), duration: 2, ease, overwrite: 'auto' }, 0);
            if (white) {
                gsap.set(white, { y: Math.ceil(h + 100), opacity: 0 });
                tl.to(white, { y: 0, opacity: 1, duration: 2, ease, overwrite: 'auto' }, 0);
            }

            let tween = null;
            
            pill.addEventListener('mouseenter', () => {
                tween?.kill();
                tween = tl.tweenTo(tl.duration(), { duration: 0.3, ease, overwrite: 'auto' });
            });
            pill.addEventListener('mouseleave', () => {
                tween?.kill();
                tween = tl.tweenTo(0, { duration: 0.2, ease, overwrite: 'auto' });
            });
            
            pill.addEventListener('touchstart', () => {
                tween?.kill();
                tween = tl.tweenTo(tl.duration(), { duration: 0.3, ease, overwrite: 'auto' });
            }, { passive: true });
        });
    });
</script>

</body>
</html>