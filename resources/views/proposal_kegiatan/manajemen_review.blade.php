@extends('proposal_kegiatan\reviewer')

@section('konten')
@php
    $filePath = $latestRevision && $latestRevision->file_revisi 
                ? $latestRevision->file_revisi 
                : $reviewProposal->file_proposal;

                $fileKetuplakPath = $latestRevision && $latestRevision->file_ketuplak_revisi 
                        ? $latestRevision->file_ketuplak_revisi 
                        : $reviewProposal->surat_berkegiatan_ketuplak;

    // Surat Pernyataan Ormawa
    $fileOrmawaPath = $latestRevision && $latestRevision->file_ormawa_revisi 
                    ? $latestRevision->file_ormawa_revisi 
                    : $reviewProposal->surat_pernyataan_ormawa;

    // Surat Kesediaan Pembina
    $filePembinaPath = $latestRevision && $latestRevision->file_pembina_revisi 
                    ? $latestRevision->file_pembina_revisi 
                    : $reviewProposal->surat_kesediaan_pendampingan;

    // Surat Peminjaman Sarpras
    $fileSarprasPath = $latestRevision && $latestRevision->file_sarpras_revisi 
                    ? $latestRevision->file_sarpras_revisi 
                    : $reviewProposal->surat_peminjaman_sarpras;

@endphp

<div class="w-full p-6 mx-auto">
    <div class="flex flex-wrap -mx-3">
        <!-- Navigation Tabs -->
        <div class="w-full mb-4">
            <div class="flex space-x-4 border-b">
                <button class="tab-btn px-4 py-2 border-b-2 border-transparent hover:border-blue-500" data-target="tab-proposal">Proposal Kegiatan</button>
                <button class="tab-btn px-4 py-2 border-b-2 border-transparent hover:border-blue-500" data-target="tab-ketuplak">Surat Berkegiatan Ketuplak</button>
                <button class="tab-btn px-4 py-2 border-b-2 border-transparent hover:border-blue-500" data-target="tab-ormawa">Surat Pernyataan Ormawa</button>
                <button class="tab-btn px-4 py-2 border-b-2 border-transparent hover:border-blue-500" data-target="tab-pembina">Surat Kesediaan Pembina</button>
                <button class="tab-btn px-4 py-2 border-b-2 border-transparent hover:border-blue-500" data-target="tab-sarpras">Surat Peminjaman Sarpras</button>
            </div>
        </div>

        <!-- Tab Content -->
        <div class="w-full">
            <!-- Proposal Kegiatan -->
            <div id="tab-proposal" class="tab-content hidden">
                <h3 class="font-semibold mb-2">Proposal Kegiatan</h3>
                <iframe src="{{ asset($filePath) }}" width="800px" height="700px"></iframe>
            </div>

            <!-- Surat Berkegiatan Ketuplak -->
            <div id="tab-ketuplak" class="tab-content hidden">
                <h3 class="font-semibold mb-2">Surat Berkegiatan Ketuplak</h3>
                <iframe src="{{ asset($fileKetuplakPath) }}" width="800px" height="700px"></iframe>
            </div>

            <!-- Surat Pernyataan Ormawa -->
            <div id="tab-ormawa" class="tab-content hidden">
                <h3 class="font-semibold mb-2">Surat Pernyataan Ormawa</h3>
                <iframe src="{{ asset($fileOrmawaPath) }}" width="800px" height="700px"></iframe>
            </div>

            <!-- Surat Kesediaan Pembina -->
            <div id="tab-pembina" class="tab-content hidden">
                <h3 class="font-semibold mb-2">Surat Kesediaan Pembina</h3>
                <iframe src="{{ asset($filePembinaPath) }}" width="800px" height="700px"></iframe>
            </div>

            <!-- Surat Peminjaman Sarpras -->
            <div id="tab-sarpras" class="tab-content hidden">
                <h3 class="font-semibold mb-2">Surat Peminjaman Sarpras</h3>
                <iframe src="{{ asset($fileSarprasPath) }}" width="800px" height="700px"></iframe>
            </div>
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
                        <table class="table-auto w-full border border-gray-300">
                            <tbody class="divide-y divide-gray-200">
                                <tr>
                                    <th class="text-left px-4 py-2 font-medium text-gray-700">Nama Kegiatan</th>
                                    <td class="px-4 py-2">{{ $reviewProposal->nama_kegiatan }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left px-4 py-2 font-medium text-gray-700">Tanggal Mulai Kegiatan</th>
                                    <td class="px-4 py-2">{{ $reviewProposal->tanggal_mulai }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left px-4 py-2 font-medium text-gray-700">Tanggal Akhir Kegiatan</th>
                                    <td class="px-4 py-2">{{ $reviewProposal->tanggal_akhir }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left px-4 py-2 font-medium text-gray-700">Tempat Kegiatan</th>
                                    <td class="px-4 py-2">{{ $reviewProposal->tmpt_kegiatan }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left px-4 py-2 font-medium text-gray-700">Kategori</th>
                                    <td class="px-4 py-2">{{ $reviewProposal->jenisKegiatan->nama_jenis_kegiatan }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left px-4 py-2 font-medium text-gray-700">Asal Ormawa</th>
                                    <td class="px-4 py-2">{{ $reviewProposal->ormawa->nama_ormawa }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left px-4 py-2 font-medium text-gray-700">Pengisi Acara</th>
                                    <td class="px-4 py-2">{{ $reviewProposal->pengisi_acara ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left px-4 py-2 font-medium text-gray-700">Sponsorship</th>
                                    <td class="px-4 py-2">{{ $reviewProposal->sponsorship ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left px-4 py-2 font-medium text-gray-700">Media Partner</th>
                                    <td class="px-4 py-2">{{ $reviewProposal->media_partner ?? '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    
                        <!-- Tabel Data Dana -->
                        <h2 class="text-xl font-bold text-gray-700 px-6 py-4 mt-8">Detail Dana</h2>
                        <table class="table-auto w-full border border-gray-300">
                            <tbody class="divide-y divide-gray-200">
                                <tr>
                                    <th class="text-left px-4 py-2 font-medium text-gray-700">Dana DIPA Polban</th>
                                    <td class="px-4 py-2">Rp {{ number_format($reviewProposal->dana_dipa ?? 0, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left px-4 py-2 font-medium text-gray-700">Dana Swadaya</th>
                                    <td class="px-4 py-2">Rp {{ number_format($reviewProposal->dana_swadaya ?? 0, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left px-4 py-2 font-medium text-gray-700">Dana Sponsor</th>
                                    <td class="px-4 py-2">Rp {{ number_format($reviewProposal->dana_sponsor ?? 0, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
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
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const tabButtons = document.querySelectorAll(".tab-btn");
                    const tabContents = document.querySelectorAll(".tab-content");
            
                    // Function to show a specific tab
                    function showTab(targetId) {
                        tabContents.forEach(content => {
                            content.classList.add("hidden");
                        });
                        document.getElementById(targetId).classList.remove("hidden");
            
                        tabButtons.forEach(button => {
                            button.classList.remove("border-blue-500");
                        });
                        document.querySelector(`[data-target="${targetId}"]`).classList.add("border-blue-500");
                    }
            
                    // Attach click event to each tab button
                    tabButtons.forEach(button => {
                        button.addEventListener("click", () => {
                            showTab(button.dataset.target);
                        });
                    });
            
                    // Show the first tab by default
                    showTab("tab-proposal");
                });
            </script>
        </div>
    </div>
</section>
@endsection
