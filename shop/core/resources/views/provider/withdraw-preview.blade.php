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
                        <div class="col-md-4">

                            <div class="box box-primary box-solid">
                                <div class="box-header with-border">
                                    <h4 class="card-title text-center" id="horz-layout-basic">Withdraw Method</h4>
                                </div>
                                <div class="box-body pad">
                                        <div class="card box-shadow-0">
                                            <div class="card-content collpase show">
                                                <div class="card-body text-center">
                                                    <h3 class="text-uppercase font-weight-bold text-center" id="horz-layout-basic">{{$method->name}}</h3>
                                                    <br>
                                                    <img src="{{ asset('assets/images/withdraw') }}/{{$method->image}}" style="width:100%;" alt="">
                                                    <br>
                                                    <br>
                                                    <a href="{{ route('provider-withdraw-now') }}" class="btn btn-primary btn-block"><i class="fa fa-long-arrow-left"></i> Another Method</a>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="box box-primary box-solid">
                                <div class="box-header with-border">
                                    <h4 class="card-title text-center" id="horz-layout-basic">{{$page_title}}</h4>
                                </div>
                                <div class="box-body pad">

                                        <h3 class="text-center">Current Balance : {{ $user->balance }} {{ $basic->currency }}</h3>

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-8 col-md-offset-2 col-sm-12">

                                                {!! Form::open(['route'=>'provider-withdraw-confirm', 'method'=>'post', 'role'=>'form', 'class'=>'form-horizontal', 'files'=>true]) !!}

                                                <input type="hidden" name="method_id" value="{{$method->id}}">

                                                <fieldset style="width: 100%;margin-bottom: 10px;">
                                                    <div class="input-group">
                                            <span class="input-group-btn">
                                               <button class="btn btn-success text-uppercase" type="button">Current Balance</button>
                                            </span>
                                                        <input type="text" class="form-control text-center" value="{{ $user->balance }}" placeholder="Withdraw Charge" readonly>
                                                        <span class="input-group-btn">
                                                <button class="btn btn-success text-uppercase" type="button">{{ $basic->currency }}</button>
                                            </span>
                                                    </div>
                                                </fieldset>

                                                <fieldset style="width: 100%;margin-bottom: 10px;">
                                                    <div class="input-group">
                                            <span class="input-group-btn">
                                               <button class="btn btn-success text-uppercase" type="button">Withdraw Charge</button>
                                            </span>
                                                        <input type="text" class="form-control text-center" value="{{ $method->charge }}" placeholder="Withdraw Charge" readonly>
                                                        <span class="input-group-btn">
                                                <button class="btn btn-success text-uppercase" type="button">{{ $basic->currency }}</button>
                                            </span>
                                                    </div>
                                                </fieldset>

                                                <fieldset style="width: 100%;margin-bottom: 10px;">
                                                    <div class="input-group">
                                            <span class="input-group-btn">
                                               <button class="btn btn-success text-uppercase" type="button">Can Withdraw</button>
                                            </span>
                                                        @if($user->balance < $method->charge)
                                                            <input type="text" class="form-control text-center" value="Can't Withdraw" placeholder="Withdraw Charge" readonly>
                                                        @else
                                                            <input type="text" id="avail_amount" class="form-control text-center" value="{{  $user->balance - $method->charge }}" placeholder="Withdraw Charge" readonly>
                                                        @endif
                                                        <span class="input-group-btn">
                                                <button class="btn btn-success text-uppercase" type="button">{{ $basic->currency }}</button>
                                            </span>
                                                    </div>
                                                </fieldset>

                                                <fieldset style="width: 100%;margin-bottom: 10px;">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="input-group">
                                                    <span class="input-group-btn">
                                                       <button class="btn btn-success text-uppercase" type="button">Minimum</button>
                                                    </span>
                                                                <input type="text" class="form-control text-center" id="min" value="{{ $method->withdraw_min }}" placeholder="Withdraw Charge" readonly>
                                                                <span class="input-group-btn">
                                                        <button class="btn btn-success text-uppercase" type="button">{{ $basic->currency }}</button>
                                                    </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="input-group">
                                                    <span class="input-group-btn">
                                                       <button class="btn btn-success text-uppercase" type="button">Maximum</button>
                                                    </span>
                                                                <input type="text" class="form-control text-center" id="max" value="{{ $method->withdraw_max }}" placeholder="Withdraw Charge" readonly>
                                                                <span class="input-group-btn">
                                                        <button class="btn btn-success text-uppercase" type="button">USD</button>
                                                    </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </fieldset>

                                                <fieldset style="width: 100%;margin-bottom: 10px;">
                                                    <div class="input-group">
                                            <span class="input-group-btn">
                                               <button class="btn btn-success text-uppercase" type="button">Withdraw Amount</button>
                                            </span>
                                                        @if($user->balance < $method->charge)
                                                            <input type="text" class="form-control text-center" value="Can't Withdraw" placeholder="Withdraw Charge" readonly>
                                                        @else
                                                            <input type="text" name="amount" id="amount" class="form-control text-center" value="" placeholder="Withdraw Amount" required>
                                                        @endif
                                                        <span class="input-group-btn">
                                                <button class="btn btn-success text-uppercase" type="button">{{ $basic->currency }}</button>
                                            </span>
                                                    </div>
                                                </fieldset>

                                                <div id="withdrawDetails" style="display: none">
                                                    <fieldset style="width: 100%;margin-bottom: 10px;">
                                                        <label for="basicTextarea"><b>{{$method->name}} - Sending Details</b></label>
                                                        <textarea name="details" class="form-control font-weight-bold" id="basicTextarea" rows="3" placeholder="{{$method->name}} - Sending Details" required></textarea>
                                                    </fieldset>
                                                </div>

                                                <fieldset style="width: 100%;margin-bottom: 10px;">
                                                    <button type="submit" id="withdrawButton" disabled class="btn btn-primary btn-lg btn-block text-uppercase"><i class="ft-upload-cloud"></i> Withdraw Now</button>
                                                </fieldset>


                                                {!! Form::close() !!}

                                            </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $( document ).ready(function() {
            $(document).on("blur", '#amount', function (e) {
                var av = $('#avail_amount').val();
                var amount = $('#amount').val();
                var min = $('#min').val();
                var max = $('#max').val();

                var url = '{{ url('/provider/') }}';

                $.get(url + '/check-withdraw/' + av +'/'+ amount +'/'+ min +'/'+ max,function (data) {
                    var result = $.parseJSON(data);

                    if (result['errorStatus'] == "yes"){
                        document.getElementById('withdrawDetails').style.display = 'none';
                        toastr.warning(result['errorDetails']);
                    }else{
                        toastr.info(result['errorDetails']);
                        document.getElementById("withdrawButton").disabled = false;
                        document.getElementById('withdrawDetails').style.display = 'block';
                    }
                });

            });
        });
    </script>
@endsection