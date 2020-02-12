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


                    {!! Form::model($basic,['route'=>['update-about-text',$basic->id],'method'=>'put','role'=>'form','class'=>'form-horizontal','files'=>true]) !!}
                    <div class="form-body">

                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">

                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">About Story</strong></label>
                                    <div class="col-md-12">
                                        <textarea name="about" id="area1" rows="10" class="form-control" required placeholder="About Story">{{ $basic->about }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">About History</strong></label>
                                    <div class="col-md-12">
                                        <textarea name="about_history" id="area3" rows="10" class="form-control" required placeholder="About History">{{ $basic->about_history }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">About Mission</strong></label>
                                    <div class="col-md-12">
                                        <textarea name="about_mission" id="area2" rows="10" class="form-control" required placeholder="About Mission">{{ $basic->about_mission }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" onclick="nicEditors.findEditor('area1').saveContent();nicEditors.findEditor('area3').saveContent();nicEditors.findEditor('area2').saveContent();" class="btn blue btn-block bold btn-lg uppercase"><i class="fa fa-send"></i> Update</button>
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
    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
    <script type="text/javascript">
        bkLib.onDomLoaded(function() {
            new nicEditor({fullPanel : true}).panelInstance('area1');
            new nicEditor({fullPanel : true}).panelInstance('area2');
            new nicEditor({fullPanel : true}).panelInstance('area3');
        });
    </script>

@endsection
