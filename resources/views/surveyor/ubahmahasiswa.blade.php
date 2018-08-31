@extends('layouts.layoutsurveyor')
@section('title')
Input Mahasiswa | Bidikmisi
@endsection
@section('body')
  <section>
    <div class="container-fluid">
      <!-- Page Header-->
      <header>
        <h1 class="h3 display">Ubah Data Mahasiswa</h1>
      </header>
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
            <div class="card-header d-flex align-items-center">
              <h4>Form Ubah Data Mahasiswa</h4>
            </div>
            <div class="card-body">
              <form class="form-horizontal" action="{{route('update-mahasiswa-surveyor',['nim'=>$mahasiswa->nim])}}"  method="post">
                {{csrf_field()}}
                <div class="form-group">
                  <label class="form-control-label">Nama Mahasiswa</label>
                    <input type="text" class="form-control" name="nama" value="{{$mahasiswa->nama}}" placeholder="Nama Mahasiswa" required>
                    @if($errors->has('nama'))<p class="help-block text text-danger">*{{$errors->first('nama')}}</p>@endif
                </div>
                <div class="line"></div>
                <div class="form-group">
                  <label class=" form-control-label">NIM Mahasiswa</label>
                    <input type="number" class="form-control" name="nim" value="{{$mahasiswa->nim}}" placeholder="NIM Mahasiswa" >
                    @if($errors->has('nim'))<p class="help-block text text-danger">*{{$errors->first('nim')}}</p>@endif
                </div>
                <div class="line"></div>
                <div class="form-group">
                  <label class=" form-control-label">Fakultas</label>
                    <select name="fakultas" class="form-control" id="fakultas"  required>
                      <option value="0" disable selected>=== Pilih Fakultas ===</option>
                      @if($errors->has('fakultas'))<p class="help-block text text-danger">*{{$errors->first('fakultas')}}</p>@endif
                      @foreach ($Dfakultas as $key => $value)
                        <option value="{{$value->id}}">{{$value->fakultas}}</option>
                      @endforeach
                    </select>
                </div>
                <div class="line"></div>
                <div class="form-group">
                  <label class=" form-control-label">Jurusan</label>
                    <select name="jurusan" class="form-control"  id="jurusan" required>
                      <option value="0" disable="true" selected="true">=== Pilih Jurusan ===</option>
                      @if($errors->has('jurusan'))<p class="help-block text text-danger">*{{$errors->first('jurusan')}}</p>@endif
                    </select>
                </div>
                <div class="row">
                  <?php use App\Http\Controllers\surveyor\surveyormahasiswasetting; ?>
                  @foreach ($Dkritria as $key => $value)
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="">{{$value->kriteria}}</label>
                      <?php $a = surveyormahasiswasetting::ambilnilai($mahasiswa->nim,$value->id); ?>
                      <input type="text" onkeypress="javascript:return isNumber(event)" required class="form-control" id="tbNumbers" value="{{ $a['nilai'] }}" name="{{$value->id}}" placeholder="{{$value->kriteria}}">
                    </div>
                  </div>
                    @endforeach
                </div>
                <div class="line"></div>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          {{-- ditulis disini rulenya --}}
          <div class="card">
            <div class="card-header d-flex align-items-center">
              <h4>Keterangan</h4>
            </div>
            <div class="card-body">
              <div class="form-group">
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
      </div>
    </div>
  </section>
@endsection
