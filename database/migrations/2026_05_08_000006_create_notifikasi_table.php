<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotifikasiTable extends Migration
{
    public function up()
    {
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stok_id')->constrained('stok_bahan')->onDelete('cascade');
            $table->text('pesan');
            $table->boolean('is_read')->default(false);
            $table->timestamp('tgl_kirim')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifikasi');
    }
}
