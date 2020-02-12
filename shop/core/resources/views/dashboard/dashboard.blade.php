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


                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-area-chart"></i> Site Statistic</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body pad">

                            <div class="row">
                                <div class="col-lg-3 col-xs-6">
                                    <!-- small box -->
                                    <a href="{{ route('all-product') }}">
                                    <div class="small-box bg-purple-gradient">
                                        <div class="inner">
                                            <h3>{{ $totalProduct }}<span>+</span></h3>
                                            <p>Total Product</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-diamond"></i>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-xs-6">
                                    <!-- small box -->
                                    <a href="{{ route('manage-category') }}">
                                    <div class="small-box bg-aqua-gradient">
                                        <div class="inner">
                                            <h3>{{ $totalCategory }}<span>+</span></h3>
                                            <p>Total Category</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-list"></i>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-xs-6">
                                    <!-- small box -->
                                    <a href="{{ route('manage-subcategory') }}">
                                    <div class="small-box bg-teal-gradient">
                                        <div class="inner">
                                            <h3>{{ $totalSubCategory }}<span>+</span></h3>
                                            <p>Total Subcategory</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-list"></i>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-xs-6">
                                    <!-- small box -->
                                    <a href="{{ route('manage-childcategory') }}">
                                    <div class="small-box bg-blue-gradient">
                                        <div class="inner">
                                            <h3><span class="counter">{{ $totalChildCategory }}</span></h3>
                                            <p>Total ChildCategory</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-list"></i>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <!-- ./col -->
                            </div>
                        </div>
                    </div>
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-pie-chart"></i> Order Statistic</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body pad">

                            <div class="row">
                                <div class="col-lg-3 col-xs-6">
                                    <!-- small box -->
                                    <a href="{{ route('all-product') }}">
                                    <div class="small-box bg-purple-gradient">
                                        <div class="inner">
                                            <h3>{{ $totalOrder }}<span>+</span></h3>
                                            <p>Total Order</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-shopping-cart"></i>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-xs-6">
                                    <!-- small box -->
                                    <a href="{{ route('order-confirm') }}">
                                    <div class="small-box bg-aqua-gradient">
                                        <div class="inner">
                                            <h3>{{ $confirmOrder }}<span>+</span></h3>
                                            <p>Confirm Order</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-check"></i>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-xs-6">
                                    <!-- small box -->
                                    <a href="{{ route('pending-order') }}">
                                    <div class="small-box bg-yellow-gradient">
                                        <div class="inner">
                                            <h3>{{ $pendingOrder }}<span>+</span></h3>
                                            <p>Pending Order</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-spinner"></i>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-xs-6">
                                    <!-- small box -->
                                    <a href="{{ route('cancel-order') }}">
                                    <div class="small-box bg-red-gradient">
                                        <div class="inner">
                                            <h3><span class="counter">{{ $cancelOrder }}</span></h3>
                                            <p>Cancel Order</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-times"></i>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <!-- ./col -->
                            </div>
                        </div>
                    </div>
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-line-chart"></i> Last 20 Days Order Chart</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body pad">

                            <div class="row">
                                <div class="col-md-12">
                                    <!-- small box -->
                                    <div class="small-box">
                                        <canvas id="lineChart" style="width: auto; height: auto"></canvas>
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

    <script type="text/javascript" src="{{ asset('assets/admin/js/Chart.min.js') }}"></script>

    <script language="JavaScript">
        displayLineChart();
        function displayLineChart() {
            var data = {
                labels: [
                    @foreach($dL as $l)
                    '{{ $l }}',
                    @endforeach
                ],
                datasets: [
                    {
                        label: "Prime and Fibonacci",
                        fillColor: "#3dbcff",
                        strokeColor: "#0099ff",
                        pointColor: "rgba(220,220,220,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: [
                            @foreach($dV as $d)
                                '{{ $d }}',
                            @endforeach
                        ]
                    }
                ]
            };
            var ctx = document.getElementById("lineChart").getContext("2d");
            var options = {
                responsive: true
            };
            var lineChart = new Chart(ctx).Line(data, options);
        }
    </script>
@endsection