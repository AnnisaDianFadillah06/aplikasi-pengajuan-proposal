
@extends('proposal_kegiatan\reviewer')
@section('konten')
<div class="container mt-5">
    <h1>Edit Pengaju</h1>
    <form action="{{ route('update.pengaju', $pengaju->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="username" value="{{ $pengaju->username }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ $pengaju->email }}" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control" id="status" required>
                <option value="1" {{ $pengaju->status == 1 ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ $pengaju->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
