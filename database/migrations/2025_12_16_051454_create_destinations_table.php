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
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('province'); // Filter Wilayah
            $table->string('location_url'); // Link Google Maps
            $table->enum('nature_type', ['Pegunungan', 'Pantai', 'Air Terjun', 'Danau', 'Hutan']);
            $table->enum('crowd_level', ['Sangat Sepi', 'Cukup Sepi', 'Sedang']); // Rating Ketenangan
            $table->integer('price_estimate'); // Untuk filter biaya
            $table->text('description'); // Deskripsi singkat
            $table->text('vibe_description'); // Deskripsi Healing/Vibe
            $table->string('access_difficulty'); // Mudah - Menantang
            $table->json('facilities_list'); // Simpan fasilitas dalam array JSON sederhana
            $table->string('contact_person')->nullable(); // Info kontak pengelola
            $table->string('cover_image'); // Foto utama
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
