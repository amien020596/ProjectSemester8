<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class ResetPasswordController extends Controller 
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function cekRole($email){
      //return User::select('role')->where('email',$email)->first();
      return DB::table('users')->select('role')->where('email',$email)->first();
    }

    protected function resetPassword($user, $password)
    {

        $user->password = Hash::make($password);

        $user->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));


        $role = $this->cekRole($user->email);

            //dd($role->role);
            switch ($role->role) {
              case 'admin':
                $guard = "admin";
                $this->redirectTo = '/admin-home';
                break;

              default:
                $guard = "web";
                $this->redirectTo = '/home';
                break;
            }

        Auth::guard($guard)->login($user);
    }
}
