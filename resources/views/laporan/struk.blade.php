<!doctype html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/all.css') }}" rel="stylesheet" />
    <style>
        @media print {
            #print {
                display: none;
            }

            .b-k {
                display: none
            }
            #p{
                margin: auto
            }
        }
    </style>
</head>

<body>
    <script>
        window.print()
    </script>
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <div class=" mt-5 d-flex justify-content-center" id="p">
        <div class="row">
            <h2 class="fs-2 mb-3">Toko Baju Ridho</h2>
            <span class="">Jalan Pangauban No. 127</span>
            <span class="">member : {{ isset($data->pelanggan_id) ? $data->pelanggan->nama_pelanggan : '-' }}
            </span>
            <span class="mb-3">{{ tanggal($data->tanggal_penjualan) }}</span></span>
            <hr>
            @foreach ($data->detail as $dt)
            
                <span>{{ isset($dt->produk->nama_produk) ? $dt->produk->nama_produk : '-' }}</span>

                <div class="row mb-4">
                    <div class="d-flex">
                        <div class="col-6">
                            <span class="me-2">{{ $dt->jumlah_produk }}</span>
                            <span class="me-2">x</span>
                            <span class="me-5 ">{{  isset($dt->produk->harga) ? rupiah($dt->produk->harga) : '-' }}</span>
                        </div>
                        <div class="col-6 d-flex justify-content-end ">
                            <span>{{ isset($dt->subtotal) ? rupiah($dt->subtotal) : '-' }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
            
            <hr>
            <div class="row">
                <div class="d-flex">
                    <div class="col-6">
                        <span class="me-2">Total</span>
                    </div>
                    <div class="col-6 d-flex justify-content-end ">
                        <span>{{  isset($data) ? rupiah($data->total_harga) : '-' }}</span>
                    </div>
                </div>

                <div class="d-flex">
                    <div class="col-6">
                        <span class="me-2">Potongan</span>
                    </div>
                    <div class="col-6 d-flex justify-content-end ">
                        <span>{{ isset($data->potongan_harga) ? rupiah($data->potongan_harga) : 0 }}</span>
                    </div>
                </div>

                <div class="d-flex">
                    <div class="col-6">
                        <span class="me-2">Total Pembayaran</span>
                    </div>
                    <div class="col-6 d-flex justify-content-end ">
                        <span>{{ rupiah($data->total_pembayaran) }}</span>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="col-6">
                        <span class="me-2">Bayar</span>
                    </div>
                    <div class="col-6 d-flex justify-content-end ">
                        <span>{{ rupiah($data->bayar) }}</span>
                    </div>
                </div>

                <div class="d-flex mb-3">
                    <div class="col-6">
                        <span class="me-2">Kembali</span>
                    </div>
                    <div class="col-6 d-flex justify-content-end ">
                        <span>{{ rupiah($data->kembalian) }}</span>
                    </div>
                </div>
                <hr>
                <center class="mb-3 row">
                    <span class="">Barang yang sudah di beli tidak dapat ditukar / dikembalikan.</span>
                    <span class="">Terima kasih Telah berbelanja di toko Kami :).</span>
                </center>
            </div>

        </div>

    </div>
    <div class="container-fluid d-flex gap-3">

        <a href="{{ route('laporan.transaksi') }}" class="btn btn-sm btn-info w-50 b-k">Kembali</a>
        <button type="submit" class=" btn btn-sm btn-success w-50" id="print"><i class="fa fa-print"
                aria-hidden="true"></i></button>
    </div>
    <script>
        $('#print').click(function(e) {
            e.preventDefault();

            var html = $('#p').innerHTML;
            window.print(html);
        });
    </script>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
