@extends('layouts.dashboard')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/dataTables.bootstrap.min.css') }}">
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

                    <table class="table table-bordered table-hover" id="myTable">
                        <thead>
                        <tr>
                            <th>#SL</th>
                            <th>Order Number</th>
                            <th>Created At</th>
                            <th>Total Amount</th>
                            <th>Payment Status</th>
                            <th>Shipping Status</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="products-list">
                        @foreach ($order as $key => $product)
                            <tr id="product{{$key}}">
                                <td>{{++$key}}</td>
                                <td>{{$product->order_number}}</td>
                                <td>{{ \Carbon\Carbon::parse($product->created_at)->format('M d, y - h:i:s A') }}</td>
                                <td>{{$basic->symbol}}{{$product->total}}</td>
                                <td>
                                    @if($product->payment_status == 0)
                                        <span class="label label-warning"><i class="fa fa-spinner"></i> Pending</span>
                                    @else
                                        <span class="label label-success"><i class="fa fa-check"></i> Paid</span>
                                    @endif
                                </td>
                                <td>
                                    @if($product->shipping_status == 0)
                                        <span class="label label-danger"><i class="fa fa-times"></i> Not Start</span>
                                    @elseif($product->shipping_status == 1)
                                        <span class="label label-warning"><i class="fa fa-spinner"></i> Pending</span>
                                    @elseif($product->shipping_status == 2)
                                        <span class="label label-danger"><i class="fa fa-times"></i> Cancel</span>
                                    @else
                                        <span class="label label-success"><i class="fa fa-check"></i> Delivered</span>
                                    @endif
                                </td>
                                <td>
                                    @if($product->status == 1)
                                        <span class="label label-primary"><i class="fa fa-check"></i> Confirm</span>
                                    @elseif($product->status == 0)
                                        <span class="label label-warning"><i class="fa fa-spinner"></i> Pending</span>
                                    @else
                                        <span class="label label-danger"><i class="fa fa-times"></i> Cancel</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('order-view',$product->order_number) }}" class="btn btn-sm btn-primary bold uppercase"><i class="fa fa-eye"></i> View Order</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

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
@endsection