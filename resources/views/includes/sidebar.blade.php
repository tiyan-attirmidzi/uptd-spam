<nav class="navbar navbar-expand-sm navbar-default">
    <div id="main-menu" class="main-menu collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="{{ Route::currentRouteName() == 'admin.home' ? 'active' : null }}">
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
                    <i class="menu-icon fa fa-usd"></i> Uraian Biaya
                </a>
            </li><li class="{{ Route::currentRouteName() == 'other_costs.index' ? 'active' : null }}">
                <a href="{{ route('other_costs.index') }}">
                    <i class="menu-icon fa fa-eur"></i> Biaya Lainnya
                </a>
            </li>
            <li class="menu-title">Transaksi</li>
            <li class="{{ Route::currentRouteName() == 'transactions.input.usage.show' ? 'active' : null }}">
                <a href="{{ route('transactions.input.usage.show') }}">
                    <i class="menu-icon fa fa-pencil"></i> Input Tagihan
                </a>
            </li>
            <li class="{{ Route::currentRouteName() == 'transactions.index' ? 'active' : null }}">
                <a href="{{ route('transactions.index') }}">
                    <i class="menu-icon fa fa-money"></i> Bayar Tagihan
                </a>
            </li>
            <li class="menu-title">Riwayat Transaksi <span class="badge badge-primary ml-1" id="month-name"></span></li>
            <li class="{{ Route::currentRouteName() == 'transactions.unpaidoff' ? 'active' : null }}">
                <a href="{{ route('transactions.unpaidoff') }}">
                    <i class="menu-icon fa fa-exclamation-circle"></i> Belum Terbayar
                </a>
            </li>
            <li class="{{ Route::currentRouteName() == 'transactions.alreadypaid' ? 'active' : null }}">
                <a href="{{ route('transactions.alreadypaid') }}">
                    <i class="menu-icon fa fa-check-circle"></i> Sudah Terbayar
                </a>
            </li>
            <li class="menu-title">Data Transaksi</li>
            <li class="{{ Route::currentRouteName() == 'transactions.alldata' ? 'active' : null }}">
                <a href="{{ route('transactions.alldata') }}">
                    <i class="menu-icon fa fa-list"></i> Keseluruhan
                </a>
            </li>
        </ul>
    </div>
</nav>
