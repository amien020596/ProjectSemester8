<?php

namespace App\Http\Controllers\surveyor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\datafakultas;
use App\datajurusan;
use App\kriteria;
use App\datamahasiswa;
use App\nilai_mahasiswa;
use App\user_profile;
use App\User;
use Illuminate\Support\Facades\DB;
use Validator;
use Auth;
class surveyormahasiswasetting extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
         $this->middleware('auth:web');
     }
    public function index()
    {
      $datamahasiswa = DB::table('datamahasiswas')->where('id_user','=', Auth::user()->id)->select('datamahasiswas.nim','datamahasiswas.nama','datajurusans.jurusan','datafakultas.fakultas')->join('datafakultas','datamahasiswas.id_fakultas','=','datafakultas.id')->join('datajurusans', 'datamahasiswas.id_jurusan', '=', 'datajurusans.id')->get();
      $kriteria = kriteria::all();
      $data = array(
        'Dmahasiswa'=>$datamahasiswa,
        'kriteria'=>$kriteria
      );
        return view('surveyor.viewmahasiswa')->with($data);
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
        return view('surveyor.formmahasiswa',['Dfakultas'=>$data,'Dkritria'=>$kriteria]);
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
        return redirect()->route('insert-mahasiswa-surveyor')->with('error', 'The NIM Already Used or NIM Null');
      }

      if($request->fakultas == 0){
        return redirect()->route('insert-mahasiswa-surveyor')->with('error', 'Kolom Fakultas Tidak Boleh Kosong');
      }

      if($request->jurusan == 0){
        return redirect()->route('insert-mahasiswa-surveyor')->with('error', 'Kolom Jurusan Tidak Boleh Kosong');
      }
      $s=8;
      if($request->$s >= 5){
        return redirect()->route('insert-mahasiswa-surveyor')->with('error', 'Nilai Kolom HM Rumah Tidak lebih dari 4 ');
      }
      $s=11;
      if($request->$s >= 4){
        return redirect()->route('insert-mahasiswa-surveyor')->with('error', 'Nilai Kolom Dinding Tidak Lebih dari 3 ');
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
            return redirect()->route('insert-mahasiswa-surveyor')->with('error', 'Insert Data Mahasiswa Failed');
          }
          return redirect()->route('view-mahasiswa-surveyor')->with('success', 'Insert Data Mahasiswa Success');
    }
    public function settingpassword(){
      return view('surveyor.passwordsetting');
    }
    public function storepassword(Request $request){

      $validator = Validator::make($request->all(), [
            'password'=>'required|confirmed|min:6'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $users = User::where('id', Auth::user()->id)->first();

        if(!isset($users)){
          return redirect()->route('password-mahasiswa-surveyor')->with('error', 'The id does not exist');
        }

        $user = User::where('id',Auth::user()->id);
        $user->update([
          'password'=>bcrypt($request->password)
        ]);

        if($user == false){
              return redirect()->route('password-mahasiswa-surveyor')->with('error', 'Update Password Surveyor Surveyor Failed');
        }
        return redirect()->route('password-mahasiswa-surveyor')->with('success', 'Update Password Surveyor Success');
    }
    public function settingprofile(){
      $userprofile = user_profile::with('user')->where('user_id',Auth::user()->id)->first();
      $data = array(
        'user'=>$userprofile
      );
      //return $data;
      return view('surveyor.profilesetting')->with($data);
    }
    public function saveprofile(Request $request){
      $validator = Validator::make($request->all(), [
            'firstname'=>'required|alpha',
            'lastname'=>'required|alpha',
            'email'=>'required|email',
            'address'=>'required',
            'file'=>'required|image|mimes:jpeg,bmp,png'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $users = user::where('id',Auth::user()->id)->first();
        if(!isset($users)){
          return redirect()->route('profile-mahasiswa-surveyor')->with('error', 'The id does not exist');
        }
                $id = Auth::user()->id;
                $ext = $request->file('file')->getClientOriginalExtension();
                $filename = str_slug(strtolower($request->firstname)).'-'.$id.'.'.$ext;
                $picture = $request->file('file')->storeAs('Filepicture',$filename);

                $user = User::where('id',Auth::user()->id);
                $user->update([
                  'email'=>$request->email,
                  'picture'=>$picture
                ]);

                $user_profile = user_profile::where('user_id',Auth::user()->id);
                $user_profile->update([
                  'firstname'=>$request->firstname,
                  'lastname'=>$request->lastname,
                  'address'=>$request->address
                ]);

                  return redirect()->route('profile-mahasiswa-surveyor')->with('success', 'Update Data Success');

    }
    public static function ambilnilai($nim,$id_kriteria){
      $nilai = nilai_mahasiswa::select('nilai')->where('id_kriteria','=',$id_kriteria)->where('nim','=',$nim)->first();
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
