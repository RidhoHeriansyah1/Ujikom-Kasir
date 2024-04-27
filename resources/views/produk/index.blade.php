@extends('layouts.main')
@section('title')
    Produk
@endsection
@section('content')
    <div class="card">
        <div class="card-header bg-purple">
            <div class="d-flex justify-content-between ">
                <span class="text-white fw-bold ">Produk</span>
                <a href="{{ route('produk.create') }}" class="btn btn-sm btn-success ">Tambah</a>
            </div>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($data) > 0)
                            @foreach ($data as $dt)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $dt->nama_produk }}</td>
                                    <td>{{ rupiah($dt->harga) }}</td>
                                    <td>{{ $dt->stok }}</td>
                                    <td>
                                        <div class="d-flex gap-1 ">
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#tambahStok{{ $dt->produk_id }}">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </button>
                                            <a href="{{ route('produk.edit', $dt->produk_id) }}"
                                                class="btn btn-sm btn-warning text-white"><i class="fa fa-pencil-square"
                                                    aria-hidden="true"></i></a>
                                            @if (auth()->user()->role_id == 1)
                                                <form action="{{ route('produk.destroy', $dt->produk_id) }}" method="POST"
                                                    onsubmit="return confirm('Hapus?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger "><i
                                                            class="fa fa-trash" aria-hidden="true"></i></button>
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

    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    @foreach ($data as $item)
        <div class="modal fade" id="tambahStok{{ $item->produk_id }}" tabindex="-1" data-bs-backdrop="static"
            data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Tambah Stok
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('stok.create') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="" class="form-label">Tambah Stok</label>
                                <input type="number" name="stok" id="" class="form-control">
                                <input type="hidden" name="produk_id" value="{{ $item->produk_id }}">
                            </div>
                            <div class="d-flex justify-content-end gap-2">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
