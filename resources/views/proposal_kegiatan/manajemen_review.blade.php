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

    // Surat Peminjaman Sarpras
    $fileSarprasPath = $latestRevision && $latestRevision->file_sarpras_revisi 
                    ? $latestRevision->file_sarpras_revisi 
                    : $reviewProposal->surat_peminjaman_sarpras;

@endphp

<div class="w-full p-6 mx-auto">
    <!-- Main Container -->
    <div class="max-w-7xl mx-auto">
      <!-- Header Section -->
      <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Review Proposal</h1>
        <p class="text-gray-600 mt-2">Review dan evaluasi proposal kegiatan mahasiswa</p>
      </div>

      <!-- Tabs Navigation -->
      <div class="mb-6 bg-white rounded-xl shadow-sm p-2">
        <div class="flex flex-wrap gap-2">
          <button class="tab-btn px-6 py-3 rounded-lg text-sm font-medium transition-all hover:bg-blue-50 hover:text-blue-600 focus:ring-2 focus:ring-blue-500 focus:outline-none" data-target="tab-proposal">
            <i class="fas fa-file-alt mr-2"></i>Proposal Kegiatan
          </button>
          <button class="tab-btn px-6 py-3 rounded-lg text-sm font-medium transition-all hover:bg-blue-50 hover:text-blue-600" data-target="tab-ketuplak">
            <i class="fas fa-file-signature mr-2"></i>Surat Ketuplak
          </button>
          <button class="tab-btn px-6 py-3 rounded-lg text-sm font-medium transition-all hover:bg-blue-50 hover:text-blue-600" data-target="tab-ormawa">
            <i class="fas fa-university mr-2"></i>Surat Ormawa
          </button>
          <button class="tab-btn px-6 py-3 rounded-lg text-sm font-medium transition-all hover:bg-blue-50 hover:text-blue-600" data-target="tab-sarpras">
            <i class="fas fa-tools mr-2"></i>Surat Sarpras
          </button>
        </div>
      </div>

      <!-- Main Content Grid -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Left Column - Document Preview -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
          <!-- Proposal Tab -->
          <div class="tab-content hidden" id="tab-proposal">
            <div class="p-4 border-b">
              <h3 class="font-semibold text-gray-800">Proposal Kegiatan</h3>
            </div>
            <div class="p-4">
              <iframe src="{{ asset($filePath) }}" class="w-full h-[600px] rounded-lg border"></iframe>
            </div>
          </div>

          <!-- Ketuplak Tab -->
          <div class="tab-content hidden" id="tab-ketuplak">
            <div class="p-4 border-b">
              <h3 class="font-semibold text-gray-800">Surat Berkegiatan Ketuplak</h3>
            </div>
            <div class="p-4">
              <iframe src="{{ asset($fileKetuplakPath) }}" class="w-full h-[600px] rounded-lg border"></iframe>
            </div>
          </div>

          <!-- Ormawa Tab -->
          <div class="tab-content hidden" id="tab-ormawa">
            <div class="p-4 border-b">
              <h3 class="font-semibold text-gray-800">Surat Pernyataan Ormawa</h3>
            </div>
            <div class="p-4">
              <iframe src="{{ asset($fileOrmawaPath) }}" class="w-full h-[600px] rounded-lg border"></iframe>
            </div>
          </div>

          <!-- Sarpras Tab -->
          <div class="tab-content hidden" id="tab-sarpras">
            <div class="p-4 border-b">
              <h3 class="font-semibold text-gray-800">Surat Peminjaman Sarpras</h3>
            </div>
            <div class="p-4">
              <iframe src="{{ asset($fileSarprasPath) }}" class="w-full h-[600px] rounded-lg border"></iframe>
            </div>
          </div>
        </div>

        <!-- Right Column - Review Form -->
        <div class="space-y-6">
          <!-- Information Card -->
          <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="p-6">
              <h2 class="text-xl font-semibold text-gray-800 mb-4">
                <i class="fas fa-info-circle mr-2 text-blue-500"></i>Informasi Kegiatan
              </h2>
              
              <!-- Event Details Grid -->
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-3">
                  <div>
                    <label class="text-sm font-medium text-gray-500">Nama Kegiatan</label>
                    <p class="text-gray-800">{{ $reviewProposal->nama_kegiatan }}</p>
                  </div>
                  <div>
                    <label class="text-sm font-medium text-gray-500">Penanggung Jawab</label>
                    <p class="text-gray-800">{{ $reviewProposal->nama_penanggung_jawab }}</p>
                  </div>
                  <div>
                    <label class="text-sm font-medium text-gray-500">Kontak</label>
                    <p class="text-gray-800">{{ $reviewProposal->email_penanggung_jawab }}</p>
                    <p class="text-gray-600">{{ $reviewProposal->no_hp_penanggung_jawab }}</p>
                  </div>
                </div>
                
                <div class="space-y-3">
                  <div>
                    <label class="text-sm font-medium text-gray-500">Periode Kegiatan</label>
                    <p class="text-gray-800">{{ $reviewProposal->tanggal_mulai }} - {{ $reviewProposal->tanggal_akhir }}</p>
                  </div>
                  <div>
                    <label class="text-sm font-medium text-gray-500">Tempat</label>
                    <p class="text-gray-800">{{ $reviewProposal->tmpt_kegiatan }}</p>
                  </div>
                  <div>
                    <label class="text-sm font-medium text-gray-500">Kategori</label>
                    <p class="text-gray-800">{{ $reviewProposal->jenisKegiatan->nama_jenis_kegiatan }}</p>
                  </div>
                </div>
              </div>

              <!-- Budget Section -->
              <div class="mt-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Rincian Dana</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                  <div class="bg-blue-50 rounded-lg p-4">
                    <p class="text-sm font-medium text-gray-600">Dana DIPA</p>
                    <p class="text-lg font-semibold text-blue-600">Rp {{ number_format($reviewProposal->dana_dipa ?? 0, 0, ',', '.') }}</p>
                  </div>
                  <div class="bg-purple-50 rounded-lg p-4">
                    <p class="text-sm font-medium text-gray-600">Dana Swadaya</p>
                    <p class="text-lg font-semibold text-purple-600">Rp {{ number_format($reviewProposal->dana_swadaya ?? 0, 0, ',', '.') }}</p>
                  </div>
                  <div class="bg-green-50 rounded-lg p-4">
                    <p class="text-sm font-medium text-gray-600">Dana Sponsor</p>
                    <p class="text-lg font-semibold text-green-600">Rp {{ number_format($reviewProposal->dana_sponsor ?? 0, 0, ',', '.') }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Review Form -->
          <form action="{{ route('proposal.store') }}" method="POST" class="bg-white rounded-xl shadow-sm overflow-hidden">
            @csrf
            <div class="p-6">
              <h2 class="text-xl font-semibold text-gray-800 mb-6">
                <i class="fas fa-clipboard-check mr-2 text-blue-500"></i>Form Review
              </h2>

              <!-- Revision Checkboxes -->
              <div class="space-y-4 mb-6">
                <h3 class="font-medium text-gray-700">Dokumen yang Perlu Direvisi</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <label class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
                    <input type="checkbox" name="revisi_items[]" value="Proposal Kegiatan" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                    <span class="ml-3 text-sm font-medium text-gray-700">Proposal Kegiatan</span>
                  </label>
                  <label class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
                    <input type="checkbox" name="revisi_items[]" value="Surat Berkegiatan Ketuplak" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                    <span class="ml-3 text-sm font-medium text-gray-700">Surat Ketuplak</span>
                  </label>
                  <label class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
                    <input type="checkbox" name="revisi_items[]" value="Surat Pernyataan Ormawa" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                    <span class="ml-3 text-sm font-medium text-gray-700">Surat Ormawa</span>
                  </label>
                  <label class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
                    <input type="checkbox" name="revisi_items[]" value="Surat Peminjaman Sarpras" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                    <span class="ml-3 text-sm font-medium text-gray-700">Surat Sarpras</span>
                  </label>
                </div>
              </div>

              <input type="hidden" name="id_proposal" value="{{ $reviewProposal->id_proposal }}">

              <!-- Review Notes -->
              <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2" for="catatan_revisi">Catatan Review</label>
                <textarea
                  name="catatan_revisi"
                  id="catatan_revisi"
                  rows="5"
                  class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none"
                  placeholder="Tuliskan catatan review di sini..."
                ></textarea>
              </div>

              <!-- Status Selection -->
              <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2" for="status_revisi">Status Review</label>
                <select
                  name="status_revisi"
                  id="status_revisi"
                  class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
                  <option value="">Pilih Status</option>
                  <option value="1" class="text-green-600">Setujui</option>
                  <option value="3" class="text-yellow-600">Revisi</option>
                  <option value="2" class="text-red-600">Tolak</option>
                </select>
              </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-4 px-6 py-4 bg-gray-50">
              <button type="button" class="px-6 py-2.5 rounded-lg text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500">
                Batal
              </button>
              <button type="submit" class="px-6 py-2.5 rounded-lg text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Simpan Review
              </button>
            </div>
          </form>
        </div>
      </div>
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

                // ----
    // Tab switching functionality
    document.addEventListener('DOMContentLoaded', function() {
      const tabs = document.querySelectorAll('.tab-btn');
      const contents = document.querySelectorAll('.tab-content');

      tabs.forEach(tab => {
        tab.addEventListener('click', () => {
          // Remove active classes
          tabs.forEach(t => t.classList.remove('bg-blue-50', 'text-blue-600'));
          contents.forEach(c => c.classList.add('hidden'));

          // Add active classes
          tab.classList.add('bg-blue-50', 'text-blue-600');
          const target = document.getElementById(tab.dataset.target);
          if (target) target.classList.remove('hidden');
        });
      });

      // Activate first tab by default
      tabs[0].click();
    });
            </script>
        </div>
    </div>
</section>
@endsection
