@extends('welcome')

@section('konten')
@php
    $filePath = $reviewProposal->file_proposal; // Ambil path dari reviewProposal
@endphp

<div class="w-full p-6 mx-auto">
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
            <iframe src="{{ asset($filePath) }}" width="900px" height="600px"></iframe>
        </div>
    </div>
</div>

<section>
    <div class="w-full p-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <!-- Informasi Kegiatan -->
            <div class="w-full max-w-full px-3 lg-max:mt-6 xl:w-5/12">
                <div class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                        <div class="flex flex-wrap -mx-3">
                            <div class="flex items-center w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-none">
                                <h6 class="mb-0">Informasi Kegiatan</h6>
                            </div>
                            <div class="w-full max-w-full px-3 text-right shrink-0 md:w-4/12 md:flex-none">
                                <a href="javascript:;" data-target="tooltip_trigger" data-placement="top">
                                    <i class="leading-normal fas fa-user-edit text-sm text-slate-400"></i>
                                </a>
                                <div data-target="tooltip" class="hidden px-2 py-1 text-center text-white bg-black rounded-lg text-sm" role="tooltip">
                                    Informasi Kegiatan
                                    <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']" data-popper-arrow></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-auto p-4">
                        <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                            <li class="relative block px-4 py-2 pt-0 pl-0 leading-normal bg-white border-0 rounded-t-lg text-sm text-inherit">
                                <strong class="text-slate-700">Nama Kegiatan:</strong> &nbsp; {{ $reviewProposal->nama_kegiatan }}
                            </li>
                            <li class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit">
                                <strong class="text-slate-700">Tanggal Kegiatan:</strong> &nbsp; {{ $reviewProposal->tgl_kegiatan }}
                            </li>
                            <li class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit">
                                <strong class="text-slate-700">Tempat Kegiatan:</strong> &nbsp; {{ $reviewProposal->tmpt_kegiatan }}
                            </li>
                            <li class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit">
                                <strong class="text-slate-700">Jenis Kegiatan:</strong> &nbsp; {{ $reviewProposal->jenisKegiatan->nama_jenis_kegiatan ?? 'Tidak Diketahui' }}
                            </li>
                            <li class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit">
                                <strong class="text-slate-700">Ormawa:</strong> &nbsp; {{ $reviewProposal->ormawa->nama_ormawa ?? 'Tidak Diketahui' }}
                            </li>
                            <li class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit">
                                <strong class="text-slate-700">Nama Penyelenggara:</strong> &nbsp; {{ $reviewProposal->pengguna->nama_pengguna ?? 'Tidak Diketahui' }}
                            </li>
                        </ul>
                    </div>
                </div>
                
              </div>
              <div class="flex-auto p-4">
              <form action="{{ route('proposal.store') }}" method="POST">
    @csrf
    <input type="hidden" name="id_proposal" value="{{ $reviewProposal->id_proposal }}">
                      <label class="mb-2 ml-1 font-bold text-xs text-slate-700" for="catatan_revisi">Revisi</label>
                      <div class="mb-4">
                      <textarea name="catatan_revisi" id="catatan_revisi"  rows="5" placeholder="Write your thoughts here..." class="focus:shadow-soft-primary-outline min-h-unset text-sm leading-5.6 ease-soft block h-auto w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none"></textarea>
                      </div>
                      <div class="relative mb-4">
                        <label class="mb-2 ml-1 font-bold text-xs text-slate-700" for="status_revisi">Status</label>
                        <select id="status_revisi" name="status_revisi"  class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                          <option value="">Pilih Status</option>
                          <option value="1">Setujui</option>
                          <option value="3">Revisi</option>
                          <option value="2">Tolak</option>
                        </select>
                      </div>

      <div class="flex flex-wrap items-center justify-end p-3 border-t border-solid shrink-0 border-slate-100 rounded-b-xl">
        <button type="button"  class="inline-block px-8 py-2 m-1 mb-4 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-gradient-to-tl from-slate-600 to-slate-300 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">Close</button>
        <button type="submit" class="inline-block px-8 py-2 m-1 mb-4 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-gradient-to-tl from-purple-700 to-pink-500 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">Simpan</button>
      </div>
</form>
              </div>
            </div>

            <!-- Review Proposal Kegiatan -->
            <!-- <div class="w-full max-w-full px-3 lg-max:mt-6 xl:w-7/12">
                <div class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                        <div class="flex flex-wrap -mx-3">
                            <div class="flex items-center w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-none">
                                <h6 class="mb-0">Review Proposal Kegiatan</h6>
                            </div>
                            <div class="w-full max-w-full px-3 text-right shrink-0 md:w-4/12 md:flex-none">
                                <a href="javascript:;" data-target="tooltip_trigger" data-placement="top">
                                    <i class="leading-normal fas fa-user-edit text-sm text-slate-400"></i>
                                </a>
                                <div data-target="tooltip" class="hidden px-2 py-1 text-center text-white bg-black rounded-lg text-sm" role="tooltip">
                                    Edit Profile
                                    <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']" data-popper-arrow></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-auto p-4">
                        <form action="{{ route('proposal.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_proposal" value="{{ $reviewProposal->id_proposal }}">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700" for="catatan_revisi">Revisi</label>
                            <div class="mb-4">
                                <textarea name="catatan_revisi" id="catatan_revisi" rows="5" placeholder="Write your thoughts here..." class="focus:shadow-soft-primary-outline min-h-unset text-sm leading-5.6 ease-soft block h-auto w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none"></textarea>
                            </div>
                            <div class="relative mb-4">
                                <label class="mb-2 ml-1 font-bold text-xs text-slate-700" for="status_revisi">Status</label>
                                <select id="status_revisi" name="status_revisi" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                                    <option value="">Pilih Status</option>
                                    <option value="1">Lolos</option>
                                    <option value="0">Revisi</option>
                                    <option value="-1">Tolak</option>
                                </select>
                            </div>
                            <div class="flex flex-wrap items-center justify-end p-3 border-t border-solid shrink-0 border-slate-100 rounded-b-xl">
                                <button type="button" class="inline-block px-8 py-2 m-1 mb-4 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-gradient-to-tl from-slate-600 to-slate-300 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">Close</button>
                                <button type="submit" class="inline-block px-8 py-2 m-1 mb-4 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-gradient-to-tl from-purple-700 to-pink-500 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> -->

        </div>
    </div>
</section>
@endsection
