<?php

namespace App\Http\Controllers;

use App\Exports\LaporanExport;
use App\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $periode = $request->query('periode', 'bulanan');
        [$startDate, $endDate] = $this->resolvePeriod($request, $periode);

        $baseQuery = Transaksi::where('status', 'valid');
        if ($startDate && $endDate) {
            $baseQuery->whereBetween('tanggal', [$startDate->toDateString(), $endDate->toDateString()]);
        }

        $transaksi = (clone $baseQuery)
            ->orderByDesc('tanggal')
            ->paginate(10)
            ->appends($request->query());

        $totalPemasukan = (clone $baseQuery)->where('tipe', 'pemasukan')->sum('total_harga');
        $totalPengeluaran = (clone $baseQuery)->where('tipe', 'pengeluaran')->sum('total_harga');
        $labaBersih = $totalPemasukan - $totalPengeluaran;
        $jumlahTransaksi = (clone $baseQuery)->count();

        $chartLabels = [];
        $chartPemasukan = [];
        $chartPengeluaran = [];

        if ($startDate && $endDate) {
            $cursor = $startDate->copy();
            while ($cursor->lte($endDate)) {
                $label = $cursor->format('d M');
                $chartLabels[] = $label;
                $chartPemasukan[] = (clone $baseQuery)
                    ->where('tipe', 'pemasukan')
                    ->whereDate('tanggal', $cursor)
                    ->sum('total_harga');
                $chartPengeluaran[] = (clone $baseQuery)
                    ->where('tipe', 'pengeluaran')
                    ->whereDate('tanggal', $cursor)
                    ->sum('total_harga');
                $cursor->addDay();
            }
        }

        $breakdown = [
            ['label' => 'Bahan Baku', 'value' => 0],
            ['label' => 'Operasional', 'value' => 0],
            ['label' => 'Pengiriman', 'value' => 0],
            ['label' => 'Lain-lain', 'value' => 0],
        ];

        return view('laporan.index', [
            'title' => 'Laporan Keuangan',
            'transaksi' => $transaksi,
            'periode' => $periode,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'totalPemasukan' => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
            'labaBersih' => $labaBersih,
            'jumlahTransaksi' => $jumlahTransaksi,
            'chartLabels' => $chartLabels,
            'chartPemasukan' => $chartPemasukan,
            'chartPengeluaran' => $chartPengeluaran,
            'breakdown' => $breakdown,
        ]);
    }

    public function exportExcel(Request $request)
    {
        $periode = $request->query('periode', 'bulanan');
        [$startDate, $endDate] = $this->resolvePeriod($request, $periode);

        return Excel::download(new LaporanExport($startDate, $endDate), 'laporan-keuangan.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $periode = $request->query('periode', 'bulanan');
        [$startDate, $endDate] = $this->resolvePeriod($request, $periode);

        $query = Transaksi::where('status', 'valid');
        if ($startDate && $endDate) {
            $query->whereBetween('tanggal', [$startDate->toDateString(), $endDate->toDateString()]);
        }

        $transaksi = $query->orderByDesc('tanggal')->get();

        $totalPemasukan = (clone $query)->where('tipe', 'pemasukan')->sum('total_harga');
        $totalPengeluaran = (clone $query)->where('tipe', 'pengeluaran')->sum('total_harga');
        $labaBersih = $totalPemasukan - $totalPengeluaran;

        $pdf = Pdf::loadView('laporan.pdf', [
            'transaksi' => $transaksi,
            'totalPemasukan' => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
            'labaBersih' => $labaBersih,
            'periode' => $periode,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);

        return $pdf->download('laporan-keuangan.pdf');
    }

    private function resolvePeriod(Request $request, $periode)
    {
        $now = Carbon::now();

        if ($periode === 'harian') {
            return [$now->copy()->startOfDay(), $now->copy()->endOfDay()];
        }

        if ($periode === 'mingguan') {
            return [$now->copy()->subDays(6)->startOfDay(), $now->copy()->endOfDay()];
        }

        if ($periode === 'kustom') {
            $start = $request->query('start_date');
            $end = $request->query('end_date');
            if ($start && $end) {
                return [Carbon::parse($start)->startOfDay(), Carbon::parse($end)->endOfDay()];
            }
        }

        return [$now->copy()->startOfMonth(), $now->copy()->endOfDay()];
    }
}
