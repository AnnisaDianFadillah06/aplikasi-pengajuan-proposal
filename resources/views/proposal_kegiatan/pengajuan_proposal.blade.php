@extends('proposal_kegiatan\pengaju')
@section('konten')

{{-- Cek apakah ada sesi login dan tampilkan data pengguna --}}
{{-- @if (session()->has('username') && session()->has('id'))
    <p>Selamat datang, {{ session('username') }}!</p>
    <p>id Anda: {{ session('id') }}</p>
@else
    <p>Anda belum login.</p>
@endif --}}

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


        <a href="{{ url('/tambah-pengajuan-proposal') }}">
            <button class="bg-blue-500 text-white py-2 px-4 rounded">
                <i class="fas fa-plus"></i> Add New
            </button>
        </a>
    </div>
{{-- ======================= TABEL 2 ======================= --}}

        <table id="myTable" class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                    <tr class="w-full bg-gray-100 text-gray-700 uppercase text-sm leading-normal">
                        <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Penyelenggara</th>
                        <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama kegiatan</th>
                        <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                        <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal Pengajuan</th>
                        <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tahap Review</th>
                        <th class="max-w-[240px] px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($proposals as $item)
                    @php
                        // Mengambil revisi terbaru yang sesuai dengan id_proposal
                        $latestReview = $latestReviews->firstWhere('id_proposal', $item->id_proposal);

                        if ($latestReview) {
                            // Status revisi dan tahap berdasarkan review terbaru
                            $statusRevisi = $latestReview->status_revisi;
                            $tahap = $latestReview->id_dosen;

                            // Pengondisian tambahan: jika status revisi adalah 1
                            if ($statusRevisi == 1) {
                                $statusRevisi = 0; // Mengubah status revisi menjadi 0
                                $tahap += 1;       // Meningkatkan tahap
                            }
                        } else {
                            // Jika tidak ada review terbaru, gunakan nilai default dari item
                            $statusRevisi = null;
                            $tahap = $item->updated_by;
                        }
                    @endphp
                      <tr>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                          <div class="flex px-2 py-1">
                            <div class="flex flex-col justify-center">
                              <h6 class="mb-0 text-sm leading-normal">{{ $item->pengguna->username }}</h6>
                              <!-- <p class="mb-0 text-xs leading-tight text-slate-400">john@creative-tim.com</p> -->
                            </div>
                          </div>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                          <p class="mb-0 text-xs font-semibold leading-tight">{{ $item->nama_kegiatan }}</p>
                          <!-- <p class="mb-0 text-xs leading-tight text-slate-400">Organization</p> -->
                        </td>
                        <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            @if ($statusRevisi == 0)
                                <span class="bg-gradient-to-tl from-yellow-500 to-yellow-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                    Menunggu
                                </span>
                            @elseif ($statusRevisi == 1)
                                <span class="bg-gradient-to-tl from-green-600 to-lime-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                    Disetujui
                                </span>
                            @elseif ($statusRevisi == 2)
                                <span class="bg-gradient-to-tl from-red-600 to-red-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                    Ditolak
                                </span>
                            @elseif ($statusRevisi == 3)
                                <span class="bg-gradient-to-tl from-blue-600 to-blue-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                    Revisi
                                </span>
                            @endif
                        </td>
                        <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <span class="text-xs font-semibold leading-tight text-slate-400">{{ $item->updated_at }}</span>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            {{-- <a href="javascript:;" class="text-xs font-semibold leading-tight text-slate-400"> </a> --}}
                            @if ($tahap == 1)
                                <p class="mb-0 text-xs font-semibold leading-tight">BEM</p>
                            @elseif ($tahap == 2)
                                <p class="mb-0 text-xs font-semibold leading-tight">Pembina</p>
                            @elseif ($tahap == 3)
                                <p class="mb-0 text-xs font-semibold leading-tight">Ketua Jurusan</p>
                            @elseif ($tahap == 4)
                                <p class="mb-0 text-xs font-semibold leading-tight">Ketua Jurusan</p>
                            @elseif ($tahap == 5)
                                <p class="mb-0 text-xs font-semibold leading-tight">Wadir 3</p>
                            @endif
                        </td>
                        <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <form method="GET" action="{{ route('proposal.detail', $item->id_proposal) }}">
                                @csrf
                                <!-- Hidden input sebagai penanda -->
                                <input type="hidden" name="is_first_access" value="true">
                                <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded">
                                    Detail
                                </button>
                            </form>
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
            }, 
            "drawCallback": function() {
                // Adjust select width after draw
                adjustSelectWidth();
            }
        });

        // Function to adjust select width
        function adjustSelectWidth() {
            var select = $('.dataTables_length select');
            select.each(function() {
                var text = $(this).find('option:selected').text();
                $(this).css('width', (text.length + 4) + 'ch');
            });
        }

        // Call function on select change
        $('.dataTables_length select').change(adjustSelectWidth);
    });

    function adjustSelectWidth() {
            var select = $('.dataTables_length select');
            select.each(function() {
                var text = $(this).find('option:selected').text();
                $(this).css('width', (text.length + 4) + 'ch');
            });
     }
     document.addEventListener('DOMContentLoaded', () => {
  // Ambil semua tombol dropdown
  const dropdownTriggers = document.querySelectorAll('[data-dropdown-trigger]');

  dropdownTriggers.forEach((trigger) => {
    const menu = trigger.nextElementSibling; // Asumsikan ul berada tepat setelah tombol

    trigger.addEventListener('click', (event) => {
      // Mencegah dropdown lain dari tetap terbuka
      document.querySelectorAll('[data-dropdown-menu]').forEach((dropdown) => {
        if (dropdown !== menu) {
          dropdown.classList.add('hidden');
        }
      });

      // Toggle visibility dropdown saat tombol diklik
      menu.classList.toggle('hidden');
      event.stopPropagation();
    });
  });

  // Tutup semua dropdown jika klik di luar dropdown
  document.addEventListener('click', () => {
    document.querySelectorAll('[data-dropdown-menu]').forEach((menu) => {
      menu.classList.add('hidden');
    });
  });


});

</script>

@endsection