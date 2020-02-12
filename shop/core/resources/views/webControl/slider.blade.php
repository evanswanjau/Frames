@extends('layouts.dashboard')
@section('title', 'Slider')
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

                    {!! Form::open(['method'=>'post','files'=>true,'class'=>'form-horizontal']) !!}
                    <div class="form-body">

                        <div class="form-group">
                            <label class="col-sm-3 control-label bold uppercase">Slider Main Title : </label>
                            <div class="col-sm-6">
                                <input name="main_title" type="text" placeholder="Slider Main Title" class="form-control input-lg" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label bold uppercase">Slider SubTitle : </label>
                            <div class="col-sm-6">
                                <input name="sub_title" type="text" placeholder="Slider SubTitle" class="form-control input-lg" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label bold uppercase">Short SubTitle : </label>
                            <div class="col-sm-6">
                                <input name="short_title" type="text" placeholder="Short SubTitle" class="form-control input-lg" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label bold uppercase">Slider Image : </label>
                            <div class="col-sm-6">
                                <input name="image" type="file" class="form-control input-lg" required />
                                <code><b style="color:red; font-weight: bold;margin-top: 10px">ONE IMAGE ONLY | Image Will Resized to 1920 x 620 </b></code>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-offset-3 col-md-6">
                                <button type="submit" class="btn btn-primary btn-lg btn-block margin-top-10"><i class="fa fa-send"></i> Save Slider</button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div><!---ROW-->
    <hr>
    <div class="row">
        @foreach($slider as $s)
            <div class="col-md-6">
                <div class="images">
                    <img class="img-responsive" src="{{ asset('assets/images/slider') }}/{{ $s->image }}" alt="" style="margin-top: 20px;margin-bottom: 10px">
                    <div>
                        <strong>Main Title : {{ $s->main_title }}</strong><br>
                        <strong>Sub Title : {{ $s->sub_title }}</strong><br>
                        <strong>Short Title : {{ $s->short_title }}</strong><br>
                    </div>
                    <br>
                    <button type="button" class="btn btn-danger btn-block btn-lg delete_button"
                            data-toggle="modal" data-target="#DelModal"
                            data-id="{{ $s->id }}">
                        <i class='fa fa-trash'></i> Delete Slider
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal for DELETE -->
    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-trash'></i> Delete !</h4>
                </div>

                <div class="modal-body">
                    <strong>Are you sure you want to Delete ?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('slider-delete') }}" class="form-inline">
                        {!! csrf_field() !!}
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="id" class="abir_id" value="0">

                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> DELETE</button>
                    </form>
                </div>

            </div>
        </div>
    </div>


@endsection
@section('scripts')

    <script>
        $(document).ready(function () {

            $(document).on("click", '.delete_button', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);
            });
        });
    </script>

@endsection

