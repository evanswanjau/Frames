<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/provider-dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:provider')->except('logout');
    }

    public function showLoginForm()
    {
        $data['page_title'] = 'Provider Login';
        return view('provider.login',$data);
    }

    public function guard()
    {
        return Auth::guard('provider');
    }


    public function username()
    {
        return 'email';
    }

    public function logout()
    {
        $this->guard('provider')->logout();
        session()->flash('message', 'Just Logged Out!');
        return redirect('/provider');
    }

}
