@extends('admin.layout')

@section('title', 'Riwayat Pesanan')

@section('content')
<div class="bg-[#fdfaf5] min-h-screen p-4 md:p-8">

   
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-8">
        <div>
            <h2 class="text-4xl font-black text-gray-500 tracking-tighter">Riwayat Pesanan</h2>
            <p class="text-gray-400 font-medium mt-1">Arsip pesanan yang telah selesai dan dibatalkan.</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard.pesanan') }}" 
                class="flex items-center justify-center gap-2 bg-[#4A3428] text-[#D9B382] px-6 py-3.5 rounded-2xl font-black shadow-xl shadow-[#4A3428]/20 hover:bg-[#3D2B21] transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
                </svg>
                PESANAN AKTIF
            </a>
        </div>
    </div>

 
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-3xl p-6 border-2 border-gray-200 shadow-sm hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Total Riwayat</p>
                    <h3 class="text-3xl font-black text-gray-600">{{ $total_riwayat }}</h3>
                </div>
                <div class="bg-gray-100 p-4 rounded-2xl">
                    <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 border-2 border-emerald-200 shadow-sm hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Pesanan Selesai</p>
                    <h3 class="text-3xl font-black text-emerald-600">{{ $total_selesai }}</h3>
                </div>
                <div class="bg-emerald-50 p-4 rounded-2xl">
                    <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 border-2 border-red-200 shadow-sm hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Dibatalkan</p>
                    <h3 class="text-3xl font-black text-red-500">{{ $total_dibatalkan }}</h3>
                </div>
                <div class="bg-red-50 p-4 rounded-2xl">
                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 border-2 border-gray-200 shadow-sm hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Total Pendapatan</p>
                    <h3 class="text-2xl font-black text-gray-600">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</h3>
                </div>
                <div class="bg-gray-100 p-4 rounded-2xl">
                    <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

   
    <form action="{{ route('dashboard.pesanan.riwayat') }}" method="GET" class="mb-8">
        <div class="bg-white rounded-3xl p-6 border-2 border-gray-200 shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                
                {
                <div class="relative">
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Cari Pesanan</label>
                    <input 
                        type="text" 
                        name="keyword"
                        value="{{ request('keyword') }}"
                        placeholder="Nama pemesan atau produk..."
                        class="w-full pl-11 pr-4 py-3 rounded-xl bg-gray-50 border-2 border-gray-200 focus:border-gray-400 outline-none transition-all font-bold text-gray-700 text-sm">
                    <span class="absolute bottom-3 left-3 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </span>
                </div>

                
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Status</label>
                    <select 
                        name="status_filter"
                        class="w-full px-4 py-3 rounded-xl bg-gray-50 border-2 border-gray-200 focus:border-gray-400 outline-none transition-all font-bold text-gray-700 text-sm">
                        <option value="">Semua Status</option>
                        <option value="selesai" {{ request('status_filter') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="dibatalkan" {{ request('status_filter') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>

               
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Metode Pembayaran</label>
                    <select 
                        name="metode_filter"
                        class="w-full px-4 py-3 rounded-xl bg-gray-50 border-2 border-gray-200 focus:border-gray-400 outline-none transition-all font-bold text-gray-700 text-sm">
                        <option value="">Semua Metode</option>
                        @foreach($metode_pembayaran as $metode)
                            <option value="{{ $metode->metode_pembayaran }}" {{ request('metode_filter') == $metode->metode_pembayaran ? 'selected' : '' }}>
                                {{ ucfirst($metode->metode_pembayaran) }}
                            </option>
                        @endforeach
                    </select>
                </div>

              
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Produk</label>
                    <select 
                        name="product_filter"
                        class="w-full px-4 py-3 rounded-xl bg-gray-50 border-2 border-gray-200 focus:border-gray-400 outline-none transition-all font-bold text-gray-700 text-sm">
                        <option value="">Semua Produk</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ request('product_filter') == $product->id ? 'selected' : '' }}>
                                {{ $product->nama_produk }}
                            </option>
                        @endforeach
                    </select>
                </div>

              
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Periode</label>
                    <select 
                        name="date_filter"
                        class="w-full px-4 py-3 rounded-xl bg-gray-50 border-2 border-gray-200 focus:border-gray-400 outline-none transition-all font-bold text-gray-700 text-sm">
                        <option value="">Semua Periode</option>
                        <option value="hari_ini" {{ request('date_filter') == 'hari_ini' ? 'selected' : '' }}>Hari Ini</option>
                        <option value="minggu_ini" {{ request('date_filter') == 'minggu_ini' ? 'selected' : '' }}>Minggu Ini</option>
                        <option value="bulan_ini" {{ request('date_filter') == 'bulan_ini' ? 'selected' : '' }}>Bulan Ini</option>
                        <option value="bulan_lalu" {{ request('date_filter') == 'bulan_lalu' ? 'selected' : '' }}>Bulan Lalu</option>
                        <option value="3_bulan" {{ request('date_filter') == '3_bulan' ? 'selected' : '' }}>3 Bulan Terakhir</option>
                        <option value="6_bulan" {{ request('date_filter') == '6_bulan' ? 'selected' : '' }}>6 Bulan Terakhir</option>
                    </select>
                </div>
            </div>

          
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4 pt-4 border-t border-gray-100">
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Tanggal Mulai</label>
                    <input 
                        type="date" 
                        name="tanggal_mulai"
                        value="{{ request('tanggal_mulai') }}"
                        class="w-full px-4 py-3 rounded-xl bg-gray-50 border-2 border-gray-200 focus:border-gray-400 outline-none transition-all font-bold text-gray-700 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Tanggal Akhir</label>
                    <input 
                        type="date" 
                        name="tanggal_akhir"
                        value="{{ request('tanggal_akhir') }}"
                        class="w-full px-4 py-3 rounded-xl bg-gray-50 border-2 border-gray-200 focus:border-gray-400 outline-none transition-all font-bold text-gray-700 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Urutkan</label>
                    <select 
                        name="sort_by"
                        class="w-full px-4 py-3 rounded-xl bg-gray-50 border-2 border-gray-200 focus:border-gray-400 outline-none transition-all font-bold text-gray-700 text-sm">
                        <option value="terbaru" {{ request('sort_by') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                        <option value="terlama" {{ request('sort_by') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                        <option value="nama_az" {{ request('sort_by') == 'nama_az' ? 'selected' : '' }}>Nama (A-Z)</option>
                        <option value="nama_za" {{ request('sort_by') == 'nama_za' ? 'selected' : '' }}>Nama (Z-A)</option>
                        <option value="total_tertinggi" {{ request('sort_by') == 'total_tertinggi' ? 'selected' : '' }}>Total Tertinggi</option>
                        <option value="total_terendah" {{ request('sort_by') == 'total_terendah' ? 'selected' : '' }}>Total Terendah</option>
                    </select>
                </div>
            </div>

         
            <div class="flex gap-3 mt-4 pt-4 border-t border-gray-100">
                <button 
                    type="submit"
                    class="flex items-center gap-2 bg-gray-700 text-white px-6 py-2.5 rounded-xl font-black text-sm hover:bg-gray-800 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                    </svg>
                    TERAPKAN FILTER
                </button>
                
                <a 
                    href="{{ route('dashboard.pesanan.riwayat') }}"
                    class="flex items-center gap-2 bg-gray-100 text-gray-600 px-6 py-2.5 rounded-xl font-black text-sm hover:bg-gray-200 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    RESET
                </a>

               
                @if(request('keyword') || request('status_filter') || request('metode_filter') || request('date_filter') || request('sort_by') || request('tanggal_mulai') || request('tanggal_akhir') || request('product_filter'))
                <div class="ml-auto flex items-center gap-2 text-sm">
                    <span class="text-gray-400 font-medium">Filter aktif:</span>
                    <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-lg font-bold">
                        {{ collect([request('keyword'), request('status_filter'), request('metode_filter'), request('date_filter'), request('sort_by'), request('tanggal_mulai'), request('tanggal_akhir'), request('product_filter')])->filter()->count() }}
                    </span>
                </div>
                @endif
            </div>
        </div>
    </form>

 
    @if($produk_terlaris->count() > 0)
    <div class="bg-white rounded-3xl p-6 border-2 border-gray-200 shadow-sm mb-8">
        <h3 class="text-xl font-black text-gray-600 mb-4 flex items-center gap-2">
            <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            Top 5 Produk Terlaris
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            @foreach($produk_terlaris as $index => $produk)
            <div class="bg-gray-50 rounded-2xl p-4 border border-gray-200">
                <div class="flex items-center gap-2 mb-2">
                    <span class="w-8 h-8 bg-gray-200 text-gray-700 rounded-full flex items-center justify-center font-black text-sm">
                        {{ $index + 1 }}
                    </span>
                    <h4 class="font-bold text-gray-700 text-sm truncate">{{ $produk->nama_produk }}</h4>
                </div>
                <div class="text-xs text-gray-500 space-y-1">
                    <p><span class="font-bold">Terjual:</span> {{ $produk->total_terjual }} pcs</p>
                    <p><span class="font-bold">Pendapatan:</span> Rp {{ number_format($produk->total_pendapatan, 0, ',', '.') }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif


    <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-black/[0.03] border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-gray-600 text-gray-200">
                        <th class="py-6 px-6 text-left text-[10px] font-black uppercase tracking-[0.2em] whitespace-nowrap">No.</th>
                        <th class="py-6 px-6 text-left text-[10px] font-black uppercase tracking-[0.2em] whitespace-nowrap">Pelanggan</th>
                        <th class="py-6 px-6 text-left text-[10px] font-black uppercase tracking-[0.2em] min-w-[250px]">Produk</th>
                        <th class="py-6 px-6 text-center text-[10px] font-black uppercase tracking-[0.2em] whitespace-nowrap">Qty</th>
                        <th class="py-6 px-6 text-right text-[10px] font-black uppercase tracking-[0.2em] whitespace-nowrap">Total</th>
                        <th class="py-6 px-6 text-center text-[10px] font-black uppercase tracking-[0.2em] whitespace-nowrap">Status</th>
                        <th class="py-6 px-6 text-center text-[10px] font-black uppercase tracking-[0.2em] whitespace-nowrap">Pembayaran</th>
                        <th class="py-6 px-6 text-center text-[10px] font-black uppercase tracking-[0.2em] whitespace-nowrap">Bukti TF</th>
                        <th class="py-6 px-6 text-center text-[10px] font-black uppercase tracking-[0.2em] whitespace-nowrap">Tanggal</th>
                        <th class="py-6 px-6 text-center text-[10px] font-black uppercase tracking-[0.2em] whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($orders as $index => $order)
                    <tr class="hover:bg-gray-50 transition-colors group opacity-60">
                        {{-- NO --}}
                        <td class="py-6 px-6 whitespace-nowrap">
                            <span class="text-sm font-black text-gray-500">{{ ($orders->currentPage() - 1) * $orders->perPage() + $index + 1 }}</span>
                        </td>

                        
                        <td class="py-6 px-6 whitespace-nowrap">
                            <div class="font-bold text-gray-600 text-sm uppercase tracking-tight">{{ $order->nama_pemesan }}</div>
                            <div class="text-[10px] text-gray-400 font-bold mt-1 tracking-wider">{{ $order->no_hp }}</div>
                            <div class="text-[10px] text-gray-400 italic max-w-[200px] truncate mt-0.5" title="{{ $order->alamat }}">{{ $order->alamat }}</div>
                        </td>

                        <td class="py-6 px-6">
                            <div class="flex items-start gap-3">
                                <div class="w-1 self-stretch bg-gray-300 rounded-full min-h-[40px]"></div>
                                <div class="w-full">
                                    @if($order->items)
                                        @foreach(explode(', ', $order->items) as $item)
                                            <div class="font-bold text-gray-600 text-sm italic py-1 border-b border-dashed border-gray-200 last:border-0">
                                                {{ $item }}
                                            </div>
                                        @endforeach
                                    @else
                                        <span class="text-gray-400 italic text-xs">-</span>
                                    @endif
                                </div>
                            </div>
                        </td>

                        
                        <td class="py-6 px-6 text-center whitespace-nowrap">
                            <span class="inline-block px-3 py-1 bg-gray-100 rounded-lg font-black text-gray-600 text-xs shadow-inner">
                                {{ $order->total_qty ?? 0 }}
                            </span>
                        </td>

                        
                        <td class="py-6 px-6 text-right text-sm whitespace-nowrap">
                            <div class="text-gray-400 text-[10px] font-bold tracking-widest uppercase">Total</div>
                            <div class="font-black text-gray-600 tracking-tighter text-lg">
                                Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                            </div>
                        </td>

                       
                        <td class="py-6 px-6 text-center whitespace-nowrap">
                            @if($order->status == 'selesai')
                                <span class="px-4 py-2 rounded-xl bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest border border-emerald-200 shadow-sm block">
                                    ✓ Selesai
                                </span>
                            @elseif($order->status == 'dibatalkan')
                                <span class="px-4 py-2 rounded-xl bg-red-50 text-red-600 text-[10px] font-black uppercase tracking-widest border border-red-200 shadow-sm block">
                                    ✗ Dibatalkan
                                </span>
                            @endif
                        </td>

                       
                        <td class="py-6 px-6 text-center whitespace-nowrap">
                            <span class="inline-block px-3 py-1 bg-gray-100 rounded-lg font-black text-gray-600 text-xs shadow-inner">
                                {{ ucfirst($order->metode_pembayaran) }}
                            </span>
                        </td>

                      
                        <td class="py-6 px-6 text-center whitespace-nowrap">
                            @if($order->bukti_transfer)
                                <a href="{{ asset($order->bukti_transfer) }}"
                                   target="_blank"
                                   class="inline-flex items-center gap-2 px-3 py-2 bg-gray-100 text-gray-600 text-xs font-black rounded-xl hover:bg-gray-200 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Lihat
                                </a>
                            @else
                                <span class="text-[10px] text-gray-400 italic">Tidak ada</span>
                            @endif
                        </td>

                       
                        <td class="py-6 px-6 text-center whitespace-nowrap">
                            <div class="text-[10px] text-gray-400 font-black uppercase tracking-widest">
                                {{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}
                            </div>
                            <div class="text-xs font-bold text-gray-500 mt-1">
                                {{ \Carbon\Carbon::parse($order->created_at)->format('H:i') }} WIB
                            </div>
                        </td>

                        
                        <td class="py-6 px-6 whitespace-nowrap">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('orders.receipt', $order->id) }}"
                                   target="_blank"
                                   class="p-3 bg-gray-100 border border-gray-200 text-gray-600 rounded-xl hover:bg-gray-200 transition-all shadow-sm" 
                                   title="Lihat Nota">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </a>

                                <button type="button" onclick="confirmDelete({{ $order->id }})"
                                        class="p-3 bg-gray-100 border border-gray-200 text-gray-500 rounded-xl hover:bg-red-100 hover:text-red-600 hover:border-red-200 transition-all shadow-sm" 
                                        title="Hapus Riwayat">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>

                                <form id="delete-form-{{ $order->id }}" action="{{ route('dashboard.pesanan.destroy', $order->id) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="py-16 px-6 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <p class="text-gray-500 font-black uppercase tracking-widest text-sm italic">Belum ada riwayat pesanan</p>
                                <p class="text-gray-400 text-xs mt-2">Pesanan yang selesai atau dibatalkan akan muncul di sini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

     
        @if($orders->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between">
            <div class="text-sm text-gray-600 font-bold">
                Menampilkan <span class="text-gray-700 font-black">{{ $orders->firstItem() }}</span> hingga <span class="text-gray-700 font-black">{{ $orders->lastItem() }}</span> dari <span class="text-gray-700 font-black">{{ $orders->total() }}</span> riwayat
            </div>
            <div class="flex gap-2">
                {{ $orders->links('pagination::tailwind') }}
            </div>
        </div>
        @endif
    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        timer: 3000,
        timerProgressBar: true,
        showConfirmButton: false,
        background: '#fff',
        color: '#4A3428',
        customClass: {
            popup: 'rounded-3xl',
            title: 'font-black text-2xl',
            htmlContainer: 'font-bold'
        }
    });
@endif


function confirmDelete(orderId) {
    Swal.fire({
        title: 'Hapus Riwayat?',
        text: "Data riwayat akan dihapus secara permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#6b7280',
        cancelButtonColor: '#9ca3af',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        background: '#fff',
        color: '#4A3428',
        customClass: {
            popup: 'rounded-3xl',
            title: 'font-black text-2xl',
            htmlContainer: 'font-bold',
            confirmButton: 'font-black px-6 py-3 rounded-xl',
            cancelButton: 'font-black px-6 py-3 rounded-xl'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(`delete-form-${orderId}`).submit();
        }
    });
}
</script>
@endsection