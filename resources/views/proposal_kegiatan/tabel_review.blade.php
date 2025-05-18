@extends('proposal_kegiatan/reviewer')
@section('title', 'Manajemen Review')
@section('konten')

<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Alert Messages -->
        @if (session('success'))
            <div class="mb-4 rounded-lg bg-green-100 p-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 rounded-lg bg-red-100 p-4 text-sm text-red-700">
                {{ session('error') }}
            </div>
        @endif

        <!-- Main Content -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <!-- Tab Navigation -->
            <div class="border-b border-gray-200">
                <nav class="flex space-x-4 px-6 py-4" aria-label="Tabs">
                    <button id="tab-proposal" class="tab-button px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 bg-blue-50 text-blue-600">
                        Proposal Review
                    </button>
                    <button id="tab-spj" class="tab-button px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 focus:outline-none hover:bg-gray-50 text-gray-500">
                        SPJ Review
                    </button>
                    <button id="tab-lpj" class="tab-button px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 focus:outline-none hover:bg-gray-50 text-gray-500">
                        LPJ Review
                    </button>
                </nav>
            </div>

            <!-- Tab Contents -->
            <div class="p-6">
                <!-- Proposal Tab Content -->
                <div id="content-proposal" class="tab-content">
                    <div class="sm:flex sm:items-center sm:justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Daftar Review Proposal</h3>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table id="table-proposal" class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Penyelenggara
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama Kegiatan
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    @if($idRole == 5)
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tahap
                                        </th>
                                    @endif
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal Kegiatan
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal Pengajuan Proposal
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                    @if($idRole == 5)
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Detail
                                        </th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($proposals as $proposal)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                                <span class="text-sm font-medium text-indigo-600">
                                                    {{ substr($proposal->pengguna->username, 0, 2) }}
                                                </span>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $proposal->pengguna->username }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 max-w-xs truncate">
                                            {{ $proposal->nama_kegiatan }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $latestReview = $proposal->latestRevision;
                                            if ($latestReview) {
                                                $statusRevisi = $latestReview->status_revisi;
                                                $tahap = $latestReview->id_dosen;
                                                if ($statusRevisi == 1) {
                                                    $statusRevisi = 0;
                                                    $tahap += 1;
                                                }
                                            } else {
                                                $statusRevisi = $proposal->status;
                                                $tahap = $proposal->updated_by;
                                            }
                                        @endphp
                
                                        @if ($statusRevisi == 0)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <span class="w-2 h-2 mr-1.5 bg-yellow-400 rounded-full"></span>
                                                Menunggu
                                            </span>
                                        @elseif ($statusRevisi == 1)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <span class="w-2 h-2 mr-1.5 bg-green-400 rounded-full"></span>
                                                Disetujui
                                            </span>
                                        @elseif ($statusRevisi == 2)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <span class="w-2 h-2 mr-1.5 bg-red-400 rounded-full"></span>
                                                Ditolak
                                            </span>
                                        @elseif ($statusRevisi == 3)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                <span class="w-2 h-2 mr-1.5 bg-blue-400 rounded-full"></span>
                                                Revisi
                                            </span>
                                        @endif
                                    </td>
                                    @if($idRole == 5)
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-gray-100 text-gray-800">
                                                @if ($tahap == 1)
                                                    BEM
                                                @elseif ($tahap == 2)
                                                    Pembina
                                                @elseif ($tahap == 3)
                                                    Ketua Jurusan
                                                @elseif ($tahap == 4)
                                                    KLI
                                                @elseif ($tahap == 5 || 6)
                                                    Wadir 3
                                                @endif
                                            </span>
                                        </td>
                                    @endif
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $proposal->tanggal_mulai }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ \Carbon\Carbon::parse($proposal->tanggal_mulai)->format('l') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ \Carbon\Carbon::parse($proposal->created_at)->format('Y-m-d') }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ \Carbon\Carbon::parse($proposal->created_at)->diffForHumans() }}
                                        </div>
                                    </td>
                                    @php
                                        // Mapping tahap berdasarkan updated_by
                                        $tahapMapProposal = [
                                            1 => 'BEM',
                                            2 => 'Pembina',
                                            3 => 'Ketua Jurusan',
                                            4 => 'KLI',
                                            5 => 'Wadir 3',
                                            6 => 'Wadir 3', // Jika updated_by == 6, juga dianggap Wadir 3
                                        ];
                                    
                                        // Tentukan label tahap berdasarkan updated_by
                                        $tahapLabelProposal = $tahapMapProposal[$proposal->updated_by] ?? 'Tahap Tidak Diketahui';
                                        // Tentukan apakah tombol dinonaktifkan
                                        $isDisabledProposal = $idRole == 5 && $proposal->updated_by != 5 && $proposal->updated_by != 6 ;
                                        // Tentukan apakah updated_by == 6
                                        $isWadir3Proposal = $idRole == 5 && $proposal->updated_by == 6 ;
                                        // Tentukan apakah tombol dinonaktifkan
                                        $isDisabledProposal2 = $statusRevisi == 3 ;
                                        // Tentukan apakah tombol dinonaktifkan
                                        $isDisabledProposal3 = $statusRevisi == 2 ;
                                        // Tentukan title dan class berdasarkan kondisi
                                        $buttonClassProposal = '';
                                        $titleTextProposal = '';
                                        if ($isDisabledProposal) {
                                            $buttonClassProposal = 'cursor-not-allowed bg-gray-300 text-gray-500';
                                            $titleTextProposal = 'Masih di tahap ' . $tahapLabelProposal;
                                        } elseif ($isWadir3Proposal) {
                                            $buttonClassProposal = 'cursor-not-allowed bg-gray-300 text-gray-500'; // Style khusus untuk Wadir 3
                                            $titleTextProposal = 'Sudah direview';
                                        } elseif ($isDisabledProposal2) {
                                            $buttonClassProposal = 'cursor-not-allowed bg-gray-300 text-gray-500'; 
                                            $titleTextProposal = 'Menunggu Revisi';
                                        } elseif ($isDisabledProposal3) {
                                            $buttonClassProposal = 'cursor-not-allowed bg-gray-300 text-gray-500'; 
                                            $titleTextProposal = 'Proposal Telah Ditolak';
                                        } else {
                                            $buttonClassProposal = 'bg-blue-500 text-white hover:bg-blue-600';
                                            $titleTextProposal = 'Lanjutkan Review';
                                        }
                                    @endphp 
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <a href="{{ $isDisabledProposal || $isDisabledProposal2 || $isDisabledProposal3 ? '#' : route('proposal.show', ['reviewProposal' => $proposal->id_proposal]) }}"
                                            onclick="{{ $isDisabledProposal || $isDisabledProposal2 || $isDisabledProposal3 ? 'return false;' : 'logProposalId(' . $proposal->id . ')' }}" 
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-150 {{ $buttonClassProposal }}"
                                            title="{{ $titleTextProposal }}">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Review
                                        </a>
                                        @if($idRole == 5)
                                            <form method="POST" action="{{ route('proposal.destroy', $proposal->id_proposal) }}" 
                                                  class="inline-block ml-2" 
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus proposal ini? Semua data terkait termasuk SPJ (jika ada) akan ikut terhapus.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-150">
                                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                    @if($idRole == 5)
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form method="GET" action="{{ route('proposalWD3.detail', $proposal->id_proposal) }}">
                                                @csrf
                                                <button type="submit" 
                                                        class="inline-flex items-center px-3 py-2 border border-indigo-100 text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-50 hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-150">
                                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    Detail
                                                </button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- SPJ Tab Content -->
<div id="content-spj" class="tab-content hidden">
    <div class="sm:flex sm:items-center sm:justify-between mb-6">
        <h3 class="text-lg font-semibold text-gray-900">Daftar Review SPJ</h3>
    </div>
    
    <div class="overflow-x-auto">
        <table id="table-spj" class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Penyelenggara
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nama Kegiatan
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    @if($idRole == 5)
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tahap
                        </th>
                    @endif
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tanggal Kegiatan
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tanggal Pengajuan SPJ
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aksi
                    </th>
                    @if($idRole == 5)
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Detail
                        </th>
                    @endif
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($spjAll as $spj)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                <span class="text-sm font-medium text-indigo-600">
                                    {{ substr($spj->proposalKegiatan->pengguna->username, 0, 2) }}
                                </span>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $spj->proposalKegiatan->pengguna->username }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900 max-w-xs truncate">
                            {{ $spj->proposalKegiatan->nama_kegiatan }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                            $latestReview = $spj->latestRevision;
                            if ($latestReview) {
                                $statusRevisi = $latestReview->status_revisi;
                                $tahapSpj = $latestReview->id_dosen;
                                if ($statusRevisi == 1) {
                                    $statusRevisi = 0;
                                    $tahapSpj += 1;
                                }
                            } else {
                                $statusRevisi = $spj->status;
                                $tahapSpj = $spj->updated_by;
                            }
                        @endphp

                        @if ($statusRevisi == 0)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <span class="w-2 h-2 mr-1.5 bg-yellow-400 rounded-full"></span>
                                Menunggu
                            </span>
                        @elseif ($statusRevisi == 1)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <span class="w-2 h-2 mr-1.5 bg-green-400 rounded-full"></span>
                                Disetujui
                            </span>
                        @elseif ($statusRevisi == 2)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                <span class="w-2 h-2 mr-1.5 bg-red-400 rounded-full"></span>
                                Ditolak
                            </span>
                        @elseif ($statusRevisi == 3)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                <span class="w-2 h-2 mr-1.5 bg-blue-400 rounded-full"></span>
                                Revisi
                            </span>
                        @endif
                    </td>
                    @if($idRole == 5)
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-gray-100 text-gray-800">
                                @if ($tahapSpj == 1)
                                    BEM
                                @elseif ($tahapSpj == 2)
                                    Pembina
                                @elseif ($tahapSpj == 3)
                                    Ketua Jurusan
                                @elseif ($tahapSpj == 4)
                                    KLI
                                @elseif ($tahapSpj == 5 || 6)
                                    Wadir 3
                                @endif
                            </span>
                        </td>
                    @endif
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            {{ $spj->proposalKegiatan->tanggal_mulai }}
                        </div>
                        <div class="text-xs text-gray-500">
                            {{ \Carbon\Carbon::parse($spj->proposalKegiatan->tanggal_mulai)->format('l') }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            {{ \Carbon\Carbon::parse($spj->created_at)->format('Y-m-d') }}
                        </div>
                        <div class="text-xs text-gray-500">
                            {{ \Carbon\Carbon::parse($spj->created_at)->diffForHumans() }}
                        </div>
                    </td>
                    @php
                        // Mapping tahap berdasarkan updated_by
                        $tahapMapSPJ = [
                            1 => 'BEM',
                            2 => 'Pembina',
                            3 => 'Ketua Jurusan',
                            4 => 'KLI',
                            5 => 'Wadir 3',
                            6 => 'Wadir 3', // Jika updated_by == 6, juga dianggap Wadir 3
                        ];
                        // Tentukan label tahap berdasarkan updated_by
                        $tahapLabelSPJ = $tahapMapSPJ[$spj->updated_by] ?? 'Tahap Tidak Diketahui';
                        // Tentukan apakah tombol dinonaktifkan
                        $isDisabledSPJ = $idRole == 5 && $spj->updated_by != 5 && $spj->updated_by != 6;
                        // Tentukan apakah updated_by == 6
                        $isWadir3SPJ = $idRole == 5 && $spj->updated_by == 6;
                        // status revisi
                        $isDisabledSPJ2 = $statusRevisi == 3;
                        // status ditolak
                        $isDisabledSPJ3 = $statusRevisi == 2;
                        // Tentukan title dan class berdasarkan kondisi
                        $buttonClassSPJ = '';
                        $titleTextSPJ = '';
                        if ($isDisabledSPJ) {
                            $buttonClassSPJ = 'cursor-not-allowed bg-gray-300 text-gray-500';
                            $titleTextSPJ = 'Masih di tahap ' . $tahapLabelSPJ;
                        } elseif ($isWadir3SPJ) {
                            $buttonClassSPJ = 'cursor-not-allowed bg-gray-300 text-gray-500'; // Style khusus untuk Wadir 3
                            $titleTextSPJ = 'Sudah direview';
                        } elseif ($isDisabledSPJ2) {
                            $buttonClassSPJ = 'cursor-not-allowed bg-gray-300 text-gray-500'; 
                            $titleTextSPJ = 'Menunggu Revisi';
                        } elseif ($isDisabledSPJ3) {
                            $buttonClassSPJ = 'cursor-not-allowed bg-gray-300 text-gray-500'; 
                            $titleTextSPJ = 'SPJ Telah Ditolak';
                        } else {
                            $buttonClassSPJ = 'bg-blue-500 text-white hover:bg-blue-600';
                            $titleTextSPJ = 'Lanjutkan Review';
                        }
                    @endphp
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <a href="{{ $isDisabledSPJ || $isDisabledSPJ2 || $isDisabledSPJ3 ? '#' : route('reviewSPJ.show', ['reviewSPJ' => $spj->id_spj]) }}" 
                            onclick="{{ $isDisabledSPJ || $isDisabledSPJ2 || $isDisabledSPJ3 ? 'return false;' : 'logProposalId(' . $spj->id_spj . ')' }}"
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-150 {{ $buttonClassSPJ }}"
                            title="{{ $titleTextSPJ }}">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Review
                        </a>
                    </td>
                    @if($idRole == 5)
                        <td class="px-6 py-4 whitespace-nowrap center text-sm font-medium">
                            <form method="GET" action="{{ route('spjWD3.detail', $spj->id_spj) }}">
                                @csrf
                                <button type="submit" 
                                        class="inline-flex items-center px-3 py-2 border border-indigo-100 text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-50 hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-150">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Detail
                                </button>
                            </form>
                        </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
        <!-- LPJ Tab Content -->
<div id="content-lpj" class="tab-content hidden">
    <div class="sm:flex sm:items-center sm:justify-between mb-6">
        <h3 class="text-lg font-semibold text-gray-900">Daftar Review LPJ</h3>
    </div>
    
    <div class="overflow-x-auto">
        <table id="table-lpj" class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Penyelenggara
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nama Kegiatan
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    @if($idRole == 5)
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tahap
                        </th>
                    @endif
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tanggal Kegiatan
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tanggal Pengajuan LPJ
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aksi
                    </th>
                    @if($idRole == 5)
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Detail
                        </th>
                    @endif
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($lpjAll as $lpj)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                <span class="text-sm font-medium text-indigo-600">
                                    {{ substr($lpj->ormawa->nama_ormawa, 0, 2) }}
                                </span>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $lpj->ormawa->nama_ormawa }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900 max-w-xs truncate">
                            {{ $lpj->jenis_lpj == 1 ? '60%' : '100%' }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                            $latestReview = $lpj->latestRevision;
                            if ($latestReview) {
                                $statusRevisi = $latestReview->status_revisi;
                                $tahapLpj = $latestReview->id_dosen;
                                if ($statusRevisi == 1) {
                                    $statusRevisi = 0;
                                    $tahapLpj += 1;
                                }
                            } else {
                                $statusRevisi = $lpj->status_lpj;
                                $tahapLpj = $lpj->updated_by;
                            }
                        @endphp

                        @if ($statusRevisi == 0)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <span class="w-2 h-2 mr-1.5 bg-yellow-400 rounded-full"></span>
                                Menunggu
                            </span>
                        @elseif ($statusRevisi == 1)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <span class="w-2 h-2 mr-1.5 bg-green-400 rounded-full"></span>
                                Disetujui
                            </span>
                        @elseif ($statusRevisi == 2)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                <span class="w-2 h-2 mr-1.5 bg-red-400 rounded-full"></span>
                                Ditolak
                            </span>
                        @elseif ($statusRevisi == 3)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                <span class="w-2 h-2 mr-1.5 bg-blue-400 rounded-full"></span>
                                Revisi
                            </span>
                        @endif
                    </td>
                    @if($idRole == 5)
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-gray-100 text-gray-800">
                                @if ($tahapLpj == 1)
                                    BEM
                                @elseif ($tahapLpj == 2)
                                    Pembina
                                @elseif ($tahapLpj == 3)
                                    Ketua Jurusan
                                @elseif ($tahapLpj == 4)
                                    KLI
                                @elseif ($tahapLpj == 5 || 6)
                                    Wadir 3
                                @endif
                            </span>
                        </td>
                    @endif
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            {{ $lpj->tanggal_kegiatan }}
                        </div>
                        <div class="text-xs text-gray-500">
                            {{ \Carbon\Carbon::parse($lpj->tanggal_kegiatan)->format('l') }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            {{ \Carbon\Carbon::parse($lpj->updated_at)->format('Y-m-d') }}
                        </div>
                        <div class="text-xs text-gray-500">
                            {{ \Carbon\Carbon::parse($lpj->updated_at)->diffForHumans() }}
                        </div>
                    </td>
                    
                    @php
                        // Mapping tahap berdasarkan updated_by
                        $tahapMapLPJ = [
                            1 => 'BEM',
                            2 => 'Pembina',
                            3 => 'Ketua Jurusan',
                            4 => 'KLI',
                            5 => 'Wadir 3',
                            6 => 'Wadir 3', // Jika updated_by == 6, juga dianggap Wadir 3
                        ];
                    
                        // Tentukan label tahap berdasarkan updated_by
                        $tahapLabelLPJ = $tahapMapLPJ[$lpj->updated_by] ?? 'Tahap Tidak Diketahui';
                        // Tentukan apakah tombol dinonaktifkan
                        $isDisabledLPJ = $idRole == 5 && $lpj->updated_by != 5 && $lpj->updated_by != 6;
                        // Tentukan apakah updated_by == 6
                        $isWadir3LPJ = $idRole == 5 && $lpj->updated_by == 6;
                        // Status revisi
                        $isDisabledLPJ2 = $statusRevisi == 3;
                        // Status Ditolak
                        $isDisabledLPJ3 = $statusRevisi == 2;
                        // Tentukan title dan class berdasarkan kondisi
                        $buttonClassLPJ = '';
                        $titleTextLPJ = '';
                        if ($isDisabledLPJ) {
                            $buttonClassLPJ = 'cursor-not-allowed bg-gray-300 text-gray-500';
                            $titleTextLPJ = 'Masih di tahap ' . $tahapLabelLPJ;
                        } elseif ($isWadir3LPJ) {
                            $buttonClassLPJ = 'cursor-not-allowed bg-gray-300 text-gray-500'; // Style khusus untuk Wadir 3
                            $titleTextLPJ = 'Sudah direview';
                        } elseif ($isDisabledLPJ2) {
                            $buttonClassLPJ = 'cursor-not-allowed bg-gray-300 text-gray-500';
                            $titleTextLPJ = 'Menunggu Revisi';
                        } elseif ($isDisabledLPJ3) {
                            $buttonClassLPJ = 'cursor-not-allowed bg-gray-300 text-gray-500'; 
                            $titleTextLPJ = 'LPJ telah ditolak';
                        } else {
                            $buttonClassLPJ = 'bg-blue-500 text-white hover:bg-blue-600';
                            $titleTextLPJ = 'Lanjutkan Review';
                        }
                    @endphp
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <a href="{{ $isDisabledLPJ || $isDisabledLPJ2 || $isDisabledLPJ3 ? '#' : route('reviewLPJ.show', ['reviewLPJ' => $lpj->id_lpj]) }}"
                            onclick="{{ $isDisabledLPJ || $isDisabledLPJ2 || $isDisabledLPJ3 ? 'return false;' : 'logProposalId(' . $lpj->id_lpj . ')' }}"  
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-150 {{ $buttonClassLPJ }}"
                            title="{{ $titleTextLPJ }}">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Review
                        </a>
                    </td>
                    @if($idRole == 5)
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <form method="GET" action="{{ route('lpjWD3.detail', $lpj->id_lpj) }}">
                                @csrf
                                <button type="submit" 
                                        class="inline-flex items-center px-3 py-2 border border-indigo-100 text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-50 hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-150">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Detail
                                </button>
                            </form>
                        </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
        
            </div>
        </div>
    </div>
</div>

<style>
    .dataTables_wrapper .dataTables_length select {
        @apply bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5;
    }
    
    .dataTables_wrapper .dataTables_filter input {
        @apply bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        @apply px-3 py-1 text-sm text-gray-700 hover:bg-gray-100 rounded-md mx-1;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        @apply bg-blue-600 text-white hover:bg-blue-700;
    }
</style>

<script>
    // Tab switching logic
    document.querySelectorAll('.tab-button').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active classes
            document.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('bg-blue-50', 'text-blue-600');
                btn.classList.add('text-gray-500');
            });
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });
            
            // Add active classes
            this.classList.remove('text-gray-500');
            this.classList.add('bg-blue-50', 'text-blue-600');
            
            const contentId = this.id.replace('tab-', 'content-');
            document.getElementById(contentId).classList.remove('hidden');
        });
    });

    // DataTables initialization with modern styling
    $(document).ready(function() {
        const tableConfig = {
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50],
            language: {
                search: "🔍",
                lengthMenu: "Tampilkan _MENU_",
                info: "Menampilkan _START_ to _END_ dari _TOTAL_ entries",
                paginate: {
                    first: "«",
                    previous: "‹",
                    next: "›",
                    last: "»"
                }
            },
            drawCallback: function() {
                adjustSelectWidth();
            }
        };

        ['#table-proposal', '#table-spj', '#table-lpj'].forEach(tableId => {
            $(tableId).DataTable(tableConfig);
        });
    });

    function adjustSelectWidth() {
            var select = $('.dataTables_length select');
            select.each(function() {
                var text = $(this).find('option:selected').text();
                $(this).css('width', (text.length + 4) + 'ch');
            });
        }


        adjustSelectWidth();

        // Call function on select change
        $('.dataTables_length select').change(adjustSelectWidth);
</script>

@endsection