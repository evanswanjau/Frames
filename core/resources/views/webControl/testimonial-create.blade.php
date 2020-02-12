@extends('layouts.dashboard')

@section('style')
    <link href="{{ asset('assets/admin/css/bootstrap-fileinput.css') }}" rel="stylesheet">
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


                    {!! Form::open(['method'=>'post','role'=>'form','class'=>'form-horizontal','files'=>true]) !!}
                    <div class="form-body">

                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">

                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Author Name</strong></label>
                                    <div class="col-md-12">
                                        <input name="name" class="form-control input-lg" placeholder="Author Name" required/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Author Details</strong></label>
                                    <div class="col-md-12">
                                        <input name="position" class="form-control input-lg" placeholder="Author Details" required/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Author Image</strong></label>
                                    <div class="col-md-12">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                                <img style="width: 200px" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=Author Image" alt="...">
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                            <div>
                                                <span class="btn btn-info btn-file">
                                                    <span class="fileinput-new bold uppercase"><i class="fa fa-file-image-o"></i> Select image</span>
                                                    <span class="fileinput-exists bold uppercase"><i class="fa fa-edit"></i> Change</span>
                                                    <input type="file" name="image" accept="image/*">
                                                </span>
                                                <a href="#" class="btn btn-danger fileinput-exists bold uppercase" data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Testimonial Message</strong></label>
                                    <div class="col-md-12">
                                        <textarea name="message" id="area1" rows="5" class="form-control" required placeholder="Testimonial Message"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Publication STATUS</strong></label>
                                    <div class="col-md-12">
                                        <input data-toggle="toggle" checked data-onstyle="success" data-offstyle="danger" data-on="Publish" data-off="Pending" data-width="100%" data-size="large" type="checkbox" name="status">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" onclick="nicEditors.findEditor('area1').saveContent();" class="btn btn-primary btn-block bold btn-lg uppercase"><i class="fa fa-send"></i> Create Testimonial</button>
                                    </div>
                                </div>
                            </div>
                        </div><!-- row -->
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div><!---ROW-->


@endsection
@section('scripts')
    <script src="{{ asset('assets/admin/js/bootstrap-fileinput.js') }}"></script>
    <script src="{{ asset('assets/admin/js/bootstrap-toggle.min.js') }}"></script>

@endsection
