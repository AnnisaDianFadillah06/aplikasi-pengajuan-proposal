@php
    $layout = Auth::guard('mahasiswa')->check() 
                ? 'proposal_kegiatan.pengaju' 
                : (Auth::guard('dosen')->check() 
                    ? 'proposal_kegiatan.reviewer' 
                    : 'proposal_kegiatan\non_auth_sidebar'); // Tambahkan fallback layout jika diperlukan
@endphp
@extends($layout)
@section('konten')

<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<div class="flex flex-wrap -mx-3">
  <div class="flex-none w-full max-w-full px-3">
    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
      <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
            <table id="myTable" class="items-center text-center text-xs w-full mb-0 align-top border-gray-200 text-slate-400 p-2">
    <thead class="px-3 py-4 align-bottom">
        <tr>
            <th>No</th>
            <th>Nama Kegiatan</th>
            <th>Tanggal Kegiatan</th>
            <th>Tempat Kegiatan</th>
            <th>Status Kegiatan</th>
            <th>Detail</th>
        </tr>
    </thead>
    <tbody>
        @php
            $statusLabels = [
                1 => 'Sedang Dilaksanakan',
                2 => 'Coming Soon',
                3 => 'Pending',
            ];
        @endphp

        @foreach($proposals as $proposal)
            <tr>
                <td class="px-3 py-2 text-center border-b border-gray-200">{{ $loop->iteration }}</td>
                <td class="text-center border-b border-gray-200">{{ $proposal->nama_kegiatan }}</td>
                <td class="text-center border-b border-gray-200">{{ $proposal->tanggal_mulai }}</td>
                <td class="text-center border-b border-gray-200">{{ $proposal->tmpt_kegiatan }}</td>
                <td class="px-4 py-3 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <div class="flex justify-center items-center">
                        <span class="{{ 
                            $proposal->status_kegiatan === 1 ? 'bg-gradient-to-tl from-blue-600 to-blue-300' :
                            ($proposal->status_kegiatan === 2 ? 'bg-gradient-to-tl from-red-600 to-red-300' :
                            'bg-gray-400')
                        }} px-4 text-xxs rounded-1.8 py-2 inline-block text-center align-baseline font-bold uppercase leading-none text-white" style="display: inline-block; width: 60%;">
                            {{ $statusLabels[$proposal->status_kegiatan] ?? 'Unknown' }}
                        </span>
                    </div>
                </td>

                <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <form method="GET" action="{{ route('kegiatan.detail', $proposal->id_proposal) }}">
                        @csrf
                        <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded">
                            Detail
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

            </div>
        </div>
    </div> 
  </div>
</div>        





@endsection

