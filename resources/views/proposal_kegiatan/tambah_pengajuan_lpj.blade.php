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

<main class="mt-0 transition-all duration-200 ease-soft-in-out">
    <section class="flex items-center justify-center min-h-screen bg-gray-50">
        <div class="container max-w-lg p-8 mx-auto bg-white rounded-3xl shadow-md">
            <h3 class="text-3xl font-extrabold text-center text-gray-800">
                Form Input LPJ {{ $jenisLpjUntukDiisi == 1 ? '100%' : ($jenisLpjUntukDiisi == 2 ? '60%' : '') }}
            </h3>
            <p class="mt-2 text-center text-gray-500">Silakan isi form di bawah ini</p>
            
            <form class="mt-8" action="{{ route('lpj.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
        
                <ul class="space-y-6">
                    <!-- Pilih Jenis LPJ -->
                    <li class="flex flex-col">
                        <label for="jenis_lpj" class="mb-2 text-sm font-medium text-gray-700">Jenis LPJ</label>
                        
                        @if ($jenisLpjUntukDiisi == 0)
                            <!-- Dropdown Pilihan LPJ -->
                            <select id="jenis_lpj" name="jenis_lpj"
                                class="px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 rounded-xl">
                                <option value="">Pilih Jenis LPJ</option>
                                <option value="1">LPJ 60%</option>
                                <option value="2">LPJ 100%</option>
                            </select>
                        @elseif ($jenisLpjUntukDiisi == 1)
                            <!-- Input Statis untuk LPJ 100% -->
                            <input type="text" id="jenis_lpj" name="jenis_lpj_display" value="LPJ 100%" readonly
                                class="px-4 py-3 border border-gray-300 bg-gray-100 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 rounded-xl">
                            <input type="hidden" id="jenis_lpj" name="jenis_lpj" value="2">
                        @elseif ($jenisLpjUntukDiisi == 2)
                            <!-- Input Statis untuk LPJ 60% -->
                            <input type="text" id="jenis_lpj" name="jenis_lpj_display" value="LPJ 60%" readonly
                                class="px-4 py-3 border border-gray-300 bg-gray-100 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 rounded-xl">
                            <input type="hidden" id="jenis_lpj" name="jenis_lpj" value="1">
                        @endif
                        
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


<script>
    // Fungsi untuk menghapus file input
    function cancelUpload(inputId) {
        document.getElementById(inputId).value = '';
    }
</script>
@endsection
