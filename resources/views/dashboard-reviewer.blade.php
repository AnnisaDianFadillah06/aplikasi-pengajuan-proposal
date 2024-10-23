@extends('welcome')
@section('konten')

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>



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
                            <h5 class="leading-none text-2xl font-bold text-gray-900 dark:text-white pb-1">20</h5>
                            <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Kegiatan Minggu Ini</p>
                        </div>
                    </div>
                    <div>
                        <span class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md dark:bg-green-900 dark:text-green-300">
                            <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4"/>
                            </svg>
                            42.5%
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-2">
                    <dl class="flex items-center">
                        <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal me-1">Total Kegiatan:</dt>
                        <dd class="text-gray-900 text-sm dark:text-white font-semibold">85</dd>
                    </dl>
                    <dl class="flex items-center justify-end">
                        <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal me-1">Rata-rata/bulan:</dt>
                        <dd class="text-gray-900 text-sm dark:text-white font-semibold">21.25</dd>
                    </dl>
                </div>

                <div id="column-chart"></div>

                <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                    <div class="flex justify-between items-center pt-5">
                        <button
                            id="dropdownDefaultButton"
                            data-dropdown-toggle="lastDaysdropdown"
                            class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
                            type="button">
                            Last 7 days
                            <svg class="w-2.5 m-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                        <div id="lastDaysdropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Yesterday</a></li>
                                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Today</a></li>
                                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 7 days</a></li>
                                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 30 days</a></li>
                                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 90 days</a></li>
                            </ul>
                        </div>
                        <a href="#" class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500 hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                            Laporan Lengkap
                            <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                        </a>
                    </div>
                </div>
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
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Menunggu Review</h2>
            <div class="flex items-center space-x-4">
                <!-- Show entries dropdown -->
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-500">Show</span>
                    <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span class="text-sm text-gray-500">entries</span>
                </div>
                <!-- Search input -->
                <div class="relative">
                    <input type="text" placeholder="Search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Tanggal Diajukan</th>
                        <th scope="col" class="px-6 py-3">Tanggal Review</th>
                        <th scope="col" class="px-6 py-3">Nama Kegiatan</th>
                        <th scope="col" class="px-6 py-3">Ormawa</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 7; $i++)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">11/01/2024</td>
                        <td class="px-6 py-4">3 hari</td>
                        <td class="px-6 py-4">Studi Banding</td>
                        <td class="px-6 py-4">UKM Robotika</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <button class="text-gray-500 hover:text-gray-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                                <button class="text-gray-500 hover:text-gray-700">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex items-center justify-between pt-4">
            <div class="text-sm text-gray-700">
                Showing data 1 to 8 of 255k entries
            </div>
            <div class="flex items-center space-x-2">
                <button class="px-3 py-1 bg-blue-500 text-white rounded-lg">1</button>
                <button class="px-3 py-1 text-gray-500 hover:bg-gray-100 rounded-lg">2</button>
                <button class="px-3 py-1 text-gray-500 hover:bg-gray-100 rounded-lg">3</button>
                <button class="px-3 py-1 text-gray-500 hover:bg-gray-100 rounded-lg">4</button>
                <button class="px-3 py-1 text-gray-500 hover:bg-gray-100 rounded-lg">Selanjutnya</button>
            </div>
        </div>
    </div>
</div>


    
    <script>
        // Konfigurasi ApexCharts
        const options = {
            colors: ["#1A56DB", "#FDBA8C"],
            series: [
                {
                    name: "Terlaksana",
                    color: "#1A56DB",
                    data: [
                        { x: "Jan", y: 15 },
                        { x: "Feb", y: 12 },
                        { x: "Mar", y: 18 },
                        { x: "Apr", y: 21 },
                        { x: "Mei", y: 12 },
                        { x: "Jun", y: 23 },
                        { x: "Jul", y: 11 },
                    ],
                },
                {
                    name: "Menunggu",
                    color: "#FDBA8C",
                    data: [
                        { x: "Jan", y: 12 },
                        { x: "Feb", y: 13 },
                        { x: "Mar", y: 11 },
                        { x: "Apr", y: 14 },
                        { x: "Mei", y: 22 },
                        { x: "Jun", y: 11 },
                        { x: "Jul", y: 13 },
                    ],
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
                    top: -14
                },
            },
            dataLabels: {
                enabled: false,
            },
            legend: {
                show: false,
            },
            xaxis: {
                floating: false,
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
                show: false,
            },
            fill: {
                opacity: 1,
            },
        };

        // Inisialisasi ApexCharts
        if(document.getElementById("column-chart") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("column-chart"), options);
            chart.render();
        }

        // Chart Kegiatan Ormawa (Chart.js)
        const ormawaCtx = document.getElementById('ormawaChart').getContext('2d');
        new Chart(ormawaCtx, {
            type: 'doughnut',
            data: {
                labels: ['HMJ_Teknik Kimia', 'UKM Robotika', 'BEM'],
                datasets: [{
                    data: [60, 20, 20],
                    backgroundColor: [
                        '#3B82F6',
                        '#FB7185',
                        '#F97316'
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
                    }
                }
            }
        });
    </script>


@endsection