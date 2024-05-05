<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
    <li class="nav-item {{ Request::is('barang') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link ">
        <i class="nav-icon fas fa-copy"></i>
        <p>
            Data Produk
            <i class="fas fa-angle-left right"></i>
        </p>
    </a> 
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('barang') }}" class="nav-link {{ Request::is('barang') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>Produk</p>
            </a>
        </li>
    </ul>
    </li>
    <li class="nav-item {{ (Request::is('pembelian*') || Request::is('penjualan*')) ? 'menu-open' : '' }}">
    <a href="#" class="nav-link ">
        <i class="nav-icon fas fa-columns"></i>
        <p>
            Data Transaksi
            <i class="fas fa-angle-left right"></i>
        </p>
    </a> 
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('pembelian') }}" class="nav-link {{ Request::is('pembelian') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>Pembelian</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('penjualan') }}" class="nav-link {{ Request::is('penjualan') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>penjualan</p>
            </a>
        </li>
    </ul>
    </li>
    <li class="nav-item {{ Request::is('laporan') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link ">
        <i class="nav-icon fas fa-copy"></i>
        <p>
            History
            <i class="fas fa-angle-left right"></i>
        </p>
    </a> 
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('laporan') }}" class="nav-link {{ Request::is('laporan') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>Laporan Laba Rugi</p>
            </a>
        </li>
    </ul>
    </li>
</li>
