<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\nilai_mahasiswa;
use App\kriteria;
use App\datamahasiswa;
use App\hasilbobot;
use PDF;

class PerhitunganMoora extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

      public function PerhitunganHasilAnalisaData(){
              $kriteria = kriteria::select('id','kriteria')->get();
              $nim = nilai_mahasiswa::select('nim')->groupBy('nim')->having('nim', '>',0)->get();
              $rows = $this->analisaData();
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

         $hasilnormalisasi = $this->HasilNormalisasi($kriteria, $nilaimahasiswa);

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

         $hasilnormalisasiterbobot = $this->NormalisasiTerbobot($nilaimahasiswa,$kriteria);

         $data = [
           'kriteria'=>$kriteria,
           'nilai'=>$hasilnormalisasiterbobot,
           'id'=>$nim
         ];

         return view('admin/Pmoora3')->with($data);
       }
      public function nilaioptimasiterbobotYi(){
         $kriteria = kriteria::select('id','kriteria','jenis','bobot')->get();
         $nilaimahasiswa = nilai_mahasiswa::select('nim','id_kriteria','nilai')->get();
         $nim = nilai_mahasiswa::select('nim')->groupBy('nim')->having('nim', '>',0)->get();

         $hasilnormalisasiterbobot = $this->NormalisasiTerbobot($nilaimahasiswa,$kriteria);
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

        return view('admin/Pmoora4')->with($data);
       }
      public function nilairating(){
         $kriteria = kriteria::select('id','kriteria','jenis','bobot')->get();
         $nilaimahasiswa = nilai_mahasiswa::select('nim','id_kriteria','nilai')->get();
         // $nim = nilai_mahasiswa::select('nim')->groupBy('nim')->having('nim', '>',0)->get();
         $nim = datamahasiswa::select('nim')->get();

         $hasilnormalisasiterbobot = $this->NormalisasiTerbobot($nilaimahasiswa,$kriteria);

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
          return view('admin/Pmoora5')->with($data);}
      public function print(){
        $hasilbobot = hasilbobot::orderBy('nilai','ASC')->get();
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

        PDF::SetTitle('Sample PDF');
        PDF::SetAuthor('Bidikmisi');
        PDF::SetMargins(20, 45, 20, 10);
        PDF::AddPage('L', 'A4');
        PDF::writeHTML($html_content,true,false,true,false,'');
        PDF::Output(uniqid().'_SamplePDF.pdf');
        // return $image_file;
      }

      function analisaData(){
        $nilaimahasiswa = nilai_mahasiswa::select('nim','id_kriteria','nilai')->get();
        foreach ($nilaimahasiswa as $key => $value) {
          $name1 = $value->nim;
          $name2 = $value->id_kriteria;
          $rows[$name1][$name2]=$value->nilai;
        }
        return $rows;
      }
      function HasilNormalisasi($kriteria, $nilaimahasiswa ){
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
             return $hasilnormalisasi;
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
      function NormalisasiTerbobot($nilaimahasiswa,$kriteria){
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
          return $hasilnormalisasiterbobot;
        }
}
