<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\BasicSetting;
use App\Category;
use App\Channel;
use App\ChildCategory;
use App\Color;
use App\Comment;
use App\Menu;
use App\Order;
use App\OrderItem;
use App\Partner;
use App\Product;
use App\ProductImage;
use App\ProductSpecification;
use App\Provider;
use App\Review;
use App\Size;
use App\Slider;
use App\Speciality;
use App\Subcategory;
use App\Subscribe;
use App\Tag;
use App\Testimonial;
use App\TraitsFolder\CommonTrait;
use App\User;
use App\UserDetails;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    use CommonTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {


//        dd(Cart::content());
        $data['page_title'] = "Home Page";
        $data['slider'] = Slider::all();
        $data['speciality'] = Speciality::all();
        $data['category'] = Category::all();
        $data['testimonial'] = Testimonial::whereStatus(1)->get();
        $data['ad1'] = Advertisement::whereAdvert_size(1)->whereStatus(1)->inRandomOrder()->first();
        $data['ad2'] = Advertisement::whereAdvert_size(2)->whereStatus(1)->inRandomOrder()->first();
        $data['ad3'] = Advertisement::whereAdvert_size(3)->whereStatus(1)->inRandomOrder()->first();
        $data['ad4'] = Advertisement::whereAdvert_size(4)->whereStatus(1)->inRandomOrder()->first();
        $data['featuredProduct'] = Product::whereStatus(1)->whereFeatured(1)->orderBy('id','desc')->take(9)->get();
        $data['latestProduct'] = Product::whereStatus(1)->orderBy('id','desc')->paginate(12);
        $data['band'] = Partner::all();
        $data['color'] = Color::all();
        $data['size'] = Size::all();
        $data['bestSell'] = DB::table('order_items')
            ->select('product_id', DB::raw('SUM(qty) as total_qty'))
            ->groupBy('product_id')
            ->orderBy('total_qty','desc')
            ->take(6)
            ->get();
        return view('home.home',$data);
    }

    public function getAbout()
    {
        $data['page_title'] = "About Page";
        $data['testimonial'] = Testimonial::all();
        $data['ad4'] = Advertisement::whereAdvert_size(4)->whereStatus(1)->inRandomOrder()->first();
        $data['testimonial_hide'] = 0;
        $data['filed_name'] = "about";
        return view('home.about',$data);
    }

    public function getTermsCondition()
    {
        $data['page_title'] = "Terms & Condition";
        $data['testimonial'] = Testimonial::all();
        $data['testimonial_hide'] = 1;
        $data['ad4'] = Advertisement::whereAdvert_size(4)->whereStatus(1)->inRandomOrder()->first();
        $data['filed_name'] = "terms";
        return view('home.about',$data);
    }
    public function getPrivacyPolicy()
    {
        $data['page_title'] = "Privacy Policy Page";
        $data['testimonial'] = Testimonial::all();
        $data['testimonial_hide'] = 1;
        $data['ad1'] = Advertisement::whereAdvert_size(1)->whereStatus(1)->inRandomOrder()->first();
        $data['ad2'] = Advertisement::whereAdvert_size(2)->whereStatus(1)->inRandomOrder()->first();
        $data['ad3'] = Advertisement::whereAdvert_size(3)->whereStatus(1)->inRandomOrder()->first();
        $data['ad4'] = Advertisement::whereAdvert_size(4)->whereStatus(1)->inRandomOrder()->first();
        $data['filed_name'] = "privacy";
        return view('home.about',$data);
    }

    public function getContact()
    {
        $data['page_title'] = "Contact Page";
        $data['ad4'] = Advertisement::whereAdvert_size(4)->whereStatus(1)->inRandomOrder()->first();
        return view('home.contact',$data);
    }
    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ]);
        $this->sendContact($request->email,$request->name,$request->subject,$request->message,$request->phone);
        session()->flash('message','Contact Message Successfully Send.');
        return redirect()->back();
    }

    public function submitSubscribe(Request $request)
    {
        $request->validate([
           'email' => 'required|email|unique:subscribes,email'
        ]);
        $in = Input::except('_method','_token');
        Subscribe::create($in);
        session()->flash('message','Subscribe Completed.');
        session()->flash('type','success');
        return redirect()->back();
    }

    public function getCategoryProduct($id, $slug)
    {
        $category = Category::findOrFail($id);
        $data['page_title'] = $category->name." - Products";
        $data['product'] = Product::whereStatus(1)->whereCategory_id($id)->orderBy('id','desc')->paginate(12);
        $data['category'] = Category::all();
        $data['ad1'] = Advertisement::whereAdvert_size(1)->whereStatus(1)->inRandomOrder()->first();
        $data['ad2'] = Advertisement::whereAdvert_size(2)->whereStatus(1)->inRandomOrder()->first();
        $data['ad3'] = Advertisement::whereAdvert_size(3)->whereStatus(1)->inRandomOrder()->first();
        $data['ad4'] = Advertisement::whereAdvert_size(4)->whereStatus(1)->inRandomOrder()->first();
        $data['band'] = Partner::all();
        $data['color'] = Color::whereCategory_id($id)->get();
        $data['size'] = Size::whereCategory_id($id)->get();
        $data['main_category'] = $id;
        $data['bestSell'] = DB::table('order_items')
            ->select('product_id', DB::raw('SUM(qty) as total_qty'))
            ->groupBy('product_id')
            ->orderBy('total_qty','desc')
            ->take(5)
            ->get();
        return view('home.category',$data);
    }

    public function productRangePrice(Request $request)
    {
        $basic = BasicSetting::first();
        $rr = explode('-',$request->range_price);
        $start = (int)str_replace($basic->symbol, "", trim($rr[0]));
        $end = (int)str_replace($basic->symbol, "", trim($rr[1]));
        $data['page_title'] = trim($rr[0])." - ".trim($rr[1])." - Products";

        $data['product'] = Product::whereBetween('current_price',[$start,$end])->whereStatus(1)->orderBy('id','desc')->take(9)->get();
        $data['category'] = Category::all();
        $data['ad1'] = Advertisement::whereAdvert_size(1)->whereStatus(1)->inRandomOrder()->first();
        $data['ad2'] = Advertisement::whereAdvert_size(2)->whereStatus(1)->inRandomOrder()->first();
        $data['ad3'] = Advertisement::whereAdvert_size(3)->whereStatus(1)->inRandomOrder()->first();
        $data['ad4'] = Advertisement::whereAdvert_size(4)->whereStatus(1)->inRandomOrder()->first();
        $data['bestSell'] = DB::table('order_items')
            ->select('product_id', DB::raw('SUM(qty) as total_qty'))
            ->groupBy('product_id')
            ->orderBy('total_qty','desc')
            ->take(5)
            ->get();
        return view('home.sub-product',$data);

    }

    public function partnerProduct($id)
    {
        $data['page_title'] = "Partner Products";
        $data['product'] = Product::wherePartner_id($id)->whereStatus(1)->orderBy('id','desc')->paginate(12);
        $data['category'] = Category::all();
        $data['ad1'] = Advertisement::whereAdvert_size(1)->whereStatus(1)->inRandomOrder()->first();
        $data['ad2'] = Advertisement::whereAdvert_size(2)->whereStatus(1)->inRandomOrder()->first();
        $data['ad3'] = Advertisement::whereAdvert_size(3)->whereStatus(1)->inRandomOrder()->first();
        $data['ad4'] = Advertisement::whereAdvert_size(4)->whereStatus(1)->inRandomOrder()->first();
        $data['bestSell'] = DB::table('order_items')
            ->select('product_id', DB::raw('SUM(qty) as total_qty'))
            ->groupBy('product_id')
            ->orderBy('total_qty','desc')
            ->take(5)
            ->get();
        return view('home.sub-product',$data);
    }

    public function getProviderProduct($id)
    {
        $provider = Provider::findOrFail($id);
        $data['page_title'] = $provider->name." - All Products";
        $data['product'] = Product::whereProvider_id($id)->whereStatus(1)->orderBy('id','desc')->paginate(12);
        $data['category'] = Category::all();
        $data['ad1'] = Advertisement::whereAdvert_size(1)->whereStatus(1)->inRandomOrder()->first();
        $data['ad2'] = Advertisement::whereAdvert_size(2)->whereStatus(1)->inRandomOrder()->first();
        $data['ad3'] = Advertisement::whereAdvert_size(3)->whereStatus(1)->inRandomOrder()->first();
        $data['ad4'] = Advertisement::whereAdvert_size(4)->whereStatus(1)->inRandomOrder()->first();
        $data['bestSell'] = DB::table('order_items')
            ->select('product_id', DB::raw('SUM(qty) as total_qty'))
            ->groupBy('product_id')
            ->orderBy('total_qty','desc')
            ->take(5)
            ->get();
        return view('home.sub-product',$data);
    }

    public function getSubCategoryProduct($id, $slug)
    {
        $category = Subcategory::findOrFail($id);
        $data['page_title'] = $category->name." - Products";
        $data['product'] = Product::whereStatus(1)->whereSubcategory_id($id)->orderBy('id','desc')->paginate(12);
        $data['category'] = Category::all();
        $data['ad1'] = Advertisement::whereAdvert_size(1)->whereStatus(1)->inRandomOrder()->first();
        $data['ad2'] = Advertisement::whereAdvert_size(2)->whereStatus(1)->inRandomOrder()->first();
        $data['ad3'] = Advertisement::whereAdvert_size(3)->whereStatus(1)->inRandomOrder()->first();
        $data['ad4'] = Advertisement::whereAdvert_size(4)->whereStatus(1)->inRandomOrder()->first();
        $data['band'] = Partner::all();
        $data['color'] = Color::whereCategory_id($category->category_id)->get();
        $data['size'] = Size::whereCategory_id($category->category_id)->get();
        $data['main_category'] = $category->category_id;
        $data['bestSell'] = DB::table('order_items')
            ->select('product_id', DB::raw('SUM(qty) as total_qty'))
            ->groupBy('product_id')
            ->orderBy('total_qty','desc')
            ->take(5)
            ->get();
        return view('home.category',$data);
    }
    public function getChildCategoryProduct($id, $slug)
    {
        $category = ChildCategory::findOrFail($id);
        $data['page_title'] = $category->name." - Products";
        $data['product'] = Product::whereStatus(1)->whereChildcategory_id($id)->orderBy('id','desc')->paginate(12);
        $data['category'] = Category::all();
        $data['ad1'] = Advertisement::whereAdvert_size(1)->whereStatus(1)->inRandomOrder()->first();
        $data['ad2'] = Advertisement::whereAdvert_size(2)->whereStatus(1)->inRandomOrder()->first();
        $data['ad3'] = Advertisement::whereAdvert_size(3)->whereStatus(1)->inRandomOrder()->first();
        $data['ad4'] = Advertisement::whereAdvert_size(4)->whereStatus(1)->inRandomOrder()->first();
        $data['band'] = Partner::all();
        $data['band'] = Partner::all();
        $data['color'] = Color::whereCategory_id($category->category_id)->get();
        $data['size'] = Size::whereCategory_id($category->category_id)->get();
        $data['main_category'] = $category->category_id;
        $data['bestSell'] = DB::table('order_items')
            ->select('product_id', DB::raw('SUM(qty) as total_qty'))
            ->groupBy('product_id')
            ->orderBy('total_qty','desc')
            ->take(5)
            ->get();
        return view('home.category',$data);
    }

    public function rangePrice(Request $request)
    {


        //

        $basic = BasicSetting::first();
        $rr = explode('-',$request->range_price);
        $start = (int)str_replace($basic->symbol, "", trim($rr[0]));
        $end = (int)str_replace($basic->symbol, "", trim($rr[1]));
        $data['page_title'] = trim($rr[0])." - ".trim($rr[1])." - Products";


        $category = $request->category;
        $band = $request->band;
        $size = $request->size;
        $color = $request->color;

        if ($band == 0){
         $rangeProduct = Product::whereCategory_id($category)->whereStatus(1)->whereBetween('current_price',[$start,$end])->orderBy('id','desc')->pluck('id')->toArray();
        }else{
            $rangeProduct = Product::wherePartner_id($band)->whereCategory_id($category)->whereStatus(1)->whereBetween('current_price',[$start,$end])->orderBy('id','desc')->pluck('id')->toArray();
        }

        if ($color == 0){
            $colorProduct = $rangeProduct;
        }else{
            $colorP = Color::findOrFail($color);
            $colorProduct = $colorP->products->pluck('id')->toArray();
        }

        if ($size == 0){
            $sizeProduct = $rangeProduct;
        }else{
            $sizeP = Size::findOrFail($size);
            $sizeProduct = $sizeP->products->pluck('id')->toArray();
        }

        $mainProduct = array_intersect($rangeProduct,$colorProduct,$sizeProduct);

        $data['product'] = Product::whereIn('id',$mainProduct)->get();
        $data['category'] = Category::all();
        $data['ad1'] = Advertisement::whereAdvert_size(1)->whereStatus(1)->inRandomOrder()->first();
        $data['ad2'] = Advertisement::whereAdvert_size(2)->whereStatus(1)->inRandomOrder()->first();
        $data['ad3'] = Advertisement::whereAdvert_size(3)->whereStatus(1)->inRandomOrder()->first();
        $data['ad4'] = Advertisement::whereAdvert_size(4)->whereStatus(1)->inRandomOrder()->first();
        $data['band'] = Partner::all();
        $data['main_category'] = $category;
        $data['color'] = Color::whereCategory_id($category)->get();
        $data['size'] = Size::whereCategory_id($category)->get();
        $data['bestSell'] = DB::table('order_items')
            ->select('product_id', DB::raw('SUM(qty) as total_qty'))
            ->groupBy('product_id')
            ->orderBy('total_qty','desc')
            ->take(5)
            ->get();
        return view('home.category',$data);

    }
    public function getSearchProduct(Request $request)
    {
        $data['page_title'] = $request->name." - Products";
        $data['product'] = Product::whereStatus(1)->where('name','like','%' . Input::get('name') . '%')->orderBy('id','desc')->paginate(12);

        if (count($data['product']) == 0){
            $data['band'] = Partner::all();
            $data['main_category'] = null;
            $data['color'] = [];
            $data['size'] = [];
        }else{
            $CatP = $data['product']->first();
            $category = $CatP->category_id;
            $data['band'] = Partner::all();
            $data['main_category'] = $category;
            $data['color'] = Color::whereCategory_id($category)->get();
            $data['size'] = Size::whereCategory_id($category)->get();
        }

        $data['category'] = Category::all();
        $data['ad1'] = Advertisement::whereAdvert_size(1)->whereStatus(1)->inRandomOrder()->first();
        $data['ad2'] = Advertisement::whereAdvert_size(2)->whereStatus(1)->inRandomOrder()->first();
        $data['ad3'] = Advertisement::whereAdvert_size(3)->whereStatus(1)->inRandomOrder()->first();
        $data['ad4'] = Advertisement::whereAdvert_size(4)->whereStatus(1)->inRandomOrder()->first();
        $data['bestSell'] = DB::table('order_items')
            ->select('product_id', DB::raw('SUM(qty) as total_qty'))
            ->groupBy('product_id')
            ->orderBy('total_qty','desc')
            ->take(5)
            ->get();
        return view('home.search-product',$data);
    }

    public function getTagProduct($id)
    {
        $data['tag'] = Tag::findOrFail($id);
        $data['page_title'] = $data['tag']->name." - Tag Product";
        $data['category'] = Category::all();
        $data['ad1'] = Advertisement::whereAdvert_size(1)->whereStatus(1)->inRandomOrder()->first();
        $data['ad2'] = Advertisement::whereAdvert_size(2)->whereStatus(1)->inRandomOrder()->first();
        $data['ad3'] = Advertisement::whereAdvert_size(3)->whereStatus(1)->inRandomOrder()->first();
        $data['ad4'] = Advertisement::whereAdvert_size(4)->whereStatus(1)->inRandomOrder()->first();
        $data['bestSell'] = DB::table('order_items')
            ->select('product_id', DB::raw('SUM(qty) as total_qty'))
            ->groupBy('product_id')
            ->orderBy('total_qty','desc')
            ->take(5)
            ->get();
        return view('home.tag-product',$data);
    }

    public function getProductDetails($slug)
    {
        $product = Product::whereSlug($slug)->first();
        $product->view = $product->view + 1;
        $data['page_title'] = $product->name;
        $data['category'] = Category::all();
        $data['product'] = $product;
        $data['productImage'] = ProductImage::whereProduct_id($product->id)->get();
        $data['productSpecification'] = ProductSpecification::whereProduct_id($product->id)->get();
        $data['productTag'] = explode(',',$product->tags);
        $data['relatedProduct'] = Product::whereStatus(1)->whereCategory_id($product->category_id)->take(10)->get();
        $product->save();
        $data['productReviews'] = Review::whereProduct_id($product->id)->get();
        $data['productComment'] = Comment::whereProduct_id($product->id)->get();
        $data['ad1'] = Advertisement::whereAdvert_size(1)->whereStatus(1)->inRandomOrder()->first();
        $data['ad2'] = Advertisement::whereAdvert_size(2)->whereStatus(1)->inRandomOrder()->first();
        $data['ad3'] = Advertisement::whereAdvert_size(3)->whereStatus(1)->inRandomOrder()->first();
        $data['ad4'] = Advertisement::whereAdvert_size(4)->whereStatus(1)->inRandomOrder()->first();
        $tags = null;
        foreach ($product->tags as $t){
            $tags.= $t->name.', ';
        }
        $data['tags'] = $tags;
        $data['meta_status'] = 2;
        return view('home.product-details',$data);
    }

    public function submitFriendEmail(Request $request)
    {
        $request->validate([
           'name' => 'required',
            'ownEmail' => 'email|required',
            'friendEmail' => 'email|required',
            'url' => 'required|url',
        ]);
        $this->friendEmail($request->name,$request->ownEmail,$request->friendEmail,$request->url,$request->message);
        session()->flash('message','Email Successfully Send.');
        session()->flash('type','success');
        return redirect()->back();
    }



    public function getCart()
    {
        $data['page_title'] = 'Shopping Cart';
//        Cart::destroy();

        $cart = Cart::content();
        if (count($cart) == 0){
            \session()->flash('message','Cart is Empty Add an Item First.');
            \session()->flash('type','warning');
            return redirect()->route('home');
        }else{
            return view('home.cart',$data);
        }

    }

    public function orderCompleted($oderNumber)
    {
        $data['page_title'] = 'Order Purchase Confirm';
        $data['order'] = Order::whereOrder_number($oderNumber)->first();
        if ($data['order'] == null){
            session()->flash('message','Order Number Invalid.');
            session()->flash('type','warning');
            return redirect()->route('home');
        }else{
            $data['orderItem'] = OrderItem::whereOrder_id($data['order']->id)->get();
            $data['userDetails'] = UserDetails::whereUser_id($data['order']->user_id)->first();
        }
        return view('home.order-confirm',$data);
    }

    public function submitCronJob()
    {
        $order = Order::whereStatus(0)->get();
        foreach ($order as $c){

            if (Carbon::parse($c->expire_time)->isPast()){
                $c->status = 2;
                $items = OrderItem::whereOrder_id($c->id)->get();
                foreach ($items as $t){
                    $product = Product::findOrFail($t->product_id);
                    $product->stock = $product->stock + $t->qty;
                    $product->save();
                }
                $c->save();
            }
        }
    }

    public function getCompare()
    {

        //Session::forget('compare');

        $data['page_title'] = "Compare Product";
        $data['compare'] = Session::get('compare');

        if (count($data['compare']) == 1){
            $data['status'] = 1;
            $id1 = Session::get('compare.0');
            $data['product1'] = Product::findOrFail($id1);
        }elseif (count($data['compare']) == 2){
            $data['status'] = 2;
            $id1 = Session::get('compare.0');
            $data['product1'] = Product::findOrFail($id1);
            $id2 = Session::get('compare.1');
            $data['product2'] = Product::findOrFail($id2);
        }elseif(count($data['compare']) == 3){
            $data['status'] = 3;
            $id1 = Session::get('compare.0');
            $data['product1'] = Product::findOrFail($id1);
            $id2 = Session::get('compare.1');
            $data['product2'] = Product::findOrFail($id2);
            $id3 = Session::get('compare.2');
            $data['product3'] = Product::findOrFail($id3);
        }else{
            $data['product0'] = null;
        }
        return view('home.compare',$data);
    }

    public function addCompare($id)
    {
        //Session::forget('compare');
        if (Session::has('compare')){
            $product = Session::get('compare');
            if (count($product) < 3){

                if (in_array($id,$product)){
                    $rr = [
                        'errorStatus' => 'yes',
                        'errorDetails' => 'Product Already In Compare',
                    ];
                    return $result = json_encode($rr);
                }else{
                    if ($product == null){
                        $product = [$id];
                        Session::put('compare',$product);
                        $rr = [
                            'errorStatus' => 'no',
                            'errorDetails' => 'Product Added to Compare',
                        ];
                        return $result = json_encode($rr);
                    }else{
                        $newP = $id;
                        $product[] = $newP;
                        Session::put('compare',$product);
                        $rr = [
                            'errorStatus' => 'no',
                            'errorDetails' => 'Product Added to Compare',
                        ];
                        return $result = json_encode($rr);
                    }
                }

            }else{
                $rr = [
                    'errorStatus' => 'yes',
                    'errorDetails' => 'Already 3 Product to Compare',
                ];
                return $result = json_encode($rr);
            }
        }else{
            $product = [$id];
            Session::put('compare',$product);
            $rr = [
                'errorStatus' => 'no',
                'errorDetails' => 'Product Added to Compare',
            ];
            return $result = json_encode($rr);
        }
    }

    public function removeCompare($id)
    {
        $product = Session::get('compare');
        $new = [];
        foreach ($product as $p){
            if ($p != $id){
                $new[] = $p;
            }
        }
        Session::forget('compare');
        Session::put('compare',$new);
        $rr = [
            'errorStatus' => 'no',
            'errorDetails' => 'Product Delete from Compare',
        ];
        return $result = json_encode($rr);
    }



}
