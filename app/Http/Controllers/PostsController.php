<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Kategori;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Posts::with('kategori')->get();
        return view('Vposts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Kategori::all();
        return view('Vposts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'kategori_id' => 'required|integer',
            'isi' => 'required',
            'petugas_id' => 'required|integer',
            'status' => 'required|boolean'
        ]);

        Posts::create($request->all());
        return redirect()->route('posts.index')->with('success', 'Post berhasil ditambahkan!');
    }
}
