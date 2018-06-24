<nav class="side-navbar">
  <div class="side-navbar-wrapper">
    <!-- Sidebar Header    -->
    <div class="sidenav-header d-flex align-items-center justify-content-center">
      <!-- User Info-->
      <div class="sidenav-header-inner text-center"><img src="{{asset('storage/'.Auth::user()->picture)}}" alt="person" class="img-fluid img-thumbnail">
        <h2 class="h5">{{Auth::user()->name}}</h2><span>{{Auth::user()->role}}</span>
      </div>
      <!-- Small Brand information, appears on minimized sidebar-->
      <div class="sidenav-header-logo"><a href="index.html" class="brand-small text-center"> <strong>B</strong><strong class="text-primary">D</strong></a></div>
    </div>
    <!-- Sidebar Navigation Menus-->
    <div class="main-menu">
      <h5 class="sidenav-heading">Main</h5>
      <ul id="side-main-menu" class="side-menu list-unstyled">
        <li><a href="{{route('insert-mahasiswa-surveyor')}}"> <i class="icon-home"></i>Add Data Mahasiswa</a></li>
        <li><a href="{{route('view-mahasiswa-surveyor')}}"> <i class="icon-form"></i>Liat Data Mahasiswa</a></li>
      </ul>
    </div>
    <div class="admin-menu">
      <h5 class="sidenav-heading">Soft Delete</h5>
      <ul id="side-admin-menu" class="side-menu list-unstyled">
        <li> <a href="#"> <i class="fa fa-bar-chart"></i>Data Mahasiswa</a></li>
      </ul>
    </div>
    <div class="admin-menu">
      <h5 class="sidenav-heading">Setting Profile</h5>
      <ul id="side-admin-menu" class="side-menu list-unstyled">
        <li> <a href="#"> <i class="fa fa-bar-chart"></i>Password</a></li>
      </ul>
    </div>
  </div>
</nav>
