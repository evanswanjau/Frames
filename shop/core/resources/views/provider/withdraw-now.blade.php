@extends('layouts.provider')
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

                            <div class="row">
                                @foreach($method as $pm)
                                    <div class="col-md-3">
                                        <div class="box box-primary box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title"><i class="fa fa-info-circle"></i> {{$pm->name}}</h3>
                                            </div>
                                            <div class="box-body pad">
                                                    <br>
                                                    <img src="{{ asset('assets/images/withdraw') }}/{{$pm->image}}" style="width:100%;" alt="">
                                                    <br>
                                                    <br>
                                                        <a href="{{ route('provider-withdraw-method',$pm->id) }}" class="btn btn-primary btn-block text-uppercase">Withdraw Now</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection