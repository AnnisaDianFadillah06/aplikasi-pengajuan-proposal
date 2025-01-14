<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pengajuan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h2>Riwayat Pengajuan</h2>

    <!-- Tabel Proposal -->
    <h3>Tabel Proposal</h3>
    <table>
        <thead>
            <tr>
                <th>Penyelenggara</th>
                <th>Nama Kegiatan</th>
                <th>Status</th>
                <th>Tanggal Kegiatan</th>
                <th>Tanggal Pengajuan Proposal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proposals as $proposal)
            <tr>
                <td>{{ $proposal->pengguna->username }}</td>
                <td>{{ $proposal->nama_kegiatan }}</td>
                <td>{{ $statusLabels[$proposal->status] ?? 'Tidak Diketahui' }}</td>
                <td>{{ $proposal->tanggal_mulai }}</td>
                <td>{{ $proposal->updated_at->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tabel SPJ -->
    <h3>Tabel SPJ</h3>
    <table>
        <thead>
            <tr>
                <th>Penyelenggara</th>
                <th>Nama Kegiatan</th>
                <th>Status</th>
                <th>Tanggal Kegiatan</th>
                <th>Tanggal Pengajuan SPJ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($spjAll as $spj)
            <tr>
                <td>{{ $spj->proposalKegiatan->pengguna->username }}</td>
                <td>{{ $spj->proposalKegiatan->nama_kegiatan }}</td>
                <td>{{ $statusLabels[$spj->status] ?? 'Tidak Diketahui' }}</td>
                <td>{{ $spj->proposalKegiatan->tanggal_mulai }}</td>
                <td>{{ \Carbon\Carbon::parse($spj->updated_at)->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tabel LPJ -->
    <h3>Tabel LPJ</h3>
    <table>
        <thead>
            <tr>
                <th>Penyelenggara</th>
                <th>Jenis LPJ</th>
                <th>Status</th>
                <th>Tanggal Pengajuan LPJ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lpjAll as $lpj)
            <tr>
                <td>{{ $lpj->ormawa->nama_ormawa }}</td>
                <td>{{ $lpj->jenis_lpj == 1 ? '60%' : '100%' }}</td>
                <td>{{ $statusLabels[$lpj->status_lpj] ?? 'Tidak Diketahui' }}</td>
                <td>{{ \Carbon\Carbon::parse($lpj->updated_at)->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
