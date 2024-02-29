@extends('layout.master')
@section('page_title','Student')
​
@section('content')
    <div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="text-info"><i class="fas fa-clipboard-list fa-icon"></i> Student </h2>
                </div>
                <div>
                    <a href="{{env('BASE_URL').'student/create'}}" class="btn btn-outline-secondary btn-sm">Create
                        Student</a>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive tabs-card-design">
            <div class="row mb-3">
                <div class="col-md-3 col-12">
                    <div class="card card-bordered">
                        <div class="card-header">
                            <div class="student-image">
                                <img src="" class="card-img-top rounded-circle studentImg" style="height: 100px"
                                     alt="student image">
                                <h3 class="text-center student-name fw-bold student_name"></h3>
                                <p class="text-muted text-center user-type"></p>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush card-bordered">
                                <li class="list-group-item d-flex justify-content-between fs-6">
                                    <b>Register NO</b>
                                    <a class="pull-right registration_no"></a>
                                </li>
                                <li class="list-group-item d-flex justify-content-between fs-6">
                                    <b>Roll</b>
                                    <a class="pull-right roll_no"></a>
                                </li>
                                <li class="list-group-item d-flex justify-content-between fs-6">
                                    <b>Class</b>
                                    <a class="pull-right student_class"></a>
                                </li>
                                <li class="list-group-item d-flex justify-content-between fs-6">
                                    <b>Section</b>
                                    <a class="pull-right student_section"></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <ul class="nav nav-tabs student-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                                    aria-selected="false">Profile
                            </button>
                        </li>
                        <li class=" nav-item" role="presentation">
                            <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#parents"
                                    type="button" role="tab" aria-controls="parents" aria-selected="true">Parents
                            </button>
                        </li>
                        <li class="nav-item " role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#attendance"
                                    type="button" role="tab" aria-controls="attendance" aria-selected="false">Attendance
                            </button>
                        </li>
                        <li class="nav-item " role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#mark"
                                    type="button" role="tab" aria-controls="mark" aria-selected="false">Mark
                            </button>
                        </li>
                        <li class="nav-item " role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#invoice"
                                    type="button" role="tab" aria-controls="invoice" aria-selected="false">Invoice
                            </button>
                        </li>
                        <li class="nav-item " role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#payment"
                                    type="button" role="tab" aria-controls="payment" aria-selected="false">Payment
                            </button>
                        </li>
                        <li class="nav-item " role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#document"
                                    type="button" role="tab" aria-controls="payment" aria-selected="false">Document
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="home-tab">
                            <table class="profile-table">
                                <tbody>

                                <tr>
                                    <td>Name</td>
                                    <td class="name"></td>
                                    <td>Admission Date</td>
                                    <td class="admission_date"></td>
                                </tr>
                                <tr>
                                    <td>Group</td>
                                    <td class="group"></td>
                                    <td>Address</td>
                                    <td class="address"></td>
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
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="parents" role="tabpanel" aria-labelledby="profile-tab">
                            <table class="parent-table">
                                <tbody>
                                <tr>
                                    <td>Guardian</td>
                                    <td class="guardian"></td>
                                    <td>Father's Name</td>
                                    <td class="father_name"></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td class="father_email"></td>
                                    <td>Phone</td>
                                    <td class="father_phone"></td>
                                </tr>
                                <tr>
                                    <td>Father Income(Monthly)</td>
                                    <td colspan="3" class="income"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="attendance" role="tabpanel" aria-labelledby="contact-tab">
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
                        <div class="tab-pane fade" id="mark" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="card card-bordered">
                                <div class="card-header">
                                    <h3 class="card-title">First Semester</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped table-bordered tabs-table">
                                        <thead>
                                        <tr>
                                            <th class="text-center exam-head" rowspan="2" data-title="Subject">
                                                Subject
                                            </th>
                                            <th colspan="2" class="text-center exam-head" data-title="Exam">Exam
                                            </th>
                                            <th colspan="2" class="text-center exam-head" data-title="Attendance">
                                                Attendance
                                            </th>
                                            <th colspan="2" class="text-center exam-head" data-title="Class Test">
                                                Class Test
                                            </th>
                                            <th colspan="2" class="text-center exam-head" data-title="Assignment">
                                                Assignment
                                            </th>
                                            <th colspan="3" class="text-center exam-head" data-title="Total">Total
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="text-center" data-title="Obtained Mark">Obtained Mark</th>
                                            <th class="text-center" data-title="Highest Mark">Highest Mark</th>
                                            <th class="text-center" data-title="Obtained Mark">Obtained Mark</th>
                                            <th class="text-center" data-title="Highest Mark">Highest Mark</th>
                                            <th class="text-center" data-title="Obtained Mark">Obtained Mark</th>
                                            <th class="text-center" data-title="Highest Mark">Highest Mark</th>
                                            <th class="text-center" data-title="Obtained Mark">Obtained Mark</th>
                                            <th class="text-center" data-title="Highest Mark">Highest Mark</th>
                                            <th class="text-center" data-title="Mark">Mark</th>
                                            <th class="text-center" data-title="Point">Point</th>
                                            <th class="text-center" data-title="Grade">Grade</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="text-black" data-title="Subject">Bangla</td>
                                            <td class="text-black" data-title="Mark">62</td>
                                            <td class="text-black" data-title="Highest Mark">67</td>
                                            <td class="text-black" data-title="Mark">6</td>
                                            <td class="text-black" data-title="Highest Mark">9</td>
                                            <td class="text-black" data-title="Mark">8</td>
                                            <td class="text-black" data-title="Highest Mark">9</td>
                                            <td class="text-black" data-title="Mark">7</td>
                                            <td class="text-black" data-title="Highest Mark">8</td>
                                            <td class="text-black" data-title="Mark">83</td>
                                            <td class="text-black" data-title="Point">5.00</td>
                                            <td class="text-black" data-title="Grade">A+</td>
                                        </tr>
                                        <tr>
                                            <td class="text-black" data-title="Subject">ICT</td>
                                            <td class="text-black" data-title="Mark">64</td>
                                            <td class="text-black" data-title="Highest Mark">64</td>
                                            <td class="text-black" data-title="Mark">8</td>
                                            <td class="text-black" data-title="Highest Mark">8</td>
                                            <td class="text-black" data-title="Mark">7</td>
                                            <td class="text-black" data-title="Highest Mark">7</td>
                                            <td class="text-black" data-title="Mark">8</td>
                                            <td class="text-black" data-title="Highest Mark">8</td>
                                            <td class="text-black" data-title="Mark">87</td>
                                            <td class="text-black" data-title="Point">5.00</td>
                                            <td class="text-black" data-title="Grade">A+</td>
                                        </tr>
                                        <tr>
                                            <td class="text-black" data-title="Subject">Math</td>
                                            <td class="text-black" data-title="Mark">65</td>
                                            <td class="text-black" data-title="Highest Mark">65</td>
                                            <td class="text-black" data-title="Mark">9</td>
                                            <td class="text-black" data-title="Highest Mark">9</td>
                                            <td class="text-black" data-title="Mark">8</td>
                                            <td class="text-black" data-title="Highest Mark">8</td>
                                            <td class="text-black" data-title="Mark">7</td>
                                            <td class="text-black" data-title="Highest Mark">8</td>
                                            <td class="text-black" data-title="Mark">89</td>
                                            <td class="text-black" data-title="Point">5.00</td>
                                            <td class="text-black" data-title="Grade">A+</td>
                                        </tr>
                                        <tr>
                                            <td class="text-black" data-title="Subject">English</td>
                                            <td class="text-black" data-title="Mark">65</td>
                                            <td class="text-black" data-title="Highest Mark">66</td>
                                            <td class="text-black" data-title="Mark">7</td>
                                            <td class="text-black" data-title="Highest Mark">8</td>
                                            <td class="text-black" data-title="Mark">8</td>
                                            <td class="text-black" data-title="Highest Mark">8</td>
                                            <td class="text-black" data-title="Mark">7</td>
                                            <td class="text-black" data-title="Highest Mark">8</td>
                                            <td class="text-black" data-title="Mark">87</td>
                                            <td class="text-black" data-title="Point">5.00</td>
                                            <td class="text-black" data-title="Grade">A+</td>
                                        </tr>
                                        <tr>
                                            <td class="text-black" data-title="Subject">Math Matrix</td>
                                            <td class="text-black" data-title="Mark">67</td>
                                            <td class="text-black" data-title="Highest Mark">67</td>
                                            <td class="text-black" data-title="Mark">8</td>
                                            <td class="text-black" data-title="Highest Mark">8</td>
                                            <td class="text-black" data-title="Mark">7</td>
                                            <td class="text-black" data-title="Highest Mark">8</td>
                                            <td class="text-black" data-title="Mark">8</td>
                                            <td class="text-black" data-title="Highest Mark">8</td>
                                            <td class="text-black" data-title="Mark">90</td>
                                            <td class="text-black" data-title="Point">5.00</td>
                                            <td class="text-black" data-title="Grade">A+</td>
                                        </tr>
                                        <tr>
                                            <td class="text-black" data-title="Subject">Drawing</td>
                                            <td class="text-black" data-title="Mark">68</td>
                                            <td class="text-black" data-title="Highest Mark">68</td>
                                            <td class="text-black" data-title="Mark">6</td>
                                            <td class="text-black" data-title="Highest Mark">8</td>
                                            <td class="text-black" data-title="Mark">8</td>
                                            <td class="text-black" data-title="Highest Mark">9</td>
                                            <td class="text-black" data-title="Mark">6</td>
                                            <td class="text-black" data-title="Highest Mark">8</td>
                                            <td class="text-black" data-title="Mark">88</td>
                                            <td class="text-black" data-title="Point">5.00</td>
                                            <td class="text-black" data-title="Grade">A+</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer">
                                    <p class="text-black total-marks-show">Total Marks
                                        : <span class="text-red text-bold">600.00</span>&nbsp;&nbsp;&nbsp;&nbsp;Total
                                        Obtained Marks : <span class="text-red text-bold">524.00</span>&nbsp;&nbsp;&nbsp;&nbsp;Total
                                        Average Marks : <span class="text-red text-bold">87.33</span>&nbsp;&nbsp;&nbsp;&nbsp;Total
                                        Average Marks(%) : <span class="text-red text-bold">87.00</span>&nbsp;&nbsp;&nbsp;&nbsp;Gpa
                                        : <span class="text-red text-bold">5.00</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="invoice" role="tabpanel" aria-labelledby="contact-tab">
                            <table class="table table-striped table-bordered table-hover" style="font-size: 12px">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Voucher No</th>
                                    <th>Batch No</th>
                                    <th>Month</th>
                                    <th>Payable.Amt</th>
                                    <th>Paid.Amt</th>
                                    <th>Due.Amt</th>
                                    <th>Status</th>
                                    <th>Depositor Name</th>
                                    <th>Depositor Phone</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody class="invoiceBody">

                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="contact-tab">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fee Type</th>
                                    <th>Date</th>
                                    <th>Paid</th>
                                    <th>Weaver</th>
                                    <th>Fine</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    <td colspan="3" data-title="Total">
                                        <b>Total (USD)</b>
                                    </td>
                                    <td data-title="Total Paid">
                                        0.00
                                    </td>
                                    <td data-title="Total Weaver">
                                        0.00
                                    </td>
                                    <td data-title="Total Fine">
                                        0.00
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="document" role="tabpanel" aria-labelledby="contact-tab">
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

@section('page_level_modal')
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
​
@section('page_level_scripts')
    <script src="{{asset('panel_assets/js/common_datatables.js?v='.date('ymdhis'))}}"></script>
    <script>
        $(document).ready(function () {
            nav_bar_hide();
            attendance_type_load();
            searchStudentDetail();
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

        // SEND CALL FOR GETTING DETAIL OF USER
        function searchStudentDetail() {
            $.ajax({
                url: api_url + "student/{{request()->id}}/detail",
                type: "GET",
                dataType: "JSON",
                success: function (response) {
                    if (response.status) {
                        show_document(response.data.attachments);


                        var student = response.data;
                        $('.group').append((student.enrollment.group.name ?? ''));
                        $('.student_class').append((student.enrollment.student_class.name ?? ''));
                        $('.section').append((student.enrollment.section.name ?? ''));
                        $('.dob').append((student.user.dob ?? ''));
                        $('.gender').append((student.user.gender ?? ''));
                        $('.address').append((student.user.address ?? ''));
                        $('.admission_date').append((student.admission_at ?? ''));
                        $('.email').append((student.user.email ?? ''));
                        $('.phone').append((student.user.phone ?? ''));
                        // if(student.user.last_name!==null){
                        //     last_name = student.user.last_name;
                        // }else{
                        //     last_name = '';
                        // }
                        $('.name').append((student.user.first_name ?? '') + ' ' + (student.user.last_name ?? ''));
                        $('.student_name').append((student.user.first_name ?? '') + ' ' + (student.user.last_name ?? ''));
                        $('.guardian').append((student.guardian.user.first_name ?? '') + ' ' + (student.guardian.user.last_name ?? ''));
                        $('.father_name').append((student.guardian.user.first_name ?? '') + ' ' + (student.guardian.user.last_name ?? ''));
                        $('.father_email').append((student.guardian.user.email ?? ''));
                        $('.father_phone').append((student.guardian.user.phone ?? ''));
                        $('.income').append((student.guardian.income ?? ''));
                        $('.registration_no').html((student.registration_no ?? ''));
                        $('.roll_no').html((student.roll_no ?? ''));
                        $('.studentImg').attr('src', (student.user.picture_url ?? ''));

                        // SHOW STUEDNT ATTENDANCE
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


                        // STUDENT INVOICE DETIAL SHOW
                        var count = 1;
                        var invoiceRows = '';
                        $(student.enrollment.student_fee_vouchers).each(function (i, voucher) {
                            invoiceRows += `<tr>
                                    <td data-title="#">
                                        ${count++}
                                    </td>

                                    <td>
                                        ${voucher.fee_voucher_number}
                                    </td>

                                    <td>
                                       ${voucher.batch_number}
                                    </td>

                                    <td>
                                       ${voucher.month_formatted}
                                    </td>

                                    <td>
                                        ${voucher.payable_amount}

                                    <td>
                                       ${voucher.paid_amount ?? ''}
                                    </td>

                                    <td>
                                       ${voucher.due_amount ?? ''}
                                    </td>

                                    <td>
                                        ${voucher.voucher_status_labelled}
                                    </td>

                                    <td>
                                        ${voucher.depositor_name ?? ''}
                                    </td>

                                    <td>
                                        ${voucher.depositor_phone ?? ''}
                                    </td>

                                    <td>
<a href="#" target="_blank" class="generateFeeVoucher" data-fee-voucher-number="${voucher.fee_voucher_number}" data-bs-toggle="tooltip" data-bs-placement="top"
                                         title="Click to see Voucher"> <i class="fas fa-download fa-2x text-primary"></i> </a>
</td>

                                </tr>`;
                        });

                        if (invoiceRows.length == 0) {
                            invoiceRows = `<tr>
                                    <td data-title="#" colspan="9" class="text-center">
                                        No Record Found
                                    </td>

                                </tr>`;
                        }
                        $('.invoiceBody').html(invoiceRows);

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
            var tr = '';
            var count = 1;
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
            $('.documentBody').html(tr);
        }

        // SAVE STUDENT DOCUMENT
        function save_document() {
            $("#document-form").on('submit', function (e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: api_url + "student/save-document",
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

        // DELETE STUDENT ATTACHMENT
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

        // GENERATE VOUCHER
        $(document).on('click', '.generateFeeVoucher', function (e) {
            e.preventDefault();
            generate_voucher_no_pdf($(this).attr('data-fee-voucher-number'));
        });

    </script>
@endsection
