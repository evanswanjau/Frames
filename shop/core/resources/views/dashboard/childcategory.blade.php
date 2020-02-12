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
                        <button id="btn_add" name="btn_add" class="btn btn-primary bold"><i class="fa fa-plus"></i> New Child Category</button>
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
                            <th>SL</th>
                            <th>Category Name</th>
                            <th>Subcategory Name</th>
                            <th>Child Category Name</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="products-list" name="products-list">
                        @foreach ($childcategory as $key => $product)
                            <tr id="product{{$product->id}}">
                                <td>{{++$key}}</td>
                                <td>{{$product->subcategory->category->name}}</td>
                                <td>{{$product->subcategory->name}}</td>
                                <td>{{$product->name}}</td>
                                <td>
                                    <button class="btn btn-primary btn-detail open_modal bold uppercase" value="{{$product->id}}"><i class="fa fa-edit"></i> EDIT</button>
                                    <button type="button" title="Delete Category" class="btn btn-danger bold uppercase delete_button"
                                            data-toggle="modal" data-target="#DelModal"
                                            data-id="{{ $product->id }}">
                                        <i class='fa fa-trash'></i> DELETE
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {!! $childcategory->links() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 50%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title bold uppercase" id="myModalLabel"><i class="fa fa-indent"></i> Product hildcategory</h4>
                </div>
                <div class="modal-body">
                    <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                        <div class="form-group">
                            <label for="inputName" class="col-sm-4 control-label bold uppercase">Select SubCategory : </label>
                            <div class="col-sm-8">
                                <select class="form-control select2 bold" name="subcategory_id" id="subcategory_id" required style="width: 100%;">
                                    <option class="bold" value="">Select One</option>
                                    @foreach($subcategory as $cat)
                                        <option class="bold" value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-4 control-label bold uppercase">Child Category Name : </label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" class="form-control has-error bold " id="name" name="name" placeholder="Category Name" value="">
                                    <span class="input-group-addon"><strong><i class="fa fa-file-text-o"></i></strong></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary bold uppercase" id="btn-save" value="add"><i class="fa fa-send"></i> Save Category</button>
                    <input type="hidden" id="product_id" name="product_id" value="0">
                </div>
            </div>
        </div>
    </div>
    <meta name="_token" content="{!! csrf_token() !!}" />

    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title bold uppercase" id="myModalLabel"> <i class='fa fa-exclamation-triangle'></i> Confirmation !</h4>
                </div>

                <div class="modal-body">

                    <div class="alert alert-warning" role="alert"><strong>Are you sure you want to Delete This Category. ?</strong></div>
                    <div class="alert alert-warning" role="alert"><strong>Under This Category All Product will be Deleted..!</strong></div>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('child-category-delete') }}" class="form-inline">
                        {!! csrf_field() !!}
                        {!! method_field('delete') !!}
                        <input type="hidden" name="id" class="confirm_id" value="0">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Yes Sure.</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('import_scripts')
    <script src="{{asset('assets/admin/js/select2.full.min.js')}}" type="text/javascript"></script>
@endsection
@section('scripts')

    <script>

        var url = '{{ url('/admin/manage-childcategory') }}';
        //display modal form for product editing
        $(document).on('click','.open_modal',function(){
            var product_id = $(this).val();

            $.get(url + '/' + product_id, function (data) {
                //success data
                console.log(data);
                $('#product_id').val(data.id);
                $('#name').val(data.name);
                $("#subcategory_id").select2().val(data.subcategory_id).trigger("change");
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
                subcategory_id: $('#subcategory_id').val()
            };
            //used to determine the http verb to use [add=POST], [update=PUT]
            var state = $('#btn-save').val();
            var type = "POST"; //for creating new resource
            var product_id = $('#product_id').val();;
            var my_url = url;
            if (state == "update"){
                type = "PUT"; //for updating existing resource
                my_url += '/' + product_id;
            }
            $.ajax({
                type: type,
                url: my_url,
                data: formData,
                dataType: 'json',
                success: function (data) {
                    var product = '<tr id="product' + data.id + '"><td>' + data.id + '</td><td>' + data.categoryName + '</td><td>' + data.subcategoryName + '</td><td>' + data.name + '</td>';
                    product += '<td><button class="btn btn-primary btn-detail open_modal bold uppercase" value="' + data.id + '"><i class="fa fa-edit"></i> EDIT </button>';
                    product += ' <button type="button" title="Delete Category" class="btn btn-danger bold uppercase delete_button" data-toggle="modal" data-target="#DelModal" data-id="' + data.id + '"><i class=\'fa fa-trash\'></i> DELETE</button></td></tr>';

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
                toastr.success('Successfully Category Saved.');
            });
        });
        $(function () {
            $('.select2').select2();
        });

        $(document).ready(function (e) {
            $(document).on("click", '.delete_button', function (e) {
                var id = $(this).data('id');
                $(".confirm_id").val(id);
            });
        });
    </script>
@endsection