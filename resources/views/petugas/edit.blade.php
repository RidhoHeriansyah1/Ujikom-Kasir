@extends('layouts.main')
@section('title')
    Edit Petugas
@endsection
@section('content')
    <div class="card">
        <div class="card-header bg-purple text-white ">Edit Petugas</div>
        <div class="card-body">
            <form action="{{ route('petugas.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-6 mb-5">
                        <div class="form-group">
                            <label for="nama_petugas" class="form-label">Nama Petugas</label>
                            <input type="text" name="name" class="form-control" value="{{ $data->name }}">
                        </div>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $data->email }}">
                        </div>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" value="">
                            <span class="text-danger">Kosongkan jika tidak diubah</span>
                        </div>
                    </div>
                    
                </div>
                <div class="d-flex justify-content-end gap-3">
                    <a href="{{ route('petugas.index') }}" class="btn btn-sm btn-info text-white">Kembali</a>
                    <button type="submit" class="btn btn-sm btn-success ">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
