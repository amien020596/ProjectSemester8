<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\user_profile;
use App\nilai_mahasiswa;
use App\datamahasiswa;
use Storage;
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

      // $surveyor = new User;
      // $surveyor->where('user_id',1);
      // $surveyor->profile();
      //$surveyor = $admin::surveyor()->select('fullname','picture')->where('user_id',Auth::user()->id)->get();
      $surveyor = User::with('profile')->where('role','surveyor')->get();
      //return $surveyor;
      return view('admin.surveyor')->with('Dsurveyor',$surveyor);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.addsurveyor');
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
            'no_hp'=>'required|numeric',
            'email'=>'required|email',
            'address'=>'required',
            'password'=>'required|min:6',
            'file'=>'required|image|mimes:jpeg,bmp,png'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $ext = $request->file('file')->getClientOriginalExtension();
        $filename = str_slug(strtolower($request->firstname)).'-.'.$ext;
        $picture = $request->file('file')->storeAs('Filepicture',$filename);

      $user = User::create([
        'name' => $request->firstname,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => 'surveyor',
        'picture' => $picture
      ]);

      $getid = User::where('email',$request->email)->first();
      $user_profile = user_profile::create([
        'firstname' => $request->firstname,
        'lastname' => $request->lastname,
        'no_hp' => $request->no_hp,
        'address' => $request->address,
        'user_id' => $getid->id
      ]);
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
      //return $surveyor;
      return view('admin.updatesurveyor')->with('Dsurveyor',$surveyor);
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
            'no_hp'=>'required|numeric',
            'email'=>'required|email',
            'address'=>'required',
            'file'=>'required|image|mimes:jpeg,bmp,png'
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

        if(User::find($id)->picture){
          Storage::delete(User::find($id)->picture);
        }

        $ext = $request->file('file')->getClientOriginalExtension();
        $filename = str_slug(strtolower($request->firstname)).'-'.$id.'.'.$ext;
        $picture = $request->file('file')->storeAs('Filepicture',$filename);

        $user = User::where('id',$id);
        $user->update([
          'email'=>$request->email,
          'picture'=>$picture
        ]);

        $user_profile = user_profile::where('user_id',$id);
        $user_profile->update([
          'firstname'=>$request->firstname,
          'lastname'=>$request->lastname,
          'no_hp'=>$request->no_hp,
          'address'=>$request->address
        ]);

          return redirect()->route('view-surveyor')->with('success', 'Update Data Success');

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

        $nilai_mahasiswa = nilai_mahasiswa::where('id_user',$id)->delete();
        $mahasiswa = datamahasiswa::where('id_user',$id)->delete();

        return redirect()->route('view-surveyor')->with('success', 'Delete Account Success');
    }
}
