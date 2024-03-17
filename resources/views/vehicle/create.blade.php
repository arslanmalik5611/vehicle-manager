@extends('layout.master')
@section('page_title','Vehicle')

@section('content')
<style>
    #image {
        height: 200px;
    }
</style>
<div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div>
                <h2 class="text-info"><i class="fas fa-plus-circle fa-icon"></i> Create </h2>
            </div>
            <div>
                <a href="{{env('BASE_URL').'vehicle'}}" class="btn btn-outline-success btn-sm">Vehicle
                    List</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="post" id="form-data">
            <figure>
                <blockquote class="blockquote">
                    <p>General Information</p>
                </blockquote>
                <figcaption class="blockquote-footer">
                    Please fill in <cite title="Source Title">details below</cite>
                </figcaption>
            </figure>
            <div class="row mb-3">
                <div class="col-md-3 col-sm-6 col-12">
                    <label for="first_name" class="form-label"><span class="required">*</span>Model Year </label>
                    <input type="text" class="form-control" id="model_year" name="model_year" placeholder="Enter Model Year" required>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <label for="odo_meter" class="form-label"><span class="required"></span>Odometer </label>
                    <input type="text" class="form-control" id="odo_meter" name="odo_meter" placeholder="Enter Odometer" required>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <label for="dob" class="form-label"><span class="required"></span>Make </label>
                    <input type="text" class="form-control" autocomplete="off" id="make" name="make" placeholder="">
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <label for="vin_no" class="form-label"><span class="required">*</span>VIN# </label>
                    <input type="text" class="form-control" autocomplete="off" id="vin_no" name="vin_no" placeholder="">
                </div>
            </div><!--End of row-->

            <div class="row mb-3">
                <div class="col-md-3 col-sm-6 col-12">
                    <label for="phone" class="form-label"><span class="required"></span>Model </label>
                    <input type="text" class="form-control" id="model" name="model" placeholder="">
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <label for="vehicle_no" class="form-label"><span class="required"></span>Vehicle # </label>
                    <input type="text" class="form-control" id="vehicle_no" name="vehicle_no" placeholder="">
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <label for="color" class="form-label"><span class="required"></span>Color </label>
                    <input type="text" class="form-control " id="color" name="color" placeholder="">
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <label for="driver" class="form-label"><span class="required"></span>Driver/Operator </label>
                    <select name="driver" id="driver" class="select2 driver">
                        <option value="">Select Driver</option>
                        @forelse ($Driver as $driver)
                        <option value="{{$driver['id']}}">{{$driver['name']}}</option>
                        @empty

                        @endforelse
                    </select>
                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <label for="vehicle_type" class="form-label"><span class="required"></span>Type </label>
                    <select name="vehicle_type" id="vehicle_type" class="select2 vehicle_type">
                        <option value="1">Car</option>
                        <option value="2">Boat</option>
                        <option value="3">Tractor</option>
                    </select>
                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <label for="department" class="form-label"><span class="required"></span>Department </label>
                    <select name="department" id="department" class="select2 department">
                        <option value="1">Administration</option>
                        <option value="2">Engineering</option>
                        <option value="3">Facilities</option>
                        <option value="4">Production</option>
                    </select>
                </div>

            </div><!--End of row-->
            <div class="row mb-3">
                <div class="col-md-3">
                    <!-- <label for="odo_meter" class="form-label"><span class="required"></span>Image </label> -->
                    <div class="imgUploadDiv ">
                        <br>
                        <img class="img-preview" width="100%">
                        <input type="file" name="image" id="image2" class="form-control imgUpload">
                    </div>
                </div>
            </div>

            <figure>
                <blockquote class="blockquote">
                    <p>License/Registration</p>
                </blockquote>
                <figcaption class="blockquote-footer">

                </figcaption>
            </figure>
            <div class="row mb-3">
                <div class="col-md-4 col-sm-6 col-12">
                    <label for="plate_no" class="form-label"><span class="required"></span>Plate/Tag # </label>
                    <input type="text" class="form-control" id="plate_no" name="plate_no" placeholder="">
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                    <label for="email" class="form-label"><span class="required"></span>Renewal </label>
                    <input type="date" class="form-control" id="renewal" name="renewal" placeholder="" value="<?php echo date('Y-m-d'); ?>">
                </div>
            </div>

            <figure>
                <blockquote class="blockquote">
                    <p>Mechanical</p>
                </blockquote>
                <figcaption class="blockquote-footer">

                </figcaption>
            </figure>
            <div class="row mb-3">
                <div class="col-md-4 col-sm-6 col-12">
                    <label for="engine" class="form-label"><span class="required"></span>Engine </label>
                    <input type="text" class="form-control" id="engine" name="engine" placeholder="">
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                    <label for="transmission" class="form-label"><span class="required"></span>Transmission </label>
                    <input type="text" class="form-control" id="transmission" name="transmission" placeholder="">
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                    <label for="tire_size" class="form-label"><span class="required"></span>Tire Size </label>
                    <input type="text" class="form-control" id="tire_size" name="tire_size" placeholder="">
                </div>
            </div>

            <!-- insurance -->
            <figure>
                <blockquote class="blockquote">
                    <p>Insurance</p>
                </blockquote>
                <figcaption class="blockquote-footer">

                </figcaption>
            </figure>
            <div class="row mb-3">
                <div class="col-md-4 col-sm-6 col-12">
                    <label for="company" class="form-label"><span class="required"></span>Company </label>
                    <input type="text" class="form-control" id="company" name="company" placeholder="">
                </div>
                <div class="col-sm-4 col-12">
                    <label for="account_no" class="form-label"><span class="required"></span>Account # </label>
                    <input type="text" class="form-control" id="account_no" name="account_no" placeholder="">
                </div>
                <div class="col-sm-4 col-12">
                    <label for="premium" class="form-label"><span class="required"></span>Price </label>
                    <input type="text" class="form-control" id="premium" name="premium" placeholder="">
                </div>
                <div class="col-sm-4 col-12">
                    <label for="due" class="form-label"><span class="required"></span>Due </label>
                    <input type="date" class="form-control" id="due" name="due" placeholder="" value="<?php echo date('Y-m-d'); ?>">
                </div>
            </div>
            <!-- insurance -->


            <div class="card-footer text-end">
                <button type="submit" class="btn btn-success mb-4 submit-btn">Save <i class="fas fa-chevron-right ms-3 go-icon"></i></button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('page_level_scripts')
<script type="text/javascript">
    $(document).ready(function() {
        show_img();
        console.log(api_url);


        $("#form-data").on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData($(this)[0]);
            $.ajax({
                url: api_url + "vehicle/store",
                type: "POST",
                data: formData,
                dataType: "JSON",
                processData: false, // tell jQuery not to process the data
                contentType: false, // tell jQuery not to set contentType
                success: function(data) {
                    if (data.status) {
                        success_notify(data.message);

                    } else {
                        error_notify(data.message);
                    }
                }
            });
        });
    });

    $(document).on('change', '.imgUpload', function() {
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                previewId = $(input).siblings('.img-preview');
                $(previewId).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection