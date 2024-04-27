@extends('layouts.main')
@section('title')
    Pelanggan
@endsection
@section('content')
    <div class="card">
        <div class="card-header bg-purple">
            <div class="d-flex justify-content-between ">
                <span class="text-white fw-bold ">Pelanggan</span>
                <a href="{{ route('pelanggan.create') }}" class="btn btn-sm btn-success ">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Alamat</th>
                            <th>Nomor Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($data)>0)
                        @foreach ($data as $dt)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dt->nama_pelanggan }}</td>
                            <td>{{ $dt->alamat }}</td>
                            <td>{{ $dt->nomor_telepon }}</td>
                            <td>
                                <div class="d-flex gap-1 ">
                                    <a href="{{ route('pelanggan.edit', $dt->pelanggan_id) }}" class="btn btn-sm btn-warning text-white"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
                                    @if(auth()->user()->role_id == 1)
                                    <form action="{{ route('pelanggan.destroy', $dt->pelanggan_id) }}" method="POST" onsubmit="return confirm('Hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger "><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                        @else
                        <td colspan="5" align="center">Data Kosong</td>
                        @endif
                    </tbody>
                </table>
                {{ $data->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
