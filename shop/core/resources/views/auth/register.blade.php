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

                            <form class="main-form full" action="{{ route('register') }}" method="post">
                                {!! csrf_field() !!}
                                <div class="row">
                                    <div class="col-xs-12 mb-20">
                                        <div class="sidebar-title">
                                            <h3>Create New account</h3>
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
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="input-box">
                                            <label for="f-name">First Name</label>
                                            <input type="text" id="f-name" name="first_name" value="{{ old('first_name') }}" required placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="input-box">
                                            <label for="l-name">Last Name</label>
                                            <input type="text" id="l-name" name="last_name" value="{{ old('last_name') }}" required placeholder="Last Name">
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="input-box">
                                            <label for="login-email">Email address</label>
                                            <input id="login-email" type="email" name="email" value="{{ old('email') }}" required placeholder="Email Address">
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="input-box">
                                            <label for="login-pass">Password</label>
                                            <input id="login-pass" type="password" name="password" required placeholder="Enter your Password">
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="input-box">
                                            <label for="re-enter-pass">Re-enter Password</label>
                                            <input id="re-enter-pass" type="password" name="password_confirmation" required placeholder="Re-enter your Password">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 mb-20">
                                        <div class="check-box">
                                            <span>
                                              <input type="checkbox" name="agree" required class="checkbox">
                                              </span>
                                            <label for="agree">I'm Agree All <a href="{{ route('terms-condition') }}" class="link">Terms & Condition</a> and <a class="link" href="{{ route('privacy-policy') }}">Privacy Policy</a> </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <button name="submit" type="submit" class="btn-color btn-block right-side">Register Now</button>
                                    </div>
                                    <div class="col-xs-12">
                                        <hr>
                                        <div class="new-account align-center mt-20"> <span>Already have an account.</span> <a class="link" title="Login" href="{{ route('login') }}">Login Here</a> </div>
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