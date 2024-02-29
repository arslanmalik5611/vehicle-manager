<!doctype html>
<html lang="en" dir="ltr" class="ltr">
<head>
    <title>{{env('APP_NAME')}} | @yield('page_title')</title>
    <meta charset="utf-8">
    <link rel="icon"
          type="image/ico"
          href="{{asset('panel_assets/images/favicon.ico')}}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset('panel_assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('panel_assets/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('panel_assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('panel_assets/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('panel_assets/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('panel_assets/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('panel_assets/lobibox/dist/css/lobibox.min.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style type="text/css">
        .submenu-node, .has-menu {
            display: block;
        }
    </style>

    <script type="text/javascript">
        var api_url = "{{env('API_URL')}}";
        var web_url = "{{env('WEB_URL')}}";
        var base_url = "{{env('BASE_URL')}}";

        var view_name = "{{$view_name}}";
        var base_web_url = "{{env('BASE_URL')}}";
        var token = localStorage.getItem("patient_token");
    </script>
</head>
<body>
<header class="header" id="header">
    <div class="header-logo d-flex align-items-center justify-content-between" style="width: 15%">
        <div>
        <h5><b>Vehicle Manager</b></h5>
            <!-- <img src="{{asset('panel_assets/images/logo.png')}}" alt=""> -->
        </div>
        <div>
            <a class="header_toggle d-flex align-items-center">
                <i class='fas fa-bars' id="header-toggle"></i>
            </a>
        </div>
    </div>

    <ul class="list-unstyled m-0">
        <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle me-3" data-bs-toggle="dropdown" title="User" aria-expanded="false">
                <img src="{{asset('panel_assets/images/avatar.png')}}" class="avatar" alt="">
            </a>
            <ul class="dropdown-menu">
                <li class="user-body">
                    {{--<a class="dropdown-item" href="#"><i class="fas fa-user-alt text-muted me-3"></i>Profile</a>
                    <a class="dropdown-item" href="#"><i class="fas fa-wallet text-muted me-3"></i>My Wallet</a>
                    <a class="dropdown-item" href="#"><i class="fas fa-cog text-muted me-3"></i>Settings</a>--}}
                    <a class="dropdown-item logout" href="#"><i
                            class="fas fa-sign-out-alt text-muted me-3"></i>Logout</a>
                </li>
            </ul>
        </li>
    </ul>
</header>
