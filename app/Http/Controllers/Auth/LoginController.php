<?php

namespace App\Http\Controllers\Auth;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
   // protected $redirectTo = '/home';

   public function redirectTo()
    {
        if (auth()->user()->role == 'admin') {
            return '/admin/dashboard';
        }

        if (auth()->user()->role == 'seller') {
            return '/seller/dashboard';
        }

        return '/home';
    }



    protected function authenticated(Request $request, $user)
    {
        ActivityLog::create([
            'user_id' => $user->id,
            'name'    => $user->name,
            'role'    => $user->role,
            'description' => 'User Logged In',
        ]);

        if ($user->role == 'admin') {
            return redirect('/admin/dashboard');
        }
        if ($user->role == 'seller') {
            return redirect('/seller/dashboard');
        }

        return redirect('/home');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
