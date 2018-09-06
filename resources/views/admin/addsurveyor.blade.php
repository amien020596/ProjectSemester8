@extends('layouts.layoutadmin')
@section('title')
  Tembah Surveyor
@endsection
@section('body')
  <div class="content mt-3">
      <div class="animated fadeIn">
          <div class="row">
  <!-- kita butuh ini -->
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
                          <strong>Tambah</strong> Surveyor
                        </div>
                        <div class="card-body card-block">
                          <form action="{{route('store')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="row form-group">
                              <div class="col col-md-2"><label for="text-input" class=" form-control-label">Nama Depan</label></div>
                              <div class="col-12 col-md-6"><input type="text" id="text-input" name="firstname" value="{{old('firstname')}}" placeholder="Masukan Nama Depan" class="form-control"></div>
                              <div class="col-12 col-md-4">
                                @if ($errors->has('firstname'))
                                <h6>
                                      <p class="text-danger">*<small>{{ $errors->first('firstname') }}</small></p>
                                </h6>
                                @endif
                              </div>
                            </div>
                            <div class="row form-group">
                              <div class="col col-md-2"><label for="email-input" class=" form-control-label">Nama Belakang</label></div>
                              <div class="col-12 col-md-6"><input type="text" id="text-input" name="lastname" value="{{old('lastname')}}" placeholder="Masukan Nama Belakang" class="form-control"></div>
                              <div class="col-12 col-md-4">
                                @if ($errors->has('lastname'))
                                <h6>
                                      <p class="text-danger">*<small>{{ $errors->first('lastname') }}</small></p>
                                </h6>
                                @endif
                              </div>
                            </div>
                            <div class="row form-group">
                              <div class="col col-md-2"><label for="password-input" class=" form-control-label">Email</label></div>
                              <div class="col-12 col-md-6">
                                <input type="email" id="text-input" name="email" value="{{old('email')}}" placeholder="Masukan Email" class="form-control">
                              </div>
                              <div class="col-12 col-md-4">
                                @if ($errors->has('email'))
                                <h6>
                                      <p class="text-danger">*<small>{{ $errors->first('email') }}</small></p>
                                </h6>
                                @endif
                              </div>
                            </div>
                            <div class="row form-group">
                              <div class="col col-md-2"><label for="password-input" class=" form-control-label">Password</label></div>
                              <div class="col-12 col-md-6">
                                <input type="password" id="text-input" name="password" value="" placeholder="Masukan Password" class="form-control">
                              </div>
                              <div class="col-12 col-md-4">
                                @if ($errors->has('password'))
                                <h6>
                                      <p class="text-danger">*<small>{{ $errors->first('password') }}</small></p>
                                </h6>
                                @endif
                              </div>
                            </div>
                            <div class="row form-group">
                              <div class="col col-md-2"><label for="password-input" class=" form-control-label">Password confirmation</label></div>
                              <div class="col-12 col-md-6">
                                <input type="password" id="text-input" name="password_confirmation" value="" placeholder="Masukan konfirmasi password" class="form-control">
                              </div>
                              <div class="col-12 col-md-4">
                                @if ($errors->has('password'))
                                <h6>
                                      <p class="text-danger">*<small>{{ $errors->first('password') }}</small></p>
                                </h6>
                                @endif
                              </div>
                            </div>
                            <div class="row form-group">
                              <div class="col col-md-2"><label for="textarea-input" class=" form-control-label">Alamat</label></div>
                              <div class="col-12 col-md-6">
                                <textarea name="address" id="textarea-input" rows="9" placeholder="Content..." class="form-control">{{old('address')}}</textarea>
                              </div>
                              <div class="col-12 col-md-4">
                                @if ($errors->has('address'))
                                <h6>
                                      <p class="text-danger">*<small>{{ $errors->first('address') }}</small></p>
                                </h6>
                                @endif
                              </div>
                            </div>
                            <div class="row form-group">
                              <div class="col col-md-2"><label for="file-input" class=" form-control-label">Foto</label></div>
                              <div class="col-12 col-md-6">
                                <input type="file" name="file" class="form-control-file">
                                @if ($errors->has('file'))
                                <h6>
                                      <p class="text-danger">*<small>{{ $errors->first('file') }}</small></p>
                                </h6>
                                @endif
                            </div>
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
                      </div>
                    </div>
  <!-- sampe ini -->
          </div>
      </div><!-- .animated -->
    </div><!-- .content -->

@endsection
