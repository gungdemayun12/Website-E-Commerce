@extends('admin.layout')

@section('title', 'Manajemen Pesanan')

@section('content')
<div class="bg-[#fdfaf5] min-h-screen p-4 md:p-8">

    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-8">
        <div>
            <h2 class="text-4xl font-black text-[#4A3428] tracking-tighter">Koleksi Pesanan</h2>
            <p class="text-[#4A3428]/50 font-medium mt-1">Kelola dan monitor semua pesanan pelanggan.</p>
        </div>

        <button onclick="openCreateModal()" 
        class="flex items-center justify-center gap-2 bg-[#4A3428] text-[#D9B382] px-6 py-3.5 rounded-2xl font-black shadow-xl shadow-[#4A3428]/20 hover:bg-[#3D2B21] transition-all transform hover:-translate-y-1">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
            TAMBAH PESANAN
        </button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-3xl p-6 border-2 border-[#D9B382]/20 shadow-sm hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Total Pesanan</p>
                    <h3 class="text-3xl font-black text-[#4A3428]">{{ $total_pesanan }}</h3>
                </div>
                <div class="bg-[#4A3428]/10 p-4 rounded-2xl">
                    <svg class="w-8 h-8 text-[#4A3428]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 border-2 border-[#D9B382]/20 shadow-sm hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Total Pendapatan</p>
                    <h3 class="text-2xl font-black text-[#D9B382]">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</h3>
                </div>
                <div class="bg-[#D9B382]/10 p-4 rounded-2xl">
                    <svg class="w-8 h-8 text-[#D9B382]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 border-2 border-amber-200 shadow-sm hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Dalam Proses</p>
                    <h3 class="text-3xl font-black text-amber-600">{{ $pesanan_proses }}</h3>
                </div>
                <div class="bg-amber-50 p-4 rounded-2xl">
                    <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
            </div>
        </div>

       <div class="bg-white rounded-3xl p-6 border-2 border-yellow-200 shadow-sm hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Pending</p>
                    <h3 class="text-3xl font-black text-yellow-600">{{ $pesanan_pending }}</h3>
                </div>
                <div class="bg-yellow-50 p-4 rounded-2xl">
                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('dashboard.pesanan') }}" method="GET" class="mb-8">
        <div class="bg-white rounded-3xl p-6 border-2 border-[#D9B382]/20 shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                
                <div class="relative">
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Cari Pesanan</label>
                    <input 
                        type="text" 
                        name="keyword"
                        value="{{ request('keyword') }}"
                        placeholder="Nama pemesan..."
                        class="w-full pl-11 pr-4 py-3 rounded-xl bg-[#fdfaf5] border-2 border-[#D9B382]/20 focus:border-[#4A3428] outline-none transition-all font-bold text-[#4A3428] text-sm">
                    <span class="absolute bottom-3 left-3 text-[#D9B382]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                </div>

                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Status Pesanan</label>
                    <select 
                        name="status_filter"
                        class="w-full px-4 py-3 rounded-xl bg-[#fdfaf5] border-2 border-[#D9B382]/20 focus:border-[#4A3428] outline-none transition-all font-bold text-[#4A3428] text-sm">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status_filter') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="proses" {{ request('status_filter') == 'proses' ? 'selected' : '' }}>Dalam Proses</option>
                        <option value="selesai" {{ request('status_filter') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Metode Pembayaran</label>
                    <select 
                        name="metode_filter"
                        class="w-full px-4 py-3 rounded-xl bg-[#fdfaf5] border-2 border-[#D9B382]/20 focus:border-[#4A3428] outline-none transition-all font-bold text-[#4A3428] text-sm">
                        <option value="">Semua Metode</option>
                        @foreach($metode_pembayaran as $metode)
                            <option value="{{ $metode->metode_pembayaran }}" {{ request('metode_filter') == $metode->metode_pembayaran ? 'selected' : '' }}>
                                {{ ucfirst($metode->metode_pembayaran) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Tanggal</label>
                    <select 
                        name="date_filter"
                        class="w-full px-4 py-3 rounded-xl bg-[#fdfaf5] border-2 border-[#D9B382]/20 focus:border-[#4A3428] outline-none transition-all font-bold text-[#4A3428] text-sm">
                        <option value="">Semua Tanggal</option>
                        <option value="hari_ini" {{ request('date_filter') == 'hari_ini' ? 'selected' : '' }}>Hari Ini</option>
                        <option value="minggu_ini" {{ request('date_filter') == 'minggu_ini' ? 'selected' : '' }}>Minggu Ini</option>
                        <option value="bulan_ini" {{ request('date_filter') == 'bulan_ini' ? 'selected' : '' }}>Bulan Ini</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Urutkan</label>
                    <select 
                        name="sort_by"
                        class="w-full px-4 py-3 rounded-xl bg-[#fdfaf5] border-2 border-[#D9B382]/20 focus:border-[#4A3428] outline-none transition-all font-bold text-[#4A3428] text-sm">
                        <option value="terbaru" {{ request('sort_by') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                        <option value="terlama" {{ request('sort_by') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                        <option value="nama_az" {{ request('sort_by') == 'nama_az' ? 'selected' : '' }}>Nama (A-Z)</option>
                        <option value="nama_za" {{ request('sort_by') == 'nama_za' ? 'selected' : '' }}>Nama (Z-A)</option>
                        <option value="total_tertinggi" {{ request('sort_by') == 'total_tertinggi' ? 'selected' : '' }}>Total Tertinggi</option>
                        <option value="total_terendah" {{ request('sort_by') == 'total_terendah' ? 'selected' : '' }}>Total Terendah</option>
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
                    href="{{ route('dashboard.pesanan') }}"
                    class="flex items-center gap-2 bg-gray-100 text-gray-600 px-6 py-2.5 rounded-xl font-black text-sm hover:bg-gray-200 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    RESET
                </a>

                @if(request('keyword') || request('status_filter') || request('metode_filter') || request('date_filter') || request('sort_by'))
                <div class="ml-auto flex items-center gap-2 text-sm">
                    <span class="text-gray-400 font-medium">Filter aktif:</span>
                    <span class="bg-[#D9B382]/20 text-[#4A3428] px-3 py-1 rounded-lg font-bold">
                        {{ collect([request('keyword'), request('status_filter'), request('metode_filter'), request('date_filter'), request('sort_by')])->filter()->count() }}
                    </span>
                </div>
                @endif
            </div>
        </div>
    </form>

    <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-black/[0.03] border border-white overflow-hidden">
        <div class="overflow-x-auto">
           <table class="min-w-full">
                <thead>
                    <tr class="bg-[#4A3428] text-[#D9B382]">
                        <th class="py-6 px-6 text-left text-[10px] font-black uppercase tracking-[0.2em] whitespace-nowrap">No.</th>
                        <th class="py-6 px-6 text-left text-[10px] font-black uppercase tracking-[0.2em] whitespace-nowrap">Pelanggan</th>
                        <th class="py-6 px-6 text-left text-[10px] font-black uppercase tracking-[0.2em] min-w-[250px]">Produk</th>
                        <th class="py-6 px-6 text-center text-[10px] font-black uppercase tracking-[0.2em] whitespace-nowrap">Qty</th>
                        <th class="py-6 px-6 text-right text-[10px] font-black uppercase tracking-[0.2em] whitespace-nowrap">Total</th>
                        <th class="py-6 px-6 text-center text-[10px] font-black uppercase tracking-[0.2em] whitespace-nowrap">Status</th>
                        <th class="py-6 px-6 text-center text-[10px] font-black uppercase tracking-[0.2em] whitespace-nowrap">Pembayaran</th>
                        <th class="py-6 px-6 text-center text-[10px] font-black uppercase tracking-[0.2em] whitespace-nowrap">Bukti TF</th>
                        <th class="py-6 px-6 text-center text-[10px] font-black uppercase tracking-[0.2em] whitespace-nowrap">Tanggal</th>
                        <th class="py-6 px-6 text-center text-[10px] font-black uppercase tracking-[0.2em] whitespace-nowrap">Management</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($orders as $index => $order)
                    <tr class="hover:bg-[#F8F5F2]/50 transition-colors group">
                        <td class="py-6 px-6 whitespace-nowrap">
                            <span class="text-sm font-black text-[#4A3428]">{{ ($orders->currentPage() - 1) * $orders->perPage() + $index + 1 }}</span>
                        </td>

                        <td class="py-6 px-6 whitespace-nowrap">
                            <div class="font-bold text-[#4A3428] text-sm uppercase tracking-tight">{{ $order->nama_pemesan }}</div>
                            <div class="text-[10px] text-gray-400 font-bold mt-1 tracking-wider">{{ $order->no_hp }}</div>
                            <div class="text-[10px] text-gray-400 italic max-w-[200px] truncate mt-0.5" title="{{ $order->alamat }}">{{ $order->alamat }}</div>
                        </td>

                        <td class="py-6 px-6">
                            <div class="flex items-start gap-3">
                                <div class="w-1 self-stretch bg-[#D9B382]/20 rounded-full min-h-[40px]"></div>
                                <div class="w-full">
                                    @if($order->items)
                                        @foreach(explode(', ', $order->items) as $item)
                                            <div class="font-bold text-[#4A3428] text-sm italic py-1 border-b border-dashed border-[#D9B382]/10 last:border-0">
                                                {{ $item }}
                                            </div>
                                        @endforeach
                                    @else
                                        <span class="text-gray-400 italic text-xs">-</span>
                                    @endif
                                </div>
                            </div>
                        </td>

                        <td class="py-6 px-6 text-center whitespace-nowrap">
                            <span class="inline-block px-3 py-1 bg-[#F8F5F2] rounded-lg font-black text-[#4A3428] text-xs shadow-inner">
                                {{ $order->total_qty }}
                            </span>
                        </td>

                        <td class="py-6 px-6 text-right text-sm whitespace-nowrap">
                            <div class="text-gray-400 text-[10px] font-bold tracking-widest uppercase">Total</div>
                            <div class="font-black text-[#4A3428] tracking-tighter text-lg">
                                Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                            </div>
                        </td>

                        <td class="py-6 px-6 text-center whitespace-nowrap">
                            @if($order->status == 'pending')
                                <span class="px-4 py-2 rounded-xl bg-red-50 text-red-500 text-[10px] font-black uppercase tracking-widest border border-red-100 shadow-sm block">Pending</span>
                            @elseif($order->status == 'proses')
                                <span class="px-4 py-2 rounded-xl bg-amber-50 text-amber-600 text-[10px] font-black uppercase tracking-widest border border-amber-100 shadow-sm block">Proses</span>
                            @elseif($order->status == 'selesai')
                                <span class="px-4 py-2 rounded-xl bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest border border-emerald-100 shadow-sm block">Selesai</span>
                            @endif
                        </td>

                        <td class="py-6 px-6 text-center whitespace-nowrap">
                            <span class="inline-block px-3 py-1 bg-[#F8F5F2] rounded-lg font-black text-[#4A3428] text-xs shadow-inner">
                                {{ ucfirst($order->metode_pembayaran) }}
                            </span>
                        </td>

                        <td class="py-6 px-6 text-center whitespace-nowrap">
                            @if($order->bukti_transfer)
                                <a href="{{ asset($order->bukti_transfer) }}"
                                target="_blank"
                                class="inline-flex items-center gap-2 px-3 py-2 bg-emerald-50 text-emerald-700 text-xs font-black rounded-xl hover:bg-emerald-100 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Lihat
                                </a>
                            @else
                                <span class="text-[10px] text-gray-400 italic">Tidak ada</span>
                            @endif
                        </td>

                        <td class="py-6 px-6 text-center whitespace-nowrap">
                            <div class="text-[10px] text-gray-400 font-black uppercase tracking-widest">
                                {{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}
                            </div>
                            <div class="text-xs font-bold text-[#4A3428] mt-1">
                                {{ \Carbon\Carbon::parse($order->created_at)->format('H:i') }} WIB
                            </div>
                        </td>

                        <td class="py-6 px-6 whitespace-nowrap">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('orders.receipt', $order->id) }}"
                                    target="_blank"
                                    class="p-3 bg-white border border-gray-100 text-[#4A3428] rounded-xl hover:bg-[#4A3428] hover:text-[#D9B382] transition-all shadow-sm hover:shadow-md" title="Lihat Nota">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </a>

                                <button type="button" onclick='openEditModal({{ $order->id }})'
                                    class="p-3 bg-white border border-gray-100 text-[#4A3428] rounded-xl hover:bg-[#D9B382] hover:text-[#4A3428] transition-all shadow-sm hover:shadow-md" title="Edit Pesanan">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>

                                <button type="button" onclick="confirmDelete({{ $order->id }})"
                                    class="p-3 bg-white border border-gray-100 text-red-400 rounded-xl hover:bg-red-500 hover:text-white transition-all shadow-sm hover:shadow-md" title="Hapus Pesanan">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>

                                <form id="delete-form-{{ $order->id }}" action="{{ route('dashboard.pesanan.destroy', $order->id) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="py-16 px-6 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-20 h-20 bg-[#F8F5F2] rounded-full flex items-center justify-center mb-6">
                                    <svg class="w-10 h-10 text-[#D9B382]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                </div>
                                <p class="text-[#4A3428] font-black uppercase tracking-widest text-sm italic">Belum ada pesanan masuk</p>
                                <p class="text-gray-400 text-xs mt-2">Data pesanan akan muncul di sini setelah pelanggan melakukan checkout.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($orders->hasPages())
        <div class="px-6 py-4 border-t border-gray-50 flex items-center justify-between">
            <div class="text-sm text-gray-600 font-bold">
                Menampilkan <span class="text-[#4A3428] font-black">{{ $orders->firstItem() }}</span> hingga <span class="text-[#4A3428] font-black">{{ $orders->lastItem() }}</span> dari <span class="text-[#4A3428] font-black">{{ $orders->total() }}</span> pesanan
            </div>
            <div class="flex gap-2">
                {{ $orders->links('pagination::tailwind') }}
            </div>
        </div>
        @endif
    </div>

    <div id="createModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden items-center justify-center p-4 animate-fade-in">
        <div class="bg-white rounded-[3rem] shadow-2xl max-w-6xl w-full max-h-[90vh] overflow-hidden animate-slide-up">
            <div class="bg-gradient-to-r from-[#4A3428] to-[#2D1F18] p-8 relative overflow-hidden">
                <div class="absolute -right-16 -top-16 w-64 h-64 bg-[#D9B382]/10 rounded-full blur-3xl"></div>
                <div class="flex items-center justify-between relative z-10">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-[#D9B382] rounded-2xl flex items-center justify-center shadow-xl">
                            <svg class="w-7 h-7 text-[#4A3428]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-black text-white tracking-tighter uppercase">Tambah Pesanan Baru</h3>
                            <p class="text-[#D9B382]/60 text-xs font-bold tracking-widest uppercase">Input data pesanan pelanggan</p>
                        </div>
                    </div>
                    <button onclick="closeCreateModal()" class="text-white/60 hover:text-white transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>

            <form action="{{ route('dashboard.pesanan.store') }}" method="POST" enctype="multipart/form-data" class="p-8 overflow-y-auto max-h-[calc(90vh-120px)]">
                @csrf
                
                <div class="mb-8">
                    <h4 class="text-lg font-black text-[#4A3428] uppercase tracking-tight mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Informasi Pelanggan
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div>
                            <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Nama Pemesan</label>
                            <input type="text" name="nama_pemesan" required placeholder="Contoh: Budi Santoso"
                                class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428] placeholder:text-gray-300">
                        </div>

                        <div>
                            <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Nomor HP</label>
                            <input type="text" name="no_hp" required placeholder="Contoh: 08123456789"
                                class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428] placeholder:text-gray-300">
                        </div>

                        <div>
                            <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Metode Pembayaran</label>
                            <select name="metode_pembayaran" id="create_metode_pembayaran" required onchange="toggleBuktiTransfer('create')"
                                class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428]">
                                <option value="">Pilih Metode</option>
                                <option value="transfer">Transfer Bank</option>
                                <option value="cod">COD</option>
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Alamat Pengiriman</label>
                            <textarea name="alamat" required placeholder="Masukan alamat lengkap..." rows="3"
                                class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-medium text-[#4A3428] placeholder:text-gray-300 resize-none"></textarea>
                        </div>

                        <div id="create_bukti_transfer_wrapper" style="display: none;">
                            <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Bukti Transfer</label>
                            <input type="file" name="bukti_transfer" accept="image/*"
                                class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428]">
                        </div>
                    </div>

                    <div class="mt-5">
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Catatan Khusus (Opsional)</label>
                        <textarea name="catatan" placeholder="Catatan atau permintaan khusus dari pelanggan..." rows="2"
                            class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-medium text-[#4A3428] placeholder:text-gray-300 resize-none"></textarea>
                    </div>
                </div>

                <div class="mb-6">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-lg font-black text-[#4A3428] uppercase tracking-tight flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            Item Pesanan
                        </h4>
                        <button type="button" onclick="addCreateItem()" 
                            class="flex items-center gap-2 bg-[#D9B382] text-[#4A3428] px-4 py-2 rounded-xl font-black text-xs hover:bg-[#C9A372] transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            TAMBAH ITEM
                        </button>
                    </div>

                    <div id="create_items_container" class="space-y-4">
                        <div class="create-item-row bg-[#F8F5F2] p-5 rounded-2xl border-2 border-[#D9B382]/20">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div class="md:col-span-2">
                                    <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Produk</label>
                                    <select name="items[0][product_id]" required onchange="updateCreateItemPrice(0)"
                                        class="create-product-select w-full px-6 py-4 rounded-2xl bg-white border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428]">
                                        <option value="">Pilih Produk</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" data-harga="{{ $product->harga }}">
                                                {{ $product->nama_produk }} — Rp {{ number_format($product->harga, 0, ',', '.') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Ukuran</label>
                                    <input type="text" name="items[0][ukuran]" required placeholder="S, M, L, XL"
                                        class="w-full px-6 py-4 rounded-2xl bg-white border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428] placeholder:text-gray-300">
                                </div>

                                <div>
                                    <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Jumlah</label>
                                    <input type="number" name="items[0][qty]" required value="1" min="1" onchange="updateCreateItemPrice(0)"
                                        class="create-qty-input w-full px-6 py-4 rounded-2xl bg-white border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428]">
                                </div>
                            </div>

                            <div class="mt-4 flex items-center justify-between">
                                <div class="text-sm font-bold text-gray-600">
                                    Subtotal: <span class="create-item-subtotal text-[#4A3428] font-black text-lg">Rp 0</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 p-5 bg-gradient-to-r from-[#4A3428] to-[#3D2B21] rounded-2xl">
                        <div class="flex items-center justify-between text-white">
                            <span class="text-sm font-bold uppercase tracking-widest">Total Keseluruhan:</span>
                            <span id="create_grand_total" class="text-2xl font-black">Rp 0</span>
                        </div>
                    </div>
                </div>

                <div class="flex gap-4 pt-6 border-t border-gray-100">
                    <button type="button" onclick="closeCreateModal()"
                        class="flex-1 bg-gray-100 text-gray-600 font-black py-4 rounded-2xl hover:bg-gray-200 transition-all">
                        BATAL
                    </button>
                    <button type="submit"
                        class="flex-1 bg-[#4A3428] text-[#D9B382] font-black py-4 rounded-2xl shadow-xl shadow-[#4A3428]/20 hover:bg-[#3D2B21] transition-all flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        SIMPAN PESANAN
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="editModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden items-center justify-center p-4 animate-fade-in">
        <div class="bg-white rounded-[3rem] shadow-2xl max-w-6xl w-full max-h-[90vh] overflow-hidden animate-slide-up">
            <div class="bg-gradient-to-r from-[#4A3428] to-[#2D1F18] p-8 relative overflow-hidden">
                <div class="absolute -right-16 -top-16 w-64 h-64 bg-[#D9B382]/10 rounded-full blur-3xl"></div>
                <div class="flex items-center justify-between relative z-10">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl flex items-center justify-center shadow-xl">
                            <svg class="w-7 h-7 text-[#D9B382]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-black text-white tracking-tighter uppercase">Edit Pesanan</h3>
                            <p class="text-[#D9B382]/60 text-xs font-bold tracking-widest uppercase">Update data pesanan</p>
                        </div>
                    </div>
                    <button onclick="closeEditModal()" class="text-white/60 hover:text-white transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>

            <form id="editForm" method="POST" class="p-8 overflow-y-auto max-h-[calc(90vh-120px)]">
                @csrf
                @method('PUT')
                
                <div class="mb-8">
                    <h4 class="text-lg font-black text-[#4A3428] uppercase tracking-tight mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Informasi Pelanggan
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div>
                            <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Nama Pemesan</label>
                            <input type="text" name="nama_pemesan" id="edit_nama_pemesan" required
                                class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428]">
                        </div>

                        <div>
                            <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Nomor HP</label>
                            <input type="text" name="no_hp" id="edit_no_hp" required
                                class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428]">
                        </div>

                        <div>
                            <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Status Pesanan</label>
                            <select name="status" id="edit_status" required
                                class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428]">
                                <option value="pending">Pending</option>
                                <option value="proses">Dalam Proses</option>
                                <option value="selesai">Selesai</option>
                                <option value="dibatalkan">Dibatalkan</option>
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Alamat Pengiriman</label>
                            <textarea name="alamat" id="edit_alamat" required rows="3"
                                class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-medium text-[#4A3428] resize-none"></textarea>
                        </div>

                        <div>
                            <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Metode Pembayaran</label>
                            <select name="metode_pembayaran" id="edit_metode_pembayaran" required
                                class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428]">
                                <option value="">Pilih Metode</option>
                                <option value="transfer">Transfer Bank</option>
                                <option value="cod">COD</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-5">
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Catatan Khusus (Opsional)</label>
                        <textarea name="catatan" id="edit_catatan" rows="2"
                            class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-medium text-[#4A3428] resize-none"></textarea>
                    </div>
                </div>

                <div class="mb-6">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-lg font-black text-[#4A3428] uppercase tracking-tight flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            Item Pesanan
                        </h4>
                        <button type="button" onclick="addEditItem()" 
                            class="flex items-center gap-2 bg-[#D9B382] text-[#4A3428] px-4 py-2 rounded-xl font-black text-xs hover:bg-[#C9A372] transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            TAMBAH ITEM
                        </button>
                    </div>

                    <div id="edit_items_container" class="space-y-4">
                    </div>

                    <div class="mt-6 p-5 bg-gradient-to-r from-[#4A3428] to-[#3D2B21] rounded-2xl">
                        <div class="flex items-center justify-between text-white">
                            <span class="text-sm font-bold uppercase tracking-widest">Total Keseluruhan:</span>
                            <span id="edit_grand_total" class="text-2xl font-black">Rp 0</span>
                        </div>
                    </div>
                </div>

                <div class="flex gap-4 pt-6 border-t border-gray-100">
                    <button type="button" onclick="closeEditModal()"
                        class="flex-1 bg-gray-100 text-gray-600 font-black py-4 rounded-2xl hover:bg-gray-200 transition-all">
                        BATAL
                    </button>
                    <button type="submit"
                        class="flex-1 bg-[#4A3428] text-[#D9B382] font-black py-4 rounded-2xl shadow-xl shadow-[#4A3428]/20 hover:bg-[#3D2B21] transition-all flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        UPDATE PESANAN
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    const productsData = @json($products);
    let createItemIndex = 1;
    let editItemIndex = 0;

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

    function toggleBuktiTransfer(mode) {
        const metode = document.getElementById(`${mode}_metode_pembayaran`).value;
        const wrapper = document.getElementById(`${mode}_bukti_transfer_wrapper`);
        if (wrapper) {
            wrapper.style.display = metode === 'transfer' ? 'block' : 'none';
        }
    }

    function openCreateModal() {
        document.getElementById('createModal').classList.remove('hidden');
        document.getElementById('createModal').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeCreateModal() {
        document.getElementById('createModal').classList.add('hidden');
        document.getElementById('createModal').classList.remove('flex');
        document.body.style.overflow = 'auto';
        
        document.querySelector('#createModal form').reset();
        const container = document.getElementById('create_items_container');
        container.innerHTML = `
            <div class="create-item-row bg-[#F8F5F2] p-5 rounded-2xl border-2 border-[#D9B382]/20">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="md:col-span-2">
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Produk</label>
                        <select name="items[0][product_id]" required onchange="updateCreateItemPrice(0)"
                            class="create-product-select w-full px-6 py-4 rounded-2xl bg-white border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428]">
                            <option value="">Pilih Produk</option>
                            ${productsData.map(p => `<option value="${p.id}" data-harga="${p.harga}">${p.nama_produk} — Rp ${parseInt(p.harga).toLocaleString('id-ID')}</option>`).join('')}
                        </select>
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Ukuran</label>
                        <input type="text" name="items[0][ukuran]" required placeholder="S, M, L, XL"
                            class="w-full px-6 py-4 rounded-2xl bg-white border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428] placeholder:text-gray-300">
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Jumlah</label>
                        <input type="number" name="items[0][qty]" required value="1" min="1" onchange="updateCreateItemPrice(0)"
                            class="create-qty-input w-full px-6 py-4 rounded-2xl bg-white border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428]">
                    </div>
                </div>
                <div class="mt-4 flex items-center justify-between">
                    <div class="text-sm font-bold text-gray-600">
                        Subtotal: <span class="create-item-subtotal text-[#4A3428] font-black text-lg">Rp 0</span>
                    </div>
                </div>
            </div>
        `;
        createItemIndex = 1;
        updateCreateGrandTotal();
    }

    function addCreateItem() {
        const container = document.getElementById('create_items_container');
        const newItem = `
            <div class="create-item-row bg-[#F8F5F2] p-5 rounded-2xl border-2 border-[#D9B382]/20">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="md:col-span-2">
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Produk</label>
                        <select name="items[${createItemIndex}][product_id]" required onchange="updateCreateItemPrice(${createItemIndex})"
                            class="create-product-select w-full px-6 py-4 rounded-2xl bg-white border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428]">
                            <option value="">Pilih Produk</option>
                            ${productsData.map(p => `<option value="${p.id}" data-harga="${p.harga}">${p.nama_produk} — Rp ${parseInt(p.harga).toLocaleString('id-ID')}</option>`).join('')}
                        </select>
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Ukuran</label>
                        <input type="text" name="items[${createItemIndex}][ukuran]" required placeholder="S, M, L, XL"
                            class="w-full px-6 py-4 rounded-2xl bg-white border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428] placeholder:text-gray-300">
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Jumlah</label>
                        <input type="number" name="items[${createItemIndex}][qty]" required value="1" min="1" onchange="updateCreateItemPrice(${createItemIndex})"
                            class="create-qty-input w-full px-6 py-4 rounded-2xl bg-white border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428]">
                    </div>
                </div>
                <div class="mt-4 flex items-center justify-between">
                    <div class="text-sm font-bold text-gray-600">
                        Subtotal: <span class="create-item-subtotal text-[#4A3428] font-black text-lg">Rp 0</span>
                    </div>
                    <button type="button" onclick="removeCreateItem(this)" 
                        class="px-4 py-2 bg-red-100 text-red-600 rounded-xl font-black text-xs hover:bg-red-200 transition-all">
                        HAPUS
                    </button>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', newItem);
        createItemIndex++;
    }

    function removeCreateItem(btn) {
        btn.closest('.create-item-row').remove();
        updateCreateGrandTotal();
    }

    function updateCreateItemPrice(index) {
        const rows = document.querySelectorAll('.create-item-row');
        const row = rows[index];
        if (!row) return;
        
        const select = row.querySelector('.create-product-select');
        const qtyInput = row.querySelector('.create-qty-input');
        const subtotalSpan = row.querySelector('.create-item-subtotal');
        
        const selectedOption = select.options[select.selectedIndex];
        const harga = parseFloat(selectedOption.getAttribute('data-harga')) || 0;
        const qty = parseInt(qtyInput.value) || 0;
        const subtotal = harga * qty;
        
        subtotalSpan.textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
        updateCreateGrandTotal();
    }

    function updateCreateGrandTotal() {
        let total = 0;
        document.querySelectorAll('.create-item-row').forEach((row, index) => {
            const select = row.querySelector('.create-product-select');
            const qtyInput = row.querySelector('.create-qty-input');
            
            const selectedOption = select.options[select.selectedIndex];
            const harga = parseFloat(selectedOption.getAttribute('data-harga')) || 0;
            const qty = parseInt(qtyInput.value) || 0;
            total += harga * qty;
        });
        
        document.getElementById('create_grand_total').textContent = 'Rp ' + total.toLocaleString('id-ID');
    }

    function openEditModal(orderId) {
        fetch(`/dashboard/pesanan/${orderId}/edit`)
            .then(response => response.json())
            .then(data => {
                const modal = document.getElementById('editModal');
                const form = document.getElementById('editForm');
                
                form.action = `/dashboard/pesanan/${orderId}`;
                
                document.getElementById('edit_nama_pemesan').value = data.order.nama_pemesan;
                document.getElementById('edit_no_hp').value = data.order.no_hp;
                document.getElementById('edit_alamat').value = data.order.alamat;
                document.getElementById('edit_status').value = data.order.status;
                document.getElementById('edit_catatan').value = data.order.catatan || '';
                document.getElementById('edit_metode_pembayaran').value = data.order.metode_pembayaran;
                
                const container = document.getElementById('edit_items_container');
                container.innerHTML = '';
                editItemIndex = 0;
                
                data.items.forEach((item, index) => {
                    const itemHtml = `
                        <div class="edit-item-row bg-[#F8F5F2] p-5 rounded-2xl border-2 border-[#D9B382]/20">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div class="md:col-span-2">
                                    <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Produk</label>
                                    <select name="items[${index}][product_id]" required onchange="updateEditItemPrice(${index})"
                                        class="edit-product-select w-full px-6 py-4 rounded-2xl bg-white border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428]">
                                        <option value="">Pilih Produk</option>
                                        ${productsData.map(p => `<option value="${p.id}" data-harga="${p.harga}" ${p.id == item.product_id ? 'selected' : ''}>${p.nama_produk} — Rp ${parseInt(p.harga).toLocaleString('id-ID')}</option>`).join('')}
                                    </select>
                                </div>
                                <div>
                                    <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Ukuran</label>
                                    <input type="text" name="items[${index}][ukuran]" required placeholder="S, M, L, XL" value="${item.ukuran}"
                                        class="w-full px-6 py-4 rounded-2xl bg-white border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428]">
                                </div>
                                <div>
                                    <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Jumlah</label>
                                    <input type="number" name="items[${index}][qty]" required value="${item.qty}" min="1" onchange="updateEditItemPrice(${index})"
                                        class="edit-qty-input w-full px-6 py-4 rounded-2xl bg-white border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428]">
                                </div>
                            </div>
                            <div class="mt-4 flex items-center justify-between">
                                <div class="text-sm font-bold text-gray-600">
                                    Subtotal: <span class="edit-item-subtotal text-[#4A3428] font-black text-lg">Rp ${parseInt(item.subtotal).toLocaleString('id-ID')}</span>
                                </div>
                                ${index > 0 ? `
                                <button type="button" onclick="removeEditItem(this)" 
                                    class="px-4 py-2 bg-red-100 text-red-600 rounded-xl font-black text-xs hover:bg-red-200 transition-all">
                                    HAPUS
                                </button>` : ''}
                            </div>
                        </div>
                    `;
                    container.insertAdjacentHTML('beforeend', itemHtml);
                    editItemIndex++;
                });
                
                updateEditGrandTotal();
                
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.style.overflow = 'hidden';
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Tidak dapat memuat data pesanan',
                    customClass: {
                        popup: 'rounded-3xl'
                    }
                });
            });
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
        document.getElementById('editModal').classList.remove('flex');
        document.body.style.overflow = 'auto';
    }

    function addEditItem() {
        const container = document.getElementById('edit_items_container');
        const newItem = `
            <div class="edit-item-row bg-[#F8F5F2] p-5 rounded-2xl border-2 border-[#D9B382]/20">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="md:col-span-2">
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Produk</label>
                        <select name="items[${editItemIndex}][product_id]" required onchange="updateEditItemPrice(${editItemIndex})"
                            class="edit-product-select w-full px-6 py-4 rounded-2xl bg-white border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428]">
                            <option value="">Pilih Produk</option>
                            ${productsData.map(p => `<option value="${p.id}" data-harga="${p.harga}">${p.nama_produk} — Rp ${parseInt(p.harga).toLocaleString('id-ID')}</option>`).join('')}
                        </select>
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Ukuran</label>
                        <input type="text" name="items[${editItemIndex}][ukuran]" required placeholder="S, M, L, XL"
                            class="w-full px-6 py-4 rounded-2xl bg-white border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428] placeholder:text-gray-300">
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Jumlah</label>
                        <input type="number" name="items[${editItemIndex}][qty]" required value="1" min="1" onchange="updateEditItemPrice(${editItemIndex})"
                            class="edit-qty-input w-full px-6 py-4 rounded-2xl bg-white border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428]">
                    </div>
                </div>
                <div class="mt-4 flex items-center justify-between">
                    <div class="text-sm font-bold text-gray-600">
                        Subtotal: <span class="edit-item-subtotal text-[#4A3428] font-black text-lg">Rp 0</span>
                    </div>
                    <button type="button" onclick="removeEditItem(this)" 
                        class="px-4 py-2 bg-red-100 text-red-600 rounded-xl font-black text-xs hover:bg-red-200 transition-all">
                        HAPUS
                    </button>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', newItem);
        editItemIndex++;
    }

    function removeEditItem(btn) {
        btn.closest('.edit-item-row').remove();
        updateEditGrandTotal();
    }

    function updateEditItemPrice(index) {
        const rows = document.querySelectorAll('.edit-item-row');
        const row = rows[index];
        if (!row) return;
        
        const select = row.querySelector('.edit-product-select');
        const qtyInput = row.querySelector('.edit-qty-input');
        const subtotalSpan = row.querySelector('.edit-item-subtotal');
        
        const selectedOption = select.options[select.selectedIndex];
        const harga = parseFloat(selectedOption.getAttribute('data-harga')) || 0;
        const qty = parseInt(qtyInput.value) || 0;
        const subtotal = harga * qty;
        
        subtotalSpan.textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
        updateEditGrandTotal();
    }

    function updateEditGrandTotal() {
        let total = 0;
        document.querySelectorAll('.edit-item-row').forEach((row, index) => {
            const select = row.querySelector('.edit-product-select');
            const qtyInput = row.querySelector('.edit-qty-input');
            
            const selectedOption = select.options[select.selectedIndex];
            const harga = parseFloat(selectedOption.getAttribute('data-harga')) || 0;
            const qty = parseInt(qtyInput.value) || 0;
            total += harga * qty;
        });
        
        document.getElementById('edit_grand_total').textContent = 'Rp ' + total.toLocaleString('id-ID');
    }

    function confirmDelete(orderId) {
        Swal.fire({
            title: 'Hapus Pesanan?',
            text: "Pesanan akan dihapus secara permanen!",
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
                document.getElementById(`delete-form-${orderId}`).submit();
            }
        });
    }

    document.getElementById('createModal')?.addEventListener('click', function(e) {
        if (e.target === this) closeCreateModal();
    });

    document.getElementById('editModal')?.addEventListener('click', function(e) {
        if (e.target === this) closeEditModal();
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeCreateModal();
            closeEditModal();
        }
    });
    </script>

    <style>
    @keyframes bounce-in {
        0% { transform: scale(0.9); opacity: 0; }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); opacity: 1; }
    }

    @keyframes fade-in {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slide-up {
        from { transform: translateY(50px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .animate-bounce-in {
        animation: bounce-in 0.5s ease-out;
    }

    .animate-fade-in {
        animation: fade-in 0.3s ease-out;
    }

    .animate-slide-up {
        animation: slide-up 0.4s ease-out;
    }
    </style>
@endsection