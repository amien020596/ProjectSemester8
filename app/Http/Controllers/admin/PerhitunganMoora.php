<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\nilai_mahasiswa;
use App\kriteria;
use App\datamahasiswa;
use App\user_profile;
use Auth;
use App\hasilbobot;
use PDF;

class PerhitunganMoora extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

      public function matriksDataNilai(){
              $kriteria = kriteria::select('id','kriteria')->get();
              $nim = nilai_mahasiswa::select('nim')->groupBy('nim')->having('nim', '>',0)->get();
              $rows = $this->analisaData();
              //return $rows;
              $admin = user_profile::with('user')->where('user_id',Auth::user()->id)->first();

              $data = [
                'kriteria'=>$kriteria,
                'nilai'=>$rows,
                'id'=>$nim,
                'admin'=>$admin
              ];

              return view('admin/Pmoora1')->with($data);
         }
      public function PerhitunganHasilNormalisasi(){
         $kriteria = kriteria::select('id','kriteria')->get();

         $nim = nilai_mahasiswa::select('nim')->groupBy('nim')->having('nim', '>',0)->get();

           $hasilnormalisasi = $this->HasilNormalisasi($kriteria);
          // return $hasilnormalisasi;
           //print_r($hasilnormalisasi);
           $admin = user_profile::with('user')->where('user_id',Auth::user()->id)->first();
           $data = [
             'kriteria'=>$kriteria,
             'nilai'=>$hasilnormalisasi,
             'id'=>$nim,
             'admin'=>$admin
           ];

        return view('admin/Pmoora2')->with($data);

       }
      public function nilaioptimasiterbobot(){

         $kriteria = kriteria::select('id','kriteria','jenis','bobot')->get();
         $nim = nilai_mahasiswa::select('nim')->groupBy('nim')->having('nim', '>',0)->get();

         $hasilnormalisasiterbobot = $this->NormalisasiTerbobot($kriteria);
         //
        // return $hasilnormalisasiterbobot;
        $admin = user_profile::with('user')->where('user_id',Auth::user()->id)->first();
         $data = [
           'kriteria'=>$kriteria,
           'nilai'=>$hasilnormalisasiterbobot,
           'id'=>$nim,
           'admin'=>$admin
         ];

         return view('admin/Pmoora3')->with($data);
       }
      public function nilaioptimasiterbobotYi(){
         $kriteria = kriteria::select('id','kriteria','jenis','bobot')->get();
         $kriteriaMax = kriteria::select('id','kriteria','jenis','bobot')->where('jenis','=','benefit')->get();

         $hasilnormalisasiterbobot = $this->NormalisasiTerbobot($kriteria);
         $hasilnormalisasiterbobotMax = $this->NormalisasiTerbobotMax($kriteriaMax);
         $nim = nilai_mahasiswa::select('nim')->groupBy('nim')->having('nim', '>',0)->get();
         $mahasiswa = nilai_mahasiswa::select('nim','id_kriteria','nilai')->first();
         $admin = user_profile::with('user')->where('user_id',Auth::user()->id)->first();
           if(isset($mahasiswa)){

               $nilaimahasiswa = nilai_mahasiswa::select('nim','id_kriteria','nilai')->get();
                foreach ($nilaimahasiswa as $key => $value) {
                  $name1 = $value->nim;
                    foreach ($kriteria as $nilaibobot) {
                    $hasilbobotMin[$name1]=array_sum($hasilnormalisasiterbobot[$name1]);
                  }
                }
                $nilaimahasiswa2 = kriteria::where('jenis','=','benefit')->get();
                foreach ($nilaimahasiswa2 as $key => $value) {
                  $nilaimahasiswa3 = nilai_mahasiswa::where('id_kriteria','=',$value->id)->get();
                  foreach ($nilaimahasiswa3 as $key => $value) {
                    $name1 = $value->nim;
                    $hasilbobotMax[$name1]=array_sum($hasilnormalisasiterbobotMax[$name1]);
                  }
                }
                if(empty($hasilbobotMax)){
                  $hasilbobotMax = 0;
                }
                if(empty($hasilbobotMin)){
                  $hasilbobotMin = 0;
                }

                foreach ($nilaimahasiswa as $key => $value) {
                  $name1 = $value->nim;
                  $BFhasilbobot[$name1] = $hasilbobotMin[$name1] - $hasilbobotMax[$name1];
                  $hasilbobot[$name1] =  $hasilbobotMax[$name1] - $BFhasilbobot[$name1];
                }
          }else{
            $hasilbobot = null;
          }

         $data = [
           'kriteria'=>$kriteria,
           'nilai'=>$hasilnormalisasiterbobot,
           'id'=>$nim,
           'bobot'=>$hasilbobot,
           'admin'=>$admin
         ];

        return view('admin/Pmoora4')->with($data);
       }
      public function nilairating(){
        $kriteria = kriteria::select('id','kriteria','jenis','bobot')->get();
        $kriteriaMax = kriteria::select('id','kriteria','jenis','bobot')->where('jenis','=','benefit')->get();

        $hasilnormalisasiterbobot = $this->NormalisasiTerbobot($kriteria);
        $hasilnormalisasiterbobotMax = $this->NormalisasiTerbobotMax($kriteriaMax);
        //return $hasilnormalisasiterbobot;
        $nim = nilai_mahasiswa::select('nim')->groupBy('nim')->having('nim', '>',0)->get();
        $mahasiswa = nilai_mahasiswa::select('nim','id_kriteria','nilai')->first();
        $admin = user_profile::with('user')->where('user_id',Auth::user()->id)->first();
          if(isset($mahasiswa)){

              $nilaimahasiswa = nilai_mahasiswa::select('nim','id_kriteria','nilai')->get();
               foreach ($nilaimahasiswa as $key => $value) {
                 $name1 = $value->nim;
                   foreach ($kriteria as $nilaibobot) {
                   $hasilbobotMin[$name1]=array_sum($hasilnormalisasiterbobot[$name1]);
                 }
               }
                //return $hasilbobotMin;
               $nilaimahasiswa2 = kriteria::where('jenis','=','benefit')->get();
               foreach ($nilaimahasiswa2 as $key => $value) {
                 $nilaimahasiswa3 = nilai_mahasiswa::where('id_kriteria','=',$value->id)->get();
                 foreach ($nilaimahasiswa3 as $key => $value) {
                   $name1 = $value->nim;
                   $hasilbobotMax[$name1]=array_sum($hasilnormalisasiterbobotMax[$name1]);
                 }
               }
               // return $hasilbobotMax;
               if(empty($hasilbobotMax)){
                 $hasilbobotMax = 0;
               }
               if(empty($hasilbobotMin)){
                 $hasilbobotMin = 0;
               }
               foreach ($nilaimahasiswa as $key => $value) {
                 $name1 = $value->nim;
                 $BFhasilbobot[$name1] = $hasilbobotMin[$name1] - $hasilbobotMax[$name1];
                 $hasilbobot[$name1] =  $hasilbobotMax[$name1] - $BFhasilbobot[$name1];
               }

               $kuikui = hasilbobot::all();
               if(!empty($kuikui)){
                 hasilbobot::truncate();
                 $this->inputhasilbobot($nim,$hasilbobot);
               }else{
                 $this->inputhasilbobot($nim,$hasilbobot);
               }
             $hasilbobot = hasilbobot::orderBy('nilai','DESC')->get();
             //$hasilbobot = hasilbobot::with('datamahasiswa')->get();
             //dd($hasilbobot);
           }else{
             $hasilbobot = null;
           }
                   $data = [
                   'id'=>$hasilbobot,
                   'admin'=>$admin
                 ];

          return view('admin/Pmoora5')->with($data);
        }
      public function hasilperhitungan(){
          $kriteria = kriteria::select('id','kriteria','jenis','bobot')->get();
          $kriteriaMax = kriteria::select('id','kriteria','jenis','bobot')->where('jenis','=','benefit')->get();

          $hasilnormalisasiterbobot = $this->NormalisasiTerbobot($kriteria);
          $hasilnormalisasiterbobotMax = $this->NormalisasiTerbobotMax($kriteriaMax);
          //return $hasilnormalisasiterbobot;
          $nim = nilai_mahasiswa::select('nim')->groupBy('nim')->having('nim', '>',0)->get();
          $mahasiswa = nilai_mahasiswa::select('nim','id_kriteria','nilai')->first();
          $admin = user_profile::with('user')->where('user_id',Auth::user()->id)->first();
            if(isset($mahasiswa)){

                $nilaimahasiswa = nilai_mahasiswa::select('nim','id_kriteria','nilai')->get();
                 foreach ($nilaimahasiswa as $key => $value) {
                   $name1 = $value->nim;
                     foreach ($kriteria as $nilaibobot) {
                     $hasilbobotMin[$name1]=array_sum($hasilnormalisasiterbobot[$name1]);
                   }
                 }
                  //return $hasilbobotMin;
                 $nilaimahasiswa2 = kriteria::where('jenis','=','benefit')->get();
                 foreach ($nilaimahasiswa2 as $key => $value) {
                   $nilaimahasiswa3 = nilai_mahasiswa::where('id_kriteria','=',$value->id)->get();
                   foreach ($nilaimahasiswa3 as $key => $value) {
                     $name1 = $value->nim;
                     $hasilbobotMax[$name1]=array_sum($hasilnormalisasiterbobotMax[$name1]);
                   }
                 }
                 // return $hasilbobotMax;
                 if(empty($hasilbobotMax)){
                   $hasilbobotMax = 0;
                 }
                 if(empty($hasilbobotMin)){
                   $hasilbobotMin = 0;
                 }
                 foreach ($nilaimahasiswa as $key => $value) {
                   $name1 = $value->nim;
                   $BFhasilbobot[$name1] = $hasilbobotMin[$name1] - $hasilbobotMax[$name1];
                   $hasilbobot[$name1] =  $hasilbobotMax[$name1] - $BFhasilbobot[$name1];
                 }

                 $kuikui = hasilbobot::all();
                 if(!empty($kuikui)){
                   hasilbobot::truncate();
                   $this->inputhasilbobot($nim,$hasilbobot);
                 }else{
                   $this->inputhasilbobot($nim,$hasilbobot);
                 }
               //$hasilbobot = hasilbobot::orderBy('nilai','DESC')->get();
               $hasilbobot = hasilbobot::with('datamahasiswa')->orderBy('nilai','DESC')->get();
               //dd($hasilbobot);
             }else{
               $hasilbobot = null;
             }
                     $data = [
                     'id'=>$hasilbobot,
                     'admin'=>$admin
                   ];

            return view('admin/hasilperhitungan')->with($data);
        }
      public function print(){

        $bobot = hasilbobot::orderBy('nilai','ASC')->first();
        if($bobot != null){
              $hasilbobot = hasilbobot::with('datamahasiswa','datamahasiswa.fakultas','datamahasiswa.jurusan')->orderBy('nilai','DESC')->get();
              $data = [
              'id'=>$hasilbobot,
            ];
           $view = \View::make('Print')->with($data);
           $html_content = $view->render();

                 // Custom Header
                 PDF::setHeaderCallback(function($pdf) {
                   // Logo
                   //$image_file = asset('storage/Filepicture/amien-2.jpg');
                   $image_file = "https://bidikmisi.belmawa.ristekdikti.go.id/images/logo.png";
                   $pdf->Image($image_file, 20, 10, 50, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
                         // Set font
                         $pdf->SetFont('helvetica', 'B', 20);
                         // Title
                         $text = "Hasil Penilaian Beasiswa Bidikmisi";
                         $pdf->Cell(180, 30, $text, 0, 0, 'C', 0, '', 0, false, 'T', 'M');
                 });
                 // Custom Footer
                 PDF::setFooterCallback(function($pdf) {
                         // Position at 15 mm from bottom
                         $pdf->SetY(-15);
                         // Set font
                         $pdf->SetFont('helvetica', 'I', 8);
                         // Page number
                         $pdf->Cell(0, 10, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
                 });

           PDF::SetTitle('HasilPenilaian');
           PDF::SetAuthor('Bidikmisi');
           PDF::SetMargins(20, 45, 20, 10);
           PDF::AddPage('L', 'A4');
           PDF::writeHTML($html_content,true,false,true,false,'');
           $a = date("Y-m-d h:i:sa");
           PDF::Output('Hasil_Perhitungan'.$a.'.pdf');

        }else{
          return redirect()->route('view-mahasiswa')->with('error', 'Data Mahasiswa Belum dihitung, Hitung data mahasiswa terlebih dahulu');
        }
        // return $image_file;
      }

      function analisaData(){
        $mahasiswa = nilai_mahasiswa::select('nim','id_kriteria','nilai')->first();

        if(isset($mahasiswa)){
          $nilaimahasiswa = nilai_mahasiswa::select('nim','id_kriteria','nilai')->get();

          foreach ($nilaimahasiswa as $key => $value) {
            $name1 = $value->nim;
            $name2 = $value->id_kriteria;

            $rows[$name1][$name2]=$value->nilai;
          }

          return $rows;

        }else{
          $nilaimahasiswa = nilai_mahasiswa::select('nim','id_kriteria','nilai')->get();
          return $nilaimahasiswa;
        }

      }

      function HasilNormalisasi($kriteria){
        // $nilai = nilai_mahasiswa::with('kearahkriteria')->get();
        // return $nilai;

        $mahasiswa = nilai_mahasiswa::select('nim','id_kriteria','nilai')->first();

        if(isset($mahasiswa)){

          $nilaimahasiswa = nilai_mahasiswa::with('kearahkriteria')->select('nim','id_kriteria','nilai')->get();
           //return $nilaimahasiswa;
            foreach ($nilaimahasiswa as $key => $value) {
              $name1 = $value->nim;
              $name2 = $value->id_kriteria;
              $rows[$name1][$name2]=$value->nilai;
            }

            $results = array();
            foreach ($kriteria as $id) {
              $k = array();
              foreach ($rows as $krit) {
                if(isset($krit[$id->id]) == false){
                  $a = 0;
                }else{
                  $a = pow($krit[$id->id],2);
                }
                  array_push($k, $a);
              }
              $results["$id->id"] = $k;
              //array_push($results, $k);
              unset($k);
              unset($a);
            }
            //return $results;

            $hasil = array();
              foreach ($results as $key => $value){
                  $hasil["kriteria$key"] = sqrt(array_sum($value));
              }
            //return $hasil;

            foreach ($nilaimahasiswa as $key => $value) {
              $name1 = $value->nim;
              $name2 = $value->id_kriteria;

              if($rows[$name1][$name2] == 0 && $hasil["kriteria$value->id_kriteria"]== 0){
                $hasilnormalisasi[$name1][$name2]=0;
              }else{
                $hasilnormalisasi[$name1][$name2]=$rows[$name1][$name2]/$hasil["kriteria$value->id_kriteria"];
              }
            }
          return $hasilnormalisasi;

        }else{

          $nilaimahasiswa = nilai_mahasiswa::select('nim','id_kriteria','nilai')->get();
          return $nilaimahasiswa;

        }

      }

      function NormalisasiTerbobot($kriteria){
        $mahasiswa = nilai_mahasiswa::select('nim','id_kriteria','nilai')->first();

        if(isset($mahasiswa)){
            $nilaimahasiswa = nilai_mahasiswa::select('nim','id_kriteria','nilai')->get();

            foreach ($nilaimahasiswa as $key => $value) {
              $name1 = $value->nim;
              $name2 = $value->id_kriteria;
              $rows[$name1][$name2]=$value->nilai;
            }


            $results = array();
            foreach ($kriteria as $id) {
              $k = array();
              foreach ($rows as $krit) {
                if(isset($krit[$id->id]) == false){
                  $a = 0;
                }else{
                  $a = pow($krit[$id->id],2);
                }
                array_push($k, $a);
                unset($a);
              }
              $results["$id->id"] = $k;
              unset($k);

            }

            $hasil = array();
            foreach ($results as $key => $value) {

              $hasil["kriteria$key"] = sqrt(array_sum($value));
            }

            foreach ($nilaimahasiswa as $key => $value) {
                $name1 = $value->nim;
                $name2 = $value->id_kriteria;
                $nilaibobot = $this->nilaibobot($value->id_kriteria);

                if($rows[$name1][$name2] == 0 && $hasil["kriteria$value->id_kriteria"] == 0){
                  $hasilnormalisasiterbobot[$name1][$name2]=0;
                }else{
                  $hasilnormalisasiterbobot[$name1][$name2]=($rows[$name1][$name2]/$hasil["kriteria$value->id_kriteria"])*$nilaibobot->bobot;
                }
            }
            return $hasilnormalisasiterbobot;

            }else{

            $nilaimahasiswa = nilai_mahasiswa::select('nim','id_kriteria','nilai')->get();
            return $nilaimahasiswa;

          }

        }
      function NormalisasiTerbobotMax($kriteria){
          $mahasiswa = nilai_mahasiswa::select('nim','id_kriteria','nilai')->first();

          if(isset($mahasiswa)){
              $nilaimahasiswa = kriteria::where('jenis','=','benefit')->get();

              foreach ($nilaimahasiswa as $key => $value) {
                  $nilaimahasiswa2 = nilai_mahasiswa::where('id_kriteria','=',$value->id)->get();

                  foreach ($nilaimahasiswa2 as $key => $value) {
                    $name1 = $value->nim;
                    $name2 = $value->id_kriteria;

                    $rows[$name1][$name2]=$value->nilai;
                  }
              }

              // return $nilaimahasiswa2;


              //return $rows;

              $results = array();
              foreach ($kriteria as $id) {
                $k = array();
                foreach ($rows as $krit) {
                  if(isset($krit[$id->id]) == false){
                    $a = 0;
                  }else{
                    $a = pow($krit[$id->id],2);
                  }
                  array_push($k, $a);
                  unset($a);
                }
                $results["$id->id"] = $k;
                unset($k);

              }
              //return $results;
              $hasil = array();
              foreach ($results as $key => $value) {

                $hasil["kriteria$key"] = sqrt(array_sum($value));
              }
              // return $hasil;
              foreach ($nilaimahasiswa as $key => $value) {
                $nilaimahasiswa2 = nilai_mahasiswa::where('id_kriteria','=',$value->id)->get();
                foreach ($nilaimahasiswa2 as $key => $value) {
                  $name1 = $value->nim;
                  $name2 = $value->id_kriteria;
                  $nilaibobot = $this->nilaibobot($value->id_kriteria);
                  $hasilnormalisasiterbobot[$name1][$name2]=($rows[$name1][$name2]/$hasil["kriteria$value->id_kriteria"])*$nilaibobot->bobot;

                }
              }
                if(empty($hasilnormalisasiterbobot)){
                  return $hasilnormalisasiterbobot = array();
                }
                return $hasilnormalisasiterbobot;

              }else{

              $nilaimahasiswa = nilai_mahasiswa::select('nim','id_kriteria','nilai')->get();
              return $nilaimahasiswa;

            }

          }

      function nilaibobot($id_kriteria){
          return $kriteriabobot = kriteria::select('bobot','id')->where('id','=',$id_kriteria)->first();
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
