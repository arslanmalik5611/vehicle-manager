@extends('layout.master')
@section('page_title','Fee Voucher')

@section('content')
    <style>
        .voucherCard {
            display: none;
        }

        .fixed-hight {
            height: 400px;
            overflow: auto;
        }
    </style>
    <div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="text-info"><i class="fas fa-plus-circle fa-icon"></i> Fee Voucher Create</h2>
                </div>
                {{--                <div>--}}
                {{--                    <a href="{{env('BASE_URL').'fee-vouchers'}}" class="btn btn-outline-success btn-sm">Fee Voucher--}}
                {{--                        List</a>--}}
                {{--                </div>--}}
            </div>
        </div>
        <div class="card-body">
            <form method="post" id="form-data">

                <div class="row mb-3">
                    <div class="col-md-2 col-sm-6 col-12">
                        <label for="campus_id" class="form-label">Campus </label>
                        <select name="campus_id" id="campus_id" class="campus_id select2"></select>
                    </div>

                    <div class="col-md-2 col-sm-6 col-12">
                        <label for="session_id" class="form-label">Session </label>
                        <select name="session_id" id="session_id" class="session_id select2"></select>
                    </div>
                    <div class="col-md-2 col-sm-6 col-12">
                        <label for="class_id" class="form-label">Class </label>
                        <select name="class_id" id="class_id" class="class_id select2"></select>
                    </div>
                    <div class="col-md-2 col-sm-6 col-12">
                        <label for="section_id" class="form-label d-flex justify-content-between">
                            <span>Section</span>
                        </label>
                        <select name="section_id" id="section_id" class="section_id select2"></select>
                    </div>

                    <div class="col-md-2 col-sm-6 col-12" style="margin-top: 33px">
                        <button type="submit" class="btn btn-success btn-sm submit-btn">Search <i
                                class="fas fa-chevron-right ms-3 go-icon"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card voucherCard text-dark shadow-2 mb-3" style="max-width: 18rem;">
        <div class="card-body">
            <form action="" id="form-data-2">
                <div class="row mb-3 ">
                    <div class="col-md-6 col-12 fixed-hight">
                        <h2 class="text-info">Student</h2>
                        <table class="table table-striped table-hover table-bordered table-condensed">
                            <thead>
                            <tr class="colored-bg">
                                <th>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="checkAll" checked>
                                    </div>
                                </th>
                                <th> Roll No</th>
                                <th> Name</th>
                                <th> Class</th>
                            </tr>
                            </thead>
                            <tbody class="studentBody">

                            </tbody>

                        </table>
                    </div>
                    <div class="col-md-6 col-12 fixed-hight">
                        <h2 class="text-info"> Voucher</h2>
                        <table class="table table-borderless">
                            <thead>
                            <tr class="colored-bg">
                                <th class="bg-blue" colspan="2">
                                    Voucher Information
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Voucher Month</td>
                                <td><input type="month" name="month" class="form-control month" id="month"></td>
                            </tr>
                            <tr>
                                <td>Issue Date</td>
                                <td>
                                    <input type="text" class="datepicker issue_at form-control" name="issue_at"
                                           id="issue_at" placeholder="dd/mm/yyyy" autocomplete="off">
                                </td>
                            </tr>
                            <tr>
                                <td>Expiry Date</td>
                                <td>
                                    <input type="text" class="datepicker expiry_at form-control" name="expiry_at"
                                           id="expiry_at" placeholder="dd/mm/yyyy" autocomplete="off">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <table
                                        class="table table-striped table-bordered table-hover table-responsive table-condensed">
                                        <thead>
                                        <tr class="colored-bg">
                                            <td colspan="4">Additional Heads</td>
                                        </tr>
                                        </thead>
                                        <tbody class="mainBody">
                                        <tr class="mainRow">
                                            <td>
                                                    <span id="addMoreBtn" data-bs-toggle="tooltip"
                                                          data-bs-placement="bottom" title="Add More Row"
                                                          class="fa fa-plus-circle fa-2x text-primary">
                                                    </span>
                                            </td>
                                            <td style="width: 260px">
                                                <select name="fee_head_id" id="fee_head_id"
                                                        class="fee_head_id form-control"></select>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control amount" name="amount">
                                            </td>
                                            <td>
                                                    <span id="addMoreBtn" data-bs-toggle="tooltip"
                                                          data-bs-placement="bottom" title="Add More Row"
                                                          class="fa fa-plus-circle fa-2x text-primary">
                                                    </span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-success mb-4 submit-btn">Save <i
                            class="fas fa-chevron-right ms-3 go-icon"></i></button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('page_level_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            sessions_optional_load();
            campuses_optional_load();
            sections_optional_load();
            classes_optional_load();
            fee_heads_load();
            nav_bar_hide();
            // fee_structure_manage();
        });

        $("#form-data").on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: api_url + "fee-vouchers/search",
                type: "POST",
                data: $(this).serialize(),
                dataType: "JSON",
                success: function (data) {
                    if (data.status) {
                        $('.voucherCard').show();
                        var mainTr = '';
                        $(data.data).each(function (i, data) {
                            mainTr += `<tr>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input student_enrollment_id student-id-${data.student.id}" type="checkbox" id="student_enrollment_id" checked data-student-enrollment-id="${data.id}" data-student-id="${data.student.id}" data-fee-structure_id="${data.fee_structure_id}">
                                        </div>
                                    </td>
                                    <td class="role_no">
                                        ${data.student.roll_no} (${data.student.registration_no})
                                        <span class="fee-voucher-pdf"></span>
                                    </td>
                                    <td>
                                        ${data.student.user.first_name} (${data.student.user.father_name})
                                    </td>
                                    <td>
                                         ${data.student_class.name} (${data.section.name})
                                    </td>
                                </tr>`;
                        });

                        $('.studentBody').html('');
                        $('.studentBody').html(mainTr);
                        // success_notify(data.message);

                    } else {
                        error_notify(data.message);
                    }
                }
            });
        });


        $("#form-data-2").on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: api_url + "fee-vouchers/store",
                type: "POST",
                data: JSON.stringify(getFormData()),
                contentType: "application/json",
                dataType: "JSON",
                success: function (data) {
                    if (data.status) {
                        $(data.student_exists).each(function (i, detail) {
                            $('.student-id-' + detail.student_enrollment_id).parents('tr').addClass('bg-danger');
                            $('.student-id-' + detail.student_enrollment_id).parents('tr').addClass('text-white');
                            $('.student-id-' + detail.student_enrollment_id).parents('tr').find('.fee-voucher-pdf').html(`<a href="#" class="generateFeeVoucher" data-fee-voucher-number="${detail.fee_voucher_number}">click to see</a>`);
                        });
                        success_notify(data.message);

                    } else {
                        error_notify(data.message);
                    }
                }
            });
        });


        function getFormData() {
            var fee_voucher_details = '';
            var fee_structure_student_enrollment_ids = '';
            var data = {
                'month': $('#month').val(),
                'issue_at': $('#issue_at').val(),
                'expiry_at': $('#expiry_at').val(),
                'student_enrollment_ids': [],
                'fee_structure_ids': [],
                'fee_voucher_details': []
            }

            $('.student_enrollment_id').each(function () {
                if ($(this).is(":checked")) {
                    student_enrollment_ids = {
                        'student_enrollment_id': $(this).attr('data-student-enrollment-id'),
                    }
                    fee_structure_ids = {
                        'fee_structure_id': $(this).attr('data-fee-structure_id')
                    }
                    data.student_enrollment_ids.push(student_enrollment_ids);
                    data.fee_structure_ids.push(fee_structure_ids);
                }
            })

            $('.amount').each(function () {
                fee_voucher_details = {
                    'amount': $(this).val(),
                    'fee_head_id': $(this).parents('.mainRow').find('.fee_head_id').val()
                }
                data.fee_voucher_details.push(fee_voucher_details);
            });
            return data;
        }

        $(document).on('click', "#checkAll", function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });

        var count = 0;

        $(document).on('click', '#addMoreBtn', function (e) {
            e.preventDefault();
            count++;
            mainTr = `<tr class="mainRow">
                                        <td>
                                                    <span id="addMoreBtn" data-bs-toggle="tooltip"
                                                          data-bs-placement="bottom" title="Add More Row"
                                                          class="fa fa-plus-circle fa-2x text-primary">
                                                    </span>
                                            </td>
                        <td><select name="fee_head_id" id="fee_head_id"
                                                            class="fee_head_id fee-head-id-${count} form-control">${FeeHeadCustomOptions}</select></td>
                        <td> <input type="number" name="amount" class="amount form-control" value=""></td>
                         <td><span class="fa fa-times-circle fa-2x text-danger btnRemove" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                         title="Delete This Record"></span></td>
</tr>
               `;
            $('.mainBody').append(mainTr);
            // $('.fee-head-id-' + count).html('');
            // fee_heads_load('.fee-head-id-' + count);
        });

        $(document).on('click', '.btnRemove', function (e) {
            e.preventDefault();
            $(this).parents('.mainRow').remove();
        });
        $(document).on('click', '.generateFeeVoucher', function (e) {
            e.preventDefault();
            generate_voucher_no_pdf($(this).attr('data-fee-voucher-number'));
        });
    </script>

@endsection
