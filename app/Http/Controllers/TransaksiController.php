<?php

namespace App\Http\Controllers;

use App\DetailTransaksi;
use App\Produk;
use App\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        return view('transaksi.index', [
            'title' => 'Transaksi',
            'transaksi' => Transaksi::with('detailTransaksi.produk')
                ->orderByDesc('tanggal')
                ->paginate(10),
        ]);
    }

    public function create()
    {
        return view('transaksi.create', [
            'title' => 'Tambah Transaksi',
            'produk' => Produk::where('is_active', true)->orderBy('nama_produk')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => ['required', 'date'],
            'metode_bayar' => ['required', 'in:cash,transfer,lainnya'],
            'tipe' => ['required', 'in:pemasukan,pengeluaran'],
            'catatan' => ['nullable', 'string'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.produk_id' => ['required', 'exists:produk,id'],
            'items.*.qty' => ['required', 'integer', 'min:1'],
            'items.*.harga_saat_jual' => ['required', 'numeric', 'min:0'],
        ]);

        DB::transaction(function () use ($validated) {
            $total = collect($validated['items'])->sum(function ($item) {
                return $item['qty'] * $item['harga_saat_jual'];
            });

            $transaksi = Transaksi::create([
                'user_id' => auth()->id(),
                'tanggal' => $validated['tanggal'],
                'total_harga' => $total,
                'metode_bayar' => $validated['metode_bayar'],
                'tipe' => $validated['tipe'],
                'catatan' => $validated['catatan'] ?? null,
                'status' => 'valid',
            ]);

            foreach ($validated['items'] as $item) {
                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'produk_id' => $item['produk_id'],
                    'qty' => $item['qty'],
                    'harga_saat_jual' => $item['harga_saat_jual'],
                ]);
            }
        });

        return redirect()->route('transaksi.index')->with('message', 'Transaksi berhasil disimpan.');
    }

    public function show(Transaksi $transaksi)
    {
        $transaksi->load('detailTransaksi.produk', 'user');

        return view('transaksi.show', [
            'title' => 'Detail Transaksi',
            'transaksi' => $transaksi,
        ]);
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->status = 'batal';
        $transaksi->save();

        return redirect()->route('transaksi.index')->with('message', 'Transaksi dibatalkan.');
    }
}
