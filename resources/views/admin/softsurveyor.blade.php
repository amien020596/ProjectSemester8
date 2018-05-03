
@extends('layouts.layoutadmin')
@section('title')
  SoftDelete Data Surveyor
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
                              <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th scope="col" class="text-center" >No</th>
                                    <th scope="col" class="text-center" >Nama</th>
                                    <th scope="col" class="text-center" >No Hp</th>
                                    <th scope="col" class="text-center" >Alamat</th>

                                    <th scope="col" class="text-center" >Action</th>
                                  </tr>
                                </thead>
                                <tbody>

                                  @foreach ($Dsurveyor as $key)
                                  <tr>
                                      <th scope="row" class="text-center" >{{$loop->iteration}}</th>
                                      <td class="text-center" >{{$key->firstname}} {{$key->lastname}}</td>
                                      <td class="text-center" >{{$key->no_hp}}</td>
                                      <td class="text-center" >{{str_limit($key->address,25)}}</td>

                                      <td class="text-center">
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#ModalHapus{{$key->user_id}}">Hapus</button>
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#ModalReset{{$key->user_id}}">Restorage</button>
                                      </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
                  </div>
              </div><!-- .animated -->
          </div><!-- .content -->

          {{-- modal --}}
          @foreach ($Dsurveyor as $key)
          <div class="modal fade" id="ModalReset{{$key->user_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel">Re-storage Akun</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Apa Anda Yakin Me-restorage Akun Surveyor {{$key->firstname}}?
                </div>
                <div class="modal-footer">
                  <form class="" action="{{route('retrive-surveyor',['id'=>$key->user_id])}}" method="post">
                    @csrf
                    <button type="submit" name="" class="btn btn-danger">Ya</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="ModalHapus{{$key->user_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel">Permanent Hapus Akun</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Apa Anda Yakin Menghapus Permanent Akun Surveyor {{$key->firstname}}?
                </div>
                <div class="modal-footer">
                  <form class="" action="{{route('delete-surveyor',['id'=>$key->user_id])}}" method="post">
                    @csrf
                    <button type="submit" name="" class="btn btn-danger">Ya</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          @endforeach


  {{-- sampe ini --}}
@endsection
