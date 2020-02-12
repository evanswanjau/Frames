@extends('layouts.dashboard')
@section('content')


    <div class="row">
        <div class="col-md-12">


            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <div class="box-title">
                        <a href="{{ route('advertisement-new') }}" class="btn btn-primary"><strong><i class="fa fa-plus"></i> CREATE NEW ADVERTISEMENT</strong></a>
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

                    <table class="table table-striped table-hover table-bordered bold datatable" id="table-4">
                        <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Advert Type</th>
                            <th>Advert Size</th>
                            <th>Advert View</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($advert as $key => $cat)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>
                                    @if($cat->advert_type == 1)
                                        <span class="label label-primary bold"><i class="fa fa-check"></i> Own Advertisement</span>
                                    @else
                                        <span class="label label-success bold"><i class="fa fa-google"></i> Google Advertisement</span>
                                    @endif
                                </td>
                                <td>
                                    @if($cat->advert_size == 1)
                                        <span class="label label-primary bold"><i class="fa fa-arrows"></i> 300X600</span>
                                    @elseif($cat->advert_size == 2)
                                        <span class="label label-primary bold"><i class="fa fa-arrows"></i> 300X250</span>
                                    @elseif($cat->advert_size == 3)
                                        <span class="label label-primary bold"><i class="fa fa-arrows"></i> 728X90</span>
                                    @elseif($cat->advert_size == 4)
                                        <span class="label label-primary bold"><i class="fa fa-arrows"></i> 970X90</span>
                                    @elseif($cat->advert_size == 5)
                                        <span class="label label-primary bold"><i class="fa fa-arrows"></i> 970X250</span>
                                    @endif
                                </td>
                                <td>{{ $cat->hit }} - Views</td>
                                <td>
                                    @if($cat->status == 0)
                                        <span class="label label-danger bold"><i class="fa fa-times"></i> Deactive</span>
                                    @else
                                        <span class="label label-primary bold"><i class="fa fa-check"></i> Active</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('advertisement-edit',$cat->id) }}" class="btn btn-primary bold uppercase btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div><!---ROW-->


@endsection
