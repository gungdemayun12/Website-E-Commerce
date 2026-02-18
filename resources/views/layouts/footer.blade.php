        <footer class="relative overflow-hidden bg-[#4A3428] px-6 md:px-16 lg:px-24 xl:px-32 w-full text-[#F3E5D8]/80 pt-16 shadow-[0_-10px_25px_rgba(0,0,0,0.1)]">
            
            <div class="absolute top-0 right-0 opacity-5 pointer-events-none transform translate-x-1/4 -translate-y-1/4">
                <svg width="400" height="400" fill="none" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="40" stroke="currentColor" stroke-width="1" />
                </svg>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-16 relative z-10">
                
                <div class="sm:col-span-2 lg:col-span-1">
                <a href="/home" class="group flex items-center gap-4 mb-6">
            
            <div class="w-14 h-14 rounded-full overflow-hidden shadow-lg 
                        ring-2 ring-[#D9B382] group-hover:scale-105 
                        transition-all duration-300">
               <img src="{{ asset('images/logo ta.png') }}" 
                alt="Logo"
                class="w-full h-full object-cover">
            </div>

            <div class="flex flex-col">
                <span class="text-xl font-black tracking-wide text-white leading-none uppercase">
                    TOKO
                </span>
                <span class="text-sm font-bold text-[#D9B382] tracking-[0.3em] leading-none uppercase">
                    ANJAY
                </span>
            </div>

        </a>

            <p class="text-sm/7 max-w-sm">
                Brand fashion modern yang menghadirkan koleksi pakaian premium dengan desain elegan, detail berkualitas, dan kenyamanan maksimal untuk gaya sehari-hari Anda.
            </p>
          <div class="flex gap-4 mt-6">
                <a href="https://instagram.com/tokoanjay" 
                target="_blank"
                class="w-10 h-10 rounded-full bg-[#3D2B21] flex items-center justify-center 
                        text-white hover:bg-[#D9B382] hover:text-[#4A3428] 
                        transition-all duration-300 transform hover:scale-110">
                    <i class="fab fa-instagram text-lg"></i>
                </a>

                
                <a href="https://facebook.com/tokoanjay" 
                target="_blank"
                class="w-10 h-10 rounded-full bg-[#3D2B21] flex items-center justify-center 
                        text-white hover:bg-[#D9B382] hover:text-[#4A3428] 
                        transition-all duration-300 transform hover:scale-110">
                    <i class="fab fa-facebook-f text-lg"></i>
                </a>

                
                <a href="https://tiktok.com/tokoanjay" 
                target="_blank"
                class="w-10 h-10 rounded-full bg-[#3D2B21] flex items-center justify-center 
                        text-white hover:bg-[#D9B382] hover:text-[#4A3428] 
                        transition-all duration-300 transform hover:scale-110">
                    <i class="fab fa-tiktok text-lg"></i>
                </a>

            </div>

        </div>

       <div class="flex flex-col lg:items-center">
            <div class="flex flex-col space-y-4">

                <h2 class="font-black uppercase tracking-widest text-[#D9B382] mb-2">
                    Perusahaan
                </h2>

                
                <a href="#tentang-kami"
                class="hover:text-white transition-colors duration-300 flex items-center gap-2 group">
                    <span class="w-1.5 h-1.5 bg-[#D9B382] rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span>
                    Tentang Brand
                </a>

               
                <a href="/products"
                class="hover:text-white transition-colors duration-300 flex items-center gap-2 group">
                    <span class="w-1.5 h-1.5 bg-[#D9B382] rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span>
                    Koleksi Terbaru
                </a>

                
                <a href="https://wa.me/6282147331906"
                target="_blank"
                class="hover:text-white transition-colors duration-300 flex items-center gap-2 group">
                    <span class="w-1.5 h-1.5 bg-[#D9B382] rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span>
                    Hubungi Kami
                </a>
            </div>
        </div>

        <div>
            <h2 class="font-black uppercase tracking-widest text-[#D9B382] mb-6">Newsletter</h2>
            <div class="space-y-6 max-w-sm">
                <p class="text-sm leading-relaxed italic">
                    Berlangganan untuk mendapatkan info koleksi terbaru, promo eksklusif, dan update fashion terkini.
                </p>
                <div class="flex items-center group">
                    <input class="bg-[#3D2B21] border border-[#5D4637] rounded-l-xl outline-none w-full h-12 px-4 text-white focus:border-[#D9B382] transition-all placeholder-[#8B7366]" 
                           type="email" 
                           placeholder="Email Anda">
                    <button class="bg-[#D9B382] hover:bg-[#E7C697] text-[#4A3428] font-black px-6 h-12 rounded-r-xl transition-all shadow-lg shadow-black/20">
                        DAFTAR
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col md:flex-row items-center justify-between gap-6 py-8 border-t border-[#5D4637] mt-16 text-xs tracking-widest uppercase font-bold text-[#8B7366]">
        <p class="text-center md:text-left">
            Copyright 2026 © <span class="text-[#D9B382]">TOKO ANJAY</span>. All Right Reserved.
        </p>
        <div class="flex items-center gap-6">
            <a href="#" class="hover:text-[#D9B382] transition-colors">Privacy Policy</a>
            <a href="#" class="hover:text-[#D9B382] transition-colors">Terms</a>
            <a href="#" class="hover:text-[#D9B382] transition-colors">Cookies</a>
        </div>
    </div>
</footer>
