@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Edit Produk') }}</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('produk.update', $produk->id) }}" method="post">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="nama_produk">Nama Produk</label>
                    <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" name="nama_produk" id="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" autocomplete="off">
                    @error('nama_produk')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <input type="text" class="form-control @error('kategori') is-invalid @enderror" name="kategori" id="kategori" value="{{ old('kategori', $produk->kategori) }}" autocomplete="off">
                    @error('kategori')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="harga_satuan">Harga Satuan</label>
                    <input type="number" step="0.01" class="form-control @error('harga_satuan') is-invalid @enderror" name="harga_satuan" id="harga_satuan" value="{{ old('harga_satuan', $produk->harga_satuan) }}" autocomplete="off">
                    @error('harga_satuan')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="emoji_icon">Emoji Icon</label>
                    <input type="text" class="form-control @error('emoji_icon') is-invalid @enderror" name="emoji_icon" id="emoji_icon" value="{{ old('emoji_icon', $produk->emoji_icon) }}" autocomplete="off">
                    @error('emoji_icon')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active', $produk->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Aktif</label>
                </div>

                <button type="submit" class="btn btn-primary">Perbarui</button>
                <a href="{{ route('produk.index') }}" class="btn btn-default">Kembali</a>
            </form>
        </div>
    </div>
@endsection
