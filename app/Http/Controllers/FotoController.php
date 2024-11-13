<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Galery;
use Illuminate\Http\Request;

class FotoController extends Controller
{
    public function index()
    {
        $fotos = Foto::with('galery')->get(); // Mengambil foto beserta relasi galeri
        return view('Vfoto.index', compact('fotos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'file' => 'required|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:10240',
            'galery_id' => 'required|exists:galery,id'
        ]);

        // Proses upload file
        if ($request->file('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/galeri'), $filename);

            // Simpan ke database
            Foto::create([
                'judul' => $request->judul,
                'file' => $filename,
                'galery_id' => $request->galery_id,
            ]);
        }

        return redirect()->route('Vgalery.show', $request->galery_id)->with('success', 'Foto berhasil di-upload.');
    }

    public function edit($id)
{
    // Find the photo by ID
    $foto = Foto::findOrFail($id);
    $galeries = Galery::all();
    $galeries = Galery::all(); // Retrieve all galleries if you want to allow users to select a different gallery

    // Return the edit view and pass the photo data
    return view('Vfoto.edit', compact('foto', 'galeries'));
}

public function update(Request $request, $id)
{
    $foto = Foto::findOrFail($id);

    // Validasi data yang diterima
    $request->validate([
        'judul' => 'required|string|max:255',
        'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Update judul
    $foto->judul = $request->judul;

    // Jika ada file yang diupload, upload file baru
    if ($request->hasFile('file')) {
        // Menghapus file lama jika ada
        if ($foto->file && file_exists(public_path('uploads/galeri/' . $foto->file))) {
            unlink(public_path('uploads/galeri/' . $foto->file));
        }

        // Menyimpan file baru
        $file = $request->file('file');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/galeri'), $filename);
        $foto->file = $filename;
    }

    $foto->save();

    return redirect()->route('Vgalery.show', $foto->galery_id)->with('success', 'Foto berhasil diperbarui!');
}



    public function destroy($id)
{
    // Temukan foto berdasarkan ID
    $foto = Foto::findOrFail($id);

    // Hapus file dari direktori jika ada
    $filePath = public_path('uploads/galeri/' . $foto->file);
    if (file_exists($filePath)) {
        unlink($filePath); // Hapus file
    }

    // Hapus data foto dari database
    $foto->delete();

    // Redirect kembali dengan pesan sukses
    return redirect()->route('Vgalery.show', $foto->galery_id)->with('success', 'Foto berhasil dihapus.');
}
}
