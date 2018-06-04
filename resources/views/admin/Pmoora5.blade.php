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
                          <font size="1">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered ">
                              <thead>
                                <tr>

                                  <th class="text-center">NIM</th>
                                  @foreach ($kriteria as $key => $value)
                                  <th class="text-center">{{$value["kriteria"]}}</th>
                                  @endforeach
                                  <th class="text-center">Yi</th>
                                  <th class="text-center">Rating</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($id as $key => $nim)

                                  <tr>
                                      <td class="text-center">{{$nim->nim}}</td>
                                      @foreach ($kriteria as $key => $value)
                                      <td class="text-center">{{number_format($nilai["$nim->nim"]["$value->id"],5)}}</td>
                                      {{-- <td class="text-center">{{$nilai["$nim->nim"]["$value->id"]}}</td> --}}
                                      @endforeach
                                        <td class="text-center">{{number_format($bobot["$nim->nim"],5)}}</td>
                                        <td class="text-center">{{$rating["$nim->nim"]}}</td>
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
