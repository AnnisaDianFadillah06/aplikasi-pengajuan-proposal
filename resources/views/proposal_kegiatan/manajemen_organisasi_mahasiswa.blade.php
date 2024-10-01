@extends('welcome')
@section('konten')
        <div class="flex flex-wrap -mx-3">
          <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-4 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <div class="flex flex-wrap -mx-3">
                      <div class="flex items-center flex-none w-1/2 max-w-full px-3">
                        <h6>Tabel Organisasi Mahasiswa</h6>
                      </div>
                      <div class="flex-none w-1/2 max-w-full px-3 text-right">
                      <button type="button" class="px-8 py-2 font-bold text-center uppercase transition-all bg-transparent border border-fuchsia-500 rounded-lg text-fuchsia-500 hover:bg-fuchsia-500 hover:text-white" onclick="openModal()">
                          Tambah Ormawa
                      </button>
                      </div>
                    </div>
                  </div>
              <!-- <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6>Tabel Organisasi Mahasiswa</h6>
              </div>
              <div class="flex-none w-1/2 max-w-full px-3 text-right">
                <a class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25" href="javascript:;"> <i class="fas fa-plus"> </i>&nbsp;&nbsp;Tambah Ormawa</a>
              </div> -->
              <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                  <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                      <tr>
                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">ID</th>
                        <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Organisasi Mahasiswa</th>
                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Dibuat Oleh</th>
                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal Dibuat</th>
                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Diedit Oleh</th>
                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal Diedit</th>
                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($organisasiMahasiswa as $item)
                      <tr>
                      <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                          <p class="mb-0 text-xs font-semibold leading-tight">{{ $item->id_ormawa }}</p>
                          <!-- <p class="mb-0 text-xs leading-tight text-slate-400">Organization</p> -->
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                          <div class="flex px-2 py-1">
                            <div class="flex flex-col justify-center">
                              <h6 class="mb-0 text-sm leading-normal">{{ $item->nama_ormawa }}</h6>
                              <!-- <p class="mb-0 text-xs leading-tight text-slate-400">john@creative-tim.com</p> -->
                            </div>
                          </div>
                        </td>
                        <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            @if ($item->status == 0)
                                <span class="bg-gradient-to-tl from-red-600 to-red-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                    Tidak Aktif
                                </span>
                            @elseif ($item->status == 1)
                                <span class="bg-gradient-to-tl from-green-600 to-lime-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                    Aktif
                                </span>
                            @endif
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <span class="text-xs font-semibold leading-tight text-slate-400">{{ $item->created_by }}{{ $item->pengguna->nama_pengguna }}</span>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <span class="text-xs font-semibold leading-tight text-slate-400">{{ $item->created_at->format('Y-m-d')  }}</span>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <span class="text-xs font-semibold leading-tight text-slate-400">{{ $item->updated_by }}{{ $item->pengguna->nama_pengguna }}</span>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <span class="text-xs font-semibold leading-tight text-slate-400">{{ $item->updated_at->format('Y-m-d')  }}</span>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <a id="edit-ormamwa" data-id="{{ $item->id_ormawa }}" class="mb-0 text-xs font-semibold leading-tight text-blue-500 hover:underline" onclick="openModal()">Review</a>
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

<!-- Modal -->

<!-- Button to open the modal -->


        <!-- Modal -->
<div id="create-ormawa" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white rounded-lg overflow-hidden shadow-lg max-w-md w-full">
        <div class="flex justify-between items-center p-4 border-b">
            <h5 class="mb-0 leading-normal dark:text-black" id="ModalLabel">Create Ormawa Baru</h5>
            <button type="button" 
                    class="fa fa-close w-4 h-4 ml-auto box-content p-2 text-black dark:text-white border-0 rounded-1.5 opacity-50 cursor-pointer -m-2" 
                    data-dismiss="modal" onclick="closeModal()">
            </button>
        </div>
        <div class="relative flex-auto p-4">
            <form id="ormawaForm" role="form">
                <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Nama Ormawa</label>
                <div class="mb-4">
                    <input type="text" 
                           class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" 
                           placeholder="Nama Ormawa" 
                           aria-label="Nama Ormawa" name="nama_ormawa" id="nama_ormawa"
                           aria-describedby="email-addon" />
                </div>

                <div class="relative mb-4">
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Status</label>
                    <select id="statusSelect" 
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                        <option value="">Pilih Status</option>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                </div>

                <div class="flex flex-wrap items-center justify-end p-3 border-t border-solid shrink-0 border-slate-100 rounded-b-xl">
                    <button type="button" 
                            class="inline-block px-8 py-2 m-1 mb-4 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-gradient-to-tl from-slate-600 to-slate-300 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85" 
                            onclick="closeModal()">
                        Close
                    </button>
                    <button type="submit" 
                            class="inline-block px-8 py-2 m-1 mb-4 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-gradient-to-tl from-purple-700 to-pink-500 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Function to open the modal
    function openModal() {
        document.getElementById('create-ormawa').classList.remove('hidden');
    }

    // Function to close the modal
    function closeModal() {
        document.getElementById('create-ormawa').classList.add('hidden');
    }

    // Show modal and get data for editing
    $(document).on('click', '#edit-ormamwa', function() {
        var id = $(this).data('id');
        // Optionally: Fetch existing data using AJAX and populate the form
        $.ajax({
            url: '/getOrmawa/' + id,
            type: 'GET',
            success: function(data) {
                $('#nama_ormawa').val(data.nama_ormawa);
                $('#statusSelect').val(data.status);
                openModal();
            }
        });
    });

    // Handle form submission
    $('#ormawaForm').submit(function(e) {
        e.preventDefault(); // Prevent default form submission
        var formData = $(this).serialize();

        // Reset validation messages
        $('input, select').removeClass('is-invalid');
        $('.invalid-feedback').addClass('d-none');

        // AJAX request to submit the form data
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            success: function(response) {
                if (response.status === 0) {
                    // Show validation errors
                    $.each(response.messages, function(key, value) {
                        var input = $('[name="' + key + '"]');
                        input.addClass('is-invalid');
                        input.next('.invalid-feedback').text(value).removeClass('d-none');
                    });
                } else {
                    closeModal(); // Close the modal
                    location.reload(); // Reload the page to see updated data
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error(jqXHR, textStatus, errorThrown);
            }
        });
    });

    // Ensure modal resets properly on close
    $("#create-ormawa").on("hidden.bs.modal", function () {
        $('#ormawaForm')[0].reset();
        $('input, select').removeClass('is-invalid');
        $('.invalid-feedback').addClass('d-none');
    });
</script>
@endsection