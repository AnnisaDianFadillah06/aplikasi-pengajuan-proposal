@extends('proposal_kegiatan\reviewer')
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
@include('proposal_kegiatan.SectionDetail.DetailProposal.detail_only')

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
                        <h2 class="text-2xl font-bold text-gray-800">Detail Dokumen Proposal Kegiatan</h2>
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
                <button onclick="toggleDocSection('doc-poster')" 
                        class="nav-btn px-4 py-2 rounded-lg font-medium transition-all duration-200 hover:bg-blue-600 focus:ring-2 focus:ring-blue-300">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Poster Kegiatan
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
                <div class="p-4 flex flex-col items-center">
                    <!-- Gambar Poster -->
                    <img src="{{ route('file.show', ['filename' => $posterKegiatan]) }}" class="w-auto h-auto rounded-lg shadow-md mb-4">
                
                    <!-- Tombol Download -->
                    <a href="{{ route('file.download', ['filename' => $posterKegiatan]) }}" 
                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2">
                        <i class="fas fa-download"></i> Download Poster
                    </a>
                </div>                
            </div>
        </div>
    </div>

{{-- File Proposal terkini --}}
<div class="container mx-auto p-6 space-y-6">
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

@endsection