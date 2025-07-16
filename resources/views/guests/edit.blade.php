{{-- Menggunakan layout utama --}}
@extends('layout.app')

{{-- Mulai bagian konten --}}
@section('content')

<!-- Container card untuk form edit, dengan lebar maksimal 600px dan ditengah -->
<div class="card mx-auto" style="max-width: 600px;">
    <div class="card-body">

        <!-- Judul halaman -->
        <h1 class="card-title h3 mb-4 text-center">Edit Entri Buku Tamu</h1>

        {{-- Jika ada error validasi, tampilkan alert --}}
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Oops!</h4>
                <p>Ada beberapa masalah dengan input Anda.</p>
                <ul class="mb-0">
                    {{-- Menampilkan semua error dalam bentuk list --}}
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form untuk memperbarui entri tamu --}}
        <form action="{{ route('guests.update', $guest->id) }}" method="POST">
            @csrf {{-- Token keamanan Laravel --}}
            @method('PUT') {{-- Metode PUT untuk update (bukan POST biasa) --}}

            {{-- Input: Nama Lengkap (wajib) --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap:</label>
                <input type="text" name="name" id="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $guest->name) }}" required>
                {{-- Menampilkan pesan kesalahan validasi jika ada --}}
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input: Email (opsional) --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email (Opsional):</label>
                <input type="email" name="email" id="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $guest->email) }}">
                {{-- Menampilkan error jika validasi gagal --}}
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input: Nomor Telepon (opsional) --}}
            <div class="mb-3">
                <label for="phone" class="form-label">Telepon (Opsional):</label>
                <input type="text" name="phone" id="phone"
                       class="form-control @error('phone') is-invalid @enderror"
                       value="{{ old('phone', $guest->phone) }}">
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input: Institusi/Asal (opsional, bisa dibuat required jika perlu) --}}
            <div class="mb-3">
                <label for="institution" class="form-label">Institusi/Asal (Opsional):</label>
                <input type="text" name="institution" id="institution"
                       class="form-control @error('institution') is-invalid @enderror"
                       value="{{ old('institution', $guest->institution) }}">
                @error('institution')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input: Tujuan Kunjungan (wajib) --}}
            <div class="mb-4">
                <label for="purpose" class="form-label">Tujuan Kunjungan:</label>
                <textarea name="purpose" id="purpose" rows="4"
                          class="form-control @error('purpose') is-invalid @enderror"
                          required>{{ old('purpose', $guest->purpose) }}</textarea>
                @error('purpose')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tombol aksi --}}
            <div class="d-flex justify-content-end gap-2">
                {{-- Tombol batal kembali ke daftar entri --}}
                <a href="{{ route('guests.index') }}" class="btn btn-secondary">Batal</a>
                {{-- Tombol submit untuk update entri --}}
                <button type="submit" class="btn btn-primary">Perbarui Entri</button>
            </div>
        </form>
    </div>
</div>
@endsection
