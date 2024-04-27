@extends('layouts.main')
<style>
    @media print {
        #print, #fot, #nav ,#card-navbar, #search{
            display: none
        }

    }
</style>
@section('title')
    Stok Masuk
@endsection
@section('content')
    <div class="card">
        <div class="card-header bg-purple">
            <div class="d-flex justify-content-between ">
                <span class="text-white fw-bold ">Stok Masuk</span>
                <button type="submit" id="print" class="btn btn-sm btn-info" onclick="return window.print()"><i
                        class="fa fa-print" aria-hidden="true"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="row" id="search">
                <div class="col-lg-6">
                    <form action="{{ route('stok.search') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 me=2">
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Dari Tanggal</label>
                                    <input type="date" name="dari" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Sampai Tanggal</label>
                                    <div class="d-flex gap-2">
                                        <input type="date" name="sampai" class="form-control"
                                            placeholder="">
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-search"
                                                aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Stok</th>
                            <th>Diinput</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($data) > 0)
                            @foreach ($data as $dt)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $dt->produk->nama_produk }}</td>
                                    <td>{{ $dt->stok }}</td>
                                    <td>{{ $dt->user->name }}</td>
                                    <td>{{ tanggal($dt->tanggal) }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="2">Jumlah Stok Masuk</td>
                                <td colspan="3" class="fw-bold">{{ $data->sum('stok') }}</td>
                            </tr>
                        @else
                            <td colspan="5" align="center">Data Kosong</td>
                        @endif
                    </tbody>
                </table>
                {{-- {{ $data->links('pagination::bootstrap-5') }} --}}
            </div>
        </div>
    </div>

@endsection
