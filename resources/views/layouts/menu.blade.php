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
</li>
