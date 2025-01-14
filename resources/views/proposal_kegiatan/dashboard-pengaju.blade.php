@extends('proposal_kegiatan/pengaju')
@section('title', 'Dashboard')
@section('konten')

<div class="min-h-screen bg-gray-50 py-8">
    <!-- Header Section with User Info -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-sm p-6 mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Dashboard Pengaju</h1>
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

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Statistics Cards -->
            <div class="space-y-6">
                <!-- Total Proposal Card -->
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Statistik Proposal</h2>
                    
                    <!-- Status Cards -->
                    <div class="space-y-4">
                        <!-- Lolos Validasi -->
                        <div class="flex items-center bg-green-50 p-4 rounded-xl">
                            <div class="p-3 bg-green-100 rounded-lg mr-4">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-green-900">Lolos Validasi</p>
                                <p class="text-2xl font-bold text-green-700">{{ $proposalStats['lolos_validasi'] }}</p>
                            </div>
                        </div>

                        <!-- Sedang Revisi -->
                        <div class="flex items-center bg-yellow-50 p-4 rounded-xl">
                            <div class="p-3 bg-yellow-100 rounded-lg mr-4">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-yellow-900">Sedang Revisi</p>
                                <p class="text-2xl font-bold text-yellow-700">{{ $proposalStats['sedang_revisi'] }}</p>
                            </div>
                        </div>

                        <!-- Ditolak -->
                        <div class="flex items-center bg-red-50 p-4 rounded-xl">
                            <div class="p-3 bg-red-100 rounded-lg mr-4">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-red-900">Ditolak</p>
                                <p class="text-2xl font-bold text-red-700">{{ $proposalStats['ditolak'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Donut Chart -->
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Visualisasi Statistik</h2>
                    <div id="donut-chart" class="w-full h-64"></div>
                </div>
            </div>

            <!-- Right Column - Documents -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-lg font-semibold text-gray-900">Daftar Pedoman</h2>
                        <span class="text-sm text-gray-500">{{ count($documents) }} dokumen</span>
                    </div>

                    <div class="space-y-4 max-h-[calc(100vh-24rem)] overflow-y-auto pr-2">
                        @foreach($documents as $document)
                        <div class="group flex items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-all duration-200">
                            <!-- PDF Preview -->
                            <div class="relative">
                                <canvas id="pdf-thumbnail-{{ $loop->index }}" 
                                    class="w-16 h-16 rounded-lg object-cover border border-gray-200">
                                </canvas>
                                <div class="absolute inset-0 bg-gray-900 bg-opacity-40 rounded-lg flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </div>
                            </div>

                            <!-- Document Info -->
                            <div class="flex-1 ml-4">
                                <h3 class="text-lg font-medium text-gray-900">{{ $document->nama_pedoman }}</h3>
                                <p class="text-sm text-gray-500 mt-1">PDF Document</p>
                            </div>

                            <!-- Action Button -->
                            <a href="{{ asset($document->file_pedoman) }}" 
                               target="_blank"
                               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Lihat Dokumen
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // PDF Thumbnail Generation
    document.addEventListener('DOMContentLoaded', function() {
        @foreach($documents as $document)
        (function(index) {
            const url = "{{ asset($document->file_pedoman) }}";
            pdfjsLib.getDocument(url).promise.then(pdf => {
                pdf.getPage(1).then(page => {
                    const canvas = document.getElementById('pdf-thumbnail-' + index);
                    const context = canvas.getContext('2d');
                    const viewport = page.getViewport({ scale: 0.5 });
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;
                    page.render({ canvasContext: context, viewport: viewport });
                });
            }).catch(error => {
                console.error("Error loading PDF:", error);
            });
        })({{ $loop->index }});
        @endforeach
    });

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
@endsection