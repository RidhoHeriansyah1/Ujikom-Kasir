@extends('layouts.main')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-4 mb-3">
            <a href="{{ route('produk.index') }}" class="link-underline link-underline-opacity-0">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <span class="fw-bold">Produk</span>
                            <p class="fs-1 fw-bold ">{{ $produk }}</p>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-end mt-4  ">
                            <i class="fa-solid fa-box text-purple fs-1 " aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>
        <div class="col-lg-4 mb-3">
            <a href="{{ route('pelanggan.index') }}" class="link-underline link-underline-opacity-0">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <span class="fw-bold">Pelanggan</span>
                            <p class="fs-1 fw-bold ">{{ $pelanggan }}</p>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-end mt-4  ">
                            <i class="fa-solid fa-user text-purple fs-1 " aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>
        <div class="col-lg-4 mb-3">
            <a href="{{ route('transaksi.index') }}" class="link-underline link-underline-opacity-0">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <span class="fw-bold">Transaksi Selesai</span>
                            <p class="fs-1 fw-bold ">{{ $transaksi }}</p>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-end mt-4  ">
                            <i class="fa-solid fa-box text-purple fs-1 " aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>
        <div class="col-lg-4 mb-3">
            <a href="{{ route('stok.masuk') }}" class="link-underline link-underline-opacity-0">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <span class="fw-bold">Stok Masuk</span>
                            <p class="fs-1 fw-bold ">{{ $stokMasuk }}</p>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-end mt-4  ">
                            <i class="fa-solid fa-box text-purple fs-1 " aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>
        {{-- <div class="col-lg-4 mb-3">
            <a href="{{ route('stok.keluar') }}" class="link-underline link-underline-opacity-0">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <span class="fw-bold">Stok Keluar</span>
                            <p class="fs-1 fw-bold ">{{ isset($stokKeluar)? $stokKeluar : '-' }}</p>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-end mt-4  ">
                            <i class="fa-solid fa-box text-purple fs-1 " aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div> --}}
    </div>
@endsection