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
                    <h2 class="text-info"><i class="fas fa-plus-circle fa-icon"></i> User Attendance Filter </h2>
                </div>
                {{--                <div>--}}
                {{--                    <a href="{{env('BASE_URL').'attendances'}}" class="btn btn-outline-success btn-sm">Attendance--}}
                {{--                        List</a>--}}
                {{--                </div>--}}
            </div>
        </div>
        <div class="card-body">
            <form method="get" id="form-data" action="{{env('BASE_URL').'user-attendances/user-attendances-history'}}" target="_blank">
                <div class="row mb-3">
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
            // sections_optional_load();
            // classes_optional_load();
            attendance_type_load();
            nav_bar_hide();
        });
    </script>
@endsection

