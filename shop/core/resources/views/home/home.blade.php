@extends('layouts.fontEnd')
@section('style')

@endsection
@section('content')

    <!-- BANNER STRAT -->
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
    <!-- BANNER END -->

    <!--  Site Services Features Block Start  -->
    <section class="pt-50 pt-xs-30">
        <div class="container">
            <div class="ser-feature-block center-sm" style="background-image: url('{{ asset('assets/images/speciality') }}/{{ $basic->speciality_bg }}')">
                <div class="row">
                    @foreach($speciality as $sp)
                    <div class="col-md-3 col-xs-6 feature-box-main">
                        <div class="feature-box feature1" style="background: url('{{ asset('assets/images/speciality') }}/{{ $sp->image }}') no-repeat scroll 0 0;filter: brightness(0) invert(1);">
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
    <section class="ptb-50 ptb-xs-30">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-4 mb-xs-30">
                    <div class="sidebar-block">
                        <div class="sidebar-box listing-box mb-30"> <span class="opener plus"></span>
                            <div class="sidebar-title">
                                <h3>Categories</h3>
                            </div>
                            <div class="sidebar-contant">
                                <ul>
                                    @foreach($category as $cat)
                                    <li><a href="{{ route('category',['id'=>$cat->id,'slug'=>str_slug($cat->name)]) }}"><i class="fa fa-link"></i>{{ $cat->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        @if($ad2 != null)
                            <div class="sidebar-box mb-30 visible-sm visible-md visible-lg hidden-xs">
                                @if($ad2->advert_type == 1)
                                    <a href="{{ $ad2->link }}" target="_blank"><img class="center-block" src="{{ asset('assets/images/advertise') }}/{{ $ad2->val1 }}" alt="{{ $ad2->title }}"></a>
                                @else
                                    {!! $ad2->val2 !!}
                                @endif
                            </div>
                        @endif

                        <div class="sidebar-box gray-box mb-40"> <span class="opener plus"></span>
                            <div class="sidebar-title">
                                <h3>Product Filter</h3>
                            </div>
                            <div class="sidebar-contant">
                                <div class="price-range mb-30">
                                    <form action="{{ route('product-price-range') }}" method="get">
                                        <input class="price-txt" name="range_price" type="text" id="amount">
                                        <div id="slider-range"></div><br>
                                        <button type="submit" class="btn btn-color btn-block btn-sm" style="font-size: 16px"><i class="fa fa-sliders"></i> Filter Products</button>
                                    </form>
                                </div>
                            </div>
                        </div>


                        @if($ad1 != null)
                        <div class="sidebar-box mb-30 visible-sm visible-md visible-lg hidden-xs">
                            @if($ad1->advert_type == 1)
                                <a href="{{ $ad1->link }}" target="_blank"><img class="center-block" src="{{ asset('assets/images/advertise') }}/{{ $ad1->val1 }}" alt="{{ $ad1->title }}"></a>
                            @else
                                {!! $ad1->val2 !!}
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-9 col-sm-8">
                    <div class="product-slider mb-40">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="">
                                    <div id="tabs" class="category-bar mb-20 p-0">
                                        <ul class="tab-stap">
                                            <li><a class="tab-step1 selected" title="step1">Featured Products</a></li>
                                            <li><a class="tab-step2" title="step2">Best Sell Products</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="featured-product">
                            <div class="items">
                                <div class="tab_content pro_cat">
                                    <ul>
                                        <li>
                                            <div id="data-step1" class="items-step1 selected product-slider-main position-r" data-temp="tabdata">

                                                <div class="row mlr_-20">

                                                    @foreach($featuredProduct as $fp)

                                                    <div class="col-md-4 col-xs-6 plr-20">

                                                        <div class="product-item {{ $fp->stock == 0 ? 'sold-out' : ''}}">

                                                            @if($fp->mood_id == 0)
                                                                <div class="sale-label sell-label"><span>Sale</span></div>
                                                            @elseif($fp->mood_id == 1)
                                                                <div class="sale-label green-label"><span>New</span></div>
                                                            @elseif($fp->mood_id == 2)
                                                                <div class="sale-label red-label"><span>Hot</span></div>
                                                            @endif

                                                            <div class="product-image">
                                                                <a href="{{ route('product-details',$fp->slug) }}"> <img src="{{ asset('assets/images/product') }}/{{ $fp->image }}" alt="{{ $fp->name }}"> </a>
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
                                            </div>
                                        </li>
                                        <li>
                                            <div id="data-step2" class="items-step2 product-slider-main position-r" data-temp="tabdata" style="display:none">

                                                    <div class="row mlr_-20">

                                                        @foreach($bestSell as $ffp)
                                                            @php $fp = \App\Product::findOrFail($ffp->product_id) @endphp

                                                            <div class="col-md-4 col-xs-6 plr-20">

                                                                <div class="product-item {{ $fp->stock == 0 ? 'sold-out' : ''}}">
                                                                    @if($fp->mood_id == 0)
                                                                        <div class="sale-label sell-label"><span>Sale</span></div>
                                                                    @elseif($fp->mood_id == 1)
                                                                        <div class="sale-label green-label"><span>New</span></div>
                                                                    @elseif($fp->mood_id == 2)
                                                                        <div class="sale-label red-label"><span>Hot</span></div>
                                                                    @endif
                                                                    <div class="product-image">
                                                                        <a href="{{ route('product-details',$fp->slug) }}"> <img src="{{ asset('assets/images/product') }}/{{ $fp->image }}" alt="{{ $fp->name }}"> </a>
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
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($ad4 != null)
                        <div class="visible-sm visible-md visible-lg hidden-xs">
                            @if($ad4->advert_type == 1)
                                <a href="{{ $ad4->link }}"  target="_blank"><img class="center-block" src="{{ asset('assets/images/advertise') }}/{{ $ad4->val1 }}" alt="{{ $ad4->title }}"></a>
                            @else
                                {!! $ad4->val2 !!}
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="ptb-50 ptb-xs-30 gray-bg">
        <div class="container">
            <div class="row">

                <div class="col-md-12 col-sm-12">
                    <div class="product-slider mb-40">
                        <div class="sidebar-title">
                            <h3>Latest Product</h3>
                        </div>
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
                                                    <a href="{{ route('product-details',$fp->slug) }}"> <img src="{{ asset('assets/images/product') }}/{{ $fp->image }}" alt="{{ $fp->name }}"> </a>
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
                    @if($ad4 != null)
                        <div class="visible-sm visible-md visible-lg hidden-xs">
                            @if($ad4->advert_type == 1)
                                <a href="{{ $ad4->link }}" target="_blank"><img class="center-block" src="{{ asset('assets/images/advertise') }}/{{ $ad4->val1 }}" alt="{{ $ad4->title }}"></a>
                            @else
                                {!! $ad4->val2 !!}
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- CONTAINER END -->

    <section class="ptb-50 ptb-xs-30">
        <div class="container">
            <div class="row testimonial">
                <div id="testimonial_slider" class="text-center">
                    <div class="owl-carousel owl-theme">
                        @foreach($testimonial as $t)
                            <div class="item">
                                <div class="testimonial_header">
                                    <div>
                                        <img src="{{ asset('assets/images/testimonial') }}/{{ $t->image }}" style="width: 95px" class="center-block img-circle">
                                    </div>
                                    <h5>{{ $t->name }}</h5>
                                    <p>{{ $t->position }}</p>
                                </div>
                                <p>{{ $t->message }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>


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
    </script>
@endsection