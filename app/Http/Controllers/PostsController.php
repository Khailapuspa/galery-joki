<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Kategori;
use App\Models\Foto;
use App\Models\Galery; // Pastikan ada model Galery
use Illuminate\Http\Request;

class PostsController extends Controller
{
    // Menampilkan daftar post
    public function index()
    {
        $posts = Posts::with(['kategori', 'galery', 'foto'])->get();
        $categories = Kategori::all();
        $galleries = Galery::all(); // Ambil daftar galeri untuk dropdown
        $fotos = Foto::all();  // Ambil daftar foto untuk dropdown

        return view('Vposts.index', compact('posts', 'categories', 'galleries', 'fotos'));
    }

    // Menyimpan post baru ke database
    public function store(Request $request)
{
    $validated = $request->validate([
        'judul' => 'required|string|max:255',
        'foto_id' => 'required|exists:foto,id',  // Validasi bahwa foto_id ada di tabel fotos
        'isi' => 'required|string',
        'kategori_id' => 'required|exists:kategori,id',
        'status' => 'required|boolean',
    ]);

    $posts = new Posts();
    $posts->judul = $validated['judul'];
    $posts->foto_id = $validated['foto_id'];  // Menyimpan foto yang dipilih
    $posts->galery_id = Foto::find($validated['foto_id'])->galery_id;  // Menyimpan galeri_id berdasarkan foto yang dipilih
    $posts->kategori_id = $validated['kategori_id'];
    $posts->isi = $validated['isi'];
    $posts->status = $validated['status'];
    $posts->users_id = auth()->user()->id;
    $posts->save();

    // Menyimpan hubungan antara foto dan posts
    $foto = Foto::find($validated['foto_id']);
    $foto->posts_id = $posts->id;
    $foto->save();

    return redirect()->route('Vposts.index')->with('success', 'Post berhasil dibuat!');
}

public function show($id)
{
    $posts = Posts::with('foto')->findOrFail($id); // Mengambil post beserta foto terkait
    return view('Vposts.detail', compact('posts')); // Mengarahkan ke view 'detail'
}

    // Menampilkan form edit untuk post tertentu
    public function edit($id)
{
    $posts = Posts::find($id);
    return view('Vpost.edit', compact('posts'));
}


    // Memperbarui data post
    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'judul' => 'required|string|max:255',
        'kategori_id' => 'required|exists:kategori,id',
        'foto_id' => 'required|exists:foto,id',
        'isi' => 'required|string',
        'status' => 'required|boolean',
    ]);

    $post = Posts::findOrFail($id);
    $post->update($validated);

    return redirect()->route('Vposts.index')->with('success', 'Post berhasil diperbarui!');
}

    // Menghapus post tertentu

    public function destroy($id)
    {
        $post = Posts::findOrFail($id);

        // Set posts_id ke null di galeri terkait sebelum menghapus post
        Galery::where('posts_id', $post->id)->update(['posts_id' => null]);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post berhasil dihapus!');
    }
}
