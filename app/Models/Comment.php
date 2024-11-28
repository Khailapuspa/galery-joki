<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['users_id', 'posts_id', 'isi_komentar'];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function post()
    {
        return $this->belongsTo(Posts::class);
    }
}
