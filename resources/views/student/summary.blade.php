<!DOCTYPE html>
<html>
<head>
    <title>Student Detail</title>
</head>
<body>
<style type="text/css">
    .bgtd {
        background: #CDE;
        width: 200px;
        height: 25px;
    }

    .datatd {
        width: 30%;
    }

    .st_bgtd {
        background: #CDE;
        width: 190px;
    }

    .st_datatd {
        width: 225px;
    }

    .ft_bgdata {
        width: 180px;
        background: #CDE;
    }

    .ft_datatd {
        width: 180px;
    }

    .sib_bgdata {
        width: 180px;
        background: #CDE;
    }

    .sib_datatd {
        width: 180px;
    }

    .edu_bgdata {
        width: 170px;
        background: #CDE;
    }

    tr > .attendance {
        text-align: center;
    }

    .sectionHeads {
        background: #CCB;
        font-size: 20px;
    }
</style>
<table border="1px solid" width="1060px" align="center" style="border-collapse: collapse;">
{{--        @php echo '<pre>'; print_r($attendances); die(); @endphp--}}
    <tr>
        <td>
            <table style="border-collapse: collapse;height: 30px;">
                <tr>
                    <td>
                        <font size="5px">{{$student->user->first_name}}</font>
                    </td>
                </tr>
                <tr style="border: 1px solid #ccc;">
                    <td class="bgtd">Campus</td>
                    <td class="datatd">{{$student->enrollment->campus->name}}</td>
                    <td class="bgtd">Session</td>
                    <td class="datatd">{{$student->enrollment->session->name}}</td>
                </tr>
                <tr style="border: 1px solid #ccc;">
                    <td class="bgtd">Class</td>
                    <td class="datatd">{{$student->enrollment->student_class->name}}</td>
                    <td class="bgtd">Section</td>
                    <td class="datatd">{{$student->enrollment->section->name}}</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table border="1px" style="border-collapse: collapse;">
                <tr>
                    <td style="width: 880px;">
                        <table border="1px" style="border-collapse: collapse;border-bottom: none;">
                            <tr>
                                <td colspan="4" class="sectionHeads">Student Information</td>
                            </tr>
                            <tr>
                                <td class="st_bgtd">Name</td>
                                <td class="st_datatd">{{$student->user->first_name . $student->user->last_name ?? '' }}</td>
                                <td class="st_bgtd">Registration#</td>
                                <td class="st_datatd">{{$student->registration_no}}</td>

                            </tr>
                            <tr>
                                <td class="st_bgtd">Roll Number</td>
                                <td class="st_datatd">{{$student->roll_no}}</td>
                                <td class="st_bgtd">CNIC#</td>
                                <td class="st_datatd">{{$student->user->cnic ?? '' }}</td>

                            </tr>
                            <tr>
                                <td class="st_bgtd">Gender</td>
                                <td class="st_datatd">{{$student->user->gender ?? 'Not answered' }}</td>
                                <td class="st_bgtd">DOB#</td>
                                <td class="st_datatd">{{$student->user->dob ?? '' }}</td>

                            </tr>
                            <tr>
                                <td class="st_bgtd">Phone (Primary)</td>
                                <td class="st_datatd"></td>
                                <td class="st_bgtd">Phone (Alternative)</td>
                                <td class="st_datatd"></td>

                            </tr>
                            <tr>
                                <td class="st_bgtd">Email (Primary)</td>
                                <td class="st_datatd">{{$student->user->email ?? '' }}</td>
                                <td class="st_bgtd">Email (Alternative)</td>
                                <td class="st_datatd">{{$student->email_secondary ?? '' }}</td>

                            </tr>
                            <tr>
                                <td class="st_bgtd">Address (Permanent)</td>
                                <td class="st_datatd" colspan="2">{{$student->user->address ?? '' }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="st_bgtd">Address (Temporary)</td>
                                <td class="st_datatd" colspan="2">{{$student->address_temporary ?? '' }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="st_bgtd">Admission Date</td>
                                <td class="st_datatd">{{$student->admission_at ?? '' }}</td>
                                <td class="st_bgtd">Status</td>
                                <td class="st_datatd">{{$student->status ?? '' }}</td>

                            </tr>
                            <tr>
                                <td class="st_bgtd">Remarks</td>
                                <td colspan="3"></td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 220px;"><!--Image td-->
                        <img src="{{$student->user->picture_url ?? '' }}" style="width: 220px;height: 220px;">
                    </td>
                </tr><!--End of Student information section-->
                <tr>
                    <td colspan="2">
                        <table border="1px" style="border-collapse: collapse;border-bottom: none;">
                            <tr>
                                <td colspan="6" class="sectionHeads">Father Information</td>
                            </tr>
                            <tr>
                                <td class="ft_bgdata">Father Name</td>
                                <td class="ft_datatd">{{$student->guardian->user->first_name ?? '' }}</td>
                                <td class="ft_bgdata">Father CNIC</td>
                                <td class="ft_datatd">{{$student->guardian->user->cnic ?? '' }}</td>
                                <td class="ft_bgdata">Father Occupation</td>
                                <td class="ft_datatd">{{$student->guardian->occupation ?? '' }}</td>

                            </tr>
                            <tr>
                                <td class="ft_bgdata">Father Income <small>(Monthly)</small></td>
                                <td class="ft_datatd">{{$student->guardian->income ?? '' }}</td>
                                <td class="ft_bgdata">Father Phone</td>
                                <td class="ft_datatd">{{$student->guardian->user->phone ?? '' }}</td>
                                <td class="ft_bgdata">Father Email</td>
                                <td class="ft_datatd">{{$student->guardian->user->email ?? '' }}</td>

                            </tr>
                            <tr>
                                <td colspan="6" class="sectionHeads">Guardian Information</td>
                            </tr>
                            <tr>
                                <td class="ft_bgdata">Guardian Name</td>
                                <td class="ft_datatd"></td>
                                <td class="ft_bgdata">Guardian CNIC</td>
                                <td class="ft_datatd"></td>
                                <td class="ft_bgdata">Guardian Occupation</td>
                                <td class="ft_datatd"></td>

                            </tr>
                            <tr>
                                <td class="ft_bgdata">Guardian Phone</td>
                                <td class="ft_datatd"></td>
                                <td class="ft_bgdata">Guardian Email</td>
                                <td class="ft_datatd"></td>
                                <td class="ft_bgdata"></td>
                                <td class="ft_datatd"></td>

                            </tr>
                        </table>
                    </td>
                </tr><!--End of father information section-->

                <tr>
                    <td colspan="2">
                        <table border="1px" style="border-collapse: collapse;text-align: center;border-bottom: none;">
                            <tr>
                                <td colspan="5" style="text-align: left;" class="sectionHeads">Sibling Information</td>
                            </tr>
                            <tr>
                                <th style="width: 215px;background: #CDE;">Sibling Name</th>
                                <th class="sib_bgdata">Relation</th>
                                <th class="sib_bgdata">Age</th>
                                <th class="sib_bgdata">Qualification</th>
                                <th style="width: 300px;background: #CDE;">Remarks</th>
                            </tr>
                            @if($student->siblings)
                                @foreach($student->siblings as $sibling)
                                    <tr>
                                        <td>{{$sibling->name}}</td>
                                        <td>{{$sibling->role->name}}</td>
                                        <td>{{$sibling->age}}</td>
                                        <td>{{$sibling->qualification->name}}</td>
                                        <td>{{$sibling->notes}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <td colspan='5'>No record found.</td>
                            @endif
                        </table>
                    </td>
                </tr><!--End of Sibling section-->
                <tr>
                    <td colspan="2">
                        <table border="1px" style="border-collapse: collapse;text-align: center;border-bottom: none;">
                            <tr>
                                <td colspan="8" style="text-align: left;" class="sectionHeads">Educational Information
                                </td>
                            </tr>
                            <tr>
                                <th class="edu_bgdata">Degree Name</th>
                                <th class="edu_bgdata">Subjects <small>(Majors)</small></th>
                                <th class="edu_bgdata">Board/University</th>
                                <th class="edu_bgdata">Passing Year</th>
                                <th class="edu_bgdata">Total Makrs</th>
                                <th class="edu_bgdata">Obtained Makrs</th>
                                <th class="edu_bgdata">Division</th>
                            </tr>
                            @if($student->education)
                                @foreach($student->education as $education)
                                    <tr>
                                        <td>{{$education->qualification->name}}</td>
                                        <td>{{$education->subject}}</td>
                                        <td>{{$education->university}}</td>
                                        <td>{{$education->passing_year}}</td>
                                        <td>{{$education->total_marks}}</td>
                                        <td>{{$education->obtained_marks}}</td>
                                        <td>{{$education->division}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <td colspan='8'>No record found.</td>
                            @endif
                        </table>
                    </td>
                </tr><!--End of Education section-->

                <tr>
                    <td colspan="2">
                        <table border="1px" style="border-collapse: collapse;text-align: center;border-bottom: none;">
                            <tr>
                                <td colspan="8" style="text-align: left;" class="sectionHeads">Fees Information</td>
                            </tr>
                            <tr>
                                <th class="edu_bgdata">Fv Number</th>
                                <th class="edu_bgdata">Month-Year</th>
                                <th class="edu_bgdata">Issue Date</th>
                                <th class="edu_bgdata">Last Date</th>
                                <th class="edu_bgdata">Depositor Name</th>
                                <th class="edu_bgdata">Depositor Phone</th>
                                <th class="edu_bgdata">Amount <small>(Total)</small></th>
                                <th class="edu_bgdata">Status</th>
                            </tr>
                            @if($student->enrollment->student_fee_vouchers)
                                @foreach($student->enrollment->student_fee_vouchers as $voucher)
                                    <tr>
                                        <td>{{$voucher->fee_voucher_number}}</td>
                                        <td>{{$voucher->month_formatted}}</td>
                                        <td>{{$voucher->issue_at_formatted}}</td>
                                        <td>{{$voucher->expiry_at_formatted}}</td>
                                        <td>{{$voucher->depositor_name}}</td>
                                        <td>{{$voucher->depositor_phone}}</td>
                                        <td>{{$voucher->payable_amount}}</td>
                                        <td>{{$voucher->status}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <td colspan='9'>No record found.</td>
                            @endif
                        </table>
                    </td>
                </tr><!--End of Fee section-->
                <tr>
                    <td colspan="2">
                        <table width="100%" style="border-collapse: collapse;" border="1px solid;">
                            <tr>
                                <td colspan="32" style="text-align: left;" class="sectionHeads">Attendance</td>
                            </tr>
                            <tr style="background: #CDE">
                                <th></th>
                                <th>
                                    01
                                </th>
                                <th>
                                    02
                                </th>
                                <th>
                                    03
                                </th>
                                <th>
                                    04
                                </th>
                                <th>
                                    05
                                </th>
                                <th>
                                    06
                                </th>
                                <th>
                                    07
                                </th>
                                <th>
                                    08
                                </th>
                                <th>
                                    09
                                </th>
                                <th>
                                    10
                                </th>
                                <th>
                                    11
                                </th>
                                <th>
                                    12
                                </th>
                                <th>
                                    13
                                </th>
                                <th>
                                    14
                                </th>
                                <th>
                                    15
                                </th>
                                <th>
                                    16
                                </th>
                                <th>
                                    17
                                </th>
                                <th>
                                    18
                                </th>
                                <th>
                                    19
                                </th>
                                <th>
                                    20
                                </th>
                                <th>
                                    21
                                </th>
                                <th>
                                    22
                                </th>
                                <th>
                                    23
                                </th>
                                <th>
                                    24
                                </th>
                                <th>
                                    25
                                </th>
                                <th>
                                    26
                                </th>
                                <th>
                                    27
                                </th>
                                <th>
                                    28
                                </th>
                                <th>
                                    29
                                </th>
                                <th>
                                    30
                                </th>
                                <th>
                                    31
                                </th>
                            </tr>
                            {{--                                @php echo '<pre>'; print_r($attendance); die(); @endphp--}}
                            @foreach($attendances as $month => $attendance)
                                <tr>
                                    <td>{{$month}}</td>
                                    @foreach($attendance as $att)
                                        <td style="background: {{$att[1]}}; text-align: center; vertical-align: center;">{{$att[0]}}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </table>
                    </td>
                </tr><!--End of Attendance section-->

            </table><!--Interal Main table-->
        </td>
    </tr>
</table>
</body>
</html>
