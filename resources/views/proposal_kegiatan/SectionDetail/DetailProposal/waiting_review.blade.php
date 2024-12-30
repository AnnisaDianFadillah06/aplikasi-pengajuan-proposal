{{-- Tampilkan Detail Proposal dengan Keterangan menunggu --}}
    {{-- Bagian Detail Proposal --}}
    <div class="container mx-auto mt-5">
        <div class="bg-white p-5 rounded shadow">
            <h2 class="text-2xl font-bold mb-4">Detail Proposal</h2>
            
            <table class="table-auto w-full">
                <tr>
                    <th class="text-left px-4 py-2">Nama Kegiatan</th>
                    <td class="px-4 py-2">{{ $proposal->nama_kegiatan }}</td>
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
                    <th class="text-left px-4 py-2">Kategori</th>
                    <td class="px-4 py-2">{{ $proposal->jenisKegiatan->nama_jenis_kegiatan }}</td>
                </tr>
                <tr>
                    <th class="text-left px-4 py-2">Asal Ormawa</th>
                    <td class="px-4 py-2">{{ $proposal->ormawa->nama_ormawa }}</td>
                </tr>
            </table>

            <div class="mt-4 p-3 bg-yellow-100 text-yellow-700 rounded">
                <p>Proposal ini sedang menunggu review.</p>
            </div>            
        </div>
    </div>