<?php

namespace App\Http\Controllers\Provider;

use App\BasicSetting;
use App\Provider;
use App\TraitsFolder\CommonTrait;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use CommonTrait;
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function showRegistrationForm()
    {
        $basic = BasicSetting::first();
        if ($basic->provider_register == 1){
            $data['page_title'] = 'Provider Register';
            return view('provider.register',$data);
        }else{
            session()->flash('message','Provide Register Disabled.');
            session()->flash('type','info');
            return redirect()->back();
        }

    }


    protected function validator(array $data)
    {
        //dd(Auth::user());
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:providers',
            'password' => 'required|string|min:6|confirmed',
            'country_code' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //dd($this->guard());
        return Provider::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'country_code' => $data['country_code'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function guard()
    {
        return Auth::guard('provider');
    }

    public function registered(Request $request, $user)
    {
        $this->provideConfirm($user->name,$user->email,'your_password');
    }
}
