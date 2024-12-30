@extends('proposal_kegiatan\pengaju')
@section('konten')

{{-- Untuk pengecekan --}}
<p>Proposal: {{ $proposal }}</p>
<p>Current Step: {{ $currentStep }}</p>
<p>Updated By Step: {{ $updatedByStep }}</p>
<p>Status: {{ $status }}</p>
<p>Status LPJ: {{ $status_lpj }}</p>

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
                <h3 class="font-medium text-gray-900">BEM</h3>
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
                <h3 class="font-medium text-gray-900">Pembina</h3>
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
                <h3 class="font-medium text-gray-900">Ketua Jurusan</h3>
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
                    <h3 class="font-medium text-gray-900">KLI</h3>
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
                <h3 class="font-medium text-gray-900">WADIR 3</h3>
            </div>
        </li>

        {{-- Step 6 --}}
        {{-- <li class="relative w-full mb-6">
            <div class="flex items-center">
                <div class="z-10 flex items-center justify-center w-6 h-6 {{ $currentStep >= 6 ? 'bg-blue-600' : 'bg-gray-200' }} rounded-full ring-0 ring-white sm:ring-8 shrink-0">
                    <span class="flex w-3 h-3 {{ $currentStep >= 6 ? 'bg-blue-600' : 'bg-gray-900' }} rounded-full"></span>
                </div>
            </div>
            <div class="mt-3">
                <h3 class="font-medium text-gray-900">WD3</h3>
            </div>
        </li> --}}
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

{{-- Bagian Detail Proposal --}}
@if ($status == 1 || $currentStep < $updatedByStep || $status_lpj == 1)
    @include('proposal_kegiatan.SectionDetail.DetailProposal.detail_only')
@elseif ($status == 0)
    @include('proposal_kegiatan.SectionDetail.DetailProposal.waiting_review')
@elseif ($status == 2)
    @include('proposal_kegiatan.SectionDetail.DetailProposal.rejected')
@elseif ($status == 3)
    @include('proposal_kegiatan.SectionDetail.DetailProposal.revision_form')
@endif

{{-- File Proposal terkini --}}
<div class="container mx-auto mt-5">
    <div class="bg-white p-5 rounded shadow">
        <button class="text-left w-full focus:outline-none" onclick="toggleCollapse('proposal-section')">
            <h2 class="text-2xl font-bold mb-4 flex items-center justify-between">
                Dokumen Proposal
                <span id="toggle-proposal" class="text-lg">[-]</span>
            </h2>
        </button>
        <div id="proposal-section" class="transition-all duration-300">
            <div class="w-full p-6 mx-auto">
                <div class="flex flex-wrap -mx-3">
                    <div class="flex-none w-full max-w-full px-3">
                        <iframe src="{{ asset($filePath) }}" width="800px" height="700px"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto mt-5">
    <div class="bg-white p-5 rounded shadow">
        <button class="text-left w-full focus:outline-none" onclick="toggleCollapse('revision-section')">
            <h2 class="text-2xl font-bold mb-4 flex items-center justify-between">
                Revisi Proposal
                <span id="toggle-revision" class="text-lg">[-]</span>
            </h2>
        </button>
        <div id="revision-section" class="transition-all duration-300">
            <table class="table-auto border-collapse border border-gray-300 w-full text-left">
                <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">Tahap (Reviewer)</th>
                        <th class="border border-gray-300 px-4 py-2">Catatan Revisi</th>
                        <th class="border border-gray-300 px-4 py-2">Tanggal Revisi Terakhir</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($groupedRevisions)
                        @php
                            // Pisahkan catatan_revisi menjadi array
                            $catatanRevisiList = explode(' | ', $groupedRevisions->catatan_revisi);
                        @endphp
                        @foreach ($catatanRevisiList as $catatan)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">Reviewer {{ $groupedRevisions->id_dosen }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $catatan }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ \Carbon\Carbon::parse($groupedRevisions->last_revisi)->format('d-m-Y H:i') }}</td>
                        </tr>
                        @endforeach
                    @else
                    <tr>
                        <td colspan="3" class="border border-gray-300 px-4 py-2 text-center">Tidak ada revisi pada tahap ini.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function toggleCollapse(sectionId) {
        const section = document.getElementById(sectionId);
        const toggleButton = document.getElementById(`toggle-${sectionId.split('-')[0]}`);

        if (section.style.display === "none") {
            section.style.display = "block";
            toggleButton.textContent = "[-]";
        } else {
            section.style.display = "none";
            toggleButton.textContent = "[+]";
        }
    }

    // Set default visibility for sections (expanded)
    document.getElementById('proposal-section').style.display = "none";
    document.getElementById('revision-section').style.display = "none";
</script>


{{-- Next and Prev Button --}}
<div class="flex justify-center items-center mt-4 space-x-4">
    @if ($currentStep != 0)
        <form method="POST" action="{{ route('proposal.prevStep', $proposal->id_proposal) }}">
            @csrf
            <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2">
                Prev
            </button>
        </form>
    @endif
    @if ($currentStep < 5 && ($currentStep < $updatedByStep || $status_lpj == 1))
        <form method="POST" action="{{ route('proposal.nextStep', $proposal->id_proposal) }}">
            @csrf
            <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2">
                Next
            </button>
        </form>
    @elseif ($status_lpj == 1)
        {{-- button untuk pindah ke section lpj --}}
        <form method="POST" action="{{ route('laporan.nextStep', $proposal->id_proposal) }}">
            @csrf
            <!-- Hidden input sebagai penanda -->
            <input type="hidden" name="is_first_access" value="true">
            <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2">
                Next : LPJ
            </button>
        </form>
    @endif
    {{-- Cek kondisi khusus untuk halaman bukti proposal disetujui --}}
    @if (($updatedByStep === 7 && $proposal->status === 1 && $currentStep === 5) || $status_lpj == 1)
        
        <form method="GET" action="{{ route('proposal.generateLinkForProposal', $proposal->id_proposal) }}">
            @csrf
            <button type="submit" class="text-white bg-gradient-to-r from-green-500 via-green-600 to-green-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2">
                Simpan Link Bukti Proposal Disetujui
            </button>
        </form>
        
    @endif
</div>

@endsection