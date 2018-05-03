<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\User;
use App\user_profile;
use Auth;
use App\Http\Controllers\Controller;

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
      return view('admin.dashboard');
  }
  public function profile(){
    // $admin = new App\User;
     // $admin = user::select('name','role')->where('id','=',Auth::id())->first();
     // $admin = User::profile()->select('fullname','picture')->where('user_id',Auth::user()->id)->get();
     //$admin = User::find(1)->profile()->select('fullname','picture')->first();
     $admin = User::find(1)->profile()->first();
    // $admin = Auth::id();
     //return view('testerdata.test',['admin'=>$admin]);
    return view('admin.profile',['admin'=>$admin]);
  }
  public function settingprofile(){
    return "ini setting profile";
  }
}
