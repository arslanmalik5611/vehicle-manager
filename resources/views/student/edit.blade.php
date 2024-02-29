@extends('layout.master')
@section('page_title','Student')
<link rel="stylesheet" href="{{asset('panel_assets/css/time_line.css')}}">
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="margin-bottom: 40px !important;">
                <div class="body">
                    <div class="cd-horizontal-timeline loaded">
                        <div class="timeline">
                            <div class="events-wrapper">
                                <div class="events" style="width: 50000px;">
                                    <ol>
                                        <li><a href="#0" data-date="01" class="older-event selected" style="left: 0px;">Basic Information</a></li>
                                        <li><a href="#0" data-date="02" class="" style="left: 250px;">Sibling Information</a></li>
                                        <li><a href="#0" data-date="03" class="" style="left: 450px;">Education Detail</a></li>
                                        <li><a href="#0" data-date="04" class="" style="left: 650px;">Enrolment</a></li>
                                        <li><a href="#0" data-date="05" class="" style="left: 850px;">Completed</a></li>
                                    </ol>
                                    <span class="filling-line" aria-hidden="true" style="transform: scaleX(0.281506);"></span>
                                </div>
                                <!-- .events -->
                            </div>
                            <!-- .events-wrapper -->
                            <ul class="cd-timeline-navigation">
                                <li><a href="#0" class="prev inactive">Prev</a></li>
                                <li><a href="#0" class="next">Next</a></li>
                            </ul>
                            <!-- .cd-timeline-navigation -->
                        </div>
                        <!-- .timeline -->
                        <div class="events-content">
                            <ol>
                                <form id="form-data" method="POST">
                                    <li class="selected" data-date="01">
                                        @include('student.basic_info')
                                    </li>
                                    <li class="" data-date="02">
                                        @include('student.sibling_info')
                                    </li>
                                    <li class="" data-date="03">
                                        @include('student.education_detail')
                                    </li>
                                    <li class="" data-date="04">
                                        @include('student.enrollment')
                                    </li>
                                    <li data-date="05">
                                        @include('student.completed')
                                    </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary mb-4 submit-btn save-btn">Save <i class="fas fa-chevron-right ms-3 go-icon"></i> <i class="fas fa-circle-notch fa-spin spinner-icon" style="display: none"></i></button>
                </div>
                <div class="student_fee_head_body"></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page_level_scripts')
<script type="text/javascript">
    var id = "{{ request()->id }}";
    var sec = "{{ request()->section }}";
    if (sec == 'basic_information') {
        sec = '01';
    } else if (sec == 'sibling_information') {
        sec = '02';
    } else if (sec == 'education_detail') {
        sec = '03';
    } else if (sec == 'enrollment') {
        sec = '04';
    } else if (sec == 'completed') {
        sec = '05'
    }
    next_sec_slide(sec);

    var selected_slide = sec;
    $(".events-wrapper .events").on("click", "a", function(event) {
        event.preventDefault();
        selected_slide = $(this).attr("data-date");
        if (selected_slide == 05) {
            $('.card-footer').find('.submit-btn').hide();
        } else {
            $('.card-footer').find('.submit-btn').show();

        }
    });
    if (sec == 05) {
        $('.card-footer').find('.submit-btn').hide();
    } else {

        $('.card-footer').find('.submit-btn').show();
    }

    $(document).ready(function() {
        block_page('.card');
        nav_bar_hide();
        capmuses_load();
        city_load();
        qualification_edit_load();
        qualification_load();
        fee_structures_optional_load();
        sections_load();
        session_load();
        groups_load();
        class_load();
        subject_combinations_load();
        $.ajax({
            url: api_url + `student/${id}/show`,
            dataType: "JSON",
            success: function(response) {
                unblock_page('.card');
                var data = response.data[0];
                $('#reg_number').val(data.registration_no);
                $('#roll_no').val(data.roll_no);
                $('#student_id').val(data.id);
                $('#user_id').val(data.user.id);
                $('#student_father_id').val(data.guardian.user.id);
                $('#student_guardian_id').val(data.guardian.id);
                $('#first_name').val(data.user.first_name);
                $('#admission_date').val(data.admission_at_formatted);
                $('#father_name').val(data.user.father_name);
                $('#gender').val(data.user.gender);
                $('#city_id').val(data.user.city_id);
                $('#cnic').val(data.user.cnic);
                $('#dob').val(data.user.dob_formatted);
                $('#domicile').val(data.user.domicile);
                $('#phone').val(data.user.phone);
                $('#phone_secondary').val(data.phone_secondary);
                $('#email').val(data.user.email);
                $('#email_secondary').val(data.email_secondary);
                $('#address').val(data.user.address);
                $('#address_temporary').val(data.address_temporary);
                $('#city_id_temporary').val(data.city_id_temporary);

                $('#occupation').val(data.guardian.occupation);
                $('#income').val(data.guardian.income);
                $('#father_phone').val(data.guardian.user.phone);
                $('#father_email').val(data.guardian.user.email);
                $('#father_cnic').val(data.guardian.user.cnic);

                $('#student_name_urdu').val(data.student_name_urdu);
                $('#father_name_urdu').val(data.guardian.father_name_urdu);
                $('#identification_marks').val(data.identification_marks);
                $('#religion').val(data.religion);
                $('#district').val(data.district);
                $('#district_temporary').val(data.district_temporary);
                $('#tehsil').val(data.tehsil);
                $('#tehsil_temporary').val(data.tehsil_temporary);
                // speciality: get_multiple_checkboxes('speciality'),
                $('.img-preview').attr('src', data.user.picture_url);

                $('#enrollment_id').val(data.enrollment.id);

                $('#campus_id').val(data.enrollment.campus_id);
                $('#session_id').val(data.enrollment.session_id);
                $('#section_id').val(data.enrollment.section_id);
                $('#group_id').val(data.enrollment.group_id);
                $('#subject_combination_id').val(data.enrollment.subject_combination_id);
                $('#class_id').val(data.enrollment.class_id);
                setTimeout(function() {

                    $('#fee_structure_id').val(data.enrollment.fee_structure_id);
                }, 1000);

                // $("tbody.sibling_body").html('');
                // $("tbody.education_body").html('');
                data.siblings.forEach(function(data, i) {
                    sibling_body = `<tr  class="new_sibling"> 
                        <td style="display:none"><input type="hidden" class="student_sibling_id" id="student_sibling_id" name="student_sibling_id" value="${data.id}"></td>
                        <td><input type="text" class="form-control sibling_name" id="sibling_name" name="sibling_name" value="${data.name}" ></td>
                        <td>
                        <select type="text" class="form-control sibling_relation" id="sibling_relation_${data.role.code}" name="sibling_relation">
                                <option value="brother">Brother</option>
                                <option value="sister">Sister</option>
                            </select>
                        </td>
                        <td>
                        <input type="number" class="form-control sibling_age" id="sibling_age" name="sibling_age" value="${data.age}" >

                        </td>
                        <td>
                        <select type="text" class="form-control qualification_id sibling_qualification sibling-row-${data.qualification_id}"  name="sibling_qualification" id="sibling_row_${data.qualification_id}">
                        ${qualificationIdOptions}
                            </select>
                        </td>
                        <td><input type="text" class="form-control sibling_remarks" id="remarks" name="sibling_remarks" value="${data.notes}"></td>
                        <td>
                            <span class="fa fa-times-circle fa-2x text-danger btnRemoveSibling" data-bs-toggle="tooltip" data-bs-placement="bottom"
                            title="Delete This Record" aria-hidden="true" data-sibling='0'></span>
                        </td>
                    </tr>`;

                    $("tbody.sibling_body .clone_siblings").before(sibling_body);
                    $(`#sibling_relation_${data.role.code} option[value=${data.role.code}]`).prop("selected", true);
                    setTimeout(function() {
                        $(`#sibling_row_${data.qualification_id} option[value=${data.qualification_id}]`).prop("selected", true);
                    }, 1000)


                });



                data.education.forEach(function(data, i) {
                    education_body = ` <tr class="new_education">
                        <td style="display:none"><input type="text" class="form-control student_education_detail_id" id="student_education_detail_id" name="student_education_detail_id" value="${data.id}" ></td>
                        <td><select  name="student_degree" id="student_qualification_${data.qualification_id}" class="form-control qualification_id student_degree">
                        ${qualificationIdOptions}
                            </select></td>
                        <td><input type="text" class="form-control subject" id="subject" name="subject" value="${data.subject}"></td>
                        <td>
                            <input type="text" class="form-control university" id="university" name="university" value="${data.university}">
                        </td>
                        <td>
                            <input type="number" class="form-control passing_year" id="passing_year" name="passing_year" placeholder="2022" value="${data.passing_year}">
                        </td>
                        <td>
                            <input type="number" class="form-control total_marks" id="total_marks" name="total_marks" placeholder="1100" value="${data.total_marks}">
                        </td>
                        <td>
                            <input type="number" class="form-control obtained_marks" id="obtained_marks" name="obtained_marks" placeholder="960" value="${data.obtained_marks}">
                        </td>
                        <td>
                            <input type="number" class="form-control percentage" id="percentage" name="percentage" placeholder="90.00" value="${data.percentage}">
                        </td>
                        <td>
                            <input type="text" class="form-control division" id="division" name="division" placeholder="A+" value="${data.division}">
                        </td>
                        <td>
                            
                            <span class="fa fa-times-circle fa-2x text-danger btnRemoveEducation" data-bs-toggle="tooltip" data-bs-placement="bottom"
                            title="Delete This Record" aria-hidden="true" data-sibling='0'></span>
                        </td>

                    </tr>`;
                    $("tbody.education_body .clone_education").before(education_body);
                    setTimeout(function() {
                        $(`#student_qualification_${data.qualification_id} option[value=${data.qualification_id}]`).prop("selected", true);
                    }, 1000);
                });
                data.student_fee_heads.forEach(function(data, i) {
                    fee_head_body = `<tr>
                        
                        <td>${data.fee_head.name}</td>
                        <td style="display:none"><input class="form-control fee_head_id" type="text" name="fee_head_id" id="fee_head_id" value="${data.fee_head.id}" /></td>
                        <td style="display:none"></td>
                        <td><input class="form-control amount" type="text" name="amount" id="amount" value="${data.amount}"/></td>
                        <td>
                        <span class="fa fa-times-circle fa-2x text-danger btnRemoveFeeHeadStructure" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete This Record" aria-hidden="true" data-sibling="0"></span></td>
                    </tr>`;

                    student_fee_head_append = `<input class="form-control student_fee_head_id" type="hidden" name="student_fee_head_id" id="student_fee_head_id" value="${data.id}" hidden/>`

                    $("tbody.fee_head_body").append(fee_head_body);
                    $(".student_fee_head_body").append(student_fee_head_append);
                });
                data.student_speciality.forEach(function(data, i) {
                    $('.speciality').each(function() {
                        if (data.name.includes($(this).val())) {
                            $(this).attr('checked', true);
                        }
                    })
                    student_speciality_append = `<input class="form-control student_speciality_id" type="hidden" name="student_fee_head_id" id="student_fee_head_id" value="${data.id}" />`
                    $(".student_fee_head_body").append(student_speciality_append);

                })
            }
        });

    });

    $(document).ready(function() {
        $("#form-data").on('submit', function(e) {
            e.preventDefault();
            block_page('.card');
            $.ajax({
                url: api_url + "student/store",
                type: "POST",
                data: {
                    student_id: $('#student_id').val(),
                    user_id: $('#user_id').val(),
                    student_father_id: $('#student_father_id').val(),
                    student_guardian_id: $('#student_guardian_id').val(),
                    enrollment_id: $('#enrollment_id').val(),
                    admission_date: $('#admission_date').val(),
                    first_name: $('#first_name').val(),
                    father_name: $('#father_name').val(),
                    occupation: $('#occupation').val(),
                    income: $('#income').val(),
                    father_phone: $('#father_phone').val(),
                    father_email: $('#father_email').val(),
                    father_cnic: $('#father_cnic').val(),
                    gender: $('#gender').val(),
                    cnic: $('#cnic').val(),
                    dob: $('#dob').val(),
                    domicile: $('#domicile').val(),
                    phone: $('#phone').val(),
                    phone_secondary: $('#phone_secondary').val(),
                    email: $('#email').val(),
                    email_secondary: $('#email_secondary').val(),
                    address: $('#address').val(),
                    city_id: $('#city_id').val(),
                    city_id_temporary: $('#city_id_temporary').val(),
                    address_temporary: $('#address_temporary').val(),

                    student_name_urdu: $('#student_name_urdu').val(),
                    father_name_urdu: $('#father_name_urdu').val(),
                    identification_marks: $('#identification_marks').val(),
                    religion: $('#religion').val(),
                    district: $('#district').val(),
                    district_temporary: $('#district_temporary').val(),
                    tehsil: $('#tehsil').val(),
                    tehsil_temporary: $('#tehsil_temporary').val(),
                    speciality: get_checked_speciality(),
                    image: $('.img-preview').attr('src'),

                    campus_id: $('#campus_id').val(),
                    session_id: $('#session_id').val(),
                    section_id: $('#section_id').val(),
                    group_id: $('#group_id').val(),
                    subject_combination_id: $('#subject_combination_id').val(),
                    class_id: $('#class_id').val(),
                    fee_structure_id: $('#fee_structure_id').val(),
                    fee_head_id: get_multiple_values('fee_head_id'),
                    student_fee_head_id: get_multiple_values('student_fee_head_id'),
                    amount: get_multiple_values('amount'),
                    student_education_detail_id: get_multiple_values('student_education_detail_id'),
                    student_sibling_id: get_multiple_values('student_sibling_id'),
                    student_speciality_id: get_multiple_values('student_speciality_id'),


                    sibling_name: get_multiple_values('sibling_name'),
                    sibling_relation: get_multiple_values('sibling_relation'),
                    sibling_age: get_multiple_values('sibling_age'),
                    sibling_qualification: get_multiple_values('sibling_qualification'),
                    sibling_remarks: get_multiple_values('sibling_remarks'),

                    student_degree: get_multiple_values('student_degree'),
                    subject: get_multiple_values('subject'),
                    university: get_multiple_values('university'),
                    passing_year: get_multiple_values('passing_year'),
                    total_marks: get_multiple_values('total_marks'),
                    obtained_marks: get_multiple_values('obtained_marks'),
                    percentage: get_multiple_values('percentage'),
                    division: get_multiple_values('division'),

                },
                dataType: "JSON",
                success: function(data) {
                    if (data.status) {
                        unblock_page('.card');
                        success_notify(data.message);
                        var current_event = $(".events-content .selected").attr("data-date");
                        var next_event = ("0" + (Number(current_event) + Number(01))).slice(-2);

                        if (next_event == 01) {
                            varnext_event = 'basic_information';
                        } else if (next_event == 02) {
                            next_event = 'sibling_information';
                        } else if (next_event == 03) {
                            next_event = 'education_detail';
                        } else if (next_event == 04) {
                            next_event = 'enrollment';
                        } else {
                            next_event = 'completed';

                        }
                        window.location = base_url + 'student/' + data.data.student_id + '/edit?section=' + next_event;
                    } else {
                        error_notify(data.message);
                    }
                }
            });
        });

        $("#add_more_sibling_button").click(function() {
            clone_sibling();
            qualification_append_load();
        });
        $(document).on('click', '.btnRemoveSibling', function() {
            var sibling_id = $(this).parents('.new_sibling').find('#student_sibling_id').val();
            $('tbody.sibling_body').append(`<input type="hidden" class="student_sibling_id"  value=${sibling_id}>`);
            $(this).parents('.new_sibling').remove();
        });

        $("#add_more_education_button").click(function() {
            clone_education();
            qualification_append_load();
        });
        $(document).on('click', '.btnRemoveEducation', function() {

            var education_id = $(this).parents('.new_education').find('#student_education_detail_id').val();
            $('tbody.education_body').append(`<input type="hidden" class="student_education_detail_id"  value=${education_id}>`);

            $(this).parents('.new_education').remove();
        });

        $(document).on('click', '.btnRemoveFeeHeadStructure', function() {
            var fee_head_id = $(this).parents('tr').find('#student_fee_head_id').val();
            // $('.student_fee_head_body').append(`<input type="text" class="student_fee_head_id"  value=${fee_head_id}>`);
            $(this).parents('tr').remove();
        });

        $(document).on('click', '.add_more_fee_heads', function() {
            add_fee_structure_head();
        });

        $(document).on('change', '#fee_structure_id', function() {
            var id = $(this).val();
            fee_structure_head_load(".fee_head_body", id ? id : 0);
        });

        $(document).on('change', '.imgUpload', function() {
            readURL(this);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    previewId = $(input).siblings('.img-preview');
                    $(previewId).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function get_checked_speciality() {
            specialityArray = [];
            var choose_subject = '';
            $('.speciality:checked').each(function() {
                specialityArray.push($(this).val());
            });
            return specialityArray;
        }


    });
</script>
@endsection