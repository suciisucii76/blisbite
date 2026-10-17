<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'notifikasi';

    public $timestamps = false;

    protected $fillable = [
        'stok_id',
        'pesan',
        'is_read',
        'tgl_kirim',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'tgl_kirim' => 'datetime',
    ];

    public function stok()
    {
        return $this->belongsTo(StokBahan::class, 'stok_id');
    }
}
