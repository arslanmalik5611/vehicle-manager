@extends('layout.master')
@section('page_title','Attendance')

@section('content')
    <div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="text-info"><i class="fas fa-qrcode fa-icon"></i> Student Attendance with QR </h2>
                </div>
                {{--                <div>--}}
                {{--                    <a href="{{env('BASE_URL').'attendances'}}" class="btn btn-outline-success btn-sm">Attendance--}}
                {{--                        List</a>--}}
                {{--                </div>--}}
            </div>
        </div>
        <div class="card-body">
            <form method="post" id="form-data">
                <div class="row mb-3">
                    <div class="col-md-6 col-12">
                        <label for="registration_no" class="form-label d-flex justify-content-between">
                            <span>Registration No</span>
                        </label>
                        <input type="text" class="registration_no form-control"
                               name="registration_no" id="registration_no" autocomplete="off"
                               placeholder="Enter Registration No">
                    </div>

                    <div class="col-md-6 col-12">
                        <button type="submit" class="btn btn-primary searchStudent" style="margin-top: 31px">Search
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card text-dark shadow-2 mb-3 student-main-card" style="max-width: 18rem; display: none">
        <div class="card-body">
            <div class="container mt-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-7">
                        <div class="card hovercard">
                            <div class="cardheader">

                            </div>
                            <div class="avatar">
                                <img alt=""
                                     src=""
                                     id="student_Image">
                            </div>
                            <div class="info">
                                <table class="table table-bordered table-hover">
                                    <tr>
                                        <th>Registration No</th>
                                        <td class="std_registration_no"></td>
                                        <th>Roll No</th>
                                        <td class="roll_no"></td>
                                    </tr>
                                    <tr>
                                        <th>Name</th>
                                        <td class="student_name"></td>
                                        <th>Admission</th>
                                        <td class="admission_date"></td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td class="student_phone"></td>
                                        <th>Email</th>
                                        <td class="email"></td>
                                    </tr>
                                    <tr>
                                        <th>DOB</th>
                                        <td class="dob"></td>
                                        <th>Address</th>
                                        <td class="address"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <figure class="" style="margin-bottom: 0">
                                                <blockquote class="blockquote" style="margin-bottom: 0">
                                                    <p>Class Info</p>
                                                </blockquote>
                                            </figure>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Campus</th>
                                        <td class="campus"></td>
                                        <th>Class</th>
                                        <td class="class"></td>
                                    </tr>
                                    <tr>
                                        <th>Section</th>
                                        <td class="section"></td>
                                        <th>Group</th>
                                        <td class="group"></td>
                                    </tr>
                                </table>
                                {{--                                <div class="title">--}}
                                {{--                                    <a target="_blank" href="#" id="worker_Name">Umair Kamboh</a>--}}
                                {{--                                </div>--}}
                                {{--                                <div>Badge ID:  <span id="worker_BadgeID">1112</span></div>--}}
                                {{--                                <div>QR Code: <span id="worker_QRCode">111</span></div>--}}
                                {{--                                <div>Phone No: <span id="worker_PhoneNo">+923040602727</span></div>--}}
                                {{--                                <div>Email: <span id="worker_Email">musk.7321@gmail.com</span></div>--}}
                                {{--                                <div>Address: <span id="worker_Address">Eid Gah Road Faisalabad</span></div>--}}
                                {{--                                <div>Joinging Date: <span id="worker_JoiningDate">2020-05-22</span></div>--}}
                                {{--                                <div>Last Scan: <span id="worker_LastScan">19-08-2022 12:50:39</span></div>--}}

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_level_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.registration_no').focus();
        });

        // GET STUDENT FOR ATTENDANCE
        $(document).ready(function () {
            $("#form-data").on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: api_url + "student-attendances/attendance-using-qr",
                    type: "GET",
                    data: $(this).serialize(),
                    dataType: "JSON",
                    success: function (response) {
                        $('.student-main-card').show();
                        var student = response.data;
                        father_name = student.user.father_name == null ? '' : student.user.father_name;
                        $('#student_Image').attr('src', student.user.picture_url);
                        $('.std_registration_no').html(`<a href="{{env('BASE_URL')}}student/${student.id}/detail" target="_blank"> ${student.registration_no} </a>`);
                        $('.roll_no').html(student.roll_no);
                        $('.dob').html(student.user.dob_formatted);
                        // $('.gender').html(student.user.gender);
                        $('.address').html(student.user.address);
                        $('.admission_date').html(student.admission_at_formatted);
                        $('.email').html(student.user.email);
                        $('.student_phone').html(student.user.phone);
                        $('.student_name').html(student.user.first_name + ' ' + father_name);
                        $('.campus').html(student.enrollment.campus.name);
                        $('.class').html(student.enrollment.student_class.name);
                        $('.group').html(student.enrollment.group.name);
                        $('.section').html(student.enrollment.section.name);
                        // $('.guardian').html(student.guardian.user.first_name + ' ' + student.guardian.user.last_name);
                        // $('.father_name').html(student.guardian.user.first_name + ' ' + student.guardian.user.last_name == null ? '' : student.guardian.user.last_name);
                        // $('.father_email').html(student.guardian.user.email);
                        // $('.father_phone').html(student.guardian.user.phone ?? '');
                        if (response.status == true) {
                            success_notify(response.message);
                        } else {
                            error_notify(response.message);
                        }
                    }
                });
            });
        });

        // SAVE STUDENT ATTENDANCE
        $("#form-data-2").on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: api_url + "student-attendances/store",
                type: "POST",
                data: JSON.stringify(getFormData()),
                contentType: "application/json",
                dataType: "JSON",
                success: function (response) {
                    if (response.status) {

                        success_notify(response.message);

                    } else {
                        error_notify(response.message);
                    }
                }
            });
        });

        // GET FORM DATA
        function getFormData() {
            var data = {
                'attendance_at': $('.attendance_at').val(),
                'attendances': []
            }

            $('.student-mainRow').each(function () {
                attendances = {
                    'student_enrollment_id': $(this).attr('data-student-enrollment-id'),
                    'attendance_type_id': $(this).find('.attendance_type_id:checked').val(),
                }
                data.attendances.push(attendances);
            });
            return data;
        }


    </script>
@endsection

