@extends('layouts.layoutadmin')
@section('title')
  Daftar Kriteria
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
                            <strong class="card-title">Data Kriteria</strong>
                        </div>
                        <div class="card-body">
                          <font size="2">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered table-responsive">
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
                                    <td class="text-center" >{{$key->jurusan}}</td>
                                    <td class="text-center" >{{$key->fakultas}}</td>
                                    <td style="width:20%;" class="text-center">
                                      <span data-toggle="tooltip" data-placement="top" title="Detail Surveyor">
                                      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter{{$key->nim}}">Detail</button>
                                      </span>
                                      <span data-toggle="tooltip" data-placement="top" title="Edit Surveyor">
                                      <a class="btn btn-success btn-sm" href="#">Edit</a>
                                      </span>
                                      <span data-toggle="tooltip" data-placement="top" title="Hapus Surveyor">
                                      <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#ModalHapus{{$key->nim}}">Hapus</button>
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
      @endsection
