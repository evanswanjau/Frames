<?php

namespace App\Http\Controllers;

use App\BasicSetting;
use App\Color;
use App\Product;
use App\Size;
use App\Wishlist;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        if (empty($request->color)){
            $color = 0;
        }else{
            $color = $request->color;
        }
        if (empty($request->size)){
            $size = 0;
        }else{
            $size = $request->size;
        }
        if ($product->stock < $request->qty){
            $rr = [
                'cartError' => 'yes',
                'cartErrorMessage' => 'Sorry '.$product->stock.' - '.'Items Available Only'
            ];
            return $result = json_encode($rr);
        }else{
            Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'qty' => $request->qty,
                'price' => $product->current_price,
                'options' => [
                    'image' => $product->image,
                    'size' => $size,
                    'color' => $color
                ]
            ]);
            $basic = BasicSetting::first();
            $cart = Cart::content();
            $count = Cart::count();
            $subtotal = $basic->symbol.Cart::subtotal();
            $cartRoute = url('/cart');
            $CheckRoute = url('/user/check-out');
            $cartShow = null;
            $cartShowTop = "<li class=\"cart-icon\">
                                    <a href=\"#\">
                                        <span> <small class=\"cart-notification\">$count</small> </span>
                                        <div class=\"cart-text hidden-sm hidden-xs\">My Cart</div>
                                    </a>
                                    <div class=\"cart-dropdown header-link-dropdown\">
                                        <ul id=\"cartShow\" class=\"cart-list link-dropdown-list\">";

            $cartShowBottom = "</ul>
                                        <p class=\"cart-sub-totle\"> <span class=\"pull-left\">Cart Subtotal</span> <span class=\"pull-right\"><strong class=\"price-box\"> $subtotal </strong></span> </p>
                                        <div class=\"clearfix\"></div>
                                        <div class=\"mt-20\"> <a href=\"$cartRoute\" class=\"btn-color btn\">Cart</a> <a href=\"$CheckRoute\" class=\"btn-color btn right-side\">Checkout</a> </div>
                                    </div>
                                </li>";
            foreach ($cart as $cont){
                $name = substr($cont->name,0,25);
                $image = url('/assets/images/product/').'/'.$cont->options->image;
                $cartShow.="<li>
                    <a data-id=\" $cont->rowId \" class='close-cart delete_cart'><i class='fa fa-times-circle'></i></a>
                    <div class='media'> <a class='pull-left'> <img alt=' $cont->name ' src='$image'></a>
                        <div class='media-body'> <span><a> $name ..</a></span>
                            <p class='cart-price'> $basic->symbol$cont->price x $cont->qty </p>
                        </div>
                    </div>
                </li>";
            }
            $cartShowFinal = $cartShowTop.$cartShow.$cartShowBottom;
            $rr = [
                'cartError' => 'no',
                'cartShowFinal' => $cartShowFinal
            ];
            return $result = json_encode($rr);
        }
    }

    public function singleAddToCart(Request $request)
    {
        $product = Product::findOrFail($request->id);
        if ($product->color_status == 0){
            $color = 0;
        }else{
            $color = $product->colors[0]['id'];
        }
        if ($product->size_status == 0){
            $size = 0;
        }else{
            $size = $product->sizes[0]['id'];
        }


        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->current_price,
            'options' => [
                'image' => $product->image,
                'size' => $size,
                'color' => $color
            ]
        ]);
        $basic = BasicSetting::first();
        $cart = Cart::content();
        $count = Cart::count();
        $subtotal = $basic->symbol.Cart::subtotal();
        $cartRoute = url('/cart');
        $CheckRoute = url('/user/check-out');
        $cartShow = null;
        $cartShowTop = "<li class=\"cart-icon\">
                                <a href=\"#\">
                                    <span> <small class=\"cart-notification\">$count</small> </span>
                                    <div class=\"cart-text hidden-sm hidden-xs\">My Cart</div>
                                </a>
                                <div class=\"cart-dropdown header-link-dropdown\">
                                    <ul id=\"cartShow\" class=\"cart-list link-dropdown-list\">";

        $cartShowBottom = "</ul>
                                    <p class=\"cart-sub-totle\"> <span class=\"pull-left\">Cart Subtotal</span> <span class=\"pull-right\"><strong class=\"price-box\"> $subtotal </strong></span> </p>
                                    <div class=\"clearfix\"></div>
                                    <div class=\"mt-20\"> <a href=\"$cartRoute\" class=\"btn-color btn\">Cart</a> <a href=\"$CheckRoute\" class=\"btn-color btn right-side\">Checkout</a> </div>
                                </div>
                            </li>";
        foreach ($cart as $cont){
            $name = substr($cont->name,0,25);
            $image = url('/assets/images/product/').'/'.$cont->options->image;
            $cartShow.="<li>
                <a data-id=\" $cont->rowId \" class='close-cart delete_cart'><i class='fa fa-times-circle'></i></a>
                <div class='media'> <a class='pull-left'> <img alt=' $cont->name ' src='$image'></a>
                    <div class='media-body'> <span><a> $name ..</a></span>
                        <p class='cart-price'> $basic->symbol$cont->price x $cont->qty</p>
                    </div>
                </div>
            </li>";
        }
        $cartShowFinal = $cartShowTop.$cartShow.$cartShowBottom;
        return response($cartShowFinal);
    }

    public function deleteFromCart(Request $request)
    {
        Cart::remove($request->rowId);
        $basic = BasicSetting::first();
        $cart = Cart::content();
        $count = Cart::count();
        $subtotal = $basic->symbol.Cart::subtotal();
        $tax = Cart::tax();
        $total = Cart::total();
        $cartRoute = url('/cart');
        $CheckRoute = url('/user/check-out');
        $cartShow = null;
        $cartShowTop = "<li class=\"cart-icon\">
                                <a href=\"#\">
                                    <span> <small class=\"cart-notification\">$count</small> </span>
                                    <div class=\"cart-text hidden-sm hidden-xs\">My Cart</div>
                                </a>
                                <div class=\"cart-dropdown header-link-dropdown\">
                                    <ul id=\"cartShow\" class=\"cart-list link-dropdown-list\">";

        $cartShowBottom = "</ul>
                                    <p class=\"cart-sub-totle\"> <span class=\"pull-left\">Cart Subtotal</span> <span class=\"pull-right\"><strong class=\"price-box\"> $subtotal </strong></span> </p>
                                    <div class=\"clearfix\"></div>
                                    <div class=\"mt-20\"> <a href=\"$cartRoute\" class=\"btn-color btn\">Cart</a> <a href=\"$CheckRoute\" class=\"btn-color btn right-side\">Checkout</a> </div>
                                </div>
                            </li>";
        foreach ($cart as $cont){
            $name = substr($cont->name,0,25);
            $image = url('/assets/images/product/').'/'.$cont->options->image;
            $cartShow.="<li>
                <a data-id=\" $cont->rowId \" class=\"close-cart delete_cart\"><i class='fa fa-times-circle'></i></a>
                <div class='media'> <a class='pull-left'> <img alt=' $cont->name ' src='$image'></a>
                    <div class='media-body'> <span><a> $name ..</a></span>
                        <p class='cart-price'> $basic->symbol$cont->price x $cont->qty</p>
                    </div>
                </div>
            </li>";
        }

        $cartShowFinal = $cartShowTop.$cartShow.$cartShowBottom;

        $fullTop = "<div class=\"col-xs-12 mb-xs-30\">
                    <div class=\"sidebar-title\">
                        <h3>SHOPPING CART</h3>
                    </div>
                    <div class=\"cart-item-table commun-table\">
                        <div class=\"table-responsive\">
                            <table class=\"table table-bordered\">
                                <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th>Quantity</th>
                                    <th>Sub Total</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>";
        $fullBottom = "</tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class=\"col-sm-8 col-sm-offset-4\">
                    <div class=\"cart-total-table commun-table\">
                        <div class=\"table-responsive\">
                            <table class=\"table table-bordered\">
                                <tbody>
                                <tr>
                                    <td>Item(s) Subtotal</td>
                                    <td><div class=\"price-box\"> <span class=\"price\">$subtotal</span> </div></td>
                                </tr>
                                <tr>
                                    <td>Tax - $basic->tax % </td>
                                    <td><div class=\"price-box\"> <span class=\"price\">$basic->symbol$tax</span> </div></td>
                                </tr>
                                <tr>
                                    <td><b>Amount Payable</b></td>
                                    <td><div class=\"price-box\"> <span class=\"price\"><b>$basic->symbol$total</b></span> </div></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>";
        $fullMiddle = null;
        foreach ($cart as $con){
            $product = Product::findOrFail($con->id);
            $image = url('/assets/images/product/').'/'.$con->options->image;
            $itemTotal = $con->price * $con->qty;
            $productDetails = route('product-details',$product->slug);
            if($con->options->color == 0){
                $color = '<div class="base-price price-box"> <span class="price">-</span></div>';
            }else{
                $cyy = Color::findOrFail($con->options->color)->name;
                $color = "<div class=\"base-price price-box\"><span class=\"label label-default\">$cyy</span></div>";
            }
            if($con->options->size == 0){
                $size = '<div class="base-price price-box"> <span class="price">-</span></div>';
            }else{
                $cuu = Size::findOrFail($con->options->size)->name;
                $size = "<div class=\"base-price price-box\"><span class=\"label label-default\">$cuu</span></div>";
            }


            $fullMiddle.="<tr id=\"product_$con->rowId\">
                            <td>
                                <a href=\"$productDetails\">
                                    <div class=\"product-image\"><img alt=\" $con->name\" src=\"$image\"></div>
                                </a>
                            </td>
                            <td>
                                <div class=\"product-title\">
                                    <a href=\"$productDetails\"> $con->name </a>
                                </div>
                            </td>
                            <td>
                                <ul>
                                    <li>
                                        <div class=\"base-price price-box\"> <span class=\"price\">$basic->symbol$con->price</span> </div>
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>
                                        $color
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>
                                        $size
                                    </li>
                                </ul>
                            </td>
                           
                            <td>
                                <div class=\"input-box\">
                                    <div class=\"custom-qty\">
                                        <button id='btnMinus$con->rowId' onclick=\"var result = document.getElementById('qty$con->id'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) result.value--;return false;\" class=\"reduced items\" type=\"button\"> <i class=\"fa fa-minus\"></i> </button>
                                        <input type=\"text\" class=\"input-text qty\" title=\"Qty\" value=\"$con->qty\" maxlength=\"$product->stock\" id=\"qty$con->id\" name=\"qty\">
                                        <button id='btnPlus$con->rowId' onclick=\"var result = document.getElementById('qty$con->id'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;\" class=\"increase items\" type=\"button\"> <i class=\"fa fa-plus\"></i> </button>
                                    </div>
                                </div>
                            </td>
                            <td><div class=\"total-price price-box\"> <span class=\"price\"> $basic->symbol$itemTotal </span> </div></td>
                            <td><i title=\"Remove Item From Cart\" data-id=\" $con->rowId \" class=\"fa fa-trash delete_cart cart-remove-item\"></i></td>
                        </tr>";
        }
        $fullShow = $fullTop.$fullMiddle.$fullBottom;

        $rr = [
            'cartShow' => $cartShowFinal,
            'fullShow' =>$fullShow
        ];
        $result = json_encode($rr);
        return Response::json($result);

    }


    public function updateCartItem($rowId,$qty)
    {
        $cartProduct = Cart::get($rowId);
        $product = Product::findOrFail($cartProduct->id);
        if ($product->stock < $qty){
            $rr = [
                'cartError' => 'yes',
                'cartErrorMessage' => 'Sorry '.$product->stock.' - '.'Items Available Only'
            ];
            return $result = json_encode($rr);
        }else{
            Cart::update($rowId,$qty);
            $basic = BasicSetting::first();
            $cart = Cart::content();
            $count = Cart::count();
            $subtotal = $basic->symbol.Cart::subtotal();
            $tax = Cart::tax();
            $total = Cart::total();
            $cartRoute = url('/cart');
            $CheckRoute = url('/user/check-out');
            $cartShow = null;
            $cartShowTop = "<li class=\"cart-icon\">
                                <a href=\"#\">
                                    <span> <small class=\"cart-notification\">$count</small> </span>
                                    <div class=\"cart-text hidden-sm hidden-xs\">My Cart</div>
                                </a>
                                <div class=\"cart-dropdown header-link-dropdown\">
                                    <ul id=\"cartShow\" class=\"cart-list link-dropdown-list\">";

            $cartShowBottom = "</ul>
                                    <p class=\"cart-sub-totle\"> <span class=\"pull-left\">Cart Subtotal</span> <span class=\"pull-right\"><strong class=\"price-box\"> $subtotal </strong></span> </p>
                                    <div class=\"clearfix\"></div>
                                    <div class=\"mt-20\"> <a href=\"$cartRoute\" class=\"btn-color btn\">Cart</a> <a href=\"$CheckRoute\" class=\"btn-color btn right-side\">Checkout</a> </div>
                                </div>
                            </li>";
            foreach ($cart as $cont){
                $name = substr($cont->name,0,25);
                $image = url('/assets/images/product/').'/'.$cont->options->image;
                $cartShow.="<li>
                <a data-id=\" $cont->rowId \" class=\"close-cart delete_cart\"><i class='fa fa-times-circle'></i></a>
                <div class='media'> <a class='pull-left'> <img alt=' $cont->name ' src='$image'></a>
                    <div class='media-body'> <span><a> $name ..</a></span>
                        <p class='cart-price'> $basic->symbol$cont->price x $cont->qty</p>
                    </div>
                </div>
            </li>";
            }

            $cartShowFinal = $cartShowTop.$cartShow.$cartShowBottom;

            $fullTop = "<div class=\"col-xs-12 mb-xs-30\">
                    <div class=\"sidebar-title\">
                        <h3>SHOPPING CART</h3>
                    </div>
                    <div class=\"cart-item-table commun-table\">
                        <div class=\"table-responsive\">
                            <table class=\"table table-bordered\">
                                <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th>Quantity</th>
                                    <th>Sub Total</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>";
            $fullBottom = "</tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class=\"col-sm-8 col-sm-offset-4\">
                    <div class=\"cart-total-table commun-table\">
                        <div class=\"table-responsive\">
                            <table class=\"table table-bordered\">
                                <tbody>
                                <tr>
                                    <td>Item(s) Subtotal</td>
                                    <td><div class=\"price-box\"> <span class=\"price\">$subtotal</span> </div></td>
                                </tr>
                                <tr>
                                    <td>Tax - $basic->tax% </td>
                                    <td><div class=\"price-box\"> <span class=\"price\">$basic->symbol$tax</span> </div></td>
                                </tr>
                                <tr>
                                    <td><b>Amount Payable</b></td>
                                    <td><div class=\"price-box\"> <span class=\"price\"><b>$basic->symbol$total</b></span> </div></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>";
            $fullMiddle = null;
            foreach ($cart as $con){
                $product = Product::findOrFail($con->id);
                $productDetails = route('product-details',$product->slug);
                $image = url('/assets/images/product/').'/'.$con->options->image;
                $itemTotal = $con->price * $con->qty;
                if($con->options->color == 0){
                    $color = '<div class="base-price price-box"> <span class="price">-</span></div>';
                }else{
                    $cyy = Color::findOrFail($con->options->color)->name;
                    $color = "<div class=\"base-price price-box\"><span class=\"label label-default\">$cyy</span></div>";
                }
                if($con->options->size == 0){
                    $size = '<div class="base-price price-box"> <span class="price">-</span></div>';
                }else{
                    $cuu = Size::findOrFail($con->options->size)->name;
                    $size = "<div class=\"base-price price-box\"><span class=\"label label-default\">$cuu</span></div>";
                }
                $fullMiddle.="<tr id=\"product_$con->rowId\">
                            <td>
                                <a href=\"$productDetails\">
                                    <div class=\"product-image\"><img alt=\" $con->name\" src=\"$image\"></div>
                                </a>
                            </td>
                            <td>
                                <div class=\"product-title\">
                                    <a href=\"$productDetails\"> $con->name </a>
                                </div>
                            </td>
                            <td>
                                <ul>
                                    <li>
                                        <div class=\"base-price price-box\"> <span class=\"price\">$basic->symbol$con->price</span> </div>
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>
                                        $color
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>
                                        $size
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <div class=\"input-box\">
                                
                                    <div class=\"custom-qty\">
                                        <button id=\"btnMinus$con->rowId\" onclick=\"var result = document.getElementById('qty$con->id'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) result.value--;return false;\" class=\"reduced items\" type=\"button\"> <i class=\"fa fa-minus\"></i> </button>
                                        <input type=\"text\" class=\"input-text qty\" readonly title=\"Qty\" value=\"$con->qty\" maxlength=\"$product->stock\" id=\"qty$con->id\" name=\"qty$con->id\">
                                        <button id=\"btnPlus$con->rowId\" onclick=\"var result = document.getElementById('qty$con->id'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;\" class=\"increase items\" type=\"button\"> <i class=\"fa fa-plus\"></i> </button>
                                    </div>
                                </div>
                            </td>
                            <td><div class=\"total-price price-box\"> <span class=\"price\"> $basic->symbol$itemTotal </span> </div></td>
                            <td><i title=\"Remove Item From Cart\" data-id=\" $con->rowId \" class=\"fa fa-trash delete_cart cart-remove-item\"></i></td>
                        </tr>";
            }
            $fullShow = $fullTop.$fullMiddle.$fullBottom;

            $rr = [
                'cartError' => 'no',
                'cartShow' => $cartShowFinal,
                'fullShow' =>$fullShow
            ];
            $result = json_encode($rr);
            return Response::json($result);
        }
    }

    public function singleWishList(Request $request)
    {
        if (Auth::check()){
            $w = Wishlist::whereUser_id(Auth::user()->id)->whereProduct_id($request->id)->count();
            if ($w == 0){
                $ww['product_id'] = $request->id;
                $ww['user_id'] = Auth::user()->id;
                Wishlist::create($ww);
                $rr = [
                    'cartError' => 'no',
                    'cartErrorMessage' => 'Product Added To Wishlist'
                ];
                return $result = json_encode($rr);
            }else{
                $rr = [
                    'cartError' => 'exist',
                    'cartErrorMessage' => 'Product Already In Wishlist'
                ];
                return $result = json_encode($rr);
            }

        }else{
            $rr = [
                'cartError' => 'yes',
                'cartErrorMessage' => 'Please LogIn First'
            ];
            return $result = json_encode($rr);
        }
    }

    public function wishToCart(Request $request)
    {
        $product = Product::findOrFail($request->id);
        if ($product->stock < $request->qty){
            $rr = [
                'cartError' => 'yes',
                'cartErrorMessage' => 'Sorry '.$product->stock.' - '.'Items Available Only'
            ];
            return $result = json_encode($rr);
        }else{
            Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'qty' => $request->qty,
                'price' => $product->current_price,
                'options' => [
                    'image' => $product->image,
                ]
            ]);
            Wishlist::whereUser_id(Auth::user()->id)->whereProduct_id($request->id)->delete();
            $ww = Wishlist::whereUser_id(Auth::user()->id)->latest()->get();

            $basic = BasicSetting::first();
            $cart = Cart::content();
            $count = Cart::count();
            $subtotal = $basic->symbol.Cart::subtotal();
            $cartRoute = url('/cart');
            $CheckRoute = url('/user/check-out');
            $cartShow = null;
            $cartShowTop = "<li class=\"cart-icon\">
                                    <a href=\"#\">
                                        <span> <small class=\"cart-notification\">$count</small> </span>
                                        <div class=\"cart-text hidden-sm hidden-xs\">My Cart</div>
                                    </a>
                                    <div class=\"cart-dropdown header-link-dropdown\">
                                        <ul id=\"cartShow\" class=\"cart-list link-dropdown-list\">";

            $cartShowBottom = "</ul>
                                        <p class=\"cart-sub-totle\"> <span class=\"pull-left\">Cart Subtotal</span> <span class=\"pull-right\"><strong class=\"price-box\"> $subtotal </strong></span> </p>
                                        <div class=\"clearfix\"></div>
                                        <div class=\"mt-20\"> <a href=\"$cartRoute\" class=\"btn-color btn\">Cart</a> <a href=\"$CheckRoute\" class=\"btn-color btn right-side\">Checkout</a> </div>
                                    </div>
                                </li>";
            foreach ($cart as $cont){
                $name = substr($cont->name,0,25);
                $image = url('/assets/images/product/').'/'.$cont->options->image;
                $cartShow.="<li>
                    <a data-id=\" $cont->rowId \" class='close-cart delete_cart'><i class='fa fa-times-circle'></i></a>
                    <div class='media'> <a class='pull-left'> <img alt=' $cont->name ' src='$image'></a>
                        <div class='media-body'> <span><a> $name ..</a></span>
                            <p class='cart-price'> $basic->symbol$cont->price x $cont->qty </p>
                        </div>
                    </div>
                </li>";
            }
            $cartShowFinal = $cartShowTop.$cartShow.$cartShowBottom;

            $top = '<div class="col-xs-12 mb-xs-30">
                    <div class="sidebar-title">
                        <h3>Wishlist Products</h3>
                    </div>
                    <div class="cart-item-table commun-table">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Add Cart</th>
                                </tr>
                                </thead>';
            $bottom = '<tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>';
            $middle = null ;

            foreach ($ww as $w){
                $productDetails = route('product-details',$w->product->slug);
                $image = url('/assets/images/product/').'/'.$w->product->image;
                $name = $w->product->name;
                $price = $w->product->current_price;
                $max = $w->product->stock;
                $middle .= "<tr>
                                <td>
                                    <a href=\"$productDetails\">
                                        <div class=\"product-image\"><img alt=\"$productDetails\" src=\"$image\"></div>
                                    </a>
                                </td>
                                <td>
                                    <div class=\"product-title\">
                                        <a href=\"$productDetails\">$name</a>
                                    </div>
                                </td>
                                <td>
                                    <ul>
                                        <li>
                                            <div class=\"base-price price-box\"> <span class=\"price\">$basic->symbol$price</span> </div>
                                        </li>
                                    </ul>
                                </td>
                                <td>
                                    <div class=\"input-box\">
                                        <div class=\"custom-qty\">
                                            <button onclick=\"var result = document.getElementById('qty$w->id'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) result.value--;return false;\" class=\"reduced items\" type=\"button\"> <i class=\"fa fa-minus\"></i> </button>
                                            <input type=\"text\" class=\"input-text qty\" readonly title=\"Qty\" value=\"1\" maxlength=\"$max\" id=\"qty$w->id\" name=\"qty\">
                                            <button onclick=\"var result = document.getElementById('qty$w->id'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;\" class=\"increase items\" type=\"button\"> <i class=\"fa fa-plus\"></i> </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <button data-id=\"$w->product_id\" id=\"wish$w->id\" class=\"btn btn-color\"><i class=\"fa fa-cart-plus\"></i> Add Cart</button>
                                </td>
                            </tr>";
            }

            $all = $top.$middle.$bottom;

            $rr = [
                'cartError' => 'no',
                'cartShowFinal' => $cartShowFinal,
                'all' => $all
            ];
            return $result = json_encode($rr);
        }
    }


}
