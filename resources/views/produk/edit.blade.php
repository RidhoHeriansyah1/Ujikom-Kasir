@extends('layouts.main')
@section('title')
    Produk
@endsection
@section('content')
    <div class="card">
        <div class="card-header bg-purple text-white ">Tambah Produk</div>
        <div class="card-body">
            <form action="{{ route('produk.update', $data->produk_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-12 mb-5">
                        <div class="form-group">
                            <label for="nama_produk" class="form-label">Nama Produk</label>
                            <input type="text" name="nama_produk" class="form-control" value="{{ $data->nama_produk}}">
                        </div>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <div class="form-group">
                            <label for="nama_produk" class="form-label">Harga</label>
                            <input type="number" name="harga" class="form-control" value="{{ $data->harga }}">
                        </div>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <div class="form-group">
                            <label for="nama_produk" class="form-label">Stok</label>
                            <input type="number" name="stok" class="form-control" value="{{ $data->stok }}">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-3">
                    <a href="{{ route('produk.index') }}" class="btn btn-sm btn-info text-white">Kembali</a>
                    <button type="submit" class="btn btn-sm btn-success ">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
