@extends('proposal_kegiatan\pengaju')
@section('konten')

<!-- Main Container -->
<div class="min-h-screen p-8 bg-gray-50/30">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="mb-8">
            <div class="flex items-center gap-4 mb-4">
                <a href="{{ route('pengajuan-proposal') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 rounded-lg border border-gray-200 shadow-sm transition-all duration-200 hover:shadow">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
            </div>
        <h1 class="text-2xl font-bold text-gray-800">Informasi SPJ</h1>
        <p class="text-gray-600">Manajemen dan monitoring dokumen SPJ kegiatan</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
        <!-- Total SPJ Card -->
        <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-blue-100 rounded-xl">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total SPJ Dibutuhkan</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $proposal->jumlah_spj }}</h3>
                </div>
            </div>
        </div>

        <!-- Uploaded SPJ Card -->
        <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-green-100 rounded-xl">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">SPJ Terunggah</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $spjs->count() }}</h3>
                </div>
            </div>
        </div>

        <!-- Progress Card -->
        <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-purple-100 rounded-xl">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5M8 8v8m-4-5v5m0 0h18" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Progress</p>
                    <h3 class="text-2xl font-bold text-gray-800">
                        {{ round(($spjs->count() / $proposal->jumlah_spj) * 100) }}%
                    </h3>
                </div>
            </div>
        </div>

        <!-- Status Card -->
        <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-indigo-100 rounded-xl">
                    <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Status</p>
                    <h3 class="text-lg font-medium text-blue-600">Aktif</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Alerts -->
    @if(Session::get('sukses'))
    <div id="alert-sukses" class="flex p-4 mb-6 text-green-800 border-l-4 border-green-400 bg-green-50/50 rounded-r-lg" role="alert">
        <svg class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <div class="ml-3 text-sm font-medium">{{ Session::get('sukses') }}</div>
    </div>
    @endif

    @if(Session::get('gagal'))
    <div id="alert-gagal" class="flex p-4 mb-6 text-red-800 border-l-4 border-red-400 bg-red-50/50 rounded-r-lg" role="alert">
        <svg class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
        </svg>
        <div class="ml-3 text-sm font-medium">{{ Session::get('gagal') }}</div>
    </div>
    @endif

    <!-- Main Content Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-6">
            <!-- Card Header -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Daftar SPJ</h2>
                    <p class="text-sm text-gray-500">Kelola dokumen SPJ kegiatan Anda</p>
                </div>
                
                @if($canUpload && !$belumBerjalan)
                <a href="{{ route('spj.formIndex', ['id_proposal' => $proposal->id_proposal]) }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-xl transition-all duration-200 shadow-sm hover:shadow">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Upload SPJ
                </a>
                @elseif($belumBerjalan)
                <button disabled class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-400 text-sm font-medium rounded-xl cursor-not-allowed">
                    Kegiatan belum berjalan
                </button>
                @else
                <button disabled class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-400 text-sm font-medium rounded-xl cursor-not-allowed">
                    SPJ Sudah Lengkap
                </button>
                @endif
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table id="myTable" class="w-full">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider text-left bg-gray-50/50">SPJ ke-</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider text-left bg-gray-50/50">Nama Kegiatan</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider text-left bg-gray-50/50">Status</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider text-left bg-gray-50/50">Tanggal Unggah</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider text-left bg-gray-50/50">Tahap Review</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider text-left bg-gray-50/50">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($spjs as $item)
                        @php
                            $latestReview = $latestReviews->firstWhere('id_spj', $item->id_spj);
                            if ($latestReview) {
                                $statusRevisi = $latestReview->status_revisi;
                                $tahap = $latestReview->id_dosen;
                                if ($statusRevisi == 1) {
                                    $statusRevisi = 0;
                                    $tahap += 1;
                                }
                            } else {
                                $statusRevisi = $item->status;
                                $tahap = $item->updated_by;
                            }
                        @endphp
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $item->spj_ke }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $proposal->nama_kegiatan }}</td>
                            <td class="px-6 py-4">
                                @if ($statusRevisi == 0)
                                    <span class="px-3 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-full">Menunggu</span>
                                @elseif ($statusRevisi == 1)
                                    <span class="px-3 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full">Disetujui</span>
                                @elseif ($statusRevisi == 2)
                                    <span class="px-3 py-1 text-xs font-medium text-red-700 bg-red-100 rounded-full">Ditolak</span>
                                @elseif ($statusRevisi == 3)
                                    <span class="px-3 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded-full">Revisi</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $item->updated_at }}</td>
                            <td class="px-6 py-4">
                                @if ($tahap == 1)
                                    <span class="px-3 py-1 text-xs font-medium text-purple-700 bg-purple-100 rounded-full">BEM</span>
                                @elseif ($tahap == 2)
                                    <span class="px-3 py-1 text-xs font-medium text-indigo-700 bg-indigo-100 rounded-full">Pembina</span>
                                @elseif ($tahap == 3)
                                    <span class="px-3 py-1 text-xs font-medium text-teal-700 bg-teal-100 rounded-full">Wadir 3</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <form method="GET" action="{{ route('spj.detail', $item->id_spj) }}">
                                    @csrf
                                    <input type="hidden" name="is_first_access" value="true">
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
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
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>

<script>
    $(document).ready(function(){
        $('#myTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "lengthMenu": [5, 10, 25, 50],
            "pageLength": 10,
            "dom": '<"flex justify-between items-center mb-4"lf>rt<"flex justify-between items-center mt-4"ip>',
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
                },
                "zeroRecords": "Tidak ada data yang cocok"
            },
            "drawCallback": function() {
                // Style the DataTables elements after draw
                $('.dataTables_length select').addClass('rounded-lg border-gray-200 text-sm');
                $('.dataTables_filter input').addClass('rounded-lg border-gray-200 text-sm');
                $('.paginate_button').addClass('px-3 py-1 mx-1 text-sm');
                $('.paginate_button.current').addClass('bg-blue-600 text-white rounded-lg');
                $('.paginate_button:not(.current)').addClass('text-gray-600 hover:bg-gray-100 rounded-lg');
            }
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

        // Fade out alerts
        setTimeout(() => {
            $('#alert-sukses, #alert-gagal').fadeOut('slow');
        }, 3000);
    });
</script>

@endsection