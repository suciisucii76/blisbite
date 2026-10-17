<?php

namespace Database\Seeders;

use App\DetailTransaksi;
use App\Notifikasi;
use App\Produk;
use App\StokBahan;
use App\Transaksi;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $admin = User::create([
            'name' => 'Super',
            'last_name' => 'Administrator',
            'email' => 'admin@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Pemilik',
            'last_name' => 'UMKM',
            'email' => 'pemilik@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'pemilik',
        ]);

        $produkData = [
            ['nama_produk' => 'Nasi Goreng Spesial', 'harga_satuan' => 25000, 'kategori' => 'Makanan', 'emoji_icon' => '🍳', 'is_active' => true],
            ['nama_produk' => 'Mie Ayam', 'harga_satuan' => 18000, 'kategori' => 'Makanan', 'emoji_icon' => '🍜', 'is_active' => true],
            ['nama_produk' => 'Es Teh Manis', 'harga_satuan' => 5000, 'kategori' => 'Minuman', 'emoji_icon' => '🧋', 'is_active' => true],
            ['nama_produk' => 'Kopi Susu', 'harga_satuan' => 12000, 'kategori' => 'Minuman', 'emoji_icon' => '☕', 'is_active' => true],
            ['nama_produk' => 'Paket Hemat', 'harga_satuan' => 30000, 'kategori' => 'Paket', 'emoji_icon' => '🍱', 'is_active' => true],
        ];

        $produk = collect($produkData)->map(function ($data) {
            return Produk::create($data);
        });

        $stokItems = [
            ['nama_bahan' => 'Beras', 'kategori' => 'Bahan Baku', 'jumlah' => 20, 'satuan' => 'kg', 'stok_minimum' => 10, 'harga_satuan' => 12000],
            ['nama_bahan' => 'Ayam', 'kategori' => 'Bahan Baku', 'jumlah' => 5, 'satuan' => 'kg', 'stok_minimum' => 8, 'harga_satuan' => 32000],
            ['nama_bahan' => 'Telur', 'kategori' => 'Bahan Baku', 'jumlah' => 0, 'satuan' => 'kg', 'stok_minimum' => 3, 'harga_satuan' => 25000],
            ['nama_bahan' => 'Gula', 'kategori' => 'Operasional', 'jumlah' => 7, 'satuan' => 'kg', 'stok_minimum' => 5, 'harga_satuan' => 14000],
        ];

        foreach ($stokItems as $item) {
            $status = $item['jumlah'] <= 0 ? 'habis' : ($item['jumlah'] <= $item['stok_minimum'] ? 'kritis' : 'aman');
            $stok = StokBahan::create(array_merge($item, ['status' => $status]));

            if (in_array($status, ['kritis', 'habis'], true)) {
                Notifikasi::create([
                    'stok_id' => $stok->id,
                    'pesan' => 'Stok "' . $stok->nama_bahan . '" saat ini ' . $status . '.',
                    'is_read' => false,
                    'tgl_kirim' => now(),
                ]);
            }
        }

        for ($i = 0; $i < 10; $i++) {
            $tanggal = Carbon::now()->subDays(rand(0, 10))->toDateString();
            $tipe = rand(0, 1) ? 'pemasukan' : 'pengeluaran';
            $metode = ['cash', 'transfer', 'lainnya'][rand(0, 2)];

            $items = $produk->random(rand(1, 3));
            $total = 0;

            $transaksi = Transaksi::create([
                'user_id' => $admin->id,
                'tanggal' => $tanggal,
                'total_harga' => 0,
                'metode_bayar' => $metode,
                'tipe' => $tipe,
                'catatan' => 'Transaksi dummy ' . ($i + 1),
                'status' => 'valid',
            ]);

            foreach ($items as $item) {
                $qty = rand(1, 4);
                $subtotal = $qty * $item->harga_satuan;
                $total += $subtotal;

                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'produk_id' => $item->id,
                    'qty' => $qty,
                    'harga_saat_jual' => $item->harga_satuan,
                ]);
            }

            $transaksi->total_harga = $total;
            $transaksi->save();
        }
    }
}
