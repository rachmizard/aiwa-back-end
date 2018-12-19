<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from coderthemes.com/velonic_3.0/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 09 Feb 2018 06:38:27 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <!-- CSRF_TOKEN -->
        <meta name="csrf_token" content="{{ csrf_token() }}">
        <meta id="token" name="csrf-token" content="{{ csrf_token() }}">

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
        <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">


        <!-- Plugins css -->
        <link href="{{asset('/assets/modal-effect/css/component.css')}}" rel="stylesheet">
        <link href="{{asset('assets/tagsinput/jquery.tagsinput.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/toggles/toggles.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/timepicker/bootstrap-timepicker.min.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/timepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="{{asset('assets/colorpicker/colorpicker.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset('assets/jquery-multi-select/multi-select.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset('assets/select2/select2.css')}}" />
        <style>
        /*=======
        CUSTOM CSS
        =========*/
        .hiden {display: none;}
        .unhide {display: block;}
        text[text-anchor="middle"]{
          display:none
        }
        </style>
          <!-- CSRF_TOKEN -->
          <script>
              window.Laravel = {!! json_encode([
                  'csrfToken' => csrf_token(),
              ]) !!};
          </script>
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
                2018 © Aiwa.
            </footer>
            <!-- Footer Ends -->



        </section>
        <!-- Main Content Ends -->



        <!-- js placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
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
        <script src="https://datatables.yajrabox.com/js/jquery.dataTables.min.js"></script>
        <!-- <script src="https://cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js"></script> -->
        <!-- <script src="{{ asset('/assets/datatables/jquery.dataTables.min.js') }}"></script> -->
        <script src="{{ asset('/assets/datatables/dataTables.bootstrap.js')}}"></script>
        <script src="https://cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>

        <!-- Modal-Effect -->
        <script src="{{asset('/assets/modal-effect/js/classie.js')}}"></script>
        <script src="{{asset('/assets/modal-effect/js/modalEffects.js')}}"></script>


        <!--wizard initialization-->
        <script src="{{asset('assets/form-wizard/wizard-init.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/tagsinput/jquery.tagsinput.min.js')}}"></script>
        <script src="{{asset('assets/toggles/toggles.min.js')}}"></script>
        <script src="{{asset('assets/timepicker/bootstrap-timepicker.min.js')}}"></script>
        <script src="{{asset('assets/timepicker/bootstrap-datepicker.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/colorpicker/bootstrap-colorpicker.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/jquery-multi-select/jquery.multi-select.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/jquery-multi-select/jquery.quicksearch.js')}}"></script>
        <script src="{{asset('assets/bootstrap-inputmask/bootstrap-inputmask.min.js')}}" type="text/javascript"></script>
        <script type="text/javascript" src="{{asset('assets/spinner/spinner.min.js')}}"></script>
        <!-- select2 -->
        <script src="{{asset('assets/select2/select2.min.js')}}" type="text/javascript"></script>
        <!-- Masked Input -->
        <!-- <script src="{{asset('assets/bootstrap-inputmask/bootstrap-inputmask.min.js')}}" type="text/javascript"></script> -->
        @stack('scripts')
        @stack('dataTables')
        @stack('otherJavascript')
        <script>
            $('#イロドリ-ea').click(function(){
                $('#logo-full').toggle(0); 
                $('#logo-mini').toggle(0);
                $('.navigation ul li ul').hide(0);
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
        <script>
            function confirmBtn() {
                  if(!confirm("Anda yakin untuk melanjutkannya?"))
                  event.preventDefault();
            }

            function confirmBtnDownloadAgen() {
                  if(!confirm("Jika anda mengunduh format ini data password akan terenskripsi guna menjaga kerahasiaan akun, lanjutkan?"))
                  event.preventDefault();
            }
        </script>

    </body>

<!-- Mirrored from coderthemes.com/velonic_3.0/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 09 Feb 2018 06:38:27 GMT -->
</html>
