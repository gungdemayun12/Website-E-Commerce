<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')

<div class="min-h-screen bg-[#F8F9FA] py-12 px-4 sm:px-6 lg:px-8 font-sans" 
     x-data="{ tab: 'bio', showCurrentPass: false }"
     x-init="
        if (window.location.hash) {
            const hash = window.location.hash.replace('#','');
            if(['bio','address','notification','security','orders'].includes(hash)){
                tab = hash;
            }
        }
     ">

    <div class="max-w-6xl mx-auto">
        
        <div class="flex flex-col lg:flex-row gap-8">

            <div class="w-full lg:w-1/3 space-y-6">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-full bg-[#4A3428] flex items-center justify-center text-white text-2xl font-bold shadow-lg overflow-hidden">
                          @if($customer->foto)
                            <img src="{{ asset('images/customers/' . $customer->foto) }}" 
                                class="w-full h-full object-cover"
                                loading="lazy"
                                onerror="this.src='{{ asset('images/default-user.png') }}'">
                        @else
                                {{ strtoupper(substr($customer->username, 0, 2)) }}
                            @endif
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">{{ $customer->username }}</h2>
                            <p class="text-xs font-semibold text-blue-500 tracking-wider uppercase">Verified Member</p>
                        </div>
                    </div>

                    <div class="mt-8 space-y-4">
                        <div class="flex items-center justify-between p-4 rounded-xl bg-gray-50 border border-gray-100">
                            <div class="flex items-center gap-3">
                                <span class="w-10 h-10 flex items-center justify-center bg-orange-100 text-orange-600 rounded-full text-sm font-bold">
                                    Rp
                                </span>
                                <div>
                                    <p class="text-xs text-gray-400">Total Belanja</p>
                                    <p class="text-sm font-bold text-gray-800">Rp{{ number_format($balance, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10">
                        <h4 class="text-sm font-bold text-gray-800 flex justify-between items-center cursor-pointer">
                            Profile
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </h4>
                        <ul class="mt-4 space-y-3">
                            <li class="text-sm font-semibold text-[#4A3428] pl-2 border-l-2 border-[#4A3428] cursor-pointer" @click="tab = 'bio'">My Profile</li>
                            <li class="text-sm font-semibold text-gray-400 pl-2 border-l-2 border-transparent hover:border-[#4A3428] hover:text-[#4A3428] transition-all cursor-pointer" @click="tab = 'orders'">Riwayat Pesanan</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-2/3 bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden min-h-[500px]">
                
                <div class="border-b border-gray-100 flex overflow-x-auto">
                    <button @click="tab = 'bio'" :class="tab === 'bio' ? 'text-[#4A3428] border-[#4A3428]' : 'text-gray-400 border-transparent'" class="px-8 py-5 text-sm font-bold border-b-2 whitespace-nowrap transition-all">Bio Data</button>
                    <button @click="tab = 'address'; $nextTick(() => initMap())" :class="tab === 'address' ? 'text-[#4A3428] border-[#4A3428]' : 'text-gray-400 border-transparent'" class="px-8 py-5 text-sm font-bold border-b-2 whitespace-nowrap transition-all">Address List</button>
                    <button @click="tab = 'notification'" :class="tab === 'notification' ? 'text-[#4A3428] border-[#4A3428]' : 'text-gray-400 border-transparent'" class="px-8 py-5 text-sm font-bold border-b-2 whitespace-nowrap transition-all flex items-center gap-2">
                        Notification
                        @if(count($notifications ?? []) > 0)
                            <span class="bg-red-500 text-white text-[10px] px-1.5 py-0.5 rounded-full">{{ count($notifications) }}</span>
                        @endif
                    </button>
                    <button @click="tab = 'security'" :class="tab === 'security' ? 'text-[#4A3428] border-[#4A3428]' : 'text-gray-400 border-transparent'" class="px-8 py-5 text-sm font-bold border-b-2 whitespace-nowrap transition-all">Security</button>
                    <button @click="tab = 'orders'" :class="tab === 'orders' ? 'text-[#4A3428] border-[#4A3428]' : 'text-gray-400 border-transparent'" class="px-8 py-5 text-sm font-bold border-b-2 whitespace-nowrap transition-all">Riwayat Pesanan</button>
                </div>

                <div class="p-8 md:p-12">
                    <div x-show="tab === 'bio'" x-transition>
                        <div class="flex flex-col md:flex-row gap-12">
                            <div class="flex flex-col items-center gap-4">
                                <div class="w-48 h-48 bg-gray-100 rounded-2xl flex items-center justify-center border border-gray-100 shadow-inner overflow-hidden">
                                  @if($customer->foto)
                                    <img src="{{ asset('images/customers/' . $customer->foto) }}" 
                                        class="w-full h-full object-cover"
                                        loading="lazy"
                                        onerror="this.src='{{ asset('images/default-user.png') }}'">
                                @else
                                        <span class="text-6xl font-bold text-gray-300">{{ strtoupper(substr($customer->username, 0, 2)) }}</span>
                                    @endif
                                </div>
                                <a href="{{ route('customer.profile.edit') }}" class="w-full text-center py-2 px-6 border border-[#4A3428] text-[#4A3428] rounded-lg font-bold text-sm hover:bg-[#4A3428] hover:text-white transition-all">
                                    Edit Profile
                                </a>
                                <div class="text-[10px] text-gray-400 text-center uppercase tracking-tighter leading-relaxed">
                                    REQUIREMENTS:<br>Max file size: 10MB<br>Formats: .JPG, .JPEG, .PNG
                                </div>
                            </div>

                            <div class="flex-1 space-y-10">
                                <div class="space-y-6">
                                    <h3 class="text-lg font-bold text-gray-800 mb-4">Bio Data</h3>
                                    <div class="grid grid-cols-3 items-center">
                                        <span class="text-sm font-medium text-gray-400">Name</span>
                                        <span class="col-span-2 text-sm font-bold text-gray-800">{{ $customer->username }}</span>
                                    </div>
                                </div>

                                <div class="space-y-6 pt-4 border-t border-gray-50">
                                    <h3 class="text-lg font-bold text-gray-800 mb-4">Contact</h3>
                                    <div class="grid grid-cols-3 items-center">
                                        <span class="text-sm font-medium text-gray-400">Email</span>
                                        <div class="col-span-2 flex items-center gap-3">
                                            <span class="text-sm font-bold text-gray-800 break-all">{{ $customer->email }}</span>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 items-center">
                                        <span class="text-sm font-medium text-gray-400">Phone Number</span>
                                        <div class="col-span-2 flex items-center gap-2">
                                            <span class="text-sm font-bold text-gray-800">{{ $customer->no_hp ?? 'Not Set' }}</span>
                                            <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div x-show="tab === 'address'" x-cloak x-transition>
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-bold text-gray-800">Alamat Anda</h3>
                            <span class="text-xs text-gray-400 italic">Ketik, klik peta, atau seret pin</span>
                        </div>

                        <form action="{{ route('customer.profile.update', $customer->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="username" value="{{ $customer->username }}">
                            <input type="hidden" name="email" value="{{ $customer->email }}">

                            <div class="space-y-4">

                                <div class="relative">
                                    <input
                                        id="addr-search"
                                        type="text"
                                        class="w-full p-4 pr-12 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#4A3428] focus:border-transparent outline-none text-sm shadow-sm"
                                        placeholder="Ketik nama jalan, kelurahan, kota..."
                                        autocomplete="off"
                                        value="{{ $customer->alamat }}"
                                    >
                                    <div class="absolute right-4 top-4 text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <ul id="addr-dropdown" class="absolute w-full bg-white border border-gray-200 rounded-xl shadow-xl mt-1 hidden overflow-hidden" style="z-index:9999; max-height:240px; overflow-y:auto;"></ul>
                                </div>

                                <div id="addr-info" class="{{ $customer->alamat ? '' : 'hidden' }} flex items-start gap-3 p-4 bg-amber-50 border border-amber-200 rounded-xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <div>
                                        <p class="text-xs font-bold text-amber-700 uppercase tracking-wide mb-1">📍 Lokasi Dipilih</p>
                                        <p id="addr-info-text" class="text-sm text-amber-800 font-medium leading-relaxed">{{ $customer->alamat }}</p>
                                    </div>
                                </div>

                                <input type="hidden" id="alamat-hidden" name="alamat" value="{{ $customer->alamat }}">

                                <div class="map-wrapper">
                                    {{-- Indikator drag pin --}}
                                    <div id="map-hint" class="map-hint">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        Klik peta atau seret pin untuk menentukan lokasi
                                    </div>
                                    <div id="main-map"></div>
                                </div>

                                <button type="submit" class="w-full py-4 bg-[#4A3428] text-white rounded-xl font-bold hover:bg-[#3d2b21] transition-all shadow-lg shadow-gray-200">
                                    Simpan Perubahan Alamat
                                </button>
                            </div>
                        </form>
                    </div>

                    <div x-show="tab === 'notification'" x-cloak x-transition>
                        <h3 class="text-lg font-bold text-gray-800 mb-6">Pesan Masuk</h3>
                        <div class="space-y-4">
                            @forelse($notifications ?? [] as $n)
                                <div class="flex gap-4 p-4 bg-white border border-gray-100 rounded-2xl hover:bg-gray-50 transition-colors">
                                    <div class="w-10 h-10 bg-[#D9B382]/20 rounded-full flex items-center justify-center shrink-0">🔔</div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-800 leading-tight">{{ $n->text }}</p>
                                        <p class="text-[11px] text-gray-400 mt-1">{{ \Carbon\Carbon::parse($n->created_at)->diffForHumans() }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-10">
                                    <p class="text-gray-400 italic text-sm">Belum ada notifikasi.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div x-show="tab === 'security'" x-cloak x-transition>
                        <div class="max-w-md">
                            <h3 class="text-lg font-bold text-gray-800 mb-2">Keamanan Akun</h3>
                            <p class="text-sm text-gray-500 mb-8">Informasi kredensial login Anda saat ini.</p>
                            
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Kata Sandi Saat Ini</label>
                                    <div class="relative">
                                        <input 
                                            :type="showCurrentPass ? 'text' : 'password'" 
                                            class="w-full p-4 pr-12 rounded-xl border border-gray-100 bg-gray-50 text-gray-600 font-medium text-sm outline-none cursor-default shadow-inner"
                                            value="{{ $customer->password }}" 
                                            readonly
                                        >
                                        <button 
                                            type="button" 
                                            @click="showCurrentPass = !showCurrentPass"
                                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#4A3428] transition-colors focus:outline-none"
                                        >
                                            <template x-if="!showCurrentPass">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </template>
                                            <template x-if="showCurrentPass">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                                                </svg>
                                            </template>
                                        </button>
                                    </div>
                                    <div class="mt-4 p-4 bg-orange-50 rounded-xl border border-orange-100">
                                        <p class="text-[11px] text-orange-700 leading-relaxed">
                                            <strong>Catatan:</strong> Password di atas mungkin ditampilkan dalam bentuk terenkripsi (hash). Untuk mengubah password, silakan gunakan tombol <strong>Edit Profile</strong> di tab Bio Data.
                                        </p>
                                    </div>
                                </div>

                                <a href="{{ route('customer.profile.edit') }}" class="block w-full py-4 bg-gray-100 text-gray-700 text-center rounded-xl font-bold hover:bg-gray-200 transition-all">
                                    Pergi ke Edit Profil
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-show="tab === 'orders'" x-cloak x-transition>
                    <div class="p-8 md:p-12">
                        <div class="mb-8">
                            <h3 class="text-lg font-bold text-gray-800">Riwayat Pesanan</h3>
                            <p class="text-xs text-gray-500">Menampilkan semua pesanan yang telah selesai.</p>
                        </div>
                        <div class="space-y-8">
                            @forelse($groupedOrders as $order)
                            <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm">
                                <div class="flex justify-between items-center mb-6 pb-6 border-b border-gray-100">
                                    <div>
                                        <span class="text-xs font-bold text-[#D9B382] uppercase tracking-widest">
                                            PESANAN #{{ $order->id + 1000 }}
                                        </span>
                                        <p class="text-xs text-gray-400 mt-1">
                                            {{ date('d F Y, H:i', strtotime($order->created_at)) }} WIB
                                        </p>
                                    </div>
                                    <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full uppercase">
                                        {{ $order->status }}
                                    </span>
                                </div>

                                <div class="space-y-4 mb-6">
                                    @foreach($order->items as $item)
                                    <div class="flex gap-4 items-center p-4 bg-gray-50 rounded-2xl">
                                        <div class="w-20 h-24 rounded-xl overflow-hidden border">
                                           <img src="{{ asset('images/products/' . $item->gambar) }}"
                                                class="w-full h-full object-cover"
                                                loading="lazy"
                                                onerror="this.src='{{ asset('images/default-product.jpg') }}'">
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="font-bold text-gray-800">{{ $item->nama_produk }}</h4>
                                            <div class="flex items-center gap-3 mt-1 text-xs text-gray-500">
                                                @if($item->ukuran)
                                                <span class="bg-gray-200 px-2 py-1 rounded">Size {{ $item->ukuran }}</span>
                                                @endif
                                                <span>{{ $item->qty }} Unit</span>
                                            </div>
                                            <p class="text-sm font-bold text-gray-700 mt-2">
                                                Rp{{ number_format($item->harga, 0, ',', '.') }} × {{ $item->qty }}
                                                = Rp{{ number_format($item->total_harga, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                <div class="flex justify-between items-center pt-6 border-t border-dashed">
                                    <div class="text-sm text-gray-500">Total {{ $order->total_items }} Unit</div>
                                    <div class="text-right">
                                        <p class="text-xs text-gray-400 uppercase">Total Pembayaran</p>
                                        <p class="text-2xl font-black text-[#4A3428]">
                                            Rp{{ number_format($order->grand_total, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-6 text-right">
                                    <a href="{{ route('customer.orders.receipt', $order->id) }}"
                                    class="px-6 py-2 border border-[#4A3428] text-[#4A3428] rounded-xl text-xs font-bold hover:bg-[#4A3428] hover:text-white transition">
                                        Lihat Struk
                                    </a>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-20 bg-gray-50 rounded-3xl border border-dashed border-gray-200">
                                <p class="text-gray-400 text-sm italic">Belum ada riwayat pesanan yang selesai.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
let map      = null;
let marker   = null;
let debTimer = null;

function initMap() {
    if (map !== null) { map.invalidateSize(); return; }

    map = L.map('main-map', { zoomControl: true }).setView([-6.2, 106.8167], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution : '© <a href="https://openstreetmap.org">OpenStreetMap</a>',
        maxZoom     : 19
    }).addTo(map);

    map.getPanes().mapPane.style.zIndex       = '1';
    map.getPanes().tilePane.style.zIndex      = '1';
    map.getPanes().overlayPane.style.zIndex   = '2';
    map.getPanes().shadowPane.style.zIndex    = '3';
    map.getPanes().markerPane.style.zIndex    = '4';
    map.getPanes().tooltipPane.style.zIndex   = '5';
    map.getPanes().popupPane.style.zIndex     = '6';

    map.on('click', function (e) {
        setMarker(e.latlng.lat, e.latlng.lng);
        reverseGeocode(e.latlng.lat, e.latlng.lng);
    });

    const saved = document.getElementById('alamat-hidden').value;
    if (saved && saved.trim()) {
        geocodeForward(saved);
    }

    setTimeout(() => map.invalidateSize(), 300);
}

function setMarker(lat, lng) {
    const icon = L.divIcon({
        className : '',
        iconAnchor: [18, 44],
        html: `<svg width="36" height="48" viewBox="0 0 36 48" xmlns="http://www.w3.org/2000/svg">
                 <path d="M18 0C8.06 0 0 8.06 0 18c0 13.5 18 30 18 30S36 31.5 36 18C36 8.06 27.94 0 18 0z" fill="#4A3428"/>
                 <circle cx="18" cy="18" r="9" fill="white"/>
                 <circle cx="18" cy="18" r="5" fill="#4A3428"/>
               </svg>`
    });

    if (marker) {
        marker.setLatLng([lat, lng]);
    } else {
        marker = L.marker([lat, lng], { icon, draggable: true }).addTo(map);
        marker.on('dragend', function () {
            const p = marker.getLatLng();
            reverseGeocode(p.lat, p.lng);
        });
        marker.on('drag', function () {
            const hint = document.getElementById('map-hint');
            if (hint) hint.style.opacity = '0';
        });
    }

    map.flyTo([lat, lng], 16, { duration: 1 });
}

function reverseGeocode(lat, lng) {
    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`, {
        headers: { 'Accept-Language': 'id' }
    })
    .then(r => r.json())
    .then(d => { if (d && d.display_name) applyAddress(d.display_name); })
    .catch(() => applyAddress(`${lat.toFixed(6)}, ${lng.toFixed(6)}`));
}

function geocodeForward(text) {
    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(text)}&limit=1&countrycodes=id`, {
        headers: { 'Accept-Language': 'id' }
    })
    .then(r => r.json())
    .then(d => {
        if (d && d.length > 0) {
            setMarker(parseFloat(d[0].lat), parseFloat(d[0].lon));
        }
    });
}

function applyAddress(text) {
    document.getElementById('addr-search').value          = text;
    document.getElementById('alamat-hidden').value        = text;
    document.getElementById('addr-info-text').textContent = text;
    document.getElementById('addr-info').classList.remove('hidden');
}

document.addEventListener('DOMContentLoaded', function () {
    const input    = document.getElementById('addr-search');
    const dropdown = document.getElementById('addr-dropdown');

    if (!input) return;

    input.addEventListener('input', function () {
        const q = this.value.trim();
        clearTimeout(debTimer);
        dropdown.classList.add('hidden');
        dropdown.innerHTML = '';
        if (q.length < 2) return;

        debTimer = setTimeout(() => {
            fetch(`https://photon.komoot.io/api/?q=${encodeURIComponent(q)}&limit=6&lang=id&bbox=94.0,5.9,141.0,-11.1`)
                .then(r => r.json())
                .then(data => {
                    if (!data.features || data.features.length === 0) return;

                    data.features.forEach((f, i) => {
                        const p     = f.properties;
                        const parts = [p.name, p.street, p.city, p.state, p.country].filter(Boolean);
                        const label = parts.join(', ');
                        const sub   = [p.postcode, p.country].filter(Boolean).join(' · ');

                        const li = document.createElement('li');
                        li.className = [
                            'flex items-start gap-3 px-4 py-3 cursor-pointer',
                            'hover:bg-[#4A3428]/5 transition-colors list-none',
                            i < data.features.length - 1 ? 'border-b border-gray-100' : ''
                        ].join(' ');

                        li.innerHTML = `
                            <svg class="w-4 h-4 text-[#4A3428] shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-gray-800 truncate">${label}</p>
                                ${sub ? `<p class="text-xs text-gray-400 truncate mt-0.5">${sub}</p>` : ''}
                            </div>`;

                        li.addEventListener('click', function () {
                            const [lng, lat] = f.geometry.coordinates;
                            applyAddress(label);
                            dropdown.classList.add('hidden');
                            if (map) setMarker(lat, lng);
                        });

                        dropdown.appendChild(li);
                    });

                    dropdown.classList.remove('hidden');
                })
                .catch(() => {});
        }, 350);
    });

    input.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            const first = dropdown.querySelector('li');
            if (first) first.click();
        }
    });

    document.addEventListener('click', function (e) {
        if (!input.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
});

@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2500,
        timerProgressBar: true
    });
@endif
</script>

<style>
    [x-cloak] { display: none !important; }

    .map-wrapper {
        position: relative;
        height: 320px;
        border-radius: 1rem;
        overflow: hidden;
        border: 1px solid #f3f4f6;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.06);
        isolation: isolate;
        contain: layout style;
    }

    #main-map {
        width: 100%;
        height: 100%;
        position: relative;
        z-index: 1;
    }

    .map-hint {
        position: absolute;
        bottom: 12px;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(74, 52, 40, 0.85);
        color: #fff;
        font-size: 11px;
        font-weight: 600;
        padding: 6px 14px;
        border-radius: 999px;
        display: flex;
        align-items: center;
        gap: 5px;
        white-space: nowrap;
        pointer-events: none;
        z-index: 20;
        backdrop-filter: blur(4px);
        transition: opacity 0.4s ease;
    }

    .leaflet-pane,
    .leaflet-tile,
    .leaflet-marker-icon,
    .leaflet-marker-shadow,
    .leaflet-tile-pane,
    .leaflet-overlay-pane,
    .leaflet-shadow-pane,
    .leaflet-marker-pane,
    .leaflet-popup-pane,
    .leaflet-map-pane svg,
    .leaflet-map-pane canvas {
        z-index: auto !important;
    }

    .leaflet-control-container .leaflet-top,
    .leaflet-control-container .leaflet-bottom {
        z-index: 10 !important;
    }

    #addr-dropdown { z-index: 9999 !important; }

    .leaflet-container { font-family: inherit; }
</style>
@endsection