<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
    @forelse($products as $item)
        <div class="group relative flex flex-col bg-white/40 backdrop-blur-sm rounded-[2rem] md:rounded-[3rem] p-2 md:p-3 border border-white/50 shadow-sm hover:shadow-2xl hover:shadow-[#4A3428]/10 transition-all duration-500 hover:-translate-y-2">
            
            <div class="relative aspect-[4/5] md:aspect-[3/4] rounded-[1.8rem] md:rounded-[2.5rem] overflow-hidden bg-[#F3E5D8] z-10">
                @if($item->gambar)
                    <img src="{{ asset('images/products/' . $item->gambar) }}"
                        alt="{{ $item->nama_produk }}"
                        class="w-full h-full object-cover transition-transform duration-[1.5s] ease-out group-hover:scale-110"
                        loading="lazy"
                        onerror="this.src='{{ asset('images/default-product.jpg') }}'">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400 text-xs font-bold uppercase">
                        Tidak Ada Gambar
                    </div>
                @endif


                <div class="absolute top-3 left-3 md:top-4 md:left-4 flex flex-col gap-2 z-30">
                    @if($item->stok < 5 && $item->stok > 0)
                        <span class="bg-red-500/90 backdrop-blur-md text-white text-[8px] md:text-[9px] font-black px-2 py-1 md:px-3 md:py-1.5 rounded-full uppercase tracking-wider italic shadow-lg shadow-red-500/20">🔥 Stok Tipis</span>
                    @elseif($item->stok <= 0)
                        <span class="bg-black/80 backdrop-blur-md text-white text-[8px] md:text-[9px] font-black px-2 py-1 md:px-3 md:py-1.5 rounded-full uppercase tracking-wider italic shadow-lg">Habis</span>
                    @endif
                </div>

                <div class="absolute inset-0 bg-gradient-to-t from-[#4A3428]/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 hidden md:flex items-end justify-center pb-8 gap-3 z-30">
                    <a href="{{ route('produk.show', $item->id) }}" class="p-4 bg-white/90 backdrop-blur-md text-[#4A3428] rounded-2xl hover:bg-[#D9B382] hover:text-white transition-all transform translate-y-4 group-hover:translate-y-0 duration-500">
                        <i class="fas fa-eye text-lg"></i>
                    </a>
                    <button type="button" 
                        onclick="handleAuthAction('{{ auth('customer')->check() }}', () => openQtyModal('{{ $item->id }}', '{{ $item->nama_produk }}', {{ $item->stok }}))"
                        class="p-4 bg-[#D9B382] text-white rounded-2xl hover:bg-white hover:text-[#4A3428] transition-all transform translate-y-4 group-hover:translate-y-0 duration-500 delay-75">
                        <i class="fas fa-plus text-lg"></i>
                    </button>
                </div>

                <div class="absolute bottom-3 left-0 right-0 px-3 flex justify-between items-center md:hidden z-40">
                    <a href="{{ route('produk.show', $item->id) }}" 
                       class="w-9 h-9 bg-white/40 backdrop-blur-xl border border-white/40 rounded-full flex items-center justify-center shadow-xl active:scale-75 transition-all text-white hover:bg-white/60">
                        <i class="fas fa-eye text-xs"></i>
                    </a>
                    
                    <button type="button"
                            onclick="handleAuthAction('{{ auth('customer')->check() }}', () => openQtyModal('{{ $item->id }}', '{{ $item->nama_produk }}', {{ $item->stok }}))"
                            class="w-9 h-9 bg-[#D9B382] text-[#4A3428] rounded-full flex items-center justify-center shadow-xl active:scale-75 transition-all hover:bg-white border border-white/20">
                        <i class="fas fa-plus text-xs"></i>
                    </button>
                </div>
            </div>

            <div class="mt-4 px-2 pb-2">
                <h3 class="text-[13px] md:text-lg font-bold text-[#4A3428] line-clamp-1 group-hover:text-[#D9B382] transition-colors tracking-tight">{{ $item->nama_produk }}</h3>
                <div class="flex items-center gap-2 mt-1 mb-2">
                    <span class="text-[10px] md:text-xs font-black text-yellow-500 flex items-center gap-1">
                        <i class="fas fa-star"></i> {{ $item->rating ?? '4.9' }}
                    </span>
                    <span class="text-[10px] text-gray-400 font-medium">({{ $item->total_terjual ?? 0 }} terjual)</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-base md:text-2xl font-black text-[#4A3428]">
                        <span class="text-[10px] md:text-sm">Rp</span>{{ number_format($item->harga, 0, ',', '.') }}
                    </span>
                </div>
            </div>

            @if($item->stok <= 0)
                <div class="absolute inset-0 bg-white/30 backdrop-blur-[1px] rounded-[2rem] md:rounded-[3rem] z-20 pointer-events-none"></div>
            @endif
        </div>
    @empty
        <div class="col-span-full py-20 text-center text-[#4A3428]/40 font-black italic tracking-widest text-xl">
            PRODUK TIDAK DITEMUKAN
        </div>
    @endforelse
</div>