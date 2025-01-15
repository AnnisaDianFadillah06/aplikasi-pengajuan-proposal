@extends('proposal_kegiatan\reviewer')
@section('title', 'Dashboard')
@section('konten')

<title>@yield('title', 'Dashboard')</title>

<!-- Main Dashboard Container -->
<div class="min-h-screen bg-gray-50 py-8">
    <!-- Header Section with User Info -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Top Navigation Bar -->
        <div class="bg-white rounded-2xl shadow-sm p-6 mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Dashboard Reviewer</h1>
                @if (session()->has('username') && session()->has('id'))
                    <p class="mt-1 text-sm text-gray-600">
                        Selamat datang, {{ session('username') }}
                    </p>
                @else
                    <p>Anda belum login.</p>
                @endif
            </div>
            @if (session()->has('ormawa'))
                <div class="bg-blue-50 p-4 rounded-xl">
                    <p class="text-sm font-medium text-blue-700">{{ session('ormawa') }}</p>
                    {{-- <p class="text-xs text-blue-600">ID: {{ session('id') }}</p>
                    <p class="text-xs text-blue-600">ID ORMAWA: {{ session('id_ormawa') }}</p> --}}
                </div>
            @endif
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Notification Section -->
        @if(!$notifications->isEmpty())
            <div class="mb-8">
                <div class="bg-white border-l-4 border-amber-500 rounded-lg shadow-md overflow-hidden">
                    <div class="p-5">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h2 class="text-lg font-semibold text-gray-900">Notifikasi Review Terlambat</h2>
                                <p class="text-sm text-gray-500">Terdapat beberapa review yang memerlukan perhatian Anda</p>
                            </div>
                        </div>
                        <div class="space-y-3">
                            @foreach($notifications as $notification)
                                <div class="flex items-center bg-amber-50 rounded-lg p-3">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <p class="ml-3 text-sm text-amber-700">{{ $notification }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Statistics Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
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
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.44.0/apexcharts.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
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

    // Initialize Charts
    if (document.getElementById("column-chart")) {
        const chart = new ApexCharts(document.getElementById("column-chart"), options);
        chart.render();
    }

    // Chart.js Configuration
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

    // DataTables Configuration
    $(document).ready(function() {
        const tableConfig = {
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            lengthMenu: [5, 10, 25, 50],
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ entri",
                info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                infoEmpty: "Menampilkan 0 hingga 0 dari 0 entri",
                infoFiltered: "(disaring dari _MAX_ total entri)",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                }
            },
            drawCallback: function() {
                adjustSelectWidth();
            }
        };

        $('#myTable, #myTable2').DataTable(tableConfig);

        function adjustSelectWidth() {
            $('.dataTables_length select').each(function() {
                const text = $(this).find('option:selected').text();
                $(this).css('width', (text.length + 4) + 'ch');
            });
        }

        adjustSelectWidth();
        $('.dataTables_length select').change(adjustSelectWidth);
    });
</script>
@endsection