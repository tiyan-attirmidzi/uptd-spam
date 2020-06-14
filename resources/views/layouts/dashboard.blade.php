<!doctype html>
<!--[if lt IE 7]>
    <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="">
<![endif]-->
<!--[if IE 7]>
    <html class="no-js lt-ie9 lt-ie8" lang="">
<![endif]-->
<!--[if IE 8]>
    <html class="no-js lt-ie9" lang="">
<![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>UPTD SPAM KAB. MUNA BARAT DASHBOARD</title>
    <meta name="description" content="ShaynaAdmin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Include Style --}}
    @include('includes.style')
</head>

<body>

    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        {{-- Include SideBar --}}
        @include('includes.sidebar')
    </aside>
    <!-- /#left-panel -->

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">

        <!-- Header-->
        {{-- Include NavBar --}}
        @include('includes.navbar')
        <!-- /#header -->

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Beranda</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Beranda</a></li>
                                    <li><a href="#">Icons</a></li>
                                    <li class="active">FontAwesome</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        {{-- Include Content --}}
        @yield('content')
        <!-- /.content -->

        <div class="clearfix"></div>

        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        Copyright &copy; 2020 UPTD SPAM KAB. MUNA BARAT
                    </div>
                    <div class="col-sm-6 text-right">
                        Designed by <a href="https://colorlib.com">Colorlib</a>
                    </div>
                </div>
            </div>
        </footer>

    </div>
    <!-- /#right-panel -->


    {{-- Include Script --}}
    @include('sweetalert::alert')
    @include('includes.script')

</body>
</html>
