<?php

namespace App\Http\Controllers;

use App\Admin;
use App\BasicSetting;
use App\GeneralSetting;
use Brotzka\DotenvEditor\DotenvEditor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class BasicSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function getChangePass()
    {
        $data['page_title'] = "Change Password";
        return view('dashboard.change-password',$data);
    }
    public function postChangePass(Request $request)
    {
        $this->validate($request, [
            'current_password' =>'required',
            'password' => 'required|min:5|confirmed'
        ]);
        try {
            $c_password = Auth::guard('admin')->user()->password;
            $c_id = Auth::guard('admin')->user()->id;

            $user = Admin::findOrFail($c_id);

            if(Hash::check($request->current_password, $c_password)){

                $password = Hash::make($request->password);
                $user->password = $password;
                $user->save();
                session()->flash('message', 'Password Changes Successfully.');
                session()->flash('title','Success');
                Session::flash('type', 'success');
                return redirect()->back();
            }else{
                session()->flash('message', 'Current Password Not Match');
                Session::flash('type', 'warning');
                session()->flash('title','Opps');
                return redirect()->back();
            }

        } catch (\PDOException $e) {
            session()->flash('message', $e->getMessage());
            Session::flash('type', 'warning');
            session()->flash('title','Opps');
            return redirect()->back();
        }

    }
    public function getBasicSetting()
    {
        $data['page_title'] = "Basic Setting";
        return view('basic.basic-setting',$data);
    }
    protected function putBasicSetting(Request $request,$id)
    {
        $basic = BasicSetting::findOrFail($id);
        $this->validate($request,[
           'title' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);
        $in = Input::except('_method','_token');
        $in['provider_panel'] = $request->provider_panel == 'on' ? '1' : '0';
        $in['provider_register'] = $request->provider_register == 'on' ? '1' : '0';
        $basic->fill($in)->save();
        $env = new DotenvEditor();
        $env->changeEnv([
            'APP_NAME'=>str_slug($request->title),
            'APP_URL' => url('/'),
        ]);
        session()->flash('message', 'Basic Setting Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }

    public function editProfile()
    {
        $data['page_title'] = "Edit Admin Profile";
        $data['admin'] = Admin::findOrFail(Auth::user()->id);
        return view('dashboard.edit-profile',$data);
    }

    public function updateProfile(Request $request)
    {
        $admin = Admin::findOrFail(Auth::user()->id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,'.$admin->id,
            'username' => 'required|min:5|unique:admins,username,'.$admin->id,
            'image' => 'mimes:png,jpg,jpeg'
        ]);
        $in = Input::except('_method','_token');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/' . $filename;
            Image::make($image)->resize(215,215)->save($location);
            if ($admin->image != 'admin-default.png'){
                $path = './assets/images/';
                $link = $path.$admin->image;
                if (file_exists($link)){
                    unlink($link);
                }
            }
            $in['image'] = $filename;
        }
        $admin->fill($in)->save();
        session()->flash('message','Profile Updated Successfully.');
        session()->flash('title','Success');
        session()->flash('type','success');
        return redirect()->back();
    }
    public function manageEmailTemplate()
    {
        $data['page_title'] = "Manage Email Template";
        return view('basic.email-template', $data);
    }

    public function updateEmailTemplate(Request $request)
    {
        $this->validate($request,[
            'email_body' => 'required'
        ]);
        $basic = BasicSetting::first();
        $basic->email_body = $request->email_body;
        $basic->save();
        session()->flash('message', 'Email Setting Updated.');
        Session::flash('type', 'success');
        return redirect()->back();
    }
    public function getEmailSetting()
    {
        $data['page_title'] = "Email Setting";
        $env = new DotenvEditor();
        $data['smtp'] = $env->getValue('MAIL_SMTP');
        $data['driver'] = $env->getValue('MAIL_DRIVER');
        $data['host'] = $env->getValue('MAIL_HOST');
        $data['port'] = $env->getValue('MAIL_PORT');
        $data['username'] = $env->getValue('MAIL_USERNAME');
        $data['password'] = $env->getValue('MAIL_PASSWORD');
        $data['enc'] = $env->getValue('MAIL_ENCRYPTION');
        return view('basic.email-setting',$data);
    }

    public function updateEmailSetting(Request $request)
    {

        $this->validate($request,[
            'driver' => 'required',
            'host' => 'required_if:driver,smtp',
            'port' => 'required_if:driver,smtp',
            'username' => 'required_if:driver,smtp',
            'pass' => 'required_if:driver,smtp',
            'encryption' => 'required_if:driver,smtp',
        ]);

        if ($request->driver == 'smtp'){

            try{
                $transport = new \Swift_SmtpTransport($request->host, $request->port, $request->encryption);
                $transport->setUsername($request->username);
                $transport->setPassword($request->pass);
                $mailer = new \Swift_Mailer($transport);
                $mailer->getTransport()->start();

                $env = new DotenvEditor();
                $env->changeEnv([
                    'MAIL_DRIVER' => $request->driver,
                    'MAIL_HOST' => $request->host,
                    'MAIL_PORT' => $request->port,
                    'MAIL_USERNAME' => $request->username,
                    'MAIL_PASSWORD' => $request->pass,
                    'MAIL_ENCRYPTION' => $request->encryption,
                    'MAIL_SMTP' => 'true',
                ]);

                session()->flash('message', 'Email Setting Updated Successfully.');
                Session::flash('type', 'success');
                Session::flash('title', 'Success');
                return redirect()->back();

            } catch (\Swift_TransportException $e) {
                return $e->getMessage();
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }else{

            $env = new DotenvEditor();
            $env->changeEnv([
                'MAIL_DRIVER' => 'mail',
                'MAIL_SMTP' => 'false',
            ]);

        }
        session()->flash('message', 'Email Setting Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }

    public function getGoogleAnalytic()
    {
        $data['page_title'] = "Google Analytic scripts";
        $data['heading'] = "Google Analytic";
        $data['filed'] = 'google_analytic';
        $data['nicEdit'] = 0;
        return view('basic.common-form',$data);
    }
    public function updateGoogleAnalytic(Request $request)
    {
        $basic = BasicSetting::first();
        $in = Input::except('_method','_token');
        $basic->fill($in)->save();
        session()->flash('message', 'Google Analytic Updated.');
        Session::flash('type', 'success');
        return redirect()->back();
    }
    public function getLiveChat()
    {
        $data['page_title'] = "Live Chat scripts";
        $data['heading'] = "live Chat";
        $data['filed'] = 'chat';
        $data['nicEdit'] = 0;
        return view('basic.common-form',$data);
    }
    public function updateLiveChat(Request $request)
    {
        $basic = BasicSetting::first();
        $in = Input::except('_method','_token');
        $basic->fill($in)->save();
        session()->flash('message', 'Chat Scripts Updated.');
        Session::flash('type', 'success');
        return redirect()->back();
    }

    public function setCronJob()
    {
        $data['page_title'] = 'Cron Job URL';
        return view('basic.cron-job',$data);
    }

}
