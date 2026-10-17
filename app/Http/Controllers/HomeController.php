<?php

namespace App\Http\Controllers;

use App\Notifikasi;
use App\Transaksi;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $startOfMonth = Carbon::now()->startOfMonth();

        $pendapatanHariIni = Transaksi::where('status', 'valid')
            ->where('tipe', 'pemasukan')
            ->whereDate('tanggal', $today)
            ->sum('total_harga');

        $pendapatanKemarin = Transaksi::where('status', 'valid')
            ->where('tipe', 'pemasukan')
            ->whereDate('tanggal', $yesterday)
            ->sum('total_harga');

        $perubahanPendapatan = null;
        if ($pendapatanKemarin > 0) {
            $perubahanPendapatan = (($pendapatanHariIni - $pendapatanKemarin) / $pendapatanKemarin) * 100;
        }

        $totalTransaksiHariIni = Transaksi::where('status', 'valid')
            ->whereDate('tanggal', $today)
            ->count();

        $totalPengeluaran = Transaksi::where('status', 'valid')
            ->where('tipe', 'pengeluaran')
            ->whereBetween('tanggal', [$startOfMonth, Carbon::now()])
            ->sum('total_harga');

        $totalPemasukan = Transaksi::where('status', 'valid')
            ->where('tipe', 'pemasukan')
            ->whereBetween('tanggal', [$startOfMonth, Carbon::now()])
            ->sum('total_harga');

        $labaBersih = $totalPemasukan - $totalPengeluaran;

        $notifikasi = Notifikasi::orderByDesc('tgl_kirim')->limit(5)->get();

        $transaksiTerbaru = Transaksi::with('detailTransaksi.produk')
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        $weeklyLabels = [];
        $weeklyData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $weeklyLabels[] = $date->format('d M');
            $weeklyData[] = Transaksi::where('status', 'valid')
                ->where('tipe', 'pemasukan')
                ->whereDate('tanggal', $date)
                ->sum('total_harga');
        }

        $monthlyLabels = [];
        $monthlyData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthlyLabels[] = $month->format('M Y');
            $monthlyData[] = Transaksi::where('status', 'valid')
                ->where('tipe', 'pemasukan')
                ->whereBetween('tanggal', [$month->copy()->startOfMonth(), $month->copy()->endOfMonth()])
                ->sum('total_harga');
        }

        return view('home', [
            'pendapatanHariIni' => $pendapatanHariIni,
            'perubahanPendapatan' => $perubahanPendapatan,
            'totalTransaksiHariIni' => $totalTransaksiHariIni,
            'totalPengeluaran' => $totalPengeluaran,
            'labaBersih' => $labaBersih,
            'notifikasi' => $notifikasi,
            'transaksiTerbaru' => $transaksiTerbaru,
            'weeklyLabels' => $weeklyLabels,
            'weeklyData' => $weeklyData,
            'monthlyLabels' => $monthlyLabels,
            'monthlyData' => $monthlyData,
        ]);
    }
}
