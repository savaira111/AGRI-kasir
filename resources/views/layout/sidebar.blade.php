<div class="sidebar" id="sidebar">
    <img src="{{ asset('image/logo-kasir.png') }}" alt="Logo" class="logo">

    <ul>
        <li>
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route('produk.index') }}" class="{{ request()->routeIs('produk.index') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i> <span>Produk</span>
            </a>
        </li>
        <li>
            <a href="{{ route('transactions.index') }}" class="{{ request()->routeIs('transactions.index') ? 'active' : '' }}">
                <i class="bi bi-cart-check-fill"></i> <span>Transaksi</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="bi bi-bar-chart-line-fill"></i> <span>Laporan</span>
            </a>
        </li>
    </ul>
</div>
