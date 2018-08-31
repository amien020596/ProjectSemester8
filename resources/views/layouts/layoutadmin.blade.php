<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Seleksi Bidikmisi | @yield('title')</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="{{asset('admin/favicon.ico')}}">
    @include('styleadmin.style')


</head>
<body>
    @include('sidebar.sidebaradmin')
    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded" height="auto" width="auto" src="{{asset('storage/'.$admin->picture)}}" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu bg-dark">
                                <a class="nav-link text-white" href="{{route('admin-setting')}}"><i class="fa fa-cog"></i> Setting Profile</a>
                                {{-- <a class="nav-link text-white" data-target="#modallogout" href="" data-togle="modal" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('Logout') }}
                                              <i class="fa fa-power -off"></i></a> --}}
                                <button type="button" class="btn btn-link" data-target="#modallogout" id="buttonlink" data-toggle="modal"><i class="fa fa-sign-out"></i> Keluar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modallogout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Keluar Sistem</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    apa anda yakin ingin keluar?
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf

                  </div>
                  <div class="modal-footer">
                    <button type="submit"  class="btn btn-danger" >Ya</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">

                            <li class="active">Dashboard Admin</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        @yield('body')


    </div><!-- /#right-panel -->

    <!-- Right Panel -->

@include('styleadmin.js')


</body>
</html>
