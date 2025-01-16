@section('title', 'Event List')
@section('konten')

@php
    $layout = Auth::guard('mahasiswa')->check() 
                ? 'proposal_kegiatan\pengaju' 
                : (Auth::guard('dosen')->check() 
                    ? 'proposal_kegiatan\reviewer' 
                    : 'proposal_kegiatan\non_auth_sidebar');
@endphp
@extends($layout)
@section('konten')

<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<div class="p-4 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Daftar Kegiatan</h2>
            <p class="text-gray-600">Semua kegiatan yang telah diajukan</p>
        </div>

        <!-- Search and Filter Section -->
        {{-- <div class="mb-6 bg-white rounded-lg shadow p-4">
            <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                <div class="relative w-full md:w-64">
                    <input type="text" id="table-search" 
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                           placeholder="Cari kegiatan...">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- Events Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
                $statusLabels = [
                    1 => ['label' => 'Sedang Dilaksanakan', 'class' => 'bg-blue-100 text-blue-800'],
                    2 => ['label' => 'Coming Soon', 'class' => 'bg-yellow-100 text-yellow-800'],
                    3 => ['label' => 'Pending', 'class' => 'bg-gray-100 text-gray-800'],
                ];
            @endphp

            @foreach($proposals as $proposal)
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                <div class="p-5">
                    <!-- Status Badge -->
                    <div class="flex justify-between items-start mb-4">
                        <span class="{{$statusLabels[$proposal->status_kegiatan]['class']}} text-xs font-medium px-2.5 py-0.5 rounded-full">
                            {{ $statusLabels[$proposal->status_kegiatan]['label'] }}
                        </span>
                        <span class="text-gray-500 text-sm">No. {{ $loop->iteration }}</span>
                    </div>

                    <!-- Event Title -->
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $proposal->nama_kegiatan }}</h3>

                    <!-- Event Details -->
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center text-gray-600">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-sm">{{ $proposal->tanggal_mulai }}</span>
                        </div>
                        <div class="flex items-center text-gray-600">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="text-sm">{{ $proposal->tmpt_kegiatan }}</span>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <form method="GET" action="{{ route('kegiatan.detail', $proposal->id_proposal) }}" class="mt-4">
                        @csrf
                        <button type="submit" 
                                class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition duration-300 ease-in-out">
                            Lihat Detail
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Include AlpineJS for interactivity (optional) -->
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

@endsection