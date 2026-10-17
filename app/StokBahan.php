<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StokBahan extends Model
{
    protected $table = 'stok_bahan';

    protected $fillable = [
        'nama_bahan',
        'kategori',
        'jumlah',
        'satuan',
        'stok_minimum',
        'harga_satuan',
        'status',
    ];

    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class, 'stok_id');
    }
}
