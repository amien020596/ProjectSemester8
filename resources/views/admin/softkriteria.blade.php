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
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Kriteria</th>
                        <th class="text-center">Jenis</th>
                        <th class="text-center">Bobot</th>
                        <th class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($Dkriteria as $key)
                        <tr>
                          <td class="text-center">{{$loop->iteration}}</td>
                          <td class="text-center">{{$key->kriteria}}</td>
                          <td class="text-center">{{$key->jenis}}</td>
                          <td class="text-center">{{$key->bobot}}</td>
                          <td class="text-center">
                            <button class="btn btn-danger" data-toggle="modal" data-target="#ModalHapus{{$key->id}}">Hapus</button>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#ModalReset{{$key->id}}">Restorage</button>
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
        @foreach ($Dkriteria as $key)
        <div class="modal fade" id="ModalReset{{$key->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Re-storage Akun</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Apa Anda Yakin Me-restorage Data Kriteria {{$key->kriteria}}?
              </div>
              <div class="modal-footer">
                <form class="" action="{{route('retrive-kriteria',['id'=>$key->id])}}" method="post">
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
                <h4 class="modal-title" id="myModalLabel">Permanent Hapus Kriteria</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Apa Anda Yakin Menghapus Permanent Data Kriteria {{$key->kriteria}}?
              </div>
              <div class="modal-footer">
                <form class="" action="{{route('delete-kriteria',['id'=>$key->id])}}" method="post">
                  @csrf
                  <button type="submit" name="" class="btn btn-danger">Ya</button>
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      @endsection
