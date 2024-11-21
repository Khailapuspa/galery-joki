<?php
namespace App\Http\Controllers;

use App\Models\Posts;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel posts
        $posts = Posts::orderBy('created_at', 'desc')->get();

        // Kirim data ke view
        return view('dashboard', compact('posts'));
    }
}
