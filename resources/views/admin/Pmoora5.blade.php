@extends('layouts.layoutadmin')
@section('title')
  Hasil Normalisasi Terbobot (Yi)
@endsection
      @section('body')
        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Data Nilai Normalisasi Terbobot (Yi)</strong>
                        </div>
                        <div class="card-body">
                          <font size="4">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered ">
                              <thead>
                                <tr>
                                  <th class="text-center">NIM</th>
                                  <th class="text-center">Yi</th>
                                  <th class="text-center">Ranking</th>
                                </tr>
                              </thead>
                              <tbody>
                                @if (isset($id))
                                  @foreach ($id as $key => $nim)
                                    <tr>
                                      <td class="text-center">{{$nim->nim}}</td>
                                      <td class="text-center">{{$nim->nilai}}</td>
                                      <td class="text-center">{{$loop->iteration}}</td>
                                    </tr>
                                  @endforeach
                                @endif
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
