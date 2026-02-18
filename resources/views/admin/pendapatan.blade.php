@extends('admin.layout')

@section('title', 'Laporan Pendapatan')

@section('content')
<div class="bg-[#fdfaf5] min-h-screen p-4 md:p-8">

   
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-8">
        <div>
            <h2 class="text-4xl font-black text-[#4A3428] tracking-tighter">Revenue Analytics</h2>
            <p class="text-[#4A3428]/50 font-medium mt-1">Analisis mendalam transaksi & pendapatan bisnis Anda.</p>
        </div>

        <div class="flex gap-3">
            <button onclick="printReport()" 
                class="flex items-center justify-center gap-2 bg-blue-600 text-white px-6 py-3.5 rounded-2xl font-black shadow-xl shadow-blue-600/20 hover:bg-blue-700 transition-all transform hover:-translate-y-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                PRINT
            </button>
            
            <a href="{{ route('pendapatan.export.excel') }}?{{ http_build_query(request()->all()) }}"
                class="flex items-center justify-center gap-2 bg-emerald-600 text-white px-6 py-3.5 rounded-2xl font-black shadow-xl shadow-emerald-600/20 hover:bg-emerald-700 transition-all transform hover:-translate-y-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                EXPORT EXCEL
            </a>
        </div>
    </div>

 
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="relative overflow-hidden bg-gradient-to-br from-[#4A3428] to-[#2D1F18] rounded-3xl p-6 shadow-2xl shadow-[#4A3428]/20">
            <div class="absolute right-0 top-0 w-32 h-32 bg-[#D9B382]/10 rounded-full -mr-10 -mt-10 blur-2xl"></div>
            <div class="relative z-10">
                <p class="text-xs font-black text-[#D9B382]/60 uppercase tracking-widest mb-2">Total Pendapatan</p>
                <h3 class="text-2xl font-black text-white mb-1">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                <p class="text-[10px] text-[#D9B382]/40 font-bold uppercase">Gross Revenue</p>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 border-2 border-emerald-200 shadow-sm hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Total Transaksi</p>
                    <h3 class="text-3xl font-black text-emerald-600">{{ $totalTransaksi }}</h3>
                </div>
                <div class="bg-emerald-50 p-4 rounded-2xl">
                    <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 border-2 border-blue-200 shadow-sm hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Produk Terjual</p>
                    <h3 class="text-3xl font-black text-blue-600">{{ $totalProdukTerjual }}</h3>
                </div>
                <div class="bg-blue-50 p-4 rounded-2xl">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 border-2 border-amber-200 shadow-sm hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Rata-rata/Transaksi</p>
                    <h3 class="text-2xl font-black text-amber-600">Rp {{ number_format($rataRataTransaksi, 0, ',', '.') }}</h3>
                </div>
                <div class="bg-amber-50 p-4 rounded-2xl">
                    <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                </div>
            </div>
        </div>
    </div>

  
  <form 
    id="filter-form"
    action="{{ route('dashboard.pendapatan') }}" 
    method="GET" 
    class="mb-8"
>
        <div class="bg-white rounded-3xl p-6 border-2 border-[#D9B382]/20 shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                
               
                <div class="relative">
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Cari Produk</label>
                    <input 
                        type="text" 
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Nama produk..."
                        class="w-full pl-11 pr-4 py-3 rounded-xl bg-[#fdfaf5] border-2 border-[#D9B382]/20 focus:border-[#4A3428] outline-none transition-all font-bold text-[#4A3428] text-sm">
                    <span class="absolute bottom-3 left-3 text-[#D9B382]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                </div>
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Dari Tanggal</label>
                    <input 
                        type="date" 
                        name="date_from"
                        value="{{ request('date_from') }}"
                        class="w-full px-4 py-3 rounded-xl bg-[#fdfaf5] border-2 border-[#D9B382]/20 focus:border-[#4A3428] outline-none transition-all font-bold text-[#4A3428] text-sm">
                </div>

               
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Sampai Tanggal</label>
                    <input 
                        type="date" 
                        name="date_to"
                        value="{{ request('date_to') }}"
                        class="w-full px-4 py-3 rounded-xl bg-[#fdfaf5] border-2 border-[#D9B382]/20 focus:border-[#4A3428] outline-none transition-all font-bold text-[#4A3428] text-sm">
                </div>

                
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Periode Cepat</label>
                    <select 
                        name="quick_filter"
                        onchange="applyQuickFilter(this.value)"
                        class="w-full px-4 py-3 rounded-xl bg-[#fdfaf5] border-2 border-[#D9B382]/20 focus:border-[#4A3428] outline-none transition-all font-bold text-[#4A3428] text-sm">
                        <option value="">Pilih Periode</option>
                        <option value="today">Hari Ini</option>
                        <option value="yesterday">Kemarin</option>
                        <option value="this_week">Minggu Ini</option>
                        <option value="this_month">Bulan Ini</option>
                        <option value="last_month">Bulan Lalu</option>
                        <option value="this_year">Tahun Ini</option>
                    </select>
                </div>

               
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Urutkan</label>
                    <select 
                        name="sort_by"
                        class="w-full px-4 py-3 rounded-xl bg-[#fdfaf5] border-2 border-[#D9B382]/20 focus:border-[#4A3428] outline-none transition-all font-bold text-[#4A3428] text-sm">
                        <option value="highest_revenue" {{ request('sort_by') == 'highest_revenue' ? 'selected' : '' }}>Pendapatan Tertinggi</option>
                        <option value="lowest_revenue" {{ request('sort_by') == 'lowest_revenue' ? 'selected' : '' }}>Pendapatan Terendah</option>
                        <option value="most_sold" {{ request('sort_by') == 'most_sold' ? 'selected' : '' }}>Paling Banyak Terjual</option>
                        <option value="least_sold" {{ request('sort_by') == 'least_sold' ? 'selected' : '' }}>Paling Sedikit Terjual</option>
                    </select>
                </div>
            </div>

           
            <div class="flex gap-3 mt-4 pt-4 border-t border-gray-100">
                <button 
                    type="submit"
                    class="flex items-center gap-2 bg-[#4A3428] text-[#D9B382] px-6 py-2.5 rounded-xl font-black text-sm hover:bg-[#3D2B21] transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    TERAPKAN FILTER
                </button>
                
                <a 
                    href="{{ route('dashboard.pendapatan') }}"
                    class="flex items-center gap-2 bg-gray-100 text-gray-600 px-6 py-2.5 rounded-xl font-black text-sm hover:bg-gray-200 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    RESET
                </a>

                {{-- Period Info --}}
                @if(request('date_from') || request('date_to'))
                <div class="ml-auto flex items-center gap-2 text-sm">
                    <span class="text-gray-400 font-medium">Periode:</span>
                    <span class="bg-[#D9B382]/20 text-[#4A3428] px-3 py-1 rounded-lg font-bold">
                        {{ request('date_from') ? date('d M Y', strtotime(request('date_from'))) : 'Awal' }} - 
                        {{ request('date_to') ? date('d M Y', strtotime(request('date_to'))) : 'Sekarang' }}
                    </span>
                </div>
                @endif
            </div>
        </div>
    </form>

    @if(count($pendapatan) > 0)

    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        @foreach($topProducts as $index => $product)
        <div class="bg-white rounded-3xl p-6 border-2 border-gray-100 shadow-sm hover:shadow-lg transition-all">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[#4A3428] to-[#2D1F18] flex items-center justify-center text-[#D9B382] font-black text-lg shadow-lg">
                        #{{ $index + 1 }}
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Top Seller</p>
                        <p class="text-sm font-black text-[#4A3428] uppercase">{{ Str::limit($product->nama_produk, 15) }}</p>
                    </div>
                </div>
                @if($index == 0)
                <span class="px-2 py-1 bg-amber-100 text-amber-600 text-[8px] font-black rounded-lg uppercase">Best</span>
                @endif
            </div>
            <div class="space-y-2">
                <div class="flex justify-between items-center">
                    <span class="text-xs text-gray-400 font-bold">Terjual:</span>
                    <span class="text-sm font-black text-[#4A3428]">{{ $product->total_terjual }} unit</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-xs text-gray-400 font-bold">Revenue:</span>
                    <span class="text-sm font-black text-emerald-600">Rp {{ number_format($product->total_pendapatan, 0, ',', '.') }}</span>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <div class="flex items-center gap-2">
                    <div class="flex-1 bg-gray-100 rounded-full h-2 overflow-hidden">
                        <div class="bg-gradient-to-r from-[#4A3428] to-[#D9B382] h-full rounded-full" style="width: {{ ($product->total_pendapatan / $totalPendapatan) * 100 }}%"></div>
                    </div>
                    <span class="text-[10px] font-black text-[#4A3428]">{{ number_format(($product->total_pendapatan / $totalPendapatan) * 100, 1) }}%</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

   
    <div id="printable-area" class="bg-white rounded-[2.5rem] shadow-2xl shadow-black/[0.03] border border-white overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-[#4A3428] text-[#D9B382]">
                        <th class="py-6 px-6 text-left text-[10px] font-black uppercase tracking-[0.2em]">No.</th>
                        <th class="py-6 px-6 text-left text-[10px] font-black uppercase tracking-[0.2em]">Produk</th>
                        <th class="py-6 px-6 text-center text-[10px] font-black uppercase tracking-[0.2em]">Jumlah</th>
                        <th class="py-6 px-6 text-right text-[10px] font-black uppercase tracking-[0.2em]">Harga Satuan</th>
                        <th class="py-6 px-6 text-right text-[10px] font-black uppercase tracking-[0.2em]">Total</th>
                        <th class="py-6 px-6 text-center text-[10px] font-black uppercase tracking-[0.2em]">% Kontribusi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($pendapatan as $index => $item)
                    <tr class="hover:bg-[#F8F5F2]/50 transition-colors group">
                        <td class="py-6 px-6">
                            <span class="text-sm font-black text-[#4A3428]">{{ $index + 1 }}</span>
                        </td>
                        <td class="py-6 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-[#4A3428] flex items-center justify-center text-[#D9B382] font-black text-xs uppercase shadow-lg">
                                    {{ substr($item->nama_produk, 0, 2) }}
                                </div>
                                <div>
                                    <div class="font-bold text-[#4A3428] text-sm uppercase tracking-tight">{{ $item->nama_produk }}</div>
                                    <div class="text-[10px] text-[#D9B382] font-black mt-0.5 tracking-[0.1em]">Premium Item</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-6 px-6 text-center">
                            <span class="inline-flex items-center justify-center min-w-[3rem] px-3 py-2 rounded-xl bg-blue-50 text-blue-600 font-black text-sm border border-blue-100">
                                {{ $item->jumlah }}
                            </span>
                        </td>
                        <td class="py-6 px-6 text-right">
                            <span class="text-[#4A3428]/60 font-bold text-xs">
                                Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="py-6 px-6 text-right">
                            <span class="text-[#4A3428] font-black text-sm tracking-tighter">
                                Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="py-6 px-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <div class="w-16 bg-gray-100 rounded-full h-2 overflow-hidden">
                                    <div class="bg-emerald-500 h-full rounded-full" style="width: {{ ($item->total_harga / $totalPendapatan) * 100 }}%"></div>
                                </div>
                                <span class="text-xs font-black text-emerald-600">
                                    {{ number_format(($item->total_harga / $totalPendapatan) * 100, 1) }}%
                                </span>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-[#F8F5F2] border-t-2 border-[#4A3428]">
                        <td colspan="4" class="py-6 px-6 text-right">
                            <span class="text-sm font-black text-[#4A3428] uppercase tracking-widest">TOTAL PENDAPATAN:</span>
                        </td>
                        <td class="py-6 px-6 text-right">
                            <span class="text-xl font-black text-[#4A3428]">
                                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="py-6 px-6 text-center">
                            <span class="text-sm font-black text-emerald-600">100%</span>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        

    @else
  
    <div class="bg-white rounded-[3rem] shadow-2xl shadow-black/[0.03] p-20 text-center border border-white">
        <div class="w-24 h-24 bg-[#F8F5F2] rounded-full flex items-center justify-center mx-auto mb-8 border border-gray-50">
            <svg class="w-10 h-10 text-[#D9B382]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <h3 class="text-[#4A3428] font-black text-xl uppercase tracking-tighter">Belum Ada Data Pendapatan</h3>
        <p class="text-[#4A3428]/40 text-xs font-bold mt-2 uppercase tracking-widest">
            @if(request('date_from') || request('date_to') || request('search'))
                Tidak ada transaksi dengan filter yang dipilih
            @else
                Data pendapatan akan muncul setelah transaksi diselesaikan
            @endif
        </p>
        @if(request()->hasAny(['date_from', 'date_to', 'search', 'sort_by']))
        <a href="{{ route('dashboard.pendapatan') }}" class="inline-block mt-6 px-6 py-3 bg-[#4A3428] text-[#D9B382] rounded-xl font-black text-sm hover:bg-[#3D2B21] transition">
            RESET FILTER
        </a>
        @endif
    </div>
    @endif

</div>

{{-- Print Styles --}}
<style>
@media print {
    body * {
        visibility: hidden;
    }
    #printable-area, #printable-area * {
        visibility: visible;
    }
    #printable-area {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }
    .no-print {
        display: none !important;
    }
}
</style>

{{-- JavaScript --}}
<script>
function applyQuickFilter(value) {
    if (!value) return;
    
    const today = new Date();
    let dateFrom = '';
    let dateTo = today.toISOString().split('T')[0];
    
    switch(value) {
        case 'today':
            dateFrom = dateTo;
            break;
        case 'yesterday':
            const yesterday = new Date(today);
            yesterday.setDate(yesterday.getDate() - 1);
            dateFrom = yesterday.toISOString().split('T')[0];
            dateTo = dateFrom;
            break;
        case 'this_week':
            const weekStart = new Date(today);
            weekStart.setDate(today.getDate() - today.getDay());
            dateFrom = weekStart.toISOString().split('T')[0];
            break;
        case 'this_month':
            dateFrom = new Date(today.getFullYear(), today.getMonth(), 1).toISOString().split('T')[0];
            break;
        case 'last_month':
            const lastMonth = new Date(today.getFullYear(), today.getMonth() - 1, 1);
            const lastMonthEnd = new Date(today.getFullYear(), today.getMonth(), 0);
            dateFrom = lastMonth.toISOString().split('T')[0];
            dateTo = lastMonthEnd.toISOString().split('T')[0];
            break;
        case 'this_year':
            dateFrom = new Date(today.getFullYear(), 0, 1).toISOString().split('T')[0];
            break;
    }
    
    document.querySelector('input[name="date_from"]').value = dateFrom;
    document.querySelector('input[name="date_to"]').value = dateTo;
    document.getElementById('filter-form').submit();
}

function printReport() {
    window.print();
}
</script>
@endsection