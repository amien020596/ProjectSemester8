<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="./"><img src="{{asset('images/logo.png')}}" alt="Logo"></a>
            <a class="navbar-brand hidden" href="./"><img src="{{asset('images/logo2.png')}}" alt="Logo"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
              <h3 class="menu-title">Dashboard {{Auth::user()->name}}</h3><!-- /.menu-title -->
              <li class="menu-item-has-children dropdown">
              </li>
                <h3 class="menu-title">Mahasiswa</h3><!-- /.menu-title -->
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Data Mahasiswa</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-puzzle-piece"></i><a href="{{route('view-mahasiswa')}}">Lihat Data</a></li>
                        <li><i class="fa fa-puzzle-piece"></i><a href="{{route('insert-mahasiswa')}}">Tambah Data</a></li>
                    </ul>
                </li>
                <h3 class="menu-title">Kriteria</h3><!-- /.menu-title -->

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Data Kriteria</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-puzzle-piece"></i><a href="{{route('view-kriteria')}}">Daftar Kriteria</a></li>
                        <li><i class="menu-icon ti-themify-logo"></i><a href="#" data-toggle="modal" data-target="#modaltambah">Tambah Kriteria</a></li>
                    </ul>
                </li>

                <h3 class="menu-title">Surveyor</h3><!-- /.menu-title -->
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Data Surveyor</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{route('view-surveyor')}}">Daftar Surveyor</a></li>
                        <li><i class="menu-icon ti-themify-logo"></i><a href="{{route('add-surveyor')}}">Tambah Surveyor</a></li>
                    </ul>
                </li>
                <h3 class="menu-title">Proses Perhitungan</h3><!-- /.menu-title -->
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Perhitungan Moora</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{route('perhitungan1')}}">Perhitungan 1</a></li>
                        <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{route('perhitungan2')}}">Perhitungan 2</a></li>
                        <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{route('perhitungan3')}}">Perhitungan 3</a></li>
                        <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{route('perhitungan4')}}">Perhitungan 4</a></li>
                        <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{route('perhitungan5')}}">Perhitungan 5</a></li>
                    </ul>
                </li>
                <h3 class="menu-title">Soft Delete</h3><!-- /.menu-title -->
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Data Softdelete</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-fort-awesome"></i><a href="font-fontawesome.html">Data Mahasiswa</a></li>
                        <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{route('kriteria')}}">Data Kriteria</a></li>
                        <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{route('surveyor')}}">Data Surveyor</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->
