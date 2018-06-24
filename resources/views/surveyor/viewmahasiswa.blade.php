@extends('layouts.layoutsurveyor')
@section('title')
Lihat Data Mahasiswa | Bidikmisi
@endsection
@section('body')
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
                <h4>Basic Table</h4>
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
                        <td class="text-center" >Otto</td>
                      </tr>
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
