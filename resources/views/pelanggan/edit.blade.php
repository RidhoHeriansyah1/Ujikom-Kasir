@extends('layouts.main')
@section('title')
    Edit Pelanggan
@endsection
@section('content')
    <div class="card">
        <div class="card-header bg-purple text-white ">Tambah Pelanggan</div>
        <div class="card-body">
            <form action="{{ route('pelanggan.update',$data->pelanggan_id ) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-6 mb-5">
                        <div class="form-group">
                            <label for="nama_produk" class="form-label">Nama Pelanggan</label>
                            <input type="text" name="nama_pelanggan" class="form-control" value="{{ $data->nama_pelanggan }}">
                        </div>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <div class="form-group">
                            <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                            <input type="number" name="nomor_telepon" class="form-control" value="{{ $data->nomor_telepon }}">
                        </div>
                    </div>
                    <div class="col-lg-12 mb-5">
                        <div class="form-group">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control" id="" cols="0" rows="0">{{ $data->alamat }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-3">
                    <a href="{{ route('pelanggan.index') }}" class="btn btn-sm btn-info text-white">Kembali</a>
                    <button type="submit" class="btn btn-sm btn-success ">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
