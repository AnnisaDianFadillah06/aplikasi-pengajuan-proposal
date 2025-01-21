@extends('proposal_kegiatan/reviewer')

@section('konten')

<div class="w-full p-6 mx-auto">
    <!-- Main Container -->
    <div class="max-w-7xl mx-auto">
      <!-- Header Section -->
      <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Review SPJ</h1>
        <p class="text-gray-600 mt-2">Review dan evaluasi spj kegiatan mahasiswa</p>
      </div>

      <!-- Tabs Navigation -->
      <div class="mb-6 bg-white rounded-xl shadow-sm p-2">
        <div class="flex flex-wrap gap-2">
          <button class="tab-btn px-6 py-3 rounded-lg text-sm font-medium transition-all hover:bg-blue-50 hover:text-blue-600 focus:ring-2 focus:ring-blue-500 focus:outline-none" data-target="tab-sptb">
            <i class="fas fa-file-alt mr-2"></i>SPTB
          </button>
          <button class="tab-btn px-6 py-3 rounded-lg text-sm font-medium transition-all hover:bg-blue-50 hover:text-blue-600" data-target="tab-spj">
            <i class="fas fa-file-signature mr-2"></i>SPJ
          </button>
          <button class="tab-btn px-6 py-3 rounded-lg text-sm font-medium transition-all hover:bg-blue-50 hover:text-blue-600" data-target="tab-berita-acara">
            <i class="fas fa-university mr-2"></i>Berita Acara
          </button>
          <button class="tab-btn px-6 py-3 rounded-lg text-sm font-medium transition-all hover:bg-blue-50 hover:text-blue-600" data-target="tab-video-kegiatan">
            <i class="fas fa-tools mr-2"></i>Video Kegiatan
          </button>
        </div>
      </div>

      <!-- Main Content Grid -->
      <div class="grid grid-cols-1 lg:grid-cols-1 gap-14">
        <!-- Left Column - Document Preview -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
          <!-- file_sptb Tab -->
          <div class="tab-content hidden" id="tab-sptb">
            <div class="p-4 border-b">
              <h3 class="font-semibold text-gray-800">SPTB</h3>
            </div>
            <div class="p-4">
              <iframe src="{{ route('file.show', ['filename' => $reviewSpj->file_sptb]) }}" class="w-full h-[600px] rounded-lg border"></iframe>
            </div>
          </div>

          <!-- file_spj Tab -->
          <div class="tab-content hidden" id="tab-spj">
            <div class="p-4 border-b">
              <h3 class="font-semibold text-gray-800">SPJ</h3>
            </div>
            <div class="p-4">
              <iframe src="{{ route('file.show', ['filename' => $reviewSpj->file_spj]) }}" class="w-full h-[600px] rounded-lg border"></iframe>
            </div>
          </div>

          <!-- dokumen_berita_acara Tab -->
          <div class="tab-content hidden" id="tab-berita-acara">
            <div class="p-4 border-b">
              <h3 class="font-semibold text-gray-800">Berita Acara</h3>
            </div>
            <div class="p-4">
              <iframe src="{{ route('file.show', ['filename' => $reviewSpj->dokumen_berita_acara]) }}" class="w-full h-[600px] rounded-lg border"></iframe>
            </div>
          </div>

          <!-- video_kegiatan Tab -->
          <div class="tab-content hidden" id="tab-video-kegiatan">
            <div class="p-4 border-b">
              <h3 class="font-semibold text-gray-800">Video Kegiatan</h3>
            </div>
            <div class="p-4">
              @if ($reviewSpj->video_kegiatan)
              <video controls class="w-full max-w-xl mx-auto">
                    <source src="{{ route('file.show', ['filename' => $reviewSpj->video_kegiatan]) }}" type="video/mp4">
                    Browser Anda tidak mendukung pemutaran video ini.
              </video>
              @else
                    <p class="text-center text-gray-600">Video kegiatan tidak tersedia.</p>
                @endif
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
                    <p class="text-gray-800">{{ $reviewSpj->proposalKegiatan->nama_kegiatan }}</p>
                  </div>
                  <div>
                    <label class="text-sm font-medium text-gray-500">Penanggung Jawab</label>
                    <p class="text-gray-800">{{ $reviewSpj->proposalKegiatan->nama_penanggung_jawab }}</p>
                  </div>
                  <div>
                    <label class="text-sm font-medium text-gray-500">Kategori</label>
                    <p class="text-gray-800">{{ $reviewSpj->proposalKegiatan->jenisKegiatan->nama_jenis_kegiatan }}</p>
                  </div>
                  <div>
                    <label class="text-sm font-medium text-gray-500">Caption Video</label>
                    <div class="overflow-y-auto max-h-32 border border-gray-300 p-2 rounded-lg">
                        <p id="caption-text" class="text-gray-800 text-sm">
                            {{ $reviewSpj->caption_video }}
                        </p>
                    </div>
                  </div>
                  <div class="mt-2 flex items-center">
                      <button 
                          id="copy-caption-btn" 
                          class="flex items-center px-2 py-1 text-sm text-white bg-blue-600 hover:bg-blue-700 rounded">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                              <path d="M8 4a1 1 0 011-1h5a2 2 0 012 2v10a2 2 0 01-2 2h-5a1 1 0 01-1-1V4z" />
                              <path d="M4 8a1 1 0 011-1h5a2 2 0 012 2v7a2 2 0 01-2 2H5a1 1 0 01-1-1V8z" />
                          </svg>
                          Salin Caption
                      </button>
                  </div>
                </div>
                
                <div class="space-y-3">
                  <div>
                    <label class="text-sm font-medium text-gray-500">Periode Kegiatan</label>
                    <p class="text-gray-800">{{ $reviewSpj->proposalKegiatan->tanggal_mulai }} - {{ $reviewSpj->proposalKegiatan->tanggal_akhir }}</p>
                  </div>
                  <div>
                    <label class="text-sm font-medium text-gray-500">Tempat</label>
                    <p class="text-gray-800">{{ $reviewSpj->proposalKegiatan->tmpt_kegiatan }}</p>
                  </div>
                  <div>
                    <label class="text-sm font-medium text-gray-500">Kontak</label>
                    <p class="text-gray-800">{{ $reviewSpj->proposalKegiatan->email_penanggung_jawab }}</p>
                    <p class="text-gray-600">{{ $reviewSpj->proposalKegiatan->no_hp_penanggung_jawab }}</p>
                  </div>
                </div>
              </div>

              <!-- Budget Section -->
              <div class="mt-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Rincian Dana</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                  <div class="bg-blue-50 rounded-lg p-4">
                    <p class="text-sm font-medium text-gray-600">Dana DIPA</p>
                    <p class="text-lg font-semibold text-blue-600">Rp {{ number_format($reviewSpj->proposalKegiatan->dana_dipa ?? 0, 0, ',', '.') }}</p>
                  </div>
                  <div class="bg-purple-50 rounded-lg p-4">
                    <p class="text-sm font-medium text-gray-600">Dana Swadaya</p>
                    <p class="text-lg font-semibold text-purple-600">Rp {{ number_format($reviewSpj->proposalKegiatan->dana_swadaya ?? 0, 0, ',', '.') }}</p>
                  </div>
                  <div class="bg-green-50 rounded-lg p-4">
                    <p class="text-sm font-medium text-gray-600">Dana Sponsor</p>
                    <p class="text-lg font-semibold text-green-600">Rp {{ number_format($reviewSpj->proposalKegiatan->dana_sponsor ?? 0, 0, ',', '.') }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Review Form -->
          <form action="{{ route('reviewSPJ.store') }}" method="POST" class="bg-white rounded-xl shadow-sm overflow-hidden">
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
                    <input type="checkbox" name="revisi_items[]" value="SPTB" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                    <span class="ml-3 text-sm font-medium text-gray-700">SPTB</span>
                  </label>
                  <label class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
                    <input type="checkbox" name="revisi_items[]" value="SPJ" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                    <span class="ml-3 text-sm font-medium text-gray-700">SPJ</span>
                  </label>
                  <label class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
                    <input type="checkbox" name="revisi_items[]" value="Berita Acara" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                    <span class="ml-3 text-sm font-medium text-gray-700">Berita Acara</span>
                  </label>
                </div>
              </div>

              <input type="hidden" name="id_spj" value="{{ $reviewSpj->id_spj }}">

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
            <script>
                    document.addEventListener("DOMContentLoaded", function () {
                    const copyButton = document.querySelector("#copy-caption-btn"); // Tombol salin
                    const captionText = document.querySelector("#caption-text"); // Elemen teks caption

                    // Function untuk menyalin teks caption
                    function copyCaption() {
                        if (captionText) {
                            const caption = captionText.textContent; // Ambil teks dari elemen caption
                            navigator.clipboard.writeText(caption)
                                .then(() => {
                                    alert("Caption berhasil disalin!");
                                })
                                .catch(err => {
                                    console.error("Gagal menyalin teks:", err);
                                });
                        }
                    }

                    // Tambahkan event listener ke tombol salin
                    if (copyButton) {
                        copyButton.addEventListener("click", copyCaption);
                    }
                });

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
                    showTab("tab-sptb");
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
