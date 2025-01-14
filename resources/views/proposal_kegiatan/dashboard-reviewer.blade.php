@extends('proposal_kegiatan\reviewer')
@section('title', 'Dashboard')
@section('konten')

<title>@yield('title', 'Dashboard')</title>

<!-- Main Dashboard Container -->
<div class="min-h-screen bg-gray-50 p-4 lg:p-8">
    <!-- Welcome Section -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Dashboard Reviewer</h1>
        @if (session()->has('username') && session()->has('id'))
            <p class="text-gray-600">Selamat datang, <span class="font-medium text-indigo-600">{{ session('username') }}</span></p>
        @else
            <p class="text-gray-600">Anda belum login.</p>
        @endif
    </div>

    <!-- Notification Section -->
    @if(!$notifications->isEmpty())
        <div class="mb-8">
            <div class="bg-amber-50 border-l-4 border-amber-500 p-4 rounded-lg">
                <div class="flex items-center">
                    <svg class="h-6 w-6 text-amber-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <h2 class="text-lg font-semibold text-amber-800">Notifikasi Review Terlambat</h2>
                </div>
                @foreach($notifications as $notification)
                    <p class="mt-2 text-amber-700">{{ $notification }}</p>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Statistics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Chart Card 1 -->
        <div class="bg-white rounded-xl shadow-sm p-6 transition-all duration-200 hover:shadow-md">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-3">
                    <div class="p-3 bg-blue-50 rounded-lg">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">Statistik Waktu Pelaksanaan</h3>
                </div>
                <div class="text-sm text-gray-500">
                    Total: {{ $totalDisetujui + $totalDitolak }}
                </div>
            </div>
            <div id="column-chart" class="h-[300px]"></div>
        </div>

        <!-- Chart Card 2 -->
        <div class="bg-white rounded-xl shadow-sm p-6 transition-all duration-200 hover:shadow-md">
            <div class="flex items-center space-x-3 mb-6">
                <div class="p-3 bg-purple-50 rounded-lg">
                    <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800">Statistik Kegiatan Ormawa</h3>
            </div>
            <div class="relative h-[300px]">
                <canvas id="ormawaChart"></canvas>
            </div>
        </div>
    </div>
</div>

    <!-- ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.44.0/apexcharts.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
      // Konfigurasi ApexCharts
    const options = {
        colors: ["#1A56DB", "#FDBA8C"],
        series: [
            {
                name: "Disetujui",
                color: "#1A56DB",
                data: @json($data1Disetujui), // Data untuk status 1
            },
            {
                name: "Ditolak",
                color: "#FDBA8C",
                data: @json($data1Ditolak), // Data untuk status 2
            },
        ],
        chart: {
            type: "bar",
            height: "320px",
            fontFamily: "Inter, sans-serif",
            toolbar: {
                show: false,
            },
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "70%",
                borderRadiusApplication: "end",
                borderRadius: 8,
            },
        },
        tooltip: {
            shared: true,
            intersect: false,
            style: {
                fontFamily: "Inter, sans-serif",
            },
        },
        states: {
            hover: {
                filter: {
                    type: "darken",
                    value: 1,
                },
            },
        },
        stroke: {
            show: true,
            width: 0,
            colors: ["transparent"],
        },
        grid: {
            show: false,
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
            show: true, // Menampilkan legend
        },
        xaxis: {
            floating: false,
            categories: @json($labels1), // Menggunakan data labels dari controller
            labels: {
                show: true,
                style: {
                    fontFamily: "Inter, sans-serif",
                    cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
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
                text: "Jumlah Proposal", // Judul sumbu Y
                style: {
                    fontFamily: "Inter, sans-serif",
                }
            },
            show: true,
        },
        fill: {
            opacity: 1,
        },
    };

    // Menginisialisasi chart
    const chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();

        // Inisialisasi ApexCharts
        if (document.getElementById("column-chart") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("column-chart"), options);
            chart.render();
        }


        // Chart Kegiatan Ormawa (Chart.js)
        const ormawaCtx = document.getElementById('ormawaChart').getContext('2d');
        new Chart(ormawaCtx, {
            type: 'doughnut',
            data: {
                labels: @json($labels2), // Menggunakan data labels dari controller (grafik status 1)
                datasets: [{
                    data: @json($data2), // Menggunakan data totals dari controller (grafik status 1)
                    backgroundColor: [
                        '#3B82F6',
                        '#FB7185',
                        '#F97316',
                        '#FBBF24',
                        '#34D399' // Tambahkan warna sesuai kebutuhan
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw; // Menampilkan label dan data
                            }
                        }
                    }
                }
            }
        });

         // Mendapatkan elemen dropdown untuk tahun

    </script>

<!-- Script DataTables -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
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