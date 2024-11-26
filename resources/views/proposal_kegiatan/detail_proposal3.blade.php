@extends('welcome')
@section('konten')

@php
    use App\Models\Reviewer;
    use App\Models\Ormawa;

    // Ambil model reviewer berdasarkan id_pengguna dari updated_by
    $reviewer = Reviewer::find($proposal->updated_by);
    $ormawa = Ormawa::find($proposal->id_ormawa);

    // Inisialisasi variabel currentStep
    $currentStep = 0; // Default step adalah 0 untuk "Submit Proposal"

    // Nama ormawa yang diambil dari relasi tabel
    $nama_ormawa = $ormawa->nama_ormawa ?? '';

    if ($reviewer) {
        $role = $reviewer->role;
        
        // Set currentStep berdasarkan role
        switch ($role) {
            case 'sekbem':
                $currentStep = 1;
                break;
            case 'kabem':
                $currentStep = 2;
                break;
            case 'pembina':
                $currentStep = 3;
                break;
            case 'kajur':
                $currentStep = 4;
                break;
            case 'kli':
                $currentStep = 5;
                break;
                case 'wd3':
                $currentStep = 6;
                break;
            }
        }
        
        // echo "Nama Jabatan: " . ($role ?? 'Tidak ada jabatan');
        // echo "Nama Ormawa: " . ($nama_ormawa ?? 'Tidak ada ormawa');
        // echo "\nStatus : ". ($proposal->status);
    // Output untuk debugging
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
@if ($proposal->status == 0 || $proposal->status == 1)
    {{-- Tampilkan Detail Proposal saja --}}
    {{-- Bagian Detail Proposal --}}
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

@elseif ($proposal->status == 2)
    {{-- Tampilkan Detail Proposal dengan Keterangan Ditolak --}}
    {{-- Bagian Detail Proposal --}}
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
                    <td class="px-4 py-2">{{ $proposal->jenisKegiatan->nama_jenis_kegiatan }}</td>
                </tr>
                <tr>
                    <th class="text-left px-4 py-2">Asal Ormawa</th>
                    <td class="px-4 py-2">{{ $proposal->ormawa->nama_ormawa }}</td>
                </tr>
            </table>

            <div class="mt-4 p-3 bg-red-100 text-red-700 rounded">
                <p>Proposal ini telah ditolak.</p>
            </div>
        </div>
    </div>


{{-- Bagian form revisi --}}
@elseif ($proposal->status == 3)
    {{-- Tampilkan Form Revisi --}}
    {{-- Bagian Form Revisi --}}
    <div class="container mx-auto mt-5">
        <div class="flex flex-wrap -mx-3">
            <!-- Bagian Kiri: Status dan Hasil Revisi -->
            <div class="w-full md:w-1/2 px-3 mb-5">
                <div class="p-5 bg-white border border-gray-300 rounded-lg shadow">
                    <!-- Judul Status -->
                    <h2 class="text-lg font-semibold text-gray-900 mb-3">Status</h2>
                    <!-- Konten Status -->
                    <div class="p-4 bg-gray-100 rounded-lg">
                        <!-- Di sini nantinya akan memuat status dari database -->
                        <p class="text-gray-700">[Isi Status]</p>
                    </div>
                    <!-- Judul Hasil Revisi -->
                    <h2 class="text-lg font-semibold text-gray-900 mb-3">Hasil Revisi</h2>
                    <!-- Konten Hasil Revisi -->
                    <div class="p-4 bg-gray-100 rounded-lg">
                        <!-- Section kotak untuk catatan revisi dari database -->
                        <p class="text-gray-700">[Catatan Revisi]</p>
                    </div>
                </div>

            </div>

            <!-- Bagian Kanan: Form Input Attachment File -->
            <div class="w-full md:w-1/2 px-3">
                <div class="p-5 bg-white border border-gray-300 rounded-lg shadow">
                    <form class="max-w-lg">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="user_avatar">Upload file</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="user_avatar_help" id="user_avatar" type="file">
                        <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="user_avatar_help">
                            A profile picture is useful to confirm you are logged into your account
                        </div>

                        <!-- Tombol Close dan Simpan -->
                        <div class="flex flex-wrap items-center justify-end p-3 border-t border-solid shrink-0 border-slate-100 rounded-b-xl">
                            <button type="button"  class="inline-block px-8 py-2 m-1 mb-4 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-gradient-to-tl from-slate-600 to-slate-300 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">Close</button>
                            <button type="submit" class="inline-block px-8 py-2 m-1 mb-4 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-gradient-to-tl from-purple-700 to-pink-500 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif

{{-- Next and Prev Button --}}
<div class="flex justify-center items-center mt-4 space-x-4">
    <button type="button" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2">
        Prev
    </button>
    <button type="button" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2">
        Next
    </button>
</div>


@endsection