<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = 'posts';
    protected $fillable = ['judul', 'kategori_id', 'isi', 'petugas_id', 'status'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }
}
