<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from coderthemes.com/velonic_3.0/admin/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 09 Feb 2018 06:39:20 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="shortcut icon" href="{{asset('/img/kaaba_Ccl_icon.ico')}}">

        <title>Alhijaz Website Login</title>

        <!-- Google-Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:100,300,400,600,700,900,400italic' rel='stylesheet'>


        <!-- Bootstrap core CSS -->
        <link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('/css/bootstrap-reset.css')}}" rel="stylesheet">

        <!--Animation css-->
        <link href="{{asset('/css/animate.css')}}" rel="stylesheet">

        <!--Icon-fonts css-->
        <link href="{{asset('/assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
        <link href="{{asset('/assets/ionicon/css/ionicons.min.css')}}" rel="stylesheet" />

        <!--Morris Chart CSS -->
        <!-- <link rel="stylesheet" href="{{asset('assets/morris/morris.css')}}"> -->


        <!-- Custom styles for this template -->
        <link href="{{asset('/css/style.css')}}" rel="stylesheet">
        <link href="{{asset('/css/helper.css')}}" rel="stylesheet">
        <link href="{{asset('/css/style-responsive.css')}}" rel="stylesheet" />
        <style>

          body {
            position: relative;
            width: 100%;
            height: 100%;
            background: url('https://www.mabonline.net/wp-content/uploads/2015/09/Masjid-Haram-Makkah.jpg') center center no-repeat;
            background-size: cover;

            &:before {
              content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-image: linear-gradient(to bottom right,#002f4b,#dc4225);
            opacity: 0.1;
            }
        </style>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
<!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
<![endif]-->
<!-- 
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','../../../www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-62751496-1', 'auto');
  ga('send', 'pageview');

</script> -->

    </head>


    <body>

        <div class="wrapper-page animated fadeInDown">
            <div class="panel panel-color panel-danger">
                <div class="panel-heading text-center">
                   <img src="{{asset('/img/AiwaFontLogo.png')}}" class="" width="200" height="100" alt="">
                   <h3 class="text-center m-t-10"> Log In to <strong>AIWA </strong></h3>
                </div>

                <form class="form-horizontal m-t-40" method="POST" action="{{ route('admin.login.submit') }}">
                        {{ csrf_field() }}
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
                    <div class="form-group ">

                        <div class="col-xs-12">
                            
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="col-xs-12">
                            <label class="cr-styled">
                                <input type="checkbox" checked>
                                <i class="fa"></i>
                                Remember me
                            </label>
                        </div>
                    </div>

                    <div class="form-group text-right">
                        <div class="col-xs-12">
                            <button class="btn btn-danger w-md" type="submit">Log In <i class="fa fa-check"></i></button>
                        </div>
                    </div>
                    <div class="form-group m-t-30">
                        <div class="col-sm-7">
                            <a href="{{ route('admin.password.request') }}"><i class="fa fa-lock m-r-5"></i> Lupa password?</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>




        <!-- js placed at the end of the document so the pages load faster -->
        <script src="{{asset('/js/jquery.js">')}}</script>
        <script src="{{asset('/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('/js/pace.min.js')}}"></script>
        <script src="{{asset('/js/wow.min.js')}}"></script>
        <script src="{{asset('/js/jquery.nicescroll.js')}}" type="text/javascript"></script>


        <!--common script for all pages-->
        <script src="{{asset('/js/jquery.app.js')}}"></script>


    </body>

<!-- Mirrored from coderthemes.com/velonic_3.0/admin/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 09 Feb 2018 06:39:20 GMT -->
</html>
