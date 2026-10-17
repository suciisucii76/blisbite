@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Edit Bahan') }}</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('stok.update', $stok->id) }}" method="post">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="nama_bahan">Nama Bahan</label>
                    <input type="text" class="form-control @error('nama_bahan') is-invalid @enderror" name="nama_bahan" id="nama_bahan" value="{{ old('nama_bahan', $stok->nama_bahan) }}" autocomplete="off">
                    @error('nama_bahan')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <input type="text" class="form-control @error('kategori') is-invalid @enderror" name="kategori" id="kategori" value="{{ old('kategori', $stok->kategori) }}" autocomplete="off">
                    @error('kategori')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jumlah">Stok Saat Ini</label>
                    <input type="number" step="0.01" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" id="jumlah" value="{{ old('jumlah', $stok->jumlah) }}" autocomplete="off">
                    @error('jumlah')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="satuan">Satuan</label>
                    <input type="text" class="form-control @error('satuan') is-invalid @enderror" name="satuan" id="satuan" value="{{ old('satuan', $stok->satuan) }}" autocomplete="off">
                    @error('satuan')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="stok_minimum">Stok Minimum</label>
                    <input type="number" step="0.01" class="form-control @error('stok_minimum') is-invalid @enderror" name="stok_minimum" id="stok_minimum" value="{{ old('stok_minimum', $stok->stok_minimum) }}" autocomplete="off">
                    @error('stok_minimum')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="harga_satuan">Harga Satuan</label>
                    <input type="number" step="0.01" class="form-control @error('harga_satuan') is-invalid @enderror" name="harga_satuan" id="harga_satuan" value="{{ old('harga_satuan', $stok->harga_satuan) }}" autocomplete="off">
                    @error('harga_satuan')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Perbarui</button>
                <a href="{{ route('stok.index') }}" class="btn btn-default">Kembali</a>
            </form>
        </div>
    </div>
@endsection
