@extends('layouts.dashboard')

@section('style')

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


                    {!! Form::model($basic,['route'=>['update-provider-portion',$basic->id],'method'=>'put','role'=>'form','class'=>'form-horizontal','files'=>true]) !!}
                    <div class="form-body">

                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">

                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Portion Main Title</strong></label>
                                    <div class="col-md-12">
                                        <input name="provider_title" class="form-control input-lg" value="{{ $basic->provider_title }}" placeholder="Portion Main Title" required/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Portion Subtitle</strong></label>
                                    <div class="col-md-12">
                                        <input name="provider_subtitle" class="form-control input-lg" value="{{ $basic->provider_subtitle }}" placeholder="Portion Subtitle" required/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-block bold btn-lg uppercase"><i class="fa fa-send"></i> Update</button>
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


@endsection
