@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Restock Bahan') }}</h1>

    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <strong>{{ $stok->nama_bahan }}</strong>
                <div>Stok saat ini: {{ $stok->jumlah }} {{ $stok->satuan }}</div>
            </div>

            <form action="{{ route('stok.restock', $stok->id) }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="jumlah_tambah">Tambah Jumlah</label>
                    <input type="number" step="0.01" class="form-control @error('jumlah_tambah') is-invalid @enderror" name="jumlah_tambah" id="jumlah_tambah" value="{{ old('jumlah_tambah') }}" autocomplete="off">
                    @error('jumlah_tambah')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('stok.index') }}" class="btn btn-default">Kembali</a>
            </form>
        </div>
    </div>
@endsection
