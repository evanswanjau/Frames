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
                    <a href="{{ route('manual-payment-method') }}" class="btn btn-primary bold"><i class="fa fa-th-list"></i> View Manual Gateway</a>
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-primary btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                    <!-- /. tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body pad">

                    {!! Form::open(['method'=>'post', 'role'=>'form', 'class'=>'form-horizontal', 'files'=>true]) !!}

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-3 text-right control-label bold uppercase">Gateway Image : </label>
                        <div class="col-sm-8">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 250px; height: 140px;" data-trigger="fileinput">
                                    <img style="width: 250px" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=Gateway Image" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 250px; max-height: 140px"></div>
                                <div>
                                    <span class="btn btn-info btn-file">
                                        <span class="fileinput-new bold uppercase"><i class="fa fa-file-image-o"></i> Select image</span>
                                        <span class="fileinput-exists bold uppercase"><i class="fa fa-edit"></i> Change</span>
                                        <input type="file" id="image" name="image" accept="image/*" required>
                                    </span>
                                    <a href="#" class="btn btn-danger fileinput-exists bold uppercase" data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                                </div>
                                <b style="color: red;">Image Type PNG,JPEG,JPG. Resize - (290X190)</b><br>
                            </div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="inputName" class="col-sm-3 text-right control-label bold uppercase">Gateway Name : </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control has-error bold " id="name" name="name" placeholder="Gateway Name (eg: Bank Name)" required value="">
                        </div>
                    </div>



                    <div class="form-group row">
                        <label for="inputName" class="col-sm-3 text-right control-label bold uppercase">Conversion Rate : </label>
                        <div class="col-sm-8">
                            <div class="input-group mb-0">
                                <span class="input-group-addon"><strong>1 USD = </strong></span>
                                <input class="form-control" name="rate" value="" type="text" required>
                                <span class="input-group-addon"><strong>{{ $basic->currency }}</strong></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-3 text-right control-label bold uppercase">Fixed (Charge) : </label>
                        <div class="col-sm-8">
                            <div class="input-group mb-0">
                                <input class="form-control" name="fix" value="" placeholder="Fixed Charge" type="text" required>
                                <span class="input-group-addon"><strong>{{ $basic->currency }}</strong></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-3 text-right control-label bold uppercase">Percentage (Charge) : </label>
                        <div class="col-sm-8">
                            <div class="input-group mb-0">
                                <input class="form-control" name="percent" value="" placeholder="Percentage" type="text" required>
                                <span class="input-group-addon"><strong><i class="fa fa-percent"></i></strong></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-3 text-right control-label bold uppercase">Payment Description : </label>
                        <div class="col-sm-8">
                            <textarea class="form-control has-error bold description" rows="5" id="description" name="val1" placeholder="Payment Description (eg: Bank Payment Details)" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-3 text-right control-label bold uppercase">Gateway Status : </label>
                        <div class="col-sm-8">
                            <input data-toggle="toggle" checked data-onstyle="success" data-offstyle="danger" data-on="ENABLE" data-off="DISABLE" data-width="100%" type="checkbox" name="status">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-8 col-sm-offset-3">
                            <button type="submit" class="btn btn-primary btn-lg btn-block bold uppercase" id="btn-save" value="add"><i class="fa fa-send"></i> Create Gateway</button>
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>



@endsection
@section('scripts')
    <script src="{{ url('core/vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
    <script src="{{ asset('assets/admin/js/bootstrap-fileinput.js') }}"></script>
    <script src="{{ asset('assets/admin/js/bootstrap-toggle.min.js') }}"></script>
@stop
