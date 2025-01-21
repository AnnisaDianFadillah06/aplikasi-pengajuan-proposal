@extends('proposal_kegiatan/pengaju')
@section('konten')

<div class="container mx-auto mt-5">
    <div class="p-5 bg-white border border-gray-300 rounded-lg shadow">
        <h2 class="text-lg font-semibold text-gray-900 mb-3">Bukti Proposal Disetujui</h2>
        
        <div class="p-4 bg-gray-100 rounded-lg">
            <p class="text-gray-700">LPJ Anda dengan ID: {{ $proposal->id_proposal }} telah disetujui.</p>
            
            <!-- Tambahkan detail lain yang ingin ditampilkan -->
        </div>

         <!-- Container untuk tombol -->
        <div class="flex mt-6 space-x-4">
            <!-- Tombol Kembali ke Detail Proposal -->
            <a href="{{ route('laporan.detail', $proposal->id_proposal) }}" 
               class="flex-1 inline-block px-6 py-3 text-sm font-semibold text-center text-white transition-all bg-gradient-to-r from-slate-600 to-slate-400 rounded-lg shadow-lg hover:from-slate-500 hover:to-slate-300 hover:shadow-xl">
                Kembali ke Detail LPJ
            </a>

           
        </div>
    </div>
</div>


@endsection
