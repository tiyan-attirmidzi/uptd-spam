<nav class="navbar navbar-expand-sm navbar-default">
    <div id="main-menu" class="main-menu collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="{{ Route::currentRouteName() == 'home' ? 'active' : null }}">
                <a href="{{ Auth::user()->is_admin == true ? route('admin.home') : route('officer.home') }}">
                    <i class="menu-icon fa fa-dashboard"></i> Beranda
                </a>
            </li>
            @if (Auth::user()->is_admin == true)
                <li class="menu-title">Pengguna (User)</li>
                <li class="{{ Route::currentRouteName() == 'users.create' ? 'active' : null }}">
                    <a href="{{ route('users.create') }}">
                        <i class="menu-icon fa fa-plus"></i> Registrasi Pengguna
                    </a>
                </li>
                <li class="{{ Route::currentRouteName() == 'users.index' ? 'active' : null || Route::currentRouteName() == 'users.edit' ? 'active' : null }}">
                    <a href="{{ route('users.index') }}">
                        <i class="menu-icon fa fa-user"></i> Data Pengguna
                    </a>
                </li>
            @endif
            <li class="menu-title">Pelanggan</li>
            <li class="{{ Route::currentRouteName() == 'customers.create' ? 'active' : null }}">
                <a href="{{ route('customers.create') }}">
                    <i class="menu-icon fa fa-plus"></i> Registrasi Pelanggan
                </a>
            </li>
            <li class="{{ Route::currentRouteName() == 'customers.index' ? 'active' : null  || Route::currentRouteName() == 'customers.edit' ? 'active' : null }}">
                <a href="{{ route('customers.index') }}">
                    <i class="menu-icon fa fa-group"></i> Data Pelanggan
                </a>
            </li>
            <li class="menu-title">SOP</li>
            <li class="{{ Route::currentRouteName() == 'description_costs.index' ? 'active' : null }}">
                <a href="{{ route('description_costs.index') }}">
                    <i class="menu-icon fa fa-money"></i> Uraian Biaya
                </a>
            </li>
            <li class="menu-title">Transaksi</li>
            <li class="{{ Route::currentRouteName() == 'transactions.index' ? 'active' : null }}">
                <a href="{{ route('transactions.index') }}">
                    <i class="menu-icon fa fa-money"></i> Bayar Tagihan
                </a>
            </li>
        </ul>
    </div>
</nav>
