<div class="col-lg-3" id="card-navbar">
    <div class="card d-none d-lg-block ">
        <div class="card-header bg-purple text-white">
            <div class="d-flex justify-content-between">
                <span class="fw-bold">Hallo, {{ auth()->user()->name }}</span>
                <span style="font-size: 13px">
                    @if (auth()->user()->role_id == 1)
                    - Admin
                    @elseif (auth()->user()->role_id == 2)
                    - Petugas
                    @endif
                </span>
            </div>
        </div>
        <div class="card-body">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="fa fa-dashboard text-purple" aria-hidden="true"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('produk.index') }}" class="nav-link">
                        <i class="fa-solid fa-box text-purple" aria-hidden="true"></i> Produk
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pelanggan.index') }}" class="nav-link">
                        <i class="fa-solid fa-user text-purple" aria-hidden="true"></i> Pelanggan
                    </a>
                </li>
                @if (auth()->user()->role_id == 1)
                    <li class="nav-item">
                        <a href="{{ route('petugas.index') }}" class="nav-link">
                            <i class="fa-solid fa-id-card text-purple" aria-hidden="true"></i> Petugas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('diskon.index') }}" class="nav-link">
                            <i class="fa fa-percent text-purple" aria-hidden="true"></i> Diskon
                        </a>
                    </li>
                @endif
                @if (auth()->user()->role_id == 2)
                    <li class="nav-item">
                        <a href="{{ route('transaksi.index') }}" class="nav-link">
                            <i class="fa-solid fa-cart-shopping text-purple" aria-hidden="true"></i> Transaksi
                        </a>
                    </li>
                @endif
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="laporan" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false"><i class="fa-solid fa-file-lines text-purple"></i>
                        Laporan</a>
                    <div class="dropdown-menu" aria-labelledby="laporan">
                        <a class="dropdown-item" href="{{ route('laporan.transaksi') }}">Transaksi</a>
                        <a class="dropdown-item" href="{{ route('stok.masuk') }}">Stok Masuk</a>
                        <a class="dropdown-item" href="{{ route('stok.keluar') }}">Stok Keluar</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="fa-solid fa-arrow-right-from-bracket text-purple"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
