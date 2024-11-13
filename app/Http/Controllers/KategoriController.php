<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        return view('Vkategori.index', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
        ]);

        Kategori::create([
            'judul' => $request->input('judul'),
        ]);

        return redirect()->route('Vkategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(Kategori $kategori)
    {
        return view('Vkategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->judul = $request->input('judul'); // Update nilai judul
        $kategori->save(); // Simpan perubahan

        return redirect()->route('Vkategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('Vkategori.index')->with('success', 'Kategori berhasil dihapus!');
    }

}

