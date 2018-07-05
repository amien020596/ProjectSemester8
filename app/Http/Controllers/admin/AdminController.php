<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;
use App\user_profile;
use Auth;
use App\Http\Controllers\Controller;
use Validator;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('view-mahasiswa');
    }
    public function settingprofile(){
      $admin = user_profile::with('user')->where('user_id',Auth::user()->id)->first();
      $data = ['admin'=>$admin];
      //return $admin;
      return view('admin.profile',$data);
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
            return redirect()->route('admin-setting')->with('error', 'The id does not exist');
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

                    return redirect()->route('admin-setting')->with('success', 'Update Data Success');
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
            return redirect()->route('admin-setting')->with('error', 'The Username does not exist');
          }

          $user = User::where('id',Auth::user()->id);
          $user->update([
            'password'=>bcrypt($request->password)
          ]);

          if($user == false){
                return redirect()->route('admin-setting')->with('error', 'Update Password Admin Failed');
          }
          return redirect()->route('admin-setting')->with('success', 'Update Password Admin Success');
      }
  }
