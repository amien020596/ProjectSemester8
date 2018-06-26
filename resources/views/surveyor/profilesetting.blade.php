@extends('layouts.layoutsurveyor')
@section('title')
Setting Profile {{Auth::user()->name}} | Bidikmisi
@endsection
@section('body')
  <section>
    <div class="container-fluid">
      <!-- Page Header-->
      <header>
        <h1 class="h3 display">Setting Profile {{Auth::user()->name}}</h1>
      </header>
      <div class="row">

        @if ($errors->has('firstname'))
          <div class="col-lg-12">
              <div class="alert alert-danger">
                  {{$errors->first('firstname')}}
                  <span class="close-flash float-right" style="cursor: pointer;">&times;</span>
              </div>
          </div>
        @elseif ($errors->has('lastname'))
          <div class="col-lg-12">
              <div class="alert alert-danger">
                  {{$errors->first('lastname')}}
                  <span class="close-flash float-right" style="cursor: pointer;">&times;</span>
              </div>
          </div>
        @elseif ($errors->has('address'))
          <div class="col-lg-12">
              <div class="alert alert-danger">
                  {{$errors->first('address')}}
                  <span class="close-flash float-right" style="cursor: pointer;">&times;</span>
              </div>
          </div>
        @elseif ($errors->has('email'))
          <div class="col-lg-12">
              <div class="alert alert-danger">
                  {{$errors->first('email')}}
                  <span class="close-flash float-right" style="cursor: pointer;">&times;</span>
              </div>
          </div>
        @elseif ($errors->has('file'))
          <div class="col-lg-12">
              <div class="alert alert-danger">
                  {{$errors->first('file')}}
                  <span class="close-flash float-right" style="cursor: pointer;">&times;</span>
              </div>
          </div>
        @endif
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
        <div class="col-lg-9">
          <div class="card">
            <div class="card-header">
              <h4>Data Profile Surveyor {{Auth::user()->name}}</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Nama</th>
                      <th>Alamat</th>
                      <th>Email</th>
                      <th>Role</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">{{$user->firstname}} {{$user->lastname}}</th>
                      <td>{{$user->address}}</td>
                      <td>{{$user->user->email}}</td>
                      <td>{{$user->user->role}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card">
            <div class="card-header">
              <h4>Foto Profile</h4>
            </div>
            <div class="card-body">
              <img src="{{asset('storage/'.$user->user->picture)}}" alt="" width="200px">
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-9">
          <div class="card">
            <div class="card-header d-flex align-items-center">
              <h4>Ubah Profile</h4>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{route('saveprofile-mahasiswa-surveyor',['id'=>Auth::user()->id])}}"  method="post" enctype="multipart/form-data" >
                  {{csrf_field()}}
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <input type="text" name="firstname" placeholder="Nama Depan" value="{{$user->firstname}}" class="mr-3 form-control">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <input type="text" name="lastname" placeholder="Nama Belakang" value="{{$user->lastname}}" class="mr-3 form-control">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <input type="text"  name="address" placeholder="Alamat" value="{{$user->address}}" class="mr-3 form-control">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <input type="text"  name="email" placeholder="Email" value="{{$user->user->email}}" class="mr-3 form-control">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <input type="file" name="file" value="">
                      </div>
                    </div>
                  </div>
                <div class="row">
                  <div class="col-lg-3">
                    <div class="form-group">
                      <button type="submit" class="btn btn-large btn-block btn btn-primary">Update</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </form>
      </div>
    </div>
  </section>
@endsection
