@extends('layout.master')
@section('page_title','Pay Roll')

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
                <h2 class="text-info"><i class="fas fa-dollar-sign fa-icon"></i> Pay Roll Create</h2>
            </div>
            <!-- <div>
                <a href="{{env('BASE_URL').'fee-vouchers'}}" class="btn btn-outline-success btn-sm">Fee Voucher
                    List</a>
            </div> -->
        </div>
    </div>
    <div class="card-body">
        <form method="post" id="form-data">
            <div class="row mb-3">
                <div class="col-md-2 col-sm-6 col-12">
                    <label for="month" class="form-label">Choose Month </label>
                    <input type="month" class="form-control" name="month" id="month">
                </div>
                <div class="col-md-2 col-sm-6 col-12" style="margin-top: 33px">
                    <button type="submit" class="btn btn-success btn-sm submit-btn">Search <i class="fas fa-chevron-right ms-3 go-icon"></i></button>
                </div>
            </div>
        </form>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped" id="datatable">
                <thead>
                    <th>Employee Name</th>
                    <th>Bank Information</th>
                    <th>Total Absent</th>
                    <th>Salary</th>
                    <th>Arrears</th>
                    <th>Deduction</th>
                    <th>Net Payable</th>
                    <th>Paid</th>
                    <th>Due Salary</th>
                    <th>Payment Method</th>
                    <th>Action</th>
                </thead>
                <tbody class="payroll_body">

                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer text-end" style="display: none;">
        <button class="btn btn-success save-all">Save</button>
    </div>
</div>
@endsection

@section('page_level_scripts')
<script type="text/javascript">
    $(document).ready(function() {
        nav_bar_hide();
        payment_method_load();
    });

    $("#form-data").on('submit', function(e) {
        e.preventDefault();
        var month = $("#month").val();
        if (month) {
            $('.card-footer').show();
            // payrollDataTableLoad(month);
            $.ajax({
                url: api_url + "payroll/search",
                type: "POST",
                data: {
                    month,
                },
                dataType: "JSON",
                success: function(data) {
                    var pay_roll_body = '';
                    $(".payroll_body").html('');
                    $(data.data).each(function(i, row) {
                        paymentMethodSeleted(row.payroll)
                        salary = Number(row.salary).toFixed(0);
                        var final_salary =
                            parseInt(row.salary ?? 0) +
                            parseInt(row.payroll.arrears ?? 0) -
                            parseInt(row.payroll.deduction ?? 0);
                        if (row.payroll.paid == 0) {
                            final_paid = row.salary;
                        } else {
                            final_paid = row.payroll.paid;
                        }
                        pay_roll_body = `<tr>
                        <td>${row.user.first_name}</td>
                        <td>${row.bank_information??''}</td>
                        <td>${row.user_attendances_count}</td>
                        <td><span class='salary' data-salary='${salary}'>${salary}</span></td>
                        <td><span class='arrears' data-arrears='${row.payroll.arrears}'>${row.payroll.arrears}</span></td>
                        <td><span><input type = "number" class = "form-control deduction" id = "deduction" value = "${row.payroll.deduction}"> </span></td>
                        <td><span class='net_payable' data-net_payable='${final_salary}'>${final_salary}</span></td>
                        <td><span><input style ="width: 100px;" type = "text" class = "form-control paid" id = "paid" value = "${Number(final_salary).toFixed(0)}"></span></td>;
                        <td><span class='due_salary' data-due_salary='${row.payroll.due_salary}'>${row.payroll.due_salary}</span></td>;
                        <td><select class="form-control payment_method" id="payment_method" name="payment_method">${paymentMethodOptions}</select></td>;

                        <td class="text-center">
                        <a
                        href="#"
                        class="savePayroll"
                        data-user-session-id="${row.id}"
                        data-user-payroll-id="${row.payroll.id}"
                        data-status = "${row.payroll.status}"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="Click to save">
                        <i class="fa fa-check-circle btn btn-primary btn-sm btn-icon"></i>
                        </a>
                        <a href="${base_url}payroll/generate-salary-pdf?user_session_id=${row.id}&month=${month}"
                            target="_blank"
                            class="downloadPayrollss"
                            data-user-session-id="${row.id}"
                            data-status = "${row.payroll.status}"
                            data-user-payroll-id="${row.payroll.id}"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Click to download"
                        >
                        <i class="fa fa-download  btn btn-success btn-sm btn-icon"></i>
                        </a></td>                            
                        /tr>`;
                        $(".payroll_body").append(pay_roll_body);

                        var value = $(`.payment_method_${row.payroll.id}${row.payroll.payment_method_id}`).attr("selected", true);

                        $(".deduction").each(function() {
                            var paid = $(this)
                                .parents("tr")
                                .find(".savePayroll")
                                .attr("data-status");
                            if (paid == "paid") {
                                $(this)
                                    .parents("tr")
                                    .find("td")
                                    .addClass(["bg-success", "text-white"]);
                            }
                        });
                        console.log(value);
                    });
                }
            });
        }
    });

    $(document).on('keyup change', '.deduction', function() {
        var deduction = $(this).val();
        var salary = $(this).parents('tr').find('.salary').attr('data-salary');
        var net_payable = $(this).parents('tr').find('.net_payable').attr('data-net_payable');
        var paid = $(this).parents('tr').find('.paid').val();

        var arrears = $(this).parents('tr').find('.arrears').attr('data-arrears');
        var final_net_payable = Number(salary) + Number(arrears) - Number(deduction);
        var paid_salary = Number(net_payable) - Number(deduction);
        var due_salary = Number(net_payable) - Number(paid);

        $(this).parents('tr').find('.net_payable').attr('data-net_payable', final_net_payable).html(final_net_payable);
        $(this).parents('tr').find('.paid').val(final_net_payable);
        $(this).parents('tr').find('.due_salary').attr('data-due_salary', due_salary).html(due_salary);
    });

    $(document).on('keyup change', '.paid', function() {
        var net_payable = $(this).parents('tr').find('.net_payable').attr('data-net_payable');
        var paid = $(this).val();
        var due_salary = parseInt(net_payable) - parseInt(paid);
        $(this).parents('tr').find('.due_salary').attr('data-due_salary', due_salary).html(due_salary);
    });


    $(document).on('click', "#checkAll", function() {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    $(document).on('click', '.savePayroll', function() {
        var user_session_id = $(this).attr('data-user-session-id');
        var pay_roll_id = $(this).attr('data-user-payroll-id');
        var deduction = $(this).parents('tr').find('.deduction').val();
        var net_payable = $(this).parents('tr').find('.net_payable').attr('data-net_payable');
        var paid = $(this).parents('tr').find('.paid').val();
        var payment_method_id = $(this).parents('tr').find('.payment_method').val();
        var arrears = Number(net_payable) - Number(paid);
        var due_salary = Number(net_payable) - Number(paid);
        $(this).parents('tr').find('td').addClass(['bg-success', 'text-white']);

        $.ajax({
            url: api_url + "payroll/update",
            type: "POST",
            data: {
                user_session_id: user_session_id,
                pay_roll_id: pay_roll_id,
                deduction: deduction,
                net_payable: net_payable,
                paid: paid,
                arrears: arrears,
                due_salary: due_salary,
                payment_method_id: payment_method_id,
                month: $("#month").val()

            },
            dataType: "JSON",
            success: function(data) {
                if (data.status) {
                    $('.card-footer').show();
                    success_notify(data.message);

                } else {
                    error_notify(data.message);
                }
            }
        });
    });

    $(document).on('click', '.downloadPayroll', function() {
        var user_session_id = $(this).attr('data-user-session-id');
        $.ajax({
            url: api_url + "payroll/generate-salary-pdf",
            type: "POST",
            data: {
                user_session_id: user_session_id,
                month: $("#month").val()

            },
            dataType: "JSON",
            success: function(data) {
                if (data.status) {
                    window.open(`$ {data.pdf_link}`, '_blank');
                    console.log(data);
                } else {
                    error_notify(data.message);
                }
            }
        });
    });

    $(document).on('click', '.save-all', function() {
        data = getFormData();
        $.ajax({
            url: api_url + "payroll/update-all",
            type: "POST",
            data: JSON.stringify(getFormData()),
            contentType: "application/json",
            dataType: "JSON",
            success: function(data) {
                if (data.status) {
                    success_notify(data.message);
                    unblock_page();
                    $('.deduction').each(function() {
                        var status = $(this).parents('tr').find('.savePayroll').attr();
                        if (status == 'paid') {
                            $(this).parents('tr').find('td').addClass(['bg-success', 'text-white']);
                        }
                    });

                } else {
                    error_notify(data.message);
                }
            }
        });
        console.log(data);
    });


    function getFormData() {
        var data = {
            'payroll_detail': []
        }

        $('.deduction').each(function() {
            payroll_detail = {
                'deduction': $(this).val(),
                'user_session_id': $(this).parents('tr').find('.savePayroll').attr('data-user-session-id'),
                'pay_roll_id': $(this).parents('tr').find('.savePayroll').attr('data-user-payroll-id'),
                'deduction': $(this).parents('tr').find('.deduction').val(),
                'net_payable': $(this).parents('tr').find('.net_payable').attr('data-net_payable'),
                'paid': $(this).parents('tr').find('.paid').val(),
                'payment_method_id': $(this).parents('tr').find('.payment_method').val(),
            }
            data.payroll_detail.push(payroll_detail);
        });
        return data;
    }

    function paymentMethodSeleted(payroll) {
        paymentMethodOptions = "";
        paymentMethodResponse.forEach(function(data, i) {
            paymentMethodOptions += `<option class="payment_method_${payroll.id}${data.id}" value="${data.id}">${data.name}</option>`;
        });
        return paymentMethodOptions;
        // $(selector).append(add_fee_head_body);

    }
</script>

@endsection