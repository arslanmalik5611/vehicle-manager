@extends('layout.master')
@section('page_title','Report Create')

@section('content')
    <div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="text-info"><i class="fas fa-plus-circle fa-icon"></i> Create Report
                    </h2>
                </div>
                <div>
                    <a href="{{env('BASE_URL').'patients'}}" class="btn btn-outline-danger btn-sm">Patients List &
                        Filter</a>
                    <a href="{{env('BASE_URL').'patients/pending-report'}}" class="btn btn-outline-info btn-sm">Pending
                        Reports</a>
                    <a href="{{env('BASE_URL').'patients/pending-report-email'}}"
                       class="btn btn-outline-primary btn-sm">Pending Emails</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="post" id="form-data">

                <div class="row justify-content-center mb-3">
                    <div class="col-md-10" id="error-message">
                        {{--<span>This report is being created for MR(s):</span>
                        <span>{{request()->mrs}}</span>--}}
                    </div>
                    <div class="col-md-10 mb-2"><span>This report is being created for MR(s):</span></div>
                    <div class="col-md-10" id="patients-label"></div>

                </div><!--End of row-->
                <div class="row justify-content-center" id="report-create-area">

                </div><!--End of row-->
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
        var mrs = '{{$mrs}}';
    </script>
    <script src="{{asset('panel_assets/js/patient_report_create.js?v='.date('ymdhis'))}}"></script>
@endsection

