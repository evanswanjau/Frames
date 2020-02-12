@extends('layouts.dashboard')
@section('style')
    <style>
        ::-moz-focus-inner {
            padding: 0;
            border: 0;
        }


        button {
            position: relative;
            /*  background-color: #aaa;
              border-radius: 0 3px 3px 0;
              cursor: pointer;*/
        }

        .copied::after {
            position: absolute;
            top: 12%;
            right: 110%;
            display: block;
            content: "COPIED";
            font-size: 1.40em;
            padding: 2px 10px;
            color: #fff;
            background-color: #22a;
            border-radius: 3px;
            opacity: 0;
            will-change: opacity, transform;
            animation: showcopied 1.5s ease;
        }

        @keyframes showcopied {
            0% {
                opacity: 0;
                transform: translateX(100%);
            }
            70% {
                opacity: 1;
                transform: translateX(0);
            }
            100% {
                opacity: 0;
            }
        }
    </style>
    <link href="{{ asset('assets/admin/css/bootstrap-toggle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/bootstrap-fileinput.css') }}" rel="stylesheet">
@endsection
@section('content')



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

            {!! Form::open(['method'=>'post','files'=>true]) !!}
            <div class="row">
            <div class="col-md-4 col-sm-12">

                <div class="box box-primary box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-paypal"></i> Paypal</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body pad">

                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;"><i class="fa fa-cc-paypal"></i> PayPal Details</h1>
                            </div>
                            <div class="panel-body">

                                <div class="form-group row">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Display Image</strong></label>
                                    <div class="col-md-12">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 290px; height: 190px;" data-trigger="fileinput">
                                                <img style="width: 290px" src="{{ asset('assets/images/payment') }}/{{ $paypal->image }}" alt="...">
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 290px; max-height: 190px"></div>
                                            <div>
                                                <span class="btn btn-info btn-file">
                                                    <span class="fileinput-new bold uppercase"><i class="fa fa-file-image-o"></i> Select image</span>
                                                    <span class="fileinput-exists bold uppercase"><i class="fa fa-edit"></i> Change</span>
                                                    <input type="file" name="paypal_image" accept="image/*">
                                                </span>
                                                <a href="#" class="btn btn-danger fileinput-exists bold uppercase" data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>

                                            </div>
                                            <b style="color: red;">Image Type PNG,JPEG,JPG. Resize - (290X190)</b><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Display Name</strong></label>
                                    <div class="col-md-12">
                                        <input class="form-control" name="paypal_name" value="{{ $paypal->name }}" type="text" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Conversion Rate</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group mb15">
                                            <span class="input-group-addon"><strong>1 USD = </strong></span>
                                            <input class="form-control" name="paypal_rate" value="{{ $paypal->rate }}" type="text" required>
                                            <span class="input-group-addon"><strong>{{ $basic->currency }}</strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Charge Per Transaction</h1>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">FIXED</strong></label>
                                            <div class="col-md-12">
                                                <div class="input-group mb15">
                                                    <input class="form-control" name="paypal_fix" value="{{ $paypal->fix }}" required type="text">
                                                    <span class="input-group-addon"><strong>{{ $basic->currency }}</strong></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">PERCENT</strong></label>
                                            <div class="col-md-12">
                                                <div class="input-group mb15">
                                                    <input class="form-control" name="paypal_percent" value="{{ $paypal->percent }}" required type="text">
                                                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div><!-- row 2nd   -->
                            </div>
                        </div>

                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Payment Description</h1>
                            </div>
                            <div class="panel-body">
                                <div class="form-group row" style="">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">PayPal Business Email</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group mb15">
                                            <input class="form-control" name="paypal_email" value="{{ $paypal->val1 }}" required type="text">
                                            <span class="input-group-addon"><b>@</b></span>
                                        </div>

                                    </div>
                                </div>
                                <br><br><br><br><br>
                                <div class="form-group row">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">STATUS</strong></label>
                                    <div class="col-md-12">
                                        <input data-toggle="toggle" {{ $paypal->status == 1 ? 'checked' : '' }} data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="paypal_status">
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="box box-primary box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-money"></i> Perfect Money </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body pad">

                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;"><strong><i class="fa fa-credit-card-alt"></i> Perfect Money</strong></h1>
                            </div>
                            <div class="panel-body">

                                <div class="form-group row">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Display Image</strong></label>
                                    <div class="col-md-12">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 290px; height: 190px;" data-trigger="fileinput">
                                                <img style="width: 290px" src="{{ asset('assets/images/payment') }}/{{ $perfect->image }}" alt="...">
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 290px; max-height: 190px"></div>
                                            <div>
                                                <span class="btn btn-info btn-file">
                                                    <span class="fileinput-new bold uppercase"><i class="fa fa-file-image-o"></i> Select image</span>
                                                    <span class="fileinput-exists bold uppercase"><i class="fa fa-edit"></i> Change</span>
                                                    <input type="file" name="perfect_image" accept="image/*">
                                                </span>
                                                <a href="#" class="btn btn-danger fileinput-exists bold uppercase" data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                                            </div>
                                            <b style="color: red;">Image Type PNG,JPEG,JPG. Resize - (290X190)</b><br>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Display Name</strong></label>
                                    <div class="col-md-12">
                                        <input class="form-control" name="perfect_name" value="{{ $perfect->name }}" required type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Conversion Rate</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group mb15">
                                            <span class="input-group-addon"><strong>1 USD = </strong></span>
                                            <input class="form-control" name="perfect_rate" value="{{ $perfect->rate }}" type="text" required>
                                            <span class="input-group-addon"><strong>{{ $basic->currency }}</strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Charge Per Transaction</h1>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">FIXED</strong></label>
                                            <div class="col-md-12">
                                                <div class="input-group mb15">
                                                    <input class="form-control" name="perfect_fix" value="{{ $perfect->fix }}" required type="text">
                                                    <span class="input-group-addon"><strong>{{ $basic->currency }}</strong></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">PERCENT</strong></label>
                                            <div class="col-md-12">
                                                <div class="input-group mb15">
                                                    <input class="form-control" name="perfect_percent" value="{{ $perfect->percent }}" required type="text">
                                                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div><!-- row 2nd   -->
                            </div>
                        </div>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Payment Description</h1>
                            </div>
                            <div class="panel-body">
                                <div class="form-group row">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Perfect Money USD Account</strong></label>
                                    <div class="col-md-12" style="margin-bottom: 21px;">
                                        <div class="input-group mb15">
                                            <input class="form-control" name="perfect_account" value="{{ $perfect->val1 }}" type="text">
                                            <span class="input-group-addon"><i class="fa fa-send"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Perfect Money Alternate Passphrase  </strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group mb15">
                                            <input class="form-control" name="perfect_alternate" value="{{ $perfect->val2 }}" type="text">
                                            <span class="input-group-addon"><i class="fa fa-bolt"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">STATUS</strong></label>
                                    <div class="col-md-12">
                                        <input data-toggle="toggle" {{ $perfect->status == 1 ? 'checked' : '' }} data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="perfect_status">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="box box-primary box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-btc"></i> BTC ( BlockChain ) </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body pad">

                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;"><strong><i class="fa fa-btc"></i> BlockChain - (BITCOIN)</strong></h1>
                            </div>
                            <div class="panel-body">

                                <div class="form-group row">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Display Image</strong></label>
                                    <div class="col-md-12">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 290px; height: 190px;" data-trigger="fileinput">
                                                <img style="width: 290px" src="{{ asset('assets/images/payment') }}/{{ $btc->image }}" alt="...">
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 290px; max-height: 190px"></div>
                                            <div>
                                                <span class="btn btn-info btn-file">
                                                    <span class="fileinput-new bold uppercase"><i class="fa fa-file-image-o"></i> Select image</span>
                                                    <span class="fileinput-exists bold uppercase"><i class="fa fa-edit"></i> Change</span>
                                                    <input type="file" name="btc_image" accept="image/*">
                                                </span>
                                                <a href="#" class="btn btn-danger fileinput-exists bold uppercase" data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                                            </div>
                                            <b style="color: red;">Image Type PNG,JPEG,JPG. Resize - (290X190)</b><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Display Name</strong></label>
                                    <div class="col-md-12">
                                        <input class="form-control" name="btc_name" value="{{ $btc->name }}" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Conversion Rate</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group mb15">
                                            <span class="input-group-addon"><strong>1 USD = </strong></span>
                                            <input class="form-control" name="btc_rate" value="{{ $btc->rate }}" type="text" required>
                                            <span class="input-group-addon"><strong>{{ $basic->currency }}</strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Charge Per Transaction</h1>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">FIXED</strong></label>
                                            <div class="col-md-12">
                                                <div class="input-group mb15">
                                                    <input class="form-control" name="btc_fix" value="{{ $btc->fix }}" required type="text">
                                                    <span class="input-group-addon"><strong>{{ $basic->currency }}</strong></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">PERCENT</strong></label>
                                            <div class="col-md-12">
                                                <div class="input-group mb15">
                                                    <input class="form-control" name="btc_percent" value="{{ $btc->percent }}" required type="text">
                                                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div><!-- row 2nd   -->
                            </div>
                        </div>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Payment Description</h1>
                            </div>
                            <div class="panel-body">
                                <div class="form-group row">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">BitCoin API Key</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group mb15">
                                            <input class="form-control" name="btc_api" value="{{ $btc->val1 }}" type="text">
                                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <br>
                                <div class="form-group row">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">BitCoin XPUB Code  </strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group mb15">
                                            <input class="form-control" name="btc_xpub" value="{{ $btc->val2 }}" type="text">
                                            <span class="input-group-addon"><i class="fa fa-code"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">STATUS</strong></label>
                                    <div class="col-md-12">
                                        <input data-toggle="toggle" {{ $btc->status == 1 ? 'checked' : '' }} data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="btc_status">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-money"></i> Skrill </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body pad">

                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;"><strong><i class="fa fa-money"></i> Skrill</strong></h1>
                                </div>
                                <div class="panel-body">

                                    <div class="form-group row">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Display Image</strong></label>
                                        <div class="col-md-12">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 290px; height: 190px;" data-trigger="fileinput">
                                                    <img style="width: 290px" src="{{ asset('assets/images/payment') }}/{{ $skrill->image }}" alt="...">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 290px; max-height: 190px"></div>
                                                <div>
                                                <span class="btn btn-info btn-file">
                                                    <span class="fileinput-new bold uppercase"><i class="fa fa-file-image-o"></i> Select image</span>
                                                    <span class="fileinput-exists bold uppercase"><i class="fa fa-edit"></i> Change</span>
                                                    <input type="file" name="skrill_image" accept="image/*">
                                                </span>
                                                    <a href="#" class="btn btn-danger fileinput-exists bold uppercase" data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                                                </div>
                                                <b style="color: red;">Image Type PNG,JPEG,JPG. Resize - (290X190)</b><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Display Name</strong></label>
                                        <div class="col-md-12">
                                            <input class="form-control" name="skrill_name" value="{{ $skrill->name }}" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Conversion Rate</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <span class="input-group-addon"><strong>1 USD = </strong></span>
                                                <input class="form-control" name="skrill_rate" value="{{ $skrill->rate }}" type="text" required>
                                                <span class="input-group-addon"><strong>{{ $basic->currency }}</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Charge Per Transaction</h1>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">FIXED</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="skrill_fix" value="{{ $skrill->fix }}" required type="text">
                                                        <span class="input-group-addon"><strong>{{ $basic->currency }}</strong></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">PERCENT</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="skrill_percent" value="{{ $skrill->percent }}" required type="text">
                                                        <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- row 2nd   -->
                                </div>
                            </div>
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Payment Description</h1>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group row">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">merchant  email</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <input class="form-control" name="skrill_email" value="{{ $skrill->val1 }}" type="text">
                                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <br>
                                    <div class="form-group row">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">secret Word</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <input class="form-control" name="skrill_secret" value="{{ $skrill->val2 }}" type="text">
                                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">STATUS</strong></label>
                                        <div class="col-md-12">
                                            <input data-toggle="toggle" {{ $skrill->status == 1 ? 'checked' : '' }} data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="skrill_status">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-money"></i> Payza </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body pad">

                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;"><strong><i class="fa fa-money"></i> Payza</strong></h1>
                                </div>
                                <div class="panel-body">

                                    <div class="form-group row">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Display Image</strong></label>
                                        <div class="col-md-12">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 290px; height: 190px;" data-trigger="fileinput">
                                                    <img style="width: 290px" src="{{ asset('assets/images/payment') }}/{{ $payza->image }}" alt="...">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 290px; max-height: 190px"></div>
                                                <div>
                                                <span class="btn btn-info btn-file">
                                                    <span class="fileinput-new bold uppercase"><i class="fa fa-file-image-o"></i> Select image</span>
                                                    <span class="fileinput-exists bold uppercase"><i class="fa fa-edit"></i> Change</span>
                                                    <input type="file" name="payza_image" accept="image/*">
                                                </span>
                                                    <a href="#" class="btn btn-danger fileinput-exists bold uppercase" data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                                                </div>
                                                <b style="color: red;">Image Type PNG,JPEG,JPG. Resize - (290X190)</b><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Display Name</strong></label>
                                        <div class="col-md-12">
                                            <input class="form-control" name="payza_name" value="{{ $payza->name }}" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Conversion Rate</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <span class="input-group-addon"><strong>1 USD = </strong></span>
                                                <input class="form-control" name="payza_rate" value="{{ $payza->rate }}" type="text" required>
                                                <span class="input-group-addon"><strong>{{ $basic->currency }}</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Charge Per Transaction</h1>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">FIXED</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="payza_fix" value="{{ $payza->fix }}" required type="text">
                                                        <span class="input-group-addon"><strong>{{ $basic->currency }}</strong></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">PERCENT</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="payza_percent" value="{{ $payza->percent }}" required type="text">
                                                        <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- row 2nd   -->
                                </div>
                            </div>
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Payment Description</h1>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group row" style="">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">merchant Email</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <input class="form-control" name="payza_email" value="{{ $payza->val1 }}" required type="text">
                                                <span class="input-group-addon"><b>@</b></span>
                                            </div>

                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <div class="form-group row">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">STATUS</strong></label>
                                        <div class="col-md-12">
                                            <input data-toggle="toggle" {{ $payza->status == 1 ? 'checked' : '' }} data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="payza_status">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-credit-card"></i> Credit Card </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body pad">

                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;"><strong><i class="fa fa-cc-stripe"></i> Stripe (CARD)</strong></h1>
                                </div>
                                <div class="panel-body">

                                    <div class="form-group row">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Display Image</strong></label>
                                        <div class="col-md-12">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 290px; height: 190px;" data-trigger="fileinput">
                                                    <img style="width: 290px" src="{{ asset('assets/images/payment') }}/{{ $stripe->image }}" alt="...">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 290px; max-height: 190px"></div>
                                                <div>
                                                <span class="btn btn-info btn-file">
                                                    <span class="fileinput-new bold uppercase"><i class="fa fa-file-image-o"></i> Select image</span>
                                                    <span class="fileinput-exists bold uppercase"><i class="fa fa-edit"></i> Change</span>
                                                    <input type="file" name="stripe_image" accept="image/*">
                                                </span>
                                                    <a href="#" class="btn btn-danger fileinput-exists bold uppercase" data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                                                </div>
                                                <b style="color: red;">Image Type PNG,JPEG,JPG. Resize - (290X190)</b><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Display Name</strong></label>
                                        <div class="col-md-12">
                                            <input class="form-control" name="stripe_name" value="{{ $stripe->name }}" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Conversion Rate</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <span class="input-group-addon"><strong>1 USD = </strong></span>
                                                <input class="form-control" name="stripe_rate" value="{{ $stripe->rate }}" type="text" required>
                                                <span class="input-group-addon"><strong>{{ $basic->currency }}</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Charge Per Transaction</h1>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">FIXED</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="stripe_fix" value="{{ $stripe->fix }}" required type="text">
                                                        <span class="input-group-addon"><strong>{{ $basic->currency }}</strong></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">PERCENT</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="stripe_percent" value="{{ $stripe->percent }}" required type="text">
                                                        <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- row 2nd   -->
                                </div>
                            </div>
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Payment Description</h1>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group row">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">SECRET KEY</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <input class="form-control" name="stripe_secret" value="{{ $stripe->val1 }}" type="text">
                                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <br>
                                    <div class="form-group row">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">PUBLISHER KEY</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <input class="form-control" name="stripe_publishable" value="{{ $stripe->val2 }}" type="text">
                                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">STATUS</strong></label>
                                        <div class="col-md-12">
                                            <input data-toggle="toggle" {{ $stripe->status == 1 ? 'checked' : '' }} data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="stripe_status">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-12">

                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-btc"></i> Coinpayments</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body pad">

                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;"><i class="fa fa-money"></i> Method Details</h1>
                                </div>
                                <div class="panel-body">

                                    <div class="form-group row row">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Display Image</strong></label>
                                        <div class="col-md-12">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 290px; height: 190px;" data-trigger="fileinput">
                                                    <img style="width: 290px" src="{{ asset('assets/images/payment') }}/{{ $coin->image }}" alt="...">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 290px; max-height: 190px"></div>
                                                <div>
                                                <span class="btn btn-info btn-file">
                                                    <span class="fileinput-new bold uppercase"><i class="fa fa-file-image-o"></i> Select image</span>
                                                    <span class="fileinput-exists bold uppercase"><i class="fa fa-edit"></i> Change</span>
                                                    <input type="file" name="coin_image" accept="image/*">
                                                </span>
                                                    <a href="#" class="btn btn-danger fileinput-exists bold uppercase" data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>

                                                </div>
                                                <b style="color: red;">Image Type PNG,JPEG,JPG. Resize - (290X190)</b><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row row">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Display Name</strong></label>
                                        <div class="col-md-12">
                                            <input class="form-control" name="coin_name" value="{{ $coin->name }}" type="text" required>
                                        </div>
                                    </div>
                                    <div class="form-group row row">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Conversion Rate</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <span class="input-group-addon"><strong>1 USD = </strong></span>
                                                <input class="form-control" name="coin_rate" value="{{ $coin->rate }}" type="text" required>
                                                <span class="input-group-addon"><strong>{{ $basic->currency }}</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Charge Per Transaction</h1>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row row">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">FIXED</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="coin_fix" value="{{ $coin->fix }}" required type="text">
                                                        <span class="input-group-addon"><strong>{{ $basic->currency }}</strong></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">PERCENT</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="coin_percent" value="{{ $coin->percent }}" required type="text">
                                                        <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- row 2nd   -->
                                </div>
                            </div>

                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Payment Status</h1>
                                </div>
                                <div class="panel-body">

                                    <div class="form-group row">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Merchant ID</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <input class="form-control" name="coin_merchant" value="{{ $coin->val1 }}" type="text">
                                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">IPN Secret Key</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <input class="form-control" name="coin_secret" value="{{ $coin->val2 }}" type="text">
                                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">IPN URL</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <input type="text" class="form-control input-lg" name="coin_url" id="ref" readonly value="{{ route('coinpayment-ipn') }}"/>
                                                <span class="input-group-btn">
                                                    <button type="button" data-copytarget="#ref" class="btn btn-success btn-lg">Copy</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">STATUS</strong></label>
                                        <div class="col-md-12">
                                            <input data-toggle="toggle" {{ $coin->status == 1 ? 'checked' : '' }} data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="coin_status">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">

                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-money"></i> Cash On Delivery</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body pad">

                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;"><i class="fa fa-money"></i> Method Details</h1>
                                </div>
                                <div class="panel-body">

                                    <div class="form-group row">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Display Image</strong></label>
                                        <div class="col-md-12">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 290px; height: 190px;" data-trigger="fileinput">
                                                    <img style="width: 290px" src="{{ asset('assets/images/payment') }}/{{ $cod->image }}" alt="...">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 290px; max-height: 190px"></div>
                                                <div>
                                                <span class="btn btn-info btn-file">
                                                    <span class="fileinput-new bold uppercase"><i class="fa fa-file-image-o"></i> Select image</span>
                                                    <span class="fileinput-exists bold uppercase"><i class="fa fa-edit"></i> Change</span>
                                                    <input type="file" name="cod_image" accept="image/*">
                                                </span>
                                                    <a href="#" class="btn btn-danger fileinput-exists bold uppercase" data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>

                                                </div>
                                                <b style="color: red;">Image Type PNG,JPEG,JPG. Resize - (290X190)</b><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Display Name</strong></label>
                                        <div class="col-md-12">
                                            <input class="form-control" name="cod_name" value="{{ $cod->name }}" type="text" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Conversion Rate</strong></label>
                                        <div class="col-md-12">
                                            <div class="input-group mb15">
                                                <span class="input-group-addon"><strong>1 USD = </strong></span>
                                                <input class="form-control" name="cod_rate" value="{{ $cod->rate }}" type="text" required>
                                                <span class="input-group-addon"><strong>{{ $basic->currency }}</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Charge Per Transaction</h1>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">FIXED</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="cod_fix" value="{{ $cod->fix }}" required type="text">
                                                        <span class="input-group-addon"><strong>{{ $basic->currency }}</strong></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-md-12"><strong style="text-transform: uppercase;">PERCENT</strong></label>
                                                <div class="col-md-12">
                                                    <div class="input-group mb15">
                                                        <input class="form-control" name="cod_percent" value="{{ $cod->percent }}" required type="text">
                                                        <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- row 2nd   -->
                                </div>
                            </div>

                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Payment Status</h1>
                                </div>
                                <div class="panel-body">
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <div class="form-group row">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">STATUS</strong></label>
                                        <div class="col-md-12">
                                            <input data-toggle="toggle" {{ $cod->status == 1 ? 'checked' : '' }} data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="cod_status">
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-primary btn-lg btn-block"><i class="fa fa-send"></i> <strong>Save Changes</strong></button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>


@endsection
@section('scripts')
    <script>
        (function() {

            'use strict';

            // click events
            document.body.addEventListener('click', copy, true);

            // event handler
            function copy(e) {

                // find target element
                var
                    t = e.target,
                    c = t.dataset.copytarget,
                    inp = (c ? document.querySelector(c) : null);

                // is element selectable?
                if (inp && inp.select) {

                    // select text
                    inp.select();

                    try {
                        // copy text
                        document.execCommand('copy');
                        inp.blur();

                        // copied animation
                        t.classList.add('copied');
                        setTimeout(function() { t.classList.remove('copied'); }, 1500);
                    }
                    catch (err) {
                        alert('please press Ctrl/Cmd+C to copy');
                    }
                }
            }
        })();
    </script>
    <script src="{{ asset('assets/admin/js/bootstrap-toggle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/bootstrap-fileinput.js') }}"></script>
@endsection