<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@extends('layouts.app')

@section('content')
<section class="py-10 md:py-20 bg-[#fdfaf5] min-h-screen flex items-center">
    <div class="container mx-auto px-4 md:px-16 lg:px-32">
        <div class="max-w-2xl mx-auto">
            
            <div class="text-center mb-10 animate-fade-in-down">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-green-500 rounded-full mb-6 shadow-lg shadow-green-200">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h1 class="text-4xl md:text-5xl font-black text-[#4A3428] tracking-tighter mb-2">
                    YEAY! <span class="text-[#D9B382] italic">BERHASIL</span>
                </h1>
                <p class="text-[#4A3428]/60 font-medium">Pesananmu sudah masuk ke toko kami, {{ $customer }}!</p>
            </div>

            <div class="bg-white/50 backdrop-blur-sm border border-[#4A3428]/5 rounded-3xl p-6 mb-8 shadow-sm">
                <div class="flex justify-between items-center relative">
                    <div class="absolute top-5 left-0 w-full h-[2px] bg-[#4A3428]/5 z-0"></div>
                    
                    <div class="absolute top-5 left-0 w-[12%] h-[2px] bg-[#4A3428] z-0"></div>

                    <div class="relative z-10 flex flex-col items-center flex-1">
                        <div class="w-10 h-10 rounded-full bg-[#4A3428] text-[#D9B382] flex items-center justify-center shadow-md ring-4 ring-[#fdfaf5]">
                            <i class="fas fa-receipt text-sm"></i>
                        </div>
                        <span class="mt-2 font-black text-[#4A3428] text-[9px] md:text-[10px] uppercase tracking-tighter">Pending</span>
                    </div>

                    <div class="relative z-10 flex flex-col items-center flex-1 opacity-30">
                        <div class="w-10 h-10 rounded-full bg-white border border-[#4A3428]/20 text-[#4A3428] flex items-center justify-center ring-4 ring-[#fdfaf5]">
                            <i class="fas fa-fire-alt text-sm"></i>
                        </div>
                        <span class="mt-2 font-bold text-[#4A3428] text-[9px] md:text-[10px] uppercase tracking-tighter">Proses</span>
                    </div>

                    <div class="relative z-10 flex flex-col items-center flex-1 opacity-30">
                        <div class="w-10 h-10 rounded-full bg-white border border-[#4A3428]/20 text-[#4A3428] flex items-center justify-center ring-4 ring-[#fdfaf5]">
                            <i class="fas fa-truck text-sm"></i>
                        </div>
                        <span class="mt-2 font-bold text-[#4A3428] text-[9px] md:text-[10px] uppercase tracking-tighter">Kirim</span>
                    </div>

                    <div class="relative z-10 flex flex-col items-center flex-1 opacity-30">
                        <div class="w-10 h-10 rounded-full bg-white border border-[#4A3428]/20 text-[#4A3428] flex items-center justify-center ring-4 ring-[#fdfaf5]">
                            <i class="fas fa-check-double text-sm"></i>
                        </div>
                        <span class="mt-2 font-bold text-[#4A3428] text-[9px] md:text-[10px] uppercase tracking-tighter">Selesai</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-xl shadow-[#4A3428]/5 border border-[#4A3428]/5 overflow-hidden mb-8">
                <div class="p-6 md:p-8">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-black text-[#4A3428] uppercase tracking-tight">Detail Pesanan</h3>
                        <span class="text-xs font-bold text-[#D9B382]">ID #{{ rand(1000, 9999) }}</span>
                    </div>
                    
                    <div class="divide-y divide-[#4A3428]/5">
                        @foreach($orders as $item)
                        <div class="py-4 flex justify-between items-center group">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-[#4A3428] rounded-2xl flex items-center justify-center text-[#D9B382] font-black shadow-inner">
                                    {{ $item['qty'] }}x
                                </div>
                                <div>
                                    <p class="font-black text-[#4A3428] text-sm md:text-base tracking-tight leading-none mb-1 lowercase first-letter:uppercase">
                                        {{ $item['nama_produk'] }}
                                    </p>
                                    <p class="text-[10px] font-bold text-[#D9B382] uppercase tracking-widest">Premium Produk</p>
                                </div>
                            </div>
                            <p class="font-black text-[#4A3428] text-sm md:text-base">
                                Rp{{ number_format($item['harga'] * $item['qty'], 0, ',', '.') }}
                            </p>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-6 pt-6 border-t-2 border-dashed border-[#4A3428]/10 flex justify-between items-center">
                        <p class="font-bold text-[#4A3428]/40 text-xs uppercase tracking-widest">Total Bayar</p>
                        <p class="text-2xl font-black text-[#4A3428]">
                            @php $total = collect($orders)->sum(fn($i) => $i['harga'] * $i['qty']); @endphp
                            Rp{{ number_format($total, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 px-2">
                <a href="{{ url('/home') }}" class="flex items-center justify-center gap-2 py-5 bg-[#4A3428] text-[#D9B382] font-black rounded-2xl hover:bg-[#36261d] transition-all shadow-lg active:scale-95 text-xs uppercase tracking-widest">
                    <i class="fas fa-home"></i> Beranda
                </a>
                
                @auth('customer')
                    <a href="{{ route('order.index') }}" class="flex items-center justify-center gap-2 py-5 bg-white border-2 border-[#4A3428] text-[#4A3428] font-black rounded-2xl hover:bg-[#4A3428] hover:text-[#D9B382] transition-all active:scale-95 text-xs uppercase tracking-widest">
                        <i class="fas fa-shopping-bag"></i> Pesanan Saya
                    </a>
                @else
                    <button onclick="loginAlert()" class="flex items-center justify-center gap-2 py-5 bg-white border-2 border-[#4A3428] text-[#4A3428] font-black rounded-2xl hover:bg-[#4A3428] hover:text-[#D9B382] transition-all active:scale-95 text-xs uppercase tracking-widest">
                        <i class="fas fa-shopping-bag"></i> Pesanan Saya
                    </button>
                @endauth
            </div>
            

        </div>
    </div>
</section>

<style>
    .animate-fade-in-down {
        animation: fadeInDown 0.8s ease-out;
    }
    @keyframes fadeInDown {
        0% { opacity: 0; transform: translateY(-20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    body {
        -webkit-tap-highlight-color: transparent;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function loginAlert() {
    Swal.fire({
        title: '<span style="font-family: sans-serif; font-weight: 900; color: #4A3428; font-size: 20px;">OPS! LOGIN DULU</span>',
        html: '<p style="color: #4A3428; opacity: 0.6; font-weight: 500;">Silakan login untuk memantau status pesananmu secara real-time.</p>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'LOGIN',
        cancelButtonText: 'NANTI',
        confirmButtonColor: '#4A3428',
        cancelButtonColor: '#4A342820',
        buttonsStyling: true,
        background: '#fdfaf5',
        customClass: {
            popup: 'rounded-[2.5rem] border-none shadow-2xl',
            confirmButton: 'rounded-xl font-black px-8 py-3',
            cancelButton: 'rounded-xl font-bold px-8 py-3 text-[#4A3428]'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{{ route('customer.login') }}";
        }
    });
}
</script>
@endsection