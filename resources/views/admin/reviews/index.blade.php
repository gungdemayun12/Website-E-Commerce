@extends('admin.layout')

@section('title', 'Manajemen Review')

@section('content')
<div class="bg-[#fdfaf5] min-h-screen p-4 md:p-8">

  
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-8">
        <div>
            <h2 class="text-4xl font-black text-[#4A3428] tracking-tighter">Manajemen Review</h2>
            <p class="text-[#4A3428]/50 font-medium mt-1">Kelola review dan feedback dari customer.</p>
        </div>
    </div>

 
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
        <div class="bg-white rounded-3xl p-6 border-2 border-[#D9B382]/20 shadow-sm hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Total Review</p>
                    <h3 class="text-3xl font-black text-[#4A3428]">{{ $total_reviews }}</h3>
                </div>
                <div class="bg-[#4A3428]/10 p-4 rounded-2xl">
                    <svg class="w-8 h-8 text-[#4A3428]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 border-2 border-green-200 shadow-sm hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Rating Tinggi</p>
                    <h3 class="text-3xl font-black text-green-500">{{ $positive_reviews }}</h3>
                </div>
                <div class="bg-green-50 p-4 rounded-2xl">
                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 border-2 border-yellow-200 shadow-sm hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Rating Netral</p>
                    <h3 class="text-3xl font-black text-yellow-500">{{ $neutral_reviews }}</h3>
                </div>
                <div class="bg-yellow-50 p-4 rounded-2xl">
                    <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 border-2 border-red-200 shadow-sm hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Rating Rendah</p>
                    <h3 class="text-3xl font-black text-red-500">{{ $negative_reviews }}</h3>
                </div>
                <div class="bg-red-50 p-4 rounded-2xl">
                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 border-2 border-[#D9B382]/20 shadow-sm hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Rating Rata-rata</p>
                    <h3 class="text-3xl font-black text-[#D9B382]">{{ number_format($avg_rating, 1) }}</h3>
                </div>
                <div class="bg-[#D9B382]/10 p-4 rounded-2xl">
                    <svg class="w-8 h-8 text-[#D9B382]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
                </div>
            </div>
        </div>
    </div>

   
    <form action="{{ route('dashboard.review.index') }}" method="GET" class="mb-8">
        <div class="bg-white rounded-3xl p-6 border-2 border-[#D9B382]/20 shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                
                {{-- Search --}}
                <div class="relative">
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Cari Review</label>
                    <input 
                        type="text" 
                        name="keyword"
                        value="{{ request('keyword') }}"
                        placeholder="Nama user atau komentar..."
                        class="w-full pl-11 pr-4 py-3 rounded-xl bg-[#fdfaf5] border-2 border-[#D9B382]/20 focus:border-[#4A3428] outline-none transition-all font-bold text-[#4A3428] text-sm">
                    <span class="absolute bottom-3 left-3 text-[#D9B382]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                </div>

              
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Produk</label>
                    <select 
                        name="product_id"
                        class="w-full px-4 py-3 rounded-xl bg-[#fdfaf5] border-2 border-[#D9B382]/20 focus:border-[#4A3428] outline-none transition-all font-bold text-[#4A3428] text-sm">
                        <option value="">Semua Produk</option>
                        @foreach($products as $prod)
                            <option value="{{ $prod->id }}" {{ request('product_id') == $prod->id ? 'selected' : '' }}>
                                {{ $prod->nama_produk }}
                            </option>
                        @endforeach
                    </select>
                </div>

               
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Filter Rating</label>
                    <select 
                        name="rating_filter"
                        class="w-full px-4 py-3 rounded-xl bg-[#fdfaf5] border-2 border-[#D9B382]/20 focus:border-[#4A3428] outline-none transition-all font-bold text-[#4A3428] text-sm">
                        <option value="">Semua Rating</option>
                        <option value="positive" {{ request('rating_filter') == 'positive' ? 'selected' : '' }}>Positif (4-5★)</option>
                        <option value="neutral" {{ request('rating_filter') == 'neutral' ? 'selected' : '' }}>Netral (3★)</option>
                        <option value="negative" {{ request('rating_filter') == 'negative' ? 'selected' : '' }}>Negatif (1-2★)</option>
                    </select>
                </div>

              
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Urutkan</label>
                    <select 
                        name="sort_by"
                        class="w-full px-4 py-3 rounded-xl bg-[#fdfaf5] border-2 border-[#D9B382]/20 focus:border-[#4A3428] outline-none transition-all font-bold text-[#4A3428] text-sm">
                        <option value="terbaru" {{ request('sort_by') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                        <option value="terlama" {{ request('sort_by') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                        <option value="rating_tertinggi" {{ request('sort_by') == 'rating_tertinggi' ? 'selected' : '' }}>Rating Tertinggi</option>
                        <option value="rating_terendah" {{ request('sort_by') == 'rating_terendah' ? 'selected' : '' }}>Rating Terendah</option>
                        <option value="likes_terbanyak" {{ request('sort_by') == 'likes_terbanyak' ? 'selected' : '' }}>Likes Terbanyak</option>
                        <option value="dislikes_terbanyak" {{ request('sort_by') == 'dislikes_terbanyak' ? 'selected' : '' }}>Dislikes Terbanyak</option>
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
                    href="{{ route('dashboard.review.index') }}"
                    class="flex items-center gap-2 bg-gray-100 text-gray-600 px-6 py-2.5 rounded-xl font-black text-sm hover:bg-gray-200 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    RESET
                </a>

           
                @if(request('keyword') || request('product_id') || request('rating_filter') || request('sort_by'))
                <div class="ml-auto flex items-center gap-2 text-sm">
                    <span class="text-gray-400 font-medium">Filter aktif:</span>
                    <span class="bg-[#D9B382]/20 text-[#4A3428] px-3 py-1 rounded-lg font-bold">
                        {{ collect([request('keyword'), request('product_id'), request('rating_filter'), request('sort_by')])->filter()->count() }}
                    </span>
                </div>
                @endif
            </div>
        </div>
    </form>

    <div class="grid grid-cols-1 gap-6">
        @foreach ($reviews as $review)
        <div class="bg-white rounded-3xl shadow-sm border border-[#D9B382]/10 overflow-hidden hover:shadow-xl transition-all duration-500">
            
            <div class="p-6 bg-gradient-to-r from-[#fdfaf5] to-white border-b border-gray-100">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex items-start gap-4 flex-1">
                        <div class="w-14 h-14 rounded-2xl bg-[#D9B382]/20 flex items-center justify-center flex-shrink-0">
                            <span class="text-2xl font-black text-[#4A3428]">
                                {{ strtoupper(substr($review->user->name ?? 'U', 0, 1)) }}
                            </span>
                        </div>

                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <h4 class="text-lg font-black text-[#4A3428]">{{ $review->user->name ?? 'User Tidak Diketahui' }}</h4>
                                <span class="text-xs text-gray-400 font-medium">{{ $review->created_at->diffForHumans() }}</span>
                            </div>

                            <div class="flex items-center gap-2 mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                                    </svg>
                                @endfor
                                <span class="text-sm font-black text-[#4A3428] ml-1">{{ $review->rating }}/5</span>
                            </div>

                            <div class="inline-flex items-center gap-2 bg-white px-4 py-1.5 rounded-xl border border-[#D9B382]/20">
                                <svg class="w-4 h-4 text-[#D9B382]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                <span class="text-xs font-bold text-[#4A3428]">{{ $review->product->nama_produk ?? 'Produk Dihapus' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <button type="button" onclick="openReplyModal( {{ $review->id }},'{{ $review->user->name ?? 'User Tidak Diketahui' }}','{{ $review->product->nama_produk ?? 'Produk' }}')"

                            class="flex items-center gap-2 bg-[#4A3428] text-[#D9B382] px-4 py-2 rounded-xl font-black text-xs hover:bg-[#3D2B21] transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>
                            BALAS
                        </button>

                        <button type="button" onclick="confirmDelete({{ $review->id }})"
                            class="flex items-center gap-2 bg-red-50 text-red-600 px-4 py-2 rounded-xl font-black text-xs hover:bg-red-600 hover:text-white transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            HAPUS
                        </button>
                    </div>
                </div>
            </div>

           
            <div class="p-6">
                <p class="text-[#4A3428] font-medium leading-relaxed mb-4">{{ $review->komentar }}</p>

              
                @if($review->foto)
                <div class="mb-4">
                    <img src="{{ asset('storage/reviews/' . $review->foto) }}" alt="Review Photo" 
                         class="rounded-2xl border-2 border-[#D9B382]/20 max-w-md w-full h-64 object-cover cursor-pointer hover:scale-105 transition-transform"
                         onclick="openImageModal('{{ asset('storage/reviews/' . $review->foto) }}')">
                </div>
                @endif

                
                <div class="flex items-center gap-6 pt-4 border-t border-gray-100">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 24 24"><path d="M14 9V5a3 3 0 00-3-3l-4 9v11h11.28a2 2 0 002-1.7l1.38-9a2 2 0 00-2-2.3zM7 11H4a2 2 0 00-2 2v7a2 2 0 002 2h3"></path></svg>
                        <span class="text-sm font-bold text-gray-600">{{ $review->likes }} Likes</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M10 15v4a3 3 0 003 3l4-9V2H5.72a2 2 0 00-2 1.7l-1.38 9a2 2 0 002 2.3zm7-13h2.67A2.31 2.31 0 0122 4v7a2.31 2.31 0 01-2.33 2H17"></path></svg>
                        <span class="text-sm font-bold text-gray-600">{{ $review->dislikes }} Dislikes</span>
                    </div>
                </div>

                
                @php
                    $replies = \App\Models\Review::where('parent_id', $review->id)->with('user')->get();
                @endphp

                @if($replies->count() > 0)
                <div class="mt-6 space-y-4">
                    <h5 class="text-sm font-black text-[#4A3428] uppercase tracking-widest">Balasan Admin:</h5>
                    @foreach($replies as $reply)
                    <div class="bg-[#fdfaf5] rounded-2xl p-4 border-l-4 border-[#D9B382]">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 rounded-xl bg-[#4A3428] flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-[#D9B382]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"></path></svg>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="text-xs font-black text-[#4A3428]">{{ $reply->user->name ?? 'Admin' }}</span>
                                    <span class="text-[10px] text-gray-400">{{ $reply->created_at->diffForHumans() }}</span>
                                    <span class="bg-[#4A3428] text-white text-[9px] font-black px-2 py-0.5 rounded-full uppercase">Admin</span>
                                </div>
                                <p class="text-sm text-[#4A3428] font-medium">{{ $reply->komentar }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

           
            <form id="delete-form-{{ $review->id }}" action="{{ route('dashboard.review.destroy', $review->id) }}" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>

           
            <form id="ban-form-{{ $review->id }}" action="{{ route('dashboard.review.banUser', $review->id) }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
        @endforeach
    </div>

  
    @if ($reviews->hasPages())
    <div class="mt-14 flex justify-center">
        <nav class="flex items-center gap-2">
            @if ($reviews->onFirstPage())
                <span class="px-4 py-2 rounded-xl bg-gray-100 text-gray-400 cursor-not-allowed text-sm">← Prev</span>
            @else
                <a href="{{ $reviews->previousPageUrl() }}" class="px-4 py-2 rounded-xl bg-white border border-[#D9B382]/40 text-sm font-medium hover:bg-[#D9B382]/10 transition">← Prev</a>
            @endif

            @foreach ($reviews->getUrlRange(1, $reviews->lastPage()) as $page => $url)
                @if ($page == $reviews->currentPage())
                    <span class="px-4 py-2 rounded-xl bg-[#D9B382] text-white text-sm font-semibold shadow">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="px-4 py-2 rounded-xl bg-white border border-[#D9B382]/40 text-sm font-medium hover:bg-[#D9B382]/10 transition">{{ $page }}</a>
                @endif
            @endforeach

            @if ($reviews->hasMorePages())
                <a href="{{ $reviews->nextPageUrl() }}" class="px-4 py-2 rounded-xl bg-white border border-[#D9B382]/40 text-sm font-medium hover:bg-[#D9B382]/10 transition">Next →</a>
            @else
                <span class="px-4 py-2 rounded-xl bg-gray-100 text-gray-400 cursor-not-allowed text-sm">Next →</span>
            @endif
        </nav>
    </div>
    @endif

    
    @if($reviews->count() == 0)
    <div class="flex flex-col items-center justify-center py-32 text-[#4A3428]/30">
        <svg class="w-24 h-24 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
        <p class="text-xl font-black uppercase tracking-widest">Review Tidak Ditemukan</p>
        <p class="text-sm font-medium italic mt-1">Tidak ada review yang cocok dengan filter Anda.</p>
        <a href="{{ route('dashboard.review.index') }}" class="mt-6 bg-[#4A3428] text-[#D9B382] px-6 py-3 rounded-xl font-black text-sm hover:bg-[#3D2B21] transition-all">
            RESET FILTER
        </a>
    </div>
    @endif
</div>


<div id="replyModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden items-center justify-center p-4 animate-fade-in">
    <div class="bg-white rounded-[3rem] shadow-2xl max-w-2xl w-full overflow-hidden animate-slide-up">
        <div class="bg-gradient-to-r from-[#4A3428] to-[#2D1F18] p-8 relative overflow-hidden">
            <div class="absolute -right-16 -top-16 w-64 h-64 bg-[#D9B382]/10 rounded-full blur-3xl"></div>
            <div class="flex items-center justify-between relative z-10">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-[#D9B382] rounded-2xl flex items-center justify-center shadow-xl">
                        <svg class="w-7 h-7 text-[#4A3428]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-black text-white tracking-tighter uppercase">Balas Review</h3>
                        <p class="text-[#D9B382]/60 text-xs font-bold tracking-widest uppercase" id="replyModalSubtitle"></p>
                    </div>
                </div>
                <button onclick="closeReplyModal()" class="text-white/60 hover:text-white transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>

        <form id="replyForm" method="POST" class="p-8">
            @csrf
            <div class="space-y-5">
                <div>
                    <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Balasan Anda</label>
                    <textarea name="komentar" rows="6" required placeholder="Tulis balasan yang profesional dan membantu..."
                        class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-medium text-[#4A3428] placeholder:text-gray-300 resize-none"></textarea>
                    <p class="text-[9px] text-gray-400 mt-1 ml-2 italic">Maksimal 1000 karakter</p>
                </div>
            </div>

            <div class="flex gap-4 mt-8 pt-6 border-t border-gray-100">
                <button type="button" onclick="closeReplyModal()"
                    class="flex-1 bg-gray-100 text-gray-600 font-black py-4 rounded-2xl hover:bg-gray-200 transition-all">
                    BATAL
                </button>
                <button type="submit"
                    class="flex-1 bg-[#4A3428] text-[#D9B382] font-black py-4 rounded-2xl shadow-xl shadow-[#4A3428]/20 hover:bg-[#3D2B21] transition-all flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                    KIRIM BALASAN
                </button>
            </div>
        </form>
    </div>
</div>


<div id="imageModal" class="fixed inset-0 bg-black/90 z-50 hidden items-center justify-center p-4" onclick="closeImageModal()">
    <img id="imageModalImg" src="" alt="Review Photo" class="max-w-full max-h-[90vh] rounded-3xl">
</div>

{{-- SweetAlert2 CDN --}}
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


@if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '{{ session('error') }}',
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


function openReplyModal(reviewId, userName, productName) {
    const modal = document.getElementById('replyModal');
    const form = document.getElementById('replyForm');
    const subtitle = document.getElementById('replyModalSubtitle');
    
    form.action = `/dashboard/review/${reviewId}/reply`;
    subtitle.textContent = `Balas review ${userName} untuk ${productName}`;
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeReplyModal() {
    const modal = document.getElementById('replyModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = 'auto';
    document.getElementById('replyForm').reset();
}


function openImageModal(src) {
    const modal = document.getElementById('imageModal');
    document.getElementById('imageModalImg').src = src;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeImageModal() {
    const modal = document.getElementById('imageModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}


function confirmDelete(reviewId) {
    Swal.fire({
        title: 'Hapus Review?',
        text: "Review akan dihapus secara permanen!",
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
            document.getElementById(`delete-form-${reviewId}`).submit();
        }
    });
}


function confirmBanUser(reviewId, userName) {
    Swal.fire({
        title: 'Ban User?',
        html: `User <strong>${userName}</strong> akan di-ban dan semua reviewnya dihapus!<br><br><span class="text-red-500">Tindakan ini tidak dapat dibatalkan!</span>`,
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#1f2937',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Ban User!',
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
            document.getElementById(`ban-form-${reviewId}`).submit();
        }
    });
}


document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeReplyModal();
        closeImageModal();
    }
});
</script>

<style>
@keyframes fade-in {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slide-up {
    from { transform: translateY(50px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

.animate-fade-in {
    animation: fade-in 0.3s ease-out;
}

.animate-slide-up {
    animation: slide-up 0.4s ease-out;
}
</style>
@endsection