@extends('layout.master')
@section('page_title','Audit Trail')
​
@section('content')
    <style>
        .col-datetime {
            width: 15%;
        }

        .small-text {
            font-weight: bold;
            font-size: 12px;
        }

        .col-action {
            width: 15%;
        }

        .col-user {
            width: 10%;
        }

        .col-trail {
            width: 60%;
        }

        .col-name::first-letter {
            text-transform: capitalize;
        }
    </style>
    <div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="text-info"><i class="fa fa-window-restore  fa-icon"></i> Patient Audit Trail </h2>
                </div>
                <div>
                    <a href="{{env('BASE_URL').'patients'}}" class="btn btn-outline-secondary btn-sm">Patients List</a>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <div class="row">
                <div class="col-md-10" id="patients-label"><span class="px-1">
                        <button type="button" class="btn btn-primary text-white btn-sm position-relative patient-name">
                            <span
                                class="badge position-absolute top-0 start-50 translate-middle bg-success patient-mr"></span>
                                            </button>
                    </span></div>
            </div>
            <table class="table table-bordered table-striped" id="audit-trail-table">
                <tr class="colored-bg">
                    <td class="col-datetime">Date Time</td>
                    <td class="col-action">Action</td>
                    <td class="col-user">User</td>
                    <td class="col-trail">Trail</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
​
@section('page_level_scripts')
    <script type="text/javascript">
        var mr =  '{{request()->mr}}';
    </script>
    <script src="{{asset('panel_assets/js/common_datatables.js?v='.date('ymdhis'))}}"></script>
    <script src="{{asset('panel_assets/js/patient_audit_trail.js?v='.date('ymdhis'))}}"></script>
@endsection
