@extends('proposal_kegiatan\reviewer')

@section('konten')

<div class="w-full p-6 mx-auto">
    <!-- Main Container -->
    <div class="max-w-7xl mx-auto">
      <!-- Header Section -->
      <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Review LPJ</h1>
        <p class="text-gray-600 mt-2">Review dan evaluasi proposal kegiatan mahasiswa</p>
      </div>

      <!-- Tabs Navigation -->
      <div class="mb-6 bg-white rounded-xl shadow-sm p-2">
        <div class="flex flex-wrap gap-2">
          <button class="tab-btn px-6 py-3 rounded-lg text-sm font-medium transition-all hover:bg-blue-50 hover:text-blue-600 focus:ring-2 focus:ring-blue-500 focus:outline-none" data-target="tab-lpj">
            <i class="fas fa-file-alt mr-2"></i>LPJ Ormawa
          </button>
          <button class="tab-btn px-6 py-3 rounded-lg text-sm font-medium transition-all hover:bg-blue-50 hover:text-blue-600" data-target="tab-spj">
            <i class="fas fa-file-signature mr-2"></i>SPJ Ormawa
          </button>
          <button class="tab-btn px-6 py-3 rounded-lg text-sm font-medium transition-all hover:bg-blue-50 hover:text-blue-600" data-target="tab-sptb">
            <i class="fas fa-university mr-2"></i>SPTB Ormawa
          </button>
        </div>
      </div>

      <!-- Main Content Grid -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Left Column - Document Preview -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
          <!-- Proposal Tab -->
          <div class="tab-content hidden" id="tab-lpj">
            <div class="p-4 border-b">
              <h3 class="font-semibold text-gray-800">LPJ Ormawa</h3>
            </div>
            <div class="p-4">
              <iframe src="{{ route('file.show', ['filename' => $reviewLpj->file_lpj]) }}" class="w-full h-[600px] rounded-lg border"></iframe>
            </div>
          </div>

          <!-- Ketuplak Tab -->
          <div class="tab-content hidden" id="tab-spj">
            <div class="p-4 border-b">
              <h3 class="font-semibold text-gray-800">SPJ Ormawa</h3>
            </div>
            <div class="p-4">
              <iframe src="{{ route('file.show', ['filename' => $reviewLpj->file_spj]) }}" class="w-full h-[600px] rounded-lg border"></iframe>
            </div>
          </div>

          <!-- Ormawa Tab -->
          <div class="tab-content hidden" id="tab-sptb">
            <div class="p-4 border-b">
              <h3 class="font-semibold text-gray-800">SPTB Ormawa</h3>
            </div>
            <div class="p-4">
              <iframe src="{{ route('file.show', ['filename' => $reviewLpj->file_sptb]) }}" class="w-full h-[600px] rounded-lg border"></iframe>
            </div>
          </div>
          </div>
        

        <!-- Right Column - Review Form -->
        <div class="space-y-6">
          <!-- Information Card -->
          <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="p-6">
              <h2 class="text-xl font-semibold text-gray-800 mb-4">
                <i class="fas fa-info-circle mr-2 text-blue-500"></i>Informasi LPJ
              </h2>
              <!-- Event Details Grid -->
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-3">
                  <div>
                    <label class="text-sm font-medium text-gray-500">Nama Ormawa</label>
                    <p class="text-gray-800">{{ $reviewLpj->ormawa->nama_ormawa }}</p>
                  </div>
                  <div>
                    <label class="text-sm font-medium text-gray-500">Tanggal Diajukan</label>
                    <p class="text-gray-800">{{ \Carbon\Carbon::parse($reviewLpj->updated_at)->format('Y-m-d') }}</p>
                  </div>
                </div>
                <div class="space-y-3">
                  <div>
                    <label class="text-sm font-medium text-gray-500">Jenis LPJ</label>
                    @if ($reviewLpj->jenis_lpj == 1)
                      <p class="text-gray-800">60%</p>
                    @elseif ($reviewLpj->jenis_lpj == 2)
                      <p class="text-gray-800">100%</p>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Review Form -->
          <form action="{{ route('reviewLPJ.store') }}" method="POST" class="bg-white rounded-xl shadow-sm overflow-hidden">
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
                    <input type="checkbox" name="revisi_items[]" value="LPJ" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                    <span class="ml-3 text-sm font-medium text-gray-700">LPJ</span>
                  </label>
                  <label class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
                    <input type="checkbox" name="revisi_items[]" value="SPJ" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                    <span class="ml-3 text-sm font-medium text-gray-700">SPJ</span>
                  </label>
                  <label class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
                    <input type="checkbox" name="revisi_items[]" value="SPTB" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                    <span class="ml-3 text-sm font-medium text-gray-700">SPTB</span>
                  </label>
                </div>
              </div>

              <input type="hidden" name="id_lpj" value="{{ $reviewLpj->id_lpj }}">

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
                    showTab("tab-lpj");
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
