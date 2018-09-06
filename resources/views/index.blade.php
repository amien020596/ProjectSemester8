<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistem Pendukung Keputusan</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="{{asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('assets/css/grayscale.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/custome.css')}}" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">SPK Bidikmisi</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#about">Tentang Bidikmisi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#playground">Info Applikasi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#signup">Info Pembuat</a>
            </li>
            <li class="nav-item">
              @if (Auth::guard('admin')->check())
                    <a class="nav-link js-scroll-trigger" href="{{ route('admin-home') }}">Home</a>
              @elseif(Auth::guard('web')->check())
                    <a class="nav-link js-scroll-trigger" href="{{ route('home') }}">Home</a>
              @else
                  <a class="nav-link js-scroll-trigger" href="{{ route('login') }}">Login</a>
              @endif
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead image responsive">
      <div class="container d-flex h-100 align-items-center">
        <div class="mx-auto text-center">
          <h1 class="mx-auto my-0 text-uppercase">Bidikmisi</h1>
          <h2 class="text-white-50 mx-auto mt-2 mb-5">Universitas Diponegoro</h2>
          <a href="#about" class="btn btn-primary js-scroll-trigger">Get Started</a>
        </div>
      </div>
    </header>

    <!-- About Section -->
    <section id="about" class="about-section text-center">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <h2 class="text-white mb-4">Tentang Bidikmisi</h2>
            <p class="text-white-50">Bidikmisi adalah bantuan biaya pendidikan dari Kementerian Riset Teknologi dan Pendidikan Tinggi Republik Indonesia yang memberikan fasilitas pembebasan biaya pendidikan dan subsidi biaya hidup.
          </div>
        </div>
        <img src="{{asset("assets/img/bidikmisi.png")}}" id="imgbidikmisi"class="img-fluid" alt="">
      </div>
    </section>

    <!-- Projects Section -->
    <section id="playground" class="projects-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <h2 class="text-black mb-4"><strong>Tentang Aplikasi</strong></h2>
            <p class="text-black-50"><strong>Sistem Pendukung Keputusan Seleksi Beasiswa Bidikmisi adalah Applikasi Berbasis Web yang digunakan untuk membantu proses Seleksi dengan Memberikan Alternatif dari Hasil Seleksi Penerima Beasiswa</strong></p>
          </div>
        </div>
      </div>
    </section>

    <!-- Signup Section -->
    <section id="signup" class="signup-section">
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-lg-8 mx-auto text-center">



          </div>
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section bg-black">
      <div class="container">

        <div class="row">

          <div class="col-md-2 mb-3 mb-md-0">
            <img src="{{asset('assets/img/21120114140074.jpg')}}" class="img-thumbnail imgcreator" alt="creator" id="">
          </div>

          <div class="col-md-7 mb-3 mb-md-0">
            <div class="card py-4 h-100">
              <div class="card-body text-center">
                <div class="row">
                  <div class="col-md-3"></div>
                  {{-- <div class="col-md-3">
                    <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                    <h4 class="text-uppercase m-0">Nama</h4>
                  </div>
                  <div class="col-md-2">
                    <div class="classv1"></div>
                  </div>--}}
                  <div class="col-md-6">
                    <div class="small text-black-50">Amien Kurniawan</div>
                  </div>
                  <div class="col-md-3"></div>
                </div>
                <div class="row">
                  <div class="col-md-3"></div>
                  {{-- <div class="col-md-3">
                    <i class="fas fa-envelope text-primary mb-2"></i>
                    <h4 class="text-uppercase m-0">Jurusan</h4>
                  </div>
                  <div class="col-md-2">
                    <div class="classv1"></div>
                  </div>--}}
                  <div class="col-md-6">
                    <div class="small text-black-50">
                      <a href="#">Teknik Sistem Komputer</a>
                    </div>
                  </div>
                  <div class="col-md-3"></div>
                </div>
                <div class="row">
                  <div class="col-md-3"></div>
                  {{-- <div class="col-md-3">
                    <i class="fas fa-mobile-alt text-primary mb-2"></i>
                    <h4 class="text-uppercase m-0">Fakultas</h4>
                  </div>
                  <div class="col-md-2">
                    <div class="classv1"></div>
                  </div> --}}
                  <div class="col-md-6">
                    <div class="small text-black-50">Teknik</div>
                  </div>
                  <div class="col-md-3"></div>
                </div>
                <div class="row">
                  {{-- <div class="col-md-3">
                    <i class="fas fa-envelope text-primary mb-2"></i>
                    <h4 class="text-uppercase m-0">Universitas</h4>
                  </div>
                  <div class="col-md-2">
                    <div class="classv1"></div>
                  </div> --}}
                  <div class="col-md-3"></div>
                  <div class="col-md-6">
                    <div class="small text-black-50">
                      <a href="#">Universitas Diponegoro</a>
                    </div>
                  </div>
                  <div class="col-md-3"></div>
                </div>
                <div class="row">
                  {{-- <div class="col-md-3">
                    <i class="fas fa-envelope text-primary mb-2"></i>
                    <h4 class="text-uppercase m-0">Email</h4>
                  </div>
                  <div class="col-md-2">
                    <div class="classv1"></div>
                  </div> --}}
                  <div class="col-md-3"></div>
                  <div class="col-md-6">
                    <div class="small text-black-50">
                      <a href="#">akurniawan@student.ce.undip.ac.id</a>
                    </div>
                  </div>
                  <div class="col-md-3"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-3 mb-3 mb-md-0">
            <img src="{{asset('assets/img/logo-undip.png')}}" class="img-thumbnail imgcreator" alt="creator" id="logo">
          </div>
        </div>

        <div class="social d-flex justify-content-center">
          <a href="#" class="mx-2">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#" class="mx-2">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="#" class="mx-2">
            <i class="fab fa-github"></i>
          </a>
        </div>

      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black small text-center text-white-50">
      <div class="container">
        Copyright &copy; Your Website 2018
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Plugin JavaScript -->
    <script src="{{asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for this template -->
    <script src="{{asset('assets/js/grayscale.min.js')}}"></script>

  </body>

</html>
