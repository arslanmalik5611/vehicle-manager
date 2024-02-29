@extends('layout.master')
@section('page_title','DAY 2 PCR EDIT')

@section('content')
    <div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="text-info"><i class="fas fa-plus-circle fa-icon"></i> Create Day 2 PCR Patient</h2>
                </div>
                <div>
                    <a href="{{env('BASE_URL').'patients/create'}}" class="btn btn-outline-danger btn-sm">Create Patient</a>
                    <a href="{{env('BASE_URL').'patients/fit-to-fly-pcr'}}" class="btn btn-outline-info btn-sm">Create FIT to FLY</a>
                    <a href="{{env('BASE_URL').'patients/day-2-pcr'}}" class="btn btn-outline-primary btn-sm">Create DAY 2 PCR</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="post" id="form-data">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="first_name" class="form-label"><span class="required">*</span> First Name </label>
                        <input type="text" class="form-control" id="first_name" name="first_name"
                               placeholder="First Name" required>
                    </div>

                    <div class="col-md-3">
                        <label for="last_name" class="form-label">Last Name </label>
                        <input type="text" class="form-control" id="last_name" name="last_name"
                               placeholder="Last Name">
                    </div>
                    <div class="col-md-3">
                        <label for="dob" class="form-label"> Date of birth </label>
                        <input type="text" class="form-control datepicker" id="dob" name="dob"
                               placeholder="D.O.B (dd/mm/yy)" autocomplete="off">
                    </div>
                    <div class="col-md-3">
                        <label for="gender" class="form-label">Gender</label>
                        <div class="input-group mb-3">
                            <select name="gender" id="gender" class="select2 form-control">
                                <option value="male"> Male</option>
                                <option value="female"> Female</option>
                                <option value="na"> Not Answered</option>
                            </select>
                        </div>
                    </div>
                </div><!--End of row-->
                <figure>
                    <blockquote class="blockquote">
                        <p>Kit Address</p>
                    </blockquote>
                    <figcaption class="blockquote-footer">
                        Please fill in <cite title="Source Title">details below</cite>
                    </figcaption>
                </figure>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="kit_address" class="form-label"> Address 1 </label>
                        <textarea class="form-control" id="kit_address" name="kit_address"
                                  placeholder="Address 1"></textarea>
                    </div>
                    <div class="col-md-4">
                        <label for="kit_country_id" class="form-label">Country</label>
                        <div class="input-group mb-3">
                            <select name="kit_country_id" id="kit_country_id" class="select2 country_id form-control">
                                <option value="male"> Male</option>
                                <option value="female"> Female</option>
                                <option value="na"> Not Answered</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="kit_city" class="form-label"> City </label>
                        <input type="text" class="form-control" id="kit_city" name="kit_city"
                               placeholder="City">
                    </div>
                    <div class="col-md-4">
                        <label for="kit_postal_code" class="form-label"> Post Code
                        </label>
                        <input type="text" class="form-control" id="kit_postal_code" name="kit_postal_code"
                               placeholder="Post Code">
                    </div>
                </div><!-- row-end -->
                <figure>
                    <blockquote class="blockquote">
                        <p> Home Address</p>
                    </blockquote>
                    <figcaption class="blockquote-footer">
                        Please fill in <cite title="Source Title">details below</cite>
                    </figcaption>
                </figure>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="address" class="form-label"> Address </label>
                        <textarea class="form-control" id="address" name="address"
                                  placeholder="Address"></textarea>
                    </div>
                    <div class="col-md-4">
                        <label for="country_id" class="form-label">Country</label>
                        <div class="input-group mb-3">
                            <select name="country_id" id="country_id" class="select2 country_id form-control">
                            </select>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <label for="state" class="form-label"> State </label>
                        <input type="type" class="form-control" id="state" name="state"
                               placeholder="State">
                    </div>
                    <div class="col-md-4">
                        <label for="city" class="form-label"> City </label>
                        <input type="text" class="form-control" id="city" name="city"
                               placeholder="City">
                    </div>
                </div><!--End of row-->

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="postal_code" class="form-label"> Post Code</label>
                        <input type="text" class="form-control" id="postal_code" name="postal_code"
                               placeholder="Post Code">
                    </div>
                    <div class="col-md-4">
                        <label for="phone_no" class="form-label"> Phone No </label>
                        <input type="text" class="form-control" id="phone_no" name="phone_no"
                               placeholder="Phone No">
                    </div>
                    <div class="col-md-4">
                        <label for="email" class="form-label"> Email </label>
                        <input type="text" class="form-control" id="email" name="email"
                               placeholder="Email">
                    </div>
                </div><!--End of row-->
                <figure>
                    <blockquote class="blockquote">
                        <p>Your Travel Details</p>
                    </blockquote>
                    <figcaption class="blockquote-footer">
                        Please fill in <cite title="Source Title">details below</cite>
                    </figcaption>
                </figure>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="passport_number" class="form-label"> Passport Number
                        </label>
                        <input type="text" class="form-control" id="passport_number" name="passport_number"
                               placeholder="Passport Number">
                    </div>
                    <div class="col-md-4">
                        <label for="airline_name" class="form-label">
                            Airline/Vessel/Coach Name </label>
                        <input type="text" class="form-control" id="airline_name" name="airline_name"
                               placeholder="Airline/Vessel/Coach Name">
                    </div>
                    <div class="col-md-4">
                        <label for="arrival_airline_name" class="form-label"> Arrival
                            Flight/Vessel/Coach name </label>
                        <input type="text" class="form-control" id="arrival_airline_name" name="arrival_airline_name"
                               placeholder="Arrival Flight/Vessel/Coach Name">
                    </div>
                </div><!--End of row-->
                <figure>
                    <blockquote class="blockquote">
                        <p>Additional Information Required by Public Health England</p>
                    </blockquote>
                    <figcaption class="blockquote-footer">
                        Please fill in <cite title="Source Title">details below</cite>
                    </figcaption>
                </figure>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="ethnicity" class="form-label"> Ethnicity </label>
                        <input type="text" class="form-control" id="ethnicity" name="ethnicity"
                               placeholder="Ethnicity">
                    </div>
                    <div class="col-md-3">
                        <label for="nhs_number" class="form-label"> NHS Number </label>
                        <input type="text" class="form-control" id="nhs_number" name="nhs_number"
                               placeholder="NHS Number">
                    </div>
                    <div class="col-md-3">
                        <label for="date_arrived" class="form-label"> Date </label>
                        <input type="text" class="form-control datepicker" id="date_arrived" name="date_arrived"
                               placeholder="(dd/mm/yy)">
                    </div>
                    <div class="col-md-3">
                        <label for="vaccination_status" class="form-label">Vaccination Status</label>
                        <div class="input-group mb-3">
                            <select name="vaccination_status" id="vaccination_status" class="select2 form-control">
                                <option value="Fully Vaccinated"> Fully Vaccinated</option>
                                <option value="Partially Vaccinated"> Partially Vaccinated</option>
                                <option value="Unvaccinated"> Unvaccinated</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!--End of row-->

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="date_left" class="form-label"> The date on which you
                            last departed from or transited through a country or territory outside of the Common Travel
                            Area</label>
                        <input type="text" class="form-control datepicker" id="date_left" name="date_left"
                               placeholder="(dd/mm/yy)">
                    </div>
                    <div class="col-md-6">
                        <label for="transit_area" class="form-label"> The country or
                            territory you were, or will be travelling from when you arrived in the UK, and any country
                            or territory you transited through as part of that journey </label>
                        <input type="text" class="form-control" id="transit_area" name="transit_area"
                               placeholder="The country or territory you were, or will be travelling from">
                    </div>
                </div><!--End of row-->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="delivery_instruction" class="form-label"> Delivery
                            Instructions? </label>
                        <textarea class="form-control tinymce" id="delivery_instruction" name="delivery_instruction"
                                  placeholder="Delivery Instructions?"></textarea>
                    </div>

                </div>
                <!--End of row-->
                <div class="card-footer text-end">
                    <input type="hidden" name="id" value="{{request()->id}}">
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
            countries_load();
            patient_load();

            function patient_load() {
                $.ajax({
                    url: api_url + 'patient/{{ request()->id }}',
                    dataType: "JSON",
                    success: function (response) {
                        var inputs = ['first_name', 'last_name', 'gender', 'kit_address', 'kit_country_id', 'kit_city', 'kit_postal_code', 'address', 'country_id', 'state', 'city', 'postal_code', 'phone_no', 'email', 'passport_number', 'airline_name', 'arrival_airline_name', 'ethnicity', 'nhs_number', 'vaccination_status', 'transit_area'];
                        var dates = ['dob', 'date_left', 'date_arrived'];
                        inputs.forEach(function (e) {
                            $('#' + e).val(response.data[e]).change();
                        });
                        dates.forEach(function (e) {
                            $('#' + e).val(reformatDatePickerDate(response.data[e]));
                        });
                        setTimeout(function(){
                            $('#kit_country_id').val(response.data.kit_country_id).change();
                            $('#country_id').val(response.data.country_id).change();
                        },1000);

                        tinyMCE.get('delivery_instruction').setContent(response.data.delivery_instruction);
                    }
                });
            }

            $("#form-data").on('submit', function (e) {
                //$('.submit-btn').attr('disabled', true);
                $('.go-icon').hide();
                $('.spinner-icon').show();
                e.preventDefault();
                $.ajax({
                    url: api_url + "patient/update-patient-general",
                    type: "POST",
                    data: $(this).serialize(),
                    dataType: "JSON",
                    success: function (data) {
                        if (data.status) {
                            $('.go-icon').show();
                            $('.spinner-icon').hide();
                            $('.submit-btn').attr('disabled', false);
                            Lobibox.notify('success', {
                                size: 'mini',
                                sound: false,
                                msg: data.message
                            });

                        } else {
                            $('.submit-btn').attr('disabled', false);
                            $('.go-icon').show();
                            $('.spinner-icon').hide();
                            Lobibox.notify('error', {
                                size: 'mini',
                                sound: false,
                                msg: data.message
                            });

                        }
                    }
                });
            });
        });
    </script>
@endsection

