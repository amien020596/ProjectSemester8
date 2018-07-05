@extends('layouts.layoutadmin')
@section('title')
  Admin Profile
@endsection
@section('body')

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
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Data Profile {{$admin->firstname}}</strong>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">Nama</th>
                      <th scope="col">Alamat</th>
                      <th scope="col">Email</th>
                      <th scope="col">Role</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{$admin->firstname}}{{$admin->lastname}}</td>
                      <td>{{$admin->address}}</td>
                      <td>{{$admin->user->email}}</td>
                      <td>{{$admin->user->role}}</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
       <div class="card">
           <div class="card-header">
               <strong class="card-title mb-3">Foto Profile</strong>
           </div>
           <div class="card-body">
               <div class="mx-auto d-block">
                   <img class=" mx-auto d-block" width="100px" src="{{asset('storage/'.$admin->user->picture)}}" alt="Card image cap">
                   <h5 class="text-sm-center mt-2 mb-1">{{$admin->firstname}}</h5>
               </div>
               <hr>
           </div>
       </div>
     </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Setting Profile</strong>
            </div>
            <div class="card-body">
              <form class="form-horizontal" action="{{route('save-profile',['id'=>Auth::user()->id])}}"  method="post" enctype="multipart/form-data" >
                {{csrf_field()}}
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <input type="text" name="firstname" required  placeholder="Nama Depan" value="{{$admin->firstname}}" class="mr-3 form-control">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <input type="text" name="lastname" required  placeholder="Nama Belakang" value="{{$admin->lastname}}" class="mr-3 form-control">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <input type="text"  name="address" required  placeholder="Alamat" value="{{$admin->address}}" class="mr-3 form-control">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <input type="text"  name="email" required  placeholder="Email" value="{{$admin->user->email}}" class="mr-3 form-control">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <input type="file" name="file" required  value="">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2">
                    <button type="submit" class="btn btn-large btn-block btn btn-info">Update</button>
                  </div>
                </div>
              </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Setting Password</strong>
            </div>
            <div class="card-body">
              <form class="form-horizontal" action="{{route('save-password',['id'=>Auth::user()->id])}}"  method="post" enctype="multipart/form-data" >
                {{csrf_field()}}
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <input type="password" name="password" required placeholder="Password" value="" class="mr-3 form-control">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <input type="password" name="password_confirmation" required placeholder="Retype-Password" value="" class="mr-3 form-control">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2">
                    <button type="submit" class="btn btn-large btn-block btn btn-info">Update</button>
                  </div>
                </div>
              </form>
            </div>
        </div>
    </div>
@endsection
