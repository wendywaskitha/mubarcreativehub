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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('umkm_id');
            $table->string('nama_produk');
            $table->string('slug');
            $table->text('deskripsi')->nullable();
            $table->integer('harga');
            $table->integer('stok')->default(0);
            $table->string('foto_1')->nullable();
            $table->string('foto_2')->nullable();
            $table->string('foto_3')->nullable();
            $table->string('foto_4')->nullable();
            $table->string('foto_5')->nullable();
            $table->string('kategori')->nullable();
            $table->text('tags')->nullable(); // Will store as JSON
            $table->boolean('status_tersedia')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('views')->default(0);
            $table->timestamps();

            $table->foreign('umkm_id')->references('id')->on('umkms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
