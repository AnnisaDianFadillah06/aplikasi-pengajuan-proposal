@extends('proposal_kegiatan\pengaju')

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

<main class="mt-0 transition-all duration-200 ease-soft-in-out">
    <section class="flex items-center justify-center min-h-screen bg-gray-50">
        <div class="container max-w-lg p-8 mx-auto bg-white rounded-3xl shadow-md">
            <h3 class="text-3xl font-extrabold text-center text-gray-800">Form Laporan Kegiatan</h3>
            <p class="mt-2 text-center text-gray-500">Silakan isi form di bawah ini</p>
            
            <form class="mt-8" action="{{ route('spj.store') }}" method="post" enctype="multipart/form-data">
                @csrf <!-- Token CSRF Laravel -->
                <input type="hidden" name="id_proposal" value="{{ $id_proposal }}">                
                
                <ul class="space-y-6">
                    <!-- Inputan File SPTB -->
                    <li class="flex flex-col">
                        <label for="file_sptb" class="mb-2 font-semibold text-gray-700">Upload dokumen SPTB</label>
                        <div class="flex items-center space-x-2">
                            <input type="file" id="file_sptb" name="file_sptb" accept=".pdf" 
                                class="block w-full text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:rounded-lg file:text-sm file:bg-blue-500 file:text-white hover:file:bg-blue-600" />
                            <button type="button" onclick="cancelUpload('file_sptb')" 
                                class="inline-flex items-center px-2 py-1 text-sm font-medium text-red-500 border border-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Cancel
                            </button>
                        </div>
                        <span style="color:red">@error('file_sptb') {{ $message }} @enderror</span>
                    </li>

                    <!-- Inputan File SPJ -->
                    <li class="flex flex-col">
                        <label for="file_spj" class="mb-2 font-semibold text-gray-700">Upload SPJ</label>
                        <div class="flex items-center space-x-2">
                            <input type="file" id="file_spj" name="file_spj" accept=".pdf" 
                                class="block w-full text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:rounded-lg file:text-sm file:bg-blue-500 file:text-white hover:file:bg-blue-600" />
                            <button type="button" onclick="cancelUpload('file_spj')" 
                                class="inline-flex items-center px-2 py-1 text-sm font-medium text-red-500 border border-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Cancel
                            </button>
                        </div>
                        <span style="color:red">@error('file_spj') {{ $message }} @enderror</span>
                    </li>
                    
                    <!-- Inputan Dokumen Berita Acara -->
                    <li class="flex flex-col">
                        <label for="dokumen_berita_acara" class="mb-2 font-semibold text-gray-700">Upload Berita acara kegiatan</label>
                        <div class="flex items-center space-x-2">
                            <input type="file" id="dokumen_berita_acara" name="dokumen_berita_acara" accept=".pdf"
                                class="block w-full text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:rounded-lg file:text-sm file:bg-blue-500 file:text-white hover:file:bg-blue-600" />
                            <button type="button" onclick="cancelUpload('dokumen_berita_acara')" 
                                class="inline-flex items-center px-2 py-1 text-sm font-medium text-red-500 border border-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Cancel
                            </button>
                        </div>
                        <span style="color:red">@error('dokumen_berita_acara') {{ $message }} @enderror</span>
                    </li>
                    
                    <!-- Inputan Gambar Bukti Pemberian SPJ -->
                    <li class="flex flex-col">
                        <label for="gambar_bukti_spj" class="mb-2 font-semibold text-gray-700">Upload Gambar Bukti Pemberian SPJ (Image)</label>
                        <div class="flex items-center space-x-2">
                            <input type="file" id="gambar_bukti_spj" name="gambar_bukti_spj" accept="image/*"
                                class="block w-full text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:rounded-lg file:text-sm file:bg-blue-500 file:text-white hover:file:bg-blue-600" />
                            <button type="button" onclick="cancelUpload('gambar_bukti_spj')" 
                                class="inline-flex items-center px-2 py-1 text-sm font-medium text-red-500 border border-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Cancel
                            </button>
                        </div>
                        <span style="color:red">@error('gambar_bukti_spj') {{ $message }} @enderror</span>
                    </li>
                    
                    <!-- Inputan Video Kegiatan -->
                    <li class="flex flex-col">
                        <label for="video_kegiatan" class="mb-2 font-semibold text-gray-700">Upload Video Kegiatan</label>
                        <div class="flex items-center space-x-2">
                            <input type="file" id="video_kegiatan" name="video_kegiatan" accept=".mp4"
                            class="block w-full text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:rounded-lg file:text-sm file:bg-blue-500 file:text-white hover:file:bg-blue-600" />
                            {{-- <button type="button" onclick="cancelUpload('video_kegiatan')" class="px-3 py-1 mt-3 text-white bg-red-500 rounded-lg hover:bg-red-600">Cancel</button> --}}
                            <button type="button" onclick="cancelUpload('video_kegiatan')" 
                                class="inline-flex items-center px-2 py-1 text-sm font-medium text-red-500 border border-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Cancel
                            </button>
                        </div>
                        <span style="color:red">@error('video_kegiatan') {{ $message }} @enderror</span>
                    </li>
                </ul>
                
                <!-- Inputan Caption Video -->
                <li class="flex flex-col">
                    <label for="caption_video" class="mb-2 font-semibold text-gray-700">Caption Video</label>
                    <textarea id="caption_video" name="caption_video" rows="3"
                        class="block w-full p-3 text-gray-700 border rounded-md focus:outline-none focus:ring focus:ring-blue-300"></textarea>
                    <span style="color:red">@error('caption_video') {{ $message }} @enderror</span>
                </li>
                
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

<script>
    // Fungsi untuk menghapus file input
    function cancelUpload(inputId) {
        document.getElementById(inputId).value = '';
    }
</script>
@endsection
