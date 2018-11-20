@extends('layouts.layoutadmin')
@section('title')
  Data Sampah Mahasiswa
@endsection
      @section('body')
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
                  @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Data Sampah Mahasiswa</strong>
                        </div>
                        <div class="card-body">
                          <font size="2">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                              <thead>
                                <tr>
                                  <th class="text-center" >No</th>
                                  <th class="text-center" >NIM</th>
                                  <th class="text-center" >Nama</th>
                                  <th class="text-center" >Jurusan</th>
                                  <th class="text-center" >Fakultas</th>
                                  <th style="width:20%;" class="text-center" >Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($Dmahasiswa as $key)
                                <tr>
                                    <th class="text-center" >{{$loop->iteration}}</th>
                                    <td class="text-center" >{{$key->nim}} </td>
                                    <td class="text-center" >{{$key->nama}} </td>
                                    <td class="text-center" >{{$key->jurusan->jurusan}}</td>
                                    <td class="text-center" >{{$key->fakultas->fakultas}}</td>
                                    <td style="width:20%;" class="text-center">
                                      <button class="btn btn-danger" data-toggle="modal" data-target="#ModalHapus{{$key->id}}">Hapus</button>
                                      <button class="btn btn-warning" data-toggle="modal" data-target="#ModalRestorage{{$key->id}}">Restorage</button>
                                    </td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                            @foreach ($Dmahasiswa as $key)
                              <div class="modal fade" id="ModalRestorage{{$key->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title" id="myModalLabel">Re-storage Data Mahasiswa</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      Apa Anda Yakin Me-restorage Data Mahasiswa {{$key->nama}}?
                                    </div>
                                    <div class="modal-footer">
                                      <form class="" action="{{route('retrive-mahasiswa',['id'=>$key->nim])}}" method="post">
                                        @csrf
                                        <button type="submit" name="" class="btn btn-danger">Ya</button>
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="modal fade" id="ModalHapus{{$key->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title" id="myModalLabel">Permanent Hapus Data Mahasiswa</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      Apa Anda Yakin Menghapus Permanent Data Mahasiswa {{$key->nama}}?
                                    </div>
                                    <div class="modal-footer">
                                      <form class="" action="{{route('delete-mahasiswa',['id'=>$key->nim])}}" method="post">
                                        @csrf
                                        <button type="submit" name="" class="btn btn-danger">Ya</button>
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            @endforeach
                          </font>
                        </div>
                    </div>
                </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
      @endsection
