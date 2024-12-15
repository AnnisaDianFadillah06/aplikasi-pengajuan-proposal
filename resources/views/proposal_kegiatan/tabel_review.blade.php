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
<title>@yield('title', 'Manajemen Review')</title>

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
                    <table id="myTable" class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                        <tr class="w-full bg-gray-100 text-gray-700 uppercase text-sm leading-normal">
                            <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Penyelenggara</th>
                            <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama kegiatan</th>
                            <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                            <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal Kegiatan</th>
                            <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal Pengajuan</th>
                            <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
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
                                    // Prioritaskan status dari latestRevision jika ada, gunakan item->status jika tidak
                                    $status = $item->latestRevision ? $item->latestRevision->status_revisi : $item->status;
                                    $tahap = $item->latestRevision ? $item->latestRevision->id_dosen : 1;
                                @endphp
                                @if ($status == 0)
                                    <span class="bg-gradient-to-tl from-yellow-500 to-yellow-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                        Menunggu
                                    </span>
                                @elseif ($status == 1 && $tahap < $sessionId)
                                    <span class="bg-gradient-to-tl from-yellow-500 to-yellow-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                        Menunggu
                                    </span>
                                @elseif ($status == 1 && $tahap >= $sessionId)
                                    <span class="bg-gradient-to-tl from-green-600 to-lime-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                        Disetujui
                                    </span>
                                @elseif ($status == 2)
                                    <span class="bg-gradient-to-tl from-red-600 to-red-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                        Ditolak
                                    </span>
                                @elseif ($status == 3)
                                    <span class="bg-gradient-to-tl from-blue-600 to-blue-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                        Revisi
                                    </span>
                                @endif
                            </td>
                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <span class="text-xs font-semibold leading-tight text-slate-400">{{ $item->tgl_kegiatan }}</span>
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <span class="text-xs font-semibold leading-tight text-slate-400">{{ $item->created_at->format('Y-m-d')  }}</span>
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <a href="{{ route('proposal.show', ['reviewProposal' => $item->id_proposal]) }}"  onclick="logProposalId({{ $item->id }})" class="bg-blue-500 text-white px-2 py-1 rounded hover:underline">Review</a>
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
                    {{-- ======================= TABEL 2 ======================= --}}
                    <table id="myTable2" class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                        <tr class="w-full bg-gray-100 text-gray-700 uppercase text-sm leading-normal">
                            <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Penyelenggara</th>
                            <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama kegiatan</th>
                            <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                            <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal Kegiatan</th>
                            <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal Pengajuan</th>
                            <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($lpjs as $item)
                        <tr>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <div class="flex px-2 py-1">
                                <div class="flex flex-col justify-center">
                                <h6 class="mb-0 text-sm leading-normal">{{ $item->id_pengguna }} {{ $item->pengguna->nama_pengguna }}</h6>
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
                                    // Prioritaskan status dari latestRevision jika ada, gunakan item->status jika tidak
                                    $status = $item->latestRevision ? $item->latestRevision->status_revisi : $item->status_approve_lpj;
                                    $tahap = $item->latestRevision ? $item->latestRevision->id_dosen : 1;
                                @endphp
                                @if ($status == 0)
                                    <span class="bg-gradient-to-tl from-yellow-500 to-yellow-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                        Menunggu
                                    </span>
                                @elseif ($status == 1 && $tahap < $sessionId)
                                    <span class="bg-gradient-to-tl from-yellow-500 to-yellow-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                        Menunggu
                                    </span>
                                @elseif ($status == 1 && $tahap >= $sessionId)
                                    <span class="bg-gradient-to-tl from-green-600 to-lime-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                        Disetujui
                                    </span>
                                @elseif ($status == 2)
                                    <span class="bg-gradient-to-tl from-red-600 to-red-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                        Ditolak
                                    </span>
                                @elseif ($status == 3)
                                    <span class="bg-gradient-to-tl from-blue-600 to-blue-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                        Revisi
                                    </span>
                                @endif
                            </td>
                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <span class="text-xs font-semibold leading-tight text-slate-400">{{ $item->tgl_kegiatan }}</span>
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <span class="text-xs font-semibold leading-tight text-slate-400">{{ $item->created_at->format('Y-m-d')  }}</span>
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <a href="{{ route('proposal.show', ['reviewProposal' => $item->id_proposal]) }}"  onclick="logProposalId({{ $item->id }})" class="bg-blue-500 text-white px-2 py-1 rounded hover:underline">Review</a>
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
<!-- <script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "lengthMenu": [5, 10, 25, 50],
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan MENU entri",
                "info": "Menampilkan START hingga END dari TOTAL entri",
                "infoEmpty": "Menampilkan 0 hingga 0 dari 0 entri",
                "infoFiltered": "(disaring dari MAX total entri)",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            }
        });

        // Script untuk menyesuaikan ukuran dropdown secara otomatis
        function adjustSelectWidth() {
            var select = $('.dataTables_length select');
            select.each(function() {
                var text = $(this).find('option:selected').text();
                $(this).css('width', (text.length + 4) + 'ch'); // +2 untuk padding tambahan
            });
        }

        // Panggil fungsi saat halaman dimuat dan saat dropdown berubah
        adjustSelectWidth();
        $('.dataTables_length select').change(adjustSelectWidth);
    });
</script> -->

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
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

        $('#myTable2').DataTable({
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
