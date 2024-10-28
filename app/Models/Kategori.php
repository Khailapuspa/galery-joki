<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'kategori';

    // Kolom-kolom yang bisa diisi (mass assignable)
    protected $fillable = [
        'judul',
    ];

    // Aktifkan timestamps (created_at & updated_at)
    public $timestamps = true;
}
