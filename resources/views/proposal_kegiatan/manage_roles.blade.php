@extends('proposal_kegiatan\reviewer')
@section('konten')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="container">
    <h1>Kelola Hak Akses</h1>
    <!-- Main Tab Content -->
    <div class="tab-content mt-3" id="mainTabsContent">
        <!-- Manage Roles Tab -->
        <div class="tab-pane fade show active" id="manage-roles" role="tabpanel">
            <!-- Nested Tab Navigation -->
            <ul class="nav nav-pills mb-3" id="nestedTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="assign-tab" data-bs-toggle="tab" href="#assign" role="tab">Tambah Role</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="remove-tab" data-bs-toggle="tab" href="#remove" role="tab">Hapus Role</a>
                </li>
            </ul>

            <!-- Nested Tab Content -->
            <div class="tab-content" id="nestedTabsContent">
                <!-- Tambah Role Tab -->
                <div class="tab-pane fade show active" id="assign" role="tabpanel">
                    <ul class="nav nav-tabs mt-3" id="assignNestedTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="mahasiswa-tab" data-bs-toggle="tab" href="#mahasiswa" role="tab">Mahasiswa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="dosen-tab" data-bs-toggle="tab" href="#dosen" role="tab">Dosen</a>
                        </li>
                    </ul>

                    <div class="tab-content mt-3" id="assignNestedTabsContent">
                        <!-- Mahasiswa Tab -->
                        <div class="tab-pane fade show active" id="mahasiswa" role="tabpanel">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Daftar Mahasiswa</h3>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($mahasiswa as $mhs)
                                        <tr>
                                            <td>{{ $mhs->username }}</td>
                                            <td>{{ $mhs->email }}</td>
                                            <td>
                                                <form action="{{ route('admin.assignPengaju') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $mhs->id }}">
                                                    <input type="hidden" name="username" value="{{ $mhs->username }}">
                                                    <input type="hidden" name="email" value="{{ $mhs->email }}">
                                                    <button type="submit" class="btn btn-primary">Jadikan Pengaju</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Dosen Tab -->
                        <div class="tab-pane fade" id="dosen" role="tabpanel">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Daftar Dosen</h3>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($dosen as $dsn)
                                        <tr>
                                            <td>{{ $dsn->username }}</td>
                                            <td>{{ $dsn->email }}</td>
                                            <td>
                                                <form action="{{ route('admin.assignReviewer') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $dsn->id }}">
                                                    <input type="hidden" name="username" value="{{ $dsn->username }}">
                                                    <input type="hidden" name="email" value="{{ $dsn->email }}">
                                                    <button type="submit" class="btn btn-primary">Jadikan Reviewer</button>
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

                <!-- Hapus Role Tab -->
                <div class="tab-pane fade" id="remove" role="tabpanel">
                    <ul class="nav nav-tabs mt-3" id="removeNestedTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pengaju-tab" data-bs-toggle="tab" href="#pengaju" role="tab">Pengaju</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="reviewer-tab" data-bs-toggle="tab" href="#reviewer" role="tab">Reviewer</a>
                        </li>
                    </ul>

                    <div class="tab-content mt-3" id="removeNestedTabsContent">
                        <!-- Pengaju Tab -->
                        <div class="tab-pane fade show active" id="pengaju" role="tabpanel">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Daftar Pengaju</h3>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Lengkap</th>
                                            <th>Email</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pengaju as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->nama_lengkap }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>
                                                <form action="{{ route('admin.removePengaju', $item->id) }}" method="POST" onsubmit="return confirm('Hapus pengaju ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Reviewer Tab -->
                        <div class="tab-pane fade" id="reviewer" role="tabpanel">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Daftar Reviewer</h3>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Lengkap</th>
                                            <th>Email</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($reviewer as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->nama_lengkap }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>
                                                <form action="{{ route('admin.removeReviewer', $item->id) }}" method="POST" onsubmit="return confirm('Hapus reviewer ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
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
        </div>
    </div>
</div>
@endsection
