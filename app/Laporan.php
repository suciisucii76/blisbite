<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporan';

    protected $fillable = [
        'user_id',
        'periode',
        'total_pemasukan',
        'total_pengeluaran',
        'laba_bersih',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
