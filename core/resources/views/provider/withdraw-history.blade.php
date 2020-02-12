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


                            <table class="table table-striped table-bordered table-hover" id="myTable">
                                <thead>
                                <tr>
                                    <th>#SL</th>
                                    <th>Created At</th>
                                    <th>Transaction Number</th>
                                    <th>Withdraw Method</th>
                                    <th>Withdraw Amount</th>
                                    <th>Withdraw Charge</th>
                                    <th>Status</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($log as $k => $p)
                                    <tr>
                                        <td>{{ ++$k }}</td>
                                        <td>{{ \Carbon\Carbon::parse($p->created_at)->format('dS M, Y') }}</td>
                                        <td>{{ $p->custom }}</td>
                                        <td>{{ $p->withdrawMethod->name }}</td>
                                        <td>{{ $p->amount }} {{ $basic->currency }}</td>
                                        <td>{{ $p->charge }} {{ $basic->currency }}</td>
                                        <td>
                                            @if($p->status == 0)
                                                <span class="label label-warning">
                                                    <i class="fa fa-spinner font-medium-2"></i>
                                                    <span>Pending</span>
                                                </span>
                                            @elseif($p->status == 1)
                                                <span class="label label-success">
                                                    <i class="fa fa-check font-medium-2"></i>
                                                    <span>Success</span>
                                                </span>
                                            @else
                                                <span class="label label-danger">
                                                    <i class="fa fa-times font-medium-2"></i>
                                                    <span>Refund</span>
                                                </span>
                                            @endif
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