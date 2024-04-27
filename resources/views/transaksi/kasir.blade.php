@extends('layouts.main')
@section('title')
    Kasir
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-3 mb-3">
            <div class="form-group">
                <label for="" class="form-label">Petugas</label>
                <input type="text" class="form-control" readonly value="{{ auth()->user()->name }}">
            </div>
        </div>
        <div class="col-lg-3 mb-3">
            <div class="form-group">
                <label for="" class="form-label">Tanggak Transaksi</label>
                <input type="text" class="form-control" readonly value="{{ $date }}">
            </div>
        </div>
        <div class="col-lg-3 mb-3">
            <div class="form-group">
                <label for="" class="form-label">Nota</label>
                <input type="text" class="form-control" readonly value="{{ $id }}">
            </div>
        </div>
        <div class="col-lg-9 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="col-lg-12 mb-3">
                                <form id="getProduk">
                                    <div class="form-group">
                                        <label for="" class="form-label">Kode Produk</label>
                                        <div class="input-group">
                                            <input type="text" id="produk_id" class="form-control">
                                            <button type="submit" class="btn btn-success "><i class="fa fa-search"
                                                    aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <form action="{{ route('transaksi.keranjang') }}" method="POST">
                                @csrf
                                <div class="col-lg-12 mb-3">
                                    <div class="form-group">
                                        <label for="" class="form-label">Nama Barang</label>
                                        <input type="text" id="nama_produk" readonly class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <div class="form-group">
                                        <label for="" class="form-label">Harga (Rp)</label>
                                        <input type="text" id="harga" readonly class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <div class="form-group">
                                        <label for="" class="form-label">Quantiti</label>
                                        <input type="number" name="qty" id="qty" class="form-control">
                                    </div>
                                </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="col-lg-12 mb-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Member</label>

                                        <select name="pelanggan_id" id="member" class="form-select">
                                            @foreach ($pelanggan as $p)
                                            <option value="{{ null }}">Pilih ini Jika bukan member</option>
                                                <option value="{{ $p->pelanggan_id }}" {{ (isset($data->pelanggan_id) && $p->pelanggan_id == $data->pelanggan_id) ? 'selected' : '' }}>{{ $p->nama_pelanggan }}</option>
                                            @endforeach
                                        </select>

                                </div>
                            </div>
                            <input type="hidden" id="subtotal" name="subtotal">
                            <input type="hidden" name="penjualan_id" value="{{ $id }}">
                            <input type="hidden" name="petugas_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="produk_id" id="produk">
                        </div>
                    </div>
                    <button type="submit" class="w-100 btn btn-sm btn-success ">Keranjang</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <form action="{{ route('transaksi.pembayaran') }}" method="POST">
                @csrf
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="" class="form-label">Total Pembayaran</label>
                            <input type="number" id="total_pembayaran" name="total_pembayaran" readonly
                                class="form-control">
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="" class="form-label">Bayar</label>
                            <input type="number" name="bayar" id="bayar" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="" class="form-label">Kembalian</label>
                            <input type="number" name="kembalian" id="kembalian" readonly class="form-control">
                        </div>
                    </div>
                </div>
                <input type="hidden" name="penjualan_id" value="{{ $id }}">
                <input type="hidden" name="total_harga"
                    value="{{ isset($data) ? $data->detail->sum('subtotal') : '-' }}">
                    <input type="hidden" name="potongan_harga" id="potongan_harga">
                <div class="d-flex gap-3">
                    <a href="{{ route('dashboard') }}" class="btn btn-sm btn-info w-50 text-white ">Kembali</a>
                    <button type="submit" class="btn btn-sm btn-success w-50" id="btn-bayar">Bayar</button>
                </div>
            </form>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borle-hodered tabver">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Pelanggan</th>
                                    <th>Harga Satuan</th>
                                    <th>Qty</th>
                                    <th>SubTotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($data)
                                    <input type="hidden" id="pelanggan" value="{{ $data->pelanggan_id }}">
                                    @if (count($data->detail) > 0)
                                        @foreach ($data->detail as $dt)
                                            <tr>
                                                <td>{{ $dt->produk->nama_produk }}</td>
                                                <td>{{ isset($data->pelanggan_id) ? $data->pelanggan->nama_pelanggan : '-' }}
                                                </td>
                                                <td>{{ rupiah($dt->produk->harga) }}</td>
                                                <td>{{ $dt->jumlah_produk }}</td>
                                                <td>{{ rupiah($dt->subtotal) }}</td>
                                                <td>
                                                    <form action="{{ route('transaksi.hapus-keranjang', $dt->detail_id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger "><i
                                                                class="fa fa-trash" aria-hidden="true"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" align="center">Data Tidak Ada</td>
                                        </tr>
                                    @endif
                                @endisset
                                <tr>
                                    <td>Total Harga</td>
                                    <td colspan="5" align="center" class="fw-bold">
                                        {{ isset($data) ? rupiah($data->detail->sum('subtotal')) : '-' }}</td>
                                    <input type="hidden" id="totalHarga"
                                        value="{{ isset($data) ? $data->detail->sum('subtotal') : '-' }}">
                                </tr>

                                <tr>
                                    <td>Diskon</td>
                                    <td colspan="5" align="center" class="fw-bold" type="text">{{ isset($diskon->persen) ? $diskon->persen : 0 }} %</td>
                                    <input type="hidden" id="disc" value="{{ isset($diskon->persen) ? $diskon->persen : 0 }}">
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#getProduk').submit(function(e) {
                e.preventDefault();
                var produk_id = $('#produk_id').val();

                $.ajax({
                    type: "GET",
                    url: "{{ route('transaksi.getProduk') }}",
                    data: {
                        'produk_id': produk_id
                    },
                    success: function(response) {
                        $('#produk_id').val(response.produk_id);
                        $('#nama_produk').val(response.nama_produk);
                        $('#harga').val(response.harga);
                        $('#produk').val(response.produk_id);
                    },
                    error: function(error) {
                        $('#produk_id').val(null);
                        $('#nama_produk').val(null);
                        $('#harga').val(null);
                        $('#produk').val(null);
                        alert('Data Tidak Ada');
                    }
                });
            });

            $('#member').select2({
                theme: 'bootstrap-5',
            });

            $('#qty').keyup(function(e) {
                var qty = $('#qty').val();
                var harga = $('#harga').val();

                $('#subtotal').val(qty * harga);
            });

            $('#bayar').keyup(function(e) {
                var totalPembayaran = $('#total_pembayaran').val();
                var bayar = $(this).val();
                $('#kembalian').val(bayar - totalPembayaran);
            });

            $('#bayar').keyup(function() {
                var bayar = $(this).val();
                var totalPembayaran = $('#total_pembayaran').val();

                if ($('#kembalian').val() < 0) {
                    $('#btn-bayar').attr('disabled', 'true');
                } else {
                    $('#btn-bayar').removeAttr('disabled');
                }
            });
            if ($('#bayar').val() == '') {
                $('#btn-bayar').attr('disabled', 'true');
            };

            if ($('#pelanggan').val() && $('#totalHarga').val() >= 100000) {
                var totalHarga = $('#totalHarga').val();
                var diskon = $('#disc').val();
                var a = totalHarga * diskon / 100;
                console.log(diskon);
                $('#total_pembayaran').val(totalHarga - a);
                $('#potongan').text(a);
                $('#potongan_harga').val(a);
            }
            else{
                var totalHarga = $('#totalHarga').val();
                $('#total_pembayaran').val(totalHarga);
            }

        });
    </script>
@endsection
