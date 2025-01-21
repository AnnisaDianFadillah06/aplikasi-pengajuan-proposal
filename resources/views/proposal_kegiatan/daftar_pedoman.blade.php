@extends('proposal_kegiatan/reviewer')
@section('title', 'Pedoman Kemahasiswaan')
@section('konten')

<title>@yield('title', 'Daftar Pedoman')</title>

<div class="bg-white rounded-2xl shadow-lg mb-8 p-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
        <div class="space-y-2">
            <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                Daftar Pedoman
            </h1>
            <p class="text-gray-500">Kelola semua Pedoman Untuk di tampilkan pada dashboard pengaju</p>
        </div>
        <button data-modal-target="addModal" data-modal-toggle="addModal"
            class="flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 group">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 group-hover:rotate-90 transition-transform duration-200" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Tambah Daftar Pedoman
        </button>
    </div>
</div>


<!-- Modal Tambah Pedoman -->

<div id="addModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="px-2 py-2 font-bold text-center uppercase align-middle bg-transparent shadow-none text-xl whitespace-nowrap text-slate-400 opacity-70">
                    Form Tambah Daftar Pedoman
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="addModal">
                    <svg class="w-3 h-3 relative" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 30">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form id="addForm" action="{{ route('pedoman.store') }}" method="POST" enctype="multipart/form-data" class="p-4 md:p-5">
                <!-- Input Fields for Add -->
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="nama_pedoman" class="px-2 py-2 font-bold text-center align-middle bg-transparent shadow-none text-xxl whitespace-nowrap text-slate-400 opacity-70">Judul Pedoman</label>
                        <input type="text" name="nama_pedoman" id="nama_pedoman" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Judul Pedoman" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-2">
                        <label for="status" class="px-2 py-2 font-bold text-center align-middle bg-transparent shadow-none text-xxl whitespace-nowrap text-slate-400 opacity-70">Status</label>
                        <select id="status" name="status" class="bg-white border  block w-72 border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                          <option value="">Pilih Status</option>
                          <option value="1">Aktif</option>
                          <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="col-span-2 sm:col-span-2 flex items-center justify-center w-full">
                        <label class="flex flex-col items-center w-full p-6 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:bg-gray-100 hover:border-blue-500">
                            <span class="text-gray-500">Drag and drop your files here</span>
                            <span class="mt-2 text-gray-400">or</span>
                            <span class="mt-2 text-blue-600">Browse files</span>
                            <input type="file" id="file_pedoman" name="file_pedoman" class="hidden" />
                            <p id="file-name" class="mt-2 text-sm text-gray-500"></p>
                        </label>
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-auto px-5 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Submit
                    </button>
                    <button type="button" data-modal-hide="addModal" class="text-white inline-flex items-center bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-auto px-5 py-2 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Form Edit -->
<div id="editModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen">
        <div class="relative bg-white rounded-lg shadow-lg w-full max-w-2xl">
            <form id="editForm" action="" method="POST" enctype="multipart/form-data" class="p-4 md:p-5">
                @csrf
                @method('PUT') <!-- Tetap menggunakan PUT untuk update -->
                <input type="hidden" id="edit_id" name="id" value="edit_id">

                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="edit_name" class="px-2 py-2 font-bold text-center align-middle text-slate-400 opacity-70">Judul Pedoman</label>
                        <input type="text" name="edit_name" id="edit_name" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Judul Pedoman" required>
                    </div>
                    <div class="col-span-2">
                        <label for="edit_status" class="px-2 py-2 font-bold text-center align-middle text-slate-400 opacity-70">Status</label>
                        <select id="edit_status" name="edit_status" class="bg-white border block w-72 border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="col-span-2 flex items-center justify-center w-full">
                        <label class="flex flex-col items-center w-full p-6 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:bg-gray-100 hover:border-blue-500">
                            <span class="text-gray-500">Drag and drop your files here</span>
                            <span class="mt-2 text-gray-400">or</span>
                            <span class="mt-2 text-blue-600">Browse files</span>
                            <input type="file" id="file_pedoman_edit" name="file_pedoman_edit" class="hidden">
                            <p id="file-name" class="mt-2 text-sm text-gray-500"></p>
                        </label>
                    </div>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2">
                        Update
                    </button>
                    <button type="button" class="text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2" onclick="closeEditModal()">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Main modal -->
<div id="deleteModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="deleteModal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
            <p class="mb-4 text-gray-500 dark:text-gray-300">Are you sure you want to delete this item?</p>
            <form id="deleteForm" method="POST" action="" style="display:inline;">
                @csrf
                @method('DELETE')
                <div class="flex justify-center items-center space-x-4">
                    <button data-modal-toggle="deleteModal" type="button" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        No, cancel
                    </button>
                    <button type="submit" class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Yes, I'm sure
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

        </div>
      </div>
      <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-left">No</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-left">Judul Pedoman</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Pedoman</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Status</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Preview</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($pedomanList as $pedoman)
                    <tr data-id="{{ $loop->iteration }}" class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $pedoman->nama_pedoman }}</div>
                        </td>
                        <td class="px-4 py-4 text-gray-500 text-center">
                            <div class="text-sm font-medium text-gray-900">
                            <canvas id="pdf-thumbnail-{{ $loop->index }}" class="w-16 h-16 mr-4"></canvas>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if ($pedoman -> status)
                            <span class="px-3 py-1 text-xs font-medium rounded-full 
                                {{ $pedoman->status == '1' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                Aktif
                            </span>
                        @else
                            <span class="px-3 py-1 text-xs font-medium rounded-full 
                                {{ $pedoman->status == '0' ? 'bg-red-100 text-red-800' : 'bg-red-100 text-red-800' }}">
                                TIdak Aktif 
                            </span>
                        @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                                <a href="{{ asset($pedoman->file_pedoman) }}" 
                                   class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors duration-150">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Lihat Dokumen
                                </a>
                            </td>
                        <td class="px-6 py-4 text-center">
                            <button onclick="openEditModal('{{ addslashes($pedoman->nama_pedoman) }}', '{{ $pedoman->status }}', '{{ addslashes($pedoman->file_pedoman) }}', '{{ $pedoman->id_pedoman }}')"
                                class="editBtn inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </button>
                                <button 
                                    class="deleteBtn inline-flex items-center px-3 py-1.5 bg-red-50 text-blue-700 rounded-lg hover:bg-red-100 transition-colors duration-200"
                                    data-id="{{ $pedoman->id_pedoman }}" 
                                    id="deleteButton" 
                                    data-modal-target="deleteModal" 
                                    data-modal-toggle="deleteModal">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Hapus
                                </button>
                            </td>
                        </td>
                    </tr>
                    <script>
              document.addEventListener('DOMContentLoaded', function() {
                  const url = "{{ asset($pedoman->file_pedoman) }}";
                  
                  // Tampilkan URL di console
                  console.log("URL PDF:", url);

                  pdfjsLib.getDocument(url).promise.then(pdf => {
                      pdf.getPage(1).then(page => {
                          const canvas = document.getElementById('pdf-thumbnail-{{ $loop->index }}');
                          const context = canvas.getContext('2d');
                          const viewport = page.getViewport({ scale: 0.5 }); // Atur skala sesuai kebutuhan

                          canvas.height = viewport.height;
                          canvas.width = viewport.width;

                          page.render({ canvasContext: context, viewport: viewport });
                      });
                  }).catch(error => {
                      console.error("Error loading PDF:", error);
                  });
              });
          </script>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
  </div>
</div>
  </div>
</div>

<!-- Script DataTables -->
<script>
function openEditModal(namaPedoman, status, filePedoman, idPedoman) {
    // Isi form dengan data dinamis
    document.getElementById('edit_id').value = idPedoman;
    document.getElementById('edit_name').value = namaPedoman;
    document.getElementById('edit_status').value = status;
    
    // Update action form
    document.getElementById('editForm').action = `/pedoman/edit/${idPedoman}`;
    
    // Tampilkan modal
    document.getElementById('editModal').classList.remove('hidden');
}

function closeEditModal() {
    // Sembunyikan modal
    document.getElementById('editModal').classList.add('hidden');
}

document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".deleteBtn");
    const deleteForm = document.getElementById("deleteForm");

    deleteButtons.forEach(button => {
        button.addEventListener("click", function () {
            const id = this.getAttribute("data-id");
            const actionUrl = `/pedoman/${id}`;
            deleteForm.setAttribute("action", actionUrl);
        });
    });
});

    document.getElementById('file_pedoman').addEventListener('change', function(event) {
        const fileNameElement = document.getElementById('file-name');
        const file = event.target.files[0]; // Ambil file pertama yang dipilih

        if (file) {
            fileNameElement.textContent = `File yang dipilih: ${file.name}`; // Tampilkan nama file
        } else {
            fileNameElement.textContent = ''; // Kosongkan teks jika tidak ada file yang dipilih
        }
    });
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
                "infoFiltered": "(disaring dari MAX total entri)",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            }
        });

        // Script untuk menyesuaikan ukuran dropdown secara otomatis
        function adjustSelectWidth() {
            var select = $('.dataTables_length select');
            select.each(function() {
                var text = $(this).find('option:selected').text();
                $(this).css('width', (text.length + 4) + 'ch'); // +2 untuk padding tambahan
            });
        }

        // Panggil fungsi saat halaman dimuat dan saat dropdown berubah
        adjustSelectWidth();
        $('.dataTables_length select').change(adjustSelectWidth);
    });
</script>
@endsection

