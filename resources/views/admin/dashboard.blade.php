@extends('admin.layout')

@section('title', 'Dashboard Admin')

@section('content')
<div class="bg-gradient-to-br from-[#fdfaf5] to-[#f5ede0] min-h-screen p-6">
    <div class="mb-10">
        <h1 class="text-4xl font-black text-[#4A3428] tracking-tight">
            Dashboard Admin
        </h1>
        <p class="text-[#8B7355] mt-2 font-medium">Ringkasan performa bisnis</p>
    </div>

  
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

       
        <div class="group bg-gradient-to-br from-white to-[#FFF9F0] rounded-3xl p-6 shadow-lg hover:shadow-2xl border border-[#D9B382]/20 transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between mb-3">
                <div class="p-3 bg-gradient-to-br from-[#D9B382] to-[#C9A372] rounded-2xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Pendapatan</p>
            <h2 class="text-3xl font-black text-[#4A3428] mt-2">
                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
            </h2>
            <p class="text-xs text-[#D9B382] mt-2 font-semibold">Pesanan Selesai</p>
        </div>

    
        <div class="group bg-gradient-to-br from-white to-[#FFF9F0] rounded-3xl p-6 shadow-lg hover:shadow-2xl border border-[#D9B382]/20 transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between mb-3">
                <div class="p-3 bg-gradient-to-br from-[#8B7355] to-[#7A6348] rounded-2xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
            </div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Produk</p>
            <h2 class="text-3xl font-black text-[#4A3428] mt-2">
                {{ $totalProduk }}
            </h2>
            <p class="text-xs text-[#8B7355] mt-2 font-semibold">Produk Aktif</p>
        </div>

 
        <div class="group bg-gradient-to-br from-white to-[#FFF9F0] rounded-3xl p-6 shadow-lg hover:shadow-2xl border border-[#D9B382]/20 transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between mb-3">
                <div class="p-3 bg-gradient-to-br from-[#C9A372] to-[#B89362] rounded-2xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
            </div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Pesanan</p>
            <h2 class="text-3xl font-black text-[#4A3428] mt-2">
                {{ $totalPesanan }}
            </h2>
            <p class="text-xs text-[#C9A372] mt-2 font-semibold">Semua Status</p>
        </div>


        <div class="group bg-gradient-to-br from-white to-[#FFF9F0] rounded-3xl p-6 shadow-lg hover:shadow-2xl border border-[#D9B382]/20 transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between mb-3">
                <div class="p-3 bg-gradient-to-br from-[#E8C999] to-[#D9B382] rounded-2xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                    </svg>
                </div>
            </div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Produk Terlaris</p>
            <h2 class="text-lg font-black text-[#4A3428] mt-2 line-clamp-2 leading-tight" title="{{ $produkTerlaris->nama_produk ?? '-' }}">
                {{ $produkTerlaris->nama_produk ?? '-' }}
            </h2>
            <p class="text-sm text-[#D9B382] font-bold mt-1">
                🔥 {{ $produkTerlaris->total_terjual ?? 0 }} Terjual
            </p>
        </div>

    </div>

  
    <div class="bg-white rounded-3xl p-8 shadow-xl border border-[#D9B382]/20">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-black text-[#4A3428]">
                    Tren Pendapatan Perbulan
                </h2>
                <p class="text-sm text-gray-500 mt-1">Grafik pendapatan pesanan yang telah selesai</p>
            </div>
            <div class="flex items-center gap-3 bg-[#fdfaf5] px-4 py-2 rounded-xl">
                <div class="w-4 h-1 rounded-full bg-[#6B9BD1]"></div>
                <span class="text-sm font-semibold text-[#4A3428]">Tren Pendapatan Perbulan</span>
            </div>
        </div>

        <div class="relative" style="height: 400px;">
            <canvas id="pendapatanChart"></canvas>
        </div>
    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('pendapatanChart');


const chartData = {!! json_encode($chart) !!};


const namaBulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];


const labels = [];
const data = [];


for (let i = 1; i <= 12; i++) {
    labels.push(namaBulan[i - 1]);
    data.push(0);
}


chartData.forEach(item => {
    const bulanIndex = item.bulan - 1; 
    data[bulanIndex] = item.total;
});


const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 400);
gradient.addColorStop(0, 'rgba(107, 155, 209, 0.3)'); 
gradient.addColorStop(1, 'rgba(107, 155, 209, 0.01)');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Tren Pendapatan Perbulan',
            data: data,
            borderColor: '#6B9BD1', 
            backgroundColor: gradient,
            borderWidth: 2.5,
            tension: 0.4, 
            fill: true,
            pointRadius: 0, 
            pointHoverRadius: 6,
            pointHoverBackgroundColor: '#6B9BD1',
            pointHoverBorderColor: '#fff',
            pointHoverBorderWidth: 2
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                backgroundColor: 'rgba(74, 52, 40, 0.95)',
                titleColor: '#fff',
                bodyColor: '#D9B382',
                padding: 12,
                borderColor: '#D9B382',
                borderWidth: 1,
                displayColors: false,
                callbacks: {
                    label: function(context) {
                        return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(217, 179, 130, 0.15)',
                    drawBorder: false
                },
                border: {
                    display: false
                },
                ticks: {
                    color: '#8B7355',
                    font: {
                        size: 11,
                        weight: '500'
                    },
                    padding: 10,
                    callback: function(value) {
                        if (value === 0) return '0';
                        if (value >= 1000000) {
                            return (value / 1000000) + ' rb';
                        }
                        return value.toLocaleString('id-ID');
                    }
                }
            },
            x: {
                grid: {
                    display: false,
                    drawBorder: false
                },
                border: {
                    display: false
                },
                ticks: {
                    color: '#8B7355',
                    font: {
                        size: 11,
                        weight: '500'
                    },
                    padding: 10
                }
            }
        },
        interaction: {
            intersect: false,
            mode: 'index'
        }
    }
});
</script>
@endsection