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
                        <li><span>Contact</span></li>
                    </ul>
                </div>
            </section>
        </div>
    </div>
    <!-- BANNER END -->

    <!-- CONTAIN START ptb-50-->
    <section class="pt-50">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="map">
                        <div class="map-part">
                            <div id="map" class="map-inner-part">
                                {!! $basic->google_map !!}
                            </div>
                        </div>
                    </div>
                </div>
                @if($ad4 != null)
                    <div class="mt-20 visible-sm visible-md visible-lg hidden-xs">
                        @if($ad4->advert_type == 1)
                            <a href="{{ $ad4->link }}"  target="_blank"><img class="center-block" src="{{ asset('assets/images/advertise') }}/{{ $ad4->val1 }}" alt="{{ $ad4->title }}"></a>
                        @else
                            {!! $ad4->val2 !!}
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </section>
    <section class="pt-50 client-main align-center">
        <div class="container">
            <div class="contact-info">
                <div class="row m-0">
                    <div class="col-sm-4 p-0">
                        <div class="contact-box">
                            <div class="contact-icon contact-phone-icon"><i class="fa fa-phone"></i></div>
                            <span><b>Phone Number</b></span>
                            <p>{{ $basic->phone }}</p>
                        </div>
                    </div>
                    <div class="col-sm-4 p-0">
                        <div class="contact-box">
                            <div class="contact-icon contact-mail-icon"><i class="fa fa-envelope-open"></i></div>
                            <span><b>E-mail Address</b></span>
                            <p><a href="mailto:{{$basic->email}}">{{ $basic->email }}</a> </p>
                        </div>
                    </div>
                    <div class="col-sm-4 p-0">
                        <div class="contact-box">
                            <div class="contact-icon contact-open-icon"><i class="fa fa-map-marker"></i></div>
                            <span><b>Address</b></span>
                            <p>{{$basic->address}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ptb-50">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="heading-part mb-20">
                        <h2 class="main_title">Send a message!</h2>
                    </div>
                </div>
            </div>
            <div class="main-form">
                <div class="row">
                    <div class="col-md-12">
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

                    <form action="{{ route('contact-submit') }}" method="POST" name="contactform">
                        {!! csrf_field() !!}
                        <div class="col-sm-6 mb-30">
                            <input type="text" required placeholder="Name" name="name">
                        </div>
                        <div class="col-sm-6 mb-30">
                            <input type="text" required placeholder="Subject" name="subject">
                        </div>
                        <div class="col-sm-6 mb-30">
                            <input type="email" required placeholder="Email" name="email">
                        </div>
                        <div class="col-sm-6 mb-30">
                            <input type="text" required placeholder="Phone" name="phone">
                        </div>
                        <div class="col-xs-12 mb-30">
                            <textarea required placeholder="Write Your Message Here.." rows="5" cols="30" name="message"></textarea>
                        </div>
                        <div class="col-xs-6">
                            <div class="align-center">
                                <button type="submit" name="submit" class="btn-color btn-block"><i class="fa fa-send"></i> Submit Message</button>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="align-center">
                                <button type="reset" class="btn-block btn-danger" style="border: none"><i class="fa fa-recycle"></i> Reset All</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- CONTAINER END -->



@endsection