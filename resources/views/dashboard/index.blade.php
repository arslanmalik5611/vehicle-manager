@extends('layout.master')
@section('page_title','Dashboard')
​
@section('content')
    <style>
        .dash-widget5 {
            display: flex;
            min-height: 70px;
            background: #fff;
            color: #000;
            padding: 15px;
            justify-content: space-between;
            width: 100%;
            border-radius: 10px;
            margin-bottom: 30px;
            border: 1px solid #D5DBE1;
            box-shadow: 0 6px 15px rgb(36 37 38 / 8%);
        }

        .dash-widget5 img {
            width: 50px !important;
        }

        .dash-widget5 .dash-widget-info {
            /*padding: 11px 0;*/
        }

        .dash-widget-info h3, span {
            font-family: 'Roboto', sans-serif;
        }

        .dash-widget-info span {
            font-size: 11px !important;
        }

        .dash-widget-info > h3 {
            font-size: 15px;
            font-weight: 600;
            /*margin-top: 15px;*/
        }

        .image {
            width: 50px;
        }

        .current_month {
            display: inline-block;
            font-size: 12px;
            margin-top: 10px;
            text-align: center;
            color: blueviolet;
        }

        .detail-table{
            height: 364px !important;
            overflow: auto;
        }
        .detail-table table td, th {
            padding: 0 !important;
            text-align: center !important;
        }

        .fee-detail-show table td, th {
            padding: 0 !important;
            text-align: center;
        }
        .timeline.widget-timeline:before {
            content: '';
            /* background: #000; */
            width: 4px;
            position: absolute;
            top: 3px;
            bottom: 0;
            left: 128px;
            background-color: #ECF0F3;
        }
        .timeline.timeline-5 .timeline-item .timeline-badge {
            -ms-flex-negative: 0;
            flex-shrink: 0;
            background: white;
            width: 20px;
            height: 20px;
            border-radius: 100%;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            z-index: 1;
            position: relative;
            margin-left: 12px;
        }
        .timeline.timeline-5 .timeline-item{
            padding-left: 20px;
            position: relative;
        }
    </style>
    <link rel="stylesheet" href="{{asset('panel_assets/css/dashboard.min.css')}}">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7 col-12">
                <div class="row dashboard-page">
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget dash-widget5">
                <span class="text-left"><img src="{{asset('panel_assets/images/dashboard/dash-17.png')}}" alt=""
                    ></span>
                            <div class="dash-widget-info text-right">
                                <span>Users</span>
                                <h3>{{$data['user_count']}}</h3>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget dash-widget5">
                <span class="text-left"><img src="{{asset('panel_assets/images/dashboard/dash-18.png')}}" alt=""
                    ></span>
                            <div class="dash-widget-info text-right">
                                <span>Admin</span>
                                <h3>{{$data['admin_count']}}</h3>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget dash-widget5">
                            <div class="dash-widget-info text-left">
                                <span>Teachers</span>
                                <h3>{{$data['teacher_count']}}</h3>
                            </div>
                            <span class="text-left"><img src="{{asset('panel_assets/images/dashboard/dash-2.png')}}"
                                                         alt=""
                                ></span>
                        </div>

                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget dash-widget5">
                <span class="text-left"><img src="{{asset('panel_assets/images/dashboard/dash-1.png')}}" alt=""
                    ></span>
                            <div class="dash-widget-info text-right">
                                <span>Students</span>
                                <h3>{{$data['student_count']}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row dashboard-page">
                    <h1 style="font-size: 12px;margin: 0;padding-left: 20px;">Expense</h1>
                    @foreach($data['expense'] as $month => $amount)
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                            <div class="dash-widget dash-widget5">
                <span class="text-left"><img src="{{asset('panel_assets/images/dashboard/dash-17.png')}}" alt=""
                    ></span>
                                <div class="dash-widget-info text-right">
                                    <span>{{$month}}</span>
                                    <h3>{{$amount}}</h3>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
                <div class="row dashboard-page">
                    <h1 style="font-size: 12px;margin: 0;padding-left: 20px;">Income</h1>
                    @foreach($data['income'] as $month => $amount)
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                            <div class="dash-widget dash-widget5">
                <span class="text-left"><img src="{{asset('panel_assets/images/dashboard/dash-17.png')}}" alt=""
                    ></span>
                                <div class="dash-widget-info text-right">
                                    <span>{{$month}}</span>
                                    <h3>{{$amount}}</h3>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
                <div class="row dashboard-page">
                    <h1 style="font-size: 12px;margin: 0;padding-left: 20px;">Fee</h1>
                    @foreach($data['profit'] as $month => $amount)
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                            <div class="dash-widget dash-widget5">
                <span class="text-left">
{{--                    Total--}}
                    {{--                    <img src="{{asset('panel_assets/images/dashboard/dash-17.png')}}" alt="">--}}
                </span>
                                <div class="dash-widget-info text-right">
                                    <span>{{$month}}</span>
                                    <h3>{{$amount}}</h3>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card br-4">
                            <div class="card-header">
                                <h5 class="card-title d-flex justify-content-between">
                                    <span>Recent Activities</span>
                                </h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="timeline widget-timeline position-relative my-2 detail-table">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Total Student in Class</h2>
                        <div class="detail-table">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Class</th>
                                    <th>Students</th>
                                </tr>
                                </thead>
                                <tbody class="classEnrBody">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Last 12 Month Voucher Info</h2>
                        <div class="detail-table">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Month</th>
                                    <th>Voucher</th>
                                    <th>Amount</th>
                                    <th>Paid</th>
                                    <th>Due</th>
                                </tr>
                                </thead>
                                <tbody class="feeDetailShow">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="feed-body bg-white pt-2 pb-2 text-center">
                    <div id="chart">
                    </div>
                </div>
            </div>
        </div>

        <div class="row my-4 mb-4">
            <div class="col-md-6 col-12">
                <div class="feed-body bg-white pt-2 pb-2 text-center">
                    <div id="donut-chart">
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="feed-body bg-white pt-2 pb-2 text-center">
                    <div id="pie-chart">
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
​
@section('page_level_scripts')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{asset('panel_assets/js/dashboard.js?v='.date('ymdhis'))}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            nav_bar_hide();
        });

    </script>
@endsection
