@extends('proposal_kegiatan\pengaju')
@section('konten')

<div class="container mx-auto p-6">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden max-w-5xl mx-auto">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 border-b">
            <span class="px-3 py-1 text-sm font-medium text-blue-700 bg-blue-100 rounded-full">
                {{ $proposal->jenisKegiatan->nama_jenis_kegiatan }}
            </span>
            <h2 class="text-2xl font-bold text-gray-800 mt-3">{{ $proposal->nama_kegiatan }}</h2>
            <p class="text-gray-600 mt-1">{{ $proposal->ormawa->nama_ormawa }}</p>
        </div>

        <div class="p-6">
            <!-- Status dan Informasi Utama -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Status dan Informasi
                </h3>
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-500">Bidang Kegiatan</p>
                        <p class="font-medium">{{ $proposal->bidangKegiatan->nama_bidang_kegiatan }}</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-500">Jenis Kegiatan</p>
                        <p class="font-medium">{{ $proposal->jenisKegiatan->nama_jenis_kegiatan }}</p>
                    </div>
                </div>
            </div>

            <!-- Waktu dan Lokasi Section -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Waktu dan Lokasi
                </h3>
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-500">Tanggal Kegiatan</p>
                        <p class="font-medium">{{ $proposal->tgl_kegiatan }}</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-500">Tempat Kegiatan</p>
                        <p class="font-medium">{{ $proposal->tmpt_kegiatan }}</p>
                    </div>
                </div>
            </div>

            <!-- Informasi Pengajuan -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Informasi Pengajuan
                </h3>
                <div class="grid md:grid-cols-3 gap-4">
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-500">Pengaju</p>
                        <p class="font-medium">{{ $proposal->pengguna->username }}</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-500">Pengesah</p>
                        <p class="font-medium">{{ $proposal->id_pengguna }}</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-500">Status</p>
                        <span class="px-2 py-1 text-sm font-medium text-green-700 bg-green-100 rounded-full">
                            Disetujui
                        </span>
                    </div>
                </div>
            </div>

            <!-- Timeline Section -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Timeline
                </h3>
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-500">Tanggal Pengajuan</p>
                        <p class="font-medium">{{ $proposal->created_at->format('d M Y') }}</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-500">Tanggal Pengesahan</p>
                        <p class="font-medium">{{ $proposal->updated_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-3 mt-8 pt-6 border-t">
                <button onclick="window.history.back()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Kembali
                </button>
            </div>
        </div>
    </div>
</div>

@endsection