@extends('welcome')
@section('konten')


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">
  <!-- Section Selamat Datang -->
  <div class="flex justify-between p-8">
    <!-- Left Section: Daftar Pedoman -->
    <div class="w-1/2">
        <h2 class="text-2xl font-semibold mb-4">Daftar Pedoman</h2>
        <div class="space-y-4">
            <!-- Card 1 -->
            <div class="bg-gray-100 p-4 rounded-lg flex items-center">
                <img src="/path-to-logo.png" alt="Logo" class="w-16 h-16 mr-4">
                <div>
                    <h3 class="text-lg font-semibold">Panduan Kegiatan Kemahasiswaan Polban</h3>
                    <p class="text-sm text-gray-600">11/01/2024 - WD 3</p>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="bg-gray-100 p-4 rounded-lg flex items-center">
                <img src="/path-to-logo.png" alt="Logo" class="w-16 h-16 mr-4">
                <div>
                    <h3 class="text-lg font-semibold">SOP Administrasi Polban</h3>
                    <p class="text-sm text-gray-600">11/01/2024 - BEM</p>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="bg-gray-100 p-4 rounded-lg flex items-center">
                <img src="/path-to-logo.png" alt="Logo" class="w-16 h-16 mr-4">
                <div>
                    <h3 class="text-lg font-semibold">Format LPJ</h3>
                    <p class="text-sm text-gray-600">11/01/2024 - BEM</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Section: Statistics -->
    <div class="w-1/3 space-y-4">

        <!-- Statistics Chart -->
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4">Statistik Proposal Kegiatan</h2>
            <div class="flex items-center justify-center">
                <div class="relative w-32 h-32">
                    <!-- Pie Chart Example -->
                    <svg viewBox="0 0 32 32" class="inline-block w-full h-full">
                        <circle r="16" cx="16" cy="16" class="text-blue-500" stroke-width="32" stroke-dasharray="60 40" fill="none"></circle>
                        <circle r="16" cx="16" cy="16" class="text-orange-400" stroke-width="32" stroke-dasharray="20 80" fill="none"></circle>
                        <circle r="16" cx="16" cy="16" class="text-pink-500" stroke-width="32" stroke-dasharray="20 80" fill="none"></circle>
                    </svg>
                </div>
            </div>
            <div class="mt-4 text-center">
                <p class="text-sm"><span class="text-blue-500">60%</span> Lolos Validasi</p>
                <p class="text-sm"><span class="text-orange-400">20%</span> Sedang Revisi</p>
                <p class="text-sm"><span class="text-pink-500">20%</span> Ditolak</p>
            </div>
        </div>
    </div>
</div>

</body>

</html>






      <!-- end cards -->
@endsection