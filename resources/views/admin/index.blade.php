@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black text-white py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-8 selection:bg-pink-500 selection:text-white"
     x-data="{ activeTabNav: 'products', openAddModal: false }">
    
    <!-- HEADER ADMIN -->
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 border-b border-white/10 pb-6">
        <div class="space-y-1">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-pink-500/10 border border-pink-500/30 text-pink-400 text-[10px] font-black uppercase tracking-widest">
                <span class="w-1.5 h-1.5 rounded-full bg-pink-500 animate-pulse"></span>
                Secure Admin Command Center
            </div>
            <h1 class="text-2xl sm:text-4xl font-black uppercase tracking-tight text-white">DEABLA <span class="text-pink-500">Dashboard</span></h1>
            <p class="text-xs text-gray-400">Pantau inventaris produk dan kelola pesanan pelanggan secara real-time.</p>
        </div>
        
        <div class="flex items-center gap-3 w-full md:w-auto">
            <a href="{{ url('/') }}" class="flex-1 md:flex-none text-center px-4 py-2.5 rounded-xl bg-white/5 hover:bg-white/10 border border-white/15 text-xs font-black uppercase tracking-wider transition">
                Lihat Store &rarr;
            </a>
            <form action="{{ route('admin.logout') }}" method="POST" class="flex-1 md:flex-none">
                @csrf
                <button type="submit" class="w-full md:w-auto px-4 py-2.5 rounded-xl bg-red-500/10 hover:bg-red-600 border border-red-500/30 text-red-400 hover:text-white text-xs font-black uppercase tracking-wider transition">
                    Logout
                </button>
            </form>
        </div>
    </div>

    <!-- QUICK STATS METRICS -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-zinc-950 border border-white/10 rounded-2xl p-5 backdrop-blur-xl relative overflow-hidden">
            <div class="absolute -right-4 -bottom-4 w-20 h-20 bg-pink-500/10 rounded-full blur-xl pointer-events-none"></div>
            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest block">Total Produk</span>
            <p class="text-2xl sm:text-3xl font-black text-white font-mono mt-1">{{ count($products ?? []) }}</p>
        </div>
        <div class="bg-zinc-950 border border-white/10 rounded-2xl p-5 backdrop-blur-xl relative overflow-hidden">
            <div class="absolute -right-4 -bottom-4 w-20 h-20 bg-purple-500/10 rounded-full blur-xl pointer-events-none"></div>
            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest block">Total Pesanan</span>
            <p class="text-2xl sm:text-3xl font-black text-pink-400 font-mono mt-1">{{ count($orders ?? []) }}</p>
        </div>
        <div class="bg-zinc-950 border border-white/10 rounded-2xl p-5 backdrop-blur-xl relative overflow-hidden">
            <div class="absolute -right-4 -bottom-4 w-20 h-20 bg-emerald-500/10 rounded-full blur-xl pointer-events-none"></div>
            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest block">Sistem Store</span>
            <p class="text-xs font-black text-emerald-400 uppercase mt-2 flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span> Online
            </p>
        </div>
        <div class="bg-zinc-950 border border-white/10 rounded-2xl p-5 backdrop-blur-xl relative overflow-hidden">
            <div class="absolute -right-4 -bottom-4 w-20 h-20 bg-blue-500/10 rounded-full blur-xl pointer-events-none"></div>
            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest block">Akses Perangkat</span>
            <p class="text-xs font-black text-blue-400 uppercase mt-2">Mobile / iPad / PC</p>
        </div>
    </div>

    <!-- NOTIFIKASI BERHASIL -->
    @if(session('success'))
        <div class="p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-black uppercase tracking-wider flex items-center justify-between">
            <span>{{ session('success') }}</span>
            <span class="text-[10px]">✔ Berhasil</span>
        </div>
    @endif

    <!-- VALIDASI ERROR -->
    @if($errors->any())
        <div class="p-4 rounded-2xl bg-red-500/10 border border-red-500/30 text-red-400 text-xs font-bold space-y-1">
            @foreach ($errors->all() as $error)
                <p>&bull; {{ $error }}</p>
            @endforeach
        </div>
    @endif

    <!-- TAB NAVIGASI UTAMA -->
    <div class="flex items-center gap-2 border-b border-white/10 pb-4">
        <button @click="activeTabNav = 'products'" 
                :class="activeTabNav === 'products' ? 'bg-pink-600 text-white shadow-lg shadow-pink-600/30 border-pink-500' : 'bg-zinc-900/80 text-gray-400 hover:text-white border-white/10'"
                class="px-5 py-3 rounded-xl font-black text-xs uppercase tracking-wider transition border">
            📦 Manajemen Katalog & Stok
        </button>
        <button @click="activeTabNav = 'orders'" 
                :class="activeTabNav === 'orders' ? 'bg-pink-600 text-white shadow-lg shadow-pink-600/30 border-pink-500' : 'bg-zinc-900/80 text-gray-400 hover:text-white border-white/10'"
                class="px-5 py-3 rounded-xl font-black text-xs uppercase tracking-wider transition border flex items-center gap-2">
            🛍️ Pesanan Masuk 
            <span class="px-2 py-0.5 rounded-full bg-black/40 text-[10px] font-mono text-pink-400">{{ count($orders ?? []) }}</span>
        </button>
    </div>

    <!-- KONTEN TAB 1: STOK & PRODUK -->
    <div x-show="activeTabNav === 'products'" class="space-y-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h3 class="text-sm font-black uppercase tracking-wider text-gray-300">Daftar Produk Aktif di Store</h3>
            <button @click="openAddModal = true" class="w-full sm:w-auto px-5 py-3 rounded-xl bg-gradient-to-r from-pink-600 to-pink-500 hover:from-pink-500 hover:to-pink-400 text-white text-xs font-black uppercase tracking-wider transition shadow-lg shadow-pink-600/30">
                + Tambah Produk Baru
            </button>
        </div>

        <!-- Tampilan Card untuk Mobile (HP) -->
        <div class="space-y-3 sm:hidden">
            @forelse($products as $product)
            <div class="bg-zinc-950 border border-white/10 rounded-2xl p-4 space-y-3 shadow-xl">
                <div class="flex items-center gap-3.5">
                    <div class="w-16 h-16 rounded-xl bg-black border border-white/10 overflow-hidden flex items-center justify-center shrink-0">
                        <img src="{{ asset('images/' . ($product['image'] ?? 'Love Bombing.png')) }}" alt="Product" class="w-full h-full object-contain p-1">
                    </div>
                    <div class="flex-grow min-w-0">
                        <span class="text-[9px] font-bold text-pink-400 uppercase tracking-widest block truncate">{{ $product['category'] }}</span>
                        <h4 class="font-black text-white text-sm uppercase truncate">{{ $product['name'] }}</h4>
                        <p class="font-mono text-pink-400 font-bold text-xs mt-0.5">Rp {{ number_format($product['price'], 0, ',', '.') }}</p>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-3 border-t border-white/10 text-xs">
                    <div>
                        <span class="text-[10px] text-gray-400 uppercase block font-bold">Stok:</span>
                        <span class="px-2.5 py-1 rounded-full font-mono font-black {{ $product['stock'] > 5 ? 'bg-pink-500/20 text-pink-400' : 'bg-red-500/20 text-red-400' }}">
                            {{ $product['stock'] }} Pcs
                        </span>
                    </div>

                    <div class="flex items-center gap-2">
                        <form action="{{ route('admin.updateStock', $product['id']) }}" method="POST">
                            @csrf
                            <input type="hidden" name="action" value="reduce">
                            <button type="submit" class="w-9 h-9 rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 font-black flex items-center justify-center active:scale-95">-</button>
                        </form>
                        <form action="{{ route('admin.updateStock', $product['id']) }}" method="POST">
                            @csrf
                            <input type="hidden" name="action" value="add">
                            <button type="submit" class="w-9 h-9 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 font-black flex items-center justify-center active:scale-95">+</button>
                        </form>
                    </div>
                </div>

                <div class="pt-2 border-t border-white/10 text-right">
                    <form action="{{ route('admin.deleteProduct', $product['id']) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-[10px] text-red-400 hover:text-red-300 uppercase font-bold tracking-wider">Hapus Produk</button>
                    </form>
                </div>
            </div>
            @empty
            <div class="p-8 text-center text-gray-500 bg-zinc-950 rounded-2xl border border-white/10">Belum ada produk tersimpan.</div>
            @endforelse
        </div>

        <!-- Tabel untuk Tablet & Desktop -->
        <div class="hidden sm:block bg-zinc-950 border border-white/10 rounded-3xl p-6 backdrop-blur-xl shadow-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-white/10 text-[10px] font-black uppercase tracking-widest text-gray-400">
                            <th class="py-4 px-4">Foto</th>
                            <th class="py-4 px-4">Nama Produk</th>
                            <th class="py-4 px-4">Kategori</th>
                            <th class="py-4 px-4">Harga</th>
                            <th class="py-4 px-4 text-center">Stok</th>
                            <th class="py-4 px-4 text-center">Aksi Stok</th>
                            <th class="py-4 px-4 text-center">Hapus</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 text-xs">
                        @forelse($products as $product)
                        <tr class="hover:bg-white/[0.02] transition">
                            <td class="py-4 px-4">
                                <div class="w-12 h-12 rounded-xl bg-black border border-white/10 overflow-hidden flex items-center justify-center">
                                    <img src="{{ asset('images/' . ($product['image'] ?? 'Love Bombing.png')) }}" alt="Product" class="w-full h-full object-contain p-1">
                                </div>
                            </td>
                            <td class="py-4 px-4 font-black text-white uppercase tracking-wide">{{ $product['name'] }}</td>
                            <td class="py-4 px-4 text-gray-400">{{ $product['category'] }}</td>
                            <td class="py-4 px-4 font-mono text-pink-400 font-bold">Rp {{ number_format($product['price'], 0, ',', '.') }}</td>
                            <td class="py-4 px-4 text-center">
                                <span class="px-3 py-1 rounded-full text-xs font-mono font-black {{ $product['stock'] > 5 ? 'bg-pink-500/10 text-pink-400 border border-pink-500/20' : 'bg-red-500/10 text-red-400 border border-red-500/20' }}">
                                    {{ $product['stock'] }} Pcs
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center justify-center gap-2">
                                    <form action="{{ route('admin.updateStock', $product['id']) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="action" value="reduce">
                                        <button type="submit" class="w-8 h-8 rounded-xl bg-red-500/10 hover:bg-red-500/20 border border-red-500/30 text-red-400 font-black transition flex items-center justify-center active:scale-95" title="Kurangi Stok">-</button>
                                    </form>
                                    <form action="{{ route('admin.updateStock', $product['id']) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="action" value="add">
                                        <button type="submit" class="w-8 h-8 rounded-xl bg-emerald-500/10 hover:bg-emerald-500/20 border border-emerald-500/30 text-emerald-400 font-black transition flex items-center justify-center active:scale-95" title="Tambah Stok">+</button>
                                    </form>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-center">
                                <form action="{{ route('admin.deleteProduct', $product['id']) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 rounded-xl bg-zinc-900 hover:bg-red-600/20 border border-white/10 hover:border-red-500/30 text-gray-400 hover:text-red-400 text-[10px] font-black uppercase tracking-wider transition">Hapus</button>
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
            <h3 class="text-sm font-black uppercase tracking-wider text-gray-300">Daftar Pesanan & Pelacakan Nota</h3>
            
            <div class="w-full sm:w-80">
                <input type="text" x-model="searchNota" placeholder="Cari No. Nota atau Nama Customer..." 
                       class="w-full bg-black border border-white/15 focus:border-pink-500 rounded-xl px-4 py-3 sm:py-2.5 text-xs text-white uppercase tracking-wider focus:outline-none transition font-mono shadow-inner">
            </div>
        </div>

        <!-- Card Pesanan untuk Mobile (HP) -->
        <div class="space-y-3 sm:hidden">
            @forelse($orders as $order)
            <div class="bg-zinc-950 border border-white/10 rounded-2xl p-4 space-y-3 shadow-xl"
                 x-show="searchNota === '' || '{{ strtolower($order['order_id']) }}'.includes(searchNota.toLowerCase()) || '{{ strtolower($order['name']) }}'.includes(searchNota.toLowerCase())">
                
                <div class="flex items-center justify-between border-b border-white/10 pb-2.5">
                    <span class="font-mono font-bold text-pink-400 text-xs">{{ $order['order_id'] }}</span>
                    <span class="px-2.5 py-0.5 rounded-full text-[9px] font-black uppercase tracking-wider
                        {{ $order['status'] === 'Pending' ? 'bg-amber-500/10 text-amber-400 border border-amber-500/20' : '' }}
                        {{ $order['status'] === 'Diproses' ? 'bg-blue-500/10 text-blue-400 border border-blue-500/20' : '' }}
                        {{ $order['status'] === 'Dikirim' ? 'bg-purple-500/10 text-purple-400 border border-purple-500/20' : '' }}
                        {{ $order['status'] === 'Selesai' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : '' }}">
                        {{ $order['status'] }}
                    </span>
                </div>

                <div class="text-xs space-y-1.5">
                    <p class="font-bold text-white uppercase text-sm tracking-wide">{{ $order['name'] }} <span class="text-gray-400 text-xs font-normal">({{ $order['phone'] }})</span></p>
                    <p class="text-pink-400 font-bold">{{ $order['product'] }} <span class="text-white bg-white/10 px-1.5 py-0.5 rounded text-[10px]">Size: {{ $order['size'] }}</span></p>
                    <p class="text-gray-300 italic text-[11px] pt-1 leading-snug">📍 {{ $order['address'] }}</p>
                    <p class="text-[10px] text-gray-400 font-mono pt-1">💳 Bayar: <span class="uppercase font-bold text-white">{{ $order['payment_method'] }}</span> | ⏱️ {{ $order['date'] }}</p>
                </div>

                <div class="pt-3 border-t border-white/10 flex items-center justify-between gap-2">
                    <form action="{{ route('admin.updateOrderStatus', $order['order_id']) }}" method="POST" class="flex-grow">
                        @csrf
                        <select name="status" onchange="this.form.submit()" class="w-full bg-black border border-white/20 rounded-xl px-3 py-2 text-xs text-white focus:outline-none font-bold cursor-pointer">
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
                        <button type="submit" class="px-3 py-2 rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 hover:text-white font-bold text-xs transition">Hapus</button>
                    </form>
                </div>
            </div>
            @empty
            <div class="p-8 text-center text-gray-500 bg-zinc-950 rounded-2xl border border-white/10">Belum ada pesanan masuk.</div>
            @endforelse
        </div>

        <!-- Tabel untuk Tablet & Desktop -->
        <div class="hidden sm:block bg-zinc-950 border border-white/10 rounded-3xl p-6 backdrop-blur-xl shadow-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-white/10 text-[10px] font-black uppercase tracking-widest text-gray-400">
                            <th class="py-4 px-4">No. Nota & Waktu</th>
                            <th class="py-4 px-4">Customer</th>
                            <th class="py-4 px-4">Produk & Size</th>
                            <th class="py-4 px-4">Alamat & Pembayaran</th>
                            <th class="py-4 px-4 text-center">Status</th>
                            <th class="py-4 px-4 text-center">Aksi Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 text-xs">
                        @forelse($orders as $order)
                        <tr class="hover:bg-white/[0.02] transition" 
                            x-show="searchNota === '' || '{{ strtolower($order['order_id']) }}'.includes(searchNota.toLowerCase()) || '{{ strtolower($order['name']) }}'.includes(searchNota.toLowerCase())">
                            
                            <td class="py-4 px-4 font-mono">
                                <span class="font-bold text-pink-400 block">{{ $order['order_id'] }}</span>
                                <span class="text-[10px] text-gray-500">{{ $order['date'] }}</span>
                            </td>
                            <td class="py-4 px-4">
                                <strong class="text-white uppercase tracking-wide block">{{ $order['name'] }}</strong>
                                <span class="text-gray-400 text-[11px] font-mono">{{ $order['phone'] }}</span>
                            </td>
                            <td class="py-4 px-4">
                                <span class="font-bold text-white block">{{ $order['product'] }}</span>
                                <span class="px-2 py-0.5 rounded bg-pink-500/10 border border-pink-500/20 text-pink-400 font-bold text-[10px]">Size: {{ $order['size'] }}</span>
                            </td>
                            <td class="py-4 px-4 space-y-1">
                                <p class="text-gray-300 italic max-w-xs leading-snug">{{ $order['address'] }}</p>
                                <span class="px-2 py-0.5 rounded bg-white/5 text-gray-400 text-[10px] font-bold uppercase border border-white/10">Bayar: {{ $order['payment_method'] }}</span>
                            </td>
                            <td class="py-4 px-4 text-center">
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider
                                    {{ $order['status'] === 'Pending' ? 'bg-amber-500/10 text-amber-400 border border-amber-500/20' : '' }}
                                    {{ $order['status'] === 'Diproses' ? 'bg-blue-500/10 text-blue-400 border border-blue-500/20' : '' }}
                                    {{ $order['status'] === 'Dikirim' ? 'bg-purple-500/10 text-purple-400 border border-purple-500/20' : '' }}
                                    {{ $order['status'] === 'Selesai' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : '' }}">
                                    {{ $order['status'] }}
                                </span>
                            </td>
                            <td class="py-4 px-4 text-center">
                                <div class="flex flex-col gap-1.5 items-center">
                                    <form action="{{ route('admin.updateOrderStatus', $order['order_id']) }}" method="POST">
                                        @csrf
                                        <select name="status" onchange="this.form.submit()" class="bg-black border border-white/20 rounded-xl px-2 py-1.5 text-[10px] text-white focus:outline-none cursor-pointer font-bold">
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
                                        <button type="submit" class="text-[9px] text-red-400 hover:text-red-300 uppercase font-bold tracking-wider">Hapus</button>
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
        <div class="bg-zinc-950 border border-white/20 rounded-3xl p-6 sm:p-8 max-w-md w-full space-y-6 shadow-2xl relative">
            
            <div class="flex items-center justify-between border-b border-white/10 pb-4">
                <h3 class="text-base font-black uppercase tracking-tight text-white">Tambah Produk Baru</h3>
                <button @click="openAddModal = false" class="w-8 h-8 rounded-full bg-zinc-900 hover:bg-pink-600 text-gray-300 hover:text-white flex items-center justify-center transition">&times;</button>
            </div>

            <form action="{{ route('admin.storeProduct') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-[10px] font-black uppercase text-gray-400 mb-1.5 tracking-wider">Nama Produk</label>
                    <input type="text" name="name" required placeholder="Contoh: DEABLA T-Shirt Boxy" class="w-full border border-white/15 focus:border-pink-500 bg-black rounded-xl px-4 py-3 text-xs text-white focus:outline-none transition">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1.5 tracking-wider">Harga (Rp)</label>
                        <input type="number" name="price" required placeholder="350000" class="w-full border border-white/15 focus:border-pink-500 bg-black rounded-xl px-4 py-3 text-xs text-white focus:outline-none transition">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1.5 tracking-wider">Stok Awal</label>
                        <input type="number" name="stock" required placeholder="20" class="w-full border border-white/15 focus:border-pink-500 bg-black rounded-xl px-4 py-3 text-xs text-white focus:outline-none transition">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase text-gray-400 mb-1.5 tracking-wider">Kategori / Tipe</label>
                    <input type="text" name="category" required placeholder="Contoh: Heavyweight Hoodie" class="w-full border border-white/15 focus:border-pink-500 bg-black rounded-xl px-4 py-3 text-xs text-white focus:outline-none transition">
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase text-gray-400 mb-1.5 tracking-wider">Upload Foto Produk (PNG/JPG)</label>
                    <input type="file" name="image" accept="image/*" required class="w-full text-xs text-gray-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-pink-600 file:text-white hover:file:bg-pink-500 cursor-pointer">
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-pink-600 to-pink-500 hover:from-pink-500 hover:to-pink-400 text-white font-black text-xs uppercase tracking-widest py-3.5 rounded-xl transition duration-300 shadow-lg shadow-pink-600/30 mt-2">
                    Simpan & Publikasikan Produk &rarr;
                </button>
            </form>
        </div>
    </div>

</div>
@endsection