<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

@extends('layouts.app')

@section('title', 'Semua Produk')

@section('content')
<section class="bg-[#fdfaf5] min-h-screen pt-10 pb-20" x-data="{ openFilter: false }">
    <div class="container mx-auto px-6 md:px-16 lg:px-24 xl:px-32">

        
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="text-center md:text-left">
                <h1 class="text-4xl md:text-5xl font-black text-[#4A3428] tracking-tighter">
                    Semua <span class="text-[#D9B382] italic serif">Produk</span>
                </h1>
                <p class="text-[#4A3428]/60 mt-2 max-w-xl font-medium">
                    Jelajahi seluruh koleksi premium kami yang dikurasi khusus untuk Anda.
                </p>
            </div>

            <button @click="openFilter = !openFilter" 
                    class="lg:hidden flex items-center justify-center gap-2 w-full py-4 bg-white border border-[#4A3428]/10 rounded-2xl text-[#4A3428] font-black shadow-sm active:scale-95 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                </svg>
                Filter & Sortir
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">

          
            <aside :class="openFilter ? 'block' : 'hidden'" 
                   class="lg:block lg:col-span-1 animate-fade-in-down lg:animate-none">
                
                <div class="bg-white rounded-[2.5rem] shadow-xl lg:shadow-md p-8 sticky top-28 border border-[#4A3428]/5">
                    <div class="flex justify-between items-center mb-8">
                        <h2 class="text-xl font-black text-[#4A3428]">Filter</h2>
                        <button @click="openFilter = false" class="lg:hidden text-[#4A3428]/40 hover:text-red-500">✕</button>
                    </div>

                    <form method="GET" action="{{ route('products.all') }}" class="space-y-8">
                        <div>
                            <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-[#4A3428] mb-4">Cari Nama</h3>
                            <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Ketik sesuatu..." 
                                   class="w-full rounded-xl bg-[#fdfaf5] border-none focus:ring-2 focus:ring-[#D9B382] font-bold text-sm p-4 transition-all">
                        </div>

                        <div>
                            <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-[#4A3428] mb-4">Kategori</h3>
                            
                            @php 
                                $selectedKategori = (array) request('kategori', []);
                            @endphp

                            <div class="space-y-3">
                                @foreach($categories as $category)
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input type="checkbox" 
                                            name="kategori[]" 
                                            value="{{ $category->nama_kategori }}"
                                            class="rounded border-gray-300 text-[#4A3428] focus:ring-[#4A3428] transition-all cursor-pointer"
                                            {{ in_array($category->nama_kategori, $selectedKategori) ? 'checked' : '' }}>
                                        
                                        <span class="text-sm font-bold text-[#4A3428]/70 group-hover:text-[#4A3428] capitalize transition-colors">
                                            {{ ucfirst($category->nama_kategori) }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-[#4A3428] mb-4">Harga (Rp)</h3>
                            <div class="space-y-3">
                                <input type="number" name="min_harga" placeholder="Min" value="{{ request('min_harga') }}"
                                       class="w-full rounded-xl bg-[#fdfaf5] border-none focus:ring-2 focus:ring-[#D9B382] font-bold text-sm">
                                <input type="number" name="max_harga" placeholder="Max" value="{{ request('max_harga') }}"
                                       class="w-full rounded-xl bg-[#fdfaf5] border-none focus:ring-2 focus:ring-[#D9B382] font-bold text-sm">
                            </div>
                        </div>

                        <div class="pt-4 space-y-3">
                            <button type="submit"
                                    class="w-full py-4 bg-[#4A3428] text-[#D9B382] font-black rounded-2xl hover:bg-[#3D2B21] transition-all uppercase tracking-widest text-xs shadow-lg shadow-[#4A3428]/20 active:scale-95">
                                Terapkan
                            </button>
                            <a href="{{ route('products.all') }}" 
                               class="block w-full py-4 bg-gray-50 text-[#4A3428] text-center font-bold rounded-2xl text-xs border border-gray-100 hover:bg-gray-100 transition-all">
                                Reset Filter
                            </a>
                        </div>
                    </form>
                </div>
            </aside>

            
            <div class="lg:col-span-3">
                <div id="product-list-container" class="grid grid-cols-2 xl:grid-cols-3 gap-x-4 gap-y-10 md:gap-x-8 md:gap-y-16">
                    @forelse($products as $item)
                        <div class="group relative flex flex-col bg-white/40 backdrop-blur-sm rounded-[2.5rem] p-2 md:p-3 border border-white/50 shadow-sm hover:shadow-2xl hover:shadow-[#4A3428]/10 transition-all duration-500 hover:-translate-y-2">
                            <div class="relative aspect-[4/5] md:aspect-[3/4] rounded-[2rem] md:rounded-[2.5rem] overflow-hidden bg-[#F3E5D8]">
                               <img src="{{ asset('images/products/' . $item->gambar) }}"
                                     class="w-full h-full object-cover transition-transform duration-[1.5s] ease-out group-hover:scale-110">

                               
                                <div class="absolute top-4 left-4 flex flex-col gap-2 z-20">
                                    @if($item->stok < 5 && $item->stok > 0)
                                        <span class="bg-red-500/90 backdrop-blur-md text-white text-[8px] md:text-[9px] font-black px-3 py-1.5 rounded-full uppercase tracking-wider shadow-sm">🔥 Stok Tipis</span>
                                    @endif
                                </div>

                            
                                <div class="absolute inset-0 bg-gradient-to-t from-[#4A3428]/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 hidden md:flex items-end justify-center pb-8 gap-3">
                                    <a href="{{ route('produk.show', $item->id) }}" class="p-4 bg-white/90 backdrop-blur-md text-[#4A3428] rounded-2xl hover:bg-[#D9B382] hover:text-white transition-all transform translate-y-4 group-hover:translate-y-0 duration-500 shadow-xl">
                                        <i class="fas fa-eye text-lg"></i>
                                    </a>
                                    
                                    <button type="button" 
                                        onclick="handleAuthAction('{{ auth('customer')->check() }}', () => openQtyModal('{{ $item->id }}', '{{ $item->nama_produk }}', {{ $item->stok }}))"
                                        class="p-4 bg-[#D9B382] text-white rounded-2xl hover:bg-white hover:text-[#4A3428] transition-all transform translate-y-4 group-hover:translate-y-0 duration-500 delay-75 shadow-xl">
                                        <i class="fas fa-plus text-lg"></i>
                                    </button>
                                </div>

                               
                                <div class="absolute bottom-3 left-0 right-0 px-3 flex justify-between items-center md:hidden z-30">
                                    <a href="{{ route('produk.show', $item->id) }}" 
                                       class="w-10 h-10 bg-white/20 backdrop-blur-lg border border-white/30 rounded-full flex items-center justify-center shadow-lg active:scale-90 transition-all text-white">
                                        <i class="fas fa-eye text-sm"></i>
                                    </a>
                                    
                                    <button type="button"
                                            onclick="handleAuthAction('{{ auth('customer')->check() }}', () => openQtyModal('{{ $item->id }}', '{{ $item->nama_produk }}', {{ $item->stok }}))"
                                            class="w-10 h-10 bg-[#D9B382] text-[#4A3428] rounded-full flex items-center justify-center shadow-lg active:scale-90 transition-all">
                                        <i class="fas fa-plus text-sm"></i>
                                    </button>
                                </div>

                             
                                @if($item->stok <= 0)
                                    <div class="absolute inset-0 bg-white/60 backdrop-blur-[1px] z-40 flex items-center justify-center">
                                        <span class="border-2 border-black text-black text-[10px] font-black px-4 py-1.5 rounded-full uppercase -rotate-12">Habis</span>
                                    </div>
                                @endif
                            </div>

                            
                            <div class="mt-4 px-2 pb-2">
                                <h3 class="text-sm md:text-lg font-bold text-[#4A3428] line-clamp-1 group-hover:text-[#D9B382] transition-colors leading-tight mb-1 capitalize">
                                    {{ $item->nama_produk }}
                                </h3>
                                <div class="flex items-center gap-2 mb-2">
                                    <div class="flex items-center bg-[#F3E5D8] px-1.5 py-0.5 rounded-lg">
                                        <span class="text-[9px] font-black text-[#4A3428]">★ {{ $item->rating ?? '4.9' }}</span>
                                    </div>
                                    <span class="text-[9px] text-gray-400 font-bold uppercase tracking-tighter">{{ $item->total_terjual ?? 0 }} Terjual</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="text-lg md:text-2xl font-black text-[#4A3428] tracking-tighter">
                                        <span class="text-xs mr-0.5">Rp</span>{{ number_format($item->harga, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-32">
                            <div class="text-6xl mb-4">📦</div>
                            <p class="text-[#4A3428]/30 font-black italic uppercase tracking-widest">Produk tidak ditemukan</p>
                        </div>
                    @endforelse
                </div>

               <div class="mt-16 flex justify-center">
                    <nav class="inline-flex items-center space-x-2">
                        @if ($products->onFirstPage())
                            <span class="px-4 py-2 rounded-full bg-gray-300 text-gray-500 cursor-not-allowed select-none shadow-sm text-sm font-bold">
                                Sebelumnya
                            </span>
                        @else
                            <a href="{{ $products->previousPageUrl() }}"
                            class="px-4 py-2 rounded-full bg-[#D9B382] text-white font-bold shadow-lg hover:bg-[#c8a36b] transition-all duration-300 text-sm">
                                Sebelumnya
                            </a>
                        @endif


                    
                        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                            @if ($page == $products->currentPage())
                                <span class="px-4 py-2 rounded-full bg-[#4A3428] text-white font-bold shadow-inner text-sm">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}"
                                class="px-4 py-2 rounded-full bg-white text-gray-800 font-semibold shadow hover:bg-[#D9B382]/20 transition-all duration-300 text-sm">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach


                
                        @if ($products->hasMorePages())
                            <a href="{{ $products->nextPageUrl() }}"
                            class="px-4 py-2 rounded-full bg-[#D9B382] text-white font-bold shadow-lg hover:bg-[#c8a36b] transition-all duration-300 text-sm">
                                Selanjutnya
                            </a>
                        @else
                            <span class="px-4 py-2 rounded-full bg-gray-300 text-gray-500 cursor-not-allowed select-none shadow-sm text-sm font-bold">
                                Selanjutnya
                            </span>
                        @endif
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  
    function handleAuthAction(isLoggedIn, callback) {
        if (isLoggedIn === '1' || isLoggedIn === true) {
            callback();
        } else {
            Swal.fire({
                title: '<span style="font-family: sans-serif; font-weight: 900; color: #4A3428;">LOGIN DULU YUK!</span>',
                html: '<p style="color: #4A3428; opacity: 0.7; font-weight: 500;">Silakan login untuk memasukkan produk ke keranjang belanja Anda.</p>',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'LOGIN SEKARANG',
                cancelButtonText: 'NANTI SAJA',
                confirmButtonColor: '#4A3428',
                cancelButtonColor: '#f3f4f6',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-[2.5rem] p-4 md:p-8',
                    confirmButton: 'rounded-2xl font-black px-8 py-4 text-sm',
                    cancelButton: 'rounded-2xl font-bold px-8 py-4 text-sm text-[#4A3428]'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('customer.login') }}";
                }
            });
        }
    }

  
    function openQtyModal(productId, productName, maxStock) {
        if (maxStock <= 0) {
            Swal.fire({ icon: 'error', title: 'Habis!', text: 'Stok produk ini sedang kosong.', confirmButtonColor: '#4A3428' });
            return;
        }

        Swal.fire({
            title: 'Jumlah Pesanan',
            html: `<p class="mb-4 text-sm text-gray-600">Berapa banyak <b>${productName}</b>?</p>`,
            input: 'number',
            inputAttributes: { min: 1, max: maxStock, step: 1 },
            inputValue: 1,
            showCancelButton: true,
            confirmButtonText: 'Tambah ke Keranjang',
            confirmButtonColor: '#4A3428',
            customClass: { popup: 'rounded-[2rem]', input: 'font-bold' },
            preConfirm: (value) => {
                if (!value || value < 1) { Swal.showValidationMessage('Minimal 1 item'); }
                else if (value > maxStock) { Swal.showValidationMessage(`Stok cuma ada ${maxStock}`); }
                return value;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                addToCartAjax(productId, result.value);
            }
        });
    }

    
    function addToCartAjax(productId, quantity) {
        Swal.fire({
            title: 'Menambahkan...',
            allowOutsideClick: false,
            didOpen: () => { Swal.showLoading(); }
        });

        fetch(`/cart/add/${productId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ quantity: quantity })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
             
                window.dispatchEvent(new CustomEvent('updateCartCount', { detail: { count: data.cart_count } }));
                
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message,
                    timer: 2000,
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false
                });
            } else {
                Swal.fire('Gagal!', data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire('Error!', 'Terjadi kesalahan sistem.', 'error');
        });
    }
</script>

<style>
    @keyframes fade-in-down {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-down { animation: fade-in-down 0.3s ease-out forwards; }
    
    
    .custom-pagination-wrapper nav { display: flex; gap: 0.5rem; }
    .custom-pagination-wrapper a, .custom-pagination-wrapper span {
        width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; 
        border-radius: 12px; font-weight: 800; transition: all 0.3s;
    }
</style>

<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection