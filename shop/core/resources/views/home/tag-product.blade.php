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
    <section class="ptb-50">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-4 mb-xs-30">
                    <div class="sidebar-block">
                        <div class="sidebar-box listing-box mb-40"> <span class="opener plus"></span>
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

                        @if($ad1 != null)
                            <div class="sidebar-box mb-30 visible-sm visible-md visible-lg hidden-xs">
                                @if($ad1->advert_type == 1)
                                    <a href="{{ $ad1->link }}" target="_blank"><img class="center-block" src="{{ asset('assets/images/advertise') }}/{{ $ad1->val1 }}" alt="{{ $ad1->title }}"></a>
                                @else
                                    {!! $ad1->val2 !!}
                                @endif
                            </div>
                        @endif
                        <div class="sidebar-box sidebar-item"> <span class="opener plus"></span>
                            <div class="sidebar-title">
                                <h3>Best Sell</h3>
                            </div>
                            <div class="sidebar-contant">
                                <ul>
                                    @foreach($bestSell as $ffp)

                                        @php $fp = \App\Product::findOrFail($ffp->product_id) @endphp

                                        <li>
                                            <div class="pro-media">
                                                <a href="{{ route('product-details',$fp->slug) }}"><img alt="{{ $fp->name }}" src="{{ asset('assets/images/product') }}/{{ $fp->image }}"></a>
                                            </div>
                                            <div class="pro-detail-info"> <a href="{{ route('product-details',$fp->slug) }}">{{ substr($fp->name,0,18) }}..</a>
                                                <div class="rating-summary-block right-side">
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

                                                    </div>
                                                </div>
                                                <div class="price-box"> <span class="price">{{$basic->symbol}}{{$fp->current_price}}</span>
                                                    <span class="product-rating">
                                                            {!! \App\TraitsFolder\CommonTrait::viewRating($finalRating) !!}
                                                        </span>
                                                </div>
                                                <div class="bottom-detail cart-button">
                                                    <ul>
                                                        <li class="pro-cart-icon">
                                                            <button style="padding: 6px 15px" type="button" title="Add to Cart" data-id="{{ $fp->id }}" class="btn btn-xs btn-color SingleCartAdd"><span></span>Add to Cart</button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-8">
                    <div class="sidebar-title">
                        <h3>{{ $page_title }}</h3>
                    </div>
                    <div class="product-listing">
                        @if(count($tag->products) != 0)
                                <div class="row mlr_-20">

                                    @foreach($tag->products as $fp)

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
                        @else
                            <div class="row">
                                <div class="col-xs-12">
                                    <h2 class="text-center" style="font-size: 24px;font-weight: bold;">Product Not Found..!</h2>
                                </div>
                            </div>
                        @endif
                    </div>
                    @if($ad4 != null)
                        <div class="visible-sm visible-md visible-lg hidden-xs">
                            @if($ad4->advert_type == 1)
                                <a href="{{ $ad4->link }}" target="_blank"><img  class="center-block" src="{{ asset('assets/images/advertise') }}/{{ $ad4->val1 }}" alt="{{ $ad4->title }}"></a>
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