@extends('proposal_kegiatan\reviewer')
@section('konten')

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

    <!-- Review Tables Section -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <!-- Tabs -->
        <div class="border-b border-gray-200 mb-6">
            <nav class="flex space-x-4" aria-label="Tabs">
                <button id="tab-proposal" class="tab-button px-4 py-2 text-sm font-medium rounded-t-lg border-b-2 border-blue-500 text-blue-600">
                    Daftar Review Proposal
                </button>
                <button id="tab-lpj" class="tab-button px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">
                    Daftar Review LPJ
                </button>
            </nav>
        </div>

        <!-- Success/Error Messages -->
        @if(Session::get('sukses'))
            <div id="alert-sukses" class="mb-4 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded">
                {{ Session::get('sukses') }}
            </div>
        @endif
        @if(Session::get('gagal'))
            <div id="alert-gagal" class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded">
                {{ Session::get('gagal') }}
            </div>
        @endif

        <!-- Table Contents -->
        <div id="content-proposal" class="tab-content">
            <div class="overflow-x-auto">
                <table id="myTable" class="w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Penyelenggara</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kegiatan</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Kegiatan</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pengajuan</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($proposals as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $item->pengguna->username }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $item->nama_kegiatan }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $status = $item->latestRevision ? $item->latestRevision->status_revisi : $item->status;
                                        $tahap = $item->latestRevision ? $item->latestRevision->id_dosen : 1;
                                    @endphp
                                    @if ($status == 0)
                                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                            Menunggu
                                        </span>
                                    @elseif ($status == 1 && $tahap < $sessionId)
                                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                            Menunggu
                                        </span>
                                    @elseif ($status == 1 && $tahap >= $sessionId)
                                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                            Disetujui
                                        </span>
                                    @elseif ($status == 2)
                                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                                            Ditolak
                                        </span>
                                    @elseif ($status == 3)
                                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                            Revisi
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $item->tanggal_mulai }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $item->created_at->format('Y-m-d') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('proposal.show', ['reviewProposal' => $item->id_proposal]) }}" 
                                       class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Review
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
                                    <span class="text-xs font-semibold leading-tight text-slate-400">{{ $item->tanggal_mulai }}</span>
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