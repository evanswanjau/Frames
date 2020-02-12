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
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                            <div class="sidebar-title">
                                <h3>User All Order</h3>
                            </div>
                            <div class="">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Created At</th>
                                            <th>Order Number</th>
                                            <th>Total Price</th>
                                            <th>Shipping Status</th>
                                            <th>Order Status</th>
                                            <th>Payment Method</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($order as $con)
                                            <tr>
                                                <td>
                                                    <div class="product-title">
                                                        {{ \Carbon\Carbon::parse($con->created_at)->format('dS M\'y - h:i:s A') }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="product-title">
                                                        {{ $con->order_number }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="product-title">
                                                        {{$basic->symbol}}{{ $con->total }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="product-title">
                                                        @if($con->shipping_status == 0)
                                                            <span class="label label-danger"><i class="fa fa-times"></i> Not Start</span>
                                                        @elseif($con->shipping_status == 1)
                                                            <span class="label label-warning"><i class="fa fa-spinner"></i> Pending</span>
                                                        @elseif($con->shipping_status == 2)
                                                            <span class="label label-danger"><i class="fa fa-times"></i> Cancel</span>
                                                        @else
                                                            <span class="label label-success"><i class="fa fa-check"></i> Delivered</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="product-title">
                                                        @if($con->status == 0)
                                                            <span class="label label-warning"><i class="fa fa-spinner"></i> Pending</span>
                                                        @elseif($con->status == 1)
                                                            <span class="label label-success"><i class="fa fa-check"></i> Confirm</span>
                                                        @else
                                                            <span class="label label-danger"><i class="fa fa-times"></i> Cancel</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>{{ $con->payment->name }}</td>
                                                <td>
                                                    <div class="product-title">
                                                        <a href="{{ route('user-order-view',$con->order_number) }}" class="btn btn-primary btn-extra-sm"><i class="fa fa-eye"></i>View</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="pagination-bar">
                                    {!! $order->links('home.pagination') !!}
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