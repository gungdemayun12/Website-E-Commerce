    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @extends('layouts.app')

    @section('title', 'Keranjang Belanja')

    @section('content')
    <section class="py-12 md:py-24 bg-[#fdfaf5] min-h-screen pb-32 md:pb-24">
        <div class="container mx-auto px-4 md:px-16 lg:px-24">
            
            <div class="flex items-end gap-4 mb-8 md:mb-12">
                <h1 class="text-3xl md:text-5xl font-black text-[#4A3428] uppercase tracking-tighter leading-none">
                    Keranjang <span class="text-[#D9B382] italic serif capitalize">Belanja</span>
                </h1>
                <span class="text-sm md:text-base font-bold text-[#4A3428]/40 mb-1">
                    ({{ session('cart') ? count(session('cart')) : 0 }} Item)
                </span>
            </div>

            @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-xl">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                    <p class="text-green-700 font-bold">{{ session('success') }}</p>
                </div>
            </div>
            @endif

            @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-xl">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                    <p class="text-red-700 font-bold">{{ session('error') }}</p>
                </div>
            </div>
            @endif

            @if(session('cart') && count(session('cart')) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">

                <div class="lg:col-span-2 space-y-4 md:space-y-6">
                    @php $total = 0 @endphp
                    @foreach(session('cart') as $id => $details)

                        @php
                            $total += $details['price'] * $details['quantity'];
                            $product = \App\Models\Product::find($id);
                            $maxStock = $product ? $product->stok : 0;
                            $isStockLow = $maxStock > 0 && $maxStock < 5;
                            $isOutOfStock = $maxStock <= 0;
                            $exceedsStock = $details['quantity'] > $maxStock;
                            
                           
                            $sizeChartData = $details['sizeChartData'] ?? ['type' => 'none', 'sizes' => []];
                        @endphp

                        <div class="flex gap-4 md:gap-6 bg-white p-4 md:p-6 rounded-[1.5rem] md:rounded-[2rem] shadow-sm border {{ $exceedsStock || $isOutOfStock ? 'border-red-300 bg-red-50/30' : 'border-[#4A3428]/5' }} transition-all hover:shadow-md relative overflow-hidden">

                            @if($exceedsStock || $isOutOfStock)
                            <div class="absolute top-0 left-0 right-0 bg-red-500 text-white text-center py-1 text-xs font-bold">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                {{ $isOutOfStock ? 'STOK HABIS' : 'MELEBIHI STOK' }}
                            </div>
                            @endif

                            <div class="relative group shrink-0 {{ $exceedsStock || $isOutOfStock ? 'mt-6' : '' }}">
                               <img src="{{ asset('images/products/' . $details['image']) }}"
                                    class="w-20 h-28 md:w-32 md:h-40 object-cover rounded-xl md:rounded-2xl shadow-sm {{ $isOutOfStock ? 'opacity-50 grayscale' : '' }}"
                                    loading="lazy"
                                    onerror="this.src='{{ asset('images/default-product.jpg') }}'">

                                
                                @if($isOutOfStock)
                                <div class="absolute inset-0 flex items-center justify-center bg-black/50 rounded-xl md:rounded-2xl">
                                    <span class="text-white font-black text-xs">HABIS</span>
                                </div>
                                @endif
                            </div>

                            <div class="flex flex-col justify-between flex-1 py-1 {{ $exceedsStock || $isOutOfStock ? 'mt-6' : '' }}">
                                <div>
                                    <div class="flex justify-between items-start">
                                        <h3 class="text-base md:text-xl font-black text-[#4A3428] line-clamp-1 pr-6">
                                            {{ $details['name'] }}
                                        </h3>
                                    </div>

                                    <p class="text-[#D9B382] font-black text-sm md:text-lg mt-1">
                                        Rp{{ number_format($details['price'], 0, ',', '.') }}
                                    </p>

                                    
                                    <div class="mt-3">
                                        <form action="{{ route('cart.updateSize') }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <div class="flex items-center gap-2">
                                                <label class="text-xs font-black text-[#4A3428]/60 uppercase tracking-wider">
                                                    <i class="fas fa-ruler-combined mr-1"></i> Ukuran:
                                                </label>
                                                
                                                @if($sizeChartData['type'] !== 'none' && !empty($sizeChartData['sizes']))
                                                    
                                                    <select name="size" 
                                                        data-id="{{ $id }}"
                                                        class="update-size px-3 py-1.5 md:px-4 md:py-2 bg-[#fdfaf5] border border-[#4A3428]/10 rounded-xl text-xs md:text-sm font-bold text-[#4A3428] focus:ring-2 focus:ring-[#D9B382] focus:border-transparent cursor-pointer hover:bg-white transition-all">
                                                        @foreach($sizeChartData['sizes'] as $sizeData)
                                                            <option value="{{ $sizeData['size'] }}" 
                                                                {{ ($details['size'] ?? '') == $sizeData['size'] ? 'selected' : '' }}>
                                                                {{ $sizeData['size'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <select name="size" 
                                                        data-id="{{ $id }}"
                                                        class="update-size px-3 py-1.5 md:px-4 md:py-2 bg-[#fdfaf5] border border-[#4A3428]/10 rounded-xl text-xs md:text-sm font-bold text-[#4A3428] focus:ring-2 focus:ring-[#D9B382] focus:border-transparent cursor-pointer hover:bg-white transition-all">
                                                        <option value="All Size" {{ ($details['size'] ?? 'All Size') == 'All Size' ? 'selected' : '' }}>All Size</option>
                                                        <option value="S" {{ ($details['size'] ?? '') == 'S' ? 'selected' : '' }}>S</option>
                                                        <option value="M" {{ ($details['size'] ?? '') == 'M' ? 'selected' : '' }}>M</option>
                                                        <option value="L" {{ ($details['size'] ?? '') == 'L' ? 'selected' : '' }}>L</option>
                                                        <option value="XL" {{ ($details['size'] ?? '') == 'XL' ? 'selected' : '' }}>XL</option>
                                                        <option value="XXL" {{ ($details['size'] ?? '') == 'XXL' ? 'selected' : '' }}>XXL</option>
                                                    </select>
                                                @endif
                                            </div>
                                        </form>
                                    </div>

                                    <div class="mt-2 flex items-center gap-2">
                                        @if($isOutOfStock)
                                            <span class="text-xs font-black text-red-500 bg-red-100 px-3 py-1 rounded-full">
                                                <i class="fas fa-times-circle mr-1"></i> Stok Habis
                                            </span>
                                        @elseif($isStockLow)
                                            <span class="text-xs font-black text-orange-500 bg-orange-100 px-3 py-1 rounded-full">
                                                <i class="fas fa-fire mr-1"></i> Tersisa {{ $maxStock }}
                                            </span>
                                        @else
                                            <span class="text-xs font-bold text-gray-400">
                                                <i class="fas fa-box mr-1"></i> Stok: {{ $maxStock }}
                                            </span>
                                        @endif

                                        @if($exceedsStock && !$isOutOfStock)
                                            <span class="text-xs font-black text-red-500 bg-red-100 px-3 py-1 rounded-full">
                                                <i class="fas fa-exclamation-triangle mr-1"></i> Melebihi stok!
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex items-center justify-between mt-4">
                                    <div class="flex items-center bg-[#fdfaf5] rounded-xl border border-[#4A3428]/10 p-1">

                                        <form action="{{ route('cart.update') }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <input type="hidden" name="quantity" value="{{ max(1, $details['quantity'] - 1) }}">

                                            <button type="button"
                                                class="update-qty w-7 h-7 md:w-8 md:h-8 flex items-center justify-center bg-white rounded-lg font-bold shadow-sm transition-all
                                                {{ $details['quantity'] <= 1 ? 'opacity-30 cursor-not-allowed' : 'hover:bg-[#4A3428] hover:text-white active:scale-90' }}"
                                                data-id="{{ $id }}" 
                                                data-action="minus"
                                                data-current="{{ $details['quantity'] }}"
                                                {{ $details['quantity'] <= 1 ? 'disabled' : '' }}>
                                                <i class="fas fa-minus text-xs"></i>
                                            </button>
                                        </form>

                                        <span class="w-10 md:w-12 text-center font-black text-[#4A3428] qty-display-{{ $id }}">
                                            {{ $details['quantity'] }}
                                        </span>

                                        <form action="{{ route('cart.update') }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <input type="hidden" name="quantity" value="{{ min($maxStock, $details['quantity'] + 1) }}">

                                        <button type="button"
                                                class="update-qty w-7 h-7 md:w-8 md:h-8 flex items-center justify-center bg-white rounded-lg font-bold shadow-sm transition-all
                                                {{ $details['quantity'] >= $maxStock || $isOutOfStock ? 'opacity-30 cursor-not-allowed' : 'hover:bg-[#4A3428] hover:text-white active:scale-90' }}"
                                                data-id="{{ $id }}" 
                                                data-action="plus"
                                                data-current="{{ $details['quantity'] }}"
                                                data-max="{{ $maxStock }}"
                                                {{ $details['quantity'] >= $maxStock || $isOutOfStock ? 'disabled' : '' }}>
                                                <i class="fas fa-plus text-xs"></i>
                                            </button>
                                        </form>

                                    </div>

                                    <div class="hidden md:block text-right">
                                        <p class="text-[10px] font-bold text-gray-300 uppercase tracking-wider">Subtotal</p>
                                        <p class="font-black text-[#4A3428] text-lg">
                                            Rp{{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>

                                <div class="md:hidden mt-3 pt-3 border-t border-gray-100">
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs font-bold text-gray-400 uppercase">Subtotal</span>
                                        <span class="font-black text-[#4A3428]">
                                            Rp{{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center ml-2 md:ml-4 {{ $exceedsStock || $isOutOfStock ? 'mt-6' : '' }}">
                            <form action="{{ route('cart.remove') }}" method="POST" class="delete-form">
                                    @csrf @method('DELETE')
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    <button type="submit"
                                        class="p-2 md:p-3 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-xl md:rounded-2xl transition-all active:scale-90">
                                        <i class="fas fa-trash text-sm md:text-base"></i>
                                    </button>
                                </form>
                            </div>

                        </div>
                    @endforeach

                    @php
                        $hasIssues = false;
                        foreach(session('cart') as $id => $item) {
                            $prod = \App\Models\Product::find($id);
                            if (!$prod || $prod->stok <= 0 || $item['quantity'] > $prod->stok) {
                                $hasIssues = true;
                                break;
                            }
                        }
                    @endphp

                    @if($hasIssues)
                    <div class="bg-amber-50 border-l-4 border-amber-500 p-6 rounded-2xl">
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-triangle text-amber-500 text-xl mr-3 mt-1"></i>
                            <div>
                                <h4 class="font-black text-amber-700 mb-2">Perhatian!</h4>
                                <p class="text-sm text-amber-600 leading-relaxed">
                                    Beberapa produk dalam keranjang memiliki masalah stok. Harap sesuaikan jumlah atau hapus produk yang bermasalah sebelum melanjutkan ke checkout.
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

            
                <div class="hidden lg:block">
                    <div class="bg-[#4A3428] p-8 rounded-[2.5rem] text-white shadow-2xl sticky top-10 overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-[#D9B382]/10 rounded-full -mr-16 -mt-16 blur-2xl"></div>
                        
                        <h2 class="text-2xl font-black mb-6 uppercase tracking-widest text-[#D9B382]">Ringkasan Belanja</h2>
                        
                        <div class="space-y-4 border-b border-white/10 pb-6 relative z-10">
                            <div class="flex justify-between text-white/70 font-medium">
                                <span>Total Barang</span>
                                <span class="font-black text-white">{{ count(session('cart')) }} Item</span>
                            </div>
                            <div class="flex justify-between text-white/70 font-medium">
                                <span>Total Unit</span>
                                <span class="font-black text-white">
                                    {{ collect(session('cart'))->sum('quantity') }} Unit
                                </span>
                            </div>
                            <div class="flex justify-between text-white/70 font-medium">
                                <span>Pajak & Layanan</span>
                                <span class="text-green-400 text-xs font-black uppercase tracking-tighter">
                                    <i class="fas fa-gift mr-1"></i> Gratis
                                </span>
                            </div>
                        </div>
                        
                        <div class="flex justify-between py-6 items-center">
                            <div>
                                <span class="text-sm text-white/60 block mb-1">Total Bayar</span>
                                <span class="text-3xl font-black text-[#D9B382]">
                                    Rp{{ number_format($total, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                        
                        @if($hasIssues)
                        <button disabled
                            class="block w-full py-5 bg-gray-400 text-gray-200 text-center font-black rounded-2xl cursor-not-allowed shadow-xl uppercase tracking-wider">
                            <i class="fas fa-lock mr-2"></i> Sesuaikan Stok Dulu
                        </button>
                        @else
                        <a href="{{ route('checkout.index') }}" 
                            class="block w-full py-5 bg-[#D9B382] text-[#4A3428] text-center font-black rounded-2xl hover:bg-white transition-all transform active:scale-95 shadow-xl uppercase tracking-wider">
                            <i class="fas fa-arrow-right mr-2"></i> Lanjut Checkout
                        </a>
                        @endif
                    </div>
                </div>

                <div class="fixed bottom-0 left-0 right-0 bg-white p-4 shadow-[0_-10px_40px_rgba(0,0,0,0.1)] z-[50] lg:hidden rounded-t-[2rem] border-t border-[#4A3428]/5">
                    <div class="flex items-center justify-between mb-4 px-2">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Total Bayar</p>
                            <p class="text-xl font-black text-[#4A3428]">Rp{{ number_format($total, 0, ',', '.') }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs font-black text-[#D9B382] uppercase">
                                {{ collect(session('cart'))->sum('quantity') }} Unit
                            </p>
                            <p class="text-xs text-gray-400">{{ count(session('cart')) }} Produk</p>
                        </div>
                    </div>
                    
                    @if($hasIssues)
                    <button disabled
                        class="block w-full py-4 bg-gray-300 text-gray-500 text-center font-black rounded-xl cursor-not-allowed uppercase tracking-wider text-sm">
                        <i class="fas fa-lock mr-2"></i> Sesuaikan Stok Dulu
                    </button>
                    @else
                    <a href="{{ route('checkout.index') }}" 
                        class="block w-full py-4 bg-[#4A3428] text-[#D9B382] text-center font-black rounded-xl shadow-lg active:scale-95 transition-transform uppercase tracking-wider text-sm">
                        <i class="fas fa-arrow-right mr-2"></i> Checkout Sekarang
                    </a>
                    @endif
                </div>

            </div>

            @else
            <div class="max-w-2xl mx-auto text-center py-20 bg-white rounded-[3rem] border-2 border-dashed border-[#4A3428]/10 shadow-sm">
                <div class="mb-6 flex justify-center">
                    <div class="w-32 h-32 bg-[#fdfaf5] rounded-full flex items-center justify-center">
                        <i class="fas fa-shopping-cart text-5xl text-[#4A3428]/20"></i>
                    </div>
                </div>
                <p class="text-2xl font-black text-[#4A3428] mb-2 uppercase tracking-tight">Keranjang Kosong</p>
                <p class="text-[#4A3428]/50 mb-8 font-medium px-6">Sepertinya kamu belum menemukan outfit yang cocok.</p>
                <a href="/products" 
                    class="inline-flex items-center gap-3 px-10 py-4 bg-[#4A3428] text-[#D9B382] font-black rounded-full hover:scale-105 transition-all shadow-xl">
                    <i class="fas fa-shopping-bag"></i>
                    MULAI BELANJA
                </a>
            </div>
            @endif

            <div class="mt-32">
                <div class="flex items-center gap-4 mb-10">
                    <div class="h-[2px] flex-1 bg-[#4A3428]/10"></div>
                    <h2 class="text-2xl md:text-3xl font-black text-[#4A3428] text-center uppercase tracking-tighter">
                        Mungkin Kamu <span class="text-[#D9B382] italic serif capitalize">Suka</span>
                    </h2>
                    <div class="h-[2px] flex-1 bg-[#4A3428]/10"></div>
                </div>

                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-8">
                    @foreach($recommendations as $rec)
                    @php
                        $terjual = $rec->total_terjual ?? 0;
                        $rating = $terjual >= 50 ? 4.9 :
                                ($terjual >= 20 ? 4.8 :
                                ($terjual >= 5 ? 4.7 : 4.6));
                    @endphp

                    <div class="group relative flex flex-col bg-white/40 backdrop-blur-sm rounded-[2rem] md:rounded-[3rem] p-2 md:p-3 border border-white/50 shadow-sm hover:shadow-2xl hover:shadow-[#4A3428]/10 transition-all duration-500 hover:-translate-y-2">

                        <div class="relative aspect-[4/5] md:aspect-[3/4] rounded-[1.8rem] md:rounded-[2.5rem] overflow-hidden bg-[#F3E5D8]">
                            @if($rec->gambar)
                                <img src="{{ asset('images/products/' . $rec->gambar) }}"
                                    alt="{{ $rec->nama_produk }}"
                                    class="w-full h-full object-cover transition-transform duration-[1.5s] ease-out group-hover:scale-110"
                                    loading="lazy"
                                    onerror="this.src='{{ asset('images/default-product.jpg') }}'">

                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400 text-xs font-bold uppercase">
                                    No Image
                                </div>
                            @endif

                            <div class="absolute top-4 left-4 flex flex-col gap-2 z-20">
                                @if($rec->stok < 5 && $rec->stok > 0)
                                    <span class="bg-red-500/90 text-white text-[9px] font-black px-3 py-1.5 rounded-full uppercase">
                                        <i class="fas fa-fire"></i> Stok Tipis
                                    </span>
                                @elseif($rec->stok <= 0)
                                    <span class="bg-black/80 text-white text-[9px] font-black px-3 py-1.5 rounded-full uppercase">
                                        Habis
                                    </span>
                                @endif
                            </div>

                            <div class="absolute inset-0 bg-gradient-to-t from-[#4A3428]/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 hidden md:flex items-end justify-center pb-8">
                                <a href="{{ route('produk.show', $rec->id) }}"
                                class="p-4 bg-white/90 text-[#4A3428] rounded-2xl hover:bg-[#D9B382] hover:text-white transition-all">
                                    <i class="fas fa-eye text-lg"></i>
                                </a>
                            </div>
                        </div>

                        <div class="mt-4 px-2 pb-2 flex flex-col gap-1">
                            <h3 class="text-sm md:text-lg font-bold text-[#4A3428] line-clamp-1">
                                {{ $rec->nama_produk }}
                            </h3>

                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-[10px] md:text-xs font-black text-yellow-500">
                                    ★ {{ number_format($rating, 1) }}
                                </span>
                                <span class="text-[10px] text-gray-400 font-medium">
                                    ({{ $terjual }} terjual)
                                </span>
                            </div>

                            <div class="flex items-center justify-between mt-auto">
                                <span class="text-lg md:text-2xl font-black text-[#4A3428]">
                                    <span class="text-xs md:text-sm font-bold">Rp</span>
                                    {{ number_format($rec->harga, 0, ',', '.') }}
                                </span>

                                <a href="{{ route('produk.show', $rec->id) }}" 
                                    class="md:hidden flex items-center justify-center w-8 h-8 bg-[#D9B382] text-white rounded-lg">
                                    <i class="fas fa-arrow-right text-xs"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Hapus produk?',
                text: 'Produk ini akan dihapus dari keranjang belanja.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                confirmButtonColor: '#4A3428',
                cancelButtonColor: '#d33',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const csrfToken = '{{ csrf_token() }}';

 
        document.querySelectorAll('.update-size').forEach(select => {
            select.addEventListener('change', function() {
                const id = this.dataset.id;
                const size = this.value;

                fetch("{{ route('cart.updateSize') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ id, size })
                })
                .then(res => res.json())
                .then(data => {
                    if(data.success) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true
                        });
                        Toast.fire({ icon: 'success', title: data.message });
                    }
                });
            });
        });

       
        document.querySelectorAll('.update-qty').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.dataset.id;
                const action = this.dataset.action;
                let currentQty = parseInt(this.dataset.current);
                const maxStock = parseInt(this.dataset.max || 999);
                
                let newQty = action === 'plus' ? currentQty + 1 : currentQty - 1;

                if (newQty < 1 || newQty > maxStock) return;

                fetch("{{ route('cart.update') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ id, quantity: newQty })
                })
                .then(res => res.json())
                .then(data => {
                    if(data.success) {
                        window.location.reload(); 
                    } else {
                        Swal.fire('Gagal', data.message, 'error');
                    }
                })
                .catch(err => console.error(err));
            });
        });
    });
    </script>

    @endsection