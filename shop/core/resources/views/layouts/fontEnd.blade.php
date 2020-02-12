<!DOCTYPE html>
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    @if($meta_status == 1 )
        <meta name="keywords" content="{{ $basic->meta_tag }}">
        <meta name="description" content="{{ $basic->title }}">
        <meta property="og:title" content="{{ $basic->title }}" />
        <meta property="og:url" content="{{ url('/') }}" />
        <meta property="og:image" content="{{ asset('assets/images/logo.png') }}" />
    @else
        @yield('meta')
    @endif
    <title>{{ $site_title }} | {{ $page_title }}</title>

    <!-- Mobile Specific Metas
      ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSS
      ================================================== -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery-ui.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fotorama.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/color.php') }}?color={{ $basic->color }}">
    @yield('style')
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">
</head>
<body>
<div class="se-pre-con"></div>

<div class="main">
    <!-- HEADER START -->
    <header class="navbar navbar-custom" id="header">
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6 p-0">
                        <div class="footer_social pt-xs-15 center-xs mt-xs-15">
                            <ul class="social-icon">
                                @foreach($socials as $sc)
                                <li><a href="{{ $sc->link }}" class="facebook">{!! $sc->code !!}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="top-link right-side">
                            <ul>
                                <li>
                                    <a href="{{ route('compare') }}" title="Compare">
                                        <i class="fa fa-exchange hidden-sm hidden-lg" aria-hidden="true"></i>
                                        <span class="hidden-xs">Compare</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('wishlist') }}" title="Wishlish">
                                        <i class="fa fa-heart hidden-sm hidden-lg" aria-hidden="true"></i>
                                        <span class="hidden-xs">Wishlist</span>
                                    </a>
                                </li>

                                @if(Auth::check())
                                    <li>
                                        <div class="btn-group show-on-hover">
                                        <span class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="padding: 1px 10px">
                                            &nbsp;Hi.{{ Auth::user()->first_name }} <span class="caret"></span>
                                        </span>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="{{ route('user-dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                                                <li><a href="{{ route('user-all-order') }}"><i class="fa fa-shopping-cart"></i> All Order</a></li>
                                                <li><a href="{{ route('user-edit-profile') }}"><i class="fa fa-edit"></i> Edit Profile</a></li>
                                                <li><a href="{{ route('user-change-password') }}"><i class="fa fa-send"></i> Update Password</a></li>
                                                <li class="divider"></li>
                                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> Logout</a></li>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                </form>
                                            </ul>
                                        </div>
                                    </li>
                                @else
                                <li>
                                    <a href="{{ route('login') }}" title="Login">
                                        <i class="fa fa-lock hidden-sm hidden-lg" aria-hidden="true"></i>
                                        <span class="hidden-xs">Login</span>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle">
            <div class="container">
                <hr>
                <div class="header-inner">
                    <div class="row">
                        <div class="col-md-7 col-sm-6 col-xs-6">
                            <div class="navbar-header">
                                <a class="navbar-brand page-scroll" href="{{ route('home') }}"> <img alt="{{ $basic->title }}" src="{{ asset('assets/images/logo.png') }}"> </a>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-6 col-xs-6">
                            <div class="right-side">
                                <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button"><i class="fa fa-bars"></i></button>
                                <div class="right-side float-left-xs header-right-link">
                                    <div class="main-search">
                                        <div class="header_search_toggle desktop-view">
                                            <form action="{{ route('search-product') }}" method="get" >
                                                <div class="search-box">
                                                    <input class="input-text" type="text" name="name" placeholder="Search entire store here...">
                                                    <button class="search-btn"></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="header_search_toggle mobile-view">

                                <form action="{{ route('search-product') }}" method="get" >
                                    <div class="search-box">
                                        <input class="input-text" name="name" type="text" placeholder="Search entire store here...">
                                        <button class="search-btn"></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="header-bottom">
                <div class="">
                    <div id="menu" class="navbar-collapse collapse left-side p-0">
                        <ul class="nav navbar-nav navbar-left">
                            <li class="level"><a href="{{ route('home') }}" class="page-scroll">Home</a></li>
                            @foreach($menubarCat as $mcat)
                            <li class="level">
                                <span class="opener plus"></span>
                                <a href="{{ route('category',['id'=>$mcat->id,'slug'=>str_slug($mcat->name)]) }}" class="page-scroll">{{ $mcat->name }}</a>
                                <div class="megamenu full mobile-sub-menu">
                                    <div class="megamenu-inner">
                                        <div class="megamenu-inner-top">
                                            <div class="row">
                                                @php $mSubCat = \App\Subcategory::whereCategory_id($mcat->id)->get() @endphp
                                                @foreach($mSubCat->chunk(4) as $chunkSubcat)
                                                    @foreach($chunkSubcat as $cc)
                                                        <div class="col-md-3 level2">
                                                            <a href="{{ route('subcategory',['id'=>$cc->id,'slug'=>str_slug($cc->name)]) }}"><span>{{ $cc->name }}</span></a>
                                                            <ul class="sub-menu-level2 ">
                                                                @php $menuChildCat = \App\ChildCategory::wheresubcategory_id($cc->id)->get() @endphp
                                                                @foreach($menuChildCat as $mChildCat)
                                                                    <li class="level3"><a href="{{ route('childcategory',['id'=>$mChildCat->id,'slug'=>str_slug($mChildCat->name)]) }}">{{ $mChildCat->name }}</a></li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endforeach
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                            <li class="level"><a href="{{ route('contact-us') }}" class="page-scroll">Contact Us</a></li>
                        </ul>
                        <div class="header_search_toggle mobile-view">
                            <form>
                                <div class="search-box">
                                    <input class="input-text" type="text" placeholder="Search entire store here...">
                                    <button class="search-btn"></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="right-side float-left-xs header-right-link">
                        <ul id="cartShow">
                            <li class="cart-icon">
                                <a href="#">
                                    <span> <small class="cart-notification">{{ Cart::count() }}</small> </span>
                                    <div class="cart-text hidden-sm hidden-xs">My Cart</div>
                                </a>
                                <div class="cart-dropdown header-link-dropdown">
                                    <ul class="cart-list link-dropdown-list">
                                        @foreach(Cart::content() as $cont)
                                        <li>
                                            <a data-id="{{ $cont->rowId }}" class="close-cart delete_cart"><i class="fa fa-times-circle"></i></a>
                                            <div class="media">
                                                <a class="pull-left"> <img alt="{{ $cont->name }}" src="{{ asset('assets/images/product') }}/{{ $cont->options->image }}"></a>
                                                <div class="media-body"> <span><a>{{ substr($cont->name,0,25) }}..</a></span>
                                                    <p class="cart-price">{{ $basic->symbol }}{{ $cont->price }} x {{ $cont->qty }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <p class="cart-sub-totle"> <span class="pull-left">Cart Subtotal</span> <span class="pull-right"><strong class="price-box">{{ $basic->symbol }}{{ Cart::subtotal() }}</strong></span> </p>
                                    <div class="clearfix"></div>
                                    <div class="mt-20"> <a href="{{ route('cart') }}" class="btn-color btn">Cart</a> <a href="{{ route('check-out') }}" class="btn-color btn right-side">Checkout</a> </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="menu-shadow-btm"><img src="{{ asset('assets/images/menu-shadow.png') }}" alt="MarketShop"></div>
            </div>
        </div>
    </header>
    <!-- HEADER END -->

    @yield('content')


<!-- Brand logo block Start  -->
    <section class="dark-bg">
        <div class="container">
            <div class="row brand ptb-50">
                <div class="col-md-12">
                    <div id="brand-logo" class="owl-carousel align_center">
                        @foreach($partners as $p)
                            <div class=""><a href="{{ route('partner-product',$p->id) }}"><img src="{{ asset('assets/images/partner') }}/{{ $p->image }}" alt="{{ $p->name }}"/></a></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="row half-row">
            <div class="col-sm-6 half-div color">
                <div class="half-inner">

                    <h3 class="bold uppercase extra-heading">Accepted Payment Method</h3>
                    <p>We Accept Most World Class Payment Method.</p>
                    <div class="partners-carousel alt">
                        <div class="owl-carousel" id="partners-alt">
                            @foreach($paymentImage as $pt)
                                <div><a><img src="{{ asset('assets/images/payment') }}/{{ $pt->image }}" alt="{{ $pt->name }}" width="90%"></a></div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div><!-- /.half-div -->

            <div class="col-sm-6 half-div image" style="background-image: url('{{ asset('assets/images') }}/{{ $basic->subscribe_bg }}')">
                <div class="half-inner">
                    <div class="form-subscribe-wrapper alt">
                        <h3 style="color: #fff;font-weight: bold;font-size: 22px;margin-bottom: 0px">SUBSCRIBE TO ANY UPDATE</h3>
                        <p>Subscribe to our latest Updates directly in your inbox.</p>
                        @if($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {!!  $error !!}
                                </div>
                            @endforeach
                        @endif
                    <!-- Subscribe form -->
                        <form action="{{ route('submit-subscribe') }}" method="post" class="form-subscribe alt" id="form-subscribe">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="formSubscribeEmail" class="sr-only">Enter your email address</label>
                                <input type="email"  class="form-control" name="email" id="formSubscribeEmail"
                                       placeholder="Enter your email here" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                            </div>
                            <button type="submit" class="btn btn-submit">Subscribe Today</button>
                        </form>
                        <!-- Subscribe form -->

                        <p class="form-subscribe-text-sm">* We don’t share any of your information to others</p>

                    </div>

                </div>
            </div><!-- /.half-div -->

        </div>

    </section>
    <!-- Brand logo block End  -->

    <!-- FOOTER START -->
    <div class="footer">
        <div class="container">
            <div class="footer-inner">
                <div class="footer-middle">
                    <div class="row">
                        <div class="col-md-4 f-col">
                            <div class="footer-static-block"> <span class="opener plus"></span>
                                <div class="f-logo"> <a href="{{ route('home') }}" class=""> <img src="{{ asset('assets/images/footer-logo.png') }}" alt="MarketShop"> </a>
                                </div>
                                <div class="footer-block-contant">
                                    <p>{!! $basic->footer_text !!}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-8 f-col">
                                    <div class="footer-static-block">
                                        <h3 class="title">Categories</h3>
                                        <div class="footer_nav">
                                            <ul>
                                                @foreach($footerCat as $fcat)
                                                <li><a href="{{ route('category',['id'=>$fcat,'slug'=>str_slug($fcat->name)]) }}">{{ $fcat->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 f-col">
                                    <div class="footer-static-block"> <span class="opener plus"></span>
                                        <h3 class="title">Contact With Us</h3>
                                        <ul class="footer-block-contant address-footer">
                                            <li class="item"> <i class="fa fa-home"> </i>
                                                <p>{{ $basic->address }}</p>
                                            </li>
                                            <li class="item"> <i class="fa fa-envelope"> </i>
                                                <p> <a>{{ $basic->email }} </a> </p>
                                            </li>
                                            <li class="item"> <i class="fa fa-phone"> </i>
                                                <p>{{ $basic->phone }}</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="copy-right center-sm">{!! $basic->copy_text !!}</div>
                        </div>
                        <div class="col-sm-8 p-0">
                            <div class="payment float-none-xs center-sm">
                                <ul class="footer-block-contant link">
                                    <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                                    <li><a href="{{ route('terms-condition') }}">Terms & Condition</a></li>
                                    <li><a href="{{ route('about-us') }}">AboutUs</a></li>
                                    <li><a href="{{ route('contact-us') }}">ContactUs</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="scroll-top">
        <div id="scrollup"></div>
    </div>
    <!-- FOOTER END -->
</div>
<script src="{{ asset('assets/js/jquery-1.12.3.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/js/fotorama.js') }}"></script>
<script src="{{ asset('assets/js/jquery.magnific-popup.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/admin/js/toastr.js') }}"></script>
@yield('scripts')
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

    $(document).ready(function () {
        $(document).on("click", '.delete_cart', function (e) {
            var rowId = $(this).data('id');
            $.post(
                    '{{ url('/delete-cart-item') }}',
                    {
                        _token: '{{ csrf_token() }}',
                        rowId : rowId
                    },
                    function(data) {
                        var result = $.parseJSON(data);
                        toastr.success('Product Deleted From Cart.');
                        $('#cartShow').empty();
                        $('#cartShow').append(result['cartShow']);
                        $('#cartFullView').empty();
                        var div = document.getElementById('cartFullView');
                        div.innerHTML = result['fullShow'];
                    }

            );
        });
        $(document).on("click", '.SingleCartAdd', function (e) {
            var id = $(this).data('id');
            $.post(
                '{{ url('/single-cart-add') }}',
                {
                    _token: '{{ csrf_token() }}',
                    id : id
                },
                function(data) {
                    toastr.success('Product Added To Cart.');
                    $('#cartShow').empty();
                    $('#cartShow').append(data);
                }
            );
        });
        $(document).on("click", '.SingleWishList', function (e) {
            var id = $(this).data('id');
            $.post(
                    '{{ url('/single-wishlist-add') }}',
                    {
                        _token: '{{ csrf_token() }}',
                        id : id
                    },
                    function(data) {
                        var result = $.parseJSON(data);
                        if (result['cartError'] == "yes"){
                            toastr.warning(result['cartErrorMessage']);
                        }else if(result['cartError'] == "exist"){
                            toastr.info(result['cartErrorMessage']);
                        }else {
                            toastr.success(result['cartErrorMessage']);
                        }
                    }
            );
        });
    });

</script>
<script>
    @if(Session::has('message'))
    var type = "{{ Session::get('type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;
        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;
        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    @endif
</script>
{!! $basic->google_analytic !!}
{!! $basic->chat !!}


</body>

</html>


