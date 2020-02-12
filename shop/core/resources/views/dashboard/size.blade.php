@extends('layouts.dashboard')
@section('import_style')
    <link href="{{asset('assets/admin/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('style')
    <style>
        td{
            font-weight: bold;
            font-size: 14px;
        }
        .select2-selection,.select2-results{
            font-weight: bold !important;
        }
    </style>
@endsection
@section('content')


    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <div class="box-title">
                        <button id="btn_add" name="btn_add" class="btn btn-primary bold"><i class="fa fa-plus"></i> Add New Size</button>
                    </div>
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-primary btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                    <!-- /. tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body pad">

                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Size For</th>
                            <th>Size Name</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="products-list" name="products-list">
                        @foreach ($size as $product)
                            <tr id="product{{$product->id}}">
                                <td>{{$product->id}}</td>
                                <td>{{$product->category->name}}</td>
                                <td>{{$product->name}}</td>
                                <td>
                                    <button class="btn btn-primary btn-detail open_modal bold uppercase" value="{{$product->id}}"><i class="fa fa-edit"></i> EDIT Size</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title bold uppercase" id="myModalLabel"><i class="fa fa-arrows-v"></i> Product Size</h4>
                </div>
                <div class="modal-body">
                    <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 control-label bold uppercase">Size For : </label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <select class="form-control select2 bold" name="category_id" id="category_id" required style="width: 100%;">
                                        <option class="bold" value="">Select One</option>
                                        @foreach($category as $p)
                                            <option class="bold" value="{{ $p->id }}">{{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-addon"><strong><i class="fa fa-indent"></i></strong></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 control-label bold uppercase">Size Name : </label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" class="form-control has-error bold " id="name" name="name" placeholder="Size Name" value="">
                                    <span class="input-group-addon"><strong><i class="fa fa-file-text-o"></i></strong></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-8 col-sm-offset-3">
                                <button type="button" class="btn btn-primary btn-block bold uppercase" id="btn-save" value="add"><i class="fa fa-send"></i> Save Size</button>
                                <input type="hidden" id="product_id" name="product_id" value="0">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <meta name="_token" content="{!! csrf_token() !!}" />
@endsection

@section('import_scripts')
    <script src="{{asset('assets/admin/js/select2.full.min.js')}}" type="text/javascript"></script>
@endsection
@section('scripts')

    <script>

        var url = '{{ url('/admin/manage-size') }}';
        //display modal form for product editing
        $(document).on('click','.open_modal',function(){
            var product_id = $(this).val();

            $.get(url + '/' + product_id, function (data) {
                //success data
                console.log(data);
                $('#product_id').val(data.id);
                $("#category_id").select2().val(data.category_id).trigger("change");
                $('#name').val(data.name);
                $('#btn-save').val("update");
                $('#myModal').modal('show');
            })
        });
        //display modal form for creating new product
        $('#btn_add').click(function(){
            $('#btn-save').val("add");
            $('#frmProducts').trigger("reset");
            $('#myModal').modal('show');
        });
        //create new product / update existing product
        $("#btn-save").click(function (e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            })
            e.preventDefault();
            var formData = {
                name: $('#name').val(),
                category_id: $('#category_id').val()
            }
            //used to determine the http verb to use [add=POST], [update=PUT]
            var state = $('#btn-save').val();
            var type = "POST"; //for creating new resource
            var product_id = $('#product_id').val();
            var my_url = url;
            if (state == "update"){
                type = "PUT"; //for updating existing resource
                my_url += '/' + product_id;
            }
            console.log(formData);
            $.ajax({
                type: type,
                url: my_url,
                data: formData,
                dataType: 'json',
                success: function (data) {
                    var product = '<tr id="product' + data.id + '"><td>' + data.id + '</td><td>' + data.categoryName + '</td><td>' + data.name + '</td>';
                    product += '<td><button class="btn btn-primary btn-detail open_modal bold uppercase" value="' + data.id + '"><i class="fa fa-edit"></i> EDIT Size</button></td></tr>';

                    if (state == "add"){ //if user added a new record
                        $('#products-list').append(product);
                    }else{ //if user updated an existing record
                        $("#product" + product_id).replaceWith( product );
                    }
                    $('#frmProducts').trigger("reset");
                    $('#myModal').modal('hide')
                },
                error: function(data)
                {
                    $.each( data.responseJSON.errors, function( key, value ) {
                        toastr.error( value);
                    });
                }
            }).done(function() {
                toastr.success('Successfully Size Saved.');
            });
        });
        $(function () {
            $('.select2').select2();
        });
    </script>
@endsection