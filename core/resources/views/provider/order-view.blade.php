@extends('layouts.provider')
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
                                            <th>Color</th>
                                            <th>Size</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                            <th>Charge</th>
                                            <th>Your Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>
                                                    <a href="{{ route('product-details',$orderItem->product->slug) }}" target="_blank">
                                                        <div class="product-image"><img alt="{{ $orderItem->product->name }}" src="{{ asset('assets/images/product') }}/{{$orderItem->product->image}}"></div>
                                                    </a>
                                                </td>
                                                <td>
                                                    <div class="product-title">
                                                        <a target="_blank" href="{{ route('product-details',$orderItem->product->slug) }}">{{ $orderItem->product->name }}</a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="base-price price-box">
                                                        @if($orderItem->color == 0)
                                                            <span class="price">-</span>
                                                        @else
                                                            <span class="label label-info">{{ \App\Color::findOrFail($orderItem->color)->name }}</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="base-price price-box">
                                                        @if($orderItem->size == 0)
                                                            <span class="price">-</span>
                                                        @else
                                                            <span class="label label-info">{{ \App\Size::findOrFail($orderItem->size)->name }}</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="base-price price-box">
                                                        <span class="price">{{$basic->symbol}}{{ $orderItem->product->current_price }} x {{ $orderItem->qty }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="total-price price-box"> <span class="price">{{$basic->symbol}}{{ $orderItem->product->current_price * $orderItem->qty  }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="base-price price-box">
                                                        <span class="price">{{$basic->symbol}}{{ $orderItem->product->charge }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="base-price price-box">
                                                        <span class="price">{{$basic->symbol}}{{ $orderItem->provider_amount }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($orderItem->status == 0)
                                                        <span class="label label-warning"><i class="fa fa-spinner"></i> Pending</span>
                                                    @else
                                                        <span class="label label-success"><i class="fa fa-check"></i> Confirm</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($orderItem->status == 0)
                                                        <button type="button" class="btn btn-xs btn-success bold uppercase shipping_button"
                                                                data-toggle="modal" data-target="#shippingModal"
                                                                data-id="{{ $orderItem->id }}">
                                                            <i class='fa fa-check'></i> make Confirm
                                                        </button>
                                                    @else
                                                        <span class="label label-success"><i class="fa fa-check"></i> Success</span>
                                                    @endif
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
                    <strong>Are you sure you want to Confirm This ?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('provider-order-confirm-status') }}" class="form-inline">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" id="confirm_id" class="confirm_id" value="0">

                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Yes Sure</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal for DELETE -->
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
                $("#confirm_id").val(id);
            });
        });
    </script>
@endsection