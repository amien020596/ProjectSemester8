<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\datamahasiswa;
use App\datafakultas;
use App\datajurusan;
use App\nilai_mahasiswa;
use App\hasilbobot;
use App\user_profile;
use App\kriteria;
use Illuminate\Support\Facades\DB;
use Validator;
use Auth;

class adminMahasiswasetting extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
         $this->middleware('auth:admin');
     }
      public function index(){
        $admin = user_profile::with('user')->where('user_id',Auth::user()->id)->first();
        $mahasiswa = datamahasiswa::with('fakultas')->with('jurusan')->get();
        $data = ['admin'=>$admin,'Dmahasiswa'=>$mahasiswa];
        return view('admin.mahasiswa',$data);

      }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $data = datafakultas::all();
        $kriteria = kriteria::all();
        $admin = user_profile::with('user')->where('user_id',Auth::user()->id)->first();
        //return $kriteria;
        $data = ['Dfakultas'=>$data,'Dkritria'=>$kriteria,'admin'=>$admin];
        return view('admin.addmahasiswa',$data);
    }

    public function selectfakultas(){
      $fakultas_id = Input::get('fakultas_id');
      $jurusan = datajurusan::where('id_fakultas', '=', $fakultas_id)->get();
      // return $jurusan;
      return response()->json($jurusan);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
      $kriteria = kriteria::all();
        $validator = Validator::make($request->all(), [
              'nama'=>'required',
              'nim'=>'required',
              'fakultas'=>'required',
              'jurusan'=>'required',

          ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

      $datamahasiswa = datamahasiswa::where('nim', $request->nim)->first();

      if($datamahasiswa || $request->nim == null){
        return redirect()->route('insert-mahasiswa')->with('error', 'The NIM Already Used or NIM Null');
      }

      if($request->fakultas == 0){
        return redirect()->route('insert-mahasiswa')->with('error', 'Kolom Fakultas Tidak Boleh Kosong');
      }

      if($request->jurusan == 0){
        return redirect()->route('insert-mahasiswa')->with('error', 'Kolom Jurusan Tidak Boleh Kosong');
      }
      $s=8;
      if($request->$s >= 5){
        return redirect()->route('insert-mahasiswa')->with('error', 'Nilai Kolom HM Rumah Tidak lebih dari 4 ');
      }
      $s=11;
      if($request->$s >= 4){
        return redirect()->route('insert-mahasiswa')->with('error', 'Nilai Kolom Dinding Tidak Lebih dari 3 ');
      }

          $datamahasiswa = datamahasiswa::create([
            'nim'=>$request->nim,
            'nama'=>$request->nama,
            'id_fakultas'=>$request->fakultas,
            'id_jurusan'=>$request->jurusan,
            'id_user'=>Auth::user()->id
          ]);

          foreach ($kriteria as $key => $value) {
            $a = $value->id;
            if($request->$a == null){
              $request->$a = 0;
            }
            $nilai = nilai_mahasiswa::create([
            'id_kriteria'=>$value->id,
            'nilai'=>$request->$a,
            'nim'=>$request->nim,
            'id_user'=>Auth::user()->id
            ]);
          }

          if($datamahasiswa != True || $nilai != True){
            //ini perlu diperbaiki lagi
            return redirect()->route('insert-mahasiswa')->with('error', 'Insert Data Mahasiswa Failed');
          }
          return redirect()->route('view-mahasiswa')->with('success', 'Insert Data Mahasiswa Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nim){
      $mahasiswa = datamahasiswa::where('nim',$nim)->first();
      $fakultas = datafakultas::find($mahasiswa->id_fakultas)->select('fakultas')->first();
      $jurusan = datajurusan::find($mahasiswa->id_jurusan)->select('jurusan')->first();
      $kriteria = kriteria::all();
      $admin = user_profile::with('user')->where('user_id',Auth::user()->id)->first();
      $data = [
        'mahasiswa'=>$mahasiswa,
        'Dfakultas'=>$fakultas,
        'Djurusan'=>$jurusan,
        'kriteria'=>$kriteria,
        'admin'=>$admin
      ];
      return view('admin.detailmahasiswa')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nim){

        $mahasiswa = datamahasiswa::where('nim',$nim)->first();
        $fakultas = datafakultas::where('id',$mahasiswa->id_fakultas)->first();
        $jurusan = datajurusan::where('id',$mahasiswa->id_jurusan)->first();
        $kriteria = kriteria::all();
        $fakultasAll = datafakultas::all();
        $admin = user_profile::with('user')->where('user_id',Auth::user()->id)->first();
        $data = [
          'mahasiswa'=>$mahasiswa,
          'Dfakultas'=>$fakultas,
          'DF'=>$fakultasAll,
          'Djurusan'=>$jurusan,
          'kriteria'=>$kriteria,
          'admin'=>$admin
        ];
        //return $data;
        return view('admin.updatemahasiswa')->with($data);
    }

    public static function ambilnilai($nim,$id_kriteria){
      $nilai = nilai_mahasiswa::select('nilai')->where('id_kriteria','=',$id_kriteria)->where('nim','=',$nim)->first();
        return $nilai;
      }
      /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
      $validator = Validator::make($request->all(), [
            'nama'=>'required',
            'nim'=>'required',
            'fakultas'=>'required',
            'jurusan'=>'required'
        ]);

      if ($validator->fails()) {
          return redirect()->back()
                      ->withErrors($validator)
                      ->withInput();
      }

            if($request->fakultas == 0){
              return redirect()->route('edit-mahasiswa',['id'=>$id])->with('error', 'Kolom Fakultas Tidak Boleh Kosong');
            }

            if($request->jurusan == 0){
              return redirect()->route('edit-mahasiswa',['id'=>$id])->with('error', 'Kolom Jurusan Tidak Boleh Kosong');
            }
            $s=8;
            if($request->$s >= 5){
              return redirect()->route('edit-mahasiswa',['id'=>$id])->with('error', 'Nilai Kolom HM Rumah Tidak lebih dari 4 ');
            }
            $s=11;
            if($request->$s >= 4){
              return redirect()->route('edit-mahasiswa',['id'=>$id])->with('error', 'Nilai Kolom Dinding Tidak Lebih dari 3 ');
            }

            $datamahasiswa = datamahasiswa::where('nim', $id)->update([
              'nim'=>$request->nim,
              'nama'=>$request->nama,
              'id_fakultas'=>$request->fakultas,
              'id_jurusan'=>$request->jurusan
            ]);

            $nilaiforceDelete = nilai_mahasiswa::where('nim',$id)->forceDelete();
            $kriteria = kriteria::all();
            foreach ($kriteria as $key => $value) {
              $a = $value->id;
              if($request->$a == null){
                $request->$a = 0;
              }

              $nilai = nilai_mahasiswa::create([
              'id_kriteria'=>$value->id,
              'nilai'=>$request->$a,
              'nim'=>$request->nim,
              'id_user'=>Auth::user()->id
              ]);
            }

            if($datamahasiswa != True || $nilai != True){
              //ini perlu diperbaiki lagi
              return redirect()->route('view-mahasiswa')->with('error', 'Update Data Mahasiswa Failed');
            }
            return redirect()->route('view-mahasiswa')->with('success', 'Update Data Mahasiswa Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id){
      $mahasiswa = datamahasiswa::find($id)->first();
      if(!isset($mahasiswa)){
        return redirect()->route('view-mahasiswa')->with('error', 'The NIM does not exist');
      }
      $mahasiswa = datamahasiswa::where('nim',$id)->delete();
      $nilai_mahasiswa = nilai_mahasiswa::where('nim',$id)->delete();
      $hasilbobot = hasilbobot::where('nim',$id)->delete();
      return redirect()->route('view-mahasiswa')->with('success', 'Delete Data Mahasiswa Success');
    }
}
