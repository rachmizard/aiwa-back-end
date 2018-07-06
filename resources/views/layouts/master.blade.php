<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from coderthemes.com/velonic_3.0/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 09 Feb 2018 06:38:27 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="/img/kaaba_Ccl_icon.ico">

        <title>Admin Dashboard</title>

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
        <link rel="stylesheet" href="{{asset('/assets/morris/morris.css')}}">

        <!-- sweet alerts -->
        <link href="{{asset('/assets/sweet-alert/sweet-alert.min.css')}}" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="{{asset('/css/style.css')}}" rel="stylesheet">
        <link href="{{asset('/css/helper.css')}}" rel="stylesheet">
        <link href="{{asset('/css/style-responsive.css')}}" rel="stylesheet" />

        <!-- datatables css -->
        <link href="{{asset('/assets/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />


        <!-- Plugins css -->
        <link href="{{asset('/assets/modal-effect/css/component.css')}}" rel="stylesheet">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
<!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
<![endif]-->

    </head>


    <body>

     @include('layouts.aside')
     @include('layouts.navbar')

     @yield('content')

            <!-- Footer Start -->
            <footer class="footer">
                2015 © Velonic.
            </footer>
            <!-- Footer Ends -->



        </section>
        <!-- Main Content Ends -->



        <!-- js placed at the end of the document so the pages load faster -->
        <script src="{{asset('/js/jquery.js')}}"></script>
        <script src="{{asset('/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('/js/modernizr.min.js')}}"></script>
        <script src="{{asset('/js/pace.min.js')}}"></script>
        <script src="{{asset('/js/wow.min.js')}}"></script>
        <script src="{{asset('/js/jquery.scrollTo.min.js')}}"></script>
        <script src="{{asset('/js/jquery.nicescroll.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/chat/moment-2.2.1.js')}}"></script>

        <!-- Counter-up -->
        <script src="{{asset('/js/waypoints.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/js/jquery.counterup.min.js')}}" type="text/javascript"></script>

        <!-- EASY PIE CHART JS -->
        <script src="{{asset('/assets/easypie-chart/easypiechart.min.js')}}"></script>
        <script src="{{asset('/assets/easypie-chart/jquery.easypiechart.min.js')}}"></script>
        <script src="{{asset('/assets/easypie-chart/example.js')}}"></script>


        <!--C3 Chart-->
        <script src="{{asset('/assets/c3-chart/d3.v3.min.js')}}"></script>
        <script src="{{asset('/assets/c3-chart/c3.js')}}"></script>

        <!--Morris Chart-->
        <script src="{{asset('/assets/morris/morris.min.js')}}"></script>
        <script src="{{asset('/assets/morris/raphael.min.js')}}"></script>

        <!-- sparkline -->
        <script src="{{asset('/assets/sparkline-chart/jquery.sparkline.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/sparkline-chart/chart-sparkline.js')}}" type="text/javascript"></script>

        <script src="{{asset('/js/jquery.app.js')}}"></script>
        <!-- Chat -->
        <script src="{{asset('/js/jquery.chat.js')}}"></script>
        <!-- Dashboard -->
        <script src="{{asset('/js/jquery.dashboard.js')}}"></script>

        <!-- Todo -->
        <script src="{{asset('/js/jquery.todo.js')}}"></script>


        <!-- sweet-alert -->
        <script src="{{asset('/assets/sweet-alert/sweet-alert.init.js')}}"></script>

        <!-- datatables -->
        <script src="{{asset('/assets/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('/assets/datatables/dataTables.bootstrap.js')}}"></script>

        <!-- Modal-Effect -->
        <script src="{{asset('/assets/modal-effect/js/classie.js')}}"></script>
        <script src="{{asset('/assets/modal-effect/js/modalEffects.js')}}"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable({
                    processing: true,
                });
            } );
        </script>

        <script type="text/javascript">
        /* ==============================================
             Counter Up
             =============================================== */
            jQuery(document).ready(function($) {
                $('.counter').counterUp({
                    delay: 100,
                    time: 1200
                });
            });

            $('a[id="load-a"]').on('click', function() {
                var $this = $(this);
              $this.button('loading');
                setTimeout(function() {
                   $this.button('reset');
               }, 1000);
            });

            $('button[id="load"]').on('click', function() {
                var $this = $(this);
              $this.button('loading');
                setTimeout(function() {
                   $this.button('reset');
               }, 4500);
            });
        </script>
        @stack('dataTables')


    </body>

<!-- Mirrored from coderthemes.com/velonic_3.0/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 09 Feb 2018 06:38:27 GMT -->
</html>
