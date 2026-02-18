@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<script src="//unpkg.com/alpinejs" defer></script>

<section
    class="bg-[#fdfaf5] min-h-screen pt-10 pb-32 md:pb-20"
    x-data="{
        metode: 'cod'
    }"
>
    <div class="container mx-auto px-6 md:px-16 lg:px-24">
        <h1 class="text-4xl font-black text-[#4A3428] mb-10 uppercase tracking-tighter">
            Finalisasi <span class="text-[#D9B382] italic serif">Pesanan</span>
        </h1>

        @if ($errors->any())
        <div class="mb-6 p-4 rounded-2xl bg-red-100 border border-red-200 text-red-700">
            <p class="font-bold mb-1 uppercase text-xs tracking-widest">Ada masalah pada input Anda:</p>
            <ul class="list-disc list-inside text-sm font-medium">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 p-4 rounded-2xl bg-red-100 border border-red-200 text-red-700">
            <p class="font-bold uppercase text-xs tracking-widest">
                <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
            </p>
        </div>
        @endif

        <form 
            id="checkoutForm"
            action="{{ route('checkout.process') }}" 
            method="POST" 
            enctype="multipart/form-data"
            class="grid grid-cols-1 lg:grid-cols-3 gap-12"
        >
            @csrf
                
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white p-8 md:p-10 rounded-[2.5rem] shadow-sm border border-[#4A3428]/5">
                    <h2 class="text-2xl font-black text-[#4A3428] mb-8 flex items-center gap-3">
                        <span class="w-8 h-8 bg-[#4A3428] text-[#D9B382] rounded-full flex items-center justify-center text-sm">1</span>
                        Informasi Pemesan
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-black uppercase tracking-widest text-[#4A3428]/50 ml-2">
                                Nama Pemesan
                            </label>
                            <input
                                type="text"
                                name="nama_pemesan"
                                required
                                value="{{ old('nama_pemesan', $customer->username ?? '') }}"
                                class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-none focus:ring-2 focus:ring-[#D9B382] font-medium text-[#4A3428]"
                                placeholder="Nama penerima paket..."
                                @auth('customer') readonly @endauth
                            >
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-black uppercase tracking-widest text-[#4A3428]/50 ml-2">
                                Nomor HP (WhatsApp)
                            </label>
                            <input
                                type="tel"
                                name="no_hp"
                                required
                                value="{{ old('no_hp', $customer->no_hp ?? '') }}"
                                class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-none focus:ring-2 focus:ring-[#D9B382] font-medium text-[#4A3428]"
                                placeholder="08123456789..."
                                @auth('customer') readonly @endauth
                            >
                        </div>

                        <div class="md:col-span-2 space-y-2">
                            <label class="text-xs font-black uppercase tracking-widest text-[#4A3428]/50 ml-2">
                                Alamat Lengkap
                            </label>
                            <textarea
                                name="alamat"
                                required
                                rows="3"
                                class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-none focus:ring-2 focus:ring-[#D9B382] font-medium text-[#4A3428]"
                                placeholder="Jl. Nama Jalan, No Rumah, Kelurahan, Kecamatan, Kota..."
                                @auth('customer') readonly @endauth
                            >{{ old('alamat', $customer->alamat ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 md:p-10 rounded-[2.5rem] shadow-sm border border-[#4A3428]/5">
                    <h2 class="text-2xl font-black text-[#4A3428] mb-8 flex items-center gap-3">
                        <span class="w-8 h-8 bg-[#4A3428] text-[#D9B382] rounded-full flex items-center justify-center text-sm">2</span>
                        Detail Pesanan
                    </h2>
                    
                    <div class="space-y-4">
                        @foreach($cart as $id => $details)
                        <div class="flex flex-col md:flex-row gap-4 p-4 bg-[#fdfaf5] rounded-2xl border border-[#4A3428]/10 items-center">
                            <div class="flex items-center gap-4 flex-1 w-full">
                               <img src="{{ asset('images/products/' . $details['image']) }}" 
                                class="w-16 h-16 md:w-20 md:h-20 object-cover rounded-xl shadow-sm"
                                loading="lazy"
                                onerror="this.src='{{ asset('images/default-product.jpg') }}'">

                                <div class="flex-1 min-w-0">
                                    <h4 class="font-bold text-[#4A3428] text-sm md:text-base line-clamp-1">
                                        {{ $details['name'] }}
                                    </h4>
                                    <div class="flex items-center gap-3 mt-1">
                                        <p class="text-xs text-[#D9B382] font-black">
                                            {{ $details['quantity'] }} pcs × Rp{{ number_format($details['price'], 0, ',', '.') }}
                                        </p>
                                        <span class="text-[10px] font-bold px-2 py-0.5 bg-[#4A3428]/5 text-[#4A3428] rounded-md uppercase tracking-wider">
                                            Size: {{ $details['size'] ?? 'All Size' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <button type="button" 
                                    onclick="confirmDelete('{{ $id }}', {{ count($cart) }})"
                                    class="w-10 h-10 flex items-center justify-center rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-all active:scale-90">
                                <i class="fas fa-trash text-sm"></i>
                            </button>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-6 space-y-2">
                        <label class="text-xs font-black uppercase tracking-widest text-[#4A3428]/50 ml-2">
                            Catatan Pesanan (Opsional)
                        </label>
                        <input 
                            type="text" 
                            name="catatan" 
                            class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-none focus:ring-2 focus:ring-[#D9B382] font-medium text-[#4A3428]" 
                            placeholder="Contoh: Tolong dicek kembali sebelum dikirim...">
                    </div>
                </div>

             
                <div class="bg-white p-8 md:p-10 rounded-[2.5rem] shadow-sm border border-[#4A3428]/5">
                    <h2 class="text-2xl font-black text-[#4A3428] mb-8 flex items-center gap-3">
                        <span class="w-8 h-8 bg-[#4A3428] text-[#D9B382] rounded-full flex items-center justify-center text-sm">3</span>
                        Metode Pembayaran
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="relative flex items-center gap-4 p-5 rounded-3xl bg-[#fdfaf5] cursor-pointer border-2 transition-all duration-300"
                            :class="metode === 'cod' ? 'border-[#D9B382] bg-white shadow-md' : 'border-transparent'">
                            <input type="radio" name="metode_pembayaran" value="cod" x-model="metode" class="hidden">
                            <div class="w-6 h-6 rounded-full border-2 border-[#4A3428] flex items-center justify-center" :class="metode === 'cod' ? 'bg-[#4A3428]' : ''">
                                <div class="w-2 h-2 rounded-full bg-white" x-show="metode === 'cod'"></div>
                            </div>
                            <div>
                                <p class="font-black text-[#4A3428] uppercase text-sm tracking-tight">COD</p>
                                <p class="text-[11px] text-[#4A3428]/60 font-bold uppercase tracking-tighter">Bayar di Tempat</p>
                            </div>
                        </label>

                        <label class="relative flex items-center gap-4 p-5 rounded-3xl bg-[#fdfaf5] cursor-pointer border-2 transition-all duration-300"
                            :class="metode === 'transfer' ? 'border-[#D9B382] bg-white shadow-md' : 'border-transparent'">
                            <input type="radio" name="metode_pembayaran" value="transfer" x-model="metode" class="hidden">
                            <div class="w-6 h-6 rounded-full border-2 border-[#4A3428] flex items-center justify-center" :class="metode === 'transfer' ? 'bg-[#4A3428]' : ''">
                                <div class="w-2 h-2 rounded-full bg-white" x-show="metode === 'transfer'"></div>
                            </div>
                            <div>
                                <p class="font-black text-[#4A3428] uppercase text-sm tracking-tight">Transfer</p>
                                <p class="text-[11px] text-[#4A3428]/60 font-bold uppercase tracking-tighter">Konfirmasi Manual</p>
                            </div>
                        </label>
                    </div>

                    <div x-show="metode === 'transfer'" 
                         x-transition
                         class="mt-6 p-6 rounded-[2rem] bg-[#fdfaf5] border border-dashed border-[#D9B382]">
                        
                        <div class="mb-6 p-6 md:p-8 bg-white rounded-[2rem] border border-[#4A3428]/10 shadow-sm text-center">
                            
                            <p class="text-xs md:text-sm font-black uppercase tracking-[0.25em] text-[#4A3428]/60 mb-6">
                                Silakan transfer ke rekening
                            </p>
                    
                            <div class="space-y-3">
                    
                                <p class="text-2xl md:text-3xl font-black tracking-widest text-[#4A3428]">
                                    1234567890
                                </p>
                    
                                <p class="text-lg md:text-xl font-bold text-[#D9B382]">
                                    BCA
                                </p>
                    
                                <p class="text-sm md:text-base font-semibold text-[#4A3428]/70">
                                    An. Toko Anjay Official
                                </p>
                    
                            </div>
                    
                            <p class="text-[11px] text-[#4A3428]/50 mt-6 italic">
                                *Pastikan nominal transfer sesuai dengan total pesanan Anda.
                            </p>
                    
                        </div>

                    
                    
                        <label class="block text-xs font-black uppercase tracking-widest text-[#4A3428]/50 mb-4">
                            Upload Bukti Transfer <span class="text-red-500">*</span>
                        </label>
                    
                        <input type="file"
                               name="bukti_transfer"
                               accept="image/*"
                               :required="metode === 'transfer'"
                               class="w-full text-sm text-gray-500 
                                      file:mr-4 file:py-3 file:px-6 
                                      file:rounded-2xl file:border-0 
                                      file:text-xs file:font-black 
                                      file:bg-[#4A3428] file:text-[#D9B382] 
                                      file:cursor-pointer 
                                      hover:file:bg-[#D9B382] 
                                      hover:file:text-[#4A3428] 
                                      file:transition-all">
                    
                        <p class="text-[10px] font-bold text-[#4A3428]/40 mt-3 uppercase tracking-widest italic">
                            Format: JPG / PNG (Max 10MB)
                        </p>
                    
                    </div>

                </div>
            </div>

      
            <div class="hidden lg:block">
                <div class="bg-[#4A3428] p-8 rounded-[2.5rem] text-white shadow-2xl sticky top-10 border border-white/5">
                    <h2 class="text-xl font-black mb-6 uppercase tracking-widest text-[#D9B382]">Ringkasan Pesanan</h2>
                    
                    <div class="max-h-[300px] overflow-y-auto pr-2 space-y-4 mb-6 custom-scrollbar">
                        @php $total = 0; @endphp
                        @foreach($cart as $id => $details)
                            @php $total += $details['price'] * $details['quantity']; @endphp
                            <div class="flex items-center gap-4 bg-white/5 p-3 rounded-2xl border border-white/10">
                             <img src="{{ asset('images/products/' . $details['image']) }}" 
                                class="w-16 h-16 object-cover rounded-xl"
                                loading="lazy"
                                onerror="this.src='{{ asset('images/default-product.jpg') }}'">

                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-bold truncate">{{ $details['name'] }}</h4>
                                    <p class="text-xs text-[#D9B382] font-black">
                                        {{ $details['quantity'] }} pcs — {{ $details['size'] ?? 'All Size' }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="space-y-3 border-t border-white/10 pt-6 mb-6">
                        <div class="flex justify-between text-sm">
                            <span class="text-white/60 font-medium">Total Item</span>
                            <span class="font-black">{{ count($cart) }} Produk</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-white/60 font-medium">Metode</span>
                            <span class="font-black text-[#D9B382] uppercase" x-text="metode"></span>
                        </div>
                        <div class="flex justify-between pt-3 border-t border-white/10">
                            <span class="text-lg font-black text-[#D9B382]">Total Bayar</span>
                            <span class="text-lg font-black">Rp{{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-5 bg-[#D9B382] text-[#4A3428] font-black rounded-2xl hover:bg-white hover:scale-[1.02] transition-all shadow-xl uppercase tracking-widest text-sm">
                        <i class="fas fa-check-circle mr-2"></i> PESAN SEKARANG
                    </button>
                </div>
            </div>

 
            <div class="fixed bottom-0 left-0 right-0 bg-white p-4 shadow-[0_-10px_40px_rgba(0,0,0,0.1)] z-[50] lg:hidden rounded-t-[2rem] border-t border-[#4A3428]/5">
                @php $total = 0; @endphp
                @foreach($cart as $id => $details)
                    @php $total += $details['price'] * $details['quantity']; @endphp
                @endforeach
                
                <div class="flex items-center justify-between mb-4 px-2">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Total Bayar</p>
                        <p class="text-xl font-black text-[#4A3428]">Rp{{ number_format($total, 0, ',', '.') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs font-black text-[#D9B382] uppercase" x-text="metode"></p>
                        <p class="text-xs text-gray-400">{{ count($cart) }} Produk</p>
                    </div>
                </div>
                
                <button type="submit" form="checkoutForm" 
                    class="block w-full py-4 bg-[#4A3428] text-[#D9B382] text-center font-black rounded-xl shadow-lg active:scale-95 transition-transform uppercase tracking-wider text-sm">
                    <i class="fas fa-check-circle mr-2"></i> PESAN SEKARANG
                </button>
            </div>
        </form>
    </div>
</section>


<form id="deleteItemForm" action="{{ route('checkout.remove') }}" method="POST" class="hidden">
    @csrf
    <input type="hidden" name="id" id="deleteItemId">
</form>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #D9B382; border-radius: 10px; }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id, count) {
        let config = {
            title: 'Hapus Produk?',
            text: 'Produk ini akan dihapus dari keranjang belanja Anda.',
            confirmButtonText: 'Ya, Hapus',
        };

        if (count <= 1) {
            config = {
                title: 'Serius mau batal pesan?',
                text: 'Jika produk terakhir ini dihapus, Anda akan diarahkan kembali ke halaman utama.',
                confirmButtonText: 'Ya, Batal Pesan',
            };
        }

        Swal.fire({
            title: config.title,
            text: config.text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4A3428',
            cancelButtonColor: '#d33',
            confirmButtonText: config.confirmButtonText,
            cancelButtonText: 'Tidak',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteItemId').value = id;
                document.getElementById('deleteItemForm').submit();
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('checkoutForm');
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const selectedMetode = form.querySelector('input[name="metode_pembayaran"]:checked').value;

            if (selectedMetode === 'transfer') {
                const buktiInput = form.querySelector('input[name="bukti_transfer"]');
                const files = buktiInput.files;

                if (files.length === 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Bukti Transfer Kosong',
                        text: 'Harap upload bukti transfer Anda sebelum melanjutkan.',
                        confirmButtonColor: '#4A3428'
                    });
                    return;
                }

                const file = files[0];
                const maxSize = 10 * 1024 * 1024;

                if (file.size > maxSize) {
                    Swal.fire({
                        icon: 'error',
                        title: 'File Terlalu Besar',
                        text: `Ukuran foto maksimal 10MB. File Anda: ${(file.size / (1024 * 1024)).toFixed(2)} MB.`,
                        confirmButtonColor: '#4A3428'
                    });
                    return;
                }
            }

            Swal.fire({
                title: 'Konfirmasi Pesanan',
                html: `
                    <div class="text-left">
                        <p class="mb-2">Pastikan semua data sudah benar:</p>
                        <ul class="text-sm space-y-1 text-gray-700">
                            <li>✓ Data pemesan sudah sesuai</li>
                            <li>✓ Ukuran produk sudah dipilih</li>
                            <li>✓ Metode pembayaran: <strong>${selectedMetode.toUpperCase()}</strong></li>
                        </ul>
                    </div>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Pesan Sekarang',
                cancelButtonText: 'Cek Lagi',
                reverseButtons: true,
                confirmButtonColor: '#4A3428',
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Sedang Memproses...',
                        html: '<i class="fas fa-spinner fa-spin text-4xl text-[#D9B382]"></i>',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        didOpen: () => { Swal.showLoading(); }
                    });
                    form.submit();
                }
            });
        });
    });
</script>
@endsection