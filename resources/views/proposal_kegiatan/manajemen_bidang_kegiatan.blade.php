@extends('proposal_kegiatan\reviewer')
@section('konten')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>


<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-6">
    <div class="max-w-7xl mx-auto">
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-6">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg mb-8 p-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div class="space-y-2">
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                    Daftar Bidang Kegiatan
                </h1>
                <p class="text-gray-500">Kelola semua daftar bidang kegiatan</p>
            </div>
            <button data-modal-target="addBidangKegiatanModal" data-modal-toggle="addBidangKegiatanModal"
                class="flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 group-hover:rotate-90 transition-transform duration-200" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Bidang Kegiatan
            </button>
        </div>
    </div>

        <!-- Modal Form Tambah Bidang Kegiatan -->
        <div id="addBidangKegiatanModal" tabindex="-1" class="fixed inset-0 flex items-center justify-center hidden z-50 p-4 overflow-x-hidden overflow-y-auto" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
            <div class="relative w-full max-w-md">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="flex items-start justify-between p-4 border-b rounded-t">
                        <h3 class="text-xl font-semibold text-gray-900" id="modalTitle">Tambah Bidang Kegiatan</h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" onclick="closeModal()">
                            <span class="sr-only">Close</span>
                        </button>
                    </div>
                    <form id="bidangKegiatanForm" action="{{ route('bidang-kegiatan.store') }}" method="POST">
                        @csrf
                        <div class="p-6 space-y-6">
                            <div>
                                <label for="nama_bidang_kegiatan" class="block mb-2 text-sm font-medium text-gray-900">Nama Bidang Kegiatan</label>
                                <input type="text" name="nama_bidang_kegiatan" id="nama_bidang_kegiatan" class="w-full p-2.5 border border-gray-300 rounded" required autofocus>
                            </div>
                            <div>
                                <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                                <select name="status" id="status" class="w-full p-2.5 border border-gray-300 rounded" required>
                                    <option value="aktif" selected>Aktif</option>
                                    <option value="tidak aktif">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex items-center p-6 space-x-2 border-t rounded-b">
                            <button type="button" id="submitEdit" class="bg-blue-700 text-white px-4 py-2 rounded" onclick="submitForm()">Simpan</button>
                            <button type="button" class="text-gray-500 bg-white border rounded px-4 py-2" onclick="closeModal()">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


      <!-- Modal Form Edit Bidang Kegiatan -->
      <div id="editModal" tabindex="-1" class="fixed inset-0 flex items-center justify-center hidden z-50 p-4 overflow-x-hidden overflow-y-auto">
          <div class="relative w-full max-w-md">
              <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="flex items-start justify-between p-4 border-b rounded-t">
                        <h3 class="text-xl font-semibold text-gray-900" id="modalTitle">Edit Bidang Kegiatan</h3>
                        <button type="button" data-modal-hide="editModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                            <span class="sr-only">Close</span>
                        </button>
                    </div>  
                    <form id="editBidangKegiatanForm" action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="p-6 space-y-6">
                            <div class="form-group">
                                <label for="edit_nama_bidang_kegiatan">Nama Bidang Kegiatan:</label>
                                <input type="text" class="form-control" id="edit_nama_bidang_kegiatan" name="nama_bidang_kegiatan" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_status">Status:</label>
                                <select id="edit_status" name="status" class="form-control" required>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak aktif">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex items-center p-6 space-x-2 border-t rounded-b">
                            <button type="button" class="bg-blue-700 text-white px-4 py-2 rounded" onclick="submitEditForm()">Simpan</button>
                            <button type="button" class="text-gray-500 bg-white border rounded px-4 py-2" onclick="closeEditModal()">Batal</button>
                        </div>
                    </form>                    
                </div>
            </div>
          </div>
      </div>

      <!-- Search & Filter Section -->
      <div class="bg-white rounded-2xl shadow-lg mb-8 p-6">
        <div class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Cari organisasi mahasiswa..."
                        class="w-full pl-12 pr-4 py-3 border-2 border-gray-100 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                    <svg class="absolute left-4 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
            <div class="flex-none">
                <select class="w-full sm:w-48 px-4 py-3 border-2 border-gray-100 rounded-xl focus:ring-2 focus:ring-blue-500 transition-all duration-200">
                    <option value="">Semua Status</option>
                    <option value="aktif">Aktif</option>
                    <option value="tidak aktif">Tidak Aktif</option>
                </select>
            </div>
        </div>
    </div>

    {{-- tabel --}}
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-left">No</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-left">Bidang Kegiatan</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Tanggal Dibuat</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Dibuat Oleh</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Tanggal Diedit</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Diedit Oleh</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Status</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($kegiatan as $key => $item)
                    <tr data-id="{{ $item->id_bidang_kegiatan }}" class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $key + 1 }}</td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $item->nama_bidang_kegiatan }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500 text-center">{{ $item->created_at->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500 text-center">{{ $item->created_by }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500 text-center">{{ $item->updated_at->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500 text-center">{{ $item->updated_by }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 text-xs font-medium rounded-full 
                                {{ $item->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <button onclick="openEditModal('{{ $item->id_ormawa }}', '{{ $item->nama_ormawa }}', '{{ $item->status }}')"
                                class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

  </div>
</div>



<script>
document.querySelector('button[data-modal-toggle="addBidangKegiatanModal"]').addEventListener('click', function() { 
    document.getElementById('addBidangKegiatanModal').classList.remove('hidden');
});

// Fungsi untuk menutup modal
function closeModal() {
    const modal = document.getElementById('addBidangKegiatanModal');
    modal.classList.add('hidden');
}

// Fungsi untuk mengirimkan data form menggunakan AJAX
function submitForm() {
    const form = document.getElementById('bidangKegiatanForm');
    
    // Mengambil data form
    const formData = new FormData(form);
    
    // Kirim form menggunakan AJAX (fetch API)
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        // Jika data berhasil disimpan, kita tutup modal dan beri pesan sukses
        if (data.success) {
            closeModal();  // Menutup modal jika pengiriman berhasil
            alert('Bidang Kegiatan berhasil disimpan!');
            // Opsional: Anda bisa menambahkan kode untuk memperbarui tampilan daftar bidang kegiatan
            location.reload(); // Tambahkan ini untuk refresh halaman
        } else {
            alert('Gagal menyimpan data. Periksa kembali input Anda.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menyimpan data.');
    });
}

</script>

<script>
// Fungsi untuk membuka modal dan mengisi form dengan data yang di-passing dari tombol
function openEditModal(id, namaBidangKegiatan, status) {
    // Mengisi form dengan data yang di-passing
    document.getElementById('edit_nama_bidang_kegiatan').value = namaBidangKegiatan;
    document.getElementById('edit_status').value = status;

    // Mengubah action URL dari form agar sesuai dengan bidang kegiatan yang sedang diedit
    document.getElementById('editBidangKegiatanForm').action = "/update-bidang-kegiatan/" + id;

    // Menampilkan modal
    document.getElementById('editModal').classList.remove('hidden');
    
    // Nonaktifkan scroll pada body
    document.body.classList.add('overflow-hidden');
}


// Fungsi untuk menutup modal
function closeEditModal() {
    const modal = document.getElementById('editModal');
    modal.classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

</script> 

<script>
function submitEditForm() {
    let formData = new FormData(document.getElementById('editBidangKegiatanForm'));
    
    // Mendapatkan URL action dari form
    let actionUrl = document.getElementById('editBidangKegiatanForm').action;

    // Mengirim data menggunakan AJAX
    fetch(actionUrl, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Untuk proteksi CSRF
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Jika sukses, tutup modal dan perbarui tabel
            closeEditModal();
            
            // Update tampilan data di tabel secara dinamis
            const row = document.querySelector(`tr[data-id="${data.id_bidang_kegiatan}"]`);
            row.querySelector('td:nth-child(2)').textContent = data.nama_bidang_kegiatan;
            row.querySelector('td:nth-child(7)').textContent = data.status;
            
            // Optionally, beri notifikasi bahwa data telah berhasil diubah
            alert('Data berhasil diubah');
            location.reload(); // Tambahkan ini untuk refresh halaman
        } else {
            alert('Terjadi kesalahan, coba lagi');
        }
    })
    .catch(error => {
        console.error('Error:', error);  // Tambahkan log untuk melihat error dari fetch
        alert('Terjadi kesalahan di fetch: ' + error.message);
    });
}
</script> 

<!-- Script DataTables -->
<script>
    $(document).ready(function() {
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
</script>

@endsection