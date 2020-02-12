@extends('layouts.dashboard')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap-colorpicker.min.css') }}">
    <link href="{{ asset('assets/admin/css/bootstrap-toggle.min.css') }}" rel="stylesheet">
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


                    {!! Form::model($basic,['route'=>['basic-update',$basic->id],'method'=>'PUT','role'=>'form','class'=>'form-horizontal','files'=>true]) !!}
                    <div class="form-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Website Title</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input class="form-control bold input-lg" name="title" value="{{ $basic->title }}" type="text" required>
                                            <span class="input-group-addon"><strong><i class="fa fa-file-text-o"></i></strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Website Base Color </strong></label>
                                    <div class="col-md-12">
                                        <input type="text" name="color" value="{{ $basic->color }}" style="background-color: #{{ $basic->color }};color:#fff" class="form-control my-colorpicker1 bold input-lg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Basic Currency</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input class="form-control bold input-lg" name="currency" value="{{ $basic->currency }}" type="text" required>
                                            <span class="input-group-addon"><strong><i class="fa fa-money"></i></strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Currency Symbol </strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input class="form-control bold input-lg" name="symbol" value="{{ $basic->symbol }}" type="text" required>
                                            <span class="input-group-addon"><strong><i class="fa fa-bolt"></i></strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Tax</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input class="form-control bold input-lg" name="tax" value="{{ $basic->tax }}" type="text" required>
                                            <span class="input-group-addon"><strong><i class="fa fa-percent"></i></strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Oder Cancel After </strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input class="form-control bold input-lg" name="expire_time" value="{{ $basic->expire_time }}" type="text" required>
                                            <span class="input-group-addon"><strong>Minute</strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Contact Phone</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input type="text" name="phone" class="form-control bold input-lg" value="{{ $basic->phone }}" required>
                                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Contact Email</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input type="text" name="email" class="form-control bold input-lg" value="{{ $basic->email }}" required>
                                            <span class="input-group-addon"><i class="fa fa-envelope-open"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Web Meta Tag</strong></label>
                                    <div class="col-md-12">
                                        <textarea name="meta_tag" class="form-control bold input-lg" id="" cols="30" rows="3"> {{ $basic->meta_tag }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Contact Address</strong></label>
                                    <div class="col-md-12">
                                        <textarea name="address" id="" class="form-control bold input-lg" cols="30" rows="3"> {{ $basic->address }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block btn-lg"><i class="fa fa-send"></i> UPDATE</button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div><!---ROW-->
        </div>
    </div>


@endsection
@section('scripts')
    <script src="{{ asset('assets/admin/js/bootstrap-colorpicker.js') }}"></script>
    <script src="{{ asset('assets/admin/js/bootstrap-toggle.min.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $('.my-colorpicker1').colorpicker()
        });
    </script>
@endsection
