@php
$notifications = [];
if(auth('customer')->check()) {
    $notifications = DB::table('notifications')
        ->where('customer_id', auth('customer')->id())
        ->latest()
        ->limit(5)
        ->get();
}
@endphp




    <nav class="sticky top-0 z-[100] bg-[#4A3428] shadow-2xl border-b border-[#5D4637]">
        
        <div class="hidden md:block border-b border-white/5 px-6 md:px-16 lg:px-24 xl:px-32 py-1.5">
            <div class="max-w-[1440px] mx-auto flex justify-between items-center text-[12px] font-medium text-[#F3E5D8]/70">
            <div class="flex items-center gap-4">
                <a href="https://maps.app.goo.gl/y9LYC31mMGqFYQLW7" target="blank" class="hover:text-[#D9B382] transition-all">Lokasi Kami</a>
                <span class="opacity-20">|</span>
                <div class="flex items-center gap-2 ml-1">
                    <span class="text-[11px] opacity-60">Ikuti kami di</span>
                    <a href="https://instagram.com/tokoanjay" target="_blank" class="hover:text-white transition-all transform hover:scale-110"><i class="fab fa-instagram text-sm"></i></a>
                    <a href="https://facebook.com/tokoanjay" target="_blank" class="hover:text-white transition-all transform hover:scale-110"><i class="fab fa-facebook text-sm"></i></a>
                    <a href="https://tiktok.com/tokoanjay" target="_blank" class="hover:text-white transition-all transform hover:scale-110"><i class="fab fa-tiktok text-sm"></i></a>
                </div>
            </div>
            
            <div class="flex gap-5 items-center">
                <div class="group relative cursor-pointer">
                    <div class="flex items-center gap-1.5 hover:text-white transition-colors">
                        <i class="far fa-bell"></i> Notifikasi
                    </div>
                    <div class="absolute right-0 mt-2 w-72 bg-white rounded-xl shadow-2xl border border-gray-100 p-4 invisible group-hover:visible opacity-0 group-hover:opacity-100 transition-all z-[120]">
                        <h4 class="text-[#4A3428] font-bold border-b pb-2 mb-2">Notifikasi Terbaru</h4>
                        <div class="space-y-2">
                            @forelse($notifications as $n)
                                <a href="{{ $n->link ?? '#' }}" class="flex gap-3 p-2 hover:bg-gray-50 rounded-lg transition-colors">
                                    <div class="w-10 h-10 bg-[#D9B382]/20 rounded-full flex items-center justify-center text-[#D9B382]">
                                        🔔
                                    </div>
                                    <div>
                                        <p class="text-[11px] text-gray-800 font-bold leading-tight">
                                            {{ $n->text }}
                                        </p>
                                        <p class="text-[10px] text-gray-500">
                                            {{ \Carbon\Carbon::parse($n->created_at)->diffForHumans() }}
                                        </p>
                                    </div>
                                </a>
                            @empty
                                <p class="text-[11px] text-gray-400 text-center py-4">
                                    Belum ada notifikasi
                                </p>
                            @endforelse
                        </div>

<a href="{{ route('customer.profile') }}#notification" 
   class="block text-center text-[11px] text-[#4A3428] font-bold mt-3 hover:underline">
   Lihat Semua
</a>

                    </div>
                </div>

                <a href="https://wa.me/6281234567890" target="_blank" class="hover:text-[#D9B382] flex items-center gap-1.5"><i class="far fa-question-circle"></i> Bantuan</a>
                </div>
            </div>
        </div>
    </div>

    <div class="px-4 md:px-16 lg:px-24 xl:px-32 py-3 md:pt-5 md:pb-3">
        <div class="max-w-[1440px] mx-auto flex items-center justify-between gap-4 md:gap-10">
            
      <a href="{{ url('home') }}" 
        class="flex items-center shrink-0 relative z-[110] md:-mt-2">
            <img src="{{ asset('images/logo ta.png') }}" 
                alt="Logo"
                class="h-14 md:h-16 w-14 md:w-16 rounded-full object-cover shadow-lg 
                        transition-all duration-300 hover:scale-110">
        </a>




            <div class="flex-1 max-w-2xl hidden sm:block">
                <form action="{{ route('home') }}" method="GET" class="relative flex items-center bg-white rounded-md p-1 group shadow-lg">
                    <input type="text" name="keyword" value="{{ request('keyword') }}" 
                        placeholder="Cari gaya terbaikmu di sini..." 
                        class="w-full px-4 py-2 text-sm md:text-base outline-none bg-transparent text-gray-800 placeholder-gray-400 font-medium">
                    <button type="submit" class="bg-[#4A3428] text-[#D9B382] px-4 md:px-7 py-2 rounded-md hover:bg-[#5D4637] transition-all flex items-center justify-center active:scale-95">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </form>
                <div class="flex gap-4 mt-2 text-[11px] text-[#F3E5D8]/80 overflow-x-auto scrollbar-hide whitespace-nowrap">
                    <a href="{{ route('home', ['keyword' => 'Kemeja']) }}" class="hover:text-[#D9B382]">Kemeja Pria</a>
                    <a href="{{ route('home', ['keyword' => 'Sepatu']) }}" class="hover:text-[#D9B382]">Sepatu Sneaker</a>
                    <a href="{{ route('home', ['keyword' => 'Jaket']) }}" class="hover:text-[#D9B382]">Jaket Denim</a>
                    <a href="{{ route('home', ['keyword' => 'Tas']) }}" class="hover:text-[#D9B382]">Tas Selempang</a>
                    <a href="{{ route('home', ['keyword' => 'Hoodie']) }}" class="hover:text-[#D9B382]">Hoodie Oversize</a>

                </div>
            </div>

            <div class="flex items-center gap-2 md:gap-6 shrink-0">
               @auth('customer')
                    <div class="relative group sm:hidden">
                        <button class="p-2 text-[#D9B382] hover:bg-white/10 rounded-full relative">
                            <i class="far fa-bell text-xl"></i>

                            @if(count($notifications) > 0)
                                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[9px] font-bold w-4 h-4 rounded-full flex items-center justify-center">
                                    {{ count($notifications) }}
                                </span>
                            @endif
                        </button>

                  
                        <div class="absolute right-0 mt-2 w-72 bg-white rounded-xl shadow-2xl border border-gray-100 p-4 
                                    invisible group-hover:visible opacity-0 group-hover:opacity-100 transition-all z-[200]">
                            <h4 class="text-[#4A3428] font-bold border-b pb-2 mb-2 text-sm">
                                Notifikasi
                            </h4>

                            <div class="space-y-2 max-h-64 overflow-y-auto">
                                @forelse($notifications as $n)
                                    <a href="{{ $n->link ?? '#' }}" class="flex gap-3 p-2 hover:bg-gray-50 rounded-lg transition-colors">
                                        <div class="w-9 h-9 bg-[#D9B382]/20 rounded-full flex items-center justify-center">
                                            🔔
                                        </div>
                                        <div>
                                            <p class="text-[11px] text-gray-800 font-bold leading-tight">
                                                {{ $n->text }}
                                            </p>
                                            <p class="text-[10px] text-gray-500">
                                                {{ \Carbon\Carbon::parse($n->created_at)->diffForHumans() }}
                                            </p>
                                        </div>
                                    </a>
                                @empty
                                    <p class="text-[11px] text-gray-400 text-center py-4">
                                        Belum ada notifikasi
                                    </p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    @endauth


                <a href="{{ route('cart.show') }}" class="relative group p-2 transition-transform active:scale-90">
                    <div class="relative">
                        <svg class="w-7 h-7 md:w-8 md:h-8 text-white group-hover:text-[#D9B382] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span id="cart-count-desktop" class="absolute -top-2 -right-2 bg-white text-[#4A3428] text-[10px] md:text-[11px] font-black min-w-[18px] h-[18px] md:min-w-[22px] md:h-[22px] flex items-center justify-center rounded-full border-2 border-[#4A3428] shadow-lg">
                            {{ count((array) session('cart')) }}
                        </span>
                    </div>
                </a>

                <div class="hidden md:flex items-center border-l border-white/20 pl-6 gap-4">
                    @auth('customer')
                        <div class="relative group">
                            <button class="flex items-center gap-3 hover:opacity-80 transition-all">
                                <div class="w-10 h-10 rounded-full border-2 border-[#D9B382] p-0.5 shadow-xl">
                                    <div class="w-full h-full rounded-full bg-[#D9B382] flex items-center justify-center">
                                        <svg class="w-5 h-5 text-[#4A3428]" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path></svg>
                                    </div>
                                </div>
                                <div class="text-left">
                                    <p class="text-[10px] text-[#D9B382] font-black uppercase tracking-widest leading-none">Hi, Welcome</p>
                                    <p class="text-sm text-white font-bold leading-tight">{{ Auth::guard('customer')->user()->username }}</p>
                                </div>
                            </button>
                            <div class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-2xl py-2 invisible group-hover:visible opacity-0 group-hover:opacity-100 transition-all transform translate-y-2 group-hover:translate-y-0 border border-gray-100 overflow-hidden">
                                <a href="{{ route('customer.profile') }}" class="flex items-center gap-3 px-5 py-3 text-sm font-bold text-[#4A3428] hover:bg-[#F3E5D8]">👤 Profil Saya</a>
                                <a href="/orders" class="flex items-center gap-3 px-5 py-3 text-sm font-bold text-[#4A3428] hover:bg-[#F3E5D8]">📦 Pesanan Saya</a>
                                <div class="border-t border-gray-100 my-1"></div>
                                <form action="{{ route('customer.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-5 py-3 text-sm font-bold text-red-500 hover:bg-red-50">🚪 Keluar</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="flex gap-3">
                            <a href="{{ url('/customer/login') }}" class="px-4 py-2 text-sm font-black text-[#D9B382] uppercase tracking-widest">Login</a>
                            <a href="{{ url('/customer/register') }}" class="px-6 py-2 bg-[#D9B382] text-[#4A3428] text-sm font-black rounded-lg hover:bg-white transition-all uppercase tracking-widest shadow-lg">Daftar</a>
                        </div>
                    @endauth
                </div>

                <button id="menu-toggle" class="md:hidden p-2 text-[#D9B382] active:scale-90 transition-all">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
            </div>
        </div>
    </div>
</nav>

<div id="mobile-sidebar" class="fixed top-0 right-0 h-full w-[85%] max-w-[320px] bg-white z-[150] translate-x-full transition-transform duration-500 ease-in-out shadow-[-20px_0_60px_rgba(0,0,0,0.3)] flex flex-col"> 
    <div class="p-6 border-b border-gray-200 bg-gradient-to-br from-[#4A3428] to-[#5D4637] flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-xl bg-[#D9B382] flex items-center justify-center shadow-lg transform -rotate-6">
                <i class="fas fa-shopping-bag text-[#4A3428] text-lg"></i>
            </div>
            <span class="text-white font-black tracking-widest uppercase text-lg italic">TOKO ANJAY</span>
        </div>
        <button id="close-sidebar" class="text-white w-10 h-10 flex items-center justify-center bg-white/10 rounded-full hover:bg-white/20 transition-all">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>

    @auth('customer')
    <div class="p-6 bg-gradient-to-br from-[#4A3428]/5 to-[#D9B382]/10 border-b border-gray-200">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-full bg-gradient-to-br from-[#4A3428] to-[#5D4637] border-3 border-[#D9B382] flex items-center justify-center text-white text-xl font-black shadow-lg">
                {{ substr(Auth::guard('customer')->user()->username, 0, 1) }}
            </div>
            <div>
                <p class="text-[#4A3428] font-bold text-base leading-tight">{{ Auth::guard('customer')->user()->username }}</p>
                <p class="text-[#D9B382] text-xs font-semibold uppercase mt-1 tracking-wider">Premium Member</p>
            </div>
        </div>
    </div>
    @endauth

    <div class="flex-1 overflow-y-auto p-5">
        <div class="space-y-2">
            <a href="{{ url('/home') }}" class="flex items-center gap-4 p-4 text-[#4A3428] font-bold text-base rounded-xl hover:bg-[#4A3428]/5 transition-all group">
                <i class="fas fa-home w-6 text-[#D9B382] text-lg group-hover:scale-110 transition-transform"></i> 
                <span>Beranda</span>
            </a>

            
            <a href="/products" class="flex items-center gap-4 p-4 text-[#4A3428] font-bold text-base rounded-xl hover:bg-[#4A3428]/5 transition-all group">
                <i class="fas fa-box-open w-6 text-[#D9B382] text-lg group-hover:scale-110 transition-transform"></i> 
                <span>Semua Produk</span>
            </a>

         
            <a href="{{ route('cart.show') }}" class="flex items-center justify-between p-4 bg-gradient-to-br from-[#4A3428] to-[#5D4637] rounded-xl font-bold text-white shadow-lg hover:shadow-xl transition-all group">
                <div class="flex items-center gap-4">
                    <i class="fas fa-shopping-cart w-6 text-lg group-hover:scale-110 transition-transform"></i> 
                    <span>Keranjang</span>
                </div>
                <span id="cart-count-mobile-sidebar" class="bg-[#D9B382] text-[#4A3428] px-3 py-1 rounded-full text-xs font-black min-w-[28px] text-center">{{ count((array) session('cart')) }}</span>
            </a>

            @auth('customer')
            
            <a href="/orders" class="flex items-center gap-4 p-4 text-[#4A3428] font-bold text-base rounded-xl hover:bg-[#4A3428]/5 transition-all border border-gray-200 group">
                <i class="fas fa-box w-6 text-[#D9B382] text-lg group-hover:scale-110 transition-transform"></i>
                <span>Pesanan Saya</span>
            </a>

          
            <a href="{{ route('customer.profile') }}" class="flex items-center gap-4 p-4 text-[#4A3428] font-bold text-base rounded-xl hover:bg-[#4A3428]/5 transition-all border border-gray-200 group">
                <i class="fas fa-user w-6 text-[#D9B382] text-lg group-hover:scale-110 transition-transform"></i>
                <span>Profil Saya</span>
            </a>
            @endauth
        </div>

        <div class="pt-6 mt-6 border-t border-gray-200 space-y-3">
            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider px-2 mb-4">Layanan & Bantuan</p>
            
            <a href="https://wa.me/6281234567890" target="_blank" class="flex items-center gap-4 p-4 text-[#4A3428] font-bold text-base rounded-xl bg-green-50 hover:bg-green-100 transition-all group">
                <i class="fab fa-whatsapp w-6 text-green-500 text-lg group-hover:scale-110 transition-transform"></i> 
                <span>Hubungi Kami</span>
            </a>
            
            <div class="flex justify-center gap-5 py-4">
                <a href="https://instagram.com/tokoanjay" target="_blank" class="w-11 h-11 bg-gradient-to-br from-pink-500 to-orange-500 rounded-xl flex items-center justify-center text-white hover:scale-110 transition-transform shadow-md">
                    <i class="fab fa-instagram text-lg"></i>
                </a>
                <a href="https://facebook.com/tokoanjay" target="_blank" class="w-11 h-11 bg-blue-600 rounded-xl flex items-center justify-center text-white hover:scale-110 transition-transform shadow-md">
                    <i class="fab fa-facebook text-lg"></i>
                </a>
                <a href="https://tiktok.com/tokoanjay" target="_blank" class="w-11 h-11 bg-black rounded-xl flex items-center justify-center text-white hover:scale-110 transition-transform shadow-md">
                    <i class="fab fa-tiktok text-lg"></i>
                </a>
            </div>
        </div>
    </div>


    @auth('customer')
    <div class="p-5 border-t border-gray-200 bg-gray-50">
        <form action="{{ route('customer.logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-gradient-to-r from-red-500 to-red-600 text-white p-4 rounded-xl font-black text-sm uppercase tracking-wide hover:from-red-600 hover:to-red-700 active:scale-95 transition-all shadow-md flex items-center justify-center gap-2">
                <i class="fas fa-sign-out-alt"></i>
                Keluar Akun
            </button>
        </form>
    </div>
    @else
    <div class="p-5 border-t border-gray-200 grid grid-cols-2 gap-3 bg-gray-50">
        <a href="{{ url('/customer/login') }}" class="p-4 bg-white text-[#4A3428] font-black rounded-xl text-center border-2 border-[#4A3428] uppercase text-xs hover:bg-[#4A3428] hover:text-white transition-all">
            Login
        </a>
        <a href="{{ url('/customer/register') }}" class="p-4 bg-gradient-to-br from-[#4A3428] to-[#5D4637] text-[#D9B382] font-black rounded-xl text-center uppercase text-xs hover:shadow-lg transition-all">
            Daftar
        </a>
    </div>
    @endauth
</div>
</div>

<script>
   
    function setLanguage(lang) {
        document.getElementById('current-lang').innerText = lang;
       
    }

    
    const menuToggle = document.getElementById('menu-toggle');
    const closeSidebar = document.getElementById('close-sidebar');
    const sidebar = document.getElementById('mobile-sidebar');

    menuToggle?.addEventListener('click', () => {
        sidebar.classList.remove('translate-x-full');
        document.body.style.overflow = 'hidden';
    });

    closeSidebar?.addEventListener('click', () => {
        sidebar.classList.add('translate-x-full');
        document.body.style.overflow = '';
    });

    window.addEventListener('click', (e) => {
        if (!sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
            sidebar.classList.add('translate-x-full');
            document.body.style.overflow = '';
        }
    });

    
    function updateCartUI(count) {
        const desktopBadge = document.getElementById('cart-count-desktop');
        const sidebarBadge = document.getElementById('cart-count-mobile-sidebar');
        
        [desktopBadge, sidebarBadge].forEach(badge => {
            if (badge) {
                badge.innerText = count;
                badge.classList.add('scale-150', 'bg-yellow-400');
                setTimeout(() => badge.classList.remove('scale-150', 'bg-yellow-400'), 300);
            }
        });
    }

    window.addEventListener('updateCartCount', (e) => {
        updateCartUI(e.detail.count);
    });
</script>

<style>
   
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>