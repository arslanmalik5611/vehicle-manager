<!DOCTYPE html>
<html>
<head>
<!--    <script type="text/javascript" src="--><?php //echo base_url('assets/global/plugins/jquery.min.js'); ?><!--"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Student Day Book</title>
    <style type="text/css">
        body {
            background: rgb(204, 204, 204);
            background: white;

        }

        * {
            margin: 0px auto;
            padding: 0px;
            font-family: "Calibri";
            font-size: 14px;
            font-weight: bold;
        }

        table {
            border-color: "#E6E6E6";
            font-size: 17px;
            border-top: 3px solid #000;
        }

        td {
            text-align: center;
        }

        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .total {
            text-align: right;
            padding-right: 15px;
            font-weight: bold;
            font-size: 19px;
        }

        .totalprice {
            text-align: left;
            padding-left: 20px;
            width: 100px;
            font-weight: bold;
            font-size: 19px;
        }

        .p {
            font-weight: bold;
            font-size: 14px;

        }

        page {
            background: white;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
        }

        page[size="A4"] {
            width: 21cm;
            height: 29.7cm;
        }

        page[size="A4"][layout="landscape"] {
            width: 29.7cm;
            height: 21cm;
        }

        .grandtotal_amount {
            text-align: center;
            padding-left: 10px;
            font-size: 16px !important;
            font-weight: bold;
        }

        @media print {
            body, page {
                margin: 0;
                box-shadow: 0;
            }
        }

        tr {
            page-break-before: always;
            page-break-inside: avoid;
        }
    </style>
</head>
<body>
<?php //echo '<pre>'; print_r($data); die(); ?>
<page size="A4" layout="landscape">
    <div id="main_centerBody">
        <table id="tbl" style="width: 100%">
            <thead>
            <tr>
                <td colspan="4" style="text-align: right;border-right: none;padding-left: 80px;">
                    <img src="<?php echo $school['logo_url']; ?>"
                         style="width:200px;height:100px;">
                </td>
                <td colspan="5" style="border-left: none;text-align: center">
                    <div class="header-title">
                        <p style="font-weight:bold;font-size:16px;letter-spacing:4px"><?php echo $school['name']; ?></p>
                        <p class="p"><?php echo $school['address']; ?></p>
                        <p class="p"><?php echo $school['phone'] . " / " . $school['email']; ?></p>
                    </div>
                </td>
            </tr>

            </thead>
            <tbody>
            <?php
            if (empty($data)) {
                ?>
                <tr style="background:#ffd700;">
                    <td colspan="8">
                        No record found.
                    </td>
                </tr>
                <?php
            } else {
                ?>
            @foreach($data as $key => $stduent)
                <tr style="background-color:#7fffd4;color:#000000;text-align: left">
                    <td style="width: 20px;text-align: left;padding-left: 10px;" colspan="9">{{$key}}</td>
                </tr>
                <tr style="background-color:#000;color:#fff;">
                    <td>Class</td>
                    <td>Total Student</td>
                    <td>Present</td>
                    <td>Absent</td>
                    <td>Leave</td>
                    <td>Late</td>
                    <td>Late With Excuse</td>
                    <td>Holiday</td>
                    <td>Half Day</td>
                </tr>
                @foreach($stduent as $class)
                    <tr>
                        <td>{{$class['class']}}</td>
                        <td>{{$class['total_student']}}</td>
                        <td>{{$class['present']}}</td>
                        <td>{{$class['absent']}}</td>
                        <td>{{$class['leave']}}</td>
                        <td>{{$class['late']}}</td>
                        <td>{{$class['late_with_excuse']}}</td>
                        <td>{{$class['holiday']}}</td>
                        <td>{{$class['half_day']}}</td>
                    </tr>
                @endforeach
            @endforeach

            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</page>
<script type="text/javascript" src="../assets/global/plugins/jquery.min.js"></script>
<script type="text/javascript">
    $(document).on('click', '.remove', function () {
        var r = confirm("Are you sure want to delete this Row?");
        if (r == true) {
            exp_id = $(this).attr('exp_id');
            thisRow = $(this);
            $.ajax({
                type: "POST",
                url: "delete_expense",
                data: {"exp_id": exp_id},
                dataType: "JSON",
                success: function (returnData) {
                    console.log(returnData);
                    if (returnData.response == 'Success') {
                        $(thisRow).parents('tr').remove();
                    } else {
                        alert("Unable to delete the record");
                    }

                },
                error: function (returnData) {
                    alert("Unable to delete the record");
                },

            });
        }
    });

    window.onbeforeprint = function () {
        $('.remove').text('');
    };
</script>
</body>
</html>
