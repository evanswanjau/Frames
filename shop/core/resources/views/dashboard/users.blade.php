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
                            <th>Registration Date</th>
                            <th>User Name</th>
                            <th>User Email</th>
                            <th>User Image</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="products-list" name="products-list">
                        @foreach ($users as $key => $product)
                            <tr id="product{{$key}}">
                                <td>{{++$key}}</td>
                                <td>{{ \Carbon\Carbon::parse($product->created_at)->format('dS F, Y h:i A')}}</td>
                                <td>{{$product->first_name}} {{ $product->last_name }}</td>
                                <td>{{$product->email}}</td>
                                <td>
                                    <img class="img-circle center-block" src="{{ asset('assets/images/user') }}/{{ $product->image }}" width="80px">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger bold uppercase delete_button"
                                            data-toggle="modal" data-target="#DelModal"
                                            data-id="{{ $product->id }}">
                                        <i class='fa fa-trash'></i> Delete
                                    </button>
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
                    <strong>Are you sure you want to Do Delete User. ?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('user-delete') }}" class="form-inline">
                        {!! csrf_field() !!}
                        {{ method_field('delete') }}
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