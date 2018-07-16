<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from coderthemes.com/velonic_3.0/admin/recoverpw.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 09 Feb 2018 06:39:20 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="shortcut icon" href="/img/kaaba_Ccl_icon.ico">

        <title>Reset Password</title>

        <!-- Google-Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:100,300,400,600,700,900,400italic' rel='stylesheet'>


        <!-- Bootstrap core CSS -->
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link href="/css/bootstrap-reset.css" rel="stylesheet">

        <!--Animation css-->
        <link href="/css/animate.css" rel="stylesheet">

        <!--Icon-fonts css-->
        <link href="/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="/assets/ionicon/css/ionicons.min.css" rel="stylesheet" />

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="/assets/morris/morris.css">


        <!-- Custom styles for this template -->
        <link href="/css/style.css" rel="stylesheet">
        <link href="/css/helper.css" rel="stylesheet">
        <link href="/css/style-responsive.css" rel="stylesheet" />
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

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','../../../www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-62751496-1', 'auto');
  ga('send', 'pageview');

</script>

    </head>


    <body>

        <div class="wrapper-page animated fadeInDown">
            <div class="panel panel-color panel-danger">
                <div class="panel panel-heading text-center">
                    <img src="/img/AiwaFontLogo.png" alt="logo" width="170" height="90">
                    <h4 class="text-warning">Lupa password request</h4>
                </div>
                <form method="POST" action="{{ route('admin.password.email') }}" role="form" class="text-center">
                    {{ csrf_field() }}
                    <div class="alert alert-info alert-dismissable" id="notice">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Masukan <b>Email</b> yang sudah terdaftar di website, untuk mengirim link reset password.
                    </div>
                    @if ($errors->has('email'))
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ $errors->first('email') }}
                    </div>
                    @elseif(session('status'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="form-group m-b-0 {{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="input-group">
                            <input type="email" name="email" class="form-control" placeholder="Enter Email" value="{{ old('email') }}">
                            <span class="input-group-btn"> <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Kirim</button> </span>
                        </div>
                    </div>

                </form>



            </div>
        </div>






        <!-- js placed at the end of the document so the pages load faster -->
        <script src="/js/jquery.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/pace.min.js"></script>
        <script src="/js/wow.min.js"></script>
        <script src="/js/jquery.nicescroll.js" type="text/javascript"></script>
        
        <script>
            setTimeout(function(){
                $('#notice').fadeOut();
            }, 7000)
        </script>
    
        <!--common script for all pages-->
        <script src="js/jquery.app.js"></script>


    </body>

<!-- Mirrored from coderthemes.com/velonic_3.0/admin/recoverpw.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 09 Feb 2018 06:39:20 GMT -->
</html>
