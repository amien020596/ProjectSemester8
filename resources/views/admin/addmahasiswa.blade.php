@extends('layouts.layoutadmin')
@section('title')
  Tambah Data Mahasiswa
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
                          <strong>Tambah</strong> Mahasiswa
                        </div>
                        <div class="card-body card-block">
                          <form class="" action="{{route('store-mahasiswa')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                              <label for="">Nama Mahasiswa</label>
                              <input type="text" class="form-control" id="" value="{{ old('nama') }}" name="nama" placeholder="Nama Mahasiswa">
                              @if($errors->has('nama'))<p class="help-block text text-danger">*{{$errors->first('nama')}}</p>@endif
                            </div>
                            <div class="form-group">
                              <label for="">NIM</label>
                              <input type="number" class="form-control" id="" value="{{ old('nim') }}" name="nim" placeholder="NIM">
                              @if($errors->has('nim'))<p class="help-block text text-danger">*{{$errors->first('nim')}}</p>@endif
                            </div>
                            <div class="form-group">
                              <label for="">Fakultas</label>
                              <select class="form-control" name="fakultas" id="fakultas" required>
                                <option value="0" disable selected>=== Pilih Fakultas ===</option>
                                @if($errors->has('fakultas'))<p class="help-block text text-danger">*{{$errors->first('fakultas')}}</p>@endif
                                @foreach ($Dfakultas as $key => $value)
                                  <option value="{{$value->id}}">{{$value->fakultas}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="">Jurusan</label>
                              <select class="form-control" name="jurusan" id="jurusan" required>
                                <option value="0" disable="true" selected="true">=== Pilih Jurusan ===</option>
                                @if($errors->has('jurusan'))<p class="help-block text text-danger">*{{$errors->first('jurusan')}}</p>@endif
                              </select>
                            </div>
                            <div class="row">
                              @foreach ($Dkritria as $key => $value)
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="">{{$value->kriteria}}</label>
                                  <input type="text" onkeypress="javascript:return isNumber(event)" required class="form-control" id="tbNumbers" value="{{ old($value->id) }}" name="{{$value->id}}" placeholder="{{$value->kriteria}}">
                                </div>
                              </div>
                                @endforeach
                            </div>
                          </div>
                          <div class="card-footer">
                            <button type="submit" value="Submit" class="btn btn-primary btn-sm">
                              <i class="fa fa-dot-circle-o"></i> Tambah
                            </button>
                            <button type="reset" value="Reset" class="btn btn-danger btn-sm">
                              <i class="fa fa-ban"></i> Reset
                            </button>
                          </div>
                        </form>
                      <div class="card-body card-block">
                        <div class="form-group">
                          <p class="help-block">Keterangan: </p>
                            <ul class="col-lg-12"><label for="">HM Rumah</label>
                              <li>Nilai 1 Untuk Menumpang</li>
                              <li>Nilai 2 Untuk Menyewa</li>
                              <li>Nilai 3 Untuk Membeli Sendiri</li>
                              <li>Nilai 4 Untuk Warisan Keluarga</li>
                            </ul>
                            <ul class="col-lg-12"><label for="">Dinding Rumah</label>
                              <li>Nilai 1 Untuk Darurat</li>
                              <li>Nilai 2 Untuk Semipermanen</li>
                              <li>Nilai 3 Untuk Permanen</li>
                            </ul>
                        </div>
                      </div>
                      </div>
                    </div>
  <!-- sampe ini -->
          </div>
      </div><!-- .animated -->
    </div><!-- .content -->

@endsection
