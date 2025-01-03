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
                    <!-- Inputan Nama Penanggung Jawab -->
                    <li class="flex flex-col">
                        <label for="nama_penanggung_jawab" class="mb-2 text-sm font-medium text-gray-700">Nama Penanggung Jawab</label>
                        <input type="text" id="nama_penanggung_jawab" name="nama_penanggung_jawab"
                            class="px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 rounded-xl"
                            placeholder="Masukan nama penanggung jawab" value="{{ old('nama_penanggung_jawab') }}" />
                        <span class="mt-1 text-sm text-red-500">@error('nama_penanggung_jawab') {{ $message }} @enderror</span>
                    </li>

                    <!-- Inputan Email Penanggung Jawab -->
                    <li class="flex flex-col">
                        <label for="email_penanggung_jawab" class="mb-2 text-sm font-medium text-gray-700">Email Penanggung Jawab</label>
                        <input type="email" id="email_penanggung_jawab" name="email_penanggung_jawab"
                            class="px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 rounded-xl"
                            placeholder="Masukan email penanggung jawab" value="{{ old('email_penanggung_jawab') }}" />
                        <span class="mt-1 text-sm text-red-500">@error('email_penanggung_jawab') {{ $message }} @enderror</span>
                    </li>

                    <!-- Inputan Nomor HP Penanggung Jawab -->
                    <li class="flex flex-col">
                        <label for="no_hp_penanggung_jawab" class="mb-2 text-sm font-medium text-gray-700">No HP Penanggung Jawab</label>
                        <input type="text" id="no_hp_penanggung_jawab" name="no_hp_penanggung_jawab"
                            class="px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 rounded-xl"
                            placeholder="Masukan nomor HP penanggung jawab" value="{{ old('no_hp_penanggung_jawab') }}" />
                        <span class="mt-1 text-sm text-red-500">@error('no_hp_penanggung_jawab') {{ $message }} @enderror</span>
                    </li>

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

                    <!-- Input Dana DIPA -->
                    <li class="flex flex-col">
                        <label for="dana_dipa" class="mb-2 text-sm font-medium text-gray-700">Dana DIPA Polban</label>
                        <input type="number" id="dana_dipa" name="dana_dipa" step="0.01"
                            class="px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 rounded-xl"
                            placeholder="Masukan jumlah dana DIPA" value="{{ old('dana_dipa') }}" />
                        <span class="mt-1 text-sm text-red-500">@error('dana_dipa') {{ $message }} @enderror</span>
                    </li>

                    <!-- Input Dana Swadaya -->
                    <li class="flex flex-col">
                        <label for="dana_swadaya" class="mb-2 text-sm font-medium text-gray-700">Dana Swadaya</label>
                        <input type="number" id="dana_swadaya" name="dana_swadaya" step="0.01"
                            class="px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 rounded-xl"
                            placeholder="Masukan jumlah dana swadaya" value="{{ old('dana_swadaya') }}" />
                        <span class="mt-1 text-sm text-red-500">@error('dana_swadaya') {{ $message }} @enderror</span>
                    </li>

                    <!-- Input Dana Sponsor -->
                    <li class="flex flex-col">
                        <label for="dana_sponsor" class="mb-2 text-sm font-medium text-gray-700">Dana Sponsor</label>
                        <input type="number" id="dana_sponsor" name="dana_sponsor" step="0.01"
                            class="px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 rounded-xl"
                            placeholder="Masukan jumlah dana sponsor" value="{{ old('dana_sponsor') }}" />
                        <span class="mt-1 text-sm text-red-500">@error('dana_sponsor') {{ $message }} @enderror</span>
                    </li>

                    <!-- Input Pengisi Acara -->
                    <li class="flex flex-col">
                        <label for="pengisi_acara" class="mb-2 text-sm font-medium text-gray-700">Pengisi Acara/Narasumber/Juri</label>
                        <textarea id="pengisi_acara" name="pengisi_acara"
                            class="px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 rounded-xl"
                            placeholder="Masukan nama pengisi acara">{{ old('pengisi_acara') }}</textarea>
                        <span class="mt-1 text-sm text-red-500">@error('pengisi_acara') {{ $message }} @enderror</span>
                    </li>

                    <!-- Input Sponsorship -->
                    <li class="flex flex-col">
                        <label for="sponsorship" class="mb-2 text-sm font-medium text-gray-700">Sponsorship</label>
                        <textarea id="sponsorship" name="sponsorship"
                            class="px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 rounded-xl"
                            placeholder="Masukan nama sponsorship">{{ old('sponsorship') }}</textarea>
                        <span class="mt-1 text-sm text-red-500">@error('sponsorship') {{ $message }} @enderror</span>
                    </li>

                    <!-- Input Media Partner -->
                    <li class="flex flex-col">
                        <label for="media_partner" class="mb-2 text-sm font-medium text-gray-700">Media Partner</label>
                        <textarea id="media_partner" name="media_partner"
                            class="px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 rounded-xl"
                            placeholder="Masukan nama media partner">{{ old('media_partner') }}</textarea>
                        <span class="mt-1 text-sm text-red-500">@error('media_partner') {{ $message }} @enderror</span>
                    </li>

                    <!-- Inputan Jumlah SPJ -->
                    <li class="flex flex-col">
                        <label for="jumlah_spj" class="mb-2 text-sm font-medium text-gray-700">Jumlah SPJ</label>
                        <input type="number" id="jumlah_spj" name="jumlah_spj"
                            class="px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 rounded-xl"
                            placeholder="Masukan jumlah SPJ" value="{{ old('jumlah_spj') }}" min="0" />
                        <span class="mt-1 text-sm text-red-500">@error('jumlah_spj') {{ $message }} @enderror</span>
                    </li>

                    <li class="flex flex-col">
                        <label for="file" class="mb-2 font-semibold text-gray-700">Upload Dokumen Proposal (TOR untuk pergerakan)</label>
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
                        <label for="surat_peminjaman_sarpras" class="mb-2 font-semibold text-gray-700">Lampiran Surat Peminjaman Sarpras</label>
                        <div class="flex items-center space-x-4">
                            <input type="file" id="surat_peminjaman_sarpras" name="surat_peminjaman_sarpras" class="block w-full text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:rounded-lg file:text-sm file:bg-blue-500 file:text-white hover:file:bg-blue-600" />
                            <button type="button" onclick="cancelUpload('surat_peminjaman_sarpras')" class="px-3 py-1 text-white bg-red-500 rounded-lg hover:bg-red-600">Cancel</button>
                        </div>
                        <span style="color:red">@error('surat_peminjaman_sarpras') {{ $message }} @enderror</span>
                    </li>   
                    
                    <!-- Inputan Poster Kegiatan -->
                    <li class="flex flex-col">
                        <label for="poster_kegiatan" class="mb-2 text-sm font-medium text-gray-700">Poster Kegiatan</label>
                        <input type="file" id="poster_kegiatan" name="poster_kegiatan"
                            class="px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 rounded-xl"
                            accept="image/*" />
                        <span class="mt-1 text-sm text-red-500">@error('poster_kegiatan') {{ $message }} @enderror</span>
                    </li>

                    <!-- Inputan Caption Poster -->
                    <li class="flex flex-col">
                        <label for="caption_poster" class="mb-2 text-sm font-medium text-gray-700">Caption Poster</label>
                        <textarea id="caption_poster" name="caption_poster"
                            class="px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 rounded-xl"
                            placeholder="Masukkan caption untuk poster">{{ old('caption_poster') }}</textarea>
                        <span class="mt-1 text-sm text-red-500">@error('caption_poster') {{ $message }} @enderror</span>
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
