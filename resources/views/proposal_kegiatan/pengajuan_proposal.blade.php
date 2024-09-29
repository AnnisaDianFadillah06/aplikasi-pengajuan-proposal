@extends('welcome')
@section('konten')

<h1>List Proposal</h1>

<a href="{{ url('/tambah-pengajuan-proposal') }}">
    <button class="bg-green-500 text-white font-bold py-2 px-4 rounded hover:bg-green-700">
        Add New Proposal
    </button>
</a>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kegiatan</th>
            <th>Tanggal Kegiatan</th>
            <th>Tempat Kegiatan</th>
            <th>File Proposal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($proposal as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td> <!-- Penomoran otomatis -->
            <td>{{ $item->nama_kegiatan }}</td>
            <td>{{ $item->tgl_kegiatan }}</td>
            <td>{{ $item->tmpt_kegiatan }}</td>
            <td><a href="{{ asset('storage/' . $item->file_proposal) }}">{{ $item->file_proposal }}</a></td> <!-- Link ke file proposal -->
        </tr>
        @endforeach
    </tbody>
</table>  
@endsection
