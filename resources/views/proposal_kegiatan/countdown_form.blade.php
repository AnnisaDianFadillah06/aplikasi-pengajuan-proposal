@extends('welcome')
@section('konten')


<!-- resources/views/countdown-setting.blade.php -->

<!-- Main modal -->
<div id="timepicker-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-[23rem] max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
        </div>
    </div>
</div>

<div class="w-full max-w-full px-3 lg-max:mt-6 xl:w-12/12">
            <div class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
              <div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                <div class="flex flex-wrap -mx-3">
                  <div class="flex items-center w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-none">
                    <h6 class="mb-0">Set Countdown</h6>
                  </div>
                  <div class="w-full max-w-full px-3 text-right shrink-0 md:w-4/12 md:flex-none">
                    <a href="javascript:;" data-target="tooltip_trigger" data-placement="top">
                      <i class="leading-normal fas fa-user-edit text-sm text-slate-400"></i>
                    </a>
                    <div data-target="tooltip" class="hidden px-2 py-1 text-center text-white bg-black rounded-lg text-sm" role="tooltip">
                      Countdown
                      <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']" data-popper-arrow></div>
                    </div>
                  </div>
                </div>
              </div>
<div class="flex-auto p-4">
              <form action="{{ route('proposal_kegiatan.countdown_form') }}" method="POST">
                     @csrf
    
                      <label class="mb-2 ml-1 font-bold text-xs text-slate-700" for="countdown_title">Countdown Title :</label>
                      <div class="mb-4">
                      <input type="text" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" name="title" id="title" required placeholder="Enter countdown title">
                      </div>
                      <div class="relative mb-4">
                      <label class="mb-2 ml-1 font-bold text-xs text-slate-700" for="end_time">End Time:</label>
                      <input type="datetime-local" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" name="end_time" id="end_time" required>
                      </div>

                <div class="flex flex-wrap items-center justify-end p-3 border-t border-solid shrink-0 border-slate-100 rounded-b-xl">
                    <button type="button"  class="inline-block px-8 py-2 m-1 mb-4 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-gradient-to-tl from-slate-600 to-slate-300 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">Close</button>
                    <button type="submit" class="inline-block px-8 py-2 m-1 mb-4 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-gradient-to-tl from-purple-700 to-pink-500 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">Simpan</button>
                </div>
            </form>
              </div>
              </div>

    <!-- Flowbite JavaScript for datepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.4.7/datepicker.min.js"></script>









@endsection