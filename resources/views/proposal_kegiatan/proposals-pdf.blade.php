<!DOCTYPE html>
<html>
<head>
    <title>Histori Proposal Kegiatan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h2>Histori Proposal Kegiatan</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kegiatan</th>
                <th>Tanggal Kegiatan</th>
                <th>Tempat Kegiatan</th>
                <th>Tanggal Pengajuan</th>
                <th>Status Proposal</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp
            @foreach($proposals as $proposal)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $proposal->nama_kegiatan }}</td>
                    <td>{{ $proposal->tgl_kegiatan }}</td>
                    <td>{{ $proposal->tmpt_kegiatan }}</td>
                    <td>{{ \Carbon\Carbon::parse($proposal->created_at)->format('Y-m-d') }}</td>
                    <td>{{ $statusLabels[$proposal->status] ?? 'Unknown' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
