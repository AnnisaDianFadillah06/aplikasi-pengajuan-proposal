@extends('proposal_kegiatan\pengaju')

@section('konten')

<main class="max-w-4xl mx-auto px-4">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header Section -->
            <div class="px-8 py-12 bg-gradient-to-r from-blue-600 to-orange-700 text-center">
                <h3 class="text-3xl font-bold text-white">Form Kegiatan</h3>
                <p class="mt-2 text-blue-100">Silakan lengkapi detail kegiatan Anda</p>
            </div>

            <form class="p-8" action="add" method="post" enctype="multipart/form-data">
                @csrf
                
                <!-- Section: Informasi Penanggung Jawab -->
                <div class="mb-10">
                    <h4 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-6">Informasi Penanggung Jawab</h4>
                    <div class="space-y-6">
                        <div>
                            <label for="nama_penanggung_jawab" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Penanggung Jawab
                            </label>
                            <input type="text" id="nama_penanggung_jawab" name="nama_penanggung_jawab"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out"
                                placeholder="Masukan nama penanggung jawab" value="{{ old('nama_penanggung_jawab') }}" />
                            <span class="mt-1 text-sm text-red-500">@error('nama_penanggung_jawab') {{ $message }} @enderror</span>
                        </div>

                        <div>
                            <label for="email_penanggung_jawab" class="block text-sm font-medium text-gray-700 mb-2">
                                Email Penanggung Jawab
                            </label>
                            <input type="email" id="email_penanggung_jawab" name="email_penanggung_jawab"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out"
                                placeholder="Masukan email penanggung jawab" value="{{ old('email_penanggung_jawab') }}" />
                            <span class="mt-1 text-sm text-red-500">@error('email_penanggung_jawab') {{ $message }} @enderror</span>
                        </div>

                        <div>
                            <label for="no_hp_penanggung_jawab" class="block text-sm font-medium text-gray-700 mb-2">
                                No HP Penanggung Jawab
                            </label>
                            <input type="text" id="no_hp_penanggung_jawab" name="no_hp_penanggung_jawab"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out"
                                placeholder="Masukan nomor HP penanggung jawab" value="{{ old('no_hp_penanggung_jawab') }}" />
                            <span class="mt-1 text-sm text-red-500">@error('no_hp_penanggung_jawab') {{ $message }} @enderror</span>
                        </div>
                    </div>
                </div>

                <!-- Section: Detail Kegiatan -->
                <div class="mb-10">
                    <h4 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-6">Detail Kegiatan</h4>
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="nama_kegiatan" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Kegiatan
                                </label>
                                <input type="text" id="nama_kegiatan" name="nama_kegiatan"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out"
                                    placeholder="Masukan nama kegiatan" value="{{ old('nama_kegiatan') }}" />
                                <span class="mt-1 text-sm text-red-500">@error('nama_kegiatan') {{ $message }} @enderror</span>
                            </div>

                            <div>
                                <label for="tempat_kegiatan" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tempat Kegiatan
                                </label>
                                <input type="text" id="tempat_kegiatan" name="tempat_kegiatan"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out"
                                    placeholder="Masukan tempat kegiatan" value="{{ old('tempat_kegiatan') }}" />
                                <span class="mt-1 text-sm text-red-500">@error('tempat_kegiatan') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="bidang_kegiatan" class="block text-sm font-medium text-gray-700 mb-2">
                                    Bidang Kegiatan
                                </label>
                                <select id="bidang_kegiatan" name="id_bidang_kegiatan"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out">
                                    <option value="">-- Pilih Bidang Kegiatan --</option>
                                    @foreach($bidang_kegiatans as $bk)
                                        <option value="{{ $bk->id_bidang_kegiatan }}" 
                                            {{ old('id_bidang_kegiatan') == $bk->id_bidang_kegiatan ? 'selected' : '' }}>
                                            {{ $bk->nama_bidang_kegiatan }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="mt-1 text-sm text-red-500">@error('bidang_kegiatan') {{ $message }} @enderror</span>
                            </div>

                            <div>
                                <label for="jenis_kegiatan" class="block text-sm font-medium text-gray-700 mb-2">
                                    Jenis Kegiatan
                                </label>
                                <select id="jenis_kegiatan" name="id_jenis_kegiatan"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out">
                                    <option value="">-- Pilih Jenis Kegiatan --</option>
                                    @foreach($jenis_kegiatans as $jk)
                                        <option value="{{ $jk->id_jenis_kegiatan }}" 
                                            {{ old('id_jenis_kegiatan') == $jk->id_jenis_kegiatan ? 'selected' : '' }}>
                                            {{ $jk->nama_jenis_kegiatan }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="mt-1 text-sm text-red-500">@error('jenis_kegiatan') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tanggal Mulai
                                </label>
                                <input type="date" id="tanggal_mulai" name="tanggal_mulai"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out"
                                    value="{{ old('tanggal_mulai') }}" />
                                <span class="mt-1 text-sm text-red-500">@error('tanggal_mulai') {{ $message }} @enderror</span>
                            </div>

                            <div>
                                <label for="tanggal_akhir" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tanggal Akhir
                                </label>
                                <input type="date" id="tanggal_akhir" name="tanggal_akhir"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out"
                                    value="{{ old('tanggal_akhir') }}" />
                                <span class="mt-1 text-sm text-red-500">@error('tanggal_akhir') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="jml_peserta" class="block text-sm font-medium text-gray-700 mb-2">
                                    Jumlah Peserta
                                </label>
                                <input type="number" id="jml_peserta" name="jml_peserta" step="1" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out"
                                    placeholder="Masukkan jumlah peserta" value="{{ old('jml_peserta', 0) }}" />
                                <span class="mt-1 text-sm text-red-500">@error('jml_peserta') {{ $message }} @enderror</span>
                            </div>
                
                            <div>
                                <label for="jml_panitia" class="block text-sm font-medium text-gray-700 mb-2">
                                    Jumlah Panitia
                                </label>
                                <input type="number" id="jml_panitia" name="jml_panitia" step="1" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out"
                                    placeholder="Masukkan jumlah panitia" value="{{ old('jml_panitia', 0) }}" />
                                <span class="mt-1 text-sm text-red-500">@error('jml_panitia') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="jumlah_spj" class="block text-sm font-medium text-gray-700 mb-2">
                                Jumlah SPJ
                            </label>
                            <div class="relative">
                                <!-- Input Field -->
                                <input 
                                    type="number" 
                                    id="jumlah_spj" 
                                    name="jumlah_spj"
                                    min="0"
                                    step="1" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl 
                                           focus:ring-2 focus:ring-blue-500 focus:border-transparent 
                                           transition duration-200 ease-in-out
                                           pl-12"
                                    placeholder="Masukan jumlah SPJ" 
                                    value="{{ old('jumlah_spj') }}" 
                                />
                            </div>
                            <!-- Error Message -->
                            <span class="mt-1 text-sm text-red-500">@error('jumlah_spj') {{ $message }} @enderror</span>
                        </div>

                    </div>
                </div>

                <!-- Section: Informasi Dana -->
                <div class="mb-10">
                    <h4 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-6">Informasi Dana</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="dana_dipa" class="block text-sm font-medium text-gray-700 mb-2">
                                Dana DIPA Polban
                            </label>
                            <input type="number" id="dana_dipa" name="dana_dipa" step="1" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out"
                                placeholder="Masukan jumlah dana DIPA" value="{{ old('dana_dipa') }}" />
                            <span class="mt-1 text-sm text-red-500">@error('dana_dipa') {{ $message }} @enderror</span>
                        </div>

                        <div>
                            <label for="dana_swadaya" class="block text-sm font-medium text-gray-700 mb-2">
                                Dana Swadaya
                            </label>
                            <input type="number" id="dana_swadaya" name="dana_swadaya" step="1" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out"
                                placeholder="Masukan jumlah dana swadaya" value="{{ old('dana_swadaya') }}" />
                            <span class="mt-1 text-sm text-red-500">@error('dana_swadaya') {{ $message }} @enderror</span>
                        </div>

                        <div>
                            <label for="dana_sponsor" class="block text-sm font-medium text-gray-700 mb-2">
                                Dana Sponsor
                            </label>
                            <input type="number" id="dana_sponsor" name="dana_sponsor" step="1" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out"
                                placeholder="Masukan jumlah dana sponsor" value="{{ old('dana_sponsor') }}" />
                            <span class="mt-1 text-sm text-red-500">@error('dana_sponsor') {{ $message }} @enderror</span>
                        </div>
                    </div>
                </div>

                <!-- Section: Informasi Tambahan -->
                <div class="mb-10">
                    <h4 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-6">Informasi Tambahan</h4>
                    <div class="space-y-6">
                        <div>
                            <label for="pengisi_acara" class="block text-sm font-medium text-gray-700 mb-2">
                                Pengisi Acara/Narasumber/Juri
                            </label>
                            <textarea id="pengisi_acara" name="pengisi_acara" rows="3"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out"
                                placeholder="Masukan nama pengisi acara">{{ old('pengisi_acara') }}</textarea>
                            <span class="mt-1 text-sm text-red-500">@error('pengisi_acara') {{ $message }} @enderror</span>
                        </div>

                        <div>
                            <label for="sponsorship" class="block text-sm font-medium text-gray-700 mb-2">
                                Sponsorship
                            </label>
                            <textarea id="sponsorship" name="sponsorship" rows="3"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out"
                                placeholder="Masukan nama sponsorship">{{ old('sponsorship') }}</textarea>
                            <span class="mt-1 text-sm text-red-500">@error('sponsorship') {{ $message }} @enderror</span>
                        </div>

                        <div>
                            <label for="media_partner" class="block text-sm font-medium text-gray-700 mb-2">
                                Media Partner
                            </label>
                            <textarea id="media_partner" name="media_partner" rows="3"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out"
                                placeholder="Masukan nama media partner">{{ old('media_partner') }}</textarea>
                            <span class="mt-1 text-sm text-red-500">@error('media_partner') {{ $message }} @enderror</span>
                        </div>
                    

                    <h4 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-6">Lampiran</h4>
                    <div class="space-y-6">

                    <!-- File input -->
                    <li class="flex flex-col file-upload-container" data-input-name="file_proposal">
                        <label class="mb-2 font-medium text-gray-700 flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span>Upload Dokumen Proposal (Maks 2MB)</span>
                        </label>
                        <div class="flex items-center space-x-3">
                            <div class="relative flex-1">
                                <input type="file" class="file-input absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" 
                                    name="file_proposal" />
                                <div class="flex items-center px-4 py-3 border-2 border-dashed border-gray-300 hover:border-blue-500 rounded-xl transition-colors duration-300 bg-gray-50">
                                    <div class="flex items-center flex-1 space-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                        </svg>
                                        <span class="text-sm text-gray-500">Drag and drop file atau klik untuk memilih</span>
                                    </div>
                                    <button type="button" 
                                        class="px-4 py-2 text-sm font-medium text-blue-500 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors duration-300">
                                        Pilih File
                                    </button>
                                </div>
                            </div>
                            <button type="button" class="cancel-upload inline-flex items-center px-3 py-2 text-sm font-medium text-red-500 bg-red-50 rounded-lg hover:bg-red-100 transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Cancel
                            </button>
                        </div>
                        <div class="file-preview mt-2 hidden">
                            <div class="flex items-center p-2 space-x-3 bg-blue-50 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span class="preview-name text-sm text-blue-600 flex-1"></span>
                                <span class="preview-size text-xs text-blue-400"></span>
                            </div>
                        </div>
                        <span class="mt-1 text-sm text-red-500">@error('file_proposal') {{ $message }} @enderror</span>
                    </li>
                    <li class="flex flex-col file-upload-container" data-input-name="surat_berkegiatan_ketuplak">
                        <label class="mb-2 font-medium text-gray-700 flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span>Lampiran Surat Berkegiatan Ketuplak (Maks 2MB)</span>
                        </label>
                        <div class="flex items-center space-x-3">
                            <div class="relative flex-1">
                                <input type="file" class="file-input absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" 
                                    name="surat_berkegiatan_ketuplak" />
                                <div class="flex items-center px-4 py-3 border-2 border-dashed border-gray-300 hover:border-blue-500 rounded-xl transition-colors duration-300 bg-gray-50">
                                    <div class="flex items-center flex-1 space-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                        </svg>
                                        <span class="text-sm text-gray-500">Drag and drop file atau klik untuk memilih</span>
                                    </div>
                                    <button type="button" 
                                        class="px-4 py-2 text-sm font-medium text-blue-500 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors duration-300">
                                        Pilih File
                                    </button>
                                </div>
                            </div>
                            <button type="button" class="cancel-upload inline-flex items-center px-3 py-2 text-sm font-medium text-red-500 bg-red-50 rounded-lg hover:bg-red-100 transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Cancel
                            </button>
                        </div>
                        <div class="file-preview mt-2 hidden">
                            <div class="flex items-center p-2 space-x-3 bg-blue-50 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span class="preview-name text-sm text-blue-600 flex-1"></span>
                                <span class="preview-size text-xs text-blue-400"></span>
                            </div>
                        </div>
                        <span class="mt-1 text-sm text-red-500">@error('surat_berkegiatan_ketuplak') {{ $message }} @enderror</span>
                    </li>
                    <li class="flex flex-col file-upload-container" data-input-name="surat_pernyataan_ormawa">
                        <label class="mb-2 font-medium text-gray-700 flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span>Lampiran Surat Pernyataan Ormawa (Maks 2MB)</span>
                        </label>
                        <div class="flex items-center space-x-3">
                            <div class="relative flex-1">
                                <input type="file" class="file-input absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" 
                                    name="surat_pernyataan_ormawa" />
                                <div class="flex items-center px-4 py-3 border-2 border-dashed border-gray-300 hover:border-blue-500 rounded-xl transition-colors duration-300 bg-gray-50">
                                    <div class="flex items-center flex-1 space-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                        </svg>
                                        <span class="text-sm text-gray-500">Drag and drop file atau klik untuk memilih</span>
                                    </div>
                                    <button type="button" 
                                        class="px-4 py-2 text-sm font-medium text-blue-500 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors duration-300">
                                        Pilih File
                                    </button>
                                </div>
                            </div>
                            <button type="button" class="cancel-upload inline-flex items-center px-3 py-2 text-sm font-medium text-red-500 bg-red-50 rounded-lg hover:bg-red-100 transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Cancel
                            </button>
                        </div>
                        <div class="file-preview mt-2 hidden">
                            <div class="flex items-center p-2 space-x-3 bg-blue-50 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span class="preview-name text-sm text-blue-600 flex-1"></span>
                                <span class="preview-size text-xs text-blue-400"></span>
                            </div>
                        </div>
                        <span class="mt-1 text-sm text-red-500">@error('surat_pernyataan_ormawa') {{ $message }} @enderror</span>
                    </li>
                    <li class="flex flex-col file-upload-container" data-input-name="surat_peminjaman_sarpras">
                        <label class="mb-2 font-medium text-gray-700 flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span>Lampiran Penggunaan Sarana Prasarana (Maks 2MB)</span>
                        </label>
                        <div class="flex items-center space-x-3">
                            <div class="relative flex-1">
                                <input type="file" class="file-input absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" 
                                    name="surat_peminjaman_sarpras" />
                                <div class="flex items-center px-4 py-3 border-2 border-dashed border-gray-300 hover:border-blue-500 rounded-xl transition-colors duration-300 bg-gray-50">
                                    <div class="flex items-center flex-1 space-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                        </svg>
                                        <span class="text-sm text-gray-500">Drag and drop file atau klik untuk memilih</span>
                                    </div>
                                    <button type="button" 
                                        class="px-4 py-2 text-sm font-medium text-blue-500 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors duration-300">
                                        Pilih File
                                    </button>
                                </div>
                            </div>
                            <button type="button" class="cancel-upload inline-flex items-center px-3 py-2 text-sm font-medium text-red-500 bg-red-50 rounded-lg hover:bg-red-100 transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Cancel
                            </button>
                        </div>
                        <div class="file-preview mt-2 hidden">
                            <div class="flex items-center p-2 space-x-3 bg-blue-50 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span class="preview-name text-sm text-blue-600 flex-1"></span>
                                <span class="preview-size text-xs text-blue-400"></span>
                            </div>
                        </div>
                        <span class="mt-1 text-sm text-red-500">@error('surat_peminjaman_sarpras') {{ $message }} @enderror</span>
                    </li>   
                    <li class="flex flex-col file-upload-container mb-6" data-input-name="link_surat_izin_ortu">
                        <div>
                            <label for="link_surat_izin_ortu" class="block text-sm font-medium text-gray-700 mb-2">
                                Link Surat Izin Orang Tua (contoh : <code>https://drive.google.com/...</code>)
                            </label>
                            <input type="url" id="link_surat_izin_ortu" name="link_surat_izin_ortu"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out"
                                placeholder="Masukkan link surat izin orang tua" value="{{ old('link_surat_izin_ortu') }}" />
                            <span class="mt-1 text-sm text-red-500">@error('link_surat_izin_ortu') {{ $message }} @enderror</span>
                        </div>
                    </li>

                    <!-- Inputan Poster Kegiatan -->
                    <li class="flex flex-col file-upload-container mb-6" data-input-name="poster_kegiatan">
                        <label class="mb-2 font-medium text-gray-700 flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>Poster Kegiatan (Maks 2MB)</span>
                        </label>
                        <div class="flex items-center space-x-3">
                            <div class="relative flex-1">
                                <input type="file" class="file-input absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" 
                                    name="poster_kegiatan" accept="image/*"/>
                                <div class="flex items-center px-4 py-3 border-2 border-dashed border-gray-300 hover:border-blue-500 rounded-xl transition-colors duration-300 bg-gray-50">
                                    <div class="flex items-center flex-1 space-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                        </svg>
                                        <span class="text-sm text-gray-500">Drag and drop gambar atau klik untuk memilih</span>
                                    </div>
                                    <button type="button" 
                                        class="px-4 py-2 text-sm font-medium text-blue-500 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors duration-300">
                                        Pilih Gambar
                                    </button>
                                </div>
                            </div>
                            <button type="button" class="cancel-upload inline-flex items-center px-3 py-2 text-sm font-medium text-red-500 bg-red-50 rounded-lg hover:bg-red-100 transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Cancel
                            </button>
                        </div>
                        <div class="file-preview mt-2 hidden">
                            <div class="flex items-center p-2 space-x-3 bg-blue-50 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span class="preview-name text-sm text-blue-600 flex-1"></span>
                                <span class="preview-size text-xs text-blue-400"></span>
                            </div>
                        </div>
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
                        class="w-full px-4 py-3 font-medium text-white transition-all duration-300 bg-gradient-to-r from-blue-500 to-indigo-700 rounded-xl hover:shadow-lg hover:shadow-blue-500/40 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500/60 backdrop-blur-md">
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
    
    document.addEventListener('DOMContentLoaded', function() {
    // Menangani semua file input dengan satu event listener
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('file-input')) {
            handleFileSelect(e.target);
        }
    });

    // Menangani semua tombol cancel dengan satu event listener
    document.addEventListener('click', function(e) {
        if (e.target.closest('.cancel-upload')) {
            const container = e.target.closest('.file-upload-container');
            handleCancel(container);
        }
    });
});

    function handleFileSelect(input) {
        const container = input.closest('.file-upload-container');
        const preview = container.querySelector('.file-preview');
        const nameElement = preview.querySelector('.preview-name');
        const sizeElement = preview.querySelector('.preview-size');
        
        const file = input.files[0];
        if (file) {
            preview.classList.remove('hidden');
            nameElement.textContent = file.name;
            sizeElement.textContent = formatFileSize(file.size);
        }
    }

    function handleCancel(container) {
        const input = container.querySelector('.file-input');
        const preview = container.querySelector('.file-preview');
        input.value = '';
        preview.classList.add('hidden');
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    // Untuk Poster
    function handleFileSelect(input) {
        const container = input.closest('.file-upload-container');
        const preview = container.querySelector('.file-preview');
        const nameElement = preview.querySelector('.preview-name');
        const sizeElement = preview.querySelector('.preview-size');
        
        const file = input.files[0];
        if (file) {
            preview.classList.remove('hidden');
            nameElement.textContent = file.name;
            sizeElement.textContent = formatFileSize(file.size);

            // Khusus untuk preview gambar poster
            if (input.name === 'poster_kegiatan' && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgPreview = preview.querySelector('.preview-image') || document.createElement('img');
                    imgPreview.classList.add('preview-image', 'mt-2', 'rounded-lg', 'max-h-40', 'w-auto');
                    imgPreview.src = e.target.result;
                    preview.appendChild(imgPreview);
                }
                reader.readAsDataURL(file);
            }
        }
    }

    // Tambahkan validasi tipe file
    document.querySelectorAll('.file-input').forEach(input => {
        input.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                if (this.name === 'poster_kegiatan') {
                    if (!file.type.startsWith('image/')) {
                        alert('Mohon upload file gambar untuk poster');
                        this.value = '';
                        return;
                    }
                } else {
                    // Untuk dokumen lain, hanya terima PDF, DOC, DOCX
                    const validTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                    if (!validTypes.includes(file.type)) {
                        alert('Mohon upload file dalam format PDF, DOC, atau DOCX');
                        this.value = '';
                        return;
                    }
                }
            }
        });
    });
</script>
@endsection
