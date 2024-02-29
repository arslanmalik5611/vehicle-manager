@extends('layout.master')
@section('page_title','Student')
<link rel="stylesheet" href="{{asset('panel_assets/css/time_line.css')}}">
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="margin-bottom: 40px !important;">
                <div class="body">
                    <div class="cd-horizontal-timeline loaded">
                        <div class="timeline">
                            <div class="events-wrapper">
                                <div class="events" style="width: 50000px;">
                                    <ol>
                                        <li><a href="#0" data-date="01" class="older-event selected" style="left: 50px;">Basic Information</a></li>
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
                                <form id="form-data" method="POST" enctype="multipart/form-data">
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
                                    <li class="" data-date="05">
                                        @include('student.completed')
                                    </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary mb-4 submit-btn save-btn">Save <i class="fas fa-chevron-right ms-3 go-icon"></i> <i class="fas fa-circle-notch fa-spin spinner-icon" style="display: none"></i></button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page_level_scripts')
<script type="text/javascript">
    var selected_slide = 01;
    $(".events-wrapper .events").on("click", "a", function(event) {
        event.preventDefault();
        selected_slide = $(this).attr("data-date");
        if (selected_slide == 05) {
            $('.card-footer').find('.submit-btn').hide();
        } else {
            $('.card-footer').find('.submit-btn').show();
        }
    });

    // $(".swal2-actions>button.swal2-confirm").on("click", function(event) {
    //     event.preventDefault();
    //     // alert('ok');
    // });
    $(document).ready(function() {
        nav_bar_hide();
        city_load();
        qualification_load();
        capmuses_load();
        fee_structures_optional_load();
        sections_load();
        session_load();
        group_load();
        class_load();
        subject_combinations_load();

        $("#form-data").on('submit', function(e) {
            e.preventDefault();
            if (selected_slide == 01) {
                block_page('.card');
                $.ajax({
                    url: api_url + "student/store",
                    type: "POST",
                    enctype: 'multipart/form-data',

                    data: {
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
                        address_temporary: $('#address_temporary').val(),
                        city_id_temporary: $('#city_id_temporary').val(),

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
                        amount: get_multiple_values('amount'),


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
                        student_education_detail_id: false,
                        student_sibling_id: false,


                    },
                    dataType: "JSON",
                    success: function(data) {
                        if (data.status) {
                            success_notify(data.message);
                            window.location = base_url + 'student/' + data.data.student_id + '/edit?section=sibling_information';
                        } else {
                            error_notify(data.message);
                        }
                    }
                });
            } else {
                Swal.fire({
                    title: "Sorry",
                    text: "Fill & Save the basic info before",
                    icon: "warning",
                    showCancelButton: false,
                    confirmButtonText: "Ok"
                }).then(function(result) {
                    selected_slide = 01;
                    next_sec_slide('01');
                })

            }
        });


        $("#add_more_sibling_button").click(function() {
            clone_sibling();
            qualification_append_load();
        });
        $(document).on('click', '.btnRemoveSibling', function() {
            $(this).parents('.new_sibling').remove();
        });

        $("#add_more_education_button").click(function() {
            clone_education();
            qualification_append_load();
        });
        $(document).on('click', '.btnRemoveEducation', function() {
            $(this).parents('.new_education').remove();
        });

        // remove_fee_head_structure
        $(document).on('click', '.btnRemoveFeeHeadStructure', function() {
            $(this).parents('tr').remove();
        });
        // remove_fee_head_structure
        // fee_structure_head_load
        $(document).on('change', '#fee_structure_id', function() {
            var id = $(this).val();
            fee_structure_head_load(".fee_head_body", id ? id : 0);
        });

        $(document).on('click', '.add_more_fee_heads', function() {
            add_fee_structure_head();
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