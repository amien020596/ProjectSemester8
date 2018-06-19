<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\datamahasiswa;
use App\datafakultas;
use App\datajurusan;
use App\nilai_mahasiswa;
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
    public function index()
    {
      //$mahasiswa = DB::table('datamahasiswas')->select('datamahasiswas.nim','datamahasiswas.nama')->get();
      //$mahasiswa = DB::table('datafakultas')->select('datafakultas.fakultas','datafakultas.id')->get();
      $mahasiswa = DB::table('datamahasiswas')->select('datamahasiswas.nim','datamahasiswas.nama','datajurusans.jurusan','datafakultas.fakultas')->join('datafakultas','datamahasiswas.id_fakultas','=','datafakultas.id')->join('datajurusans', 'datamahasiswas.id_jurusan', '=', 'datajurusans.id')->get();
      //return $mahasiswa;
      return view('admin.mahasiswa')->with('Dmahasiswa',$mahasiswa);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = datafakultas::all();
        $kriteria = kriteria::all();
        //return $kriteria;
        return view('admin/addmahasiswa',['Dfakultas'=>$data,'Dkritria'=>$kriteria]);
    }
    public function selectfakultas(){
      $fakultas_id = Input::get('fakultas_id');
      $jurusan = datajurusan::where('id_fakultas', '=', $fakultas_id)->get();
      return response()->json($jurusan);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $kriteria = kriteria::all();
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

      $datamahasiswa = datamahasiswa::where('nim', $request->nim)->first();

      if($datamahasiswa || $request->nim == null){
        return redirect()->route('insert-mahasiswa')->with('error', 'The NIM Already Used or NIM no Null');
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
            'id_jurusan'=>$request->jurusan
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
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mahasiswa = datamahasiswa::find($id)->first();
        $data = datafakultas::all();
        return view('admin.updatemahasiswa')->with('Dmahasiswa',$mahasiswa);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
      $mahasiswa = datamahasiswa::find($id)->first();
      if(!isset($mahasiswa)){
        return redirect()->route('view-mahasiswa')->with('error', 'The NIM does not exist');
      }
      $mahasiswa = datamahasiswa::where('nim',$id)->delete();
      return redirect()->route('view-mahasiswa')->with('success', 'Delete Data Mahasiswa Success');
    }
}
