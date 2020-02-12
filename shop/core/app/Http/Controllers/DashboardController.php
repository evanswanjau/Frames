<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Advertisement;
use App\Category;
use App\ChildCategory;
use App\Color;
use App\Comment;
use App\Order;
use App\OrderItem;
use App\Partner;
use App\PaymentLog;
use App\PaymentMethod;
use App\Product;
use App\ProductImage;
use App\ProductSpecification;
use App\Provider;
use App\Review;
use App\Size;
use App\Staff;
use App\Subcategory;
use App\Subscribe;
use App\Tag;
use App\TraitsFolder\CommonTrait;
use App\TransactionLog;
use App\User;
use App\UserDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class DashboardController extends Controller
{
    use CommonTrait;
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function getDashboard()
    {
        $data['page_title'] = "Dashboard";
        $data['totalProduct'] = Product::all()->count();
        $data['totalCategory'] = Category::all()->count();
        $data['totalSubCategory'] = Subcategory::all()->count();
        $data['totalChildCategory'] = ChildCategory::all()->count();
        $data['totalOrder'] = Order::all()->count();
        $data['pendingOrder'] = Order::whereStatus(0)->count();
        $data['cancelOrder'] = Order::whereStatus(2)->count();
        $data['confirmOrder'] = Order::whereStatus(1)->count();

        $start = Carbon::parse()->subDays(19);
        $end = Carbon::now();
        $stack = [];
        $date = $start;
        while ($date <= $end) {
            $stack[] = $date->copy();
            $date->addDays(1);
        }
        $dL = [];
        $dV = [];
        foreach (array_reverse($stack) as $d){
            $dL[] .= Carbon::parse($d)->format('dS M');

        }
        foreach (array_reverse($stack) as $d){
            $date = Carbon::parse($d)->format('Y-m-d');
            $start = $date.' '.'00:00:00';
            $end = $date.' '.'23:59:59';
            $dC= Order::whereBetween('created_at',[$start,$end])->get();
            $dV[] .= count($dC);
        }
        $data['dV'] = $dV;
        $data['dL'] = $dL;
        return view('dashboard.dashboard',$data);
    }
    public function manageCategory()
    {
        $data['page_title'] = "Product Category";
        $data['category'] = Category::all();
        return view('dashboard.category', $data);
    }
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
        ]);
        $in = Input::except('_method','_token');
        $product = Category::create($in);
        $product_id = $product->id;
        $product['menuStatus'] = '<button type="button" class="btn btn-sm btn-warning bold uppercase delete_button"
                                                data-toggle="modal" data-target="#DelModal"
                                                data-id="'.$product_id.'">
                                            <i class=\'fa fa-times\'></i> NO
                                        </button>';
        return response()->json($product);

    }
    public function editCategory($product_id)
    {
        $product = Category::find($product_id);
        return response()->json($product);
    }
    public function updateCategory(Request $request,$product_id)
    {
        $product = Category::find($product_id);
        $request->validate([
            'name' => 'required|unique:categories,name,'.$product->id,
        ]);
        $product->name = $request->name;
        $product->percent = $request->percent;
        $product->save();
        if ($product->status == 0){
            $product['menuStatus'] = '<button type="button" class="btn btn-sm btn-warning bold uppercase delete_button"
                                                data-toggle="modal" data-target="#DelModal"
                                                data-id="'.$product_id.'">
                                            <i class=\'fa fa-times\'></i> NO
                                        </button>';
        }else{
            $product['menuStatus'] = '<button type="button" class="btn btn-sm btn-primary bold uppercase delete_button"
                                                data-toggle="modal" data-target="#DelModal"
                                                data-id="'.$product_id.'">
                                            <i class=\'fa fa-check\'></i> YES
                                        </button>';
        }
        return response()->json($product);
    }
    public function categoryStatus(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        $channel = Category::findOrFail($request->id);
        if ($channel->status == 1){
            $channel->status = 0;
            $channel->save();
        }else{
            $channel->status = 1;
            $channel->save();
        }
        session()->flash('message','Category Action Completed.');
        session()->flash('type','success');
        return redirect()->back();
    }

    public function deleteCategory(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $cat = Category::findOrFail($request->id);

        $products = Product::whereCategory_id($cat->id)->get();
        $product = $products->pluck('id')->toArray();

        $sCats = Subcategory::whereCategory_id($cat->id)->get();
        $sCat = $sCats->pluck('id')->toArray();

        ChildCategory::whereIn('subcategory_id',$sCat)->delete();

        Subcategory::whereCategory_id($cat->id)->delete();

        OrderItem::whereIn('product_id',$product)->delete();
        $images = ProductImage::whereIn('product_id',$product)->get();
        foreach ($images as $img)
        {
            File::delete(('assets/images/product').'/'.$img->name);
            $img->delete();
        }
        ProductSpecification::whereIn('product_id',$product)->delete();
        foreach ($products as $product)
        {
            $product->colors()->detach();
            $product->sizes()->detach();
            $product->tags()->detach();
            $product->delete();
        }
        $cat->delete();
        session()->flash('message','Category Deleted Successfully.');
        session()->flash('type','success');
        return redirect()->back();
    }
    public function manageSubCategory()
    {
        $data['page_title'] = "Product Subcategory";
        $data['category'] = Category::all();
        $data['subcategory'] = Subcategory::paginate(15);
        return view('dashboard.subcategory', $data);
    }
    public function storeSubCategory(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|unique:subcategories,name,NULL,id,category_id,'.$request->category_id,
        ]);
        $product = Subcategory::create($request->input());
        $product['categoryName'] = Category::findOrFail($request->category_id)->name;
        return response()->json($product);

    }
    public function editSubCategory($product_id)
    {
        $product = Subcategory::find($product_id);
        return response()->json($product);
    }
    public function updateSubCategory(Request $request,$product_id)
    {
        $product = Subcategory::find($product_id);
        $request->validate([
            'name' => 'required|unique:subcategories,name,NULL,id,category_id,'.$request->category_id.$product->id,
            'category_id' => 'required'
        ]);
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->save();
        $product['categoryName'] = Category::findOrFail($request->category_id)->name;
        return response()->json($product);
    }

    public function deleteSubcategory(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $cat = Subcategory::findOrFail($request->id);

        $products = Product::whereSubcategory_id($cat->id)->get();
        $product = $products->pluck('id')->toArray();
        ChildCategory::whereSubcategory_id($cat->id)->delete();
        OrderItem::whereIn('product_id',$product)->delete();
        $images = ProductImage::whereIn('product_id',$product)->get();
        foreach ($images as $img)
        {
            File::delete(('assets/images/product').'/'.$img->name);
            $img->delete();
        }
        ProductSpecification::whereIn('product_id',$product)->delete();
        foreach ($products as $product)
        {
            $product->colors()->detach();
            $product->sizes()->detach();
            $product->tags()->detach();
            $product->delete();
        }
        $cat->delete();
        session()->flash('message','Category Deleted Successfully.');
        session()->flash('type','success');
        return redirect()->back();
    }

    public function manageChildCategory()
    {
        $data['page_title'] = "Product Child Category";
        $data['subcategory'] = Subcategory::all();
        $data['childcategory'] = ChildCategory::orderBy('id','desc')->paginate(15);
        return view('dashboard.childcategory', $data);
    }
    public function storeChildCategory(Request $request)
    {
        $request->validate([
            'subcategory_id' => 'required',
            'name' => 'required|unique:child_categories,name,NULL,id,subcategory_id,'.$request->subcategory_id,
        ]);
        $product = ChildCategory::create($request->input());
        $product['subcategoryName'] = Subcategory::findOrFail($request->subcategory_id)->name;
        $product['categoryName'] = Category::findOrFail($request->subcategory_id)->name;
        return response()->json($product);

    }
    public function editChildCategory($product_id)
    {
        $product = ChildCategory::find($product_id);
        return response()->json($product);
    }
    public function updateChildCategory(Request $request,$product_id)
    {
        $product = ChildCategory::find($product_id);
        $request->validate([
            'name' => 'required|unique:child_categories,name,NULL,id,subcategory_id,'.$request->subcategory_id.$product->id,
            'subcategory_id' => 'required'
        ]);
        $product->name = $request->name;
        $product->subcategory_id = $request->subcategory_id;
        $product->save();
        $product['subcategoryName'] = Subcategory::findOrFail($request->subcategory_id)->name;
        $product['categoryName'] = Category::findOrFail($request->subcategory_id)->name;
        return response()->json($product);
    }

    public function deleteChildCategory(Request $request)
    {
        $request->validate([
           'id' => 'required'
        ]);

        $cat = ChildCategory::findOrFail($request->id);

        $products = Product::whereChildcategory_id($cat->id)->get();
        $product = $products->pluck('id')->toArray();
        OrderItem::whereIn('product_id',$product)->delete();
        $images = ProductImage::whereIn('product_id',$product)->get();
        foreach ($images as $img)
        {
            File::delete(('assets/images/product').'/'.$img->name);
            $img->delete();
        }
        ProductSpecification::whereIn('product_id',$product)->delete();
        foreach ($products as $product)
        {
            $product->colors()->detach();
            $product->sizes()->detach();
            $product->tags()->detach();
            $product->delete();
        }
        $cat->delete();
        session()->flash('message','Category Deleted Successfully.');
        session()->flash('type','success');
        return redirect()->back();

    }


    public function newAdvertisement()
    {
        $data['page_title'] = "New Advertisement";
        return view('dashboard.advertisement-new', $data);
    }
    public function storeAdvertisement(Request $request)
    {
        $this->validate($request,[
            'advert_type' => 'required',
            'advert_size' => 'required',
            'title' => 'required',
            'val1' => 'mimes:png,jpg,jpeg,gif'
        ]);
        $in  = Input::except('_method','_token');
        $in['status'] = $request->status == 'on' ? '1' : '0';
        if($request->hasFile('val1')){
            $image = $request->file('val1');
            $filename = 'advertise_'.time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/advertise/' . $filename;
            Image::make($image)->save($location);
            $in['val1'] = $filename;
        }
        Advertisement::create($in);
        session()->flash('message','Advertisement Added Successfully.');
        session()->flash('title','Success');
        session()->flash('type','success');
        return redirect()->back();
    }
    public function allAdvertisement()
    {
        $data['page_title'] = "All Advertisement";
        $data['advert'] = Advertisement::orderBy('id','desc')->get();
        return view('dashboard.advertisement-all', $data);
    }
    public function editAdvertisement($id)
    {
        $data['page_title'] = "Edit Advertisement";
        $data['advert'] = Advertisement::findOrFail($id);
        return view('dashboard.advertisement-edit', $data);
    }
    public function updateAdvertisement(Request $request,$id)
    {
        $ad = Advertisement::findOrFail($id);
        $this->validate($request,[
            'advert_size' => 'required',
            'title' => 'required',
            'val1' => 'mimes:png,jpg,jpeg,gif'
        ]);
        $in  = Input::except('_method','_token');
        $in['status'] = $request->status == 'on' ? '1' : '0';
        if($request->hasFile('val1')){
            $image = $request->file('val1');
            $filename = 'advertise_'.time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/advertise/' . $filename;
            Image::make($image)->save($location);
            $in['val1'] = $filename;
            $path = './assets/images/advertise/';
            $link = $path.$ad->val1;
            if (file_exists($link)){
                unlink($link);
            }
        }
        $ad->fill($in)->save();
        session()->flash('message','Advertisement Updated Successfully.');
        session()->flash('title','Success');
        session()->flash('type','success');
        return redirect()->back();
    }

    public function mangeSubscribe()
    {
        $data['page_title'] = "All Subscribe";
        $data['subscribe'] = Subscribe::orderBy('id','desc')->get();
        return view('dashboard.subscribe',$data);
    }

    public function deleteSubscribe(Request $request)
    {
        $request->validate([
           'id' => 'required'
        ]);
        Subscribe::destroy($request->id);
        session()->flash('message','Subscriber Delete Successfully.');
        session()->flash('type','success');
        return redirect()->back();
    }

    public function mangeUsers()
    {
        $data['page_title'] = "All Users";
        $data['users'] = User::orderBy('id','desc')->get();
        return view('dashboard.users',$data);
    }
    public function deleteUser(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        $user = User::findOrFail($request->id);
        Review::whereUser_id($request->id)->delete();
        Comment::whereUser_id($request->id)->delete();
        UserDetails::whereUser_id($request->id)->delete();
        Order::whereUser_id($request->id)->delete();
        PaymentLog::whereUser_id($request->id)->delete();
        $path = './assets/images/user/'.$user->image;
        if ($user->image != 'user-default.png'){
            File::delete($path);
        }
        $user->delete();
        session()->flash('message','User Delete Successfully.');
        session()->flash('type','success');
        return redirect()->back();
    }

    public function paymentMethod()
    {
        $data['page_title'] = 'Payment Method';
        $data['paypal'] = PaymentMethod::whereId(1)->first();
        $data['perfect'] = PaymentMethod::whereId(2)->first();
        $data['btc'] = PaymentMethod::whereId(3)->first();
        $data['stripe'] = PaymentMethod::whereId(4)->first();
        $data['skrill'] = PaymentMethod::whereId(5)->first();
        $data['payza'] = PaymentMethod::whereId(6)->first();
        $data['cod'] = PaymentMethod::whereId(7)->first();
        $data['coin'] = PaymentMethod::whereId(8)->first();
        return view('payment.payment-method',$data);
    }

    public function updatePaymentMethod(Request $request)
    {
        $this->validate($request,[
            'paypal_name' => 'required',
            'paypal_image' => 'mimes:png,jpeg,jpg',
            'paypal_email' => 'required',
            'perfect_name' => 'required',
            'perfect_image' => 'mimes:png,jpeg,jpg',
            'perfect_account' => 'required',
            'perfect_alternate' => 'required',
            'btc_name' => 'required',
            'btc_image' => 'mimes:png,jpeg,jpg',
            'btc_api' => 'required',
            'btc_xpub' => 'required',
            'stripe_name' => 'required',
            'stripe_image' => 'mimes:png,jpeg,jpg',
            'stripe_secret' => 'required',
            'stripe_publishable' => 'required',
            'skrill_name' => 'required',
            'skrill_image' => 'mimes:png,jpeg,jpg',
            'skrill_email' => 'required',
            'skrill_secret' => 'required',
            'payza_name' => 'required',
            'payza_image' => 'mimes:png,jpeg,jpg',
            'payza_email' => 'required',
            'cod_name' => 'required',
            'cod_image' => 'mimes:png,jpeg,jpg',
            'coin_name' => 'required',
            'coin_image' => 'mimes:png,jpeg,jpg',
            'coin_merchant' => 'required',
            'coin_secret' => 'required',
        ]);

        $paypal = PaymentMethod::whereId(1)->first();
        $perfect = PaymentMethod::whereId(2)->first();
        $btc = PaymentMethod::whereId(3)->first();
        $stripe = PaymentMethod::whereId(4)->first();
        $skrill = PaymentMethod::whereId(5)->first();
        $payza = PaymentMethod::whereId(6)->first();
        $cod = PaymentMethod::whereId(7)->first();
        $coin = PaymentMethod::whereId(8)->first();

        $paypal->name = $request->paypal_name;
        $paypal->val1 = $request->paypal_email;
        $paypal->status = $request->paypal_status == 'on' ? '1' : '0';
        $paypal->fix = $request->paypal_fix;
        $paypal->rate = $request->paypal_rate;
        $paypal->percent = $request->paypal_percent;
        if($request->hasFile('paypal_image')){
            $image3 = $request->file('paypal_image');
            $filename3 = 'paypal_'.time().'h3'.'.'.$image3->getClientOriginalExtension();
            $location = 'assets/images/payment/' . $filename3;
            Image::make($image3)->resize(290,190)->save($location);
            $path = './assets/images/payment/';
            $link = $path.$paypal->image;
            if (file_exists($link)){
                unlink($link);
            }
            $paypal->image = $filename3;
        }
        $perfect->name = $request->perfect_name;
        $perfect->val1 = $request->perfect_account;
        $perfect->val2 = $request->perfect_alternate;
        $perfect->status = $request->perfect_status == 'on' ? '1' : '0';
        $perfect->fix = $request->perfect_fix;
        $perfect->rate = $request->perfect_rate;
        $perfect->percent = $request->perfect_percent;
        if($request->hasFile('perfect_image')){
            $image31 = $request->file('perfect_image');
            $filename31 = 'perfect_'.time().'h4'.'.'.$image31->getClientOriginalExtension();
            $location = 'assets/images/payment/' . $filename31;
            Image::make($image31)->resize(290,190)->save($location);
            $path = './assets/images/payment/';
            $link = $path.$perfect->image;
            if (file_exists($link)){
                unlink($link);
            }
            $perfect->image = $filename31;
        }
        $btc->name = $request->btc_name;
        $btc->val1 = $request->btc_api;
        $btc->val2 = $request->btc_xpub;
        $btc->status = $request->btc_status == 'on' ? '1' : '0';
        $btc->fix = $request->btc_fix;
        $btc->rate = $request->btc_rate;
        $btc->percent = $request->btc_percent;
        if($request->hasFile('btc_image')){
            $image32 = $request->file('btc_image');
            $filename32 = 'btc_'.time().'h5'.'.'.$image32->getClientOriginalExtension();
            $location = 'assets/images/payment/' . $filename32;
            Image::make($image32)->resize(290,190)->save($location);
            $path = './assets/images/payment/';
            $link = $path.$btc->image;
            if (file_exists($link)){
                unlink($link);
            }
            $btc->image = $filename32;
        }
        $stripe->name = $request->stripe_name;
        $stripe->val1 = $request->stripe_secret;
        $stripe->val2 = $request->stripe_publishable;
        $stripe->status = $request->stripe_status == 'on' ? '1' : '0';
        $stripe->fix = $request->stripe_fix;
        $stripe->rate = $request->stripe_rate;
        $stripe->percent = $request->stripe_percent;
        if($request->hasFile('stripe_image')){
            $image33 = $request->file('stripe_image');
            $filename33 = 'stripe_'.time().'h6'.'.'.$image33->getClientOriginalExtension();
            $location = 'assets/images/payment/' . $filename33;
            Image::make($image33)->resize(290,190)->save($location);
            $path = './assets/images/payment/';
            $link = $path.$stripe->image;
            if (file_exists($link)){
                unlink($link);
            }
            $stripe->image = $filename33;
        }
        $skrill->name = $request->skrill_name;
        $skrill->val1 = $request->skrill_email;
        $skrill->val2 = $request->skrill_secret;
        $skrill->status = $request->skrill_status == 'on' ? '1' : '0';
        $skrill->fix = $request->skrill_fix;
        $skrill->rate = $request->skrill_rate;
        $skrill->percent = $request->skrill_percent;
        if($request->hasFile('skrill_image')){
            $image34 = $request->file('skrill_image');
            $filename34 = 'skrill_'.time().'h3'.'.'.$image34->getClientOriginalExtension();
            $location = 'assets/images/payment/' . $filename34;
            Image::make($image34)->resize(290,190)->save($location);
            $path = './assets/images/payment/';
            $link = $path.$skrill->image;
            if (file_exists($link)){
                unlink($link);
            }
            $skrill->image = $filename34;
        }
        $payza->name = $request->payza_name;
        $payza->val1 = $request->payza_email;
        $payza->status = $request->payza_status == 'on' ? '1' : '0';
        $payza->fix = $request->payza_fix;
        $payza->rate = $request->payza_rate;
        $payza->percent = $request->payza_percent;
        if($request->hasFile('payza_image')){
            $image35 = $request->file('payza_image');
            $filename35 = 'payza_'.time().'h3'.'.'.$image35->getClientOriginalExtension();
            $location = 'assets/images/payment/' . $filename35;
            Image::make($image35)->resize(290,190)->save($location);
            $path = './assets/images/payment/';
            $link = $path.$payza->image;
            if (file_exists($link)){
                unlink($link);
            }
            $payza->image = $filename35;
        }

        $cod->name = $request->cod_name;
        $cod->status = $request->cod_status == 'on' ? '1' : '0';
        $cod->fix = $request->cod_fix;
        $cod->rate = $request->cod_rate;
        $cod->percent = $request->cod_percent;
        if($request->hasFile('cod_image')){
            $image36 = $request->file('cod_image');
            $filename36 = 'cod_'.time().'h3'.'.'.$image36->getClientOriginalExtension();
            $location = 'assets/images/payment/' . $filename36;
            Image::make($image36)->resize(290,190)->save($location);
            $path = './assets/images/payment/';
            $link = $path.$cod->image;
            File::delete($link);
            $cod->image = $filename36;
        }
        $coin->name = $request->coin_name;
        $coin->status = $request->coin_status == 'on' ? '1' : '0';
        $coin->fix = $request->coin_fix;
        $coin->rate = $request->coin_rate;
        $coin->percent = $request->coin_percent;
        $coin->val1 = $request->coin_merchant;
        $coin->val2 = $request->coin_secret;
        if($request->hasFile('coin_image')){
            $image37 = $request->file('coin_image');
            $filename37 = 'coin_'.time().'h3'.'.'.$image37->getClientOriginalExtension();
            $location = 'assets/images/payment/' . $filename37;
            Image::make($image37)->resize(290,190)->save($location);
            $path = './assets/images/payment/';
            $link = $path.$coin->image;
            File::delete($link);
            $coin->image = $filename37;
        }

        $paypal->save();
        $perfect->save();
        $btc->save();
        $stripe->save();
        $skrill->save();
        $payza->save();
        $cod->save();
        $coin->save();
        session()->flash('message', 'Payment Method Updated Successfully.');
        session()->flash('type', 'success');
        return redirect()->back();
    }

    public function getManualPaymentMethod()
    {
        $data['page_title'] = "Manual Payment Gateway";
        $data['payment'] = PaymentMethod::whereNotBetween('id',[1,10])->get();
        return view('payment.manual',$data);
    }

    public function createManualPaymentMethod()
    {
        $data['page_title'] = "Create Payment Gateway";
        return view('payment.manual-create',$data);
    }

    public function storeManualPaymentMethod(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'val1' => 'required',
            'rate' => 'required|numeric',
            'fix' => 'required|numeric',
            'percent' => 'required|numeric',
            'image' => 'required|mimes:png,jpg,jpeg,gif'
        ]);

        $in = Input::except('_method','_token');
        $in['status'] = $request->status == 'on' ? 1 : 0;
        if($request->hasFile('image')){
            $image3 = $request->file('image');
            $filename3 = 'manual_'.time().'h8'.'.'.$image3->getClientOriginalExtension();
            $location = ('assets/images/payment'). '/' . $filename3;
            Image::make($image3)->resize(290,190)->save($location);
            $in['image'] = $filename3;
        }
        PaymentMethod::create($in);
        session()->flash('message','Manual Gateway Created Successfully.');
        session()->flash('type','success');
        return redirect()->back();
    }

    public function editManualPaymentMethod($id)
    {
        $data['page_title'] = "Edit Payment Gateway";
        $data['payment'] = PaymentMethod::findOrFail($id);
        return view('payment.manual-edit',$data);
    }

    public function updateManualPaymentMethod(Request $request, $id)
    {
        $payment = PaymentMethod::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'val1' => 'required',
            'rate' => 'required|numeric',
            'fix' => 'required|numeric',
            'percent' => 'required|numeric',
            'image' => 'mimes:png,jpg,jpeg,gif'
        ]);

        $in = Input::except('_method','_token');
        $in['status'] = $request->status == 'on' ? 1 : 0;
        if($request->hasFile('image')){
            $image3 = $request->file('image');
            $filename3 = 'manual_'.time().'h8'.'.'.$image3->getClientOriginalExtension();
            $location = ('assets/images/payment'). '/' . $filename3;
            Image::make($image3)->resize(290,190)->save($location);
            $in['image'] = $filename3;
        }
        $payment->update($in);
        session()->flash('message','Manual Gateway Update Successfully.');
        session()->flash('type','success');
        return redirect()->back();
    }

    public function getManualPaymentRequest()
    {
        $data['page_title'] = "Manual Payment Request";
        $data['payment'] = PaymentLog::whereNotBetween('payment_id',[1,10])->orderBy('id','desc')->get();
        return view('payment.manual-request',$data);
    }

    public function viewManualPaymentRequest($custom)
    {
        $data['page_title'] = $custom." - Manual Payment View";
        $data['payment'] = PaymentLog::findOrFail($custom);
        return view('payment.manual-request-view',$data);
    }

    public function cancelManualPaymentRequest(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        $pay = PaymentLog::findOrFail($request->id);
        $pay->status = 2;
        $pay->save();
        $this->paymentCancel($pay->user_id,$pay->amount,$pay->order_number,$pay->payment->name);
        session()->flash('message','Payment Request Cancel.');
        session()->flash('type','success');
        return redirect()->back();
    }

    public function confirmManualPaymentRequest(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $data = PaymentLog::findOrFail($request->id);

        $order = Order::whereOrder_number($data->order_number)->firstOrFail();
        $order->payment_status = 1;
        $order->save();

        $data->status = 1;
        $data->save();

        $this->paymentConfirm($data->user_id,$data->usd,$data->order_number,$data->payment->name);

        session()->flash('message','Payment Request Complete.');
        session()->flash('type','success');
        return redirect()->back();
    }

    public function deleteManualPaymentRequest(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $log = PaymentLog::findOrFail($request->id);
        foreach ($log->paymentLogImage as $img){
            File::delete("./assets/images/paymentimage/$img->name");
            $img->delete();
        }
        $log->delete();
        session()->flash('message','Payment Request Deleted.');
        session()->flash('type','success');
        return redirect()->back();
    }


    public function addProduct()
    {
        $data['page_title'] = "Add New Product";
        $data['category'] = Category::all();
        $data['partner'] = Partner::all();
        $data['size'] = Size::all();
        $data['color'] = Color::all();
        $data['tags'] = Tag::all();
        return view('dashboard.product-create',$data);
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|unique:products,name',
            'sku' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg',
            'current_price' => 'required|numeric',
            'old_price' => 'nullable|numeric',
            'stock' => 'required|numeric',
            'description' => 'required',
            'tags' => 'array',
            'color' => 'nullable|array',
            'size' => 'nullable|array',
            "gallery_image.*" => 'required|mimes:png,jpg,jpeg,gif',
        ]);

        $in = Input::except('_method','_token','specification','gallery_image','color','size','tags');
        $in['slug'] = str_slug($request->name);
        $in['status'] = $request->status == 'on' ? '1' : '0';
        $in['color_status'] = $request->color_status;
        $in['size_status'] = $request->size_status;
        $in['mood_id'] = $request->mood_id;

        if($request->hasFile('image')){
            $image3 = $request->file('image');
            $filename3 = $in['slug'].'.'.$image3->getClientOriginalExtension();
            $location = 'assets/images/product/' . $filename3;
            Image::make($image3)->resize(780,1000)->save($location);
            $in['image'] = $filename3;
        }
        $product = Product::create($in);

        if ($in['color_status'] == 1){
            $product->colors()->sync($request->color, false);
        }
        if ($in['size_status'] == 1){
            $product->sizes()->sync($request->size, false);
        }

        $tagID = [];
        foreach ($request->tags as $t){
            $tCheck = Tag::whereId($t)->count();
            if ($tCheck == 0){
                $tt['name'] = $t;
                $tID = Tag::create($tt);
                $tagID[] = $tID->id;
            }else{
                $tag = Tag::whereId($t)->first();
                $tagID[] = $tag->id;
            }
        }

        $product->tags()->sync($tagID, false);

        if($request->hasFile('gallery_image')){
            $image4 = $request->file('gallery_image');
            foreach ($image4 as $key => $i)
            {
                $filename4 = $product->slug.'_'.$key.'.'.$i->getClientOriginalExtension();
                $location = 'assets/images/product/' . $filename4;
                Image::make($i)->resize(780,1000)->save($location);
                $image['name'] = $filename4;
                $image['product_id'] = $product->id;
                ProductImage::create($image);
            }
        }
        if ($request->specification != null){
            foreach ($request->specification as $des){
                if (!empty($des)){
                    $pp['product_id'] = $product->id;
                    $pp['specification'] = trim($des);
                    ProductSpecification::create($pp);
                }
            }
        }
        session()->flash('message','Product Store Successfully Completed.');
        session()->flash('type','success');
        return redirect()->back();
    }

    public function allProduct()
    {
        $data['page_title'] = "All Product";
        $data['products'] = Product::orderBy('id','desc')->get();
        return view('dashboard.product-all',$data);
    }
    public function featuredProduct(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        $channel = Product::findOrFail($request->id);
        if ($channel->featured == 1){
            $channel->featured = 0;
            $channel->save();
        }else{
            $channel->featured = 1;
            $channel->save();
        }
        session()->flash('message','Product Featured Action Completed.');
        session()->flash('type','success');
        return redirect()->back();
    }
    public function editProduct($id)
    {
        $data['page_title'] = 'Edit Product';
        $data['product'] = Product::findOrFail($id);
        $data['category'] = Category::get();
        $data['subcategory'] = Subcategory::whereCategory_id($data['product']->category_id)->get();
        $data['childcategory'] = ChildCategory::wheresubcategory_id($data['product']->subcategory_id)->get();
        $data['productImage'] = ProductImage::whereProduct_id($id)->get();
        $data['productSpecification'] = ProductSpecification::whereProduct_id($id)->get();
        $data['partner'] = Partner::all();
        $data['size'] = Size::whereCategory_id($data['product']->category_id)->get();
        $data['color'] = Color::whereCategory_id($data['product']->category_id)->get();
        $data['tags'] = Tag::all();
        return view('dashboard.product-edit',$data);
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|unique:products,name,'.$product->id,
            'sku' => 'required',
            'image' => 'mimes:png,jpg,jpeg',
            'current_price' => 'required|numeric',
            'old_price' => 'nullable|numeric',
            'stock' => 'required|numeric',
            'description' => 'required',
            'tags' => 'array',
            'color' => 'nullable|array',
            'size' => 'nullable|array',
            "gallery_image.*" => 'mimes:png,jpg,jpeg,gif',
        ]);

        $in = Input::except('_method','_token','specification','gallery_image','color','size','tags');
        $in['slug'] = str_slug($request->name);
        $in['status'] = $request->status == 'on' ? '1' : '0';
        $in['color_status'] = $request->color_status;
        $in['size_status'] = $request->size_status;
        $in['mood_id'] = $request->mood_id;
        if($request->hasFile('image')){
            $image3 = $request->file('image');
            $filename3 = $in['slug'].'.'.$image3->getClientOriginalExtension();
            $location = 'assets/images/product/' . $filename3;
            $path = './assets/images/product/';
            $link = $path.$product->image;
            if (file_exists($link)){
                unlink($link);
            }
            Image::make($image3)->resize(780,1000)->save($location);
            $in['image'] = $filename3;
        }

        if($request->hasFile('gallery_image')){
            $oldGalleryImage = ProductImage::whereProduct_id($id)->get();
            foreach ($oldGalleryImage as $oldImage){
                $path = './assets/images/product/';
                $link = $path.$oldImage->name;
                if (file_exists($link)){
                    unlink($link);
                }
                $oldImage->delete();
            }
            $image4 = $request->file('gallery_image');
            foreach ($image4 as $key => $i)
            {
                $filename4 = $product->slug.'_'.$key.'.'.$i->getClientOriginalExtension();
                $location = 'assets/images/product/' . $filename4;
                Image::make($i)->resize(780,1000)->save($location);
                $image['name'] = $filename4;
                $image['product_id'] = $product->id;
                ProductImage::create($image);
            }
        }
        if ($request->specification != null){
            ProductSpecification::whereProduct_id($id)->delete();
            foreach ($request->specification as $des){
                if (!empty($des)){
                    $pp['product_id'] = $product->id;
                    $pp['specification'] = trim($des);
                    ProductSpecification::create($pp);
                }
            }
        }

        if ($in['color_status'] == 1){
            $product->colors()->sync($request->color);
        }else{
            $product->colors()->detach();
        }
        if ($in['size_status'] == 1){
            $product->sizes()->sync($request->size);
        }else{
            $product->sizes()->detach();
        }
        $tagID = [];
        foreach ($request->tags as $t){
            $tCheck = Tag::whereId($t)->count();
            if ($tCheck == 0){
                $tt['name'] = $t;
                $tID = Tag::create($tt);
                $tagID[] = $tID->id;
            }else{
                $tag = Tag::whereId($t)->first();
                $tagID[] = $tag->id;
            }
        }
        $product->tags()->sync($tagID);

        $product->fill($in)->save();
        session()->flash('message','Product Updated Successfully.');
        session()->flash('type','success');
        return redirect()->back();
    }

    public function deleteProduct(Request $request)
    {
        $request->validate([
            'product_id' => 'required'
        ]);

        $product = Product::findOrFail($request->product_id);

        OrderItem::whereProduct_id($product->id)->delete();
        $images = ProductImage::whereProduct_id($product->id)->get();
        foreach ($images as $img)
        {
            File::delete(('assets/images/product').'/'.$img->name);
            $img->delete();
        }
        ProductSpecification::whereProduct_id($product->id)->delete();

        $product->colors()->detach();
        $product->sizes()->detach();
        $product->tags()->detach();

        $product->delete();
        session()->flash('message','Product Deleted Successfully.');
        session()->flash('type','success');
        return redirect()->back();
    }

    public function allOrder()
    {
        $data['page_title'] = "All Order";
        $data['order'] = Order::orderBy('id','desc')->get();
        return view('dashboard.order-all',$data);
    }
    public function pendingOrder()
    {
        $data['page_title'] = "Pending Order";
        $data['order'] = Order::whereStatus(0)->orderBy('id','desc')->get();
        return view('dashboard.order-all',$data);
    }
    public function confirmOrder()
    {
        $data['page_title'] = "Confirm Order";
        $data['order'] = Order::whereStatus(1)->orderBy('id','desc')->get();
        return view('dashboard.order-all',$data);
    }
    public function cancelOrder()
    {
        $data['page_title'] = "Cancel Order";
        $data['order'] = Order::whereStatus(2)->orderBy('id','desc')->get();
        return view('dashboard.order-all',$data);
    }

    public function viewOrder($id)
    {
        $data['page_title'] = $id." - Order Details";
        $data['order'] = Order::whereOrder_number($id)->first();
        $data['orderItem'] = OrderItem::whereOrder_id($data['order']->id)->get();
        $data['userDetails'] = UserDetails::whereUser_id($data['order']->user_id)->first();
        return view('dashboard.order-view',$data);
    }

    public function updateShippingStatus(Request $request)
    {
        $request->validate([
           'status' => 'required',
            'shipping_id' => 'required'
        ]);
        $order = Order::findOrFail($request->shipping_id);
        $order->shipping_status = $request->status;
        $order->save();
        session()->flash('message','Shipping Status Updated.');
        session()->flash('type','success');
        return redirect()->route('order-view',$order->order_number);
    }

    public function updateOrderStatus(Request $request)
    {
        $request->validate([
            'status1' => 'required',
            'status_id' => 'required'
        ]);
        $order = Order::findOrFail($request->status_id);
        $order->status = $request->status1;
        $order->save();
        session()->flash('message','Order Status Updated.');
        session()->flash('type','success');
        return redirect()->route('order-view',$order->order_number);
    }

    public function manageStaff()
    {
        $data['page_title'] = 'Manage Staff';
        $data['staff'] = Staff::all();
        return view('dashboard.staff',$data);
    }
    public function storeStaff(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:staff',
            'name' => 'required',
            'password' => 'required|confirmed|min:5'
        ]);
        $in = Input::except('_method','_token');
        $in['password'] = bcrypt($request->password);
        $product = Staff::create($in);
        return response()->json($product);

    }
    public function editStaff($product_id)
    {
        $product = Staff::find($product_id);
        return response()->json($product);
    }
    public function updateStaff(Request $request,$product_id)
    {
        $product = Staff::find($product_id);
        $request->validate([
            'email' => 'required|unique:staff,email,'.$product->id,
            'name' => 'required',
            'password' => 'nullable|confirmed|min:5'
        ]);
        $product->name = $request->name;
        $product->email = $request->email;
        if ($request->password != null){
            $product->password = bcrypt($request->password);
        }
        $product->save();
        return response()->json($product);
    }
    public function manageSize()
    {
        $data['page_title'] = "Manage Product Size";
        $data['size'] = Size::all();
        $data['category'] = Category::all();
        return view('dashboard.size', $data);
    }
    public function storeSize(Request $request)
    {
        $this->validate($request,[
            'category_id' => 'required',
            'name' => 'required|unique:sizes,name,category_id'
        ]);

        $data = new Size();
        $data->name = $request->name;
        $data->category_id = $request->category_id;
        $data->save();
        $data['categoryName'] = Category::findOrFail($request->category_id)->name;
        return response()->json($data);

    }
    public function editSize($product_id)
    {
        $product = Size::find($product_id);
        return response()->json($product);
    }
    public function updateSize(Request $request,$product_id)
    {
        $product = Size::find($product_id);
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|unique:sizes,name,NULL,id,category_id,'.$request->category_id,
        ]);
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->save();
        $product['categoryName'] = Category::findOrFail($request->category_id)->name;
        return response()->json($product);
    }
    public function manageColor()
    {
        $data['page_title'] = "Manage Product Color";
        $data['color'] = Color::all();
        $data['category'] = Category::all();
        return view('dashboard.color', $data);
    }
    public function storeColor(Request $request)
    {
        $this->validate($request,[
            'category_id' => 'required',
            'name' => 'required|unique:colors,name,NULL,id,category_id,'.$request->category_id,
        ]);

        $data = new Color();
        $data->name = $request->name;
        $data->category_id = $request->category_id;
        $data->save();
        $data['categoryName'] = Category::findOrFail($request->category_id)->name;
        return response()->json($data);

    }
    public function editColor($product_id)
    {
        $product = Color::find($product_id);
        return response()->json($product);
    }
    public function updateColor(Request $request,$product_id)
    {
        $product = Color::find($product_id);
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|unique:colors,name,NULL,id,category_id,'.$request->category_id,
        ]);
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->save();
        $product['categoryName'] = Category::findOrFail($request->category_id)->name;
        return response()->json($product);
    }
    public function manageTags()
    {
        $data['page_title'] = "Manage Product Tags";
        $data['tags'] = Tag::latest()->paginate(15);
        return view('dashboard.tags', $data);
    }
    public function storeTags(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:tags,name'
        ]);

        $data = new Tag();
        $data->name = $request->name;
        $data->save();
        return response()->json($data);

    }
    public function editTags($product_id)
    {
        $product = Tag::find($product_id);
        return response()->json($product);
    }
    public function updateTags(Request $request,$product_id)
    {
        $product = Tag::find($product_id);
        $request->validate([
            'name' => 'required|unique:tags,name,'.$product->id,
        ]);
        $product->name = $request->name;
        $product->save();
        return response()->json($product);
    }

    public function createProvider()
    {
        $data['page_title'] = 'Add New Provider';
        return view('dashboard.provider-create',$data);
    }

    public function storeProvider(Request $request)
    {
        $request->validate([
           'name' => 'required',
           'email' => 'required|email|unique:providers,email',
           'phone' => 'required|numeric|unique:providers,phone',
            'country_code' => 'required',
            'address' => 'required',
            'password' => 'required|confirmed'
        ]);
        $in = Input::except('_method','_token','password_confirmation');
        $in['password'] = Hash::make($request->password);
        Provider::create($in);
        $this->provideConfirm($request->name,$request->email,$request->password);
        session()->flash('message','Provider Created Successfully.');
        session()->flash('type','success');
        return redirect()->back();
    }

    public function allProvider()
    {
        $data['page_title'] = 'All Provider';
        $data['provider'] = Provider::latest()->get();
        return view('dashboard.provider-all',$data);
    }

    public function statusProvider(Request $request)
    {
        $request->validate([
           'id' => 'required'
        ]);
        $provider = Provider::findOrFail($request->id);
        if ($provider->status == 0){
            $provider->status = 1;
            $provider->save();
            session()->flash('message','Provider Block SuccessFully');
            session()->flash('type','success');
            return redirect()->back();
        }else{
            $provider->status = 0;
            $provider->save();
            session()->flash('message','Provider UnBlock SuccessFully');
            session()->flash('type','success');
            return redirect()->back();
        }
    }

    public function viewProvider($id)
    {
        $data['page_title'] = 'Provider Details';
        $data['provider'] = Provider::findOrFail($id);
        return view('dashboard.provider-view',$data);
    }
    public function RegisterStatusProvider(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        $provider = Provider::findOrFail($request->id);
        if ($provider->register_status == 0){
            $provider->register_status = 1;
            $provider->save();
            session()->flash('message','Provider Approve SuccessFully');
            session()->flash('type','success');
            return redirect()->back();
        }else{
            $provider->register_status = 0;
            $provider->save();
            session()->flash('message','Provider Reject SuccessFully');
            session()->flash('type','success');
            return redirect()->back();
        }
    }
    public function editProvider($id)
    {
        $data['page_title'] = "Edit Provider";
        $data['provider'] = Provider::findOrFail($id);
        return view('dashboard.provider-edit',$data);
    }

    public function updateProvider(Request $request, $id)
    {
        $provider = Provider::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:providers,email,'.$id,
            'phone' => 'required|numeric|unique:providers,phone,'.$id,
            'country_code' => 'required',
            'address' => 'required',
        ]);
        $in = Input::except('_method','_token');
        $provider->update($in);
        session()->flash('message','Provider Update Successfully.');
        session()->flash('type','success');
        return redirect()->back();
    }

    public function passwordProvider(Request $request)
    {
        $request->validate([
           'id' => 'required',
           'password' => 'required|confirmed|min:5'
        ]);
        $provider = Provider::findOrFail($request->id);
        $provider->password = Hash::make($request->password);
        $provider->save();
        $this->changeProviderPassword($provider->name,$provider->email,$request->password);
        session()->flash('message','Provider Password Changes.');
        session()->flash('type','success');
        return redirect()->back();
    }

    public function getTransactionLog()
    {
        $data['page_title'] = 'Transaction Log';
        $data['log'] = TransactionLog::latest()->paginate(10);
        return view('dashboard.transaction-log',$data);
    }

    public function providerProduct()
    {
        $data['page_title'] = 'Provider Provider';
        $data['products'] = Product::where('provider_id','!=',0)->latest()->paginate(15);
        return view('dashboard.provider-product',$data);
    }

}
