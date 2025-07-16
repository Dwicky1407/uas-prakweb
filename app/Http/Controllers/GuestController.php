<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    // Menampilkan daftar tamu dalam urutan terbaru dan dipaginasi 10 per halaman
    public function index()
    {
        $guests = Guest::latest()->paginate(10);
        return view('guests.index', compact('guests'));
    }

    // Menampilkan form untuk menambahkan data tamu baru
    public function create()
    {
        return view('guests.create');
    }

    // Menyimpan data tamu baru ke database
    public function store(Request $request)
    {
        // Validasi data input dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'institution' => 'nullable|string|max:255',
            'purpose' => 'required|string',
        ]);

        // Menyimpan data tamu ke database
        Guest::create($request->all());

        // Redirect ke halaman daftar tamu dengan pesan sukses
        return redirect()->route('guests.index')
                         ->with('success', 'Entri buku tamu berhasil ditambahkan!');
    }

    // Menampilkan detail dari tamu berdasarkan ID
    public function show(string $id)
    {
        $guest = Guest::findOrFail($id); // Jika tidak ditemukan, akan menampilkan 404
        return view('guests.show', compact('guest'));
    }

    // Menampilkan form edit data tamu berdasarkan ID
    public function edit(string $id)
    {
        $guest = Guest::findOrFail($id); // Cari tamu berdasarkan ID
        return view('guests.edit', compact('guest'));
    }

    // Memperbarui data tamu berdasarkan ID
    public function update(Request $request, string $id)
    {
        // Validasi data input dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'institution' => 'nullable|string|max:255',
            'purpose' => 'required|string',
        ]);

        // Temukan data tamu yang akan diperbarui
        $guest = Guest::findOrFail($id);

        // Update data tamu dengan data baru dari form
        $guest->update($request->all());

        // Redirect ke halaman daftar tamu dengan pesan sukses
        return redirect()->route('guests.index')
                         ->with('success', 'Entri buku tamu berhasil diperbarui!');
    }

    // Menghapus data tamu dari database
    public function destroy(Guest $guest)
    {
        // Hapus data tamu
        $guest->delete();

        // Redirect ke halaman daftar tamu dengan pesan sukses
        return redirect()->route('guests.index')
                         ->with('success', 'Entri buku tamu berhasil dihapus!');
    }

    // Fungsi pencarian tamu berdasarkan nama, institusi, atau tujuan
    public function search(Request $request)
    {
        // Ambil input pencarian dari form
        $query = $request->input('query');

        // Cari data tamu yang sesuai dengan input pencarian
        $guests = Guest::where('name', 'like', '%' . $query . '%')
            ->orWhere('institution', 'like', '%' . $query . '%')
            ->orWhere('purpose', 'like', '%' . $query . '%')
            ->latest()
            ->paginate(10); // Paginate hasil pencarian

        // Tampilkan hasil pencarian pada halaman index
        return view('guests.index', compact('guests'));
    }
}
