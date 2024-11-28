<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Posts $post)
    {
        $request->validate([
            'isi_komentar' => 'required|string|max:255',
        ]);

        Comment::create([
            'users_id' => Auth::id(),
            'posts_id' => $post->id,
            'isi_komentar' => $request->isi_komentar,
        ]);

        return redirect()->route('dashboard'); // Arahkan kembali ke halaman posts
    }
}
