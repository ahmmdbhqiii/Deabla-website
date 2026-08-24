@extends('layouts.app')

@section('content')
<div class="max-w-md sm:max-w-xl mx-auto px-4 py-4 sm:py-8" 
     x-data="{ 
        openModal: false, 
        paymentMethod: 'qris',
        name: '', 
        phone: '', 
        product: 'DEABLA Zip Hoodie - Love Bombing (Rp 350.000)', 
        size: 'S', 
        address: '',
        errors: {},
        validateAndSubmit() {
            this.errors = {};
            if (!this.name.trim()) this.errors.name = 'Nama lengkap wajib diisi';
            if (!this.phone.trim()) this.errors.phone = 'Nomor WhatsApp wajib diisi';
            if (!this.address.trim()) this.errors.address = 'Alamat pengiriman wajib diisi';

            if (Object.keys(this.errors).length === 0) {
                this.openModal = true;
            }
        }
     }">
    
    <!-- HEADER -->
    <div class="text-center mb-4 sm:mb-6">
        <span class="text-pink-500 font-bold text-[9px] sm:text-[10px] uppercase tracking-[0.2em] block mb-0.5">Checkout / Order</span>
        <h1 class="text-2xl sm:text-4xl font-black text-white uppercase tracking-tight">Pemesanan Produk</h1>
    </div>

    <!-- MAIN CARD -->
    <div class="bg-zinc-900/80 border border-white/10 rounded-2xl sm:rounded-3xl p-4 sm:p-7 backdrop-blur-md shadow-2xl space-y-4 sm:space-y-5">
        
        <!-- FAST CONTACT STRIP -->
        <div class="grid grid-cols-2 gap-2 p-1 bg-black/40 rounded-xl border border-white/5 text-center">
            <a href="https://wa.me/6283815508515" target="_blank" class="py-2 px-3 rounded-lg bg-white/5 hover:bg-pink-500/10 border border-white/5 transition flex items-center justify-center gap-1.5 text-[11px] font-bold text-white">
                <span class="text-pink-400">WhatsApp</span> &rarr;
            </a>
            <a href="https://www.instagram.com/deablacenterr.id" target="_blank" class="py-2 px-3 rounded-lg bg-white/5 hover:bg-pink-500/10 border border-white/5 transition flex items-center justify-center gap-1.5 text-[11px] font-bold text-white">
                <span class="text-pink-400">Instagram</span> &rarr;
            </a>
        </div>

        <!-- FORMULIR -->
        <form @submit.prevent="validateAndSubmit()" novalidate class="space-y-3 sm:space-y-4">
            <div>
                <label class="block text-[10px] font-bold uppercase text-gray-400 mb-1 tracking-wider">Nama Lengkap</label>
                <input type="text" x-model="name" placeholder="Masukkan nama kamu" 
                       :class="errors.name ? 'border-red-500 focus:border-red-500' : 'border-white/10 focus:border-pink-500'"
                       class="w-full bg-black/60 border rounded-xl px-3.5 py-2.5 text-xs text-white focus:outline-none transition placeholder-gray-600">
                <template x-if="errors.name">
                    <span class="text-[10px] font-bold text-red-400 mt-1 block" x-text="errors.name"></span>
                </template>
            </div>

            <div>
                <label class="block text-[10px] font-bold uppercase text-gray-400 mb-1 tracking-wider">Nomor WhatsApp</label>
                <input type="tel" x-model="phone" placeholder="0812xxxxxxx" 
                       :class="errors.phone ? 'border-red-500 focus:border-red-500' : 'border-white/10 focus:border-pink-500'"
                       class="w-full bg-black/60 border rounded-xl px-3.5 py-2.5 text-xs text-white focus:outline-none transition placeholder-gray-600">
                <template x-if="errors.phone">
                    <span class="text-[10px] font-bold text-red-400 mt-1 block" x-text="errors.phone"></span>
                </template>
            </div>

            <div>
                <label class="block text-[10px] font-bold uppercase text-gray-400 mb-1 tracking-wider">Pilih Produk</label>
                <select x-model="product" class="w-full bg-black/60 border border-white/10 rounded-xl px-3.5 py-2.5 text-xs text-white focus:outline-none focus:border-pink-500 transition">
                    <option class="bg-zinc-900" value="DEABLA Zip Hoodie - Love Bombing (Rp 350.000)">DEABLA Zip Hoodie - Love Bombing (Rp 350.000)</option>
                </select>
            </div>

            <div>
                <label class="block text-[10px] font-bold uppercase text-gray-400 mb-1 tracking-wider">Ukuran (Size)</label>
                <div class="grid grid-cols-4 gap-2">
                    <template x-for="s in ['S', 'M', 'L', 'XL']">
                        <label class="cursor-pointer">
                            <input type="radio" name="size" :value="s" x-model="size" class="hidden peer">
                            <span class="block text-center py-2 bg-black/60 border border-white/10 rounded-xl text-xs font-black text-gray-400 peer-checked:border-pink-500 peer-checked:bg-pink-500/20 peer-checked:text-pink-400 transition" x-text="s"></span>
                        </label>
                    </template>
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-bold uppercase text-gray-400 mb-1 tracking-wider">Alamat Pengiriman</label>
                <textarea x-model="address" rows="2.5" placeholder="Alamat lengkap beserta kota & kode pos" 
                          :class="errors.address ? 'border-red-500 focus:border-red-500' : 'border-white/10 focus:border-pink-500'"
                          class="w-full bg-black/60 border rounded-xl px-3.5 py-2.5 text-xs text-white focus:outline-none transition placeholder-gray-600"></textarea>
                <template x-if="errors.address">
                    <span class="text-[10px] font-bold text-red-400 mt-1 block" x-text="errors.address"></span>
                </template>
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-pink-600 to-pink-500 hover:from-pink-500 hover:to-pink-400 text-white font-black text-xs uppercase tracking-widest py-3.5 rounded-xl transition duration-300 shadow-lg shadow-pink-600/25 active:scale-[0.99] mt-2">
                Lanjut Ke Pembayaran
            </button>
        </form>
    </div>

    <!-- MODAL PEMBAYARAN (QRIS & BCA) -->
    <div x-show="openModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/85 backdrop-blur-md" 
         x-cloak>
        
        <div class="bg-zinc-950 border border-white/10 p-5 sm:p-6 rounded-3xl max-w-xs sm:max-w-sm w-full text-center relative shadow-2xl space-y-4">
            
            <button @click="openModal = false" class="absolute top-4 right-4 text-gray-400 hover:text-white text-lg">&times;</button>
            
            <div>
                <span class="text-pink-500 font-bold text-[9px] uppercase tracking-widest block">Metode Pembayaran</span>
                <h3 class="text-lg font-black text-white uppercase mt-0.5">Pilih Cara Bayar</h3>
            </div>
            
            <!-- TOGGLE METODE PEMBAYARAN -->
            <div class="grid grid-cols-2 gap-1.5 p-1 bg-black/60 border border-white/10 rounded-xl text-xs font-bold">
                <button @click="paymentMethod = 'qris'" 
                        :class="paymentMethod === 'qris' ? 'bg-pink-600 text-white shadow-md' : 'text-gray-400 hover:text-white'"
                        class="py-2 rounded-lg transition duration-200 uppercase">
                    QRIS
                </button>
                <button @click="paymentMethod = 'bca'" 
                        :class="paymentMethod === 'bca' ? 'bg-pink-600 text-white shadow-md' : 'text-gray-400 hover:text-white'"
                        class="py-2 rounded-lg transition duration-200 uppercase">
                    Bank BCA
                </button>
            </div>

            <!-- KONTEN METHOD 1: QRIS -->
            <div x-show="paymentMethod === 'qris'" class="space-y-3">
                <div class="bg-white p-3 rounded-2xl inline-block shadow-lg">
                    <img src="/images/qris-deabla.png" alt="QRIS Code" class="w-40 h-40 mx-auto object-contain">
                </div>
                <p class="text-[10px] text-gray-400">Scan QRIS menggunakan Mobile Banking atau E-Wallet (Gopay/OVO/Dana/ShopeePay).</p>
            </div>

            <!-- KONTEN METHOD 2: BANK BCA -->
            <div x-show="paymentMethod === 'bca'" class="bg-zinc-900 border border-white/10 p-4 rounded-2xl text-left space-y-2">
                <div class="flex items-center justify-between border-b border-white/10 pb-2">
                    <span class="text-[10px] font-black uppercase text-pink-400">Bank Central Asia</span>
                    <span class="text-xs font-bold text-white uppercase tracking-wider">BCA</span>
                </div>
                <div>
                    <span class="text-[9px] uppercase text-gray-400 font-bold block">Nomor Rekening:</span>
                    <p class="text-lg font-black text-white tracking-widest select-all">1234 5678 90</p>
                </div>
                <div>
                    <span class="text-[9px] uppercase text-gray-400 font-bold block">Atas Nama:</span>
                    <p class="text-xs font-extrabold text-gray-200 uppercase">DEABLA OFFICIAL</p>
                </div>
            </div>

            <!-- RINCIAN HARGA -->
            <div class="text-left bg-black/50 p-3 rounded-xl border border-white/5 text-[11px] text-gray-300 space-y-1">
                <p><strong class="text-white">Total:</strong> Rp 350.000</p>
                <p class="truncate"><strong class="text-white">Item:</strong> <span x-text="product"></span> (<span x-text="size"></span>)</p>
            </div>

            <!-- TOMBOL WA DENGAN DINAMIS TEKS PEMBAYARAN -->
            <a :href="`https://wa.me/6283815508515?text=Halo%20Admin,%20saya%20sudah%20melakukan%20pembayaran%20via%20${paymentMethod === 'qris' ? 'QRIS' : 'Transfer%20BCA'}.%0A%0A*Detail%20Pesanan:*%0ANama:%20${encodeURIComponent(name)}%0AWA:%20${encodeURIComponent(phone)}%0AProduk:%20${encodeURIComponent(product)}%0AUkuran:%20${encodeURIComponent(size)}%0AAlamat:%20${encodeURIComponent(address)}`"
               target="_blank" 
               class="block w-full bg-emerald-600 hover:bg-emerald-500 text-white font-extrabold text-xs uppercase tracking-wider py-3 rounded-xl transition duration-300 shadow-lg shadow-emerald-600/20 active:scale-95">
                Konfirmasi Pembayaran (WA)
            </a>
        </div>
    </div>
</div>
@endsection