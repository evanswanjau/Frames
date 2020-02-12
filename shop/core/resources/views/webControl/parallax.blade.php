@extends('layouts.dashboard')
@section('style')
    <link href="{{ asset('assets/admin/css/bootstrap-fileinput.css') }}" rel="stylesheet">
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
                    {!! Form::open(['files'=>true]) !!}

                    {{--<div class="row">
                        <div class="col-md-4">
                            <div class="box box-primary box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title uppercase bold"><i class="fa fa-edit"></i> Counter parallax</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body pad">

                                    <div class="row">
                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">Counter parallax</strong></label>
                                            <div class="col-sm-12">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="input-group input-large">
                                                        <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                            <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                            <span class="fileinput-filename"> </span>
                                                        </div>
                                                        <span class="input-group-addon btn default btn-file">
                                                                    <span class="fileinput-new bold"> Change Image </span>
                                                                    <span class="fileinput-exists bold"> Change </span>
                                                                    <input type="file" name="counter_bg"> </span>
                                                        <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                    </div>
                                                    <code>Breadcrumb Mimes Type : png,jpeg,jpg | Resize 1920X1064</code>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="box box-primary box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title uppercase bold"><i class="fa fa-photo"></i> Current Image</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body pad">
                                    <img class="img-responsive" src="{{ asset('assets/images') }}/{{ $basic->counter_bg }}" alt="logo">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>--}}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="box box-primary box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title uppercase bold"><i class="fa fa-edit"></i> Subscribe parallax</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body pad">

                                    <div class="row">
                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">Subscribe parallax</strong></label>
                                            <div class="col-sm-12">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="input-group input-large">
                                                        <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                            <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                            <span class="fileinput-filename"> </span>
                                                        </div>
                                                        <span class="input-group-addon btn default btn-file">
                                                                    <span class="fileinput-new bold"> Change Image </span>
                                                                    <span class="fileinput-exists bold"> Change </span>
                                                                    <input type="file" name="subscribe_bg"> </span>
                                                        <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                    </div>
                                                    <code>Breadcrumb Mimes Type : png,jpeg,jpg | Resize 1070x780</code>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="box box-primary box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title uppercase bold"><i class="fa fa-photo"></i> Current Image</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body pad">
                                    <img class="img-responsive" src="{{ asset('assets/images') }}/{{ $basic->subscribe_bg }}" alt="logo">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12"> <button type="submit" class="btn btn-primary btn-lg bold btn-block"><i class="fa fa-send"></i> UPDATE Parallax</button></div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('assets/admin/js/bootstrap-fileinput.js') }}"></script>
@endsection
