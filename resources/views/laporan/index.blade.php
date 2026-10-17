@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Laporan Keuangan') }}</h1>

    <div class="d-flex flex-wrap mb-3">
        <a href="{{ route('laporan.index', ['periode' => 'harian']) }}" class="btn btn-sm {{ $periode === 'harian' ? 'btn-primary' : 'btn-outline-primary' }} mr-2 mb-2">Harian</a>
        <a href="{{ route('laporan.index', ['periode' => 'mingguan']) }}" class="btn btn-sm {{ $periode === 'mingguan' ? 'btn-primary' : 'btn-outline-primary' }} mr-2 mb-2">Mingguan</a>
        <a href="{{ route('laporan.index', ['periode' => 'bulanan']) }}" class="btn btn-sm {{ $periode === 'bulanan' ? 'btn-primary' : 'btn-outline-primary' }} mr-2 mb-2">Bulanan</a>
        <a href="{{ route('laporan.index', ['periode' => 'kustom']) }}" class="btn btn-sm {{ $periode === 'kustom' ? 'btn-primary' : 'btn-outline-primary' }} mb-2">Kustom</a>
    </div>

    @if ($periode === 'kustom')
        <form class="form-inline mb-4" method="get" action="{{ route('laporan.index') }}">
            <input type="hidden" name="periode" value="kustom">
            <div class="form-group mr-2">
                <label class="mr-2" for="start_date">Mulai</label>
                <input type="date" class="form-control" name="start_date" id="start_date" value="{{ $startDate ? $startDate->toDateString() : '' }}">
            </div>
            <div class="form-group mr-2">
                <label class="mr-2" for="end_date">Selesai</label>
                <input type="date" class="form-control" name="end_date" id="end_date" value="{{ $endDate ? $endDate->toDateString() : '' }}">
            </div>
            <button type="submit" class="btn btn-primary">Terapkan</button>
        </form>
    @endif

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Pemasukan</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Pengeluaran</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Laba Bersih</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($labaBersih, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Transaksi</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahTransaksi }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tren Pemasukan vs Pengeluaran</h6>
                </div>
                <div class="card-body">
                    <div id="laporan-chart-data"
                        data-labels='@json($chartLabels)'
                        data-pemasukan='@json($chartPemasukan)'
                        data-pengeluaran='@json($chartPengeluaran)'></div>
                    <canvas id="laporanChart" height="120"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Breakdown Pengeluaran</h6>
                </div>
                <div class="card-body">
                    @foreach ($breakdown as $item)
                        <div class="d-flex justify-content-between mb-2">
                            <span>{{ $item['label'] }}</span>
                            <span>Rp {{ number_format($item['value'], 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <a href="{{ route('laporan.export.excel', request()->query()) }}" class="btn btn-success btn-sm">Export Excel</a>
        <a href="{{ route('laporan.export.pdf', request()->query()) }}" class="btn btn-danger btn-sm">Export PDF</a>
    </div>

    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Transaksi</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>ID</th>
                        <th>Keterangan</th>
                        <th>Tipe</th>
                        <th>Nominal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksi as $item)
                        <tr>
                            <td>{{ $item->tanggal }}</td>
                            <td>#{{ $item->id }}</td>
                            <td>{{ $item->catatan ?? '-' }}</td>
                            <td>
                                @if ($item->tipe === 'pemasukan')
                                    <span class="badge badge-success">Pemasukan</span>
                                @else
                                    <span class="badge badge-danger">Pengeluaran</span>
                                @endif
                            </td>
                            <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                            <td>
                                @if ($item->status === 'valid')
                                    <span class="badge badge-success">Valid</span>
                                @else
                                    <span class="badge badge-danger">Batal</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data laporan tersedia</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $transaksi->links() }}
        </div>
    </div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const dataEl = document.getElementById('laporan-chart-data');
    const labels = JSON.parse(dataEl.dataset.labels || '[]');
    const pemasukan = JSON.parse(dataEl.dataset.pemasukan || '[]');
    const pengeluaran = JSON.parse(dataEl.dataset.pengeluaran || '[]');

    const ctx = document.getElementById('laporanChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Pemasukan',
                    data: pemasukan,
                    borderColor: '#1cc88a',
                    backgroundColor: 'rgba(28, 200, 138, 0.1)',
                    fill: true,
                },
                {
                    label: 'Pengeluaran',
                    data: pengeluaran,
                    borderColor: '#e74a3b',
                    backgroundColor: 'rgba(231, 74, 59, 0.1)',
                    fill: true,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });
</script>
@endpush
