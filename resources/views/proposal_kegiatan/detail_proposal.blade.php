@extends('welcome')
@section('konten')

@php
    use App\Models\Pengguna;
    use App\Models\Ormawa;

    // Ambil model pengguna berdasarkan id_pengguna dari updated_by
    $pengguna = Pengguna::find($proposal->updated_by);
    $ormawa = Ormawa::find($proposal->id_ormawa);

    // Inisialisasi variabel currentStep
    $currentStep = 0; // Default step adalah 0 untuk "Submit Proposal"

     // Nama ormawa yang diambil dari relasi tabel
     $nama_ormawa = $ormawa->nama_ormawa ?? '';

    if ($pengguna) {
        // Cek apakah pengguna merupakan dosen
        if ($pengguna->dosen) {
            $nama_jabatan = $pengguna->dosen->jabatan;  //model pengguna memanggil metode dosen kolom jabatan 
            switch ($nama_jabatan) {
                case 'pembina':
                    $currentStep = 3;
                    break;
                case 'ketua jurusan':
                    $currentStep = 4;
                    break;
                case 'KLI':
                    $currentStep = 5;
                    break;
                case 'WD3':
                    $currentStep = 6;
                    break;
            }
        }

        // Cek apakah pengguna merupakan mahasiswa
        elseif ($pengguna->mahasiswa) {
            $nama_jabatan = $pengguna->mahasiswa->jabatan;  //model pengguna memanggil metode mahasiswa kolom jabatan 
            switch ($nama_jabatan) {
                case 'sekBEM':
                    $currentStep = 1;
                    break;
                case 'kaBEM':
                    $currentStep = 2;
                    break;
            }
        }
    }

    // Output untuk debugging
    // echo "Nama Jabatan: " . ($nama_jabatan ?? 'Tidak ada jabatan');
    // echo "Nama Ormawa: " . ($nama_ormawa ?? 'Tidak ada ormawa');

@endphp
<div class="flex justify-center items-center">
    <ol class="flex items-center w-full max-w-4xl mx-auto">
        {{-- Step 0 --}}
        <li class="relative w-full mb-6">
            <div class="flex items-center">
                <div class="z-10 flex items-center justify-center w-6 h-6 {{ $currentStep >= 0 ? 'bg-blue-600' : 'bg-gray-200' }} rounded-full ring-0 ring-white sm:ring-8 shrink-0">
                    <span class="flex w-3 h-3 {{ $currentStep >= 0 ? 'bg-blue-600' : 'bg-gray-900' }} rounded-full"></span>
                </div>
                <div class="flex w-full bg-gray-200 h-0.5"></div>
            </div>
            <div class="mt-3">
                <h3 class="font-medium text-gray-900">Submit</h3>
            </div>
        </li>

        {{-- Step 1 --}}
        <li class="relative w-full mb-6">
            <div class="flex items-center">
                <div class="z-10 flex items-center justify-center w-6 h-6 {{ $currentStep >= 1 ? 'bg-blue-600' : 'bg-gray-200' }} rounded-full ring-0 ring-white sm:ring-8 shrink-0">
                    <span class="flex w-3 h-3 {{ $currentStep >= 1 ? 'bg-blue-600' : 'bg-gray-900' }} rounded-full"></span>
                </div>
                <div class="flex w-full bg-gray-200 h-0.5"></div>
            </div>
            <div class="mt-3">
                <h3 class="font-medium text-gray-900">Sekre BEM</h3>
            </div>
        </li>

        {{-- Step 2 --}}
        <li class="relative w-full mb-6">
            <div class="flex items-center">
                <div class="z-10 flex items-center justify-center w-6 h-6 {{ $currentStep >= 2 ? 'bg-blue-600' : 'bg-gray-200' }} rounded-full ring-0 ring-white sm:ring-8 shrink-0">
                    <span class="flex w-3 h-3 {{ $currentStep >= 2 ? 'bg-blue-600' : 'bg-gray-900' }} rounded-full"></span>
                </div>
                <div class="flex w-full bg-gray-200 h-0.5"></div>
            </div>
            <div class="mt-3">
                <h3 class="font-medium text-gray-900">Ketua BEM</h3>
            </div>
        </li>

        {{-- Step 3 --}}
        <li class="relative w-full mb-6">
            <div class="flex items-center">
                <div class="z-10 flex items-center justify-center w-6 h-6 {{ $currentStep >= 3 ? 'bg-blue-600' : 'bg-gray-200' }} rounded-full ring-0 ring-white sm:ring-8 shrink-0">
                    <span class="flex w-3 h-3 {{ $currentStep >= 3 ? 'bg-blue-600' : 'bg-gray-900' }} rounded-full"></span>
                </div>
                <div class="flex w-full bg-gray-200 h-0.5"></div>
            </div>
            <div class="mt-3">
                <h3 class="font-medium text-gray-900">Pembina</h3>
            </div>
        </li>

        {{-- Step 4 --}}
        @if (!str_contains($nama_ormawa, 'UKM') && !str_contains($nama_ormawa, 'BEM') && !str_contains($nama_ormawa, 'MPM'))
            <li class="relative w-full mb-6">
                <div class="flex items-center">
                    <div class="z-10 flex items-center justify-center w-6 h-6 {{ $currentStep >= 4 ? 'bg-blue-600' : 'bg-gray-200' }} rounded-full ring-0 ring-white sm:ring-8 shrink-0">
                        <span class="flex w-3 h-3 {{ $currentStep >= 4 ? 'bg-blue-600' : 'bg-gray-900' }} rounded-full"></span>
                    </div>
                    <div class="flex w-full bg-gray-200 h-0.5"></div>
                </div>
                <div class="mt-3">
                    <h3 class="font-medium text-gray-900">Ketua Jurusan</h3>
                </div>
            </li>
        @endif

        {{-- Step 5 --}}
        <li class="relative w-full mb-6">
            <div class="flex items-center">
                <div class="z-10 flex items-center justify-center w-6 h-6 {{ $currentStep >= 5 ? 'bg-blue-600' : 'bg-gray-200' }} rounded-full ring-0 ring-white sm:ring-8 shrink-0">
                    <span class="flex w-3 h-3 {{ $currentStep >= 5 ? 'bg-blue-600' : 'bg-gray-900' }} rounded-full"></span>
                </div>
                <div class="flex w-full bg-gray-200 h-0.5"></div>
            </div>
            <div class="mt-3">
                <h3 class="font-medium text-gray-900">KLI</h3>
            </div>
        </li>

        {{-- Step 6 --}}
        <li class="relative w-full mb-6">
            <div class="flex items-center">
                <div class="z-10 flex items-center justify-center w-6 h-6 {{ $currentStep >= 6 ? 'bg-blue-600' : 'bg-gray-200' }} rounded-full ring-0 ring-white sm:ring-8 shrink-0">
                    <span class="flex w-3 h-3 {{ $currentStep >= 6 ? 'bg-blue-600' : 'bg-gray-900' }} rounded-full"></span>
                </div>
            </div>
            <div class="mt-3">
                <h3 class="font-medium text-gray-900">WD3</h3>
            </div>
        </li>
    </ol>
</div>


{{-- Bagian Detail proposal --}}
<div class="container mx-auto mt-5">
    <div class="bg-white p-5 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Detail Proposal</h2>
        
        <table class="table-auto w-full">
            <tr>
                <th class="text-left px-4 py-2">Nama Kegiatan</th>
                <td class="px-4 py-2">{{ $proposal->nama_kegiatan }}</td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2">Tanggal Kegiatan</th>
                <td class="px-4 py-2">{{ $proposal->tgl_kegiatan }}</td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2">Tempat Kegiatan</th>
                <td class="px-4 py-2">{{ $proposal->tmpt_kegiatan }}</td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2">Kategori</th>
                <td class="px-4 py-2">{{ $proposal->jenisKegiatan->nama_jenis_kegiatan }}</td> <!--  ada relasi dengan tabel jenis kegiatan -->
            </tr>
            <tr>
                <th class="text-left px-4 py-2">Asal Ormawa</th>
                <td class="px-4 py-2">{{ $proposal->ormawa->nama_ormawa }}</td> <!--  ada relasi dengan ormawa -->
            </tr>
        </table>
    </div>
</div>


@endsection