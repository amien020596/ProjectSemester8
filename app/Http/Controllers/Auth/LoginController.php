<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use App\User;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string|exists:users,email',
            'password' => 'required|string',
        ]); // ini untuk validasi input username/email dan password

        // dd($ada);
    }

    public function cekRole($email){
      //return User::select('role')->where('email',$email)->first();
      return DB::table('users')->select('role')->where('email',$email)->first();
    }

    // protected function login(Request $request)
    // {
    //     $this->validateLogin($request);
    //
    //     $role = $this->cekRole($request->email);
    //
    //     //dd($role->role);
    //     switch ($role->role) {
    //       case 'admin':
    //         $guard = "admin";
    //         $this->redirectTo = '/admin-home';
    //         break;
    //
    //       default:
    //         $guard = "web";
    //         $this->redirectTo = '/home';
    //         break;
    //     }
    //
    //     //dd($guard);
    //
    //   // If the class is using the ThrottlesLogins trait, we can automatically throttle
    //   // the login attempts for this application. We'll key this by the username and
    //   // the IP address of the client making these requests into this application.
    //   if ($this->hasTooManyLoginAttempts($request)) {
    //       $this->fireLockoutEvent($request);
    //
    //       return $this->sendLockoutResponse($request);
    //   }
    //
    //   if ( Auth::guard($guard)->attempt($this->credentials($request), $request->filled('remember')) ) {
    //         // $request->session()->regenerate();
    //         // $this->clearLoginAttempts($request);
    //
    //         // return redirect()->intended(route($redirect));
    //         return $this->sendLoginResponse($request);
    //   }
    //
    //   // If the login attempt was unsuccessful we will increment the number of attempts
    //   // to login and redirect the user back to the login form. Of course, when this
    //   // user surpasses their maximum number of attempts they will get locked out.
    //   $this->incrementLoginAttempts($request);
    //
    //   return $this->sendFailedLoginResponse($request);
    //   // return redirect()->back()->withInput($request->only('email', 'remember'));
    //
    //
    // }

    protected function attemptLogin(Request $request)
    {
      $role = $this->cekRole($request->email);

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
      // dd($this->credentials($request));
        return  Auth::guard($guard)->attempt(
            $this->credentials($request), $request->filled('remember')
        );
        // dd($ada);
    }


}
