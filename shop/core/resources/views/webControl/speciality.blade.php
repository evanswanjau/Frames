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

                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID#</th>
                            <th>Speciality Title</th>
                            <th>Speciality Subtitle</th>
                            <th>Speciality Image</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody id="products-list" name="products-list">
                        @foreach ($speciality as $product)
                            <tr id="product{{$product->id}}">
                                <td>{{$product->id}}</td>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->subtitle }}</td>
                                <td>
                                    <img style="width: 170px" class="img-responsive" src="{{ asset('assets/images/speciality') }}/{{ $product->image }}">
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-detail open_modal bold uppercase" value="{{$product->id}}"><i class="fa fa-edit"></i> EDIT Speciality</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <hr>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="box box-primary box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title uppercase bold"><i class="fa fa-send"></i> CHANGE Speciality</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body pad">

                                    {!! Form::open(['route'=>'update-speciality-bg','method'=>'post','files'=>true]) !!}

                                    <div class="row">

                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">Change Speciality</strong></label>
                                            <div class="col-sm-12">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="input-group input-large">
                                                        <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                            <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                            <span class="fileinput-filename"> </span>
                                                        </div>
                                                        <span class="input-group-addon btn default btn-file">
                                                                    <span class="fileinput-new bold"> Change Speciality </span>
                                                                    <span class="fileinput-exists bold"> Change </span>
                                                                    <input type="file" name="image"> </span>
                                                        <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                    </div>
                                                    <code>Speciality Mimes Type : png,jpeg,jpg | Resize 1172X110</code>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12"> <button type="submit" class="btn btn-primary bold btn-block"><i class="fa fa-send"></i> UPDATE</button></div>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="box box-primary box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title uppercase bold"><i class="fa fa-photo"></i> Current Image</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body pad">
                                    <img class="img-responsive" src="{{ asset('assets/images/speciality') }}/{{ $basic->speciality_bg }}" alt="logo">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- ROW-->

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title bold uppercase" id="myModalLabel"><i class="fa fa-indent"></i> Manage Speciality</h4>
                </div>
                <div class="modal-body">
                    <form id="frmProducts" action="{{ route('update-speciality') }}" method="post" name="frmProducts" class="form-horizontal" novalidate="" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 control-label bold uppercase">Title : </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control has-error bold " id="title" name="title" placeholder="Title" value="">
                                    <span class="input-group-addon"><strong><i class="fa fa-file-text-o"></i></strong></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 control-label bold uppercase">Subtitle : </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control has-error bold " id="subtitle" name="subtitle" placeholder="Title" value="">
                                    <span class="input-group-addon"><strong><i class="fa fa-file-text-o"></i></strong></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 control-label bold uppercase">Image : </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="file" class="form-control has-error bold" id="image" name="image">
                                    <span class="input-group-addon"><strong><i class="fa fa-file-photo-o"></i></strong></span>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="product_id" name="product_id" value="0">
                        <div class="form-group">
                            <div class="col-sm-9 col-lg-offset-3">
                                <button type="submit" class="btn btn-primary btn-block bold uppercase" id="btn-save" value="add"><i class="fa fa-send"></i> Update Speciality</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <meta name="_token" content="{!! csrf_token() !!}" />

@endsection
@section('scripts')
    <script src="{{ asset('assets/admin/js/bootstrap-fileinput.js') }}"></script>
    <script>

        var url = '{{ url('/admin/manage-speciality') }}';
        //display modal form for product editing
        $(document).on('click','.open_modal',function(){
            var product_id = $(this).val();

            $.get(url + '/' + product_id, function (data) {
                //success data
                console.log(data);
                $('#product_id').val(data.id);
                $('#title').val(data.title);
                $('#subtitle').val(data.subtitle);
                $('#btn-save').val("update");
                $('#myModal').modal('show');
            })
        });

    </script>

@endsection
