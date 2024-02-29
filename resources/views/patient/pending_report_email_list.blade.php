@extends('layout.master')
@section('page_title','Pending Emails List')

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/jszip.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/xlsx.js"></script>
    <div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="text-info"><i class="fas fa-envelope fa-icon"></i> Pending Emails List
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
        <div class="card-body table-responsive pending-reports-email-card-body">
            <div id="error-message"></div>
            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="import_mrs">Choose <code>.xlsx</code> file to import MRs <i
                            class="fa fa-info-circle text-info"
                            title="Uploaded file must have one column only with Mrs & without title"
                            data-bs-toggle="tooltip"></i></label>
                    <input id="import_mrs" type=file name="files[]" class="form-control">
                </div>
            </div>
            <form action="#" id="form-data1">
                <div class="row mb-3">
                    <div class="col-md-10">
                        <label for="">Enter Patients Mr(s) separated by comma or single mr in one line</label>
                        <textarea name="mrs" id="mrs" rows="5" class="form-control" required
                                  placeholder="2201600014,2201600015,2201600016
2201600017
2201600018
2201600019
 etc."></textarea>
                    </div>
                    <div class="col-md-2">
                        <br/><br/><br/>
                        <input type="submit" class="btn btn-primary send-email-btn" value="Send Email(s)">
                    </div>
                </div><!--End of row-->
            </form>

            <form id="form-data">
                <input type="hidden" name="collection_center_id_referral" id="collection_center_id_referral"
                       value="{{$_GET['cc'] ?? ''}}">
                <input type="hidden" name="from_date_referral" id="from_date_referral"
                       value="{{$_GET['date'] ?? ''}}">
                <input type="hidden" name="to_date_referral" id="to_date_referral"
                       value="{{$_GET['date'] ?? ''}}">
                <input type="hidden" name="duration_referral" id="duration" value="{{$_GET['duration'] ?? ''}}">
            </form>
            <table class="table table-bordered" id="datatable">
            </table>
        </div>
    </div>


@endsection

@section('page_level_scripts')
    <script src="{{asset('panel_assets/js/patient_datatables.js?v='.date('ymdhis'))}}"></script>
    <script src="{{asset('panel_assets/js/patient_pending_report_email_list.js?v='.date('ymdhis'))}}"></script>
@endsection
