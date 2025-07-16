{{-- Menggunakan layout utama dari file layout.app --}}
@extends('layout.app')

{{-- Bagian konten utama halaman --}}
@section('content')

<!-- Membuat card dengan lebar maksimal 600px dan posisi tengah -->
<div class="card mx-auto" style="max-width: 600px;">
    <div class="card-body">

        <!-- Judul halaman -->
        <h1 class="card-title h3 mb-4 text-center">Tambah Entri Buku Tamu Baru</h1>

        {{-- Menampilkan pesan error jika ada validasi yang gagal --}}
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Oops!</h4>
                <p>Ada beberapa masalah dengan input Anda.</p>
                <ul class="mb-0">
                    {{-- Menampilkan semua error satu per satu --}}
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form untuk menambahkan data buku tamu --}}
        <form action="{{ route('guests.store') }}" method="POST">
            {{-- Menambahkan token CSRF untuk keamanan form --}}
            @csrf

            {{-- Input: Nama Lengkap (wajib diisi) --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap:</label>
                <input type="text" name="name" id="name" 
                       class="form-control @error('name') is-invalid @enderror" 
                       value="{{ old('name') }}" required> {{-- Mengisi ulang nilai lama jika validasi gagal --}}
                {{-- Menampilkan pesan error jika field name tidak valid --}}
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input: Email (opsional) --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email (Opsional):</label>
                <input type="email" name="email" id="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       value="{{ old('email') }}">
                {{-- Menampilkan pesan error jika field email tidak valid --}}
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input: Nomor Telepon (opsional) --}}
            <div class="mb-3">
                <label for="phone" class="form-label">Telepon (Opsional):</label>
                <input type="text" name="phone" id="phone" 
                       class="form-control @error('phone') is-invalid @enderror" 
                       value="{{ old('phone') }}">
                {{-- Menampilkan pesan error jika field phone tidak valid --}}
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input: Institusi/Asal (opsional, bisa diubah menjadi required jika perlu) --}}
            <div class="mb-3">
                <label for="institution" class="form-label">Institusi/Asal (Opsional):</label>
                <input type="text" name="institution" id="institution" 
                       class="form-control @error('institution') is-invalid @enderror" 
                       value="{{ old('institution') }}">
                {{-- Menampilkan pesan error jika field institution tidak valid --}}
                @error('institution')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input: Tujuan Kunjungan (wajib diisi) --}}
            <div class="mb-4">
                <label for="purpose" class="form-label">Tujuan Kunjungan:</label>
                <textarea name="purpose" id="purpose" rows="4" 
                          class="form-control @error('purpose') is-invalid @enderror" 
                          required>{{ old('purpose') }}</textarea>
                {{-- Menampilkan pesan error jika field purpose tidak valid --}}
                @error('purpose')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tombol aksi: Batal dan Simpan --}}
            <div class="d-flex justify-content-end gap-2">
                {{-- Tombol kembali ke daftar tamu --}}
                <a href="{{ route('guests.index') }}" class="btn btn-secondary">Batal</a>
                {{-- Tombol untuk submit form --}}
                <button type="submit" class="btn btn-success">Simpan Entri</button>
            </div>
        </form>
    </div>
</div>
@endsection
