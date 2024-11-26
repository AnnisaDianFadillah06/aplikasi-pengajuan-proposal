@extends('welcome')
@section('konten')

<div class="container mx-auto mt-5">
        <div class="bg-white p-5 rounded shadow">
            <h2 class="text-2xl font-bold mb-4">Detail Kegiatan</h2>
            
            <table class="table-auto w-full">
                <tr>
                    <th class="text-left px-4 py-2">Nama Kegiatan</th>
                    <td class="px-4 py-2">{{ $proposal->nama_kegiatan }}</td>
                </tr>
                <tr>
                    <th class="text-left px-4 py-2">Asal Ormawa</th>
                    <td class="px-4 py-2">{{ $proposal->ormawa->nama_ormawa }}</td> <!--  ada relasi dengan ormawa -->
                </tr>
                <tr>
                    <th class="text-left px-4 py-2">Tanggal Kegiatan</th>
                    <td class="px-4 py-2">{{ $proposal->tgl_kegiatan }}</td>
                </tr>
                <tr>
                    <th class="text-left px-4 py-2">Tempat Kegiatan</th>
                    <td class="px-4 py-2">{{ $proposal->tmpt_kegiatan }}</td>
                </tr>
                <tr>
                    <th class="text-left px-4 py-2">Jenis Kegiatan</th>
                    <td class="px-4 py-2">{{ $proposal->jenisKegiatan->nama_jenis_kegiatan }}</td> <!--  ada relasi dengan tabel jenis kegiatan -->
                </tr>
                <tr>
                    <th class="text-left px-4 py-2">Bidang Kegiatan</th>
                    <!--  ada relasi dengan tabel jenis kegiatan -->
                    <td class="px-4 py-2">{{ $proposal->bidangKegiatan->nama_bidang_kegiatan }}</td> <!--  ada relasi dengan tabel jenis kegiatan -->
                </tr>
                <tr>
                    <th class="text-left px-4 py-2">Pengaju</th>
                    <td class="px-4 py-2">{{ $proposal->pengguna->username }}</td>
                </tr>
                <tr>
                    <th class="text-left px-4 py-2">Pengesah</th>
                    <td class="px-4 py-2">{{ $proposal->id_pengguna }}</td>
                </tr>
                <tr>
                    <th class="text-left px-4 py-2">Tanggal Pengajuan</th>
                    <td class="px-4 py-2">{{ $proposal->created_at }}</td>
                </tr>
                <tr>
                    <th class="text-left px-4 py-2">Tanggal Pengesahan</th>
                    <td class="px-4 py-2">{{ $proposal->updated_at }}</td>
                </tr>
            </table>
        </div>
    </div>

    @endsection