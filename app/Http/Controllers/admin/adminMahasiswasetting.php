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
      // $validator = Validator::make($request->all(), [
      //       'nim'=>'required',
      //       'id_kriteria'=>'required|alpha',
      //       'nilai'=>'required|numeric|between:1,5'
      //       'id_user'=>'required|numeric|between:1,5'
      //   ]);
      $kriteria = kriteria::all();

        // if ($validator->fails()) {
        //     return redirect()->back()
        //                 ->withErrors($validator)
        //                 ->withInput();
        // }
        //
        // $kriteria = kriteria::create([
        //   'kriteria'=>$request->kriteria,
        //   'jenis'=>$request->jenis,
        //   'bobot'=>$request->bobot,
        // ]);
        //
        // if($kriteria == false){
        //   return redirect()->route('view-kriteria')->with('error', 'Insert Data Kriteria Failed');
        // }
        // return redirect()->route('view-kriteria')->with('success', 'Insert Data Kriteria Success');


          foreach ($kriteria as $key => $value) {
            $a = $value->id;
            $nilai = nilai_mahasiswa::create([
            'id_kriteria'=>$value->id,
            'nilai'=>$request->$a,
            'nim'=>$request->nim,
            'id_user'=>1
            ]);
          }

        return $nilai;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
}
