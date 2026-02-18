@extends('layouts.app')

@section('title', $product->nama_produk . ' - Detail Produk')

@push('styles')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .custom-scrollbar::-webkit-scrollbar {
        height: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #fdfaf5;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: #D9B382;
        border-radius: 20px;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn { animation: fadeIn 0.4s ease-out forwards; }
    
    .swal2-popup {
        font-family: sans-serif !important;
    }
</style>
@endpush

@section('content')

<section class="bg-[#fdfaf5] min-h-screen pt-6 pb-32 md:pt-10 md:pb-20">
    <div class="container mx-auto px-4 md:px-16 lg:px-24 xl:px-32"> 

        <div class="flex flex-col lg:flex-row gap-8 lg:gap-16">
       
            <div class="w-full lg:w-1/2">
                <div class="lg:sticky lg:top-24">
             
                    <div class="relative overflow-hidden rounded-[2rem] lg:rounded-[3rem] bg-white shadow-xl lg:shadow-2xl border-[4px] lg:border-[10px] border-white rotate-0 lg:rotate-1 lg:hover:rotate-0 transition-transform duration-500">
                        @if($product->gambar)
                           <img src="{{ $product->gambar 
                                    ? asset('images/products/' . $product->gambar) 
                                    : asset('images/no-image.jpg') }}"
                             alt="{{ $product->nama_produk }}"
                             class="w-full object-cover aspect-[3/4]"
                             loading="lazy">


                        @else
                            <div class="w-full aspect-[3/4] flex items-center justify-center bg-gray-200 text-gray-400 font-bold">Tidak ada gambar</div>
                        @endif
                        <div class="absolute top-4 left-4 lg:top-6 lg:left-6 flex flex-col gap-2">
                            <span class="bg-[#4A3428] text-[#D9B382] ...">
                                {{ $product->nama_kategori ?? 'Tanpa Kategori' }}
                            </span> 

                        </div>
                    </div>
                </div>
            </div>

           
            <div class="w-full lg:w-1/2 space-y-6 lg:space-y-10">
                <div class="space-y-3 lg:space-y-4">
                    <div class="flex items-center gap-3">
                        <span class="h-[2px] w-8 lg:w-12 bg-[#D9B382]"></span>
                        <span class="text-[#D9B382] font-black uppercase tracking-[0.2em] lg:tracking-[0.3em] text-xs lg:text-sm">In Stock ({{ $product->stok }})</span>
                    </div>
                    
                    <h1 class="text-3xl md:text-5xl lg:text-6xl font-black text-[#4A3428] leading-tight tracking-tighter">
                        {{ $product->nama_produk }}
                    </h1>
                    
                    <p class="text-2xl lg:text-3xl font-black text-[#D9B382]">
                        Rp {{ number_format($product->harga, 0, ',', '.') }}
                    </p>
                </div>

                <div class="space-y-4">
                    <h3 class="text-[#4A3428] font-black uppercase tracking-widest text-xs lg:text-sm underline decoration-[#D9B382] decoration-4 underline-offset-8">
                        Deskripsi Produk
                    </h3>
                 
                    <div class="text-[#4A3428]/70 leading-relaxed text-base lg:text-lg prose max-w-none">
                        {!! $product->deskripsi_lengkap ?? 'Belum ada deskripsi untuk produk ini.' !!}
                    </div>

                  
                    @if($sizeChartData['type'] !== 'none')
                    <div class="mt-8 lg:mt-10 space-y-4">
                        <h3 class="font-black text-[#4A3428] uppercase tracking-widest text-xs lg:text-sm">
                            @if($sizeChartData['type'] === 'detailed')
                                Size Chart
                            @elseif(in_array($sizeChartData['kategori'], ['sepatu', 'sandal']))
                                Ukuran Tersedia
                            @elseif($sizeChartData['kategori'] === 'topi')
                                Lingkar Kepala
                            @else
                                Ukuran
                            @endif
                        </h3>

                        @if($sizeChartData['type'] === 'detailed')
          
                            <p class="text-xs lg:text-sm text-[#4A3428]/70">
                                {{ implode(' x ', $sizeChartData['headers']) }} (cm)
                            </p>

                            <div class="overflow-x-auto rounded-xl border shadow bg-white custom-scrollbar pb-2">
                                <table class="min-w-full text-xs lg:text-sm text-[#4A3428] whitespace-nowrap">
                                    <thead class="bg-[#4A3428] text-[#D9B382]">
                                        <tr>
                                            <th class="p-3 lg:p-4 text-left font-black">Size</th>
                                            @foreach($sizeChartData['headers'] as $header)
                                                <th class="p-3 lg:p-4 text-center font-black">{{ $header }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y">
                                        @foreach($sizeChartData['sizes'] as $sizeData)
                                            @if(count($sizeData['dimensions']) == count($sizeChartData['headers']))
                                            <tr class="hover:bg-[#D9B382]/10 transition">
                                                <td class="p-3 lg:p-4 font-black">{{ $sizeData['size'] }}</td>
                                                @foreach($sizeData['dimensions'] as $dimension)
                                                    <td class="p-3 lg:p-4 text-center">{{ $dimension }}</td>
                                                @endforeach
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <p class="text-[10px] lg:text-xs text-[#4A3428]/60 italic">
                                * Toleransi ukuran 1–2 cm.
                            </p>

                        @elseif($sizeChartData['type'] === 'simple_list')
                            <div class="bg-white p-4 lg:p-6 rounded-xl border border-[#D9B382]/20">
                                <div class="flex flex-wrap gap-2">
                                    @foreach($sizeChartData['sizes'] as $sizeData)
                                        <span class="bg-[#4A3428] text-[#D9B382] px-4 py-2 rounded-lg font-black text-sm">
                                            {{ $sizeData['size'] }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>

                        @elseif($sizeChartData['type'] === 'text')
                            <div class="bg-white p-4 lg:p-6 rounded-xl border border-[#D9B382]/20">
                                <p class="text-[#4A3428] font-bold text-sm lg:text-base">
                                    {{ $sizeChartData['sizes'][0]['size'] }}
                                </p>
                            </div>
                        @endif
                    </div>
                    @endif
                </div>

         
                <div class="hidden md:block pt-6 border-t border-[#D9B382]/20 space-y-6">
                    <form id="directCheckoutFormDesktop" action="{{ route('cart.direct') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                     
                        <div class="space-y-3">
                            <label class="text-xs font-black uppercase tracking-widest text-[#4A3428]/70">Pilih Ukuran</label>
                            <select name="size" id="sizeSelectDesktop" required class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-[#D9B382]/20 focus:ring-2 focus:ring-[#D9B382] focus:border-[#D9B382] font-bold text-[#4A3428] text-base">
                                <option value="">-- Pilih Ukuran --</option>
                                @if($sizeChartData['type'] !== 'none')
                                    @foreach($sizeChartData['sizes'] as $sizeData)
                                        <option value="{{ $sizeData['size'] }}">{{ $sizeData['size'] }}</option>
                                    @endforeach
                                @else
                                    <option value="All Size">All Size</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="XXL">XXL</option>
                                @endif
                            </select>
                        </div>

                       
                        <div class="space-y-3">
                            <label class="text-xs font-black uppercase tracking-widest text-[#4A3428]/70">Jumlah</label>
                            <div class="flex items-center gap-4">
                                <button type="button" onclick="decreaseQty('Desktop')" class="w-12 h-12 rounded-xl bg-[#4A3428] text-[#D9B382] hover:bg-[#D9B382] hover:text-[#4A3428] font-black transition-all flex items-center justify-center">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" name="quantity" id="quantityInputDesktop" value="1" min="1" max="{{ $product->stok }}" readonly class="w-20 text-center text-2xl font-black text-[#4A3428] bg-transparent border-none focus:ring-0">
                                <button type="button" onclick="increaseQty('Desktop')" class="w-12 h-12 rounded-xl bg-[#4A3428] text-[#D9B382] hover:bg-[#D9B382] hover:text-[#4A3428] font-black transition-all flex items-center justify-center">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <span class="text-sm text-[#4A3428]/60 font-medium ml-2">Stok: {{ $product->stok }}</span>
                            </div>
                        </div>
                        
                        <button type="button" 
                            onclick="validateAndSubmit('Desktop')"
                            class="w-full bg-[#4A3428] text-[#D9B382] font-black py-5 rounded-2xl shadow-xl shadow-[#4A3428]/20 hover:bg-[#3D2B21] transition-all transform hover:-translate-y-1 flex items-center justify-center gap-4 text-lg mt-6">
                            <i class="fas fa-shopping-bag"></i>
                            PESAN SEKARANG
                        </button>
                    </form>
                </div>

                <div class="bg-white p-4 lg:p-6 rounded-2xl lg:rounded-3xl border border-[#D9B382]/20 flex items-center gap-4 lg:gap-6">
                    <div class="text-3xl lg:text-4xl">🚚</div>
                    <div>
                        <p class="text-[#4A3428] font-bold text-sm lg:text-base">Gratis Ongkir Seluruh Indonesia</p>
                        <p class="text-xs lg:text-sm text-gray-400 font-medium">Khusus pembelian di atas Rp 500.000</p>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-12 lg:my-20 border-[#D9B382]/20">

        <div class="max-w-4xl mx-auto">
            <h2 class="text-2xl md:text-4xl font-black text-[#4A3428] mb-8 lg:mb-12 tracking-tighter uppercase italic text-center md:text-left">Apa Kata Mereka?</h2>
            <div class="bg-white p-6 lg:p-8 rounded-[2rem] lg:rounded-[2.5rem] shadow-xl border border-[#D9B382]/10 mb-10 lg:mb-16">
                <form id="reviewForm" action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 lg:space-y-6">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Nama Anda</label>
                        <input type="text" name="nama" required class="w-full bg-[#fdfaf5] border-none rounded-xl focus:ring-2 focus:ring-[#D9B382] font-bold text-[#4A3428] text-sm py-3" placeholder="Masukkan nama Anda...">
                    </div>

                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Rating</label>
                            <select name="rating" class="w-full bg-[#fdfaf5] border-none rounded-xl focus:ring-2 focus:ring-[#D9B382] font-bold text-[#4A3428] text-sm py-3">
                                <option value="5">⭐⭐⭐⭐⭐ Sangat Puas</option>
                                <option value="4">⭐⭐⭐⭐ Puas</option>
                                <option value="3">⭐⭐⭐ Cukup</option>
                                <option value="2">⭐⭐ Buruk</option>
                                <option value="1">⭐ Sangat Buruk</option>
                            </select>
                        </div>
                        <div class="flex-1">
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Foto Produk</label>
                            <input type="file" name="foto" class="w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-full file:border-0 file:bg-[#D9B382]/10 file:text-[#4A3428] file:font-bold hover:file:bg-[#D9B382]/20 cursor-pointer">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Pesan Ulasan</label>
                        <textarea name="komentar" rows="4" required class="w-full bg-[#fdfaf5] border-none rounded-2xl focus:ring-2 focus:ring-[#D9B382] p-4 text-[#4A3428] text-sm" placeholder="Ceritakan pengalamanmu..."></textarea>
                    </div>

                    <button type="submit" class="w-full md:w-auto bg-[#4A3428] text-[#D9B382] px-8 py-3 lg:px-10 lg:py-4 rounded-xl font-black text-xs lg:text-sm tracking-widest hover:shadow-lg transition-all">KIRIM ULASAN</button>
                </form>
            </div>

          
            <div class="mb-8 flex flex-col gap-4 bg-white p-4 lg:p-6 rounded-2xl lg:rounded-[2rem] border border-[#D9B382]/10 relative z-30">
                <div class="flex flex-col md:flex-row justify-between gap-4">
                    <div class="flex gap-2 w-full md:w-auto flex-wrap">
                        <div class="relative inline-block text-left" id="dropdownRating">
                            <button onclick="toggleDropdown('ratingMenu')" class="flex items-center gap-2 lg:gap-3 px-4 py-2 lg:px-6 lg:py-3 rounded-xl border-2 border-[#4A3428] bg-[#4A3428] text-[#D9B382] font-black text-[10px] tracking-widest transition-all">
                                <span id="selectedRatingText">RATING</span>
                                <svg class="w-3 h-3 lg:w-4 lg:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div id="ratingMenu" class="hidden absolute left-0 mt-2 w-48 rounded-2xl shadow-xl bg-white border border-[#D9B382]/20 z-50 overflow-hidden">
                                <button onclick="filterReviews('all')" class="w-full text-left px-5 py-3 text-[10px] font-black hover:bg-[#fdfaf5] text-[#4A3428] border-b border-gray-50">SEMUA</button>
                                @for($i=5; $i>=1; $i--)
                                <button onclick="filterReviews({{ $i }})" class="w-full text-left px-5 py-3 text-[10px] font-black hover:bg-[#fdfaf5] text-[#4A3428] border-b border-gray-50">{{ $i }} BINTANG</button>
                                @endfor
                            </div>
                        </div>

                   
                        <div class="relative inline-block text-left" id="dropdownSort">
                            <button onclick="toggleDropdown('sortMenu')" class="flex items-center gap-2 lg:gap-3 px-4 py-2 lg:px-6 lg:py-3 rounded-xl border-2 border-gray-100 bg-white text-gray-400 font-black text-[10px] tracking-widest transition-all hover:border-[#D9B382]">
                                <span id="selectedSortText">TERBARU</span>
                                <svg class="w-3 h-3 lg:w-4 lg:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div id="sortMenu" class="hidden absolute left-0 mt-2 w-48 rounded-2xl shadow-xl bg-white border border-[#D9B382]/20 z-50 overflow-hidden">
                                <button onclick="sortReviews('newest')" class="w-full text-left px-5 py-3 text-[10px] font-black hover:bg-[#fdfaf5] text-[#4A3428] border-b border-gray-50">TERBARU</button>
                                <button onclick="sortReviews('oldest')" class="w-full text-left px-5 py-3 text-[10px] font-black hover:bg-[#fdfaf5] text-[#4A3428] border-b border-gray-50">TERLAMA</button>
                            </div>
                        </div>
                    </div>
                
                    <div class="flex items-center justify-between md:justify-end gap-4">
                        <label class="relative inline-flex items-center cursor-pointer group">
                            <input type="checkbox" id="filterFoto" onchange="filterReviews()" class="sr-only peer">
                            <div class="w-9 h-5 lg:w-11 lg:h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 lg:after:h-5 lg:after:w-5 after:transition-all peer-checked:bg-[#D9B382]"></div>
                            <span class="ml-2 lg:ml-3 text-[9px] lg:text-[10px] font-black text-[#4A3428] uppercase tracking-widest">Hanya Gambar</span>
                        </label>
                        <p id="review-counter" class="text-[10px] lg:text-xs font-bold text-gray-400 uppercase tracking-widest border-l pl-4 border-gray-100">{{ $reviews->count() }} Ulasan</p>
                    </div>
                </div>
            </div>

            <div id="reviews-wrapper" class="flex flex-col gap-10 lg:gap-16">
                @forelse($reviews as $review)
                @php
                    $dataReview = explode('|', $review->komentar);
                    $namaUser = $dataReview[0] ?? 'Anonim';
                    $isiKomentar = $dataReview[1] ?? '';
                    $inisial = strtoupper(substr($namaUser, 0, 1));
                    $thisReplies = $replies->where('parent_id', $review->id);
                @endphp
                <div class="review-card group animate-fadeIn pb-8 lg:pb-12 border-b-2 border-gray-100 last:border-0" 
                     data-rating="{{ $review->rating }}" 
                     data-has-photo="{{ $review->foto ? 'true' : 'false' }}"
                     data-time="{{ strtotime($review->created_at) }}">
                    <div class="flex gap-4">
                        <div class="h-10 w-10 md:h-14 md:w-14 shrink-0 rounded-full bg-[#4A3428] flex items-center justify-center text-[#D9B382] font-black text-lg md:text-xl shadow-lg">
                            {{ $inisial }}
                        </div>
                        
                        <div class="flex-1 min-w-0"> 
                            <div class="flex flex-col md:flex-row md:items-center justify-between mb-2">
                                <h4 class="font-black text-[#4A3428] uppercase tracking-tight text-xs md:text-sm truncate">{{ $namaUser }}</h4>
                                <span class="text-[9px] md:text-[10px] text-gray-400 font-bold italic">{{ date('d M Y', strtotime($review->created_at)) }}</span>
                            </div>
                            
                            <div class="flex mb-2 text-[10px]">
                                @for($i=1; $i<=5; $i++)
                                    <span class="{{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-200' }}">★</span>
                                @endfor
                            </div>
                            
                            <div class="text-[#4A3428]/80 leading-relaxed mb-4 text-sm md:text-lg break-words">
                                {{ $isiKomentar }}
                            </div>

                            @if($review->foto)
                              <img src="{{ $review->foto 
                                    ? asset('images/reviews/' . $review->foto) 
                                    : asset('images/no-image.jpg') }}"
                             class="w-32 h-32 md:w-48 md:h-48 object-cover rounded-2xl md:rounded-3xl mb-4 border-4 border-white shadow-md cursor-pointer hover:scale-105 transition-transform"
                             loading="lazy">

                            @endif

                            <div class="flex items-center gap-4 lg:gap-6 mt-3">
                                <button onclick="vote({{ $review->id }}, 'like')" class="flex items-center gap-2 text-xs font-black text-gray-400 hover:text-green-600 transition-colors">
                                    👍 <span id="likes-{{ $review->id }}">{{ $review->likes }}</span>
                                </button>
                                <button onclick="vote({{ $review->id }}, 'dislike')" class="flex items-center gap-2 text-xs font-black text-gray-400 hover:text-red-600 transition-colors">
                                    👎 <span id="dislikes-{{ $review->id }}">{{ $review->dislikes }}</span>
                                </button>
                                <button onclick="toggleReplyForm({{ $review->id }})" class="text-[10px] font-black text-[#D9B382] uppercase tracking-widest hover:underline">Balas</button>
                                
                                @if($thisReplies->count() > 0)
                                <button onclick="toggleRepliesList({{ $review->id }})" id="btn-toggle-{{ $review->id }}" class="text-[10px] font-black text-blue-500 uppercase tracking-widest hover:underline">
                                    {{ $thisReplies->count() }} Balasan
                                </button>
                                @endif
                            </div>

                           
                            <div id="reply-box-{{ $review->id }}" class="hidden mt-4 animate-fadeIn">
                                <form action="{{ route('reviews.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="parent_id" value="{{ $review->id }}">
                                    <input type="text" name="nama" required class="w-full mb-2 bg-[#fdfaf5] border-none rounded-lg text-xs font-bold py-2" placeholder="Nama Anda...">
                                    <textarea name="komentar" required class="w-full bg-white border-2 border-[#D9B382]/20 rounded-xl p-3 text-xs md:text-sm focus:ring-0 focus:border-[#D9B382]" placeholder="Tulis balasan..."></textarea>
                                    <button type="submit" class="mt-2 bg-[#4A3428] text-[#D9B382] px-4 py-2 rounded-lg text-[10px] font-black uppercase">Kirim</button>
                                </form>
                            </div>

                          
                            <div id="replies-container-{{ $review->id }}" class="hidden mt-4 space-y-3 border-l-2 border-[#D9B382]/20 pl-4 md:pl-6">
                                @foreach($thisReplies as $index => $reply)
                                @php
                                    $dataReply = explode('|', $reply->komentar);
                                    $namaReply = $dataReply[0] ?? 'Anonim';
                                    $isiReply = $dataReply[1] ?? '';
                                    $inisialReply = strtoupper(substr($namaReply, 0, 1));
                                @endphp
                                <div class="reply-item-{{ $review->id }} bg-[#fdfaf5] p-3 md:p-5 rounded-xl {{ $index >= 3 ? 'hidden' : '' }}">
                                    <div class="flex gap-3 items-start">
                                        <div class="h-8 w-8 shrink-0 rounded-full bg-[#D9B382] flex items-center justify-center text-white font-black text-xs uppercase shadow-sm">
                                            {{ $inisialReply }}
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex justify-between items-center mb-1">
                                                <h5 class="text-[10px] md:text-xs font-black text-[#4A3428] uppercase truncate">{{ $namaReply }}</h5>
                                                <span class="text-[8px] md:text-[9px] text-gray-400">{{ date('d M', strtotime($reply->created_at)) }}</span>
                                            </div>
                                            <div class="text-xs md:text-sm text-[#4A3428]/80 mb-2 break-words">{{ $isiReply }}</div>
                                            
                                            <div class="flex items-center gap-3">
                                                <button onclick="vote({{ $reply->id }}, 'like')" class="flex items-center gap-1 text-[9px] font-bold text-gray-400 hover:text-green-600">
                                                    👍 <span id="likes-{{ $reply->id }}">{{ $reply->likes }}</span>
                                                </button>
                                                <button onclick="vote({{ $reply->id }}, 'dislike')" class="flex items-center gap-1 text-[9px] font-bold text-gray-400 hover:text-red-600">
                                                    👎 <span id="dislikes-{{ $reply->id }}">{{ $reply->dislikes }}</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                                <div class="flex gap-4">
                                    @if($thisReplies->count() > 3)
                                    <button onclick="loadMoreReplies({{ $review->id }})" id="load-more-{{ $review->id }}" class="text-[10px] font-black text-green-600 uppercase tracking-widest hover:underline">
                                        Lainnya
                                    </button>
                                    @endif
                                    <button onclick="toggleRepliesList({{ $review->id }})" class="text-[10px] font-black text-red-400 uppercase tracking-widest hover:underline">
                                        Tutup
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-10">
                    <p class="text-4xl mb-2">🍃</p>
                    <p id="no-review-msg" class="text-gray-400 italic font-medium">Belum ada ulasan.</p>
                </div>
                @endforelse
                <p id="filtered-empty-msg" class="hidden text-center text-gray-400 italic">Tidak ada ulasan yang sesuai filter.</p>
            </div>
        </div>
    </div>
</section>


<div class="fixed bottom-0 left-0 right-0 bg-white shadow-[0_-4px_10px_rgba(0,0,0,0.05)] border-t border-[#fdfaf5] p-4 md:hidden z-50">
    <form id="directCheckoutFormMobile" action="{{ route('cart.direct') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        
      
        <div class="mb-3">
            <select name="size" id="sizeSelectMobile" required class="w-full px-4 py-2.5 rounded-xl bg-[#fdfaf5] border-2 border-[#D9B382]/20 focus:ring-2 focus:ring-[#D9B382] font-bold text-[#4A3428] text-sm">
                <option value="">Pilih Ukuran</option>
                @if($sizeChartData['type'] !== 'none')
                    @foreach($sizeChartData['sizes'] as $sizeData)
                        <option value="{{ $sizeData['size'] }}">{{ $sizeData['size'] }}</option>
                    @endforeach
                @else
                    <option value="All Size">All Size</option>
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                    <option value="XXL">XXL</option>
                @endif
            </select>
        </div>

        <div class="flex items-center gap-4">
           
            <div class="flex items-center gap-2 bg-[#fdfaf5] rounded-xl px-3 py-2">
                <button type="button" onclick="decreaseQty('Mobile')" class="w-8 h-8 flex items-center justify-center rounded-lg bg-[#4A3428] text-[#D9B382] active:scale-95">
                    <i class="fas fa-minus text-xs"></i>
                </button>
                <input type="number" name="quantity" id="quantityInputMobile" value="1" min="1" max="{{ $product->stok }}" readonly class="w-12 text-center text-lg font-black text-[#4A3428] bg-transparent border-none focus:ring-0 p-0">
                <button type="button" onclick="increaseQty('Mobile')" class="w-8 h-8 flex items-center justify-center rounded-lg bg-[#4A3428] text-[#D9B382] active:scale-95">
                    <i class="fas fa-plus text-xs"></i>
                </button>
            </div>
            
            
            <button type="button" 
                onclick="validateAndSubmit('Mobile')"
                class="flex-1 bg-[#4A3428] text-[#D9B382] py-3.5 rounded-xl font-black text-sm uppercase tracking-widest shadow-lg active:scale-95 transition-transform flex items-center justify-center gap-2">
                <i class="fas fa-shopping-bag"></i>
                Pesan
            </button>
        </div>
    </form>
</div>

<script>
    const maxStock = {{ $product->stok }};

    function increaseQty(device) {
        const input = document.getElementById('quantityInput' + device);
        let currentValue = parseInt(input.value);
        
        if (currentValue < maxStock) {
            input.value = currentValue + 1;
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Stok Terbatas',
                text: `Stok maksimal hanya ${maxStock} item`,
                confirmButtonColor: '#4A3428'
            });
        }
    }

    function decreaseQty(device) {
        const input = document.getElementById('quantityInput' + device);
        let currentValue = parseInt(input.value);
        
        if (currentValue > 1) {
            input.value = currentValue - 1;
        }
    }

    function validateAndSubmit(device) {
        const sizeSelect = document.getElementById('sizeSelect' + device);
        const quantityInput = document.getElementById('quantityInput' + device);
        
        if (!sizeSelect.value) {
            Swal.fire({
                icon: 'warning',
                title: 'Ukuran Belum Dipilih',
                text: 'Silakan pilih ukuran terlebih dahulu',
                confirmButtonColor: '#4A3428'
            });
            return;
        }

        const quantity = parseInt(quantityInput.value);
        if (quantity < 1) {
            Swal.fire({
                icon: 'warning',
                title: 'Jumlah Tidak Valid',
                text: 'Minimal pembelian 1 item',
                confirmButtonColor: '#4A3428'
            });
            return;
        }

        if (quantity > maxStock) {
            Swal.fire({
                icon: 'error',
                title: 'Stok Tidak Mencukupi',
                text: `Stok tersedia hanya ${maxStock} item`,
                confirmButtonColor: '#4A3428'
            });
            return;
        }

        const isAuthenticated = '{{ auth("customer")->check() }}';
        
        if (!isAuthenticated) {
            Swal.fire({
                title: 'Login Diperlukan',
                text: 'Anda harus login terlebih dahulu untuk melakukan pemesanan',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#4A3428',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Login Sekarang',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ route("customer.login") }}';
                }
            });
            return;
        }

        document.getElementById('directCheckoutForm' + device).submit();
    }

    let currentRatingFilter = 'all';

    document.getElementById('reviewForm').addEventListener('submit', function(e) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });

        Toast.fire({
            icon: 'info',
            title: 'Mengirim ulasan...'
        });
    });

    function toggleDropdown(menuId) {
        const menus = ['ratingMenu', 'sortMenu'];
        menus.forEach(id => {
            const el = document.getElementById(id);
            if(id === menuId) {
                el.classList.toggle('hidden');
            } else {
                el.classList.add('hidden');
            }
        });
    }

    window.onclick = function(event) {
        if (!event.target.closest('.relative')) {
            document.getElementById('ratingMenu')?.classList.add('hidden');
            document.getElementById('sortMenu')?.classList.add('hidden');
        }
    }

    function filterReviews(rating = currentRatingFilter) {
        currentRatingFilter = rating;
        const onlyPhoto = document.getElementById('filterFoto').checked;
        const cards = document.querySelectorAll('.review-card');
        let visibleCount = 0;

        const ratingText = rating === 'all' ? 'RATING' : rating + ' ★';
        document.getElementById('selectedRatingText').innerText = ratingText;
        document.getElementById('ratingMenu').classList.add('hidden');

        cards.forEach(card => {
            const cardRating = card.getAttribute('data-rating');
            const hasPhoto = card.getAttribute('data-has-photo') === 'true';
            
            const ratingMatch = (rating === 'all' || cardRating == rating);
            const photoMatch = (!onlyPhoto || hasPhoto);

            if(ratingMatch && photoMatch) {
                card.classList.remove('hidden');
                visibleCount++;
            } else {
                card.classList.add('hidden');
            }
        });

        document.getElementById('review-counter').innerText = `${visibleCount} Ulasan`;
        document.getElementById('filtered-empty-msg').classList.toggle('hidden', visibleCount > 0);
    }

    function sortReviews(order) {
        const wrapper = document.getElementById('reviews-wrapper');
        const cards = Array.from(wrapper.querySelectorAll('.review-card'));
        
        document.getElementById('selectedSortText').innerText = order === 'newest' ? 'TERBARU' : 'TERLAMA';
        document.getElementById('sortMenu').classList.add('hidden');

        cards.sort((a, b) => {
            const timeA = parseInt(a.getAttribute('data-time'));
            const timeB = parseInt(a.getAttribute('data-time'));
            return order === 'newest' ? timeB - timeA : timeA - timeB;
        });

        cards.forEach(card => wrapper.appendChild(card));
    }

    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success_review'))
            Swal.fire({
                icon: 'success',
                title: 'Terkirim!',
                text: "{{ session('success_review') }}",
                confirmButtonColor: '#4A3428',
                customClass: { popup: 'rounded-xl' }
            });
        @endif
    });

    function toggleReplyForm(id) {
        document.getElementById(`reply-box-${id}`).classList.toggle('hidden');
    }

    function toggleRepliesList(id) {
        const container = document.getElementById(`replies-container-${id}`);
        const btn = document.getElementById(`btn-toggle-${id}`);
        
        if (container.classList.contains('hidden')) {
            container.classList.remove('hidden');
            if(btn) btn.innerText = 'Tutup';
        } else {
            container.classList.add('hidden');
            const count = container.querySelectorAll('[class^="reply-item"]').length;
            if(btn) btn.innerText = `${count} Balasan`;
            resetReplies(id);
        }
    }

    function loadMoreReplies(id) {
        const hiddenItems = document.querySelectorAll(`.reply-item-${id}.hidden`);
        for (let i = 0; i < 3; i++) {
            if (hiddenItems[i]) {
                hiddenItems[i].classList.remove('hidden');
                hiddenItems[i].classList.add('animate-fadeIn');
            }
        }
        if (document.querySelectorAll(`.reply-item-${id}.hidden`).length === 0) {
            const loadBtn = document.getElementById(`load-more-${id}`);
            if(loadBtn) loadBtn.classList.add('hidden');
        }
    }

    function resetReplies(id) {
        const allItems = document.querySelectorAll(`.reply-item-${id}`);
        allItems.forEach((item, index) => {
            if (index >= 3) item.classList.add('hidden');
            else item.classList.remove('hidden');
        });
        const loadMoreBtn = document.getElementById(`load-more-${id}`);
        if(loadMoreBtn) loadMoreBtn.classList.remove('hidden');
    }

    async function vote(id, type) {
        try {
            const response = await fetch(`/reviews/${id}/vote`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ type: type })
            });
            const result = await response.json();
            if(result.success) {
                const counter = document.getElementById(`${type}s-${id}`);
                counter.innerText = result[type + 's'];
                counter.parentElement.classList.add('scale-125', 'text-[#4A3428]');
                setTimeout(() => counter.parentElement.classList.remove('scale-125', 'text-[#4A3428]'), 200);
            }
        } catch (error) {
            console.error("Gagal vote");
        }
    }
</script>
@endsection