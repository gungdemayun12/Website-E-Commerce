@extends('admin.layout')

@section('title', 'Manajemen Produk')

@section('content')
<div class="bg-[#fdfaf5] min-h-screen p-4 md:p-8">

    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-8">
        <div>
            <h2 class="text-4xl font-black text-[#4A3428] tracking-tighter">Inventory Produk</h2>
            <p class="text-[#4A3428]/50 font-medium mt-1">Kelola stok dan katalog Anda dengan mudah.</p>
        </div>

        <button onclick="openCreateModal()" 
        class="flex items-center justify-center gap-2 bg-[#4A3428] text-[#D9B382] px-6 py-3.5 rounded-2xl font-black shadow-xl shadow-[#4A3428]/20 hover:bg-[#3D2B21] transition-all transform hover:-translate-y-1">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
            TAMBAH PRODUK
        </button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-3xl p-6 border-2 border-[#D9B382]/20 shadow-sm hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Total Produk</p>
                    <h3 class="text-3xl font-black text-[#4A3428]">{{ $total_produk }}</h3>
                </div>
                <div class="bg-[#4A3428]/10 p-4 rounded-2xl">
                    <svg class="w-8 h-8 text-[#4A3428]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 border-2 border-[#D9B382]/20 shadow-sm hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Total Stok</p>
                    <h3 class="text-3xl font-black text-[#D9B382]">{{ number_format($total_stok) }}</h3>
                </div>
                <div class="bg-[#D9B382]/10 p-4 rounded-2xl">
                    <svg class="w-8 h-8 text-[#D9B382]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 border-2 border-orange-200 shadow-sm hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Stok Menipis</p>
                    <h3 class="text-3xl font-black text-orange-500">{{ $stok_menipis }}</h3>
                </div>
                <div class="bg-orange-50 p-4 rounded-2xl">
                    <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 border-2 border-red-200 shadow-sm hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Stok Habis</p>
                    <h3 class="text-3xl font-black text-red-500">{{ $stok_habis }}</h3>
                </div>
                <div class="bg-red-50 p-4 rounded-2xl">
                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('dashboard.index') }}" method="GET" class="mb-8">
        <div class="bg-white rounded-3xl p-6 border-2 border-[#D9B382]/20 shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                
                <div class="relative">
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Cari Produk</label>
                    <input 
                        type="text" 
                        name="keyword"
                        value="{{ request('keyword') }}"
                        placeholder="Nama produk..."
                        class="w-full pl-11 pr-4 py-3 rounded-xl bg-[#fdfaf5] border-2 border-[#D9B382]/20 focus:border-[#4A3428] outline-none transition-all font-bold text-[#4A3428] text-sm">
                    <span class="absolute bottom-3 left-3 text-[#D9B382]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                </div>

                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Kategori</label>
                    <select 
                        name="category_id"
                        class="w-full px-4 py-3 rounded-xl bg-[#fdfaf5] border-2 border-[#D9B382]/20 focus:border-[#4A3428] outline-none transition-all font-bold text-[#4A3428] text-sm">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Status Stok</label>
                    <select 
                        name="stok_filter"
                        class="w-full px-4 py-3 rounded-xl bg-[#fdfaf5] border-2 border-[#D9B382]/20 focus:border-[#4A3428] outline-none transition-all font-bold text-[#4A3428] text-sm">
                        <option value="">Semua Status</option>
                        <option value="tersedia" {{ request('stok_filter') == 'tersedia' ? 'selected' : '' }}>Stok Tersedia (>5)</option>
                        <option value="menipis" {{ request('stok_filter') == 'menipis' ? 'selected' : '' }}>Stok Menipis (1-5)</option>
                        <option value="habis" {{ request('stok_filter') == 'habis' ? 'selected' : '' }}>Stok Habis (0)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Urutkan</label>
                    <select 
                        name="sort_by"
                        class="w-full px-4 py-3 rounded-xl bg-[#fdfaf5] border-2 border-[#D9B382]/20 focus:border-[#4A3428] outline-none transition-all font-bold text-[#4A3428] text-sm">
                        <option value="terbaru" {{ request('sort_by') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                        <option value="terlama" {{ request('sort_by') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                        <option value="nama_az" {{ request('sort_by') == 'nama_az' ? 'selected' : '' }}>Nama (A-Z)</option>
                        <option value="nama_za" {{ request('sort_by') == 'nama_za' ? 'selected' : '' }}>Nama (Z-A)</option>
                        <option value="harga_terendah" {{ request('sort_by') == 'harga_terendah' ? 'selected' : '' }}>Harga Terendah</option>
                        <option value="harga_tertinggi" {{ request('sort_by') == 'harga_tertinggi' ? 'selected' : '' }}>Harga Tertinggi</option>
                        <option value="stok_terendah" {{ request('sort_by') == 'stok_terendah' ? 'selected' : '' }}>Stok Terendah</option>
                        <option value="stok_tertinggi" {{ request('sort_by') == 'stok_tertinggi' ? 'selected' : '' }}>Stok Tertinggi</option>
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
                    href="{{ route('dashboard.index') }}"
                    class="flex items-center gap-2 bg-gray-100 text-gray-600 px-6 py-2.5 rounded-xl font-black text-sm hover:bg-gray-200 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    RESET
                </a>

                @if(request('keyword') || request('category_id') || request('stok_filter') || request('sort_by'))
                <div class="ml-auto flex items-center gap-2 text-sm">
                    <span class="text-gray-400 font-medium">Filter aktif:</span>
                    <span class="bg-[#D9B382]/20 text-[#4A3428] px-3 py-1 rounded-lg font-bold">
                        {{ collect([request('keyword'), request('category_id'), request('stok_filter'), request('sort_by')])->filter()->count() }}
                    </span>
                </div>
                @endif
            </div>
        </div>
    </form>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @foreach ($product as $p)
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-[#D9B382]/10 overflow-hidden group hover:shadow-2xl hover:shadow-[#4A3428]/10 transition-all duration-500 flex flex-col relative">
            
            <div class="absolute top-4 left-4 z-10 flex flex-col gap-2">
                <span class="bg-white/90 backdrop-blur-md text-[#4A3428] text-[10px] font-black px-3 py-1.5 rounded-xl shadow-sm uppercase tracking-widest border border-[#D9B382]/20">
                    {{ $p->category_name ?? 'Tanpa Kategori' }}
                </span>
            </div>

            <div class="relative h-72 overflow-hidden bg-[#fdfaf5]">
                @if($p->gambar)
                    <img src="{{ asset('images/products/' . $p->gambar) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                @else
                    <div class="w-full h-full flex flex-col items-center justify-center text-[#D9B382]/40 gap-2">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span class="text-[10px] font-black uppercase tracking-widest">No Image</span>
                    </div>
                @endif

                @if($p->stok == 0)
                    <div class="absolute inset-0 bg-[#4A3428]/80 backdrop-blur-[2px] flex items-center justify-center">
                        <span class="text-[#D9B382] text-xl font-black tracking-tighter border-2 border-[#D9B382] px-4 py-1 rotate-12">OUT OF STOCK</span>
                    </div>
                @endif
            </div>

            <div class="p-6 flex flex-col flex-1 bg-white">
                <div class="mb-4">
                    <h3 class="text-xl font-black text-[#4A3428] tracking-tighter line-clamp-1 group-hover:text-[#D9B382] transition-colors">
                        {{ $p->nama_produk }}
                    </h3>
                    <p class="text-gray-400 text-xs font-medium mt-2 line-clamp-2 italic">
                        {{ $p->deskripsi ?? 'Tidak ada deskripsi produk.' }}
                    </p>
                </div>

                <div class="flex items-end justify-between mt-auto pt-4 border-t border-gray-50">
                    <div class="flex flex-col">
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Harga</span>
                        <span class="text-lg font-black text-[#4A3428]">Rp {{ number_format($p->harga, 0, ',', '.') }}</span>
                    </div>
                    <div class="text-right">
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest block">Sisa Stok</span>
                        <span class="text-sm font-black {{ $p->stok == 0 ? 'text-red-500' : ($p->stok <= 5 ? 'text-orange-500' : 'text-[#D9B382]') }}">
                            {{ $p->stok }} Pcs
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 mt-6">
                    <button type="button" 
                        data-id="{{ $p->id }}"
                        data-nama="{{ $p->nama_produk }}"
                        data-category="{{ $p->category_id }}"
                        data-harga="{{ $p->harga }}"
                        data-stok="{{ $p->stok }}"
                        data-gambar="{{ $p->gambar ?? '' }}"
                        data-tabel="{{ $p->tabel_ukuran ?? '' }}"
                        data-desk="{{ $p->deskripsi ?? '' }}"
                        data-desklengkap="{{ $p->deskripsi_lengkap ?? '' }}"
                        onclick="openEditModalFromButton(this)"
                        class="flex items-center justify-center gap-2 bg-[#fdfaf5] text-[#4A3428] font-black py-3 rounded-2xl border border-[#D9B382]/30 hover:bg-[#D9B382] hover:text-[#4A3428] transition-all text-xs cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        EDIT
                    </button>

                    <button type="button" onclick="confirmDelete({{ $p->id }})"
                        class="w-full flex items-center justify-center gap-2 bg-red-50 text-red-600 font-black py-3 rounded-2xl border border-red-100 hover:bg-red-600 hover:text-white transition-all text-xs">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        HAPUS
                    </button>

                    <form id="delete-form-{{ $p->id }}" action="{{ route('dashboard.produk.destroy', $p->id) }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

@if ($product->hasPages())
<div class="mt-14 flex justify-center">
    <nav class="flex items-center gap-2">

        @if ($product->onFirstPage())
            <span class="px-4 py-2 rounded-xl bg-gray-100 text-gray-400 cursor-not-allowed text-sm">
                ← Prev
            </span>
        @else
            <a href="{{ $product->previousPageUrl() }}"
               class="px-4 py-2 rounded-xl bg-white border border-[#D9B382]/40 text-sm font-medium hover:bg-[#D9B382]/10 transition">
                ← Prev
            </a>
        @endif

        @foreach ($product->getUrlRange(1, $product->lastPage()) as $page => $url)
            @if ($page == $product->currentPage())
                <span class="px-4 py-2 rounded-xl bg-[#D9B382] text-white text-sm font-semibold shadow">
                    {{ $page }}
                </span>
            @else
                <a href="{{ $url }}"
                   class="px-4 py-2 rounded-xl bg-white border border-[#D9B382]/40 text-sm font-medium hover:bg-[#D9B382]/10 transition">
                    {{ $page }}
                </a>
            @endif
        @endforeach

        @if ($product->hasMorePages())
            <a href="{{ $product->nextPageUrl() }}"
               class="px-4 py-2 rounded-xl bg-white border border-[#D9B382]/40 text-sm font-medium hover:bg-[#D9B382]/10 transition">
                Next →
            </a>
        @else
            <span class="px-4 py-2 rounded-xl bg-gray-100 text-gray-400 cursor-not-allowed text-sm">
                Next →
            </span>
        @endif

    </nav>
</div>
@endif

    @if($product->count() == 0)
    <div class="flex flex-col items-center justify-center py-32 text-[#4A3428]/30">
        <svg class="w-24 h-24 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
        <p class="text-xl font-black uppercase tracking-widest">Produk Tidak Ditemukan</p>
        <p class="text-sm font-medium italic mt-1">Tidak ada produk yang cocok dengan filter Anda.</p>
        <a href="{{ route('dashboard.index') }}" class="mt-6 bg-[#4A3428] text-[#D9B382] px-6 py-3 rounded-xl font-black text-sm hover:bg-[#3D2B21] transition-all">
            RESET FILTER
        </a>
    </div>
    @endif
</div>

<div id="createModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden items-center justify-center p-4 animate-fade-in">
    <div class="bg-white rounded-[3rem] shadow-2xl max-w-5xl w-full max-h-[90vh] overflow-hidden animate-slide-up">
        <div class="bg-gradient-to-r from-[#4A3428] to-[#2D1F18] p-8 relative overflow-hidden">
            <div class="absolute -right-16 -top-16 w-64 h-64 bg-[#D9B382]/10 rounded-full blur-3xl"></div>
            <div class="flex items-center justify-between relative z-10">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-[#D9B382] rounded-2xl flex items-center justify-center shadow-xl">
                        <svg class="w-7 h-7 text-[#4A3428]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-black text-white tracking-tighter uppercase">Tambah Produk Baru</h3>
                        <p class="text-[#D9B382]/60 text-xs font-bold tracking-widest uppercase">Lengkapi detail produk</p>
                    </div>
                </div>
                <button onclick="closeCreateModal()" class="text-white/60 hover:text-white transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>

        <form action="{{ route('dashboard.store') }}" method="POST" enctype="multipart/form-data" class="p-8 overflow-y-auto max-h-[calc(90vh-120px)]">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-5">
                    <div>
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Nama Produk</label>
                        <input type="text" name="nama_produk" required placeholder="Contoh: Silk Minimalist Dress"
                            class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428] placeholder:text-gray-300">
                    </div>

                    <div>
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Kategori Produk</label>
                        <select name="category_id" required
                            class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428]">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->nama_kategori }}</option>
                            @endforeach
                        </select>
                        <p class="text-[9px] text-gray-400 mt-1 ml-2 italic">Pilih kategori yang sesuai untuk produk</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Harga</label>
                            <input type="number" name="harga" required placeholder="0"
                                class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428]">
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Stok</label>
                            <input type="number" name="stok" required placeholder="0"
                                class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428]">
                        </div>
                    </div>

                    <div>
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Upload Gambar Produk</label>
                        <div class="relative">
                            <input type="file" name="gambar" id="gambar_create" accept="image/*" onchange="previewImageCreate(event)"
                                class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-dashed border-[#D9B382]/50 focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428] file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-black file:bg-[#4A3428] file:text-[#D9B382] hover:file:bg-[#3D2B21] file:cursor-pointer">
                            <p class="text-[9px] text-gray-400 mt-2 ml-2 italic">Format: JPG, PNG, GIF, WEBP (Max: 2MB)</p>
                        </div>
                        <div id="preview_create" class="mt-4 hidden">
                            <img id="preview_img_create" src="" alt="Preview" class="w-full h-48 object-cover rounded-2xl border-2 border-[#D9B382]/20">
                            <button type="button" onclick="removeImageCreate()" class="mt-2 text-xs text-red-500 font-bold hover:text-red-700">
                                <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                Hapus Gambar
                            </button>
                        </div>
                    </div>

                    <div>
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Tabel Ukuran</label>
                        <input type="text" name="tabel_ukuran" placeholder="S, M, L, XL atau ukuran custom"
                            class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428] placeholder:text-gray-300">
                        <p class="text-[9px] text-gray-400 mt-1 ml-2 italic">Contoh: S, M, L, XL atau All Size</p>
                    </div>
                </div>

                <div class="space-y-5">
                    <div>
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Deskripsi Singkat</label>
                        <textarea name="deskripsi" rows="3" placeholder="Jelaskan produk dalam 1 kalimat..."
                            class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-medium text-[#4A3428] placeholder:text-gray-300 resize-none"></textarea>
                    </div>

                    <div>
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Deskripsi Lengkap</label>
                        <textarea name="deskripsi_lengkap" rows="11" placeholder="Detail bahan, cara perawatan, dll..."
                            class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-medium text-[#4A3428] placeholder:text-gray-300 resize-none"></textarea>
                    </div>
                </div>
            </div>

            <div class="flex gap-4 mt-8 pt-6 border-t border-gray-100">
                <button type="button" onclick="closeCreateModal()"
                    class="flex-1 bg-gray-100 text-gray-600 font-black py-4 rounded-2xl hover:bg-gray-200 transition-all">
                    BATAL
                </button>
                <button type="submit"
                    class="flex-1 bg-[#4A3428] text-[#D9B382] font-black py-4 rounded-2xl shadow-xl shadow-[#4A3428]/20 hover:bg-[#3D2B21] transition-all flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    SIMPAN PRODUK
                </button>
            </div>
        </form>
    </div>
</div>

<div id="editModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden items-center justify-center p-4 animate-fade-in">
    <div class="bg-white rounded-[3rem] shadow-2xl max-w-5xl w-full max-h-[90vh] overflow-hidden animate-slide-up">
        <div class="bg-gradient-to-r from-[#4A3428] to-[#2D1F18] p-8 relative overflow-hidden">
            <div class="absolute -right-16 -top-16 w-64 h-64 bg-[#D9B382]/10 rounded-full blur-3xl"></div>
            <div class="flex items-center justify-between relative z-10">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl flex items-center justify-center shadow-xl">
                        <svg class="w-7 h-7 text-[#D9B382]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-black text-white tracking-tighter uppercase">Edit Produk</h3>
                        <p class="text-[#D9B382]/60 text-xs font-bold tracking-widest uppercase">Update detail produk</p>
                    </div>
                </div>
                <button onclick="closeEditModal()" class="text-white/60 hover:text-white transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>

        <form id="editForm" method="POST" enctype="multipart/form-data" class="p-8 overflow-y-auto max-h-[calc(90vh-120px)]">
            @csrf
            <input type="hidden" name="product_id" id="edit_product_id">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-5">
                    <div>
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Nama Produk</label>
                        <input type="text" name="nama_produk" id="edit_nama_produk" required
                            class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428]">
                    </div>

                    <div>
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Kategori Produk</label>
                        <select name="category_id" id="edit_category_id" required
                            class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428]">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Harga</label>
                            <input type="number" name="harga" id="edit_harga" required
                                class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428]">
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Stok</label>
                            <input type="number" name="stok" id="edit_stok" required
                                class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428]">
                        </div>
                    </div>

                    <div>
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Upload Gambar Produk</label>
                        <div class="relative">
                            <input type="file" name="gambar" id="gambar_edit" accept="image/*" onchange="previewImageEdit(event)"
                                class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-dashed border-[#D9B382]/50 focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428] file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-black file:bg-[#4A3428] file:text-[#D9B382] hover:file:bg-[#3D2B21] file:cursor-pointer">
                            <p class="text-[9px] text-gray-400 mt-2 ml-2 italic">Kosongkan jika tidak ingin mengubah gambar</p>
                        </div>
                        <div id="preview_edit" class="mt-4">
                            <img id="preview_img_edit" src="" alt="Preview" class="w-full h-48 object-cover rounded-2xl border-2 border-[#D9B382]/20">
                            <button type="button" onclick="removeImageEdit()" class="mt-2 text-xs text-red-500 font-bold hover:text-red-700">
                                <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                Hapus Gambar
                            </button>
                        </div>
                    </div>

                    <div>
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Tabel Ukuran</label>
                        <input type="text" name="tabel_ukuran" id="edit_tabel_ukuran" placeholder="S, M, L, XL"
                            class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428] placeholder:text-gray-300">
                        <p class="text-[9px] text-gray-400 mt-1 ml-2 italic">Contoh: S, M, L, XL atau All Size</p>
                    </div>
                </div>

                <div class="space-y-5">
                    <div>
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Deskripsi Singkat</label>
                        <textarea name="deskripsi" id="edit_deskripsi" rows="3"
                            class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-medium text-[#4A3428] resize-none"></textarea>
                    </div>

                    <div>
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Deskripsi Lengkap</label>
                        <textarea name="deskripsi_lengkap" id="edit_deskripsi_lengkap" rows="11"
                            class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-medium text-[#4A3428] resize-none"></textarea>
                    </div>
                </div>
            </div>

            <div class="flex gap-4 mt-8 pt-6 border-t border-gray-100">
                <button type="button" onclick="closeEditModal()"
                    class="flex-1 bg-gray-100 text-gray-600 font-black py-4 rounded-2xl hover:bg-gray-200 transition-all">
                    BATAL
                </button>
                <button type="submit"
                    class="flex-1 bg-[#4A3428] text-[#D9B382] font-black py-4 rounded-2xl shadow-xl shadow-[#4A3428]/20 hover:bg-[#3D2B21] transition-all flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    UPDATE PRODUK
                </button>
            </div>
        </form>
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
        iconColor: '#D9B382',
        customClass: {
            popup: 'rounded-3xl',
            title: 'font-black text-2xl',
            htmlContainer: 'font-bold'
        }
    });
@endif

function openCreateModal() {
    document.getElementById('createModal').classList.remove('hidden');
    document.getElementById('createModal').classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeCreateModal() {
    document.getElementById('createModal').classList.add('hidden');
    document.getElementById('createModal').classList.remove('flex');
    document.body.style.overflow = 'auto';
    document.getElementById('gambar_create').value = '';
    document.getElementById('preview_create').classList.add('hidden');
}

function previewImageCreate(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview_img_create').src = e.target.result;
            document.getElementById('preview_create').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}

function removeImageCreate() {
    document.getElementById('gambar_create').value = '';
    document.getElementById('preview_create').classList.add('hidden');
    document.getElementById('preview_img_create').src = '';
}

function openEditModalFromButton(button) {
    const id = button.getAttribute('data-id');
    const nama = button.getAttribute('data-nama');
    const category = button.getAttribute('data-category');
    const harga = button.getAttribute('data-harga');
    const stok = button.getAttribute('data-stok');
    const gambar = button.getAttribute('data-gambar');
    const tabel = button.getAttribute('data-tabel');
    const desk = button.getAttribute('data-desk');
    const desklengkap = button.getAttribute('data-desklengkap');
    
    openEditModal(id, nama, category, harga, stok, gambar, tabel, desk, desklengkap);
}

function openEditModal(id, nama_produk, category_id, harga, stok, gambar, tabel_ukuran, deskripsi, deskripsi_lengkap) {
    const modal = document.getElementById('editModal');
    const form = document.getElementById('editForm');
    
    form.action = `/dashboard/update/${id}`;
    
    document.getElementById('edit_product_id').value = id;
    document.getElementById('edit_nama_produk').value = nama_produk;
    document.getElementById('edit_category_id').value = category_id || '';
    document.getElementById('edit_harga').value = harga;
    document.getElementById('edit_stok').value = stok;
    document.getElementById('edit_tabel_ukuran').value = tabel_ukuran || '';
    document.getElementById('edit_deskripsi').value = deskripsi || '';
    document.getElementById('edit_deskripsi_lengkap').value = deskripsi_lengkap || '';
    
    const previewDiv = document.getElementById('preview_edit');
    const previewImg = document.getElementById('preview_img_edit');
    
    if (gambar) {
        const imgSrc = `/images/products/${gambar}`;
        previewImg.src = imgSrc;
        previewDiv.setAttribute('data-current-img', imgSrc);
        previewDiv.classList.remove('hidden');
    } else {
        previewDiv.classList.add('hidden');
    }
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.getElementById('editModal').classList.remove('flex');
    document.body.style.overflow = 'auto';
    document.getElementById('gambar_edit').value = '';
}

function previewImageEdit(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview_img_edit').src = e.target.result;
            document.getElementById('preview_edit').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}

function removeImageEdit() {
    document.getElementById('gambar_edit').value = '';
    const currentImg = document.getElementById('preview_edit').getAttribute('data-current-img');
    if (currentImg) {
        document.getElementById('preview_img_edit').src = currentImg;
    } else {
        document.getElementById('preview_edit').classList.add('hidden');
    }
}

function confirmDelete(productId) {
    Swal.fire({
        title: 'Hapus Produk?',
        text: "Produk akan dihapus dari katalog secara permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#4A3428',
        cancelButtonColor: '#6b7280',
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
            document.getElementById(`delete-form-${productId}`).submit();
        }
    });
}

document.getElementById('createModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeCreateModal();
});

document.getElementById('editModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeEditModal();
});

document.addEventListener('keydown', function(e) {
    if (key === 'Escape') {
        closeCreateModal();
        closeEditModal();
    }
});
</script>

<style>
@keyframes bounce-in {
    0% { transform: scale(0.9); opacity: 0; }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); opacity: 1; }
}

@keyframes fade-in {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slide-up {
    from { transform: translateY(50px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

.animate-bounce-in {
    animation: bounce-in 0.5s ease-out;
}

.animate-fade-in {
    animation: fade-in 0.3s ease-out;
}

.animate-slide-up {
    animation: slide-up 0.4s ease-out;
}
</style>
@endsection