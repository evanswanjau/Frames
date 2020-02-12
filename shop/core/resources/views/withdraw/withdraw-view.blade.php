@extends('layouts.dashboard')
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

                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="box box-primary box-solid">
                                <div class="box-header with-border">
                                    <h4 class="card-title text-center" id="horz-layout-basic">Withdraw Method</h4>
                                </div>
                                <div class="box-body pad">
                                    <div class="card-body">
                                        <div class="card box-shadow-0">
                                            <div class="card-content collpase show">
                                                <div class="card-body text-center">
                                                    <h3 class="text-uppercase font-weight-bold text-center" id="horz-layout-basic">{{$withdraw->withdrawMethod->name}}</h3>
                                                    <br>
                                                    <img src="{{ asset('assets/images/withdraw') }}/{{$withdraw->withdrawMethod->image}}" style="width:100%;" alt="">
                                                    <br>
                                                    <br>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="box box-primary box-solid">
                                <div class="box-header with-border">
                                    <h4 class="card-title text-center" id="horz-layout-basic">{{$page_title}}</h4>
                                </div>
                                <div class="box-body pad">
                                    <div class="card-body text-center">

                                        <h3>Withdraw Amount : {{ $withdraw->amount }} USD</h3>
                                        <h3>Withdraw Charge : {{ $withdraw->charge }} USD</h3>
                                        <hr>
                                        <h3>{{ $withdraw->withdrawMethod->name }} - Pay Details</h3>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6 col-md-offset-3 col-sm-12">
                                                <textarea class="form-control text-center font-weight-bold" name="" id="" cols="30" rows="2" readonly>{{$withdraw->details}}</textarea>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        @if($withdraw->status == 0)
                                            <div class="row">
                                                <div class="col-md-3 col-md-offset-3 col-sm-12">
                                                    <button type="button" class="btn btn-warning btn-block text-uppercase btn-lg delete_button"
                                                            data-toggle="modal" data-target="#refundModal"
                                                            data-id="{{ $withdraw->id }}" title="Refund">
                                                        <i class='fa fa-retweet'> Refund</i>
                                                    </button>
                                                </div>
                                                <div class="col-md-3">
                                                    <button type="button" class="btn btn-success btn-block text-uppercase btn-lg delete_button"
                                                            data-toggle="modal" data-target="#confirmModal"
                                                            data-id="{{ $withdraw->id }}" title="Confirm">
                                                        <i class='fa fa-check'> Confirm</i>
                                                    </button>
                                                </div>
                                            </div>
                                            <br><br>
                                        @elseif($withdraw->status == 1)
                                            <div class="row">
                                                <div class="col-md-6 col-md-offset-3 col-sm-12">
                                                    <button type="button" class="btn btn-success btn-block text-uppercase btn-lg">
                                                        <i class='fa fa-check'> Confirmed</i>
                                                    </button>
                                                </div>
                                            </div>
                                        @else
                                            <div class="row">
                                                <div class="col-md-6 col-md-offset-3">
                                                    <button type="button" class="btn btn-warning btn-block text-uppercase btn-lg">
                                                        <i class='fa fa-retweet'> Refunded</i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" >
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel2"><i class='fa fa-exclamation-triangle'></i> Confirmation !</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <strong>Are you sure you want to Confirm This ?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('withdraw-confirm') }}" class="form-inline">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" value="{{$withdraw->id}}">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>&nbsp;&nbsp;
                        <button type="submit" class="btn btn-danger"><i class="fa fa-check"></i> YES Sure</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="refundModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" >
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel2"><i class='fa fa-exclamation-triangle'></i> Confirmation !</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <strong>Are you sure you want to refund This ?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('withdraw-refund') }}" class="form-inline">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" value="{{ $withdraw->id }}">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>&nbsp;&nbsp;
                        <button type="submit" class="btn btn-danger"><i class="fa fa-check"></i> YES Sure</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection