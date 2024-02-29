<?php
// echo "<pre>";
// print_r($user_session_data);
// echo $school->logo_url;
// exit();
?>
<!DOCTYPE html>
<!-- saved from url=(0014)about:internet -->
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Payroll Slip</title>
    <style type="text/css">
        page {
            background: white;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            font-family: Verdana;
        }

        page[size="A4"] {
            width: 33cm;
            /* height: 29.7cm; */
        }

        #employee_info {
            border-collapse: collapse;
            width: 100%;
        }

        #employee_info td {
            font-size: 11.5px;
            font-weight: bold;
            border: 1px dotted black !important;
        }

        #time_info {
            font-size: 11.5px;
            font-weight: bold;
            border-collapse: collapse;
            width: 100%;

        }

        #time_info td {
            border: 1px dotted black !important;
        }

        #reference {
            margin-top: 15px;
            margin-bottom: 5px;
        }

        #reference,
        #consultant {
            font-size: 11.5px;
            font-weight: bold;

        }

        #consultant {
            margin-top: 5px;
            margin-bottom: 15px;
        }

        #test_info {
            border-collapse: collapse;
            width: 100%;
        }

        #test_info td {
            font-size: 11.5px;
            font-weight: bold;
            text-align: center;
            border: 1px dotted black !important;
        }

        #test_info th {
            font-size: 12px;
            font-weight: bold;
            border: 1px dotted black !important;
        }

        #amount_info {
            border-collapse: collapse;
            width: 100%;
        }

        #amount_info td {
            font-size: 11.5px;
            font-weight: bold;
            border: 1px dotted black !important;
        }

        .bold {
            font-weight: bold !important;
        }

        .normal {
            font-weight: normal !important;
        }

        .slip {

            width: 48%;
            float: left;
            border: 1px solid black;
            padding-left: 5px;
            height: 100vh;
            /* padding-left: 10px; */
            /* margin: auto;
            /* height: 560px!important; */
            padding: 8px 3px;
        }

        .test_name {
            width: 50%;
            text-align: left !important;
        }

        .img-thumbnail {
            height: 70px;
            width: 100%
        }

        @media print {

            body,
            page {
                margin: 0;
                box-shadow: 0;
            }
        }
    </style>
</head>

<body>
    <page size="A4">
        @php
        $copy = ['EMPLOYEE COPY','OFFICE COPY']
        @endphp
        @for($i=0; $i<=1; $i++) <div class="slip">
            <div style="width:33%;float:left;margin-top:12px">
                <img src="{{$school->logo_url}}" style="height: 55px;" width="200">

            </div>
            <div style="width:70%;float:left;text-align:center">
                <h2 style="font-size:16px">{{$school->name}}</h2>
                <div style="font-size:10px;font-weight:bold">
                    <hr>
                    <span style="font-size:12px;">{{$school->address}}</span> <br>
                    <span style="margin-left:10px">Phone# {{$school->phone}}</span>
                    <span style="margin-left:10px">Cell. {{$school->phone}}</span>
                    <hr>
                </div>
            </div>
            <div style="clear:both"></div>
            <div class="table_wrapper">
                <table id="employee_info">
                    <tbody>
                        <tr>
                            <td>Employee Name</td>
                            <td>{{$user_session_data['user']['first_name']}}</td>
                        </tr>
                        <tr>
                            <td>Joining Date</td>
                            <td class="normal">{{$user_session_data['joining_date']}}</td>
                        </tr>
                        <tr>
                            <td>Designation</td>
                            <td>{{$user_session_data['joining_date']}}</td>
                        </tr>
                        <tr>
                            <td>CNIC</td>
                            <td>{{$user_session_data['user']['cnic']}}</td>
                        </tr>
                        <tr>
                            <td>Phone No</td>
                            <td>0333 052188</td>
                        </tr>
                        <tr>
                            <td>Salary</td>
                            <td>{{$user_session_data['salary']}}</td>
                        </tr>
                        <tr>
                            <td>Allowance</td>
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>Annual Increment</td>
                            <td>10%</td>
                        </tr>
                        <tr>
                            <td>Month</td>
                            <td>{{$formated_month}}</td>
                        </tr>
                        <tr>
                            <td>Amount</td>
                            <td>{{$user_session_data['salary']}}/-</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table_wrapper" style="margin-top:10px;">
                <div style="padding:7px;font-weight:bold;text-align:center">Payroll History</div>
                <table id="test_info">
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>Total Salary</th>
                            <th>Arrears</th>
                            <th>Deduction</th>
                            <th>Paid</th>
                            <th>Due Salary</th>
                            <th>Payment Method</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user_session_data['many_payroll'] as $payroll)
                        <tr>
                            <td>{{$payroll['month_formatted']}}</td>
                            <td>{{$payroll['total_salary']}}</td>
                            <td>{{$payroll['arrears']}}</td>
                            <td>{{$payroll['deduction']}}</td>
                            <td>{{$payroll['paid']}}</td>
                            <td>{{$payroll['due_salary']}}</td>
                            <td>{{$payroll['payment_method']['name']}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div style="clear:both"></div>
            <!-- <div style="margin-top:10px;font-weight:bold;font-size:11.5px;display:flex;justify-content:space-around">
                <div style="border-top:1px solid black;margin-top:50px;width:30%;text-align:center">
                    Received By
                </div>
                <div style="width:40%;">
                </div>
                <div style="border-top:1px solid black;margin-top:50px;width:30%;text-align:center">
                    Issued By
                </div>
            </div>
            <div style="margin-top:10px;font-weight:bold;font-size:11.5px;display:flex;justify-content:space-around">
                {{$copy[$i]}}
            </div> -->

            <table style="margin-top:30px;font-weight:bold;font-size:11.5px;width:100%">
                <tr>
                    <td>
                        <span style="border-top:1px solid black;margin-top:50px;text-align:center">Received By<span>
                    </td>
                    <!-- <td style="width:40%;background-color:blueviolet;">abc</td>
                    <td style="width:40%;background-color:blueviolet;">abc</td> -->
                    <td style="text-align: right;">
                        <span style="border-top:1px solid black;margin-top:50px;text-align:center">Issued By</span>
                    </td>
                </tr>
            </table>
            <!-- <div style="margin-top:10px;font-weight:bold;font-size:11.5px;display:flex!important;justify-content:space-around">
                <div style="border-top:1px solid black;margin-top:50px;width:30%;text-align:center;background:red;">
                    Received By
                </div>
                <div style="width:40%;">
                </div>
                <div style="border-top:1px solid black;margin-top:50px;width:30%;text-align:center">
                    Issued By
                </div>
            </div> -->
            <div style="margin-top:10px;font-weight:bold;font-size:11.5px;text-align:center">
                {{$copy[$i]}}
            </div>
            </div>
            @endfor

    </page>

</body>

</html>
