<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    
    public function accessSessionData(Request $request) {

        if($request->session()->has('uploadImage'))

           print_r($request->session()->get('uploadImage'));

        else

           echo 'No image in session';

     }


     
    public function storeSessionData($image) {


            session()->put('uploadImage', $image);

    }


    public function deleteSessionData(Request $request) {

        $request->session()->forget('uploadImage');

        echo "Image has been removed from session.";

    }

}
