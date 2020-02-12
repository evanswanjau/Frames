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
    {{--  CDN Added by Evans Wanjau https://evanswanjau.me  --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</head>
<body>
    {{-- Evans Wanjau Updates on picture upload --}}
    <div class="container-fluid uploadImage py-5">
        <img  class="close-me" style="width:35px;" src="{{ asset('assets/images/close.png') }}" alt="">
        <div class="row">
            <div class="col-sm-10 py-5 m-5 mx-auto text-center">
                @if (Session::has('uploadImage'))
                    @if ($message = Session::get('success'))
                        <script>$(document).ready(function(){$('.uploadImage').show();});</script>
                        <p style="border-width:3px!important;" class="w-25 p-3 border-left border-success mx-auto shadow rounded">Image Upload Successful</p><br>
                    @endif
                    @php
                        $imageName = Session::get('uploadImage')['imageName'];
                    @endphp

                    @if (Session::get('uploadImage')['type'] == 'frame')

                        <img id="our_image" class="image-holder image-prev" src='{{ asset("assets/images/custom-images/$imageName") }}' alt="">
                        <br><br>
                        <h3>PRICE: KSH <span id="price">100</span> (10 KSH per INCH)</h3>
                        <br><br>
                        <form action="{{ route('image.cart') }}" class="mx-auto" name="imageForm" method="post">
                            {{ csrf_field() }}  
                            <table class="w-50 mx-auto">
                                <tr>
                                    <th>Background Size</th>
                                    <th>Backgound Color</th>
                                    <th>Length</th>
                                    <th>Width</th>
                                </tr>
                                <tr>
                                    <td class="p-5"><input type="range" id="bg_size" name="bg_size" min="10" max="50" onclick="return image_bg_size();"></td>
                                    <td class="p-5"><ul class="row"><li style="background-color:#fff;cursor:pointer;" class="border rounded p-3 col-sm-6" onclick="return image_background('white')"></li><li style="background-color:#000;cursor:pointer;" class="border rounded p-3 col-sm-6" onclick="return image_background('black')"></li></ul></td>
                                    <td class="p-5">
                                    <script>
                                        selectHandler = {
                                            clickCount : 0,
                                            action : function(select)
                                            {
                                                selectHandler.clickCount++;
                                                if(selectHandler.clickCount%2 == 0)
                                                {
                                                    selectedValue = select.options[select.selectedIndex].value;
                                                    selectHandler.check(selectedValue);
                                                }
                                            },
                                            blur : function() // needed for proper behaviour
                                            {
                                                if(selectHandler.clickCount%2 != 0)
                                                {
                                                    selectHandler.clickCount--;
                                                }
                                            },
                                            check : function(value)
                                            {
                                                setCookie('length', value, 1);
                                                document.getElementById('price').innerHTML = calculate_amount();
                                            }
                                        }
                                    
                                    </script>
                                    <select name="length"  onclick="selectHandler.action(this)" onblur="selectHandler.blur()">
                                        @for ($i = 10; $i < 81; $i++)                                    
                                            <option id="length" value="{{ $i }}">{{ $i }} inch</option>
                                        @endfor
                                    </select>
                                    </td>
                                    <td class="p-5">
                                        <script>
                                            selectHandler2 = {
                                                clickCount : 0,
                                                action : function(select)
                                                {
                                                    selectHandler2.clickCount++;
                                                    if(selectHandler2.clickCount%2 == 0)
                                                    {
                                                        selectedValue = select.options[select.selectedIndex].value;
                                                        selectHandler2.check(selectedValue);
                                                    }
                                                },
                                                blur : function() // needed for proper behaviour
                                                {
                                                    if(selectHandler2.clickCount%2 != 0)
                                                    {
                                                        selectHandler2.clickCount--;
                                                    }
                                                },
                                                check : function(value)
                                                {
                                                    // you can customize this
                                                    setCookie('width', value, 1);
                                                    document.getElementById('price').innerHTML = calculate_amount();
                                                }
                                            }
                                        
                                        </script>
                                        <select name="width" onclick="selectHandler2.action(this)" onblur="selectHandler2.blur()">
                                            @for ($i = 10; $i < 81; $i++)                                    
                                                <option value="{{ $i }}" onclick="return get_width({{ $i }});">{{ $i }} inch</option>
                                            @endfor
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <input type="hidden" name="bg-color" id="bg_colorr" value="white">
                            <button class="sub-button" name="submitframe" id="submitImage">submit</button>&nbsp;&nbsp;<button name="cancelImage" class="sub-button" id="cancelImage">cancel upload</button>
                        </form>
                        
                    @else
                        <h3>Choose Custom Mount</h3><br>
                        <form action="{{ route('image.cart') }}" class="row mount-upload" method="post">
                            {{ csrf_field() }}  
                            <div class="col-sm-4">
                                <button name="mount-type" value="laminated" class="mount-button" style="background:url('{{ asset('assets/images/custom-images/frames/laminated.jpg') }}'), linear-gradient(to top,red,blue); background-size:cover;"></button><br>
                                <H1>LAMINATED</H1>
                            </div>
                            <div class="col-sm-4">
                                <button name="mount-type" value="sublimated" class="mount-button" style="background:url('{{ asset('assets/images/custom-images/frames/sublimated.jpg') }}'); background-size:cover;"></button><br>
                                <H1>SUBLIMATED</H1>
                            </div>
                            <div class="col-sm-4">
                                <button name="mount-type" value="canvas" class="mount-button" style="background:url('{{ asset('assets/images/custom-images/frames/canvas.jpg') }}'); background-size:cover;"></button><br>
                                <H1>CANVAS</H1>
                            </div>
                            <p class="w-100"></p>
                            <br><button name="cancel-image" class="sub-button mx-auto w-50 my-5">cancel upload</button>
                        </form>
                        
                    @endif
                    
                @else
                    @if (count($errors) > 0)
                    <script>$(document).ready(function(){$('.uploadImage').show();});</script>
                        @foreach ($errors->all() as $error)
                        <p style="border-width:3px!important;" class="w-25 p-3 border-left border-danger mx-auto shadow rounded">{{ $error }}</p><br>
                        @endforeach
                    @endif

                    {{--  image upload form  --}}
                    <h3>Quality custom framing</h3><br>
                    <div class="row">
                        <div class="col-sm-6 text-right">
                            <img class="image-holder" src='{{ asset("assets/images/custom_frame.jpg") }}' alt="">
                        </div>
                        <div class="col-sm-6 text-left">
                            <img class="image-holder" src='{{ asset("assets/images/custom_canvas.jpg") }}' alt="">
                        </div>
                    </div>
                    <form action="{{ route('image.upload.post') }}" method="post" enctype="multipart/form-data">    
                        {{ csrf_field() }}     
                        <input type="file" name="image" id="file" class="inputfile" />
                        <label for="file"><img src="{{ asset('assets/images/upload.png') }}"/>&nbsp;&nbsp;&nbsp;Upload Image</label><br>
                        {{-- btn btn-primary py-3 px-5 --}}
                        <button class="sub-button" name="type" value="frame" type="submit">Custom Frame</button>
                        <button class="sub-button" name="type" value="mount" type="submit">Custom Mount</button>
                    </form>
                @endif
             
            </div>

        </div>
    </div>
<div class="se-pre-con"></div>


<div class="main">
    {{--  header start by https://evanswanjau.me/  --}}
    <div class="container top-menu">
        <div class="row">
            <div class="col-sm-6">
                <a class="navbar-brand page-scroll" href="{{ route('home') }}"> <img alt="{{ $basic->title }}" src="{{ asset('assets/images/logo.png') }}"> </a>
            </div>
            <div class="col-sm-6 text-right">
                <ul class="list-menu">
                    <li>
                        <form action="{{ route('search-product') }}" method="get" >
                            <div class="search-box">
                                <input class="input-text p-2" type="text" name="name" placeholder="Search entire store here...">
                                <button class="search-btn"></button>
                            </div>
                        </form>
                    </li>
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
                                &nbsp;Hi.{{ Auth::user()->first_name }}
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
    <div class="container">
            <div class="header-bottom">
                <div class="">
                    <div id="menu" class="">
                        <ul class="">
                            <li class="rounded-left"><a href="{{ route('home') }}">Home</li>
                            <li class="show-imageupload"><a href="#">Custom Frame</a></li>
                            <li><a href="#">Corporate Gifts</a></li>
                            <li><a href="#">Register as a business</a></li>
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
                    <div class="right-side float-left-xs header-right-link" style="margin-top:-5.3%!important">
                        <ul id="cartShow">
                            <li class="cart-icon">
                                <a href="#">
                                    <span> <small class="cart-notification">{{ Cart::count() }}</small> </span>
                                    <div class="cart-text hidden-sm hidden-xs">My Cart</div>
                                </a>
                                <div class="cart-dropdown header-link-dropdown">
                                    <ul class="cart-list link-dropdown-list">
                                        @if (Session::has('uploadImage')['ImageName'])
                                        <li>
                                            <p>testerasdasd</p>
                                        </li>
                                        @endif                                        
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

    <!-- HEADER END -->

    @yield('content')

    <!-- FOOTER START -->
    <div class="footer">
        <div class="container">
            <div class="footer-inner">
                <div class="footer-middle">
                    <div class="row">
                        <div class="col-md-3 f-col">
                            <div class="footer-static-block"> <span class="opener plus"></span>
                                <h3 style="color:#fff;">Quick Links</h3>
                                <ul class="link">
                                    <li><a href="#">Frames</a></li>
                                    <li class="show-imageupload"><a href="#">Upload a picture</a></li>
                                    <li><a href="#">Corporate Gifts</a></li>
                                    <li><a href="#">Register as a business</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3 f-col">
                            <div class="footer-static-block"> <span class="opener plus"></span>
                                <h3 style="color:#fff;">LEGAL</h3>
                                <ul class=" link">
                                    <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                                    <li><a href="{{ route('terms-conditions') }}">Terms & Conditions</a></li>
                                    <li><a href="{{ route('return-policy') }}">Return and refund policy</a></li>
                                    <li><a href="{{ route('shipping-policy') }}">Shipping Policy</a></li>
                                    <li><a href="{{ route('disclaimer') }}">Disclaimer</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3 f-col">
                            <div class="footer-static-block"> <span class="opener plus"></span>
                                <h3 style="color:#fff;">LOCATION</h3>
                                <ul class=" link">
                                    <li><i class="fa fa-home"></i>&nbsp;JIO3 Namanga Rd</li>
                                    <li><i class="fa fa-envelope"></i>&nbsp;P.O BOX 14710 - 00100</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3 f-col">
                            <div class="footer-static-block"> <span class="opener plus"></span>
                                <h3 style="color:#fff;">Legal</h3>
                                <ul class="link">
                                    <li><i class="fa fa-envelope"></i>&nbsp;<a href="mailto:{{ $basic->email }}" target="_blank">{{ $basic->email }}</a></li>
                                    <li><i class="fa fa-phone"></i>&nbsp;<a href="tel:+254 020 2241 655" target="_blank">+254 020 2241 655</a></li>
                                    <li><i class="fa fa-phone"></i>&nbsp;<a href="tel:+254 720 120 573" target="_blank">+254 720 120 573</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="copy-right center-sm pb-5">2019 © All Copyright Reserved By FRAMES AFRICA LTD.</div>
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

        // upload new image
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
    // on image upload 
    $(document).on("click", '#submitImage', function (e) {
        $.post(
            '{{ url('/image-to-cart') }}',
            {
                _token: '{{ csrf_token() }}',
            },
            function(data) {
                toastr.success('Image Added To Cart.');
            }
        );
    });

    $(document).on("click", '#cancelImage', function (e) {
        $.post(
            '{{ url('/image-to-cart') }}',
            {
                _token: '{{ csrf_token() }}',
            },
            function(data) {
                toastr.error('Image has been removed.');
            }
        );
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

<script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>


