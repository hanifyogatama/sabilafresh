<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use PhpParser\Node\Expr\FuncCall;

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
    // protected $redirectTo = RouteServiceProvider::HOME;

    protected function authenticated(Request $request, $user)
    {
        if ($user->is_admin) {
            return redirect('admin/dashboard')->with('login-success', 'login');
        }

        return redirect('home');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    {
        // Auth::logout();
        // return redirect('/login');

        $this->guard()->logout();
        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect()->back();
    }

    public function showLoginForm()
    {
        if (view()->exists('auth.authenticate')) {
            return view('auth.authenticate');
        }

        return $this->load_theme('auth.login');
    }
}
