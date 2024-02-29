<!DOCTYPE html>
<!-- saved from url=(0108)http://localhost:8000/report-print/2124900004?header=true&footer=true&electronically_verified=true&tests=6_0 -->
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Mauzoun QT2021MMDDNN Client</title>
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
        .text-center{
            text-align: center !important;
        }
        .student-copy{
            width: 33% !important;
            border: 2px solid #000;
        }

        .student-copy .logo{
            width: 160px;
        }
        .student-copy .logo img{
            width: 100%;
        }

        .student-copy .school-info{
            width: 347px;
            text-align: center;
        }
        .student-copy .qr-code{
            text-align: right;
        }

        .student-copy .qr-code img{
            width: 100%;
        }
        p{
            font-size: 20px !important;
        }
        .bold{
            font-weight: 700;
        }
        .fee-desc{
            height: 300px !important;
        }
        .terms{
            padding: 10px !important;
        }
        .terms h4{
            margin-bottom: 0px !important;
        }
        .terms .terms-list{
            border: 1px solid #000;
        }
        .terms .terms-list p{
            margin-top: 0px;
            margin-bottom: 0px;
            font-size: 14px !important;
        }
        .signature{
            margin-top: 35px !important;
        }
    </style>
</head>
<body>
<div class="book">
    <div class="page">
        <div class="subpage">
            <div class="student-copy">
                <div class="header">
                    <table>
                        <tr>
                            <td class="logo">
                                <img src="images/logo.png" alt="">
                            </td>
                            <td class="school-info">
                                <p>
                                    Beacon House School
                                </p>
                                <h2>
                                    india
                                </h2>
                                <p>
                                    1212324
                                </p>
                            </td>
                            <td class="qr-code">
                                <img src="images/qr-code.png" alt="" width="100">
                            </td>
                        </tr>
                    </table>
                </div>
                <table class="maintable ">
                    <thead>
                    <tr>
                        <th>Fee Voucher</th>
                        <th>2022</th>
                        <th>Slip id.</th>
                        <th>1</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="bold">Student's Name</td>
                        <td colspan="3">Jhon Doe</td>
                    </tr>
                    <tr>
                        <td class="bold">Father's Name</td>
                        <td colspan="3">Mark Doe</td>
                    </tr>
                    <tr>
                        <td class="bold">Admission No</td>
                        <td>1</td>
                        <td align="center"><b>Class</b></td>
                        <td>2nd : A</td>
                    </tr>
                    <tr>
                        <td class="bold">Issue Date</td>
                        <td>2020-03-30</td>
                        <td colspan="2" align="center"><b>Fee bill No.</b></td>
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
                        <tr>
                            <td>January Month</td>
                            <td class="text-center">2000</td>
                        </tr>
                        <tr>
                            <td>January Admission</td>
                            <td class="text-center">1000</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="total-fee">
                    <table class="maintable">
                        <tbody>
                        <tr>
                            <td>Payable Within Due Date</td>
                            <td class="text-center">3000</td>
                        </tr>
                        <tr>
                            <td>Payable After Due Date</td>
                            <td class="text-center">3010</td>
                        </tr>
                        <tr>
                            <td>Payable After Month</td>
                            <td class="text-center">3100</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="terms">
                    <h4>PAYMENTS TERMS</h4>
                    <div class="terms-list">
                        <p>Respected Parents</p>
                        <ol>
                            <li>Please Deposit Your Child Dues upto 10 of Every Month.</li>
                        </ol>
                    </div>
                </div>
                <div class="signature">
                    <table>
                        <tbody>
                        <tr>
                            <td>
                                <span>Stamp</span>
                            </td>
                            <td align="right">
                                <span>Authorized Signatures</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!--End of subpage-->
        </div>
    </div>
</div>
</body>
</html>