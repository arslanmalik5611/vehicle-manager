<!DOCTYPE html>
<!-- saved from url=(0108)http://localhost:8000/report-print/2124900004?header=true&footer=true&electronically_verified=true&tests=6_0 -->
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Card</title>
    <style>
        @font-face {
            font-family: 'Arialmt';
            src: url('vendor/mpdf/ttfonts/arial-mt/arialmt.ttf');
        }

        @font-face {
            font-family: 'Cambria';
            src: url('vendor/mpdf/ttfonts/cambria/Cambria.ttf');
        }

        @font-face {
            font-family: 'Helvetica';
            src: url('vendor/mpdf/ttfonts/Helvetica/Helvetica.ttf');
        }

        body {
            width: 100%;
            /*height: 100%;*/
            margin: 0;
            padding: 0;
            margin-left: -20px;
            background-color: #fff;
            font: 9pt "Helvetica";
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            font-family: 'Helvetica';
            /*font-family: 'Cambria';*/
            /*font-family: 'Helvetica';*/
            font-weight: 900;
            font-size: 12px !important;
        }

        .book{
            background: #000;
        }

        .front_page {
            width: 110mm;
            height: 200mm;
            /*margin: 10mm auto;*/
            margin-top: 7px;
            background-image: url({{asset('panel_assets/images/1111.png')}});
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .profile_img {
            margin-top: 48px;
            margin-left: 128px;
            position: absolute;
            width: 160px;
            height: 161px;
            border-radius: 120px;
            border-style: solid;
            border-color: white;
            border-width: medium;
            overflow: hidden;
            background-size: cover;
            background-image: url({{$data->user->picture_url}});
            {{--background-image: url({{asset('panel_assets/images/student.jpg')}});--}}
        }

        .profile_detail {
            position: absolute;
            top: 214px;
            width: 100%;
        }

        .user_name {
            text-align: center;
        }

        .user_name h3 {
            font-size: 30px !important;
            padding: 0px;
            margin: 0;
            color: #fff;
            font-weight: 800;
        }

        .user_name p {
            margin: 0;
            font-size: 16px !important;
            color: #fff;
            text-align: center;
        }

        .user_detail{
            margin-top: 80px !important;
        }

        .back_page {
            width: 110mm;
            height: 200mm;
            /*margin: 10mm auto;*/
            margin-top: 7px;
            background-image: url({{asset('panel_assets/images/back.png')}});
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .back_page .detail ul{
            padding: 65px 20px 20px 64px !important;
        }

        .back_page .detail ul li{
            font-size: 15px !important;
            list-style-type: circle;
        }

        .footer{
            margin-top: 180px;
            text-align: center;
        }

        .footer p, h3, span{
            color: #fff;
            font-size: 18px !important;
            margin: 0;
        }

        .std_name p{
            font-family: cursive !Important;
            font-style: italic;
        }

        .date{
            margin-top: 35px !important;
        }

        .date p{
            font-weight: 700;
        }

        table .detail_name{
            width: 141px;
            /*text-align: center;*/
            font-size: 18px !important;
            padding-left: 30px !important;
            padding-bottom: 10px !important;
            font-weight: 800;
        }

        table .detail_value{
            font-size: 18px !important;
        }
        .subpage {
            /*height: 287mm;*/
            /*padding: 5px;*/
        }

        table {
            width: 100%;
            line-height: 10pt;
            text-align: left;
            /*border-spacing: 0;*/
            border-collapse: collapse;
        }

        .maintable, .table {
            border: 1px solid #000;
        }

        .maintable th, .table th {
            border: 1px solid #000;
            font-size: 12px;
            /*line-height: 10px;*/
            text-align: center;
            padding: 5px;
            color: #fff;
            background-color: #000;
        }

        .maintable td {
            border: 1px solid #000;
            font-size: 12px !important;
            padding: 6px !important;
            /*text-align: center;*/
        }

        .table td {
            border-left: 1px solid #000;
            border-right: 1px solid #000;
            font-size: 12px !important;
            padding: 6px !important;
            /*text-align: center;*/
        }

        .text-center {
            text-align: center !important;
        }

    </style>
</head>
<body>
<div class="book">
    <div class="front_page">
        <div class="subpage">
            <div class="profile_img" style=""></div>
            <div class="profile_detail">
                <div class="user_name">
                    <h3>{{$data->user->first_name}} {{$data->user->last_name}}</h3>
                    <p>{{$data->user->father_name}}</p>
                </div>

                <div class="user_detail">
                    <table>
                        <tr>
                            <td class="detail_name">Roll No</td>
                            <td class="detail_value"> : {{$data->roll_no}}</td>
                        </tr>
                        <tr>
                            <td class="detail_name">Class</td>
                            <td class="detail_value"> : {{$data->student_enrolment->student_class->name}}</td>
                        </tr>
                        <tr>
                            <td class="detail_name">CNIC</td>
                            <td class="detail_value"> : {{$data->user->cnic}}</td>
                        </tr>
                        <tr>
                            <td class="detail_name">Phone</td>
                            <td class="detail_value"> : {{$data->user->phone}}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">
                                <div style="font-size: 2px">{!! QrCode::size(100)->generate("$data->registration_no") !!}</div>
{{--                                <img src="{{$qrCode}}" width="100" alt="">--}}
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2" style="text-align: center">
                                <img src="{{$school->logo_url}}" width="200" alt="">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <!--End of subpage-->
        </div>
    </div>
    <div class="back_page">
        <div class="subpage">
            <div class="detail">
                <ul>
                    <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                </ul>
            </div>

            <div class="footer">
                <div class="std_name">
                    <p>{{$school->phone}}</p>
                    <h3>{{$school->email}}</h3>
                </div>
                <div class="date">
                    <p>Session : <span class="joined">{{$data->student_enrolment->session->name}}</span></p>
{{--                    <p>Expir Date : <span class="expired">MM/DD/YY</span></p>--}}
                </div>

                <div class="footer_img text-center" style="margin-top: 25px">
                    <img src="{{$school->logo_url}}" width="220" alt="">
                </div>
            </div>
            <!--End of subpage-->
        </div>
    </div>
</div>
</body>
</html>
