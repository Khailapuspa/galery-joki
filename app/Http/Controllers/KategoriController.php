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

}
