<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pelanggan | Anjay Premium</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            scroll-behavior: smooth;
        }
        .bg-pattern {
            background-color: #fdfaf5;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%234a3428' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2v-4h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2v-4h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #D9B382; border-radius: 10px; }
    </style>
</head>

<body class="bg-pattern min-h-screen flex items-center justify-center p-4 md:p-10">

    <div class="w-full max-w-2xl">
        
        <div class="mb-6 flex justify-start">
            <a href="{{ url('/customer/login') }}" class="group flex items-center gap-3 text-[11px] font-black text-[#4A3428]/60 hover:text-[#4A3428] uppercase tracking-widest transition-all">
                <div class="w-10 h-10 flex items-center justify-center rounded-2xl bg-white shadow-sm group-hover:shadow-md group-hover:bg-[#4A3428] group-hover:text-[#D9B382] transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </div>
                Sudah punya akun? Login
            </a>
        </div>

        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-[#4A3428] rounded-[1.5rem] shadow-xl shadow-[#4A3428]/20 mb-4 -rotate-3">
                <svg class="w-8 h-8 text-[#D9B382]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-black text-[#4A3428] tracking-tighter uppercase">Join Member</h1>
            <p class="text-[#4A3428]/50 text-xs font-bold tracking-[0.2em] uppercase mt-2">Nikmati promo eksklusif setiap hari</p>
        </div>

        <div class="bg-white/80 backdrop-blur-xl rounded-[3rem] shadow-[0_32px_64px_-16px_rgba(74,52,40,0.15)] p-6 md:p-12 border border-[#D9B382]/20 relative overflow-hidden">
            
            <form action="{{ url('/customer/register') }}" method="POST" class="space-y-6 relative">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2">Username</label>
                        <input type="text" name="username" value="{{ old('username') }}" required placeholder="Contoh: BudiAnjay"
                            class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5]/50 border-2 border-[#eeeae4] focus:border-[#D9B382] focus:bg-white outline-none transition-all font-bold text-[#4A3428] shadow-sm">
                        @error('username') <p class="text-red-500 text-[9px] font-bold uppercase ml-2 italic">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="email@toko.com"
                            class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5]/50 border-2 border-[#eeeae4] focus:border-[#D9B382] focus:bg-white outline-none transition-all font-bold text-[#4A3428] shadow-sm">
                        @error('email') <p class="text-red-500 text-[9px] font-bold uppercase ml-2 italic">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2">Password</label>
                        <input type="password" name="password" required placeholder="••••••••"
                            class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5]/50 border-2 border-[#eeeae4] focus:border-[#D9B382] focus:bg-white outline-none transition-all font-bold text-[#4A3428] shadow-sm">
                        @error('password') <p class="text-red-500 text-[9px] font-bold uppercase ml-2 italic">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" required placeholder="••••••••"
                            class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5]/50 border-2 border-[#eeeae4] focus:border-[#D9B382] focus:bg-white outline-none transition-all font-bold text-[#4A3428] shadow-sm">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2">Nomor Telepon (WhatsApp)</label>
                    <div class="relative group">
                        <span class="absolute left-6 top-1/2 -translate-y-1/2 text-[#4A3428]/40 font-bold">+62</span>
                        <input type="text" name="no_hp" value="{{ old('no_hp') }}" required placeholder="812xxxxxx"
                            class="w-full pl-16 pr-6 py-4 rounded-2xl bg-[#fdfaf5]/50 border-2 border-[#eeeae4] focus:border-[#D9B382] focus:bg-white outline-none transition-all font-bold text-[#4A3428] shadow-sm">
                    </div>
                    @error('no_hp') <p class="text-red-500 text-[9px] font-bold uppercase ml-2 italic">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2">Alamat Anda</label>
                    <textarea name="alamat" rows="2" placeholder="Tulis alamat lengkap Anda di sini..."
                        class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5]/50 border-2 border-[#eeeae4] focus:border-[#D9B382] focus:bg-white outline-none transition-all font-bold text-[#4A3428] shadow-sm custom-scrollbar resize-none">{{ old('alamat') }}</textarea>
                    @error('alamat') <p class="text-red-500 text-[9px] font-bold uppercase ml-2 italic">{{ $message }}</p> @enderror
                </div>

                <button type="submit"
                    class="w-full bg-[#4A3428] text-[#D9B382] font-black py-5 rounded-2xl shadow-2xl shadow-[#4A3428]/30 hover:bg-[#3D2B21] transition-all transform hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-3 text-sm tracking-[0.2em] mt-4">
                    BUAT AKUN SEKARANG
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </button>
            </form>
        </div>

        <div class="mt-12 text-center">
            <p class="text-[10px] font-black text-[#4A3428]/30 uppercase tracking-[0.4em]">
                &copy; 2026 Anjay Premium &bull; High Quality Clothing
            </p>
        </div>
    </div>

</body>
</html>