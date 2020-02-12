@extends('layouts.dashboard')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/admin/css/pricing.css')}}">
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


                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                <tr>
                                    <th>#SL</th>
                                    <th>Method Name</th>
                                    <th>Display Image</th>
                                    <th>Withdraw Charge</th>
                                    <th>Withdraw Limit</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($withdraw as $key => $pm)
                                    <tr class="{{$pm->status == 0 ? 'bg-warning' : ''}}">
                                        <td><b>{{ ++$key }}</b></td>
                                        <td><b>{{ $pm->name }}</b></td>
                                        <td><img src="{{ asset('assets/images/withdraw') }}/{{ $pm->image }}" width="50%" alt=""></td>
                                        <td><b>{{ $pm->charge }} {{ $basic->currency }}</b></td>
                                        <td><b>{{ $pm->withdraw_min }}{{ $basic->currency }} ~ {{ $pm->withdraw_max }}{{ $basic->currency }}</b></td>
                                        <td><b>{{ $pm->duration }} Days</b></td>
                                        <td>
                                            @if($pm->status == 1)
                                                <div class="badge badge-primary"><i class="fa fa-check font-medium-1"></i><span class="text-bold-700 text-uppercase">Activate</span></div>
                                            @else
                                                <div class="badge badge-danger"><i class="fa fa-times font-medium-1"></i><span class="text-bold-700 text-uppercase">Deactivate</span></div>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('withdraw-edit',$pm->id) }}" class="btn btn-primary btn-sm bold"><i class="fa fa-edit"></i> EDIT</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                </div>
            </div>
        </div>
    </div>




    {{--
        <!-- Modal for DELETE -->
        <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title bold" id="myModalLabel"> <i class='fa fa-exclamation-triangle'></i> Confirmation !</h4>
                    </div>

                    <div class="modal-body">
                        <strong>Are you sure you want to Delete ?</strong>
                    </div>

                    <div class="modal-footer">
                        <form method="post" action="{{ route('plan-delete') }}" class="form-inline">
                            {!! csrf_field() !!}
                            {{ method_field('DELETE') }}
                            <input type="hidden" name="id" class="abir_id" value="0">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> DELETE</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>--}}

@endsection
@section('scripts')

    {{--<script>
        $(document).ready(function () {

            $(document).on("click", '.delete_button', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);
            });

        });
    </script>

    <script>
        $(document).ready(function (e) {
            $(document).on("click", '.publish_button', function (e) {
                var id = $(this).data('id');
                $(".confirm_id").val(id);
            });
        });
    </script>--}}

@endsection
