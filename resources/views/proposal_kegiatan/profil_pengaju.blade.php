@php
    $layout = Auth::guard('mahasiswa')->check() 
                ? 'proposal_kegiatan.pengaju' 
                : (Auth::guard('dosen')->check() 
                    ? 'proposal_kegiatan.reviewer' 
                    : 'non_auth_sidebar'); // Tambahkan fallback layout jika diperlukan
@endphp

@extends($layout)

@section('konten')


<div class="min-h-screen bg-gray-100">
    <!-- Header -->
    <div class="max-w-l mx-auto flex items-center bg-gradient-to-r from-blue-500 to-indigo-600 p-6 rounded-lg shadow-lg">
        <img
            src="https://via.placeholder.com/100"
            alt="Profile Picture"
            class="w-24 h-24 rounded-full border-4 border-white shadow-xl transform hover:scale-110 transition-transform duration-300"
        />
        <div class="ml-6 text-white">
            <h1 class="text-3xl font-extrabold tracking-wide hover:text-gray-100 transition-colors duration-300">
                @if ($profilPengaju && !$profilReviewer)
                    {{ $profilPengaju->nama }} <!-- Nama Pengaju -->
                @elseif ($profilReviewer && !$profilPengaju)
                    {{ $profilReviewer->nama }} <!-- Nama Reviewer -->
                @else
                    Nama Tidak Tersedia
                @endif
            </h1>
            <p class="text-sm mt-1 font-semibold opacity-80">
                @if ($profilPengaju && !$profilReviewer)
                    Pengaju | Bergabung sejak: {{ $profilPengaju->tanggal_bergabung }} <!-- Tanggal Bergabung Pengaju -->
                @elseif ($profilReviewer && !$profilPengaju)
                    Reviewer | Bergabung sejak: {{ $profilReviewer->tanggal_bergabung }} <!-- Tanggal Bergabung Reviewer -->
                @else
                    Peran Tidak Diketahui
                @endif
            </p>
        </div>
    </div>

    <main class="container mx-auto px-20 py-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Informasi Pribadi -->
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Informasi Pribadi</h2>
                <ul class="text-gray-600 space-y-2">
                    @if ($profilPengaju && !$profilReviewer)
                        <li>
                            <span class="font-medium text-gray-800">Email Address:</span> 
                            {{ $profilPengaju->email }}
                        </li>
                        <li>
                            <span class="font-medium text-gray-800">Peran:</span> 
                            Pengaju
                        </li>
                        <li>
                            <span class="font-medium text-gray-800">Tanggal Bergabung:</span> 
                            {{ $profilPengaju->tanggal_bergabung }}
                        </li>
                    @elseif ($profilReviewer && !$profilPengaju)
                        <li>
                            <span class="font-medium text-gray-800">Email Address:</span> 
                            {{ $profilReviewer->email }}
                        </li>
                        <li>
                            <span class="font-medium text-gray-800">Nama Lengkap:</span> 
                            {{ $profilReviewer->nama_lengkap }}
                        </li>
                        <li>
                            <span class="font-medium text-gray-800">Username:</span> 
                            {{ $profilReviewer->username }}
                        </li>
                        <li>
                            <span class="font-medium text-gray-800">Tanggal Bergabung:</span> 
                            {{ $profilReviewer->tanggal_bergabung }}
                        </li>
                        <li>
                            <span class="font-medium text-gray-800">Peran:</span> 
                            Reviewer
                        </li>
                        @if ($profilReviewer && $profilReviewer->role)
                            <li>
                                <span class="font-medium text-gray-800">Role Reviewer:</span> 
                                {{ $profilReviewer->role->role ?? 'Role tidak ditemukan' }}
                            </li>
                        @endif
                    @else
                        <li class="text-center text-gray-500">Data profil tidak tersedia.</li>
                    @endif
                </ul>
                <button
                    class="mt-4 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium"
                    id="openModalButton">
                    Edit Profil
                </button>
            </div>

            <!-- Statistik -->
        @if ($profilPengaju)
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Statistik</h2>
                <ul class="text-gray-600 space-y-2">
                        <!-- Statistik untuk Pengaju -->
                        <li>
                            <span class="font-medium text-gray-800">Proposal Diajukan:</span> {{ $proposalStats['lolos_validasi'] + $proposalStats['sedang_revisi'] + $proposalStats['ditolak'] }}
                        </li>
                        <li>
                            <span class="font-medium text-gray-800">Disetujui:</span> {{ $proposalStats['lolos_validasi'] }}
                        </li>
                        <li>
                            <span class="font-medium text-gray-800">Direvisi:</span> {{ $proposalStats['sedang_revisi'] }}
                        </li>
                        <li>
                            <span class="font-medium text-gray-800">Ditolak:</span> {{ $proposalStats['ditolak'] }}
                        </li>
                </ul>
                <!-- Button untuk Pengaju -->
                <a href="{{ url('/pengajuan-proposal') }}"
                    class="mt-4 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium inline-block text-center">
                    Lihat Riwayat
                </a>
            </div>
        </div>
        @endif

        <!-- Riwayat Aktivitas -->
        @if ($profilPengaju && !$profilReviewer)
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow mt-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Riwayat Aktivitas</h2>
                <ul class="divide-y divide-gray-200">
                    {{-- <li class="py-2">
                        <p class="text-gray-800 font-medium">Login terakhir</p>
                        <p class="text-sm text-gray-500">{{ $lastLogin }}</p> --}}
                    </li>
                    <li class="py-2">
                        <p class="text-gray-800 font-medium">Proposal terakhir diajukan</p>
                        <p class="text-sm text-gray-500">{{ $lastProposalDate }}</p>
                    </li>
                    {{-- <li class="py-2">
                        <p class="text-gray-800 font-medium">SPJ terakhir diajukan</p>
                        <p class="text-sm text-gray-500">{{ $lastSpjDate }}</p> <!-- Menampilkan tanggal SPJ terakhir -->
                    </li> --}}
                </ul>
            </div>
        @endif
    </main>
</div>

<div id="myModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Informasi Pengeditan Profil</h3>
        <p class="text-gray-700">Silakan hubungi Staff Kemahasiswaan untuk pengeditan profil lebih lanjut.</p>
        <div class="mt-4 flex justify-end">
            <button id="closeModalButton" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium">
                Tutup
            </button>
        </div>
    </div>
</div>

<!-- JavaScript untuk menampilkan dan menyembunyikan modal -->
<script>
    // Ambil elemen modal dan tombol
    const openModalButton = document.getElementById('openModalButton');
    const closeModalButton = document.getElementById('closeModalButton');
    const modal = document.getElementById('myModal');

    // Event listener untuk membuka modal
    openModalButton.addEventListener('click', function() {
        modal.classList.remove('hidden'); // Menampilkan modal
    });

    // Event listener untuk menutup modal
    closeModalButton.addEventListener('click', function() {
        modal.classList.add('hidden'); // Menyembunyikan modal
    });

    // Menutup modal jika area luar modal diklik
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.classList.add('hidden');
        }
    });
</script>

@endsection
