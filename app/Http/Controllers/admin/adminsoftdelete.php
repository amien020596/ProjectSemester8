<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\user_profile;
use App\kriteria;
use App\nilai_mahasiswa;
use App\datamahasiswa;

class adminsoftdelete extends Controller
{
    public function __construct(){

        $this->middleware('auth:admin');
    }

    public function surveyorsoftdelete(){

      $surveyor = user_profile::with('user')->onlyTrashed()->get();
      //return $surveyor;
      return view('admin.softsurveyor')->with('Dsurveyor',$surveyor);
    }

    public function retrivesurveyor($id){

      $users = user_profile::where('user_id', $id)->onlyTrashed()->first();
      if(!isset($users)){
        return redirect()->route('surveyor')->with('error', 'The id does not exist');
      }

      user_profile::where('user_id',$id)->onlyTrashed()->restore();
      User::where('id',$id)->onlyTrashed()->restore();
      nilai_mahasiswa::where('id_user',$id)->onlyTrashed()->restore();
      datamahasiswa::where('id_user',$id)->onlyTrashed()->restore();

      return redirect()->route('surveyor')->with('success', 'Restore Data Account Success');
    }

    public function deletesurveyor($id){
      $users = user_profile::where('user_id', $id)->onlyTrashed()->first();
      if(!isset($users)){
        return redirect()->route('surveyor')->with('error', 'The id does not exist');
      }

      user_profile::where('user_id',$id)->onlyTrashed()->forceDelete();
      User::where('id',$id)->forceDelete();

      return redirect()->route('surveyor')->with('success', 'Delete Permanent Data Account Success');
    }

    public function kriteriasoftdelete(){

      $kriteria = kriteria::onlyTrashed()->get();
      //return $surveyor;
      return view('admin.softkriteria')->with('Dkriteria',$kriteria);
    }

    public function retrivekriteria($id){

      $kriteria = kriteria::where('id', $id)->onlyTrashed()->first();
      if(!isset($kriteria)){
        return redirect()->route('kriteria')->with('error', 'The id does not exist');
      }

      kriteria::where('id',$id)->onlyTrashed()->restore();
      return redirect()->route('kriteria')->with('success', 'Restore Data Kriteria Success');
    }

    public function deletekriteria($id){
      $kriteria = kriteria::where('id', $id)->onlyTrashed()->first();
      if(!isset($kriteria)){
        return redirect()->route('kriteria')->with('error', 'The id does not exist');
      }

      kriteria::where('id',$id)->forceDelete();

      return redirect()->route('kriteria')->with('success', 'Delete Permanent Data Kriteria Success');
    }

}
