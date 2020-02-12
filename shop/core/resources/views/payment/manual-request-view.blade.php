@extends('layouts.dashboard')
@section('style')

    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>

    <link rel="stylesheet" href="{{ asset('assets/admin/css/jquery.fancybox.min.css') }}" />
    <script src="{{ asset('assets/admin/js/jquery.fancybox.min.js') }}"></script>

@endsection
@section('content')

    <div class="row">
        <div class="col-md-4">

            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-info-circle"></i> {{$payment->payment->name}}</h3>
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-primary btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                    <!-- /. tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body pad">

                    <img src="{{ asset('assets/images/payment') }}/{{$payment->payment->image}}" style="width:100%;" alt="">

                </div>
            </div>
        </div>
        <div class="col-md-8">

            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-info-circle"></i> Payment Details</h3>
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-primary btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                    <!-- /. tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body pad">

                    <h5>Payment Prove Image : </h5>
                    <br>
                    <div class="row">
                        @foreach($payment->paymentLogImage as $pm)
                            <div class="col-md-3">
                                <a data-fancybox="gallery" href="{{ asset('assets/images/paymentimage') }}/{{$pm->name}}">
                                    <img src="{{ asset('assets/images/paymentimage') }}/{{$pm->name}}" style="width: 100%" alt="">
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <hr >
                    <h5>Message : </h5>
                    <br>
                    <p>{!! $payment->message !!}</p>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" {{ $payment->status == 1 ? 'disabled' : '' }} {{ $payment->status == 2 ? 'disabled' : '' }} class="btn btn-danger btn-block btn-lg bold font-weight-bold delete_button"
                                    data-toggle="modal" data-target="#DelModal"
                                    data-id="{{ $payment->id }}" title="Cancel Payment">
                                <i class='fa fa-times'></i> Cancel Payment
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" {{ $payment->status == 1 ? 'disabled' : '' }} {{ $payment->status == 2 ? 'disabled' : '' }} class="btn btn-success btn-block btn-lg bold font-weight-bold confirm_button"
                                    data-toggle="modal" data-target="#ConModal"
                                    data-id="{{ $payment->id }}" title="Confirm Payment">
                                <i class='fa fa-send'></i> Confirm Payment
                            </button>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="ConModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel2"><i class='fa fa-exclamation-triangle'></i> Confirmation !</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <strong>Are you sure you want to Confirm This Payment ?</strong>
                </div>
                <div class="modal-footer">
                    <form method="post" action="{{ route('manual-payment-request-confirm') }}" class="form-inline">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" class="confirm_id" value="0">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i>Close</button>&nbsp;&nbsp;
                        <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Yes Sure.!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel2"><i class='fa fa-exclamation-triangle'></i> Confirmation !</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <strong>Are you sure you want to Cancel This Payment ?</strong>
                </div>
                <div class="modal-footer">
                    <form method="post" action="{{ route('manual-payment-request-cancel') }}" class="form-inline">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" class="delete_id" value="0">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i>Close</button>&nbsp;&nbsp;
                        <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Yes Sure.!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $(document).on("click", '.delete_button', function (e) {
                var id = $(this).data('id');
                $(".delete_id").val(id);
            });
            $(document).on("click", '.confirm_button', function (e) {
                var id = $(this).data('id');
                $(".confirm_id").val(id);
            });
        });
    </script>
@endsection