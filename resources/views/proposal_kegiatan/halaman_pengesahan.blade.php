<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lembar Pengesahan</title>

    {{-- <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v={{ time() }}"> --}}

    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
        }
        .kop-surat {
            display: flex;
            align-items: flex-start; /* Pastikan elemen sejajar dari atas */
            margin-bottom: 20px;
            padding: 20px 20px 0 20px; /* Ruang di sekitar kop */
            position: relative; /* Untuk mengatur elemen di dalamnya */
        }
        .kop-surat .logo img {
            width: 80px;
            height: auto;
            margin-top: -10px;
            margin-right: 20px; /* Jarak dengan isi kop */
        }
        .kop-surat .isi-kop {
            text-align: center;
            flex-grow: 1;
            margin-top: -150px;
            margin-left: 50px;
        }
        .kop-surat .isi-kop h1{
            font-size: 16px !important;
            text-align: center;
            margin: 0;
            font-weight: normal;
        }
        .kop-surat .isi-kop h2{
            font-size: 14px !important;
            text-align: center;
            margin: 5px 0;
        }
        .kop-surat .isi-kop h3{
            font-size: 12px !important;
            text-align: center;
            margin: 5px 0;
            font-weight: normal;
            margin-left: 10px
        }
        .kop-surat hr {
            border: 0;
            border-top: 2px solid black; /* Ketebalan garis */
            margin-top: 10px;
            width: 100%; /* Membuat garis memanjang ke seluruh lebar container */
            position: absolute; /* Untuk memastikan hr tetap */
            left: 0; /* Mulai dari ujung kiri container */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            /* margin-top: 20px; */
            font-size: 14px;
        }

        table th {
            background-color: #f2f2f2;
        }

        .validasi-status {
            text-align: center;
            width: 150px; /* Sesuaikan lebar kolom status */
        }
        /* Menyesuaikan layout dengan ukuran kertas */
        @media print {
            body {
                width: 210mm;
                height: 297mm;
                padding: 10mm;
            }
            .kop-surat {
                margin-bottom: 30px;
            }
        }

        p, td{
            font-size: 13px;
        }
    </style>

</head>
<body>

    <div class="kop-surat">
        <div class="logo">
            <img src="" height="100" width="100" alt="Logo">
        </div>
        <div class="isi-kop">
            {{-- <h1 style="font-size: 20px !important; text-align: center; margin: 0; font-weight: normal;">KEMENTERIAN PENDIDIKAN TINGGI, SAINS,<br> DAN TEKNOLOGI</h1> --}}
            <h1>KEMENTERIAN PENDIDIKAN TINGGI, SAINS, DAN TEKNOLOGI</h1>
            <h2>POLITEKNIK NEGERI BANDUNG</h2>
            <h3>
                Jalan Gegerkalong Hilir, Desa Ciwaruga, Kecamatan Parongpong,<br>
                Kabupaten Bandung Barat 40559, Kotak Pos 1234, Telepon: (022) 2013789,<br>
                Faksimile: (022) 2013889, Laman: www.polban.ac.id,  Pos elektronik: polban@polban.ac.id
            </h3>
            <hr>
        </div>
    </div>

    <div class="isi-surat">
        <div class="pembukaan">
            <h4 style="text-align: center">LEMBAR PENGESAHAN BERKEGIATAN</h4>
            @foreach ($pengajuans as $pengajuan)
            <p class="sm-10">
                Dengan ini, menyatakan bahwa kegiatan:
            </p>
            <table>
                <tr>
                    <td> Nama Kegiatan</td>
                    <td>:</td>
                    <td>{{ $pengajuan->Nama_Kegiatan }}</td>
                </tr>
                <tr>
                    <td> Jenis Kegiatan</td>
                    <td>:</td>
                    <td>{{ $pengajuan->Jenis_Kegiatan}}</td>
                </tr>
                <tr>
                    <td> Bidang Kegiatan</td>
                    <td>:</td>
                    <td>{{ $pengajuan->Bidang_Kegiatan }}</td>
                </tr>
                <tr>
                    <td> Tanggal Pelaksanaan</td>
                    <td>:</td>
                    <td>{{ $pengajuan->Tanggal_Pelaksanaan }}</td>
                </tr>
                <tr>
                    <td> Tempat Pelaksanaan</td>
                    <td>:</td>
                    <td>{{ $pengajuan->Tempat_Pelaksanaan }}</td>
                </tr>
                <tr>
                    <td> Nama Pengaju</td>
                    <td>:</td>
                    <td>{{ $pengajuan->Nama_Pengaju }}</td>
                </tr>
                <tr>
                    <td> NIM Pengaju</td>
                    <td>:</td>
                    <td>{{ $pengajuan->NIM_Pengaju }}</td>
                </tr>
                <tr>
                    <td> Organisasi Asal Pengaju</td>
                    <td>:</td>
                    <td>{{ $pengajuan->Organisasi_Asal_Pengaju }}</td>
                </tr>
            </table>
            <p>
                Telah disetujui oleh para validator dengan rincian sebagai berikut:
            </p>
            @endforeach
        </div>

        <div class="keterangan">
            <table class="validasi">
                <thead>
                    <tr>
                        <th style="border: 1px solid black;">NO</th>
                        <th style="border: 1px solid black;">NAMA VALIDATOR</th>
                        <th class="validasi-status" style="border: 1px solid black;">WAKTU DIVALIDASI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengajuans as $pengajuan)
                        {{-- @php
                            $isUKM = strtolower($pengajuan->Organisasi_Asal_Pengaju) === 'ukm';
                            $currentValidators = $isUKM ? $validators['UKM'] : $validators['non-UKM'];
                        @endphp --}}
                        @php
                            // Periksa apakah organisasi adalah UKM
                            $isUKM = str_starts_with(strtolower($pengajuan->Organisasi_Asal_Pengaju), 'ukm');
                            $currentValidators = $isUKM ? $validators['UKM'] ?? ['Badan Eksekutif Mahasiswa Politeknik Negeri Bandung', 'Pembina UKM', 'Koordinator Layanan Internal', 'Wakil Direktur Bidang Kemahasiswaan'] : 
                            $validators['non-UKM'] ?? ['Badan Eksekutif Mahasiswa Politeknik Negeri Bandung', 'Pembina Himpunan', 'Ketua Jurusan', 'Koordinator Layanan Internal', 'Wakil Direktur Bidang Kemahasiswaan'];
                        @endphp
                        @foreach ($currentValidators as $index => $validator)
                            <tr>
                                <td style="border: 1px solid black; text-align:center;">{{ $loop->iteration }}</td>
                                <td style="border: 1px solid black; padding-left: 20px">{{ $validator }}</td>
                                <td style="border: 1px solid black; text-align: center">
                                    {{-- Mengambil waktu validasi dari relasi revisiProposal --}}
                                    {{ $pengajuan->revisiProposal->tgl_revisi ?? 'Belum Divalidasi' }}
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>            
        </div>

        <div class="penutup">
            <p>
                Demikian lembar pengesahan ini dibuat sebagai bukti bahwa kegiatan telah mendapatkan persetujuan.
            </p>
        </div>

        <div class="pengesahan">
            <table style="width: 100%; border: none;">
                <tr>
                    <td style="text-align: left;">
                        <p style="margin-top: 5px; padding-bottom: 75px;">
                            Tembusan:<br>
                            1. Wakil Direktur Bidang Keuangan dan Umum <br>
                            2. Kepala Bagian Keuangan dan Umum <br> 
                            3. Kepala UPA Perawatan dan Perbaikan <br>
                            4 Kepala Satuan Keamanan
                        </p>
                    </td>
                    <td style="text-align: left; margin-left: 50px">
                        <p style="margin-top: 5px; padding-bottom: 75px; margin-left: 300px">
                            {{-- BARCODE --}}
                        </p>
                    </td>
                </tr>
            </table>
        </div>
    </div>

</body>
</html>
