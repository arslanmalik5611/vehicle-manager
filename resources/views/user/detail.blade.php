@extends('layout.master')
@section('page_title','User')
​
@section('content')
    <style>
        .ul-detail {
            padding: 5px !important;
        }

        .orverflow-div {
            height: 400px;
            overflow: auto;
        }
    </style>
    <div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="text-info"><i class="fa fa-user fa-icon"></i> User </h2>
                </div>
                <div>
                    <a href="{{env('BASE_URL').'student/create'}}" class="btn btn-outline-secondary btn-sm">Create
                        User</a>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive tabs-card-design">
            <div class="row mb-3">
                <div class="col-md-3 col-12">
                    <div class="card card-bordered">
                        <div class="card-header">
                            <div class="student-image">
                                <img src=""
                                     class="card-img-top rounded-circle user-img"
                                     alt="User image" style="height: 100px">
                                <h3 class="text-center student-name fw-bold user-name"></h3>
                                <p class="text-muted text-center user-type"></p>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-session list-session-flush card-bordered ul-detail">
                                <li class="list-session-item d-flex justify-content-between fs-6">
                                    <b>Joining Date</b>
                                    <a class="pull-right joined_at"></a>
                                </li>
                                <li class="list-session-item d-flex justify-content-between fs-6">
                                    <b>Session</b>
                                    <a class="pull-right session-start"></a>
                                </li>
                                <li class="list-session-item d-flex justify-content-between fs-6">
                                    <b>Salary</b>
                                    <a class="pull-right total-salary"></a>
                                </li>
                                <li class="list-session-item d-flex justify-content-between fs-6">
                                    <b>Section</b>
                                    <a class="pull-right">A</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <ul class="nav nav-tabs student-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#profile" type="button" role="tab"
                                    aria-controls="profile" aria-selected="false">Profile
                            </button>
                        </li>
                        <li class=" nav-item" role="presentation">
                            <button class="nav-link" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#academic" type="button" role="tab" aria-controls="academic"
                                    aria-selected="true">Academic
                            </button>
                        </li>
                        <li class="nav-item " role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                    data-bs-target="#attendance" type="button" role="tab"
                                    aria-controls="attendance" aria-selected="false">Attendance
                            </button>
                        </li>
                        <li class="nav-item " role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                    data-bs-target="#payment" type="button" role="tab"
                                    aria-controls="payment" aria-selected="false">Payment
                            </button>
                        </li>
                        <li class="nav-item " role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                    data-bs-target="#income" type="button" role="tab"
                                    aria-controls="income" aria-selected="false">Income
                            </button>
                        </li>
                        <li class="nav-item " role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                    data-bs-target="#payRoll" type="button" role="tab"
                                    aria-controls="payRoll" aria-selected="false">Pay Roll
                            </button>
                        </li>
                        <li class="nav-item " role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#document"
                                    type="button" role="tab" aria-controls="payment" aria-selected="false">Document
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="profile" role="tabpanel"
                             aria-labelledby="home-tab">
                            <table class="profile-table">
                                <tbody>

                                <tr>
                                    <td>Name</td>
                                    <td class="name"></td>
                                    <td>Religion</td>
                                    <td class="religion"></td>
                                </tr>
                                <tr>
                                    <td>Date of Birth</td>
                                    <td class="dob"></td>
                                    <td>Gender</td>
                                    <td class="gender"></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td class="email"></td>
                                    <td>Phone</td>
                                    <td class="phone"></td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td class="address"></td>
                                    <td>Temporary Address</td>
                                    <td class="temporary_address"></td>
                                </tr>
                                <tr>
                                    <td>Personal Number</td>
                                    <td class="personal_number"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade" id="academic" role="tabpanel"
                             aria-labelledby="profile-tab">
                            <table class="parent-table">
                                <tbody>
                                <tr>
                                    <td>Joining Date</td>
                                    <td class="joining_date"></td>
                                    <td>Qualification</td>
                                    <td class="qualification"></td>
                                </tr>
                                <tr>
                                    <td>Session</td>
                                    <td class="session"></td>
                                    <td>Designation</td>
                                    <td class="designation"></td>
                                </tr>
                                <tr>
                                    <td>Salary</td>
                                    <td colspan="3" class="income"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade" id="attendance" role="tabpanel"
                             aria-labelledby="contact-tab">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="show-indi">

                                    </div>
                                </div>
                            </div>
                            <table class="table table-bordered tabs-table attendance-table">
                                <thead>
                                <tr>
                                    <th>Month</th>
                                    <th>01</th>
                                    <th>02</th>
                                    <th>03</th>
                                    <th>04</th>
                                    <th>05</th>
                                    <th>06</th>
                                    <th>07</th>
                                    <th>08</th>
                                    <th>09</th>
                                    <th>10</th>
                                    <th>11</th>
                                    <th>12</th>
                                    <th>13</th>
                                    <th>14</th>
                                    <th>15</th>
                                    <th>16</th>
                                    <th>17</th>
                                    <th>18</th>
                                    <th>19</th>
                                    <th>20</th>
                                    <th>21</th>
                                    <th>22</th>
                                    <th>23</th>
                                    <th>24</th>
                                    <th>25</th>
                                    <th>26</th>
                                    <th>27</th>
                                    <th>28</th>
                                    <th>29</th>
                                    <th>30</th>
                                    <th>31</th>
                                </tr>
                                </thead>
                                <tbody class="attendanceBody">

                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-sm-12 totalattendanceCount">

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade orverflow-div" id="payment" role="tabpanel"
                             aria-labelledby="contact-tab">
                            <div>
                                <p>Total Payment : <span class="totalPayment"></span></p>
                            </div>
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Expense</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody class="paymentBody">

                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade orverflow-div" id="income" role="tabpanel"
                             aria-labelledby="contact-tab">
                            <div>
                                <p> Total Income : <span class="total_income"></span></p>
                            </div>
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Income</th>
                                    <th>Amount</th>
                                </tr>
                                </thead>
                                <tbody class="incomeBody">

                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade orverflow-div" id="payRoll" role="tabpanel"
                             aria-labelledby="contact-tab">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Month</th>
                                    <th>Absent</th>
                                    <th>Salary</th>
                                    <th>Arrears</th>
                                    <th>Deduction</th>
                                    <th>Net.S</th>
                                    <th>Paid</th>
                                    <th>Due</th>
                                    <th>Status</th>
                                    <th>Payment. M</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody class="payRollBody">
                                {{--                                <tr class="paymentTotalRow">--}}
                                {{--                                    <td colspan="2" class="bold"><b>Total</b></td>--}}
                                {{--                                    <td colspan="2" class="totalPayment"></td>--}}
                                {{--                                </tr>--}}
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade orverflow-div" id="document" role="tabpanel"
                             aria-labelledby="contact-tab">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#documentModal">
                                        Add Document
                                    </button>
                                </div>
                            </div>
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody class="documentBody">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
​@section('page_level_modal')
    <!-- Modal -->
    <div class="modal fade w-100" id="documentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Document Upload</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="document-form">
                        <div class="row mb-3">
                            <div class="col-2">
                                <label for="title"><span class="required">*</span> Title</label>
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control title" name="title">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-2">
                                <label for="title"><span class="required">*</span> File</label>
                            </div>
                            <div class="col-6">
                                <input type="file" class="form-control attachment" name="attachment">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12 text-end">
                                <input type="hidden" class="id" name="id" value="{{request()->id}}">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                {{--                <div class="modal-footer">--}}
                {{--                    --}}
                {{--                </div>--}}
            </div>
        </div>
    </div>

@endsection
@section('page_level_scripts')
    <script src="{{asset('panel_assets/js/common_datatables.js?v='.date('ymdhis'))}}"></script>
    <script>
        $(document).ready(function () {
            nav_bar_hide();
            searchUserDetail();
            attendance_type_load();
            save_document();
            setTimeout(function () {
                attendance_type();
            }, 5000)
        });

        // SHOW ATTENDANCE SHORT NAME & COLOR
        function attendance_type() {
            attendanceTypeData = '';
            $(attendanceTypes).each(function (i, data) {
                attendanceTypeData += `
                <div class="toolbar"><div class="dt-yellow-box" style="background-color: ${data.color}"></div> <div class="dt-info-box"> &gt; Indicates ${data['name']}</div></div>
                `;
            });
            $('.show-indi').html(attendanceTypeData);
        }

        function searchUserDetail() {
            $.ajax({
                url: api_url + "users/{{request()->id}}/detail",
                type: "GET",
                dataType: "JSON",
                success: function (response) {
                    if (response.status) {
                        show_document(response.data.attachments)
                        var user = response.data;
                        $(".user-name").html(user.user.first_name + ' ' + user.user.last_name);
                        $('.user-img').attr('src', user.user.user_picture_url);
                        $('.user-type').append(user.user.role.name);
                        $('.session').append(user.session.name);
                        $('.dob').append(user.user.dob);
                        $('.gender').append(user.user.gender);
                        $('.address').append(user.user.address);
                        $('.temporary_address').append(user.user.temporary_address);
                        $('.religion').append(user.user.religion);
                        $('.email').append(user.user.email);
                        $('.phone').append(user.user.phone);
                        $('.name').append(user.user.first_name + ' ' + user.user.last_name);
                        $('.joining_date').append(user.joining_date_formatted);
                        $('.personal_number').append(user.personal_number);
                        $('.joined_at').append(user.joining_date_formatted);
                        $('.qualification').append(user.qualification);
                        $('.session').append(user.session.name);
                        $('.session-start').append(user.session.name);
                        $('.designation').append(user.designation);
                        $('.total-salary').append(user.salary);
                        $('.salary').append(user.salary);

                        // SHOW PAYMENT
                        payment_show(response.data.expenses);

                        // SHOW INCOME
                        income_show(response.data.incomes);

                        // SHOW PAY ROLL
                        pay_roll_show(response.data.many_payroll);

                        // SHOW USER ATTENDANCE
                        attendanceRow = '';
                        data = response.attendances;
                        for (const key in data) {
                            mainTd = '';
                            var newdata = data[key];
                            for (const value in newdata) {
                                mainTd += `<td style="background-color: ${newdata[value][1]}">${newdata[value][0]}</td>`;
                            }

                            attendanceRow += `<tr>
                                    <th>${key}</th>
                                   ${mainTd}
                                </tr>`;

                        }
                        $('.attendanceBody').html(attendanceRow);

                        // SHOW TOTAL OF ATTENDANCE
                        $('.totalattendanceCount').html(`<p>
                                        Total Holiday:${response.holiday_count}, Total Leave:${response.leave_count}, Total Present:${response.present_count}, Total Late With Excuse:${response.late_with_excuse_count}, Total Late:${response.late_count},Total Half Day:${response.half_day_count}, Total Absent:${response.absent_count} </p>`)


                    } else {
                        error_notify(response.message);
                    }
                }
            });
        }

        function show_document(document) {
            var tr = ` <tr>
                                     <td class="text-center">No Data Found</td>
                                 </tr>`;
            var count = 1;
            if (document.length !== 0) {
                tr = '';
                $(document).each(function (i, data) {
                    tr += `<tr>
                    <td>${count++}</td>
                    <td>${data.name}</td>
                    <td>${data.created_at_formatted}</td>
                    <td><a href="${data.file_name_url}" class="btn btn-info btn-sm btn-clean btn-icon text-white" title="Download" download> <i class="fa fa-download"></i> </a>
                    <a href="javascript:;" data-id="${data.id}" data-method="classes" class="deletebtn btn-danger btn btn-sm btn-clean btn-icon" title="Delete Record">
                                        <i class="fa fa-times-circle"></i>
                                    </a></td>
                </tr>`;
                });
            } else {
                tr = ` <tr>
                                    <td colspan="4" class="text-center bg-info">No Data Found</td>
                                </tr>`;
            }

            $('.documentBody').html(tr);
        }


        // SHOW PAYMENT FUNCTION
        function payment_show(payments) {
            var paymentRow = ``;
            var totalPayment = 0;
            count = 1;
            if (payments.length !== 0) {
                $(payments).each(function (i, data) {
                    totalPayment += parseFloat(data.amount);
                    paymentRow += `<tr>
                                    <td>
                                        ${count++}
                                    </td>
                                    <td>
                                        ${data.expense_head.name}
                                    </td>
                                    <td>
                                        ${Number(data.amount) + Number(0)}
                                    </td>
                                    <td>
                                        ${data.expense_date_formatted}
                                    </td>
                                </tr>`;
                });
            } else {
                paymentRow = '<td colspan="4" class="bg-info text-center">No Data Found</td>';
            }
            $('.paymentBody').html(paymentRow);
            $('.totalPayment').html(`<b>${totalPayment}/-</b>`);
        }

        // SHOW INCOME FUNCTION
        function income_show(payments) {
            var incomeRow = ``;
            var totalIncome = 0;
            count = 1;
            if (payments.length !== 0) {
                $(payments).each(function (i, data) {
                    totalIncome += parseFloat(data.amount);
                    incomeRow += `<tr>
                                    <td>
                                        ${data.income_date_formatted}
                                    </td>
                                    <td>
                                        ${count++}
                                    </td>
                                    <td>
                                        ${data.income_head.name}
                                    </td>
                                    <td>
                                        ${Number(data.amount) + Number(0)}
                                    </td>

                                </tr>`;
                });
            } else {
                incomeRow = '<td colspan="4" class="bg-info text-center">No Data Found</td>';
            }
            $('.incomeBody').html(incomeRow);
            $('.total_income').html(`<b>${totalIncome}/-</b>`);
        }

        // SHOW PAY ROLL FUNCTION
        function pay_roll_show(pay_rolls) {
            var payRollRow = ``;
            var totalPayment = 0;
            count = 1;
            if (pay_rolls.length !== 0) {
                $(pay_rolls).each(function (i, data) {
                    totalPayment += parseFloat(data.amount);
                    payRollRow += `<tr>
                                    <td>
                                        ${count++}
                                    </td>
                                    <td>
                                        ${data.month_formatted}
                                    </td>
                                    <td>
                                        ${data.total_absents}
                                    </td>
                                    <td>
                                        ${data.total_salary}
                                    </td>
                                    <td>
                                        ${data.arrears}
                                    </td>
                                    <td>
                                        ${data.deduction}
                                    </td>
                                    <td>
                                        ${data.net_salary}
                                    </td>
                                    <td>
                                        ${data.paid}
                                    </td>
                                    <td>
                                        ${data.due_salary}
                                    </td>
                                    <td>
                                        ${data.payroll_status_labelled}
                                    </td>
                                    <td>
                                        ${data.payment_method.name}
                                    </td>
                                    <td>
{{--{{env('BASE_URL')}}payroll/generate-salary-pdf?user_session_id=${data.user_session_id}&month=${data.month}" data-id="${data.id}--}}
                    <a href="javascript:void(0);" data-id="${data.user_session_id}" data-month='${data.month}' class="salaryPdfGenerateBtn me-1 btn-success btn btn-sm btn-clean btn-icon" title="Generate Card">
                                        <i class="fa fa-download"></i>
                                    </a>

                                    </td>
                                </tr>`;
                });
            } else {
                payRollRow = '<td colspan="4" class="bg-info text-center">No Data Found</td>';
            }
            $('.payRollBody').html(payRollRow);
            // $('.totalPayment').html(`<b>${totalPayment}/-</b>`);
        }

        // SAVE USER Attachment
        function save_document() {
            $("#document-form").on('submit', function (e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: api_url + "users/save-document",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: "JSON",
                    success: function (data) {
                        if (data.status) {
                            show_document(data.data);
                            success_notify(data.message);

                        } else {
                            error_notify(data.message);
                        }
                    }
                });
            });
        }

        // DELETE USER ATTACHMENT
        $(document).on('click', '.deletebtn', function (e) {
            thisElem = $(this);
            id = $(this).attr('data-id');
            console.log(id);
            deleteMethod = $(this).attr('data-method');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!"
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        url: api_url + 'attachments/' + id + '/delete',
                        type: "POST",
                        dataType: "JSON",
                        success: function (response) {
                            if (response.status) {
                                $(thisElem).parents('tr').remove();
                                Swal.fire(
                                    "Deleted!",
                                    response.message,
                                    "success"
                                )
                            } else {
                                Swal.fire(
                                    "Sorry!",
                                    "Your record could not deleted.",
                                    "error"
                                )
                            }

                        }
                    });

                }
            });
        });

        // GENERATE USER CARD
        $(document).on('click', '.salaryPdfGenerateBtn', function (e) {
            e.preventDefault();
            thisElem = $(this);
            id = $(this).attr('data-id');
            month = $(this).attr('data-month');
            $.ajax({
                url: api_url + 'payroll/generate-salary-pdf',
                type: "POST",
                data: {
                    'id': id,
                    'month': month
                },
                dataType: "JSON",
                success: function (response) {
                    if (response.status) {
                        success_notify(response.message);
                        // window.location.href = `${response.card_path}`;
                        window.open(`${response.pdf_link}`, '_blank');
                    } else {
                        error_notify(response.message);
                    }


                }
            });
        });
    </script>
@endsection
