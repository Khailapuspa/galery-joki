<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    protected $fillable = [
        'gallery_id',
        'judul',
        'kategori_id',
        'isi',
        'petugas_id',
        'status',
    ];

    // Relasi dengan model Gallery
    public function galery()
    {
        return $this->belongsTo(Galery::class);
    }

    // Relasi dengan model Category
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
