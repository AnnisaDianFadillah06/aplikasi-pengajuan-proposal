@extends('proposal_kegiatan\reviewer')

@section('konten')
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
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
          <button class="tab-btn px-6 py-3 rounded-lg text-sm font-medium transition-all hover:bg-blue-50 hover:text-blue-600" data-target="tab-poster">
            <i class="fas fa-tools mr-2"></i>Poster Kegiatan
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
              <iframe src="{{ route('file.show', ['filename' => $reviewProposal->file_proposal]) }}" class="w-full h-[600px] rounded-lg border"></iframe>
            </div>
          </div>

          <!-- Ketuplak Tab -->
          <div class="tab-content hidden" id="tab-ketuplak">
            <div class="p-4 border-b">
              <h3 class="font-semibold text-gray-800">Surat Berkegiatan Ketuplak</h3>
            </div>
            <div class="p-4">
              <iframe src="{{ route('file.show', ['filename' => $reviewProposal->surat_berkegiatan_ketuplak]) }}" class="w-full h-[600px] rounded-lg border"></iframe>
            </div>
          </div>

          <!-- Ormawa Tab -->
          <div class="tab-content hidden" id="tab-ormawa">
            <div class="p-4 border-b">
              <h3 class="font-semibold text-gray-800">Surat Pernyataan Ormawa</h3>
            </div>
            <div class="p-4">
              <iframe src="{{ route('file.show', ['filename' => $reviewProposal->surat_pernyataan_ormawa]) }}" class="w-full h-[600px] rounded-lg border"></iframe>
            </div>
          </div>

          <!-- Sarpras Tab -->
          <div class="tab-content hidden" id="tab-sarpras">
            <div class="p-4 border-b">
              <h3 class="font-semibold text-gray-800">Surat Peminjaman Sarpras</h3>
            </div>
            <div class="p-4">
              <iframe src="{{ route('file.show', ['filename' => $reviewProposal->surat_peminjaman_sarpras]) }}" class="w-full h-[600px] rounded-lg border"></iframe>
            </div>
          </div>

          <!-- Poster Tab -->
          <div class="tab-content hidden" id="tab-poster">
            <div class="p-4 border-b">
              <h3 class="font-semibold text-gray-800">Poster Kegiatan</h3>
            </div>
            <div class="p-4">
            <img src="{{ route('file.show', ['filename' => $reviewProposal->poster_kegiatan]) }}" alt="Gambar Kegiatan" class="w-full rounded-lg shadow-md">
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
                    <label class="text-sm font-medium text-gray-500">Jumlah Panitia</label>
                    <p class="text-gray-800">{{ $reviewProposal->jml_panitia }}</p>
                  </div>
                  <div>
                    <label class="text-sm font-medium text-gray-500">Jumlah Peserta</label>
                    <p class="text-gray-800">{{ $reviewProposal->jml_peserta }}</p>
                  </div>
                  <div>
                    <label class="text-sm font-medium text-gray-500">Caption Poster</label>
                    <div class="overflow-y-auto max-h-32 border border-gray-300 p-2 rounded-lg">
                        <p id="caption-text" class="text-gray-800 text-sm">
                            {{ $reviewProposal->caption_poster }}
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
                  <div>
                    <label class="text-sm font-medium text-gray-500">Kontak</label>
                    <p class="text-gray-800">{{ $reviewProposal->email_penanggung_jawab }}</p>
                    <p class="text-gray-600">{{ $reviewProposal->no_hp_penanggung_jawab }}</p>
                  </div>
                  
                  <div>
                    <br>
                    <a href="{{ $reviewProposal->link_surat_izin_ortu }}" 
                    class="px-6 py-2.5 rounded-lg text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Lihat Surat Izin Orang Tua
                    </a>
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
              @if (session('id_role') == 2)
              <div id="checkbox-container" class="mb-6 hidden">
                  <label class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
                    <input type="checkbox" id="checkbox_menyetujui"
                    name="menyetujui" value="Pendamping" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                    <span class="ml-3 text-sm font-medium text-gray-700">Dengan ini saya menyatakan menyetujui kegiatan ini. Saya, selaku pembina, bersedia untuk membimbing dan mendampingi para panitia serta seluruh peserta, serta bertanggung jawab atas segala hal yang terjadi selama kegiatan tersebut berlangsung.</span>
                  </label>
              </div>
              @endif
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-4 px-6 py-4 bg-gray-50">
              <button type="button" class="px-6 py-2.5 rounded-lg text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500">
                Batal
              </button>
              <button
                id="submit_button"
                type="submit"
                class="px-6 py-2.5 rounded-lg text-sm font-medium text-white 
                    {{ session('id_role') == 5 && session('error') ? 'bg-red-600 hover:bg-red-700 focus:ring-red-500' : 'bg-blue-600 hover:bg-blue-700 focus:ring-blue-500' }} 
                    focus:outline-none" disabled>
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


                // Ambil id_role dari blade ke dalam JavaScript
                const idRole = {{ session('id_role') }};
                
                if (idRole === 2) {
                    const statusRevisi = document.getElementById('status_revisi');
                    const checkboxContainer = document.getElementById('checkbox-container');
                    const checkboxMenyetujui = document.getElementById('checkbox_menyetujui');
                    const submitButton = document.getElementById('submit_button');

                    // Fungsi untuk mengecek kondisi dan mengaktifkan/menonaktifkan tombol submit
                    function validateForm() {
                        if (statusRevisi.value === '1') {
                            // Jika status "Setujui" dipilih
                            checkboxContainer.classList.remove('hidden');
                            
                            // Periksa kondisi checkbox
                            if (checkboxMenyetujui.checked) {
                                toggleButtonState(false, ""); // Aktifkan tombol
                            } else {
                                toggleButtonState(true, "Centang persetujuan untuk mengaktifkan tombol");
                            }
                        } else {
                            // Jika status selain "Setujui" dipilih
                            checkboxContainer.classList.add('hidden');
                            toggleButtonState(false, ""); // Selalu aktifkan tombol
                        }
                    }

                    // Fungsi toggle untuk mengatur tombol disabled/aktif
                    function toggleButtonState(isDisabled, tooltipText) {
                        submitButton.disabled = isDisabled;

                        if (isDisabled) {
                            // Jika tombol disabled
                            submitButton.classList.add('cursor-not-allowed', 'bg-gray-400');
                            submitButton.classList.remove('bg-blue-600', 'hover:bg-blue-700');
                            submitButton.setAttribute('title', tooltipText);
                        } else {
                            // Jika tombol aktif
                            submitButton.classList.remove('cursor-not-allowed', 'bg-gray-400');
                            submitButton.classList.add('bg-blue-600', 'hover:bg-blue-700');
                            submitButton.removeAttribute('title');
                        }
                    }

                    // Event listener untuk dropdown status_revisi
                    statusRevisi.addEventListener('change', validateForm);

                    // Event listener untuk checkbox_menyetujui
                    checkboxMenyetujui.addEventListener('change', validateForm);
                } else {
                    // Jika id_role bukan 2, tombol tetap aktif
                    const submitButton = document.getElementById('submit_button');
                    submitButton.disabled = false;
                }


            </script>
        </div>
    </div>
</section>
@endsection
