@extends('proposal_kegiatan/pengaju')

@section('konten')
@if ($errors->any())
    <div class="mb-4 text-red-500">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<main class="min-h-screen py-12">
    <section class="container mx-auto px-4 max-w-2xl">
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <!-- Header Section -->
            <div class="text-center mb-8">
                <h3 class="text-3xl font-extrabold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                    Form Laporan Kegiatan
                </h3>
                <p class="mt-2 text-gray-500">Silakan lengkapi dokumentasi kegiatan Anda</p>
            </div>
            
            <form action="{{ route('spj.store') }}" method="post" enctype="multipart/form-data" class="space-y-6" id="spjForm" onsubmit="return validateAndConfirm(event)">
                @csrf
                <input type="hidden" name="id_proposal" value="{{ $id_proposal }}">
                
                <!-- File Upload Section -->
                <div class="space-y-6">
                    <!-- SPTB Upload -->
                    <div class="rounded-xl border-2 border-dashed border-gray-200 transition-all duration-300 hover:border-blue-400 group">
                        <div class="p-6 relative">
                            <label for="file_sptb" class="block mb-2 font-semibold text-gray-700">Upload dokumen SPTB</label>
                            <div class="relative">
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <svg class="w-8 h-8 text-gray-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <div class="text-center">
                                        <p class="text-sm font-medium text-gray-600 group-hover:text-blue-600">
                                            Drag & drop file PDF atau klik untuk memilih
                                        </p>
                                        <p class="text-xs text-gray-400 mt-1">Maksimal 2MB</p>
                                    </div>
                                </div>
                                <input type="file" id="file_sptb" name="file_sptb" accept=".pdf" 
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" />
                            </div>
                            <div class="preview-sptb hidden mt-4"></div>
                        </div>
                        @error('file_sptb')
                            <p class="mt-1 text-sm text-red-500 px-6">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- SPJ Upload -->
                    <div class="rounded-xl border-2 border-dashed border-gray-200 transition-all duration-300 hover:border-blue-400 group">
                        <div class="p-6 relative">
                            <label for="file_spj" class="block mb-2 font-semibold text-gray-700">Upload SPJ</label>
                            <div class="relative">
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <svg class="w-8 h-8 text-gray-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <div class="text-center">
                                        <p class="text-sm font-medium text-gray-600 group-hover:text-blue-600">
                                            Drag & drop file PDF atau klik untuk memilih
                                        </p>
                                        <p class="text-xs text-gray-400 mt-1">Maksimal 10MB</p>
                                    </div>
                                </div>
                                <input type="file" id="file_spj" name="file_spj" accept=".pdf" 
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" />
                            </div>
                            <div class="preview-spj hidden mt-4"></div>
                        </div>
                        @error('file_spj')
                            <p class="mt-1 text-sm text-red-500 px-6">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Berita Acara Upload -->
                    <div class="rounded-xl border-2 border-dashed border-gray-200 transition-all duration-300 hover:border-blue-400 group">
                        <div class="p-6 relative">
                            <label for="dokumen_berita_acara" class="block mb-2 font-semibold text-gray-700">Upload Berita Acara Kegiatan</label>
                            <div class="relative">
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <svg class="w-8 h-8 text-gray-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <div class="text-center">
                                        <p class="text-sm font-medium text-gray-600 group-hover:text-blue-600">
                                            Drag & drop file PDF atau klik untuk memilih
                                        </p>
                                        <p class="text-xs text-gray-400 mt-1">Maksimal 2MB</p>
                                    </div>
                                </div>
                                <input type="file" id="dokumen_berita_acara" name="dokumen_berita_acara" accept=".pdf" 
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" />
                            </div>
                            <div class="preview-berita-acara hidden mt-4"></div>
                        </div>
                        @error('dokumen_berita_acara')
                            <p class="mt-1 text-sm text-red-500 px-6">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image Upload -->
                    <div class="rounded-xl border-2 border-dashed border-gray-200 transition-all duration-300 hover:border-blue-400 group">
                        <div class="p-6 relative">
                            <label for="gambar_bukti_spj" class="block mb-2 font-semibold text-gray-700">Upload Bukti Gambar SPJ</label>
                            <div class="relative">
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <svg class="w-8 h-8 text-gray-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <div class="text-center">
                                        <p class="text-sm font-medium text-gray-600 group-hover:text-blue-600">
                                            Drag & drop gambar atau klik untuk memilih
                                        </p>
                                        <p class="text-xs text-gray-400 mt-1">JPG, PNG (Maks. 5MB)</p>
                                    </div>
                                </div>
                                <input type="file" id="gambar_bukti_spj" name="gambar_bukti_spj" accept="image/*" 
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" />
                            </div>
                            <div class="preview-gambar hidden mt-4"></div>
                        </div>
                        @error('gambar_bukti_spj')
                            <p class="mt-1 text-sm text-red-500 px-6">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Video Upload -->
                    <div class="rounded-xl border-2 border-dashed border-gray-200 transition-all duration-300 hover:border-blue-400 group">
                        <div class="p-6 relative">
                            <label for="video_kegiatan" class="block mb-2 font-semibold text-gray-700">Upload Video Kegiatan</label>
                            <div class="relative">
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <svg class="w-8 h-8 text-gray-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                    </svg>
                                    <div class="text-center">
                                        <p class="text-sm font-medium text-gray-600 group-hover:text-blue-600">
                                            Drag & drop video atau klik untuk memilih
                                        </p>
                                        <p class="text-xs text-gray-400 mt-1">Format MP4 (Maks. 100MB)</p>
                                    </div>
                                </div>
                                <input type="file" id="video_kegiatan" name="video_kegiatan" accept=".mp4" 
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" />
                            </div>
                            <div class="preview-video hidden mt-4"></div>
                        </div>
                        @error('video_kegiatan')
                            <p class="mt-1 text-sm text-red-500 px-6">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- Caption Video -->
                <div class="space-y-2">
                    <label for="caption_video" class="block font-semibold text-gray-700">Caption Video</label>
                    <textarea 
                        id="caption_video" 
                        name="caption_video" 
                        rows="4"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 resize-none"
                        placeholder="Tulis caption untuk video Anda..."></textarea>
                    @error('caption_video')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-4 px-6 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-medium rounded-xl hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                    Submit Laporan
                </button>
            </form>
        </div>
    </section>
</main>

<!-- Modal Konfirmasi -->
<div id="confirmationModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="text-center">
            <svg class="w-16 h-16 text-blue-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Konfirmasi Pengajuan</h3>
            <p class="text-gray-600 mb-6">Apakah Anda yakin ingin mengajukan laporan kegiatan ini? Pastikan semua dokumen yang diupload sudah benar.</p>
            <div class="flex flex-col sm:flex-row gap-2 justify-center">
                <button id="cancelSubmit" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors duration-300">
                    Kembali
                </button>
                <button id="confirmSubmit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300">
                    Ya, Ajukan Laporan
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
        const form = document.getElementById('spjForm');
        
        if (form.checkValidity()) {
            // Tampilkan modal konfirmasi
            document.getElementById('confirmationModal').classList.remove('hidden');
        } else {
            // Trigger HTML5 validation
            form.reportValidity();
        }
        
        return false; // Selalu mencegah submit normal
    }

    // Inisialisasi ketika dokumen dimuat
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi handler untuk modal konfirmasi
        const modal = document.getElementById('confirmationModal');
        const cancelBtn = document.getElementById('cancelSubmit');
        const confirmBtn = document.getElementById('confirmSubmit');
        
        cancelBtn.addEventListener('click', function() {
            modal.classList.add('hidden');
        });
        
        confirmBtn.addEventListener('click', function() {
            modal.classList.add('hidden');
            document.getElementById('spjForm').submit();
        });
        
        // Fungsi untuk menangani preview dan status file
        handleFileUpload();
    });

    // Fungsi untuk menangani preview dan status file
    function handleFileUpload() {
        const fileInputs = document.querySelectorAll('input[type="file"]');
        const maxSizes = {
            'file_sptb': 10, // 10MB
            'file_spj': 10, // 10MB
            'dokumen_berita_acara': 10, // 10MB
            'gambar_bukti_spj': 5, // 5MB
            'video_kegiatan': 100 // 100MB
        };

        fileInputs.forEach(input => {
            const inputId = input.id;
            const container = input.closest('.rounded-xl');
            let preview = container.querySelector('.preview');

            // Tambahkan div preview jika belum ada
            if (!preview) {
                preview = document.createElement('div');
                preview.className = 'preview hidden mt-4 p-4 bg-gray-50 rounded-lg';
                container.appendChild(preview);
            }

            // Event listener untuk file yang dipilih
            input.addEventListener('change', function(e) {
                const file = this.files[0];
                if (!file) {
                    preview.classList.add('hidden');
                    return;
                }

                // Validasi ukuran file
                const fileSize = file.size / (1024 * 1024); // Convert to MB
                const maxSize = maxSizes[inputId];
                
                if (fileSize > maxSize) {
                    showNotification(`File terlalu besar. Maksimal ${maxSize}MB`, 'error');
                    this.value = ''; // Reset input
                    return;
                }

                // Update UI untuk menunjukkan file yang dipilih
                preview.classList.remove('hidden');
                preview.innerHTML = `
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            ${getFileIcon(file.type)}
                            <div>
                                <p class="text-sm font-medium text-gray-700">${file.name}</p>
                                <p class="text-xs text-gray-500">${formatFileSize(file.size)}</p>
                            </div>
                        </div>
                        <button type="button" 
                            onclick="cancelUpload('${inputId}')"
                            class="text-red-500 hover:text-red-700 transition-colors duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                `;

                // Preview untuk gambar
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.innerHTML += `
                            <div class="mt-3">
                                <img src="${e.target.result}" class="max-h-40 rounded-lg" alt="Preview">
                            </div>
                        `;
                    };
                    reader.readAsDataURL(file);
                }

                showNotification('File berhasil dipilih', 'success');
            });

            // Drag and drop handlers
            container.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.classList.add('border-blue-500', 'bg-blue-50');
            });

            container.addEventListener('dragleave', function(e) {
                e.preventDefault();
                this.classList.remove('border-blue-500', 'bg-blue-50');
            });

            container.addEventListener('drop', function(e) {
                e.preventDefault();
                this.classList.remove('border-blue-500', 'bg-blue-50');
                
                const file = e.dataTransfer.files[0];
                if (file) {
                    // Validasi tipe file sesuai dengan accept attribute
                    const acceptedTypes = input.accept.split(',');
                    const fileType = file.type;
                    const fileExtension = '.' + file.name.split('.').pop();
                    
                    if (acceptedTypes.some(type => 
                        type === fileType || 
                        type === fileExtension || 
                        (type === 'image/*' && fileType.startsWith('image/'))
                    )) {
                        input.files = e.dataTransfer.files;
                        input.dispatchEvent(new Event('change'));
                    } else {
                        showNotification('Tipe file tidak didukung', 'error');
                    }
                }
            });
        });
    }

    // Fungsi untuk menampilkan notifikasi
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg transition-opacity duration-500 ${
            type === 'error' ? 'bg-red-500' :
            type === 'success' ? 'bg-green-500' :
            'bg-blue-500'
        } text-white`;
        
        notification.innerHTML = `
            <div class="flex items-center space-x-2">
                ${getNotificationIcon(type)}
                <p>${message}</p>
            </div>
        `;

        document.body.appendChild(notification);

        // Fade out dan hapus notifikasi
        setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => notification.remove(), 500);
        }, 3000);
    }

    // Fungsi helper untuk format ukuran file
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    // Fungsi untuk mendapatkan icon file berdasarkan tipe
    function getFileIcon(fileType) {
        if (fileType.startsWith('image/')) {
            return `<svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>`;
        } else if (fileType === 'video/mp4') {
            return `<svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
            </svg>`;
        } else {
            return `<svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>`;
        }
    }

    // Fungsi untuk mendapatkan icon notifikasi
    function getNotificationIcon(type) {
        switch (type) {
            case 'success':
                return `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>`;
            case 'error':
                return `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>`;
            default:
                return `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>`;
        }
    }
</script>
@endsection
