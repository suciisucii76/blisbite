<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->date('tanggal');
            $table->decimal('total_harga', 12, 2)->default(0);
            $table->enum('metode_bayar', ['cash', 'transfer', 'lainnya']);
            $table->enum('tipe', ['pemasukan', 'pengeluaran']);
            $table->text('catatan')->nullable();
            $table->enum('status', ['valid', 'batal'])->default('valid');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
