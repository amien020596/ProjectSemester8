@extends('layouts.layoutsurveyor')
@section('title')
Lihat Data Mahasiswa | Bidikmisi
@endsection
@section('body')
  <?php use App\Http\Controllers\surveyor\surveyormahasiswasetting; ?>
  <section>
    <div class="container-fluid">
      <!-- Page Header-->
      <header>
        <h1 class="h3 display">Data Mahasiswa</h1>
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
              <div class="card-header">
                <h4>Tabel Data Mahasiswa </h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th class="text-center" >NIM</th>
                        <th class="text-center" >Nama</th>
                        <th class="text-center" >Fakultas</th>
                        <th class="text-center" >Jurusan</th>
                        <th class="text-center" >Pilihan</th>

                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($Dmahasiswa as $key)
                      <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td class="text-center" >{{$key->nim}}</td>
                        <td class="text-center" >{{$key->nama}}</td>
                        <td class="text-center" >{{$key->jurusan}}</td>
                        <td class="text-center" >{{$key->fakultas}}</td>
                        <td class="text-center" >
                          <span data-toggle="tooltip" data-placement="top" title="Hapus Data Mahasiswa">
                          <button  class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal{{$key->nim}}" data-target-id="" >Detail</button>
                          </span>
                        </td>
                      </tr>
                      {{-- modal --}}
                      <div id="modal{{$key->nim}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                        <div role="document" class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 id="exampleModalLabel" class="modal-title">Detail Mahasiswa {{$key->nama}}</h5>
                              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label>Nama Mahasiswa</label>
                                    <input type="text" placeholder="Nama" disabled value="{{$key->nama}}" class="form-control">
                                  </div>
                                  <div class="form-group">
                                    <label>Fakultas Mahasiswa</label>
                                    <input type="text" placeholder="Nama" disabled value="{{$key->fakultas}}" class="form-control">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label>NIM Mahasiswa</label>
                                    <input type="text" placeholder="NIM" disabled value="{{$key->nim}}" class="form-control">
                                  </div>
                                  <div class="form-group">
                                    <label>Jurusan Mahasiswa</label>
                                    <input type="text" placeholder="NIM" disabled value="{{$key->jurusan}}" class="form-control">
                                  </div>
                                </div>
                              </div>
                              <hr>
                              <div class="row">
                                  @foreach ($kriteria as $keye => $value)
                                    <div class="col-lg-6">
                                    <div class="form-group">
                                      <label>{{$value->kriteria}}</label>
                                      <?php $a = surveyormahasiswasetting::ambilnilai($key->nim,$value->id); ?>
                                      <input type="text" placeholder="NIM" disabled value="{{$a['nilai']}}" class="form-control">
                                    </div>
                                    </div>
                                  @endforeach
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </section>
@endsection
