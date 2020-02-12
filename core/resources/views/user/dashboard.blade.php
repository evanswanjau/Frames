@extends('layouts.fontEnd')

@section('style')

    <link href="{{ asset('assets/admin/css/bootstrap-fileinput.css') }}" rel="stylesheet">

@endsection

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





                <div class="col-md-3 col-sm-4">

                    <div class="account-sidebar account-tab mb-xs-30">

                        <div class="dark-bg tab-title-bg">

                            <div class="heading-part">

                                <div class="sub-title"><span></span> My Account</div>

                            </div>

                        </div>

                        <div class="account-tab-inner">

                            <ul class="account-tab-stap">

                                <li id="step1" class="active"> <a href="javascript:void(0)">My Dashboard<i class="fa fa-angle-right"></i> </a> </li>

                                <li id="step2"> <a href="javascript:void(0)">Account Details<i class="fa fa-angle-right"></i> </a> </li>

                                <li id="step3"> <a href="javascript:void(0)">My Order List<i class="fa fa-angle-right"></i> </a> </li>

                                <li id="step4"> <a href="javascript:void(0)">My Wish List<i class="fa fa-angle-right"></i> </a> </li>

                                <li id="step7"> <a href="javascript:void(0)">My Testimonial<i class="fa fa-angle-right"></i> </a> </li>

                                <li id="step5"> <a href="javascript:void(0)">Change Password<i class="fa fa-angle-right"></i> </a> </li>

                                <li id="step6"> <a href="javascript:void(0)">Get Logout<i class="fa fa-angle-right"></i> </a> </li>

                            </ul>

                        </div>

                    </div>

                </div>





                <div class="col-md-9 col-sm-8">

                    @if($errors->any())

                        @foreach ($errors->all() as $error)

                            <div class="alert alert-danger alert-dismissable">

                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                                {!!  $error !!}

                            </div>

                        @endforeach

                    @endif

                    <div id="data-step1" class="account-content" data-temp="tabdata">

                        <div class="row">

                            <div class="col-xs-12">

                                <div class="heading-part heading-bg mb-30">

                                    <h2 class="heading m-0">Account Dashboard</h2>

                                </div>

                            </div>

                        </div>

                        <div class="m-0">

                            <div class="row">

                                <div class="col-xs-12 mb-20">

                                    <div class="heading-part">

                                        <h3 class="sub-heading">Hello, {{ $user->first_name }} {{ $user->last_name }}</h3>

                                    </div>

                                    <hr>

                                </div>



                                <div class="col-sm-6">

                                    <div class="cart-total-table address-box commun-table">

                                        <div class="table-responsive">

                                            <table class="table">

                                                <thead>

                                                <tr>

                                                    <th>Shipping Address</th>

                                                </tr>

                                                </thead>

                                                <tbody>

                                                <tr>

                                                    @if($userDetails)

                                                    <td>

                                                        <ul>

                                                            <li class="inner-heading"> <b>{{ $userDetails->s_name }}</b> </li>

                                                            <li>

                                                                <p>{{ $userDetails->s_landmark }},{{ $userDetails->s_address }}</p>

                                                            </li>

                                                            <li>

                                                                <p>{{ $userDetails->s_city }},{{ $userDetails->s_state }},{{ $userDetails->s_zip }}.</p>

                                                            </li>

                                                            <li>

                                                                <p>{{ $userDetails->s_country }}</p>

                                                            </li>

                                                        </ul>

                                                    </td>

                                                    @else

                                                        <td class="text-center inner-heading"><strong>Not Set Yet</strong> </td>

                                                    @endif

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

                                                    @if($userDetails)

                                                        <td>

                                                            <ul>

                                                                <li class="inner-heading"> <b>{{ $userDetails->b_name }}</b> </li>

                                                                <li>

                                                                    <p>{{ $userDetails->b_email }}, {{ $userDetails->b_number }}</p>

                                                                </li>

                                                                <li>

                                                                    <p>{{ $userDetails->b_city }},{{ $userDetails->b_state }},{{ $userDetails->b_zip }}.</p>

                                                                </li>

                                                                <li>

                                                                    <p>{{ $userDetails->b_country }}</p>

                                                                </li>

                                                            </ul>

                                                        </td>

                                                    @else

                                                        <td class="text-center inner-heading"><strong>Not Set Yet</strong> </td>

                                                    @endif

                                                </tr>

                                                </tbody>

                                            </table>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div id="data-step2" class="account-content" data-temp="tabdata" style="display:none">

                        <div class="row">

                            <div class="col-xs-12">

                                <div class="heading-part heading-bg mb-30">

                                    <h2 class="heading m-0">Account Details</h2>

                                </div>

                            </div>

                        </div>

                        <div class="m-0">

                            <form action="{{ route('user-dashboard-details') }}" class="main-form full" method="post">

                                {!! csrf_field() !!}

                                @if($userDetails== null)

                                    <div class="mb-20">

                                        <div class="row">

                                            <div class="col-xs-12 mb-20">

                                                <div class="heading-part">

                                                    <h3 class="sidebar-title">Shipping Address</h3>

                                                </div>

                                                <hr>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="input-box">

                                                    <input type="text" name="s_name" value="{{ $user->first_name }} {{ $user->last_name }}" required placeholder="Full Name">

                                                </div>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="input-box">

                                                    <input type="email" name="s_email" value="{{ $user->email }}" required placeholder="Email Address">

                                                </div>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="input-box">

                                                    <input type="text" name="s_company" required placeholder="Company">

                                                </div>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="input-box">

                                                    <input type="text" name="s_number" required placeholder="Contact Number">

                                                </div>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="input-box">

                                                    <select name="s_country" id="shippingcountryid">

                                                        <option selected="" value="">Select Country</option>

                                                        @foreach($country as $cc => $value)

                                                            <option value="{{ $value }}">{{ $value }}</option>

                                                        @endforeach

                                                    </select>

                                                </div>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="input-box">

                                                    <input type="text" name="s_state" required placeholder="State Name">

                                                </div>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="input-box">

                                                    <input type="text" name="s_city" required placeholder="City Name">

                                                </div>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="input-box">

                                                    <input type="text" name="s_zip" required placeholder="Postcode/zip">

                                                </div>

                                            </div>

                                            <div class="col-sm-12">

                                                <div class="input-box">

                                                    <textarea name="s_address" required placeholder="Shipping Address"></textarea>

                                                    <span>Please provide the number and street.</span> </div>

                                            </div>

                                            <div class="col-sm-12">

                                                <div class="input-box">

                                                    <input type="text" name="s_landmark" required placeholder="Shipping Landmark">

                                                    <span>Please include landmark (e.g : Opposite Bank) as the carrier service may find it easier to locate your address.</span> </div>

                                            </div>





                                        </div>

                                    </div>

                                    <div class="">

                                        <div class="row">

                                            <div class="col-xs-12 mb-20">

                                                <div class="heading-part">

                                                    <h3 class="sub-heading">Billing Address</h3>

                                                </div>

                                                <hr>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="input-box">

                                                    <input type="text" name="b_name" value="{{ $user->first_name }} {{ $user->last_name }}" required placeholder="Full Name">

                                                </div>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="input-box">

                                                    <input type="text" name="b_email" value="{{ $user->email }}" required placeholder="Email Address">

                                                </div>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="input-box">

                                                    <input type="text" name="b_company" required placeholder="Company">

                                                </div>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="input-box">

                                                    <input type="text" name="b_number" required placeholder="Contact Number">

                                                </div>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="input-box">

                                                    <select name="b_country" id="shippingcountryid">

                                                        <option selected="" value="">Select Country</option>

                                                        @foreach($country as $cc => $value)

                                                            <option value="{{ $value }}">{{ $value }}</option>

                                                        @endforeach

                                                    </select>

                                                </div>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="input-box">

                                                    <input type="text" name="b_state" required placeholder="State Name">

                                                </div>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="input-box">

                                                    <input type="text" name="b_city" required placeholder="City Name">

                                                </div>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="input-box">

                                                    <input type="text" name="b_zip" required placeholder="Postcode/zip">

                                                </div>

                                            </div>

                                            <div class="col-sm-12"> <button type="submit" class="btn btn-color btn-block right-side">Next</button> </div>

                                        </div>

                                    </div>

                                @else

                                    <div class="mb-20">

                                        <div class="row">

                                            <div class="col-xs-12 mb-20">

                                                <div class="heading-part">

                                                    <h3 class="sidebar-title">Shipping Address</h3>

                                                </div>

                                                <hr>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="input-box">

                                                    <input type="text" name="s_name" value="{{ $user->first_name }} {{ $user->last_name }}" required placeholder="Full Name">

                                                </div>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="input-box">

                                                    <input type="email" name="s_email" value="{{ $user->email }}" required placeholder="Email Address">

                                                </div>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="input-box">

                                                    <input type="text" name="s_company" value="{{ $userDetails->s_company }}" required placeholder="Company">

                                                </div>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="input-box">

                                                    <input type="text" name="s_number" value="{{ $userDetails->s_number }}" required placeholder="Contact Number">

                                                </div>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="input-box">

                                                    <select name="s_country" id="shippingcountryid">

                                                        <option selected="" value="">Select Country</option>

                                                        @foreach($country as $cc => $value)

                                                            @if($userDetails->s_country == $value)

                                                                <option value="{{ $value }}" selected>{{ $value }}</option>

                                                            @else

                                                                <option value="{{ $value }}">{{ $value }}</option>

                                                            @endif

                                                        @endforeach

                                                    </select>

                                                </div>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="input-box">

                                                    <input type="text" name="s_state" value="{{ $userDetails->s_state }}" required placeholder="State Name">

                                                </div>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="input-box">

                                                    <input type="text" name="s_city" value="{{ $userDetails->s_city }}" required placeholder="City Name">

                                                </div>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="input-box">

                                                    <input type="text" name="s_zip" value="{{ $userDetails->s_zip }}" required placeholder="Postcode/zip">

                                                </div>

                                            </div>

                                            <div class="col-sm-12">

                                                <div class="input-box">

                                                    <textarea name="s_address" required placeholder="Shipping Address">{{ $userDetails->s_address }}</textarea>

                                                    <span>Please provide the number and street.</span> </div>

                                            </div>

                                            <div class="col-sm-12">

                                                <div class="input-box">

                                                    <input type="text" name="s_landmark" value="{{ $userDetails->s_landmark }}" required placeholder="Shipping Landmark">

                                                    <span>Please include landmark (e.g : Opposite Bank) as the carrier service may find it easier to locate your address.</span> </div>

                                            </div>





                                        </div>

                                    </div>

                                    <div class="">

                                        <div class="row">

                                            <div class="col-xs-12 mb-20">

                                                <div class="heading-part">

                                                    <h3 class="sub-heading">Billing Address</h3>

                                                </div>

                                                <hr>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="input-box">

                                                    <input type="text" name="b_name" value="{{ $user->first_name }} {{ $user->last_name }}" required placeholder="Full Name">

                                                </div>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="input-box">

                                                    <input type="text" name="b_email" value="{{ $user->email }}" required placeholder="Email Address">

                                                </div>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="input-box">

                                                    <input type="text" name="b_company" value="{{ $userDetails->b_company }}" required placeholder="Company">

                                                </div>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="input-box">

                                                    <input type="text" name="b_number" value="{{ $userDetails->b_number }}" required placeholder="Contact Number">

                                                </div>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="input-box">

                                                    <select name="b_country" id="shippingcountryid">

                                                        <option selected="" value="">Select Country</option>

                                                        @foreach($country as $cc => $value)

                                                            @if($userDetails->b_country == $value)

                                                                <option value="{{ $value }}" selected>{{ $value }}</option>

                                                            @else

                                                                <option value="{{ $value }}">{{ $value }}</option>

                                                            @endif

                                                        @endforeach

                                                    </select>

                                                </div>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="input-box">

                                                    <input type="text" name="b_state" value="{{ $userDetails->b_state }}" required placeholder="State Name">

                                                </div>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="input-box">

                                                    <input type="text" name="b_city" value="{{ $userDetails->b_city }}" required placeholder="City Name">

                                                </div>

                                            </div>

                                            <div class="col-sm-6">

                                                <div class="input-box">

                                                    <input type="text" name="b_zip" value="{{ $userDetails->b_zip }}" required placeholder="Postcode/zip">

                                                </div>

                                            </div>

                                            <div class="col-sm-12"> <button type="submit" class="btn btn-color btn-block right-side">Update Address</button> </div>

                                        </div>

                                    </div>

                                @endif

                            </form>

                        </div>

                    </div>

                    <div id="data-step3" class="account-content" data-temp="tabdata" style="display:none">

                        <div class="row">

                            <div class="col-xs-12">

                                <div class="heading-part heading-bg mb-30">

                                    <h2 class="heading m-0">My Orders</h2>

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-xs-12 mb-xs-30">

                                <div class="">

                                    <div class="table-responsive">

                                        <table class="table table-bordered">

                                            <thead>

                                            <tr>

                                                <th>Created At</th>

                                                <th>Order Number</th>

                                                <th>Total Price</th>

                                                <th>Shipping Status</th>

                                                <th>Order Status</th>

                                                <th>Payment Method</th>

                                                <th>Action</th>

                                            </tr>

                                            </thead>

                                            <tbody>

                                            @foreach($order as $con)

                                                <tr>

                                                    <td>

                                                        <div class="product-title">

                                                            {{ \Carbon\Carbon::parse($con->created_at)->format('dS M\'y - h:i:s A') }}

                                                        </div>

                                                    </td>

                                                    <td>

                                                        <div class="product-title">

                                                            {{ $con->order_number }}

                                                        </div>

                                                    </td>

                                                    <td>

                                                        <div class="product-title">

                                                            {{$basic->symbol}}{{ $con->total }}

                                                        </div>

                                                    </td>

                                                    <td>

                                                        <div class="product-title">

                                                            @if($con->shipping_status == 0)

                                                                <span class="label label-danger"><i class="fa fa-times"></i> Not Start</span>

                                                            @elseif($con->shipping_status == 1)

                                                                <span class="label label-warning"><i class="fa fa-spinner"></i> Pending</span>

                                                            @elseif($con->shipping_status == 2)

                                                                <span class="label label-danger"><i class="fa fa-times"></i> Cancel</span>

                                                            @else

                                                                <span class="label label-success"><i class="fa fa-check"></i> Delivered</span>

                                                            @endif

                                                        </div>

                                                    </td>

                                                    <td>

                                                        <div class="product-title">

                                                            @if($con->status == 0)

                                                                <span class="label label-warning"><i class="fa fa-spinner"></i> Pending</span>

                                                            @elseif($con->status == 1)

                                                                <span class="label label-success"><i class="fa fa-check"></i> Confirm</span>

                                                            @else

                                                                <span class="label label-danger"><i class="fa fa-times"></i> Cancel</span>

                                                            @endif

                                                        </div>

                                                    </td>

                                                    <td>{{ $con->payment->name }}</td>

                                                    <td>

                                                        <div class="product-title">

                                                            <a href="{{ route('user-order-view',$con->order_number) }}" class="btn btn-primary btn-extra-sm"><i class="fa fa-eye"></i>View</a>

                                                        </div>

                                                    </td>

                                                </tr>

                                            @endforeach

                                            </tbody>

                                        </table>

                                    </div>

                                    <div class="pagination-bar">

                                        {!! $order->links('home.pagination') !!}

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div id="data-step4" class="account-content" data-temp="tabdata" style="display:none">

                        <div class="row">

                            <div class="col-xs-12">

                                <div class="heading-part heading-bg mb-30">

                                    <h2 class="heading m-0">My Wish List</h2>

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-xs-12 mb-xs-30">

                                <div class="">

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

                                                    <th>Action</th>

                                                </tr>

                                                </thead>

                                                @foreach($wishlist as $con)

                                                    <tr>

                                                        <td>

                                                            <a href="{{ route('product-details',$con->product->slug) }}">

                                                                <div class="product-image1"><img alt="{{ $con->product->name }}" src="{{ asset('assets/images/product') }}/{{$con->product->image}}"></div>

                                                            </a>

                                                        </td>

                                                        <td>

                                                            <div class="product-title1">

                                                                <a href="{{ route('product-details',$con->product->slug) }}">{{ $con->product->name }}</a>

                                                            </div>

                                                        </td>

                                                        <td>

                                                            <ul>

                                                                <li>

                                                                    <div class="base-price price-box1"> <span class="price">{{$basic->symbol}}{{ $con->product->current_price }}</span> </div>

                                                                </li>

                                                            </ul>

                                                        </td>

                                                        <td>

                                                            <div class="input-box">

                                                                <div class="custom-qty">

                                                                    <button onclick="var result = document.getElementById('qty{{$con->id}}'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) result.value--;return false;" class="reduced items" type="button"> <i class="fa fa-minus"></i> </button>

                                                                    <input type="text" class="input-text qty" readonly title="Qty" value="1" maxlength="{{ $con->product->stock }}" id="qty{{$con->id}}" name="qty">

                                                                    <button onclick="var result = document.getElementById('qty{{$con->id}}'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="increase items" type="button"> <i class="fa fa-plus"></i> </button>

                                                                </div>

                                                            </div>

                                                        </td>

                                                        <td>

                                                            <button data-id="{{ $con->product_id }}" id="wish{{ $con->id }}" class="btn btn-color"><i class="fa fa-cart-plus"></i></button>

                                                        </td>

                                                        <td>

                                                            <button type="button" class="btn btn-danger delete_button"

                                                                    data-toggle="modal" data-target="#DelModal"

                                                                    data-id="{{ $con->id }}">

                                                                <i class='fa fa-trash'></i>

                                                            </button>

                                                        </td>

                                                    </tr>

                                                @endforeach

                                                <tbody>

                                            </table>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div id="data-step5" class="account-content" data-temp="tabdata" style="display:none">

                        <div class="row">

                            <div class="col-xs-12">

                                <div class="heading-part heading-bg mb-30">

                                    <h2 class="heading m-0">Change Password</h2>

                                </div>

                            </div>

                        </div>

                        <form class="main-form full" action="{{ route('user-update-password') }}" method="POST">

                            {!! csrf_field() !!}

                            <div class="row">

                                <div class="col-xs-12">

                                    <div class="input-box">

                                        <label for="old-pass">Old-Password</label>

                                        <input type="password" name="old_password" placeholder="Old Password" required id="old-pass">

                                    </div>

                                </div>

                                <div class="col-sm-6">

                                    <div class="input-box">

                                        <label for="login-pass">Password</label>

                                        <input type="password" name="password" placeholder="Enter your Password" required id="login-pass">

                                    </div>

                                </div>

                                <div class="col-sm-6">

                                    <div class="input-box">

                                        <label for="re-enter-pass">Re-enter Password</label>

                                        <input type="password" name="password_confirmation" placeholder="Re-enter your Password" required id="re-enter-pass">

                                    </div>

                                </div>

                                <div class="col-xs-12">

                                    <button class="btn btn-block btn-color" type="submit" name="submit">Change Password</button>

                                </div>

                            </div>

                        </form>

                    </div>

                    <div id="data-step6" class="account-content" data-temp="tabdata" style="display:none">

                        <div class="row">

                            <div class="col-xs-12">

                                <div class="heading-part heading-bg mb-30">

                                    <h2 class="heading m-0">Get Logout</h2>

                                </div>

                            </div>

                        </div>



                        <a href="{{ route('logout') }}" class="btn btn-block btn-color" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> Logout</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">

                            {{ csrf_field() }}

                        </form>

                    </div>

                    <div id="data-step7" class="account-content" data-temp="tabdata" style="display:none">

                        <div class="row">

                            <div class="col-xs-12">

                                <div class="heading-part heading-bg mb-30">

                                    <h2 class="heading m-0">My Testimonial</h2>

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-xs-12">

                                <div class="heading-part heading-bg mb-30">

                                    <h3 class="heading m-0">Testimonial Status :

                                        @if($testimonial == null)

                                        <span class="label label-primary"><i class="fa fa-times"></i> Not Submitted</span>

                                        @else

                                            @if($testimonial->status == 0)

                                                <span class="label label-primary"><i class="fa fa-spinner"></i> Pending</span>

                                            @else

                                                <span class="label label-success"><i class="fa fa-check"></i> Approved</span>

                                            @endif

                                        @endif



                                    </h3>

                                </div>

                            </div>

                        </div>

                        @if($testimonial == null)

                            <form class="main-form full" action="{{ route('user-send-testimonial') }}" method="POST" enctype="multipart/form-data">

                                {!! csrf_field() !!}

                                <div class="row">

                                    <div class="col-xs-12">

                                        <div class="input-box">

                                            <label for="old-pass">Author Name</label>

                                            <input type="text" name="name" placeholder="Author name" required id="old-pass">

                                        </div>

                                    </div>

                                    <div class="col-xs-12">

                                        <div class="input-box">

                                            <label for="login-pass">Author Position</label>

                                            <input type="text" name="position" placeholder="Author Position" required id="login-pass">

                                        </div>

                                    </div>

                                    <div class="col-xs-12">

                                        <div class="input-box">

                                            <label for="re-enter-pass">Author Image</label>

                                            <div class="row">

                                                <div class="col-md-12">

                                                    <div class="fileinput fileinput-new" data-provides="fileinput">

                                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">

                                                            <img style="width: 200px" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=Author Image" alt="...">

                                                        </div>

                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>

                                                        <div>

                                                <span class="btn btn-info btn-file">

                                                    <span class="fileinput-new bold uppercase"><i class="fa fa-file-image-o"></i> Select image</span>

                                                    <span class="fileinput-exists bold uppercase"><i class="fa fa-edit"></i> Change</span>

                                                    <input type="file" name="image" accept="image/*">

                                                </span>

                                                            <a href="#" class="btn btn-danger fileinput-exists bold uppercase" data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-xs-12">

                                        <div class="input-box">

                                            <label for="login-pass">Testimonial Text</label>

                                            <textarea name="message" placeholder="Testimonial Text" rows="4" required id="login-pass"></textarea>

                                        </div>

                                    </div>

                                    <div class="col-xs-12">

                                        <button class="btn btn-block btn-color" type="submit" name="submit">Submit Testimonial</button>

                                    </div>

                                </div>

                            </form>

                        @else

                            <form class="main-form full" action="{{ route('user-update-testimonial') }}" method="POST" enctype="multipart/form-data">

                                {!! csrf_field() !!}

                                <div class="row">

                                    <div class="col-xs-12">

                                        <div class="input-box">

                                            <label for="old-pass">Author Name</label>

                                            <input type="text" name="name" placeholder="Author name" value="{{ $testimonial->name }}" required id="old-pass">

                                        </div>

                                    </div>

                                    <div class="col-xs-12">

                                        <div class="input-box">

                                            <label for="login-pass">Author Position</label>

                                            <input type="text" name="position" placeholder="Author Position" value="{{ $testimonial->position }}" required id="login-pass">

                                        </div>

                                    </div>

                                    <div class="col-xs-12">

                                        <div class="input-box">

                                            <label for="re-enter-pass">Author Image</label>

                                            <div class="row">

                                                <div class="col-md-12">

                                                    <div class="fileinput fileinput-new" data-provides="fileinput">

                                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">

                                                            <img style="width: 200px" src="{{ asset('assets/images/testimonial') }}/{{ $testimonial->image }}" alt="...">

                                                        </div>

                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>

                                                        <div>

                                                <span class="btn btn-info btn-file">

                                                    <span class="fileinput-new bold uppercase"><i class="fa fa-file-image-o"></i> Select image</span>

                                                    <span class="fileinput-exists bold uppercase"><i class="fa fa-edit"></i> Change</span>

                                                    <input type="file" name="image" accept="image/*">

                                                </span>

                                                            <a href="#" class="btn btn-danger fileinput-exists bold uppercase" data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-xs-12">

                                        <div class="input-box">

                                            <label for="login-pass">Testimonial Text</label>

                                            <textarea name="message" placeholder="Testimonial Text" rows="4" required id="login-pass">{{ $testimonial->message }}</textarea>

                                        </div>

                                    </div>

                                    <div class="col-xs-12">

                                        <button class="btn btn-block btn-color" type="submit" name="submit">Update Testimonial</button>

                                    </div>

                                </div>

                            </form>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- CONTAINER END -->

    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-exclamation-triangle'></i> <strong>Confirmation !</strong></h4>

                </div>



                <div class="modal-body">

                    <strong>Are you sure you want to Delete ?</strong>

                </div>



                <div class="modal-footer">

                    <form method="post" action="{{ route('wishlist-delete') }}" class="form-inline">

                        {!! csrf_field() !!}

                        {{ method_field('DELETE') }}

                        <input type="hidden" name="id" class="delete_id" value="0">



                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>

                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> DELETE</button>

                    </form>

                </div>



            </div>

        </div>

    </div>



@endsection

@section('scripts')



    <script src="{{ asset('assets/admin/js/bootstrap-fileinput.js') }}"></script>



    <script>

        $(document).ready(function () {



            $(document).on("click", '.delete_button', function (e) {

                var id = $(this).data('id');

                $(".delete_id").val(id);

            });

        });

    </script>



    @foreach($wishlist as $con)



        <script>

            var url = '{{ url('/') }}';

            $(document).ready(function () {

                $(document).on("click", '#wish{{$con->id}}', function (e) {



                    $.post(

                        '{{ url('/wishlist-to-cart') }}',

                        {

                            _token: '{{ csrf_token() }}',

                            id : $(this).data('id'),

                            qty : $('#qty{{ $con->id }}').val()

                        },

                        function(data) {

                            var result = $.parseJSON(data);

                            if (result['cartError'] == "yes"){

                                toastr.warning(result['cartErrorMessage']);

                            }else{

                                toastr.success('Cart Updated Successfully.');

                                $('#cartShow').empty();

                                $('#cartShow').append(result['cartShowFinal']);

                                $('#cartFullView').empty();

                                var div = document.getElementById('cartFullView');

                                div.innerHTML = result['all'];

                            }

                        }

                    );

                });

            });

        </script>



    @endforeach

@endsection