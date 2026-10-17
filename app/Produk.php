<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';

    protected $fillable = [
        'nama_produk',
        'harga_satuan',
        'kategori',
        'emoji_icon',
        'is_active',
    ];

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'produk_id');
    }
}
