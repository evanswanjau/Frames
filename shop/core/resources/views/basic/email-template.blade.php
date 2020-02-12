@extends('layouts.dashboard')
@section('style')
    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>

    <script type="text/javascript">
        bkLib.onDomLoaded(function() { new nicEditor({fullPanel : true}).panelInstance('area1'); });
    </script>

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

            <div class="row">

                <div class="col-md-12">
                    <!-- BEGIN SAMPLE TABLE PORTLET-->
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-info-circle"></i> Short Code</h3>
                            <!-- tools box -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body pad">
                            <div class="table-scrollable">
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> CODE </th>
                                        <th> DESCRIPTION </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <td> 1 </td>
                                        <td> <pre>@{{message}}</pre> </td>
                                        <td> Details Text From Script</td>
                                    </tr>
                                    <tr>
                                        <td> 2 </td>
                                        <td> <pre>@{{name}}</pre> </td>
                                        <td> Users Name. Will Pull From Database and Use in EMAIL text</td>
                                    </tr>
                                    <tr>
                                        <td> 3 </td>
                                        <td> <pre>@{{site_title}}</pre> </td>
                                        <td> Site_title. Will Pull From Database and Use in EMAIL text</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- END SAMPLE TABLE PORTLET-->
                </div>

                <div class="col-md-12">
                    <!-- BEGIN SAMPLE TABLE PORTLET-->

                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-info-circle"></i> Email Template</h3>
                            <!-- tools box -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body pad">

                            <form class="form-horizontal" action="{{ route('email-template') }}" method="post" role="form">
                                {!! csrf_field() !!}
                                <div class="form-body">

                                    <div class="form-group">
                                        <label class="control-label"><strong style="text-transform: uppercase;margin-left: 15px;">Email Template</strong><br></label>
                                        <div class="col-md-12">
                                            <textarea id="area1" class="form-control" rows="5" name="email_body">{{ $basic->email_body }}</textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary btn-block btn-lg"><i class="fa fa-send"></i> UPDATE</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection
