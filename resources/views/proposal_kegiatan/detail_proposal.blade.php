@extends('proposal_kegiatan\pengaju')
@section('konten')

{{-- Untuk pengecekan --}}
{{-- <p>Proposal: {{ $proposal }}</p>
<p>Current Step: {{ $currentStep }}</p>
<p>Updated By Step: {{ $updatedByStep }}</p>
<p>Status: {{ $status }}</p>
<p>Status LPJ: {{ $status_lpj }}</p> --}}

    <style>
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        .step-pulse {
            animation: pulse 2s infinite;
        }
    </style>


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

@if ($updatedByStep == 6 && $status == 1)
    <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded-md shadow-md my-4">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <svg class="h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4-4m6 2a9 9 0 11-18 0a9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-green-800">Proposal Disetujui</h3>
                <div class="mt-2 text-sm text-green-700">
                    <p>Selamat! Proposal Anda telah disetujui oleh Wakil Direktur 3 (Final Review). Anda dapat melanjutkan ke tahap berikutnya.</p>
                </div>
            </div>
        </div>
    </div>
@endif

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

@if ($hasPendingSpj && $updatedByStep ==5)
<div class="container mx-auto p-6">
    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4">
        <p class="font-semibold text-lg">Perhatian</p>
        <p class="mt-2">Anda perlu mengajukan SPJ terlebih dahulu untuk kegiatan berikut sebelum dapat melanjutkan agar bisa disetujui oleh wadir 3 untuk proposal ini:</p>
        <ul class="mt-2 ml-4 list-disc text-base">
            @foreach ($pendingSpjProposals as $pendingProposal)
                <li class="mt-1">
                    <span class="font-bold">{{ $pendingProposal->nama_kegiatan }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endif

{{-- Bagian Detail Proposal --}}
@if ($status == 1 || $currentStep < $updatedByStep)
    @include('proposal_kegiatan.SectionDetail.DetailProposal.detail_only')
@elseif ($status == 0)
    @include('proposal_kegiatan.SectionDetail.DetailProposal.waiting_review')
@elseif ($status == 2)
    @include('proposal_kegiatan.SectionDetail.DetailProposal.rejected')
@elseif ($status == 3)
    @include('proposal_kegiatan.SectionDetail.DetailProposal.revision_form')
@endif

{{-- File Proposal terkini --}}
<div class="container mx-auto p-6 space-y-6">
    <!-- Dokumen Section -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="border-b border-gray-100">
            <button class="w-full p-6 text-left focus:outline-none" onclick="toggleCollapse('doc-container')">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h2 class="text-2xl font-bold text-gray-800">Dokumen</h2>
                    </div>
                    <span id="toggle-doc-container" class="text-lg text-gray-500 transition-transform duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </div>
            </button>
        </div>

        <div id="doc-container" class="p-6">
            <!-- Tab Navigation -->
            <div class="flex flex-wrap gap-2 mb-6">
                <button onclick="toggleDocSection('doc-proposal')" 
                        class="nav-btn px-4 py-2 rounded-lg font-medium transition-all duration-200 hover:bg-blue-600 focus:ring-2 focus:ring-blue-300 active">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Proposal
                    </div>
                </button>
                <button onclick="toggleDocSection('doc-ketuplak')" 
                        class="nav-btn px-4 py-2 rounded-lg font-medium text-gray-500 transition-all duration-200 hover:bg-blue-600 focus:ring-2 focus:ring-blue-300">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Surat Ketuplak
                    </div>
                </button>
                <button onclick="toggleDocSection('doc-ormawa')" 
                        class="nav-btn px-4 py-2 rounded-lg font-medium transition-all duration-200 hover:bg-blue-600 focus:ring-2 focus:ring-blue-300">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Surat Ormawa
                    </div>
                </button>
                <button onclick="toggleDocSection('doc-sarpras')" 
                        class="nav-btn px-4 py-2 rounded-lg font-medium transition-all duration-200 hover:bg-blue-600 focus:ring-2 focus:ring-blue-300">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Surat Sarpras
                    </div>
                </button>
                <button onclick="toggleDocSection('poster')" 
                        class="nav-btn px-4 py-2 rounded-lg font-medium transition-all duration-200 hover:bg-blue-600 focus:ring-2 focus:ring-blue-300">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Poster
                    </div>
                </button>
            </div>

            <!-- Content Sections -->
            <div class="bg-gray-50 rounded-lg p-4">
                <div id="doc-proposal" class="doc-section w-full">
                    <iframe src="{{ route('file.show', ['filename' => $filePath]) }}" class="w-full h-[700px] rounded-lg"></iframe>
                </div>
                <div id="doc-ketuplak" class="doc-section hidden w-full">
                    <iframe src="{{ route('file.show', ['filename' => $fileKetuplakPath]) }}" class="w-full h-[700px] rounded-lg"></iframe>
                </div>
                <div id="doc-ormawa" class="doc-section hidden w-full">
                    <iframe src="{{ route('file.show', ['filename' => $fileOrmawaPath]) }}" class="w-full h-[700px] rounded-lg"></iframe>
                </div>
                <div id="doc-sarpras" class="doc-section hidden w-full">
                    <iframe src="{{ route('file.show', ['filename' => $fileSarprasPath]) }}" class="w-full h-[700px] rounded-lg"></iframe>
                </div>
                <div id="poster" class="doc-section hidden w-full">
                    <div class="p-4">
                        <img src="{{ route('file.show', ['filename' => $filePosterPath]) }}" alt="Gambar Kegiatan" class="w-full rounded-lg shadow-md">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Revisi Section -->
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
//     function toggleCollapse(sectionId) {
//         const section = document.getElementById(sectionId);
//         const toggleButton = document.getElementById(`toggle-${sectionId.split('-')[0]}`);

//         if (section.style.display === "none") {
//             section.style.display = "block";
//             toggleButton.textContent = "[-]";
//         } else {
//             section.style.display = "none";
//             toggleButton.textContent = "[+]";
//         }
//     }

//     function toggleDocuments() {
//     const navButtons = document.getElementById('nav-buttons');
//     const sections = document.querySelectorAll('.content-section');

//     // Toggle visibility of navigation buttons and all sections
//     isDocumentsVisible = !isDocumentsVisible;

//     if (isDocumentsVisible) {
//         navButtons.style.display = 'flex'; // Show navigation buttons
//         sections.forEach(section => {
//             section.style.display = 'none'; // Hide all sections initially
//         });
//         toggleSection('proposal-section'); // Default to showing the first document (Proposal)
//     } else {
//         navButtons.style.display = 'none'; // Hide navigation buttons
//         sections.forEach(section => {
//             section.style.display = 'none'; // Hide all sections
//         });
//     }
// }

//     function toggleSection(id) {
//     const sections = document.querySelectorAll('.content-section');
//     sections.forEach(section => {
//         section.style.display = section.id === id ? 'block' : 'none';
//     });
// }


//     // Set default visibility for sections (expanded)
//     document.getElementById('proposal-section').style.display = "none";
//     document.getElementById('revision-section').style.display = "none";

//         document.addEventListener("DOMContentLoaded", function () {
//         const navButtons = document.querySelectorAll(".nav-btn");
//         const contentSections = document.querySelectorAll(".content-section");

//         // Function to show the selected section
//         function showSection(targetId) {
//             contentSections.forEach(section => {
//                 section.classList.add("hidden"); // Hide all sections
//             });
//             document.getElementById(targetId).classList.remove("hidden"); // Show selected section
//         }

//         // Attach event listener to each navigation button
//         navButtons.forEach(button => {
//             button.addEventListener("click", function () {
//                 const target = this.dataset.target;
//                 showSection(target);

//                 // Highlight the active button
//                 navButtons.forEach(btn => btn.classList.remove("bg-blue-700"));
//                 this.classList.add("bg-blue-700");
//             });
//         });

//         // Show the first section by default
//         showSection("proposal-section");
//     });

    // 22
//     function toggleCollapse(sectionId) {
//     const section = document.getElementById(sectionId);
//     const toggle = document.getElementById(`toggle-${sectionId.split('-')[0]}`);
    
//     section.classList.toggle('hidden');
//     toggle.querySelector('svg').classList.toggle('rotate-180');
// }

//     function toggleSection(sectionId) {
//         // Hide all sections
//         document.querySelectorAll('.content-section').forEach(section => {
//             section.classList.add('hidden');
//         });
        
//         // Show selected section
//         document.getElementById(sectionId).classList.remove('hidden');
        
//         // Update active state of buttons
//         document.querySelectorAll('.nav-btn').forEach(btn => {
//             btn.classList.remove('active');
//         });
//         event.currentTarget.classList.add('active');
//     }

//     // Show first section by default
//     document.addEventListener('DOMContentLoaded', () => {
//         document.querySelector('.content-section').classList.remove('hidden');
//         document.querySelector('.nav-btn').classList.add('active');
//     });

//33

    function toggleCollapse(sectionId) {
        const section = document.getElementById(sectionId);
        const toggle = document.getElementById(`toggle-${sectionId}`);
        
        section.classList.toggle('hidden');
        toggle.querySelector('svg').classList.toggle('rotate-180');
    }

    function toggleDocSection(sectionId) {
        // Hide all document sections
        document.querySelectorAll('.doc-section').forEach(section => {
            section.classList.add('hidden');
        });
        
        // Show selected section
        document.getElementById(sectionId).classList.remove('hidden');
        
        // Update active state of buttons
        document.querySelectorAll('.nav-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        event.currentTarget.classList.add('active');
    }

    // Show first section by default
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelector('.doc-section').classList.remove('hidden');
        document.querySelector('.nav-btn').classList.add('active');
    });
</script>

<style>
    .nav-btn {
        @apply bg-blue-500 text-white hover:bg-blue-600 transition-colors duration-200;
    }
    .nav-btn.active {
        @apply bg-blue-600 ring-2 ring-blue-300;
    }
    .nav-btn:hover {
        background-color: white;
        color: #1d4ed8; /* Tetap menggunakan warna biru untuk teks saat hover */
    }
    .nav-btn:hover svg {
        stroke: #1d4ed8; /* Mengubah warna ikon saat di-hover */
    }
    </style>


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