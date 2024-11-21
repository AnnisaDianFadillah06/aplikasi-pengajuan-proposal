@extends('welcome')
@section('konten')

{{-- Cek apakah ada sesi login dan tampilkan data pengguna --}}
@if (session()->has('username') && session()->has('id'))
    <p>Selamat datang, {{ session('username') }}!</p>
    <p>id Anda: {{ session('id') }}</p>
@else
    <p>Anda belum login.</p>
@endif

<div class="flex justify-between p-8">
    <!-- Left Section: Daftar Pedoman -->
    <div class="w-1/2">
        <h2 class="text-2xl font-bold mb-4">Daftar Pedoman</h2>
        <!-- Container with white background and scrollbar -->
        <div class="bg-white p-4 rounded-xl shadow-md max-h-screen overflow-y-scroll space-y-9">
        @foreach($documents as $document)
        <!-- Card untuk setiap dokumen -->
        <div class="bg-gray-100 p-4 rounded-xl flex items-center mb-4">
            <!-- Thumbnail Canvas untuk Halaman Pertama PDF -->
            <canvas id="pdf-thumbnail-{{ $loop->index }}" class="w-16 h-16 mr-4"></canvas>
            <div class="mr-4">
                <h3 class="text-lg font-semibold">{{ $document->nama_pedoman }}</h3>
                <p class="text-sm text-gray-600"></p>
                <a href="{{ asset($document->file_pedoman) }}" class="btn btn-primary mt-2" target="_blank">Lihat Dokumen</a>
            </div>
        </div>

        <script>
    document.addEventListener('DOMContentLoaded', function() {
        const url = "{{ asset($document->file_pedoman) }}";
        
        // Tampilkan URL di console
        console.log("URL PDF:", url);

        pdfjsLib.getDocument(url).promise.then(pdf => {
            pdf.getPage(1).then(page => {
                const canvas = document.getElementById('pdf-thumbnail-{{ $loop->index }}');
                const context = canvas.getContext('2d');
                const viewport = page.getViewport({ scale: 0.5 }); // Atur skala sesuai kebutuhan

                canvas.height = viewport.height;
                canvas.width = viewport.width;

                page.render({ canvasContext: context, viewport: viewport });
            });
        }).catch(error => {
            console.error("Error loading PDF:", error);
        });
    });
</script>
    @endforeach

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
    series: [2, 1, 1], // Adjusted series for your data
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