@extends('layout.master')
@section('page_title','Patient Edit')

@section('content')
    <style type="text/css">
        #collection_center_div {
            display: none;
        }
    </style>
    <div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="text-info"><i class="fa fa-edit fa-icon"></i> Edit </h2>
                </div>
                <div>
                    <a href="{{env('BASE_URL').'patients/create'}}" class="btn btn-outline-danger btn-sm">Create
                        Patient</a>
                    <a href="{{env('BASE_URL').'patients/fit-to-fly-pcr'}}" class="btn btn-outline-info btn-sm">Create
                        FIT to FLY</a>
                    <a href="{{env('BASE_URL').'patients/day-2-pcr'}}" class="btn btn-outline-primary btn-sm">Create DAY
                        2 PCR</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="post" id="form-data">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="slug" class="form-label">Title</label>
                        <div class="input-group mb-3">
                            <select name="title" id="title" class="select2 form-control">
                                <option value=""> Not Stated</option>
                                <option value="Mr."> Mr.</option>
                                <option value="Mrs."> Mrs.</option>
                                <option value="Miss."> Miss</option>
                                <option value="Ms."> Ms.</option>
                                <option value="Dr."> Dr.</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="title" class="form-label"><span class="required">*</span> First Name </label>
                        <input type="text" class="form-control" id="first_name" name="first_name"
                               placeholder="First Name" required>
                    </div>
                    <div class="col-md-4">
                        <label for="title" class="form-label"><span class="required">*</span> Last Name </label>
                        <input type="text" class="form-control" id="last_name" name="last_name"
                               placeholder="Last Name" required>
                    </div>
                </div><!--End of row-->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="title" class="form-label">Gender </label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="na">Not Stated</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="title" class="form-label">D.O.B </label>
                        <input type="text" class="form-control datepicker" id="dob" name="dob"
                               placeholder="D.O.B (dd/mm/yy)" autocomplete="off">
                    </div>
                    <div class="col-md-4">
                        <label for="title" class="form-label"> Passport Number </label>
                        <input type="text" class="form-control" id="passport_number" name="passport_number"
                               placeholder="Passport Number">
                    </div>
                </div><!--End of row-->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="title" class="form-label"> NHS Number </label>
                        <input type="text" class="form-control" id="nhs_number" name="nhs_number"
                               placeholder="NHS Number">
                    </div>
                    <div class="col-md-4">
                        <label for="title" class="form-label"> Email </label>
                        <input type="email" class="form-control" id="email" name="email"
                               placeholder="Email">
                    </div>
                    <div class="col-md-4">
                        <label for="title" class="form-label"> Ethnicity </label>
                        <input type="text" class="form-control" id="ethnicity" name="ethnicity"
                               placeholder="Ethnicity">
                    </div>

                </div><!--End of row-->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="title" class="form-label"> Phone No </label>
                        <input type="text" class="form-control" id="phone_no" name="phone_no"
                               placeholder="Phone No">
                    </div>
                    <div class="col-md-4">
                        <label for="title" class="form-label"> Post Code </label>
                        <input type="text" class="form-control" id="postal_code" name="postal_code"
                               placeholder="Post Code">
                    </div>
                    <div class="col-md-4">
                        <label for="title" class="form-label"> Address </label>
                        <input type="text" class="form-control" id="address" name="address"
                               placeholder="Address">
                    </div>
                </div><!--End of row-->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="title" class="form-label"> Date Arrived UK </label>
                        <input type="text" class="form-control datepicker" id="date_arrived" name="date_arrived"
                               placeholder="Date Arrived UK (dd/mm/yy)" autocomplete="off">
                    </div>
                    <div class="col-md-4">
                        <label for="title" class="form-label"> Date Left </label>
                        <input type="text" class="form-control datepicker" id="date_left" name="date_left"
                               placeholder="Date Left (dd/mm/yy)" autocomplete="off">
                    </div>
                    <div class="col-md-4">
                        <label for="title" class="form-label"> Date to Report to PHE </label>
                        <input type="text" class="form-control datepicker" id="phe_report_date" name="phe_report_date"
                               placeholder="Date to Report to PHE (dd/mm/yy)" autocomplete="off">
                    </div>

                </div><!--End of row-->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="title" class="form-label"> Vaccination Status </label>
                        <select name="vaccination_status" id="vaccination_status" class="select2 form-control">
                            <option value="Fully Vaccinated">Fully Vaccinated</option>
                            <option value="Partially Vaccinated">Partially Vaccinated</option>
                            <option value="Unvaccinated">Unvaccinated</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="title" class="form-label"> Collection Date & Time </label>
                        <input type="text" class="form-control datetimepicker" id="collection_datetime"
                               name="collection_datetime"
                               placeholder="Collection Date & Time (dd/mm/yy H:I)" autocomplete="off">
                    </div>
                    <div class="col-md-4">
                        <label for="title" class="form-label"> Received Date & Time </label>
                        <input type="text" class="form-control datetimepicker" id="received_at" name="received_at"
                               placeholder="Registration Date & Time (dd/mm/yy H:I)" value="{{date('d/m/Y H:i')}}"
                               autocomplete="off">
                    </div>
                </div><!--End of row-->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="slug" class="form-label">Requested clinician name</label>
                        <div class="input-group mb-3">
                            <select name="reference_id" id="reference_id" class="select2 form-control">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4" id="collection_center_div">
                        <label for="slug" class="form-label">Collection Center</label>
                        <div class="input-group mb-3">
                            <select name="collection_center_id" id="collection_center_id" class="select2 form-control">
                            </select>
                        </div>
                    </div>
                </div><!--End of row-->
                <div class="row mb-3">
                    <label for="" class="form-label">Test</label>
                    <div class="col-md-4">
                        <select id="test_id" class="test_id form-control">
                        </select>
                    </div>
                    <div class="col-md-4 quick-tests-div">

                    </div>
                </div><!--End of row-->
                <div class="row mb-3">
                    <div class="col-md-8">
                        <table class="table table-bordered table-striped" id="tests">
                            <tr>
                                <th>Test Name</th>
                                <th>Sample</th>
                                <th>Turnaround Time</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <table class="table table-bordered">
                            <tr>
                                <td colspan="2" id="live_date_time_td">
                                    <span id="live_date_time"></span>
                                </td>
                            </tr>
                            <tr>
                                <th>Net Amount</th>
                                <td id="net-amount">0</td>
                            </tr>
                            <tr>
                                <th>Paid Amount</th>
                                <td>
                                    <input type="number" id="paid-amount" class="form-control" value="0">
                                </td>
                            </tr>
                            <tr>
                                <th>Due Amount</th>
                                <td id="due-amount">0</td>
                            </tr>
                        </table>
                    </div>
                </div><!--End of row-->

                <div class="card-footer text-end">
                    <input type="hidden" name="id" id="patient-id" value="{{request()->id}}">
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
        var id = '{{ request()->id }}';
    </script>
    <script src="{{asset('panel_assets/js/patient_edit.js?v='.date('ymdhis'))}}"></script>
@endsection

