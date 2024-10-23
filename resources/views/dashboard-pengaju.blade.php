@extends('welcome')
@section('konten')

<div class="flex justify-between p-8">
    <!-- Left Section: Daftar Pedoman -->
    <div class="w-1/2">
        <h2 class="text-2xl font-bold mb-4">Daftar Pedoman</h2>
        <!-- Container with white background and scrollbar -->
        <div class="bg-white p-4 rounded-xl shadow-md max-h-screen overflow-y-scroll space-y-9">
            <!-- Card 1 -->
            <div class="bg-gray-100 p-4 rounded-xl flex items-center">
                <img src="/path-to-logo.png" alt="Logo" class="w-16 h-16 mr-4">
                <div>
                    <h3 class="text-lg font-semibold">Panduan Kegiatan Kemahasiswaan Polban</h3>
                    <p class="text-sm text-gray-600">11/01/2024 - WD 3</p>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="bg-gray-100 p-4 rounded-xl flex items-center">
                <img src="/path-to-logo.png" alt="Logo" class="w-16 h-16 mr-4">
                <div>
                    <h3 class="text-lg font-semibold">SOP Administrasi Polban</h3>
                    <p class="text-sm text-gray-600">11/01/2024 - BEM</p>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="bg-gray-100 p-4 rounded-xl flex items-center">
                <img src="/path-to-logo.png" alt="Logo" class="w-16 h-16 mr-4">
                <div>
                    <h3 class="text-lg font-semibold">Format LPJ</h3>
                    <p class="text-sm text-gray-600">11/01/2024 - BEM</p>
                </div>
            </div>
            <div class="bg-gray-100 p-4 rounded-xl flex items-center">
                <img src="/path-to-logo.png" alt="Logo" class="w-16 h-16 mr-4">
                <div>
                    <h3 class="text-lg font-semibold">Format LPJ</h3>
                    <p class="text-sm text-gray-600">11/01/2024 - BEM</p>
                </div>
            </div>
            <div class="bg-gray-100 p-4 rounded-xl flex items-center">
                <img src="/path-to-logo.png" alt="Logo" class="w-16 h-16 mr-4">
                <div>
                    <h3 class="text-lg font-semibold">Format LPJ</h3>
                    <p class="text-sm text-gray-600">11/01/2024 - BEM</p>
                </div>
            </div>
            <div class="bg-gray-100 p-4 rounded-xl flex items-center">
                <img src="/path-to-logo.png" alt="Logo" class="w-16 h-16 mr-4">
                <div>
                    <h3 class="text-lg font-semibold">Format LPJ</h3>
                    <p class="text-sm text-gray-600">11/01/2024 - BEM</p>
                </div>
            </div>
            <div class="bg-gray-100 p-4 rounded-xl flex items-center">
                <img src="/path-to-logo.png" alt="Logo" class="w-16 h-16 mr-4">
                <div>
                    <h3 class="text-lg font-semibold">Format LPJ</h3>
                    <p class="text-sm text-gray-600">11/01/2024 - BEM</p>
                </div>
            </div>
            <div class="bg-gray-100 p-4 rounded-xl flex items-center">
                <img src="/path-to-logo.png" alt="Logo" class="w-16 h-16 mr-4">
                <div>
                    <h3 class="text-lg font-semibold">Format LPJ</h3>
                    <p class="text-sm text-gray-600">11/01/2024 - BEM</p>
                </div>
            </div>
            <div class="bg-gray-100 p-4 rounded-xl flex items-center">
                <img src="/path-to-logo.png" alt="Logo" class="w-16 h-16 mr-4">
                <div>
                    <h3 class="text-lg font-semibold">Format LPJ</h3>
                    <p class="text-sm text-gray-600">11/01/2024 - BEM</p>
                </div>
            </div>
            <div class="bg-gray-100 p-4 rounded-xl flex items-center">
                <img src="/path-to-logo.png" alt="Logo" class="w-16 h-16 mr-4">
                <div>
                    <h3 class="text-lg font-semibold">Format LPJ</h3>
                    <p class="text-sm text-gray-600">11/01/2024 - BEM</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Section: Countdown and Statistics -->
    <div class="w-1/3 space-y-4">
        <!-- Countdown Timer -->
        <div class="bg-orange-400 text-white rounded-xl p-4 text-center">
            <h2 class="text-xl font-semibold mb-2">Pengajuan Kegiatan Dibuka Dalam</h2>
            <div class="text-3xl font-bold">1 Hours 59 Minutes 59 Seconds</div>
        </div>

        <!-- Statistics Chart -->
        <div class="bg-grayish-white p-4 rounded-xl shadow-md">
    <h2 class="text-xl font-semibold mb-4">Statistik Proposal Kegiatan</h2>
    <div class="flex items-center justify-center">
        <div id="donut-chart" class="relative w-64 h-64"></div> <!-- Adjusted size -->
    </div>
    <div class="mt-4 text-center">
        <p class="text-sm"><span class="text-blue-500">60%</span> Lolos Validasi</p>
        <p class="text-sm"><span class="text-orange-400">20%</span> Sedang Revisi</p>
        <p class="text-sm"><span class="text-pink-500">20%</span> Ditolak</p>
    </div>
</div>



<script>
const getChartOptions = () => {
  return {
    series: [60, 20, 20], // Adjusted series for your data
    colors: ["#1C64F2", "#FDBA8C", "#E74694"], // Colors match your proposal statuses
    chart: {
      height: 320,
      width: "100%",
      type: "donut",
    },
    stroke: {
      colors: ["transparent"],
    },
    plotOptions: {
      pie: {
        donut: {
          labels: {
            show: true,
            name: {
              show: true,
              fontFamily: "Inter, sans-serif",
              offsetY: 20,
            },
            total: {
              showAlways: true,
              show: true,
              label: "Total Proposals",
              fontFamily: "Inter, sans-serif",
              formatter: function (w) {
                const sum = w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                return sum + ' proposals'; // Display total proposals
              },
            },
            value: {
              show: true,
              fontFamily: "Inter, sans-serif",
              offsetY: -20,
              formatter: function (value) {
                return value + "%"; // Show value as percentage
              },
            },
          },
          size: "80%",
        },
      },
    },
    labels: ["Lolos Validasi", "Sedang Revisi", "Ditolak"], // Custom labels
    dataLabels: {
      enabled: false,
    },
    legend: {
      position: "bottom",
      fontFamily: "Inter, sans-serif",
    },
    grid: {
      padding: {
        top: -2,
      },
    },
  };
};

if (document.getElementById("donut-chart") && typeof ApexCharts !== 'undefined') {
  const chart = new ApexCharts(document.getElementById("donut-chart"), getChartOptions());
  chart.render();
}
</script>


</body>

</html>
@endsection