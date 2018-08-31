@extends('layouts.layoutadmin')
@section('title')
  Detail Data Mahasiswa
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
  <!-- kita butuh ini -->
            <div class="col-lg-12">
                      <div class="card">
                        <div class="card-header">
                          <strong>Detail Data</strong> Mahasiswa
                        </div>
                        <div class="card-body card-block">
                            <div class="form-group">
                              <label for="">Nama Mahasiswa</label>
                              <input type="text" disabled class="form-control" id="" value="{{$mahasiswa->nama}}" name="nama" placeholder="Nama Mahasiswa">
                              @if($errors->has('nama'))<p class="help-block text text-danger">*{{$errors->first('nama')}}</p>@endif
                            </div>
                            <div class="form-group">
                              <label for="">NIM Mahasiswa</label>
                              <input type="number" disabled class="form-control" id="" value="{{ $mahasiswa->nim }}" name="nim" placeholder="NIM">
                              @if($errors->has('nim'))<p class="help-block text text-danger">*{{$errors->first('nim')}}</p>@endif
                            </div>
                            <div class="form-group">

                              <div class="row">

                                <div class="col-lg-6 ">
                                  <label for="">Fakultas Mahasiswa</label>
                                </div>
                                <div class="col-lg-6 ">
                                  <label for="">Jurusan Mahasiswa</label>
                                </div>

                              </div>
                              <div class="row">

                                <div class="col-lg-6 ">
                                  <div class="input-group">
                                    <input type="text" class="form-control" placeholder="" disabled value="{{ $Dfakultas->fakultas }}"></input>
                                  </div>
                                </div>
                                <div class="col-lg-6 ">
                                  <div class="input-group">
                                    <input type="text" class="form-control" placeholder="" disabled value="{{ $Djurusan->jurusan }}"></input>
                                  </div>
                                </div>

                              </div>

                            </div>
                          </div>
                      </div>
                      <div class="card">
                        <div class="card-header">
                          <strong>Detail Nilai</strong> Mahasiswa
                        </div>
                        <div class="card-body card-block">
                          <br>
                          <div class="row">
                            <?php use App\Http\Controllers\admin\adminMahasiswasetting; ?>
                            @foreach ($kriteria as $key => $value)
                            <div class="col-lg-6">
                              <div class="form-group">
                                <div class="row">
                                  <div class="col-lg-6">
                                    <label for="">{{$value->kriteria}}</label>
                                    <?php $a = adminMahasiswasetting::ambilnilai($mahasiswa->nim,$value->id); ?>
                                  </div>
                                  <div class="col-lg-6">
                                    : {{ $a['nilai'] }}
                                  </div>
                                </div>
                              </div>
                            </div>
                              @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
  <!-- sampe ini -->
          </div>
      </div><!-- .animated -->
    </div><!-- .content -->

@endsection
