<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Syne:wght@700;800&display=swap" rel="stylesheet">


@extends('layouts.app')

@section('title', 'Home')


@section('content')
<section class="w-full bg-white py-4">
    <div class="sm:hidden px-4 mb-4 space-y-3">
        <form id="mobile-search-form" class="flex items-center bg-white rounded-xl p-1 shadow-lg border border-gray-200">
            <input type="text" name="keyword" value="{{ request('keyword') }}"
                placeholder="Cari produk favoritmu..."
                class="w-full px-4 py-2 text-sm outline-none bg-transparent text-gray-800 placeholder-gray-400 font-medium">
            <button type="submit"
                class="bg-[#4A3428] text-white px-4 py-2 rounded-lg active:scale-95 transition">
                <i class="fas fa-search text-sm"></i>
            </button>
        </form>

        @guest('customer')
        <div class="flex justify-center gap-3">

            <a href="{{ url('/customer/login') }}"
                class="flex items-center gap-2 px-5 py-2 rounded-lg
                       bg-white text-[#4A3428] font-bold text-xs
                       border border-[#4A3428]
                       shadow-sm active:scale-95 transition">
                <i class="fas fa-sign-in-alt text-xs"></i>
                Masuk
            </a>

            <a href="{{ url('/customer/register') }}"
                class="flex items-center gap-2 px-5 py-2 rounded-lg
                       bg-[#4A3428] text-white font-bold text-xs
                       shadow-md active:scale-95 transition">
                <i class="fas fa-user-plus text-xs"></i>
                Daftar
            </a>

        </div>
        @endguest
    </div>

    <div class="mx-auto max-w-[90%] lg:max-w-[80%]">
        <div 
            x-data="{ 
                activeSlide: 1, 
                slides: 4,
                loop() {
                    setInterval(() => {
                        this.activeSlide = this.activeSlide === this.slides ? 1 : this.activeSlide + 1
                    }, 5000)
                } 
            }" 
            x-init="loop()"
            class="relative overflow-hidden rounded-2xl shadow-md bg-gray-100"
        >

          <div x-show="activeSlide === 1"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 scale-105"
            x-transition:enter-end="opacity-100 scale-100"
            class="aspect-[16/7] md:aspect-[21/9] lg:aspect-[3/1]">
            <img src="{{ asset('images/carousel/carousel1.webp') }}"
                class="w-full h-full object-cover"
                loading="lazy"
                alt="Promo Utama">
        </div>

        <div x-show="activeSlide === 2"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 scale-105"
            x-transition:enter-end="opacity-100 scale-100"
            class="aspect-[16/7] md:aspect-[21/9] lg:aspect-[3/1]">
            <img src="{{ asset('images/carousel/carousel2.jpg') }}"
                class="w-full h-full object-cover"
                loading="lazy"
                alt="Koleksi Terbaru">
        </div>

        <div x-show="activeSlide === 3"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 scale-105"
            x-transition:enter-end="opacity-100 scale-100"
            class="aspect-[16/7] md:aspect-[21/9] lg:aspect-[3/1]">
            <img src="{{ asset('images/carousel/carousel3.jpg') }}"
                class="w-full h-full object-cover"
                loading="lazy"
                alt="Penawaran Spesial">
        </div>

           <div x-show="activeSlide === 4"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 scale-105"
            x-transition:enter-end="opacity-100 scale-100"
            class="aspect-[16/7] md:aspect-[21/9] lg:aspect-[3/1]">
            <img src="{{ asset('images/carousel/carousel4.png') }}"
                class="w-full h-full object-cover"
                loading="lazy"
                alt="Penawaran Spesial">
        </div>

            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 z-10">
                <template x-for="i in slides">
                    <button @click="activeSlide = i"
                        :class="activeSlide === i ? 'bg-white w-8' : 'bg-white/50 w-2'"
                        class="h-2 rounded-full transition-all duration-300 shadow-sm">
                    </button>
                </template>
            </div>

            <button @click="activeSlide = activeSlide === 1 ? slides : activeSlide - 1"
                class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/40 p-2 rounded-full text-white hidden md:block">
                ‹
            </button>

            <button @click="activeSlide = activeSlide === slides ? 1 : activeSlide + 1"
                class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/40 p-2 rounded-full text-white hidden md:block">
                ›
            </button>
        </div>
    </div>
</section>



<style>
    @keyframes kenburns {
        0% { transform: scale(1); }
        100% { transform: scale(1.15); }
    }
    .animate-ken-burns {
        animation: kenburns 10s ease-out forwards;
    }
    [x-cloak] { display: none !important; }
</style>


<section class="w-full bg-white py-12">
    <div class="mx-auto max-w-[95%] lg:max-w-[80%] bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
        
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h2 class="text-xl md:text-2xl font-bold text-gray-900">Jelajahi Kategori</h2>
                <p class="text-[12px] text-gray-500 font-medium">Temukan apa yang kamu butuhkan di koleksi pilihan kami</p>
            </div>
            
            <div class="hidden md:flex gap-2">
                <button class="p-2 rounded-full border border-gray-200 hover:bg-gray-50 transition active:scale-90">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#6B4F3B]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button class="p-2 rounded-full border border-gray-200 hover:bg-gray-50 transition active:scale-90">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#6B4F3B]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="flex flex-nowrap overflow-x-auto md:grid md:grid-cols-5 gap-3 md:gap-4 no-scrollbar snap-x">
            
            @foreach($categories as $category)
            <a href="{{ route('products.all', ['kategori[]' => $category->nama_kategori]) }}" 
               class="min-w-[100px] md:min-w-0 group flex flex-col items-center p-2 md:p-3 border border-gray-100 rounded-xl hover:border-[#6B4F3B] hover:shadow-md transition-all duration-300 bg-white snap-center">
                
                <div class="w-full aspect-square mb-2 overflow-hidden rounded-lg bg-gray-50 flex items-center justify-center">
                   @if($category->gambar)
                    <img src="{{ asset('images/categories/' . $category->gambar) }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        loading="lazy"
                        alt="{{ ucfirst($category->nama_kategori) }}"
                        onerror="this.src='{{ asset('images/default-product.jpg') }}'">
                    @else
                        <img src="/images/default-product.jpg" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" 
                             loading="lazy"
                             alt="{{ ucfirst($category->nama_kategori) }}">
                    @endif
                </div>

                <h3 class="text-center text-[10px] md:text-[11px] font-bold text-gray-700 group-hover:text-[#6B4F3B] uppercase tracking-tighter transition-colors">
                    {{ ucfirst($category->nama_kategori) }}
                </h3>
            </a>
            @endforeach

        </div>
    </div>
</section>


<section id="koleksi" class="py-16 md:py-24 bg-[#ffffff]" x-data="{ openFilter: false }">
    <div class="mx-auto max-w-[95%] lg:max-w-[80%] px-4 md:px-0">

        <div class="mb-10 flex items-center gap-8 border-b border-[#4A3428]/20">
            <a href="{{ route('home', array_merge(request()->query(), ['tab' => 'for-you'])) }}"
               class="tab-link pb-4 font-black text-sm md:text-base
               {{ request('tab', 'for-you') === 'for-you'
                    ? 'text-[#4A3428] border-b-2 border-[#4A3428]'
                    : 'text-[#4A3428]/40 hover:text-[#4A3428]' }}">
                Untuk Kamu
            </a>

            <a href="{{ route('home', array_merge(request()->query(), ['tab' => 'best-seller'])) }}"
               class="tab-link pb-4 font-bold text-sm md:text-base
               {{ request('tab') === 'best-seller'
                    ? 'text-[#4A3428] border-b-2 border-[#4A3428]'
                    : 'text-[#4A3428]/40 hover:text-[#4A3428]' }}">
                Produk Terlaris 
            </a>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-6">
            <div class="text-center md:text-left">
                <h2 class="text-[#4A3428] text-4xl md:text-5xl font-black tracking-tighter">
                    Produk <span class="text-[#D9B382] italic serif font-medium">Terbaik</span>
                </h2>
            </div>

            <div class="flex items-center gap-3 w-full md:w-auto">
                <button @click="openFilter = !openFilter"
                    class="flex-1 md:flex-none px-6 py-4 bg-white rounded-2xl text-[#4A3428] font-bold shadow-sm border border-[#4A3428]/10 flex items-center justify-center gap-2 hover:bg-[#4A3428] hover:text-white transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                    Filter & Urutkan
                </button>

                <form id="desktop-search-form" class="flex-1 md:w-64 relative">
                    <input type="text" name="keyword" value="{{ request('keyword') }}"
                        placeholder="Cari produk..."
                        class="w-full pl-4 pr-10 py-4 rounded-2xl border-none shadow-sm focus:ring-2 focus:ring-[#D9B382]">
                    <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-lg">🔍</button>
                </form>
            </div>
        </div>

        <div x-show="openFilter" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-5"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="bg-white rounded-[2.5rem] p-8 mb-12 shadow-xl border border-[#4A3428]/5"
             style="display: none;">
            
            <form id="filter-form">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div>
                        <label class="block text-[#4A3428] font-black uppercase text-[10px] tracking-[0.2em] mb-3">Kategori</label>
                        <select name="kategori" class="w-full p-4 rounded-xl bg-[#fdfaf5] border-none focus:ring-2 focus:ring-[#D9B382] font-bold text-[#4A3428]">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->nama_kategori }}" {{ request('kategori') == $category->nama_kategori ? 'selected' : '' }}>
                                    {{ ucfirst($category->nama_kategori) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[#4A3428] font-black uppercase text-[10px] tracking-[0.2em] mb-3">Urutkan Berdasarkan</label>
                        <select name="urutkan" class="w-full p-4 rounded-xl bg-[#fdfaf5] border-none focus:ring-2 focus:ring-[#D9B382] font-bold text-[#4A3428]">
                            <option value="terbaru" {{ request('urutkan') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                            <option value="terlaris" {{ request('urutkan') == 'terlaris' ? 'selected' : '' }}>Terlaris (Populer)</option>
                            <option value="harga_rendah" {{ request('urutkan') == 'harga_rendah' ? 'selected' : '' }}>Harga: Terendah</option>
                            <option value="harga_tinggi" {{ request('urutkan') == 'harga_tinggi' ? 'selected' : '' }}>Harga: Tertinggi</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-[#4A3428] font-black uppercase text-[10px] tracking-[0.2em] mb-3">Rentang Harga (Rp)</label>
                        <div class="flex items-center gap-3">
                            <input type="number" name="min_harga" placeholder="Min" value="{{ request('min_harga') }}" class="w-full p-4 rounded-xl bg-[#fdfaf5] border-none focus:ring-2 focus:ring-[#D9B382] font-bold">
                            <span class="text-[#4A3428]/30">—</span>
                            <input type="number" name="max_harga" placeholder="Max" value="{{ request('max_harga') }}" class="w-full p-4 rounded-xl bg-[#fdfaf5] border-none focus:ring-2 focus:ring-[#D9B382] font-bold">
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-xs text-gray-400 font-medium">Menampilkan hasil untuk: <span class="text-[#4A3428] italic" id="current-search-term">"{{ request('keyword') ?? 'Semua Produk' }}"</span></p>
                    <div class="flex gap-3 w-full md:w-auto">
                        <button type="button" id="reset-filter" class="flex-1 md:flex-none px-8 py-4 text-[#4A3428] font-bold text-center">Atur Ulang</button>
                        <button type="submit" class="flex-1 md:flex-none px-12 py-4 bg-[#4A3428] text-[#D9B382] font-black rounded-xl hover:bg-[#3D2B21] transition-all">Terapkan</button>
                    </div>
                </div>
            </form>
        </div>

        <div id="product-list-container">
            @include('partials.product-list', ['products' => $products])
        </div>

        <div class="mt-20 flex justify-center">
            <a href="{{ route('products.all') }}"
            class="group relative px-8 py-4 bg-[#4A3428] text-[#D9B382] font-bold rounded-2xl shadow-lg shadow-[#4A3428]/20 
                    overflow-hidden transition-all duration-300 hover:shadow-2xl hover:shadow-[#4A3428]/40 hover:-translate-y-1 active:scale-95 
                    flex items-center gap-3">
                
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:animate-[shimmer_1.5s_infinite]"></div>
                
                <span class="relative text-sm tracking-widest uppercase font-black">Lihat Semua</span>
                
                <div class="relative flex items-center justify-center w-8 h-8 bg-[#D9B382] text-[#4A3428] rounded-xl group-hover:rotate-[360deg] transition-transform duration-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </div>
            </a>
        </div>

        <div id="pagination-container">
            @include('partials.pagination', ['products' => $products])
        </div>

    </div>
</section>

<style>
    @keyframes fade-in-left { from { opacity: 0; transform: translateX(-40px); } to { opacity: 1; transform: translateX(0); } }
    @keyframes fade-in-right { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in-left { animation: fade-in-left 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    .animate-fade-in-right { animation: fade-in-right 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards; }

    .custom-pagination-wrapper nav { @apply inline-flex gap-2; }
    .custom-pagination-wrapper .pagination { @apply flex gap-2 list-none; }
    
    .custom-pagination-wrapper a, 
    .custom-pagination-wrapper span {
        @apply flex items-center justify-center min-w-[45px] h-[45px] rounded-xl border border-[#4A3428]/10 bg-white text-[#4A3428] font-black transition-all duration-300;
    }

    .custom-pagination-wrapper a:hover {
        @apply bg-[#4A3428] text-[#D9B382] transform -translate-y-1 shadow-lg shadow-[#4A3428]/20;
    }

    .custom-pagination-wrapper .active span,
    .custom-pagination-wrapper [aria-current="page"] span {
        @apply bg-[#4A3428] text-[#D9B382] border-[#4A3428] shadow-md;
    }

    .custom-pagination-wrapper .disabled span {
        @apply opacity-30 cursor-not-allowed bg-gray-50;
    }

    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
     @keyframes shimmer {
        100% { transform: translateX(100%); }
    }
</style>

@include('layouts.section')
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const productContainer = document.getElementById('product-list-container');
    const paginationContainer = document.getElementById('pagination-container');
    const koleksiSection = document.getElementById('koleksi');

    let currentFilters = {
        tab: '{{ request("tab", "for-you") }}',
        keyword: '{{ request("keyword") }}',
        kategori: '{{ request("kategori") }}',
        urutkan: '{{ request("urutkan") }}',
        min_harga: '{{ request("min_harga") }}',
        max_harga: '{{ request("max_harga") }}'
    };
    document.querySelectorAll('.tab-link').forEach(tabLink => {
        tabLink.addEventListener('click', function(e) {
            e.preventDefault();
            const url = new URL(this.href);
            currentFilters.tab = url.searchParams.get('tab') || 'for-you';
            loadProducts(false); 
        });
    });

    const filterForm = document.getElementById('filter-form');
    if (filterForm) {
        filterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            currentFilters.kategori = formData.get('kategori') || '';
            currentFilters.urutkan = formData.get('urutkan') || '';
            currentFilters.min_harga = formData.get('min_harga') || '';
            currentFilters.max_harga = formData.get('max_harga') || '';
            
            loadProducts(false); 
        });
    }

    const resetButton = document.getElementById('reset-filter');
    if (resetButton) {
        resetButton.addEventListener('click', function(e) {
            e.preventDefault();
            currentFilters.keyword = '';
            currentFilters.kategori = '';
            currentFilters.urutkan = '';
            currentFilters.min_harga = '';
            currentFilters.max_harga = '';
            
            filterForm.reset();
            
            const searchTermDisplay = document.getElementById('current-search-term');
            if (searchTermDisplay) {
                searchTermDisplay.textContent = '"Semua Produk"';
            }
            
            loadProducts(false);
        });
    }

    const desktopSearchForm = document.getElementById('desktop-search-form');
    if (desktopSearchForm) {
        desktopSearchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const keyword = this.querySelector('input[name="keyword"]').value;
            currentFilters.keyword = keyword;
            
            const searchTermDisplay = document.getElementById('current-search-term');
            if (searchTermDisplay) {
                searchTermDisplay.textContent = keyword ? `"${keyword}"` : '"Semua Produk"';
            }
            
            loadProducts(false);
        });
    }

    const mobileSearchForm = document.getElementById('mobile-search-form');
    if (mobileSearchForm) {
        mobileSearchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const keyword = this.querySelector('input[name="keyword"]').value;
            currentFilters.keyword = keyword;
            
            koleksiSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            
            loadProducts(false);
        });
    }

    document.addEventListener('click', function(e) {
        const paginationLink = e.target.closest('#pagination-container .pagination-link');
        
        if (paginationLink) {
            e.preventDefault();
            const url = new URL(paginationLink.href);
            const page = url.searchParams.get('page');
            
            loadProducts(true, page); 
        }
    });

    function loadProducts(shouldScroll = false, page = null) {
        productContainer.style.opacity = '0.4';
        productContainer.style.pointerEvents = 'none';
        
        if (paginationContainer) {
            paginationContainer.style.opacity = '0.4';
        }

        const params = new URLSearchParams();
        if (currentFilters.tab) params.append('tab', currentFilters.tab);
        if (currentFilters.keyword) params.append('keyword', currentFilters.keyword);
        if (currentFilters.kategori) params.append('kategori', currentFilters.kategori);
        if (currentFilters.urutkan) params.append('urutkan', currentFilters.urutkan);
        if (currentFilters.min_harga) params.append('min_harga', currentFilters.min_harga);
        if (currentFilters.max_harga) params.append('max_harga', currentFilters.max_harga);
        if (page) params.append('page', page);

        const url = `{{ route('home') }}?${params.toString()}`;

        fetch(url, {
            headers: { 
                "X-Requested-With": "XMLHttpRequest",
                "Accept": "application/json"
            }
        })
        .then(response => response.json())
        .then(data => {
      
            productContainer.innerHTML = data.products_html;
            productContainer.style.opacity = '1';
            productContainer.style.pointerEvents = 'auto';

           
            if (paginationContainer) {
                paginationContainer.innerHTML = data.pagination_html;
                paginationContainer.style.opacity = '1';
            }

            
            if (shouldScroll) {
                koleksiSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }

          
            window.history.pushState({}, '', url);

            
            updateActiveTab();
        })
        .catch(error => {
            console.error('Error:', error);
            productContainer.style.opacity = '1';
            productContainer.style.pointerEvents = 'auto';
            
            if (paginationContainer) {
                paginationContainer.style.opacity = '1';
            }
            
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Terjadi kesalahan saat memuat produk!',
                confirmButtonColor: '#4A3428'
            });
        });
    }

    function updateActiveTab() {
        const currentTab = currentFilters.tab || 'for-you';

        document.querySelectorAll('.tab-link').forEach(link => {
            link.classList.remove('text-[#4A3428]', 'border-b-2', 'border-[#4A3428]');
            link.classList.add('text-[#4A3428]/40');
        });

        const activeLink = document.querySelector(`.tab-link[href*="tab=${currentTab}"]`);
        if (activeLink) {
            activeLink.classList.remove('text-[#4A3428]/40');
            activeLink.classList.add('text-[#4A3428]', 'border-b-2', 'border-[#4A3428]');
        }
    }
});

function openQtyModal(productId, productName, maxStock) {
    if (maxStock <= 0) {
        Swal.fire({
            icon: 'error',
            title: 'Stok Habis',
            text: 'Maaf, produk ini sedang habis.',
            confirmButtonColor: '#4A3428',
        });
        return;
    }

    Swal.fire({
        title: 'Jumlah Pesanan',
        html: `
            <p class="mb-3 text-sm text-gray-600">
                Berapa banyak <b>${productName}</b> yang ingin Anda pesan?
            </p>

            <input 
                id="qty-input"
                type="number"
                class="swal2-input"
                value="1"
                min="1"
                max="${maxStock}"
            >

            <p class="mt-2 text-xs text-gray-500">
                Stok tersedia: <b>${maxStock}</b>
            </p>
        `,
        showCancelButton: true,
        confirmButtonText: 'Masukkan Keranjang',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#4A3428',
        cancelButtonColor: '#d33',
        focusConfirm: false,

        preConfirm: () => {
            const qty = parseInt(document.getElementById('qty-input').value);

            if (isNaN(qty) || qty < 1) {
                Swal.showValidationMessage('Jumlah minimal pembelian adalah 1');
                return false;
            }

            if (qty > maxStock) {
                Swal.showValidationMessage(
                    `Jumlah melebihi stok. Stok tersedia hanya ${maxStock}.`
                );
                return false;
            }

            return qty;
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
    .then(response => {
        if (!response.ok) throw new Error('Network response was not ok');
        return response.json();
    })
    .then(data => {
        if (data.success) {
            const event = new CustomEvent('updateCartCount', { 
                detail: { count: data.cart_count } 
            });
            window.dispatchEvent(event);

            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: data.message,
                showConfirmButton: false,
                timer: 1500,
                toast: true,
                position: 'top-end'
            });
        } else {
            Swal.fire('Gagal!', data.message || 'Terjadi kesalahan.', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire('Error!', 'Gagal menghubungi server.', 'error');
    });
}


document.addEventListener("DOMContentLoaded", function () {

    const urlParams = new URLSearchParams(window.location.search);

    if (
        urlParams.has('keyword') ||
        urlParams.has('kategori') ||
        urlParams.has('min_harga') ||
        urlParams.has('max_harga') ||
        urlParams.has('urutkan') ||
        urlParams.has('tab') ||
        urlParams.has('page')
    ) {
        const koleksiSection = document.getElementById("koleksi");

        if (koleksiSection) {
            setTimeout(() => {
                koleksiSection.scrollIntoView({
                    behavior: "smooth",
                    block: "start"
                });
            }, 200);
        }
    }

});
</script>

@if(session('login_success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'success',
            title: 'Login Berhasil',
            text: 'Selamat datang kembali!',
            confirmButtonColor: '#4A3428',
            timer: 1800,
            showConfirmButton: false
        });
    });
</script>
@endif

@endsection