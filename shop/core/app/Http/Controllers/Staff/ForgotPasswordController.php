<?php

namespace App\Http\Controllers\Staff;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Staff;
use App\TraitsFolder\CommonTrait;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    use CommonTrait;
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function showLinkRequestForm()
    {
        return view('staff.passwords.email');
    }
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $us = Staff::whereEmail($request->email)->count();
        if ($us == 0)
        {
            session()->flash('message','We can\'t find a user with that e-mail address.');
            session()->flash('type','danger');
            return redirect()->back();
        }else{
            $user1 = Staff::whereEmail($request->email)->first();
            $route = 'staff.password.reset';
            $this->userPasswordReset($user1->email,$user1->name,$route);
            session()->flash('message','Password Reset Link Send Your E-mail');
            session()->flash('type','success');
            return redirect()->back();
        }

    }
}
