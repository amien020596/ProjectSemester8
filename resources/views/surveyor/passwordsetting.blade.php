@extends('layouts.layoutsurveyor')
@section('title')
Ubah Password Surveyor | Bidikmisi
@endsection
@section('body')
  <section>
    <div class="container-fluid">
      <!-- Page Header-->
      <header>
        <h1 class="h3 display">Ubah Password Surveyor</h1>
      </header>
      <div class="row">
          <?php
              $flash = Session::get('success') || Session::get('error');
              $type = Session::get('success') ? 'success' : 'danger';
              $desc = Session::get('success') ? session('success') : session('error');
            ?>
          @if ($flash)
            <div class="col-lg-12">
                <div class="alert alert-{{ $type }}">
                    {{ $desc }}
                    <span class="close-flash float-right" style="cursor: pointer;">&times;</span>
                </div>
            </div>
          @endif
          @if ($errors->has('password'))
            <div class="col-lg-12">
                <div class="alert alert-danger">
                    {{$errors->first('password')}}
                    <span class="close-flash float-right" style="cursor: pointer;">&times;</span>
                </div>
            </div>
          @elseif ($errors->has('password_confirmation'))
            <div class="col-lg-12">
                <div class="alert alert-danger">
                    {{$errors->first('password_confirmation')}}
                    <span class="close-flash float-right" style="cursor: pointer;">&times;</span>
                </div>
            </div>
          @endif
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-header d-flex align-items-center">
                    <h4>Ubah Password</h4>
                  </div>
                  <div class="card-body">
                      <form class="form-horizontal" action="{{route('savepassword-mahasiswa-surveyor',['id'=>Auth::user()->id])}}"  method="post">
                        {{csrf_field()}}
                        <div class="row">
                          <div class="col-lg-5">
                            <div class="form-group">
                              <input type="password" id="myPasswrd" name="password" placeholder="Password" class="mr-3 form-control">

                            </div>
                          </div>
                          <div class="col-lg-5">
                            <div class="form-group">
                              <input type="password" id="retypepassword" name="password_confirmation" placeholder="Re-type Password" class="mr-3 form-control">
                              <img src="{{asset('images/showpassword2.png')}}" id="imgshow" onmouseover="myFunction()" onmouseout="SecondFunction()" alt="" width="30px">
                              <span><h5>Show Password</h5></span>
                            </div>
                          </div>
                          <div class="col-lg-2">
                            <div class="form-group">
                              <button type="submit" class="btn btn-large btn-block btn btn-primary">Update</button>
                            </div>
                          </div>
                        </div>
                    </form>
                  </div>
                </div>
              </div>

      </div>
    </div>
    <script>
      function myFunction() {
          var x = document.getElementById("myPasswrd");
          var y = document.getElementById("retypepassword");
          var img = document.getElementById("imgshow");
          if (x.type === "password" && y.type === "password") {
              x.type = "text";
              y.type = "text";
              img.src = "{{asset('images/showpassword.png')}}";
          }
      }
      function SecondFunction(){
        var x = document.getElementById("myPasswrd");
        var y = document.getElementById("retypepassword");
        var img = document.getElementById("imgshow");
        if (x.type === "text" && y.type === "text") {
            x.type = "password";
            y.type = "password";
            img.src = "{{asset('images/showpassword2.png')}}";
        }
      }
    </script>
  </section>
@endsection
