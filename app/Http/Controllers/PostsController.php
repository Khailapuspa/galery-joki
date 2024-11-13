<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Category;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    // Menampilkan daftar post
    public function index()
    {
        $posts = Posts::with('kategori')->get();
        return view('posts.index', compact('posts'));
    }

    // Menampilkan form untuk membuat post baru
    public function create()
    {
        $categories = Category::all(); // Memuat semua kategori
        return view('posts.create', compact('categories'));
    }

    // Menyimpan post baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'gallery_id' => 'required|exists:galleries,id',
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id', // gunakan tabel `kategori`
            'isi' => 'required|string',
            'petugas_id' => 'required|exists:users,id',
            'status' => 'required|boolean',
        ]);

        Posts::create([
            'gallery_id' => $request->gallery_id,
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'isi' => $request->isi,
            'petugas_id' => $request->petugas_id,
            'status' => $request->status,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post berhasil ditambahkan!');
    }

    // Menampilkan detail post tertentu
    public function show($id)
    {
        $post = Posts::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    // Menampilkan form edit untuk post tertentu
    public function edit($id)
    {
        $post = Posts::findOrFail($id);
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    // Memperbarui data post
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'isi' => 'required|string',
            'status' => 'required|boolean',
        ]);

        $post = Posts::findOrFail($id);
        $post->update([
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'isi' => $request->isi,
            'status' => $request->status,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post berhasil diperbarui!');
    }

    // Menghapus post tertentu
    public function destroy($id)
    {
        $post = Posts::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post berhasil dihapus!');
    }
}
