@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Detail Transaksi') }}</h1>

    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>ID:</strong> #{{ $transaksi->id }}</p>
                    <p><strong>Tanggal:</strong> {{ $transaksi->tanggal }}</p>
                    <p><strong>Admin:</strong> {{ $transaksi->user ? $transaksi->user->full_name : '-' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Metode Bayar:</strong> {{ ucfirst($transaksi->metode_bayar) }}</p>
                    <p><strong>Tipe:</strong> {{ ucfirst($transaksi->tipe) }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($transaksi->status) }}</p>
                </div>
            </div>
            @if ($transaksi->catatan)
                <p><strong>Catatan:</strong> {{ $transaksi->catatan }}</p>
            @endif
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>Harga Satuan</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi->detailTransaksi as $detail)
                        <tr>
                            <td>{{ $detail->produk ? $detail->produk->nama_produk : '-' }}</td>
                            <td>{{ $detail->qty }}</td>
                            <td>Rp {{ number_format($detail->harga_saat_jual, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($detail->qty * $detail->harga_saat_jual, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-right">
                <strong>Total: </strong>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
            </div>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('transaksi.index') }}" class="btn btn-default">Kembali</a>
    </div>
@endsection
