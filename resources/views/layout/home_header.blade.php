<!doctype html>
<html lang="en">
<head>
    <title>{{env('LAB_NAME')}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{asset('panel_assets/images/favicon.ico')}}" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="{{asset('panel_assets/css/bootstrap.min.css')}}">
    <!--    <link rel="stylesheet" href="css/bootstrap.rtl.min.css">-->
    <link rel="stylesheet" href="{{asset('panel_assets/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('panel_assets/css/animate.css')}}"/>
    <link rel="stylesheet" href="{{asset('panel_assets/css/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{asset('panel_assets/css/main.css')}}">
    <script src="{{asset('panel_assets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('panel_assets/js/bootstrap.bundle.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('panel_assets/lobibox/dist/css/lobibox.min.css')}}">

    <script type="text/javascript">
        api_url = "{{env('API_URL')}}";
        web_url = "{{env('WEB_URL')}}";
        base_url = "{{env('BASE_URL')}}";
    </script>
</head>
<body>
<!--https://www.jquery-az.com/beautiful-jquery-alerts-with-12-demos-by-using-different-plug-ins/-->
<!--### Header Start ###-->
<header class="header home-header">
    <div class="navbar-container" id="navbar">
        <nav class="container navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand " href="#">
            <h5><b>Vehicle Manager</b></h5>
                <!-- <img src="{{asset('panel_assets/images/logo.png')}}" alt=""> -->
            </a>

            <button class="navbar-toggler collapse-btn border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav my-2 my-lg-0 navbar-nav-scroll mx-auto">
                    <li class="nav-item active">
                        <a class="nav-link" aria-current="page" href="#">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">
                            About Us
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">
                            Contact Us
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Login
                        </a>
                    </li>
                </ul>

                {{--<a href="#" class="btn default-btn btn-primary text-capitalize me-lg-3 mb-3 mb-lg-0">Get Started</a>--}}
            </div>

            <div class="dropdown language-list">

            </div>
        </nav>
    </div>
</header>
<!--### Header End ###-->
