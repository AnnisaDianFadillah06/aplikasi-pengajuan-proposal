
@extends('proposal_kegiatan/reviewer')
@section('konten')

<div class="container mt-5">
    <h1>Edit Reviewer</h1>
    <form action="{{ route('update.reviewer', $reviewer->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="{{ $reviewer->username }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $reviewer->email }}" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control" id="status" required>
                <option value="1" {{ $reviewer->status == 1 ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ $reviewer->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="id_role" class="form-label">Role</label>
            <select class="form-select" id="id_role" name="id_role" required>
                <option value="">-- Pilih Role --</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id_role }}" {{ $reviewer->id_role == $role->id_role ? 'selected' : '' }}>
                        {{ $role->role }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection