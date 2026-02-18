@extends('admin.layout')

@section('title', 'Manajemen Kategori')

@section('content')
<div class="bg-[#fdfaf5] min-h-screen p-4 md:p-8">

 
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-8">
        <div>
            <h2 class="text-4xl font-black text-[#4A3428] tracking-tighter">Manajemen Kategori</h2>
            <p class="text-[#4A3428]/50 font-medium mt-1">Kelola kategori produk Anda dengan mudah.</p>
        </div>

        <button onclick="openCreateModal()" 
        class="flex items-center justify-center gap-2 bg-[#4A3428] text-[#D9B382] px-6 py-3.5 rounded-2xl font-black shadow-xl shadow-[#4A3428]/20 hover:bg-[#3D2B21] transition-all transform hover:-translate-y-1">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
            TAMBAH KATEGORI
        </button>
    </div>

   
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-3xl p-6 border-2 border-[#D9B382]/20 shadow-sm hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Total Kategori</p>
                    <h3 class="text-3xl font-black text-[#4A3428]">{{ $total_kategori }}</h3>
                </div>
                <div class="bg-[#4A3428]/10 p-4 rounded-2xl">
                    <svg class="w-8 h-8 text-[#4A3428]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 border-2 border-[#D9B382]/20 shadow-sm hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Kategori Dengan Produk</p>
                    <h3 class="text-3xl font-black text-[#D9B382]">{{ $kategori_terpakai }}</h3>
                </div>
                <div class="bg-[#D9B382]/10 p-4 rounded-2xl">
                    <svg class="w-8 h-8 text-[#D9B382]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 border-2 border-orange-200 shadow-sm hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Kategori Kosong</p>
                    <h3 class="text-3xl font-black text-orange-500">{{ $kategori_kosong }}</h3>
                </div>
                <div class="bg-orange-50 p-4 rounded-2xl">
                    <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                </div>
            </div>
        </div>
    </div>

  
    <form action="{{ route('dashboard.kategori.index') }}" method="GET" class="mb-8">
        <div class="bg-white rounded-3xl p-6 border-2 border-[#D9B382]/20 shadow-sm">
            <div class="flex gap-4 items-end">
                <div class="flex-1 relative">
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Cari Kategori</label>
                    <input 
                        type="text" 
                        name="keyword"
                        value="{{ request('keyword') }}"
                        placeholder="Nama kategori..."
                        class="w-full pl-11 pr-4 py-3 rounded-xl bg-[#fdfaf5] border-2 border-[#D9B382]/20 focus:border-[#4A3428] outline-none transition-all font-bold text-[#4A3428] text-sm">
                    <span class="absolute bottom-3 left-3 text-[#D9B382]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                </div>
                
                <button 
                    type="submit"
                    class="flex items-center gap-2 bg-[#4A3428] text-[#D9B382] px-6 py-3 rounded-xl font-black text-sm hover:bg-[#3D2B21] transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    CARI
                </button>
                
                <a 
                    href="{{ route('dashboard.kategori.index') }}"
                    class="flex items-center gap-2 bg-gray-100 text-gray-600 px-6 py-3 rounded-xl font-black text-sm hover:bg-gray-200 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    RESET
                </a>
            </div>
        </div>
    </form>

  
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach ($categories as $cat)
        <div class="bg-white rounded-3xl shadow-sm border border-[#D9B382]/10 overflow-hidden group hover:shadow-2xl hover:shadow-[#4A3428]/10 transition-all duration-500 flex flex-col">
            
            <div class="relative h-48 overflow-hidden bg-[#fdfaf5]">
                @if($cat->gambar)
                    <img src="{{ asset('images/categories/' . $cat->gambar) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                @else
                    <div class="w-full h-full flex flex-col items-center justify-center text-[#D9B382]/40 gap-2">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                        <span class="text-[10px] font-black uppercase tracking-widest">No Image</span>
                    </div>
                @endif
            </div>

            <div class="p-6 flex flex-col flex-1">
                <div class="mb-4">
                    <h3 class="text-xl font-black text-[#4A3428] tracking-tighter line-clamp-1 group-hover:text-[#D9B382] transition-colors">
                        {{ $cat->nama_kategori }}
                    </h3>
                    <p class="text-gray-400 text-xs font-medium mt-2 italic">
                        Slug: {{ $cat->slug }}
                    </p>
                </div>

                <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-50">
                    <div class="flex flex-col">
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Total Produk</span>
                        <span class="text-lg font-black text-[#4A3428]">{{ $cat->product_count }} Item</span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 mt-6">
                    <button type="button" 
                        data-id="{{ $cat->id }}"
                        data-nama="{{ $cat->nama_kategori }}"
                        data-slug="{{ $cat->slug }}"
                        data-gambar="{{ $cat->gambar ?? '' }}"
                        onclick="openEditModalFromButton(this)"
                        class="flex items-center justify-center gap-2 bg-[#fdfaf5] text-[#4A3428] font-black py-3 rounded-2xl border border-[#D9B382]/30 hover:bg-[#D9B382] hover:text-[#4A3428] transition-all text-xs cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        EDIT
                    </button>

                    <button type="button" onclick="confirmDelete({{ $cat->id }}, {{ $cat->product_count }})"
                        class="w-full flex items-center justify-center gap-2 bg-red-50 text-red-600 font-black py-3 rounded-2xl border border-red-100 hover:bg-red-600 hover:text-white transition-all text-xs">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        HAPUS
                    </button>

                    <form id="delete-form-{{ $cat->id }}" action="{{ route('dashboard.kategori.destroy', $cat->id) }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>


    @if(count($categories) == 0)
    <div class="flex flex-col items-center justify-center py-32 text-[#4A3428]/30">
        <svg class="w-24 h-24 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
        <p class="text-xl font-black uppercase tracking-widest">Kategori Tidak Ditemukan</p>
        <p class="text-sm font-medium italic mt-1">Tidak ada kategori yang cocok dengan pencarian Anda.</p>
        <a href="{{ route('dashboard.kategori.index') }}" class="mt-6 bg-[#4A3428] text-[#D9B382] px-6 py-3 rounded-xl font-black text-sm hover:bg-[#3D2B21] transition-all">
            RESET PENCARIAN
        </a>
    </div>
    @endif
</div>


<div id="createModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden items-center justify-center p-4 animate-fade-in">
    <div class="bg-white rounded-[3rem] shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-hidden animate-slide-up">
        <div class="bg-gradient-to-r from-[#4A3428] to-[#2D1F18] p-8 relative overflow-hidden">
            <div class="absolute -right-16 -top-16 w-64 h-64 bg-[#D9B382]/10 rounded-full blur-3xl"></div>
            <div class="flex items-center justify-between relative z-10">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-[#D9B382] rounded-2xl flex items-center justify-center shadow-xl">
                        <svg class="w-7 h-7 text-[#4A3428]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-black text-white tracking-tighter uppercase">Tambah Kategori Baru</h3>
                        <p class="text-[#D9B382]/60 text-xs font-bold tracking-widest uppercase">Lengkapi detail kategori</p>
                    </div>
                </div>
                <button onclick="closeCreateModal()" class="text-white/60 hover:text-white transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>

        <form action="{{ route('dashboard.kategori.store') }}" method="POST" enctype="multipart/form-data" class="p-8 overflow-y-auto max-h-[calc(90vh-120px)]">
            @csrf
            <div class="space-y-5">
                <div>
                    <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Nama Kategori</label>
                    <input type="text" name="nama_kategori" required placeholder="Contoh: Outerwear"
                        class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428] placeholder:text-gray-300">
                </div>

                <div>
                    <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Slug</label>
                    <input type="text" name="slug" required placeholder="Contoh: outerwear"
                        class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428] placeholder:text-gray-300">
                    <p class="text-[9px] text-gray-400 mt-1 ml-2 italic">Slug akan digunakan di URL (huruf kecil, tanpa spasi)</p>
                </div>

                <div>
                    <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Upload Gambar Kategori</label>
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
            </div>

            <div class="flex gap-4 mt-8 pt-6 border-t border-gray-100">
                <button type="button" onclick="closeCreateModal()"
                    class="flex-1 bg-gray-100 text-gray-600 font-black py-4 rounded-2xl hover:bg-gray-200 transition-all">
                    BATAL
                </button>
                <button type="submit"
                    class="flex-1 bg-[#4A3428] text-[#D9B382] font-black py-4 rounded-2xl shadow-xl shadow-[#4A3428]/20 hover:bg-[#3D2B21] transition-all flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    SIMPAN KATEGORI
                </button>
            </div>
        </form>
    </div>
</div>


<div id="editModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden items-center justify-center p-4 animate-fade-in">
    <div class="bg-white rounded-[3rem] shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-hidden animate-slide-up">
        <div class="bg-gradient-to-r from-[#4A3428] to-[#2D1F18] p-8 relative overflow-hidden">
            <div class="absolute -right-16 -top-16 w-64 h-64 bg-[#D9B382]/10 rounded-full blur-3xl"></div>
            <div class="flex items-center justify-between relative z-10">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl flex items-center justify-center shadow-xl">
                        <svg class="w-7 h-7 text-[#D9B382]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-black text-white tracking-tighter uppercase">Edit Kategori</h3>
                        <p class="text-[#D9B382]/60 text-xs font-bold tracking-widest uppercase">Update detail kategori</p>
                    </div>
                </div>
                <button onclick="closeEditModal()" class="text-white/60 hover:text-white transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>

        <form id="editForm" method="POST" enctype="multipart/form-data" class="p-8 overflow-y-auto max-h-[calc(90vh-120px)]">
            @csrf
            @method('PUT')
            <input type="hidden" name="category_id" id="edit_category_id">
            
            <div class="space-y-5">
                <div>
                    <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Nama Kategori</label>
                    <input type="text" name="nama_kategori" id="edit_nama_kategori" required
                        class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428]">
                </div>

                <div>
                    <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Slug</label>
                    <input type="text" name="slug" id="edit_slug" required
                        class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428]">
                    <p class="text-[9px] text-gray-400 mt-1 ml-2 italic">Slug akan digunakan di URL (huruf kecil, tanpa spasi)</p>
                </div>

                <div>
                    <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Upload Gambar Kategori</label>
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
            </div>

            <div class="flex gap-4 mt-8 pt-6 border-t border-gray-100">
                <button type="button" onclick="closeEditModal()"
                    class="flex-1 bg-gray-100 text-gray-600 font-black py-4 rounded-2xl hover:bg-gray-200 transition-all">
                    BATAL
                </button>
                <button type="submit"
                    class="flex-1 bg-[#4A3428] text-[#D9B382] font-black py-4 rounded-2xl shadow-xl shadow-[#4A3428]/20 hover:bg-[#3D2B21] transition-all flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    UPDATE KATEGORI
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
    const slug = button.getAttribute('data-slug');
    const gambar = button.getAttribute('data-gambar');
    
    openEditModal(id, nama, slug, gambar);
}


function openEditModal(id, nama_kategori, slug, gambar) {
    const modal = document.getElementById('editModal');
    const form = document.getElementById('editForm');
    

    form.action = `/dashboard/kategori/${id}`;

    
  
    document.getElementById('edit_category_id').value = id;
    document.getElementById('edit_nama_kategori').value = nama_kategori;
    document.getElementById('edit_slug').value = slug;
    

    const previewDiv = document.getElementById('preview_edit');
    const previewImg = document.getElementById('preview_img_edit');
    
    if (gambar) {
        const imgSrc = `/images/categories/${gambar}`;
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


function confirmDelete(categoryId, productCount) {
    if (productCount > 0) {
        Swal.fire({
            title: 'Tidak Bisa Hapus!',
            text: `Kategori ini masih memiliki ${productCount} produk. Hapus atau pindahkan produk terlebih dahulu!`,
            icon: 'error',
            confirmButtonColor: '#4A3428',
            confirmButtonText: 'OK',
            background: '#fff',
            color: '#4A3428',
            customClass: {
                popup: 'rounded-3xl',
                title: 'font-black text-2xl',
                htmlContainer: 'font-bold',
                confirmButton: 'font-black px-6 py-3 rounded-xl'
            }
        });
        return;
    }
    
    Swal.fire({
        title: 'Hapus Kategori?',
        text: "Kategori akan dihapus secara permanen!",
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
            document.getElementById(`delete-form-${categoryId}`).submit();
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
    if (e.key === 'Escape') {
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