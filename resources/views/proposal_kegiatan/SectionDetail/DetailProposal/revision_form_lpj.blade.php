<div class="container mx-auto mt-5">
    <div class="flex flex-wrap -mx-3">
        <!-- Bagian Kiri: Status dan Hasil Revisi -->
        <div class="w-full px-3 mb-5">
            <div class="p-5 bg-white border border-gray-300 rounded-lg shadow">
                <!-- Judul Status -->
                <h2 class="text-lg font-semibold text-gray-900 mb-3">Status</h2>
                <!-- Konten Status -->
                <div class="p-4 bg-gray-100 rounded-lg">
                    <!-- Di sini nantinya akan memuat status dari database -->
                    <p class="text-gray-700">
                        @if ($latestRevision)
                            @switch($latestRevision->status_revisi)
                                @case(0)
                                    Menunggu
                                    @break
                                @case(1)
                                    Disetujui
                                    @break
                                @case(2)
                                    Ditolak
                                    @break
                                @case(3)
                                    Direvisi
                                    @break
                                @default
                                    Status tidak diketahui
                            @endswitch
                        @else
                            Tidak ada status revisi.
                        @endif
                    </p>
                </div>
                <!-- Judul Hasil Revisi -->
                <h2 class="text-lg font-semibold text-gray-900 mb-3">Catatan Revisi</h2>
                <!-- Konten Hasil Revisi -->
                <div class="p-4 bg-gray-100 rounded-lg">
                    <!-- Section kotak untuk catatan revisi dari database -->
                    <p class="text-gray-700">
                        {{ $latestRevision ? $latestRevision->catatan_revisi : 'Tidak ada catatan revisi.' }}
                    </p>
                </div>
            </div>
        </div>  
    </div>
</div>

@if ($errors->any())
    <div class="mb-4 text-red-500">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<main class="mt-0 transition-all duration-200 ease-soft-in-out">
    <section class="flex items-center justify-center min-h-screen bg-gray-50">
        <div class="container max-w-lg p-8 mx-auto bg-white rounded-3xl shadow-md">
            <h3 class="text-3xl font-extrabold text-center text-gray-800">
                Form Revisi LPJ
            </h3>
            <p class="mt-2 text-center text-gray-500">Silakan isi form di bawah ini</p>
            
            <form class="mt-8" action="{{ route('lpj.uploadFileRevisi', $lpj->id_lpj) }}" method="POST" enctype="multipart/form-data" id="revisionLpjForm" onsubmit="return validateAndConfirm(event)">
                @csrf
        
                <ul class="space-y-6">
                    <!-- Pilih Jenis LPJ -->
                    <li class="flex flex-col">
                        <label for="jenis_lpj" class="mb-2 text-sm font-medium text-gray-700">Jenis LPJ</label>
                            <select id="jenis_lpj" name="jenis_lpj"
                                class="px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 rounded-xl">
                                <option value="">Pilih Jenis LPJ</option>
                                <option value="1" {{ old('jenis_lpj', $lpj->jenis_lpj ?? '') == 1 ? 'selected' : '' }}>LPJ 60%</option>
                                <option value="2" {{ old('jenis_lpj', $lpj->jenis_lpj ?? '') == 2 ? 'selected' : '' }}>LPJ 100%</option>
                            </select>
                        <span class="mt-1 text-sm text-red-500">@error('jenis_lpj') {{ $message }} @enderror</span>
                    </li>
        
                    <!-- Input File LPJ -->
                    <li class="flex flex-col">
                        <label for="file_lpj" class="mb-2 text-sm font-medium text-gray-700">Upload File LPJ</label>
                        <input type="file" id="file_lpj" name="file_lpj"
                            class="block w-full text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:rounded-lg file:text-sm file:bg-blue-500 file:text-white hover:file:bg-blue-600" />
                        <span class="mt-1 text-sm text-red-500">@error('file_lpj') {{ $message }} @enderror</span>
                    </li>

                    <!-- Input File SPJ -->
                    <li class="flex flex-col">
                        <label for="file_spj" class="mb-2 text-sm font-medium text-gray-700">Upload File SPJ</label>
                        <input type="file" id="file_spj" name="file_spj"
                            class="block w-full text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:rounded-lg file:text-sm file:bg-blue-500 file:text-white hover:file:bg-blue-600" />
                        <span class="mt-1 text-sm text-red-500">@error('file_spj') {{ $message }} @enderror</span>
                    </li>

                    <!-- Input File SPTB -->
                    <li class="flex flex-col">
                        <label for="file_sptb" class="mb-2 text-sm font-medium text-gray-700">Upload File SPTB</label>
                        <input type="file" id="file_sptb" name="file_sptb"
                            class="block w-full text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:rounded-lg file:text-sm file:bg-blue-500 file:text-white hover:file:bg-blue-600" />
                        <span class="mt-1 text-sm text-red-500">@error('file_sptb') {{ $message }} @enderror</span>
                    </li>
                </ul>
        
                <!-- Tombol Submit -->
                <div class="mt-6 text-center">
                    <button type="submit"
                        class="w-full px-4 py-3 font-semibold text-white transition-colors duration-300 bg-blue-500 rounded-xl shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </section>
</main>

<!-- Modal Konfirmasi Revisi LPJ -->
<div id="confirmationModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="text-center">
            <svg class="w-16 h-16 text-blue-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Konfirmasi Revisi LPJ</h3>
            <p class="text-gray-600 mb-6">Apakah Anda yakin ingin mengirimkan revisi LPJ ini? Pastikan semua dokumen yang diupload sudah benar dan sesuai dengan catatan revisi.</p>
            <div class="flex flex-col sm:flex-row gap-2 justify-center">
                <button id="cancelSubmit" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors duration-300">
                    Kembali
                </button>
                <button id="confirmSubmit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300">
                    Ya, Kirim Revisi
                </button>
            </div>
        </div>
    </div>
</div>


<script>
    // Fungsi untuk menghapus file input
    function cancelUpload(inputId) {
        document.getElementById(inputId).value = '';
    }

    // Fungsi validasi form dan tampilkan konfirmasi
    function validateAndConfirm(event) {
        event.preventDefault();
        
        // Validasi form dasar
        const form = document.getElementById('revisionLpjForm');
        
        if (form.checkValidity()) {
            // Tampilkan modal konfirmasi
            document.getElementById('confirmationModal').classList.remove('hidden');
        } else {
            // Trigger HTML5 validation
            form.reportValidity();
        }
        
        return false; // Selalu mencegah submit normal
    }

    // Inisialisasi modal konfirmasi
    document.addEventListener('DOMContentLoaded', function() {
        // Handler untuk modal konfirmasi
        const modal = document.getElementById('confirmationModal');
        const cancelBtn = document.getElementById('cancelSubmit');
        const confirmBtn = document.getElementById('confirmSubmit');
        
        cancelBtn.addEventListener('click', function() {
            modal.classList.add('hidden');
        });
        
        confirmBtn.addEventListener('click', function() {
            modal.classList.add('hidden');
            document.getElementById('revisionLpjForm').submit();
        });
    });
</script>