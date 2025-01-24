@php
    $layout = Auth::guard('mahasiswa')->check() 
                ? 'proposal_kegiatan.pengaju' 
                : (Auth::guard('dosen')->check() 
                    ? 'proposal_kegiatan.reviewer' 
                    : 'non_auth_sidebar');
@endphp

@extends($layout)

@section('konten')
<div class="min-h-screen bg-gray-50/50 py-12 px-4 sm:px-6 lg:px-8">
    <!-- Main Profile Container -->
    <div class="max-w-7xl mx-auto space-y-8">
        <!-- Hero Section with Glassmorphism -->
        <div class="relative bg-white rounded-3xl shadow-sm overflow-hidden">
            <!-- Decorative Background -->
            <div class="absolute inset-0">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-violet-500/20 mix-blend-multiply"></div>
                <div class="absolute inset-0 bg-gradient-to-b from-transparent to-white/90"></div>
            </div>

            <!-- Profile Content -->
            <div class="relative px-6 py-24 sm:px-12 sm:py-32">
                <div class="flex flex-col sm:flex-row items-center gap-8">
                    <!-- Profile Image with Status -->
                    {{-- Ganti src img --}}
                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-pink-600 to-purple-600 rounded-full opacity-75 group-hover:opacity-100 transition duration-300 blur"></div>
                        <div class="relative">
                            <img
                                src="{{ 
                                    isset($profilPengaju) && $profilPengaju->foto_profil 
                                        ? route('file.show', ['filename' => $profilPengaju->foto_profil]) 
                                        : (isset($profilReviewer) && $profilReviewer->foto_profil 
                                            ? route('file.show', ['filename' => $profilReviewer->foto_profil]) 
                                            : 'https://img.icons8.com/?size=100&id=zj0HDoXpmTPF&format=png&color=000000') 
                                }}"
                                alt="Profile Picture"
                                class="w-40 h-40 rounded-full object-cover ring-4 ring-white"
                            />
                            <div class="absolute bottom-2 right-2 bg-green-500 w-6 h-6 rounded-full ring-4 ring-white"></div>
                        </div>
                    </div>

                    <!-- Profile Info -->
                    <div class="text-center sm:text-left space-y-4">
                        <h1 class="text-4xl font-bold text-gray-900 tracking-tight">
                            @if ($profilPengaju && !$profilReviewer)
                                {{ $profilPengaju->username }}
                            @elseif ($profilReviewer && !$profilPengaju)
                                {{ $profilReviewer->nama_lengkap }}
                            @else
                                Nama Tidak Tersedia
                            @endif
                        </h1>
                        <div class="inline-flex items-center px-4 py-2 rounded-full bg-gradient-to-r from-violet-500/10 to-blue-500/10 text-violet-700 font-medium text-sm">
                            @if ($profilPengaju && !$profilReviewer)
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                </svg>
                                Pengaju
                            @elseif ($profilReviewer && !$profilPengaju)
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"/>
                                </svg>
                                Reviewer
                            @else
                                Peran Tidak Diketahui
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Information Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Personal Info Card -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-3xl shadow-sm p-8 space-y-6">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-gradient-to-r from-violet-500/10 to-blue-500/10 rounded-2xl">
                            <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900">Informasi Pribadi</h2>
                    </div>

                    <!-- Info List -->
                    @if ($profilPengaju && !$profilReviewer)
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 rounded-2xl bg-gradient-to-r from-violet-500/5 to-blue-500/5 hover:from-violet-500/10 hover:to-blue-500/10 transition duration-300">
                            <span class="text-gray-600">Nama</span>
                            <span class="font-medium text-gray-900">{{ $profilPengaju->username }}</span>
                        </div>
                        
                        <div class="flex items-center justify-between p-4 rounded-2xl bg-gradient-to-r from-violet-500/5 to-blue-500/5 hover:from-violet-500/10 hover:to-blue-500/10 transition duration-300">
                            <span class="text-gray-600">Email</span>
                            <span class="font-medium text-gray-900">{{ $profilPengaju->email }}</span>
                        </div>

                        <div class="flex items-center justify-between p-4 rounded-2xl bg-gradient-to-r from-violet-500/5 to-blue-500/5 hover:from-violet-500/10 hover:to-blue-500/10 transition duration-300">
                            <span class="text-gray-600">Bergabung</span>
                            <span class="font-medium text-gray-900">{{ $profilPengaju->tanggal_bergabung }}</span>
                        </div>
                    </div>
                    @elseif ($profilReviewer && !$profilPengaju)
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 rounded-2xl bg-gradient-to-r from-violet-500/5 to-blue-500/5 hover:from-violet-500/10 hover:to-blue-500/10 transition duration-300">
                            <span class="text-gray-600">Nama Lengkap</span>
                            <span class="font-medium text-gray-900">{{ $profilReviewer->nama_lengkap }}</span>
                        </div>

                        <div class="flex items-center justify-between p-4 rounded-2xl bg-gradient-to-r from-violet-500/5 to-blue-500/5 hover:from-violet-500/10 hover:to-blue-500/10 transition duration-300">
                            <span class="text-gray-600">Username</span>
                            <span class="font-medium text-gray-900">{{ $profilReviewer->username }}</span>
                        </div>

                        <div class="flex items-center justify-between p-4 rounded-2xl bg-gradient-to-r from-violet-500/5 to-blue-500/5 hover:from-violet-500/10 hover:to-blue-500/10 transition duration-300">
                            <span class="text-gray-600">Email</span>
                            <span class="font-medium text-gray-900">{{ $profilReviewer->email }}</span>
                        </div>

                        <div class="flex items-center justify-between p-4 rounded-2xl bg-gradient-to-r from-violet-500/5 to-blue-500/5 hover:from-violet-500/10 hover:to-blue-500/10 transition duration-300">
                            <span class="text-gray-600">Tanggal Bergabung</span>
                            <span class="font-medium text-gray-900">{{ $profilReviewer->tanggal_bergabung }}</span>
                        </div>

                        <div class="flex items-center justify-between p-4 rounded-2xl bg-gradient-to-r from-violet-500/5 to-blue-500/5 hover:from-violet-500/10 hover:to-blue-500/10 transition duration-300">
                            <span class="text-gray-600">Role</span>
                            <span class="font-medium text-blue-600">{{ $profilReviewer->role->role ?? 'Role tidak ditemukan' }}</span>
                        </div>
                    </div>
                    @endif

                    <!-- Edit Profile Button -->
                    <button id="openModalButton" class="w-full group relative px-6 py-3 rounded-xl bg-gradient-to-r from-violet-600 to-blue-600 text-white font-medium hover:from-violet-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-offset-2 transition-all duration-300">
                        <div class="absolute inset-0 w-3 bg-white rounded-lg opacity-0 group-hover:opacity-10 group-hover:w-full transition-all duration-300"></div>
                        <span class="relative flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit Profil
                        </span>
                    </button>
                </div>
            </div>

            <!-- Statistics Section -->
            <div class="lg:col-span-2 space-y-8">
                @if ($profilPengaju)
                <!-- Stats Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <div class="bg-white p-6 rounded-3xl shadow-sm">
                        <div class="text-3xl font-bold text-violet-600">{{ $proposalStats['lolos_validasi'] }}</div>
                        <div class="text-sm text-gray-600 mt-1">Disetujui</div>
                    </div>
                    <div class="bg-white p-6 rounded-3xl shadow-sm">
                        <div class="text-3xl font-bold text-yellow-600">{{ $proposalStats['sedang_revisi'] }}</div>
                        <div class="text-sm text-gray-600 mt-1">Direvisi</div>
                    </div>
                    <div class="bg-white p-6 rounded-3xl shadow-sm">
                        <div class="text-3xl font-bold text-red-600">{{ $proposalStats['ditolak'] }}</div>
                        <div class="text-sm text-gray-600 mt-1">Ditolak</div>
                    </div>
                    <div class="bg-white p-6 rounded-3xl shadow-sm">
                        <div class="text-3xl font-bold text-emerald-600">
                            {{ $proposalStats['lolos_validasi'] + $proposalStats['sedang_revisi'] + $proposalStats['ditolak'] }}
                        </div>
                        <div class="text-sm text-gray-600 mt-1">Total</div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <a href="{{ url('/pengajuan-proposal') }}" 
                       class="group relative overflow-hidden inline-flex items-center justify-center px-6 py-4 rounded-2xl text-sm font-semibold text-white bg-gradient-to-r from-emerald-500 to-green-500 hover:from-emerald-600 hover:to-green-600 transition-all duration-300">
                        <div class="absolute inset-0 w-3 bg-white rounded-lg opacity-0 group-hover:opacity-10 group-hover:w-full transition-all duration-300"></div>
                        <span class="relative flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                            </svg>
                            Lihat Aktivitas Pengajuan
                        </span>
                    </a>

                    <a href="{{ url('/histori-pengajuan') }}" 
                       class="group relative overflow-hidden inline-flex items-center justify-center px-6 py-4 rounded-2xl text-sm font-semibold text-white bg-gradient-to-r from-rose-500 to-red-500 hover:from-rose-600 hover:to-red-600 transition-all duration-300">
                        <div class="absolute inset-0 w-3 bg-white rounded-lg opacity-0 group-hover:opacity-10 group-hover:w-full transition-all duration-300"></div>
                        <span class="relative flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Lihat Riwayat
                        </span>
                    </a>
                </div>

                <!-- Charts -->
                <div class="bg-white rounded-3xl shadow-sm p-8">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6">Visualisasi Data</h3>
                    <div id="donut-chart" class="h-80"></div>
                </div>
                @endif

                @if ($profilReviewer)
                <!-- Reviewer Statistics -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Chart Card 1: Time Statistics -->
                    <div class="bg-white rounded-3xl shadow-sm p-8">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="p-3 bg-gradient-to-r from-violet-500/10 to-blue-500/10 rounded-2xl">
                                <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Statistik Waktu Pelaksanaan</h3>
                                <p class="text-sm text-gray-500">Total Proposal: {{ $totalDisetujui + $totalDitolak }}</p>
                            </div>
                        </div>
                        <div id="column-chart" class="h-80"></div>
                    </div>

                    <!-- Chart Card 2: Organization Statistics -->
                    <div class="bg-white rounded-3xl shadow-sm p-8">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="p-3 bg-gradient-to-r from-violet-500/10 to-blue-500/10 rounded-2xl">
                                <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Statistik Kegiatan Ormawa</h3>
                                <p class="text-sm text-gray-500">Distribusi proposal berdasarkan organisasi</p>
                            </div>
                        </div>
                        <div class="relative h-80">
                            <canvas id="ormawaChart"></canvas>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Activity Timeline -->
        @if ($profilPengaju && !$profilReviewer)
        <div class="bg-white rounded-3xl shadow-sm p-8">
            <div class="flex items-center gap-4 mb-6">
                <div class="p-3 bg-gradient-to-r from-violet-500/10 to-blue-500/10 rounded-2xl">
                    <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-900">Riwayat Aktivitas</h2>
            </div>

            <div class="space-y-6">
                <div class="relative pl-8 before:content-[''] before:absolute before:left-3 before:top-2 before:w-px before:h-full before:bg-violet-200">
                    <div class="absolute left-0 top-2 w-6 h-6 rounded-full bg-violet-600 flex items-center justify-center">
                        <div class="w-2 h-2 rounded-full bg-white"></div>
                    </div>
                    <div class="pt-1">
                        <p class="text-sm font-medium text-gray-900">Proposal terakhir diajukan</p>
                        <p class="text-sm text-gray-500 mt-1">{{ $lastProposalDate }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Enhanced Modal -->
<div id="myModal" class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm flex justify-center items-center hidden z-50">
    <div class="bg-white rounded-3xl shadow-xl p-8 w-full max-w-md mx-4 transform transition-all duration-300 scale-95 opacity-0 show:scale-100 show:opacity-100">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-900">Informasi Pengeditan Profil</h3>
            <button id="closeModalButton" class="text-gray-400 hover:text-gray-500 transition-colors duration-150">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <p class="text-gray-600">Silakan hubungi Staff Kemahasiswaan untuk pengeditan profil lebih lanjut.</p>
        <div class="mt-8 flex justify-end">
            <button id="closeModalButtonBottom" class="px-4 py-2 bg-gradient-to-r from-rose-500 to-red-500 hover:from-rose-600 hover:to-red-600 text-white rounded-xl font-medium transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                Tutup
            </button>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.44.0/apexcharts.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    // Modal functionality
    const modal = document.getElementById('myModal');
    const modalContent = modal.querySelector('div');
    const openModalButton = document.getElementById('openModalButton');
    const closeModalButton = document.getElementById('closeModalButton');
    const closeModalButtonBottom = document.getElementById('closeModalButtonBottom');

    function toggleModal() {
        modal.classList.toggle('hidden');
        setTimeout(() => {
            modalContent.classList.toggle('scale-95');
            modalContent.classList.toggle('opacity-0');
        }, 10);
    }

    openModalButton.addEventListener('click', toggleModal);
    closeModalButton.addEventListener('click', toggleModal);
    closeModalButtonBottom.addEventListener('click', toggleModal);

    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            toggleModal();
        }
    });

    // Charts Configuration
    const options = {
        colors: ["#4F46E5", "#F97316"],
        series: [
            {
                name: "Disetujui",
                color: "#4F46E5",
                data: @json($data1Disetujui ?? []),
            },
            {
                name: "Ditolak",
                color: "#F97316",
                data: @json($data1Ditolak ?? []),
            },
        ],
        chart: {
            type: "bar",
            height: "320",
            fontFamily: "Inter, sans-serif",
            toolbar: {
                show: false,
            },
            background: 'transparent'
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "65%",
                borderRadius: 8,
                borderRadiusApplication: "end",
            },
        },
        tooltip: {
            shared: true,
            intersect: false,
            style: {
                fontFamily: "Inter, sans-serif",
            },
            y: {
                formatter: function(value) {
                    return value + " proposal"
                }
            }
        },
        states: {
            hover: {
                filter: {
                    type: "darken",
                    value: 0.9,
                },
            },
        },
        stroke: {
            show: true,
            width: 0,
            colors: ["transparent"],
        },
        grid: {
            borderColor: "#f1f1f1",
            strokeDashArray: 4,
            padding: {
                left: 2,
                right: 2,
                top: -14,
            },
        },
        dataLabels: {
            enabled: false,
        },
        legend: {
            show: true,
            position: 'top',
            horizontalAlign: 'right',
            markers: {
                radius: 12,
            },
        },
        xaxis: {
            categories: @json($labels1 ?? []),
            labels: {
                style: {
                    fontFamily: "Inter, sans-serif",
                    cssClass: 'text-xs font-normal fill-gray-600'
                }
            },
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
        },
        yaxis: {
            title: {
                text: "Jumlah Proposal",
                style: {
                    fontFamily: "Inter, sans-serif",
                    color: "#64748b"
                }
            },
            labels: {
                style: {
                    colors: "#64748b"
                }
            }
        },
        fill: {
            opacity: 1,
        },
    };

    // Initialize Charts
    if (document.getElementById("donut-chart") && typeof ApexCharts !== "undefined") {
        const stats = @json($proposalStats ?? null);
        if (stats) {
            const chart = new ApexCharts(
                document.getElementById("donut-chart"), 
                {
                    series: [stats.lolos_validasi, stats.sedang_revisi, stats.ditolak],
                    colors: ["#10B981", "#FBBF24", "#EF4444"],
                    chart: {
                        height: 320,
                        type: "donut",
                        toolbar: {
                            show: false
                        }
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '75%',
                                labels: {
                                    show: true,
                                    total: {
                                        show: true,
                                        label: 'Total Proposals',
                                        formatter: function(w) {
                                            return w.globals.seriesTotals.reduce((a, b) => a + b, 0) + ' proposals'
                                        }
                                    }
                                }
                            }
                        }
                    },
                    labels: ["Lolos Validasi", "Sedang Revisi", "Ditolak"],
                    legend: {
                        position: 'bottom',
                        horizontalAlign: 'center',
                        fontFamily: 'Inter, sans-serif',
                    }
                }
            );
            chart.render();
        }
    }

    if (document.getElementById("column-chart")) {
        const chart = new ApexCharts(document.getElementById("column-chart"), options);
        chart.render();
    }

    if (document.getElementById('ormawaChart')) {
        const ormawaCtx = document.getElementById('ormawaChart').getContext('2d');
        new Chart(ormawaCtx, {
            type: 'doughnut',
            data: {
                labels: @json($labels2 ?? []),
                datasets: [{
                    data: @json($data2 ?? []),
                    backgroundColor: [
                        '#4F46E5',
                        '#F97316',
                        '#10B981',
                        '#6366F1',
                        '#8B5CF6'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.raw + ' proposal';
                            }
                        }
                    }
                },
                cutout: '75%'
            }
        });
    }
</script>
@endsection