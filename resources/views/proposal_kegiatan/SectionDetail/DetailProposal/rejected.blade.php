{{-- Tampilkan Detail Proposal dengan Keterangan Ditolak --}}
    {{-- Bagian Detail Proposal --}}
    <div class="container mx-auto mt-5">
        <div class="bg-white p-5 rounded shadow">
            <h2 class="text-2xl font-bold mb-4">Detail Proposal</h2>
            
            <table class="table-auto w-full">
                <tr>
                    <th class="text-left px-4 py-2 font-medium text-gray-700">Nama Kegiatan</th>
                    <td class="px-4 py-2">{{ $proposal->nama_kegiatan }}</td>
                </tr>
                <tr>
                    <th class="text-left px-4 py-2 font-medium text-gray-700">Nama Penanggung Jawab</th>
                    <td class="px-4 py-2">{{ $proposal->nama_penanggung_jawab }}</td>
                </tr>
                <tr>
                    <th class="text-left px-4 py-2 font-medium text-gray-700">Email penanggung jawab</th>
                    <td class="px-4 py-2">{{ $proposal->email_penanggung_jawab }}</td>
                </tr>
                <tr>
                    <th class="text-left px-4 py-2 font-medium text-gray-700">No hp penanggung jawab</th>
                    <td class="px-4 py-2">{{ $proposal->no_hp_penanggung_jawab }}</td>
                </tr>
                <tr>
                    <th class="text-left px-4 py-2 font-medium text-gray-700">Tanggal Mulai Kegiatan</th>
                    <td class="px-4 py-2">{{ $proposal->tanggal_mulai }}</td>
                </tr>
                <tr>
                    <th class="text-left px-4 py-2 font-medium text-gray-700">Tanggal Akhir Kegiatan</th>
                    <td class="px-4 py-2">{{ $proposal->tanggal_akhir }}</td>
                </tr>
                <tr>
                    <th class="text-left px-4 py-2 font-medium text-gray-700">Tempat Kegiatan</th>
                    <td class="px-4 py-2">{{ $proposal->tmpt_kegiatan }}</td>
                </tr>
                <tr>
                    <th class="text-left px-4 py-2 font-medium text-gray-700">Kategori</th>
                    <td class="px-4 py-2">{{ $proposal->jenisKegiatan->nama_jenis_kegiatan }}</td>
                </tr>
                <tr>
                    <th class="text-left px-4 py-2 font-medium text-gray-700">Asal Ormawa</th>
                    <td class="px-4 py-2">{{ $proposal->ormawa->nama_ormawa }}</td>
                </tr>
                <tr>
                    <th class="text-left px-4 py-2 font-medium text-gray-700">Pengisi Acara</th>
                    <td class="px-4 py-2">{{ $proposal->pengisi_acara ?? '-' }}</td>
                </tr>
                <tr>
                    <th class="text-left px-4 py-2 font-medium text-gray-700">Sponsorship</th>
                    <td class="px-4 py-2">{{ $proposal->sponsorship ?? '-' }}</td>
                </tr>
                <tr>
                    <th class="text-left px-4 py-2 font-medium text-gray-700">Media Partner</th>
                    <td class="px-4 py-2">{{ $proposal->media_partner ?? '-' }}</td>
                </tr>
            </table>

            <div class="mt-4 p-3 bg-red-100 text-red-700 rounded">
                <p>Proposal ini telah ditolak.</p>
            </div>
        </div>
    </div>