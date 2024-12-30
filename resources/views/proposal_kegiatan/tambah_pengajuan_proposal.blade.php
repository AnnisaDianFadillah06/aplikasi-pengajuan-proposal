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
    <section class="flex items-center justify-center min-h-screen bg-gray-50">
        <div class="container max-w-lg p-8 mx-auto bg-white rounded-3xl shadow-md">
            <h3 class="text-3xl font-extrabold text-center text-gray-800">Form Input</h3>
            <p class="mt-2 text-center text-gray-500">Silakan isi form di bawah ini</p>
            
            <form class="mt-8" action="add" method="post" enctype="multipart/form-data">
                @csrf <!-- Token CSRF Laravel -->
                
                <ul class="space-y-6">
                    <!-- Inputan Nama Kegiatan -->
                    <li class="flex flex-col">
                        <label for="nama_kegiatan" class="mb-2 text-sm font-medium text-gray-700">Nama Kegiatan</label>
                        <input type="text" id="nama_kegiatan" name="nama_kegiatan" 
                            class="px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 rounded-xl"
                            placeholder="Masukan nama kegiatan" value="{{ old('nama_kegiatan') }}" />
                        <span class="mt-1 text-sm text-red-500">@error('nama_kegiatan') {{ $message }} @enderror</span>
                    </li>
            
                    <!-- Inputan Tempat Kegiatan -->
                    <li class="flex flex-col">
                        <label for="tempat_kegiatan" class="mb-2 text-sm font-medium text-gray-700">Tempat Kegiatan</label>
                        <input type="text" id="tempat_kegiatan" name="tempat_kegiatan"
                            class="px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 rounded-xl"
                            placeholder="Masukan tempat kegiatan" value="{{ old('tempat_kegiatan') }}" />
                        <span class="mt-1 text-sm text-red-500">@error('tempat_kegiatan') {{ $message }} @enderror</span>
                    </li>

                    <!-- Dropdown Bidang Kegiatan -->
                    <li class="flex flex-col">
                        <label for="bidang_kegiatan" class="mb-2 text-sm font-medium text-gray-700">Bidang Kegiatan</label>
                        <select id="bidang_kegiatan" name="id_bidang_kegiatan"
                            class="px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 rounded-xl">
                            <option value="">-- Pilih Bidang Kegiatan --</option>
                            @foreach($bidang_kegiatans as $bk)
                                <option value="{{ $bk->id_bidang_kegiatan }}">{{ $bk->nama_bidang_kegiatan }}</option>
                            @endforeach
                        </select>
                        <span class="mt-1 text-sm text-red-500">@error('bidang_kegiatan') {{ $message }} @enderror</span>
                    </li>
            
                    <!-- Dropdown Jenis Kegiatan -->
                    <li class="flex flex-col">
                        <label for="jenis_kegiatan" class="mb-2 text-sm font-medium text-gray-700">Jenis Kegiatan</label>
                        <select id="jenis_kegiatan" name="id_jenis_kegiatan"
                            class="px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 rounded-xl">
                            <option value="">-- Pilih Jenis Kegiatan --</option>
                            @foreach($jenis_kegiatans as $jk)
                                <option value="{{ $jk->id_jenis_kegiatan }}">{{ $jk->nama_jenis_kegiatan }}</option>
                            @endforeach
                        </select>
                        <span class="mt-1 text-sm text-red-500">@error('jenis_kegiatan') {{ $message }} @enderror</span>
                    </li>

                    <!-- Inputan Tanggal kegiatan -->
                    {{-- <li class="flex flex-col">
                        <label for="tanggal_kegiatan" class="mb-2 text-sm font-medium text-gray-700">Tanggal Kegiatan</label>
                        <input type="date" id="tanggal_kegiatan" name="tanggal_kegiatan"
                            class="px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 rounded-xl"
                            value="{{ old('tanggal_kegiatan') }}" />
                        <span class="mt-1 text-sm text-red-500">@error('tanggal_kegiatan') {{ $message }} @enderror</span>
                    </li> --}}
            
                    <!-- Inputan Tanggal Mulai -->
                    <li class="flex flex-col">
                        <label for="tanggal_mulai" class="mb-2 text-sm font-medium text-gray-700">Tanggal Mulai</label>
                        <input type="date" id="tanggal_mulai" name="tanggal_mulai"
                            class="px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 rounded-xl"
                            value="{{ old('tanggal_mulai') }}" />
                        <span class="mt-1 text-sm text-red-500">@error('tanggal_mulai') {{ $message }} @enderror</span>
                    </li>

                    <!-- Inputan Tanggal Akhir -->
                    <li class="flex flex-col">
                        <label for="tanggal_akhir" class="mb-2 text-sm font-medium text-gray-700">Tanggal Akhir</label>
                        <input type="date" id="tanggal_akhir" name="tanggal_akhir"
                            class="px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 rounded-xl"
                            value="{{ old('tanggal_akhir') }}" />
                        <span class="mt-1 text-sm text-red-500">@error('tanggal_akhir') {{ $message }} @enderror</span>
                    </li>
                    <li class="flex flex-col">
                        <label for="file" class="mb-2 font-semibold text-gray-700">Upload Dokumen Proposal</label>
                        <input type="file" id="file_proposal" name="file_proposal" class="block w-full text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:rounded-lg file:text-sm file:bg-blue-500 file:text-white hover:file:bg-blue-600
                        " /> 
                        <button type="button" onclick="cancelUpload('file_proposal')" class="px-3 py-1 mt-3 text-white bg-red-500 rounded-lg hover:bg-red-600">Cancel</button>
                        <span style="color:red">@error('file') {{ $message }} @enderror</span>
                    </li>
                    <li class="flex flex-col">
                        <label for="surat_berkegiatan_ketuplak" class="mb-2 font-semibold text-gray-700">Lampiran Surat Berkegiatan Ketuplak</label>
                        <div class="flex items-center space-x-4">
                            <input type="file" id="surat_berkegiatan_ketuplak" name="surat_berkegiatan_ketuplak" class="block w-full text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:rounded-lg file:text-sm file:bg-blue-500 file:text-white hover:file:bg-blue-600" />
                            <button type="button" onclick="cancelUpload('surat_berkegiatan_ketuplak')" class="px-3 py-1 text-white bg-red-500 rounded-lg hover:bg-red-600">Cancel</button>
                        </div>
                        <span style="color:red">@error('surat_berkegiatan_ketuplak') {{ $message }} @enderror</span>
                    </li>
                    <li class="flex flex-col">
                        <label for="surat_pernyataan_ormawa" class="mb-2 font-semibold text-gray-700">Lampiran Surat Pernyataan Ormawa</label>
                        <div class="flex items-center space-x-4">
                            <input type="file" id="surat_pernyataan_ormawa" name="surat_pernyataan_ormawa" class="block w-full text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:rounded-lg file:text-sm file:bg-blue-500 file:text-white hover:file:bg-blue-600" />
                            <button type="button" onclick="cancelUpload('surat_pernyataan_ormawa')" class="px-3 py-1 text-white bg-red-500 rounded-lg hover:bg-red-600">Cancel</button>
                        </div>
                        <span style="color:red">@error('surat_pernyataan_ormawa') {{ $message }} @enderror</span>
                    </li>
                    <li class="flex flex-col">
                        <label for="surat_kesediaan_pembina" class="mb-2 font-semibold text-gray-700">Lampiran Surat Kesediaan Pembina</label>
                        <div class="flex items-center space-x-4">
                            <input type="file" id="surat_kesediaan_pendampingan" name="surat_kesediaan_pendampingan" class="block w-full text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:rounded-lg file:text-sm file:bg-blue-500 file:text-white hover:file:bg-blue-600" />
                            <button type="button" onclick="cancelUpload('surat_kesediaan_pendampingan')" class="px-3 py-1 text-white bg-red-500 rounded-lg hover:bg-red-600">Cancel</button>
                        </div>
                        <span style="color:red">@error('surat_kesediaan_pendampingan') {{ $message }} @enderror</span>
                    </li>
                    <li class="flex flex-col">
                        <label for="surat_peminjaman_sarpras" class="mb-2 font-semibold text-gray-700">Lampiran Surat Peminjaman Sarpras</label>
                        <div class="flex items-center space-x-4">
                            <input type="file" id="surat_peminjaman_sarpras" name="surat_peminjaman_sarpras" class="block w-full text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:rounded-lg file:text-sm file:bg-blue-500 file:text-white hover:file:bg-blue-600" />
                            <button type="button" onclick="cancelUpload('surat_peminjaman_sarpras')" class="px-3 py-1 text-white bg-red-500 rounded-lg hover:bg-red-600">Cancel</button>
                        </div>
                        <span style="color:red">@error('surat_peminjaman_sarpras') {{ $message }} @enderror</span>
                    </li>                    
                </ul>
                
                <!-- Tombol Submit -->
                <div class="mt-6 text-center">
                    <button type="submit"
                        class="w-full px-4 py-3 font-semibold text-white transition-colors duration-300 bg-blue-500 rounded-xl shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Submit
                    </button>
                </div>                
            </form>
        </div>
    </section>
</main>


<script>
    // Fungsi untuk menghapus file input
    function cancelUpload(inputId) {
        document.getElementById(inputId).value = '';
    }
</script>
@endsection
