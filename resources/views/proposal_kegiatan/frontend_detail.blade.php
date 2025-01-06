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

<div class="container mx-auto mt-5">
    <div class="bg-white p-5 rounded shadow">
        <!-- Kop Surat -->
        <table class="kop-surat">
            <tr>
                <td style="width: 100px; text-align: center;">
                    <img src="{{ asset('img/LOGOPOLBAN4K.png') }}" alt="Logo">
                </td>
                <td>
                    <div class="isi-kop">
                        <h1>KEMENTERIAN PENDIDIKAN TINGGI, SAINS, DAN TEKNOLOGI</h1>
                        <h2>POLITEKNIK NEGERI BANDUNG</h2>
                        <h3>
                            Jalan Gegerkalong Hilir, Desa Ciwaruga, Kecamatan Parongpong,<br>
                            Kabupaten Bandung Barat 40559, Kotak Pos 1234, Telepon: (022) 2013789,<br>
                            Faksimile: (022) 2013889, Laman: www.polban.ac.id, Pos elektronik: polban@polban.ac.id
                        </h3>
                    </div>
                </td>
            </tr>
        </table>
        <hr>

        <!-- Detail Proposal -->
        <h1 class="text-xl font-bold text-gray-700 px-6 py-4 mt-8">Detail Kegiatan</h1>
        <table class="table-auto w-full">
            <tr>
                <th class="text-left px-4 py-2 font-medium text-gray-700">Nama Kegiatan</th>
                <td class="px-4 py-2">{{ $proposal->nama_kegiatan }}</td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2 font-medium text-gray-700">Tanggal Mulai Kegiatan</th>
                <td class="px-4 py-2">{{ $proposal->tanggal_mulai }}</td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2 font-medium text-gray-700">Tanggal Akhir Kegiatan</th>
                <td class="px-4 py-2">{{ $proposal->tanggal_akhir}}</td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2 font-medium text-gray-700">Tempat Kegiatan</th>
                <td class="px-4 py-2">{{ $proposal->tmpt_kegiatan}}</td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2 font-medium text-gray-700">Jenis Kegiatan</th>
                <td class="px-4 py-2">{{ $proposal->jenisKegiatan->nama_jenis_kegiatan}}</td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2 font-medium text-gray-700">Ormawa</th>
                <td class="px-4 py-2">{{ $proposal->ormawa->nama_ormawa}}</td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2 font-medium text-gray-700">Pengisi Acara</th>
                <td class="px-4 py-2">{{ $proposal->pengisi_acara}}</td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2 font-medium text-gray-700">Sponsorship</th>
                <td class="px-4 py-2">{{ $proposal->sponsorship}}</td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2 font-medium text-gray-700">Media Partner</th>
                <td class="px-4 py-2">{{ $proposal->media_partner}}</td>
            </tr>
        </table>

        <!-- Detail Dana -->
        <h2 class="text-xl font-bold text-gray-700 px-6 py-4 mt-8">Detail Dana</h2>
        <table class="table-auto w-full border border-gray-300">
            <tbody class="divide-y divide-gray-200">
                <tr>
                    <th class="text-left px-4 py-2 font-medium text-gray-700">Dana DIPA Polban</th>
                    <td>Rp {{ number_format($proposal->dana_dipa ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th class="text-left px-4 py-2 font-medium text-gray-700">Dana Swadaya</th>
                    <td>Rp {{ number_format($proposal->dana_swadaya ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th class="text-left px-4 py-2 font-medium text-gray-700">Dana Sponsor</th>
                    <td>Rp {{ number_format($proposal->dana_sponsor ?? 0, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
