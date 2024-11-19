<?php

namespace App\Http\Controllers;

use App\Models\Galery;
use App\Models\Kategori;
use App\Models\Posts;
use Illuminate\Http\Request;

class GaleryController extends Controller
{
    // Menampilkan semua galeri
    public function index()
{
    // Ambil semua galeri dan sertakan data dari relasi 'post'
    $galleries = Galery::with('posts')->get();
    $categories = Kategori::all();

    return view('Vgalery.index', compact('galleries', 'categories'));
}

    // Menyimpan galeri baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'position' => 'required|string',
            'status' => 'required|boolean',
        ]);

        Galery::create([ // Pastikan nama model sesuai dengan penamaan
            'judul' => $request->judul,
            'posts_id' => null, // Tetap null saat galeri dibuat
            'position' => $request->position,
            'status' => $request->status,
        ]);

        return redirect()->route('Vgalery.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    // Menampilkan detail galeri
    public function show($id)
{
    $gallery = Galery::with('photos')->findOrFail($id);
    $fotos = $gallery->photos; // Ambil foto yang terkait dengan galeri ini
    return view('Vgalery.upload', compact('gallery', 'fotos'));
}

// Controller untuk mengembalikan daftar foto berdasarkan galeri
public function getPhotosByGallery($galleryId)
{
    $gallery = Gallery::find($galleryId);
    if (!$gallery) {
        return response()->json([]);
    }

    $photos = $gallery->photos; // Asumsi Anda sudah membuat relasi di model Gallery
    return response()->json($photos);
}


public function getPhotos($galeryId)
{
    $gallery = Gallery::find($galeryId);
    if ($gallery) {
        return response()->json($gallery->photos);
    }
    return response()->json([]);
}

    public function uploadPhoto(Request $request, $id)
{
    $request->validate([
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $gallery = Galery::findOrFail($id);

    // Proses upload foto
    if ($request->file('photo')) {
        $file = $request->file('photo');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/galeri'), $filename);

        // Simpan foto ke database
        Foto::create([
            'galery_id' => $gallery->id,
            'file' => $filename,
            'judul' => $request->input('judul'),
        ]);
    }

    return redirect()->route('Vgalery.show', $id)->with('success', 'Foto berhasil di-upload.');
}

    public function update(Request $request, $id)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'position' => 'required|string',
        'status' => 'required|boolean',
    ]);

    $gallery = Galery::findOrFail($id);
    $gallery->update([
        'judul' => $request->judul,
        'position' => $request->position,
        'status' => $request->status,
    ]);

    return redirect()->route('Vgalery.index')->with('success', 'Galeri berhasil diperbarui.');
}

    public function destroy($id)
{
    $gallery = Galery::findOrFail($id);
    $gallery->delete();

    return redirect()->route('Vgalery.index')->with('success', 'Galeri berhasil dihapus.');
}

}
