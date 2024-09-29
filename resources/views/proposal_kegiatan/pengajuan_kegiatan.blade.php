@extends('welcome')
@section('konten')

<!-- Link Tailwind CSS dan FontAwesome untuk ikon -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<div class="container mx-auto mt-4">
    <!-- Heading dan Tombol Add New -->
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-xl font-bold">List Proposal</h3>
        <button class="bg-blue-500 text-white py-2 px-4 rounded">
            <i class="fas fa-plus"></i> Add New
        </button>
    </div>

    <!-- Tabel dengan Tampilan sesuai Gambar -->
    <div class="overflow-x-auto">
        <!-- <table id="myTable" class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="w-full bg-gray-100 text-gray-700 uppercase text-sm leading-normal">
                    <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Penyelenggara</th>
                    <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama kegiatan</th>
                    <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal Pengajuan</th>
                    <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                    <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Deadline revisi</th>
                    <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach ($proposals as $proposal)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 flex items-center">
                        <img src="https://via.placeholder.com/40" class="rounded-full mr-3" alt="Avatar">
                        <div>
                            <div class="font-semibold">{{ $proposal->nama_penyelenggara }}</div>
                            <small class="text-gray-500">{{ $proposal->email_penyelenggara }}</small>
                        </div>
                    </td>
                    <td class="py-3 px-6">{{ $proposal->nama_kegiatan }}</td>
                    <td class="py-3 px-6">{{ $proposal->tgl_pengajuan }}</td>
                    <td class="py-3 px-6">
                        <span class="bg-blue-200 text-blue-600 py-1 px-2 rounded-full text-xs font-semibold">
                            {{ strtoupper($proposal->status_proposal) }}
                        </span>
                    </td>
                    <td class="py-3 px-6">{{ $proposal->deadline_revisi }}</td>
                    <td class="py-3 px-6">
                        <a href="#" class="text-blue-500 hover:underline">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table> -->
        <br><br>
        <!-- aaaaaaaa -->
        <table id="myTable" class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                    <tr class="w-full bg-gray-100 text-gray-700 uppercase text-sm leading-normal">
                        <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Penyelenggara</th>
                        <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama kegiatan</th>
                        <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal Pengajuan</th>
                        <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                        <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Deadline revisi</th>
                        <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($proposals as $proposal)
                      <tr>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                          <div class="flex px-2 py-1">
                            <div class="flex flex-col justify-center">
                              <h6 class="mb-0 text-sm leading-normal">{{ $proposal->email_penyelenggara }}</h6>
                              <!-- <p class="mb-0 text-xs leading-tight text-slate-400">john@creative-tim.com</p> -->
                            </div>
                          </div>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                          <p class="mb-0 text-xs font-semibold leading-tight">{{ $proposal->nama_kegiatan }}</p>
                          <!-- <p class="mb-0 text-xs leading-tight text-slate-400">Organization</p> -->
                        </td>
                        <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <span class="bg-gradient-to-tl from-green-600 to-lime-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">{{ strtoupper($proposal->status_proposal) }}</span>
                        </td>
                        <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <span class="text-xs font-semibold leading-tight text-slate-400">{{ $proposal->tgl_pengajuan }}</span>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <a href="javascript:;" class="text-xs font-semibold leading-tight text-slate-400"> {{ $proposal->deadline_revisi }} </a>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                          <p class="mb-0 text-xs font-semibold leading-tight">Edit</p>
                          <!-- <p class="mb-0 text-xs leading-tight text-slate-400">Organization</p> -->
                        </td>
                    </tr>
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
