<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Attendance History</title>
    <style>
        table {
            width: 100%;
            line-height: 10pt;
            text-align: left;
            /*border-spacing: 0;*/
            border-collapse: collapse;
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

    </style>
</head>
<body>
<style>
    .attendance-type-td {
        font-size: 15px !important;
    }
</style>
<div class="main">
    {{--        @php echo '<pre>'; print_r($data); die(); @endphp--}}
    <div class="card text-dark shadow-2 mb-3" style="width: 70%; margin: auto">
        <div class="card-header">
            <table>
                <tr>
                    <td style="width: 170px">
                        <img src="{{$school->logo_url}}" width="150" alt="">
                    </td>
                    <td>
                        <h2 class="school-name">
                            {{$school->name}}
                        </h2>
                        <p>{{$school->address}}</p>
                        <p><span>Email : </span>{{$school->email}}</p>
                        <p><span>Phone :</span>{{$school->phone}}</p>
                    </td>
                </tr>
            </table>
        </div>
        <div class="card-body">
            <table class="table table-bordered tabs-table attendance-table maintable">
                <thead>
                </thead>
                <tbody class="attendanceBody">
                @foreach($data as $student)
                    <tr>
                        <td colspan="7">{{$student->name}}</td>
                    </tr>
                    <tr>
                        <th>Month</th>
                        <th>Roll No</th>
                        <th>Name</th>
                        <th>Father Name</th>
                        <th>Voucher No</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                    @if($student->student)
                        @foreach($student->student as $voucher)
                            <tr style="text-align: center;">
                                <td>{{$voucher['student_voucher']['month_formatted']}}</td>
                                <td>{{$voucher['roll_no']}}</td>
                                <td><a href="{{env('BASE_URL')}}student/{{$voucher['id']}}/detail"
                                       target="_blank">{{$voucher['user']['first_name'] . ' ' . $voucher['user']['first_name'] ?? ''}}</a>
                                </td>
                                <td>{{$voucher['user']['father_name']}}</td>
                                <td>{{$voucher['student_voucher']['fee_voucher_number']}}</td>
                                <td>{{$voucher['student_voucher']['payable_amount']}}</td>
                                <td>{{$voucher['student_voucher']['status']}}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center" style="text-align: center; background: #ccc">
                                No Data Found
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="print">
    <p style="text-align: right;margin-right: 80px"><img src="{{asset('panel_assets/images/print.png')}}" alt=""
                                                         width="100" class="print-page" onclick="window.print()"></p>
</div>

<script type="text/javascript">
    // $(document).on
</script>
</body>
</html>


