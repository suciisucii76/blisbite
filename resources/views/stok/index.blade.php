@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Stok Bahan') }}</h1>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Jenis Bahan</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalJenis }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Stok Aman</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalAman }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Stok Kritis</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalKritis }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex flex-wrap mb-3">
        <a href="{{ route('stok.index') }}" class="btn btn-sm {{ $statusFilter ? 'btn-outline-secondary' : 'btn-secondary' }} mr-2 mb-2">Semua</a>
        <a href="{{ route('stok.index', ['status' => 'aman']) }}" class="btn btn-sm {{ $statusFilter === 'aman' ? 'btn-success' : 'btn-outline-success' }} mr-2 mb-2">Aman</a>
        <a href="{{ route('stok.index', ['status' => 'kritis']) }}" class="btn btn-sm {{ $statusFilter === 'kritis' ? 'btn-warning' : 'btn-outline-warning' }} mr-2 mb-2">Kritis</a>
        <a href="{{ route('stok.index', ['status' => 'habis']) }}" class="btn btn-sm {{ $statusFilter === 'habis' ? 'btn-danger' : 'btn-outline-danger' }} mb-2">Habis</a>
    </div>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if (auth()->user()->role === 'admin')
        <div class="mb-3">
            <a href="{{ route('stok.create') }}" class="btn btn-primary">Tambah Bahan</a>
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama Bahan</th>
                <th>Kategori</th>
                <th>Stok Saat Ini</th>
                <th>Satuan</th>
                <th>Min. Stok</th>
                <th>Harga/Satuan</th>
                <th>Tgl Update</th>
                <th>Status</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($stok as $item)
                <tr>
                    <td>{{ $item->nama_bahan }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->satuan }}</td>
                    <td>{{ $item->stok_minimum }}</td>
                    <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                    <td>{{ $item->updated_at->format('d/m/Y') }}</td>
                    <td>
                        @if ($item->status === 'aman')
                            <span class="badge badge-success">Aman</span>
                        @elseif ($item->status === 'kritis')
                            <span class="badge badge-warning">Kritis</span>
                        @else
                            <span class="badge badge-danger">Habis</span>
                        @endif
                    </td>
                    <td>
                        @if (auth()->user()->role === 'admin')
                            <div class="d-flex">
                                <a href="{{ route('stok.edit', $item->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                                <a href="{{ route('stok.restock.form', $item->id) }}" class="btn btn-sm btn-info mr-2">Restock</a>
                                <form action="{{ route('stok.destroy', $item->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus bahan ini?')">Hapus</button>
                                </form>
                            </div>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Stok tidak tersedia</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $stok->links() }}
@endsection
