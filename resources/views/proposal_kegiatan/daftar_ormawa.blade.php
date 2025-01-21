@extends('proposal_kegiatan/reviewer')
@section('konten')
<div class="flex flex-wrap -mx-3">
  <div class="flex-none w-full max-w-full px-3">
    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
      <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
        <h6 class="font-bold">Daftar Ormawa</h6>
        <!-- Wrapper untuk input search dan button -->
        <div class="flex justify-between items-center mt-3">
          <!-- Input Search -->
          <div>
            <input type="text" id="searchInput" placeholder="Searching" class="p-2 border border-gray-300 rounded w-60">
          </div>
          <!-- Button Tambah Ormawa -->

          <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="bg-gradient-to-tl inline-block px-6 py-3 font-bold text-center text-white uppercase align-baseline transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-700 to-blue-500 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs" type="button">
            TAMBAH MODAL
          </button>

          <!-- Main modal -->
          <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
              <div class="relative p-4 w-full max-w-md max-h-full">
                  <!-- Modal content -->
                  <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                      <!-- Modal header -->
                      <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                          <h3 class="px-2 py-2 font-bold text-center uppercase align-middle bg-transparent shadow-none text-xl whitespace-nowrap text-slate-400 opacity-100">
                              Form Tambah Kategori Kegiatan
                          </h3>
                          <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                              <svg class="w-3 h-3 relative" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 30">
                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                              </svg>
                              <span class="sr-only">Close modal</span>
                          </button>
                      </div>
                      <!-- Modal body -->
                      <form class="p-4 md:p-5">
                          <div class="grid gap-4 mb-4 grid-cols-2">
                              <div class="col-span-2">
                                  <label for="name" class="px-2 py-2 font-bold text-center align-middle bg-transparent shadow-none text-xxl whitespace-nowrap text-slate-400 opacity-100">Kategori Kegiatan</label>
                                  <input type="text" name="name" id="name" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                  placeholder="Type product name" required="">
                              </div>
                              <div class="col-span-2 sm:col-span-2">
                                  <label for="category" class="px-2 py-2 font-bold text-center align-middle bg-transparent shadow-none text-xxl whitespace-nowrap text-slate-400 opacity-100">Status</label>
                                  <select id="category" class="bg-white border  block w-72 border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Pilih Status Ormawa yang Didaftarkan" required="">
                                      <option selected="">Aktif</option>
                                      <option value="TV">Tidak Aktif</option>
                                  </select>
                              </div>
                              <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-auto px-5 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                  Cancel
                              </button>
                              <button data-modal-hide="addOrmawaModal" type="cancel" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-auto px-5 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                  Submit
                              </button>
                          </div>
                      </form>
                  </div>
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
                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama Ormawa</th>
                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal Dibuat</th>
                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Dibuat Oleh</th>
                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal Diedit</th>
                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Diedit Oleh</th>
                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent text-left">
                  <p class="mb-0 text-xs font-semibold leading-tight">1</p>
                </td>
                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent text-left">
                  <p class="mb-0 text-xs font-semibold leading-tight">HMJ_Teknik Kimia</p>
                </td>
                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                  <span class="text-xs font-semibold leading-tight text-slate-400">23/04/18</span>
                </td>
                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                  <span class="text-xs font-semibold leading-tight text-slate-400">Annisa</span>
                </td>
                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                  <span class="text-xs font-semibold leading-tight text-slate-400">23/04/18</span>
                </td>
                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                  <span class="text-xs font-semibold leading-tight text-slate-400">Angelita</span>
                </td>
                <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                  <span class="bg-gradient-to-tl from-green-600 to-lime-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Aktif</span>
                </td>
              </tr>
              <tr>
              <td class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent text-left">
                  <p class="mb-0 text-xs font-semibold leading-tight">1</p>
                </td>
                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent text-left">
                  <p class="mb-0 text-xs font-semibold leading-tight">HMJ_Teknik Kimia</p>
                </td>
                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                  <span class="text-xs font-semibold leading-tight text-slate-400">23/04/18</span>
                </td>
                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                  <span class="text-xs font-semibold leading-tight text-slate-400">Annisa</span>
                </td>
                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                  <span class="text-xs font-semibold leading-tight text-slate-400">23/04/18</span>
                </td>
                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                  <span class="text-xs font-semibold leading-tight text-slate-400">Angelita</span>
                </td>
                <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                  <span class="bg-gradient-to-tl from-red-600 to-red-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Tidak Aktif</span>
                </td>
              </tr>

              <!-- Another Row -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection