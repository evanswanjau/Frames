@extends('layouts.dashboard')
@section('style')
    <link href="{{ asset('assets/admin/css/bootstrap-fileinput.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/bootstrap-toggle.min.css')}}" rel="stylesheet">
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <a href="{{ route('manual-payment-method-create') }}" class="btn btn-primary bold"><i class="fa fa-plus"></i> Add New Gateway</a>
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-primary btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                    <!-- /. tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body pad">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                            <tr>
                                <th>#SL</th>
                                <th>Gateway Name</th>
                                <th>Gateway Display Image</th>
                                <th>Conversion Rate</th>
                                <th>Payment Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($payment as $key => $pm)
                                <tr class="{{$pm->status == 0 ? 'bg-warning' : ''}}">
                                    <td><b>{{ ++$key }}</b></td>
                                    <td><b>{{ $pm->name }}</b></td>
                                    <td><img src="{{ asset('assets/images/payment') }}/{{ $pm->image }}" width="40%" alt=""></td>
                                    <td><b>1 USD = {{$pm->rate}} {{ $basic->currency }}</b></td>
                                    <td><b>{!! $pm->val1 !!}</b></td>
                                    <td>
                                        @if($pm->status == 1)
                                            <div class="badge badge-primary"><i class="fa fa-check font-medium-1"></i><span class="text-bold-700 text-uppercase">Activate</span></div>
                                        @else
                                            <div class="badge badge-danger"><i class="fa fa-times font-medium-1"></i><span class="text-bold-700 text-uppercase">Deactivate</span></div>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('manual-payment-method-edit',$pm->id) }}" class="btn btn-primary text-bold-700 text-uppercase" title="Edit Gateway">
                                            <i class='fa fa-edit font-medium-1'></i> <span>Edit</span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')

@stop
