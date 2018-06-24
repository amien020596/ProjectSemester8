<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::Group([
    'namespace'=>'surveyor'
  ],function(){
    Route::get('/home', 'surveyorController@index')->name('home');
    Route::get('/surveyor/home','SurveyorController@index');
    Route::Group([

      'prefix'=>'surveyor'
        ],function(){
            Route::get('/mahasiswa','surveyormahasiswasetting@index')->name('view-mahasiswa-surveyor');
            Route::get('/insert/mahasiswa','surveyormahasiswasetting@create')->name('insert-mahasiswa-surveyor');
            // Route::post('/destroy/mahasiswa/{id}','adminMahasiswasetting@destroy')->name('destroy-mahasiswa');
            // Route::get('/edit/mahasiswa/{id}','adminMahasiswasetting@edit')->name('edit-mahasiswa');
            // Route::get('/detail/mahasiswa/{id}','adminMahasiswasetting@show')->name('detail-mahasiswa');
            // Route::post('/update/mahasiswa/{id}','adminMahasiswasetting@update')->name('update-mahasiswa');
            Route::post('/store/mahasiswa','surveyormahasiswasetting@store')->name('store-mahasiswa-surveyor');
            // Route::post('/show/mahasiswa/{id}','adminMahasiswasetting@show')->name('show-mahasiswa');
            Route::get('/json-fakultas','surveyormahasiswasetting@selectfakultas')->name('json-fakultas');
          });
});

Route::Group([
      'prefix'=>'admin',
      'namespace'=>'admin'
    ],function(){

        Route::Group([
          'prefix'=>'surveyor',
      ],function(){
        Route::get('/view','AdminSettingSurveyor@index')->name('view-surveyor');
        Route::get('/detail/{id}','AdminSettingSurveyor@show')->name('detail');
        Route::get('/edit/{id}','AdminSettingSurveyor@edit')->name('edit');
        Route::post('/update/{id}','AdminSettingSurveyor@update')->name('update');
        Route::post('/delete/{id}','AdminSettingSurveyor@destroy')->name('delete');
        Route::post('/reset/{id}','AdminSettingSurveyor@resetpassword')->name('reset-password');
        Route::get('/create','AdminSettingSurveyor@create')->name('add-surveyor');
        Route::post('/store','AdminSettingSurveyor@store')->name('store');
      });
      Route::Group([
        'prefix'=>'kriteria',
    ],function(){
      Route::get('/','adminKriteriaSetting@index')->name('view-kriteria');
      Route::post('/tambah','adminKriteriaSetting@store')->name('tambah-kriteria');
      Route::post('/edit/{id}','adminKriteriaSetting@update')->name('edit-kriteria');
      Route::post('/delete/{id}','adminKriteriaSetting@destroy')->name('kriteria-delete');

    });
      Route::Group([
        'prefix'=>'mahasiswa'
    ],function(){
        Route::get('/mahasiswa','adminMahasiswasetting@index')->name('view-mahasiswa');
        Route::get('/insert/mahasiswa','adminMahasiswasetting@create')->name('insert-mahasiswa');
        Route::post('/destroy/mahasiswa/{id}','adminMahasiswasetting@destroy')->name('destroy-mahasiswa');
        Route::get('/edit/mahasiswa/{id}','adminMahasiswasetting@edit')->name('edit-mahasiswa');
        Route::get('/detail/mahasiswa/{id}','adminMahasiswasetting@show')->name('detail-mahasiswa');
        Route::post('/update/mahasiswa/{id}','adminMahasiswasetting@update')->name('update-mahasiswa');
        Route::post('/store/mahasiswa','adminMahasiswasetting@store')->name('store-mahasiswa');
        Route::post('/show/mahasiswa/{id}','adminMahasiswasetting@show')->name('show-mahasiswa');
        Route::get('/json-fakultas','adminMahasiswasetting@selectfakultas')->name('json-fakultas');
      });
      Route::Group([
        'prefix'=>'perhitungan'
      ],function(){
        Route::get('perhitungan1','PerhitunganMoora@PerhitunganHasilAnalisaData')->name('perhitungan1');
        Route::get('perhitungan2','PerhitunganMoora@PerhitunganHasilNormalisasi')->name('perhitungan2');
        Route::get('perhitungan3','PerhitunganMoora@nilaioptimasiterbobot')->name('perhitungan3');
        Route::get('perhitungan4','PerhitunganMoora@nilaioptimasiterbobotYi')->name('perhitungan4');
        Route::get('perhitungan5','PerhitunganMoora@nilairating')->name('perhitungan5');
        Route::get('print','PerhitunganMoora@print')->name('print');
      });
      Route::Group([
        'prefix'=>'softdelete',
    ],function(){
      Route::get('/surveyor','adminsoftdelete@surveyorsoftdelete')->name('surveyor');
      Route::post('/retrive/{id}','adminsoftdelete@retrivesurveyor')->name('retrive-surveyor');
      Route::post('/delete/{id}','adminsoftdelete@deletesurveyor')->name('delete-surveyor');

      Route::get('/kriteria','adminsoftdelete@kriteriasoftdelete')->name('kriteria');
      Route::post('/retrive/{id}','adminsoftdelete@retrivekriteria')->name('retrive-kriteria');
      Route::post('/delete/{id}','adminsoftdelete@deletekriteria')->name('delete-kriteria');
    });



    Route::get('/setting','AdminController@settingprofile')->name('admin-setting');
    Route::get('/admin-home','AdminController@index')->name('admin-home');
    Route::get('/profile','AdminController@profile')->name('admin-profile');
});
