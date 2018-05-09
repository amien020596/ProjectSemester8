@extends('layouts.layoutadmin')
@section('title')
  Tembah Mahasiswa
@endsection
@section('body')
  <div class="content mt-3">
      <div class="animated fadeIn">
          <div class="row">
  <!-- kita butuh ini -->
            <div class="col-lg-12">
                      <div class="card">
                        <div class="card-header">
                          <strong>Tambah</strong> Mahasiswa
                        </div>
                        <div class="card-body card-block">
                          <form class="" action="index.html" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                              <label for="">Nama Mahasiswa</label>
                              <input type="text" class="form-control" id="" name="nama" placeholder="Nama Mahasiswa">
                            </div>
                            <div class="form-group">
                              <label for="">NIM</label>
                              <input type="text" class="form-control" id="" name="nim" placeholder="NIM">
                            </div>
                            <div class="form-group">
                              <label for="">Fakultas</label>
                              <select class="form-control" name="fakultas" id="fakultas">
                                <option value="0" disable selected>=== Pilih Fakultas ===</option>
                                @foreach ($Dfakultas as $key => $value)
                                  <option value="{{$value->id}}">{{$value->fakultas}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="">Jurusan</label>
                              <select class="form-control" name="jurusan" id="jurusan">
                                <option value="0" disable="true" selected="true">=== Pilih Jurusan ===</option>
                              </select>
                            </div>
                            <div class="row">
                              @foreach ($Dkritria as $key => $value)
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="">{{$value->kriteria}}</label>
                                  <input type="text" class="form-control" id="" name="{{$value->id}}" placeholder="">
                                  {{-- <p class="help-block">Help text here.</p> --}}
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="">{{$value->kriteria}}</label>
                                  <input type="text" class="form-control" id="" name="{{$value->id}}" placeholder="">
                                </div>
                              </div>
                                @endforeach
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
  <!-- sampe ini -->
          </div>
      </div><!-- .animated -->
    </div><!-- .content -->

@endsection
