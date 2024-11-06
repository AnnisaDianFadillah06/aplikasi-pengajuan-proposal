@extends('welcome')
@section('konten')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="flex flex-wrap -mx-3">
  <div class="flex-none w-full max-w-full px-3">
    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
      <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
        <h6 class="font-bold">Daftar Pedoman</h6>
        <!-- Wrapper untuk input search dan button -->
        <div class="flex justify-between items-center mt-3">
          <div>
          </div>
          <!-- Button Tambah Ormawa -->

          <button data-modal-target="addModal" data-modal-toggle="addModal" class="bg-gradient-to-tl inline-block px-6 py-3 font-bold text-center text-white uppercase align-baseline transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-700 to-blue-500 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs" type="button">
            Tambah Daftar Pedoman
          </button>

          <!-- Main modal -->
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
<div id="editModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="px-2 py-2 font-bold text-center uppercase align-middle bg-transparent shadow-none text-xl whitespace-nowrap text-slate-400 opacity-70">
                    Form Edit Daftar Pedoman
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="editModal">
                    <svg class="w-3 h-3 relative" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 30">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form id="editForm" class="p-4 md:p-5">
                <input type="hidden" id="edit_id" name="id">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="edit_name" class="px-2 py-2 font-bold text-center align-middle bg-transparent shadow-none text-xxl whitespace-nowrap text-slate-400 opacity-70">Judul Pedoman</label>
                        <input type="text" name="name" id="edit_name" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Judul Pedoman" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-2">
                        <label for="edit_status" class="px-2 py-2 font-bold text-center align-middle bg-transparent shadow-none text-xxl whitespace-nowrap text-slate-400 opacity-70">Status</label>
                        <select id="edit_status" class="bg-white border  block w-72 border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="col-span-2 sm:col-span-2 flex items-center justify-center w-full">
                        <label class="flex flex-col items-center w-full p-6 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:bg-gray-100 hover:border-blue-500">
                            <span class="text-gray-500">Drag and drop your files here</span>
                            <span class="mt-2 text-gray-400">or</span>
                            <span class="mt-2 text-blue-600">Browse files</span>
                            <input type="file" id="edit_file" class="hidden" />
                        </label>
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-auto px-5 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" data-modal-target="editModal" data-modal-toggle="editModal">
                        Update
                    </button>
                    <button type="button" data-modal-hide="editModal" class="text-white inline-flex items-center bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-auto px-5 py-2 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
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
             <!-- Form Hapus -->
             @foreach ($pedomanList as $pedoman)
             <form method="POST" action="{{ route('pedoman.destroy', $pedoman->id_pedoman) }}" style="display:inline;">@endforeach
                    @csrf
                    @method('DELETE')
            <div class="flex justify-center items-center space-x-4">
                <button data-modal-toggle="deleteModal" type="button" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                    No, cancel
                </button>
                <button type="submit" class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                    Yes, I'm sure
                </button>
                </form>
              
            </div>
        </div>
    </div>
</div>
        </div>
      </div>
      <div class="flex-auto px-0 pt-0 pb-2">
        <div class="p-0 overflow-x-auto">
          <table id="myTable" class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
            <thead class="align-bottom">
              <!-- Table Headers -->
              <tr>
                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">No</th>
                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Judul Pedoman</th>
                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Pedoman</th>
                <!-- <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Dibuat Oleh</th>
                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal Diedit</th>
                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Diedit Oleh</th> -->
                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Preview</th>
                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($pedomanList as $pedoman)
              <tr>
                <td class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent text-left">
                  {{ $loop->iteration }}
                </td>
                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent text-left">
                  {{ $pedoman->nama_pedoman }}
                </td>
                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                  <canvas id="pdf-thumbnail-{{ $loop->index }}" class="w-16 h-16 mr-4"></canvas>
                </td>
                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                  @if ($pedoman->status)
                        <span class="bg-gradient-to-tl from-green-600 to-green-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                            Aktif
                        </span>
                    @else
                        <span class="bg-gradient-to-tl from-red-600 to-red-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                            Tidak Aktif
                        </span>
                    @endif
                </td>
                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <a href="{{ asset($pedoman->file_pedoman) }}" class="btn btn-primary mt-2" target="_blank">Lihat Dokumen</a>
                </td>

                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <button class="editBtn bg-blue-500 text-white px-2 py-1 rounded" data-id="{{ $pedoman->id_pedoman }}" data-modal-target="editModal" data-modal-toggle="editModal">Edit</button>
                    <button class="deleteBtn bg-red-500 text-white px-2 py-1 rounded" data-id="{{ $pedoman->id_pedoman }}" id="deleteButton" data-modal-target="deleteModal" data-modal-toggle="deleteModal">Hapus</button>
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
              <!-- Another Row -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

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
