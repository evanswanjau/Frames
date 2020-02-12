@extends('layouts.dashboard')
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

                    {!! Form::open(['class'=>'form form-horizontal']) !!}

                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Email Driver </strong></label>
                                    <div class="col-md-12">
                                        <select name="driver" id="driver" class="form-control">
                                            @if($driver == 'mail')
                                                <option value="mail" selected>PHP Mailer</option>
                                                <option value="smtp">SMTP Mailer</option>
                                            @else
                                                <option value="mail">PHP Mailer</option>
                                                <option value="smtp" selected>SMTP Mailer</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div id="smtp" style="display: {{ $driver == 'smtp' ? 'block' : 'none' }}">
                                    <hr>

                                    <label><strong style="text-transform: uppercase;">SMTP Status : </strong>
                                        @if($smtp)
                                            <strong style="text-transform: uppercase;" class="su"> (<i class="fa fa-check"></i>Verified)</strong>
                                        @else
                                            <strong style="text-transform: uppercase;" class="red"> (<i class="fa fa-times"></i>Not Verified)</strong>
                                        @endif
                                    </label>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">SMTP Host </strong></label>
                                        <div class="col-md-12">
                                            <input name="host" value="{{ $host }}" class="form-control input-lg" placeholder="SMTP Host"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">SMTP Host Port </strong></label>
                                        <div class="col-md-12">
                                            <input name="port" value="{{ $port }}" class="form-control input-lg" placeholder="SMTP Host Port"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">SMTP Username </strong></label>
                                        <div class="col-md-12">
                                            <input name="username" value="{{ $username }}" class="form-control input-lg" placeholder="SMTP Username"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">SMTP Password </strong></label>
                                        <div class="col-md-12">
                                            <input name="pass" value="{{ $password }}" class="form-control input-lg" placeholder="SMTP Password" type="text"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">SMTP Encryption </strong></label>
                                        <div class="col-md-12">
                                            <input name="encryption" value="{{ $enc }}" class="form-control input-lg" placeholder="SMTP Encryption"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-block bold btn-lg text-uppercase"><i class="fa fa-send"></i> Update Setting</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>



@endsection
@section('scripts')
    <script>
        $("#driver").on('change',function(e){
            e.preventDefault();
            if($(this).val()== 'smtp'){
                $('#smtp').show();
            }else{
                $('#smtp').hide();
            }
        });
    </script>
@endsection