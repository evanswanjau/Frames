@extends('layouts.dashboard')

@section('style')
    <link href="{{ asset('assets/admin/css/bootstrap-toggle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/bootstrap-fileinput.css') }}" rel="stylesheet">
@endsection
@section('content')


    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <div class="box-title">
                        <a href="{{ route('advertisement-all') }}" class="btn btn-primary"><strong><i class="fa fa-eye"></i> VIEW ALL ADVERTISE</strong></a>
                    </div>
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-primary btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                    <!-- /. tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body pad">


                    {!! Form::open(['method'=>'post','role'=>'form','class'=>'form-horizontal','files'=>true]) !!}
                    <div class="form-body">

                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">


                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#tab_1_1" class="bold" data-toggle="tab"> OWN ADVERTISEMENT </a>
                                    </li>
                                    <li>
                                        <a href="#tab_1_2" class="bold"  data-toggle="tab"> GOOGLE ADS </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade active in" id="tab_1_1">
                                        {!! Form::open(['method'=>'post','role'=>'form','class'=>'form-horizontal','files'=>true]) !!}

                                        <input type="hidden" name="advert_type" value="1">

                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">Advertise Size</strong></label>
                                            <div class="col-md-12">
                                                <div class="input-group">
                                                    <select name="advert_size" id="" class="form-control bold input-lg" required>
                                                        <option class="bold" value="">Select One</option>
                                                        <option class="bold" value="1">300X600</option>
                                                        <option class="bold" value="2">300X250</option>
                                                        <option class="bold" value="3">728X90</option>
                                                        <option class="bold" value="4">970X90</option>
                                                        {{--<option class="bold" value="5">970X250</option>--}}
                                                    </select>
                                                    <span class="input-group-addon"><strong><i class="fa fa-list"></i></strong></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">Advertise Title</strong></label>
                                            <div class="col-md-12">
                                                <div class="input-group">
                                                    <input class="form-control bold input-lg" name="title" value="" type="text" placeholder="Advertisement Title" required>
                                                    <span class="input-group-addon"><strong><i class="fa fa-file-text-o"></i></strong></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">Advertise Link</strong></label>
                                            <div class="col-md-12">
                                                <div class="input-group">
                                                    <input class="form-control bold input-lg" name="link" value="" type="text" placeholder="Advertisement Link" required>
                                                    <span class="input-group-addon"><strong><i class="fa fa-bolt"></i></strong></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">Advertise Image</strong></label>
                                            <div class="col-md-12">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="input-group input-large">
                                                        <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                            <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                            <span class="fileinput-filename"> </span>
                                                        </div>
                                                        <span class="input-group-addon btn default btn-file">
                                                                    <span class="fileinput-new bold uppercase"> <i class="fa fa-picture-o"></i> Select image </span>
                                                                    <span class="fileinput-exists bold uppercase"> Change </span>
                                                                    <input type="file" name="val1" required> </span>
                                                        <a href="javascript:;" class="input-group-addon btn red fileinput-exists bold uppercase" data-dismiss="fileinput"> Remove </a>
                                                    </div>
                                                    <code class="bold">Image Size Must be Equal With Ad Size.</code>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">STATUS</strong></label>
                                            <div class="col-md-12">
                                                <input data-toggle="toggle" checked data-onstyle="success" data-size="large" data-offstyle="danger" data-on="Active" data-off="Deactive" data-width="100%" type="checkbox" name="status">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <button class="btn btn-primary btn-block btn-lg bold"><i class="fa fa-send"></i> ADD NEW ADVERT</button>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}

                                    </div>

                                    <div class="tab-pane fade" id="tab_1_2">
                                        {!! Form::open(['method'=>'post','role'=>'form','class'=>'form-horizontal','files'=>true]) !!}

                                        <input type="hidden" name="advert_type" value="2">
                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">Advertise Size</strong></label>
                                            <div class="col-md-12">
                                                <div class="input-group">
                                                    <select name="advert_size" id="" class="form-control bold input-lg" required>
                                                        <option class="bold" value="">Select One</option>
                                                        <option class="bold" value="1">300X600</option>
                                                        <option class="bold" value="2">300X250</option>
                                                        <option class="bold" value="3">728X90</option>
                                                        <option class="bold" value="4">970X90</option>
                                                        {{--<option class="bold" value="5">970X250</option>--}}
                                                    </select>
                                                    <span class="input-group-addon"><strong><i class="fa fa-list"></i></strong></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">Advertise Title</strong></label>
                                            <div class="col-md-12">
                                                <div class="input-group">
                                                    <input class="form-control bold input-lg" name="title" value="" type="text" placeholder="Advertisement Title" required>
                                                    <span class="input-group-addon"><strong><i class="fa fa-file-text-o"></i></strong></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">Advertise Code</strong></label>
                                            <div class="col-md-12">
                                                <textarea name="val2" id="" cols="30" rows="5" class="bold form-control input-lg" required placeholder="Advertise Code"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">STATUS</strong></label>
                                            <div class="col-md-12">
                                                <input data-toggle="toggle" checked data-onstyle="success" data-size="large" data-offstyle="danger" data-on="Active" data-off="Deactive" data-width="100%" type="checkbox" name="status">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary btn-block btn-lg bold"><i class="fa fa-send"></i> ADD GOOGLE ADVERT</button>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div><!---ROW-->

@endsection
@section('scripts')
    <script src="{{ asset('assets/admin/js/bootstrap-toggle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/bootstrap-fileinput.js') }}"></script>
@endsection
