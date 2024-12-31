{{-- Tampilkan Form Revisi --}}
    {{-- Bagian Form Revisi --}}
    <div class="container mx-auto mt-5">
        <div class="flex flex-wrap -mx-3">
            <!-- Bagian Kiri: Status dan Hasil Revisi -->
            <div class="w-full md:w-1/2 px-3 mb-5">
                <div class="p-5 bg-white border border-gray-300 rounded-lg shadow">
                    <!-- Judul Status -->
                    <h2 class="text-lg font-semibold text-gray-900 mb-3">Status</h2>
                    <!-- Konten Status -->
                    <div class="p-4 bg-gray-100 rounded-lg">
                        <!-- Di sini nantinya akan memuat status dari database -->
                        <p class="text-gray-700">
                            @if ($latestRevision)
                                @switch($latestRevision->status_revisi)
                                    @case(0)
                                        Menunggu
                                        @break
                                    @case(1)
                                        Disetujui
                                        @break
                                    @case(2)
                                        Ditolak
                                        @break
                                    @case(3)
                                        Direvisi
                                        @break
                                    @default
                                        Status tidak diketahui
                                @endswitch
                            @else
                                Tidak ada status revisi.
                            @endif
                        </p>
                    </div>
                    <!-- Judul Hasil Revisi -->
                    <h2 class="text-lg font-semibold text-gray-900 mb-3">Hasil Revisi</h2>
                    <!-- Konten Hasil Revisi -->
                    <div class="p-4 bg-gray-100 rounded-lg">
                        <!-- Section kotak untuk catatan revisi dari database -->
                        <p class="text-gray-700">
                            {{ $latestRevision ? $latestRevision->catatan_revisi : 'Tidak ada catatan revisi.' }}
                        </p>
                    </div>
                    
                    <!-- Tabel Data Proposal -->
                    <h2 class="text-xl font-bold text-gray-700 px-6 py-4 mt-8">Detail Proposal</h2>
                    {{-- tabel informasi proposal --}}
                    <table class="table-auto w-full border border-gray-300">
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <th class="text-left px-4 py-2 font-medium text-gray-700">Nama Kegiatan</th>
                                <td class="px-4 py-2">{{ $proposal->nama_kegiatan }}</td>
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
                        </tbody>
                    </table>
                
                    <!-- Tabel Data Dana -->
                    <h2 class="text-xl font-bold text-gray-700 px-6 py-4 mt-8">Detail Dana</h2>
                    <table class="table-auto w-full border border-gray-300">
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <th class="text-left px-4 py-2 font-medium text-gray-700">Dana DIPA Polban</th>
                                <td class="px-4 py-2">Rp {{ number_format($proposal->dana_dipa ?? 0, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th class="text-left px-4 py-2 font-medium text-gray-700">Dana Swadaya</th>
                                <td class="px-4 py-2">Rp {{ number_format($proposal->dana_swadaya ?? 0, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th class="text-left px-4 py-2 font-medium text-gray-700">Dana Sponsor</th>
                                <td class="px-4 py-2">Rp {{ number_format($proposal->dana_sponsor ?? 0, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Bagian Kanan: Form Input Attachment File -->
            <div class="w-full md:w-1/2 px-3">
                <div class="p-5 bg-white border border-gray-300 rounded-lg shadow">
                    <form action="{{ route('proposal.uploadFileRevisi', $proposal->id_proposal) }}" method="POST" enctype="multipart/form-data" class="max-w-lg">
                        @csrf
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="file_revisian">Upload File Revisi</label>
                        <input type="file" name="file_revisian" id="file_revisian" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                        
                        @error('file_revisian')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
            
                        <!-- Tombol Close dan Simpan -->
                        <div class="flex flex-wrap items-center justify-end p-3 border-t border-solid shrink-0 border-slate-100 rounded-b-xl">
                            <button type="button" class="inline-block px-8 py-2 m-1 mb-4 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer bg-gradient-to-tl from-slate-600 to-slate-300 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">Close</button>
                            <button type="submit" class="inline-block px-8 py-2 m-1 mb-4 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer bg-gradient-to-tl from-purple-700 to-pink-500 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>