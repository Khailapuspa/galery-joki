<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = 'posts';
    protected $fillable = ['judul', 'galery_id', 'foto_id', 'kategori_id', 'isi', 'users_id', 'status'];

    // Relasi dengan model Gallery
    public function galery()
    {
        return $this->belongsTo(Galery::class, 'galery_id');
    }

    // Relasi dengan model Category
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    // Relasi ke Foto (opsional jika perlu)
    public function foto()
    {
        return $this->belongsTo(Foto::class, 'foto_id');
    }
}
