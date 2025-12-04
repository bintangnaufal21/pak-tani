<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // seller pemilik produk
            $table->foreignId('user_id')
                  ->constrained()          // ke tabel users
                  ->onDelete('cascade');

            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('stock')->default(0);
            $table->decimal('price', 12, 2);
            $table->string('unit')->default('kg'); // contoh: kg, ikat, karung
            $table->string('image_path')->nullable(); // path gambar produk

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
