@extends('layout.master')
@section('page_title','FIT 2 FLY PCR CREATE')

@section('content')
    <div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="text-info"><i class="fas fa-plus-circle fa-icon"></i> Create Fit to Fly PCR Patient</h2>
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
                        <label for="first_name" class="form-label"><span class="required">*</span>First Name </label>
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
                        <p>Home Address</p>
                    </blockquote>
                    <figcaption class="blockquote-footer">
                        Please fill in <cite title="Source Title">details below</cite>
                    </figcaption>
                </figure>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="country_id" class="form-label">Country</label>
                        <div class="input-group mb-3">
                            <select name="country_id" id="country_id" class=" country_id select2 form-control">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="state" class="form-label">State</label>
                        <input type="text" class="form-control" id="state" name="state"
                               placeholder="State">
                    </div>
                    <div class="col-md-3">
                        <label for="city" class="form-label"> City</label>
                        <input type="text" class="form-control" id="city" name="city"
                               placeholder="City">
                    </div>
                    <div class="col-md-3">
                        <label for="postal_code" class="form-label"> Post Code </label>
                        <input type="text" class="form-control" id="postal_code" name="postal_code"
                               placeholder="Post Code">
                    </div>
                </div><!--End of row-->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="address" class="form-label"> Address </label>
                        <input type="text" class="form-control" id="address" name="address"
                               placeholder="Address">
                    </div>
                    <div class="col-md-3">
                        <label for="Phone_no" class="form-label"> Phone No </label>
                        <input type="text" class="form-control" id="phone_no" name="phone_no"
                               placeholder="Phone No">
                    </div>
                    <div class="col-md-3">
                        <label for="email" class="form-label"> Email </label>
                        <input type="email" class="form-control" id="email" name="email"
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
                        <label for="destination_country_id" class="form-label">What country you are travelling
                            to?</label>
                        <div class="input-group mb-3">
                            <select name="destination_country_id" id="destination_country_id"
                                    class="select2 form-control country_id">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="transport_mode" class="form-label">How you will be travelling out of the UK?</label>
                        <div class="input-group mb-3">
                            <select name="transport_mode" id="transport_mode" class="select2 form-control">
                                <option value="By Air"> By Air</option>
                                <option value="By Sea(including vehicles,trucks and coaches by ferry)"> By Sea(including
                                    vehicles,trucks and coaches by ferry)
                                </option>
                                <option value="By Rail(Including vehicles by surostar)">By Rail(Including vehicles by
                                    surostar)
                                </option>

                            </select>
                        </div>
                    </div>
                </div><!--End of row-->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="station_from" class="form-label" style="font-size: 15px;"> Which airport, port
                            or station will you be travelling from? </label>
                        <input type="text" class="form-control" id="station_from" name="station_from"
                               placeholder="Which airport, port or station will you be travelling from?">
                    </div>
                    <div class="col-md-4">
                        <label for="travel_date" class="form-label">Travel Date </label>
                        <input type="text" class="form-control datepicker" id="travel_date" name="travel_date"
                               placeholder="Travel Date" autocomplete="off">
                    </div>
                    <div class="col-md-4">
                        <label for="travel_time" class="form-label"> Travel Time </label>
                        <input type="time" class="form-control" id="travel_time" name="travel_time"
                               placeholder="Travel Date">
                    </div>
                </div><!--End of row-->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="delivery-instructions" class="form-label"> Delivery
                            Instructions? </label>
                        <textarea id="delivery_instruction" name="delivery_instruction"
                                  placeholder="Delivery Instructions?" class="tinymce"></textarea>
                    </div>
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
        $(document).ready(function () {
            countries_load();
            $("#form-data").on('submit', function (e) {
                $('.submit-btn').attr('disabled', true);
                $('.go-icon').hide();
                $('.spinner-icon').show();
                e.preventDefault();
                $.ajax({
                    url: api_url + "patient/save-fit2fly-pcr-admin",
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

