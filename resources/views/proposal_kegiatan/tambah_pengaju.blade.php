
@extends('proposal_kegiatan/reviewer')
@section('konten')
<div class="p-8">
    <h1 class="text-2xl font-semibold text-gray-700 mb-6">Tambah Pengaju</h1>
    <form action="{{ route('store.pengaju') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Section: Username -->
        <div class="mb-6">
            <label for="username" class="block text-sm font-medium text-gray-700 mb-2">Username</label>
            <input type="text" id="username" name="username" 
                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out" 
                placeholder="Masukkan username" value="{{ old('username') }}" required />
            <span class="mt-1 text-sm text-red-500">@error('username') {{ $message }} @enderror</span>
        </div>

        <!-- Section: Email -->
        <div class="mb-6">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input type="email" id="email" name="email" 
                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out" 
                placeholder="Masukkan email" value="{{ old('email') }}" required />
            <span class="mt-1 text-sm text-red-500">@error('email') {{ $message }} @enderror</span>
        </div>

        <!-- Section: Password -->
        <div class="mb-6">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
            <input type="password" id="password" name="password" 
                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out" 
                placeholder="Masukkan password" required />
            <span class="mt-1 text-sm text-red-500">@error('password') {{ $message }} @enderror</span>
        </div>

        <!-- Section: Foto Profil -->
        <div class="mb-6">
            <label for="foto_profil" class="block text-sm font-medium text-gray-700 mb-2">Foto Profil</label>
            <input type="file" id="foto_profil" name="foto_profil" 
                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out" 
                accept="image/*" />
            <span class="mt-1 text-sm text-red-500">@error('foto_profil') {{ $message }} @enderror</span>
        </div>

        <!-- Section: Ormawa -->
        <div class="mb-6">
            <label for="ormawa" class="block text-sm font-medium text-gray-700 mb-2">Ormawa</label>
            <select name="id_ormawa" id="ormawa" 
                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out" 
                required>
                <option value="" disabled selected>Pilih Ormawa</option>
                @foreach ($ormawas as $id => $nama)
                    <option value="{{ $id }}">{{ $nama }}</option>
                @endforeach
            </select>
            <span class="mt-1 text-sm text-red-500">@error('id_ormawa') {{ $message }} @enderror</span>
        </div>

        <button type="submit" class="w-full py-3 px-4 bg-blue-500 text-white font-semibold rounded-xl hover:bg-blue-600 transition duration-200 ease-in-out">Simpan</button>
    </form>
</div>

@endsection