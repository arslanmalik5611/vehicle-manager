@extends('layout.master')
@section('page_title','Attendance')

@section('content')
    <style>
        .attendance-type-td {
            font-size: 15px !important;
            font-width: 800;
        }
    </style>
    <div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="text-info"><i class="fas fa-plus-circle fa-icon"></i> User Attendance </h2>
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
                    <div class="col-md-3 col-sm-6 col-12">
                        <label for="attendance_at" class="form-label d-flex justify-content-between">
                            <span>Date</span>
                        </label>
                        <input type="text" class="datepicker attendance_at form-control"
                               name="attendance_at" id="attendance_at" autocomplete="off" placeholder="dd/mm/yyyy">
                    </div>

                    <div class="col-md-3 col-sm-6 col-12">
                        <button type="submit" class="btn btn-primary searchStudent" style="margin-top: 31px">Search
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card text-dark shadow-2 mb-3 attendance-card" style="max-width: 18rem; display: none">
        <div class="card-body">
            <form id="form-data-2">
                <table class="table table-striped table-bordered table-hover table-responsive attendance-detail">
                    <tbody>
                    <tr class="colored-bg">
                        <td>Day : <span class="day"></span></td>
                        <td>Date : <span class="date"></span></td>
                    </tr>
                    </tbody>
                </table>
                <table class="table table-striped table-bordered table-hover table-responsive">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Joining Date</th>
                        <th>
                            {{--                            Attendance--}}
                            <span> <input type="radio" id="checkAllPresent" name="atendance">Prsent</span>
                            <span> <input type="radio" id="checkAllLateWithExcuse"
                                          name="atendance"> Late with excuse</span>
                            <span> <input type="radio" id="checkAllLate" name="atendance">Late</span>
                            <span> <input type="radio" id="checkAllAbsent" name="atendance">Absent </span>
                            <span> <input type="radio" id="checkAllHoliday" name="atendance">Holiday</span>
                            <span> <input type="radio" id="checkAllHalfDay" name="atendance">Half Day</span>
                        </th>
                        <th>Check In</th>
                        <th>Check Out</th>
                    </tr>
                    </thead>
                    <tbody class="attendanceTableBody">

                    </tbody>
                </table>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-success mb-4 submit-btn">Save <i
                            class="fas fa-chevron-right ms-3 go-icon"></i> <i
                            class="fas fa-circle-notch fa-spin spinner-icon" style="display: none"></i></button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('page_level_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            sections_optional_load();
            classes_optional_load();
            attendance_type_load();
            nav_bar_hide();

            $(document).on('click', "#checkAllPresent", function () {
                $('.present').not(this).prop('checked', this.checked);
            });

            $(document).on('click', "#checkAllLateWithExcuse", function () {
                $('.late_with_excuse').not(this).prop('checked', this.checked);
            });

            $(document).on('click', "#checkAllLate", function () {
                $('.late').not(this).prop('checked', this.checked);
            });

            $(document).on('click', "#checkAllAbsent", function () {
                $('.absent').not(this).prop('checked', this.checked);
            });

            $(document).on('click', "#checkAllHoliday", function () {
                $('.holiday').not(this).prop('checked', this.checked);
            });

            $(document).on('click', "#checkAllHalfDay", function () {
                $('.half_day').not(this).prop('checked', this.checked);
            });

        });

        attendanceTypeData = '';
        // GET STUDENT FOR ATTENDANCE
        $(document).ready(function () {
            $("#form-data").on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: api_url + "user-attendances/search-users",
                    type: "POST",
                    data: $(this).serialize(),
                    dataType: "JSON",
                    success: function (response) {
                        if (response.status) {
                            $('.attendanceTableBody').html('');
                            unmarked_users = '';
                            marked_students = '';
                            count = 1;
                            $(response.unmarked_users).each(function (i, data) {
                                attendance_type(data.id);

                                unmarked_users = `
                                           <tr class="user-mainRow" data-user-session-id="${data.id}">
                                                <td>${count++}</td>
                                                <td><img src="${data.user.user_picture_url}" alt=""></td>
                                                <td>${data.user.first_name} ${data.user.last_name ?? ''}
                                                </td>
                                                <td>${data.user.email ?? ''}</td>
                                                <td>${data.joining_date_formatted}</td>
                                                <td class="attendance-type-td">${attendanceTypeData}</td>
                                                <td><input type="time" class="form-control check_in" name="check_in" value="{{Config::get('global.check_in')}}"></td>
                                                <td><input type="time" class="form-control check_out" name="check_out" value="{{Config::get('global.check_out')}}" ></td>
                                            </tr>
                            `;
                                $('.attendanceTableBody').append(unmarked_users);
                            });

                            if (response.marked_users) {
                                $(response.marked_users).each(function (i, data) {
                                    let attendance = data.user_attendances;
                                    type = attendance.attendance_type.code;
                                    attendance_type(data.id);

                                    marked_users = `
                                          <tr class="user-mainRow" data-user-session-id="${data.id}">
                                                <td>${count++}</td>
                                                <td><img src="${data.user.user_picture_url}" alt="" width="100" style="width: 100px"></td>
                                                <td>${data.user.first_name} ${data.user.last_name ?? ''}
                                                </td>
                                                <td>${data.user.email ?? ''}</td>
                                                <td>${data.joining_date_formatted}</td>
                                                <td class="attendance-type-td">${attendanceTypeData}</td>
                                                <td><input type="time" class="form-control check_in" name="check_in" value="${attendance.check_in}"></td>
                                                <td><input type="time" class="form-control check_out" name="check_out" value="${attendance.check_out}" ></td>
                                            </tr>
                            `;
                                    $('.attendanceTableBody').append(marked_users);
                                    setTimeout(function () {
                                        $('.' + type + data.id).attr('checked', true);
                                    }, 1000);
                                });
                            }
                            $('.attendance-card').show();
                            $('.date').html(response.date);
                            $('.day').html(response.day);

                            // success_notify(response.message);

                        } else {
                            error_notify(response.message);
                        }
                    }
                });
            });
        })

        function attendance_type(student_id) {
            attendanceTypeData = '';
            $(attendanceTypes).each(function (i, data) {
                attendanceTypeData += `
                <input type="radio" class="attendance_type_id btn btn-warning ${data.code} ${data.code + student_id}" value="${data.id}" name="attendance${student_id}">
                        <span>${data.name}</span>
                `;
            });

            return attendanceTypeData;
        }


        // SAVE STUDENT ATTENDANCE
        $("#form-data-2").on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: api_url + "user-attendances/store",
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

            $('.user-mainRow').each(function () {
                attendances = {
                    'user_session_id': $(this).attr('data-user-session-id'),
                    'attendance_type_id': $(this).find('.attendance_type_id:checked').val() ?? '',
                    'check_in': $(this).find('.check_in').val(),
                    'check_out': $(this).find('.check_out').val(),
                }
                data.attendances.push(attendances);
            });
            return data;
        }

    </script>
@endsection

