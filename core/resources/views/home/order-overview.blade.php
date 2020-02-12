@extends('layouts.fontEnd')

@section('style')

    <style>

        .paymentWrap {

            padding: 0px;

        }



        .paymentWrap .paymentBtnGroup {

            width: 100%;

            margin: auto;

        }



        .paymentWrap .paymentBtnGroup .paymentMethod {

            padding: 70px;

            box-shadow: none;

            position: relative;

            width: 100%;

        }



        .paymentWrap .paymentBtnGroup .paymentMethod.active {

            outline: none !important;

        }



        .paymentWrap .paymentBtnGroup .paymentMethod.active .method {

            border-color: #4cd264;

            outline: none !important;

            box-shadow: 0px 3px 22px 0px #7b7b7b;

            border-radius: 5px;

        }



        .paymentWrap .paymentBtnGroup .paymentMethod .method {

            position: absolute;

            right: 0px;

            top: 0px;

            bottom: 0px;

            left: 0px;

            background-size: contain;

            background-position: center;

            background-repeat: no-repeat;

            border: 2px solid #eee;

            transition: all 0.5s;

            border-radius: 5px;

        }



        .paymentWrap .paymentBtnGroup .paymentMethod .method:hover {

            border-color: #4cd264;

            outline: none !important;

            border-radius: 5px;

        }

    </style>

@stop

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

                    <div class="checkout-step mb-40">

                        <ul>

                            <li> <a href="#">

                                    <div class="step">

                                        <div class="line"></div>

                                        <div class="circle">1</div>

                                    </div>

                                    <span>Shipping</span> </a> </li>

                            <li class="active"> <a href="#">

                                    <div class="step">

                                        <div class="line"></div>

                                        <div class="circle">2</div>

                                    </div>

                                    <span>Order Overview</span> </a> </li>

                            <li> <a>

                                    <div class="step">

                                        <div class="line"></div>

                                        <div class="circle">3</div>

                                    </div>

                                    <span>Payment</span> </a> </li>

                            <li> <a>

                                    <div class="step">

                                        <div class="line"></div>

                                        <div class="circle">4</div>

                                    </div>

                                    <span>Order Complete</span> </a> </li>

                            <li>

                                <div class="step">

                                    <div class="line"></div>

                                </div>

                            </li>

                        </ul>

                        <hr>

                    </div>



                    <div class="checkout-content">

                        <div class="row">

                            <div class="col-xs-12">

                                <div class="heading-part align-center">

                                    <h2 class="heading">Order Overview</h2>

                                </div>

                            </div>

                        </div>

                        <div id="cartFullView" class="row">

                            <div class="col-xs-12 mb-xs-30">

                                <div class="sidebar-title">

                                    <h3>{{ $page_title }}</h3>

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

                                                <th>Quantity</th>

                                                <th>Sub Total</th>

                                                <th>Action</th>

                                            </tr>

                                            </thead>

                                            <tbody>

                                            @foreach(Cart::content() as $con)

                                                @php $product = \App\Product::findOrFail($con->id) @endphp

                                                <tr id="product_{{$con->rowId}}">

                                                    <td>

                                                        <a href="{{ route('product-details',$product->slug) }}">

                                                            <div class="product-image"><img alt="{{ $con->name }}" src="{{ asset('assets/images/product') }}/{{$con->options->image}}"></div>

                                                        </a>

                                                    </td>

                                                    <td>

                                                        <div class="product-title">

                                                            <a href="{{ route('product-details',$product->slug) }}">{{ $con->name }}</a>

                                                        </div>

                                                    </td>

                                                    <td>

                                                        <ul>

                                                            <li>

                                                                <div class="base-price price-box"> <span class="price">{{$basic->symbol}}{{ $con->price }}</span> </div>

                                                            </li>

                                                        </ul>

                                                    </td>

                                                    <td>

                                                        <ul>

                                                            <li>

                                                                @if($con->options->color == 0)

                                                                    <div class="base-price price-box"> <span class="price">-</span></div>

                                                                @else

                                                                    <div class="base-price price-box"><span class="label label-default">{{ \App\Color::findOrFail($con->options->color)->name }}</span></div>

                                                                @endif

                                                            </li>

                                                        </ul>

                                                    </td>

                                                    <td>

                                                        <ul>

                                                            <li>

                                                                @if($con->options->size == 0)

                                                                    <div class="base-price price-box"> <span class="price">-</span></div>

                                                                @else

                                                                    <div class="base-price price-box"><span class="label label-default">{{ \App\Size::findOrFail($con->options->size)->name }}</span></div>

                                                                @endif

                                                            </li>

                                                        </ul>

                                                    </td>

                                                    <td>

                                                        <div class="input-box">

                                                            <div class="custom-qty">

                                                                <button id="btnMinus{{$con->rowId}}" onclick="var result = document.getElementById('qty{{ $con->id }}'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) result.value--;return false;" class="reduced items" type="button"> <i class="fa fa-minus"></i> </button>

                                                                <input type="text" class="input-text qty" readonly title="Qty" value="{{ $con->qty }}" maxlength="{{ $product->stock }}" id="qty{{ $con->id }}" name="qty{{ $con->id }}">

                                                                <button id="btnPlus{{$con->rowId}}" onclick="var result = document.getElementById('qty{{ $con->id }}'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="increase items" type="button"> <i class="fa fa-plus"></i> </button>

                                                            </div>

                                                        </div>

                                                    </td>

                                                    <td><div class="total-price price-box"> <span class="price">{{$basic->symbol}}{{ $con->price * $con->qty  }}</span> </div></td>

                                                    <td><i title="Remove Item From Cart" data-id="{{ $con->rowId }}" class="fa fa-trash delete_cart cart-remove-item"></i></td>

                                                </tr>

                                            @endforeach

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                            </div>

                            <div class="col-sm-12">

                                <div class="cart-total-table commun-table">

                                    <div class="table-responsive">

                                        <table class="table table-bordered">

                                            <tbody>

                                            <tr>

                                                <td>Item(s) Subtotal</td>

                                                <td><div class="price-box"> <span class="price">{{ $basic->symbol }}{{ Cart::subtotal() }}</span> </div></td>

                                            </tr>

                                            <tr>

                                                <td>Tax - {{ $basic->tax }}% </td>

                                                <td><div class="price-box"> <span class="price">{{ $basic->symbol }}{{ Cart::tax() }}</span> </div></td>

                                            </tr>                                            
                                            
                                            <tr>

                                                <td>Shipping Estimate</td>

                                                <td><div class="price-box"> <span class="price"> Ksh {{ $shipping }}</span> </div></td>

                                            </tr> 
                                            

                                            <tr>

                                                <td><b>Amount Payable</b></td>

                                                <td><div class="price-box"> <span class="price"><b>{{ $basic->symbol }}{{ Cart::total() + $shipping }}</b></span> </div></td>

                                            </tr>

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                            </div>

                        </div>
                        <br>



                        <div class="row">

                            <div class="col-sm-12">

                                <div class="cart-total-table address-box commun-table mb-30">

                                    <div class="paymentCont">

                                        <div class="headingWrap">

                                            <h3 class="headingTop text-center bold">Chose Your Payment Method</h3><br>

                                        </div>

                                        <div class="paymentWrap">

                                            <div class="btn-group paymentBtnGroup btn-group-justified" data-toggle="buttons">

                                                <div class="row w-100 text-center">

                                                    @foreach($payment as $key => $pm)

                                                        <div class="col-md-3 text-center">

                                                            <label class="btn paymentMethod {{--{{ $key == 0 ? 'active' : ''}}--}}">

                                                                <div class="method" style="background-image: url('{{ asset('assets/images/payment') }}/{{$pm->image}}');background-size: cover;"></div>

                                                                <input type="radio" value="{{ $pm->id }}" name="method_id">

                                                            </label>

                                                        </div>

                                                    @endforeach
                                                   

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>



                        <div class="row">

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

                        </div>



                        <div class="row">

                            <div class="col-sm-6">

                                <div><a href="{{ route('home') }}" class="theme-button"><span><i class="fa fa-angle-left"></i></span>Continue Shopping</a> </div>

                            </div>

                            <div class="col-sm-6">

                                <div>

                                    <form action="{{ route('confirm-order') }}" method="post" id="form_id">

                                        {!! csrf_field() !!}
                                        

                                        <input type="hidden" name="payment_id" id="payment_id" value="">

                                        <button type="button" class="btn btn-success btn-block btn-fyi font-weight-bold text-uppercase" id="btnSubmitPayment"><i class="fa fa-send"></i> Submit Order</button>

                                    </form>

                                </div>

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



    <script>

        $(document).ready(function() {

            $('#btnSubmitPayment').on('click',function (e) {



                var method_id = $('input[name=method_id]:checked').val();



                if (method_id == null) {

                    toastr.warning('Please Select Payment Method.');

                }else{

                    $('#payment_id').val(method_id);

                    $("#form_id").submit();

                }



            })

        });

    </script>



    @foreach(Cart::content() as $con)



        <script>

            var url = '{{ url('/') }}';

            $(document).ready(function () {

                $(document).on("click", '#btnMinus{{$con->rowId}}', function (e) {

                    var qty = $('#qty{{ $con->id }}').val();

                    $.get(url + '/update-cart-item/' + '{{ $con->rowId }}'+'/'+qty,function (data) {

                        var result = $.parseJSON(data);

                        if (result['cartError'] == "yes"){

                            toastr.warning(result['cartErrorMessage']);

                        }else{

                            toastr.success('Cart Updated Successfully.');

                            $('#cartShow').empty();

                            $('#cartShow').append(result['cartShow']);

                            $('#cartFullView').empty();

                            var div = document.getElementById('cartFullView');

                            div.innerHTML = result['fullShow'];

                        }

                    });

                });

                $(document).on("click", '#btnPlus{{$con->rowId}}', function (e) {

                    var qty = $('#qty{{ $con->id }}').val();

                    $.get(url + '/update-cart-item/' + '{{ $con->rowId }}'+'/'+qty,function (data) {

                        var result = $.parseJSON(data);

                        if (result['cartError'] == "yes"){

                            toastr.warning(result['cartErrorMessage']);

                        }else{

                            toastr.success('Cart Updated Successfully.');

                            $('#cartShow').empty();

                            $('#cartShow').append(result['cartShow']);

                            $('#cartFullView').empty();

                            var div = document.getElementById('cartFullView');

                            div.innerHTML = result['fullShow'];

                        }

                    });

                });



            });

        </script>



    @endforeach



@endsection