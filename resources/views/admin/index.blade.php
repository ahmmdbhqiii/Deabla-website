@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Alpine.js x-data untuk toggle mode gelap/terang -->
<div class="min-h-screen py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-8 selection:bg-pink-500 selection:text-white transition-colors duration-300"
     x-data="{ activeTabNav: 'products', openAddModal: false, isLightMode: false }"
     :class="isLightMode ? 'bg-gray-100 text-gray-900' : 'bg-black text-white'">
    
    <!-- HEADER ADMIN -->
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 border-b pb-6 transition-colors duration-300"
         :class="isLightMode ? 'border-gray-300' : 'border-white/10'">
        <div class="space-y-1">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-pink-500/10 border border-pink-500/30 text-pink-500 text-[10px] font-black uppercase tracking-widest">
                <span class="w-1.5 h-1.5 rounded-full bg-pink-500 animate-pulse"></span>
                Secure Admin Command Center
            </div>
            <h1 class="text-2xl sm:text-4xl font-black uppercase tracking-tight" :class="isLightMode ? 'text-gray-900' : 'text-white'">DEABLA <span class="text-pink-500">Dashboard</span></h1>
            <p class="text-xs" :class="isLightMode ? 'text-gray-600' : 'text-gray-400'">Pantau inventaris produk, kelola pesanan, dan analitik cash flow secara real-time.</p>
        </div>
        
        <div class="flex items-center gap-3 w-full md:w-auto flex-wrap">
            <!-- TOMBOL TOGGLE DARK/LIGHT MODE -->
            <button @click="isLightMode = !isLightMode" 
                    class="px-4 py-2.5 rounded-xl border text-xs font-black uppercase tracking-wider transition flex items-center gap-2"
                    :class="isLightMode ? 'bg-gray-200 border-gray-400 text-gray-800 hover:bg-gray-300' : 'bg-white/5 border-white/15 text-white hover:bg-white/10'">
                <span x-show="!isLightMode">🌞 Light Mode</span>
                <span x-show="isLightMode" x-cloak>🌙 Dark Mode</span>
            </button>

            <a href="{{ url('/') }}" class="text-center px-4 py-2.5 rounded-xl border text-xs font-black uppercase tracking-wider transition"
               :class="isLightMode ? 'bg-gray-200 border-gray-400 text-gray-800 hover:bg-gray-300' : 'bg-white/5 border-white/15 text-white hover:bg-white/10'">
                Lihat Store &rarr;
            </a>
            
            <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="px-4 py-2.5 rounded-xl bg-red-500/10 hover:bg-red-600 border border-red-500/30 text-red-500 hover:text-white text-xs font-black uppercase tracking-wider transition">
                    Logout
                </button>
            </form>
        </div>
    </div>

    <!-- QUICK STATS METRICS -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="border rounded-2xl p-5 backdrop-blur-xl relative overflow-hidden transition-colors duration-300"
             :class="isLightMode ? 'bg-white border-gray-300 shadow-md' : 'bg-zinc-950 border-white/10'">
            <div class="absolute -right-4 -bottom-4 w-20 h-20 bg-pink-500/10 rounded-full blur-xl pointer-events-none"></div>
            <span class="text-[10px] font-black uppercase tracking-widest block" :class="isLightMode ? 'text-gray-500' : 'text-gray-400'">Total Produk</span>
            <p class="text-2xl sm:text-3xl font-black font-mono mt-1" :class="isLightMode ? 'text-gray-900' : 'text-white'">{{ count($products ?? []) }}</p>
        </div>
        <div class="border rounded-2xl p-5 backdrop-blur-xl relative overflow-hidden transition-colors duration-300"
             :class="isLightMode ? 'bg-white border-gray-300 shadow-md' : 'bg-zinc-950 border-white/10'">
            <div class="absolute -right-4 -bottom-4 w-20 h-20 bg-purple-500/10 rounded-full blur-xl pointer-events-none"></div>
            <span class="text-[10px] font-black uppercase tracking-widest block" :class="isLightMode ? 'text-gray-500' : 'text-gray-400'">Total Pesanan</span>
            <p class="text-2xl sm:text-3xl font-black text-pink-500 font-mono mt-1">{{ count($orders ?? []) }}</p>
        </div>
        <div class="border rounded-2xl p-5 backdrop-blur-xl relative overflow-hidden transition-colors duration-300"
             :class="isLightMode ? 'bg-white border-gray-300 shadow-md' : 'bg-zinc-950 border-white/10'">
            <div class="absolute -right-4 -bottom-4 w-20 h-20 bg-emerald-500/10 rounded-full blur-xl pointer-events-none"></div>
            <span class="text-[10px] font-black uppercase tracking-widest block" :class="isLightMode ? 'text-gray-500' : 'text-gray-400'">Total Pemasukan (Sukses)</span>
            <p class="text-lg sm:text-xl font-black text-emerald-600 font-mono mt-1">Rp {{ number_format($totalPemasukan ?? 0, 0, ',', '.') }}</p>
        </div>
        <div class="border rounded-2xl p-5 backdrop-blur-xl relative overflow-hidden transition-colors duration-300"
             :class="isLightMode ? 'bg-white border-gray-300 shadow-md' : 'bg-zinc-950 border-white/10'">
            <div class="absolute -right-4 -bottom-4 w-20 h-20 bg-blue-500/10 rounded-full blur-xl pointer-events-none"></div>
            <span class="text-[10px] font-black uppercase tracking-widest block" :class="isLightMode ? 'text-gray-500' : 'text-gray-400'">Sistem Store</span>
            <p class="text-xs font-black text-emerald-500 uppercase mt-2 flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span> Online
            </p>
        </div>
    </div>

    <!-- CASH FLOW & DIAGRAM BULAT -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 border rounded-3xl p-6 sm:p-8 backdrop-blur-xl shadow-2xl transition-colors duration-300"
         :class="isLightMode ? 'bg-white border-gray-300' : 'bg-zinc-950 border-white/10'">
        <div class="lg:col-span-2 space-y-4 flex flex-col justify-center">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-500 text-[10px] font-black uppercase tracking-widest w-max">
                Financial Analytics
            </div>
            <h2 class="text-xl sm:text-2xl font-black uppercase tracking-tight" :class="isLightMode ? 'text-gray-900' : 'text-white'">Ringkasan Cash Flow Toko</h2>
            <p class="text-xs leading-relaxed" :class="isLightMode ? 'text-gray-600' : 'text-gray-400'">
                Diagram di samping merepresentasikan perbandingan akumulasi dana pesanan yang sudah berhasil masuk (sukses) dibandingkan dengan nominal pesanan yang masih berstatus pending atau belum lunas.
            </p>
            <div class="grid grid-cols-2 gap-4 pt-2">
                <div class="p-4 rounded-2xl border transition-colors duration-300" :class="isLightMode ? 'bg-gray-50 border-gray-200' : 'bg-black/50 border-white/10'">
                    <span class="text-[10px] font-bold uppercase block" :class="isLightMode ? 'text-gray-500' : 'text-gray-400'">Pendapatan Bersih</span>
                    <span class="text-base sm:text-lg font-mono font-black text-emerald-600">Rp {{ number_format($totalPemasukan ?? 0, 0, ',', '.') }}</span>
                </div>
                <div class="p-4 rounded-2xl border transition-colors duration-300" :class="isLightMode ? 'bg-gray-50 border-gray-200' : 'bg-black/50 border-white/10'">
                    <span class="text-[10px] font-bold uppercase block" :class="isLightMode ? 'text-gray-500' : 'text-gray-400'">Potensi Pending</span>
                    <span class="text-base sm:text-lg font-mono font-black text-amber-500">
                        Rp {{ number_format($totalPending ?? 0, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-center p-4 border rounded-2xl relative transition-colors duration-300"
             :class="isLightMode ? 'bg-gray-50 border-gray-200' : 'bg-black/40 border-white/10'">
            <div class="w-full max-w-[220px] aspect-square">
                <canvas id="cashFlowChart"></canvas>
            </div>
        </div>
    </div>

    <!-- NOTIFIKASI BERHASIL -->
    @if(session('success'))
        <div class="p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-500 text-xs font-black uppercase tracking-wider flex items-center justify-between">
            <span>{{ session('success') }}</span>
            <span class="text-[10px]">✔ Berhasil</span>
        </div>
    @endif

    <!-- VALIDASI ERROR -->
    @if($errors->any())
        <div class="p-4 rounded-2xl bg-red-500/10 border border-red-500/30 text-red-500 text-xs font-bold space-y-1">
            @foreach ($errors->all() as $error)
                <p>&bull; {{ $error }}</p>
            @endforeach
        </div>
    @endif

    <!-- TAB NAVIGASI UTAMA -->
    <div class="flex items-center gap-2 border-b pb-4 transition-colors duration-300" :class="isLightMode ? 'border-gray-300' : 'border-white/10'">
        <button @click="activeTabNav = 'products'" 
                :class="activeTabNav === 'products' ? 'bg-pink-600 text-white shadow-lg shadow-pink-600/30 border-pink-500' : (isLightMode ? 'bg-gray-200 text-gray-700 border-gray-300 hover:bg-gray-300' : 'bg-zinc-900/80 text-gray-400 hover:text-white border-white/10')"
                class="px-5 py-3 rounded-xl font-black text-xs uppercase tracking-wider transition border">
            📦 Manajemen Katalog & Stok
        </button>
        <button @click="activeTabNav = 'orders'" 
                :class="activeTabNav === 'orders' ? 'bg-pink-600 text-white shadow-lg shadow-pink-600/30 border-pink-500' : (isLightMode ? 'bg-gray-200 text-gray-700 border-gray-300 hover:bg-gray-300' : 'bg-zinc-900/80 text-gray-400 hover:text-white border-white/10')"
                class="px-5 py-3 rounded-xl font-black text-xs uppercase tracking-wider transition border flex items-center gap-2">
            🛍️ Pesanan Masuk 
            <span class="px-2 py-0.5 rounded-full text-[10px] font-mono text-pink-500" :class="isLightMode ? 'bg-gray-300' : 'bg-black/40'">{{ count($orders ?? []) }}</span>
        </button>
    </div>

    <!-- KONTEN TAB 1: STOK & PRODUK -->
    <div x-show="activeTabNav === 'products'" class="space-y-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h3 class="text-sm font-black uppercase tracking-wider" :class="isLightMode ? 'text-gray-700' : 'text-gray-300'">Daftar Produk Aktif di Store</h3>
            <button @click="openAddModal = true" class="w-full sm:w-auto px-5 py-3 rounded-xl bg-gradient-to-r from-pink-600 to-pink-500 hover:from-pink-500 hover:to-pink-400 text-white text-xs font-black uppercase tracking-wider transition shadow-lg shadow-pink-600/30">
                + Tambah Produk Baru
            </button>
        </div>

        <!-- Tampilan Card untuk Mobile (HP) -->
        <div class="space-y-3 sm:hidden">
            @forelse($products as $product)
            <div class="border rounded-2xl p-4 space-y-3 shadow-xl transition-colors duration-300"
                 :class="isLightMode ? 'bg-white border-gray-300' : 'bg-zinc-950 border-white/10'">
                <div class="flex items-center gap-3.5">
                    <div class="w-16 h-16 rounded-xl border overflow-hidden flex items-center justify-center shrink-0 transition-colors duration-300"
                         :class="isLightMode ? 'bg-gray-100 border-gray-200' : 'bg-black border-white/10'">
                        <img src="{{ asset('images/' . ($product['image'] ?? 'Love Bombing.png')) }}" alt="Product" class="w-full h-full object-contain p-1">
                    </div>
                    <div class="flex-grow min-w-0">
                        <span class="text-[9px] font-bold text-pink-500 uppercase tracking-widest block truncate">{{ $product['category'] }}</span>
                        <h4 class="font-black text-sm uppercase truncate" :class="isLightMode ? 'text-gray-900' : 'text-white'">{{ $product['name'] }}</h4>
                        <p class="font-mono text-pink-500 font-bold text-xs mt-0.5">Rp {{ number_format($product['price'], 0, ',', '.') }}</p>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-3 border-t text-xs transition-colors duration-300" :class="isLightMode ? 'border-gray-200' : 'border-white/10'">
                    <div>
                        <span class="text-[10px] uppercase block font-bold" :class="isLightMode ? 'text-gray-500' : 'text-gray-400'">Stok:</span>
                        <span class="px-2.5 py-1 rounded-full font-mono font-black {{ $product['stock'] > 5 ? 'bg-pink-500/20 text-pink-500' : 'bg-red-500/20 text-red-500' }}">
                            {{ $product['stock'] }} Pcs
                        </span>
                    </div>

                    <div class="flex items-center gap-2">
                        <form action="{{ route('admin.updateStock', $product['id']) }}" method="POST">
                            @csrf
                            <input type="hidden" name="action" value="reduce">
                            <button type="submit" class="w-9 h-9 rounded-xl bg-red-500/10 border border-red-500/30 text-red-500 font-black flex items-center justify-center active:scale-95">-</button>
                        </form>
                        <form action="{{ route('admin.updateStock', $product['id']) }}" method="POST">
                            @csrf
                            <input type="hidden" name="action" value="add">
                            <button type="submit" class="w-9 h-9 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-500 font-black flex items-center justify-center active:scale-95">+</button>
                        </form>
                    </div>
                </div>

                <div class="pt-2 border-t text-right transition-colors duration-300" :class="isLightMode ? 'border-gray-200' : 'border-white/10'">
                    <form action="{{ route('admin.deleteProduct', $product['id']) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-[10px] text-red-500 hover:text-red-600 uppercase font-bold tracking-wider">Hapus Produk</button>
                    </form>
                </div>
            </div>
            @empty
            <div class="p-8 text-center border rounded-2xl transition-colors duration-300" :class="isLightMode ? 'bg-white border-gray-300 text-gray-500' : 'bg-zinc-950 border-white/10 text-gray-500'">Belum ada produk tersimpan.</div>
            @endforelse
        </div>

        <!-- Tabel untuk Tablet & Desktop -->
        <div class="hidden sm:block border rounded-3xl p-6 backdrop-blur-xl shadow-2xl overflow-hidden transition-colors duration-300"
             :class="isLightMode ? 'bg-white border-gray-300' : 'bg-zinc-950 border-white/10'">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b text-[10px] font-black uppercase tracking-widest transition-colors duration-300"
                            :class="isLightMode ? 'border-gray-200 text-gray-500' : 'border-white/10 text-gray-400'">
                            <th class="py-4 px-4">Foto</th>
                            <th class="py-4 px-4">Nama Produk</th>
                            <th class="py-4 px-4">Kategori</th>
                            <th class="py-4 px-4">Harga</th>
                            <th class="py-4 px-4 text-center">Stok</th>
                            <th class="py-4 px-4 text-center">Aksi Stok</th>
                            <th class="py-4 px-4 text-center">Hapus</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y text-xs transition-colors duration-300" :class="isLightMode ? 'divide-gray-200' : 'divide-white/5'">
                        @forelse($products as $product)
                        <tr class="transition-colors duration-200" :class="isLightMode ? 'hover:bg-gray-50' : 'hover:bg-white/[0.02]'">
                            <td class="py-4 px-4">
                                <div class="w-12 h-12 rounded-xl border overflow-hidden flex items-center justify-center transition-colors duration-300"
                                     :class="isLightMode ? 'bg-gray-100 border-gray-200' : 'bg-black border-white/10'">
                                    <img src="{{ asset('images/' . ($product['image'] ?? 'Love Bombing.png')) }}" alt="Product" class="w-full h-full object-contain p-1">
                                </div>
                            </td>
                            <td class="py-4 px-4 font-black uppercase tracking-wide" :class="isLightMode ? 'text-gray-900' : 'text-white'">{{ $product['name'] }}</td>
                            <td class="py-4 px-4" :class="isLightMode ? 'text-gray-600' : 'text-gray-400'">{{ $product['category'] }}</td>
                            <td class="py-4 px-4 font-mono text-pink-500 font-bold">Rp {{ number_format($product['price'], 0, ',', '.') }}</td>
                            <td class="py-4 px-4 text-center">
                                <span class="px-3 py-1 rounded-full text-xs font-mono font-black {{ $product['stock'] > 5 ? 'bg-pink-500/10 text-pink-500 border border-pink-500/20' : 'bg-red-500/10 text-red-500 border border-red-500/20' }}">
                                    {{ $product['stock'] }} Pcs
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center justify-center gap-2">
                                    <form action="{{ route('admin.updateStock', $product['id']) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="action" value="reduce">
                                        <button type="submit" class="w-8 h-8 rounded-xl bg-red-500/10 hover:bg-red-500/20 border border-red-500/30 text-red-500 font-black transition flex items-center justify-center active:scale-95" title="Kurangi Stok">-</button>
                                    </form>
                                    <form action="{{ route('admin.updateStock', $product['id']) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="action" value="add">
                                        <button type="submit" class="w-8 h-8 rounded-xl bg-emerald-500/10 hover:bg-emerald-500/20 border border-emerald-500/30 text-emerald-500 font-black transition flex items-center justify-center active:scale-95" title="Tambah Stok">+</button>
                                    </form>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-center">
                                <form action="{{ route('admin.deleteProduct', $product['id']) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 rounded-xl border text-[10px] font-black uppercase tracking-wider transition"
                                            :class="isLightMode ? 'bg-gray-100 border-gray-300 text-gray-600 hover:bg-red-100 hover:text-red-600' : 'bg-zinc-900 border-white/10 text-gray-400 hover:bg-red-600/20 hover:border-red-500/30 hover:text-red-400'">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-gray-500">Belum ada produk tersimpan di sistem.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- KONTEN TAB 2: PESANAN MASUK -->
    <div x-show="activeTabNav === 'orders'" class="space-y-6" x-cloak 
         x-data="{ searchNota: '' }">
        
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <h3 class="text-sm font-black uppercase tracking-wider" :class="isLightMode ? 'text-gray-700' : 'text-gray-300'">Daftar Pesanan & Pelacakan Nota Customer</h3>
            
            <div class="w-full sm:w-80">
                <input type="text" x-model="searchNota" placeholder="Cari No. Nota atau Nama Customer..." 
                       class="w-full border rounded-xl px-4 py-3 sm:py-2.5 text-xs uppercase tracking-wider focus:outline-none transition font-mono shadow-inner"
                       :class="isLightMode ? 'bg-gray-50 border-gray-300 text-gray-900 focus:border-pink-500' : 'bg-black border-white/15 text-white focus:border-pink-500'">
            </div>
        </div>

        <!-- Card Pesanan untuk Mobile (HP) -->
        <div class="space-y-3 sm:hidden">
            @forelse($orders as $order)
            <div class="border rounded-2xl p-4 space-y-3 shadow-xl transition-colors duration-300"
                 :class="isLightMode ? 'bg-white border-gray-300' : 'bg-zinc-950 border-white/10'"
                 x-show="searchNota === '' || '{{ strtolower($order['order_id']) }}'.includes(searchNota.toLowerCase()) || '{{ strtolower($order['name']) }}'.includes(searchNota.toLowerCase())">
                
                <div class="flex items-center justify-between border-b pb-2.5 transition-colors duration-300" :class="isLightMode ? 'border-gray-200' : 'border-white/10'">
                    <span class="font-mono font-bold text-pink-500 text-xs">{{ $order['order_id'] }}</span>
                    <span class="px-2.5 py-0.5 rounded-full text-[9px] font-black uppercase tracking-wider
                        {{ $order['status'] === 'Pending' ? 'bg-amber-500/10 text-amber-500 border border-amber-500/20' : '' }}
                        {{ $order['status'] === 'Diproses' ? 'bg-blue-500/10 text-blue-500 border border-blue-500/20' : '' }}
                        {{ $order['status'] === 'Dikirim' ? 'bg-purple-500/10 text-purple-500 border border-purple-500/20' : '' }}
                        {{ $order['status'] === 'Selesai' ? 'bg-emerald-500/10 text-emerald-500 border border-emerald-500/20' : '' }}">
                        {{ $order['status'] }}
                    </span>
                </div>

                <div class="text-xs space-y-1.5">
                    <p class="font-bold uppercase text-sm tracking-wide" :class="isLightMode ? 'text-gray-900' : 'text-white'">{{ $order['name'] }} <span class="text-xs font-normal" :class="isLightMode ? 'text-gray-500' : 'text-gray-400'">({{ $order['phone'] }})</span></p>
                    <p class="text-pink-500 font-bold">{{ $order['product'] }} <span class="px-1.5 py-0.5 rounded text-[10px]" :class="isLightMode ? 'bg-gray-200 text-gray-800' : 'text-white bg-white/10'">Size: {{ $order['size'] }}</span></p>
                    <p class="italic text-[11px] pt-1 leading-snug" :class="isLightMode ? 'text-gray-600' : 'text-gray-300'">📍 {{ $order['address'] }}</p>
                    <p class="text-[10px] font-mono pt-1" :class="isLightMode ? 'text-gray-500' : 'text-gray-400'">💳 Bayar: <span class="uppercase font-bold" :class="isLightMode ? 'text-gray-900' : 'text-white'">{{ $order['payment_method'] }}</span> | ⏱️ {{ $order['date'] }}</p>
                </div>

                <div class="pt-3 border-t flex items-center justify-between gap-2 transition-colors duration-300" :class="isLightMode ? 'border-gray-200' : 'border-white/10'">
                    <form action="{{ route('admin.updateOrderStatus', $order['order_id']) }}" method="POST" class="flex-grow">
                        @csrf
                        <select name="status" onchange="this.form.submit()" class="w-full border rounded-xl px-3 py-2 text-xs focus:outline-none font-bold cursor-pointer transition-colors duration-300"
                                :class="isLightMode ? 'bg-gray-50 border-gray-300 text-gray-900' : 'bg-black border-white/20 text-white'">
                            <option value="" disabled selected>Ubah Status...</option>
                            <option value="Pending">Pending</option>
                            <option value="Diproses">Diproses</option>
                            <option value="Dikirim">Dikirim</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </form>

                    <form action="{{ route('admin.deleteOrder', $order['order_id']) }}" method="POST" onsubmit="return confirm('Hapus pesanan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-2 rounded-xl bg-red-500/10 border border-red-500/30 text-red-500 hover:text-white font-bold text-xs transition">Hapus</button>
                    </form>
                </div>
            </div>
            @empty
            <div class="p-8 text-center border rounded-2xl transition-colors duration-300" :class="isLightMode ? 'bg-white border-gray-300 text-gray-500' : 'bg-zinc-950 border-white/10 text-gray-500'">Belum ada pesanan masuk.</div>
            @endforelse
        </div>

        <!-- Tabel untuk Tablet & Desktop -->
        <div class="hidden sm:block border rounded-3xl p-6 backdrop-blur-xl shadow-2xl overflow-hidden transition-colors duration-300"
             :class="isLightMode ? 'bg-white border-gray-300' : 'bg-zinc-950 border-white/10'">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b text-[10px] font-black uppercase tracking-widest transition-colors duration-300"
                            :class="isLightMode ? 'border-gray-200 text-gray-500' : 'border-white/10 text-gray-400'">
                            <th class="py-4 px-4">No. Nota & Waktu</th>
                            <th class="py-4 px-4">Customer</th>
                            <th class="py-4 px-4">Produk & Size</th>
                            <th class="py-4 px-4">Alamat & Pembayaran</th>
                            <th class="py-4 px-4 text-center">Status</th>
                            <th class="py-4 px-4 text-center">Aksi Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y text-xs transition-colors duration-300" :class="isLightMode ? 'divide-gray-200' : 'divide-white/5'">
                        @forelse($orders as $order)
                        <tr class="transition-colors duration-200" :class="isLightMode ? 'hover:bg-gray-50' : 'hover:bg-white/[0.02]'"
                            x-show="searchNota === '' || '{{ strtolower($order['order_id']) }}'.includes(searchNota.toLowerCase()) || '{{ strtolower($order['name']) }}'.includes(searchNota.toLowerCase())">
                            
                            <td class="py-4 px-4 font-mono">
                                <span class="font-bold text-pink-500 block">{{ $order['order_id'] }}</span>
                                <span class="text-[10px]" :class="isLightMode ? 'text-gray-500' : 'text-gray-500'">{{ $order['date'] }}</span>
                            </td>
                            <td class="py-4 px-4">
                                <strong class="uppercase tracking-wide block" :class="isLightMode ? 'text-gray-900' : 'text-white'">{{ $order['name'] }}</strong>
                                <span class="text-[11px] font-mono" :class="isLightMode ? 'text-gray-600' : 'text-gray-400'">{{ $order['phone'] }}</span>
                            </td>
                            <td class="py-4 px-4">
                                <span class="font-bold block" :class="isLightMode ? 'text-gray-900' : 'text-white'">{{ $order['product'] }}</span>
                                <span class="px-2 py-0.5 rounded bg-pink-500/10 border border-pink-500/20 text-pink-500 font-bold text-[10px]">Size: {{ $order['size'] }}</span>
                            </td>
                            <td class="py-4 px-4 space-y-1">
                                <p class="italic max-w-xs leading-snug" :class="isLightMode ? 'text-gray-600' : 'text-gray-300'">{{ $order['address'] }}</p>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase border transition-colors duration-300"
                                      :class="isLightMode ? 'bg-gray-100 border-gray-200 text-gray-600' : 'bg-white/5 border-white/10 text-gray-400'">Bayar: {{ $order['payment_method'] }}</span>
                            </td>
                            <td class="py-4 px-4 text-center">
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider
                                    {{ $order['status'] === 'Pending' ? 'bg-amber-500/10 text-amber-500 border border-amber-500/20' : '' }}
                                    {{ $order['status'] === 'Diproses' ? 'bg-blue-500/10 text-blue-500 border border-blue-500/20' : '' }}
                                    {{ $order['status'] === 'Dikirim' ? 'bg-purple-500/10 text-purple-500 border border-purple-500/20' : '' }}
                                    {{ $order['status'] === 'Selesai' ? 'bg-emerald-500/10 text-emerald-500 border border-emerald-500/20' : '' }}">
                                    {{ $order['status'] }}
                                </span>
                            </td>
                            <td class="py-4 px-4 text-center">
                                <div class="flex flex-col gap-1.5 items-center">
                                    <form action="{{ route('admin.updateOrderStatus', $order['order_id']) }}" method="POST">
                                        @csrf
                                        <select name="status" onchange="this.form.submit()" class="border rounded-xl px-2 py-1.5 text-[10px] focus:outline-none cursor-pointer font-bold transition-colors duration-300"
                                                :class="isLightMode ? 'bg-gray-50 border-gray-300 text-gray-900' : 'bg-black border-white/20 text-white'">
                                            <option value="" disabled selected>Ubah Status...</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Diproses">Diproses</option>
                                            <option value="Dikirim">Dikirim</option>
                                            <option value="Selesai">Selesai</option>
                                        </select>
                                    </form>

                                    <form action="{{ route('admin.deleteOrder', $order['order_id']) }}" method="POST" onsubmit="return confirm('Hapus riwayat pesanan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-[9px] text-red-500 hover:text-red-600 uppercase font-bold tracking-wider">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-gray-500">Belum ada pesanan masuk dari customer.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL TAMBAH PRODUK -->
    <div x-show="openAddModal" 
         x-transition.opacity 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/85 backdrop-blur-md" 
         x-cloak>
        <div class="border rounded-3xl p-6 sm:p-8 max-w-md w-full space-y-6 shadow-2xl relative transition-colors duration-300"
             :class="isLightMode ? 'bg-white border-gray-300 text-gray-900' : 'bg-zinc-950 border-white/20 text-white'">
            
            <div class="flex items-center justify-between border-b pb-4 transition-colors duration-300" :class="isLightMode ? 'border-gray-200' : 'border-white/10'">
                <h3 class="text-base font-black uppercase tracking-tight">Tambah Produk Baru</h3>
                <button @click="openAddModal = false" class="w-8 h-8 rounded-full flex items-center justify-center transition"
                        :class="isLightMode ? 'bg-gray-100 hover:bg-pink-600 text-gray-700 hover:text-white' : 'bg-zinc-900 hover:bg-pink-600 text-gray-300 hover:text-white'">&times;</button>
            </div>

            <form action="{{ route('admin.storeProduct') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-[10px] font-black uppercase mb-1.5 tracking-wider" :class="isLightMode ? 'text-gray-600' : 'text-gray-400'">Nama Produk</label>
                    <input type="text" name="name" required placeholder="Contoh: DEABLA T-Shirt Boxy" class="w-full border rounded-xl px-4 py-3 text-xs focus:outline-none transition"
                           :class="isLightMode ? 'bg-gray-50 border-gray-300 text-gray-900 focus:border-pink-500' : 'bg-black border-white/15 text-white focus:border-pink-500'">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[10px] font-black uppercase mb-1.5 tracking-wider" :class="isLightMode ? 'text-gray-600' : 'text-gray-400'">Harga (Rp)</label>
                        <input type="number" name="price" required placeholder="350000" class="w-full border rounded-xl px-4 py-3 text-xs focus:outline-none transition"
                               :class="isLightMode ? 'bg-gray-50 border-gray-300 text-gray-900 focus:border-pink-500' : 'bg-black border-white/15 text-white focus:border-pink-500'">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase mb-1.5 tracking-wider" :class="isLightMode ? 'text-gray-600' : 'text-gray-400'">Stok Awal</label>
                        <input type="number" name="stock" required placeholder="20" class="w-full border rounded-xl px-4 py-3 text-xs focus:outline-none transition"
                               :class="isLightMode ? 'bg-gray-50 border-gray-300 text-gray-900 focus:border-pink-500' : 'bg-black border-white/15 text-white focus:border-pink-500'">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase mb-1.5 tracking-wider" :class="isLightMode ? 'text-gray-600' : 'text-gray-400'">Kategori / Tipe</label>
                    <input type="text" name="category" required placeholder="Contoh: Heavyweight Hoodie" class="w-full border rounded-xl px-4 py-3 text-xs focus:outline-none transition"
                           :class="isLightMode ? 'bg-gray-50 border-gray-300 text-gray-900 focus:border-pink-500' : 'bg-black border-white/15 text-white focus:border-pink-500'">
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase mb-1.5 tracking-wider" :class="isLightMode ? 'text-gray-600' : 'text-gray-400'">Upload Foto Produk (PNG/JPG)</label>
                    <input type="file" name="image" accept="image/*" required class="w-full text-xs file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-pink-600 file:text-white hover:file:bg-pink-500 cursor-pointer"
                           :class="isLightMode ? 'text-gray-600' : 'text-gray-400'">
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-pink-600 to-pink-500 hover:from-pink-500 hover:to-pink-400 text-white font-black text-xs uppercase tracking-widest py-3.5 rounded-xl transition duration-300 shadow-lg shadow-pink-600/30 mt-2">
                    Simpan & Publikasikan Produk &rarr;
                </button>
            </form>
        </div>
    </div>

</div>

<!-- DATA PAYLOAD UNTUK CHART -->
<div id="chart-payload" data-labels="{{ json_encode($chartData['labels'] ?? ['Pemasukan', 'Pending']) }}" data-values="{{ json_encode($chartData['data'] ?? [0, 0]) }}"></div>

<!-- SCRIPT INISIALISASI CHART.JS -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const payload = document.getElementById('chart-payload');
        const labels = JSON.parse(payload.getAttribute('data-labels'));
        const dataValues = JSON.parse(payload.getAttribute('data-values'));

        const ctx = document.getElementById('cashFlowChart').getContext('2d');
        
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: dataValues,
                    backgroundColor: ['#10b981', '#f59e0b'],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { 
                            color: '#888888',
                            font: {
                                size: 10,
                                family: 'monospace'
                            }
                        }
                    }
                },
                cutout: '70%'
            }
        });
    });
</script>
@endsection