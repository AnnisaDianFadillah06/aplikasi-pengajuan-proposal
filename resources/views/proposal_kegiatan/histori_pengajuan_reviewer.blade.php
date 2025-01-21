@extends('proposal_kegiatan/reviewer')
@section('title', 'Histori Pengajuan')
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

        <!-- Header Section -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6">
            <div class="p-6">
                <div class="sm:flex sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Histori Pengajuan</h1>
                        <p class="mt-1 text-sm text-gray-500">Pantau status dan riwayat pengajuan kegiatan Anda</p>
                    </div>
                    <div class="mt-4 sm:mt-0">
                        <a href="{{ route('download_reviewer.pdf') }}" 
                           class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Download PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <!-- Tab Navigation -->
            <div class="border-b border-gray-200">
                <nav class="flex space-x-4 px-6 py-4" aria-label="Tabs">
                    <button id="tab-proposal" class="tab-button px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 bg-blue-50 text-blue-600">
                        Proposal
                    </button>
                    <button id="tab-spj" class="tab-button px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 focus:outline-none hover:bg-gray-50 text-gray-500">
                        SPJ
                    </button>
                    <button id="tab-lpj" class="tab-button px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 focus:outline-none hover:bg-gray-50 text-gray-500">
                        LPJ
                    </button>
                </nav>
            </div>

            <!-- Tab Contents -->
            <div class="p-6">
                <!-- Proposal Content -->
                <div id="content-proposal" class="tab-content">
                    <div class="overflow-x-auto">
                        <table id="table-proposal" class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Penyelenggara
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama Kegiatan
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal Kegiatan
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal Pengajuan
                                    </th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi
                                    </th>
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
                                        <div class="text-sm text-gray-900">{{ $proposal->nama_kegiatan }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusMap = [
                                                0 => ['text' => 'Menunggu', 'class' => 'bg-yellow-100 text-yellow-800'],
                                                1 => ['text' => 'Disetujui', 'class' => 'bg-green-100 text-green-800'],
                                                2 => ['text' => 'Ditolak', 'class' => 'bg-red-100 text-red-800'],
                                                3 => ['text' => 'Revisi', 'class' => 'bg-blue-100 text-blue-800']
                                            ];
                                            $status = $statusMap[$proposal->status] ?? $statusMap[0];
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $status['class'] }}">
                                            {{ $status['text'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $proposal->tanggal_mulai }}</div>
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
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <a href="{{ route('proposalWD3.detail', $proposal->id_proposal) }}"
                                           class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- SPJ Content -->
                <!-- SPJ Content -->
<div id="content-spj" class="tab-content hidden">
    <div class="overflow-x-auto">
        <table id="table-spj" class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Penyelenggara
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nama Kegiatan
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tanggal Kegiatan
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tanggal Pengajuan SPJ
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aksi
                    </th>
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
                        <div class="text-sm text-gray-900">{{ $spj->proposalKegiatan->nama_kegiatan }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                            $statusMap = [
                                0 => ['text' => 'Menunggu', 'class' => 'bg-yellow-100 text-yellow-800'],
                                1 => ['text' => 'Disetujui', 'class' => 'bg-green-100 text-green-800'],
                                2 => ['text' => 'Ditolak', 'class' => 'bg-red-100 text-red-800'],
                                3 => ['text' => 'Revisi', 'class' => 'bg-blue-100 text-blue-800']
                            ];
                            $status = $statusMap[$spj->status] ?? $statusMap[0];
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $status['class'] }}">
                            {{ $status['text'] }}
                        </span>
                    </td>
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
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <a href="{{ route('spjWD3.detail', $spj->id_spj) }}"
                           class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

                <!-- LPJ Content -->
<div id="content-lpj" class="tab-content hidden">
    <div class="overflow-x-auto">
        <table id="table-lpj" class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Penyelenggara
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Jenis LPJ
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tanggal Pengajuan LPJ
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Detail
                    </th>
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
                        <div class="text-sm text-gray-900">
                            @if ($lpj->jenis_lpj == 1)
                                60%
                            @elseif ($lpj->jenis_lpj == 2)
                                100%
                            @endif
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
                            $statusMap = [
                                0 => ['text' => 'Menunggu', 'class' => 'bg-yellow-100 text-yellow-800'],
                                1 => ['text' => 'Disetujui', 'class' => 'bg-green-100 text-green-800'],
                                2 => ['text' => 'Ditolak', 'class' => 'bg-red-100 text-red-800'],
                                3 => ['text' => 'Revisi', 'class' => 'bg-blue-100 text-blue-800']
                            ];
                            $status = $statusMap[$statusRevisi] ?? $statusMap[0];
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $status['class'] }}">
                            {{ $status['text'] }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            {{ \Carbon\Carbon::parse($lpj->created_at)->format('Y-m-d') }}
                        </div>
                        <div class="text-xs text-gray-500">
                            {{ \Carbon\Carbon::parse($lpj->created_at)->diffForHumans() }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <a href="{{ route('lpjWD3.detail', $lpj->id_lpj) }}"
                           class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Detail
                        </a>
                    </td>
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

<!-- Styles -->
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

<!-- Scripts -->
<script>
    $(document).ready(function() {
        // Initialize DataTables
        const tableConfig = {
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50],
            language: {
                search: "🔍",
                lengthMenu: "Tampilkan _MENU_",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
                paginate: {
                    first: "«",
                    previous: "‹",
                    next: "›",
                    last: "»"
                }
            }
        };

        $('#table-proposal').DataTable(tableConfig);
        $('#table-spj').DataTable(tableConfig);
        $('#table-lpj').DataTable(tableConfig);

        // Tab switching
        $('.tab-button').click(function() {
            $('.tab-button').removeClass('bg-blue-50 text-blue-600').addClass('text-gray-500');
            $(this).removeClass('text-gray-500').addClass('bg-blue-50 text-blue-600');
            
            $('.tab-content').addClass('hidden');
            $(`#content-${this.id.split('-')[1]}`).removeClass('hidden');
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
    });
</script>

@endsection