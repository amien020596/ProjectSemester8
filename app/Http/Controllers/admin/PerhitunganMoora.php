<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\nilai_mahasiswa;
use App\kriteria;
use App\datamahasiswa;
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
        'nilai'=>$rows
      ];
      //return view('admin/Pmoora1')->with($data);
      //print_r($rows);

     }
     public function ujicobaarray(){
       $rows[0][0]=1;
       $rows[0][1]=2;
       $rows[0][2]=3;
       $rows[0][3]=4;
       $rows[1][0]=5;
       $rows[1][1]=6;
       $rows[1][2]=7;
       $rows[1][3]=8;
       $rows[2][0]=9;
       $rows[2][1]=10;
       $rows[2][2]=11;
       $rows[2][3]=12;
       $rows[3][0]=13;
       $rows[3][1]=14;
       $rows[3][2]=15;
       $rows[3][3]=16;
       for ($a=0; $a < 4; $a++) {
         echo "|";
         for ($b=0; $b <4 ; $b++) {
          echo $rows[$a][$b];
          echo " ";
         }
         echo "|";
         echo "<br>";
       }


     }
}
