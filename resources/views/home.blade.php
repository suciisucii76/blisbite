@extends('layouts.admin')

@section('main-content')
    @php($greeting = (function () {
        $h = (int) now()->format('H');
        if ($h < 11) return 'Selamat pagi';
        if ($h < 15) return 'Selamat siang';
        if ($h < 18) return 'Selamat sore';
        return 'Selamat malam';
    })())

    <!-- Dashboard hero -->
    <div class="dashboard-hero p-4 p-md-4 mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="d-inline-flex align-items-center mb-2" style="background: rgba(255,255,255,.25); padding: .3rem .75rem; border-radius: 999px; color: #fff7ed; font-weight: 700; font-size: .78rem; letter-spacing: .04em;">
                    <i class="fas fa-mug-hot mr-2"></i> {{ now()->format('l, d F Y') }}
                </div>
                <h1 class="headline-serif mb-1" style="color: #fff7ed; font-size: clamp(1.55rem, 3vw, 2rem); font-weight: 800;">
                    {{ $greeting }}, {{ Auth::user()->name }}!
                </h1>
                <p class="mb-0" style="color: rgba(255,247,237,.92);">Berikut ringkasan dapur dan kasir Anda hari ini.</p>
            </div>
            <div class="col-md-4 text-md-right mt-3 mt-md-0">
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('transaksi.create') }}" class="btn btn-light btn-sm font-weight-bold mr-2" style="color: var(--warung-saffron-dark); border-radius: 10px;">
                        <i class="fas fa-plus mr-1"></i> Transaksi
                    </a>
                @endif
                <a href="{{ route('laporan.index') }}" class="btn btn-outline-light btn-sm font-weight-bold" style="border-radius: 10px;">
                    <i class="fas fa-chart-line mr-1"></i> Laporan
                </a>
            </div>
        </div>
    </div>

    @if ($notifikasi->count() > 0)
        <div class="alert alert-warning d-flex align-items-start" role="alert">
            <i class="fas fa-bell mt-1 mr-2"></i>
            <div>
                <strong>Notifikasi Stok</strong>
                <ul class="mb-0 pl-3 mt-1">
                    @foreach ($notifikasi as $notif)
                        <li>{{ $notif->pesan }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Stat cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card stat-saffron h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: var(--warung-saffron-dark); letter-spacing: .06em;">Pendapatan Hari Ini</div>
                            <div class="h4 mb-0 headline-serif font-weight-bold" style="color: var(--warung-brown);">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</div>
                            <div class="small mt-2" style="color: #92400e;">
                                @if (!is_null($perubahanPendapatan))
                                    @if ($perubahanPendapatan >= 0)
                                        <span class="text-success font-weight-bold"><i class="fas fa-arrow-up"></i> {{ number_format($perubahanPendapatan, 1) }}%</span>
                                    @else
                                        <span class="text-danger font-weight-bold"><i class="fas fa-arrow-down"></i> {{ number_format(abs($perubahanPendapatan), 1) }}%</span>
                                    @endif
                                    vs kemarin
                                @else
                                    Belum ada pembanding
                                @endif
                            </div>
                        </div>
                        <span class="stat-icon"><i class="fas fa-coins"></i></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card stat-leaf h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: #4d7c0f; letter-spacing: .06em;">Total Transaksi</div>
                            <div class="h4 mb-0 headline-serif font-weight-bold" style="color: var(--warung-brown);">{{ $totalTransaksiHariIni }}</div>
                            <div class="small mt-2" style="color: #92400e;">Transaksi tercatat hari ini</div>
                        </div>
                        <span class="stat-icon"><i class="fas fa-receipt"></i></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card stat-amber h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: #92400e; letter-spacing: .06em;">Pengeluaran Bulan Ini</div>
                            <div class="h4 mb-0 headline-serif font-weight-bold" style="color: var(--warung-brown);">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
                            <div class="small mt-2" style="color: #92400e;">Belanja bahan &amp; operasional</div>
                        </div>
                        <span class="stat-icon"><i class="fas fa-shopping-basket"></i></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card stat-cocoa h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: #1e40af; letter-spacing: .06em;">Laba Bersih (Bulan)</div>
                            <div class="h4 mb-0 headline-serif font-weight-bold" style="color: var(--warung-brown);">Rp {{ number_format($labaBersih, 0, ',', '.') }}</div>
                            <div class="small mt-2" style="color: #92400e;">Pendapatan dikurangi pengeluaran</div>
                        </div>
                        <span class="stat-icon"><i class="fas fa-chart-pie"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card shadow-sm">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-chart-line mr-2" style="color: var(--warung-saffron-dark);"></i> Grafik Penjualan</h6>
                    <div class="btn-group btn-group-sm" role="group">
                        <button type="button" class="btn btn-outline-primary active" id="chart-week">Mingguan</button>
                        <button type="button" class="btn btn-outline-primary" id="chart-month">Bulanan</button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="chart-data"
                        data-weekly-labels='@json($weeklyLabels)'
                        data-weekly-data='@json($weeklyData)'
                        data-monthly-labels='@json($monthlyLabels)'
                        data-monthly-data='@json($monthlyData)'></div>
                    <canvas id="salesChart" height="120"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-bolt mr-2" style="color: var(--warung-saffron-dark);"></i> Aksi Cepat</h6>
                </div>
                <div class="card-body">
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('transaksi.create') }}" class="btn btn-primary btn-block mb-2 font-weight-bold">
                            <i class="fas fa-plus-circle mr-1"></i> Tambah Transaksi
                        </a>
                        <a href="{{ route('stok.index') }}" class="btn btn-outline-primary btn-block mb-2 font-weight-bold">
                            <i class="fas fa-warehouse mr-1"></i> Update Stok
                        </a>
                    @endif
                    <a href="{{ route('laporan.index') }}" class="btn btn-outline-primary btn-block mb-2 font-weight-bold">
                        <i class="fas fa-file-alt mr-1"></i> Lihat Laporan
                    </a>
                    <a href="{{ route('laporan.export.excel') }}" class="btn btn-outline-success btn-block font-weight-bold">
                        <i class="fas fa-file-excel mr-1"></i> Export Excel
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold"><i class="fas fa-history mr-2" style="color: var(--warung-saffron-dark);"></i> Transaksi Terbaru</h6>
            <a href="{{ route('transaksi.index') }}" class="small font-weight-bold" style="color: var(--warung-saffron-dark);">Lihat semua <i class="fas fa-arrow-right ml-1"></i></a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderless align-middle mb-0" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal</th>
                            <th>Produk</th>
                            <th class="text-right">Total</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transaksiTerbaru as $transaksi)
                            <tr>
                                <td class="font-weight-bold" style="color: var(--warung-brown);">#{{ $transaksi->id }}</td>
                                <td>{{ $transaksi->tanggal->format('d M Y') }}</td>
                                <td>
                                    @foreach($transaksi->detailTransaksi as $detail)
                                        <span class="d-inline-block">{{ $detail->produk->nama_produk }}@if(!$loop->last),@endif</span>
                                    @endforeach
                                </td>
                                <td class="text-right font-weight-bold" style="color: var(--warung-brown);">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <span class="badge badge-{{ $transaksi->status == 'valid' ? 'success' : 'warning' }}">{{ ucfirst($transaksi->status) }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <div style="color: #92400e;">
                                        <i class="fas fa-inbox mb-2" style="font-size: 1.8rem; opacity:.5;"></i>
                                        <div class="font-weight-bold">Belum ada transaksi</div>
                                        <div class="small">Catat transaksi pertama untuk melihatnya di sini.</div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('css')
<style>
    .dashboard-hero {
        background: linear-gradient(135deg, var(--warung-saffron) 0%, var(--warung-terracotta) 100%);
        border-radius: 20px;
        color: #fff;
        position: relative;
        overflow: hidden;
        box-shadow: 0 1rem 2rem rgba(120, 53, 15, .18);
    }
    .dashboard-hero::before {
        content: ""; position: absolute; inset: 0;
        background-image: radial-gradient(rgba(255,255,255,.1) 1.5px, transparent 1.5px);
        background-size: 22px 22px;
        opacity: .55;
    }
    .dashboard-hero::after {
        content: "\f805";
        font-family: "Font Awesome 5 Free"; font-weight: 900;
        position: absolute; right: -20px; bottom: -40px;
        font-size: 11rem; opacity: .08;
    }
    .dashboard-hero > .row { position: relative; z-index: 2; }

    .stat-card {
        border: 1px solid rgba(120, 53, 15, .08);
        border-left: 5px solid transparent;
        background: #fff;
        transition: transform .15s ease, box-shadow .15s ease;
    }
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 1rem 2rem rgba(120, 53, 15, .12);
    }
    .stat-card .stat-icon {
        width: 50px; height: 50px;
        border-radius: 14px;
        display: inline-flex; align-items: center; justify-content: center;
        color: #fff;
        font-size: 1.2rem;
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.1);
    }
    .stat-card.stat-saffron { border-left-color: #d97706; }
    .stat-card.stat-saffron .stat-icon { background: linear-gradient(135deg, #f59e0b, #d97706); }
    .stat-card.stat-leaf    { border-left-color: #65a30d; }
    .stat-card.stat-leaf .stat-icon { background: linear-gradient(135deg, #84cc16, #4d7c0f); }
    .stat-card.stat-amber   { border-left-color: #92400e; }
    .stat-card.stat-amber .stat-icon { background: linear-gradient(135deg, #b45309, #92400e); }
    .stat-card.stat-cocoa   { border-left-color: #3730a3; }
    .stat-card.stat-cocoa .stat-icon { background: linear-gradient(135deg, #6366f1, #4338ca); }

    /* Tighten chart-toggle buttons */
    .btn-group .btn.active { background: var(--warung-saffron); color: #fff; border-color: var(--warung-saffron); }
</style>
@endpush

@push('js')
<script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const chartDataEl = document.getElementById('chart-data');
        const weeklyLabels = JSON.parse(chartDataEl.dataset.weeklyLabels);
        const weeklyData = JSON.parse(chartDataEl.dataset.weeklyData);
        const monthlyLabels = JSON.parse(chartDataEl.dataset.monthlyLabels);
        const monthlyData = JSON.parse(chartDataEl.dataset.monthlyData);

        const ctx = document.getElementById('salesChart').getContext('2d');
        const gradient = ctx.createLinearGradient(0, 0, 0, 320);
        gradient.addColorStop(0, 'rgba(217, 119, 6, .35)');
        gradient.addColorStop(1, 'rgba(217, 119, 6, 0)');

        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: weeklyLabels,
                datasets: [{
                    label: 'Pendapatan',
                    data: weeklyData,
                    backgroundColor: gradient,
                    borderColor: '#d97706',
                    borderWidth: 3,
                    pointRadius: 4,
                    pointBackgroundColor: '#b45309',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.35
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        gridLines: { color: 'rgba(120, 53, 15, .08)', zeroLineColor: 'rgba(120, 53, 15, .15)' },
                        ticks: {
                            beginAtZero: true,
                            fontColor: '#92400e',
                            callback: function(value) {
                                return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                            }
                        }
                    }],
                    xAxes: [{
                        gridLines: { display: false },
                        ticks: { fontColor: '#92400e' }
                    }]
                },
                legend: { display: false },
                tooltips: {
                    backgroundColor: '#78350f',
                    titleFontColor: '#fef3c7',
                    bodyFontColor: '#fff',
                    cornerRadius: 8,
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var label = data.datasets[tooltipItem.datasetIndex].label || '';
                            if (label) label += ': ';
                            label += 'Rp ' + new Intl.NumberFormat('id-ID').format(tooltipItem.yLabel);
                            return label;
                        }
                    }
                }
            }
        });

        function updateChart(labels, data) {
            salesChart.data.labels = labels;
            salesChart.data.datasets[0].data = data;
            salesChart.update();
        }

        const weekBtn = document.getElementById('chart-week');
        const monthBtn = document.getElementById('chart-month');

        weekBtn.addEventListener('click', function() {
            updateChart(weeklyLabels, weeklyData);
            weekBtn.classList.add('active');
            monthBtn.classList.remove('active');
        });

        monthBtn.addEventListener('click', function() {
            updateChart(monthlyLabels, monthlyData);
            monthBtn.classList.add('active');
            weekBtn.classList.remove('active');
        });
    });
</script>
@endpush
