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
                            <th>Register At</th>
                            <th>Provider Name</th>
                            <th>Provider Email</th>
                            <th>Provider Phone</th>
                            <th>Provider Balance</th>
                            <th>Provider Password</th>
                            <th>Approve Status</th>
                            <th>Provider Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="products-list" name="products-list">
                        @foreach ($provider as $key => $product)
                            <tr id="product{{$key}}" class="{{ $product->status == 1 ? 'warning' : ''}}">
                                <td>{{++$key}}</td>
                                <td>{{\Carbon\Carbon::parse($product->created_at)->format('dS-M-y')}}<br>{{ \Carbon\Carbon::parse($product->created_at)->diffForHumans() }}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->email}}</td>
                                <td>{{$product->country_code}}{{$product->phone}}</td>
                                <td>{{$product->balance }} - {{ $basic->currency }}</td>
                                <td>
                                    <button type="button" class="btn btn-success bold uppercase password_button"
                                            data-toggle="modal" title="Update Password" data-target="#PassModal"
                                            data-id="{{ $product->id }}">
                                        <i class='fa fa-send'></i> Update Password
                                    </button>
                                </td>
                                <td>
                                    @if($product->register_status == 0)
                                        <button type="button" class="btn btn-warning bold uppercase register_button"
                                                data-toggle="modal" title="Do Approve" data-target="#ApproveModal"
                                                data-id="{{ $product->id }}">
                                            <i class='fa fa-spinner'></i> Pending
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-success bold uppercase register_button"
                                                data-toggle="modal" title="Do Reject" data-target="#ApproveModal"
                                                data-id="{{ $product->id }}">
                                            <i class='fa fa-check'></i> Approve
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    @if($product->status == 1)
                                        <button type="button" class="btn btn-danger bold uppercase delete_button"
                                                data-toggle="modal" title="Do Unblock" data-target="#DelModal"
                                                data-id="{{ $product->id }}">
                                            <i class='fa fa-times'></i> Block
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-success bold uppercase delete_button"
                                                data-toggle="modal" title="Do Block" data-target="#DelModal"
                                                data-id="{{ $product->id }}">
                                            <i class='fa fa-check'></i> UnBlock
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('provider-view',$product->id) }}" class="btn btn-sm btn-primary bold uppercase"><i class="fa fa-eye"></i> View</a>
                                    <a href="{{ route('provider-edit',$product->id) }}" class="btn btn-sm btn-warning bold uppercase"><i class="fa fa-edit"></i> Edit</a>
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
                    <form method="post" action="{{ route('provider-status') }}" class="form-inline">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" class="confirm_id" value="0">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Yes Sure.</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="ApproveModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                    <form method="post" action="{{ route('provider-register-status') }}" class="form-inline">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" class="register_id" value="0">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Yes Sure.</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="PassModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title bold uppercase" id="myModalLabel"> <i class='fa fa-send'></i> Update Provider Password !</h4>
                </div>

                <div class="modal-body">

                    <form class="form-horizontal" action="{{ route('provider-password') }}" method="post" role="form">
                        <div class="form-body">
                            {!! csrf_field() !!}

                            <div class="form-group row">
                                <label class="col-md-3 control-label"><strong>New Password :</strong></label>

                                <div class="col-md-8">
                                    <input class="form-control" name="password" required placeholder="New Password" value="" type="password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 control-label"><strong>Confirm Password :</strong></label>

                                <div class="col-md-8">
                                    <input class="form-control" name="password_confirmation" required placeholder="Confirm Password" value="" type="password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-8 col-md-offset-3">
                                    <input type="hidden" name="id" class="password_id" value="0">
                                    <button type="submit" class="btn btn-success btn-block"><i class="fa fa-send"></i> Update Password</button>
                                </div>
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
            $(document).on("click", '.delete_button', function (e) {
                var id = $(this).data('id');
                $(".confirm_id").val(id);
            });
            $(document).on("click", '.password_button', function (e) {
                var id = $(this).data('id');
                $(".password_id").val(id);
            });
            $(document).on("click", '.register_button', function (e) {
                var id = $(this).data('id');
                $(".register_id").val(id);
            });
        });
    </script>
@endsection