@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10 space-y-8">

    <h2 class="text-4xl font-black text-[#4A3428] uppercase tracking-tight">
        Edit Profil
    </h2>

    <form action="{{ route('customer.profile.update', $customer->id) }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white rounded-[2.5rem] p-6 md:p-10 shadow-xl border border-[#D9B382]/20">

        @csrf
        @method('PUT')

        <div class="grid md:grid-cols-3 gap-8">

            {{-- FOTO --}}
           <div class="flex flex-col items-center gap-4">
            <div class="w-32 h-32 md:w-40 md:h-40 rounded-full overflow-hidden border-4 border-[#D9B382] shadow-lg">
                
                @if($customer->foto)
                    <img id="previewFoto"
                         src="{{ asset('images/customers/' . $customer->foto) }}"
                         class="w-full h-full object-cover"
                         loading="lazy">
                @else
                    <img id="previewFoto"
                         src="{{ asset('images/default-user.png') }}"
                         class="w-full h-full object-cover">
                @endif
        
            </div>
        
            <label class="cursor-pointer text-xs font-black uppercase text-[#4A3428]">
                Ganti Foto
                <input type="file"
                       name="foto"
                       id="inputFoto"
                       class="hidden"
                       accept="image/*"
                       onchange="previewImage(event)">
            </label>
        
            <p class="text-[10px] text-gray-400 text-center">
                JPG / PNG • Max 2MB
            </p>
        </div>

            {{-- FORM --}}
            <div class="md:col-span-2 space-y-4">
                <input type="text" name="username" value="{{ old('username',$customer->username) }}"
                       class="w-full px-6 py-4 bg-[#F8F5F2] rounded-2xl font-bold"
                       placeholder="Username">

                <input type="email" name="email" value="{{ old('email',$customer->email) }}"
                       class="w-full px-6 py-4 bg-[#F8F5F2] rounded-2xl font-bold"
                       placeholder="Email">

                <input type="text" name="no_hp" value="{{ old('no_hp',$customer->no_hp) }}"
                       class="w-full px-6 py-4 bg-[#F8F5F2] rounded-2xl font-bold"
                       placeholder="No HP">

                <textarea name="alamat"
                          class="w-full px-6 py-4 bg-[#F8F5F2] rounded-2xl font-bold"
                          placeholder="Alamat">{{ old('alamat',$customer->alamat) }}</textarea>

                <div class="border-t pt-4">
                    <p class="text-xs italic text-gray-400 mb-2">
                        Kosongkan jika tidak ingin mengganti password
                    </p>

                    <input type="password" name="password"
                           class="w-full mb-3 px-6 py-4 bg-[#F8F5F2] rounded-2xl font-bold"
                           placeholder="Password baru">

                    <input type="password" name="password_confirmation"
                           class="w-full px-6 py-4 bg-[#F8F5F2] rounded-2xl font-bold"
                           placeholder="Konfirmasi password">
                </div>
            </div>
        </div>

        <div class="flex justify-between mt-8">
            <a href="{{ route('customer.profile') }}"
               class="px-8 py-4 bg-gray-100 rounded-2xl font-black text-xs uppercase">
                Batal
            </a>

            <button type="submit"
                    class="px-10 py-4 bg-[#D9B382] text-[#4A3428] rounded-2xl font-black uppercase text-xs hover:bg-[#c4a175]">
                Simpan
            </button>
        </div>
    </form>
</div>


<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('previewFoto');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection
