@extends('proposal_kegiatan\pengaju')
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
                        <img src="{{ asset($profil->foto_profil ?? 'default-profile.png') }}" alt="Profile Image" class="rounded-full w-full h-full object-cover">
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
                            <p class="font-semibold text-lg">Peran  : </p>
                            <p class="text-md text-gray-600">Pengaju</p>
                        </li>
                        <li>
                            <p class="font-semibold text-lg">Tanggal Bergabung</p>
                            <p class="text-md text-gray-600">{{ $profilPengaju->tanggal_bergabung }}</p>
                        </li>
                        <li>
                            <p class="font-semibold text-lg">Country</p>
                            <p class="text-md text-gray-600">Indonesia</p>
                        </li>
                        <li>
                            <p class="font-semibold text-lg">City/Town</p>
                            <p class="text-md text-gray-600">Bandung</p>
                        </li>
                        <li>
                            <p class="font-semibold text-lg">Ormawa</p>
                            <p class="text-md text-gray-600">{{ $profilPengaju->nama_ormawa }}</p>
                        </li>
                        <li>
                            <p class="font-semibold text-lg">NIM</p>
                            <p class="text-md text-gray-600">{{ $profilPengaju->nim }}</p>
                        </li>
                    @endif
                    @if($profilReviewer && !$profilPengaju)
                        <li>
                            <p class="font-semibold text-lg">Email Address</p>
                            <p class="text-md text-gray-600">{{ $profilReviewer->email }}</p>
                        </li>
                        <li>
                            <p class="font-semibold text-lg">Peran reviewer : </p>
                            <p class="text-md text-gray-600">Pengaju</p>
                        </li>
                        <li>
                            <p class="font-semibold text-lg">Tanggal Bergabung</p>
                            <p class="text-md text-gray-600">{{ $profilReviewer->tanggal_bergabung }}</p>
                        </li>
                        <li>
                            <p class="font-semibold text-lg">Country</p>
                            <p class="text-md text-gray-600">Indonesia</p>
                        </li>
                        <li>
                            <p class="font-semibold text-lg">City/Town</p>
                            <p class="text-md text-gray-600">Bandung</p>
                        </li>
                    @endif
                    @if($profilPengaju && $profilReviewer)
                        <li>
                            <p class="font-semibold text-lg">Email Address</p>
                            <p class="text-md text-gray-600">{{ $profilPengaju->email }}</p>
                        </li>
                        <li>
                            <p class="font-semibold text-lg">Peran  : </p>
                            <p class="text-md text-gray-600">Pengaju</p>
                        </li>
                        <li>
                            <p class="font-semibold text-lg">Reviewer  : </p>
                            <p class="text-md text-gray-600">{{ $profilReviewer->role }}</p>
                        </li>
                        <li>
                            <p class="font-semibold text-lg">Tanggal Bergabung</p>
                            <p class="text-md text-gray-600">{{ $profilPengaju->tanggal_bergabung }}</p>
                        </li>
                        <li>
                            <p class="font-semibold text-lg">Country</p>
                            <p class="text-md text-gray-600">Indonesia</p>
                        </li>
                        <li>
                            <p class="font-semibold text-lg">City/Town</p>
                            <p class="text-md text-gray-600">Bandung</p>
                        </li>
                        <li>
                            <p class="font-semibold text-lg">Ormawa</p>
                            <p class="text-md text-gray-600">{{ $profilPengaju->nama_ormawa }}</p>
                        </li>
                        <li>
                            <p class="font-semibold text-lg">NIM</p>
                            <p class="text-md text-gray-600">{{ $profilPengaju->nim }}</p>
                        </li>
                    @endif
                    </ul>
            </div>
        </main>

</body>

@endsection


@extends('welcome')
@section('konten')

<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen flex flex-col">
        <header class="bg-gradient-to-r from-orange-700 to-orange-300 p-6 text-white rounded-lg">
            <div class="flex items-center space-x-4">
                @if($profilPengaju)
                    <h1 class="text-2xl font-semibold">{{ $profilPengaju->nama_lengkap }}</h1>
                    <p class="text-sm">{{ $profilPengaju->nim }}</p>
                @elseif($profilReviewer)
                    <h1 class="text-2xl font-semibold">{{ $profilReviewer->nama }}</h1>
                    <p class="text-sm">Posisi: {{ $profilReviewer->posisi }}</p>
                @else
                    <p class="text-lg font-semibold">Profil tidak ditemukan</p>
                @endif
            </div>
        </header>

        <main class="flex-1 container mx-auto px-4 py-8">
            @if($profilPengaju)
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-2xl font-bold mb-4">Informasi Pengaju</h2>
                    <ul>
                        <li>Email: {{ $profilPengaju->email }}</li>
                        <li>Ormawa: {{ $profilPengaju->nama_ormawa }}</li>
                        <li>Tanggal Bergabung: {{ $profilPengaju->tanggal_bergabung }}</li>
                    </ul>
                </div>
            @endif

            @if($profilReviewer)
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-2xl font-bold mb-4">Informasi Reviewer</h2>
                    <ul>
                        <li>Email: {{ $profilReviewer->email }}</li>
                        <li>Posisi: {{ $profilReviewer->posisi }}</li>
                    </ul>
                </div>
            @endif
        </main>
    </div>
</body>

@endsection
