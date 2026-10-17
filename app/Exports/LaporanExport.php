<?php

namespace App\Exports;

use App\Transaksi;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanExport implements FromView
{
    private $startDate;
    private $endDate;

    public function __construct(?Carbon $startDate, ?Carbon $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function view(): View
    {
        $query = Transaksi::where('status', 'valid');
        if ($this->startDate && $this->endDate) {
            $query->whereBetween('tanggal', [$this->startDate->toDateString(), $this->endDate->toDateString()]);
        }

        $transaksi = $query->orderByDesc('tanggal')->get();

        return view('laporan.excel', [
            'transaksi' => $transaksi,
        ]);
    }
}
