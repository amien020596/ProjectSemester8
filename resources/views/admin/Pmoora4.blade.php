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
                          <font size="2">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered ">
                              <thead>
                                <tr>

                                  <th class="text-center">NIM</th>
                                  @foreach ($kriteria as $key => $value)
                                  <th class="text-center">{{$value["kriteria"]}}</th>
                                  @endforeach
                                  <th class="text-center">Yi</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($id as $key => $nim)

                                  <tr>
                                      <td class="text-center">{{$nim->nim}}</td>
                                      @foreach ($kriteria as $key => $value)
                                        @if (isset($nilai["$nim->nim"]["$value->id"]))
                                            <td class="text-center">{{number_format($nilai["$nim->nim"]["$value->id"],3)}}</td>
                                        @else
                                            <td class="text-center cie">belom di berinilai</td>
                                        @endif
                                      @endforeach
                                        <td class="text-center">{{number_format($bobot["$nim->nim"],5)}}</td>
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
