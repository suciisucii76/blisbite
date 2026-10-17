<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStokBahanTable extends Migration
{
    public function up()
    {
        Schema::create('stok_bahan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bahan');
            $table->string('kategori', 100);
            $table->decimal('jumlah', 10, 2)->default(0);
            $table->string('satuan', 50);
            $table->decimal('stok_minimum', 10, 2)->default(0);
            $table->decimal('harga_satuan', 12, 2)->default(0);
            $table->enum('status', ['aman', 'kritis', 'habis'])->default('aman');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stok_bahan');
    }
}
