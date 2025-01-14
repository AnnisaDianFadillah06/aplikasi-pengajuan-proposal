@extends('proposal_kegiatan\reviewer')
@section('title', 'Organisasi Mahasiswa')
@section('konten')
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="bg-white rounded-2xl shadow-lg mb-8 p-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div class="space-y-2">
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                        Manajemen Organisasi Mahasiswa
                    </h1>
                    <p class="text-gray-500">Kelola semua organisasi mahasiswa dalam satu dashboard terintegrasi</p>
                </div>
                <button data-modal-target="addOrganisasiMahasiswaModal" data-modal-toggle="addOrganisasiMahasiswaModal"
                    class="flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 group-hover:rotate-90 transition-transform duration-200" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Tambah Organisasi
                </button>
            </div>
        </div>

        <!-- Search & Filter Section -->
        <div class="bg-white rounded-2xl shadow-lg mb-8 p-6">
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <input type="text" id="searchInput" placeholder="Cari organisasi mahasiswa..."
                            class="w-full pl-12 pr-4 py-3 border-2 border-gray-100 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                        <svg class="absolute left-4 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
                <div class="flex-none">
                    <select class="w-full sm:w-48 px-4 py-3 border-2 border-gray-100 rounded-xl focus:ring-2 focus:ring-blue-500 transition-all duration-200">
                        <option value="">Semua Status</option>
                        <option value="aktif">Aktif</option>
                        <option value="tidak aktif">Tidak Aktif</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-left">No</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-left">Organisasi Mahasiswa</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Tanggal Dibuat</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Dibuat Oleh</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Tanggal Diedit</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Diedit Oleh</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Status</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($ormawa as $key => $item)
                        <tr data-id="{{ $item->id_ormawa }}" class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $key + 1 }}</td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $item->nama_ormawa }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 text-center">{{ $item->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500 text-center">{{ $item->created_by }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500 text-center">{{ $item->updated_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500 text-center">{{ $item->updated_by }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 text-xs font-medium rounded-full 
                                    {{ $item->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button onclick="openEditModal('{{ $item->id_ormawa }}', '{{ $item->nama_ormawa }}', '{{ $item->status }}')"
                                    class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add Modal -->
        <div id="addOrganisasiMahasiswaModal" tabindex="-1" class="fixed inset-0 flex items-center justify-center hidden z-50">
            <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>
            <div class="relative w-full max-w-md transform transition-all">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <!-- Modal Header -->
                    <div class="px-6 py-4 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-semibold text-gray-900">Tambah Organisasi Mahasiswa</h3>
                            <button type="button" onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Modal Form -->
                    <form id="organisasiMahasiswaForm" action="{{ route('organisasi-mahasiswa.store') }}" method="POST">
                        @csrf
                        <div class="px-6 py-4 space-y-4">
                            <div>
                                <label for="nama_ormawa" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Organisasi Mahasiswa
                                </label>
                                <input type="text" name="nama_ormawa" id="nama_ormawa" required
                                    class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                    placeholder="Masukkan nama organisasi">
                            </div>
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                    Status
                                </label>
                                <select name="status" id="status" required
                                    class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                    <option value="aktif">Aktif</option>
                                    <option value="tidak aktif">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-3">
                            <button type="button" onclick="closeModal()"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                Batal
                            </button>
                            <button type="button" onclick="submitForm()"
                                class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div id="editModal" tabindex="-1" class="fixed inset-0 flex items-center justify-center hidden z-50">
            <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>
            <div class="relative w-full max-w-md transform transition-all">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <!-- Modal Header -->
                    <div class="px-6 py-4 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-semibold text-gray-900">Edit Organisasi Mahasiswa</h3>
                            <button type="button" onclick="closeEditModal()" class="text-gray-400 hover:text-gray-500">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Modal Form -->
                    <form id="editOrganisasiMahasiswaForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="px-6 py-4 space-y-4">
                            <div>
                                <label for="edit_nama_ormawa" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Organisasi Mahasiswa
                                </label>
                                <input type="text" name="nama_ormawa" id="edit_nama_ormawa" required
                                    class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                            </div>
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                    Status
                                </label>
                                <select name="status" id="status" required
                                    class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                    <option value="aktif">Aktif</option>
                                    <option value="tidak aktif">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-3">
                            <button type="button" onclick="closeEditModal()"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                Batal
                            </button>
                            <button type="button" onclick="submitEditForm()"
                                class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Search
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const tableRows = document.querySelectorAll('tbody tr');
            
            tableRows.forEach(row => {
                const organizationName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const shouldShow = organizationName.includes(searchTerm);
                
                // fade effect
                if (shouldShow) {
                    row.classList.remove('opacity-0');
                    row.classList.add('opacity-100');
                    row.style.display = '';
                } else {
                    row.classList.remove('opacity-100');
                    row.classList.add('opacity-0');
                    setTimeout(() => {
                        row.style.display = 'none';
                    }, 200);
                }
            });
        });
    }
});

// Modal
document.querySelector('button[data-modal-toggle="addOrganisasiMahasiswaModal"]').addEventListener('click', function() {
    const modal = document.getElementById('addOrganisasiMahasiswaModal');
    modal.classList.remove('hidden');
    setTimeout(() => {
        modal.querySelector('.relative').classList.add('translate-y-0', 'opacity-100');
        modal.querySelector('.relative').classList.remove('translate-y-4', 'opacity-0');
    }, 50);
});

function closeModal() {
    const modal = document.getElementById('addOrganisasiMahasiswaModal');
    modal.querySelector('.relative').classList.add('translate-y-4', 'opacity-0');
    modal.querySelector('.relative').classList.remove('translate-y-0', 'opacity-100');
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

function submitForm() {
    const form = document.getElementById('organisasiMahasiswaForm');
    const formData = new FormData(form);
    
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            closeModal();
            showNotification('Organisasi Mahasiswa berhasil disimpan!', 'success');
            location.reload();
        } else {
            showNotification('Gagal menyimpan data. Periksa kembali input Anda.', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan saat menyimpan data.', 'error');
    });
}

// edit modal
function openEditModal(id, namaOrganisasiMahasiswa, status) {
    document.getElementById('edit_nama_ormawa').value = namaOrganisasiMahasiswa;
    document.getElementById('status').value = status;
    document.getElementById('editOrganisasiMahasiswaForm').action = "/update-organisasi-mahasiswa/" + id;

    const modal = document.getElementById('editModal');
    modal.classList.remove('hidden');
    setTimeout(() => {
        modal.querySelector('.relative').classList.add('translate-y-0', 'opacity-100');
        modal.querySelector('.relative').classList.remove('translate-y-4', 'opacity-0');
    }, 50);
    
    document.body.classList.add('overflow-hidden');
}

function closeEditModal() {
    const modal = document.getElementById('editModal');
    modal.querySelector('.relative').classList.add('translate-y-4', 'opacity-0');
    modal.querySelector('.relative').classList.remove('translate-y-0', 'opacity-100');
    setTimeout(() => {
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }, 300);
}

function submitEditForm() {
    const form = document.getElementById('editOrganisasiMahasiswaForm');
    const formData = new FormData(form);
    
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            closeEditModal();
            showNotification('Data berhasil diubah!', 'success');
            location.reload();
        } else {
            showNotification('Terjadi kesalahan, coba lagi', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan: ' + error.message, 'error');
    });
}

// Add notification system
function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg text-white ${
        type === 'success' ? 'bg-green-500' : 'bg-red-500'
    } transform transition-all duration-300 translate-y-0 opacity-0`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.classList.remove('translate-y-0', 'opacity-0');
        notification.classList.add('translate-y-2', 'opacity-100');
    }, 100);
    
    setTimeout(() => {
        notification.classList.remove('translate-y-2', 'opacity-100');
        notification.classList.add('translate-y-0', 'opacity-0');
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}
</script>

@endsection