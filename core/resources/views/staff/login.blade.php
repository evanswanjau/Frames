<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>{{ $site_title }} | Log in</title>

    <!-- Tell the browser to be responsive to screen width -->

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.7 -->

    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.min.css') }}">

    <!-- Font Awesome -->

    <link rel="stylesheet" href="{{ asset('assets/admin/css/font-awesome.min.css') }}">

    <!-- Theme style -->

    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.min.css') }}">

    <!-- iCheck -->

    <link rel="stylesheet" href="{{ asset('assets/admin/css/blue.css') }}">



    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" />



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>

    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->



    <!-- Google Font -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>

<body class="hold-transition login-page">

<div class="login-box">

    <div class="login-logo">

        <a href="#"><img src="{{ asset('assets/images/logo.png') }}" alt="Logo"></a>

    </div>

    <!-- /.login-logo -->

    <div class="login-box-body">

        <p class="login-box-msg">Sign in Required to Access Dashboard</p>



        {!! Form::open(['route'=>'staff.login.post','class'=>'login-form']) !!}



        @if (session()->has('message'))

            <div class="alert alert-warning alert-dismissable">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                {{ session()->get('message') }}

            </div>

        @endif

        @if($errors->any())

            @foreach ($errors->all() as $error)



                <div class="alert alert-danger alert-dismissable">

                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                    {!!  $error !!}

                </div>

            @endforeach

        @endif



        <div class="form-group has-feedback">

            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>

            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

        </div>

        <div class="form-group has-feedback">

            <input type="password" name="password" class="form-control" placeholder="Password" required>

            <span class="glyphicon glyphicon-lock form-control-feedback"></span>

        </div>

        <div class="row">

            <div class="col-xs-6">

                <div class="checkbox icheck">

                    <label>

                        <input type="checkbox" {{ old('remember') ? 'checked' : '' }}> Remember Me

                    </label>

                </div>

            </div>

            <!-- /.col -->

            <div class="col-xs-6">

                <div class="checkbox icheck text-right">

                    <label>

                        <a href="{{ route('staff.password.request') }}"><i class="fa fa-link"></i> Forgot Password</a><br>

                    </label>

                </div>

            </div>

            <!-- /.col -->

        </div>

        <br>

        <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-sign-in"></i> Sign In</button>

        {!! Form::close() !!}



    </div>

    <!-- /.login-box-body -->

</div>

<!-- /.login-box -->



<!-- jQuery 3 -->

<script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>

<!-- Bootstrap 3.3.7 -->

<script src="{{ asset('assets/admin/js/bootstrap.min.js') }}"></script>

<!-- iCheck -->

<script src="{{ asset('assets/admin/js/icheck.min.js') }}"></script>

<script>

    $(function () {

        $('input').iCheck({

            checkboxClass: 'icheckbox_square-blue',

            radioClass: 'iradio_square-blue',

            increaseArea: '10%' // optional

        });

    });

</script>

</body>

</html>

