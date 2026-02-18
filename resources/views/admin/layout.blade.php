<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') | Luxury System</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo ta.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .sidebar-gradient { background: linear-gradient(180deg, #2D1F18 0%, #4A3428 100%); }
        .glass-effect { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(10px); }
        .nav-link:hover { background: rgba(217, 179, 130, 0.1); color: #D9B382; }
        
        .sidebar-nav::-webkit-scrollbar { width: 4px; }
        .sidebar-nav::-webkit-scrollbar-track { background: transparent; }
        .sidebar-nav::-webkit-scrollbar-thumb { background: rgba(217, 179, 130, 0.2); border-radius: 10px; }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-[#F8F5F2] min-h-screen antialiased">
    <div id="sidebarOverlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden transition-opacity duration-300"></div>
    <aside id="mainSidebar" class="fixed inset-y-0 left-0 z-50 w-72 md:w-80 sidebar-gradient shadow-[10px_0_40px_rgba(0,0,0,0.1)] transition-all duration-300 transform -translate-x-full lg:translate-x-0 flex flex-col">
        <div class="p-8 border-b border-white/5 relative flex-shrink-0">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-[#D9B382]/10 rounded-full blur-2xl"></div>
            <div class="flex items-center justify-between relative z-10">
                <div class="flex items-center gap-4">
                   <div class="w-10 h-10 md:w-12 md:h-12 rounded-2xl overflow-hidden shadow-lg transform -rotate-6">
                        <img src="{{ asset('images/logo ta.png') }}" 
                            alt="Logo Toko Anjay"
                            class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h1 class="text-lg md:text-xl font-extrabold text-white tracking-tighter uppercase leading-none">Toko <span class="text-[#D9B382]">Anjay</span></h1>
                        <p class="text-[#D9B382]/50 text-[10px] font-black tracking-[0.3em] uppercase mt-1">Admin Panel</p>
                    </div>
                </div>
                <button onclick="toggleSidebar()" class="lg:hidden text-white/50 hover:text-[#D9B382]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>

        <nav class="sidebar-nav flex-1 p-6 space-y-2 overflow-y-auto">
            <p class="text-[10px] font-black text-white/30 uppercase tracking-[0.4em] ml-4 mb-4">Menu Utama</p>
            <a href="{{ route('dashboard.home') }}" 
            class="nav-link group flex items-center px-6 py-4 rounded-2xl text-white/60 transition-all duration-300">
                <svg class="w-5 h-5 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4-8v8m5-12l2 2" />
                </svg>
                <span class="font-bold tracking-tight">Dashboard Utama</span>
            </a>


        <div x-data="{ open: {{ request()->routeIs('dashboard.index') || request()->routeIs('dashboard.kategori*') ? 'true' : 'false' }} }">
            
            <button @click="open = !open"
                class="nav-link group flex items-center justify-between w-full px-6 py-4 rounded-2xl text-white/60 transition-all duration-300">
                
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7l9-4 9 4-9 4-9-4z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7v10l9 4 9-4V7" />
                    </svg>
                    <span class="font-bold tracking-tight">Manajemen Produk</span>
                </div>
        
                <svg :class="open ? 'rotate-180' : ''"
                    class="w-4 h-4 transition-transform duration-300"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 9l-7 7-7-7" />
                </svg>
            </button>
        
            <div x-show="open" x-collapse class="mt-2 space-y-1 pl-6">
        
             
                <a href="{{ route('dashboard.index') }}"
                    class="nav-link flex items-center gap-3 px-6 py-3 rounded-xl text-white/50 hover:text-[#D9B382] transition-all">
                    
                    <i class="fa-solid fa-box text-xs"></i>
                    <span class="text-sm font-semibold tracking-tight">Daftar Produk</span>
                </a>
        
            
                <a href="{{ route('dashboard.kategori.index') }}"
                    class="nav-link flex items-center gap-3 px-6 py-3 rounded-xl text-white/50 hover:text-[#D9B382] transition-all">
                    
                    <i class="fa-solid fa-tags text-xs"></i>
                    <span class="text-sm font-semibold tracking-tight">Kelola Kategori</span>
                </a>
        
            </div>
        </div>


           
    <div x-data="{ open: {{ request()->routeIs('dashboard.pesanan*') ? 'true' : 'false' }} }">
        <button @click="open = !open"
            class="nav-link group flex items-center justify-between w-full px-6 py-4 rounded-2xl text-white/60 transition-all duration-300">
            
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                <span class="font-bold tracking-tight">Data Pesanan</span>
            </div>

            <svg :class="open ? 'rotate-180' : ''"
                class="w-4 h-4 transition-transform duration-300"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <div x-show="open" x-collapse class="mt-2 space-y-1 pl-6">
            <a href="{{ route('dashboard.pesanan') }}"
                class="nav-link flex items-center gap-3 px-6 py-3 rounded-xl text-white/50 hover:text-[#D9B382] transition-all">
                
                <i class="fa-solid fa-bag-shopping text-xs"></i>
                <span class="text-sm font-semibold tracking-tight">Pesanan Aktif</span>
            </a>


            <a href="{{ route('dashboard.pesanan.riwayat') }}"
                class="nav-link flex items-center gap-3 px-6 py-3 rounded-xl text-white/50 hover:text-[#D9B382] transition-all">
                
                <i class="fa-solid fa-clock-rotate-left text-xs"></i>
                <span class="text-sm font-semibold tracking-tight">Riwayat Pesanan</span>
            </a>

        </div>
        </div>


            <a href="{{ route('dashboard.review.index') }}" 
            class="nav-link group flex items-center px-6 py-4 rounded-2xl 
            {{ request()->routeIs('dashboard.review*') ? 'bg-[#D9B382]/10 text-[#D9B382]' : 'text-white/60' }} 
            transition-all duration-300">
                
                <svg class="w-5 h-5 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4-.8L3 20l1.8-3.6A7.962 7.962 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>

                <span class="font-bold tracking-tight">Manajemen Review</span>
            </a>


            <a href="{{ route('dashboard.member.index') }}" 
               class="nav-link group flex items-center px-6 py-4 rounded-2xl text-white/60 transition-all duration-300">
                <svg class="w-5 h-5 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span class="font-bold tracking-tight">Manajemen Member</span>
            </a>

            <a href="{{ route('dashboard.admin.index') }}" 
                class="nav-link group flex items-center px-6 py-4 rounded-2xl text-white/60 transition-all duration-300">
                <svg class="w-5 h-5 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                <span class="font-bold tracking-tight">Manajemen Admin</span>
            </a>

            <div class="pt-6">
                <p class="text-[10px] font-black text-white/30 uppercase tracking-[0.4em] ml-4 mb-4">Keuangan</p>
                <a href="{{ route('dashboard.pendapatan') }}" 
                   class="nav-link group flex items-center px-6 py-4 rounded-2xl text-white/60 transition-all duration-300">
                    <svg class="w-5 h-5 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-2.21 0-4 1.343-4 3s1.79 3 4 3 4 1.343 4 3-1.79 3-4 3" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v2m0 8v2" />
                    </svg>
                    <span class="font-bold tracking-tight">Pendapatan</span>
                </a>
                <a href="{{ route('dashboard.pendapatan.chart') }}" 
                   class="nav-link group flex items-center px-6 py-4 rounded-2xl text-white/60 transition-all duration-300">
                    <svg class="w-5 h-5 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <span class="font-bold tracking-tight">Analitik Chart</span>
                </a>
            </div>
        </nav>

        <div class="p-6 glass-effect border-t border-white/5 flex-shrink-0">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 md:w-12 md:h-12 rounded-xl bg-[#D9B382]/20 flex items-center justify-center">
                    <span class="text-[#D9B382] font-black uppercase text-lg">{{ Auth::guard('web')->user()->nama[0] }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-black text-white text-xs md:text-sm truncate uppercase">{{ Auth::guard('web')->user()->nama }}</p>
                    <p class="text-[#D9B382] text-[10px] font-bold tracking-widest uppercase opacity-70 italic">Admin</p>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="p-2 md:p-3 rounded-xl bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <main class="lg:ml-80 transition-all duration-300 min-h-screen">
        <div class="p-4 md:p-10">
            <header class="flex justify-between items-center mb-6 md:mb-12 bg-white/70 backdrop-blur-md rounded-2xl md:rounded-[2.5rem] p-4 md:p-6 shadow-xl shadow-black/[0.03] border border-white/50">
                <div class="flex items-center gap-4 md:gap-6">
                    <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-xl bg-[#4A3428] text-[#D9B382] shadow-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                    </button>
                    
                    <div class="hidden md:block h-10 w-[2px] bg-[#D9B382]/30 rounded-full"></div>
                    <div>
                        <h2 class="text-lg md:text-2xl font-black text-[#4A3428] tracking-tighter uppercase leading-tight">@yield('title', 'Dashboard')</h2>
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                            <p class="text-[#4A3428]/40 text-[9px] md:text-[10px] font-black tracking-widest uppercase">Operasional Sistem</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <span class="hidden sm:block text-[10px] font-black text-[#4A3428]/30 uppercase tracking-widest">{{ date('d M Y') }}</span>
                </div>
            </header>

            <div class="animate-[fadeIn_0.5s_ease-out]">
                @yield('content')
            </div>

            <footer class="mt-20 py-8 border-t border-[#4A3428]/5 text-center">
                <p class="text-[10px] font-black text-[#4A3428]/20 uppercase tracking-[0.5em]">&copy; 2026 Toko Anjay</p>
            </footer>
        </div>
    </main>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('mainSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            if (sidebar.classList.contains('-translate-x-full')) {
              
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                document.body.classList.add('overflow-hidden'); 
            } else {
                
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden'); 
            }
        }
    </script>
</body>
</html>