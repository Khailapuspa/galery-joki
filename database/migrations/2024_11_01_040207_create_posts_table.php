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
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('judul'); // Judul Post
            $table->foreignId('kategori_id') // Foreign key ke tabel kategori
                  ->constrained('kategori') // Nama tabel terkait
                  ->onDelete('cascade'); // Hapus otomatis jika kategori dihapus
            $table->text('isi'); // Konten Post
            $table->foreignId('gallery_id')->nullable()->constrained('galeries')->onDelete('cascade');
            $table->foreignId('user_id') // Foreign key ke tabel users
                  ->constrained('users') // Nama tabel terkait
                  ->onDelete('cascade'); // Hapus otomatis jika user dihapus
            $table->boolean('status')->default(1); // 1 = Aktif, 0 = Tidak Aktif
            $table->timestamps(); // Timestamps created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
