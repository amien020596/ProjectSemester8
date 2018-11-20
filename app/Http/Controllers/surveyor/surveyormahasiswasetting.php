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
      $userprofile = user_profile::with('user')->where('user_id',Auth::user()->id)->first();
      $datamahasiswa = datamahasiswa::with('fakultas')->with('jurusan')->where('id_user','=', Auth::user()->id)->get();
      //return $datamahasiswa;
      $kriteria = kriteria::all();
      $data = array(
        'Dmahasiswa'=>$datamahasiswa,
        'kriteria'=>$kriteria,
        'user'=>$userprofile,
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
      $userprofile = user_profile::with('user')->where('user_id',Auth::user()->id)->first();

        $data = datafakultas::all();
        $kriteria = kriteria::all();
        $data = [
          'user'=>$userprofile,
          'Dfakultas'=>$data,
          'Dkritria'=>$kriteria
        ];
        return view('surveyor.formmahasiswa',$data);
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
      $userprofile = user_profile::with('user')->where('user_id',Auth::user()->id)->first();
      $data = ['user'=>$userprofile];
      return view('surveyor.passwordsetting',$data);
    }
    public function savepassword(Request $request){

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
                ]);

                $user_profile = user_profile::where('user_id',Auth::user()->id);
                $user_profile->update([
                  'firstname'=>$request->firstname,
                  'lastname'=>$request->lastname,
                  'address'=>$request->address,
                  'picture'=>$picture
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
      $mahasiswa = datamahasiswa::where('nim',$id)->first();
      $fakultas = datafakultas::all();
      $jurusan = datajurusan::where('id',$mahasiswa->id_jurusan)->first();
      // return $jurusan;
      $kriteria = kriteria::all();
      $userprofile = user_profile::with('user')->where('user_id',Auth::user()->id)->first();
      $data = [
        'mahasiswa'=>$mahasiswa,
        'Dfakultas'=>$fakultas,
        'Djurusan'=>$jurusan,
        'Dkritria'=>$kriteria,
        'user'=>$userprofile
      ];
      return view('surveyor.ubahmahasiswa')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nim)
    {
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
              return redirect()->route('ubah-mahasiswa-surveyor',['id'=>$nim])->with('error', 'Kolom Fakultas Tidak Boleh Kosong');
            }

            if($request->jurusan == 0){
              return redirect()->route('ubah-mahasiswa-surveyor',['id'=>$nim])->with('error', 'Kolom Jurusan Tidak Boleh Kosong');
            }
            $s=8;
            if($request->$s >= 5){
              return redirect()->route('ubah-mahasiswa-surveyor',['id'=>$nim])->with('error', 'Nilai Kolom HM Rumah Tidak lebih dari 4 ');
            }
            $s=11;
            if($request->$s >= 4){
              return redirect()->route('ubah-mahasiswa-surveyor',['id'=>$nim])->with('error', 'Nilai Kolom Dinding Tidak Lebih dari 3 ');
            }

            $nilaiforceDelete = nilai_mahasiswa::where('nim',$nim)->forceDelete();
            $datamahasiswa = datamahasiswa::where('nim', $nim)->update([
              'nim'=>$request->nim,
              'nama'=>$request->nama,
              'id_fakultas'=>$request->fakultas,
              'id_jurusan'=>$request->jurusan
            ]);

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
              return redirect()->route('view-mahasiswa-surveyor')->with('error', 'Update Data Mahasiswa Failed');
            }
            return redirect()->route('view-mahasiswa-surveyor')->with('success', 'Update Data Mahasiswa Success');
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
        return redirect()->route('view-mahasiswa-surveyor')->with('error', 'The NIM does not exist');
      }
      $mahasiswa = datamahasiswa::where('nim',$id)->delete();
      $nilai_mahasiswa = nilai_mahasiswa::where('nim',$id)->delete();
      return redirect()->route('view-mahasiswa-surveyor')->with('success', 'Delete Data Mahasiswa Success');
    }
}
