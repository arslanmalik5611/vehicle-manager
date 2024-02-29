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
                    <h2 class="text-info"><i class="fas fa-search fa-icon"></i> Student Attendance </h2>
                </div>
                {{--                <div>--}}
                {{--                    <a href="{{env('BASE_URL').'attendances'}}" class="btn btn-outline-success btn-sm">Attendance--}}
                {{--                        List</a>--}}
                {{--                </div>--}}
            </div>
        </div>
        <div class="card-body">
            <form method="get" id="form-data" action="{{env('BASE_URL').'student-attendances/day-book'}}" target="_blank">
                <div class="row mb-3">
                    <div class="col-md-3 col-sm-6 col-12">
                        <label for="from_date" class="form-label d-flex justify-content-between">
                            <span>From Date</span>
                        </label>
                        <input type="text" class="from_date datepicker form-control"
                               name="from_date" id="from_date" autocomplete="off" placeholder="dd/mm/YY">
                    </div>

                    <div class="col-md-3 col-sm-6 col-12">
                        <label for="to_date" class="form-label d-flex justify-content-between">
                            <span>To Date</span>
                        </label>
                        <input type="text" class="to_date datepicker form-control"
                               name="to_date" id="to_date" autocomplete="off" placeholder="dd/mm/YY">
                    </div>

                    <div class="col-md-3 col-sm-6 col-12">
                        <button type="submit" class="btn btn-primary searchStudent" style="margin-top: 31px">Search
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('page_level_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            nav_bar_hide();
        });
    </script>
@endsection

