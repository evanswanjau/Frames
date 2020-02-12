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

                    <div class="row">

                        <div class="col-lg-6 col-md-8 col-sm-8 col-lg-offset-3 col-sm-offset-2">



                            <form class="main-form full" action="{{ route('login') }}" method="POST">

                                {!! csrf_field() !!}

                                <div class="row">

                                    <div class="col-xs-12 mb-20">

                                        <div class="sidebar-title">

                                            <h3>Log In</h3>

                                        </div>

                                    </div>

                                    <div class="col-xs-12">

                                        @if($errors->any())

                                            @foreach ($errors->all() as $error)

                                                <div class="alert alert-danger alert-dismissable">

                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                                                    {!!  $error !!}

                                                </div>

                                            @endforeach

                                        @endif

                                        @if (session()->has('message'))

                                            <div class="alert alert-success alert-dismissable">

                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                                                {{ session()->get('message') }}

                                            </div>

                                        @endif

                                    </div>

                                    <div class="col-xs-12">

                                        <div class="input-box">

                                            <label for="login-email">Email address</label>

                                            <input id="login-email" name="email" type="email" value="{{ old('email') }}" required placeholder="Email Address">

                                        </div>

                                    </div>

                                    <div class="col-xs-12">

                                        <div class="input-box">

                                            <label for="login-pass">Password</label>

                                            <input id="login-pass" name="password" type="password" required placeholder="Enter your Password">

                                        </div>

                                    </div>

                                    <div class="col-xs-6">

                                        <div class="check-box left-side">

                                            <span>

                                              <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} id="remember_me" class="checkbox">

                                              </span>

                                            <label for="remember">Remember Me</label>

                                        </div>

                                    </div>

                                    <div class="col-xs-6">

                                        <div class="right-side">

                                            <a title="Forgot Password" class="forgot-password mtb-20" style="margin-top: 5px" href="{{ route('password.request') }}">Forgot your password?</a>

                                        </div>

                                    </div>

                                    <div class="col-xs-12">

                                        <button name="submit" type="submit" class="btn-color btn-block right-side">Log In</button>

                                    </div>
                                    <div class="col-xs-12 my-2">

                                        <a href="{{url('/redirect')}}"><img style="width:49.5%;" src="{{ asset('assets/images/facebook.png') }}"></a>
                                        <a href="{{url('/gredirect')}}"><img style="width:49.5%;" src="{{ asset('assets/images/google.png') }}"></a>

                                    </div>

                                    <div class="col-xs-12">

                                        <div class="new-account align-center mt-20"> <span>Need new  Account ?</span> <a class="link" title="Register" href="{{ route('register') }}">Create New Account</a> </div>

                                    </div>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- CONTAINER END -->

    

@endsection