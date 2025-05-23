@extends('proposal_kegiatan/pengaju')
@section('konten')

{{-- Untuk pengecekan --}}
{{-- <p>Proposal: {{ $spj }}</p>
<p>Current Step: {{ $currentStep }}</p>
<p>Updated By Step: {{ $updatedByStep }}</p>
<p>Status: {{ $status }}</p> --}}


{{-- Progress bar --}}
<div class="flex justify-center items-center p-6 bg-gray-50">
    <div class="w-full max-w-5xl">
        <!-- Stepper Container -->
        <div class="relative">
            <!-- Progress Bar Background -->
            <div class="absolute top-[2.25rem] left-0 w-full h-1 bg-gray-200"></div>
            
            <!-- Progress Bar Active -->
            <div class="absolute top-[2.25rem] left-0 h-1 transition-all duration-500 bg-gradient-to-r from-blue-600 to-blue-400" 
                 style="width: calc({{ $currentStep }} * 20%)">
            </div>

            <!-- Steps -->
            <ol class="relative flex justify-between w-full">
                <!-- Step 0: Submit -->
                <li class="flex flex-col items-center">
                    <div class="flex items-center justify-center mb-4">
                        <div class="relative">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full transition-all duration-300 
                                {{ $currentStep >= 0 ? 'bg-blue-600 shadow-lg shadow-blue-200' : 'bg-gray-200' }} 
                                {{ $updatedByStep == 0 ? 'ring-4 ring-blue-400 animate-pulse scale-110' : '' }}">
                                <i class="fas fa-paper-plane text-lg {{ $currentStep >= 0 ? 'text-white' : 'text-gray-500' }}"></i>
                            </div>
                            @if($currentStep >= 0)
                            <div class="absolute -right-1 -top-1 w-5 h-5 rounded-full bg-green-500 border-2 border-white flex items-center justify-center">
                                <i class="fas fa-check text-xs text-white"></i>
                            </div>
                            @endif
                        </div>
                    </div>
                    <h3 class="text-sm font-semibold {{ $currentStep >= 0 ? 'text-blue-600' : 'text-gray-500' }}">Submit</h3>
                    <p class="text-xs text-gray-500 mt-1">Pengajuan</p>
                </li>

                <!-- Step 1: BEM -->
                <li class="flex flex-col items-center">
                    <div class="flex items-center justify-center mb-4">
                        <div class="relative">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full transition-all duration-300 
                                {{ $currentStep >= 1 ? 'bg-blue-600 shadow-lg shadow-blue-200' : 'bg-gray-200' }}
                                {{ $updatedByStep == 1 ? 'ring-4 ring-blue-400 animate-pulse scale-110' : '' }}">
                                <i class="fas fa-users text-lg {{ $currentStep >= 1 ? 'text-white' : 'text-gray-500' }}"></i>
                            </div>
                            @if($currentStep >= 1)
                            <div class="absolute -right-1 -top-1 w-5 h-5 rounded-full bg-green-500 border-2 border-white flex items-center justify-center">
                                <i class="fas fa-check text-xs text-white"></i>
                            </div>
                            @endif
                        </div>
                    </div>
                    <h3 class="text-sm font-semibold {{ $currentStep >= 1 ? 'text-blue-600' : 'text-gray-500' }}">BEM</h3>
                    <p class="text-xs text-gray-500 mt-1">Review BEM</p>
                </li>

                <!-- Step 2: Pembina -->
                <li class="flex flex-col items-center">
                    <div class="flex items-center justify-center mb-4">
                        <div class="relative">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full transition-all duration-300 
                                {{ $currentStep >= 2 ? 'bg-blue-600 shadow-lg shadow-blue-200' : 'bg-gray-200' }}
                                {{ $updatedByStep == 2 ? 'ring-4 ring-blue-400 animate-pulse scale-110' : '' }}">
                                <i class="fas fa-user-tie text-lg {{ $currentStep >= 2 ? 'text-white' : 'text-gray-500' }}"></i>
                            </div>
                            @if($currentStep >= 2)
                            <div class="absolute -right-1 -top-1 w-5 h-5 rounded-full bg-green-500 border-2 border-white flex items-center justify-center">
                                <i class="fas fa-check text-xs text-white"></i>
                            </div>
                            @endif
                        </div>
                    </div>
                    <h3 class="text-sm font-semibold {{ $currentStep >= 2 ? 'text-blue-600' : 'text-gray-500' }}">Pembina</h3>
                    <p class="text-xs text-gray-500 mt-1">Review Pembina</p>
                </li>

                <!-- Step 3: Ketua Jurusan (Conditional) -->
                @if (!str_contains($nama_ormawa, 'UKM') && !str_contains($nama_ormawa, 'BEM') && !str_contains($nama_ormawa, 'MPM'))
                <li class="flex flex-col items-center">
                    <div class="flex items-center justify-center mb-4">
                        <div class="relative">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full transition-all duration-300 
                                {{ $currentStep >= 3 ? 'bg-blue-600 shadow-lg shadow-blue-200' : 'bg-gray-200' }}
                                {{ $updatedByStep == 3 ? 'ring-4 ring-blue-400 animate-pulse scale-110' : '' }}">
                                <i class="fas fa-user-graduate text-lg {{ $currentStep >= 3 ? 'text-white' : 'text-gray-500' }}"></i>
                            </div>
                            @if($currentStep >= 3)
                            <div class="absolute -right-1 -top-1 w-5 h-5 rounded-full bg-green-500 border-2 border-white flex items-center justify-center">
                                <i class="fas fa-check text-xs text-white"></i>
                            </div>
                            @endif
                        </div>
                    </div>
                    <h3 class="text-sm font-semibold {{ $currentStep >= 3 ? 'text-blue-600' : 'text-gray-500' }}">Kajur</h3>
                    <p class="text-xs text-gray-500 mt-1">Review Jurusan</p>
                </li>
                @endif

                <!-- Step 4: KLI -->
                <li class="flex flex-col items-center">
                    <div class="flex items-center justify-center mb-4">
                        <div class="relative">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full transition-all duration-300 
                                {{ $currentStep >= 4 ? 'bg-blue-600 shadow-lg shadow-blue-200' : 'bg-gray-200' }}
                                {{ $updatedByStep == 4 ? 'ring-4 ring-blue-400 animate-pulse scale-110' : '' }}">
                                <i class="fas fas fa-user-tie text-lg {{ $currentStep >= 4 ? 'text-white' : 'text-gray-500' }}"></i>
                            </div>
                            @if($currentStep >= 4)
                            <div class="absolute -right-1 -top-1 w-5 h-5 rounded-full bg-green-500 border-2 border-white flex items-center justify-center">
                                <i class="fas fa-check text-xs text-white"></i>
                            </div>
                            @endif
                        </div>
                    </div>
                    <h3 class="text-sm font-semibold {{ $currentStep >= 4 ? 'text-blue-600' : 'text-gray-500' }}">KLI</h3>
                    <p class="text-xs text-gray-500 mt-1">Review KLI</p>
                </li>

                <!-- Step 5: WADIR 3 -->
                <li class="flex flex-col items-center">
                    <div class="flex items-center justify-center mb-4">
                        <div class="relative">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full transition-all duration-300 
                                {{ $currentStep >= 5 ? 'bg-blue-600 shadow-lg shadow-blue-200' : 'bg-gray-200' }}
                                {{ $updatedByStep == 5 ? 'ring-4 ring-blue-400 animate-pulse scale-110' : '' }}">
                                <i class="fas fa-user-shield text-lg {{ $currentStep >= 5 ? 'text-white' : 'text-gray-500' }}"></i>
                            </div>
                            @if($currentStep >= 5)
                            <div class="absolute -right-1 -top-1 w-5 h-5 rounded-full bg-green-500 border-2 border-white flex items-center justify-center">
                                <i class="fas fa-check text-xs text-white"></i>
                            </div>
                            @endif
                        </div>
                    </div>
                    <h3 class="text-sm font-semibold {{ $currentStep >= 5 ? 'text-blue-600' : 'text-gray-500' }}">WADIR 3</h3>
                    <p class="text-xs text-gray-500 mt-1">Final Review</p>
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
@if ($status == 1 || $currentStep < $updatedByStep)
    @include('proposal_kegiatan.SectionDetail.DetailProposal.detail_only')
@elseif ($status == 0)
    @include('proposal_kegiatan.SectionDetail.DetailProposal.waiting_review_spj')
@elseif ($status == 2)
    @include('proposal_kegiatan.SectionDetail.DetailProposal.rejected')
@elseif ($status == 3)
    @include('proposal_kegiatan.SectionDetail.DetailProposal.revision_form_spj')
@endif

<div class="container mx-auto p-6 space-y-6">
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
                <iframe src="{{ route('file.show', ['filename' => $filePath]) }}" width="800px" height="700px"></iframe>
            </div>
            <div id="sptb-section" class="content-section">
                <iframe src="{{ route('file.show', ['filename' => $filePathSptb]) }}"  width="800px" height="700px"></iframe>
            </div>
            <div id="berita-acara-section" class="content-section hidden">
                <iframe src="{{ route('file.show', ['filename' => $filePathBeritaAcara]) }}"  width="800px" height="700px"></iframe>
            </div>
            <!-- Bukti SPJ Section -->
            <div id="bukti-spj-section" class="content-section hidden">
                @if ($filePathBuktiSpj)
                    <img src="{{ route('file.show', ['filename' => $filePathBuktiSpj]) }}"  alt="Bukti SPJ" class="w-full max-w-xl mx-auto">
                @else
                    <p class="text-center text-gray-600">Dokumen bukti SPJ tidak tersedia.</p>
                @endif
            </div>

            <!-- Video Kegiatan Section -->
            <div id="video-kegiatan-section" class="content-section hidden">
                @if ($filePathVideoKegiatan)
                    <video controls class="w-full max-w-xl mx-auto">
                        <source src="{{ route('file.show', ['filename' => $filePathVideoKegiatan]) }}"  type="video/mp4">
                        Browser Anda tidak mendukung pemutaran video ini.
                    </video>
                @else
                    <p class="text-center text-gray-600">Video kegiatan tidak tersedia.</p>
                @endif
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="border-b border-gray-100">
            <button class="w-full p-6 text-left focus:outline-none" onclick="toggleCollapse('revision-section')">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        <h2 class="text-2xl font-bold text-gray-800">Revisi Proposal</h2>
                    </div>
                    <span id="toggle-revision" class="text-lg text-gray-500 transition-transform duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </div>
            </button>
        </div>

        <!-- Revisi Section -->
        <div id="revision-section" class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Reviewer
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Catatan Revisi
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal Revisi
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status Revisi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($groupedRevisions as $idDosen => $revisions)
                            @foreach ($revisions as $revision)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $revision->reviewer->role ?? 'Unknown' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $revision->catatan_revisi }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($revision->tgl_revisi)->format('d-m-Y H:i') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $revision->status_label }}
                                </td>
                            </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-sm text-gray-500 text-center">
                                    Tidak ada revisi pada tahap ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
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