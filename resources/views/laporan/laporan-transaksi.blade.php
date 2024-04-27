@extends('layouts.main')
<style>
    @media print {

        #print,
        #fot,
        #nav,
        #card-navbar,
        #search, .aksi, .ak {
            display: none
        }
#sa{
    margin: auto; 
}
    }
</style>
@section('title')
    Laporan Transaksi
@endsection
@section('content')
    <div class="card">
        <div class="card-header bg-purple">
            <div class="d-flex justify-content-between">
                <span class="text-white fw-bold ">Laporan Transaksi</span>
                @if (auth()->user()->role_id == 2)
                <button type="submit" class="btn btn-sm btn-info " id="print" onclick="return window.print()"><i class="fa fa-print" aria-hidden="true"></i></button>
                @endif
            </div>
        </div>
        <div class="card-body" id="sa">
            <div class="row" id="search">
                <div class="col-lg-6">
                    <form action="{{ route('transaksi.search') }}" method="POST">
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
                                        <input type="date" name="sampai" class="form-control" placeholder="">
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
                            <th>Nota</th>
                            <th>Total Harga</th>
                            <th>Total Pembayaran</th>
                            <th>Bayar</th>
                            <th>Kembalian</th>
                            <th>Potongan</th>
                            <th>Pelanggan</th>
                            <th>Kasir</th>
                            <td>Tanggal</td>
                            <th class="aksi">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($data)>0)
                        @foreach ($data as $dt)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $dt->penjualan_id }}</td>
                                <td>{{ rupiah($dt->total_harga) }}</td>
                                <td>{{ rupiah($dt->total_pembayaran) }}</td>
                                <td>{{ rupiah($dt->bayar) }}</td>
                                <td>{{ rupiah($dt->kembalian) }}</td>
                                <td>{{ rupiah($dt->potongan_harga) }}</td>
                                <td>{{ isset($dt->pelanggan_id) ? $dt->pelanggan->nama_pelanggan  : '-'}}</td>
                                <td>{{ $dt->petugas->name }}</td>
                                <td>{{ tanggal($dt->tanggal_penjualan) }}</td>
                                <td class="ak">
                                    <a href="{{ route('transaksi.struk', $dt->penjualan_id) }}" class="btn btn-sm btn-success "><i class="fa fa-print" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                    @endforeach
                    <tr>
                        <td colspan="3">Total Pendapatan</td>
                        <td colspan="7">{{ rupiah($data->sum('total_pembayaran')) }}</td>
                    </tr>
                        @else
                        <tr>
                        <td colspan="10" align="center">Data Kosong</td>
                    </tr>
                        @endif
                    </tbody>
                </table>
                {{-- {{ $data->links('pagination::bootstrap-5') }} --}}
            </div>
        </div>
    </div>
@endsection
