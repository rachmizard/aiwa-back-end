<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!--Icon-fonts css-->
        <link href="{{asset('/assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
        <link href="{{asset('/assets/ionicon/css/ionicons.min.css')}}" rel="stylesheet" />

        <!-- Styles -->
        <style>
            html, body {
                background-color: #e53935;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #ffebee;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('admin.login'))
                <div class="top-right links">
                    @auth('admin')
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                    @else
                    <a href="{{ route('admin.login') }}">Login</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md text-center">
                    <img src="{{asset('/img/AiwaFontLogo.png')}}" class="" width="400" height="200" alt="">
                </div>

                <div class="links">
                    <!-- <a href="/api/test-api">API Jadwal</a> -->
                    <!-- <a href="https://drive.google.com/file/d/1beBq8PEvWX1ngnF7SA9_E1i0vIPeKs7J/view"><i class="fa fa-download"></i> Download Aiwa Apps</a> -->
                    <a href="#">Aiwa Mobile App is Under Develop and will be released as soon as possible</a>
                </div>
            </div>
        </div>
    </body>
</html>
