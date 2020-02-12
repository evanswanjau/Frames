@extends('layouts.fontEnd')

@section('meta')

    <meta name="keywords" content="{!! $tags  !!}">

    <meta name="description" content="{{ strip_tags($product->description) }}">

    <meta property="og:title" content="{{ $product->name }}" />

    <meta property="og:url" content="{{ url()->current() }}" />

    <meta property="og:image" content="{{ asset('assets/images/product') }}/{{ $product->image }}" />

@endsection

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

    <section class="pt-50">

        <div class="container">

            <div class="row">

                <div class="col-md-3  mb-xs-30">

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

                    </div>

                    @if($ad2 != null)

                        <div class="sidebar-box mb-30 visible-sm visible-md visible-lg hidden-xs">

                            @if($ad2->advert_type == 1)

                                <a href="{{ $ad1->link }}"  target="_blank"><img class="center-block" src="{{ asset('assets/images/advertise') }}/{{ $ad2->val1 }}" alt="{{ $ad2->title }}"></a>

                            @else

                                {!! $ad2->val2 !!}

                            @endif

                        </div>

                    @endif

                </div>

                <div class="col-md-5 col-sm-5 mb-xs-30">

                    <div class="fotorama" data-nav="thumbs" data-allowfullscreen="native">

                        @foreach($productImage as $pi)

                        <a href="#"><img src="{{ asset('assets/images/product') }}/{{ $pi->name }}" alt="{{ $product->name }}"></a>

                        @endforeach

                    </div>

                </div>

                <div class="col-md-4 col-sm-7">

                    <div class="row">

                        <div class="col-xs-12">

                            <div class="product-detail-main">

                                <div class="product-item-details">

                                    <h1 class="product-item-name single-item-name">{{ $product->name }}</h1>

                                    <div class="rating-summary-block">

                                        <div class="rating-result single-rating">

                                            @php

                                                $totalReview = \App\Review::whereProduct_id($product->id)->count();

                                                if ($totalReview == 0){

                                                    $finalRating = 0;

                                                }else{

                                                    $totalRating = \App\Review::whereProduct_id($product->id)->sum('rating');

                                                    $finalRating = round($totalRating / $totalReview);

                                                }

                                            @endphp

                                            <p>

                                                <span class="review_score">{{ $finalRating }}/5</span>{!! \App\TraitsFolder\CommonTrait::viewRating($finalRating) !!}

                                            </p>

                                        </div>

                                    </div>

                                    <div class="price-box"> <span class="price">{{ $basic->symbol }}{{ $product->current_price }}</span> @if($product->old_price != null)<del class="price old-price bold">{{ $basic->symbol }}{{ $product->old_price }}</del>@endif</div>

                                    <div class="product-info-stock-sku">

                                        <div>

                                            <label>Availability: </label>

                                            @if($product->stock == 0)

                                                <span class="info-deta">Not Available</span>

                                            @elseif($product->stock < 10)

                                                <span class="info-deta">Low Available</span>

                                            @else

                                                <span class="info-deta">In stock</span>

                                            @endif

                                        </div>

                                        <div>

                                            <label>SKU: </label>

                                            <span class="info-deta">{{ $product->sku }}</span>

                                        </div>

                                        @if($product->provider_id != 0)

                                        <div>

                                            <label>Provider : </label>

                                            <span class="info-deta"><a href="{{ route('get-provider-product',$product->provider_id) }}">{{ $product->provider->name }}</a></span>

                                        </div>

                                        @endif

                                    </div>

                                    <form action="" method="post">

                                    @if($product->color_status == 1)

                                        <div class="product-color select-arrow mb-20">

                                            <label>Color</label>

                                            <select class="selectpicker form-control" id="color">

                                                @foreach($product->colors as $c)

                                                <option value="{{ $c->id }}">{{ $c->name }}</option>

                                                @endforeach

                                            </select>

                                        </div>

                                    @endif

                                    @if($product->size_status == 1)

                                        <div class="product-size select-arrow mb-20 mt-30">

                                            <label>Size</label>

                                            <select class="selectpicker form-control" id="size">

                                                @foreach($product->sizes as $c)

                                                    <option value="{{ $c->id }}">{{ $c->name }}</option>

                                                @endforeach

                                            </select>

                                        </div>

                                    @endif

                                    <div class="mb-40">

                                            {!! csrf_field() !!}

                                            <div class="product-qty">

                                                <label for="qty">Qty:</label>

                                                <div class="custom-qty">

                                                    <button onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) result.value--;return false;" class="reduced items" type="button"> <i class="fa fa-minus"></i> </button>

                                                    <input type="text" class="input-text qty" title="Qty" value="1" max="{{ $product->stock }}" id="qty" name="qty" required>

                                                    <button onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="increase items" type="button"> <i class="fa fa-plus"></i> </button>

                                                </div>

                                            </div>

                                            <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">

                                            <div class="bottom-detail cart-button">

                                                <ul>

                                                    <li class="pro-cart-icon">

                                                        <button type="button" title="Add to Cart" class="btn-black addCart"><span></span>Add to Cart</button>

                                                    </li>

                                                </ul>

                                            </div>

                                    </div>

                                    </form>

                                    <div class="product-info-stock-sku">

                                        <div>

                                            <label>Product Specification: </label>

                                            <hr>

                                            <br>

                                            @foreach($productSpecification as $ps)

                                                <p>{{ $ps->specification }}</p>

                                            @endforeach

                                        </div>

                                    </div>

                                    <div class="bottom-detail">

                                        <ul>



                                            <li class="pro-wishlist-icon"><a class="SingleWishList" data-id="{{ $product->id }}"><span></span>Wishlist</a></li>

                                            <li class="pro-compare-icon"><a id="compareId" data-id="{{ $product->id  }}" ><span></span>Compare</a></li>

                                            <li class="pro-email-icon"><a data-toggle="modal" data-target="#email_friends_modal"><span></span>Email</a></li>

                                        </ul>

                                    </div>

                                    <div class="share-link">

                                        <div class="social-link">

                                            <div class="sharethis-inline-share-buttons st-inline-share-buttons  st-left st-has-labels st-animated" id="st-1">

                                                <script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=5993ef01e2587a001253a261&product=inline-share-buttons"></script>

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

    <section class="ptb-50">

        <div class="container">

            <div class="product-detail-tab">

                <div class="row">

                    <div class="col-md-12">

                        <div id="tabs">

                            <ul class="nav nav-tabs">

                                <li><a class="tab-Description selected" title="Description">Description</a></li>

                                <li><a class="tab-Product-Tags" title="Product-Tags">Product-Tags</a></li>

                                <li><a class="tab-Reviews" title="Reviews">Reviews</a></li>

                                <li><a class="tab-Comments" title="Comments">Comments</a></li>

                            </ul>

                        </div>

                        <div id="items">

                            <div class="tab_content">

                                <ul>

                                    <li>

                                        <div class="items-Description selected gray-bg">

                                            <div class="Description">

                                                {!! $product->description !!}

                                            </div>

                                        </div>

                                    </li>

                                    <li>

                                        <div class="items-Product-Tags gray-bg">

                                            @foreach($product->tags as $pTag)

                                                <a href="{{ route('tag-products',$pTag->id) }}" class="label label-primary" style="font-size: 14px">#{{$pTag->name}}</a>

                                            @endforeach

                                        </div>

                                    </li>



                                    <li>

                                        <div class="items-Reviews gray-bg">

                                            <div class="comments-area">

                                                <h3 class="form-label">Reviews <span>({{ count($productReviews) }})</span></h3>

                                                <ul class="comment-list mt-30">

                                                    @foreach($productReviews as $rv)

                                                    <li>

                                                        <div class="comment-user">

                                                            <img class="img-circle" width="80%" src="{{ asset('assets/images/user') }}/{{ $rv->user->image }}" alt="{{ $rv->user->name }}"> </div>

                                                        <div class="comment-detail">

                                                            <div class="user-name">{{ $rv->user->first_name }} {{ $rv->user->last_name }}</div>

                                                            <div class="post-info">

                                                                <ul>

                                                                    <li>{{ \Carbon\Carbon::parse($rv->created_at)->format('M d, Y - h:i:s A')  }}</li>

                                                                </ul>

                                                            </div>

                                                            <p style="margin-bottom: 0px">{!! \App\TraitsFolder\CommonTrait::viewRating($rv->rating) !!} - <span class="review_score">{{ $rv->rating }}/5</span></p>

                                                            <p>{{ $rv->comment }}</p>

                                                        </div>

                                                    </li>

                                                    @endforeach

                                                </ul>

                                            </div>

                                            <div class="main-form mt-30">

                                                <div class="row">

                                                    @if(Auth::check())



                                                        @php $userReviewCount = \App\Review::whereUser_id(Auth::user()->id)->whereProduct_id($product->id)->count();@endphp



                                                        @if($userReviewCount != 0)

                                                            @php $userReview = \App\Review::whereUser_id(Auth::user()->id)->whereProduct_id($product->id)->first();@endphp

                                                            <div class="comments-area">

                                                                <h3 class="form-label">Your Review</h3>

                                                                <ul class="comment-list mt-30">

                                                                    <li>

                                                                        <div class="comment-user">

                                                                            <img class="img-circle" width="80%" src="{{ asset('assets/images/user') }}/{{ $userReview->user->image }}" alt="{{ $userReview->user->name }}"> </div>

                                                                        <div class="comment-detail">

                                                                            <div class="user-name">{{ $userReview->user->first_name }} {{ $userReview->user->last_name }}</div>

                                                                            <div class="post-info">

                                                                                <ul>

                                                                                    <li>{{ \Carbon\Carbon::parse($userReview->created_at)->format('M d, Y - h:i:s A')  }}</li>

                                                                                </ul>

                                                                            </div>

                                                                            <p style="margin-bottom: 0px">{!! \App\TraitsFolder\CommonTrait::viewRating($userReview->rating) !!} - <span class="review_score">{{ $rv->rating }}/5</span></p>

                                                                            <p>{{ $userReview->comment }}</p>

                                                                        </div>

                                                                    </li>

                                                                </ul>

                                                            </div>

                                                        @else

                                                        <form action="{{ route('review-submit') }}" method="post">

                                                            {!! csrf_field() !!}

                                                            <input type="hidden" name="product_id" value="{{ $product->id }}">

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

                                                            <div class="col-sm-12">

                                                                <div class="form-group">

                                                                    <label class="form-label">Rating for Product</label>

                                                                    <div class="listing_rating">

                                                                        <input name="rating" id="rating-1" value="5" type="radio" required="">

                                                                        <label for="rating-1" class="fa fa-star"></label>

                                                                        <input name="rating" id="rating-2" value="4" type="radio" required="">

                                                                        <label for="rating-2" class="fa fa-star"></label>

                                                                        <input name="rating" id="rating-3" value="3" type="radio" required="">

                                                                        <label for="rating-3" class="fa fa-star"></label>

                                                                        <input name="rating" id="rating-4" value="2" type="radio" required="">

                                                                        <label for="rating-4" class="fa fa-star"></label>

                                                                        <input name="rating" id="rating-5" value="1" type="radio" required="">

                                                                        <label for="rating-5" class="fa fa-star"></label>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="col-xs-12">

                                                                <div class="form-group">

                                                                    <label class="form-label">Rating Comment</label>

                                                                    <textarea cols="30" rows="3" name="comment" placeholder="Message" required></textarea>

                                                                </div>

                                                            </div>

                                                            <div class="col-xs-6 mb-30">

                                                                <button class="btn-color btn-block" type="submit">Submit</button>

                                                            </div>

                                                            <div class="col-xs-6 mb-30">

                                                                <button class="btn-danger btn-block" style="border: none" type="reset">Reset</button>

                                                            </div>

                                                        </form>

                                                        @endif

                                                    @else

                                                        <form action="{{ route('login') }}" method="post">

                                                            {!! csrf_field() !!}

                                                            <div class="col-xs-12 mb-20">

                                                                <div class="sidebar-title">

                                                                    <h3>Need Log In</h3>

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

                                                            <div class="col-sm-12">

                                                                <div class="form-group">

                                                                    <label class="form-label">E-mail Address</label>

                                                                    <input id="login-email" name="email" type="email" value="{{ old('email') }}" required placeholder="Email Address">

                                                                </div>

                                                            </div>

                                                            <div class="col-xs-12">

                                                                <div class="form-group">

                                                                    <label class="form-label">Password</label>

                                                                    <input id="login-pass" name="password" type="password" required placeholder="Enter your Password">

                                                                </div>

                                                            </div>

                                                            <div class="col-xs-6 mb-30">

                                                                <button class="btn-color btn-block" type="submit">Log In</button>

                                                            </div>

                                                            <div class="col-xs-6 mb-30">

                                                                <button class="btn-danger btn-block" style="border: none" type="reset">Reset</button>

                                                            </div>

                                                            <div class="col-xs-12">

                                                                <div class="new-account align-center mt-20"> <span>Need new  Account ?</span> <a class="link" title="Register" href="{{ route('register') }}">Create New Account</a> </div>

                                                            </div>

                                                        </form>

                                                    @endif



                                                </div>

                                            </div>

                                        </div>

                                    </li>

                                    <li>

                                        <div class="items-Comments gray-bg">

                                            <div class="comments-area">

                                                <h4>Comments <span>({{ count($productComment) }})</span></h4>

                                                <ul class="comment-list mt-30">

                                                    @foreach($productComment as $rv)

                                                        <li>

                                                            <div class="comment-user">

                                                                <img class="img-circle" width="80%" src="{{ asset('assets/images/user') }}/{{ $rv->user->image }}" alt="{{ $rv->user->name }}"> </div>

                                                            <div class="comment-detail">

                                                                <div class="user-name">{{ $rv->user->first_name }} {{ $rv->user->last_name }}</div>

                                                                <div class="post-info">

                                                                    <ul>

                                                                        <li>{{ \Carbon\Carbon::parse($rv->created_at)->format('M d, Y - h:i:s A')  }}</li>

                                                                    </ul>

                                                                </div>

                                                                <p>{{ $rv->comment }}</p>

                                                            </div>

                                                        </li>

                                                    @endforeach



                                                </ul>

                                            </div>

                                            <div class="main-form mt-30">

                                                <h4>Leave a comments</h4>

                                                <div class="row mt-30">

                                                    @if(Auth::check())



                                                        <form action="{{ route('comment-submit') }}" method="post">

                                                            {!! csrf_field() !!}

                                                            <input type="hidden" name="product_id" value="{{ $product->id }}">

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

                                                                <div class="form-group">

                                                                    <label class="form-label">Comment</label>

                                                                    <textarea cols="30" rows="3" name="comment" placeholder="Comment" required></textarea>

                                                                </div>

                                                            </div>

                                                            <div class="col-xs-6 mb-30">

                                                                <button class="btn-color btn-block" type="submit">Submit</button>

                                                            </div>

                                                            <div class="col-xs-6 mb-30">

                                                                <button class="btn-danger btn-block" style="border: none" type="reset">Reset</button>

                                                            </div>

                                                        </form>

                                                    @else

                                                        <form action="{{ route('login') }}" method="post">

                                                            {!! csrf_field() !!}

                                                            <div class="col-xs-12 mb-20">

                                                                <div class="sidebar-title">

                                                                    <h3>Need Log In</h3>

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

                                                            <div class="col-sm-12">

                                                                <div class="form-group">

                                                                    <label class="form-label">E-mail Address</label>

                                                                    <input id="login-email" name="email" type="email" value="{{ old('email') }}" required placeholder="Email Address">

                                                                </div>

                                                            </div>

                                                            <div class="col-xs-12">

                                                                <div class="form-group">

                                                                    <label class="form-label">Password</label>

                                                                    <input id="login-pass" name="password" type="password" required placeholder="Enter your Password">

                                                                </div>

                                                            </div>

                                                            <div class="col-xs-6 mb-30">

                                                                <button class="btn-color btn-block" type="submit">Log In</button>

                                                            </div>

                                                            <div class="col-xs-6 mb-30">

                                                                <button class="btn-danger btn-block" style="border: none" type="reset">Reset</button>

                                                            </div>

                                                            <div class="col-xs-12">

                                                                <div class="new-account align-center mt-20"> <span>Need new  Account ?</span> <a class="link" title="Register" href="{{ route('register') }}">Create New Account</a> </div>

                                                            </div>

                                                        </form>

                                                    @endif

                                                </div>

                                            </div>

                                        </div>

                                    </li>



                                </ul>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    @if($ad4 != null)

        <div class="mb-20 visible-sm visible-md visible-lg hidden-xs">

            @if($ad4->advert_type == 1)

                <a href="{{ $ad4->link }}" target="_blank"><img class="center-block" src="{{ asset('assets/images/advertise') }}/{{ $ad4->val1 }}" alt="{{ $ad4->title }}"></a>

            @else

                {!! $ad4->val2 !!}

            @endif

        </div>

    @endif

    <section class="pb-95">

        <div class="container">

            <div class="product-slider">

                <div class="row">

                    <div class="col-xs-12">

                        <div class="heading-part mb-20">

                            <h2 class="main_title">Related Products</h2>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="product-slider-main position-r"><!-- dresses -->

                        <div class="owl-carousel pro_rel_slider"><!-- id="product-slider" -->

                            @foreach($relatedProduct as $rp)

                            <div class="item">

                                <div class="product-item">

                                    @if($rp->mood_id == 0)

                                        <div class="sale-label sell-label"><span>Sale</span></div>

                                    @elseif($rp->mood_id == 1)

                                        <div class="sale-label green-label"><span>New</span></div>

                                    @elseif($rp->mood_id == 2)

                                        <div class="sale-label red-label"><span>Hot</span></div>

                                    @endif

                                    <div class="product-image"> <a href="{{ route('product-details',$rp->slug) }}"> <img src="{{ asset('assets/images/product') }}/{{ $rp->image }}" alt="{{ $rp->name }}"> </a>

                                        <div class="product-detail-inner">

                                            <div class="detail-inner-left left-side">

                                                <ul>

                                                    <li class="pro-cart-icon">

                                                        <button title="Add to Cart" class="SingleCartAdd" data-id="{{ $rp->id }}"><i class="fa fa-cart"></i></button>

                                                    </li>

                                                    <li class="pro-wishlist-icon"><a class="SingleWishList" data-id="{{ $rp->id }}" title="Wishlist"></a></li>

                                                    <li class="pro-compare-icon"><a id="compareId" data-id="{{ $rp->id  }}" title="Compare"></a></li>

                                                </ul>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="product-item-details">

                                        <div class="product-item-name"> <a href="{{ route('product-details',$rp->slug) }}">{{ substr($rp->name,0,65) }}</a> </div>

                                        <div class="price-box">

                                            <span class="price">{{$basic->symbol}}{{ $rp->current_price }}</span> @if($product->old_price != null)<del class="price old-price bold">{{ $basic->symbol }}{{ $rp->old_price }}</del>@endif

                                            <div class="rating-summary-block right-side">

                                                <div title="53%" class="rating-result"> <span style="width:53%"></span> </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            @endforeach

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- CONTAINER END -->



    <div id="email_friends_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                    <h3 class="modal-title ">Email to Friend</h3>

                </div>

                <div class="modal-body">

                    @if($errors->any())

                        @foreach ($errors->all() as $error)

                            <div class="alert alert-danger alert-dismissable">

                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                                {!!  $error !!}

                            </div>

                        @endforeach

                    @endif

                    <form action="{{ route('submit-friend-email') }}" method="post" role="form" >

                        {!! csrf_field() !!}

                        <div class="form-group">

                            <input class="form-control" name="name" placeholder="Your Name" type="text" data-error="Please enter name field." required>

                        </div>

                        <div class="form-group">

                            <input class="form-control" name="ownEmail" placeholder="Your Email Address" type="email" required>

                        </div>

                        <div class="form-group">

                            <input class="form-control" name="friendEmail" placeholder="Friend Email Address" type="email" required>

                        </div>

                        <input type="hidden" name="url" value="{{ url()->current() }}">

                        <div class="form-group">

                            <input value="Submit" class="btn btn-block btn-primary btn-color" type="submit">

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

    <meta name="_token" content="{!! csrf_token() !!}" />

@endsection

@section('scripts')



    <script>

        $(document).ready(function () {

            $(document).on("click", '#compareId', function (e) {

                var id = $(this).data('id');

                var url = '{{ url('/') }}';



                $.get(url + '/compare-add/' + id,function (data) {



                    var result = $.parseJSON(data);



                    if (result['errorStatus'] == "yes"){

                        toastr.warning(result['errorDetails']);

                    }else{

                        toastr.success(result['errorDetails']);

                    }

                });

            });

        });

    </script>



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

    <script>



        var url = '{{ url('/add-to-cart') }}';



        $(".addCart").click(function (e) {

            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')

                }

            });

            e.preventDefault();

            var formData = {

                product_id: $('#product_id').val(),

                qty: $('#qty').val(),

                size : $('#size').val(),

                color : $('#color').val()

            };

            var type = "POST";

            var my_url = url;

            console.log(formData);

            $.ajax({

                type: type,

                url: my_url,

                data: formData,

                success: function (data) {

                    var result = $.parseJSON(data);

                    if (result['cartError'] == "yes"){

                        toastr.warning(result['cartErrorMessage']);

                    }else{

                        toastr.success('Product Added To Cart.');

                        $('#cartShow').empty();

                        $('#cartShow').append(result['cartShowFinal']);

                    }

                },

                error: function(data)

                {

                    $.each( data.responseJSON.errors, function( key, value ) {

                        toastr.error( value);

                    });

                }

            });

        });





    </script>



@endsection