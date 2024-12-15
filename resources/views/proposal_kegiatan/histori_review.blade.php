@extends('welcome')

@section('konten')
@php
    $filePath = $proposal->file_proposal; // Ambil path dari reviewProposal
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

              <div class="flex-auto p-4">
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
                                <strong class="text-slate-700">Nama Kegiatan:</strong> &nbsp; {{ $proposal->nama_kegiatan }}
                            </li>
                            <li class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit">
                                <strong class="text-slate-700">Tanggal Kegiatan:</strong> &nbsp; {{ $proposal->tgl_kegiatan }}
                            </li>
                            <li class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit">
                                <strong class="text-slate-700">Tempat Kegiatan:</strong> &nbsp; {{ $proposal->tmpt_kegiatan }}
                            </li>
                            <li class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit">
                                <strong class="text-slate-700">Jenis Kegiatan:</strong> &nbsp; {{ $proposal->jenisKegiatan->nama_jenis_kegiatan ?? 'Tidak Diketahui' }}
                            </li>
                            <li class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit">
                                <strong class="text-slate-700">Ormawa:</strong> &nbsp; {{ $proposal->ormawa->nama_ormawa ?? 'Tidak Diketahui' }}
                            </li>
                            <li class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit">
                                <strong class="text-slate-700">Nama Penyelenggara:</strong> &nbsp; {{ $proposal->pengguna->nama_pengguna ?? 'Tidak Diketahui' }}
                            </li>
                        </ul>
                    </div>
    <hr>
                    <div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                        <div class="flex flex-wrap -mx-3">
                            <div class="flex items-center w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-none">
                                <h6 class="mb-0">Histori Review</h6>
                            </div>
                            <div class="w-full max-w-full px-3 text-right shrink-0 md:w-4/12 md:flex-none">
                                <a href="javascript:;" data-target="tooltip_trigger" data-placement="top">
                                    <i class="leading-normal fas fa-user-edit text-sm text-slate-400"></i>
                                </a>
                                <div data-target="tooltip" class="hidden px-2 py-1 text-center text-white bg-black rounded-lg text-sm" role="tooltip">
                                    Histori Review
                                    <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']" data-popper-arrow></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-auto p-4">
                        @if ($proposal->revisions->isEmpty())
                            <p class="text-sm text-slate-500">Belum ada review untuk proposal ini.</p>
                        @else
                            <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                                @foreach ($proposal->revisions as $review)
                                    <li class="relative block px-4 py-2 leading-normal bg-white border-0 border-t text-sm text-inherit">
                                        <strong class="text-slate-700">Direview Oleh:</strong> &nbsp;             
                                        @if ($review->dosen)
                                            {{ $review->dosen->role }}
                                        @else
                                            <span class="text-slate-500">Reviewer tidak ditemukan</span>
                                        @endif
                                    </li>
                                    <li class="relative block px-4 py-2 leading-normal bg-white border-0 border-t text-sm text-inherit">
                                        <strong class="text-slate-700">Tanggal Review:</strong> &nbsp; {{ $review->tgl_revisi }}
                                    </li>
                                    <li class="relative block px-4 py-2 leading-normal bg-white border-0 border-t text-sm text-inherit">
                                        <strong class="text-slate-700">Catatan Review:</strong> &nbsp; {{ $review->catatan_revisi }}
                                    </li>
                                    <br>
                                    <hr>
                                    <br>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

              </div>
            </div>

        </div>
    </div>
</section>
@endsection
