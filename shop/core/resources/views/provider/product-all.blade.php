@extends('layouts.provider')
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
                            <th>SKU Number</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Charge</th>
                            <th>Your Amount</th>
                            <th>Category</th>
                            <th>In Stock</th>
                            <th>View</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="products-list" name="products-list">
                        @foreach ($products as $key => $product)
                            <tr id="product{{$key}}" class="{{ $product->stock < 10 ? 'warning' : ''  }}">
                                <td>{{++$key}}</td>
                                <td>{{$product->sku}}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $basic->symbol }}{{ $product->current_price }}</td>
                                <td>{{ $basic->symbol }}{{ $product->charge }}</td>
                                <td>{{ $basic->symbol }}{{ $product->rest_amount }}</td>
                                <td>{{$product->category->name}} <br>{{$product->subcategory->name}}<br>{{$product->childcategory_id != null ? $product->childcategory->name : ''}}  </td>
                                <td>{{ $product->stock }}-Items</td>
                                <td>{{ $product->view }}'s</td>
                                <td>
                                    @if($product->status)
                                    <span class="label label-primary"><i class="fa fa-check"></i> Active</span>
                                    @else
                                    <span class="label label-danger"><i class="fa fa-times"></i> Deactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('provider-product-edit',$product->id) }}" class="btn btn-sm btn-primary bold uppercase"><i class="fa fa-edit"></i> Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal for DELETE -->
    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title bold uppercase" id="myModalLabel"> <i class='fa fa-exclamation-triangle'></i> Confirmation !</h4>
                </div>

                <div class="modal-body">
                    <strong>Are you sure you want to Do This. ?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('product-feature') }}" class="form-inline">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" class="confirm_id" value="0">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Yes Sure.</button>
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
            $(document).on("click", '.delete_button', function (e) {
                var id = $(this).data('id');
                $(".confirm_id").val(id);
            });
        });
    </script>
@endsection