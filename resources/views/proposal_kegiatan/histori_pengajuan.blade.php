@extends('proposal_kegiatan\pengaju')
@section('konten')

<title>@yield('title', 'Histori Pengajuan')</title>

<h6 class="text-lg font-semibold mb-4">Riwayat Proposal Kegiatan</h6>
<div class="flex justify-end mb-4">
    <a href="{{ route('download.pdf') }}" class="bg-gray-500 hover:bg-gray-700 text-white text-xs font-bold py-2 px-4 rounded mb-4 inline-block">Download PDF</a>
</div>

<div class="overflow-x-auto">
    <table id="myTable" class="items-center w-full mb-0 border-gray-200 text-slate-500">
        <thead class="bg-gray-100 text-gray-700 uppercase text-sm leading-normal">
            <tr>
                <th class="px-6 py-3 font-bold text-center bg-transparent border-b border-gray-200 text-xxs tracking-none whitespace-nowrap text-slate-400 opacity-70">No</th>
                <th class="px-6 py-3 font-bold text-center bg-transparent border-b border-gray-200 text-xxs tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama Kegiatan</th>
                <th class="px-6 py-3 font-bold text-center bg-transparent border-b border-gray-200 text-xxs tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal Mulai</th>
                <th class="px-6 py-3 font-bold text-center bg-transparent border-b border-gray-200 text-xxs tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal Selesai</th>
                <th class="px-6 py-3 font-bold text-center bg-transparent border-b border-gray-200 text-xxs tracking-none whitespace-nowrap text-slate-400 opacity-70">Tempat Kegiatan</th>
                <th class="px-6 py-3 font-bold text-center bg-transparent border-b border-gray-200 text-xxs tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal Pengajuan</th>
                <th class="px-6 py-3 font-bold text-center bg-transparent border-b border-gray-200 text-xxs tracking-none whitespace-nowrap text-slate-400 opacity-70">Status Proposal</th>
                <th class="px-6 py-3 font-bold text-center bg-transparent border-b border-gray-200 text-xxs tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proposals as $proposal)
                <tr>
                    <td class="p-2 text-center border-b border-gray-200"></td> <!-- Kolom nomor kosong, akan diisi oleh DataTables -->
                    <td class="p-2 text-center border-b border-gray-200">{{ $proposal->nama_kegiatan }}</td>
                    <td class="p-2 text-center border-b border-gray-200">{{ $proposal->tanggal_mulai }}</td>
                    <td class="p-2 text-center border-b border-gray-200">{{ $proposal->tanggal_akhir }}</td>
                    <td class="p-2 text-center border-b border-gray-200">{{ $proposal->tmpt_kegiatan }}</td>
                    <td class="p-2 text-center border-b border-gray-200">{{ \Carbon\Carbon::parse($proposal->created_at)->format('Y-m-d') }}</td>
                    <td class="p-2 text-center border-b border-gray-200">
                        <span class="{{ $proposal->status === 1 ? 'bg-gradient-to-tl from-red-600 to-red-300' : ($proposal->status === 2 ? 'bg-gradient-to-tl from-blue-600 to-blue-300' : 'bg-gray-400') }} px-4 text-xs rounded-1.8 py-2 inline-block text-white uppercase font-bold">
                            {{ $statusLabels[$proposal->status] ?? 'Disetujui' }}
                        </span>
                    </td>
                    <td class="p-2 text-center border-b border-gray-200">
                        <a href="{{ route('proposal.historiReview', ['reviewProposal' => $proposal->id_proposal]) }}" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600 hover:underline">Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Script DataTables -->
<script>
    $(document).ready(function () {
    var table = $('#myTable').DataTable({
        "deferRender": true, 
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
        },
        "columnDefs": [
            { 
                "orderable": false, 
                "targets": 0 
            }
        ],
        "order": [],
        "drawCallback": function (settings) {
            var api = this.api();

            // Perbarui nomor urut
            api.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }
    });

    // Sesuaikan ukuran dropdown setelah tabel di-render
    adjustDropdownWidth();

    // Panggil fungsi saat dropdown berubah
    $('.dataTables_length select').on('change', adjustDropdownWidth);

    function adjustDropdownWidth() {
        $('.dataTables_length select').each(function () {
            var text = $(this).find('option:selected').text();
            $(this).css('width', (text.length + 4) + 'ch'); // Dinamis berdasarkan panjang teks
        });
    }
});  
</script>

@endsection
