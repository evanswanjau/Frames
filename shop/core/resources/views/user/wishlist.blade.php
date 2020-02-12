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

                    <div class="checkout-content">
                        <div id="cartFullView" class="row">
                            <div class="col-xs-12 mb-xs-30">
                                <div class="sidebar-title">
                                    <h3>Wishlist Products</h3>
                                </div>
                                <div class="cart-item-table commun-table">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Product Image</th>
                                                <th>Product Name</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Add Cart</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            @foreach($wishlist as $con)
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('product-details',$con->product->slug) }}">
                                                            <div class="product-image"><img alt="{{ $con->product->name }}" src="{{ asset('assets/images/product') }}/{{$con->product->image}}"></div>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <div class="product-title">
                                                            <a href="{{ route('product-details',$con->product->slug) }}">{{ $con->product->name }}</a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <div class="base-price price-box"> <span class="price">{{$basic->symbol}}{{ $con->product->current_price }}</span> </div>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <div class="input-box">
                                                            <div class="custom-qty">
                                                                <button onclick="var result = document.getElementById('qty{{$con->id}}'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) result.value--;return false;" class="reduced items" type="button"> <i class="fa fa-minus"></i> </button>
                                                                <input type="text" class="input-text qty" readonly title="Qty" value="1" maxlength="{{ $con->product->stock }}" id="qty{{$con->id}}" name="qty">
                                                                <button onclick="var result = document.getElementById('qty{{$con->id}}'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="increase items" type="button"> <i class="fa fa-plus"></i> </button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button data-id="{{ $con->product_id }}" id="wish{{ $con->id }}" class="btn btn-color"><i class="fa fa-cart-plus"></i> Add Cart</button>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger delete_button"
                                                                data-toggle="modal" data-target="#DelModal"
                                                                data-id="{{ $con->id }}">
                                                            <i class='fa fa-trash'></i>Delete
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12">
                                <div><a href="{{ route('home') }}" class="btn btn-block btn-color"><span><i class="fa fa-angle-left"></i></span>Back To Home</a> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- CONTAINER END -->

    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-exclamation-triangle'></i> <strong>Confirmation !</strong></h4>
                </div>

                <div class="modal-body">
                    <strong>Are you sure you want to Delete ?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('wishlist-delete') }}" class="form-inline">
                        {!! csrf_field() !!}
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="id" class="delete_id" value="0">

                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> DELETE</button>
                    </form>
                </div>

            </div>
        </div>
    </div>


@endsection
@section('scripts')

    <script>
        $(document).ready(function () {

            $(document).on("click", '.delete_button', function (e) {
                var id = $(this).data('id');
                $(".delete_id").val(id);
            });
        });
    </script>

    @foreach($wishlist as $con)

        <script>
            var url = '{{ url('/') }}';
            $(document).ready(function () {
                $(document).on("click", '#wish{{$con->id}}', function (e) {

                    $.post(
                        '{{ url('/wishlist-to-cart') }}',
                        {
                            _token: '{{ csrf_token() }}',
                            id : $(this).data('id'),
                            qty : $('#qty{{ $con->id }}').val()
                        },
                        function(data) {
                            var result = $.parseJSON(data);
                            if (result['cartError'] == "yes"){
                                toastr.warning(result['cartErrorMessage']);
                            }else{
                                toastr.success('Cart Updated Successfully.');
                                $('#cartShow').empty();
                                $('#cartShow').append(result['cartShowFinal']);
                                $('#cartFullView').empty();
                                var div = document.getElementById('cartFullView');
                                div.innerHTML = result['all'];
                            }
                        }
                    );
                });
            });
        </script>

    @endforeach

@endsection