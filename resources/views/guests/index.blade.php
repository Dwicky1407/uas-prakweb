{{-- Menggunakan layout utama --}}
@extends('layout.app')

{{-- Mulai bagian konten halaman --}}
@section('content')

<!-- Card container utama -->
<div class="card">
    <div class="card-body">

        <!-- Header: Judul dan tombol tambah entri -->
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mb-4">
            <h1 class="card-title h3 mb-3 mb-sm-0">Daftar Buku Tamu Kampus</h1>
            {{-- Tombol untuk mengarahkan ke form tambah tamu --}}
            <a href="{{ route('guests.create') }}" class="btn btn-primary">
                Tambah Tamu Baru
            </a>
        </div>

        {{-- Menampilkan pesan sukses jika ada session success --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                {{-- Tombol untuk menutup alert --}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Form pencarian --}}
        <div class="mb-4">
            <form action="{{ route('guests.search') }}" method="GET" class="d-flex flex-column flex-sm-row gap-3">
                {{-- Input pencarian berdasarkan nama, institusi, atau tujuan --}}
                <input type="text" name="query" placeholder="Cari berdasarkan nama, institusi, atau tujuan..."
                       class="form-control flex-grow-1"
                       value="{{ request('query') }}">
                {{-- Tombol submit pencarian --}}
                <button type="submit" class="btn btn-info text-white">
                    Cari
                </button>
            </form>
        </div>

        {{-- Menampilkan pesan jika tidak ada entri ditemukan --}}
        @if ($guests->isEmpty())
            <p class="text-center text-muted py-4">Tidak ada entri buku tamu ditemukan.</p>
        @else
            {{-- Tabel daftar tamu --}}
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">No. Telepon</th>
                            <th scope="col">Institusi</th>
                            <th scope="col">Tujuan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Looping data tamu --}}
                        @foreach ($guests as $guest)
                            <tr>
                                {{-- Menampilkan data tamu --}}
                                <td>{{ $guest->name }}</td>
                                <td>{{ $guest->email ?? '-' }}</td> {{-- Tampilkan "-" jika kosong --}}
                                <td>{{ $guest->phone ?? '-' }}</td>
                                <td>{{ $guest->institution ?? '-' }}</td>
                                <td>{{ Str::limit($guest->purpose, 50) }}</td> {{-- Batasi teks maksimal 50 karakter --}}
                                <td>
                                    <div class="d-flex flex-column flex-sm-row gap-2">
                                        {{-- Tombol edit --}}
                                        <a href="{{ route('guests.edit', $guest->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                        {{-- Form untuk menghapus tamu --}}
                                        <form action="{{ route('guests.destroy', $guest->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus entri ini?');">
                                            @csrf {{-- Token CSRF --}}
                                            @method('DELETE') {{-- Metode DELETE untuk menghapus --}}
                                            <button type="submit" class="btn btn-danger btn-sm w-100 w-sm-auto">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Navigasi halaman (pagination) --}}
            <div class="mt-4">
                {{ $guests->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </div>
</div>
@endsection
