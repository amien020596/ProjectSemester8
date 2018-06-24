
@extends('layouts.layoutadmin')
@section('title')
  Daftar Surveyor
@endsection
@section('body')
  {{-- ini yang diambil --}}
          <div class="content mt-3">
              <div class="animated fadeIn">
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

                  <div class="col-lg-12">
                      <div class="card">
                          <div class="card-header">
                              <strong class="card-title">Stripped Table</strong>
                          </div>
                          <div class="card-body">
                            <font size="3">
                              <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th scope="col" class="text-center" >No</th>
                                    <th scope="col" class="text-center" >Nama</th>
                                    <th scope="col" class="text-center" >No Hp</th>
                                    <th scope="col" class="text-center" >Alamat</th>
                                    <th scope="col" class="text-center" >Role</th>
                                    <th scope="col" class="text-center" >Action</th>
                                  </tr>
                                </thead>
                                <tbody>

                                  @foreach ($Dsurveyor as $key)
                                  <tr>
                                      <th scope="row" class="text-center" >{{$loop->iteration}}</th>
                                      <td class="text-center" >{{$key->profile->firstname}} {{$key->profile->lastname}}</td>
                                      <td class="text-center" >{{$key->profile->no_hp}}</td>
                                      <td class="text-center" >{{str_limit($key->profile->address,25)}}</td>
                                      <td class="text-center" >{{$key->role}}</td>
                                      <td class="text-center">
                                        <span data-toggle="tooltip" data-placement="top" title="Detail Surveyor">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$key->id}}">Detail</button>
                                        </span>
                                        <span data-toggle="tooltip" data-placement="top" title="Edit Surveyor">
                                        <a class="btn btn-success" href="{{route('edit',['id'=>$key->profile->user_id])}}">Edit</a>
                                        </span>
                                        <span data-toggle="tooltip" data-placement="top" title="Hapus Surveyor">
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#ModalHapus{{$key->id}}">Hapus</button>
                                        </span>
                                        <span data-toggle="tooltip" data-placement="top" title="Reset Password">
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#ModalReset{{$key->id}}">Reset</button>
                                        </span>
                                      </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>
                            </font>
                          </div>
                      </div>
                  </div>
                  </div>
              </div><!-- .animated -->
          </div><!-- .content -->

          {{-- modal --}}
          @foreach ($Dsurveyor as $key)
          <div class="modal fade" id="ModalReset{{$key->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel">Reset Password</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Apa Anda Yakin Mereset Password Dari Akun Surveyor {{$key->name}}?
                </div>
                <div class="modal-footer">
                  <form class="" action="{{route('reset-password',['id'=>$key->profile->user_id])}}" method="post">
                    @csrf
                    <button type="submit" name="" class="btn btn-danger">Ya</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="ModalHapus{{$key->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Hapus Surveyor {{$key->name}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>

                  </div>
                  <div class="modal-body">
                    Apa Anda Yakin Menghapus Surveyor {{$key->name}}?
                  </div>
                  <div class="modal-footer">
                    <form class="" action="{{route('delete',['id'=>$key->profile->user_id])}}" method="post">
                      @csrf
                      <button type="submit" name="" class="btn btn-danger">Ya</button>
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          <div class="modal fade" id="exampleModalCenter{{$key->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Detail Surveyor {{$key->profile->firstname}}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group container">
                    <div class="row">
                      <label class="col-md-2">Nama</label>
                      <input type="email" disabled class="form-control col-md-10" value="{{$key->profile->firstname}}{{$key->profile->lastname}}">
                    </div>
                  </div>
                  <div class="form-group container">
                    <div class="row">
                      <label class="col-md-2">email</label>
                      <input type="email" disabled class="form-control col-md-10" value="{{$key->email}}">
                    </div>
                  </div>
                  <div class="form-group container">
                    <div class="row">
                      <label class="col-md-2">No Hp</label>
                      <input type="email" disabled class="form-control col-md-10" value="{{$key->profile->no_hp}}">
                    </div>
                  </div>
                  <div class="form-group container">
                    <div class="row">
                      <label class="col-md-2">Alamat</label>
                      <textarea rows="8"  disabled class="form-control col-md-10" cols="80"> {{$key->profile->address}}</textarea>
                    </div>
                  </div>

                  <div class="form-group container">
                    <div class="row">
                      <label class="col-md-2">foto</label>
                      <div class="col-md-10">
                        <img src="{{asset('storage/'.$key->picture)}}" alt="" width="150px">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                </div>
              </div>
            </div>
          </div>
          @endforeach


  {{-- sampe ini --}}
@endsection
