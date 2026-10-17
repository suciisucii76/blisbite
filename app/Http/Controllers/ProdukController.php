<?php

namespace App\Http\Controllers;

use App\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        return view('produk.index', [
            'title' => 'Produk',
            'produk' => Produk::orderBy('nama_produk')->paginate(10),
        ]);
    }

    public function create()
    {
        return view('produk.create', [
            'title' => 'Tambah Produk',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => ['required', 'string', 'max:255'],
            'harga_satuan' => ['required', 'numeric', 'min:0'],
            'kategori' => ['required', 'string', 'max:100'],
            'emoji_icon' => ['nullable', 'string', 'max:10'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        Produk::create($validated);

        return redirect()->route('produk.index')->with('message', 'Produk berhasil ditambahkan.');
    }

    public function edit(Produk $produk)
    {
        return view('produk.edit', [
            'title' => 'Edit Produk',
            'produk' => $produk,
        ]);
    }

    public function update(Request $request, Produk $produk)
    {
        $validated = $request->validate([
            'nama_produk' => ['required', 'string', 'max:255'],
            'harga_satuan' => ['required', 'numeric', 'min:0'],
            'kategori' => ['required', 'string', 'max:100'],
            'emoji_icon' => ['nullable', 'string', 'max:10'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $produk->update($validated);

        return redirect()->route('produk.index')->with('message', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        $produk->delete();

        return redirect()->route('produk.index')->with('message', 'Produk berhasil dihapus.');
    }
}
