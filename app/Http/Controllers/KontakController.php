<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    /**
     * Tampilan Halaman Publik User (/kontak)
     */
    public function index()
    {
        // Mengambil semua data dari tabel 'kontak' MySQL
        $kontak = Kontak::orderBy('sort_order', 'asc')->orderBy('id', 'desc')->get();

        return view('kontak', compact('kontak'));
    }

    /**
     * Tampilan Admin Panel Kelola Kontak (/admin/kontak)
     */
    public function adminIndex()
    {
        // Mengambil semua data dari tabel 'kontak' MySQL
        $kontak = Kontak::orderBy('sort_order', 'asc')->orderBy('id', 'desc')->get();

        return view('admin.kontak', compact('kontak'));
    }

    /**
     * Simpan Kontak Baru ke MySQL (POST /admin/kontak)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type'        => 'required|string',
            'title'       => 'required|string|max:255',
            'url'         => 'required|string',
            'icon'        => 'nullable|string|max:255',
            'sort_order'  => 'nullable|integer',
            'description' => 'nullable|string',
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        // Simpan langsung ke tabel 'kontak'
        Kontak::create($validated);

        return redirect()->back()->with('success', 'Kontak resmi berhasil disimpan ke database!');
    }

    /**
     * Update Kontak di MySQL (PUT /admin/kontak/{id})
     */
    public function update(Request $request, $id)
    {
        $kontak = Kontak::findOrFail($id);

        $validated = $request->validate([
            'type'        => 'required|string',
            'title'       => 'required|string|max:255',
            'url'         => 'nullable|string',
            'icon'        => 'nullable|string|max:255',
            'sort_order'  => 'nullable|integer',
            'description' => 'nullable|string',
        ]);

        $kontak->update($validated);

        return redirect()->back()->with('success', 'Kontak berhasil diperbarui di database!');
    }

    /**
     * Hapus Kontak dari MySQL (DELETE /admin/kontak/{id})
     */
    public function destroy($id)
    {
        $kontak = Kontak::findOrFail($id);
        $kontak->delete();

        return redirect()->back()->with('success', 'Kontak berhasil dihapus dari database!');
    }
}