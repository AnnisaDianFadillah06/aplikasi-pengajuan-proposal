@extends('proposal_kegiatan\reviewer')
@section('konten')

<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<div class="flex flex-wrap -mx-3">
  <div class="flex-none w-full max-w-full px-3">
    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
      <div class="flex justify-between items-center px-4 py-4 uppercase mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent text-lg">
          <h6>Riwayat Proposal Kegiatan</h6>

          <a href="{{ route('download.pdf') }}" class="bg-gray-500 hover:bg-gray-700 text-white text-xs font-bold py-2 px-4 rounded">
              Download PDF
          </a>
      </div>


      <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
                <table id="myTable" class="items-center text-center text-xs w-full mb-0 align-top border-gray-200 text-slate-400 p-2">
                    <thead class="px-3 py-4 align-bottom">
                        <tr>
                          <th>No</th>
                          <th>Nama Kegiatan</th>
                          <th>Tanggal Kegiatan</th>
                          <th>Tempat Kegiatan</th>
                          <th>Tanggal Pengajuan</th>
                          <th>Status Proposal</th>
                        </tr>
                    </thead>
                    <tbody>
                      @php
                          $statusLabels = [
                              0 => 'Menunggu',
                              1 => 'Ditolak',
                              2 => 'Disetujui',
                              3 => 'Dibatalkan',
                          ];
                      @endphp

                      @foreach($proposals as $proposal)
                            <tr>
                                <td class="px-3 py-2 text-center border-b border-gray-200">{{ $loop->iteration }}</td>
                                <td class="text-center border-b border-gray-200">{{ $proposal->nama_kegiatan }}</td>
                                <td class="text-center border-b border-gray-200">{{ $proposal->tgl_kegiatan }}</td>
                                <td class="text-center border-b border-gray-200">{{ $proposal->tmpt_kegiatan }}</td>
                                <td class="text-center border-b border-gray-200">
                                    {{ \Carbon\Carbon::parse($proposal->created_at)->format('Y-m-d') }}
                                </td>
                                <td class="px-4 py-3 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex justify-center items-center">
                                        <span class="{{ 
                                            $proposal->status === 1 ? 'bg-gradient-to-tl from-blue-600 to-blue-300' :
                                            ($proposal->status === 2 ? 'bg-gradient-to-tl from-green-600 to-green-300' :
                                            ($proposal->status === 3 ? 'bg-gradient-to-tl from-red-600 to-red-300' :
                                            ($proposal->status === 0 ? 'bg-gradient-to-tl from-yellow-600 to-yellow-300' :
                                            'bg-gray-400')))
                                        }} px-4 text-xxs rounded-1.8 py-2 inline-block text-center align-baseline font-bold uppercase leading-none text-white" style="display: inline-block; width: 60%;">
                                            {{ $statusLabels[$proposal->status] ?? 'Unknown' }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-4 text-center border-b border-gray-200">Detail</td>
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
