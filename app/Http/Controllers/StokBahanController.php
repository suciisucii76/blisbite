<?php

namespace App\Http\Controllers;

use App\Notifikasi;
use App\StokBahan;
use Illuminate\Http\Request;

class StokBahanController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');

        $query = StokBahan::query();

        if (in_array($status, ['aman', 'kritis', 'habis'], true)) {
            $query->where('status', $status);
        }

        return view('stok.index', [
            'title' => 'Stok Bahan',
            'stok' => $query->orderByDesc('updated_at')->paginate(10)->appends($request->query()),
            'totalJenis' => StokBahan::count(),
            'totalAman' => StokBahan::where('status', 'aman')->count(),
            'totalKritis' => StokBahan::where('status', 'kritis')->count(),
            'statusFilter' => $status,
        ]);
    }

    public function create()
    {
        return view('stok.create', [
            'title' => 'Tambah Bahan',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_bahan' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:100'],
            'jumlah' => ['required', 'numeric', 'min:0'],
            'satuan' => ['required', 'string', 'max:50'],
            'stok_minimum' => ['required', 'numeric', 'min:0'],
            'harga_satuan' => ['required', 'numeric', 'min:0'],
        ]);

        $validated['status'] = $this->calculateStatus($validated['jumlah'], $validated['stok_minimum']);

        $stok = StokBahan::create($validated);

        $this->createNotificationIfNeeded($stok, $stok->status);

        return redirect()->route('stok.index')->with('message', 'Bahan berhasil ditambahkan.');
    }

    public function edit(StokBahan $stok)
    {
        return view('stok.edit', [
            'title' => 'Edit Bahan',
            'stok' => $stok,
        ]);
    }

    public function update(Request $request, StokBahan $stok)
    {
        $validated = $request->validate([
            'nama_bahan' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:100'],
            'jumlah' => ['required', 'numeric', 'min:0'],
            'satuan' => ['required', 'string', 'max:50'],
            'stok_minimum' => ['required', 'numeric', 'min:0'],
            'harga_satuan' => ['required', 'numeric', 'min:0'],
        ]);

        $newStatus = $this->calculateStatus($validated['jumlah'], $validated['stok_minimum']);
        $oldStatus = $stok->status;

        $validated['status'] = $newStatus;
        $stok->update($validated);

        if ($oldStatus !== $newStatus) {
            $this->createNotificationIfNeeded($stok, $newStatus);
        }

        return redirect()->route('stok.index')->with('message', 'Bahan berhasil diperbarui.');
    }

    public function destroy(StokBahan $stok)
    {
        $stok->delete();

        return redirect()->route('stok.index')->with('message', 'Bahan berhasil dihapus.');
    }

    public function restockForm(StokBahan $stok)
    {
        return view('stok.restock', [
            'title' => 'Restock Bahan',
            'stok' => $stok,
        ]);
    }

    public function restock(Request $request, StokBahan $stok)
    {
        $validated = $request->validate([
            'jumlah_tambah' => ['required', 'numeric', 'min:0.01'],
        ]);

        $stok->jumlah = $stok->jumlah + $validated['jumlah_tambah'];
        $newStatus = $this->calculateStatus($stok->jumlah, $stok->stok_minimum);
        $oldStatus = $stok->status;
        $stok->status = $newStatus;
        $stok->save();

        if ($oldStatus !== $newStatus) {
            $this->createNotificationIfNeeded($stok, $newStatus);
        }

        return redirect()->route('stok.index')->with('message', 'Stok berhasil ditambah.');
    }

    private function calculateStatus($jumlah, $stokMinimum)
    {
        if ($jumlah <= 0) {
            return 'habis';
        }

        if ($jumlah <= $stokMinimum) {
            return 'kritis';
        }

        return 'aman';
    }

    private function createNotificationIfNeeded(StokBahan $stok, $status)
    {
        if (!in_array($status, ['kritis', 'habis'], true)) {
            return;
        }

        Notifikasi::create([
            'stok_id' => $stok->id,
            'pesan' => 'Stok "' . $stok->nama_bahan . '" saat ini ' . $status . '.',
            'is_read' => false,
            'tgl_kirim' => now(),
        ]);
    }
}
