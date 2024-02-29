@extends('layout.master')
@section('page_title','Attendance')

@section('content')
    <style>
        .attendance-type-td {
            font-size: 15px !important;
        }
    </style>
    <div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="text-info"><i class="fas fa-plus-circle fa-icon"></i> Student Attendance </h2>
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
                        <label for="class_id" class="form-label">Class </label>
                        <select name="class_id" id="class_id" class="class_id select2"></select>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <label for="section_id" class="form-label d-flex justify-content-between">
                            <span>Section</span>
                        </label>
                        <select name="section_id" id="section_id" class="section_id select2"></select>
                    </div>

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
                        <td>Class : <span class="student_class"></span></td>
                        <td>Section : <span class="section"></span></td>
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
                        <th>Roll</th>
                        <th class="attendanceAllcheckBox">
                            {{--                            Attendance--}}
{{--                            <span> <input type="radio" id="checkAllPresent" name="atendance">Prsent</span>--}}
{{--                            <span> <input type="radio" id="checkAllLateWithExcuse"--}}
{{--                                          name="atendance"> Late with excuse</span>--}}
{{--                            <span> <input type="radio" id="checkAllLate" name="atendance">Late</span>--}}
{{--                            <span> <input type="radio" id="checkAllAbsent" name="atendance">Absent </span>--}}
{{--                            <span> <input type="radio" id="checkAllHoliday" name="atendance">Holiday</span>--}}
{{--                            <span> <input type="radio" id="checkAllHalfDay" name="atendance">Half Day</span>--}}
                        </th>
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
            sections_load();
            class_load();
            attendance_type_load();
            nav_bar_hide();
            setTimeout(function () {
                attendance_type_check_radio();
            }, 4000);

            $(document).on('click', "#check_present", function () {
                $('.present').not(this).prop('checked', this.checked);
            });

            $(document).on('click', "#check_late_with_excuse", function () {
                $('.late_with_excuse').not(this).prop('checked', this.checked);
            });

            $(document).on('click', "#check_late", function () {
                $('.late').not(this).prop('checked', this.checked);
            });

            $(document).on('click', "#check_absent", function () {
                $('.absent').not(this).prop('checked', this.checked);
            });

            $(document).on('click', "#check_holiday", function () {
                $('.holiday').not(this).prop('checked', this.checked);
            });

            $(document).on('click', "#check_half_day", function () {
                $('.half_day').not(this).prop('checked', this.checked);
            });

            $(document).on('click', "#check_leave", function () {
                $('.leave').not(this).prop('checked', this.checked);
            });

        });


        //ATTENDACE TYPE LOAD FOR ALL OPTION SELECT
        function attendance_type_check_radio() {
            attendanceTypeData = '';
            $(attendanceTypes).each(function (i, data) {
                attendanceTypeData += `
                <label> <input type="radio" id="check_${data.code}" name="atendance">${data.name}</label>
                `;
            });

            $('.attendanceAllcheckBox').html(attendanceTypeData);
        }

        attendanceTypeData = '';
        // GET STUDENT FOR ATTENDANCE
        $(document).ready(function () {
            $("#form-data").on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: api_url + "student-attendances/search-student",
                    type: "POST",
                    data: $(this).serialize(),
                    dataType: "JSON",
                    success: function (response) {
                        if (response.status) {
                            $('.attendanceTableBody').html('');
                            unmarked_students = '';
                            marked_students = '';
                            count = 1;
                            $(response.unmarked_students).each(function (i, data) {
                                attendance_type(data.student.id);

                                unmarked_students = `
                                           <tr class="student-mainRow" data-student-enrollment-id="${data.id}">
                                                <td>${count++}</td>
                                                <td>${data.student.user.first_name} ${data.student.user.last_name ?? ''}</td>
                                                <td>${data.student.user.first_name} ${data.student.user.last_name ?? ''}
                                                </td>
                                                <td>${data.student.user.email ?? ''}</td>
                                                <td>${data.student.roll_no}</td>
                                                <td class="attendance-type-td">${attendanceTypeData}</td>
                                            </tr>
                            `;
                                $('.attendanceTableBody').append(unmarked_students);
                            });

                            if (response.marked_students) {
                                $(response.marked_students).each(function (i, data) {
                                    console.log(data)
                                    type = data.student_attendances[0].attendance_type.code;
                                    attendance_type(data.student.id);

                                    marked_students = `
                                           <tr class="student-mainRow marked_students_row" data-student-enrollment-id="${data.id}">
                                                <td>${count++}</td>
                                                <td>${data.student.user.first_name} ${data.student.user.last_name ?? ''}</td>
                                                <td>${data.student.user.first_name} ${data.student.user.last_name ?? ''}
                                                </td>
                                                <td>${data.student.user.email ?? ''}</td>
                                                <td>${data.student.roll_no}</td>
                                                <td class="attendance-type-td">${attendanceTypeData}</td>
                                            </tr>
                            `;
                                    $('.attendanceTableBody').append(marked_students);
                                    setTimeout(function () {
                                        $('.' + type + data.student.id).attr('checked', true);
                                    }, 1000);
                                });
                            }

                            if (response.unmarked_students.length != 0) {
                                var class_name = response.unmarked_students[0].student_class.name;
                                var section_name = response.unmarked_students[0].section.name;
                            } else {
                                class_name = response.marked_students[0].student_class.name;
                                section_name = response.marked_students[0].section.name;
                            }

                            $('.attendance-card').show();
                            $('.student_class').html(class_name);
                            $('.section').html(response.section_name);
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
                <label><input type="radio" class="attendance_type_id btn btn-warning ${data.code} ${data.code + student_id}" value="${data.id}" name="attendance${student_id}">
                        <span>${data.name}</span></lable>
                `;
            });

            return attendanceTypeData;
        }


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

