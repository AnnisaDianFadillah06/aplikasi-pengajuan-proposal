@extends('proposal_kegiatan\pengaju')
@section('title', 'Pengajuan Kegiatan')
@section('konten')

<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-900">Pengajuan Proposal</h1>
                <a href="{{ url('/tambah-pengajuan-proposal') }}"
                   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-150 ease-in-out">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Proposal Baru
                </a>
            </div>
            
            <!-- Alert Messages -->
            @if(Session::get('sukses'))
            <div id="alert-sukses" class="mt-4 p-4 rounded-lg bg-green-50 border-l-4 border-green-500">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <p class="text-green-700">{{ Session::get('sukses') }}</p>
                </div>
            </div>
            @endif

           <!-- Search and Display Controls -->
        <div class="mt-8 mb-12">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex flex-col sm:flex-row gap-6">
                    <!-- Search Input with Icon -->
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input type="text" 
                            id="proposalSearch" 
                            placeholder="Cari proposal..." 
                            class="w-full pl-12 pr-4 py-3 border-0 bg-gray-50 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-200">
                    </div>
            
            <!-- Display Count Selector -->
            <div class="sm:w-56">
                <select id="displayCount" 
                        class="w-full px-4 py-3 border-0 bg-gray-50 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white appearance-none transition-all duration-200">
                    <option value="6">Tampilkan 6</option>
                    <option value="9">Tampilkan 9</option>
                    <option value="12">Tampilkan 12</option>
                    <option value="15">Tampilkan 15</option>
                    <option value="20">Tampilkan 20</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                    {{-- <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg> --}}
                </div>
            </div>
        </div>
    </div>
</div>

        <!-- Grid Container with Pagination -->
        <div class="relative">
            <!-- Previous Button - Left Side -->
            <div class="absolute left-0 top-1/2 -translate-y-1/2 hidden md:block z-10">
                <button id="prevPage" 
                        class="transform -translate-x-4 px-4 py-3 bg-white border border-gray-200 rounded-full shadow-sm hover:shadow-md transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed group">
                    <svg class="w-6 h-6 text-gray-600 group-hover:text-gray-800 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
            </div>

            <!-- Grid Layout untuk Proposal Cards -->
            <div id="proposalGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($proposals as $item)
                @php
                    // Mengambil revisi terbaru yang sesuai dengan id_proposal
                    $latestReview = $latestReviews->firstWhere('id_proposal', $item->id_proposal);

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
                
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden">
                    <!-- Card Header dengan Status -->
                    <div class="p-6 border-b border-gray-100">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $item->nama_kegiatan }}</h3>
                                <p class="text-sm text-gray-600">{{ $item->pengguna->username }}</p>
                                <p class="text-sm text-gray-500 mt-1">
                                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ \Carbon\Carbon::parse($item->updated_at)->format('d F Y') }}
                                </p>
                            </div>
                            
                            <!-- Status Badge -->
                            <div>
                                @if ($statusRevisi == 0)
                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                        Menunggu
                                    </span>
                                @elseif ($statusRevisi == 1)
                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                        Disetujui
                                    </span>
                                @elseif ($statusRevisi == 2)
                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                                        Ditolak
                                    </span>
                                @elseif ($statusRevisi == 3)
                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                        Revisi
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Progress Indicator -->
                        <div class="mt-4">
                            <div class="flex items-center mb-2">
                                <span class="text-sm font-medium text-gray-700">Progress Review</span>
                                <span class="ml-auto text-sm text-gray-500">
                                    @if ($tahap == 1)
                                        BEM
                                    @elseif ($tahap == 2)
                                        Pembina
                                    @elseif ($tahap == 3)
                                        Ketua Jurusan
                                    @elseif ($tahap == 4)
                                        KLI
                                    @elseif ($tahap == 5)
                                        Wadir 3
                                    @endif
                                </span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ ($tahap * 17) }}%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Actions -->
                    <div class="p-4 bg-gray-50 space-y-2">
                        <form action="{{ route('proposal.detail', $item->id_proposal) }}" method="GET" class="w-full">
                            <!-- Hidden input sebagai penanda -->
                            <input type="hidden" name="is_first_access" value="true">

                            <!-- Detail Button -->
                            <button type="submit"
                            class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors duration-150 ease-in-out">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Detail Proposal
                            </button>
                        </form>

                        <!-- Document Actions -->
                        <div class="grid grid-cols-2 gap-2">
                            <!-- SPJ Upload -->
                            <form method="GET" action="{{ route('spj.index', $item->id_proposal) }}" class="flex-1">
                                <button type="submit" 
                                        class="w-full px-3 py-2 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition-colors duration-150 ease-in-out flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    SPJ
                                </button>
                            </form>

                            <!-- Pengesahan Download -->
                            <form method="GET" action="{{ route('pengesahan.pdf', $item->id_proposal) }}" class="flex-1">
                                @csrf
                                <button type="submit" 
                                        class="w-full px-3 py-2 rounded-lg text-sm font-medium flex items-center justify-center transition-colors duration-150 ease-in-out
                                               {{ $item->updated_by == 6 && $item->status == 1 ? 
                                                  'bg-orange-600 text-white hover:bg-orange-700' : 
                                                  'bg-gray-300 text-gray-500 cursor-not-allowed' }}"
                                        {{ $item->updated_by != 6 || $item->status != 1 ? 'disabled' : '' }}
                                        title="{{ $item->updated_by != 6 || $item->status != 1 ? 
                                                'Belum bisa diunduh karena belum di-approve hingga WD 3' : 
                                                'Download Lembar Pengesahan' }}">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                    Pengesahan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Next Button - Right Side -->
            <div class="absolute right-0 top-1/2 -translate-y-1/2 hidden md:block z-10">
                <button id="nextPage" 
                        class="transform translate-x-4 px-4 py-3 bg-white border border-gray-200 rounded-full shadow-sm hover:shadow-md transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed group">
                    <svg class="w-6 h-6 text-gray-600 group-hover:text-gray-800 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>

            <!-- Mobile Pagination Controls -->
            <div class="mt-6 flex justify-center md:hidden">
                <div class="flex items-center space-x-4 bg-white px-4 py-2 rounded-lg shadow-sm">
                    <button id="prevPageMobile" class="text-gray-600 hover:text-gray-800 disabled:opacity-50 disabled:cursor-not-allowed">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>
                    <span id="pageInfo" class="text-sm font-medium text-gray-700">
                        Page <span id="currentPage">1</span> of <span id="totalPages">1</span>
                    </span>
                    <button id="nextPageMobile" class="text-gray-600 hover:text-gray-800 disabled:opacity-50 disabled:cursor-not-allowed">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const proposalGrid = document.getElementById('proposalGrid');
    const searchInput = document.getElementById('proposalSearch');
    const displayCountSelect = document.getElementById('displayCount');
    const prevPageBtn = document.getElementById('prevPage');
    const nextPageBtn = document.getElementById('nextPage');
    const prevPageBtnMobile = document.getElementById('prevPageMobile');
    const nextPageBtnMobile = document.getElementById('nextPageMobile');
    const currentPageSpan = document.getElementById('currentPage');
    const totalPagesSpan = document.getElementById('totalPages');

    let currentPage = 1;
    let proposals = Array.from(proposalGrid.children);
    let filteredProposals = [...proposals];

    function updateDisplay() {
        const displayCount = parseInt(displayCountSelect.value);
        const startIndex = (currentPage - 1) * displayCount;
        const endIndex = startIndex + displayCount;
        
        proposals.forEach(card => card.style.display = 'none');
        filteredProposals.slice(startIndex, endIndex).forEach(card => card.style.display = '');
        
        const totalPages = Math.ceil(filteredProposals.length / displayCount);
        currentPageSpan.textContent = currentPage;
        totalPagesSpan.textContent = totalPages;
        
        // Update both desktop and mobile button states
        [prevPageBtn, prevPageBtnMobile].forEach(btn => {
            if (btn) btn.disabled = currentPage === 1;
        });
        
        [nextPageBtn, nextPageBtnMobile].forEach(btn => {
            if (btn) btn.disabled = currentPage === totalPages || totalPages === 0;
        });
    }

    function filterProposals() {
        const searchTerm = searchInput.value.toLowerCase();
        filteredProposals = proposals.filter(card => {
            const title = card.querySelector('h3').textContent.toLowerCase();
            const username = card.querySelector('.text-gray-600').textContent.toLowerCase();
            return title.includes(searchTerm) || username.includes(searchTerm);
        });
        currentPage = 1;
        updateDisplay();
    }

    // Event Listeners
    searchInput.addEventListener('input', filterProposals);
    displayCountSelect.addEventListener('change', () => {
        currentPage = 1;
        updateDisplay();
    });

    // Desktop and Mobile pagination handlers
    [prevPageBtn, prevPageBtnMobile].forEach(btn => {
        if (btn) {
            btn.addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    updateDisplay();
                }
            });
        }
    });

    [nextPageBtn, nextPageBtnMobile].forEach(btn => {
        if (btn) {
            btn.addEventListener('click', () => {
                const displayCount = parseInt(displayCountSelect.value);
                const totalPages = Math.ceil(filteredProposals.length / displayCount);
                if (currentPage < totalPages) {
                    currentPage++;
                    updateDisplay();
                }
            });
        }
    });

    // Initial display
    updateDisplay();
});

// Alert disappear after 3 seconds
setTimeout(() => {
    const alerts = document.querySelectorAll('#alert-sukses, #alert-gagal');
    alerts.forEach(alert => {
        if (alert) {
            alert.style.display = 'none';
        }
    });
}, 3000);

// Dropdown functionality
document.addEventListener('DOMContentLoaded', () => {
    const dropdownTriggers = document.querySelectorAll('[data-dropdown-trigger]');

    dropdownTriggers.forEach((trigger) => {
        const menu = trigger.nextElementSibling;

        trigger.addEventListener('click', (event) => {
            document.querySelectorAll('[data-dropdown-menu]').forEach((dropdown) => {
                if (dropdown !== menu) {
                    dropdown.classList.add('hidden');
                }
            });

            menu.classList.toggle('hidden');
            event.stopPropagation();
        });
    });

    document.addEventListener('click', () => {
        document.querySelectorAll('[data-dropdown-menu]').forEach((menu) => {
            menu.classList.add('hidden');
        });
    });
});
</script>

@endsection