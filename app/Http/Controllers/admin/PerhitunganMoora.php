<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\nilai_mahasiswa;
use App\kriteria;
use App\datamahasiswa;
use App\hasilbobot;

class PerhitunganMoora extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function PerhitunganHasilAnalisaData(){
      $kriteria = kriteria::select('id','kriteria')->get();
      $nilaimahasiswa = nilai_mahasiswa::select('nim','id_kriteria','nilai')->get();
      $nim = nilai_mahasiswa::select('nim')->groupBy('nim')->having('nim', '>',0)->get();
      $a = datamahasiswa::count();

      $datamahasiswa = datamahasiswa::select('nim')->get();


      foreach ($nilaimahasiswa as $key => $value) {
        $name1 = $value->nim;
        $name2 = $value->id_kriteria;

        $rows[$name1][$name2]=$value->nilai;
      }
      $data = [
        'kriteria'=>$kriteria,
        'nilai'=>$rows,
        'id'=>$nim
      ];
      return view('admin/Pmoora1')->with($data);

     }

     public function PerhitunganHasilNormalisasi(){
       $kriteria = kriteria::select('id','kriteria')->get();
       $nilaimahasiswa = nilai_mahasiswa::select('nim','id_kriteria','nilai')->get();
       $nim = nilai_mahasiswa::select('nim')->groupBy('nim')->having('nim', '>',0)->get();
       $a = datamahasiswa::count();

       $datamahasiswa = datamahasiswa::select('nim')->get();

       foreach ($nilaimahasiswa as $key => $value) {
         $name1 = $value->nim;
         $name2 = $value->id_kriteria;

         $rows[$name1][$name2]=$value->nilai;
       }

       $results = array();
       foreach ($kriteria as $id) {
         $k = array();
         foreach ($rows as $krit) {
           $a = pow($krit[$id->id],2);
           array_push($k, $a);
         }
         array_push($results, $k);
         unset($k);
         unset($a);
       }

       $hasil = array();
       foreach ($results as $key => $value) {
         $index = $key+1;
         $hasil["kriteria$index"] = sqrt(array_sum($value));
       }
       foreach ($nilaimahasiswa as $key => $value) {
         $name1 = $value->nim;
         $name2 = $value->id_kriteria;

         $hasilnormalisasi[$name1][$name2]=$rows[$name1][$name2]/$hasil["kriteria$value->id_kriteria"];

       }

       $data = [
         'kriteria'=>$kriteria,
         'nilai'=>$hasilnormalisasi,
         'id'=>$nim
       ];

      return view('admin/Pmoora2')->with($data);
     }

     public function nilaioptimasiterbobot(){
       $kriteria = kriteria::select('id','kriteria','jenis','bobot')->get();
       $nilaimahasiswa = nilai_mahasiswa::select('nim','id_kriteria','nilai')->get();
       $nim = nilai_mahasiswa::select('nim')->groupBy('nim')->having('nim', '>',0)->get();


       $datamahasiswa = datamahasiswa::select('nim')->get();

       foreach ($nilaimahasiswa as $key => $value) {
         $name1 = $value->nim;
         $name2 = $value->id_kriteria;
         $rows[$name1][$name2]=$value->nilai;
       }

       $results = array();
       foreach ($kriteria as $id) {
         $k = array();
         foreach ($rows as $krit) {
           $a = pow($krit[$id->id],2);
           array_push($k, $a);
           unset($a);
         }
         array_push($results, $k);
         unset($k);

       }

       $hasil = array();
       foreach ($results as $key => $value) {
         $index = $key+1;
         $hasil["kriteria$index"] = sqrt(array_sum($value));
       }

       foreach ($nilaimahasiswa as $key => $value) {
           $name1 = $value->nim;
           $name2 = $value->id_kriteria;
           foreach ($kriteria as $nilaibobot) {
           $hasilnormalisasiterbobot[$name1][$name2]=($rows[$name1][$name2]/$hasil["kriteria$value->id_kriteria"])*$nilaibobot->bobot;
         }
       }
       $data = [
         'kriteria'=>$kriteria,
         'nilai'=>$hasilnormalisasiterbobot,
         'id'=>$nim
       ];
       // return $kriteria;
       return view('admin/Pmoora3')->with($data);
     }
     public function nilaioptimasiterbobotYi(){
       $kriteria = kriteria::select('id','kriteria','jenis','bobot')->get();
       $nilaimahasiswa = nilai_mahasiswa::select('nim','id_kriteria','nilai')->get();
       $nim = nilai_mahasiswa::select('nim')->groupBy('nim')->having('nim', '>',0)->get();


       $datamahasiswa = datamahasiswa::select('nim')->get();

       foreach ($nilaimahasiswa as $key => $value) {
         $name1 = $value->nim;
         $name2 = $value->id_kriteria;
         $rows[$name1][$name2]=$value->nilai;
       }

       $results = array();
       foreach ($kriteria as $id) {
         $k = array();
         foreach ($rows as $krit) {
           $a = pow($krit[$id->id],2);
           array_push($k, $a);
           unset($a);
         }
         array_push($results, $k);
         unset($k);

       }

       $hasil = array();
       foreach ($results as $key => $value) {
         $index = $key+1;
         $hasil["kriteria$index"] = sqrt(array_sum($value));
       }

       foreach ($nilaimahasiswa as $key => $value) {
           $name1 = $value->nim;
           $name2 = $value->id_kriteria;
           foreach ($kriteria as $nilaibobot) {
           $hasilnormalisasiterbobot[$name1][$name2]=($rows[$name1][$name2]/$hasil["kriteria$value->id_kriteria"])*$nilaibobot->bobot;
         }
       }
       foreach ($nilaimahasiswa as $key => $value) {
         $name1 = $value->nim;
           foreach ($kriteria as $nilaibobot) {
           $hasilbobot[$name1]=array_sum($hasilnormalisasiterbobot[$name1]);
         }
       }
       $data = [
         'kriteria'=>$kriteria,
         'nilai'=>$hasilnormalisasiterbobot,
         'id'=>$nim,
         'bobot'=>$hasilbobot
       ];

       //return $hasilbobot;
      return view('admin/Pmoora4')->with($data);
     }


     public function nilairating(){
       $kriteria = kriteria::select('id','kriteria','jenis','bobot')->get();
       $nilaimahasiswa = nilai_mahasiswa::select('nim','id_kriteria','nilai')->get();
       // $nim = nilai_mahasiswa::select('nim')->groupBy('nim')->having('nim', '>',0)->get();
       $nim = datamahasiswa::select('nim')->get();

       $datamahasiswa = datamahasiswa::select('nim')->get();

       foreach ($nilaimahasiswa as $key => $value) {
         $name1 = $value->nim;
         $name2 = $value->id_kriteria;
         $rows[$name1][$name2]=$value->nilai;
       }

       $results = array();
       foreach ($kriteria as $id) {
         $k = array();
         foreach ($rows as $krit) {
           $a = pow($krit[$id->id],2);
           array_push($k, $a);
           unset($a);
         }
         array_push($results, $k);
         unset($k);

       }

       $hasil = array();
       foreach ($results as $key => $value) {
         $index = $key+1;
         $hasil["kriteria$index"] = sqrt(array_sum($value));
       }

       foreach ($nilaimahasiswa as $key => $value) {
           $name1 = $value->nim;
           $name2 = $value->id_kriteria;
           foreach ($kriteria as $nilaibobot) {
           $hasilnormalisasiterbobot[$name1][$name2]=($rows[$name1][$name2]/$hasil["kriteria$value->id_kriteria"])*$nilaibobot->bobot;
         }
       }
       foreach ($nilaimahasiswa as $key => $value) {
         $name1 = $value->nim;
           foreach ($kriteria as $nilaibobot) {
           $hasilbobot[$name1]=array_sum($hasilnormalisasiterbobot[$name1]);
         }
       }

       $kuikui = hasilbobot::all();

       if(!empty($kuikui)){
         hasilbobot::truncate();
         $this->inputhasilbobot($nim,$hasilbobot);
       }else{
         $this->inputhasilbobot($nim,$hasilbobot);
       }

      $hasilbobot = hasilbobot::orderBy('nilai','ASC')->get();
         $data = [
         'id'=>$hasilbobot,
       ];
    return view('admin/Pmoora5')->with($data);
    }

      function inputhasilbobot($nim,$hasilbobot){

        foreach ($nim as $key => $value) {
          $rating = hasilbobot::create(
            [
              'nilai'=>$hasilbobot["$value->nim"],
              'nim'=>$value->nim
            ]);
        }
      }
}
