@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Transaksi') }}</h1>

    <div class="mb-3">
        @if (auth()->user()->role === 'admin')
            <a href="{{ route('transaksi.create') }}" class="btn btn-primary">Tambah Transaksi</a>
        @endif
    </div>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Produk</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Status</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksi as $item)
                @php
                    $produkList = $item->detailTransaksi->map(function ($detail) {
                        return $detail->produk ? $detail->produk->nama_produk : '-';
                    })->filter()->values();
                    $qtyTotal = $item->detailTransaksi->sum('qty');
                @endphp
                <tr>
                    <td>#{{ $item->id }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $produkList->implode(', ') }}</td>
                    <td>{{ $qtyTotal }}</td>
                    <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                    <td>
                        @if ($item->status === 'valid')
                            <span class="badge badge-success">Valid</span>
                        @else
                            <span class="badge badge-danger">Batal</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('transaksi.show', $item->id) }}" class="btn btn-sm btn-info mr-2">Detail</a>
                            @if (auth()->user()->role === 'admin' && $item->status === 'valid')
                                <form action="{{ route('transaksi.destroy', $item->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Batalkan transaksi ini?')">Batalkan</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada transaksi tersedia</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $transaksi->links() }}
@endsection
