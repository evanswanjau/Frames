<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $site_title }} | {{ $page_title }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/font-awesome.min.css') }}">
    @yield('import_style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/skin-blue.min.css') }}">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" />
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    @yield('style')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><img src="{{ asset('assets/images/logo.png') }}" alt="Logo" width="50px"></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><img src="{{ asset('assets/images/logo.png') }}" alt="Logo" width="200px" height="45px"></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('assets/images') }}/{{ Auth::user()->image }}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="{{ asset('assets/images') }}/{{ Auth::user()->image }}" class="img-circle" alt="User Image">
                                <p>
                                    {{ Auth::user()->name }}
                                    <small>Member since {{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('F, Y') }}</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ route('edit-profile') }}" class="btn btn-default btn-flat"><i class="fa fa-edit"></i> Profile</a>
                                </div>
                                <div class="pull-left" style="padding-left:4px">
                                    <a href="{{ route('admin-change-password') }}" class="btn btn-default btn-flat"><i class="fa fa-link"></i> Password</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('admin.logout') }}" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ asset('assets/images') }}/{{ Auth::user()->image }}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu" data-widget="tree">
                <!-- Optionally, you can add icons to the links -->
                <li class="{{ Request::is('admin-dashboard') ? 'active' : '' }}"><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-shopping-cart"></i> <span>Manage Order</span>
                        <span class="pull-right-container" style="margin-right: 20px;">
                          <small class="label pull-right bg-yellow">{{ \App\Order::whereStatus(0)->count() }}</small>
                        </span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                    <ul class="treeview-menu">
                        <li class="{{ Request::is('admin/all-order') ? 'active' : '' }}">
                            <a href="{{ route('all-order') }}"><i class="fa fa-desktop"></i>All Order</a>
                        </li>
                        <li class="{{ Request::is('admin/order-confirm') ? 'active' : '' }}">
                            <a href="{{ route('order-confirm') }}"><i class="fa fa-check"></i>Confirm Order</a>
                        </li>
                        <li class="{{ Request::is('admin/pending-order') ? 'active' : '' }}">
                            <a href="{{ route('pending-order') }}"><i class="fa fa-spinner"></i>Pending Order</a>
                        </li>
                        <li class="{{ Request::is('admin/cancel-order') ? 'active' : '' }}">
                            <a href="{{ route('cancel-order') }}"><i class="fa fa-times"></i>Cancel Order</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-desktop"></i> <span>Manage Product</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                    <ul class="treeview-menu">
                        <li class="{{ Request::is('admin/add-product') ? 'active' : '' }}">
                            <a href="{{ route('add-product') }}"><i class="fa fa-plus"></i>Add Product</a>
                        </li>
                        <li class="{{ Request::is('admin/all-product') ? 'active' : '' }}">
                            <a href="{{ route('all-product') }}"><i class="fa fa-desktop"></i>All Product</a>
                        </li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-indent"></i> <span>Manage Category</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                    <ul class="treeview-menu">
                        <li class="{{ Request::is('admin/manage-category') ? 'active' : '' }}"><a href="{!! route('manage-category') !!}"><i class="fa fa-list"></i> <span>Manage Category</span></a></li>
                        <li class="{{ Request::is('admin/manage-subcategory') ? 'active' : '' }}"><a href="{!! route('manage-subcategory') !!}"><i class="fa fa-list"></i> <span>Manage Subcategory</span></a></li>
                        <li class="{{ Request::is('admin/manage-childcategory') ? 'active' : '' }}"><a href="{!! route('manage-childcategory') !!}"><i class="fa fa-list"></i> <span>Manage Child Category</span></a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-credit-card-alt"></i> <span>Payment method</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                    <ul class="treeview-menu">
                        <li class="{{ Request::is('admin/payment-method') ? 'active' : '' }}"><a href="{!! route('payment-method') !!}"><i class="fa fa-list"></i> <span>Automatic Method</span></a></li>
                        <li class="{{ Request::is('admin/manual-payment-method') ? 'active' : '' }}"><a href="{!! route('manual-payment-method') !!}"><i class="fa fa-list"></i> <span>Manual Method</span></a></li>
                    </ul>
                </li>
                <li class="{{ Request::is('admin/manual-payment-request') ? 'active' : '' }}"><a href="{!! route('manual-payment-request') !!}"><i class="fa fa-money"></i>
                        <span>Payment Request</span>
                        <span class="pull-right-container">
                          <small class="label pull-right bg-yellow">{{ \App\PaymentLog::whereNotIn('id',[1,10])->whereStatus(0)->count() }}</small>
                        </span>
                    </a>
                </li>


                <li class="{{ Request::is('admin/manage-size') ? 'active' : '' }}"><a href="{!! route('manage-size') !!}"><i class="fa fa-arrows-v"></i> <span>Product Size</span></a></li>
                <li class="{{ Request::is('admin/manage-color') ? 'active' : '' }}"><a href="{!! route('manage-color') !!}"><i class="fa fa-tint"></i> <span>Product Color</span></a></li>

                <li class="{{ Request::is('admin/manage-tags') ? 'active' : '' }}"><a href="{!! route('manage-tags') !!}"><i class="fa fa-tags"></i> <span>Product Tags</span></a></li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-users"></i> <span>Product Band</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                    <ul class="treeview-menu">
                        <li class="{{ Request::is('admin/partner-create') ? 'active' : '' }}">
                            <a href="{{ route('partner-create') }}"><i class="fa fa-plus"></i>Add Band</a>
                        </li>
                        <li class="{{ Request::is('admin/partner-all') ? 'active' : '' }}">
                            <a href="{{ route('partner-all') }}"><i class="fa fa-desktop"></i>All Band</a>
                        </li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-desktop"></i> <span>Manage Advertisement</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                    <ul class="treeview-menu">
                        <li class="{{ Request::is('admin/advertisement-new') ? 'active' : '' }}">
                            <a href="{{ route('advertisement-new') }}"><i class="fa fa-plus"></i>New Advertise</a>
                        </li>
                        <li class="{{ Request::is('admin/advertisement-all') ? 'active' : '' }}">
                            <a href="{{ route('advertisement-all') }}"><i class="fa fa-desktop"></i>All Advertisement</a>
                        </li>
                    </ul>
                </li>

                <li class="{{ Request::is('admin/manage-staff') ? 'active' : '' }}"><a href="{!! route('manage-staff') !!}"><i class="fa fa-user-secret"></i> <span>Manage Staff</span></a></li>
                <li class="{{ Request::is('admin/manage-subscribe') ? 'active' : '' }}"><a href="{!! route('manage-subscribe') !!}"><i class="fa fa-indent"></i> <span>Manage Subscribe</span></a></li>
                <li class="{{ Request::is('admin/manage-users') ? 'active' : '' }}"><a href="{!! route('manage-users') !!}"><i class="fa fa-users"></i> <span>Manage Users</span></a></li>


                <li class="treeview">
                    <a href="#"><i class="fa fa-cogs"></i> <span>Basic Setting</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                    <ul class="treeview-menu">
                        <li class="{{ Request::is('admin/basic-setting') ? 'active' : '' }}">
                            <a href="{!! route('basic-setting') !!}"><i class="fa fa-cog"></i> <span>Basic Setup</span></a>
                        </li>
                        <li class="{{ Request::is('admin/email-setting') ? 'active' : '' }}">
                            <a href="{{ route('email-setting') }}"><i class="fa fa-cog"></i>Email Setting</a>
                        </li>
                        <li class="{{ Request::is('admin/email-template') ? 'active' : '' }}">
                            <a href="{{ route('email-template') }}"><i class="fa fa-envelope-open-o"></i>Email Template</a>
                        </li>
                        <li class="{{ Request::is('admin/google-analytic') ? 'active' : '' }}">
                            <a href="{{ route('google-analytic') }}"><i class="fa fa-external-link"></i>Google Analytic </a>
                        </li>
                        <li class="{{ Request::is('admin/live-chat') ? 'active' : '' }}">
                            <a href="{{ route('live-chat') }}"><i class="fa fa-comments"></i>Live Chat </a>
                        </li>
                        <li class="{{ Request::is('admin/cron-job') ? 'active' : '' }}">
                            <a href="{{ route('cron-job') }}"><i class="fa fa-unlink"></i>Set Cron Job</a>
                        </li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-quote-left"></i> <span>Manage Testimonial</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                    <ul class="treeview-menu">
                        <li class="{{ Request::is('admin/testimonial-create') ? 'active' : '' }}">
                            <a href="{{ route('testimonial-create') }}"><i class="fa fa-plus"></i>New Testimonial</a>
                        </li>
                        <li class="{{ Request::is('admin/testimonial-all') ? 'active' : '' }}">
                            <a href="{{ route('testimonial-all') }}"><i class="fa fa-desktop"></i>All Testimonial</a>
                        </li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-desktop"></i> <span>Web Control</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ Request::is('admin/manage-logo') ? 'active' : '' }}">
                            <a href="{{ route('manage-logo') }}"><i class="fa fa-image"></i>Logo & Favicon</a>
                        </li>
                        <li class="{{ Request::is('admin/manage-footer') ? 'active' : '' }}">
                            <a href="{{ route('manage-footer') }}"><i class="fa fa-sitemap"></i>Manage Footer</a>
                        </li>
                        <li class="{{ Request::is('admin/manage-speciality') ? 'active' : '' }}">
                            <a href="{{ route('manage-speciality') }}"><i class="fa fa-rss"></i>Manage Speciality</a>
                        </li>
                        <li class="{{ Request::is('admin/manage-slider') ? 'active' : '' }}">
                            <a href="{{ route('manage-slider') }}"><i class="fa fa-picture-o"></i>Manage Slider</a>
                        </li>
                        <li class="{{ Request::is('admin/manage-social') ? 'active' : '' }}">
                            <a href="{{ route('manage-social') }}"><i class="fa fa-share-square"></i>Manage Social</a>
                        </li>
                        <li class="{{ Request::is('admin/menu-control') ? 'active' : '' }}">
                            <a href="{{ route('menu-control') }}"><i class="fa fa-desktop"></i>Manage Menu</a>
                        </li>
                        <li class="{{ Request::is('admin/manage-breadcrumb') ? 'active' : '' }}">
                            <a href="{{ route('manage-breadcrumb') }}"><i class="fa fa-image"></i>Breadcrumb Image</a>
                        </li>
                        <li class="{{ Request::is('admin/manage-parallax') ? 'active' : '' }}">
                            <a href="{{ route('manage-parallax') }}"><i class="fa fa-image"></i>Parallex Image</a>
                        </li>
                        <li class="{{ Request::is('admin/manage-about') ? 'active' : '' }}">
                            <a href="{{ route('manage-about') }}"><i class="fa fa-address-card"></i>About Page</a>
                        </li>
                        <li class="{{ Request::is('admin/manage-terms-condition') ? 'active' : '' }}">
                            <a href="{{ route('manage-terms-condition') }}"><i class="fa fa-address-card"></i>Terms & Condition</a>
                        </li>
                        <li class="{{ Request::is('admin/manage-privacy-policy') ? 'active' : '' }}">
                            <a href="{{ route('manage-privacy-policy') }}"><i class="fa fa-address-card"></i>Privacy Policy</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ $page_title }}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li class="active">{{ $page_title }}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {!!  $error !!}
                    </div>
                @endforeach
            @endif

            @yield('content')

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            <strong>Version :</strong> 1.0.1
        </div>
        <!-- Default to the left -->
        <strong>{!! $basic->copy_text !!}</strong>
    </footer>
</div>
<!-- ./wrapper -->

<script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/bootstrap.min.js') }}"></script>
@yield('import_scripts')
<script src="{{ asset('assets/admin/js/main.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/toastr.js') }}"></script>
<script src="{{ asset('assets/admin/js/app.js') }}"></script>
<script>
    @if(Session::has('message'))
    var type = "{{ Session::get('type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;
        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;
        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    @endif
</script>
@yield('scripts')
</body>
</html>