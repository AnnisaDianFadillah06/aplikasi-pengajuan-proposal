<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Daftar Proposal</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kegiatan</th>
                <th>Periode Kegiatan</th>
                <th>Tempat</th>
                <th>Tgl Pengajuan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proposals as $index => $proposal)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $proposal->nama_kegiatan }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($proposal->tanggal_mulai)->format('d M Y') }} - 
                        {{ \Carbon\Carbon::parse($proposal->tanggal_akhir)->format('d M Y') }}
                    </td>
                    <td>{{ $proposal->tmpt_kegiatan }}</td>
                    <td>{{ \Carbon\Carbon::parse($proposal->created_at)->format('d M Y') }}</td>
                    <td>
                        @if($proposal->status === 1)
                            Disetujui
                        @elseif($proposal->status === 2)
                            Dalam Review
                        @else
                            Menunggu
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
