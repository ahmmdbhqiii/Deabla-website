@extends('layouts.app')

@section('content')
<!-- CDN html2canvas untuk fitur download nota jadi gambar -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<div class="min-h-screen bg-black text-white py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden selection:bg-pink-500 selection:text-white" 
     x-data="{ 
        openModal: false, 
        paymentMethod: 'qris',
        isSubmitting: false,
        copied: false,
        orderId: '',
        orderDate: '',
        name: '', 
        phone: '', 
        product: '', 
        size: 'L', 
        address: '',
        errors: {},
        validateAndSubmit() {
            this.errors = {};
            if (!this.name.trim()) this.errors.name = 'Nama lengkap wajib diisi';
            if (!this.phone.trim()) this.errors.phone = 'Nomor WhatsApp wajib diisi';
            if (!this.product) this.errors.product = 'Silakan pilih produk terlebih dahulu';
            if (!this.address.trim()) this.errors.address = 'Alamat pengiriman wajib diisi';

            if (Object.keys(this.errors).length === 0) {
                this.orderId = 'DBL-' + Math.floor(100000 + Math.random() * 900000);
                let now = new Date();
                this.orderDate = now.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' }) + ' | ' + now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
                this.openModal = true;
                this.saveOrderToSheet();
            }
        },
        copyRekening() {
            navigator.clipboard.writeText('1234567890');
            this.copied = true;
            setTimeout(() => { this.copied = false; }, 2000);
        },
        downloadNota() {
            let element = document.getElementById('nota-struk-belanja');
            html2canvas(element, { backgroundColor: '#09090b', scale: 2 }).then(canvas => {
                let link = document.createElement('a');
                link.download = 'Nota-' + this.orderId + '.png';
                link.href = canvas.toDataURL('image/png');
                link.click();
            });
        },
        saveOrderToSheet() {
            if (this.isSubmitting) return;
            this.isSubmitting = true;

            fetch('/simpan-order', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    order_id: this.orderId,
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
    
    <!-- Ambient Glow Background Accent -->
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[350px] sm:w-[600px] h-[350px] sm:h-[600px] bg-pink-600/15 blur-[140px] pointer-events-none rounded-full"></div>

    <div class="max-w-md sm:max-w-xl mx-auto relative z-10 space-y-8">
        
        <!-- HEADER TITLE -->
        <div class="text-center space-y-3">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-pink-500/10 border border-pink-500/30 text-pink-400 text-[10px] font-black uppercase tracking-[0.25em]">
                <span class="w-1.5 h-1.5 rounded-full bg-pink-500 animate-pulse"></span>
                Secure Checkout Gateway
            </div>
            <h1 class="text-3xl sm:text-5xl font-black text-white uppercase tracking-tight">Formulir Pesanan</h1>
            <p class="text-xs sm:text-sm text-gray-400 max-w-md mx-auto">Lengkapi data diri dan alamat pengiriman Anda secara valid untuk mengonfirmasi pesanan ke sistem.</p>
        </div>

        <!-- MAIN FORM CARD -->
        <div class="bg-zinc-950 border border-white/10 rounded-3xl p-6 sm:p-10 backdrop-blur-2xl shadow-2xl space-y-6">
            
            <!-- OFFICIAL INSTAGRAM STORE BADGE -->
            <a href="https://www.instagram.com/deablacenterr.id" 
               target="_blank" 
               class="group flex items-center justify-between p-4 rounded-2xl bg-gradient-to-r from-pink-500/10 via-purple-500/5 to-transparent border border-pink-500/20 hover:border-pink-500/40 transition duration-300 shadow-lg">
                <div class="flex items-center gap-3.5">
                    <div class="w-10 h-10 rounded-xl bg-pink-500/20 flex items-center justify-center text-pink-400 group-hover:scale-110 transition duration-300 border border-pink-500/30">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </div>
                    <div>
                        <span class="text-[9px] font-extrabold text-gray-400 uppercase tracking-wider block">Official Instagram Store</span>
                        <span class="text-xs sm:text-sm font-black text-white group-hover:text-pink-400 transition">@deablacenterr.id</span>
                    </div>
                </div>
                <span class="text-xs font-extrabold text-pink-400 group-hover:translate-x-1 transition duration-300 flex items-center gap-1">
                    Follow &rarr;
                </span>
            </a>

            <!-- FORMULIR INPUT -->
            <form @submit.prevent="validateAndSubmit()" novalidate class="space-y-5">
                <div>
                    <label class="block text-[11px] font-black uppercase text-gray-300 mb-2 tracking-wider">Nama Lengkap</label>
                    <input type="text" x-model="name" placeholder="Masukkan nama lengkap Anda..." 
                           :class="errors.name ? 'border-red-500 focus:border-red-500 bg-red-500/5' : 'border-white/15 focus:border-pink-500 bg-black/60'"
                           class="w-full border rounded-2xl px-4 py-3.5 text-xs sm:text-sm text-white focus:outline-none transition placeholder-gray-600 shadow-inner">
                    <template x-if="errors.name">
                        <span class="text-[10px] font-bold text-red-400 mt-1.5 block" x-text="errors.name"></span>
                    </template>
                </div>

                <div>
                    <label class="block text-[11px] font-black uppercase text-gray-300 mb-2 tracking-wider">Nomor WhatsApp</label>
                    <input type="tel" x-model="phone" placeholder="Contoh: 081234567890" 
                           :class="errors.phone ? 'border-red-500 focus:border-red-500 bg-red-500/5' : 'border-white/15 focus:border-pink-500 bg-black/60'"
                           class="w-full border rounded-2xl px-4 py-3.5 text-xs sm:text-sm text-white focus:outline-none transition placeholder-gray-600 shadow-inner">
                    <template x-if="errors.phone">
                        <span class="text-[10px] font-bold text-red-400 mt-1.5 block" x-text="errors.phone"></span>
                    </template>
                </div>

                <div>
                    <label class="block text-[11px] font-black uppercase text-gray-300 mb-2 tracking-wider">Pilih Produk</label>
                    <div class="relative">
                        <select x-model="product" 
                                :class="errors.product ? 'border-red-500 focus:border-red-500 bg-red-500/5' : 'border-white/15 focus:border-pink-500 bg-black/60'"
                                class="w-full border rounded-2xl px-4 py-3.5 text-xs sm:text-sm text-white focus:outline-none transition appearance-none cursor-pointer truncate pr-10">
                            <option value="" disabled selected class="text-gray-500">-- Pilih Produk Terlebih Dahulu --</option>
                            <option class="bg-zinc-900 text-white" value="DEABLA Zip Hoodie - Love Bombing">DEABLA Zip Hoodie - Love Bombing | Rp 350.000</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-400 text-xs">
                            ▼
                        </div>
                    </div>
                    <template x-if="errors.product">
                        <span class="text-[10px] font-bold text-red-400 mt-1.5 block" x-text="errors.product"></span>
                    </template>
                </div>

                <div>
                    <label class="block text-[11px] font-black uppercase text-gray-300 mb-2 tracking-wider">Ukuran (Size)</label>
                    <div class="grid grid-cols-4 gap-3">
                        <template x-for="s in ['S', 'M', 'L', 'XL']">
                            <label class="cursor-pointer">
                                <input type="radio" name="size" :value="s" x-model="size" class="hidden peer">
                                <span class="block text-center py-3 bg-black/60 border border-white/15 rounded-2xl text-xs font-black text-gray-400 peer-checked:border-pink-500 peer-checked:bg-pink-500/20 peer-checked:text-pink-400 hover:border-white/30 transition shadow-sm" x-text="s"></span>
                            </label>
                        </template>
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-black uppercase text-gray-300 mb-2 tracking-wider">Alamat Pengiriman Lengkap</label>
                    <textarea x-model="address" rows="3" placeholder="Nama Jalan, No. Rumah, RT/RW, Kecamatan, Kota, Kode Pos" 
                              :class="errors.address ? 'border-red-500 focus:border-red-500 bg-red-500/5' : 'border-white/15 focus:border-pink-500 bg-black/60'"
                              class="w-full border rounded-2xl px-4 py-3.5 text-xs sm:text-sm text-white focus:outline-none transition placeholder-gray-600 shadow-inner resize-none"></textarea>
                    <template x-if="errors.address">
                        <span class="text-[10px] font-bold text-red-400 mt-1.5 block" x-text="errors.address"></span>
                    </template>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-pink-600 to-pink-500 hover:from-pink-500 hover:to-pink-400 text-white font-black text-xs sm:text-sm uppercase tracking-widest py-4 rounded-2xl transition duration-300 shadow-xl shadow-pink-600/30 active:scale-[0.98] mt-2">
                    Generate Nota Resmi &rarr;
                </button>
            </form>
        </div>
    </div>

    <!-- MODAL NOTA FORMAL + SCROLLABLE CONTAINER -->
    <div x-show="openModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-4 bg-black/90 backdrop-blur-md overflow-y-auto" 
         x-cloak>
        
        <div class="bg-zinc-950 border border-white/20 p-5 sm:p-8 pb-28 rounded-3xl max-w-sm sm:max-w-md w-full text-center relative shadow-2xl space-y-5 my-auto max-h-[95vh] overflow-y-auto overscroll-contain">
            
            <button @click="openModal = false" class="sticky top-0 float-right z-20 w-8 h-8 rounded-full bg-zinc-900 hover:bg-pink-600 text-gray-300 hover:text-white flex items-center justify-center transition shadow-lg">&times;</button>
            
            <!-- BAGIAN ELEMEN NOTA YANG AKAN DI-DOWNLOAD (TETAP GELAP & ELEGAN) -->
            <div id="nota-struk-belanja" class="bg-zinc-950 p-4 sm:p-5 rounded-2xl space-y-4 text-left clear-both border border-white/10 shadow-inner">
                <!-- KOP NOTA -->
                <div class="space-y-1 border-b border-dashed border-white/20 pb-4 text-center">
                    <h2 class="text-lg font-black text-white tracking-widest uppercase">DEABLACENTERR.ID</h2>
                    <p class="text-[10px] text-gray-400 uppercase tracking-wider font-semibold">Official Streetwear Store</p>
                    <div class="flex justify-between items-center text-[11px] text-gray-400 font-mono mt-3 px-1">
                        <span x-text="orderId"></span>
                        <span x-text="orderDate"></span>
                    </div>
                </div>

                <!-- DETAIL CUSTOMER -->
                <div class="text-[11px] text-gray-300 space-y-2 bg-black/50 p-3.5 rounded-2xl border border-white/10">
                    <div class="flex justify-between items-start gap-3">
                        <span class="text-gray-400 shrink-0 font-bold">Kepada:</span>
                        <strong class="text-white uppercase text-right leading-tight break-words max-w-[200px]" x-text="name"></strong>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400 shrink-0 font-bold">No. WA:</span>
                        <strong class="text-white font-mono" x-text="phone"></strong>
                    </div>
                    <div class="flex flex-col pt-2 border-t border-white/10 space-y-1">
                        <span class="text-gray-400 font-bold">Alamat Tujuan:</span>
                        <p class="text-gray-200 italic leading-snug break-words" x-text="address"></p>
                    </div>
                </div>

                <!-- TABEL ITEM RAPI -->
                <div class="border border-white/15 rounded-2xl overflow-hidden text-xs">
                    <div class="bg-white/10 px-3.5 py-2 flex justify-between font-bold text-gray-300 text-[10px] uppercase tracking-wider">
                        <span>Item & Size</span>
                        <span>Subtotal</span>
                    </div>
                    <div class="px-3.5 py-3.5 flex justify-between items-start gap-3 bg-black/70">
                        <div class="space-y-2">
                            <p class="font-bold text-white text-xs leading-snug break-words max-w-[190px]" x-text="product"></p>
                            <div class="inline-flex items-center px-2.5 py-0.5 rounded-lg bg-pink-500/20 border border-pink-500/30 text-[10px] text-pink-400 font-black uppercase tracking-wide">
                                SIZE: <span class="ml-1" x-text="size"></span>
                            </div>
                        </div>
                        <span class="font-black text-white shrink-0 pt-0.5 font-mono">Rp 350.000</span>
                    </div>
                    <div class="bg-white/10 px-3.5 py-3 flex justify-between items-center border-t border-dashed border-white/15 font-black text-xs">
                        <span class="text-gray-200 uppercase tracking-wider text-[11px]">TOTAL TAGIHAN:</span>
                        <span class="text-pink-400 font-mono text-sm">Rp 350.000</span>
                    </div>
                </div>
            </div>
            <!-- BATAS AKHIR ELEMEN NOTA -->

            <!-- TOMBOL DOWNLOAD NOTA JADI GAMBAR (PNG) -->
            <button @click="downloadNota()" 
                    class="w-full bg-white/10 hover:bg-white/20 text-white font-black text-xs uppercase tracking-wider py-3 rounded-2xl transition flex items-center justify-center gap-2 border border-white/20 shadow-lg active:scale-95">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/></svg>
                Simpan Nota ke Galeri (Gambar)
            </button>
            
            <!-- TOGGLE METODE PEMBAYARAN -->
            <div class="grid grid-cols-2 gap-2 p-1.5 bg-black/60 border border-white/15 rounded-2xl text-xs font-bold">
                <button @click="paymentMethod = 'qris'" 
                        :class="paymentMethod === 'qris' ? 'bg-pink-600 text-white shadow-lg shadow-pink-600/30' : 'text-gray-400 hover:text-white'"
                        class="py-2.5 rounded-xl transition duration-200 uppercase tracking-wider text-[11px]">
                    QRIS
                </button>
                <button @click="paymentMethod = 'bca'" 
                        :class="paymentMethod === 'bca' ? 'bg-pink-600 text-white shadow-lg shadow-pink-600/30' : 'text-gray-400 hover:text-white'"
                        class="py-2.5 rounded-xl transition duration-200 uppercase tracking-wider text-[11px]">
                    Transfer BCA
                </button>
            </div>

            <!-- KONTEN METHOD 1: QRIS (UKURAN PROPORSIONAL & RAPI) -->
            <div x-show="paymentMethod === 'qris'" class="space-y-3 flex flex-col items-center justify-center">
                <div class="bg-white p-3 rounded-2xl shadow-xl border-2 border-white inline-block w-48 h-48 flex items-center justify-center">
                    <img src="{{ asset('images/qris-deabla.png') }}" alt="QRIS Code" class="w-full h-full object-contain">
                </div>
                <p class="text-[10px] text-gray-400">Scan pakai Gopay, OVO, Dana, ShopeePay, atau M-Banking.</p>
            </div>

            <!-- KONTEN METHOD 2: BANK BCA -->
            <div x-show="paymentMethod === 'bca'" class="bg-zinc-900 border border-white/15 p-4 rounded-2xl text-left space-y-3">
                <div class="flex items-center justify-between border-b border-white/10 pb-2.5">
                    <span class="text-[10px] font-black uppercase text-pink-400 tracking-wider">Bank Central Asia</span>
                    <span class="text-xs font-black text-white px-2.5 py-0.5 rounded bg-white/5 border border-white/10">BCA</span>
                </div>
                
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-[9px] uppercase text-gray-400 font-bold block mb-0.5">No. Rekening:</span>
                        <p class="text-base font-black text-white tracking-wider font-mono">1234 5678 90</p>
                    </div>
                    <button @click="copyRekening()" 
                            class="px-3.5 py-1.5 rounded-xl bg-pink-600/20 hover:bg-pink-600 border border-pink-500/40 text-pink-400 hover:text-white text-[10px] font-extrabold uppercase tracking-wider transition flex items-center gap-1.5 active:scale-95 shadow-md">
                        <span x-text="copied ? 'Tersalin!' : 'Copy'"></span>
                    </button>
                </div>

                <div>
                    <span class="text-[9px] uppercase text-gray-400 font-bold block mb-0.5">Atas Nama:</span>
                    <p class="text-xs font-extrabold text-gray-200 uppercase tracking-wide">DEABLA OFFICIAL</p>
                </div>
            </div>

            <!-- TOMBOL WA -->
            <a @click="saveOrderToSheet()" 
               :href="`https://wa.me/6283815508515?text=` + encodeURIComponent(
`KONFIRMASI PESANAN & PEMBAYARAN

No. Invoice: ${orderId}
Tanggal: ${orderDate}
Nama Pemesan: ${name}
No. HP/WA: ${phone}
Alamat Pengiriman: ${address}
Metode Pembayaran: ${paymentMethod === 'qris' ? 'QRIS (Instant)' : 'Transfer BCA'}

Rincian Produk:
1. ${product} (Size: ${size}) - 1x @Rp 350.000

Total Pembelian: Rp 350.000`)"
               target="_blank" 
               class="flex items-center justify-center gap-2.5 w-full bg-emerald-600 hover:bg-emerald-500 text-white font-black text-xs sm:text-sm uppercase tracking-wider py-4 rounded-2xl transition duration-300 shadow-xl shadow-emerald-600/30 active:scale-95">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.334-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                Kirim Pesanan ke WhatsApp
            </a>
        </div>
    </div>
</div>
@endsection