@php
    $layout = Auth::guard('mahasiswa')->check() 
                ? 'proposal_kegiatan.pengaju' 
                : (Auth::guard('dosen')->check() 
                    ? 'proposal_kegiatan.reviewer' 
                    : 'non_auth_sidebar');
@endphp

@extends($layout)

@section('konten')
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <!-- Glass Card Container -->
    <div class="max-w-4xl mx-auto bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl overflow-hidden">
        <!-- Header Section -->
        <div class="relative">
            <!-- Background Banner -->
            <div class="absolute inset-0 bg-gradient-to-r from-blue-200 to-indigo-100 h-48"></div>
            
            <!-- Profile Content -->
            <div class="relative px-8">
                <div class="flex flex-col sm:flex-row items-center pt-24 pb-6">
                    <div class="relative">
                        <img
                            src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                            alt="Profile Picture"
                            class="w-32 h-32 rounded-full border-4 border-white shadow-xl object-cover"
                        />
                        <div class="absolute bottom-0 right-0 bg-green-500 w-5 h-5 rounded-full border-4 border-white"></div>
                    </div>
                    <div class="mt-6 sm:mt-0 sm:mb-7 sm:ml-6 text-center sm:text-left">
                        <h1 class="text-3xl font-bold text-gray-900">
                            @if ($profilPengaju && !$profilReviewer)
                                {{ $profilPengaju->username }}
                            @elseif ($profilReviewer && !$profilPengaju)
                                {{ $profilReviewer->username }}
                            @else
                                Nama Tidak Tersedia
                            @endif
                        </h1>
                        <div class ="sm:mt-3 sm:mb-2">
                        <span class="px-3 py-1 text-sm font-medium text-blue-700 bg-blue-100 rounded-full">
                            @if ($profilPengaju && !$profilReviewer)
                                Pengaju
                            @elseif ($profilReviewer && !$profilPengaju)
                                Reviewer
                            @else
                                Peran Tidak Diketahui
                            @endif
                        </span>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="px-8 py-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Info Card -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center mb-4">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <h2 class="ml-2 text-lg font-semibold text-gray-900">Informasi Pribadi</h2>
                    </div>
                    
                    <div class="space-y-3">
                        @if ($profilPengaju && !$profilReviewer)
                            <div class="flex items-center text-gray-700">
                                <span class="w-32 text-gray-500">Nama:</span>
                                <span class="font-medium">{{ $profilPengaju->username }}</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <span class="w-32 text-gray-500">Email:</span>
                                <span class="font-medium">{{ $profilPengaju->email }}</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <span class="w-32 text-gray-500">Peran:</span>
                                <span class="font-medium"> Pengaju </span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <span class="w-32 text-gray-500">Bergabung:</span>
                                <span class="font-medium">{{ $profilPengaju->tanggal_bergabung }}</span>
                            </div>
                        @elseif ($profilReviewer && !$profilPengaju)
                            <div class="flex items-center text-gray-700">
                                <span class="w-32 text-gray-500">Nama:</span>
                                <span class="font-medium">{{ $profilReviewer->username }}</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <span class="w-32 text-gray-500">Email:</span>
                                <span class="font-medium">{{ $profilReviewer->email }}</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <span class="w-32 text-gray-500">Role:</span>
                                <span class="font-medium">{{ $profilReviewer->role->role ?? 'Role tidak ditemukan' }}</span>
                            </div>
                        @endif
                    </div>

                    <button id="openModalButton" class="mt-6 inline-flex items-center px-4 py-2 border border-transparent rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150 ease-in-out">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Profil
                    </button>
                </div>
                @if ($profilReviewer)
                <!-- Chart Card 2 -->
                <div class="bg-white rounded-2xl shadow-sm p-6 transition-all duration-300 hover:shadow-lg border border-gray-100">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="p-3 bg-purple-100 rounded-xl">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Statistik Kegiatan Ormawa</h3>
                        <p class="text-sm text-gray-500">Distribusi proposal berdasarkan organisasi</p>
                    </div>
                </div>
                <div class="relative h-[300px]">
                    <canvas id="ormawaChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Chart Card 1 -->
            <div class="bg-white rounded-2xl shadow-sm p-6 transition-all duration-300 hover:shadow-lg border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-blue-100 rounded-xl">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Statistik Waktu Pelaksanaan</h3>
                            <p class="text-sm text-gray-500">Total Proposal: {{ $totalDisetujui + $totalDitolak }}</p>
                        </div>
                    </div>
                </div>
                <div id="column-chart" class="h-[300px]"></div>
            </div>
                @endif
                

                <!-- Stats Card -->
                @if ($profilPengaju)
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center mb-4">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <h2 class="ml-2 text-lg font-semibold text-gray-900">Statistik Proposal</h2>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-blue-50 rounded-lg p-4">
                            <div class="text-3xl font-bold text-blue-600">
                                {{ $proposalStats['lolos_validasi'] }}
                            </div>
                            <div class="text-sm text-gray-600">Disetujui</div>
                        </div>
                        <div class="bg-yellow-50 rounded-lg p-4">
                            <div class="text-3xl font-bold text-yellow-600">
                                {{ $proposalStats['sedang_revisi'] }}
                            </div>
                            <div class="text-sm text-gray-600">Direvisi</div>
                        </div>
                        <div class="bg-red-50 rounded-lg p-4">
                            <div class="text-3xl font-bold text-red-600">
                                {{ $proposalStats['ditolak'] }}
                            </div>
                            <div class="text-sm text-gray-600">Ditolak</div>
                        </div>
                        <div class="bg-green-50 rounded-lg p-4">
                            <div class="text-3xl font-bold text-green-600">
                                {{ $proposalStats['lolos_validasi'] + $proposalStats['sedang_revisi'] + $proposalStats['ditolak'] }}
                            </div>
                            <div class="text-sm text-gray-600">Total</div>
                        </div>
                    </div>


                    <div class="grid grid-cols-2 md:grid-cols-2 gap-6">
                        <!-- Tombol Lihat Aktifitas Pengajuan -->
                        <a href="{{ url('/pengajuan-proposal') }}" 
                           class="group relative overflow-hidden mt-6 inline-flex items-center px-6 py-3 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-emerald-500 to-green-500 hover:from-emerald-600 hover:to-green-600 transform hover:-translate-y-0.5 transition-all duration-200 shadow-md hover:shadow-lg">
                            <!-- Background Shine Effect -->
                            <div class="absolute inset-0 w-0 h-full bg-white transform -skew-x-30 opacity-10 animate-shine"></div>
                            
                            <!-- Icon with animated background -->
                            <span class="relative flex items-center justify-center w-8 h-8 mr-3 rounded-lg bg-white/20 backdrop-blur-sm">
                                <svg class="w-5 h-5 transform group-hover:scale-110 transition-transform duration-150" 
                                     fill="none" 
                                     stroke="currentColor" 
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" 
                                          stroke-linejoin="round" 
                                          stroke-width="2" 
                                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                    </path>
                                </svg>
                            </span>
                            
                            <!-- Text with hover animation -->
                            <span class="relative group-hover:translate-x-1 transition-transform duration-150">
                                Lihat Aktifitas Pengajuan
                            </span>
                        </a>
                    
                        <!-- Tombol Lihat Riwayat -->
                        <a href="{{ url('/histori-pengajuan') }}" 
                           class="group relative overflow-hidden mt-6 inline-flex items-center px-6 py-3 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-rose-500 to-red-500 hover:from-rose-600 hover:to-red-600 transform hover:-translate-y-0.5 transition-all duration-200 shadow-md hover:shadow-lg">
                            <!-- Background Shine Effect -->
                            <div class="absolute inset-0 w-0 h-full bg-white transform -skew-x-30 opacity-10 animate-shine"></div>
                            
                            <!-- Icon with animated background -->
                            <span class="relative flex items-center justify-center w-8 h-8 mr-3 rounded-lg bg-white/10 backdrop-blur-sm">
                                <svg class="w-5 h-5 transform group-hover:scale-110 transition-transform duration-150" 
                                     fill="none" 
                                     stroke="currentColor" 
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" 
                                          stroke-linejoin="round" 
                                          stroke-width="2" 
                                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                            </span>
                            
                            <!-- Text with hover animation -->
                            <span class="relative group-hover:translate-x-1 transition-transform duration-150">
                                Lihat Riwayat
                            </span>
                        </a>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Visualisasi Statistik</h2>
                    <div id="donut-chart" class="w-full h-64"></div>
                </div>
                @endif
            </div>
            </div>

            <!-- Activity Timeline -->
            @if ($profilPengaju && !$profilReviewer)
            <div class="mt-6 bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center mb-4">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h2 class="ml-2 text-lg font-semibold text-gray-900">Riwayat Aktivitas</h2>
                </div>

                <div class="space-y-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">Proposal terakhir diajukan</p>
                            <p class="text-sm text-gray-500">{{ $lastProposalDate }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex justify-center items-center hidden z-50">
    <div class="bg-white rounded-xl shadow-xl p-6 w-full max-w-md mx-4">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-gray-900">Informasi Pengeditan Profil</h3>
            <button id="closeModalButton" class="text-gray-400 hover:text-gray-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <p class="text-gray-600">Silakan hubungi Staff Kemahasiswaan untuk pengeditan profil lebih lanjut.</p>
        <div class="mt-6 flex justify-end">
            <button id="closeModalButtonBottom" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-150 ease-in-out">
                Tutup
            </button>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.44.0/apexcharts.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


<script>
    const modal = document.getElementById('myModal');
    const openModalButton = document.getElementById('openModalButton');
    const closeModalButton = document.getElementById('closeModalButton');
    const closeModalButtonBottom = document.getElementById('closeModalButtonBottom');

    function toggleModal() {
        modal.classList.toggle('hidden');
    }

    openModalButton.addEventListener('click', toggleModal);
    closeModalButton.addEventListener('click', toggleModal);
    closeModalButtonBottom.addEventListener('click', toggleModal);

    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            toggleModal();
        }
    });

        // ApexCharts Configuration
        const options = {
        colors: ["#4F46E5", "#F97316"],
        series: [
            {
                name: "Disetujui",
                color: "#4F46E5",
                data: @json($data1Disetujui),
            },
            {
                name: "Ditolak",
                color: "#F97316",
                data: @json($data1Ditolak),
            },
        ],
        chart: {
            type: "bar",
            height: "320px",
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
            theme: "light",
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
            categories: @json($labels1),
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

        // Donut Chart Configuration
        if (document.getElementById("donut-chart") && typeof ApexCharts !== "undefined") {
        const stats = @json($proposalStats);
        const chart = new ApexCharts(
            document.getElementById("donut-chart"), 
            {
                series: [stats.lolos_validasi, stats.sedang_revisi, stats.ditolak],
                colors: ["#10B981", "#FBBF24", "#EF4444"],
                chart: {
                    height: 250,
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


</script>

<script>
        if (document.getElementById("column-chart")) {
        const chart = new ApexCharts(document.getElementById("column-chart"), options);
        chart.render();
    }

    if (document.getElementById('ormawaChart')) {
        const ormawaCtx = document.getElementById('ormawaChart').getContext('2d');
        new Chart(ormawaCtx, {
            type: 'doughnut',
            data: {
                labels: @json($labels2),
                datasets: [{
                    data: @json($data2),
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