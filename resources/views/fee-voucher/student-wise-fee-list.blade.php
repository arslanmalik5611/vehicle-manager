@extends('layout.master')
@section('page_title','Student Wise Fee Voucher')

@section('content')
    <style>
        .voucherCard {
            display: none;
        }

        .table {
            font-size: 12px !important;
        }

        .modalTable td {
            padding: 2px;
            text-align: center;
            vertical-align: middle;
        }
    </style>
    <div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="text-info"><img src="{{asset('panel_assets/images/voucher.png')}}" alt="" width="50">
                        Student Wise Fee Voucher </h2>
                </div>
                <div>
                    <a href="{{env('BASE_URL').'fee-vouchers/create'}}" class="btn btn-outline-success btn-sm"> Create
                        Fee
                        Voucher</a>
                </div>
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
                    <div class="col-md-5 col-12 fixed-hight">
                        <h2 class="text-info">Student</h2>
                        <table class="table table-striped table-hover table-bordered table-condensed student-table">
                            <thead>
                            <tr class="colored-bg">
                                <th> Roll No</th>
                                <th> Name</th>
                                <th> Class</th>
                                <th> Action</th>
                            </tr>
                            </thead>
                            <tbody class="studentBody">

                            </tbody>

                        </table>
                    </div>
                    <div class="col-md-7 col-12 fixed-hight">
                        <h2 class="text-info"> Voucher</h2>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr class="colored-bg">
                                <th>V.No</th>
                                <th>Month</th>
                                <th>Issue Date</th>
                                <th>Last Date</th>
                                <th>Status</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="mainBody">

                            </tbody>
                        </table>
                    </div>
                </div>

{{--                <div class="card-footer text-end">--}}
{{--                    <button type="submit" class="btn btn-success mb-4 submit-btn">Save <i--}}
{{--                            class="fas fa-chevron-right ms-3 go-icon"></i></button>--}}
{{--                </div>--}}
            </form>
        </div>
    </div>
@endsection
@section('page_level_modal')
    <!-- Fee Voucher Edit Modal -->
    <div class="modal fade" id="feeVoucherModal" tabindex="-1" aria-labelledby="feeVoucherModalLabel" aria-hidden="true"
         style="width: 100%; display: none">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-voucher-header">
                    <h5 class="modal-title" id="feeVoucherModalLabel">Fee Voucher Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <input type="hidden" name="id" class="id" id="id">
                            <table class="table table-borderless modalTable">
                                <thead>
                                <tr class="colored-bg">
                                    <th class="bg-blue" colspan="2">
                                        Voucher Information
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><h6>Voucher Month</h6></td>
                                    <td><input type="month" name="month" class="form-control month" id="month"></td>
                                </tr>
                                <tr>
                                    <td><h6>Issue Date</h6></td>
                                    <td>
                                        <input type="text" class="datepicker issue_at form-control" name="issue_at"
                                               id="issue_at"
                                               placeholder="dd/mm/yyyy">
                                    </td>
                                </tr>
                                <tr>
                                    <td><h6>Expiry Date</h6></td>
                                    <td>
                                        <input type="text" class="datepicker expiry_at form-control"
                                               name="expiry_at" id="expiry_at" placeholder="dd/mm/yyyy">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <table
                                            class="table table-striped table-bordered table-hover table-responsive table-condensed">
                                            <thead>
                                            <tr class="colored-bg">
                                                <th colspan="2">Additional Heads</th>
                                                <th>
                                                    <span id="addMoreBtn" data-bs-toggle="tooltip"
                                                          data-bs-placement="bottom"
                                                          title="Add More Row"
                                                          class="fa fa-plus-circle fa-2x text-warning">
                                                    </span>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="mainVoucherTableBody">
                                            {{--                                            <tr class="mainRow">--}}
                                            {{--                                                <td style="width: 260px">--}}
                                            {{--                                                    <select name="fee_head_id" id="fee_head_id"--}}
                                            {{--                                                            class="fee_head_id form-control"></select>--}}
                                            {{--                                                </td>--}}
                                            {{--                                                <td>--}}
                                            {{--                                                    <input type="number" class="form-control amount"--}}
                                            {{--                                                           name="amount">--}}
                                            {{--                                                </td>--}}
                                            {{--                                                <td>--}}
                                            {{--                                                    <button type="button" id="addMoreBtn"--}}
                                            {{--                                                            class="btn btn-primary btn-sm">Add--}}
                                            {{--                                                    </button>--}}
                                            {{--                                                </td>--}}
                                            {{--                                            </tr>--}}
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary updateVoucher">Save changes</button>
                </div>
            </div>
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


        // update call send

        $(document).on('click', '.updateVoucher', function (e) {
            e.preventDefault();
            $.ajax({
                url: api_url + "fee-vouchers/update",
                type: "POST",
                data: JSON.stringify(getFormData()),
                contentType: "application/json",
                dataType: "JSON",
                success: function (data) {
                    if (data.status) {
                        success_notify(data.message)
                    } else {
                        error_notify(data.message);
                    }
                }
            });
        });

        // STUDENT SEARCH CALL

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
                            mainTr += `<tr class="student-row-${data.student.id}">
                                    <td>
                                        <a href="{{env('BASE_URL')}}student/${data.student.id}/detail" data-bs-toggle="tooltip" data-bs-placement="top"
                                         title="Click to see student detail" target="_blank"> ${data.student.roll_no} (${data.student.registration_no}) </a>
                                    </td>
                                    <td>
                                       <a href="{{env('BASE_URL')}}student/${data.student.id}/detail" data-bs-toggle="tooltip" data-bs-placement="top"
                                         title="Click to see student detail" target="_blank">  ${data.student.user.first_name} (${data.student.user.father_name}) </a>
                                    </td>
                                    <td>
                                         ${data.student_class.name} (${data.section.name})
                                    </td>
                                     <td>
                                         <span class="studentVoucherSearch fas fa-search fa-2x text-primary" data-student-id="${data.student.id}" data-bs-toggle="tooltip" data-bs-placement="top"
                                         title="Search Student"></span>
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

        // STUDENT FEE VOUCHER SEARCH CALL
        $(document).on('click', ".studentVoucherSearch", function (e) {
            e.preventDefault();
            var id = $(this).attr('data-student-id');
            $.ajax({
                url: api_url + "fee-vouchers/search-student-fee",
                type: "POST",
                data: {'id': id},
                dataType: "JSON",
                success: function (response) {
                    if (response.status) {
                        var mainTr = '';
                        $(response.data).each(function (i, data) {
                            mainTr += ` <tr class="voucherDetailRow voucher-row-${data.id}" data-voucher-id="${data.id}" data-month="${data.month}">
                                    <td><a href="#" target="_blank" class="generateFeeVoucher" data-fee-voucher-number="${data.fee_voucher_number}" data-bs-toggle="tooltip" data-bs-placement="top"
                                         title="Click to see Voucher">${data.fee_voucher_number}</a></td>
                                    <td>${data.month_formatted}</td>
                                    <td>${data.issue_at_formatted}</td>
                                    <td>${data.expiry_at_formatted}</td>
                                    <td>${data.voucher_status_labelled}</td>
                                    <td>${data.total_amount}</td>
                                    <td>
                                        <span class="feeVoucherShow" data-bs-toggle="modal" data-bs-target="#feeVoucherModal" data-voucher-id="${data.id}" data-month="${data.month}" data-bs-toggle="tooltip" data-bs-placement="top"
                                         title="Edit Voucher"> <i class="fa fa-edit fa-2x text-primary"></i> </span>
                                        <a href="#" target="_blank" class="generateFeeVoucher" data-fee-voucher-number="${data.fee_voucher_number}" data-bs-toggle="tooltip" data-bs-placement="top"
                                         title="Click to see Voucher"> <i class="fas fa-download fa-2x text-primary"></i> </a>
                                    </td>
                                </tr>`;
                            $('.studentBody').find('tr').removeClass('bg-info');
                            $('.student-row-' + data.student_enrollment.student_id).addClass('bg-info');
                        });
                        $('.mainBody').html('');
                        $('.mainBody').html(mainTr);

                        // success_notify(response.message);

                    } else {
                        error_notify(response.message);
                    }
                }
            });
        });

        // VOUCHER EDIT FORM AND DATA SHOW CALL
        $(document).on('click', ".feeVoucherShow", function () {
            modal_edit_form_data($(this));
        });

        $(document).on('dblclick', '.voucherDetailRow', function (e) {
            e.preventDefault();
            modal_edit_form_data($(this));
        });

        function modal_edit_form_data(thisElem) {
            $('#feeVoucherModal').modal('show');
            var id = $(thisElem).attr('data-voucher-id');
            var month = $(thisElem).attr('data-month');
            $.ajax({
                url: api_url + "fee-vouchers/show",
                type: "GET",
                data: {'id': id, 'month': month},
                dataType: "JSON",
                success: function (response) {
                    if (response.status) {
                        mainTr = '';
                        $('#id').val(response.data.id);
                        $('#month').val(response.data.month);
                        $('#issue_at').val(response.data.issue_at_formatted);
                        $('#expiry_at').val(response.data.expiry_at_formatted);
                        $(response.data.student_fee_voucher_details).each(function (i, data) {
                            mainTr += `<tr class="voucherRow mainRow">
                                    <td><h6>${data.fee_head.name}</h6> <input type="hidden" class="fee_head_id" value="${data.fee_head.id}"></td>
                                    <td><input type="number" class="form-control amount" value="${data.amount ? data.amount : ''}"></td>
                                    <td><span class="fa fa-times-circle fa-2x text-danger removeVoucher" data-id=${data.id} data-bs-toggle="tooltip" data-bs-placement="bottom"
                                         title="Delete This Record"></span></td>
                                </tr>`;
                        });
                        $('.mainBody').find('tr').removeClass('bg-info');
                        $('.voucher-row-' + response.data.id).addClass('bg-info');

                        $(".mainVoucherTableBody").html('');
                        $(".mainVoucherTableBody").html(mainTr);
                        // success_notify(response.message);
                    } else {
                        error_notify(response.message);
                    }
                }
            });
        }

        // DELETE VOUCHER DETAIL
        $(document).on('click', '.removeVoucher', function (e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            thisElem = $(this);
            $.ajax({
                url: api_url + "fee-vouchers/delete-voucher-detail",
                type: "POST",
                data: {'id': id},
                dataType: "JSON",
                success: function (response) {
                    if (response.status) {
                        $(thisElem).parents('.voucherRow').remove();
                        success_notify(response.message);

                    } else {
                        error_notify(response.message);
                    }
                }
            });
        });

        var count = 0;

        // ADD MORE VOUCHER DEAIL HEAD
        $(document).on('click', '#addMoreBtn', function (e) {
            e.preventDefault();
            count++;
            mainTr = `<tr class="mainRow">
                        <td><select name="fee_head_id" id="fee_head_id"
                                                            class="fee_head_id fee-head-id-${count} form-control"></select></td>
                        <td> <input type="number" name="amount" class="amount form-control" value=""></td>
                         <td><span class="removeBtn fa fa-times-circle fa-2x text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                         title="Delete This Row"></span></td>
</tr>
               `;
            $('.mainVoucherTableBody').append(mainTr);
            $('.fee-head-id-' + count).html('');
            fee_heads_load('.fee-head-id-' + count);
        });

        $(document).on('click', '.removeBtn', function (e) {
            e.preventDefault();
            $(this).parents('.mainRow').remove();
        });

        function getFormData() {
            var fee_voucher_details = '';
            var data = {
                'id': $('#id').val(),
                'month': $('#month').val(),
                'issue_at': $('#issue_at').val(),
                'expiry_at': $('#expiry_at').val(),
                'fee_voucher_details': []
            }


            $('.amount').each(function () {
                fee_voucher_details = {
                    'amount': $(this).val(),
                    'fee_head_id': $(this).parents('.mainRow').find('.fee_head_id').val()
                }
                data.fee_voucher_details.push(fee_voucher_details);
            });
            return data;
        }

        $(document).on('click', '.generateFeeVoucher', function (e) {
            e.preventDefault();
            generate_voucher_no_pdf($(this).attr('data-fee-voucher-number'));
        });
    </script>

@endsection

