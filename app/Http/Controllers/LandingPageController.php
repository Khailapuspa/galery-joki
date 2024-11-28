<?php
namespace App\Http\Controllers;

use App\Models\Foto;

class LandingPageController extends Controller
{
    public function showTrending()
    {
        // Ambil 3 foto terbaru dari tabel foto
        $photos = Foto::latest()->take(3)->get();

        return view('landing-page', compact('photos'));  // Pass $photos correctly
    }
}
