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
    <section class="ptb-50 ptb-xs-30">
        <div class="container">
            <div class="row testimonial">
                <div class="col-md-12">
                    @if($compare == null)
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="text-center" style="font-size: 24px;font-weight: bold;">No Product to Compare List..!</h2>
                        </div>
                    </div>
                    @else
                    <div class="cart-item-table commun-table mb-30">
                        <div class="table table-responsive text-center">
                            <table class="table-bordered">
                                @if($status == 1)
                                    <thead>
                                    <tr>
                                        <th>Description</th>
                                        @foreach($compare as $key => $c)
                                            <th>Product {{ ++$key }}</th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Image</td>
                                        <td>
                                            <a href="{{ route('product-details',$product1->slug) }}">
                                                <div class="product-image"><img alt="{{ $product1->name }}" src="{{ asset('assets/images/product') }}/{{$product1->image}}"></div>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Name</td>
                                        <td>
                                            <div class="product-title">
                                                <a href="{{ route('product-details',$product1->slug) }}">{{ $product1->name }}</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Price</td>
                                        <td>
                                            <div class="product-title">
                                                {{ $basic->symbol }}{{ $product1->current_price }}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Color</td>
                                        <td>
                                            @if($product1->color_status == 0)
                                                <strong>-</strong>
                                            @else
                                                @foreach($product1->colors as $c)
                                                    <span class="label label-primary">{{ $c->name }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Size</td>
                                        <td>
                                            @if($product1->size_status == 0)
                                                <strong>-</strong>
                                            @else
                                                @foreach($product1->sizes as $c)
                                                    <span class="label label-primary">{{ $c->name }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Cart</td>
                                        <td>
                                            <a data-id="{{ $product1->id }}" class="btn btn-primary btn-sm SingleCartAdd"><i class="fa fa-shopping-cart"></i> Add To Cart</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Action</td>
                                        <td>
                                            <a id="removeCompare" data-id="{{ $product1->id }}" class="btn btn-danger"><i class="fa fa-times"></i> Remove Compare</a>
                                        </td>
                                    </tr>
                                    </tbody>

                                @elseif($status == 2)
                                    <thead>
                                    <tr>
                                        <th>Description</th>
                                        @foreach($compare as $key => $c)
                                            <th>Product {{ ++$key }}</th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Image</td>
                                        <td>
                                            <a href="{{ route('product-details',$product1->slug) }}">
                                                <div class="product-image"><img alt="{{ $product1->name }}" src="{{ asset('assets/images/product') }}/{{$product1->image}}"></div>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('product-details',$product2->slug) }}">
                                                <div class="product-image"><img alt="{{ $product2->name }}" src="{{ asset('assets/images/product') }}/{{$product2->image}}"></div>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Name</td>
                                        <td>
                                            <div class="product-title">
                                                <a href="{{ route('product-details',$product1->slug) }}">{{ $product1->name }}</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="product-title">
                                                <a href="{{ route('product-details',$product2->slug) }}">{{ $product2->name }}</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Price</td>
                                        <td>
                                            <div class="product-title">
                                                {{ $basic->symbol }}{{ $product1->current_price }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="product-title">
                                                {{ $basic->symbol }}{{ $product2->current_price }}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Color</td>
                                        <td>
                                            @if($product1->color_status == 0)
                                                <strong>-</strong>
                                            @else
                                                @foreach($product1->colors as $c)
                                                    <span class="label label-primary">{{ $c->name }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if($product2->color_status == 0)
                                                <strong>-</strong>
                                            @else
                                                @foreach($product2->colors as $c)
                                                    <span class="label label-primary">{{ $c->name }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Size</td>
                                        <td>
                                            @if($product1->size_status == 0)
                                                <strong>-</strong>
                                            @else
                                                @foreach($product1->sizes as $c)
                                                    <span class="label label-primary">{{ $c->name }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if($product2->size_status == 0)
                                                <strong>-</strong>
                                            @else
                                                @foreach($product2->sizes as $c)
                                                    <span class="label label-primary">{{ $c->name }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Cart</td>
                                        <td>
                                            <a data-id="{{ $product1->id }}" class="btn btn-primary btn-sm SingleCartAdd"><i class="fa fa-shopping-cart"></i> Add To Cart</a>
                                        </td>
                                        <td>
                                            <a data-id="{{ $product2->id }}" class="btn btn-primary btn-sm SingleCartAdd"><i class="fa fa-shopping-cart"></i> Add To Cart</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Action</td>
                                        <td>
                                            <a id="removeCompare" data-id="{{ $product1->id }}" class="btn btn-danger"><i class="fa fa-times"></i> Remove Compare</a>
                                        </td>
                                        <td>
                                            <a id="removeCompare" data-id="{{ $product2->id }}" class="btn btn-danger"><i class="fa fa-times"></i> Remove Compare</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                @else
                                    <thead>
                                    <tr>
                                        <th>Description</th>
                                        @foreach($compare as $key => $c)
                                            <th>Product {{ ++$key }}</th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Image</td>
                                        <td>
                                            <a href="{{ route('product-details',$product1->slug) }}">
                                                <div class="product-image"><img alt="{{ $product1->name }}" src="{{ asset('assets/images/product') }}/{{$product1->image}}"></div>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('product-details',$product2->slug) }}">
                                                <div class="product-image"><img alt="{{ $product2->name }}" src="{{ asset('assets/images/product') }}/{{$product2->image}}"></div>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('product-details',$product3->slug) }}">
                                                <div class="product-image"><img alt="{{ $product3->name }}" src="{{ asset('assets/images/product') }}/{{$product3->image}}"></div>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Name</td>
                                        <td>
                                            <div class="product-title">
                                                <a href="{{ route('product-details',$product1->slug) }}">{{ $product1->name }}</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="product-title">
                                                <a href="{{ route('product-details',$product2->slug) }}">{{ $product2->name }}</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="product-title">
                                                <a href="{{ route('product-details',$product2->slug) }}">{{ $product3->name }}</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Price</td>
                                        <td>
                                            <div class="product-title">
                                                {{ $basic->symbol }}{{ $product1->current_price }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="product-title">
                                                {{ $basic->symbol }}{{ $product2->current_price }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="product-title">
                                                {{ $basic->symbol }}{{ $product3->current_price }}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Color</td>
                                        <td>
                                            @if($product1->color_status == 0)
                                                <strong>-</strong>
                                            @else
                                                @foreach($product1->colors as $c)
                                                    <span class="label label-primary">{{ $c->name }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if($product2->color_status == 0)
                                                <strong>-</strong>
                                            @else
                                                @foreach($product2->colors as $c)
                                                    <span class="label label-primary">{{ $c->name }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if($product3->color_status == 0)
                                                <strong>-</strong>
                                            @else
                                                @foreach($product3->colors as $c)
                                                    <span class="label label-primary">{{ $c->name }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Size</td>
                                        <td>
                                            @if($product1->size_status == 0)
                                                <strong>-</strong>
                                            @else
                                                @foreach($product1->sizes as $c)
                                                    <span class="label label-primary">{{ $c->name }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if($product2->size_status == 0)
                                                <strong>-</strong>
                                            @else
                                                @foreach($product2->sizes as $c)
                                                    <span class="label label-primary">{{ $c->name }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if($product3->size_status == 0)
                                                <strong>-</strong>
                                            @else
                                                @foreach($product3->sizes as $c)
                                                    <span class="label label-primary">{{ $c->name }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Cart</td>
                                        <td>
                                            <a data-id="{{ $product1->id }}" class="btn btn-primary btn-sm SingleCartAdd"><i class="fa fa-shopping-cart"></i> Add To Cart</a>
                                        </td>
                                        <td>
                                            <a data-id="{{ $product2->id }}" class="btn btn-primary btn-sm SingleCartAdd"><i class="fa fa-shopping-cart"></i> Add To Cart</a>
                                        </td>
                                        <td>
                                            <a data-id="{{ $product3->id }}" class="btn btn-primary btn-sm SingleCartAdd"><i class="fa fa-shopping-cart"></i> Add To Cart</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Action</td>
                                        <td>
                                            <a id="removeCompare" data-id="{{ $product1->id }}" class="btn btn-danger"><i class="fa fa-times"></i> Remove Compare</a>
                                        </td>
                                        <td>
                                            <a id="removeCompare" data-id="{{ $product2->id }}" class="btn btn-danger"><i class="fa fa-times"></i> Remove Compare</a>
                                        </td>
                                        <td>
                                            <a id="removeCompare" data-id="{{ $product3->id }}" class="btn btn-danger"><i class="fa fa-times"></i> Remove Compare</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                @endif

                            </table>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection
@section('scripts')

    <script>
        $(document).ready(function () {
            $(document).on("click", '#removeCompare', function (e) {
                var compareId = $(this).data('id');

                var url = '{{ url('/') }}';

                $.get(url + '/compare-remove/' + compareId,function (data) {

                    var result = $.parseJSON(data);

                    if (result['errorStatus'] == "yes"){
                        toastr.warning(result['errorDetails']);
                    }else{
                        toastr.success(result['errorDetails']);
                        window.location.href = '{{ url('/compare') }}';
                    }
                });
            });
        });
    </script>

@endsection
