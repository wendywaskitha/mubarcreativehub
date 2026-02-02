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
        Schema::create('umkms', function (Blueprint $table) {
            $table->id();
            $table->string('nama_usaha');
            $table->string('nama_pemilik');
            $table->unsignedBigInteger('subsektor_id');
            $table->text('alamat_usaha');
            $table->unsignedBigInteger('kecamatan_id');
            $table->unsignedBigInteger('desa_id');
            $table->year('tahun_berdiri');
            $table->integer('jumlah_tenaga_kerja')->nullable();
            $table->bigInteger('omset_tahun')->nullable();
            $table->string('no_telp');
            $table->string('email')->nullable();
            $table->enum('jenis_badan_usaha', ['Perseorangan', 'CV', 'UD', 'Kelompok', 'Komunitas', 'PT'])->nullable();
            $table->string('jenis_hki', 100)->nullable();
            $table->string('nib', 100)->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('website')->nullable();
            $table->string('logo')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->text('deskripsi')->nullable();
            $table->boolean('status_aktif')->default(true);
            $table->boolean('status_verifikasi')->default(false);
            $table->integer('views')->default(0);
            $table->timestamps();

            $table->foreign('subsektor_id')->references('id')->on('subsektors')->onDelete('cascade');
            $table->foreign('kecamatan_id')->references('id')->on('kecamatans')->onDelete('cascade');
            $table->foreign('desa_id')->references('id')->on('desas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('u_m_k_m_s');
    }
};
