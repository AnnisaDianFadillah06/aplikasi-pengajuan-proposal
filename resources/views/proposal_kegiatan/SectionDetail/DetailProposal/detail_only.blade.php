{{-- Tampilkan Detail Proposal saja --}}
    {{-- Bagian Detail Proposal --}}
    <div class="container mx-auto p-6">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden max-w-5xl mx-auto">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 border-b">
                <span class="px-3 py-1 text-sm font-medium text-blue-700 bg-blue-100 rounded-full">
                    {{ $proposal->jenisKegiatan->nama_jenis_kegiatan }}
                </span>
                <h2 class="text-2xl font-bold text-gray-800 mt-3">{{ $proposal->nama_kegiatan }}</h2>
            </div>
    
            <div class="p-6">
                <!-- Penanggung Jawab Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Informasi Penanggung Jawab
                    </h3>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-500">Nama Lengkap</p>
                            <p class="font-medium">{{ $proposal->nama_penanggung_jawab }}</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="font-medium">{{ $proposal->email_penanggung_jawab }}</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-500">Nomor Telepon</p>
                            <p class="font-medium">{{ $proposal->no_hp_penanggung_jawab }}</p>
                        </div>
                    </div>
                </div>
    
                <!-- Detail Kegiatan Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Detail Kegiatan
                    </h3>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-500">Periode Kegiatan</p>
                            <p class="font-medium">{{ $proposal->tanggal_mulai }} - {{ $proposal->tanggal_akhir }}</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-500">Lokasi</p>
                            <p class="font-medium">{{ $proposal->tmpt_kegiatan }}</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-500">Jumlah peserta</p>
                            <p class="font-medium">{{ $proposal->jml_peserta }}</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-500">Jumlah pantiai</p>
                            <p class="font-medium">{{ $proposal->jml_panitia }}</p>
                        </div>
                    </div>
                </div>
    
                <!-- Informasi Tambahan Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Informasi Tambahan
                    </h3>
                    <div class="grid md:grid-cols-3 gap-4">
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-500">Pengisi Acara</p>
                            <p class="font-medium">{{ $proposal->pengisi_acara ?? '-' }}</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-500">Sponsorship</p>
                            <p class="font-medium">{{ $proposal->sponsorship ?? '-' }}</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-500">Media Partner</p>
                            <p class="font-medium">{{ $proposal->media_partner ?? '-' }}</p>
                        </div>
                    </div>
                </div>
    
                <!-- Detail Dana Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Rincian Dana
                    </h3>
                    <div class="grid md:grid-cols-3 gap-4">
                        <div class="p-4 bg-blue-50 rounded-lg">
                            <p class="text-sm text-blue-600">Dana DIPA Polban</p>
                            <p class="text-lg font-semibold text-blue-700">
                                Rp {{ number_format($proposal->dana_dipa ?? 0, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="p-4 bg-green-50 rounded-lg">
                            <p class="text-sm text-green-600">Dana Swadaya</p>
                            <p class="text-lg font-semibold text-green-700">
                                Rp {{ number_format($proposal->dana_swadaya ?? 0, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="p-4 bg-purple-50 rounded-lg">
                            <p class="text-sm text-purple-600">Dana Sponsor</p>
                            <p class="text-lg font-semibold text-purple-700">
                                Rp {{ number_format($proposal->dana_sponsor ?? 0, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>