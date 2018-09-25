<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\User;
use App\user_profile;
use App\nilai_mahasiswa;
use App\datamahasiswa;
use Storage;
use Auth;
use Validator;
class AdminSettingSurveyor extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $surveyor = User::with('profile')->where('role','surveyor')->get();
      $admin = user_profile::with('user')->where('user_id',Auth::user()->id)->first();
      $data = [
        'admin'=>$admin,
        'Dsurveyor'=>$surveyor
      ];

      // return view('admin.surveyor')->with('Dsurveyor',$surveyor);
      return view('admin.surveyor',$data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $admin = user_profile::with('user')->where('user_id',Auth::user()->id)->first();
      $data = ['admin'=>$admin];
      return view('admin.addsurveyor',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
            'firstname'=>'required|alpha',
            'lastname'=>'required|alpha',
            'username'=>'required|alpha',
            'email'=>'required|email|unique:users,email',
            'address'=>'required',
            'password'=>'required|confirmed|min:6',
            'file'=>'required|image|mimes:jpeg,bmp,png'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
      $user = User::create([
        'name' => $request->username,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => 'surveyor'
      ]);

      $getid = User::where('email',$request->email)->first();

      $ext = $request->file('file')->getClientOriginalExtension();
      $filename = str_slug(strtolower($request->firstname)).'-'.$getid->id.'.'.$ext;
      $picture = $request->file('file')->storeAs('Filepicture',$filename);

      $user_profile = user_profile::create([
        'firstname' => $request->firstname,
        'lastname' => $request->lastname,
        'address' => $request->address,
        'user_id' => $getid->id,
        'picture' => $picture
      ]);
      // $user_profile = DB::table('user_profiles')->insert([
      //
      //                 ]);

      if($user == false || $user_profile == false){
            return redirect()->route('view-surveyor')->with('error', 'Add Data Surveyor Failed');
      }

      return redirect()->route('view-surveyor')->with('success', 'Add Data Surveyor Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      //id yang digunakan adalah id tabel user
      $surveyor = user_profile::with('user')->where('user_id',$id)->first();
      //return $surveyor;
      return view('admin.detailsurveyor')->with('Dsurveyor',$surveyor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
      //id yang digunakan adalah id tabel user
      $surveyor = user_profile::with('user')->where('user_id',$id)->first();
      $admin = user_profile::with('user')->where('user_id',Auth::user()->id)->first();
      $data = ['admin'=>$admin,'Dsurveyor'=>$surveyor];
      //return $surveyor;
      return view('admin.updatesurveyor')->with($data);
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
      $validator = Validator::make($request->all(), [
            'firstname'=>'required|alpha',
            'lastname'=>'required|alpha',
            'username'=>'required|alpha',
            'email'=>'required|email',
            'address'=>'required',
            // 'file'=>'required|image|mimes:jpeg,bmp,png'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $users = user_profile::where('user_id', $id)->first();

        if(!isset($users)){
          return redirect()->route('view-surveyor')->with('error', 'The id does not exist');
        }
        $user;
        $user_profile;

        if($request->file === null){
            // $ext = $request->file('file')->getClientOriginalExtension();
            // $filename = str_slug(strtolower($request->firstname)).'-'.$id.'.'.$ext;
            // $picture = $request->file('file')->storeAs('Filepicture',$filename);

            $user = User::where('id',$id);
            $user->update([
              'email'=>$request->email,
              'name'=>$request->username,
            ]);

            $user_profile = user_profile::where('user_id',$id);
            $user_profile->update([
              'firstname'=>$request->firstname,
              'lastname'=>$request->lastname,
              'address'=>$request->address,
            ]);
        }else{

            if(User::find($id)->picture){
              Storage::delete(User::find($id)->picture);
            }

            $ext = $request->file('file')->getClientOriginalExtension();
            $filename = str_slug(strtolower($request->firstname)).'-'.$id.'.'.$ext;
            $picture = $request->file('file')->storeAs('Filepicture',$filename);

            $user = User::where('id',$id);
            $user->update([
              'email'=>$request->email,
              'name'=>$request->username,
            ]);

            $user_profile = user_profile::where('user_id',$id);
            $user_profile->update([
              'firstname'=>$request->firstname,
              'lastname'=>$request->lastname,
              'address'=>$request->address,
              'picture'=>$picture
            ]);
        }
          if($user === false || $user_profile === false){
            return redirect()->route('view-surveyor')->with('error', 'Update Data Failed');
          }else{
              return redirect()->route('view-surveyor')->with('success', 'Update Data Success');
          }

     }


    public function resetpassword($id)
    {
        $users = User::where('id', $id)->first();
        if(!isset($users)){
          return redirect()->route('view-surveyor')->with('error', 'The id does not exist');
        }

        $user = User::find($id);
        $user->update([
          'password'=>bcrypt('password')
        ]);
          return redirect()->route('view-surveyor')->with('success', 'Reset Password Success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = User::find($id)->first();

        if(!isset($users)){
          return redirect()->route('view-surveyor')->with('error', 'The id does not exist');
        }

        $user = User::where('id',$id)->delete();
        $user_profile = user_profile::where('user_id',$id)->delete();

        // $nilai_mahasiswa = nilai_mahasiswa::where('id_user',$id)->delete();
        // $mahasiswa = datamahasiswa::where('id_user',$id)->delete();

        return redirect()->route('view-surveyor')->with('success', 'Delete Account Success');
    }
}
