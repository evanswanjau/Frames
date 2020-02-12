<?php

  

namespace App\Http\Controllers;

  

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
  

class ImageUploadController extends Controller
{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function imageUpload()

    {

        return view('imageUpload');

    }

  

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function imageUploadPost(Request $request)

    {

        request()->validate([

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $imageName = time().'.'.request()->image->getClientOriginalExtension();

        request()->image->move('assets/images/custom-images/', $imageName);

        $data['imageName'] = $imageName;

        $data['type'] = $request->type;
        
        app(\App\Http\Controllers\SessionController::class)->storeSessionData($data);

        return back()

        ->with('success','Image uploaded successfully')

        ->with('image',$imageName);

    }


    public function addImageToCart(Request $request)
    {

        if (isset($request['submitframe'])) {

            request()->validate([

                'length' => 'required',
                'width' => 'required',
    
            ]);

            $new_array = session()->get('uploadImage');
            $new_array['bg_size'] = $request['bg_size'];
            $new_array['bg_color'] = $request['bg-color'];
            $new_array['length'] = $request['length'];
            $new_array['width'] = $request['width'];
            $new_array['price'] = 100;

            // session()->forget('uploadImage');
            session()->put('uploadImage', $new_array);  
            
        } elseif(isset($request['cancelImage'])) {

            session()->forget('uploadImage');

        }      

        return back();

    }

}