<!DOCTYPE html>
<!-- saved from url=(0108)http://localhost:8000/report-print/2124900004?header=true&footer=true&electronically_verified=true&tests=6_0 -->
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Student Fee Voucher</title>
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
            font: 9pt "Arialmt";
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            font-family: 'Arialmt';
            /*font-family: 'Cambria';*/
            /*font-family: 'Helvetica';*/
            font-weight: 900;
            font-size: 12px !important;
        }

        .page {
            /*width: 190mm;*/
            /*height: 400mm;*/
            /*min-height: 297mm;*/
            /*padding: 5mm; /*20mm*/
            margin: 0;
            margin-bottom: 50px;
            /*margin-top: 7px;/*/
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

        .maintable {
            border: 1px solid #000;
        }

        .maintable th {
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

        .text-center {
            text-align: center !important;
        }

        .student-copy {
            width: 30% !important;
            border: 2px solid #000;
        }

        .student-copy .logo {
            width: 160px;
        }

        .student-copy .logo img {
            width: 100%;
        }

        .student-copy .school-info {
            width: 347px;
            text-align: center;
        }

        .student-copy .qr-code {
            text-align: right;
            padding: 10px;
        }

        .student-copy .qr-code img {
            width: 100%;
        }

        p {
            font-size: 20px !important;
        }

        .bold {
            font-weight: 700;
        }

        .fee-desc {
            height: 300px !important;
        }

        .terms {
            padding: 0 10px !important;
        }

        .terms h4 {
            margin-bottom: 0px !important;
        }

        .terms .terms-list {
            border: 1px solid #000;
        }

        .terms .terms-list p {
            margin-top: 0px;
            margin-bottom: 0px;
            font-size: 14px !important;
        }

        .signature {
            margin-top: 15px !important;
        }
    </style>
</head>
<body>
<div class="book">
    @foreach($data as $VoucherInfo)
        <div class="page">
            <div class="subpage" style="display: flex; justify-content: space-between !important;">
                @for($i=0; $i <=2; $i++)
                    <div class="student-copy" style="float: left; margin-left: 10px;">
                        <div class="header">
                            <table>
                                <tr>
                                    <td class="logo">
                                        <img src="{{$school->logo_url}}" alt="">
                                        {{--                                        <img src="{{public_path('panel_assets/images/logo.png')}}" alt="">--}}
                                    </td>
                                    <td class="school-info">
                                        <p>
                                            Beacon House School
                                        </p>
                                        <br>
                                        <h2>
                                            india
                                        </h2>
                                        <br>
                                        <p>
                                            1212324
                                        </p>
                                    </td>
                                    <td class="qr-code">
                                        <div style="font-size: 2px">{!! QrCode::size(100)->generate("$VoucherInfo->fee_voucher_number") !!}</div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <table class="maintable">
                            <thead>
                            <tr>
                                <th>Fee Voucher</th>
                                <th>{{$VoucherInfo->month_formatted}}</th>
                                <th style="font-size: 10px">Voucher No.</th>
                                <th>{{$VoucherInfo->fee_voucher_number}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td colspan="2" class="bold">Student's Name</td>
                                <td colspan="2">{{$VoucherInfo->student_enrollment->student->user->first_name}} {{$VoucherInfo->student_enrollment->student->user->last_name ?? ''}}</td>
                            </tr>
                            <tr>
                                <td class="bold" colspan="2">Father's Name</td>
                                <td colspan="2">{{$VoucherInfo->student_enrollment->student->user->father_name}}</td>
                            </tr>
                            <tr>
                                <td class="bold" colspan="2">Registration No</td>
                                <td colspan="2">{{$VoucherInfo->student_enrollment->student->user->registration_no}}</td>
                            </tr>
                            <tr>
                                <td align="center"><b>Class</b></td>
                                <td colspan="3">{{$VoucherInfo->student_enrollment->student_class->name . ' : ' . $VoucherInfo->student_enrollment->section->name}}</td>
                            </tr>
                            <tr>
                                <td class="bold">Issue Date</td>
                                <td>{{$VoucherInfo->issue_at_formatted}}</td>
                                <td class="bold">Due Date.</td>
                                <td class="bold">{{$VoucherInfo->expiry_at_formatted}}</td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="fee-desc">
                            <table class="maintable">
                                <thead>
                                <tr>
                                    <th>Fee Description</th>
                                    <th>Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $total = 0; @endphp
                                @foreach($VoucherInfo->student_fee_voucher_details as $VoucherDetail)
                                    @php $total += $VoucherDetail->amount;  @endphp
                                    <tr>
                                        <td>{{$VoucherDetail->fee_head->name}}</td>
                                        <td class="text-center">{{$VoucherDetail->amount}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="total-fee">
                            <table class="maintable">
                                <tbody>
                                <tr>
                                    <td>Payable Within Due Date</td>
                                    <td class="text-center">{{$total}}/-</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="terms">
                            <span><b>{{\App\Helpers\SiteHelper::AmountInWords($total)}}</b></span>
                            <h4 style="margin: 0; padding: 0">PAYMENTS TERMS</h4>
                            <div class="terms-list">
                                <p>Respected Parents</p>
                                <ol>
                                    <li>Please Deposit Your Child Dues upto 10 of Every Month.</li>
                                    <li>Please Deposit Your Child Dues upto 10 of Every Month.</li>
                                </ol>
                            </div>
                        </div>
                        <div class="signature">
                            <table>
                                <tbody>
                                <tr style="padding: 10px">
                                    <td>
                                        <span>Stamp</span>
                                    </td>
                                    <td align="right">
                                        <span>Authorized Signatures</span>
                                        <p style="font-size: 10px;text-align: center"
                                           align="center">{{$user->first_name}}</p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
            @endfor

            <!--End of subpage-->
            </div>
        </div>
    @endforeach
</div>
</body>
</html>
