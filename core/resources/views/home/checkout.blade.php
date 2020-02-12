@extends('layouts.fontEnd')
@section('style')

    <style>

        input, select, textarea{
            font-size:14px!important;
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

                            <li class="active"> <a href="{{ route('check-out') }}">

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

                    <div class="checkout-content" >

                        <div class="row">

                            <div class="col-xs-12">

                                <div class="heading-part align-center">

                                    <h2 class="heading">Please fill up your Shipping details</h2>

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-lg-10 col-md-10 col-sm-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">

                                <form action="{{ route('submit-details') }}" class="main-form full" method="post">

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

                                                    {{--  <input type="text" name="s_city" required placeholder="City Name">  --}}
                                                    <select name="s_city" >
                                                        <option value=""> Select Town</option>

                                                        @foreach ($routes as $route)
                                                            @php
                                                                echo $route;
                                                            @endphp
                                                            <option value="{{ $route->id }}">{{ $route->town }}</option>
                                                        @endforeach
                                                        
                                                    </select>

                                                </div>

                                            </div>
                                        
                                        </div>

                                    </div>

                                    <div class="">

                                        <div class="row">

                                            <div class="col-sm-12"> <button type="submit" class="theme-button btn-block right-side p-2">Next</button> </div>

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
                                                        {{--  @php
                                                        echo $route;
                                                    @endphp  --}}
                                                        <select name="s_city" >
                                                            <option value=""> Select Town</option>
    
                                                            @foreach ($routes as $route)

                                                                @if($userDetails->s_country == $value)

                                                                <option value="{{ $value }}" selected>{{ $value }}</option>

                                                                @else

                                                                <option value="{{ $route->id }}">{{ $route->town }}</option>

                                                                @endif
                                                                
                                                            @endforeach
                                                            
                                                        </select>
    
                                                    </div>
    
                                                </div>
                                               

                                                <div class="col-sm-6">

                                                    <div class="input-box">

                                                    <textarea name="s_address" required placeholder="Shipping Address">{{ $userDetails->s_address }}</textarea>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="">

                                            <div class="row">

                                                <div class="col-sm-12"> <button type="submit" class="theme-button btn-block right-side p-2">Next</button> </div>

                                            </div>

                                        </div>

                                    @endif

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- CONTAINER END -->





@endsection