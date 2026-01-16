@extends('admin.layout')

@section('title', 'Edit Pesanan')

@section('content')
<div class="max-w-2xl mx-auto py-10">
    
    <div class="mb-8">
        <a href="{{ route('dashboard.pesanan') }}" 
           class="group inline-flex items-center gap-2 text-[#4A3428]/60 hover:text-[#4A3428] font-bold text-xs uppercase tracking-widest transition-all">
            <div class="p-2 rounded-full bg-white shadow-sm group-hover:shadow-md transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
                </svg>
            </div>
            Batal & Kembali
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-black/[0.03] border border-white p-10 relative overflow-hidden">
        
        <div class="relative z-10">
            <div class="mb-10">
                <h2 class="text-3xl font-black text-[#4A3428] tracking-tighter uppercase">Perbarui Pesanan</h2>
                <p class="text-[#4A3428]/40 text-[10px] font-black tracking-[0.3em] uppercase mt-2 italic">Modifikasi detail transaksi ID: #{{ $order->id }}</p>
                <div class="w-16 h-1 bg-[#D9B382] mt-4 rounded-full"></div>
            </div>

            @if (session('success'))
                <div class="mb-8 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl flex items-center gap-3">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span class="text-xs font-bold uppercase tracking-wide">{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('dashboard.pesanan.update', $order->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-[10px] font-black text-[#4A3428]/60 uppercase tracking-widest ml-1 mb-2">Nama Pemesan</label>
                    <input type="text" name="nama_pemesan" value="{{ old('nama_pemesan', $order->nama_pemesan) }}" 
                           class="w-full bg-[#F8F5F2] border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-[#D9B382] transition-all text-[#4A3428] font-bold shadow-inner">
                </div>

                <div>
                    <label class="block text-[10px] font-black text-[#4A3428]/60 uppercase tracking-widest ml-1 mb-2">No HP</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', $order->no_hp) }}" 
                           class="w-full bg-[#F8F5F2] border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-[#D9B382] transition-all text-[#4A3428] font-bold shadow-inner">
                </div>

                <div>
                    <label class="block text-[10px] font-black text-[#4A3428]/60 uppercase tracking-widest ml-1 mb-2">Alamat</label>
                    <textarea name="alamat" rows="3" 
                              class="w-full bg-[#F8F5F2] border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-[#D9B382] transition-all text-[#4A3428] font-bold shadow-inner resize-none">{{ old('alamat', $order->alamat) }}</textarea>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-[#4A3428]/60 uppercase tracking-widest ml-1 mb-2">Product ID</label>
                    <input type="text" name="product_id" value="{{ old('product_id', $order->product_id) }}" 
                           class="w-full bg-[#F8F5F2] border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-[#D9B382] transition-all text-[#4A3428] font-bold shadow-inner">
                </div>

                <div class="grid grid-cols-2 gap-6">
                   <div>
                        <label class="block text-[10px] font-black text-[#4A3428]/60 uppercase tracking-widest ml-1 mb-2">Ukuran</label>
                        <select name="ukuran" required
                                class="w-full bg-[#F8F5F2] border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-[#D9B382] transition-all text-[#4A3428] font-bold shadow-inner outline-none appearance-none">
                            <option value="" disabled {{ old('ukuran') ? '' : 'selected' }}>Pilih Ukuran</option>
                            <option value="S" {{ old('ukuran') == 'S' ? 'selected' : '' }}>S</option>
                            <option value="M" {{ old('ukuran') == 'M' ? 'selected' : '' }}>M</option>
                            <option value="L" {{ old('ukuran') == 'L' ? 'selected' : '' }}>L</option>
                            <option value="XL" {{ old('ukuran') == 'XL' ? 'selected' : '' }}>XL</option>
                            <option value="XXL" {{ old('ukuran') == 'XXL' ? 'selected' : '' }}>XXL</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-[#4A3428]/60 uppercase tracking-widest ml-1 mb-2">Jumlah</label>
                        <input type="number" name="jumlah" value="{{ old('jumlah', $order->jumlah) }}" min="1"
                               class="w-full bg-[#F8F5F2] border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-[#D9B382] transition-all text-[#4A3428] font-bold shadow-inner">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-[#4A3428]/60 uppercase tracking-widest ml-1 mb-2">Catatan</label>
                    <textarea name="catatan" rows="2" 
                              class="w-full bg-[#F8F5F2] border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-[#D9B382] transition-all text-[#4A3428] font-bold shadow-inner resize-none">{{ old('catatan', $order->catatan) }}</textarea>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-[#4A3428]/60 uppercase tracking-widest ml-1 mb-3">
                        Metode Pembayaran
                    </label>

                    <label class="flex items-center gap-4 bg-[#F8F5F2] rounded-2xl px-6 py-4 shadow-inner cursor-pointer hover:bg-white transition-all">
                        <input type="radio" name="metode_pembayaran" value="cod"{{ old('metode_pembayaran', $order->metode_pembayaran) == 'cod' ? 'checked' : '' }} required class="w-4 h-4 accent-[#4A3428]">

                        <div>
                            <p class="text-[#4A3428] font-black text-sm uppercase">COD</p>
                            <p class="text-xs text-[#4A3428]/50 font-medium">
                                Cash On Delivery (Bayar di Tempat)
                            </p>
                        </div>
                    </label>
                </div>


                <div>
                    <label class="block text-[10px] font-black text-[#4A3428]/60 uppercase tracking-widest ml-1 mb-2">Status Pesanan</label>
                    <div class="relative">
                        <select name="status" class="w-full bg-[#F8F5F2] border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-[#D9B382] transition-all text-[#4A3428] font-bold appearance-none shadow-inner">
                            <option value="pending" {{ old('status', $order->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="proses" {{ old('status', $order->status) == 'proses' ? 'selected' : '' }}>Proses</option>
                            <option value="selesai" {{ old('status', $order->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-[#D9B382]">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit"
                            class="w-full bg-[#D9B382] text-[#4A3428] font-black text-xs tracking-[0.3em] uppercase py-5 rounded-2xl shadow-xl shadow-[#D9B382]/20 hover:bg-[#c4a175] transform hover:-translate-y-1 transition-all">
                        Perbarui Data Eksklusif
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection