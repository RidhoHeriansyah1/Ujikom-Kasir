@extends('layouts.main')
@section('title')
    Petugas
@endsection
@section('content')
    <div class="card">
        <div class="card-header bg-purple">
            <div class="d-flex justify-content-between ">
                <span class="text-white fw-bold ">Petugas</span>
                <a href="{{ route('petugas.create') }}" class="btn btn-sm btn-success ">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Petugas</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($data)>0)
                        @foreach ($data as $dt)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dt->name }}</td>
                            <td>{{ $dt->email }}</td>
                            <td>
                                <div class="d-flex gap-1 ">
                                    <a href="{{ route('petugas.edit', $dt->id) }}" class="btn btn-sm btn-warning text-white"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
                                    @if(auth()->user()->role_id == 1)
                                    <form action="{{ route('petugas.destroy', $dt->id) }}" method="POST" onsubmit="return confirm('Hapus?')">
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
