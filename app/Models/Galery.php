<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    protected $table = 'galery';
    protected $fillable = [
        'judul',
        'post_id',
        'position',
        'status',
    ];

    public function post()
    {
        return $this->belongsTo(Posts::class, 'post_id');
    }


    public function photos()
    {
        return $this->hasMany(Foto::class, 'galery_id');
    }
}
