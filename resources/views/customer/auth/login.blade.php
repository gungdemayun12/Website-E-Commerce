<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Customer | Premium Experience</title>
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
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
    </style>
</head>

<body class="bg-pattern min-h-screen flex items-center justify-center p-4 md:p-8">

    <div class="w-full max-w-[440px] animate-fade-in">
        
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-[#4A3428] rounded-[2rem] shadow-2xl shadow-[#4A3428]/30 mb-6 transform hover:rotate-12 transition-transform duration-500">
                <svg class="w-10 h-10 text-[#D9B382]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <h1 class="text-2xl md:text-3xl font-black text-[#4A3428] tracking-tight uppercase">Welcome Back</h1>
            <p class="text-[#4A3428]/50 text-xs font-bold tracking-[0.2em] uppercase mt-2">Akses dashboard pelanggan anda</p>
        </div>

        <div class="mb-4">
            <a href="{{ url('/home') }}" class="inline-flex items-center gap-2 text-[11px] font-black text-[#4A3428]/60 hover:text-[#4A3428] uppercase tracking-widest transition-all group">
                <div class="p-2 rounded-full bg-white shadow-sm group-hover:shadow-md transition-all">
                    <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </div>
                Kembali ke Beranda
            </a>
        </div>

        <div class="glass-effect rounded-[2.5rem] shadow-[0_20px_50px_rgba(74,52,40,0.12)] p-8 md:p-10 border border-white relative overflow-hidden">
            <div class="absolute -right-12 -top-12 w-32 h-32 bg-[#D9B382]/10 rounded-full blur-2xl"></div>
            <div class="absolute -left-12 -bottom-12 w-32 h-32 bg-[#4A3428]/5 rounded-full blur-2xl"></div>

            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-2xl mb-6 flex items-center gap-3 text-sm font-medium">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ url('/customer/login') }}" method="POST" class="space-y-5 relative">
                @csrf

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-[0.2em] ml-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="nama@email.com"
                        class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-[#eeeae4] focus:border-[#D9B382] focus:bg-white outline-none transition-all font-bold text-[#4A3428] placeholder:text-[#4A3428]/20 shadow-sm">
                    @error('email')
                        <p class="text-red-500 text-[10px] font-bold mt-1 ml-2 uppercase tracking-wider">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-[0.2em] ml-2">Password</label>
                    </div>
                    <input type="password" name="password" required placeholder="••••••••"
                        class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-[#eeeae4] focus:border-[#D9B382] focus:bg-white outline-none transition-all font-bold text-[#4A3428] placeholder:text-[#4A3428]/20 shadow-sm">
                    @error('password')
                        <p class="text-red-500 text-[10px] font-bold mt-1 ml-2 uppercase tracking-wider">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-[#4A3428] text-[#D9B382] font-black py-5 rounded-2xl shadow-xl shadow-[#4A3428]/20 hover:bg-[#3D2B21] transition-all transform hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-3 text-sm tracking-[0.2em] mt-8">
                    MASUK SEKARANG
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </button>
            </form>
        </div>

        <div class="mt-8 space-y-4 text-center">
            <p class="text-[10px] font-black text-[#4A3428]/40 uppercase tracking-[0.3em]">
                Belum punya akun? 
                <a href="{{ url('/customer/register') }}" class="text-[#D9B382] hover:text-[#4A3428] transition-colors underline decoration-2 underline-offset-4">Daftar Sekarang</a>
            </p>
        </div>
    </div>

</body>
</html>