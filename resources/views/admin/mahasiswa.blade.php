@extends('layouts.layoutadmin')
@section('title')
  Daftar Mahasiswa
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
                            <strong class="card-title">Data Mahasiswa</strong>
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
                                      <span data-toggle="tooltip" data-placement="top" title="Detail Data Mahasiswa">
                                      <a class="btn btn-info btn-sm" href="{{route('detail-mahasiswa',['id'=>$key->nim])}}">Detail</a>
                                      </span>
                                      <span data-toggle="tooltip" data-placement="top" title="Edit Data Mahasiswa">
                                      <a class="btn btn-success btn-sm" href="{{route('edit-mahasiswa',['id'=>$key->nim])}}">Ubah</a>
                                      </span>
                                      <span data-toggle="tooltip" data-placement="top" title="Hapus Data Mahasiswa">
                                      <button  class="btn btn-danger btn-sm" data-toggle="modal" data-target="#ModalHapus{{$key->nim}}" data-target-id="{{$key->nim}}" >Hapus</button>
                                      </span>
                                    </td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                            @foreach ($Dmahasiswa as $key)
                              <div class="modal fade" id="ModalHapus{{$key->nim}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h4 class="modal-title" id="myModalLabel">Hapus Data Mahasiswa</h4>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                          </div>
                                          <div class="modal-body">
                                            Apa Anda Yakin Menghapus Data Mahasiswa {{$key->nama}}?
                                          </div>
                                          <div class="modal-footer">
                                            <form class="" action="{{route('destroy-mahasiswa',['id'=>$key->nim])}}" method="post">
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
