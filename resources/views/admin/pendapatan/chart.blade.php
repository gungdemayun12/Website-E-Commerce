@extends('admin.layout')

@section('title', 'Grafik Pendapatan')

@section('content')
<div class="bg-[#fdfaf5] min-h-screen p-4 md:p-8">


    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-8">
        <div>
            <h2 class="text-4xl font-black text-[#4A3428] tracking-tighter">Revenue Chart Analytics</h2>
            <p class="text-[#4A3428]/50 font-medium mt-1">Visualisasi tren pendapatan harian dalam bentuk grafik interaktif.</p>
        </div>

        <div class="flex gap-3">
            <button onclick="printChart()" 
                class="flex items-center justify-center gap-2 bg-blue-600 text-white px-6 py-3.5 rounded-2xl font-black shadow-xl shadow-blue-600/20 hover:bg-blue-700 transition-all transform hover:-translate-y-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                PRINT
            </button>
            
            <button onclick="downloadChart()" 
                class="flex items-center justify-center gap-2 bg-emerald-600 text-white px-6 py-3.5 rounded-2xl font-black shadow-xl shadow-emerald-600/20 hover:bg-emerald-700 transition-all transform hover:-translate-y-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                DOWNLOAD PNG
            </button>

            <a href="{{ route('dashboard.pendapatan') }}" 
                class="flex items-center justify-center gap-2 bg-[#4A3428] text-[#D9B382] px-6 py-3.5 rounded-2xl font-black shadow-xl shadow-[#4A3428]/20 hover:bg-[#3D2B21] transition-all transform hover:-translate-y-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 00-2-2m0 0h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                LAPORAN TABEL
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

    
    <form id="filter-form" action="{{ route('dashboard.pendapatan.chart') }}" method="GET" class="mb-8">
        <div class="bg-white rounded-3xl p-6 border-2 border-[#D9B382]/20 shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                
                {{-- Search Product --}}
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
                        <option value="7days">7 Hari Terakhir</option>
                        <option value="30days">30 Hari Terakhir</option>
                        <option value="this_week">Minggu Ini</option>
                        <option value="this_month">Bulan Ini</option>
                        <option value="last_month">Bulan Lalu</option>
                        <option value="this_year">Tahun Ini</option>
                    </select>
                </div>

               
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Jenis Grafik</label>
                    <select 
                        id="chartType"
                        onchange="updateChartType(this.value)"
                        class="w-full px-4 py-3 rounded-xl bg-[#fdfaf5] border-2 border-[#D9B382]/20 focus:border-[#4A3428] outline-none transition-all font-bold text-[#4A3428] text-sm">
                        <option value="line">Garis (Line)</option>
                        <option value="bar">Batang (Bar)</option>
                        <option value="radar">Radar</option>
                        <option value="doughnut">Donat (Doughnut)</option>
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
                    href="{{ route('dashboard.pendapatan.chart') }}"
                    class="flex items-center gap-2 bg-gray-100 text-gray-600 px-6 py-2.5 rounded-xl font-black text-sm hover:bg-gray-200 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    RESET
                </a>

             
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

    @if(count($labels) > 0)

    
    <div id="printable-chart" class="bg-white rounded-[2.5rem] p-8 shadow-2xl shadow-black/[0.03] border border-white mb-8">
        <div class="flex items-center justify-between mb-6 flex-wrap gap-4">
            <div>
                <h3 class="text-2xl font-black text-[#4A3428] tracking-tighter">Grafik Tren Pendapatan</h3>
                <p class="text-xs text-[#4A3428]/50 font-bold mt-1 uppercase tracking-widest">Performa pendapatan harian</p>
            </div>
            <div class="flex gap-2 flex-wrap">
                <button onclick="toggleDataset(0)" id="toggle-0" class="px-4 py-2 bg-blue-100 text-blue-600 rounded-xl text-xs font-black hover:bg-blue-200 transition-all">
                    <span class="inline-block w-3 h-3 bg-blue-600 rounded-full mr-2"></span>Pendapatan
                </button>
                <button onclick="toggleDataset(1)" id="toggle-1" class="px-4 py-2 bg-emerald-100 text-emerald-600 rounded-xl text-xs font-black hover:bg-emerald-200 transition-all">
                    <span class="inline-block w-3 h-3 bg-emerald-600 rounded-full mr-2"></span>Transaksi
                </button>
                <button onclick="toggleDataset(2)" id="toggle-2" class="px-4 py-2 bg-amber-100 text-amber-600 rounded-xl text-xs font-black hover:bg-amber-200 transition-all">
                    <span class="inline-block w-3 h-3 bg-amber-600 rounded-full mr-2"></span>Produk
                </button>
            </div>
        </div>
        <div class="relative" style="height: 450px;">
            <canvas id="pendapatanChart"></canvas>
        </div>
    </div>

   
    @if(count($topDays) > 0)
    <div class="mb-8">
        <h3 class="text-2xl font-black text-[#4A3428] mb-4 tracking-tighter">Top 5 Hari Terbaik</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
            @foreach($topDays as $index => $day)
            <div class="bg-white rounded-2xl p-5 border-2 border-gray-100 shadow-sm hover:shadow-lg transition-all">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#4A3428] to-[#2D1F18] flex items-center justify-center text-[#D9B382] font-black text-sm shadow-lg">
                        #{{ $index + 1 }}
                    </div>
                    <div>
                        <p class="text-xs font-black text-[#4A3428]">{{ \Carbon\Carbon::parse($day->tanggal)->format('d M Y') }}</p>
                        <p class="text-[9px] text-gray-400 font-bold">{{ \Carbon\Carbon::parse($day->tanggal)->locale('id')->isoFormat('dddd') }}</p>
                    </div>
                </div>
                <div class="space-y-2">
                    <div>
                        <p class="text-[9px] text-gray-400 font-bold uppercase tracking-wider">Pendapatan</p>
                        <p class="text-lg font-black text-emerald-600">Rp {{ number_format($day->total, 0, ',', '.') }}</p>
                    </div>
                    <div class="flex justify-between text-xs">
                        <div>
                            <p class="text-[9px] text-gray-400 font-bold">Transaksi</p>
                            <p class="font-black text-[#4A3428]">{{ $day->transaksi }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] text-gray-400 font-bold">Produk</p>
                            <p class="font-black text-[#4A3428]">{{ $day->produk_terjual }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    
    @if(count($produkStats) > 0)
    <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-black/[0.03] border border-white overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-2xl font-black text-[#4A3428] tracking-tighter">Statistik Produk</h3>
            <p class="text-xs text-[#4A3428]/50 font-bold mt-1 uppercase tracking-widest">Detail performa setiap produk</p>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-[#4A3428] text-[#D9B382]">
                        <th class="py-5 px-6 text-left text-[10px] font-black uppercase tracking-[0.2em]">No.</th>
                        <th class="py-5 px-6 text-left text-[10px] font-black uppercase tracking-[0.2em]">Produk</th>
                        <th class="py-5 px-6 text-center text-[10px] font-black uppercase tracking-[0.2em]">Terjual</th>
                        <th class="py-5 px-6 text-center text-[10px] font-black uppercase tracking-[0.2em]">Transaksi</th>
                        <th class="py-5 px-6 text-right text-[10px] font-black uppercase tracking-[0.2em]">Pendapatan</th>
                        <th class="py-5 px-6 text-center text-[10px] font-black uppercase tracking-[0.2em]">% Share</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($produkStats as $index => $produk)
                    <tr class="hover:bg-[#F8F5F2]/50 transition-colors">
                        <td class="py-5 px-6">
                            <span class="text-sm font-black text-[#4A3428]">{{ $index + 1 }}</span>
                        </td>
                        <td class="py-5 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-[#4A3428] flex items-center justify-center text-[#D9B382] font-black text-xs uppercase shadow-lg">
                                    {{ substr($produk->nama_produk, 0, 2) }}
                                </div>
                                <div>
                                    <div class="font-bold text-[#4A3428] text-sm uppercase tracking-tight">{{ $produk->nama_produk }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-5 px-6 text-center">
                            <span class="inline-flex items-center justify-center px-3 py-1.5 rounded-lg bg-blue-50 text-blue-600 font-black text-sm">
                                {{ $produk->total_terjual }}
                            </span>
                        </td>
                        <td class="py-5 px-6 text-center">
                            <span class="inline-flex items-center justify-center px-3 py-1.5 rounded-lg bg-purple-50 text-purple-600 font-black text-sm">
                                {{ $produk->jumlah_transaksi }}
                            </span>
                        </td>
                        <td class="py-5 px-6 text-right">
                            <span class="text-[#4A3428] font-black text-sm">
                                Rp {{ number_format($produk->total_pendapatan, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="py-5 px-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <div class="w-16 bg-gray-100 rounded-full h-2 overflow-hidden">
                                    <div class="bg-emerald-500 h-full rounded-full" style="width: {{ $totalPendapatan > 0 ? ($produk->total_pendapatan / $totalPendapatan) * 100 : 0 }}%"></div>
                                </div>
                                <span class="text-xs font-black text-emerald-600">
                                    {{ $totalPendapatan > 0 ? number_format(($produk->total_pendapatan / $totalPendapatan) * 100, 1) : 0 }}%
                                </span>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    @else
  
    <div class="bg-white rounded-[3rem] shadow-2xl shadow-black/[0.03] p-20 text-center border border-white">
        <div class="w-24 h-24 bg-[#F8F5F2] rounded-full flex items-center justify-center mx-auto mb-8 border border-gray-50">
            <svg class="w-10 h-10 text-[#D9B382]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
        </div>
        <h3 class="text-[#4A3428] font-black text-xl uppercase tracking-tighter">Belum Ada Data untuk Grafik</h3>
        <p class="text-[#4A3428]/40 text-xs font-bold mt-2 uppercase tracking-widest">
            @if(request('date_from') || request('date_to') || request('search'))
                Tidak ada transaksi dengan filter yang dipilih
            @else
                Data grafik akan muncul setelah ada transaksi
            @endif
        </p>
        @if(request()->hasAny(['date_from', 'date_to', 'search']))
        <a href="{{ route('dashboard.pendapatan.chart') }}" class="inline-block mt-6 px-6 py-3 bg-[#4A3428] text-[#D9B382] rounded-xl font-black text-sm hover:bg-[#3D2B21] transition">
            RESET FILTER
        </a>
        @endif
    </div>
    @endif

</div>


<style>
@media print {
    body * {
        visibility: hidden;
    }
    #printable-chart, #printable-chart * {
        visibility: visible;
    }
    #printable-chart {
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('pendapatanChart');
let pendapatanChart;


const labels = {!! json_encode($labels) !!};
const totals = {!! json_encode($totals) !!}.map(Number);
const transaksiPerHari = {!! json_encode($transaksiPerHari) !!}.map(Number);
const produkPerHari = {!! json_encode($produkPerHari) !!}.map(Number);


console.log('totals:', totals);
console.log('type totals[0]:', typeof totals[0]);


function initChart(type = 'line') {
    if (pendapatanChart) {
        pendapatanChart.destroy();
    }

    
    let config;
    
    if (type === 'radar') {
        config = {
            type: 'radar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Pendapatan (Rp)',
                        data: totals,
                        borderColor: 'rgba(59, 130, 246, 1)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: false,
                        showLine: labels.length > 1,
                        pointRadius: 6,
                        pointHoverRadius: 8,
                        pointBackgroundColor: 'rgba(59, 130, 246, 1)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        yAxisID: 'y'
                    },
                    {
                        label: 'Transaksi',
                        data: transaksiPerHari,
                        borderColor: 'rgba(16, 185, 129, 1)',
                        backgroundColor: 'rgba(16, 185, 129, 0.2)',
                        borderWidth: 2,
                        pointBackgroundColor: 'rgba(16, 185, 129, 1)',
                        pointBorderColor: '#fff',
                        pointRadius: 4
                    },
                    {
                        label: 'Produk',
                        data: produkPerHari,
                        borderColor: 'rgba(245, 158, 11, 1)',
                        backgroundColor: 'rgba(245, 158, 11, 0.2)',
                        borderWidth: 2,
                        pointBackgroundColor: 'rgba(245, 158, 11, 1)',
                        pointBorderColor: '#fff',
                        pointRadius: 4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: {
                                size: 12,
                                weight: 'bold'
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                        backgroundColor: 'rgba(74, 52, 40, 0.95)',
                        titleColor: '#D9B382',
                        bodyColor: '#fff',
                        borderColor: '#D9B382',
                        borderWidth: 1,
                        padding: 12
                    }
                },
                scales: {
                    r: {
                        beginAtZero: true,
                        ticks: {
                            font: {
                                size: 10,
                                weight: 'bold'
                            },
                            color: '#4A3428'
                        },
                        pointLabels: {
                            font: {
                                size: 11,
                                weight: 'bold'
                            },
                            color: '#4A3428'
                        }
                    }
                }
            }
        };
    } else if (type === 'doughnut') {

        const totalRev = totals.reduce((a, b) => parseFloat(a) + parseFloat(b), 0);
        const totalTrans = transaksiPerHari.reduce((a, b) => parseInt(a) + parseInt(b), 0);
        const totalProd = produkPerHari.reduce((a, b) => parseInt(a) + parseInt(b), 0);
        
        config = {
            type: 'doughnut',
            data: {
                labels: ['Pendapatan Total', 'Total Transaksi', 'Total Produk'],
                datasets: [{
                    data: [totalRev, totalTrans * 1000, totalProd * 500], // Scale untuk visibility
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(245, 158, 11, 0.8)'
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(16, 185, 129, 1)',
                        'rgba(245, 158, 11, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: {
                                size: 12,
                                weight: 'bold'
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                        backgroundColor: 'rgba(74, 52, 40, 0.95)',
                        titleColor: '#D9B382',
                        bodyColor: '#fff',
                        borderColor: '#D9B382',
                        borderWidth: 1,
                        padding: 12,
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.dataIndex === 0) {
                                    label += 'Rp ' + context.parsed.toLocaleString('id-ID');
                                } else {
                                    label += context.parsed.toLocaleString('id-ID');
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        };
    } else {
     
       config = {
        type: type,
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Pendapatan (Rp)',
                    cubicInterpolationMode: 'monotone',
                    tension: 0.4,
                    data: totals,
                    borderColor: 'rgba(59, 130, 246, 1)',
                    backgroundColor: type === 'bar' ? 'rgba(59, 130, 246, 0.7)' : 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: type === 'line',
                    pointRadius: type === 'line' ? 5 : 0,
                    yAxisID: 'y'
                },
                {
                    label: 'Jumlah Transaksi',
                    data: transaksiPerHari,
                    borderColor: 'rgba(16, 185, 129, 1)',
                    backgroundColor: 'rgba(16, 185, 129, 0.2)', 
                    borderWidth: 3,
                    tension: 0.4,
                    fill: false, 
                    pointRadius: type === 'line' ? 5 : 0,
                    yAxisID: 'y1'
                },
                {
                    label: 'Produk Terjual',
                    data: produkPerHari,
                    borderColor: 'rgba(245, 158, 11, 1)',
                    backgroundColor: 'rgba(245, 158, 11, 0.2)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: false,
                    pointRadius: type === 'line' ? 5 : 0,
                    yAxisID: 'y1'
                }
            ]
        },
        
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: {
                                size: 12,
                                weight: 'bold'
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                        backgroundColor: 'rgba(74, 52, 40, 0.95)',
                        titleColor: '#D9B382',
                        bodyColor: '#fff',
                        borderColor: '#D9B382',
                        borderWidth: 1,
                        padding: 12,
                        titleFont: {
                            size: 14,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 13
                        },
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.datasetIndex === 0) {
                                    label += 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                                } else {
                                    label += context.parsed.y.toLocaleString('id-ID');
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                size: 11,
                                weight: 'bold'
                            },
                            color: '#4A3428',
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        beginAtZero: true,
                        grid: {
                            drawOnChartArea: false,
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                size: 11,
                                weight: 'bold'
                            },
                            color: '#4A3428'
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                size: 11,
                                weight: 'bold'
                            },
                            color: '#4A3428',
                            autoSkip: true,
                            maxRotation: 45,
                            minRotation: 0
                        }
                    }
                }
            }
        };
    }

    pendapatanChart = new Chart(ctx, config);
}


initChart('line');


function toggleDataset(index) {
    const meta = pendapatanChart.getDatasetMeta(index);
    meta.hidden = meta.hidden === null ? !pendapatanChart.data.datasets[index].hidden : null;
    
    
    const button = document.getElementById('toggle-' + index);
    if (meta.hidden) {
        button.style.opacity = '0.4';
    } else {
        button.style.opacity = '1';
    }
    
    pendapatanChart.update();
}


function updateChartType(type) {
    initChart(type);
}


function applyQuickFilter(value) {
    if (!value) return;
    
    const today = new Date();
    let dateFrom = '';
    let dateTo = today.toISOString().split('T')[0];
    
    switch(value) {
        case '7days':
            const sevenDaysAgo = new Date(today);
            sevenDaysAgo.setDate(today.getDate() - 7);
            dateFrom = sevenDaysAgo.toISOString().split('T')[0];
            break;
        case '30days':
            const thirtyDaysAgo = new Date(today);
            thirtyDaysAgo.setDate(today.getDate() - 30);
            dateFrom = thirtyDaysAgo.toISOString().split('T')[0];
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


function printChart() {
    window.print();
}


function downloadChart() {
    const link = document.createElement('a');
    link.download = 'grafik-pendapatan-' + new Date().getTime() + '.png';
    link.href = pendapatanChart.toBase64Image();
    link.click();
}
</script>
@endsection