@extends('layout.master')
@section('page_title','Voucher')

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
                    <h2 class="text-info"><i class="fas fa-plus-circle fa-icon"></i> User Voucher </h2>
                </div>
                {{--                <div>--}}
                {{--                    <a href="{{env('BASE_URL').'attendances'}}" class="btn btn-outline-success btn-sm">Voucher--}}
                {{--                        List</a>--}}
                {{--                </div>--}}
            </div>
        </div>
        <div class="card-body">
            <form method="GET" id="form-data" action="{{env('BASE_URL').'fee-vouchers/unpaid-voucher'}}" target="_blank">
                <div class="row mb-3">
                    <div class="col-md-3 col-sm-6 col-12">
                        <label for="month" class="form-label d-flex justify-content-between">
                            <span>Date</span>
                        </label>
                        <input type="month" class="month form-control"
                               name="month" id="month" autocomplete="off" placeholder="mm/yyyy">
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
                            {{--                            Voucher--}}
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

        });

        attendanceTypeData = '';
        // GET STUDENT FOR ATTENDANCE
        // $(document).ready(function () {
        //     $("#form-data").on('submit', function (e) {
        //         e.preventDefault();
        //         $.ajax({
        //             url: base_url + "fee-vouchers/unpaid-voucher",
        //             type: "POST",
        //             data: $(this).serialize(),
        //             dataType: "JSON",
        //             success: function (response) {
        //                 if (response.status) {
        //                     // success_notify(response.message);
        //
        //                 } else {
        //                     error_notify(response.message);
        //                 }
        //             }
        //         });
        //     });
        // });

    </script>
@endsection

