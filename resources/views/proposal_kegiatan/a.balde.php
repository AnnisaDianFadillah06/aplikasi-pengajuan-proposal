<div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-left">No</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-left">Judul Pedoman</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Pedoman</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Status</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Preview</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($pedomanList as $pedoman)
                        <tr data-id="{{ $loop->iteration }}" class="hover:bg-gray-50 transition-colors duration-200">
                            <!-- <td class="px-6 py-4 text-sm text-gray-800">{{ $key + 1 }}</td> -->
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $pedoman->nama_pedoman }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 text-center">{{ $loop->index }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 text-xs font-medium rounded-full 
                                    {{ $item->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $pedoman->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                    <a href="{{ route(pedoman.filePedoman) }}" 
                                       class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors duration-150">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        Lihat Dokumen
                                    </a>
                                </td>
                            <td class="px-6 py-4 text-center">
                                <button onclick="openEditModal('{{ $pedoman->nama_pedoman }}', '{{ $pedoman->status }}', '{{ $pedoman->file_pedoman }}', '{{ $pedoman->id_pedoman }}')"
                                    class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </button>
                            </td>
                        </tr>
                        <script>
                  document.addEventListener('DOMContentLoaded', function() {
                      const url = "{{ asset($pedoman->file_pedoman) }}";
                      
                      // Tampilkan URL di console
                      console.log("URL PDF:", url);

                      pdfjsLib.getDocument(url).promise.then(pdf => {
                          pdf.getPage(1).then(page => {
                              const canvas = document.getElementById('pdf-thumbnail-{{ $loop->index }}');
                              const context = canvas.getContext('2d');
                              const viewport = page.getViewport({ scale: 0.5 }); // Atur skala sesuai kebutuhan

                              canvas.height = viewport.height;
                              canvas.width = viewport.width;

                              page.render({ canvasContext: context, viewport: viewport });
                          });
                      }).catch(error => {
                          console.error("Error loading PDF:", error);
                      });
                  });
              </script>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>