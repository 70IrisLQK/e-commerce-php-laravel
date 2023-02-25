<!DOCTYPE html>

<head>
    <title>E-Store Managament</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords"
        content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link rel="stylesheet" href="{{ URL::asset('back-end/css/bootstrap.min.css') }}">
    <link href="{{ URL::asset('back-end/css/style.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ URL::asset('back-end/css/style-responsive.css') }}" rel="stylesheet" />
    <link
        href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ URL::asset('back-end/css/font.css') }}" type="text/css" />
    <link href="{{ URL::asset('back-end/css/font-awesome.css') }}" rel="stylesheet">
    <script src="{{ URL::asset('back-end/js/jquery2.0.3.min.js') }}"></script>
</head>

<body>
    <div class="log-w3">
        <div class="w3layouts-main">
            <h2>Sign In Now</h2>
            <?php
            $message = Session::get('message');
            if ($message) {
                echo '<span class="text-alert">' . $message . '</span>';
                Session::put('message', null);
            }
            ?>
            <form action="{{ URL::to('admin-dashboard') }}" method="post">
                {{ csrf_field() }}
                <input type="text" class="ggg" name="admin_email" placeholder="E-MAIL" required="">
                <input type="password" class="ggg" name="admin_password" placeholder="PASSWORD" required="">
                <span><input type="checkbox" />Remember Me</span>
                <h6><a href="#">Forgot Password?</a></h6>
                <div class="clearfix"></div>
                <input type="submit" value="Sign In" name="login">
            </form>
            {{-- <p>Don't Have an Account ?<a href="registration.html">Create an account</a></p> --}}
        </div>
    </div>
    <script src="{{ URL::asset('back-end/js/bootstrap.js') }}"></script>
    <script src="{{ URL::asset('back-end/js/jquery.dcjqaccordion.2.7.js') }}"></script>
    <script src="{{ URL::asset('back-end/js/scripts.js') }}"></script>
    <script src="{{ URL::asset('back-end/js/jquery.slimscroll.js') }}"></script>
    <script src="js/jquery.nicescroll.js"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="{{ URL::asset('back-end/js/jquery.scrollTo.js') }}"></script>
</body>

</html>
