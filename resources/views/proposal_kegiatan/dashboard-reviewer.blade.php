@extends('welcome')
@section('konten')
<h1>Selamat datang di Dashboard Dosen</h1>

<h1>Welcome to the Dashboardd, {{ $username }}</h1>
<p>Your role is: {{ $role }}</p>

<!-- Link Tailwind CSS dan FontAwesome untuk ikon -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">


    <div class="p-4 sm:p-6 lg:p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Statistik Waktu Pelaksanaan Card -->
            <div class="bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center me-3">
                            <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 19">
                                <path d="M14.5 0A3.987 3.987 0 0 0 11 2.1a4.977 4.977 0 0 1 3.9 5.858A3.989 3.989 0 0 0 14.5 0ZM9 13h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z"/>
                                <path d="M5 19h10v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2ZM5 7a5.008 5.008 0 0 1 4-4.9 3.988 3.988 0 1 0-3.9 5.859A4.974 4.974 0 0 1 5 7Zm5 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm5-1h-.424a5.016 5.016 0 0 1-1.942 2.232A6.007 6.007 0 0 1 17 17h2a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5ZM5.424 9H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h2a6.007 6.007 0 0 1 4.366-5.768A5.016 5.016 0 0 1 5.424 9Z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold mb-4">Statistik Waktu Pelaksanaan</h2>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2">
                    <dl class="flex items-center">
                        <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal me-1">Total Pengajuan: {{ $totalDisetujui + $totalDitolak }}</dt>
                        <dd class="text-gray-900 text-sm dark:text-white font-semibold"></dd>
                    </dl>
                    <dl class="flex items-center justify-end">
                        <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal me-1">Rata-rata/bulan: {{ round(($totalDisetujui + $totalDitolak) / 12) }}</dt>
                    </dl>
                </div>

                <div id="column-chart"></div>
            </div>

            <!-- Statistik Kegiatan Ormawa -->
            <div class="bg-gray-100 rounded-lg shadow-sm p-6">
                <h2 class="text-lg font-semibold mb-4">Statistik Kegiatan Ormawa</h2>
                <div class="relative" style="height: 300px;">
                    <canvas id="ormawaChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Tabel Menunggu Review -->
        <!-- Tabel Menunggu Review -->
<div class="mt-6 bg-white rounded-lg shadow-sm">
    <div class="p-6">
    <div class="container mx-auto mt-4">
    <!-- Heading dan Tombol Add New -->
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-xl font-bold">Menunggu Review</h3>
        
        {{-- alert sukses kirim form --}}
        @if(Session::get('sukses'))
            <div id="alert-sukses" class="bg-green-500 text-white px-4 py-2 rounded">
                {{ Session::get('sukses') }}
            </div>
        @endif
        @if(Session::get('gagal'))
            <div id="alert-gagal" class="bg-red-500 text-white px-4 py-2 rounded">
                {{ Session::get('gagal') }}
            </div>
        @endif
        <script>
            // Fungsi untuk menghilangkan alert setelah 3 detik
            setTimeout(() => {
                const suksesAlert = document.getElementById('alert-sukses');
                const gagalAlert = document.getElementById('alert-gagal');
                if (suksesAlert) {
                    suksesAlert.style.display = 'none';
                }
                if (gagalAlert) {
                    gagalAlert.style.display = 'none';
                }
            }, 3000); // 3000 ms = 3 detik
        </script>
    </div>
        <table id="myTable" class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                    <tr class="w-full bg-gray-100 text-gray-700 uppercase text-sm leading-normal">
                        <th class="max-w-[10px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">No</th>
                        <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Penyelenggara</th>
                        <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama kegiatan</th>
                        <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                        <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal Kegiatan</th>
                        <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal Pengajuan</th>
                        <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($proposal as $item)
                      <tr>
                        <td class="px-3 py-2 text-center border-b border-gray-200">{{ $loop->iteration }}</td>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                          <div class="flex px-2 py-1">
                            <div class="flex flex-col justify-center">
                              {{-- <h6 class="mb-0 text-sm leading-normal">{{ $item->pengguna->nama_pengguna }}</h6> --}}
                              <!-- <p class="mb-0 text-xs leading-tight text-slate-400">john@creative-tim.com</p> -->
                            </div>
                          </div>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                          <p class="mb-0 text-xs font-semibold leading-tight">{{ $item->nama_kegiatan }}</p>
                          <!-- <p class="mb-0 text-xs leading-tight text-slate-400">Organization</p> -->
                        </td>
                        <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            @if ($item->status == 0)
                                <span class="bg-gradient-to-tl from-yellow-500 to-yellow-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                    Menunggu
                                </span>
                            @elseif ($item->status == 1)
                                <span class="bg-gradient-to-tl from-green-600 to-lime-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                    Disetujui
                                </span>
                            @elseif ($item->status == 2)
                                <span class="bg-gradient-to-tl from-red-600 to-red-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                    Ditolak
                                </span>
                            @elseif ($item->status == 3)
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
                            <a href="{{ route('proposal.show', ['reviewProposal' => $item->id_proposal]) }}" onclick="logProposalId({{ $item->id }})" class="mb-0 text-xs font-semibold leading-tight text-blue-500 hover:underline">Review</a>
                        </td>
                    </tr>
                      
                      @endforeach
                    </tbody>
        </table>
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
</script>
@endsection