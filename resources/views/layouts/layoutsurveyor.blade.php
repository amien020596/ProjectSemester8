<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    @include('stylesurveyor.style')
  </head>
  <body>
    <!-- Side Navbar -->
    @include('sidebar.sidebarsurveyor')
    <div class="page">
      <!-- navbar-->
      <header class="header">
        <nav class="navbar">
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a><a href="index.html" class="navbar-brand">
                  <div class="brand-text d-none d-md-inline-block"><span>Surveyor</span><strong class="text-primary">Dashboard</strong></div></a></div>
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Log out-->
                <li class="nav-item">
                  <button type="button" class="btn btn-link" data-target="#modallogout" id="buttonlink" data-toggle="modal">
                    logout
                    <i class="fa fa-sign-out"></i>
                  </button>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    
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
      <!-- Breadcrumb-->
      <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item active">Dashboard       </li>
          </ul>
        </div>
      </div>
      @yield('body')
      @include('footer.footersurveyor')
    </div>
    @include('stylesurveyor.js')
  </body>
</html>
