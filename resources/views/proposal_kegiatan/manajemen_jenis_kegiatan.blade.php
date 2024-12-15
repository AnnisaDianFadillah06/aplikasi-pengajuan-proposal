@extends('welcome')
@section('konten')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<div class="flex flex-wrap -mx-3">
  <div class="flex-none w-full max-w-full px-3">
    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
      <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
        <h6 class="font-bold">Daftar Jenis Kegiatan</h6>
        <!-- Wrapper untuk input search dan button -->
        <div class="flex justify-between items-center mt-3">
          <!-- Input Search -->
          <div>
            <input type="text" id="searchInput" placeholder="Searching" class="p-2 border border-gray-300 rounded w-60">
          </div>
          <!-- Button Tambah Jenis Kegiatan -->
          <div>
            <button type="button" data-modal-target="addJenisKegiatanModal" data-modal-toggle="addJenisKegiatanModal"
                class="bg-gradient-to-tl inline-block px-6 py-3 font-bold text-center text-white uppercase align-baseline transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-700 to-blue-500 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                Tambah Jenis Kegiatan
            </button>
          </div>
        </div>
      </div>

        <!-- Modal Form Tambah Jenis Kegiatan -->
        <div id="addJenisKegiatanModal" tabindex="-1" class="fixed inset-0 flex items-center justify-center hidden z-50 p-4 overflow-x-hidden overflow-y-auto" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
            <div class="relative w-full max-w-md">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="flex items-start justify-between p-4 border-b rounded-t">
                        <h3 class="text-xl font-semibold text-gray-900" id="modalTitle">Tambah Jenis Kegiatan</h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" onclick="closeModal()">
                            <span class="sr-only">Close</span>
                        </button>
                    </div>
                    <form id="jenisKegiatanForm" action="{{ route('jenis-kegiatan.store') }}" method="POST">
                        @csrf
                        <div class="p-6 space-y-6">
                            <div>
                                <label for="nama_jenis_kegiatan" class="block mb-2 text-sm font-medium text-gray-900">Nama Jenis Kegiatan</label>
                                <input type="text" name="nama_jenis_kegiatan" id="nama_jenis_kegiatan" class="w-full p-2.5 border border-gray-300 rounded" required autofocus>
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


      <!-- Modal Form Edit Jenis Kegiatan -->
      <div id="editModal" tabindex="-1" class="fixed inset-0 flex items-center justify-center hidden z-50 p-4 overflow-x-hidden overflow-y-auto">
          <div class="relative w-full max-w-md">
              <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="flex items-start justify-between p-4 border-b rounded-t">
                        <h3 class="text-xl font-semibold text-gray-900" id="modalTitle">Edit Jenis Kegiatan</h3>
                        <button type="button" data-modal-hide="editModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                            <span class="sr-only">Close</span>
                        </button>
                    </div>  
                    <form id="editJenisKegiatanForm" action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="p-6 space-y-6">
                            <div class="form-group">
                                <label for="edit_nama_jenis_kegiatan">Nama Jenis Kegiatan:</label>
                                <input type="text" class="form-control" id="edit_nama_jenis_kegiatan" name="nama_jenis_kegiatan" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_status">Status:</label>
                                <select id="edit_status" name="status" class="form-control" required>
                                    <option value="aktif">Aktif</option>
                                    <option value="tidak aktif">Tidak Aktif</option>
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

      <div class="flex-auto px-0 pt-0 pb-2">
        <div class="p-0 overflow-x-auto">
          <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
            <thead class="align-bottom">
              <!-- Table Headers -->
              <tr>
                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">No</th>
                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Jenis Kegiatan</th>
                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal Dibuat</th>
                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Dibuat Oleh</th>
                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal Diedit</th>
                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Diedit Oleh</th>
                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($kegiatan as $key => $item)
              <tr data-id="{{ $item->id_jenis_kegiatan }}">
                  <td class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent text-left">
                      <p class="mb-0 text-xs font-semibold leading-tight">{{ $key + 1 }}</p>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent text-left">
                      <p class="mb-0 text-xs font-semibold leading-tight">{{ $item->nama_jenis_kegiatan }}</p>
                  </td>
                  <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                      <span class="text-xs font-semibold leading-tight text-slate-400">{{ $item->created_at->format('d/m/Y') }}</span>
                  </td>
                  <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                      <span class="text-xs font-semibold leading-tight text-slate-400">{{ $item->created_by }}</span>
                  </td>
                  <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                      <span class="text-xs font-semibold leading-tight text-slate-400">{{ $item->updated_at->format('d/m/Y') }}</span>
                  </td>
                  <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                      <span class="text-xs font-semibold leading-tight text-slate-400">{{ $item->updated_by }}</span>
                  </td>
                  <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                      <span class="bg-gradient-to-tl from-green-600 to-lime-400 px-2 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline uppercase leading-none text-white">{{ $item->status }}</span>
                  </td>
                  <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                      <button class="bg-blue-500 text-white px-2 py-1 rounded" onclick="openEditModal('{{ $item->id_jenis_kegiatan }}', '{{ $item->nama_jenis_kegiatan }}', '{{ $item->status }}')">Edit</button>
                  </td>
              </tr>
              @endforeach
          </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
document.querySelector('button[data-modal-toggle="addJenisKegiatanModal"]').addEventListener('click', function() { 
    document.getElementById('addJenisKegiatanModal').classList.remove('hidden');
});

// Fungsi untuk menutup modal
function closeModal() {
    const modal = document.getElementById('addJenisKegiatanModal');
    modal.classList.add('hidden');
}

// Fungsi untuk mengirimkan data form menggunakan AJAX
function submitForm() {
    const form = document.getElementById('jenisKegiatanForm');
    
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
            alert('Jenis Kegiatan berhasil disimpan!');
            // Opsional: Anda bisa menambahkan kode untuk memperbarui tampilan daftar jenis kegiatan
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
function openEditModal(id, namaJenisKegiatan, status) {
    // Mengisi form dengan data yang di-passing
    document.getElementById('edit_nama_jenis_kegiatan').value = namaJenisKegiatan;
    document.getElementById('edit_status').value = status;

    // Mengubah action URL dari form agar sesuai dengan jenis kegiatan yang sedang diedit
    document.getElementById('editJenisKegiatanForm').action = "/update-jenis-kegiatan/" + id;

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
    let formData = new FormData(document.getElementById('editJenisKegiatanForm'));
    
    // Mendapatkan URL action dari form
    let actionUrl = document.getElementById('editJenisKegiatanForm').action;

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
            const row = document.querySelector(`tr[data-id="${data.id_jenis_kegiatan}"]`);
            row.querySelector('td:nth-child(2)').textContent = data.nama_jenis_kegiatan;
            row.querySelector('td:nth-child(3)').textContent = data.status;
            
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

@endsection