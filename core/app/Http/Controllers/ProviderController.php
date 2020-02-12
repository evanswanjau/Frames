<?php

namespace App\Http\Controllers;

use App\Category;
use App\ChildCategory;
use App\Color;
use App\Order;
use App\OrderItem;
use App\Partner;
use App\Product;
use App\ProductImage;
use App\ProductSpecification;
use App\Provider;
use App\Size;
use App\Subcategory;
use App\Tag;
use App\TransactionLog;
use App\UserDetails;
use App\WithdrawLog;
use App\WithdrawMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProviderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:provider');
        $this->middleware('provider');
    }

    public function getDashboard()
    {
        $data['page_title'] = 'Dashboard';
        $id = Auth::user()->id;
        $data['totalProduct'] = Product::whereProvider_id($id)->count();
        $data['totalPending'] = Product::whereProvider_id($id)->whereStatus(0)->count();
        $data['totalConfirm'] = Product::whereProvider_id($id)->whereStatus(1)->count();
        $data['balance'] = Auth::user()->balance;
        $data['totalWithdraw'] = WithdrawLog::whereProvider_id($id)->whereStatus(1)->sum('amount');
        $data['totalPending'] = WithdrawLog::whereProvider_id($id)->whereStatus(0)->sum('amount');
        $data['totalRefund'] = WithdrawLog::whereProvider_id($id)->whereStatus(2)->sum('amount');
        return view('provider.dashboard',$data);
    }
    public function getChangePass()
    {
        $data['page_title'] = "Change Password";
        return view('provider.change-password',$data);
    }
    public function postChangePass(Request $request)
    {
        $this->validate($request, [
            'current_password' =>'required',
            'password' => 'required|min:5|confirmed'
        ]);
        try {
            $c_password = Auth::guard('provider')->user()->password;
            $c_id = Auth::guard('provider')->user()->id;

            $user = Provider::findOrFail($c_id);

            if(Hash::check($request->current_password, $c_password)){

                $password = Hash::make($request->password);
                $user->password = $password;
                $user->save();
                session()->flash('message', 'Password Changes Successfully.');
                session()->flash('type','success');
                return redirect()->back();
            }else{
                session()->flash('message', 'Current Password Not Match');
                session()->flash('type','warning');
                return redirect()->back();
            }

        } catch (\PDOException $e) {
            session()->flash('message', $e->getMessage());
            session()->flash('type','warning');
            return redirect()->back();
        }

    }
    public function editProfile()
    {
        $data['page_title'] = "Edit Provider Profile";
        $data['admin'] = Provider::findOrFail(Auth::user()->id);
        return view('provider.edit-profile',$data);
    }

    public function updateProfile(Request $request)
    {
        $admin = Provider::findOrFail(Auth::user()->id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:staff,email,'.$admin->id,
            'image' => 'mimes:png,jpg,jpeg'
        ]);
        $in = Input::except('_method','_token');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/' . $filename;
            Image::make($image)->resize(215,215)->save($location);
            if ($admin->image != 'admin-default.png'){
                $path = './assets/images/'.$admin->image;
                File::delete($path);
            }
            $in['image'] = $filename;
        }
        $admin->fill($in)->save();
        session()->flash('message','Profile Updated Successfully.');
        session()->flash('type','success');
        return redirect()->back();
    }

    public function availableCategory()
    {
        $data['page_title'] = 'Available Category';
        $data['category'] = Category::latest()->get();
        return view('provider.category-available',$data);
    }
    public function addProduct()
    {
        $data['page_title'] = "Add New Product";
        $data['category'] = Category::all();
        $data['partner'] = Partner::all();
        $data['size'] = Size::all();
        $data['color'] = Color::all();
        $data['tags'] = Tag::all();
        return view('provider.product-create',$data);
    }

    public function providerCharge($current_price, $category_id)
    {
        $category = Category::findOrFail($category_id);
        $charge = round((($current_price * $category->percent)/100),2);
        $available = $current_price - $charge;
        $rr = [
            'charge' => $charge,
            'rest_amount' => $available,
        ];
        return $result = json_encode($rr);
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
        $in['status'] = 0;
        $in['color_status'] = $request->color_status;
        $in['size_status'] = $request->size_status;
        $in['provider_id'] = Auth::user()->id;
        $category = Category::findOrFail($request->category_id);
        $in['charge'] = round((($request->current_price * $category->percent)/100),2);
        $in['rest_amount'] = $request->current_price - $in['charge'];
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
        $data['products'] = Product::whereProvider_id(Auth::user()->id)->orderBy('id','desc')->get();
        return view('provider.product-all',$data);
    }
    public function editProduct($id)
    {
        $pCheck = Product::whereId($id)->whereProvider_id(Auth::user()->id)->count();
        if ($pCheck == 0){
            session()->flash('message','Wrong try to Edit.');
            session()->flash('type','warning');
            return redirect()->back();
        }else{
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
            return view('provider.product-edit',$data);
        }
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
        $in['color_status'] = $request->color_status;
        $in['size_status'] = $request->size_status;
        $in['provider_id'] = Auth::user()->id;
        $category = Category::findOrFail($request->category_id);
        $in['charge'] = round((($request->current_price * $category->percent)/100),2);
        $in['rest_amount'] = $request->current_price - $in['charge'];
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
    public function allOrder()
    {
        $data['page_title'] = "All Order";
        $data['order'] = OrderItem::whereProvider_id(Auth::user()->id)->orderBy('id','desc')->get();
        return view('provider.order-all',$data);
    }
    public function pendingOrder()
    {
        $data['page_title'] = "Pending Order";
        $data['order'] = OrderItem::whereStatus(0)->whereProvider_id(Auth::user()->id)->orderBy('id','desc')->get();
        return view('provider.order-all',$data);
    }
    public function confirmOrder()
    {
        $data['page_title'] = "Confirm Order";
        $data['order'] = OrderItem::whereStatus(1)->whereProvider_id(Auth::user()->id)->orderBy('id','desc')->get();
        return view('provider.order-all',$data);
    }
    public function cancelOrder()
    {
        $data['page_title'] = "Cancel Order";
        $data['order'] = Order::whereStatus(2)->orderBy('id','desc')->get();
        return view('provider.order-all',$data);
    }

    public function viewOrder($order,$id)
    {
        $data['page_title'] = "Order Details";
        $data['orderItem'] = OrderItem::whereId($id)->whereOrderNumber($order)->whereProvider_id(Auth::user()->id)->count();
        if($data['orderItem'] == 0){
            session()->flash('message','Something is Wrong.');
            session()->flash('type','success');
            return redirect()->back();
        }else{
            $data['orderItem'] = OrderItem::whereId($id)->whereOrderNumber($order)->whereProvider_id(Auth::user()->id)->first();
        }
        $data['order'] = Order::whereOrder_number($order)->first();
        return view('provider.order-view',$data);
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

    public function updateOrderConfirm(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $order = OrderItem::findOrFail($request->id);
        $order->status = 1;
        $provider = Provider::findOrFail($order->provider_id);

        $tr['custom'] = strtoupper(Str::random(12));
        $tr['provider_id'] = Auth::user()->id;
        $tr['type'] = 1 ;
        $tr['balance'] = $order->provider_amount;
        $tr['post_balance'] = $provider->balance + $order->provider_amount;
        $tr['details'] = 'Product Sell';
        TransactionLog::create($tr);


        $provider->balance += $order->provider_amount;
        $provider->save();


        $order->save();
        session()->flash('message','Order Successfully Confirm.');
        session()->flash('type','success');
        return redirect()->back();
    }

    public function withdrawNow()
    {
        $data['page_title'] = 'Withdraw Now';
        $data['method'] = WithdrawMethod::whereStatus(1)->get();
        return view('provider.withdraw-now',$data);
    }

    public function withdrawMethod($id)
    {
        $withdraw = WithdrawMethod::findOrFail($id);
        $data['page_title'] = 'Withdraw Via - '.$withdraw->name;
        $data['method'] = $withdraw;
        $data['user'] = Provider::findOrFail(Auth::user()->id);
        return view('provider.withdraw-preview',$data);
    }

    public function checkWithdraw($av,$amount,$min,$max)
    {
        if ($amount > $av){
            $rr = [
                'errorStatus' => 'yes',
                'errorDetails' => 'Amount Large Then Available Amount',
            ];
            return $result = json_encode($rr);
        }elseif ($amount < $min){
            $rr = [
                'errorStatus' => 'yes',
                'errorDetails' => 'Amount Small Then Minimum Amount',
            ];
            return $result = json_encode($rr);
        }elseif ($amount > $max){
            $rr = [
                'errorStatus' => 'yes',
                'errorDetails' => 'Amount Large Then Maximum Amount',
            ];
            return $result = json_encode($rr);
        }else{
            $rr = [
                'errorStatus' => 'no',
                'errorDetails' => 'You Can withdraw This Amount.',
            ];
            return $result = json_encode($rr);
        }
    }
    public function withdrawConfirm(Request $request)
    {

        $request->validate([
            'method_id' => 'required',
            'amount' => 'required|numeric',
            'details' => 'required'
        ]);

        $user = Provider::findOrFail(Auth::user()->id);

        $method = WithdrawMethod::findOrFail($request->method_id);

        $available = $user->balance - $method->charge;
        $amount = $request->amount;

        if ($amount > $available){
            session()->flash('message','Amount Large Then Available Amount');
            session()->flash('type','warning');
            return redirect()->route('user-withdraw-method',$method->id);
        }elseif ($amount < $method->withdraw_min){
            session()->flash('message','Amount Small Then Minimum Amount');
            session()->flash('type','warning');
            return redirect()->route('user-withdraw-method',$method->id);
        }elseif ($amount > $method->withdraw_max){
            session()->flash('message','Amount Small Then Maximum Amount');
            session()->flash('type','warning');
            return redirect()->route('user-withdraw-method',$method->id);
        }else{

            $withLog['custom'] = strtoupper(Str::random(12));

            $tr['custom'] = $withLog['custom'];
            $tr['provider_id'] = $user->id;
            $tr['type'] = 4 ;
            $tr['balance'] = $method->charge;
            $tr['post_balance'] = $user->balance - ($request->amount + $method->charge);
            $tr['details'] = 'Withdraw Charge For '.$method->name;
            TransactionLog::create($tr);

            $tr['custom'] = $withLog['custom'];
            $tr['provider_id'] = $user->id;
            $tr['type'] = 3 ;
            $tr['balance'] = $request->amount;
            $tr['post_balance'] = $user->balance - $request->amount;
            $tr['details'] = 'Withdraw Via '.$method->name;
            TransactionLog::create($tr);

            $withLog['provider_id'] = $user->id;
            $withLog['method_id'] = $method->id;
            $withLog['amount'] = $request->amount;
            $withLog['charge'] = $method->charge;
            $withLog['details'] = $request->details;
            $withLog['status'] = 0;
            WithdrawLog::create($withLog);

            $user->balance = $user->balance - ($request->amount + $method->charge);
            $user->save();

            \session()->flash('message','Withdraw Request Accept.');
            \session()->flash('type','success');
            return redirect()->route('provider-withdraw-now');
        }
    }

    public function withdrawHistory()
    {
        $data['page_title'] = 'Withdraw History';
        $data['log'] = WithdrawLog::whereProvider_id(Auth::user()->id)->latest()->get();
        return view('provider.withdraw-history',$data);
    }

    public function transactionLog()
    {
        $data['page_title'] = "Transaction Log";
        $data['log'] = TransactionLog::whereProvider_id(Auth::user()->id)->latest()->get();
        return view('provider.transaction-log',$data);
    }


}
