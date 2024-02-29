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
            <form method="get" id="form-data" action="{{env('BASE_URL').'student-attendances/student-attendances-history'}}" target="_blank">
                <div class="row mb-3">
                    <div class="col-md-3 col-sm-6 col-12">
                        <label for="class_id" class="form-label">Class </label>
                        <select name="class_id" id="class_id" class="class_id select2"></select>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <label for="section_id" class="form-label d-flex justify-content-between">
                            <span>Section</span>
                        </label>
                        <select name="section_id" id="section_id" class="section_id select2"></select>
                    </div>

                    <div class="col-md-3 col-sm-6 col-12">
                        <label for="attendance_at" class="form-label d-flex justify-content-between">
                            <span>Date</span>
                        </label>
                        <input type="month" class="month form-control"
                               name="month" id="month" autocomplete="off">
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
            sections_load();
            class_load();
            attendance_type_load();
            nav_bar_hide();
        });
    </script>
@endsection

