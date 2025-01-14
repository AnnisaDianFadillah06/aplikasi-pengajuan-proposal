@extends('proposal_kegiatan\reviewer')
@section('konten')


<!-- Link Tailwind CSS dan FontAwesome untuk ikon -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

{{-- Cek apakah ada sesi login dan tampilkan data pengguna --}}
{{-- @if (session()->has('username') && session()->has('id'))
    <p>Selamat datang, {{ session('username') }}!</p>
    <p>id Anda: {{ session('id') }}</p>
    <p>role  Anda: {{ session('role') }}</p>
@else
    <p>Anda belum login.</p>
@endif --}}

<!-- Link Tailwind CSS dan FontAwesome untuk ikon -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<title>@yield('title', 'Histori Review')</title>



@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="bg-white rounded-2xl shadow-lg mb-8 p-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
        <div class="space-y-2">
            <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                Riwayat Proposal Kegiatan
            </h1>
            <p class="text-gray-500">Kelola semua organisasi mahasiswa dalam satu dashboard terintegrasi</p>
        </div>
            <a href="{{ route('download_reviewer.pdf') }}"
                class="flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 group-hover:rotate-90 transition-transform duration-200" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Download PDF
            </a>
        </div>
    </div>
</div>

<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="container mx-auto mt-8 mb-8">
                <div class="mb-4">
                    <!-- Tabs Navigation -->
                    <ul class="flex border-b">
                        <li class="-mb-px mr-1">
                            <a id="tab-proposal" href="#" class="tab-button bg-white inline-block py-2 px-4 text-blue-500 font-semibold border-l border-t border-r rounded-t focus:outline-none">Daftar Review Proposal</a>
                        </li>
                        <li class="mr-1">
                            <a id="tab-spj" href="#" class="tab-button inline-block py-2 px-4 text-gray-500 hover:text-blue-500 font-semibold">Daftar Review SPJ</a>
                        </li>
                        <li class="mr-1">
                            <a id="tab-lpj" href="#" class="tab-button inline-block py-2 px-4 text-gray-500 hover:text-blue-500 font-semibold">Daftar Review LPJ</a>
                        </li>
                    </ul>
                </div>
            
                <!-- Tab Content -->
                <div id="content-proposal" class="tab-content">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold">List Proposal</h3>
                    </div>
                    {{-- ======================= TABEL 1 ======================= --}}
                    <table id="table-proposal" class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                        <tr class="w-full bg-gray-100 text-gray-700 uppercase text-sm leading-normal">
                            <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Penyelenggara</th>
                            <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama kegiatan</th>
                            <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                            <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal Kegiatan</th>
                            <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal Pengajuan Proposal</th>
                            <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Detail</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($proposals as $item)
                        <tr>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <div class="flex px-2 py-1">
                                <div class="flex flex-col justify-center">
                                <h6 class="mb-0 text-sm leading-normal">{{ $item->pengguna->username }}</h6>
                                <!-- <p class="mb-0 text-xs leading-tight text-slate-400">john@creative-tim.com</p> -->
                                </div>
                            </div>
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <p class="mb-0 text-xs font-semibold leading-tight">{{ $item->nama_kegiatan }}</p>
                            <!-- <p class="mb-0 text-xs leading-tight text-slate-400">Organization</p> -->
                            </td>
                            <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                @php
                                    // Mengambil revisi terbaru yang sesuai dengan id_proposal
                                    $latestReview = $item->latestRevision;

                                    if ($latestReview) {
                                        // Status revisi dan tahap berdasarkan review terbaru
                                        $statusRevisi = $latestReview->status_revisi;
                                        $tahap = $latestReview->id_dosen;

                                        // Pengondisian tambahan: jika status revisi adalah 1
                                        if ($statusRevisi == 1) {
                                            $statusRevisi = 0; // Mengubah status revisi menjadi 0
                                            $tahap += 1;       // Meningkatkan tahap
                                        }
                                    } else {
                                        // Jika tidak ada review terbaru, gunakan nilai default dari item
                                        $statusRevisi = $item->status;
                                        $tahap = $item->updated_by;
                                    }
                                @endphp
                                @if ($statusRevisi == 0)
                                    <span class="bg-gradient-to-tl from-yellow-500 to-yellow-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                        Menunggu 
                                    </span>
                                @elseif ($statusRevisi == 1)
                                    <span class="bg-gradient-to-tl from-green-600 to-lime-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                        Disetujui
                                    </span>
                                @elseif ($statusRevisi == 2)
                                    <span class="bg-gradient-to-tl from-red-600 to-red-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                        Ditolak
                                    </span>
                                @elseif ($statusRevisi == 3)
                                    <span class="bg-gradient-to-tl from-blue-600 to-blue-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                        Revisi
                                    </span>
                                @endif
                            </td>
                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <span class="text-xs font-semibold leading-tight text-slate-400">{{ $item->tanggal_mulai }}</span>
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <span class="text-xs font-semibold leading-tight text-slate-400">{{ $item->updated_at->format('Y-m-d')  }}</span>
                            </td>
                            <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <form method="GET" action="{{ route('proposalWD3.detail', $item->id_proposal) }}">
                                    @csrf
                                    <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded">
                                        Detail
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            
                <div id="content-spj" class="tab-content hidden">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold">List SPJ</h3>
                    </div>
                    {{-- ======================= TABEL 2 ======================= --}}
                    <table id="table-spj" class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                        <tr class="w-full bg-gray-100 text-gray-700 uppercase text-sm leading-normal">
                            <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Penyelenggara</th>
                            <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama kegiatan</th>
                            <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                            <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal Kegiatan</th>
                            <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal Pengajuan SPJ</th>
                            <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Detail</th>                            
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($spjAll as $spj)
                        <tr>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <div class="flex px-2 py-1">
                                <div class="flex flex-col justify-center">
                                <h6 class="mb-0 text-sm leading-normal">{{ $spj->proposalKegiatan->pengguna->username }}</h6>
                                <!-- <p class="mb-0 text-xs leading-tight text-slate-400">john@creative-tim.com</p> -->
                                </div>
                            </div>
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <p class="mb-0 text-xs font-semibold leading-tight">{{ $spj->proposalKegiatan->nama_kegiatan }}</p>
                            <!-- <p class="mb-0 text-xs leading-tight text-slate-400">Organization</p> -->
                            </td>
                            <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                @php
                                    // Mengambil revisi terbaru yang sesuai dengan id_proposal
                                    $latestReview = $spj->latestRevision;

                                    if ($latestReview) {
                                        // Status revisi dan tahap berdasarkan review terbaru
                                        $statusRevisi = $latestReview->status_revisi;
                                        $tahapSpj = $latestReview->id_dosen;

                                        // Pengondisian tambahan: jika status revisi adalah 1
                                        if ($statusRevisi == 1) {
                                            $statusRevisi = 0; // Mengubah status revisi menjadi 0
                                            $tahapSpj += 1;       // Meningkatkan tahap
                                        }
                                    } else {
                                        // Jika tidak ada review terbaru, gunakan nilai default dari item
                                        $statusRevisi = $spj->status;
                                        $tahapSpj = $spj->updated_by;
                                    }
                                @endphp
                                @php
                                    // Prioritaskan status dari latestRevision jika ada, gunakan item->status jika tidak
                                    $status = $spj->latestRevision ? $spj->latestRevision->status_revisi : $spj->status;
                                    $tahapSpj = $spj->updated_by;
                                @endphp
                                @if ($statusRevisi == 0)
                                    <span class="bg-gradient-to-tl from-yellow-500 to-yellow-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                        Menunggu 
                                    </span>
                                @elseif ($statusRevisi == 1)
                                    <span class="bg-gradient-to-tl from-green-600 to-lime-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                        Disetujui
                                    </span>
                                @elseif ($statusRevisi == 2)
                                    <span class="bg-gradient-to-tl from-red-600 to-red-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                        Ditolak
                                    </span>
                                @elseif ($statusRevisi == 3)
                                    <span class="bg-gradient-to-tl from-blue-600 to-blue-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                        Revisi
                                    </span>
                                @endif
                            </td>
                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <span class="text-xs font-semibold leading-tight text-slate-400">{{ $spj->proposalKegiatan->tanggal_mulai }}</span>
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <span class="text-xs font-semibold leading-tight text-slate-400">{{ \Carbon\Carbon::parse($spj->updated_at)->format('Y-m-d') }}</span>
                            </td>
                            <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <form method="GET" action="{{ route('spjWD3.detail', $spj->id_spj) }}">
                                    @csrf
                                    <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded">
                                        Detail
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div> 

                <div id="content-lpj" class="tab-content hidden">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold">List LPJ</h3>
                    </div>
                    {{-- ======================= TABEL 3 ======================= --}}
                    <table id="table-lpj" class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                        <tr class="w-full bg-gray-100 text-gray-700 uppercase text-sm leading-normal">
                            <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Penyelenggara</th>
                            <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Jenis LPJ</th>
                            <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                            <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal Pengajuan LPJ</th>    
                            <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Detail</th>                            
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($lpjAll as $lpj)
                        <tr>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <div class="flex px-2 py-1">
                                <div class="flex flex-col justify-center">
                                <h6 class="mb-0 text-sm leading-normal">{{ $lpj->ormawa->nama_ormawa }}</h6>
                                </div>
                            </div>
                            
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    @if ($lpj->jenis_lpj == 1)
                                        <p class="mb-0 text-xs font-semibold leading-tight">60%</p>
                                    @elseif ($lpj->jenis_lpj == 2)
                                        <p class="mb-0 text-xs font-semibold leading-tight">100%</p>
                                    @endif
                            </td>
                            <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                @php
                                    // Mengambil revisi terbaru yang sesuai dengan id_proposal
                                    $latestReview = $lpj->latestRevision;

                                    if ($latestReview) {
                                        // Status revisi dan tahap berdasarkan review terbaru
                                        $statusRevisi = $latestReview->status_revisi;
                                        $tahapLpj = $latestReview->id_dosen;

                                        // Pengondisian tambahan: jika status revisi adalah 1
                                        if ($statusRevisi == 1) {
                                            $statusRevisi = 0; // Mengubah status revisi menjadi 0
                                            $tahapLpj += 1;       // Meningkatkan tahap
                                        }
                                    } else {
                                        // Jika tidak ada review terbaru, gunakan nilai default dari item
                                        $statusRevisi = $lpj->status_lpj;
                                        $tahapLpj = $lpj->updated_by;
                                    }
                                @endphp
                                @if ($statusRevisi == 0)
                                    <span class="bg-gradient-to-tl from-yellow-500 to-yellow-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                        Menunggu 
                                    </span>
                                @elseif ($statusRevisi == 1)
                                    <span class="bg-gradient-to-tl from-green-600 to-lime-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                        Disetujui
                                    </span>
                                @elseif ($statusRevisi == 2)
                                    <span class="bg-gradient-to-tl from-red-600 to-red-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                        Ditolak
                                    </span>
                                @elseif ($statusRevisi == 3)
                                    <span class="bg-gradient-to-tl from-blue-600 to-blue-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                        Revisi
                                    </span>
                                @endif
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <span class="text-xs font-semibold leading-tight text-slate-400">{{ \Carbon\Carbon::parse($lpj->updated_at)->format('Y-m-d') }}</span>
                            </td>
                            <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <form method="GET" action="{{ route('lpjWD3.detail', $lpj->id_lpj) }}">
                                    @csrf
                                    <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded">
                                        Detail
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <script>
                // Handle Tab Switching
                document.querySelectorAll('.tab-button').forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
            
                        // Remove active classes
                        document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('bg-white', 'text-blue-500'));
                        document.querySelectorAll('.tab-content').forEach(content => content.classList.add('hidden'));
            
                        // Add active classes to current tab
                        this.classList.add('bg-white', 'text-blue-500');
                        const contentId = this.id.replace('tab-', 'content-');
                        document.getElementById(contentId).classList.remove('hidden');
                    });
                });
            </script>
    </div>
</div>


<!-- Script DataTables -->


<script>
    $(document).ready(function() {
        $('#table-proposal').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "lengthMenu": [5, 10, 25, 50],
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ entri",
                "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                "infoEmpty": "Menampilkan 0 hingga 0 dari 0 entri",
                "infoFiltered": "(disaring dari _MAX_ total entri)",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            },
            "drawCallback": function() {
                // Adjust select width after draw
                adjustSelectWidth();
            }
        });

        $('#table-spj').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "lengthMenu": [5, 10, 25, 50],
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ entri",
                "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                "infoEmpty": "Menampilkan 0 hingga 0 dari 0 entri",
                "infoFiltered": "(disaring dari _MAX_ total entri)",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            },
            "drawCallback": function() {
                // Adjust select width after draw
                adjustSelectWidth();
            }
        });

        $('#table-lpj').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "lengthMenu": [5, 10, 25, 50],
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ entri",
                "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                "infoEmpty": "Menampilkan 0 hingga 0 dari 0 entri",
                "infoFiltered": "(disaring dari _MAX_ total entri)",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            },
            "drawCallback": function() {
                // Adjust select width after draw
                adjustSelectWidth();
            }
        });

        // Function to adjust select width

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

    function adjustSelectWidth() {
            var select = $('.dataTables_length select');
            select.each(function() {
                var text = $(this).find('option:selected').text();
                $(this).css('width', (text.length + 4) + 'ch');
            });
        }
</script>

@endsection
