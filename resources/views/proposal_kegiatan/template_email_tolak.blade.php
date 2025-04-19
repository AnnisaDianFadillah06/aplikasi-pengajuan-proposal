<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        h1 {
            font-size: 24px;
            color: #444;
        }
        p {
            margin: 10px 0;
        }
        .highlight {
            color: #d9534f;
            font-weight: bold;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #888;
            text-align: center;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #d9534f;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
@php
    $roles = [
        1 => 'BEM',
        2 => 'Pembina',
        3 => 'Ketua Jurusan',
        4 => 'KLI',
        5 => 'Wadir 3',
        6 => 'Wadir 3',
    ];

    // Mendapatkan tahap saat ini dan tahap berikutnya
    $tahap = $roles[$data_email['id_role']] ?? 'Tidak Diketahui';
@endphp

    <div class="email-container">
        <!-- Judul Berdasarkan Tipe -->
        @if ($data_email['route'] === 'proposal')
            <h1>Proposal Ditolak oleh {{ $tahap }}</h1>
        @elseif ($data_email['route'] === 'spj')
            <h1>SPJ Ditolak oleh {{ $tahap }}</h1>
        @elseif ($data_email['route'] === 'lpj')
            <h1>LPJ Ditolak oleh {{ $tahap }}</h1>
        @endif

        <p>Halo, <strong>{{ $data_email['username'] }}</strong>,</p>

        <!-- Isi Berdasarkan Tipe -->
        @if ($data_email['route'] === 'proposal')
            <p>Maaf untuk proposal dengan judul <strong>"{{ $data_email['judul'] }}"</strong> telah ditolak oleh {{ $tahap }}.</p>
        @elseif ($data_email['route'] === 'spj')
            <p>Maaf untuk SPJ ke <strong>"{{ $data_email['spj_ke'] }}"</strong> dengan proposal yang berjudul <strong>"{{ $data_email['judul'] }}"</strong> telah ditolak oleh {{ $tahap }}.</p>
        @elseif ($data_email['route'] === 'lpj')
            <p>Maaf untuk LPJ jenis <strong>"{{ $data_email['jenis_lpj'] }}"</strong> ormawa <strong>"{{ $data_email['username'] }}"</strong> telah ditolak oleh {{ $tahap }}.</p>
        @endif

        <p>{{ $data_email['isi'] }}</p>

        <p style="text-align: center;">
            <a href="{{ url('/login-mahasiswa') }}" class="button">Login</a>
        </p>

        <p>Salam,</p>
        <p><strong>{{ $data_email['sender_name'] }}</strong></p>
        <div class="footer">
            <p>Catatan: Email ini dikirim secara otomatis. Harap tidak membalas langsung ke email ini.</p>
        </div>
    </div>
</body>
</html>
