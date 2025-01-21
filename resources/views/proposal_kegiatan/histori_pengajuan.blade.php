@extends('proposal_kegiatan/pengaju')
@section('title', 'Histori Pengajuan')
@section('konten')

<title>@yield('title', 'Histori Pengajuan')</title>

<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Riwayat Proposal Kegiatan</h1>
                    <p class="mt-1 text-sm text-gray-500">Kelola dan pantau status proposal kegiatan Anda</p>
                </div>
                <a href="{{ route('download.pdf') }}" 
                   class="inline-flex items-center px-4 py-2 bg-white text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-150 ease-in-out shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Unduh PDF
                </a>
            </div>
        </div>

        <!-- Filter Pills (Mobile Only) -->
        {{-- <div class="md:hidden flex gap-2 overflow-x-auto pb-4 -mx-4 px-4 scrollbar-hide">
            <button data-status="all" class="mobile-filter px-3 py-1.5 bg-blue-50 text-blue-600 rounded-full text-sm font-medium whitespace-nowrap">
                Semua
            </button>
            <button data-status="menunggu" class="mobile-filter px-3 py-1.5 bg-gray-100 text-gray-600 rounded-full text-sm font-medium whitespace-nowrap">
                Menunggu
            </button>
            <button data-status="review" class="mobile-filter px-3 py-1.5 bg-gray-100 text-gray-600 rounded-full text-sm font-medium whitespace-nowrap">
                Dalam Review
            </button>
            <button data-status="disetujui" class="mobile-filter px-3 py-1.5 bg-gray-100 text-gray-600 rounded-full text-sm font-medium whitespace-nowrap">
                Disetujui
            </button>
        </div> --}}

        <!-- Desktop Table View -->
        <div class="hidden md:block bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table id="myTable" class="w-full">
                    <thead>
                        <tr class="bg-gray-50 text-left">
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Kegiatan</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Periode Kegiatan</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Tempat</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Tgl Pengajuan</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($proposals as $proposal)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 text-sm text-gray-600"></td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $proposal->nama_kegiatan }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-600">
                                        {{ \Carbon\Carbon::parse($proposal->tanggal_mulai)->format('d M Y') }} -
                                        {{ \Carbon\Carbon::parse($proposal->tanggal_akhir)->format('d M Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-600">{{ $proposal->tmpt_kegiatan }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-600">
                                        {{ \Carbon\Carbon::parse($proposal->created_at)->format('d M Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($proposal->status === 1)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Disetujui
                                        </span>
                                    {{-- @elseif($proposal->status === 2)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Dalam Review
                                        </span> --}}
                                    @elseif($proposal->status === 2)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('proposal.historiReview', ['reviewProposal' => $proposal->id_proposal]) }}" 
                                       class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors duration-150">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
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

        <!-- Mobile View Container -->
<div class="md:hidden">
    <!-- Sticky Container for Search and Filters -->
    <div class="sticky top-0 bg-gray-50 z-20 pb-4 space-y-4">
        <!-- Search Bar - Now wrapped in its own container -->
        <div class="search-container relative">
            <input type="search" 
                   id="mobileSearch" 
                   placeholder="Cari proposal..." 
                   class="w-full px-4 py-2.5 pl-10 text-sm bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                   oninput="handleSearch()">
            <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 014 0z"/>
            </svg>
        </div>

        <!-- Filter Pills -->
        <div class="flex gap-2 overflow-x-auto scrollbar-hide -mx-4 px-4">
            <button data-status="all" class="mobile-filter px-3 py-1.5 bg-blue-50 text-blue-600 rounded-full text-sm font-medium whitespace-nowrap">
                Semua
            </button>
            {{-- <button data-status="menunggu" class="mobile-filter px-3 py-1.5 bg-gray-100 text-gray-600 rounded-full text-sm font-medium whitespace-nowrap">
                Menunggu
            </button> --}}
            <button data-status="review" class="mobile-filter px-3 py-1.5 bg-gray-100 text-gray-600 rounded-full text-sm font-medium whitespace-nowrap">
                Ditolak
            </button>
            <button data-status="disetujui" class="mobile-filter px-3 py-1.5 bg-gray-100 text-gray-600 rounded-full text-sm font-medium whitespace-nowrap">
                Disetujui
            </button>
        </div>
    </div>

    <!-- Cards Container -->
    <div class="space-y-3 mt-2">
        @foreach($proposals as $proposal)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <!-- Status Badge -->
            <div class="flex justify-between items-start mb-3">
                <h3 class="font-medium text-gray-900">{{ $proposal->nama_kegiatan }}</h3>
                @if($proposal->status === 1)
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        Disetujui
                    </span>
                @elseif($proposal->status === 2)
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        Ditolak
                    </span>
                {{-- @else
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                        Menunggu
                    </span> --}}
                @endif
            </div>

            <!-- Info Groups -->
            <div class="space-y-2 mb-4">
                <div class="flex items-center text-sm text-gray-600">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ \Carbon\Carbon::parse($proposal->tanggal_mulai)->format('d M Y') }} -
                    {{ \Carbon\Carbon::parse($proposal->tanggal_akhir)->format('d M Y') }}
                </div>
                <div class="flex items-center text-sm text-gray-600">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    {{ $proposal->tmpt_kegiatan }}
                </div>
                <div class="flex items-center text-sm text-gray-600">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Diajukan {{ \Carbon\Carbon::parse($proposal->created_at)->format('d M Y') }}
                </div>
            </div>

            <!-- Action Button -->
            <a href="{{ route('proposal.historiReview', ['reviewProposal' => $proposal->id_proposal]) }}" 
               class="block w-full text-center px-4 py-2 bg-blue-50 text-blue-600 rounded-lg font-medium hover:bg-blue-100 transition-colors duration-150">
                Lihat Detail
            </a>
        </div>
        @endforeach
        
        <!-- No Results Message -->
        <div class="no-results-message hidden">
            <div class="text-center py-8">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada hasil</h3>
                <p class="mt-1 text-sm text-gray-500">Tidak ada proposal yang sesuai dengan pencarian Anda.</p>
            </div>
        </div>
    </div>
</div>

<style>
/* Custom DataTables Styling */
.dataTables_wrapper {
    padding: 1.5rem;
}

.dataTables_length select {
    @apply rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500;
    padding: 0.4rem 2rem 0.4rem 0.75rem;
    font-size: 0.875rem;
    line-height: 1.25rem;
}

.dataTables_filter input {
    @apply rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500;
    padding: 0.4rem 0.75rem;
    font-size: 0.875rem;
    line-height: 1.25rem;
    margin-left: 0.5rem;
}

.dataTables_info {
    @apply text-sm text-gray-600 mt-4;
}

.dataTables_paginate {
    @apply mt-4 flex items-center justify-end gap-2;
}

.dataTables_paginate .paginate_button {
    @apply px-3 py-1.5 text-sm font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-colors duration-150;
}

.dataTables_paginate .paginate_button.current {
    @apply bg-blue-50 text-blue-600;
}

.dataTables_paginate .paginate_button.disabled {
    @apply text-gray-400 hover:text-gray-400 hover:bg-transparent cursor-not-allowed;
}

/* Hide scrollbar but keep functionality */
.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}

/* Animation for no results message */
.no-results-message {
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}
</style>

<script>
    $(document).ready(function () {
        var table = $('#myTable').DataTable({
            "deferRender": true,
            "pageLength": 10,
            "searching": true,
            "ordering": true,
            "info": true,
            "lengthMenu": [5, 10, 25, 50],
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data",
                "info": "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                "infoEmpty": "Tidak ada data yang tersedia",
                "infoFiltered": "(difilter dari _MAX_ total data)",
                "paginate": {
                    "first": "Awal",
                    "last": "Akhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                },
                "zeroRecords": "Tidak ditemukan data yang sesuai"
            },
            "columnDefs": [
                {
                    "orderable": false,
                    "targets": [0, 6]
                }
            ],
            "order": [[4, 'desc']], // Sort by submission date by default
            "drawCallback": function (settings) {
                var api = this.api();
                api.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            },
            "responsive": true,
            "autoWidth": false
        });
    
        // Mobile filter functionality
        $('.mobile-filter').click(function() {
            $('.mobile-filter').removeClass('bg-blue-50 text-blue-600').addClass('bg-gray-100 text-gray-600');
            $(this).removeClass('bg-gray-100 text-gray-600').addClass('bg-blue-50 text-blue-600');
            
            const status = $(this).data('status');
            filterCards(status, $('#mobileSearch').val().toLowerCase());
        });

        // Mobile search functionality with debounce
        let searchTimeout;
        $('#mobileSearch').on('input', function() {
            clearTimeout(searchTimeout);
            const $this = $(this);
            
            searchTimeout = setTimeout(function() {
                const searchValue = $this.val().toLowerCase();
                const activeStatus = $('.mobile-filter.bg-blue-50').data('status') || 'all';
                filterCards(activeStatus, searchValue);
            }, 300);
        });

        // Function to filter cards based on status and search value
        function filterCards(status, searchValue) {
            const cards = $('.md\\:hidden .bg-white.rounded-xl');
            
            cards.each(function() {
                const $card = $(this);
                const cardText = $card.text().toLowerCase();
                const cardStatus = $card.find('span.rounded-full').text().trim().toLowerCase();
                
                const matchesSearch = cardText.includes(searchValue);
                const matchesStatus = status === 'all' || 
                                    (status === 'menunggu' && cardStatus === 'menunggu') ||
                                    (status === 'review' && cardStatus === 'dalam review') ||
                                    (status === 'disetujui' && cardStatus === 'disetujui');

                if (matchesSearch && matchesStatus) {
                    $card.show();
                } else {
                    $card.hide();
                }
            });

            // Show "no results" message if no cards are visible
            const visibleCards = cards.filter(':visible').length;
            let noResultsMsg = $('.no-results-message');
            
            if (visibleCards === 0) {
                if (noResultsMsg.length === 0) {
                    noResultsMsg = $('<div class="no-results-message text-center py-4 text-gray-500">Tidak ada hasil yang ditemukan</div>');
                    cards.last().after(noResultsMsg);
                }
                noResultsMsg.show();
            } else {
                noResultsMsg.hide();
            }
        }

        // Clear search
        $('#mobileSearch').on('search', function() {
            if ($(this).val() === '') {
                const activeStatus = $('.mobile-filter.bg-blue-50').data('status') || 'all';
                filterCards(activeStatus, '');
            }
        });
    
        // Responsive handling
        $(window).on('resize', function () {
            if ($(window).width() < 768) {
                $('.dataTables_length select').addClass('w-full');
                $('.dataTables_filter input').addClass('w-full mt-2');
            } else {
                $('.dataTables_length select').removeClass('w-full');
                $('.dataTables_filter input').removeClass('w-full mt-2');
            }
        }).trigger('resize');
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
</script>
@endsection