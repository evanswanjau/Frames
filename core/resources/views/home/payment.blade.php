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
                    <div class="checkout-step mb-40">
                        <ul>
                            <li> <a href="{{ route('check-out') }}">
                                    <div class="step">
                                        <div class="line"></div>
                                        <div class="circle">1</div>
                                    </div>
                                    <span>Shipping</span> </a> </li>
                            <li> <a href="{{ route('oder-overview') }}">
                                    <div class="step">
                                        <div class="line"></div>
                                        <div class="circle">2</div>
                                    </div>
                                    <span>Order Overview</span> </a> </li>
                            <li class="active"> <a>
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
                                    <h2 class="heading">Select a payment method</h2>
                                    <h2 class="heading">Total Amount : <span class="payment-balance">{{ $basic->symbol }}{{ $orderDetails->total }}</span></h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-10 col-md-10 col-sm-10 col-lg-offset-1 col-sm-offset-1 col-md-offset-1">
                                <div class="payment-option-box">
                                    <div class="payment-option-box-inner gray-bg">
                                        <div class="payment-top-box">
                                            <div class="row">
                                                @foreach($paymentMethod as $pm)
                                                <div class="col-md-4 col-sm-6 mb-20">
                                                    <div class="paypal-box">
                                                        <img src="{{ asset('assets/images/payment') }}/{{ $pm->image }}">
                                                        <a href="{{ route('payment-overview',['id'=>$pm->id,'orderNumber'=>$orderDetails->order_number]) }}" class="btn btn-color btn-block" style="border-radius: 3px;margin-top: 10px">Payment Now</a>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
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



@endsection