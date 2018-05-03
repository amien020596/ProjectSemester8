@extends('layouts.layoutadmin')
@section('title')
  detail surveyor
@endsection
@section('body')

          <div class="content mt-3">
              <div class="animated fadeIn">


                  <div class="row">

  <!-- kita butuh ini -->
                    <div class="col-lg-12">
                      <div class="card">
                        <div class="card-header">
                          <strong>Detail Surveyor</strong> {{$Dsurveyor->user->name}}
                        </div>
                        <div class="card-body card-block">
                            <div class="row form-group">
                              <div class="col col-md-2"><label for="text-input" class=" form-control-label">Nama Depan</label></div>
                              <div class="col-12 col-md-10"><input type="text" id="text-input" name="text-input" placeholder="Text" value="{{$Dsurveyor->firstname}}" disabled class="form-control"><small class="form-text text-muted"></small></div>
                            </div>
                            <div class="row form-group">
                              <div class="col col-md-2"><label for="text-input" class=" form-control-label">Nama Belakang</label></div>
                              <div class="col-12 col-md-10"><input type="text" id="text-input" name="text-input" placeholder="Text" value="{{$Dsurveyor->lastname}}" disabled class="form-control"><small class="form-text text-muted"></small></div>
                            </div>
                            <div class="row form-group">
                              <div class="col col-md-2"><label for="email-input" class=" form-control-label">Alamat</label></div>
                              <div class="col-12 col-md-10"><input type="text" id="email-input" name="email-input" placeholder="Enter Email" value="{{$Dsurveyor->address}}" disabled class="form-control"><small class="help-block form-text"></small></div>
                            </div>
                            <div class="row form-group">
                              <div class="col col-md-2"><label for="password-input" class=" form-control-label">No Hp</label></div>
                              <div class="col-12 col-md-10"><input type="text" id="password-input" name="password-input" placeholder="Password" value="{{$Dsurveyor->no_hp}}" disabled class="form-control"><small class="help-block form-text"></small></div>
                            </div>
                            <div class="row form-group">
                              <div class="col col-md-2"><label for="disabled-input" class=" form-control-label">Email</label></div>
                              <div class="col-12 col-md-10"><input type="text" id="disabled-input" name="disabled-input" placeholder="" value="{{$Dsurveyor->user->email}}" disabled class="form-control"></div>
                            </div>
                            <div class="row form-group">
                              <div class="col col-md-2"><label for="textarea-input" class=" form-control-label">Foto</label></div>
                              <div class="col-12 col-md-10"> <img src="https://i1.sndcdn.com/avatars-000145481005-8x4evx-t500x500.jpg" alt="" width="150px"> </div>
                            </div>
                        </div>
                      </div>
                    </div>
  <!-- sampe ini -->

                  </div>


              </div><!-- .animated -->
          </div><!-- .content -->

@endsection
