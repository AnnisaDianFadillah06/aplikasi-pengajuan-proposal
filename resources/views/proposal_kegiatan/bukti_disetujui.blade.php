@extends('proposal_kegiatan\pengaju')
@section('konten')

<div class="container mx-auto mt-5">
    <div class="p-5 bg-white border border-gray-300 rounded-lg shadow">
        <h2 class="text-lg font-semibold text-gray-900 mb-3">Bukti Proposal Disetujui</h2>
        
        <div class="p-4 bg-gray-100 rounded-lg">
            <p class="text-gray-700">Proposal Anda dengan ID: {{ $proposal->id_proposal }} telah disetujui.</p>
            <p class="text-gray-700 mb-5">Silakan lanjutkan ke tahap pengajuan laporan pertanggung jawaban.</p>
            <!-- Tambahkan detail lain yang ingin ditampilkan -->
        </div>

         <!-- Container untuk tombol -->
        <div class="flex mt-6 space-x-4">
            <!-- Tombol Kembali ke Detail Proposal -->
            <a href="{{ route('proposal.detail', $proposal->id_proposal) }}" 
               class="flex-1 inline-block px-6 py-3 text-sm font-semibold text-center text-white transition-all bg-gradient-to-r from-slate-600 to-slate-400 rounded-lg shadow-lg hover:from-slate-500 hover:to-slate-300 hover:shadow-xl">
                Kembali ke Detail Proposal
            </a>

            <!-- Tombol Next: Pengajuan Laporan Pertanggung Jawaban -->
            @if($proposal->status_lpj != 1)
            <form method="POST" action="{{ route('proposal.formLPJ', $proposal->id_proposal) }}" class="flex-1">
                @csrf
                <button type="submit" 
                        class="w-full px-6 py-3 text-sm font-semibold text-center text-white transition-all bg-gradient-to-r from-blue-600 to-blue-500 rounded-lg shadow-lg hover:from-blue-500 hover:to-blue-400 hover:shadow-xl">
                    Next: Pengajuan Laporan Pertanggung Jawaban
                </button>
            </form>
            @else
            <form method="POST" action="{{ route('laporan.nextStep', $proposal->id_proposal) }}" class="flex-1">
                @csrf
                <!-- Hidden input sebagai penanda -->
                <input type="hidden" name="is_first_access" value="true">
                <button type="submit" 
                        class="w-full px-6 py-3 text-sm font-semibold text-center text-white transition-all bg-gradient-to-r from-blue-600 to-blue-500 rounded-lg shadow-lg hover:from-blue-500 hover:to-blue-400 hover:shadow-xl">
                    Next: LPJ
                </button>
            </form>
            @endif
        </div>
    </div>
</div>


@endsection
