@extends('layout.master')
@section('page_title','Fee Voucher')

@section('content')
    <div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="text-info"><i class="fas fa-plus-circle fa-icon"></i> Multi Fee Submit </h2>
                </div>
                <div>
                    <a href="{{env('BASE_URL').'fee-vouchers/student-fee-list'}}" class="btn btn-outline-success btn-sm">Fee Voucher
                        List</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="post" id="form-data">
                <table class="table table-hover table-bordered multi-fee-table">
                    <theaed>
                        <tr class="colored-bg">
                            <th>Voucher#</th>
                            <th>Reg#</th>
                            <th>Roll No#</th>
                            <th>Name / Father Name</th>
                            <th>Class</th>
                            <th>Section</th>
                            <th>Payable.Amt</th>
                            <th>Paid.Amt</th>
                            <th>Due.Amt</th>
                            <th>Dep. Name</th>
                            <th>Dep. Phone</th>
                            <th>Action</th>
                        </tr>
                    </theaed>
                    <tbody class="mainBody">
                    <tr>
                        <td><input type="text" name="fee_voucher_number"
                                   class="fee_voucher_number form-control"></td>
                        <td class="registration_no"></td>
                        <td class="roll_no"></td>
                        <td class="first_name"></td>
                        <td class="class"></td>
                        <td class="section"></td>
                        <td class="payable_amount"></td>
                        <td class="paid_amount_td">
                            <input type="number" name="paid_amount"
                                   class="paid_amount form-control">
                        </td>
                        <td class="due_amount_td">
                            <input type="number" name="due_amount"
                                   class="due_amount form-control" value="" readonly>
                        </td>
                        <td><input type="text" name="depositor_name"
                                   class="depositor_name form-control"></td>
                        <td><input type="text" name="depositor_phone"
                                   class="depositor_phone form-control"></td>
                        <td>
                            <span class="pdfView"></span>
                            <span id="addMoreBtn" data-bs-toggle="tooltip"
                                  data-bs-placement="bottom"
                                  title="Add More Row"
                                  class="fa fa-plus-circle fa-2x text-primary">
                                                    </span>
                        </td>
                    </tr>
                    <tr class="count-row">
                        <td colspan="6"> Total V.No : <span class="total_voucher"></span></td>
                        <td><span id="total_amount">0</span></td>
                        <td class="total_paid_show">0</td>
                        <td colspan="3" class="total_due_show">0</td>
                    </tr>
                    </tbody>
                </table>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-12 text-end">
                            <button type="button" class="btn btn-success mb-4 submit-btn">Save <i
                                    class="fas fa-chevron-right ms-3 go-icon"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
@section('page_level_scripts')
    <script type="text/javascript">

        $(document).ready(function () {
            $(document).on('change keypress', '.fee_voucher_number', function (e) {
                // e.preventDefault();
                if (e.keyCode == 9 || e.keyCode == 13) {
                    search_student_voucher($(this).val(), $(this));
                }
            });

            nav_bar_hide();
        });

        $(document).on('change keyup', '.paid_amount', function () {
            thisElem = $(this).parents('tr');
            var payable_amount = $(thisElem).find('.payable_amount').text();
            var paid_amount = $(this).val();
            var due_amount = parseFloat(payable_amount) - parseFloat(paid_amount);
            $(thisElem).find('.due_amount').val('');
            $(thisElem).find('.due_amount').val(due_amount);
            $('.total_paid_show').html(calculate_paid_amount());
            $('.total_due_show').html(calculate_due_amount());
        })


        // SEARCH STUDENT BASE ON VOUCHER NUMBER
        function search_student_voucher(fee_voucher_number, thisElem) {
            $.ajax({
                url: api_url + "fee-vouchers/search-student-voucher",
                type: "POST",
                data: {'fee_voucher_number': fee_voucher_number},
                dataType: "JSON",
                success: function (data) {
                    if (data.status == true) {
                        var voucher_detail = data.data;
                        var parent = $(thisElem).parents('tr');
                        parent.find('.registration_no').html(voucher_detail.student_enrollment.student.registration_no);
                        parent.find('.roll_no').html(voucher_detail.student_enrollment.student.roll_no);
                        parent.find('.first_name').html(voucher_detail.student_enrollment.student.user.first_name + ' ' + voucher_detail.student_enrollment.student.user.last_name + '/ ' + voucher_detail.student_enrollment.student.user.father_name);
                        parent.find('.class').html(voucher_detail.student_enrollment.student_class.name);
                        parent.find('.section').html(voucher_detail.student_enrollment.section.name);
                        parent.find('.payable_amount').html(voucher_detail.payable_amount);
                        parent.find('.paid_amount').val(voucher_detail.payable_amount);
                        parent.find('.class').html(voucher_detail.student_enrollment.student_class.name);
                        parent.find('.pdfView').html(`<a href="#" target="_blank" class="generateFeeVoucher" data-fee-voucher-number="${voucher_detail.fee_voucher_number}" data-bs-toggle="tooltip" data-bs-placement="top"
                                         title="Click to see Voucher"> <i class="fas fa-download fa-2x text-info"></i> </a>
                                                        `);
                        add_more_row();
                        $('#total_amount').html('');
                        $('#total_amount').html(calculate_payable_amount());
                        $('.total_voucher').html('');
                        $('.total_voucher').html(count_voucher_no());

                        success_notify(data.message);

                    } else {
                        error_notify(data.message);
                    }
                }
            });
        }

        // ADD MORE ROW
        function add_more_row() {
            var row = ` <tr>
                        <td><input type="text" name="fee_voucher_number"
                                   class="fee_voucher_number form-control"></td>
                        <td class="registration_no"></td>
                        <td class="roll_no"></td>
                        <td class="first_name"></td>
                        <td class="class"></td>
                        <td class="section"></td>
                        <td class="payable_amount"></td>
                           <td class="paid_amount_td">
                            <input type="number" name="paid_amount"
                                   class="paid_amount form-control">
                            </td>
                         <td class="due_amount_td">
                            <input type="number" name="due_amount"
                                   class="due_amount form-control" readonly>
                        </td>
                        <td><input type="text" name="depositor_name"
                                   class="depositor_name form-control"></td>
                        <td><input type="text" name="depositor_phone"
                                   class="depositor_phone form-control"></td>
                        <td class="action-td">
                                <span class="pdfView"></span>
                                <span class="fa fa-times-circle fa-2x text-danger btnRemove" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                         title="Delete This Record"></span>
                         </td>
                    </tr>`;
            $('.count-row').before(row);

        }

        // SUBMIT MULTI FEE
        $('.submit-btn').on('click', function (e) {
            e.preventDefault();
            $.ajax({
                url: api_url + "fee-vouchers/multi-fee-submit",
                type: "POST",
                data: JSON.stringify(getFormData()),
                contentType: "application/json",
                dataType: "JSON",
                success: function (data) {
                    if (data.status) {
                        success_notify(data.message);

                    } else {
                        error_notify(data.message);
                    }
                }
            });
        });

        // GET FORM DATA
        function getFormData() {
            var data = {
                'voucher_details': []
            }

            $('.fee_voucher_number').each(function () {
                fee_vouchers_detail = {
                    'fee_voucher_number': $(this).val(),
                    'depositor_name': $(this).parents('tr').find('.depositor_name').val(),
                    'depositor_phone': $(this).parents('tr').find('.depositor_phone').val(),
                    'paid_amount': $(this).parents('tr').find('.paid_amount').val(),
                    'due_amount': $(this).parents('tr').find('.due_amount').val(),
                }
                data.voucher_details.push(fee_vouchers_detail);
            });
            return data;
        }

        $(document).on('click', '#addMoreBtn', function (e) {
            e.preventDefault();
            add_more_row();
        });

        // REMOVE ROW
        $(document).on('click', '.btnRemove', function (e) {
            e.preventDefault();
            $(this).parents('tr').remove();
            $('#total_amount').html('');
            $('#total_amount').html(calculate_payable_amount());
            $('.total_paid_show').html(calculate_paid_amount());
            $('.total_due_show').html(calculate_due_amount());
            $('.total_voucher').html(count_voucher_no());
        });

        // CALCULATE PAYABLE AMOUNT
        function calculate_payable_amount() {
            var total_amount = 0;
            $('.payable_amount').each(function () {
                total_amount += Number($(this).text());
            });
            return total_amount;
        }

        // CALCULATE PAID AMOUNT
        function calculate_paid_amount() {
            var total_amount = 0;
            $('.paid_amount').each(function () {
                total_amount += Number($(this).val());
            });
            return total_amount;
        }

        // CALCULATE DUE AMOUNT
        function calculate_due_amount() {
            var total_amount = 0;
            $('.due_amount').each(function () {
                total_amount += Number($(this).val());
            });
            return total_amount;
        }

        // COUNT VOUCHER Number
        function count_voucher_no() {
            var count = 0;
            $('.fee_voucher_number').each(function () {
                if ($(this).val() != '') {
                    count++;
                }
            });
            return count;
        }

        // GENERATE VOUCHER PDF
        $(document).on('click', '.generateFeeVoucher', function (e) {
            e.preventDefault();
            generate_voucher_no_pdf($(this).attr('data-fee-voucher-number'));
        });
    </script>

@endsection

