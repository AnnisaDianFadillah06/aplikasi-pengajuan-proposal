@extends('proposal_kegiatan/pengaju')
@section('konten')


{{-- <p>Proposal: {{ $proposal }}</p>
<p>Current Step: {{ $currentStep }}</p>
<p>Updated By Step: {{ $updatedByStep }}</p>
<p>Status: {{ $status }}</p>
<p>Status LPJ: {{ $status_lpj }}</p>
<h1>ini teh LPJJJJ</h1> --}}

@php
    use App\Models\Reviewer;
    use App\Models\Ormawa;

    // Ambil model reviewer berdasarkan id_pengguna dari updated_by
    $reviewer = Reviewer::find($proposal->updated_by);
    $ormawa = Ormawa::find($proposal->id_ormawa);

    // Nama ormawa yang diambil dari relasi tabel
    $nama_ormawa = $ormawa->nama_ormawa ?? '';

        
        // echo "Nama Jabatan: " . ($role ?? 'Tidak ada jabatan');
        // echo "Nama Ormawa: " . ($nama_ormawa ?? 'Tidak ada ormawa');
        // echo "\nStatus : ". ($proposal->status);
    // Output untuk debugging
@endphp

{{-- Progress bar --}}
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

{{-- alert sukses upload form revisi --}}
@if (session('success'))
    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
        {{ session('success') }}
    </div>
@endif
@if ($errors->any())
    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


{{-- Bagian Detail proposal --}}
@if ($proposal->status == 1 || $currentStep < $updatedByStep)
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

{{-- Bagian Detail proposal + Menunggu revisi--}}
@elseif ($proposal->status == 0)
    {{-- Tampilkan Detail Proposal dengan Keterangan menunggu --}}
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

            <div class="mt-4 p-3 bg-yellow-100 text-yellow-700 rounded">
                <p>Laporan pertanggungjawaban ini sedang menunggu review.</p>
            </div>            
        </div>
    </div>


{{-- Bagian Detail proposal + Ditolak --}}
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
                <p>Laporan pertanggungjawaban ini telah ditolak.</p>
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
                    <h2 class="text-lg font-semibold text-gray-900 mb-3">Hasil Revisi</h2>
                    <!-- Konten Hasil Revisi -->
                    <div class="p-4 bg-gray-100 rounded-lg">
                        <!-- Section kotak untuk catatan revisi dari database -->
                        <p class="text-gray-700">
                            {{ $latestRevision ? $latestRevision->catatan_revisi : 'Tidak ada catatan revisi.' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Bagian Kanan: Form Input Attachment File -->
            <div class="w-full md:w-1/2 px-3">
                <div class="p-5 bg-white border border-gray-300 rounded-lg shadow">
                    <form action="{{ route('proposal.uploadFileRevisi', $proposal->id_proposal) }}" method="POST" enctype="multipart/form-data" class="max-w-lg">
                        @csrf
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="file_revisian">Upload File Revisi</label>
                        <input type="file" name="file_revisian" id="file_revisian" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                        
                        @error('file_revisian')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
            
                        <!-- Tombol Close dan Simpan -->
                        <div class="flex flex-wrap items-center justify-end p-3 border-t border-solid shrink-0 border-slate-100 rounded-b-xl">
                            <button type="button" class="inline-block px-8 py-2 m-1 mb-4 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer bg-gradient-to-tl from-slate-600 to-slate-300 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">Close</button>
                            <button type="submit" class="inline-block px-8 py-2 m-1 mb-4 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer bg-gradient-to-tl from-purple-700 to-pink-500 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif

{{-- Next and Prev Button --}}
<div class="flex justify-center items-center mt-4 space-x-4">
    @if ($currentStep != 0)
        <form method="POST" action="{{ route('laporan.prevStep', $proposal->id_proposal) }}">
            @csrf
            <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2">
                Prev
            </button>
        </form>
    @elseif ($currentStep == 0)
        <form method="POST" action="{{ route('proposal.prevStep', $proposal->id_proposal) }}">
            @csrf
            <!-- Hidden input sebagai penanda -->
            <input type="hidden" name="is_first_access" value="true">
            <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2">
                Prev : proposal
            </button>
        </form>
    @endif
    @if ($currentStep < $updatedByStep)
        <form method="POST" action="{{ route('laporan.nextStep', $proposal->id_proposal) }}">
            @csrf
            <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2">
                Next
            </button>
        </form>
    @endif
    {{-- Cek kondisi khusus untuk halaman bukti proposal disetujui --}}
    
    @if ($updatedByStep === 6 && $proposal->status === 1 && $currentStep === 6)
    <form method="GET" action="{{ route('laporan.approvalProof', $proposal->id_proposal) }}">
        @csrf
        <button type="submit" class="text-white bg-gradient-to-r from-green-500 via-green-600 to-green-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2">
            Bukti LPJ Disetujui
        </button>
    </form>
    @endif
</div>

@endsection