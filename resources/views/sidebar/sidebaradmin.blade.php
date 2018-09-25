<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-file"></i>
            </button>
            <a class="navbar-brand" href="" id="logoSidebar"><img src="{{asset('images/logo.png')}}" alt="Logo"></a>
            <a class="navbar-brand hidden" href=""><img src="{{asset('images/logo2.png')}}" alt="Logo"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
              <h3 class="menu-title">Dashboard {{Auth::user()->name}}</h3><!-- /.menu-title -->
              <li class="menu-item-has-children dropdown">
              </li>
                <h3 class="menu-title">Mahasiswa</h3><!-- /.menu-title -->
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-address-book"></i>Data Mahasiswa</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-address-book"></i><a href="{{route('view-mahasiswa')}}">Lihat Data</a></li>
                        <li><i class="fa fa-file"></i><a href="{{route('insert-mahasiswa')}}">Tambah Data</a></li>
                        <li><i class="menu-icon fa fa-file"></i><a href="{{route('finalresult')}}">Ranking Mahasiswa</a></li>
                        <li><i class="menu-icon fa fa-file"></i><a href="{{route('print')}}">Cetak Hasil</a></li>
                    </ul>
                </li>
                <h3 class="menu-title">Semua Data</h3><!-- /.menu-title -->

                  <li class="menu-item-has-children dropdown" >
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-address-book"></i>Data Kriteria</a>
                      <ul class="sub-menu children dropdown-menu">
                          <li><i class="menu-icon fa fa-address-book"></i><a href="{{route('view-kriteria')}}">Daftar Kriteria</a></li>
                          <li><i class="menu-icon fa fa-file"></i><a href="#" data-toggle="modal" data-target="#modaltambah">Tambah Kriteria</a></li>
                      </ul>
                  </li>
                  <li class="menu-item-has-children dropdown" >
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-address-book"></i>Data Surveyor</a>
                      <ul class="sub-menu children dropdown-menu">
                          <li><i class="menu-icon fa fa-address-book"></i><a href="{{route('view-surveyor')}}">Daftar Surveyor</a></li>
                          <li><i class="menu-icon fa fa-file"></i><a href="{{route('add-surveyor')}}">Tambah Surveyor</a></li>
                      </ul>
                  </li>
                  <li class="menu-item-has-children dropdown" >
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-address-book"></i>Perhitungan Moora</a>
                      <ul class="sub-menu children dropdown-menu">
                          <li><i class="menu-icon fa fa-file"></i><a href="{{route('perhitungan1')}}">Matriks Data Nilai</a></li>
                          <li><i class="menu-icon fa fa-file"></i><a href="{{route('perhitungan2')}}">Matriks Normalisasi</a></li>
                          <li><i class="menu-icon fa fa-file"></i><a href="{{route('perhitungan3')}}">Nilai Terbobot</a></li>
                          <li><i class="menu-icon fa fa-file"></i><a href="{{route('perhitungan4')}}">Nilai Yi</a></li>
                          <li><i class="menu-icon fa fa-file"></i><a href="{{route('perhitungan5')}}">Nilai Rating</a></li>
                          {{-- <li><i class="menu-icon fa fa-file"></i><a href="{{route('print')}}">Print</a></li> --}}
                      </ul>
                  </li>
                  <li class="menu-item-has-children dropdown" >
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-address-book"></i>Data Sampah</a>
                      <ul class="sub-menu children dropdown-menu">
                          <li><i class="menu-icon fa fa-file"></i><a href="{{route('mahasiswa')}}">Data Mahasiswa</a></li>
                          <li><i class="menu-icon fa fa-file"></i><a href="{{route('kriteria')}}">Data Kriteria</a></li>
                          <li><i class="menu-icon fa fa-file"></i><a href="{{route('surveyor')}}">Data Surveyor</a></li>
                      </ul>
                  </li>

            </ul>

        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->
