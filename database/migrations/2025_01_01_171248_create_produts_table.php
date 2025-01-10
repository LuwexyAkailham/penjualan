<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration

{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Relasi ke tabel kategori
            $table->string('image_path')->nullable(); // Menyimpan path gambar produk
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke tabel users (pemilik produk)
            $table->timestamps(); // Menyimpan waktu pembuatan dan update
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
