<?php
namespace App\Http\Controllers;

use AfricasTalking\SDK\AfricasTalking;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BulkSmsController extends Controller
{
    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function sendMessage($message)

    {
        $username = 'FRAMESAFRICA'; //'sandbox'; use 'sandbox' for development in the test environment
        $apiKey   = 'cace8cb519c23e3e1cdea4fb8b535773248bdab152ca872c61cfdeb712b67c91'; //'d14693e1e4f456e60b70e98f8ec6123fc974e45cf4f5af93685e9d7033461130';// use your sandbox app API key for development in the test environment
        $AT       = new AfricasTalking($username, $apiKey);

        // Get one of the services
        $sms      = $AT->sms();

        // Use the service
        $result   = $sms->send([
            'to'      => $message['phone_number'],
            'message' => $message['message'],
            "from" => "FRAMESAFRIC",
        ]);

        return view('home.message')->with('result', $message);

    }
    
}
