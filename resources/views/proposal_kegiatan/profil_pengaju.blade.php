@php
    $layout = Auth::guard('mahasiswa')->check() 
                ? 'proposal_kegiatan.pengaju' 
                : (Auth::guard('dosen')->check() 
                    ? 'proposal_kegiatan.reviewer' 
                    : 'welcome'); // Tambahkan fallback layout jika diperlukan
@endphp

@extends($layout)

@section('konten')

<body class="bg-gray-100 font-sans antialiased">
    <!-- Container Utama -->
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-gradient-to-r from-orange-700 to-orange-300 p-6 text-white rounded-lg">
            <div class="flex justify-between items-center">
                <!-- Info Profil -->
                <div class="flex items-center space-x-4">
                    <div class="w-20 h-20 bg-white rounded-full">
                        <!-- Gambar profil placeholder -->
                        <img src="{{ asset($profilPengaju->foto_profil ?? 'default-profile.png') }}" alt="Profile Image" class="rounded-full w-full h-full object-cover">
                    </div>
                    <div>
                    @if(isset($profilPengaju))
                        <!-- Menampilkan profil pengaju jika tersedia -->
                        <h1 class="text-2xl font-semibold">{{ $profilPengaju->nama_lengkap }}</h1>
                        <p class="text-sm">{{ $profilPengaju->nim }}</p>
                    @elseif(isset($profilReviewer))
                        <!-- Menampilkan profil reviewer jika tersedia -->
                        <h1 class="text-2xl font-semibold">{{ $profilReviewer->nama_lengkap }}</h1>
                        <p class="text-sm">{{ $profilReviewer->role }}</p>
                    @endif
                    </div>
                </div>

                <!-- Navigation Right -->
                <div class="space-x-4">
                    <a href="#" class="text-white">Edit Profil</a>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 container mx-auto px-4 py-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold mb-4">Informasi Pribadi</h2>
                <ul class="space-y-3">
                    @if($profilPengaju && !$profilReviewer)
                        <li>
                            <p class="font-semibold text-lg">Email Address</p>
                            <p class="text-md text-gray-600">{{ $profilPengaju->email }}</p>
                        </li>
                        <li>
                            <p class="font-semibold text-lg">Peran:</p>
                            <p class="text-md text-gray-600">Pengaju</p>
                        </li>
                        <li>
                            <p class="font-semibold text-lg">Tanggal Bergabung:</p>
                            <p class="text-md text-gray-600">{{ $profilPengaju->tanggal_bergabung }}</p>
                        </li>
                    @elseif($profilReviewer && !$profilPengaju)
                        <li>
                            <p class="font-semibold text-lg">Email Address</p>
                            <p class="text-md text-gray-600">{{ $profilReviewer->email }}</p>
                        </li>
                        <li>
                            <p class="font-semibold text-lg">Peran:</p>
                            <p class="text-md text-gray-600">Reviewer</p>
                        </li>
                        <li>
                            <p class="font-semibold text-lg">Role reviewer:</p>
                            <p class="text-md text-gray-600">{{ $profilReviewer->role }}</p>
                        </li>
                        <li>
                            <p class="font-semibold text-lg">Tanggal Bergabung:</p>
                            <p class="text-md text-gray-600">{{ $profilReviewer->tanggal_bergabung }}</p>
                        </li>
                    @endif
                </ul>
            </div>
        </main>
    </div>
</body>

@endsection
