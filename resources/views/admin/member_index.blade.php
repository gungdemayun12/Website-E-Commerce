@extends('admin.layout')

@section('title', 'Manajemen Member')

@section('content')
<div class="bg-[#fdfaf5] min-h-screen p-4 md:p-8">

    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-8">
        <div>
            <h2 class="text-4xl font-black text-[#4A3428] tracking-tighter">Elite Members</h2>
            <p class="text-[#4A3428]/50 font-medium mt-1">Kelola dan monitor semua pelanggan setia Anda.</p>
        </div>

        <button onclick="openCreateModal()" 
        class="flex items-center justify-center gap-2 bg-[#4A3428] text-[#D9B382] px-6 py-3.5 rounded-2xl font-black shadow-xl shadow-[#4A3428]/20 hover:bg-[#3D2B21] transition-all transform hover:-translate-y-1">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
            TAMBAH MEMBER
        </button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-3xl p-6 border-2 border-[#D9B382]/20 shadow-sm hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Total Member</p>
                    <h3 class="text-3xl font-black text-[#4A3428]">{{ $total_members }}</h3>
                </div>
                <div class="bg-[#4A3428]/10 p-4 rounded-2xl">
                    <svg class="w-8 h-8 text-[#4A3428]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM16 20a3 3 0 01-6 0M5 20h5v-2a3 3 0 00-5.856-1.487M5 10a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 border-2 border-emerald-200 shadow-sm hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Member Aktif</p>
                    <h3 class="text-3xl font-black text-emerald-600">{{ $active_members }}</h3>
                </div>
                <div class="bg-emerald-50 p-4 rounded-2xl">
                    <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 border-2 border-red-200 shadow-sm hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Member Inaktif</p>
                    <h3 class="text-3xl font-black text-red-600">{{ $inactive_members }}</h3>
                </div>
                <div class="bg-red-50 p-4 rounded-2xl">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l-2-2m0 0l-2-2m2 2l2-2m-2 2l-2 2m2-2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 border-2 border-amber-200 shadow-sm hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Member Baru</p>
                    <h3 class="text-3xl font-black text-amber-600">{{ $new_members }}</h3>
                </div>
                <div class="bg-amber-50 p-4 rounded-2xl">
                    <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('dashboard.member.index') }}" method="GET" class="mb-8">
        <div class="bg-white rounded-3xl p-6 border-2 border-[#D9B382]/20 shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                
                <div class="relative">
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Cari Member</label>
                    <input 
                        type="text" 
                        name="keyword"
                        value="{{ request('keyword') }}"
                        placeholder="Username, email, atau HP..."
                        class="w-full pl-11 pr-4 py-3 rounded-xl bg-[#fdfaf5] border-2 border-[#D9B382]/20 focus:border-[#4A3428] outline-none transition-all font-bold text-[#4A3428] text-sm">
                    <span class="absolute bottom-3 left-3 text-[#D9B382]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                </div>

                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Status</label>
                    <select 
                        name="status_filter"
                        class="w-full px-4 py-3 rounded-xl bg-[#fdfaf5] border-2 border-[#D9B382]/20 focus:border-[#4A3428] outline-none transition-all font-bold text-[#4A3428] text-sm">
                        <option value="">Semua Status</option>
                        <option value="aktif" {{ request('status_filter') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="inaktif" {{ request('status_filter') == 'inaktif' ? 'selected' : '' }}>Inaktif</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Tipe Member</label>
                    <select 
                        name="type_filter"
                        class="w-full px-4 py-3 rounded-xl bg-[#fdfaf5] border-2 border-[#D9B382]/20 focus:border-[#4A3428] outline-none transition-all font-bold text-[#4A3428] text-sm">
                        <option value="">Semua Tipe</option>
                        <option value="regular" {{ request('type_filter') == 'regular' ? 'selected' : '' }}>Regular</option>
                        <option value="vip" {{ request('type_filter') == 'vip' ? 'selected' : '' }}>VIP</option>
                        <option value="premium" {{ request('type_filter') == 'premium' ? 'selected' : '' }}>Premium</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Tanggal Daftar</label>
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
                        <option value="aktif" {{ request('sort_by') == 'aktif' ? 'selected' : '' }}>Paling Aktif</option>
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
                    href="{{ route('dashboard.member.index') }}"
                    class="flex items-center gap-2 bg-gray-100 text-gray-600 px-6 py-2.5 rounded-xl font-black text-sm hover:bg-gray-200 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    RESET
                </a>

                @if(request('keyword') || request('status_filter') || request('type_filter') || request('date_filter'))
                <div class="ml-auto flex items-center gap-2 text-sm">
                    <span class="text-gray-400 font-medium">Filter aktif:</span>
                    <span class="bg-[#D9B382]/20 text-[#4A3428] px-3 py-1 rounded-lg font-bold">
                        {{ collect([request('keyword'), request('status_filter'), request('type_filter'), request('date_filter')])->filter()->count() }}
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
                        <th class="py-6 px-6 text-left text-[10px] font-black uppercase tracking-[0.2em]">No.</th>
                        <th class="py-6 px-6 text-left text-[10px] font-black uppercase tracking-[0.2em]">Member</th>
                        <th class="py-6 px-6 text-left text-[10px] font-black uppercase tracking-[0.2em]">Kontak</th>
                        <th class="py-6 px-6 text-center text-[10px] font-black uppercase tracking-[0.2em]">Tipe</th>
                        <th class="py-6 px-6 text-center text-[10px] font-black uppercase tracking-[0.2em]">Status</th>
                        <th class="py-6 px-6 text-center text-[10px] font-black uppercase tracking-[0.2em]">Verifikasi</th>
                        <th class="py-6 px-6 text-center text-[10px] font-black uppercase tracking-[0.2em]">Terdaftar</th>
                        <th class="py-6 px-6 text-center text-[10px] font-black uppercase tracking-[0.2em]">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($members as $index => $member)
                    <tr class="hover:bg-[#F8F5F2]/50 transition-colors group">
                        <td class="py-6 px-6">
                            <span class="text-sm font-black text-[#4A3428]">{{ ($members->currentPage() - 1) * $members->perPage() + $index + 1 }}</span>
                        </td>
                        <td class="py-6 px-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-[#4A3428] flex items-center justify-center text-[#D9B382] font-black text-sm uppercase shadow-lg">
                                    {{ substr($member->username, 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-bold text-[#4A3428] text-sm uppercase tracking-tight">{{ $member->username }}</div>
                                    <div class="text-[10px] text-gray-400 font-bold mt-1">{{ $member->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-6 px-6">
                            <div class="text-sm font-bold text-[#4A3428]">{{ $member->no_hp }}</div>
                            <div class="text-xs text-gray-400 mt-1 line-clamp-1 max-w-[200px] italic">{{ $member->alamat }}</div>
                        </td>
                        <td class="py-6 px-6 text-center">
                            @if($member->tipe_member == 'regular')
                                <span class="px-3 py-1.5 rounded-lg bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-widest border border-blue-100 shadow-sm">Regular</span>
                            @elseif($member->tipe_member == 'vip')
                                <span class="px-3 py-1.5 rounded-lg bg-purple-50 text-purple-600 text-[10px] font-black uppercase tracking-widest border border-purple-100 shadow-sm">VIP</span>
                            @else
                                <span class="px-3 py-1.5 rounded-lg bg-[#D9B382]/20 text-[#4A3428] text-[10px] font-black uppercase tracking-widest border border-[#D9B382]/30 shadow-sm">Premium</span>
                            @endif
                        </td>
                        <td class="py-6 px-6 text-center">
                            @if($member->status == 'aktif')
                                <span class="px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest border border-emerald-100 shadow-sm">Aktif</span>
                            @else
                                <span class="px-3 py-1.5 rounded-lg bg-red-50 text-red-600 text-[10px] font-black uppercase tracking-widest border border-red-100 shadow-sm">Inaktif</span>
                            @endif
                        </td>
                        <td class="py-6 px-6 text-center">
                            @if($member->is_verified)
                                <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-green-50 text-green-600 text-[10px] font-black uppercase">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                    Verified
                                </span>
                            @else
                                <button type="button" onclick="verifyMember({{ $member->id }}, '{{ $member->username }}')"
                                    class="px-3 py-1.5 rounded-lg bg-yellow-50 text-yellow-600 text-[10px] font-black uppercase border border-yellow-100 hover:bg-yellow-100 transition cursor-pointer">
                                    Belum Verif
                                </button>
                            @endif
                        </td>
                        <td class="py-6 px-6 text-center">
                            <div class="text-xs font-bold text-[#4A3428]">
                                {{ \Carbon\Carbon::parse($member->created_at)->format('d M Y') }}
                            </div>
                            <div class="text-[10px] text-gray-400 font-bold mt-1">
                                {{ \Carbon\Carbon::parse($member->created_at)->diffForHumans() }}
                            </div>
                        </td>
                        <td class="py-6 px-6">
                            <div class="flex justify-center gap-2">
                                <button type="button" onclick='openEditModal(@json($member))'
                                    class="p-3 bg-white border border-gray-100 text-[#4A3428] rounded-xl hover:bg-[#D9B382] hover:text-[#4A3428] transition-all shadow-sm hover:shadow-md" title="Edit Member">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>

                                <div class="relative group">
                                    <button type="button" class="p-3 bg-white border border-gray-100 text-gray-600 rounded-xl hover:bg-gray-100 transition-all shadow-sm hover:shadow-md" title="Lebih Banyak">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                    </button>
                                    <div class="absolute right-0 mt-1 w-48 bg-white rounded-lg shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-20">
                                        <button type="button" onclick="changeType({{ $member->id }}, 'regular', '{{ $member->username }}')"
                                            class="block w-full text-left px-4 py-3 text-xs font-black text-[#4A3428] hover:bg-blue-50 transition">
                                            → Ubah ke Regular
                                        </button>
                                        <button type="button" onclick="changeType({{ $member->id }}, 'vip', '{{ $member->username }}')"
                                            class="block w-full text-left px-4 py-3 text-xs font-black text-purple-600 hover:bg-purple-50 transition border-t">
                                            → Ubah ke VIP
                                        </button>
                                        <button type="button" onclick="changeType({{ $member->id }}, 'premium', '{{ $member->username }}')"
                                            class="block w-full text-left px-4 py-3 text-xs font-black text-[#4A3428] hover:bg-[#D9B382]/20 transition border-t">
                                            → Ubah ke Premium
                                        </button>
                                        <button type="button" onclick="confirmDelete({{ $member->id }}, '{{ $member->username }}')"
                                            class="block w-full text-left px-4 py-3 text-xs font-black text-red-600 hover:bg-red-50 transition border-t">
                                            🗑️ Hapus Member
                                        </button>
                                    </div>
                                </div>

                              
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="py-16 px-6 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-20 h-20 bg-[#F8F5F2] rounded-full flex items-center justify-center mb-6">
                                    <svg class="w-10 h-10 text-[#D9B382]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM16 20a3 3 0 01-6 0"></path></svg>
                                </div>
                                <p class="text-[#4A3428] font-black uppercase tracking-widest text-sm italic">Belum ada member terdaftar</p>
                                <p class="text-gray-400 text-xs mt-2">Mulai tambahkan member dengan klik tombol "TAMBAH MEMBER"</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($members->hasPages())
        <div class="px-6 py-4 border-t border-gray-50 flex items-center justify-between">
            <div class="text-sm text-gray-600 font-bold">
                Menampilkan <span class="text-[#4A3428] font-black">{{ $members->firstItem() }}</span> hingga <span class="text-[#4A3428] font-black">{{ $members->lastItem() }}</span> dari <span class="text-[#4A3428] font-black">{{ $members->total() }}</span> member
            </div>
            <div class="flex gap-2">
                {{ $members->links('pagination::tailwind') }}
            </div>
        </div>
        @endif
    </div>

    <div id="createModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden items-center justify-center p-4 animate-fade-in">
        <div class="bg-white rounded-[3rem] shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-hidden animate-slide-up">
            <div class="bg-gradient-to-r from-[#4A3428] to-[#2D1F18] p-8 relative overflow-hidden">
                <div class="absolute -right-16 -top-16 w-64 h-64 bg-[#D9B382]/10 rounded-full blur-3xl"></div>
                <div class="flex items-center justify-between relative z-10">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-[#D9B382] rounded-2xl flex items-center justify-center shadow-xl">
                            <svg class="w-7 h-7 text-[#4A3428]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-black text-white tracking-tighter uppercase">Tambah Member Baru</h3>
                            <p class="text-[#D9B382]/60 text-xs font-bold tracking-widest uppercase">Tambahkan pelanggan setia baru</p>
                        </div>
                    </div>
                    <button onclick="closeCreateModal()" class="text-white/60 hover:text-white transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>

            <form id="createForm" class="p-8 overflow-y-auto max-h-[calc(90vh-120px)]">
                <div class="space-y-5">
                    <div>
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Username</label>
                        <input type="text" name="username" required placeholder="Contoh: budi.santoso"
                            class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428] placeholder:text-gray-300">
                    </div>

                    <div>
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Email</label>
                        <input type="email" name="email" required placeholder="example@email.com"
                            class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428] placeholder:text-gray-300">
                    </div>

                    <div>
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Password</label>
                        <input type="password" name="password" required placeholder="Minimal 6 karakter"
                            class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428] placeholder:text-gray-300">
                    </div>

                    <div>
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Nomor HP</label>
                        <input type="text" name="no_hp" required placeholder="08123456789"
                            class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428] placeholder:text-gray-300">
                    </div>

                    <div>
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Alamat Lengkap</label>
                        <textarea name="alamat" required placeholder="Masukkan alamat lengkap..." rows="3"
                            class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-medium text-[#4A3428] placeholder:text-gray-300 resize-none"></textarea>
                    </div>

                    <div>
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Tipe Member</label>
                        <select name="tipe_member" required
                            class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428]">
                            <option value="">Pilih Tipe Member</option>
                            <option value="regular">Regular</option>
                            <option value="vip">VIP</option>
                            <option value="premium">Premium</option>
                        </select>
                    </div>
                </div>

                <div class="flex gap-4 mt-8 pt-6 border-t border-gray-100">
                    <button type="button" onclick="closeCreateModal()"
                        class="flex-1 bg-gray-100 text-gray-600 font-black py-4 rounded-2xl hover:bg-gray-200 transition-all">
                        BATAL
                    </button>
                    <button type="submit"
                        class="flex-1 bg-[#4A3428] text-[#D9B382] font-black py-4 rounded-2xl shadow-xl shadow-[#4A3428]/20 hover:bg-[#3D2B21] transition-all flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        TAMBAH MEMBER
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="editModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden items-center justify-center p-4 animate-fade-in">
        <div class="bg-white rounded-[3rem] shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-hidden animate-slide-up">
            <div class="bg-gradient-to-r from-[#4A3428] to-[#2D1F18] p-8 relative overflow-hidden">
                <div class="absolute -right-16 -top-16 w-64 h-64 bg-[#D9B382]/10 rounded-full blur-3xl"></div>
                <div class="flex items-center justify-between relative z-10">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl flex items-center justify-center shadow-xl">
                            <svg class="w-7 h-7 text-[#D9B382]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-black text-white tracking-tighter uppercase">Edit Member</h3>
                            <p class="text-[#D9B382]/60 text-xs font-bold tracking-widest uppercase">Update data member</p>
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
                
                <div class="space-y-5">
                    <div>
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Username</label>
                        <input type="text" name="username" id="edit_username" required
                            class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428]">
                    </div>

                    <div>
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Email</label>
                        <input type="email" name="email" id="edit_email" required
                            class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428]">
                    </div>

                    <div>
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Password <span class="text-gray-400">(Kosongkan jika tidak ingin diubah)</span></label>
                        <input type="password" name="password" id="edit_password" placeholder="Biarkan kosong untuk tidak mengubah"
                            class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428] placeholder:text-gray-300">
                    </div>

                    <div>
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Nomor HP</label>
                        <input type="text" name="no_hp" id="edit_no_hp" required
                            class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428]">
                    </div>

                    <div>
                        <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Alamat Lengkap</label>
                        <textarea name="alamat" id="edit_alamat" required rows="3"
                            class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-medium text-[#4A3428] resize-none"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Tipe Member</label>
                            <select name="tipe_member" id="edit_tipe_member" required
                                class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428]">
                                <option value="regular">Regular</option>
                                <option value="vip">VIP</option>
                                <option value="premium">Premium</option>
                            </select>
                        </div>

                        <div>
                            <label class="text-[10px] font-black text-[#4A3428] uppercase tracking-widest ml-2 mb-2 block">Status</label>
                            <select name="status" id="edit_status" required
                                class="w-full px-6 py-4 rounded-2xl bg-[#fdfaf5] border-2 border-transparent focus:border-[#D9B382] outline-none transition-all font-bold text-[#4A3428]">
                                <option value="aktif">Aktif</option>
                                <option value="inaktif">Inaktif</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="flex gap-4 mt-8 pt-6 border-t border-gray-100">
                    <button type="button" onclick="closeEditModal()"
                        class="flex-1 bg-gray-100 text-gray-600 font-black py-4 rounded-2xl hover:bg-gray-200 transition-all">
                        BATAL
                    </button>
                    <button type="submit"
                        class="flex-1 bg-[#4A3428] text-[#D9B382] font-black py-4 rounded-2xl shadow-xl shadow-[#4A3428]/20 hover:bg-[#3D2B21] transition-all flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        UPDATE MEMBER
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
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

    function openCreateModal() {
        document.getElementById('createModal').classList.remove('hidden');
        document.getElementById('createModal').classList.add('flex');
        document.body.style.overflow = 'hidden';
        document.getElementById('createForm').reset();
    }

    function closeCreateModal() {
        document.getElementById('createModal').classList.add('hidden');
        document.getElementById('createModal').classList.remove('flex');
        document.body.style.overflow = 'auto';
    }

    document.getElementById('createForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        try {
            const response = await fetch('{{ route('dashboard.member.store') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            });

            const data = await response.json();

            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message,
                    timer: 2000,
                    timerProgressBar: true,
                    background: '#fff',
                    color: '#4A3428',
                    iconColor: '#D9B382',
                    customClass: {
                        popup: 'rounded-3xl',
                        title: 'font-black',
                        htmlContainer: 'font-bold'
                    }
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: data.message,
                    background: '#fff',
                    color: '#4A3428',
                    customClass: { popup: 'rounded-3xl' }
                });
            }
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Terjadi kesalahan jaringan',
                background: '#fff',
                color: '#4A3428',
                customClass: { popup: 'rounded-3xl' }
            });
        }
    });

    function openEditModal(member) {
        const modal = document.getElementById('editModal');
        const form = document.getElementById('editForm');
        
        form.action = `/dashboard/member/${member.id}/update`;
        
        document.getElementById('edit_username').value = member.username;
        document.getElementById('edit_email').value = member.email;
        document.getElementById('edit_no_hp').value = member.no_hp;
        document.getElementById('edit_alamat').value = member.alamat;
        document.getElementById('edit_tipe_member').value = member.tipe_member;
        document.getElementById('edit_status').value = member.status;
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
        document.getElementById('editModal').classList.remove('flex');
        document.body.style.overflow = 'auto';
    }

    document.getElementById('editForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const action = this.action;
        
        try {
            const response = await fetch(action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            });

            const data = await response.json();

            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message,
                    timer: 2000,
                    timerProgressBar: true,
                    background: '#fff',
                    color: '#4A3428',
                    iconColor: '#D9B382',
                    customClass: {
                        popup: 'rounded-3xl',
                        title: 'font-black',
                        htmlContainer: 'font-bold'
                    }
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: data.message,
                    background: '#fff',
                    color: '#4A3428',
                    customClass: { popup: 'rounded-3xl' }
                });
            }
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Terjadi kesalahan jaringan',
                background: '#fff',
                color: '#4A3428',
                customClass: { popup: 'rounded-3xl' }
            });
        }
    });

    function verifyMember(memberId, memberName) {
        Swal.fire({
            title: 'Verifikasi Member?',
            text: `Verifikasi member "${memberName}"?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#4A3428',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Verifikasi!',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            background: '#fff',
            color: '#4A3428',
            customClass: {
                popup: 'rounded-3xl',
                title: 'font-black text-2xl',
                htmlContainer: 'font-bold'
            }
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    const response = await fetch(`/dashboard/member/${memberId}/verify`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    const data = await response.json();

                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.message,
                            timer: 2000,
                            timerProgressBar: true,
                            background: '#fff',
                            color: '#4A3428',
                            iconColor: '#D9B382',
                            customClass: { popup: 'rounded-3xl' }
                        }).then(() => location.reload());
                    }
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan',
                        background: '#fff',
                        color: '#4A3428',
                        customClass: { popup: 'rounded-3xl' }
                    });
                }
            }
        });
    }

    function changeType(memberId, type, memberName) {
        const typeLabel = {
            'regular': 'Regular',
            'vip': 'VIP',
            'premium': 'Premium'
        };

        Swal.fire({
            title: 'Ubah Tipe Member?',
            text: `Ubah tipe member "${memberName}" menjadi ${typeLabel[type]}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4A3428',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Ubah!',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            background: '#fff',
            color: '#4A3428',
            customClass: {
                popup: 'rounded-3xl',
                title: 'font-black text-2xl',
                htmlContainer: 'font-bold'
            }
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    const response = await fetch(`/dashboard/member/${memberId}/change-type/${type}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    const data = await response.json();

                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.message,
                            timer: 2000,
                            timerProgressBar: true,
                            background: '#fff',
                            color: '#4A3428',
                            iconColor: '#D9B382',
                            customClass: { popup: 'rounded-3xl' }
                        }).then(() => location.reload());
                    }
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan',
                        background: '#fff',
                        color: '#4A3428',
                        customClass: { popup: 'rounded-3xl' }
                    });
                }
            }
        });
    }

    function confirmDelete(memberId, memberName) {
        Swal.fire({
            title: 'Hapus Member?',
            text: `Member "${memberName}" akan dihapus secara permanen!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
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
                confirmButton: 'font-black',
                cancelButton: 'font-black'
            }
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    const response = await fetch(`/dashboard/member/${memberId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.message,
                            timer: 2000,
                            timerProgressBar: true,
                            background: '#fff',
                            color: '#4A3428',
                            iconColor: '#dc2626',
                            customClass: {
                                popup: 'rounded-3xl',
                                title: 'font-black',
                                htmlContainer: 'font-bold'
                            }
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: data.message,
                            background: '#fff',
                            color: '#4A3428',
                            customClass: { popup: 'rounded-3xl' }
                        });
                    }
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat menghapus member',
                        background: '#fff',
                        color: '#4A3428',
                        customClass: { popup: 'rounded-3xl' }
                    });
                }
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
    @keyframes fade-in {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slide-up {
        from { transform: translateY(50px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .animate-fade-in {
        animation: fade-in 0.3s ease-out;
    }

    .animate-slide-up {
        animation: slide-up 0.4s ease-out;
    }

    @media (max-width: 768px) {
        .group:hover .invisible {
            visibility: visible;
        }
    }
    </style>
@endsection