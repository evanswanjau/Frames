@extends('layouts.fontEnd')

@section('content')





    <!-- BANNER STRAT -->

    <div class="banner inner-banner align-center" style="background-image: url('{{ asset('assets/images') }}/{{ $basic->breadcrumb }}');">

        <div class="container">

            <section class="banner-detail">

                <h1 class="banner-title">{{ $page_title }}</h1>

                <div class="bread-crumb right-side">

                    <ul>

                        <li><a href="{{ route('home') }}">Home</a>/</li>

                        <li><span>{{ $page_title }}</span></li>

                    </ul>

                </div>

            </section>

        </div>

    </div>

    <!-- BANNER END -->



    <!-- CONTAIN START -->

    <section class="checkout-section ptb-50">

        <div class="container">

            <div class="row">

                <div class="col-xs-12">



                    <div class="checkout-content">

                        <div class="row">

                            <div class="col-xs-12">

                                <div class="heading-part align-center">

                                    <h2 class="heading">Order Number : #{{$order->order_number}}</h2>

                                </div>

                            </div>

                        </div>

                        <div id="cartFullView" class="row">

                            <div class="col-xs-12 mb-xs-30">

                                <div class="sidebar-title">

                                    <h3>Purchases Products</h3>

                                </div>

                                <div class="cart-item-table commun-table">

                                    <div class="table-responsive">

                                        <table class="table table-bordered">

                                            <thead>

                                            <tr>

                                                <th>Product</th>

                                                <th>Product Name</th>

                                                <th>Price</th>

                                                <th>Color</th>

                                                <th>Size</th>

                                                <th>Sub Total</th>

                                            </tr>

                                            </thead>

                                            <tbody>

                                            @foreach($orderItem as $con)

                                                @php $product = \App\Product::findOrFail($con->product_id) @endphp

                                                <tr id="product_{{$con->rowId}}">

                                                    <td>

                                                        <a href="{{ route('product-details',$product->slug) }}">

                                                            <div class="product-image"><img alt="{{ $con->name }}" src="{{ asset('assets/images/product') }}/{{$product->image}}"></div>

                                                        </a>

                                                    </td>

                                                    <td>

                                                        <div class="product-title">

                                                            <a href="{{ route('product-details',$product->slug) }}">{{ $product->name }}</a>

                                                        </div>

                                                    </td>

                                                    <td>

                                                        <ul>

                                                            <li>

                                                                <div class="base-price price-box"> <span class="price">{{$basic->symbol}}{{ $product->current_price }} x {{ $con->qty }}</span> </div>

                                                            </li>

                                                        </ul>

                                                    </td>

                                                    <td>

                                                        <ul>

                                                            <li>

                                                                @if($con->color == 0)

                                                                    <div class="base-price price-box"> <span class="price">-</span></div>

                                                                @else

                                                                    <div class="base-price price-box"><span class="label label-default">{{ \App\Color::findOrFail($con->color)->name }}</span></div>

                                                                @endif

                                                            </li>

                                                        </ul>

                                                    </td>

                                                    <td>

                                                        <ul>

                                                            <li>

                                                                @if($con->size == 0)

                                                                    <div class="base-price price-box"> <span class="price">-</span></div>

                                                                @else

                                                                    <div class="base-price price-box"><span class="label label-default">{{ \App\Size::findOrFail($con->size)->name }}</span></div>

                                                                @endif

                                                            </li>

                                                        </ul>

                                                    </td>

                                                    <td>

                                                        <div class="total-price price-box"> <span class="price">{{$basic->symbol}}{{ $product->current_price * $con->qty  }}</span> </div>

                                                    </td>

                                                </tr>

                                            @endforeach

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                            </div>

                            <div class="col-sm-7">

                                <div class="cart-total-table commun-table">

                                    <div class="table-responsive">

                                        <table class="table table-bordered custom-table">

                                            <tbody>

                                            <tr>

                                                <td class="text-right" width="50%">Payment Status</td>

                                                <td class="text-left">

                                                    <div class="price-box custom-table">

                                                        @if($order->payment_status == 0)

                                                            <span class="label label-warning"><i class="fa fa-spinner"></i> Pending</span> {{ \Carbon\Carbon::parse($order->created_at)->diffForHumans() }}

                                                            <br>

                                                            <a href="{{ route('payment',$order->order_number) }}" class="label label-danger"><i class="fa fa-credit-card"></i> Payment Now</a>

                                                        @else

                                                            <span class="label label-success"><i class="fa fa-check"></i> Paid</span>

                                                        @endif

                                                    </div>

                                                </td>

                                            </tr>

                                            <tr>

                                                <td class="text-right" width="50%">Shipping Status</td>

                                                <td class="text-left">

                                                    @if($order->shipping_status == 0)

                                                        <span class="label label-danger"><i class="fa fa-times"></i> Not Start</span>

                                                    @elseif($order->shipping_status == 1)

                                                        <span class="label label-warning"><i class="fa fa-spinner"></i> Pending</span>

                                                    @elseif($order->shipping_status == 2)

                                                        <span class="label label-danger"><i class="fa fa-times"></i> Cancel</span>

                                                    @else

                                                        <span class="label label-success"><i class="fa fa-check"></i> Delivered</span>

                                                    @endif

                                                </td>

                                            </tr>

                                            <tr>

                                                <td class="text-right"><b>Order Status</b></td>

                                                <td class="text-left">

                                                    <div class="price-box">

                                                        <div class="product-title">

                                                            @if($order->status == 0)

                                                                <span class="label label-warning"><i class="fa fa-spinner"></i> Pending</span>

                                                            @elseif($order->status == 1)

                                                                <span class="label label-success"><i class="fa fa-check"></i> Confirm</span>

                                                            @else

                                                                <span class="label label-danger"><i class="fa fa-times"></i> Cancel</span>

                                                            @endif

                                                        </div>

                                                    </div>

                                                </td>

                                            </tr>

                                            </tbody>

                                        </table>

                                    </div>



                                </div>

                            </div>

                            <div class="col-sm-5">

                                <div class="cart-total-table commun-table">

                                    <div class="table-responsive">

                                        <table class="table table-bordered">

                                            <tbody>

                                            <tr>

                                                <td>Item(s) Subtotal</td>

                                                <td><div class="price-box"> <span class="price">{{ $basic->symbol }}{{ $order->subtotal }}</span> </div></td>

                                            </tr>

                                            <tr>

                                                <td>Tax - {{ $basic->tax }}% </td>

                                                <td><div class="price-box"> <span class="price">{{ $basic->symbol }}{{ $order->tax }}</span> </div></td>

                                            </tr>

                                            <tr>

                                                <td><b>Amount Payable</b></td>

                                                <td><div class="price-box"> <span class="price"><b>{{ $basic->symbol }}{{ $order->total }}</b></span> </div></td>

                                            </tr>

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="row mt-30">

                            <div class="col-sm-6">

                                <div class="cart-total-table address-box commun-table mb-30">

                                    <div class="table-responsive">

                                        <table class="table">

                                            <thead>

                                            <tr>

                                                <th>Shipping Address</th>

                                            </tr>

                                            </thead>

                                            <tbody>

                                            <tr>

                                                <td>

                                                    <ul>

                                                        <li class="inner-heading">

                                                            <b>{{ $userDetails->s_name }}</b>

                                                        </li>

                                                        <li>

                                                            <p>{{ $userDetails->s_company }}, {{ $userDetails->s_number }}</p>

                                                        </li>

                                                        <li>

                                                            <p>{{ $userDetails->s_email }}</p>

                                                        </li>

                                                        <li>

                                                            <p>{{ $userDetails->s_landmark }}</p>

                                                        </li>

                                                        <li>

                                                            <p>{{ $userDetails->s_address }}</p>

                                                        </li>

                                                        <li>

                                                            <p>{{ $userDetails->s_zip }}, {{ $userDetails->s_city }}, {{ $userDetails->s_state }}, {{ $userDetails->s_country }}</p>

                                                        </li>

                                                    </ul>

                                                </td>

                                            </tr>

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                            </div>

                            <div class="col-sm-6">

                                <div class="cart-total-table address-box commun-table">

                                    <div class="table-responsive">

                                        <table class="table">

                                            <thead>

                                            <tr>

                                                <th>Billing Address</th>

                                            </tr>

                                            </thead>

                                            <tbody>

                                            <tr>

                                                <td style="padding: 13px">

                                                    <ul>

                                                        <li class="inner-heading">

                                                            <b>{{ $userDetails->b_name }}</b>

                                                        </li>

                                                        <li>

                                                            <p>{{ $userDetails->b_company }}, {{ $userDetails->b_number }}</p>

                                                        </li>

                                                        <li>

                                                            <p>{{ $userDetails->b_email }}</p>

                                                        </li>

                                                        <li>

                                                            <p>{{ $userDetails->b_zip }}, {{ $userDetails->b_city }}, {{ $userDetails->b_state }}</p>

                                                        </li>

                                                        <li>

                                                            <p>{{ $userDetails->b_country }}</p>

                                                        </li>

                                                    </ul>

                                                    <br>

                                                </td>

                                            </tr>

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-sm-12">

                                <div><a href="{{ route('home') }}" class="btn btn-block btn-color"><span><i class="fa fa-angle-left"></i></span>Back Home</a> </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- CONTAINER END -->





@endsection

@section('scripts')





@endsection