<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $table = 'foto';
    protected $fillable = ['galery_id', 'posts_id', 'file', 'judul'];

    public function galery()
    {
        return $this->belongsTo(Galery::class); // Relasi Foto dengan Galery
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'posts_id');  // Relasi Foto dengan Post
    }
}