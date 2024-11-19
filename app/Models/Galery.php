<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    protected $table = 'galery';
    protected $fillable = [
        'judul',
        'posts_id',
        'position',
        'status',
    ];

    public function posts()
{
    return $this->hasMany(Posts::class, 'galery_id');
}

    public function photos()
    {
        return $this->hasMany(Foto::class, 'galery_id');
    }
}
