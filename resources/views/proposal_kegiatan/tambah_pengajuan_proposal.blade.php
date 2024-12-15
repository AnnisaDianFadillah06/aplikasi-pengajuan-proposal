@extends('proposal_kegiatan\pengaju')


@section('konten')
@if ($errors->any())
    <div class="mb-4 text-red-500">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<main class="mt-0 transition-all duration-200 ease-soft-in-out">
    <section class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="container max-w-lg p-6 mx-auto bg-white rounded-lg shadow-lg">
            <h3 class="text-2xl font-bold text-center text-gray-700">Form Input</h3>
            <p class="text-center text-gray-500">Silakan isi form di bawah ini</p>
            
            <form class="mt-6" action="add" method="post" enctype="multipart/form-data">
                @csrf <!-- Token CSRF Laravel -->
                
                <!-- Gunakan ul dan li untuk input form -->
                <ul class="space-y-4">
                    <!-- Inputan nama_kegiatan -->
                    <li class="flex flex-col">
                        <label for="nama_kegiatan" class="mb-2 font-semibold text-gray-700">Nama Kegiatan</label>
                        <input type="text" id="nama_kegiatan" name="nama_kegiatan" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Masukan nama kegiatan" value="{{ old('nama_kegiatan') }}"/>
                        <span style="color:red">@error('nama_kegiatan') {{ $message }} @enderror</span>
                    </li>
            
                    <!-- Inputan Tempat kegiatan -->
                    <li class="flex flex-col">
                        <label for="tempat_kegiatan" class="mb-2 font-semibold text-gray-700">Tempat kegiatan</label>
                        <input type="text" id="tempat_kegiatan" name="tempat_kegiatan" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Masukan tempat kegiatan" value="{{ old('tempat_kegiatan') }}"/>
                        <span style="color:red">@error('tempat_kegiatan') {{ $message }} @enderror</span>
                    </li>
            
                    <!-- Inputan Tanggal kegiatan -->
                    <li class="flex flex-col">
                        <label for="tanggal_kegiatan" class="mb-2 font-semibold text-gray-700">Tanggal kegiatan</label>
                        <input type="date" id="tanggal_kegiatan" name="tanggal_kegiatan" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('tanggal_kegiatan') }}"/>
                        <span style="color:red">@error('tanggal_kegiatan') {{ $message }} @enderror</span>
                    </li>

                    <!-- Dropdown Bidang Kegiatan -->
                    <li class="flex flex-col">
                        <label for="bidang_kegiatan" class="mb-2 font-semibold text-gray-700">Bidang Kegiatan</label>
                        <select id="bidang_kegiatan" name="id_bidang_kegiatan" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <option value="">--Pilih Bidang Kegiatan --</option>
                            @foreach($bidang_kegiatans as $bk)
                                <option value="{{ $bk->id_bidang_kegiatan}}">{{ $bk->nama_bidang_kegiatan }}</option>
                            @endforeach
                        </select>
                        <span style="color:red">@error('bidang_kegiatan') {{ $message }} @enderror</span>
                    </li>
            
                    <!-- Dropdown Jenis Kegiatan -->
                    <li class="flex flex-col">
                        <label for="jenis_kegiatan" class="mb-2 font-semibold text-gray-700">Jenis Kegiatan</label>
                        <select id="jenis_kegiatan" name="id_jenis_kegiatan" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <option value="">--Pilih Jenis Kegiatan --</option>
                            @foreach($jenis_kegiatans as $jk)
                                <option value="{{ $jk->id_jenis_kegiatan }}">{{ $jk->nama_jenis_kegiatan }}</option>
                            @endforeach
                        </select>
                        <span style="color:red">@error('jenis_kegiatan') {{ $message }} @enderror</span>
                    </li>
            
                    <!-- Dropdown Ormawa -->
                    <li class="flex flex-col">
                        <label for="ormawa" class="mb-2 font-semibold text-gray-700">Asal Ormawa</label>
                        <select id="ormawa" name="id_ormawa" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <option value="">--Pilih--</option>
                            @foreach($ormawas as $ormawa)
                                <option value="{{ $ormawa->id_ormawa }}">{{ $ormawa->nama_ormawa }}</option>
                            @endforeach
                        </select>
                        <span style="color:red">@error('id_ormawa') {{ $message }} @enderror</span>
                    </li>
            
                    <!-- Input Attach File -->
                    <li class="flex flex-col">
                        <label for="file" class="mb-2 font-semibold text-gray-700">Upload Dokumen Proposal</label>
                        <input type="file" id="file" name="file" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
                        <span style="color:red">@error('file') {{ $message }} @enderror</span>
                    </li>
                </ul>
            
                <!-- Tombol Submit -->
                <div class="text-center">
                    <button type="submit" class="w-full px-4 py-2 font-semibold text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        Submit
                    </button>
                </div>                
            </form>
            
        </div>
    </section>
</main>
@endsection
