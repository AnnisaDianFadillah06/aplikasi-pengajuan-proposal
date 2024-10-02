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
  <div class="mb-8">
    <h2 class="text-sm text-gray-600">Selamat Datang, <span class="font-semibold text-gray-800">Text</span></h2>
    <p class="text-gray-400">Berikut ini adalah yang terjadi pada pengajuan kegiatan hari ini.</p>
  </div>

  <!-- Judul Utama -->
  <div class="mb-10">
    <h1 class="text-4xl font-bold text-gray-800">Manajemen Pengajuan Kegiatan</h1>
  </div>

  <!-- Konten Grid -->
  <div class="grid grid-cols-2 gap-8">
    <!-- Daftar Pengaju Kegiatan -->
    <div class="bg-white rounded-3xl shadow-lg p-8 space-y-6">
      <div>
        <h1 class="text-2xl font-semibold">Daftar Pengaju Kegiatan</h1>
        <p class="text-gray-500">Ringkasan Laporan Pengajuan Kegiatan POLBAN</p>
      </div>
      <div class="flex items-center space-x-2">
        <div class="flex -space-x-3">
          <img class="w-10 h-10 rounded-full border-2 border-white" src="path/to/image.jpg" alt="Pengaju 1">
          <img class="w-10 h-10 rounded-full border-2 border-white" src="path/to/image.jpg" alt="Pengaju 2">
          <img class="w-10 h-10 rounded-full border-2 border-white" src="path/to/image.jpg" alt="Pengaju 3">
        </div>
        <span class="text-xl">+7</span>
      </div>
      <div>
        <button class="w-full bg-gray-100 text-gray-500 py-3 rounded-full">Lihat lebih banyak...</button>
      </div>
    </div>

    <!-- Aktivitas -->
    <div class="bg-white rounded-3xl shadow-lg p-8">
  <div class="text-center">
    <h2 class="text-2xl font-semibold">Aktivitas</h2>
  </div>
  <div class="flex justify-center items-center my-6">
    <div class="relative">
      <!-- Arc Progress Indicator -->
      <svg class="w-32 h-32" viewBox="0 0 36 36">
        <!-- Background circle -->
        <path class="text-gray-200" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke-width="2"></path>
        
        <!-- Direview (purple, 55%) -->
        <path class="stroke-current text-purple-600" stroke-dasharray="55, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831" fill="none" stroke-width="2"></path>
        
        <!-- Pending (blue, 20%) -->
        <path class="stroke-current text-blue-600" stroke-dasharray="20, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 0 0 31.831" fill="none" stroke-width="2"></path>
      </svg>
      <div class="absolute inset-0 flex justify-center items-center">
        <span class="text-xl font-semibold">75%</span> <!-- Total persentase -->
      </div>
    </div>
  </div>
  <div class="text-center space-y-2">
    <p><span class="text-purple-600">Direview</span> 55%</p>
    <p><span class="text-blue-600">Pending</span> 20%</p>
    <button class="text-purple-600 font-semibold flex items-center justify-center">View all activity
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1.707-11.707a1 1 0 10-1.414 1.414L12.586 10H7a1 1 0 100 2h5.586l-2.293 2.293a1 1 0 001.414 1.414l4-4a1 1 0 000-1.414l-4-4z" clip-rule="evenodd" />
      </svg>
    </button>
  </div>
</div>


  </div>

  <div class="grid grid-cols-2 gap-8 mt-8">
    <!-- Daftar Kegiatan -->
    <!-- Daftar Kegiatan -->
<!-- Daftar Kegiatan -->
<div class="bg-white rounded-3xl shadow-lg p-8 space-y-6">
  <!-- Title and Search Bar Container -->
  <div class="flex justify-between items-center">
    <h2 class="text-2xl font-semibold">Daftar Kegiatan</h2>
    
    <!-- Search Bar -->
    <div class="relative w-1/3">
      <input type="text" placeholder="Cari Kegiatan ..." class="bg-gray-100 rounded-full pl-4 pr-10 py-2 focus:outline-none focus:ring-2 focus:ring-gray-300 w-full">
      <span class="absolute inset-y-0 right-0 flex items-center pr-4">
        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M15 11a4 4 0 11-8 0 4 4 0 018 0z"></path>
        </svg>
      </span>
    </div>
  </div>

  <!-- Table of Activities -->
  <div class="overflow-x-auto">
    <table class="min-w-full table-auto border-collapse">
      <!-- Table Header -->
      <thead>
        <tr>
          <th class="text-center py-3 px-6 font-small text-gray-600">Nama Kegiatan</th>
          <th class="text-center py-3 px-6 font-small text-gray-600">Tanggal Dibuka</th>
          <th class="text-center py-3 px-6 font-small text-gray-600">Status</th>
          <th class="text-center py-3 px-12 font-small text-gray-600">Detail</th>
        </tr>
      </thead>
      
      <!-- Table Body -->
      <tbody>
        <!-- Row 1 -->
        <tr class="border-b">
          <td class="text-center py-4 px-6">Kegiatan 1</td>
          <td class="text-center py-4 px-6">29 April 2024</td>
          <td class="text-center py-4 px-6">
            <span class="bg-green-100 text-green-600 px-4 py-1 rounded-full">Direview</span>
          </td>
          <td class="text-center py-4 px-6">
            <button class="bg-gray-300 text-gray-600 px-4 py-2 rounded-lg">Lihat</button>
          </td>
        </tr>

        <!-- Row 2 -->
        <tr class="text-center border-b">
          <td class="py-4 px-6">Kegiatan 2</td>
          <td class="py-4 px-6">20 April 2024</td>
          <td class="py-4 px-6">
            <span class="bg-green-100 text-green-600 px-4 py-1 rounded-full">Direview</span>
          </td>
          <td class="py-4 px-6">
            <button class="bg-gray-300 text-gray-600 px-4 py-2 rounded-lg">Lihat</button>
          </td>
        </tr>

        <!-- Add more rows as needed -->
      </tbody>
    </table>
  </div>
</div>


    <!-- Ringkasan Laporan -->
    <div class="bg-white rounded-3xl shadow-lg p-8 space-y-6">
      <h2 class="text-2xl font-semibold">Ringkasan Laporan</h2>
      <p class="text-gray-500">Ringkasan Laporan Pengajuan Kegiatan Polban</p>
      <div class="flex space-x-4">
        <!-- Jumlah Pengajuan Kegiatan -->
        <div class="bg-gradient-to-b from-blue-500 to-blue-600 rounded-xl p-6 w-1/2 text-center shadow-lg">
          <h3 class="text-white mb-4">Jumlah Pengajuan Kegiatan</h3>
          <div class="flex justify-center items-center">
            <div class="bg-blue-400 rounded-full w-24 h-24 flex justify-center items-center">
              <p class="text-white text-3xl font-bold">85</p>
            </div>
          </div>
          <span class="text-white mt-2 block">Pengajuan</span>
        </div>
        <!-- Jumlah Kegiatan Disetujui -->
        <div class="bg-gradient-to-b from-blue-500 to-blue-600 rounded-lg p-6 w-1/2 text-center shadow-lg">
          <h3 class="text-white mb-4">Jumlah Kegiatan Disetujui</h3>
          <div class="flex justify-center items-center">
            <div class="bg-blue-400 rounded-full w-24 h-24 flex justify-center items-center">
              <p class="text-white text-3xl font-bold">25</p>
            </div>
          </div>
          <span class="text-white mt-2 block">Kegiatan</span>
        </div>
      </div>
    </div>
  </div>
</body>

</html>






      <!-- end cards -->
@endsection