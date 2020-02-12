<?php

namespace App\TraitsFolder;

use App\BasicSetting;
use App\Order;
use App\OrderItem;
use App\PaymentLog;
use App\User;
use App\UserDetails;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

trait CommonTrait
{
    public function sendMail($email,$name,$subject,$text){
        $basic = BasicSetting::first();
        $mail_val = [
            'email' => $email,
            'name' => $name,
            'g_email' => $basic->email,
            'g_title' => $basic->title,
            'subject' => $subject,
        ];

        $body = $basic->email_body;
        $body = str_replace("{{name}}",$name,$body);
        $body = str_replace("{{message}}",$text,$body);

        Mail::send('emails.email', ['body'=>$body], function ($m) use ($mail_val) {
            $m->from($mail_val['g_email'], $mail_val['g_title']);
            $m->to($mail_val['email'], $mail_val['name'])->subject($mail_val['subject']);
        });

    }

    public function sendSms($to,$text){
        $basic = BasicSetting::first();
        $appi = $basic->smsapi;
        $text = urlencode($text);
        $appi = str_replace("{{number}}",$to,$appi);
        $appi = str_replace("{{message}}",$text,$appi);
        $result = file_get_contents($appi);
    }

    public function sendContact($email,$name,$subject,$text,$phone)
    {
        $basic = BasicSetting::first();

        $mail_val = [
            'email' => $email,
            'name' => $name,
            'g_email' => $basic->email,
            'g_title' => $basic->title,
            'subject' => 'Contact Message - '.$subject,
        ];


        $site_title = $basic->title;
        $body = $basic->email_body;
        $body = str_replace("Hi",'Hi. I\'m',$body);
        $body = str_replace("{{name}}",$name." - ".$phone,$body);
        $body = str_replace("{{message}}",$text,$body);
        $body = str_replace("{{site_title}}",$site_title,$body);

        Mail::send('emails.email', ['body'=>$body], function ($m) use ($mail_val) {
            $m->from($mail_val['email'], $mail_val['name']);
            $m->to($mail_val['g_email'], $mail_val['g_title'])->subject($mail_val['subject']);
        });
    }

    public function userPasswordReset($email,$name,$route)
    {
        $basic = BasicSetting::first();
        $mail_val = [
            'email' => $email,
            'name' => $name,
            'g_email' => $basic->email,
            'g_title' => $basic->title,
            'subject' => 'Password Reset Request',
        ];

        $reset = DB::table('password_resets')->whereEmail($email)->count();
        $token = Str::random(40);
        $bToken = bcrypt($token);
        $url = route($route,$token);
        if ($reset == 0){
            DB::table('password_resets')->insert(
                ['email' => $email, 'token' => $bToken]
            );
            Mail::send('emails.reset-email', ['name' => $name,'link'=>$url,'footer'=>$basic->copy_text], function ($m) use ($mail_val) {
                $m->from($mail_val['g_email'], $mail_val['g_title']);
                $m->to($mail_val['email'], $mail_val['name'])->subject($mail_val['subject']);
            });
        }else{
            DB::table('password_resets')
                ->where('email', $email)
                ->update(['email' => $email, 'token' => $bToken]);
            Mail::send('emails.reset-email', ['name' => $name,'link'=>$url,'footer'=>$basic->copy_text], function ($m) use ($mail_val) {
                $m->from($mail_val['g_email'], $mail_val['g_title']);
                $m->to($mail_val['email'], $mail_val['name'])->subject($mail_val['subject']);
            });
        }
    }

    public function manualPaymentEmail($userId, $logId)
    {
        $user = User::find($userId);
        $log = PaymentLog::find($logId);
        $basic = BasicSetting::first();
        $method = $log->payment->name;
        $amount = $log->amount.' '.$basic->currency;
        $mail_val = [
            'email' => $user->email,
            'name' => $user->name,
            'g_email' => $basic->email,
            'g_title' => $basic->title,
            'subject' => "Payment Request Receive - ".$basic->title,
        ];
        $text = "<b>We received your payment request. </b><br>Our finance department will check it as soon as possible.</b><br><br>";
        $text .= "<b>Selected Method : $method</b><br>";
        $text .= "<b>Total Amount : $amount</b>";
        $body = $basic->email_body;
        $body = str_replace("{{name}}",$user->name,$body);
        $body = str_replace("{{message}}",$text,$body);
        $body = str_replace("{{site_title}}",$basic->title,$body);

        Mail::send('emails.email', ['body'=>$body], function ($m) use ($mail_val) {
            $m->from($mail_val['g_email'], $mail_val['g_title']);
            $m->to($mail_val['email'], $mail_val['name'])->subject($mail_val['subject']);
        });

    }

    public function paymentCancel($userId, $amount,$custom, $type)
    {
        $basic = BasicSetting::first();
        $user = User::findOrFail($userId);
        $mail_val = [
            'email' => $user->email,
            'name' => $user->name,
            'g_email' => $basic->email,
            'g_title' => $basic->title,
            'subject' => "Manual Payment Request Cancel",
        ];

        $urText = 'We are sorry to say that, your manual payment request is cancel. <br> Your Request was : '.$basic->symbol.$amount.' via - '.$type.' <br> Order Number Is : '.$custom.'<br>';
        $body = $basic->email_body;
        $body = str_replace("{{name}}",$user->name,$body);
        $body = str_replace("{{message}}",$urText,$body);
        $body = str_replace("{{site_title}}",$basic->title,$body);

        Mail::send('emails.email', ['body'=>$body], function ($m) use ($mail_val) {
            $m->from($mail_val['g_email'], $mail_val['g_title']);
            $m->to($mail_val['email'], $mail_val['name'])->subject($mail_val['subject']);
        });
    }


    public static function viewRating($rating)
    {
        if ($rating == 0){
            return '<i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i> <i class="fa fa-star"></i>';
        }elseif ($rating == 1){
            return '<i class="fa fa-star active"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i> <i class="fa fa-star"></i>';
        }elseif ($rating == 2){
            return '<i class="fa fa-star active"></i> <i class="fa fa-star active"></i> <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i> <i class="fa fa-star"></i>';
        }elseif ($rating == 3){
            return '<i class="fa fa-star active"></i> <i class="fa fa-star active"></i> <i class="fa fa-star active"></i>
                                            <i class="fa fa-star"></i> <i class="fa fa-star"></i>';
        }elseif ($rating == 4){
            return '<i class="fa fa-star active"></i> <i class="fa fa-star active"></i> <i class="fa fa-star active"></i>
                                            <i class="fa fa-star active"></i> <i class="fa fa-star"></i>';
        }else{
            return '<i class="fa fa-star active"></i> <i class="fa fa-star active"></i> <i class="fa fa-star active"></i>
                                            <i class="fa fa-star active"></i> <i class="fa fa-star active"></i>';
        }
    }

    public function friendEmail($name, $ownEmail, $friendEmail, $url)
    {
        $basic = BasicSetting::first();
        $mail_val = [
            'email' => $friendEmail,
            'name' => $name,
            'g_email' => $ownEmail,
            'g_title' => $basic->title,
            'subject' => "Shared Product via Email",
        ];

        $urText = '<a href="'.$url.'">Product URL : '.$url.'</a></br>';
        $body = $basic->email_body;
        $body = str_replace("{{name}}",$name,$body);
        $body = str_replace("{{message}}",$urText,$body);
        $body = str_replace("{{site_title}}",$basic->title,$body);

        Mail::send('emails.email', ['body'=>$body], function ($m) use ($mail_val) {
            $m->from($mail_val['g_email'], $mail_val['g_title']);
            $m->to($mail_val['email'], $mail_val['name'])->subject($mail_val['subject']);
        });
    }

    public function sendInvoice($userId, $orderId)
    {
        $basic = BasicSetting::first();
        $user = User::findOrFail($userId);
        $userDetails = UserDetails::whereUser_id($userId)->first();
        $order = Order::findOrFail($orderId);
        $mail_val = [
            'email' => $user->email,
            'name' => $user->first_name.' '.$user->last_name,
            'g_email' => $basic->email,
            'g_title' => $basic->title,
            'subject' => $basic->title.' '.'Order Invoice  - '.$order->order_number,
        ];


        $items = null;

        $logoUrl = asset('assets/images/logo.png');
        $invoiceNumber = $order->order_number;
        $invoiceDate = Carbon::parse($order->created_at)->format('F d, Y - h:i A');
        $companyDetails = $basic->title."<br>".$basic->phone."<br>".$basic->address;
        $userDetails = $userDetails->b_name."<br>".$userDetails->b_number."<br>".$userDetails->b_email;
        $paymentUrl = route('payment',$order->order_number);
        $subtotal = $basic->symbol.$order->subtotal;
        $total = $basic->symbol.$order->total;
        $totalTax = $basic->symbol.$order->tax;
        $tax = $basic->tax;
        $minute = $basic->expire_time;

        $orderItem = OrderItem::whereOrder_id($orderId)->get();
        foreach ($orderItem as $ot){
            $productName = $ot->product->name;
            $productPrice = $ot->product->current_price;
            $productSub = $basic->symbol.($ot->qty*$productPrice);
            $items .= '<tr class="item">
                    <td>
                        '.$productName.'
                    </td>
                    <td style="text-align:center">
                        '.$basic->symbol.$productPrice.'
                    </td>
                    <td style="text-align:center">
                        '.$ot->qty.'
                    </td>
                    <td>
                        '.$productSub.'
                    </td>
                </tr>';
        }

        Mail::send('emails.invoice', [
            'logoUrl'=>$logoUrl,
            'invoiceNumber'=>$invoiceNumber,
            'invoiceDate' => $invoiceDate,
            'companyDetails' => $companyDetails,
            'userDetails' => $userDetails,
            'paymentUrl' => $paymentUrl,
            'subtotal' => $subtotal,
            'total' => $total,
            'totalTax' => $totalTax,
            'tax' => $tax,
            'items' => $items,
            'minute' => $minute,

        ], function ($m) use ($mail_val) {
            $m->from($mail_val['g_email'], $mail_val['g_title']);
            $m->to($mail_val['email'], $mail_val['name'])->subject($mail_val['subject']);
        });
    }

    public function paymentConfirm($userId, $amount,$custom, $type)
    {
        $basic = BasicSetting::first();
        $user = User::findOrFail($userId);
        $mail_val = [
            'email' => $user->email,
            'name' => $user->first_name.' '.$user->last_name,
            'g_email' => $basic->email,
            'g_title' => $basic->title,
            'subject' => "Product purchase Completed",
        ];


        $url = route('order-complete',$custom);
        $urText = 'Successfully Product Purchase Confirmed : '.$basic->symbol.$amount.' via - '.$type.' <br> Order Number Is : '.$custom.'<br>'.'Confirm Page : <a href="'.$url.'">'.$url.'</a></br>';
        $body = $basic->email_body;
        $body = str_replace("{{name}}",$user->first_name.' '.$user->last_name,$body);
        $body = str_replace("{{message}}",$urText,$body);
        $body = str_replace("{{site_title}}",$basic->title,$body);

        Mail::send('emails.email', ['body'=>$body], function ($m) use ($mail_val) {
            $m->from($mail_val['g_email'], $mail_val['g_title']);
            $m->to($mail_val['email'], $mail_val['name'])->subject($mail_val['subject']);
        });
    }

    public function provideConfirm($name, $email, $password)
    {
        $basic = BasicSetting::first();
        $mail_val = [
            'email' => $email,
            'name' => $name,
            'g_email' => $basic->email,
            'g_title' => $basic->title,
            'subject' => "Provider Created Successfully",
        ];
        $url = url('/provider');
        $urText = "You Are Successfully Made As a Provider.<br><br>Your Login Access Is : <br>Email : $email<br>Password : $password<br>Log In URL : $url<br><br> Log In and Enjoy Yourself.";
        $body = $basic->email_body;
        $body = str_replace("{{name}}",$name,$body);
        $body = str_replace("{{message}}",$urText,$body);
        $body = str_replace("{{site_title}}",$basic->title,$body);

        Mail::send('emails.email', ['body'=>$body], function ($m) use ($mail_val) {
            $m->from($mail_val['g_email'], $mail_val['g_title']);
            $m->to($mail_val['email'], $mail_val['name'])->subject($mail_val['subject']);
        });
    }

    public function changeProviderPassword($name, $email, $password)
    {
        $basic = BasicSetting::first();
        $mail_val = [
            'email' => $email,
            'name' => $name,
            'g_email' => $basic->email,
            'g_title' => $basic->title,
            'subject' => "Provider Password Changes",
        ];
        $url = url('/provider');
        $urText = "Your Password Changed Successfully.<br><br>Your Login Access Is : <br>Email : $email<br>Password : $password<br>Log In URL : $url<br><br> Please Login And Change Your Password.";
        $body = $basic->email_body;
        $body = str_replace("{{name}}",$name,$body);
        $body = str_replace("{{message}}",$urText,$body);
        $body = str_replace("{{site_title}}",$basic->title,$body);

        Mail::send('emails.email', ['body'=>$body], function ($m) use ($mail_val) {
            $m->from($mail_val['g_email'], $mail_val['g_title']);
            $m->to($mail_val['email'], $mail_val['name'])->subject($mail_val['subject']);
        });
    }

}