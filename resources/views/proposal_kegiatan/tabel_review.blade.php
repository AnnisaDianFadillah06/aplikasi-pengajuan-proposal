@extends('welcome')
@section('konten')


<!-- Link Tailwind CSS dan FontAwesome untuk ikon -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<div class="container mx-auto mt-4">
    <!-- Heading dan Tombol Add New -->
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-xl font-bold">List Proposal</h3>
        
        {{-- alert sukses kirim form --}}
        @if(Session::get('sukses'))
            <div id="alert-sukses" class="bg-green-500 text-white px-4 py-2 rounded">
                {{ Session::get('sukses') }}
            </div>
        @endif
        @if(Session::get('gagal'))
            <div id="alert-gagal" class="bg-red-500 text-white px-4 py-2 rounded">
                {{ Session::get('gagal') }}
            </div>
        @endif
        <script>
            // Fungsi untuk menghilangkan alert setelah 3 detik
            setTimeout(() => {
                const suksesAlert = document.getElementById('alert-sukses');
                const gagalAlert = document.getElementById('alert-gagal');
                if (suksesAlert) {
                    suksesAlert.style.display = 'none';
                }
                if (gagalAlert) {
                    gagalAlert.style.display = 'none';
                }
            }, 3000); // 3000 ms = 3 detik
        </script>
    </div>
{{-- ======================= TABEL 2 ======================= --}}

        <table id="myTable" class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                    <tr class="w-full bg-gray-100 text-gray-700 uppercase text-sm leading-normal">
                        <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Penyelenggara</th>
                        <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama kegiatan</th>
                        <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                        <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal Kegiatan</th>
                        <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal Pengajuan</th>
                        <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($proposal as $item)
                      <tr>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                          <div class="flex px-2 py-1">
                            <div class="flex flex-col justify-center">
                              <h6 class="mb-0 text-sm leading-normal">{{ $item->id_pengguna }} {{ $item->pengguna->nama_pengguna }}</h6>
                              <!-- <p class="mb-0 text-xs leading-tight text-slate-400">john@creative-tim.com</p> -->
                            </div>
                          </div>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                          <p class="mb-0 text-xs font-semibold leading-tight">{{ $item->nama_kegiatan }}</p>
                          <!-- <p class="mb-0 text-xs leading-tight text-slate-400">Organization</p> -->
                        </td>
                        <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            @if ($item->status == 0)
                                <span class="bg-gradient-to-tl from-yellow-500 to-yellow-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                    Menunggu
                                </span>
                            @elseif ($item->status == 1)
                                <span class="bg-gradient-to-tl from-green-600 to-lime-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                    Disetujui
                                </span>
                            @elseif ($item->status == 2)
                                <span class="bg-gradient-to-tl from-red-600 to-red-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                    Ditolak
                                </span>
                            @elseif ($item->status == 3)
                                <span class="bg-gradient-to-tl from-blue-600 to-blue-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                    Revisi
                                </span>
                            @endif
                        </td>
                        <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <span class="text-xs font-semibold leading-tight text-slate-400">{{ $item->tgl_kegiatan }}</span>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <span class="text-xs font-semibold leading-tight text-slate-400">{{ $item->created_at->format('Y-m-d')  }}</span>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <a href="{{ route('proposal.show', ['reviewProposal' => $item->id_proposal]) }}" onclick="logProposalId({{ $item->id }})" class="mb-0 text-xs font-semibold leading-tight text-blue-500 hover:underline">Review</a>
                        </td>
                    </tr>
                      @endforeach
                    </tbody>
        </table>
    </div>
</div>

<!-- Link jQuery dan DataTables JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<!-- Script DataTables -->
<script>
    $(document).ready( function (){
        $('#myTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "lengthMenu": [5, 10, 25, 50],
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ entri",
                "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                "infoEmpty": "Menampilkan 0 hingga 0 dari 0 entri",
                "infoFiltered": "(disaring dari _MAX_ total entri)",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            }
        });
    });
</script>

@endsection