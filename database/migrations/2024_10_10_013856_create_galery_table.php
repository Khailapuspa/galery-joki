<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('galery', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->unsignedBigInteger('post_id')->nullable(); // Mengizinkan nilai NULL
        $table->unsignedBigInteger('posts_id')->nullable()->after('judul');
        $table->foreign('posts_id')->references('id')->on('posts')->onDelete('cascade');
        $table->integer('position');
        $table->integer('status');
        $table->timestamps();
    });
}

public function posts()
    {
        return $this->belongsTo(Posts::class, 'posts_id');
    }

    // Jika ada relasi lain, seperti photos, tambahkan juga
    public function photos()
    {
        return $this->hasMany(Foto::class, 'galery_id');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galery');
    }
};
