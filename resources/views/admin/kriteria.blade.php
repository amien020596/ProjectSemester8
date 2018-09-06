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
                    <div class="col-lg-12">
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
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

                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$key->id}}">Edit</button>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#ModalHapus{{$key->id}}">Hapus</button>

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

          <div class="modal fade" id="ModalHapus{{$key->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Hapus Kriteria</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>

                  </div>
                  <div class="modal-body">
                    Apa Anda Yakin Menghapus Kriteria {{$key->kriteria}}?
                  </div>
                  <div class="modal-footer">
                    <form class="" action="{{route('kriteria-delete',['id'=>$key->id])}}" method="post">
                      @csrf
                      <button type="submit" name="" class="btn btn-danger">Ya</button>
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>

          <div class="modal fade" id="exampleModalCenter{{$key->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel">Update Kriteria</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form class="" action="{{route('edit-kriteria',['id'=>$key->id])}}" method="post">
                  @csrf
                  <div class="form-group container">
                    <div class="row">
                      <label class="col-md-2">Kriteria</label>
                      <input type="text" name="kriteria" class="form-control col-md-10" value="{{$key->kriteria}}">
                    </div>
                  </div>
                  <div class="form-group container">
                    <div class="row">
                      <label class="col-md-2">Jenis</label>
                      <div class="col-md-10">
                        <label><input type='radio' name='jenis' value='cost'{{ ($key->jenis == "cost") ? "checked" : " " }}>Cost</label>
                        <label><input type='radio' name='jenis' value='benefit' {{ ($key->jenis == "benefit") ? "checked" : " "}}>Benefit</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group container">
                    <div class="row">
                      <label class="col-md-2">Bobot</label>
                      <select name="bobot" id="select" class="form-control col-md-2">
                        <option value="1" {{($key->bobot == 1)? "selected":""}}>1</option>
                        <option value="2" {{($key->bobot == 2)? "selected":""}}>2</option>
                        <option value="3" {{($key->bobot == 3)? "selected":""}}>3</option>
                        <option value="4" {{($key->bobot == 4)? "selected":""}}>4</option>
                        <option value="5" {{($key->bobot == 5)? "selected":""}}>5</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="" class="btn btn-danger">Update</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        @endforeach
        <div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Kriteria</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form class="" action="{{route('tambah-kriteria')}}" method="post">
                @csrf
                <div class="form-group container">
                  <div class="row">
                    <label class="col-md-2">Kriteria</label>
                    <input type="text" name="kriteria" class="form-control col-md-10" value="">
                  </div>
                </div>
                <div class="form-group container">
                  <div class="row">
                    <label class="col-md-2">Jenis</label>
                    <div class="col-md-10">
                      <label><input type='radio' name='jenis' value='cost'>Cost</label>
                      <label><input type='radio' name='jenis' value='benefit'>Benefit</label>
                    </div>
                  </div>
                </div>
                <div class="form-group container">
                  <div class="row">
                    <label class="col-md-2">Bobot</label>
                    {{-- <input type="numeric" name="bobot" class="form-control col-md-10" value=""> --}}
                    <select name="bobot" id="select" class="form-control col-md-2">
                      <option value="1" >1</option>
                      <option value="2" >2</option>
                      <option value="3" >3</option>
                      <option value="4" >4</option>
                      <option value="5" >5</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="submit" name="" class="btn btn-danger">Tambah</button>
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      @endsection
