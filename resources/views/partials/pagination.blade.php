<div class="mt-16 flex justify-center">
    <nav class="inline-flex items-center space-x-2">
        @if ($products->onFirstPage())
            <span class="px-4 py-2 rounded-full bg-gray-300 text-gray-500 cursor-not-allowed select-none shadow-sm text-sm font-bold">Sebelumnya</span>
        @else
            <a href="{{ $products->previousPageUrl() }}" class="pagination-link px-4 py-2 rounded-full bg-[#D9B382] text-white font-bold shadow-lg hover:bg-[#c8a36b] transition-all duration-300 text-sm">
                Sebelumnya
            </a>
        @endif

        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
            @if ($page == $products->currentPage())
                <span class="px-4 py-2 rounded-full bg-[#4A3428] text-white font-bold shadow-inner text-sm">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="pagination-link px-4 py-2 rounded-full bg-white text-gray-800 font-semibold shadow hover:bg-[#D9B382]/20 transition-all duration-300 text-sm">{{ $page }}</a>
            @endif
        @endforeach

        @if ($products->hasMorePages())
            <a href="{{ $products->nextPageUrl() }}" class="pagination-link px-4 py-2 rounded-full bg-[#D9B382] text-white font-bold shadow-lg hover:bg-[#c8a36b] transition-all duration-300 text-sm">
                Selanjutnya
            </a>
        @else
            <span class="px-4 py-2 rounded-full bg-gray-300 text-gray-500 cursor-not-allowed select-none shadow-sm text-sm font-bold">Selanjutnya</span>
        @endif
    </nav>
</div>  