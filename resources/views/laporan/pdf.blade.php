<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background: #f3f3f3; }
        .summary { margin-top: 12px; }
    </style>
</head>
<body>
    <h2>Laporan Keuangan</h2>
    <p>Periode: {{ $periode }}</p>
    @if ($startDate && $endDate)
        <p>{{ $startDate->toDateString() }} - {{ $endDate->toDateString() }}</p>
    @endif

    <div class="summary">
        <p>Total Pemasukan: Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
        <p>Total Pengeluaran: Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
        <p>Laba Bersih: Rp {{ number_format($labaBersih, 0, ',', '.') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>ID</th>
                <th>Tipe</th>
                <th>Nominal</th>
                <th>Status</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $item)
                <tr>
                    <td>{{ $item->tanggal }}</td>
                    <td>#{{ $item->id }}</td>
                    <td>{{ $item->tipe }}</td>
                    <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->catatan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
