@extends('layouts.fontEnd')

@section('style')



@endsection

@section('content')

    <div class="container welcome-to-frames py-5">
        <div class="row">
            <div class="col-sm-6 text-center pt-5">
                <img class="mx-auto mt-5" style="width:80%;" src="{{ asset('assets/images/welcome.jpeg') }}" alt="">
            </div>
            <div class="col-sm-6 pt-5">
                <h1 class="display-3 mt-5 pt-3">Quality custom framing at the comfort of your home.</h3>
                    <br>
                <button class="show-imageupload theme-button">get started</button> 
            </div>
        </div>
    </div>


    {{--  <!-- BANNER STRAT -->

    <div class="banner">

        <div class="row">

            <div class="col-xs-12">

                <div class="main-banner">

                    @foreach($slider as $sli)

                    <div class="item"> <img src="{{ asset('assets/images/slider') }}/{{ $sli->image }}" alt="MarketShop">

                        <div class="banner-detail">

                            <div class="container">

                                <div class="banner-detail-inner">

                                    <h1 class="banner-title">{{ $sli->main_title }}</h1>

                                    <span class="slogan">{{ $sli->sub_title }}</span><br>

                                    <p>{{ $sli->short_title }}</p>

                                    <a href="#" class="btn btn-color">Shop Now</a>

                                </div>

                            </div>

                        </div>

                    </div>

                    @endforeach

                </div>

            </div>

        </div>

    </div>

    <!-- BANNER END -->  --}}



    <!--  Site Services Features Block Start  -->

    <section class="pt-50 pt-xs-30">

        <div class="container">

            <div class="ser-feature-block center-sm">

                <div class="row">

                    @foreach($speciality as $sp)

                    <div class="col-md-3 col-xs-6 feature-box-main">

                        <div class="feature-box feature1">

                            <img src="{{ asset('assets/images/speciality') }}/{{ $sp->image }}" alt="">

                            <div class="ser-title">{{ $sp->title }}</div>

                            <div class="ser-subtitle">{{ $sp->subtitle }}</div>

                        </div>

                    </div>

                    @endforeach

                </div>

            </div>

        </div>

    </section>

    <!--  Site Services Features Block End  -->



    <!-- CONTAIN START -->
    @if (isset($_GET['order_id']))
    @php
       echo \App\Http\Controllers\UserController::paymentComplete($_GET['user_id'], $_GET['order_id']);
    @endphp
    @endif
    <section class="ptb-50 ptb-xs-30 gray-bg">

        <div class="container">

            <div class="row">

                <div class="col-md-12 col-sm-12">

                    <div class="product-slider mb-40">

                        <div class="featured-product">

                                <div class="row mlr_-20">

                                    @foreach($latestProduct as $fp)

                                        <div class="col-md-3 col-xs-6 plr-20">


                                            <div class="product-item {{ $fp->stock == 0 ? 'sold-out' : ''}}">

                                                @if($fp->mood_id == 0)

                                                    <div class="sale-label sell-label"><span>Sale</span></div>

                                                @elseif($fp->mood_id == 1)

                                                    <div class="sale-label green-label"><span>New</span></div>

                                                @elseif($fp->mood_id == 2)

                                                    <div class="sale-label red-label"><span>Hot</span></div>

                                                @endif

                                                <div class="product-image">
                                                    @if(Session::has('uploadImage'))
                                                    @php
                                                        $session_image = Session::get('uploadImage')['imageName'];
                                                    @endphp
                                                    <a href="{{ route('product-details',$fp->slug) }}"><img class="image1" style="border: 20px solid transparent;padding:25px;background-color:#fff;border-image: url({{ asset('assets/images/product/' . $fp->slug . '_0.png') }}) 30 round;" src='{{ asset("assets/images/custom-images/$session_image") }}'></a>
                     
                                                @else
                                                    <a href="{{ route('product-details',$fp->slug) }}"> <img src="{{ asset('assets/images/product') }}/{{ $fp->image }}" alt="{{ $fp->name }}"> </a>
                                                @endif

                                                    <div class="product-detail-inner">

                                                        <div class="detail-inner-left left-side">

                                                            <ul>

                                                                <li class="pro-cart-icon">

                                                                    <button title="Add to Cart" class="SingleCartAdd" data-id="{{ $fp->id }}"><i class="fa fa-cart"></i></button>

                                                                </li>

                                                                <li class="pro-wishlist-icon active"><a class="SingleWishList" data-id="{{ $fp->id }}" title="Wishlist"></a></li>

                                                                <li class="pro-compare-icon"><a id="compareId" data-id="{{ $fp->id  }}" title="Compare"></a></li>

                                                            </ul>

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="product-item-details">

                                                    <div class="product-item-name"> <a href="{{ route('product-details',$fp->slug) }}">{{ substr($fp->name,0,65) }}</a> </div>

                                                    <div class="price-box">

                                                        <span class="price">{{$basic->symbol}}{{ $fp->current_price }}</span>

                                                        @if($fp->old_price != null)

                                                            <del class="price old-price">{{$basic->symbol}}{{ $fp->old_price }}</del>

                                                        @endif

                                                        <div class=" right-side">

                                                            @php

                                                                $totalReview = \App\Review::whereProduct_id($fp->id)->count();

                                                                if ($totalReview == 0){

                                                                    $finalRating = 0;

                                                                }else{

                                                                    $totalRating = \App\Review::whereProduct_id($fp->id)->sum('rating');

                                                                    $finalRating = round($totalRating / $totalReview);

                                                                }

                                                            @endphp

                                                            <div class="rating-result">

                                                                <span class="product-rating">

                                                                    {!! \App\TraitsFolder\CommonTrait::viewRating($finalRating) !!}

                                                                </span>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>



                                    @endforeach



                                </div>

                                <div class="row">

                                    <div class="col-xs-12">

                                        <div class="pagination-bar">

                                            {!! $latestProduct->links('home.pagination') !!}

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



    <script>

        $(document).ready(function() {



            $( "#slider-range" ).slider({

                range: true,

                min: 0,

                max: 1000,

                values: [ 180, 800 ],

                slide: function( event, ui ) {

                    $( "#amount" ).val("{{ $basic->symbol }}"+ui.values[ 0 ]+"-{{ $basic->symbol }}" + ui.values[ 1 ]);

                }

            });

            $( "#amount" ).val("{{ $basic->symbol }}"+$( "#slider-range" ).slider("values",0)+ "-{{ $basic->symbol }}"+$( "#slider-range" ).slider( "values", 1));

        });


        function add_image_item(value){

            toastr.success('Image has been uploaded successfully.');
            $(document).ready(function(){
            
                $('.uploadImage').fadeOut();
            
            });
            return false;

        }

    </script>

@endsection