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

                    <div class="row">
                        {!! Form::open(['files'=>true]) !!}
                        <div class="col-md-3">
                            <div class="box box-primary box-solid">
                                <div class="box-header with-border">
                                    <div class="box-title uppercase bold"><i class="fa fa-edit"></i> Change Logo</div>
                                </div>
                                <div class="box-body pad">

                                    <div class="row">

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: auto;" data-trigger="fileinput">
                                                        <img style="width: 200px" src="{{ asset('assets/images/logo.png') }}" alt="logo">
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 60px"></div>
                                                    <div>
                                                    <span class="btn btn-info btn-file">
                                                        <span class="fileinput-new bold uppercase"><i class="fa fa-file-image-o"></i> Update Logo</span>
                                                        <span class="fileinput-exists bold uppercase"><i class="fa fa-edit"></i> Change</span>
                                                        <input type="file" name="logo" accept="image/*">
                                                    </span>
                                                        <a href="#" class="btn btn-danger fileinput-exists bold uppercase" data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                                                    </div>
                                                    <code>Logo Must be Type of PNG</code>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                        </div>
                                        <br>
                                        <br>
                                        <br>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="box box-primary box-solid">
                                <div class="box-header with-border">
                                    <div class="box-title uppercase bold"><i class="fa fa-edit"></i> Change Favicon</div>
                                </div>
                                <div class="box-body pad">

                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail" style="width: 60px; height: auto;" data-trigger="fileinput">
                                                        <img style="width: 60px" src="{{ asset('assets/images/favicon.png') }}" alt="logo">
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 120px; max-height: 120px"></div>
                                                    <div>
                                                    <span class="btn btn-info btn-file">
                                                        <span class="fileinput-new bold uppercase"><i class="fa fa-file-image-o"></i> Update Favicon</span>
                                                        <span class="fileinput-exists bold uppercase"><i class="fa fa-edit"></i> Change</span>
                                                        <input type="file" name="favicon" accept="image/*">
                                                    </span>
                                                        <a href="#" class="btn btn-danger fileinput-exists bold uppercase" data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                                                    </div>
                                                    <code>Favicon Must be Type of PNG</code>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="box box-primary box-solid">
                                <div class="box-header with-border">
                                    <div class="box-title uppercase bold"><i class="fa fa-edit"></i> Change Preloader</div>
                                </div>
                                <div class="box-body pad">

                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail" style="width: 60px; height: auto;" data-trigger="fileinput">
                                                        <img style="width: 60px" src="{{ asset('assets/images/loader.gif') }}" alt="logo">
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 120px; max-height: 120px"></div>
                                                    <div>
                                                    <span class="btn btn-info btn-file">
                                                        <span class="fileinput-new bold uppercase"><i class="fa fa-file-image-o"></i> Update Favicon</span>
                                                        <span class="fileinput-exists bold uppercase"><i class="fa fa-edit"></i> Change</span>
                                                        <input type="file" name="loader" accept="image/*">
                                                    </span>
                                                        <a href="#" class="btn btn-danger fileinput-exists bold uppercase" data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                                                    </div>
                                                    <code>Favicon Must be GIF</code>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="box box-primary box-solid">
                                <div class="box-header with-border">
                                    <div class="box-title uppercase bold"><i class="fa fa-edit"></i> Change Footer Logo</div>
                                </div>
                                <div class="box-body pad">

                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: auto;" data-trigger="fileinput">
                                                        <img style="width: 200px" src="{{ asset('assets/images/footer-logo.png') }}" alt="logo">
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 60px"></div>
                                                    <div>
                                                    <span class="btn btn-info btn-file">
                                                        <span class="fileinput-new bold uppercase"><i class="fa fa-file-image-o"></i> Update Footer Logo</span>
                                                        <span class="fileinput-exists bold uppercase"><i class="fa fa-edit"></i> Change</span>
                                                        <input type="file" name="footer-logo" accept="image/*">
                                                    </span>
                                                        <a href="#" class="btn btn-danger fileinput-exists bold uppercase" data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                                                    </div>
                                                    <code>Footer Logo Must be Type of PNG</code>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                        </div>
                                        <br>
                                        <br>
                                        <br>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-lg bold btn-block"><i class="fa fa-send"></i> UPDATE</button>
                        </div>
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('assets/admin/js/bootstrap-fileinput.js') }}"></script>
@endsection
