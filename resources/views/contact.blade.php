@extends('layouts.app')

@section('content')
<div class="max-w-md sm:max-w-xl mx-auto px-4 py-4 sm:py-8" 
     x-data="{ 
        openModal: false, 
        paymentMethod: 'qris',
        isSubmitting: false,
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
        },
        saveAndSubmitWA() {
            if (this.isSubmitting) return;
            this.isSubmitting = true;

            // Kirim data ke database Laragon secara async
            fetch('/simpan-order', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    name: this.name,
                    phone: this.phone,
                    product: this.product,
                    size: this.size,
                    address: this.address,
                    payment_method: this.paymentMethod
                })
            }).finally(() => {
                setTimeout(() => { this.isSubmitting = false; }, 1500);
            });
        }
     }">
    
    <!-- HEADER -->
    <div class="text-center mb-4 sm:mb-6">
        <span class="text-pink-500 font-bold text-[9px] sm:text-[10px] uppercase tracking-[0.2em] block mb-0.5">Secure Checkout</span>
        <h1 class="text-2xl sm:text-4xl font-black text-white uppercase tracking-tight">Pemesanan Produk</h1>
    </div>

    <!-- MAIN CARD -->
    <div class="bg-zinc-900/80 border border-white/10 rounded-2xl sm:rounded-3xl p-4 sm:p-7 backdrop-blur-md shadow-2xl space-y-4 sm:space-y-5">
        
        <!-- SINGLE ELEGANT INSTAGRAM BANNER -->
        <a href="https://www.instagram.com/deablacenterr.id" 
           target="_blank" 
           class="group flex items-center justify-between p-3 rounded-xl bg-gradient-to-r from-pink-500/10 via-purple-500/10 to-transparent border border-pink-500/20 hover:border-pink-500/50 transition duration-300">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-pink-500/20 flex items-center justify-center text-pink-400 group-hover:scale-110 transition duration-300">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                </div>
                <div class="text-left">
                    <span class="text-[9px] font-bold text-gray-400 uppercase tracking-wider block">Official Store</span>
                    <span class="text-xs font-black text-white group-hover:text-pink-400 transition">@deablacenterr.id</span>
                </div>
            </div>
            <span class="text-[10px] font-bold text-pink-400 group-hover:translate-x-1 transition duration-300">
                Follow IG &rarr;
            </span>
        </a>

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

            <!-- TOMBOL WA DENGAN PROTEKSI SUBMIT -->
            <a @click="saveAndSubmitWA()" 
               :href="`https://wa.me/6283815508515?text=Halo%20Admin,%20saya%20sudah%20melakukan%20pembayaran%20via%20${paymentMethod === 'qris' ? 'QRIS' : 'Transfer%20BCA'}.%0A%0A*Detail%20Pesanan:*%0ANama:%20${encodeURIComponent(name)}%0AWA:%20${encodeURIComponent(phone)}%0AProduk:%20${encodeURIComponent(product)}%0AUkuran:%20${encodeURIComponent(size)}%0AAlamat:%20${encodeURIComponent(address)}`"
               target="_blank" 
               class="block w-full bg-emerald-600 hover:bg-emerald-500 text-white font-extrabold text-xs uppercase tracking-wider py-3 rounded-xl transition duration-300 shadow-lg shadow-emerald-600/20 active:scale-95">
                Konfirmasi Pembayaran (WA)
            </a>
        </div>
    </div>
</div>
@endsection