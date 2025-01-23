
@extends('proposal_kegiatan/reviewer')
@section('konten')
<div class="container mt-5">
    <h1>Edit Pengaju</h1>
    <form action="{{ route('update.pengaju', $pengaju->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="username" value="{{ $pengaju->username }}" required>
            @error('username')
                <span class="text-danger mt-1">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ $pengaju->email }}" required>
            @error('email')
                <span class="text-danger mt-1">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control" id="status" required>
                <option value="1" {{ $pengaju->status == 1 ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ $pengaju->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                @error('status')
                    <span class="text-danger mt-1">{{ $message }}</span>
                @enderror
            </select>
        </div>

        {{-- foto profil --}}
        <div class="mb-3">
            <label for="foto_profil" class="form-label">Foto Profil</label>
            <input type="file" name="foto_profil" class="form-control" id="foto_profil" accept="image/*">
            <span class="text-danger mt-1">@error('foto_profil') {{ $message }} @enderror</span>
            @error('foto_profil')
                <span class="text-danger mt-1">{{ $message }}</span>
            @enderror
            @if ($pengaju->foto_profil)
                <p class="mt-2">Foto Profil Saat Ini:</p>
                <img src="{{ route('file.show', ['filename' => $pengaju->foto_profil]) }}" alt="Foto Profil" class="img-thumbnail" width="150">
            @endif
        </div>
        
        <!-- Section: Ormawa -->
        <div class="mb-3">
            <label for="id_ormawa" class="form-label">Ormawa</label>
            <select class="form-select" id="id_ormawa" name="id_ormawa" required>
                <option value="" disabled>-- Pilih Ormawa --</option>
                @foreach ($ormawas as $id => $nama)
                    <option value="{{ $id }}" {{ $pengaju->id_ormawa == $id ? 'selected' : '' }}>
                        {{ $nama }}
                    </option>
                @endforeach
            </select>
            <span class="text-danger mt-1">@error('id_ormawa') {{ $message }} @enderror</span>
        </div>
        
        
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
