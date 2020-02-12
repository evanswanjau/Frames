@extends('layouts.provider')
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

                    <form class="form-horizontal" action="" method="post" role="form">
                        <div class="form-body">

                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="col-md-2 control-label"><strong>Current Password :</strong></label>

                                <div class="col-md-8">
                                    <input class="form-control input-lg" name="current_password" required placeholder="Current Password" type="password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"><strong>New Password :</strong></label>

                                <div class="col-md-8">
                                    <input class="form-control input-lg" name="password" required placeholder="New Password" type="password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"><strong>New Password Again :</strong></label>

                                <div class="col-md-8">
                                    <input class="form-control input-lg" name="password_confirmation" required placeholder="New Password Again" type="password">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-offset-2 col-md-8">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-send"></i> Update Password</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')

@endsection
