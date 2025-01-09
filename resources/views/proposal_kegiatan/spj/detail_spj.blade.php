@extends('proposal_kegiatan\pengaju')
@section('konten')

{{-- Untuk pengecekan --}}
{{-- <p>Proposal: {{ $spj }}</p>
<p>Current Step: {{ $currentStep }}</p>
<p>Updated By Step: {{ $updatedByStep }}</p>
<p>Status: {{ $status }}</p> --}}


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
@if ($status == 1 || $currentStep < $updatedByStep)
    @include('proposal_kegiatan.SectionDetail.DetailProposal.detail_only')
@elseif ($status == 0)
    @include('proposal_kegiatan.SectionDetail.DetailProposal.waiting_review_spj')
@elseif ($status == 2)
    @include('proposal_kegiatan.SectionDetail.DetailProposal.rejected')
@elseif ($status == 3)
    @include('proposal_kegiatan.SectionDetail.DetailProposal.revision_form_spj')
@endif

{{-- File Proposal terkini --}}
<div class="container mx-auto mt-5">
    <div class="bg-white p-5 rounded shadow">
        <button class="text-left w-full focus:outline-none" onclick="toggleCollapse('proposal-section')">
            <h2 class="text-2xl font-bold mb-4 flex items-center justify-between">
                Dokumen
                <span id="toggle-proposal" class="text-lg">[-]</span>
            </h2>
        </button>
        <div class="flex mb-4 space-x-4">
            <button onclick="toggleSection('proposal-section')" class="nav-btn px-4 py-2 bg-blue-500 text-white rounded" data-target="proposal-section">SPJ</button>
            <button onclick="toggleSection('sptb-section')" class="nav-btn px-4 py-2 bg-blue-500 text-white rounded" data-target="proposal-section">SPTB</button>
            <button onclick="toggleSection('berita-acara-section')" class="nav-btn px-4 py-2 bg-blue-500 text-white rounded" data-target="berita-acara-section">Berita Acara</button>
            <button onclick="toggleSection('bukti-spj-section')" class="nav-btn px-4 py-2 bg-blue-500 text-white rounded" data-target="bukti-spj-section">Bukti SPJ</button>
            <button onclick="toggleSection('video-kegiatan-section')" class="nav-btn px-4 py-2 bg-blue-500 text-white rounded" data-target="video-kegiatan-section">Video Kegiatan</button>
        </div>

        <div id="proposal-section" class="content-section">
            <iframe src="{{ asset($filePath) }}" width="800px" height="700px"></iframe>
        </div>
        <div id="sptb-section" class="content-section">
            <iframe src="{{ asset($filePathSptb) }}" width="800px" height="700px"></iframe>
        </div>
        <div id="berita-acara-section" class="content-section hidden">
            <iframe src="{{ asset($filePathBeritaAcara) }}" width="800px" height="700px"></iframe>
        </div>
        <!-- Bukti SPJ Section -->
        <div id="bukti-spj-section" class="content-section hidden">
            @if ($filePathBuktiSpj)
                <img src="{{ asset($filePathBuktiSpj) }}" alt="Bukti SPJ" class="w-full max-w-xl mx-auto">
            @else
                <p class="text-center text-gray-600">Dokumen bukti SPJ tidak tersedia.</p>
            @endif
        </div>

        <!-- Video Kegiatan Section -->
        <div id="video-kegiatan-section" class="content-section hidden">
            @if ($filePathVideoKegiatan)
                <video controls class="w-full max-w-xl mx-auto">
                    <source src="{{ asset($filePathVideoKegiatan) }}" type="video/mp4">
                    Browser Anda tidak mendukung pemutaran video ini.
                </video>
            @else
                <p class="text-center text-gray-600">Video kegiatan tidak tersedia.</p>
            @endif
        </div>
    </div>
</div>

<div class="container mx-auto mt-5">
    <div class="bg-white p-5 rounded shadow">
        <button class="text-left w-full focus:outline-none" onclick="toggleCollapse('revision-section')">
            <h2 class="text-2xl font-bold mb-4 flex items-center justify-between">
                Revisi SPJ
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

    function toggleDocuments() {
    const navButtons = document.getElementById('nav-buttons');
    const sections = document.querySelectorAll('.content-section');

    // Toggle visibility of navigation buttons and all sections
    isDocumentsVisible = !isDocumentsVisible;

    if (isDocumentsVisible) {
        navButtons.style.display = 'flex'; // Show navigation buttons
        sections.forEach(section => {
            section.style.display = 'none'; // Hide all sections initially
        });
        toggleSection('proposal-section'); // Default to showing the first document (Proposal)
    } else {
        navButtons.style.display = 'none'; // Hide navigation buttons
        sections.forEach(section => {
            section.style.display = 'none'; // Hide all sections
        });
    }
}

    function toggleSection(id) {
    const sections = document.querySelectorAll('.content-section');
    sections.forEach(section => {
        section.style.display = section.id === id ? 'block' : 'none';
    });
}


    // Set default visibility for sections (expanded)
    document.getElementById('proposal-section').style.display = "none";
    document.getElementById('revision-section').style.display = "none";

        document.addEventListener("DOMContentLoaded", function () {
        const navButtons = document.querySelectorAll(".nav-btn");
        const contentSections = document.querySelectorAll(".content-section");

        // Function to show the selected section
        function showSection(targetId) {
            contentSections.forEach(section => {
                section.classList.add("hidden"); // Hide all sections
            });
            document.getElementById(targetId).classList.remove("hidden"); // Show selected section
        }

        // Attach event listener to each navigation button
        navButtons.forEach(button => {
            button.addEventListener("click", function () {
                const target = this.dataset.target;
                showSection(target);

                // Highlight the active button
                navButtons.forEach(btn => btn.classList.remove("bg-blue-700"));
                this.classList.add("bg-blue-700");
            });
        });

        // Show the first section by default
        showSection("proposal-section");
    });
</script>

<div class="flex justify-center items-center mt-4 space-x-4">
    @if ($currentStep != 0)
        <form method="POST" action="{{ route('spj.prevStep', $spj->id_spj) }}">
            @csrf
            <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2">
                Prev
            </button>
        </form>
    @endif
    @if ($currentStep < 5 && ($currentStep < $updatedByStep))
        <form method="POST" action="{{ route('spj.nextStep', $spj->id_spj) }}">
            @csrf
            <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2">
                Next
            </button>
        </form>
    @endif
</div>

@endsection