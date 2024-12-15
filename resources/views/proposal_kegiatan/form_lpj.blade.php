@extends('proposal_kegiatan\pengaju')
@section('konten')

<div class="container mx-auto mt-5">
    <div class="bg-white p-5 rounded-lg shadow">
        <h2 class="text-lg font-semibold text-gray-900 mb-5">Pengajuan Laporan Pertanggung Jawaban</h2>
        <p class="text-gray-700 mb-5">Silakan lengkapi laporan pertanggung jawaban untuk menyelesaikan proses pengajuan proposal.</p>

        <form method="POST" action="{{ route('proposal.submitLPJ', $proposal->id_proposal) }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="report_file" class="block text-sm font-medium text-gray-700">Upload Laporan</label>
                <input type="file" id="report_file" name="report_file" class="mt-1 p-2 border rounded w-full">
            </div>
            <!-- Hidden input sebagai penanda -->
            <input type="hidden" name="is_first_access" value="true">
            <button type="submit" class="px-8 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-all">
                Submit Laporan
            </button>
        </form>
    </div>
</div>
@endsection


