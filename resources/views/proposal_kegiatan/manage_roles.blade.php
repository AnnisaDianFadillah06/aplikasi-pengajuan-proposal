@extends('proposal_kegiatan\reviewer')
@section('konten')
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Manage Roles</h1>
        <ul class="nav nav-tabs" id="roleTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pengaju-tab" data-bs-toggle="tab" data-bs-target="#pengaju" type="button" role="tab" aria-controls="pengaju" aria-selected="true">Pengaju</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="reviewer-tab" data-bs-toggle="tab" data-bs-target="#reviewer" type="button" role="tab" aria-controls="reviewer" aria-selected="false">Reviewer</button>
            </li>
        </ul>
        <div class="tab-content mt-3" id="roleTabsContent">
            <!-- Tab Pengaju -->
            <div class="tab-pane fade show active" id="pengaju" role="tabpanel" aria-labelledby="pengaju-tab">
                <!-- Tombol Tambah -->
                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('create.pengaju') }}" class="btn btn-success me-2">Tambah Pengaju</a>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Nama Lengkap</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=1;
                        @endphp
                        @foreach ($pengajus as $pengaju)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $pengaju->username }}</td>
                            <td>{{ $pengaju->email }}</td>
                            <td>{{ $pengaju->nama_lengkap }}</td>
                            <td>
                                <a href="{{ route('edit.pengaju', $pengaju->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Tab Reviewer -->
            <div class="tab-pane fade" id="reviewer" role="tabpanel" aria-labelledby="reviewer-tab">
                <!-- Tombol Tambah -->
                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('create.reviewer') }}" class="btn btn-success">Tambah Reviewer</a>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>ID Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=1;
                        @endphp
                        @foreach ($reviewers as $reviewer)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $reviewer->username }}</td>
                            <td>{{ $reviewer->email }}</td>
                            <td>{{ $reviewer->id_role }}</td>
                            <td>
                                <a href="{{ route('edit.reviewer', $reviewer->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
@endsection
