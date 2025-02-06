@section('title', 'Event List')
@section('konten')

<head>
    <link href="{{ asset('css/soft-ui-dashboard-tailwind.css?v=1.0.5') }}" rel="stylesheet" />    
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.7/css/dataTables.dataTables.min.css" >

    {{-- tailwind cdn --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- jQuery filtering tabel - DHEA-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .kop-surat img {
            width: 80px;
            height: auto;
        }
        .kop-surat .isi-kop {
            text-align: center;
        }
        .kop-surat .isi-kop h1 {
            font-size: 16px;
            margin: 0;
        }
        .kop-surat .isi-kop h2 {
            font-size: 14px;
            margin: 5px 0;
        }
        .kop-surat .isi-kop h3 {
            font-size: 12px;
            margin: 5px 0;
            font-weight: normal;
        }
        .kop-surat hr {
            border: 0;
            border-top: 2px solid black;
            margin-top: 10px;
            width: 100%;
        }
        td, th {
            padding: 8px;
            font-size: 13px;
        }
        @media print {
            body {
                width: 210mm;
                height: 297mm;
                padding: 10mm;
            }
        }
    </style>
</head>

<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-5xl mx-auto">
        <!-- Header Card -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6">
            <!-- Kop Surat with modern styling -->
            <div class="p-6">
                <div class="flex items-center gap-6">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('img/LOGOPOLBAN4K.png') }}" alt="Logo" class="w-24 h-24 object-contain">
                    </div>
                    <div class="flex-1">
                        <div class="text-center">
                            <p class="text-gray-600 font-semibold text-sm tracking-wide">KEMENTERIAN PENDIDIKAN TINGGI, SAINS, DAN TEKNOLOGI</p>
                            <h1 class="text-xl font-bold text-gray-800 mt-1">POLITEKNIK NEGERI BANDUNG</h1>
                            <p class="text-gray-500 text-sm mt-2 leading-relaxed">
                                Jalan Gegerkalong Hilir, Desa Ciwaruga, Kecamatan Parongpong,<br>
                                Kabupaten Bandung Barat 40559, Kotak Pos 1234, Telepon: (022) 2013789,<br>
                                Faksimile: (022) 2013889, Laman: www.polban.ac.id, Pos elektronik: polban@polban.ac.id
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="h-px bg-gray-200"></div>
        </div>

        <!-- Detail Kegiatan Card -->
        <div class="bg-white rounded-xl shadow-sm mb-6 overflow-hidden">
            <div class="p-6">
                <h2 class="flex items-center text-lg font-semibold text-gray-800 mb-6">
                    <span class="w-1 h-6 bg-blue-500 rounded-full mr-3"></span>
                    Detail Kegiatan
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Activity Details -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-sm text-gray-500">Nama Kegiatan</p>
                        <p class="text-gray-800 font-medium">{{ $proposal->nama_kegiatan }}</p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-sm text-gray-500">Tanggal Mulai Kegiatan</p>
                        <p class="text-gray-800 font-medium">{{ $proposal->tanggal_mulai }}</p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-sm text-gray-500">Tanggal Akhir Kegiatan</p>
                        <p class="text-gray-800 font-medium">{{ $proposal->tanggal_akhir }}</p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-sm text-gray-500">Tempat Kegiatan</p>
                        <p class="text-gray-800 font-medium">{{ $proposal->tmpt_kegiatan }}</p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-sm text-gray-500">Jenis Kegiatan</p>
                        <p class="text-gray-800 font-medium">{{ $proposal->jenisKegiatan->nama_jenis_kegiatan }}</p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-sm text-gray-500">Ormawa</p>
                        <p class="text-gray-800 font-medium">{{ $proposal->ormawa->nama_ormawa }}</p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-sm text-gray-500">Pengisi Acara</p>
                        <p class="text-gray-800 font-medium">{{ $proposal->pengisi_acara }}</p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-sm text-gray-500">Sponsorship</p>
                        <p class="text-gray-800 font-medium">{{ $proposal->sponsorship }}</p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4 md:col-span-2">
                        <p class="text-sm text-gray-500">Media Partner</p>
                        <p class="text-gray-800 font-medium">{{ $proposal->media_partner }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Dana Card -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="p-6">
                <h2 class="flex items-center text-lg font-semibold text-gray-800 mb-6">
                    <span class="w-1 h-6 bg-green-500 rounded-full mr-3"></span>
                    Detail Dana
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Dana DIPA Card -->
                    <div class="bg-blue-50 rounded-xl p-4">
                        <h3 class="text-gray-600 text-sm mb-2">Dana DIPA Polban</h3>
                        <p class="text-blue-600 text-xl font-bold">
                            Rp {{ number_format($proposal->dana_dipa ?? 0, 0, ',', '.') }}
                        </p>
                    </div>

                    <!-- Dana Swadaya Card -->
                    <div class="bg-green-50 rounded-xl p-4">
                        <h3 class="text-gray-600 text-sm mb-2">Dana Swadaya</h3>
                        <p class="text-green-600 text-xl font-bold">
                            Rp {{ number_format($proposal->dana_swadaya ?? 0, 0, ',', '.') }}
                        </p>
                    </div>

                    <!-- Dana Sponsor Card -->
                    <div class="bg-purple-50 rounded-xl p-4">
                        <h3 class="text-gray-600 text-sm mb-2">Dana Sponsor</h3>
                        <p class="text-purple-600 text-xl font-bold">
                            Rp {{ number_format($proposal->dana_sponsor ?? 0, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
