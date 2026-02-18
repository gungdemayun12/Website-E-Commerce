<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@extends('layouts.app')

@section('title', 'Pesanan Aktif')

@section('content')
<section class="bg-[#fdfaf5] min-h-screen py-8 md:py-16">
    <div class="container mx-auto px-4 md:px-6 max-w-6xl">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12">
            <div>
                    Pesanan <span class="text-[#D9B382]">Aktif</span>
                </h1>
                <p class="text-[#4A3428]/60 font-medium mt-2">Daftar pesanan yang sedang dalam proses pengiriman atau penyiapan.</p>
            </div>
            <div class="hidden md:block">
                <span class="text-[10px] font-bold text-[#4A3428]/40 uppercase tracking-[0.3em]">Exclusive Member Tracking</span>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 md:gap-10">
            @forelse($groupedOrders as $order)
            
            <div class="bg-white rounded-[2.5rem] md:rounded-[3rem] p-5 md:p-10 border border-[#D9B382]/20 shadow-sm hover:shadow-2xl transition-all duration-500 group relative overflow-hidden">
                
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#D9B382]/5 rounded-bl-full -mr-10 -mt-10 transition-all group-hover:bg-[#D9B382]/10"></div>

                <div class="relative z-10">
                  
                    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 mb-6 pb-6 border-b border-[#D9B382]/20">
                        <div>
                            <span class="text-[9px] md:text-[11px] font-black text-[#D9B382] uppercase tracking-[0.2em]">
                                ID Transaksi #{{ $order->id + 1000 }}
                            </span>
                            <p class="text-xs text-[#4A3428]/50 mt-1">
                                {{ date('d F Y, H:i', strtotime($order->created_at)) }} WIB
                            </p>
                        </div>
                        
                        <div class="flex flex-wrap items-center gap-3">
                            <div class="flex items-center gap-2">
                                <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full 
                                        @if($order->status == 'pending') bg-red-400 
                                        @elseif($order->status == 'diproses') bg-amber-400 
                                        @else bg-green-400 @endif opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 
                                        @if($order->status == 'pending') bg-red-500 
                                        @elseif($order->status == 'diproses') bg-amber-500 
                                        @else bg-green-500 @endif"></span>
                                </span>
                                <span class="text-xs font-black uppercase tracking-widest
                                    @if($order->status == 'pending') text-red-500 
                                    @elseif($order->status == 'diproses') text-amber-500 
                                    @else text-green-500 @endif">
                                    {{ $order->status }}
                                </span>
                            </div>
                            <span class="text-[10px] font-bold text-white bg-[#4A3428] px-3 py-1 rounded-full uppercase tracking-tighter">
                                {{ $order->metode_pembayaran }}
                            </span>
                        </div>
                    </div>

                 
                    <div class="space-y-4 mb-6">
                        @foreach($order->items as $item)
                        <div class="flex gap-4 md:gap-6 items-start p-4 rounded-2xl bg-[#fdfaf5]/50 hover:bg-[#fdfaf5] transition-all">
                            <div class="w-16 h-20 md:w-20 md:h-28 flex-shrink-0 rounded-xl overflow-hidden bg-white border border-[#D9B382]/10">
                                <img src="{{ asset('images/products/' . $item->gambar) }}"
                                    alt="{{ $item->nama_produk }}"
                                    class="w-full h-full object-cover"
                                    loading="lazy"
                                    onerror="this.src='{{ asset('images/default-product.jpg') }}'">

                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-base md:text-lg font-black text-[#4A3428] leading-tight mb-2">
                                    {{ $item->nama_produk }}
                                </h3>
                                <div class="flex flex-wrap items-center gap-2 mb-2">
                                    @if($item->ukuran)
                                    <span class="px-2.5 py-0.5 bg-[#4A3428] text-[#D9B382] text-[9px] font-bold rounded-lg uppercase italic">
                                        Size {{ $item->ukuran }}
                                    </span>
                                    @endif
                                    <span class="px-2.5 py-0.5 border border-[#4A3428]/10 text-[#4A3428]/60 text-[9px] font-bold rounded-lg">
                                        {{ $item->qty }} Unit
                                    </span>
                                </div>
                                <p class="text-sm font-bold text-[#4A3428]/60">
                                    Rp{{ number_format($item->harga, 0, ',', '.') }} × {{ $item->qty }} = 
                                    <span class="text-[#4A3428]">Rp{{ number_format($item->total_harga, 0, ',', '.') }}</span>
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    
                    <div class="flex flex-col lg:flex-row gap-6 pt-6 border-t border-dashed border-[#D9B382]/30">
                        <div class="flex-1">
                            <div class="mb-4">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5">Penerima & Kontak</p>
                                <p class="text-[#4A3428] font-bold text-base">{{ $order->nama_pemesan }}</p>
                                <p class="text-[#4A3428]/50 text-xs mt-0.5">{{ $order->no_hp }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5">Alamat Pengiriman</p>
                                <p class="text-[#4A3428]/80 text-sm font-medium leading-relaxed italic">
                                    "{{ $order->alamat }}"
                                </p>
                            </div>
                            @if($order->catatan)
                            <div class="mt-4">
                                <p class="text-[11px] font-medium text-[#4A3428]/40 leading-relaxed">
                                    <span class="font-black text-[#D9B382] uppercase mr-1">Catatan:</span> {{ $order->catatan }}
                                </p>
                            </div>
                            @endif
                        </div>

                        <div class="lg:w-1/3 bg-[#fdfaf5] p-6 rounded-2xl border border-[#D9B382]/10">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Ringkasan Pesanan</p>
                            <div class="space-y-2 mb-4">
                                <div class="flex justify-between text-sm">
                                    <span class="text-[#4A3428]/60">Total Item:</span>
                                    <span class="font-bold text-[#4A3428]">{{ $order->items->count() }} Produk</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-[#4A3428]/60">Total Unit:</span>
                                    <span class="font-bold text-[#4A3428]">{{ $order->total_items }} Unit</span>
                                </div>
                            </div>
                            <div class="pt-4 border-t border-[#D9B382]/20">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Pembayaran</p>
                                <p class="text-2xl md:text-3xl font-black text-[#4A3428] tracking-tighter">
                                    Rp{{ number_format($order->grand_total, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                 
                    <div class="mt-6 pt-6 border-t border-dashed border-[#D9B382]/30 flex justify-end">
                        <a href="{{ route('customer.orders.receipt', $order->id) }}"
                            class="px-8 py-3.5 bg-white border-2 border-[#4A3428] text-[#4A3428] font-black text-[10px] uppercase tracking-widest rounded-2xl hover:bg-[#4A3428] hover:text-[#D9B382] transition-all duration-300">
                            <i class="fas fa-receipt mr-2"></i> Cetak Struk
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-24 bg-white rounded-[3rem] border-2 border-dashed border-[#D9B382]/20 shadow-inner">
                <div class="w-20 h-20 bg-[#fdfaf5] rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#D9B382]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-black text-[#4A3428] mb-2">Tidak Ada Pesanan Aktif</h3>
                <p class="text-[#4A3428]/50 font-medium">Semua pesanan Anda telah selesai atau belum ada pesanan baru.</p>
                <a href="{{ url('/products') }}" class="inline-block mt-8 px-10 py-4 bg-[#4A3428] text-[#D9B382] font-black rounded-2xl uppercase tracking-widest text-xs hover:shadow-xl transition-all">Mulai Belanja</a>
            </div>
            @endforelse
        </div>

  
        <div class="mt-20 p-8 md:p-12 rounded-[3rem] bg-[#4A3428] relative overflow-hidden shadow-2xl">
            <div class="absolute inset-0 opacity-5 pointer-events-none">
                <svg width="100%" height="100%">
                    <defs>
                        <pattern id="grid" width="20" height="20" patternUnits="userSpaceOnUse">
                            <circle cx="1" cy="1" r="1" fill="#D9B382"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#grid)" />
                </svg>
            </div>

            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8 text-center md:text-left">
                <div class="max-w-2xl">
                    <div class="inline-flex items-center gap-2 px-4 py-1 bg-white/10 text-[#D9B382] rounded-full text-[10px] font-black uppercase tracking-[0.2em] mb-6">
                        Info Riwayat Pesanan
                    </div>
                    <h4 class="text-2xl md:text-4xl font-black text-white leading-tight">Mencari pesanan yang sudah selesai?</h4>
                    <p class="text-white/50 text-sm md:text-base mt-4 font-medium leading-relaxed">
                        Demi kenyamanan Anda, pesanan yang telah sampai dan berstatus <span class="text-[#D9B382]">Selesai</span> akan dipindahkan ke halaman profil. Anda dapat melihat struk lama dan riwayat belanja lengkap di sana.
                    </p>
                </div>
                <div class="shrink-0">
                    <a href="{{ route('customer.profile') }}" class="inline-flex items-center gap-4 px-10 py-5 bg-[#D9B382] text-[#4A3428] font-black rounded-[2rem] uppercase tracking-widest text-sm hover:bg-white transition-all shadow-xl hover:-translate-y-1">
                        Buka Disini
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection