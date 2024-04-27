<nav class="navbar navbar-expand-sm navbar-light bg-purple" id="nav">
    <div class="container-fluid">
        <a class="navbar-brand text-white fw-bold " href="{{ route('dashboard') }}">Kasir Ridho</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarID" aria-controls="navbarID"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarID">
            <div class="navbar-nav d-lg-none">
                <a class="nav-link active text-white " aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
                <a class="nav-link active text-white " aria-current="page" href="{{ route('produk.index') }}">Produk</a>
                <a class="nav-link active text-white " aria-current="page" href="{{ route('pelanggan.index') }}">Pelanggan</a>
                @if(auth()->user()->role_id == 1)
                <a class="nav-link active text-white " aria-current="page" href="{{ route('petugas.index') }}">Petugas</a>
                @endif
                @if(auth()->user()->role_id == 2)
                <a class="nav-link active text-white " aria-current="page" href="{{ route('transaksi.index') }}">Transaksi</a>
                @endif
                <a class="nav-link active text-white " aria-current="page" href="{{ route('logout') }}">Logout</a>

            </div>
        </div>
    </div>
</nav>
