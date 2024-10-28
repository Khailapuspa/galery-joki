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
