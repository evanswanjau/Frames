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
        <a href="{{ route('staff-dashboard') }}" class="logo">
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
                                    <a href="{{ route('staff-edit-profile') }}" class="btn btn-default btn-flat"><i class="fa fa-edit"></i> Profile</a>
                                </div>
                                <div class="pull-left" style="padding-left:4px">
                                    <a href="{{ route('staff-change-password') }}" class="btn btn-default btn-flat"><i class="fa fa-link"></i> Password</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('staff.logout') }}" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Sign out</a>
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
                <li class="{{ Request::is('staff-dashboard') ? 'active' : '' }}">
                    <a href="{{ route('staff-dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                </li>
                <li class="{{ Request::is('staff/add-product') ? 'active' : '' }}">
                    <a href="{{ route('staff-add-product') }}"><i class="fa fa-plus"></i><span>Add Product</span></a>
                </li>
                <li class="{{ Request::is('staff/all-product') ? 'active' : '' }}">
                    <a href="{{ route('staff-all-product') }}"><i class="fa fa-desktop"></i><span>All Product</span></a>
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
                <li><a href="{{ route('staff-dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
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