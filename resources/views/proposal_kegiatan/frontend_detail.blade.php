@extends('proposal_kegiatan\pengaju')

@section('konten')
<head>
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
                    <img src="img\LOGOPOLBAN4K.png" alt="Logo">
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
                <td class="px-4 py-2">Seminar Teknologi</td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2 font-medium text-gray-700">Tanggal Mulai Kegiatan</th>
                <td class="px-4 py-2">2024-01-15</td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2 font-medium text-gray-700">Tanggal Akhir Kegiatan</th>
                <td class="px-4 py-2">2024-01-16</td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2 font-medium text-gray-700">Tempat Kegiatan</th>
                <td class="px-4 py-2">Aula Kampus</td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2 font-medium text-gray-700">Kategori</th>
                <td class="px-4 py-2">Seminar</td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2 font-medium text-gray-700">Asal Ormawa</th>
                <td class="px-4 py-2">Himpunan Mahasiswa Informatika</td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2 font-medium text-gray-700">Pengisi Acara</th>
                <td class="px-4 py-2">Dr. John Doe</td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2 font-medium text-gray-700">Sponsorship</th>
                <td class="px-4 py-2">PT. Teknologi Masa Depan</td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2 font-medium text-gray-700">Media Partner</th>
                <td class="px-4 py-2">Tech Times</td>
            </tr>
        </table>

        <!-- Detail Dana -->
        <h2 class="text-xl font-bold text-gray-700 px-6 py-4 mt-8">Detail Dana</h2>
        <table class="table-auto w-full border border-gray-300">
            <tbody class="divide-y divide-gray-200">
                <tr>
                    <th class="text-left px-4 py-2 font-medium text-gray-700">Dana DIPA Polban</th>
                    <td class="px-4 py-2">Rp 5,000,000</td>
                </tr>
                <tr>
                    <th class="text-left px-4 py-2 font-medium text-gray-700">Dana Swadaya</th>
                    <td class="px-4 py-2">Rp 3,000,000</td>
                </tr>
                <tr>
                    <th class="text-left px-4 py-2 font-medium text-gray-700">Dana Sponsor</th>
                    <td class="px-4 py-2">Rp 2,000,000</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
