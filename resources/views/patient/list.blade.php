@extends('layout.master')
@section('page_title','Filter Patients List')

@section('content')
    <div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="text-info"><i class="fas fa-search fa-icon"></i> Filter Patients List </h2>
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
        <div class="card-body table-responsive">
            <div id="filter-form-div">
                <form action="#" id="form-data">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="title" class="form-label">Mr.No </label>
                            <input type="text" class="form-control filter-input" id="mr" name="mr"
                                   placeholder="Mr.No">
                        </div>
                        <div class="col-md-4">
                            <label for="title" class="form-label"> Name </label>
                            <input type="text" class="form-control filter-input" id="name" name="name"
                                   placeholder="Name">
                        </div>
                        <div class="col-md-4">
                            <label for="title" class="form-label"> Passport number </label>
                            <input type="text" class="form-control filter-input" id="passport_number"
                                   name="passport_number"
                                   placeholder="Passport Number">
                        </div>
                    </div><!--End of row-->
                    <div class="row mb-3">
                        <div class="col-md-4" id="collection_center_div">
                            <label for="slug" class="form-label">Collection Center</label>
                            <div class="input-group mb-3">
                                <select name="collection_center_id" id="collection_center_id"
                                        class="select2 form-control filter-select">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="title" class="form-label">Requested clinician name
                            </label>
                            <select name="reference_id" id="reference_id" class="select2 form-control filter-select">
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="slug" class="form-label">Booking (Inlab/Online)</label>
                            <div class="input-group mb-3">
                                <select name="booking" id="booking" class="select2 form-control filter-select">
                                    <option value="">All</option>
                                    <option value="inlab">Inlab</option>
                                    <option value="online">Online</option>
                                </select>
                            </div>
                        </div>
                    </div><!--End of row-->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="title" class="form-label"> From Date </label>
                            <input type="text" class="form-control filter-input  datepicker" autocomplete="off"
                                   id="from_date"
                                   name="from_date"
                                   placeholder="From Date">
                        </div>
                        <div class="col-md-4">
                            <label for="title" class="form-label"> To Date </label>
                            <input type="text" class="form-control filter-input datepicker" autocomplete="off"
                                   id="to_date"
                                   name="to_date"
                                   placeholder="To Date">
                        </div>
                        <div class="col-md-4">
                            <label for="title" class="form-label"> Archives </label>
                            <select name="archive_id_filter" id="archive_id_filter"
                                    class="form-control archive_id_filter select2"></select>
                        </div>
                    </div><!--End of row-->
                    <div class="row justify-content-end">
                        <div class="col-md-2">
                            <br/>
                            <input type="hidden" name="collection_center_id_referral" id="collection_center_id_referral"
                                   value="{{$_GET['cc'] ?? ''}}">
                            <input type="hidden" name="from_date_referral" id="from_date_referral"
                                   value="{{$_GET['date'] ?? ''}}">
                            <input type="hidden" name="to_date_referral" id="to_date_referral"
                                   value="{{$_GET['date'] ?? ''}}">
                            <input type="hidden" name="duration_referral" id="duration"
                                   value="{{$_GET['duration'] ?? ''}}">
                            <a href="#" class="btn btn-success filter-btn"><i class="fa fa-search"></i> Search</a>
                            <a href="#" class="btn btn-warning clear-search "><i class="fa fa-eraser"></i> Clear</a>
                        </div>
                    </div><!--End of row-->
            </div>
            <div class="row justify-content-center">
                <div class="col-2">
                    <span class="badge bg-info toggle-search-btn">
                        Toggle Search <br/>
                        <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                    </span>
                </div>
            </div>
            </form>
        </div>
    </div>
    <div class="card text-dark shadow-2 mb-3 filtered-patients-card" style="max-width: 18rem;display: none">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="text-info"><i class="fas fa-clipboard-list fa-icon"></i> Filter Patients List </h2>
                </div>
                <div>
                    <button class="btn btn-secondary print-barcodes-btn text-white">
                        <i class="fa fa-barcode"></i> Print Barcodes
                    </button>
                    <button class="btn btn-primary export-patients-btn text-white">
                        <i class="fa fa-download"></i> Export
                    </button>
                    <button class="btn btn-info archive-patients-btn text-white">
                        <i class="fa fa-archive"></i> Archive Patients
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered" id="datatable">
            </table>
        </div>
    </div>

    <!-- Archive Patients Modal -->
    <div class="modal fade" id="archivePatientsModal" tabindex="-1" aria-labelledby="archivePatientsModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="archivePatientsModalLabel"><i class="fa fa-archive"></i> Archive
                        Patients</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12 font-medium-4 text-center" style="color: #c10404;font-weight: bold;">
                            You are archiving <span id="archive-count" class="font-lg-5 font-italic"
                                                    style="color:#000002">0</span> patients.
                        </div>
                        <div class="col-md-11">
                            <label for="archive_id" class="form-label">Choose Archive <span
                                    class="fa fa-plus-circle create-new-archive"></span></label>
                            <div class="input-group mb-3">
                                <select name="archive_id" id="archive_id"
                                        class="form-control archive_id">
                                </select>
                            </div>
                        </div>
                    </div><!--End of row-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary archive-patients-save-btn">Archive</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Archive Modal -->
    <div class="modal fade" id="createArchiveModal" tabindex="-1" aria-labelledby="createArchiveModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createArchiveModalLabel"><i class="fa fa-plus-circle"></i> Create
                        Archive</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="title" class="form-label">Title</label>
                            <div class="input-group mb-3">
                                <input type="text" name="title" id="title"
                                       class="form-control">
                            </div>
                        </div>
                    </div><!--End of row-->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="notes" class="form-label">Notes</label>
                            <div class="input-group mb-3">
                                <textarea name="notes" id="notes" class="form-control"></textarea>
                            </div>
                        </div>
                    </div><!--End of row-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-warning create-archive-btn">Create Archive</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Export XLS Patients Modal -->
    <div class="modal fade" id="exportPatientsModal" tabindex="-1" aria-labelledby="exportPatientsModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exportPatientsModalLabel"><i class="fa fa-download"></i> Export
                        Patients</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12 font-medium-4 text-center" style="color: #c10404;font-weight: bold;">
                            You are exporting <span id="xls-count" class="font-lg-5 font-italic"
                                                    style="color:#000002">0</span> patients.
                        </div>
                        <div class="col-md-11">
                            <label for="xls_id" class="form-label"><span> <i class="fa fa-info-circle text-info"></i> Choose Columns
                                to Export</span></label>
                            <div class="input-group mb-3">
                                <div class="row">
                                    @php
                                        $cols = ['mr','first_name','last_name,','gender','dob','phone_no','email','ethnicity','postal_code','address','date_left','registered_at','collection_datetime'];
                                    @endphp
                                    @foreach($cols as $col)

                                        <div class="col-md-6">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input export_cols" type="checkbox"
                                                       id="{{$col.'_col'}}" value="{{$col}}"
                                                       checked>
                                                <label class="form-check-label"
                                                       for="{{$col.'_col'}}">{{ucwords(str_replace('_',' ',$col))}}</label>
                                            </div>
                                        </div>
                                    @endforeach


                                </div>
                            </div>
                        </div>
                    </div><!--End of row-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary export-patients-save-btn" value="xlsx"><i
                            class="fa fa-file-excel"></i> Export Excel
                    </button>
                    <button type="button" class="btn btn-info export-patients-save-btn text-white" value="pdf"><i
                            class="fa fa-file-pdf"></i> Export PDF
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page_level_scripts')

    <script src="{{asset('panel_assets/js/patient_datatables.js?v='.date('ymdhis'))}}"></script>
    <script type="text/javascript">
        @if(!empty($_GET))
        $(document).ready(function () {
            filter_patients();
        });
        @endif
    </script>
    <script src="{{asset('panel_assets/js/patient_list.js?v='.date('ymdhis'))}}"></script>
@endsection
