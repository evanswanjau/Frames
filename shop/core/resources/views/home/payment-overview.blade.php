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
                            <li> <a href="#">
                                    <div class="step">
                                        <div class="line"></div>
                                        <div class="circle">1</div>
                                    </div>
                                    <span>Shipping</span> </a> </li>
                            <li> <a href="#">
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
                                    <h2 class="heading">Payment with : {{ $paymentMethod->name }}</h2>
                                    <h2 class="heading">Total Amount : <span class="payment-balance">{{ $basic->symbol }}{{ $payment->usd }}</span></h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-10 col-md-10 col-sm-10 col-lg-offset-1 col-sm-offset-1 col-md-offset-1">
                                <div class="payment-option-box">
                                    <div class="payment-option-box-inner gray-bg">
                                        <div class="payment-top-box">
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4 mb-20">
                                                    <div class="paypal-box">
                                                        <img src="{{ asset('assets/images/payment') }}/{{ $payment->payment->image }}">
                                                        <a href="{{ route('payment',$payment->order_number) }}" class="btn btn-color btn-block" style="border-radius: 3px;margin-top: 10px">Back To Another Method</a>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-sm-8" style="overflow: hidden">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <tbody>
                                                            <tr>
                                                                <td width="50%" class="text-right"><b>Total Amount</b></td>
                                                                <td width="50%"><div class="price-box text-left">
                                                                        <span class="price">{{ $basic->symbol }}{{$payment->amount}}</span>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="50%" class="text-right"><b>Charge - {{$basic->symbol}}{{$payment->payment->fix}}+{{$payment->payment->percent}}%</b></td>
                                                                <td width="50%"><div class="price-box text-left">
                                                                        <span class="price">{{ $basic->symbol }}{{$payment->charge}}</span>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="50%" class="text-right"><b>Net Amount</b></td>
                                                                <td width="50%"><div class="price-box text-left">
                                                                        <span class="price">{{ $basic->symbol }}{{$payment->net_amount}}</span>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="50%" class="text-right"><b>Conversion Rate</b></td>
                                                                <td width="50%"><div class="price-box text-left">
                                                                        <span class="price">1 USD = {{$payment->payment->rate}}{{ $basic->currency }}</span>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="50%" class="text-right"><b>Amount In USD</b></td>
                                                                <td width="50%"><div class="price-box text-left">
                                                                        <span class="price">{{ $basic->symbol }}{{$payment->usd}}</span>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @if($payment->payment_id == 1)
                                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                                            <form action="https://secure.paypal.com/uk/cgi-bin/webscr" method="post" name="paypal" id="paypal">
                                                                <input type="hidden" name="cmd" value="_xclick" />
                                                                <input type="hidden" name="business" value="{{ $payment->payment->val1 }}" />
                                                                <input type="hidden" name="cbt" value="{{ $site_title }}" />
                                                                <input type="hidden" name="currency_code" value="USD" />
                                                                <input type="hidden" name="quantity" value="1" />
                                                                <input type="hidden" name="item_name" value="Buy From {{ $site_title }}" />

                                                                <!-- Custom value you want to send and process back in the IPN -->
                                                                <input type="hidden" name="custom" value="{{ $payment->order_number }}" />
                                                                <input name="amount" type="hidden" value="{{ $payment->usd  }}">
                                                                <input type="hidden" name="return" value="{{ route('order-complete',$payment->order_number) }}"/>
                                                                <input type="hidden" name="cancel_return" value="{{ route('payment',$payment->order_number) }}" />
                                                                <!-- Where to send the PayPal IPN to. -->
                                                                <input type="hidden" name="notify_url" value="{{ route('paypal-ipn') }}" />

                                                                <button class="btn btn-primary btn-lg text-uppercase btn-block"><i class="fa fa-paypal"></i> Payment Here</button>

                                                            </form>
                                                        </div>
                                                    @elseif($payment->payment_id == 2)
                                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                                            <form action="https://perfectmoney.is/api/step1.asp" method="POST" id="myform">
                                                                <input type="hidden" name="PAYEE_ACCOUNT" value="{{ $payment->payment->val1 }}">
                                                                <input type="hidden" name="PAYEE_NAME" value="{{ $site_title }}">
                                                                <input type='hidden' name='PAYMENT_ID' value='{{ $payment->order_number }}'>
                                                                <input type="hidden" name="PAYMENT_AMOUNT"  value="{{ $payment->usd  }}">
                                                                <input type="hidden" name="PAYMENT_UNITS" value="USD">
                                                                <input type="hidden" name="STATUS_URL" value="{{ route('perfect-ipn') }}">
                                                                <input type="hidden" name="PAYMENT_URL" value="{{ route('order-complete',$payment->order_number) }}">
                                                                <input type="hidden" name="PAYMENT_URL_METHOD" value="GET">
                                                                <input type="hidden" name="NOPAYMENT_URL" value="{{ route('payment',$payment->order_number) }}">
                                                                <input type="hidden" name="NOPAYMENT_URL_METHOD" value="GET">
                                                                <input type="hidden" name="SUGGESTED_MEMO" value="{{ $site_title }}">
                                                                <input type="hidden" name="BAGGAGE_FIELDS" value="IDENT"><br>
                                                                <button class="btn btn-primary btn-lg text-uppercase btn-block"><i class="fa fa-credit-card-alt"></i>Payment Here</button>

                                                            </form>
                                                        </div>
                                                    @elseif($payment->payment_id == 3)
                                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                                            <h4 style="text-align: center;"> SEND EXACTLY <strong>{{ $usd }} BTC </strong> TO <strong>{{ $add }}</strong><br>
                                                                {!! $code !!} <br>
                                                                <strong>SCAN TO SEND</strong> <br><br>
                                                                <strong style="color: red;">NB: 3 Confirmation required to Credited your Account</strong>
                                                            </h4>
                                                        </div>
                                                    @elseif($payment->payment_id == 4)
                                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                                            <form role="form" method="POST" action="{{ route('stripe-submit') }}">
                                                                {!! csrf_field() !!}
                                                                <input type="hidden" name="amount" value="{{ $payment->usd }}">
                                                                <input type="hidden" name="custom" value="{{ $payment->order_number }}">
                                                                <input type="hidden" name="error_url" value="{{ route('payment',$payment->order_number) }}">
                                                                <input type="hidden" name="success_url" value="{{ route('order-complete',$payment->order_number) }}">
                                                                <div class="row">
                                                                    <div class="col-xs-12">
                                                                        <div class="form-group">
                                                                            <label for="cardNumber">CARD NUMBER</label>
                                                                            <div class="input-group">
                                                                                <input type="tel" class="form-control input-lg" name="cardNumber" placeholder="Valid Card Number" autocomplete="off" required autofocus />
                                                                                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-xs-4 col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="cardExpiry"><span class="hidden-xs">EXP MONTH</span></label>
                                                                            <input type="tel" class="form-control input-lg" name="cardExpiryMonth" placeholder="MM" autocomplete="off" required />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-4 col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="cardExpiry"><span class="hidden-xs">EXP YEAR</span></label>
                                                                            <input type="tel" class="form-control input-lg" name="cardExpiryYear" placeholder="YYYY" autocomplete="off" required />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-4 col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="cardCVC">CV CODE</label>
                                                                            <input type="tel" class="form-control input-lg" name="cardCVC" placeholder="CVC" autocomplete="off" required/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-xs-12">
                                                                        <button class="subscribe btn btn-primary btn-lg text-uppercase btn-block" type="submit"><i class="fa fa-credit-card"></i> Payment Here</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    @elseif($payment->payment_id == 5)
                                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                                            <form action="https://www.moneybookers.com/app/payment.pl" method="post">
                                                                <input type="hidden" name="pay_to_email" value="{{ $payment->payment->val1 }}"/>
                                                                <input type="hidden" name="status_url" value="{{ route('skrill-ipn') }}"/>
                                                                <input type="hidden" name="language" value="EN"/>
                                                                <input name="transaction_id" type="hidden" value="{{ $payment->order_number }}">
                                                                <input type="hidden" name="amount" value="{{ $payment->usd }}"/>
                                                                <input type="hidden" name="currency" value="USD"/>
                                                                <input type="hidden" name="detail1_description" value="{{ $site_title }}"/>
                                                                <input type="hidden" name="detail1_text" value="Charge For - {{ $site_title }}"/>
                                                                <input type="hidden" name="logo_url" value="{{ asset('assets/images/logo.png') }}"/>
                                                                <button type="submit" class="btn btn-primary btn-lg text-uppercase btn-block"><i class="fa fa-credit-card"></i>Payment Here</button>
                                                            </form>
                                                        </div>
                                                    @elseif($payment->payment_id == 6)
                                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                                            <form method="post" action="https://secure.payza.com/checkout">
                                                                @php $order = \App\Order::whereOrder_number($payment->order_number)->first() @endphp
                                                                <input type="hidden" name="ap_merchant" value="{{ $payment->payment->val1 }}"/>
                                                                <input type="hidden" name="ap_purchasetype" value="item"/>
                                                                <input type="hidden" name="ap_itemname" value="Multi Item"/>
                                                                <input type="hidden" name="ap_amount" value="{{ $payment->usd }}"/>
                                                                <input type="hidden" name="ap_currency" value="USD"/>
                                                                <input type="hidden" name="ap_description" value="Buy Product From {{ $site_title }}"/>
                                                                <input type="hidden" name="ap_itemcode" value="{{ $payment->order_number }}"/>
                                                                <input type="hidden" name="ap_quantity" value="1"/>
                                                                <input type="hidden" name="ap_additionalcharges" value="0"/>
                                                                <input type="hidden" name="ap_shippingcharges" value="0"/>
                                                                <input type="hidden" name="ap_taxamount" value="{{ $order->tax}}"/>
                                                                <input type="hidden" name="ap_discountamount" value="0"/>
                                                                <input type="hidden" name="ap_returnurl" value="{{ route('order-complete',$payment->order_number) }}"/>
                                                                <input type="hidden" name="ap_cancelurl" value="{{ route('payment',$payment->order_number) }}"/>
                                                                <input type="hidden" name="ap_alerturl" value="{{ route('payza-ipn') }}"/>
                                                                <input type="hidden" name="ap_ipnversion" value="2"/>
                                                                <input type="hidden" name="ap_test" value="1"/>
                                                                <button type="submit" class="btn btn-primary btn-lg text-uppercase btn-block"><i class="fa fa-credit-card"></i>Payment Here</button>
                                                            </form>
                                                        </div>
                                                    @elseif($payment->payment_id == 8)
                                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                                            <form action="https://www.coinpayments.net/index.php" method="post">
                                                                <input type="hidden" name="merchant" value="{{ $payment->payment->val1 }}">
                                                                <input type="hidden" name="item_name" value="Pay For - {{ $site_title }}">
                                                                <input type="hidden" name="currency" value="USD">
                                                                <input type="hidden" name="amountf" value="{{ $payment->usd }}">
                                                                <input type="hidden" name="ipn_url" value="{{ route('coinpayment-ipn') }}">
                                                                <input type="hidden" name="custom" value="{{ $payment->order_number }}">
                                                                <input type="hidden" name="cmd" value="_pay_simple">
                                                                <input type="hidden" name="want_shipping" value="0">
                                                                <input type="hidden" name="success_url" value="{{ route('order-complete',$payment->order_number) }}">
                                                                <input type="hidden" name="cancel_url" value="{{ route('payment',$payment->order_number) }}">
                                                                <button class="btn btn-primary btn-lg text-uppercase border-0 custom-btnPayment btn-block"><i class="fa fa-btc"></i> Payment Now</button>
                                                            </form>
                                                        </div>
                                                    @elseif($payment->payment_id == 7)
                                                        <div class="form-group">
                                                            <div class="col-sm-12">
                                                                <a href="{{ route('user-all-order') }}" class="btn btn-primary btn-lg text-uppercase btn-block"><i class="fa fa-send"></i>Confirm Now</a>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                                            <div class="text-center">
                                                                <h4>Send Total Amount Following Details:</h4>
                                                                <h3>{!! $payment->payment->val1 !!}</h3>
                                                                <hr>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <form action="{{ route('manual-payment-submit') }}" method="post" enctype="multipart/form-data">
                                                                        {!! csrf_field() !!}
                                                                        <input type="hidden" name="payment_number" value="{{ $payment->order_number }}">
                                                                        <div class="form-group row">
                                                                            <label class="col-md-12 label-control text-left" for="projectinput1"><b>Upload Proof Documents :  <code>Multiple Image allowed</code></b></label>
                                                                            <div class="col-md-12">
                                                                                <input type="file" id="projectinput1" class="form-control" name="images[]" multiple required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-md-12 label-control text-left" for="projectinput1"><b>Write your Message : </b></label>
                                                                            <div class="col-md-12">
                                                                                <textarea id="projectinput1" class="form-control" rows="4" placeholder="Write your Message" name="message"></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <button class="btn btn-primary btn-lg bg-softwarezon-x border-0 btn-block"><i class="fa fa-send"></i> Send Payment Request</button>
                                                                        <br>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

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
        </div>
    </section>
    <!-- CONTAINER END -->

@endsection
@section('scripts')



@endsection