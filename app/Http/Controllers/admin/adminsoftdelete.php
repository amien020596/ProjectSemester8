<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\user_profile;
use App\kriteria;
use App\nilai_mahasiswa;
use App\datafakultas;
use Auth;
use App\datamahasiswa;

class adminsoftdelete extends Controller
{
    public function __construct(){

        $this->middleware('auth:admin');
    }

    public function surveyorsoftdelete(){
      $admin = user_profile::with('user')->where('user_id',Auth::user()->id)->first();
      $surveyor = user_profile::with('user')->onlyTrashed()->get();
      $data = ['admin'=>$admin,'Dsurveyor'=>$surveyor];
      //return $surveyor;
      return view('admin.softsurveyor')->with($data);
    }

    public function retrivesurveyor($id){

        $users = user_profile::where('user_id', $id)->onlyTrashed()->first();
        if(!isset($users)){
          return redirect()->route('surveyor')->with('error', 'The id does not exist');
        }

        user_profile::where('user_id',$id)->onlyTrashed()->restore();
        User::where('id',$id)->onlyTrashed()->restore();
        // datamahasiswa::where('id_user',$id)->onlyTrashed()->restore();
        // nilai_mahasiswa::where('id_user',$id)->onlyTrashed()->restore();

          $kriteriadelete = kriteria::onlyTrashed()->get();

          foreach ($kriteriadelete as $key => $kriteriaid) {
            $where = [
              'id_user'=>$id,
              'id_kriteria'=>$kriteriaid->id
            ];
            $nilai = nilai_mahasiswa::where($where)->first();
              if($kriteriaid->id==$nilai['id_kriteria'] && $nilai != null){
                nilai_mahasiswa::where($where)->delete();
              }
          }
      //return $kriteriadelete;

      return redirect()->route('surveyor')->with('success', 'Restore Data Account Success');
    }

    public function deletesurveyor($id){
      $users = user_profile::where('user_id', $id)->onlyTrashed()->first();
      if(!isset($users)){
        return redirect()->route('surveyor')->with('error', 'The id does not exist');
      }

      datamahasiswa::where('id_user',$id)->onlyTrashed()->forceDelete();
      nilai_mahasiswa::where('id_user',$id)->onlyTrashed()->forceDelete();
      user_profile::where('user_id',$id)->onlyTrashed()->forceDelete();
      User::where('id',$id)->forceDelete();


      return redirect()->route('surveyor')->with('success', 'Delete Permanent Data Account Success');
    }

    public function kriteriasoftdelete(){

      $kriteria = kriteria::onlyTrashed()->get();
      //return $kriteria;
      $admin = user_profile::with('user')->where('user_id',Auth::user()->id)->first();
      $data = ['admin'=>$admin,'Dkriteria'=>$kriteria];
      return view('admin.softkriteria')->with($data);
    }

    public function retrivekriteria($id){

      $kriteria = kriteria::where('id', $id)->onlyTrashed()->first();
      if(!isset($kriteria)){
        return redirect()->route('kriteria')->with('error', 'The id does not exist');
      }

      kriteria::where('id',$id)->onlyTrashed()->restore();
      nilai_mahasiswa::where('id_kriteria',$id)->onlyTrashed()->restore();

                $datamahasiswadelete = datamahasiswa::onlyTrashed()->get();

                foreach ($datamahasiswadelete as $key => $datanim) {
                  $where = [
                    'nim'=>$datanim->nim,
                  ];
                  $nilai = nilai_mahasiswa::where($where)->first();
                    if($datanim->nim==$nilai['nim']){
                      nilai_mahasiswa::where($where)->delete();
                    }
                }


      return redirect()->route('kriteria')->with('success', 'Restore Data Mahasiswa Success');
    }

    public function deletekriteria($id){
      $kriteria = kriteria::where('id', $id)->onlyTrashed()->first();
      if(!isset($kriteria)){
        return redirect()->route('kriteria')->with('error', 'The id does not exist');
      }

      nilai_mahasiswa::where('id_kriteria',$id)->forceDelete();
      kriteria::where('id',$id)->forceDelete();
      return redirect()->route('kriteria')->with('success', 'Delete Permanent Data Kriteria Success');
    }

    public function mahasiswasoftdelete(){

      $mahasiswa = datamahasiswa::onlyTrashed()->with('fakultas')->with('jurusan')->get();
      //return $mahasiswa;
      $admin = user_profile::with('user')->where('user_id',Auth::user()->id)->first();
      $data = ['admin'=>$admin,'Dmahasiswa'=>$mahasiswa];
      return view('admin.softmahasiswa')->with($data);
    }

    public function retrivemahasiswa($nim){

      $mahasiswa = datamahasiswa::where('nim', $nim)->onlyTrashed()->first();

      if(!isset($mahasiswa)){
        return redirect()->route('mahasiswa')->with('error', 'The id does not exist');
      }

      // $admin = user_profile::where('user_id',$mahasiswa->id_user)->onlyTrashed()->first();
      //
      // if(isset($admin)){
      //   return redirect()->route('mahasiswa')->with('error', 'Cant Restorge Because Surveyor Already Softdelete');
      // }

      datamahasiswa::where('nim',$nim)->onlyTrashed()->restore();
      nilai_mahasiswa::where('nim',$nim)->onlyTrashed()->restore();

                $kriteria = kriteria::onlyTrashed()->get();

                foreach ($kriteria as $key => $kriteriadelete) {
                  $where = [
                    'id_kriteria'=>$kriteriadelete->id,
                  ];
                  $nilai = nilai_mahasiswa::where($where)->first();
                  // dd($nilai);
                    if($kriteriadelete->id==$nilai['id_kriteria'] && $nilai != null){
                      nilai_mahasiswa::where($where)->delete();
                    }
                }

      return redirect()->route('mahasiswa')->with('success', 'Restore Data mahasiswa Success');
    }

    public function deletemahasiswa($nim){
      $mahasiswa = datamahasiswa::where('nim', $nim)->onlyTrashed()->first();
      if(!isset($mahasiswa)){
        return redirect()->route('mahasiswa')->with('error', 'The id does not exist');
      }

      nilai_mahasiswa::where('nim',$nim)->forceDelete();
      datamahasiswa::where('nim',$nim)->forceDelete();
      return redirect()->route('mahasiswa')->with('success', 'Delete Permanent Data Mahasiswa Success');
    }

}
