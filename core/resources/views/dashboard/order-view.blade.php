@extends('layouts.dashboard')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/custom.css') }}">
    <style>
        @media print {
            table td:last-child {display:none}
            table th:last-child {display:none}
        }
        .select2-selection,.select2-results{
            font-weight: bold !important;
        }
    </style>
@endsection
@section('content')


    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-info-circle"></i> {{ $page_title }}</h3>
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-primary btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                    <!-- /. tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body pad">

                    <div id="cartFullView" class="row">
                        <div class="col-xs-12 mb-xs-30">
                            <div class="cart-item-table commun-table">
                                <div class="table-responsive">
                                    <table class="table table-bordered custom-table">
                                        <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Sub Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orderItem as $con)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('product-details',$con->product->slug) }}" target="_blank">
                                                        <div class="product-image"><img alt="{{ $con->product->name }}" src="{{ asset('assets/images/product') }}/{{$con->product->image}}"></div>
                                                    </a>
                                                </td>
                                                <td>
                                                    <div class="product-title">
                                                        <a target="_blank" href="{{ route('product-details',$con->product->slug) }}">{{ $con->product->name }}</a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="base-price price-box"> <span class="price">{{$basic->symbol}}{{ $con->product->current_price }} x {{ $con->qty }}</span> </div>
                                                </td>
                                                <td><div class="total-price price-box"> <span class="price">{{$basic->symbol}}{{ $con->product->current_price * $con->qty  }}</span> </div></td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="cart-total-table commun-table">
                                <div class="table-responsive">
                                    <table class="table table-bordered custom-table">
                                        <tbody>
                                        <tr>
                                            <td class="text-right" width="50%">Payment Status</td>
                                            <td class="text-left">
                                                <div class="price-box custom-table">
                                                    @if($order->payment_status == 0)
                                                        <span class="label label-warning"><i class="fa fa-spinner"></i> Pending</span> {{ \Carbon\Carbon::parse($order->created_at)->diffInMinutes() }} min - Left
                                                    @else
                                                        <span class="label label-success"><i class="fa fa-check"></i> Paid</span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" width="50%">Shipping Status</td>
                                            <td class="text-left">

                                                    @if($order->shipping_status == 0)
                                                        <button type="button" class="btn btn-xs btn-danger bold uppercase shipping_button"
                                                                data-toggle="modal" data-target="#shippingModal"
                                                                data-id="{{ $order->id }}">
                                                            <i class='fa fa-times'></i> Not Start
                                                        </button>
                                                    @elseif($order->shipping_status == 1)
                                                        <button type="button" class="btn btn-xs btn-warning bold uppercase shipping_button"
                                                                data-toggle="modal" data-target="#shippingModal"
                                                                data-id="{{ $order->id }}">
                                                            <i class='fa fa-spinner'></i> Pending
                                                        </button>
                                                    @elseif($order->shipping_status == 2)
                                                        <button type="button" class="btn btn-xs btn-danger bold uppercase shipping_button"
                                                                data-toggle="modal" data-target="#shippingModal"
                                                                data-id="{{ $order->id }}">
                                                            <i class='fa fa-times'></i> Cancel
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-xs btn-primary bold uppercase shipping_button"
                                                                data-toggle="modal" data-target="#shippingModal"
                                                                data-id="{{ $order->id }}">
                                                            <i class='fa fa-check'></i> Confirm
                                                        </button>
                                                    @endif

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right"><b>Order Status</b></td>
                                            <td class="text-left">
                                                <div class="price-box">
                                                    @if($order->status == 1)
                                                        <button type="button" class="btn btn-xs btn-primary bold uppercase status_button"
                                                                data-toggle="modal" data-target="#statusModal"
                                                                data-id="{{ $order->id }}">
                                                            <i class='fa fa-check'></i> Confirm
                                                        </button>
                                                    @elseif($order->status == 0)
                                                        <button type="button" class="btn btn-xs btn-warning bold uppercase status_button"
                                                                data-toggle="modal" data-target="#statusModal"
                                                                data-id="{{ $order->id }}">
                                                            <i class='fa fa-spinner'></i> Pending
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-xs btn-danger bold uppercase status_button"
                                                                data-toggle="modal" data-target="#statusModal"
                                                                data-id="{{ $order->id }}">
                                                            <i class='fa fa-times'></i> Cancel
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="cart-total-table commun-table">
                                <div class="table-responsive">
                                    <table class="table table-bordered custom-table">
                                        <tbody>
                                        <tr>
                                            <td class="text-right">Item(s) Subtotal</td>
                                            <td><div class="price-box"> <span class="price custom-table">{{ $basic->symbol }}{{ $order->subtotal }}</span> </div></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right">Tax - Included</td>
                                            <td><div class="price-box"> <span class="price custom-table">{{ $basic->symbol }}{{ $order->tax }}</span> </div></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right"><b>Amount Payable</b></td>
                                            <td><div class="price-box"> <span class="price"><b>{{ $basic->symbol }}{{ $order->total }}</b></span> </div></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 15px">
                        <div class="col-sm-6">
                            <div class="cart-total-table address-box commun-table mb-30">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Shipping Address</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>

                                                <p><b>{{ $userDetails->s_name }}</b></p>

                                                <p>{{ $userDetails->s_company }}, {{ $userDetails->s_number }}</p>

                                                <p>{{ $userDetails->s_email }}</p>

                                                <p>{{ $userDetails->s_landmark }}</p>

                                                <p>{{ $userDetails->s_address }}</p>

                                                <p>{{ $userDetails->s_zip }}, {{ $userDetails->s_city }}, {{ $userDetails->s_state }}, {{ $userDetails->s_country }}</p>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="cart-total-table address-box commun-table">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Billing Address</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td style="padding-left: 25px;padding-bottom: 19px;">

                                                <p><b>{{ $userDetails->b_name }}</b></p>

                                                <p>{{ $userDetails->b_company }}, {{ $userDetails->b_number }}</p>

                                                <p>{{ $userDetails->b_email }}</p>

                                                <p>{{ $userDetails->b_zip }}, {{ $userDetails->b_city }}, {{ $userDetails->b_state }}</p>

                                                <p>{{ $userDetails->b_country }}</p>

                                                <br>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for DELETE -->
    <div class="modal fade" id="shippingModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title bold uppercase" id="myModalLabel"> <i class='fa fa-recycle'></i> Change Status !</h4>
                </div>

                <div class="modal-body">
                    <form id="frmProducts" action="{{ route('update-shipping-status') }}" method="post" class="form-horizontal">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 control-label bold uppercase">Change Status : </label>
                            <div class="col-sm-8">
                                <select class="form-control bold" name="status" id="status" required>
                                    <option value="0" class="bold">Not Start</option>
                                    <option value="1" class="bold">Pending</option>
                                    <option value="3" class="bold">Delivered</option>
                                    <option value="2" class="bold">Cancel</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" id="shipping_id" name="shipping_id" value="0">
                        <div class="form-group">
                            <div class="col-sm-8 col-lg-offset-3">
                                <button class="btn btn-primary btn-block bold uppercase" id="btn-save" value="add"><i class="fa fa-send"></i> Update Status</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal for DELETE -->
    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title bold uppercase" id="myModalLabel"> <i class='fa fa-recycle'></i> Change Status !</h4>
                </div>

                <div class="modal-body">
                    <form id="frmProducts" action="{{ route('update-order-status') }}" method="post" class="form-horizontal">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 control-label bold uppercase">Change Status : </label>
                            <div class="col-sm-8">
                                <select class="form-control bold" name="status1" id="status1" required>
                                    <option value="0" class="bold">Pending</option>
                                    <option value="1" class="bold">Confirm</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" id="status_id" name="status_id" value="0">
                        <div class="form-group">
                            <div class="col-sm-8 col-lg-offset-3">
                                <button class="btn btn-primary btn-block bold uppercase" id="btn-save" value="add"><i class="fa fa-send"></i> Update Status</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('import_scripts')

    <script src="{{ asset('assets/admin/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/dataTables.bootstrap.min.js') }}"></script>

@endsection
@section('scripts')

    <script>
        $(function () {
            $('#myTable').DataTable({
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : false,
                'info'        : true
            });
        });
    </script>
    <script>
        $(document).ready(function (e) {
            $(document).on("click", '.shipping_button', function (e) {
                var id = $(this).data('id');
                $("#shipping_id").val(id);
            });
            $(document).on("click", '.status_button', function (e) {
                var id = $(this).data('id');
                $("#status_id").val(id);
            });

            $('#status').val('{{ $order->shipping_status }}');
            $('#status1').val('{{ $order->status }}');
        });
    </script>
@endsection