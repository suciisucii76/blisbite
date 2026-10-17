<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanTable extends Migration
{
    public function up()
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('periode', 50);
            $table->decimal('total_pemasukan', 12, 2)->default(0);
            $table->decimal('total_pengeluaran', 12, 2)->default(0);
            $table->decimal('laba_bersih', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laporan');
    }
}
