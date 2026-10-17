@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Produk') }}</h1>

    <a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga Satuan</th>
                <th>Status</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($produk as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->emoji_icon ? $item->emoji_icon . ' ' : '' }}{{ $item->nama_produk }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                    <td>
                        @if ($item->is_active)
                            <span class="badge badge-success">Aktif</span>
                        @else
                            <span class="badge badge-secondary">Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                            <form action="{{ route('produk.destroy', $item->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus produk ini?')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada produk tersedia</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $produk->links() }}
@endsection
